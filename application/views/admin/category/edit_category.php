<?php if($this->session->userdata('warning')){ ?>
<div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
    <span class="badge badge-pill badge-warning"><?php echo $this->session->userdata('warning'); ?></span>Already exist.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
            aria-hidden="true">&times;</span></button>
</div>
<?php $this->session->unset_userdata('warning'); } ?>
<?php //echo "<pre>"; print_r($categories); exit; ?>

<div class="col-lg-6">
    <div class="card">
        <strong class="card-header">Edit Categories</strong>
        <div class="card-body card-block">
            <?php foreach($categories as $key=>$value) {  ?>
            <form action="<?=site_url('admin/category/update_category')?>" method="post" enctype="multipart/form-data">
            
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Category Name</div>
                        <input type="text" value="<?=$value->name;?>" name="name" class="form-control">
                        <input type="hidden" value="<?=$value->id;?>" name="id">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Arabic Name</div>
                        <input type="text" value="<?=$value->ar_name;?>" name="ar_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Urdu Name</div>
                        <input type="text" value="<?=$value->ur_name;?>" name="ur_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Price USD</div>
                        <input type="number" value="<?=$value->price;?>" class="form-control" name="price" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Price AED</div>
                        <input type="number" value="<?=$value->ar_price;?>" class="form-control" name="ar_price"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Price PKR</div>
                        <input type="number" value="<?=$value->ur_price?>" class="form-control" name="ur_price" required>
                    </div>
                </div> 

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Slug</div>
                        <input type="text" value="<?=$value->slug?>" class="form-control" name="slug" required>
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
            </form>
            <?php } ?>
        </div>
    </div>
</div>