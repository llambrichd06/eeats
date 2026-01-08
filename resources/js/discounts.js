const discountForm = document.getElementById('discountForm');

const discountId = document.getElementById('discountId');
const discountIdDisplay = document.getElementById('discountIdDisplay');
const discountCode = document.getElementById('discountCode');
const discountType = document.getElementById('discountType');
const discountCodeType = document.getElementById('discountCodeType');
const discountProductType = document.getElementById('discountProductType');
const discountPercent = document.getElementById('discountPercent');
const discountUses = document.getElementById('discountUses');
const discountBeginsAt = document.getElementById('discountBeginsAt');
const discountEndsAt = document.getElementById('discountEndsAt');

showDiscounts();

// MAIN FUNCTION TO FETCH AND SHOW DISCOUNTS
async function showDiscounts() {
    discountForm.reset();
    fetch(currentApiURL + "?controller=Discount&action=getDiscounts", { method: 'GET' })
        .then(r => r.json())
        .then(r => {
            const tbody = document.getElementById('discountTableBody');
            tbody.innerHTML = "";
            r.forEach(discount => {
                const newDiscount = new Discount(
                    discount.id,
                    discount.code,
                    discount.type,
                    discount.percent,
                    discount.uses,
                    discount.begins_at,
                    discount.ends_at,
                );

                const discountRow = document.createElement('tr');

                Object.entries(newDiscount).forEach(([key, data]) => {
                    const td = document.createElement('td');
                    td.innerHTML = data;
                    discountRow.append(td);
                });

                // Edit and Delete buttons
                for (let i = 0; i < 2; i++) {
                    const td = document.createElement('td');
                    const button = document.createElement('button');

                    if (i === 0) {
                        button.classList.add('discountEditButton', 'btn', 'btn-secondary');
                        button.innerHTML = 'Edit';
                        button.addEventListener('click', () => {
                            discountId.value = newDiscount.getId();
                            discountIdDisplay.innerHTML = newDiscount.getId();
                            discountCode.value = newDiscount.getCode();
                            if (newDiscount.getType() == '0') discountCodeType.selected = true;
                            if (newDiscount.getType() == '1') discountProductType.selected = true;
                            discountPercent.value = newDiscount.getPercent();
                            discountUses.value = newDiscount.getUses();
                            discountBeginsAt.value = newDiscount.getBeginsAt();
                            discountBeginsAt.value = newDiscount.getBeginsAt().replace(' ', 'T').slice(0, 16);
                            discountEndsAt.value = newDiscount.getEndsAt().replace(' ', 'T').slice(0, 16);
                        });
                    } else {
                        button.classList.add('discountRemoveButton', 'btn', 'btn-danger');
                        button.innerHTML = 'Delete';
                        button.addEventListener('click', () => {
                            let idRemoved = newDiscount.getId();
                            fetch(currentApiURL + "?controller=Discount&action=deleteDiscount", {
                                method: DELETE,
                                body: JSON.stringify({ id: idRemoved })
                            }).then(() => setTimeout(showDiscounts, 50));
                        });
                    }

                    td.append(button);
                    discountRow.append(td);
                }

                tbody.append(discountRow);
            });
        });
}

// SUBMIT FORM HANDLER
discountForm.addEventListener('submit', async f => {
    f.preventDefault();
    const button = f.submitter;
    button.disabled = true;

    let codeValue = f.target[1].value;
    let typeValue = f.target[2].value;
    let percentValue = f.target[3].value;
    let usesValue = f.target[4].value;
    let beginsAtValue = f.target[5].value.replace('T', ' ') + ':00';
    let endsAtValue = f.target[6].value.replace('T', ' ') + ':00';

    if (f.target[0].value.length != 0) {
        // Edit discount
        await fetch(currentApiURL + "?controller=Discount&action=editDiscount", {
            method: PUT,
            body: JSON.stringify({
                id: f.target[0].value,
                code: codeValue != "" ? codeValue : null,
                type: typeValue,
                percent: percentValue,
                uses: usesValue != "" ? usesValue : null,
                begins_at: beginsAtValue,
                ends_at: endsAtValue,
                deleted: 0
            })
        });
    } else {
        // Save new discount
        await fetch(currentApiURL + "?controller=Discount&action=saveDiscount", {
            method: 'POST',
            body: JSON.stringify({
                code: codeValue != "" ? codeValue : null,
                type: typeValue,
                percent: percentValue,
                uses: usesValue != "" ? usesValue : null,
                begins_at: beginsAtValue,
                ends_at: endsAtValue,
                deleted: 0
            })
        });
    }

    await showDiscounts();
    button.disabled = false;
});

// RESET FORM HANDLER
discountForm.addEventListener('reset', f => {
    discountIdDisplay.innerHTML = 'No Id Selected';
    discountId.value = "";
});

// DISCOUNT CLASS
class Discount {
    constructor(id, code, type, percent, uses, begins_at, ends_at, deleted) {
        this.id = id;
        this.code = code;
        this.type = type;
        this.percent = percent;
        this.uses = uses;
        this.begins_at = begins_at;
        this.ends_at = ends_at;
    }

    getId() { return this.id; }
    getCode() { return this.code; }
    getType() { return this.type; }
    getPercent() { return this.percent; }
    getUses() { return this.uses; }
    getBeginsAt() { return this.begins_at; }
    getEndsAt() { return this.ends_at; }
}
