<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <section class="h-100 h-custom">
        <div class="container h-100 py-5">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                </tr>
                            </thead>
                            <form action="" method="POST">
                                <tbody>

                                </tbody>
                            </form>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    const tableBody = document.querySelector('tbody');
    fetch(`http://127.0.0.1:8000/api/customer/show-item-into-cart`)
        .then(response => response.json())
        .then(data => {
            console.log(data)
            const products = data.data
            console.log(products);

            // Tạo các phần tử <th>
            const thShoppingBag = document.createElement('th');
            thShoppingBag.setAttribute('scope', 'col');
            thShoppingBag.textContent = 'Shopping Bag';

            const thQuantity = document.createElement('th');
            thQuantity.setAttribute('scope', 'col');
            thQuantity.textContent = 'Quantity';

            const thPrice = document.createElement('th');
            thPrice.setAttribute('scope', 'col');
            thPrice.textContent = 'Price';

            // Tạo phần tử <tr>
            const tr = document.createElement('tr');
            tr.appendChild(thShoppingBag);
            tr.appendChild(thQuantity);
            tr.appendChild(thPrice);



            // Thêm phần tử <tr> vào <thead>
            const thead = document.querySelector('thead');
            thead.appendChild(tr);

            products.forEach(product => {
                fetch(`http://127.0.0.1:8000/api/customer/get-product-by-id/${product.product_id}`)
                    .then(response => response.json())
                    .then(productData => {
                        const {
                            name
                        } = productData.data
                        const {
                            author
                        } = productData.data
                        const {
                            image_url
                        } = productData.data
                        const {
                            description
                        } = productData.data
                        const {
                            price
                        } = productData.data

                        // Tạo các phần tử DOM
                        const tr = document.createElement('tr');
                        const tdName = document.createElement('td');
                        const tdQuantity = document.createElement('td');
                        const tdPrice = document.createElement('td');


                        // Thiết lập nội dung cho các phần tử
                        tdName.innerHTML = `
                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-7 col-lg-7 col-xl-7">
                                            <img src="${image_url}" class="img-fluid rounded-3" style="width: 200px; heigh: 200px" alt="Book">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2">${name}</p>
                                            <p><span class="text-muted">Author: </span>${author}</p>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        tdQuantity.innerHTML = `<div class="col-md-5 col-lg-5 col-xl-2 d-flex">
    <button class="btn btn-success px-2" onclick="minusQuantity(${product.product_id})">
        -
    </button>
    <input id="form${product.product_id}" min="0" name="quantity" value="${product.count}" type="number" class="form-control form-control-sm" />
    <button class="btn btn-warning px-2" onclick="plusQuantity(${product.product_id})">
        +
    </button>
    <button class="btn btn-warning px-2" onclick="deleteCart(${product.product_id})">
        Delete
    </button>

    
</div>`
                        tdPrice.textContent = price;
                     

                        // Gắn các phần tử con vào phần tử cha
                        tr.appendChild(tdName);
                        tr.appendChild(tdQuantity);
                        tr.appendChild(tdPrice);

                        // Gắn phần tử cha vào tbody
                        tableBody.appendChild(tr);
                    });
            });
        })
        .catch(error => {
            console.log('Error fetching data Product: ', error);
        });


    async function minusQuantity() {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/customer/show-item-into-cart`);
            const data = await response.json();
            const products = data.data;

            for (const product of products) {
                try {
                    const productResponse = await fetch(`http://127.0.0.1:8000/api/customer/get-product-by-id/${product.product_id}`);
                    const productData = await productResponse.json();
                    const {
                        name,
                        author,
                        image_url,
                        description,
                        price
                    } = productData.data;

                    const quantityInput = document.getElementById(`form${product.product_id}`);
                    quantityInput.stepDown();

                    const minusCountResponse = await fetch(`http://127.0.0.1:8000/api/customer/minus-cart-count/${product.product_id}`);
                    const minusCountData = await minusCountResponse.json();
                    const updateCount = minusCountData.count;

                    quantityInput.value = updateCount;
                } catch (error) {
                    console.log('Error fetching product details: ', error);
                }
            }
        } catch (error) {
            console.log('Error fetching cart items: ', error);
        }
    }

    async function plusQuantity() {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/customer/show-item-into-cart`);
            const data = await response.json();
            const products = data.data;

            for (const product of products) {
                try {
                    const productResponse = await fetch(`http://127.0.0.1:8000/api/customer/get-product-by-id/${product.product_id}`);
                    const productData = await productResponse.json();
                    const {
                        name,
                        author,
                        image_url,
                        description,
                        price
                    } = productData.data;

                    const quantityInput = document.getElementById(`form${product.product_id}`);
                    quantityInput.stepDown();

                    const plusCountResponse = await fetch(`http://127.0.0.1:8000/api/customer/plus-cart-count/${product.product_id}`);
                    const plusCountData = await plusCountResponse.json();
                    const updateCount = plusCountData.count;
                    quantityInput.value = updateCount;
                } catch (error) {
                    console.log('Error fetching product details: ', error);
                }
            }
        } catch (error) {
            console.log('Error fetching cart items: ', error);
        }
    }

    function deleteCart(product_id) {
        fetch(`http://127.0.0.1:8000/api/customer/delete-from-cart/${product_id}}`,{
            method: "DELETE",
        })   
    .then(response => {
        if (response.ok){
            console.log("OK ")
        }
        else{
            console.log('Failed')
        }
    }) 
    .catch(error => {
        console.log('Error deleting item: ', error);
    })
}

</script>

</html>