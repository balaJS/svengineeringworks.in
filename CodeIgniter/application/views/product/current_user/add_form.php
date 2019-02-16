<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="main-section">
<header class="text-center">
  <h3>Add product form</h3>
</header>
<form action="<?php echo site_url('user_products/add');?>" method="post" id="js-add-prod-form" enctype="multipart/form-data">
<?php 
if($this->session->flashdata('msg') !== null) {
    $msg = $this->session->flashdata('msg');
    echo "<p class='".$msg['htmlClass']."'>".$msg['msg']."</p>"; 
}
?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
            <label for="category">Category:</label>
            <div class="row">
                <div class="col-md-11">
                    <select class="form-control js-cat_select_box" name="product_cat[]" required>
                        <option value="">Choose one</option>
                        <?php foreach($data as $opt) {
                            echo "<option value='$opt->cat_slug'>$opt->cat_name</option>";
                        }?>
                    </select>
                    <input type="text" class="form-control js-cat_text_box d-none" placeholder="Enter category" name="product_cat[]">
                </div>
                <div class="col-md-1">
                    <i class="fa fa-plus btn btn-dark btn-sm js-category-add" title="Add new"></i>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
            <label for="pname">Product name:</label>
            <input type="text" class="form-control" placeholder="Enter product name" name="product_name" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" placeholder="Enter price" name="product_price" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
            <label for="desc">Description:</label>
            <textarea class="form-control" name="product_desc" placeholder="Enter about your product" rows="5" required></textarea>
            </div>
        </div>
    </div>
    <section class="js-spec-main-section">
    <h2>Specification</h2>
    <span class="js-main-attr-span">
    <div class="row js-attr-row">
        <div class="col-md-6">
            <div class="form-group">
            <label for="attr_name">Attribute name:</label>
            <input type="text" class="form-control" placeholder="Enter Attribute name" name="attr_name[]" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <label for="attr_value">Attribute Value:</label>
            <input type="text" class="form-control" placeholder="Enter Attribute Value" name="attr_value[]" required>
            </div>
        </div>
        <div class="col-md-2">
            <p class="d-none d-md-block">&nbsp;</p>
            <a href="#" class="btn btn-dark btn-sm js-attr-modifier" data-value="+">+</a>
            <a href="#" class="btn btn-dark btn-sm js-attr-modifier" data-value="-">-</a>
        </div>
    </div>
    </span>
    </section>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
            <input name="product_image1" type="file" accept="image/*" multiple/><br>
            <img src="#" class="js-preview-img" style="width: 50%;" alt="product image" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
            <button class="btn btn-dark">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </div>

</form>
</section>