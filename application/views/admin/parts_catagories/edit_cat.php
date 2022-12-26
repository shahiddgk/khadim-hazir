<div class="col-lg-6">
     <div class="card">
         <div class="card-header">Edit Catagories</div>
         <?php foreach($catagories as $data) ?>
        <div class="card-body card-block">
                <form action="<?=site_url('admin/catagories/update_cat')?>" method="post" enctype="multipart/form-data" class="">
                <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">CatagorydName</div>
                            <input type="text" id="username3" value="<?=$data[ENG]['name']?>" name="catagory_name" class="form-control">
                            <input type="hidden" value="<?=$data[ENG]['id'];?>" name="eng_id">                                    
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">ArabicName</div>
                                    <input type="text" id="email3" value="<?=$data[ARB]['name']?>" name="arabic_name" class="form-control">
                                    <input type="hidden" value="<?=$data[ARB]['id'];?>" name="arb_id">
                                </div>  
                                <div class="row form-group">
                            
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Upload Image</label></div>
                        <div class="col-12 col-md-9"><input type="file" id="file-input" name="photo" class="form-control-file"></div>
                                                        
                            </div>                                    
                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
        </form>
        </div>
    </div>
</div>
   
