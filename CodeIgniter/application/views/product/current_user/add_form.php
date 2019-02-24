<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if($page === 'edit') {
    $form_action = 'user_products/update';
    $pageHeader = 'Edit';
    $data = $overAllData[0];
    $productData = $overAllData[1][0][0]; 
    $currentCat = $productData->product_cat;
    $name = $productData->product_name;
    $price = $productData->product_price;
    $image = base_url().'static/img/products/'.$productData->product_image1;
    $spec = json_decode($productData->product_spec, true);
    $desc = $productData->product_desc;
    $required = '';
} else if($page === 'add') {
    $form_action = 'user_products/add';
    $pageHeader = 'Add';
    $data = $data;
    $currentCat = '';
    $name = $price = $image = $desc = '';
    $spec = ['' => ''];
    $required = 'required';
} else {
    die("I don't know, how you enter here. Please go back.App: fix me");
}
?>
<section class="main-section">
<header class="text-center">
  <h3><?php echo $pageHeader;?> product form</h3>
</header>
<form action="<?php echo site_url($form_action);?>" method="post" id="js-add-prod-form" enctype="multipart/form-data">
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
                        <?php
                        foreach($data as $opt) {
                            $selected = ($page === 'edit' && $currentCat === $opt->cat_slug) ? 'selected' : '';
                            echo "<option value='$opt->cat_slug' $selected>$opt->cat_name</option>";
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
            <input type="text" class="form-control" placeholder="Enter product name" name="product_name" data-page="<?php echo $page;?>" data-raw-value="<?php echo $name;?>" value="<?php echo $name;?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" placeholder="Enter price" name="product_price" value="<?php echo $price;?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
            <label for="desc">Description:</label>
            <textarea class="form-control" name="product_desc" placeholder="Enter about your product" rows="5" required><?php echo $desc;?></textarea>
            </div>
        </div>
    </div>
    <section class="js-spec-main-section">
    <h2>Specification</h2>
    <span class="js-main-attr-span">
    <?php foreach(array_keys($spec) as $key) {?>
    <div class="row js-attr-row">
        <div class="col-md-6">
            <div class="form-group">
            <label for="attr_name">Attribute name:</label>
            <input type="text" class="form-control" placeholder="Enter Attribute name" name="attr_name[]" value="<?php echo $key;?>" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
            <label for="attr_value">Attribute Value:</label>
            <input type="text" class="form-control" placeholder="Enter Attribute Value" name="attr_value[]" value="<?php echo $spec[$key];?>" required>
            </div>
        </div>
        <div class="col-md-2">
            <p class="d-none d-md-block">&nbsp;</p>
            <a href="#" class="btn btn-dark btn-sm js-attr-modifier" data-value="+">+</a>
            <a href="#" class="btn btn-dark btn-sm js-attr-modifier" data-value="-">-</a>
        </div>
    </div>
    <?php }?>
    </span>
    </section>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
            <input name="product_image1" type="file" accept="image/*" multiple <?php echo $required; ?>/><br>
            <img src="<?php echo $image;?>" class="js-preview-img" style="width: 50%;" alt="product image" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
            <button class="btn btn-dark">Submit</button>
            <!-- <button type="reset" class="btn btn-danger">Reset</button> -->
            </div>
        </div>
    </div>

</form>
</section>