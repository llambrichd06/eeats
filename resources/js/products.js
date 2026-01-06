const productForm = document.getElementById('prodForm');

const productId = document.getElementById('prodId');
const productIdDisplay = document.getElementById('prodIdDisplay');
const productName = document.getElementById('prodName');
const productDescription = document.getElementById('prodDesc');
const productPrice = document.getElementById('prodPrice');
const productCreatedAt = document.getElementById('prodCreatedAt');
const productStock = document.getElementById('prodStock');
const productImg = document.getElementById('prodImg');
const productPremium = document.getElementById('prodIsPremium');
const productDiscountId = document.getElementById('prodDiscountId');

showProducts();

//MAIN FUNCTION TO FETCH AND SHOW PRODUCTS
async function showProducts() {
    fetch(currentApiURL + "?controller=Product&action=getProducts", {
        method: 'GET'
    }).then(r => r.json())
        .then(r => {
            const tbody = document.getElementById('prodTableBody');
            tbody.innerHTML = "";
            r.forEach(prod => {
                const newProduct = new Product(prod.id, prod.name, prod.description, prod.price, prod.created_at, prod.stock, prod.img, prod.premium, prod.discount_id)
                const prodRow = document.createElement('tr');

                Object.entries(newProduct).forEach(([key, prodData]) => {
                    const block = document.createElement('td');
                    if (key === "price") { //if key is price, we prepare the price cell for currency conversion
                        block.classList.add("price-cell");
                        block.dataset.eur = prodData; //this applies a data attribute on the cell, which will store the origina euro value         
                        block.textContent = convertPrice(prodData);
                    } else {
                        block.innerHTML = prodData;
                    }
                    prodRow.append(block);
                });

                for (let i = 0; i < 2; i++) {
                    const buttonBlock = document.createElement('td');
                    const button = document.createElement('button');
                    if (i == 0) {
                        button.classList.add('prodEditButton', 'btn', 'btn-secondary');
                        button.innerHTML = 'Edit';
                        button.addEventListener('click', () => {
                            productId.value = newProduct.getId();
                            productIdDisplay.innerHTML = newProduct.getId();
                            productName.value = newProduct.getName();
                            productDescription.value = newProduct.getDescription();
                            productPrice.value = newProduct.getPrice();
                            productCreatedAt.value = newProduct.getCreated_at();
                            productStock.value = newProduct.getStock();
                            productImg.value = newProduct.getImg();
                            productPremium.checked = newProduct.getPremium() == 1 ? true : false;
                            productDiscountId.value = newProduct.getDiscount_id();
                        })
                    } else {
                        button.classList.add('prodRemoveButton', 'btn', 'btn-danger');
                        button.innerHTML = 'Delete';
                        button.addEventListener('click', () => {
                            let idRemoved = newProduct.getId();
                            fetch(currentApiURL + "?controller=Product&action=deleteProduct", {
                                method: DELETE,
                                body: JSON.stringify({
                                    id: idRemoved
                                })
                            }).then(setTimeout(showProducts(), 50));
                        })
                    }
                    buttonBlock.append(button);
                    prodRow.append(buttonBlock);
                }
                tbody.append(prodRow);
            })
        })
}


productForm.addEventListener('submit', async f => {
    f.preventDefault();

    const button = f.submitter;
    button.disabled = true;

    let nameValue = f.target[1].value;
    let descriptionValue = f.target[2].value;
    let priceValue = f.target[3].value;
    let createdAtValue = f.target[4].value;
    let stockValue = f.target[5].value;
    let imgValue = f.target[6].value;
    let premiumValue = f.target[7].checked ? 1 : 0;
    let discountIdValue = f.target[8].value;

    if (f.target[0].value.length != 0) {
        let idValue = f.target[0].value;
        await fetch(currentApiURL + "?controller=Product&action=editProduct", {
            method: PUT,
            body: JSON.stringify({
                id: idValue,
                name: nameValue,
                description: descriptionValue,
                price: priceValue,
                created_at: createdAtValue,
                stock: stockValue,
                img: imgValue,
                premium: premiumValue,
                discount_id: discountIdValue != "" ? discountIdValue : null,
                deleted: 0
            })
        })
    } else {
        await fetch(currentApiURL + "?controller=Product&action=saveProduct", {
            method: 'POST',
            body: JSON.stringify({
                name: nameValue,
                description: descriptionValue,
                price: priceValue,
                created_at: createdAtValue,
                stock: stockValue,
                img: imgValue,
                premium: premiumValue,
                discount_id: discountIdValue != "" ? discountIdValue : null,
                deleted: 0
            })
        })
    }

    await showProducts();
    button.disabled = false;
})

productForm.addEventListener('reset', f => {
    productIdDisplay.innerHTML = 'No Id Selected';
    productId.value = "";
})

class Product {
    constructor(id, name, description, price, created_at, stock, img, premium, discount_id) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.price = price;
        this.created_at = created_at;
        this.stock = stock;
        this.img = img;
        this.premium = premium;
        this.discount_id = discount_id;
    }

    getId() {
        return this.id;
    }
    getName() {
        return this.name;
    }
    getDescription() {
        return this.description;
    }
    getPrice() {
        return this.price;
    }
    getCreated_at() {
        return this.created_at;
    }
    getStock() {
        return this.stock;
    }
    getImg() {
        return this.img;
    }
    getPremium() {
        return this.premium;
    }
    getDiscount_id() {
        return this.discount_id;
    }
}
