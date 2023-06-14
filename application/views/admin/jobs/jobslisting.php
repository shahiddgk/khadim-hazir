<style>
 #profile {
  float:left; 
  margin-right:15px;
  height: 128px;
  width: 128px;
}
@import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
@import url(https://fonts.googleapis.com/css?family=Open+Sans:300);
h1,h2,h3,h4,h5,h6 {font-family: 'Montserrat', sans-serif; text-transform:; font-weight:700;}
html, body {font-family: 'Open Sans', sans-serif; -webkit-font-smoothing: antialiased !important;}
.active a {color:#c7ddef;}
</style>
<?php 
// echo "<pre>"; print_r($users); exit;
foreach($users as $key=>$value) {?>
<div class="container">
  <ul class="list-group">
    <li class="list-group-item clearfix">
    <?php if(($value->image)!=""){ ?>
        <img class="img-responsive img-rounded" id=profile src="<?=base_url();?>images/<?=$value->image?>" class="img-responsive" height="auto" width="50"/>
    <?php } else{ ?>
    <img class="img-responsive img-rounded" id=profile src="<?=base_url();?>images/manager.png" class="img-responsive"  height="auto" width="50"/>
        <?php } ?>
      <h4 class="list-group-item-heading">
        Job Posted By: <?=$value->username;?>
      </h4>
      <h5 class="list-group-item-heading">Job Category: <?=$value->name;?></h5>
       <p><h6 class="list-group-item-heading">Job Details</Details></h6>
           <?=$value->en_job_description;?></p>
     
    <div class="container">
     <div class="row">
    <div class="col-sm-1">
    <div class="btn-toolbar pull-right" role="toolbar" aria-label="">
        <div class="btn-group">
        <a href="#" class="btn btn-primary">$<?php echo$value->en_max_price?></a> 
      </div>
      </div>
    </div>
    <div class="col-sm-10">
    <div style="text-align: center;">
      <h6 class="list-group-item-heading">Job was Posted on: <?php echo date("d-m-Y", strtotime($value->created_at))?></h5>
    </div>
    </div>
    <div class="col-sm-1" >
    <div class="btn-toolbar pull-right" role="toolbar" aria-label="">
        <div class="btn-group">
        <a href="<?=site_url('admin/welcome/appliesPerJob?id='.$value->id.'')?>" class="btn btn-primary">Applies</a>
        <!-- <input type="button"  class="btn btn-primary" style= "cursor:pointer" value="applies" onclick="admin/welcome::appliesPerJob(5)">   -->
      </div>
      </div>
    </div>
     </div>
    </div>
    </li>     
  </ul>
</div>         
<?php }?>
