
<div class="col-lg-6">
    <div class="card">
     <?php
     if($this->session->userdata('success')){ ?>
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success"><?php echo $this->session->userdata('success'); ?></span>  Added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>  </button>
        </div>
      <?php $this->session->unset_userdata('success'); } ?>
        
    <div class="card-header">Add SparePart</div>
        <div class="card-body card-block">
                <form action="<?=site_url('admin/autoparts/insert_part')?>" method="post" enctype="multipart/form-data" class="">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Select Catagory</strong>
                    </div>
                    <div class="card-body">
                    
                        <select  name="catagory" data-placeholder="Choose a Catagory" class="standardSelect" tabindex="1">
                        <?php foreach($catagories as $data) {?>
                            <option value=""></option>
                            <option value="<?=$data[ENG]['table_id']?>"><?=$data[ENG]['name']?></option>
                        <?php } ?>
                        </select>                               
                    </div>
                </div>   
                <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Name</div>
                            <input type="text" id="username3" name="part_name" class="form-control">
                        </div>
                        
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">ArabicName</div>
                                    <input type="text" id="email3" name="arabic_name" class="form-control">
                                    
                                </div>
                            </div>
                                                           
                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                </form>
        </div>
        </div>
</div>
    
