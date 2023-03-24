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
            <?php foreach($categories as $data) { ?>
            <form action="<?=site_url('admin/category/update_category')?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Category Name</div>
                        <input type="text" value="<?=$data['eng']['name'];?>" name="category_name" class="form-control">
                        <input type="hidden" value="<?=$data['eng']['category_id'];?>" name="category_id">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Arabic Name</div>
                        <input type="text" value="<?=$data['arb']['name'];?>" name="arabic_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Urdu Name</div>
                        <input type="text" value="<?=$data['urd']['name'];?>" name="urdu_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Price</div>
                        <input type="number" value="<?=$data['eng']['price'];?>" class="form-control" name="price"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">currency</div>
                        <select name="currency" class="form-control">
                            <option value="PKR" <?=($data['eng']['currency'] == 'PKR')?'selected':''?>>PKR</option>
                            <option value="USD" <?=($data['eng']['currency'] == 'USD')?'selected':''?>>USD</option>
                            <option value="SAR" <?=($data['eng']['currency'] == 'SAR')?'selected':''?>>SAR</option>
                        </select>
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