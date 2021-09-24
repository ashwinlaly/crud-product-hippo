<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="crudProduct" id="crudProduct">
          <div class="alert alert-danger" id="error-box-product" style="display: none">
              <ul id="error-list-product"></ul>
          </div>
          <div class="mb-3 row">
              <label for="productName" class="col-sm-2 col-form-label">Product Name</label>
              <div class="col-sm-10">
              <input type="text" class="form-control" id="productName" name="name"/>
              </div>
          </div>
          <div class="mb-3 row">
              <label for="productSKU" class="col-sm-2 col-form-label">Product SKU</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="productSKU" name="stock_keeping_unit">
              </div>
          </div>
          <div class="mb-3 row">
              <label for="productPrice" class="col-sm-2 col-form-label">Product Price</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="productPrice" name="price">
              </div>
          </div>
          <div class="mb-3 row">
              <label for="productShortDescription" class="col-sm-2  form-label">Short Description</label>
              <div class="col-sm-10">
                  <textarea class="form-control" id="productShortDescription" name="short_description" rows="3"></textarea>
              </div>
          </div>
          <div class="mb-3 row">
              <label for="productDescription" class="col-sm-2  form-label">Description</label>
              <div class="col-sm-10">
                  <textarea class="form-control" id="productDescription" name="description" rows="3"></textarea>
              </div>
          </div>
          <div class="mb-3 row">
              <label for="productStatus" class="col-sm-2  form-label">Status</label>
              <div class="col-sm-10">
              <select class="form-select" id="productStatus" name="status">
                  <option value="1">Active</option>
                  <option value="0">In Active</option>
              </select>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="product_submit" onClick="submitProduct()">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>