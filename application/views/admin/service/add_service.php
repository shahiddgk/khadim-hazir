<div class="col-lg-6">
    <div class="card">
     <?php
     if($this->session->userdata('success')){ ?>
        <!-- <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success"><?php echo $this->session->userdata('success'); ?></span>  Added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>  </button>
        </div> -->
      <?php $this->session->unset_userdata('success'); } 
                                
     if($this->session->userdata('warning')){ ?>
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
            <span class="badge badge-pill badge-warning"><?php echo $this->session->userdata('warning'); ?></span>Already exist.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <?php $this->session->unset_userdata('warning'); }  if($this->session->userdata('update')){ ?>
            <!-- <div class="sufee-alert alert with-close alert-secondary alert-dismissible fade show">
                <span class="badge badge-pill badge-secondary"><?php echo $this->session->userdata('update'); ?></span>Updated successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div> -->
                <?php $this->session->unset_userdata('update'); } ?>
            <div class="card-header">Add Sub Category</div>
                <div class="card-body card-block">
                    <form action="<?=site_url('admin/service/insert_service')?>" method="post" enctype="multipart/form-data" class="">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Select Category</strong>
                        </div>
                        <div class="card-body">
                            <select name="category_id" data-placeholder="Choose a Category..." class="standardSelect" tabindex="1">
                                <?php foreach($categories as $data) {?>
                                    <option value=""></option>
                                    <option value="<?=$data['id']?>"><?=$data['name']?></option>                                 
                                <?php } ?>
                            </select>
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Sub Category</div>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Arabic Name</div>
                                <input type="text" name="ar_name" class="form-control">
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Urdu Name</div>
                                <input type="text" name="ur_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Price in USD</div>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Price in AED</div>
                                <input type="number" class="form-control" name="ar_price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Price in PKR</div>
                                <input type="number" class="form-control" name="ur_price" required>
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Image</div>
                                <input type="file" name="image_file" class="form-control form-control-file" accept="image/*">
                            </div>
                        </div>

                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
             </div>
        </div>
    
