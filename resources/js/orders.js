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

orderFilter.addEventListener("change", (filter) => {
    filters.forEach(input => {
        input.classList.remove('currentFilter')
    });
    if (filter.target.value == "date") {
        filterInputs[1].classList.add('currentFilter');
    } else if (filter.target.value) {
        filterInputs[0].classList.add('currentFilter');
    } 
})

filterButton.addEventListener('click', () => {
    showOrders(orderFilter.value, orderSort.value, sortingOrder.value);
})


//MAIN FUNCTION TO FETCH AND SHOW ORDERS
async function showOrders(filter = null, sort = null, sortingOrder = null) {
    fetch(currentApiURL + "?controller=Order&action=getOrders", {
        method: 'GET'
    })
    .then(r => r.json())
    .then(r => {
        const tbody = document.getElementById('orderTableBody');
        tbody.innerHTML = "";

        if (filter) {
            r = r.filter((order)=>{
                order.delivery_date = order.delivery_date ?? "0000-00-00 00:00";
                if (filter == "user") {
                    return order.user_id == filterInputs[0].value;
                } else if (filter == "price") {
                    return order.total > filterInputs[0].value
                } else if (filter == "date") {
                    let date1 = new Date(order.delivery_date.replace(' ', 'T').slice(0, 16)) //parse mysql datetime format into js date
                    let date2 = new Date(filterInputs[1].value)
                    console.log(date2)
                    return date1.getFullYear() === date2.getFullYear() &&
                    date1.getMonth() === date2.getMonth() &&
                    date1.getDate() === date2.getDate()
                } 
            })

        }
        if (sort) {
            r = r.sort((a, b)=>{
                let dataA;
                let dataB;
                console.log(a.delivery_date);
                a.delivery_date = a.delivery_date ?? "0000-00-00 00:00:00";
                b.delivery_date = b.delivery_date ?? "0000-00-00 00:00:00";
                if (sort == "date") {
                    dataA = new Date(a.delivery_date.replace(' ', 'T').slice(0, 16))
                    dataB = new Date(b.delivery_date.replace(' ', 'T').slice(0, 16)) //parse mysql datetime format into js date
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
                block.innerHTML = orderData;
                orderRow.append(block);
            });

            for (let i = 0; i < 3; i++) {
                const buttonBlock = document.createElement('td');
                const button = document.createElement('button');
                
                if (i === 0) {
                    //HERE IS THE BUTTON TO SHOW ORDER LINES OF THAT ORDER :P
                    button.classList.add('orderLinesButton', 'btn', 'btn-primary');
                    button.innerHTML = 'Show Order Lines';
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
                        }).then(setTimeout(showOrders(), 50));
                    });
                }

                buttonBlock.append(button);
                orderRow.append(buttonBlock);
            }

            tbody.append(orderRow);
        });
    });
}

showOrders();

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
    let deliveryDateValue = f.target[7].value.replace('T', ' ') + ':00';;
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

    await showOrders();
    button.disabled = false;
});

orderForm.addEventListener('reset', () => {
    orderIdDisplay.innerHTML = 'No Id Selected';
    orderId.value = "";
});

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
