<button type="button" onclick="createProduct()" class="btn btn-primary">Create product</button>

<div class="material-datatables">
    <table id="productTable"  class="table table-striped">
        <thead class="text-primary">
            <tr>
                <th>Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

@include("products.form")
@include("documents.upload_document")

@section('scripts')
<script>
    $(document).ready(function() {
        initDropzone("api/product/upload");
        var columns = [
            {data: "name"},
            {data: "stock_keeping_unit"},
            {data: "price"},
            {data: "description"},
            {data: "actions", class: 'right'}
        ];
        var url = "api/product";
        $("#productTable").dataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                "url": url
            },
            columns: columns
        })
    });

    function createProduct() {
        $("#error-box-product").hide();
        $("#error-list-product").html("");
        $("#product_submit").text("Create");
        $("#productModalLabel").text("Create Product");
        $("#crudProduct").attr("action", '/api/product/0');
        $("#productModal").modal("show");
    }

    function editProduct(id) {
        var url = `/api/product/${id}`;
        $.ajax({
            url: url,
            type: 'GET',
            success: function (product) {
                $("#productName").val(product.name);
                $("#productPrice").val(product.price);
                $("#productStatus").val(product.status);
                $("#productSKU").val(product.stock_keeping_unit);
                $("#productDescription").val(product.description);
                $("#productShortDescription").val(product.short_description);
            }
        });
        $("#error-box-product").hide();
        $("#error-list-product").html("");
        $("#product_submit").text("Update");
        $("#crudProduct").attr("action", url);
        $("#productModalLabel").text("Edit Product");
        $("#productModal").modal("show");
    }

    function submitProduct() {
        var data = formData($("#crudProduct"));
        
        $.ajax({
            url: $("#crudProduct").attr("action"),
            data: data,
            type: "PUT",
            dataType: 'json',
            success: function () {
                $('#productTable').DataTable().ajax.reload();
                $("#error-list-product").html("");
                $("#error-box-product").hide();
                $("#productModal").modal("hide");
            }, 
            error: function(xhr, error) {
                $("#error-list-product").html("");
                if (xhr.status == 422) {
                    var errors = xhr.responseJSON;
                    $.each(errors, function (key, val) {
                        $("#error-list-product").append('<li>' + val + '</li>');
                    });
                    $("#error-box-product").show();
                }
            }
        });
    }

    function updateImage(id) {
        var dropzone = Dropzone.forElement("#dropzone");
            dropzone.removeAllFiles();
            dropzone.on("sending", function (file, xhr, formData) {
                formData.append("id", id);
                formData.append("_token", "{{csrf_token()}}");
        });
        $("#documentModalLabel").text("Upload Image");
        $("#documentModal").modal("show");
    }
</script>
@endsection