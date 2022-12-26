<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Edit URL</div>
         <?php foreach($website as $data) ?>
         <div class="card-body card-block">
            <form action="<?=site_url('admin/websites/update')?>" method="post" enctype="multipart/form-data" class="">
                <div class="card">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Website Name</div>
                                <input type="text" id="username3" value="<?=$data[ENG]['name']?>" name="website_name" class="form-control">
                                <input type="hidden" value="<?=$data[ENG]['id'];?>" name="eng_id"> 
                                <input type="hidden" value="<?=$data[ENG]['table_id'];?>" name="table_id">                                    
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Arabic Name</div>
                                <input type="text" id="email3" value="<?=$data[ARB]['name']?>" name="arabic_name" class="form-control">
                                <input type="hidden" value="<?=$data[ARB]['id'];?>" name="arb_id">
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Enter URL</div>
                            <input type="url" id="email" value="<?=$data[ENG]['url']?>" name="url" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Enter Token</div>
                                <input type="text" id="email3" value="<?=$data[ENG]['token']?>" name="site_token" class="form-control">
                                
                        </div> 
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Enter Strings</label></div>
                        <div class="col-12 col-md-9"><textarea name="strings" value="<?=$data[ENG]['strings']?>" id="textarea-input" rows="5" placeholder="Enter Values with comma(,)" class="form-control"><?=$data[ENG]['strings']?></textarea></div>
                    </div> 
                   
                </div>  
                        <div class="col col-md-3"><label for="file-input" class=" form-control-label">Upload Logo</label></div>
                        <div class="col-12 col-md-9"><input type="file" id="file-input" name="photo" class="form-control-file"></div>
                                                        
                    </div> 
                    <div class="row form-group">
                    <div class="col col-md-3"><label class=" form-control-label">Linking To Brands</label></div>
                    <div class="col col-md-9">
                        <div class="form-check-inline form-check">
                            <label for="inline-radio1" class="form-check-label ">
                                <input type="radio" id="inline-radio1" name="radio" value="1" onclick="HideBrands();" class="form-check-input" >All
                            </label>
                            <label for="inline-radio2" class="form-check-label ">
                                <input type="radio" id="inline-radio2" name="radio" value="2" onclick="ShowBrands();" class="form-check-input" checked>Customize
                            </label>
                            
                        </div>
                    </div>
                </div> 
                <div id="car_brands" style="display:block;" class="card" >
                    <div class="card-header">
                        <strong class="card-title">Select Brands</strong>
                    </div>
                    <div class="card-body">
                        <select data-placeholder="Choose Brands..." multiple class="standardSelect" name="brands[]">
                        <?php
                                    foreach($all_brand->result() as $all) { ?>
                                        <option <?php foreach($brands->result() as $row) {if($row->name==$all->name) { ?> selected="selected" <?php }} ?> value="<?=$all->table_id?>"><?=$all->name?></option> 
                                    <?php } ?>
                        </select>
                    </div>
                </div>                                                                     
                    <div class="form-actions form-group"><button type="submit" class="btn btn-primary btn-sm">Update</button></div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript">
   
    function ShowBrands()
    {
      
       $("#car_brands").show();


    }
    function HideBrands()
    {
        $('#car_brands').hide();
    }
    </script>  
