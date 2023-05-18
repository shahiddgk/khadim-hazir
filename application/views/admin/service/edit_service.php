<?php //echo "<pre>"; print_r($categories); exit; ?>
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Edit Subcategory</div>
        <?php //foreach($sub_category as $data) ?>
        <div class="card-body card-block">
            <form action="<?=site_url('admin/service/update_service')?>" method="post" enctype="multipart/form-data"
                class="">
                <?php //foreach($sub_category as  $key=>$value) { ?>
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Select Category</strong>
                    </div>
                    <div class="card-body">
                        <select name="category_id" data-placeholder="Choose a Category..." class="standardSelect"
                            tabindex="1">
                            <?php foreach($categories as $category) { ?>
                            <option value=""></option>
                            <option <?php if($category['id'] == $category['id']) echo"selected"; ?>
                                value="<?=$category['id']?>"><?=$category['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Sub Category</div>
                        <?php //echo $sub_category[0]['name']; exit;?>
                        <input type="text" value="<?=$sub_category[0]['name'];?>" name="name" class="form-control">
                        <input type="hidden" value="<?=$sub_category[0]['id'];?>" name="id">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Arabic Name</div>
                        <input type="text" value="<?=$sub_category[0]['ar_name'];?>" name="ar_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Urdu Name</div>
                        <input type="text" value="<?=$sub_category[0]['ur_name'];?>" name="ur_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Price in USD</div>
                        <input type="number" value="<?=$sub_category[0]['price'];?>" class="form-control" name="price"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Price in AED</div>
                        <input type="number" value="<?=$sub_category[0]['ar_price'];?>" class="form-control" name="ar_price"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Price in PKR</div>
                        <input type="number" value="<?=$sub_category[0]['ur_price'];?>" class="form-control" name="ur_price"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Image</div>
                        <input type="file" name="image_file" class="form-control form-control-file" accept="image/*">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </div>

                    <?php //} ?>
            </form>
        </div>
    </div>
</div>