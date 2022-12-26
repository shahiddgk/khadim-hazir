<div class="col-lg-6">
     <div class="card">
         <div class="card-header">Edit Catagories</div>
         <?php foreach($autoparts as $data) ?>
        <div class="card-body card-block">
                <form action="<?=site_url('autoparts/update_part')?>" method="post" enctype="multipart/form-data" class="">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Select Catagory</strong>
                    </div>
                    <div class="card-body">
                        <select  name="catagory" data-placeholder="Choose a catagory..." class="standardSelect" tabindex="1">
                        <?php
                            foreach($catagories->result() as $cat) { ?>
                                <option <?php if($cat->table_id==$data[ARB]['cat_id']) { ?> selected="selected" <?php } ?> value="<?=$cat->table_id?>"><?=$cat->name?></option> 
                            <?php } ?>
                        </select>
                    </div>
                </div>   
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">PartName</div>
                        <input type="text" id="username3" value="<?=$data[ENG]['name']?>" name="part_name" class="form-control">
                        <input type="hidden" value="<?=$data[ENG]['id'];?>" name="eng_id">                                    
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">ArabicName</div>
                                <input type="text" id="email3" value="<?=$data[ARB]['name']?>" name="arabic_name" class="form-control">
                                <input type="hidden" value="<?=$data[ARB]['id'];?>" name="arb_id">
                            </div>                             
                    <div class="form-actions form-group">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                     </div>
        </form>
        </div>
    </div>
</div>
   
