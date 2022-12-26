
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Edit Job Post</div>
         <?php foreach($model as $data) ?>
         <div class="card-body card-block">
            <form action="<?=site_url('admin/models/update_model')?>" method="post" enctype="multipart/form-data" class="">
                <div class="card">
                    <div class="card-header"><strong class="card-title">Select Sub Category</strong></div>
                        <div class="card-body">
                         <select  name="brand" data-placeholder="Choose a Subcategory..." class="standardSelect" tabindex="1">
                            <?php
                                foreach($brands->result() as $brand) { ?>
                                <option <?php if($brand->table_id==$data[ARB]['brand_id']) { ?> selected="selected" <?php } ?> value="<?=$brand->table_id?>"><?=$brand->name?></option> 
                                <?php } ?>
                         </select>
                        </div>
                    </div>    
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Job Title</div>
                                <input type="text" id="username3" value="<?=$data[ENG]['name']?>" name="model_name" class="form-control">
                                <input type="hidden" value="<?=$data[ENG]['id'];?>" name="eng_id">                                    
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Arabic Title</div>
                                <input type="text" id="email3" value="<?=$data[ARB]['name']?>" name="arabic_name" class="form-control">
                                <input type="hidden" value="<?=$data[ARB]['id'];?>" name="arb_id">
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Job Location</div>
                            <input type="text" id="email3" value="<?=$data[ENG]['job_location']?>"  name="job_location" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Job Location(ARB)</div>
                            <input type="text" id="email3" value="<?=$data[ARB]['job_location']?>"  name="job_location_arabic" class="form-control">
                        </div>
                    </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Company Name</div>
                         <input type="text" id="email3" value="<?=$data[ENG]['company_name']?>" name="company_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Company Name(ARB)</div>
                         <input type="text" id="email3" value="<?=$data[ARB]['company_name']?>" name="company_name_arabic" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Website URL</div>
                         <input type="url" id="email3" value="<?=$data[ENG]['website_url']?>" name="website_url" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Enter Detail(English)</div>
                        <textarea name="detail" id="textarea-english" placeholder="Enter Detail of the job" class="form-control"><?=$data[ENG]['details']?></textarea>
                    </div>
                </div> 
            
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Enter Detail(Arabic)</div>
                        <div><textarea name="arabic_detail" id="textarea-arabic" placeholder="Enter Detail of the job" class="form-control"><?=$data[ARB]['details']?></textarea></div>
                    </div>
                </div>      
                                                          
                    <div class="form-actions form-group"><button type="submit" class="btn btn-primary btn-sm">Update</button></div>
            </form>
        </div>
    </div>
</div>
   
<script type="text/javascript">
$(document).ready(function () {
    var markupStr = 'Enter Details of Job';
    $('#textarea-english').summernote({
        placeholder: 'Please Enter Job Detail in English',
        tabsize: 2,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]});
    $('#textarea-arabic').summernote({
        placeholder: 'Please Enter Job Detail in Arabic',
        tabsize: 2,
         toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]});
  });
</script>