@extends('shared/_layout')
@section('content')


<h1 class="text-center mb-10">Cart</h1>
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
    </div>
</div>



@endsection

@section('content-scripts')
<script>
    const tableBody = document.querySelector('tbody');
    fetch(`http://127.0.0.1:8000/customer/show-item-into-cart`)
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
                                        <div class="col-md-5 col-lg-5 col-xl-5">
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
    <button class="btn btn-success px-2 m-lg-2" onclick="minusQuantity(${product.product_id})">
        -
    </button>
    <input id="form${product.product_id}" min="0" name="quantity" value="${product.count}" type="number" class="form-control" style ="width: 80px; height: 45px" placeholder="${product.count}" />
    <button class="btn btn-warning px-2 m-lg-2" onclick="plusQuantity(${product.product_id})">
        +
    </button>
    <button class="btn btn-warning px-2 m-lg-2" onclick="deleteCart(${product.product_id})">
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


    function deleteCart(product_id) {
        fetch(`http://127.0.0.1:8000/api/customer/delete-from-cart/${product_id}`, {
                method: "GET",
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                    console.log("Delete OK ")
                } else {
                    console.log(product_id)
                    console.log('Delete Failed')
                }
            })
            .catch(error => {
                console.log('Error deleting item: ', error)
            })
    }

    function minusQuantity(product_id) {
        fetch(`http://127.0.0.1:8000/api/customer/minus-cart-count/${product_id}`, {
                method: "GET"
            })
            .then(response => {
                if (response.ok) {
                    // Yêu cầu thành công, cập nhật giá trị số lượng trên giao diện người dùng
                    const quantityInput = document.getElementById(`form${product_id}`);
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                    console.log(product_id);
                    console.log("Minus Ok");
                } else {
                    console.log(product_id);
                    console.log("Minus Failed");
                }
            })
            .catch(error => {
                console.log("Error Minusting: ", error);
            });
    }

    function plusQuantity(product_id) {
        fetch(`http://127.0.0.1:8000/api/customer/plus-cart-count/${product_id}`, {
                method: "GET"
            })
            .then(response => {
                if (response.ok) {
                    // Yêu cầu thành công, cập nhật giá trị số lượng trên giao diện người dùng
                    const quantityInput = document.getElementById(`form${product_id}`);
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                    console.log(product_id);
                    console.log("Minus Ok");
                } else {
                    console.log(product_id);
                    console.log("Minus Failed");
                }
            })
            .catch(error => {
                console.log("Error plusting: ", error)
            })
    }
</script>
@endsection

</html>