<?php
if($users !=array()){?>
    <style>
    #profile {
     float:left; 
     margin-right:15px;
     height: 128px;
     width: 128px;
   }
   @import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
   @import url(https://fonts.googleapis.com/css?family=Open+Sans:300);
   h1,h2,h3,h4,h5,h6 {font-family: 'Montserrat', sans-serif; text-transform:uppercase; font-weight:700;}
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
           Employee Name: <?=$value->username;?>
         </h4>
         <h5 class="list-group-item-heading">Job Category: <?=$value->name;?></h5>
          <p><h6 class="list-group-item-heading">Job Details</Details></h6>
              <?=$value->en_job_description;?></p>
         <div class="btn-toolbar pull-right" role="toolbar" aria-label="">
           <div class="btn-group">
             <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-list"></i> <span class="caret"></span></button>
             <ul class="dropdown-menu">
               <li role="separator" class="divider"></li>
               <li><a href="#">Employee Profile</a></li>
               <li><a href="#">All jobs applied</a></li>
               <li><a href="#">Delete this job</a></li>
             </ul> -->
             <!-- <h6 class="list-group-item-heading"> Maximum Price</Details></h6> -->
           </div>
           <a href="#" class="btn btn-primary">$<?php echo$value->en_max_price?></a>
         </div>
         <div style="text-align: center;">
         <h6 class="list-group-item-heading">Applied on: <?php echo date("d-m-Y", strtotime($value->added_date))?></h5>
       </div>
       </li>     
     </ul>
   </div>         
   <?php }
}
