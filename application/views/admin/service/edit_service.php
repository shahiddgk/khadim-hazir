<?php //echo "<pre>"; print_r($sub_category); exit; ?>
<div class="col-lg-6">
     <div class="card">
         <div class="card-header">Edit Subcategory</div>
         <?php foreach($sub_category as $data) ?>
                <div class="card-body card-block">
                    <form action="<?=site_url('admin/service/update_service')?>" method="post" enctype="multipart/form-data" class="">
                    <?php foreach($sub_category as $data) { ?>
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Select Category</strong>
                        </div>
                        <div class="card-body">
                            <select name="category_id" data-placeholder="Choose a Category..." class="standardSelect" tabindex="1">
                                <?php foreach($categories as $category) { ?>
                                    <option value=""></option>
                                    <option  <?php if($category['category_id'] == $data['eng']['category_id']) echo"selected"; ?> value="<?=$category['category_id']?>"><?=$category['name']?></option>                                 
                                <?php } ?>
                            </select>
                        </div>
                    </div>    
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Sub Category</div>
                                <input type="text" value="<?=$data['eng']['name'];?>" name="sub_category" class="form-control">
                                <input type="hidden" value="<?=$data['eng']['sub_id'];?>" name="sub_cat_id">                                     
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
                            <div class="input-group-addon">Image</div>
                                <input type="file" name="image_file" class="form-control form-control-file" accept="image/*">
                            </div>
                        </div>                              
                    <div class="form-group">                            
                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
                            
                    <?php } ?> 
                    </form>
                </div>
             </div>
        </div>
   
