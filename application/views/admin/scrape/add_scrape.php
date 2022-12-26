
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<div class="col-lg-8">
    <div class="card">
     <?php
     if($this->session->userdata('success')){ ?>
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success"><?php echo $this->session->userdata('success'); ?></span>  Added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>  </button>
        </div>
      <?php $this->session->unset_userdata('success'); } ?>
        <div class="card-header">Add Job Post</div>
            <div class="card-body card-block">
             <form action="<?=site_url('admin/scrape/scrape_data')?>" method="post" enctype="multipart/form-data" class="">
                <div class="card">
                    <div class="card-header">
                     <strong class="card-title">Select Sub Category</strong>
                    </div>
                    <div class="card-body">
                     <select  name="brand" data-placeholder="Choose a subcategory..." class="standardSelect" tabindex="1">
                     <?php foreach($brand as $data) {?>
                        <option value=""></option>
                        <option value="<?=$data[ENG]['table_id']?>"><?=$data[ENG]['name']?></option>
                     <?php } ?>
                     </select>
                    </div>
                </div>  
                <div class="card">
                    <div class="card-header">
                     <strong class="card-title">Select Website</strong>
                    </div>
                    <div class="card-body">
                     <select  name="brand" data-placeholder="Choose a website..." class="standardSelect" tabindex="1">
                        <option value=""></option>
                        <option value="bayt">Bayt</option>
                        <option value="linkedin">Linkedin</option>
                     </select>
                    </div>
                </div>  
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Website URL</div>
                         <input type="url" id="email3" name="website_url" class="form-control">
                    </div>
                </div>                                             
                <div class="form-actions form-group">
                 <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
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