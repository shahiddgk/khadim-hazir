<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Add Website</div>
            <div class="card-body card-block">
             <form action="<?=site_url('admin/websites/insert_url')?>" method="post" enctype="multipart/form-data" class="">
             <div class="card">
                    <div class="card-header">
                     <strong class="card-title">Select URL</strong>
                    </div>
                    <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Website Name</div>
                         <input type="text" id="username" name="website_name" class="form-control">
                        </div>
                                
                    </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Arabic Name</div>
                         <input type="text" id="email" name="arabic_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Enter URL</div>
                         <input type="url" id="email" name="url" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Token</div>
                         <input type="text" id="email" name="token" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Enter Strings</label></div>
                    <div class="col-12 col-md-9"><textarea name="string" id="textarea-input" rows="5" placeholder="Enter Values with comma(,)" class="form-control"></textarea></div>
                </div>
               
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Upload Logo</label></div>
                    <div class="col-12 col-md-9"><input type="file" id="file-input" name="photo" class="form-control-file"></div>
                </div> 
                <div class="row form-group">
                    <div class="col col-md-3"><label class=" form-control-label">Linking To Brands</label></div>
                    <div class="col col-md-9">
                        <div class="form-check-inline form-check">
                            <label for="inline-radio1" class="form-check-label ">
                                <input type="radio" id="inline-radio1" name="radio" value="1" onclick="HideBrands();" class="form-check-input" checked>All
                            </label>
                            <label for="inline-radio2" class="form-check-label ">
                                <input type="radio" id="inline-radio2" name="radio" value="2" onclick="ShowBrands();" class="form-check-input">Customize
                            </label>
                            
                        </div>
                    </div>
                </div> 
                <div id="car_brands" style="display:none;" class="card" >
                    <div class="card-header">
                        <strong class="card-title">Select Brands</strong>
                    </div>
                    <div class="card-body">

                        <select data-placeholder="Choose Brands..." multiple class="standardSelect" name="brands[]">
                            <option value=""></option>
                            <?php foreach($brands as $data) { ?>
                            <option value="<?=$data[ARB]['table_id']?>" ><?=$data[ARB]['name']?></option>
                            <? } ?>
                        </select>

                    </div>
                </div>                                                  
                <div class="form-actions form-group">
                 <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
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
