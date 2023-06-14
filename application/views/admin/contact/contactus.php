<!-- <?php
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
         <h4 class="list-group-item-heading">
           Contact Name: <?=$value->name;?>
         </h4>
         <h5 class="list-group-item-heading">Email : <?=$value->email;?></h5>
          <p><h6 class="list-group-item-heading">Details : </Details></h6>
              <?=$value->comments;?></p>
         <div style="text-align: center;">
       </div>
       </li>     
     </ul>
   </div>         
   <?php }
} ?>-->

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<div class="content mt-3">
     <div class="animated fadeIn">
        <div class="row">
    <div class="col-md-12">
            <div class="card">
               
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                            // echo "<pre>"; print_r($users); exit;
                            foreach($users as $data){ 
                                // echo "<pre>"; print_r($data); exit;?>
                                <tr>
                                    <td><?=$data->name?></td>
                                    <td><?=$data->email?></td>
                                    <td><?=$data->comments?></td>                                
                                </tr>
                            
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </div>
    </div><!-- .animated -->
</div>


