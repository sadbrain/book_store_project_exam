@extends("shared/_layout")
@section('content')
<div class="container">
    <select class="form-select col-md-2 mr-10" aria-label="Default select example">
    </select>
    <div class="container-product mt-3 col-md-10">
    </div>
</div>
<script>
    function get_product(id = null) {
        const productContainer = document.querySelector('.container-product');
        fetch(`http://127.0.0.1:8000/api/customer/product/getByCategory/${id}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const products = data.data;
                let html = '<div class="row" style="display: grid; grid-template-columns: repeat(4, 1fr);">'; // Sử dụng CSS Grid để hiển thị 5 sản phẩm trên một hàng
                products.forEach(product => {
                    html += `
                <div class="card" style="width: 30rem; margin: 12px">
                        <img class="card-img-top" src="${product.image_url}"  alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description}</p>
                            <a href="/customer/detail/${product.id}" class="btn btn-primary">Detail</a>
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
                    html += `<option class="text-4" selected value=${category.id}  
                        >${category.name}</option>`;
                    const categoryId = category.id;
                    get_product(categoryId);
                } else {
                    html += `<option class="text-4" value=${category.id} >${category.name}</option>`;
                }
            });
            categoryContainer.innerHTML = html;
        })
        .catch(error => {
            console.error('Error fetching data: ', error)
        });
</script>
@endsection