const orderForm = document.querySelector('.orderForm');

const orderId = document.getElementById('orderId');
const orderIdDisplay = document.getElementById('orderIdDisplay');
const orderUserId = document.getElementById('orderUserId');
const orderCreatedAt = document.getElementById('orderCreatedAt');
const orderAddress = document.getElementById('orderAddress');
const orderDeliveryType = document.getElementById('orderDeliveryType');
const orderPickupDeliveryType = document.getElementById('orderPickupDeliveryType');
const orderDeliveryDeliveryType = document.getElementById('orderDeliveryDeliveryType');
const orderSubtotal = document.getElementById('orderSubtotal');
const orderTotal = document.getElementById('orderTotal');
const orderDeliveryDate = document.getElementById('orderDeliveryDate');
/**
 * This makes it so we can't pick a date that is earlier than tomorrow
 */
const minDate = new Date();
minDate.setDate(minDate.getDate() + 1);
minDate.setHours(0, 0, 0, 0);
minDate.setMinutes(minDate.getMinutes() - minDate.getTimezoneOffset());
orderDeliveryDate.min = minDate.toISOString().slice(0, 16);
/**
 * And this makes it so we can't pick a date that is later than 5 days ahead
 */
const maxDate = new Date();
maxDate.setDate(maxDate.getDate() + 5);
maxDate.setHours(0, 0, 0, 0);
maxDate.setMinutes(maxDate.getMinutes() - maxDate.getTimezoneOffset());
orderDeliveryDate.max = maxDate.toISOString().slice(0, 16);

const orderDiscountId = document.getElementById('orderDiscountId');
const orderDiscountAmount = document.getElementById('orderDiscountAmount');
/**
 * Filter variables
 */
const orderFilter = document.getElementById('orderFilter');
const filterInputs = document.getElementsByClassName('filterInput');
const filters = Array.from(filterInputs)
const orderSort = document.getElementById('orderSort');
const sortingOrder = document.getElementById('sortingOrder');
const filterButton = document.getElementById('filterButton');

const savedFiltersKey = "eeats_order_filters";

/**
 * Order lines window
 */
const closeBtn = document.getElementById('closeOrderLinesBtn');
const modal = document.getElementById('modal');
const overlay = document.getElementById('overlay');

orderFilter.addEventListener("change", (filter) => {
    filters.forEach(input => {
        input.classList.remove('currentFilter')
    });
    if (filter.target.value == "date") {
        filterInputs[1].classList.add('currentFilter');
    } else if (filter.target.value == "user" || filter.target.value == "price") {
        filterInputs[0].classList.add('currentFilter');
    }
})

filterButton.addEventListener('click', () => {
    const filter = orderFilter.value;

    const storedData = {
        filter,
        filterValue:
            filter === "date"
                ? filterInputs[1].value
                : filter
                    ? filterInputs[0].value
                    : null,
        sort: orderSort.value,
        sortingOrder: sortingOrder.value
    };

    localStorage.setItem(
        savedFiltersKey,
        JSON.stringify(storedData)
    );

    showOrders(filter, orderSort.value, sortingOrder.value);
})

function normalizeDate(dateString) { //this function converts a mysql datetime string into a js date object and can handle invalid dates
    if (!dateString) return null; // handles null, undefined, ""
    const d = new Date(dateString.replace(' ', 'T'));
    return isNaN(d) ? null : d;
}



restoreOrderFilters();

//MAIN FUNCTION TO FETCH AND SHOW ORDERS
async function showOrders(filter = null, sort = null, sortingOrder = null) {
    orderForm.reset();
    fetch(currentApiURL + "?controller=Order&action=getOrders", {
        method: 'GET'
    })
        .then(r => r.json())
        .then(r => {
            const tbody = document.getElementById('orderTableBody');
            tbody.innerHTML = "";

            if (filter) {
                r = r.filter((order) => {
                    // order.delivery_date = order.delivery_date ?? "0000-00-00 00:00";
                    if (filter == "user") {
                        return order.user_id == filterInputs[0].value;
                    } else if (filter == "price") {
                        return order.total > filterInputs[0].value
                    } else if (filter === "date") {
                        const orderDate = normalizeDate(order.delivery_date);
                        const filterDate = normalizeDate(filterInputs[1].value);

                        // If user picked a date but order has none we exclude it
                        if (!orderDate || !filterDate) return false;

                        return (
                            orderDate.getFullYear() === filterDate.getFullYear() &&
                            orderDate.getMonth() === filterDate.getMonth() &&
                            orderDate.getDate() === filterDate.getDate()
                        );
                    } else if (filter === "no_date") {
                        return !order.delivery_date;
                    }
                })

            }
            if (sort) {
                r = r.sort((a, b) => {
                    let dataA;
                    let dataB;
                    console.log(a.delivery_date);
                    // a.delivery_date = a.delivery_date ?? "0000-00-00 00:00:00";
                    // b.delivery_date = b.delivery_date ?? "0000-00-00 00:00:00";
                    if (sort === "date") {
                        dataA = normalizeDate(a.delivery_date);
                        dataB = normalizeDate(b.delivery_date);

                        // Handle nulls FIRST
                        if (!dataA && !dataB) return 0;
                        if (!dataA) return sortingOrder === "asc" ? -1 : 1;
                        if (!dataB) return sortingOrder === "asc" ? 1 : -1;

                        // Both valid dates
                        return sortingOrder === "asc"
                            ? dataA - dataB
                            : dataB - dataA;
                    } else if (sort == "user") {
                        dataA = a.user_id
                        dataB = b.user_id
                    } else {
                        dataA = a.total
                        dataB = b.total
                    }
                    if (sortingOrder == "asc") {
                        return dataA - dataB
                    } else {
                        return dataB - dataA
                    }
                })
            }
            r.forEach(order => {
                const newOrder = new Order(
                    order.id,
                    order.user_id,
                    order.created_at,
                    order.address,
                    order.delivery_type,
                    order.subtotal,
                    order.total,
                    order.delivery_date,
                    order.discount_id,
                    order.discount_applied
                );
                const orderRow = document.createElement('tr');

                Object.entries(newOrder).forEach(([key, orderData]) => {
                    const block = document.createElement('td');
                    if (key === "price" || key === "subtotal" || key === "total") { //if key is price, we prepare the price cell for currency conversion
                        block.classList.add("price-cell");
                        block.dataset.eur = orderData; //this applies a data attribute on the cell, which will store the origina euro value         
                        block.textContent = convertPrice(orderData);
                    } else {
                        block.innerHTML = orderData;
                    }
                    orderRow.append(block);
                });

                for (let i = 0; i < 3; i++) {
                    const buttonBlock = document.createElement('td');
                    const button = document.createElement('button');

                    if (i === 0) {
                        //HERE IS THE BUTTON TO SHOW ORDER LINES OF THAT ORDER
                        button.classList.add('btn', 'btn-primary');
                        button.id = 'orderLinesButton';
                        button.innerHTML = 'Show Order Lines';
                        button.addEventListener('click', () => {
                            modal.style.display = 'flex';
                            overlay.style.display = 'flex';
                            showOrderLines(newOrder.getId());
                        });

                        closeBtn.addEventListener('click', () => {
                            modal.style.display = 'none';
                            overlay.style.display = 'none';
                        });

                        overlay.addEventListener('click', () => {
                            modal.style.display = 'none';
                            overlay.style.display = 'none';
                        });

                    } else if (i === 1) {
                        button.classList.add('orderEditButton', 'btn', 'btn-secondary');
                        button.innerHTML = 'Edit';
                        button.addEventListener('click', () => {
                            orderId.value = newOrder.getId();
                            orderIdDisplay.innerHTML = newOrder.getId();
                            orderUserId.value = newOrder.getUserId();
                            orderCreatedAt.value = newOrder.getCreatedAt();
                            orderAddress.value = newOrder.getAddress();
                            if (newOrder.getDeliveryType() == 'pickup') orderPickupDeliveryType.selected = true;
                            if (newOrder.getDeliveryType() == 'delivery') orderDeliveryDeliveryType.selected = true;
                            orderSubtotal.value = newOrder.getSubtotal();
                            orderTotal.value = newOrder.getTotal();
                            orderDeliveryDate.value = newOrder.getDeliveryDate().replace(' ', 'T').slice(0, 16); //turn mysql datetime date into a datetime-local date
                            orderDiscountId.value = newOrder.getDiscountId();
                            orderDiscountAmount.value = newOrder.getDiscountApplied();
                        });
                    } else {
                        button.classList.add('orderRemoveButton', 'btn', 'btn-danger');
                        button.innerHTML = 'Delete';
                        button.addEventListener('click', () => {
                            let idRemoved = newOrder.getId();
                            fetch(currentApiURL + "?controller=Order&action=deleteOrder", {
                                method: DELETE,
                                body: JSON.stringify({ id: idRemoved })
                            }).then(setTimeout(showOrders, 50));
                        });
                    }

                    buttonBlock.append(button);
                    orderRow.append(buttonBlock);
                }

                tbody.append(orderRow);
            });
        });
}


orderForm.addEventListener('submit', async f => {
    console.log(f);
    f.preventDefault();

    const button = f.submitter;
    button.disabled = true;

    let userIdValue = f.target[1].value;
    let createdAtValue = f.target[2].value;
    let addressValue = f.target[3].value;
    let deliveryTypeValue = f.target[4].value;
    let subtotalValue = f.target[5].value;
    let totalValue = f.target[6].value;
    let deliveryDateValue = f.target[7].value.replace('T', ' ') + ':00';
    let discountIdValue = f.target[8].value;
    let discountAmountValue = f.target[9].value;

    if (f.target[0].value.length !== 0) {
        let idValue = f.target[0].value;
        await fetch(currentApiURL + "?controller=Order&action=editOrder", {
            method: PUT,
            body: JSON.stringify({
                id: idValue,
                user_id: userIdValue,
                created_at: createdAtValue,
                address: addressValue,
                delivery_type: deliveryTypeValue,
                subtotal: subtotalValue,
                total: totalValue,
                delivery_date: deliveryDateValue,
                discount_id: discountIdValue != "" ? discountIdValue : null,
                discount_applied: discountAmountValue != "" ? discountAmountValue : null,
                deleted: 0
            })
        });
    } else {
        await fetch(currentApiURL + "?controller=Order&action=saveOrder", {
            method: 'POST',
            body: JSON.stringify({
                user_id: userIdValue,
                created_at: createdAtValue,
                address: addressValue,
                delivery_type: deliveryTypeValue,
                subtotal: subtotalValue,
                total: totalValue,
                delivery_date: deliveryDateValue,
                discount_id: discountIdValue != "" ? discountIdValue : null,
                discount_applied: discountAmountValue != "" ? discountAmountValue : null,
                deleted: 0
            })
        });
    }

    await restoreOrderFilters();
    button.disabled = false;
});

orderForm.addEventListener('reset', () => {
    orderIdDisplay.innerHTML = 'No Id Selected';
    orderId.value = "";
});

function restoreOrderFilters() {
    const stored = localStorage.getItem(savedFiltersKey);
    if (!stored) {
        showOrders();
    } else {
        const { filter, filterValue, sort, sortingOrder: orderDirection } = //object destructuring is amazing
            JSON.parse(stored);

        // Restore select values
        orderFilter.value = filter || "";
        orderSort.value = sort || "";
        sortingOrder.value = orderDirection || "asc";

        // Restore input visibility + value
        filters.forEach(input => input.classList.remove('currentFilter'));

        if (filter === "date") {
            filterInputs[1].classList.add('currentFilter');
            filterInputs[1].value = filterValue || "";
        } else if (filter === "user" || filter === "price") {
            filterInputs[0].classList.add('currentFilter');
            filterInputs[0].value = filterValue || "";
        }

        showOrders(filter, sort, orderDirection);
    }
}

class Order {
    constructor(id, user_id, created_at, address, delivery_type, subtotal, total, delivery_date, discount_id, discount_applied) {
        this.id = id;
        this.user_id = user_id;
        this.created_at = created_at;
        this.address = address;
        this.delivery_type = delivery_type;
        this.subtotal = subtotal;
        this.total = total;
        this.delivery_date = delivery_date;
        this.discount_id = discount_id;
        this.discount_applied = discount_applied;
    }

    getId() {
        return this.id;
    }
    getUserId() {
        return this.user_id;
    }
    getCreatedAt() {
        return this.created_at;
    }
    getAddress() {
        return this.address;
    }
    getDeliveryType() {
        return this.delivery_type;
    }
    getSubtotal() {
        return this.subtotal;
    }
    getTotal() {
        return this.total;
    }
    getDeliveryDate() {
        return this.delivery_date;
    }
    getDiscountId() {
        return this.discount_id;
    }
    getDiscountApplied() {
        return this.discount_applied;
    }
}

//ORDER LINES

const orderLinesForm = document.getElementById('orderLinesForm');

const orderLineId = document.getElementById('orderLineId');
const orderLineIdDisplay = document.getElementById('orderLineIdDisplay');
const orderLineNumber = document.getElementById('orderLineNumber');
const orderLineOrderId = document.getElementById('orderLineOrderId');
const orderLineOrderIdDisplay = document.getElementById('orderLineOrderIdDisplay');
const orderLineProductId = document.getElementById('orderLineProductId');
const orderLinePrice = document.getElementById('orderLinePrice');
const orderLineQuantity = document.getElementById('orderLineQuantity');
const orderLineDiscountId = document.getElementById('orderLineDiscountId');
const orderLineIsEditing = document.getElementById('orderLineIsEditing');

let orderIdForLines = null;
/* FETCH & SHOW ORDER LINES */
async function showOrderLines(orderId) {

    fetch(currentApiURL + "?controller=OrderLines&action=getOrderLinesByOrderId&order_id=" + orderId, {
        method: 'GET'
    })
        .then(r => r.json())
        .then(r => {
            const tbody = document.getElementById('orderLinesTableBody');
            tbody.innerHTML = "";
            orderLineOrderId.value = orderId; //set the order id in the hidden input of the form
            orderLineOrderIdDisplay.innerHTML = orderId; //and show it on the display
            if (r.length == 0) {
                orderLineId.value = null; //if there is no lines, the id is set to null
                orderLineIdDisplay.innerHTML = "No id available"; //set the order id in the input of the form
            }
            r.forEach(line => {
                const newLine = new OrderLine(
                    line.id,
                    line.line_num,
                    line.order_id,
                    line.product_id,
                    line.price,
                    line.quantity,
                    line.discount_id
                );
                orderLineId.value = newLine.getId(); //set the order id in the input of the form
                orderLineIdDisplay.innerHTML = newLine.getId(); //set the order id in the input of the form
                orderIdForLines = orderId; //store the order id for when resetting
                const row = document.createElement('tr');

                Object.entries(newLine).forEach(([key, orderLineData]) => {
                    const block = document.createElement('td');
                    if (key === "price") { //if key is price, we prepare the price cell for currency conversion
                        block.classList.add("price-cell");
                        block.dataset.eur = orderLineData; //this applies a data attribute on the cell, which will store the origina euro value         
                        block.textContent = convertPrice(orderLineData);
                    } else {
                        block.innerHTML = orderLineData;
                    }
                    row.append(block);
                });

                // EDIT BUTTON
                const editTd = document.createElement('td');
                const editBtn = document.createElement('button');
                editBtn.classList.add('btn', 'btn-secondary');
                editBtn.innerHTML = 'Edit';

                editBtn.addEventListener('click', () => {
                    orderLineId.value = newLine.getId();
                    orderLineIdDisplay.innerHTML = newLine.getId();
                    orderLineNumber.value = newLine.getLineNum();
                    orderLineOrderId.value = newLine.getOrderId();
                    orderLineOrderIdDisplay.innerHTML = newLine.getOrderId();
                    orderLineProductId.value = newLine.getProductId();
                    orderLinePrice.value = newLine.getPrice();
                    orderLineQuantity.value = newLine.getQuantity();
                    orderLineDiscountId.value = newLine.getDiscountId();
                });

                editTd.append(editBtn);
                row.append(editTd);

                tbody.append(row);
            });
        });
}

orderLinesForm.addEventListener('submit', async e => {
    e.preventDefault();

    const submitBtn = e.submitter;
    submitBtn.disabled = true;

    const idValue = orderLineId.value;
    const lineNumValue = orderLineNumber.value;
    const orderIdValue = orderLineOrderId.value;
    const productIdValue = orderLineProductId.value;
    const priceValue = orderLinePrice.value;
    const quantityValue = orderLineQuantity.value;
    const discountIdValue = orderLineDiscountId.value;

    if (orderLineIsEditing.checked) {
        await fetch(currentApiURL + "?controller=OrderLines&action=editOrderLine", {
            method: PUT,
            body: JSON.stringify({
                id: idValue,
                line_num: lineNumValue,
                order_id: orderIdValue,
                product_id: productIdValue,
                price: priceValue,
                quantity: quantityValue,
                discount_id: discountIdValue
            })
        });
    } else {
        await fetch(currentApiURL + "?controller=OrderLines&action=saveOrderLine", {
            method: 'POST',
            body: JSON.stringify({
                id: idValue,
                line_num: lineNumValue,
                order_id: orderIdValue,
                product_id: productIdValue,
                price: priceValue,
                quantity: quantityValue,
                discount_id: discountIdValue
            })
        });
    }

    await showOrderLines(orderIdValue);
    submitBtn.disabled = false;
});

/* RESET FORM */
orderLinesForm.addEventListener('reset', (e) => {
    orderLineOrderId.value = orderIdForLines;
    orderLineOrderIdDisplay.innerHTML = orderIdForLines;
});

/* ORDER LINE CLASS */
class OrderLine {
    constructor(id, line_num, order_id, product_id, price, quantity, discount_id) {
        this.id = id;
        this.line_num = line_num;
        this.order_id = order_id;
        this.product_id = product_id;
        this.price = price;
        this.quantity = quantity;
        this.discount_id = discount_id;
    }

    getId() { return this.id; }
    getLineNum() { return this.line_num; }
    getOrderId() { return this.order_id; }
    getProductId() { return this.product_id; }
    getPrice() { return this.price; }
    getQuantity() { return this.quantity; }
    getDiscountId() { return this.discount_id; }
}

