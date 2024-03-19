@extends('shared/_layout')

@section('list_product')
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head> -->

<body>
    <select class="form-select" aria-label="Default select example">
    </select>
    <div class="container mt-3" >
        <div class="row" style="display: grid; grid-template-columns: repeat(5, 1fr);">
        </div>  
    </div>
</body>
<script>
    // List-product
    function get_product(id = null) {
        const productContainer = document.querySelector('.row');
        fetch(`http://127.0.0.1:8000/api/customer/product/getByCategory/${id}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const products = data.data;
                let html = '<div class="row" style="display: grid; grid-template-columns: repeat(4, 1fr);">'; // Sử dụng CSS Grid để hiển thị 5 sản phẩm trên một hàng
                products.forEach(product => {
                    html += `
                <div class="card" style="width: 18rem; margin: 12px">
                        <img class="card-img-top" src="${product.image_url}"  alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description}</p>
                            <a href="/products/${product.id}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
            `;
                });
                html += '</div>'; // Kết thúc hàng
                productContainer.innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching data Product: ', error)
            });
    }

    //List-category
    let categoryId;
    const categoryContainer = document.querySelector('.form-select');
    categoryContainer.addEventListener('change', function() {
        categoryId = this.value;
        get_product(categoryId)
    })
    fetch('/api/customer/listCategory')
        .then(response => response.json())
        .then(data => {
            const category = data.data;
            let html = '<option selected>Select Category: </option>';
            let i = 1;
            category.forEach(category => {
                if (i === 1) {
                    i++;
                    html += `<option selected value=${category.id}  
                     >${category.name}</option>`;
                    const categoryId = category.id;
                    get_product(categoryId);
                } else {
                    html += `<option value=${category.id} >${category.name}</option>`;
                }
            });
            categoryContainer.innerHTML = html;
        })
        .catch(error => {
            console.error('Error fetching data: ', error)
        });
    // get_product(id);
</script>



</html>
@endsection

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <select class="list-category" class="form-select form-select-sm" aria-label=".form-select-sm example">

    </select>
    <div class="container">
        <div class="row" style="display: grid; grid-template-columns: repeat(5, 1fr);">
        </div>
    </div>
</body>
<script>
    // List-product
    function get_product(id = null) {
        const productContainer = document.querySelector('.row');
        fetch(`http://127.0.0.1:8000/api/customer/product/getByCategory/${id}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const products = data.data;
                let html = '<div class="row" style="display: grid; grid-template-columns: repeat(4, 1fr);">'; // Sử dụng CSS Grid để hiển thị 5 sản phẩm trên một hàng
                products.forEach(product => {
                    html += `
                <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="${product.image_url}"  alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description}</p>
                            <a href="/products/${product.id}" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
            `;
                });
                html += '</div>'; // Kết thúc hàng
                productContainer.innerHTML = html;
            })
            .catch(error => {
                console.error('Error fetching data Product: ', error)
            });
    }

    //List-category
    let categoryId;
    const categoryContainer = document.querySelector('.list-category');
    categoryContainer.addEventListener('change', function(){
        categoryId = this.value;
        get_product(categoryId)
    })
    fetch('/api/customer/listCategory')
        .then(response => response.json())
        .then(data => {
            const category = data.data;
            let html = '<option selected>Select Category: </option>';
            let i = 1;
            category.forEach(category => {
                if (i === 1) {
                    i++;
                    html += `<option selected value=${category.id}  
                     >${category.name}</option>`;
                    const categoryId = category.id;
                    get_product(categoryId);
                } else {
                    html += `<option value=${category.id} >${category.name}</option>`;
                }
            });
            categoryContainer.innerHTML = html;
        })
        .catch(error => {
            console.error('Error fetching data: ', error)
        });
    // get_product(id);
</script>



</html> -->