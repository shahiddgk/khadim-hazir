
<div class="col-lg-6">
    <div class="card">
     <?php
     if($this->session->userdata('success')){ ?>
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success"><?php echo $this->session->userdata('success'); ?></span>  Added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>  </button>
        </div>
      <?php $this->session->unset_userdata('success'); } ?>
        
    <div class="card-header">Add Catagory</div>
        <div class="card-body card-block">
                <form action="<?=site_url('admin/catagories/insert_cat')?>" method="post" enctype="multipart/form-data" class="">
                <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Name</div>
                            <input type="text" id="username3" name="catagory_name" class="form-control">
                        </div>
                        
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">ArabicName</div>
                                    <input type="text" id="email3" name="arabic_name" class="form-control">
                                    
                                </div>
                            </div>
                            <div class="row form-group">
                            
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Upload Image</label></div>
                        <div class="col-12 col-md-9"><input type="file" id="file-input" name="photo" class="form-control-file"></div>
                                                        
                            </div>                                
                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                </form>
        </div>
        </div>
</div>
    
