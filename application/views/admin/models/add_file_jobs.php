
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<div class="col-lg-6">
    <div class="card">
     <?php
     if($this->session->userdata('success')){ ?>
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success"><?php echo $this->session->userdata('success'); ?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>  </button>
        </div>
      <?php $this->session->unset_userdata('success'); } ?>
      <?php
     if($this->session->userdata('warning')){ ?>
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
            <?php echo $this->session->userdata('warning'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>  </button>
        </div>
      <?php $this->session->unset_userdata('warning'); } ?>
      
        <div class="card-header">Add Excel/CSV Jobs</div>
            <div class="card-body card-block">
                
             <form action="<?=site_url('admin/models/import_file_data')?>" method="post" enctype="multipart/form-data" class=""> 
                
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">File Upload</div>
                            <input type="file" id="data_file" name="data_file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                    </div>
                        <p class="help-block">Only Excel/CSV File Import.</p>
                </div>                                              
                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                </div>
             </form>
            </div>
        </div>
    </div>
    