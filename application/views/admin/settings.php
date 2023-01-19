
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<div class="col-lg-12">
    <div class="card">
     <?php
     if($this->session->userdata('success')){ ?>
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success"><?php echo $this->session->userdata('success'); ?></span>  Added successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>  </button>
        </div>
      <?php $this->session->unset_userdata('success'); } ?>
        <div class="card-header">Update Settings</div>
            <div class="card-body card-block">
            <form action="<?=site_url('admin/welcome/update_settings')?>" method="post" enctype="multipart/form-data" class="">
              
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Package Price</div>
                        <input type="text" id="email3" name="package_price" value="<?php echo $settings->price; ?>" class="form-control">
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Terms & Conditions</div>
                        <textarea name="terms" id="textarea-english" class="form-control"><?php echo $settings->terms; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Terms & Conditions(Arabic)</div>
                        <textarea name="arabic_terms" id="textarea-arabic" class="form-control"><?php echo $settings->arabic_terms; ?></textarea>
                    </div>
                </div> 

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Privacy Policy</div>
                        <textarea name="privacy" id="privacy-english" class="form-control"><?php echo $settings->terms; ?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Privacy Policy(Arabic)</div>
                        <textarea name="arabic_privacy" id="privacy-arabic" class="form-control"><?php echo $settings->arabic_terms; ?></textarea>
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
    $('privacy-arabic').summernote({
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
    $('#privacy-english').summernote({
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
    
  });
</script>