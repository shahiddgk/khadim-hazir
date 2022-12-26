 <!-- Modal Header -->
 <div class="modal-header">
    <h4 class="modal-title">
        <img class="img-circle" id="img_logo" src="<?=base_url()?>assets/images/azoozyblack.png">
    </h4>
    <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
</div>
<!-- Modal Body -->
<div class="container">
    
    <div class="col-md-3">
        <div class="modal-text">
            <p class="text-dark"><?php echo $this->lang->line('job_title'); ?></p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="abid">
            <p class="text-dark"><?php echo $jobdetail->name;?> </p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="abid">
            <p class="text-dark"><?php echo $this->lang->line('location'); ?> </p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="abid">
            <p class="text-dark"><?php echo $jobdetail->job_location;?></p>
        </div>
    </div>
</div>     
    </div>
    <div class="col-md-12">
        <h4 class="jobs-desc"><?php echo $this->lang->line('details'); ?></h4>
    </div>
    <div class="col-md-12">
        <p><?php echo $jobdetail->details; ?> </p>
    </div>
    
</div>
 <!-- Modal Footer -->
 <div class="modal-footer">
     <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
     <a target="_blank" href="<?php echo $jobdetail->website_url; ?>" class="btn btn-primary"><?php echo $this->lang->line('next'); ?></button>
</div>