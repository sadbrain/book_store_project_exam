@extends('shared/_layout')
@section('content')
@if(session()->has('msg'))
<div class="alert alert-success">
    {{ session('msg') }}
</div>
@endif
<div class="card-header bg-secondary bg-gradient ml-0 py-3">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="text-white py-2">Cart</h1>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center align-items-center ">
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
        <button class="btn btn-primary"><a class="text-white" href="/customer/cart/summary">sumary</a></button>
    </div>
</div>
@endsection

@section('content-scripts')
<script>
    const tableBody = document.querySelector('tbody');
    fetch(`http://127.0.0.1:8000/customer/cart/show`)
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
                fetch(`http://127.0.0.1:8000/api/customer/cart/${product.product_id}`)
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
                                        <div class="col-md-5 col-lg-5 col-xl-5">
                                            <img src="${image_url}" class="img-fluid rounded-3" style="width: 200px; heigh: 200px" alt="Book">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2">${name}</p>
                                            <p><span class="text-muted">Author: </span>${author}</p>
                                        </div>
                            
                                    </div>
                                </div>
                            </div>
                        `;
                        tdQuantity.innerHTML = `<div class="col-md-5 col-lg-5 col-xl-2 d-flex">
    <button class="btn btn-success px-2 m-lg-2" onclick="minusQuantity(${product.id})">
        -
    </button>
    <input id="form${product.id}" min="0" name="quantity" value="${product.count}" type="number" class="form-control" style ="width: 80px; height: 45px" placeholder="${product.count}" />
    <button class="btn btn-warning px-2 m-lg-2" onclick="plusQuantity(${product.id})">
        +
    </button>
    <button class="btn btn-warning px-2 m-lg-2" onclick="deleteCart(${product.id})">
        Delete
    </button>

    
</div>`
                        tdPrice.innerHTML = `<span id="price${product.id}">${product.price}</span>`;


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


    function deleteCart(cart_id) {
        fetch(`http://127.0.0.1:8000/api/customer/cart/delete/${cart_id}`, {
                method: "GET",
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                    console.log("Delete OK ")
                } else {
                    console.log(cart_id)
                    console.log('Delete Failed')
                }
            })
            .catch(error => {
                console.log('Error deleting item: ', error)
            })
    }

    function minusQuantity(cart_id) {
        fetch(`http://127.0.0.1:8000/api/customer/cart/minus/${cart_id}`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                // Cập nhật số lượng trong giao diện người dùng
                const quantityInput = document.getElementById(`form${cart_id}`);
                const priceInput = document.getElementById(`price${cart_id}`);
                if (quantityInput && priceInput) {
                    if (quantityInput && priceInput) {
                        quantityInput.value = parseInt(quantityInput.value) - 1;
                        priceInput.textContent = data.data.price;
                    }
                }
                console.log("Minus Ok");
            })
            .catch(error => {
                console.log("Error minusting: ", error)
            })
    }

    function plusQuantity(cart_id) {
        fetch(`http://127.0.0.1:8000/api/customer/cart/plus/${cart_id}`, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                // Cập nhật số lượng trong giao diện người dùng
                const quantityInput = document.getElementById(`form${cart_id}`);
                const priceInput = document.getElementById(`price${cart_id}`);
                if (quantityInput && priceInput) {
                    if (quantityInput && priceInput) {
                        quantityInput.value = parseInt(quantityInput.value) + 1;
                        priceInput.textContent = data.data.price;
                    }
                }
                console.log("Plus Ok");
            })
            .catch(error => {
                console.log("Error plusting: ", error)
            })
    }
</script>

@endsection

</html>