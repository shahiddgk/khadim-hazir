<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<div class="content mt-3">
     <div class="animated fadeIn">
        <div class="row">
    <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header">
                    <strong class="card-title">Favourite Users</strong>
                </div> -->
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>User Type</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                    
                                </tr>
                                
                            </thead>
                            <tbody>
                            <?php $srn=1;
                             foreach($favouriteusers as $data){
                                // echo "<pre>"; print_r($favouriteusers);exit;
                                // echo "<pre>"; print_r($data->favourite_employees);exit;
                                ?>
                                <tr>
                                    <th><?=$srn?></th>
                                    <td><?=$data->employer_id?></td>
                                <?php if($data->image != ""){ ?>
                                    <td><img src="<?=base_url();?>images/<?=$data->image?>" class="img-responsive" height="auto" width="50"></td>
                                    <?php } else{ ?>
                                    <td><img src="<?=base_url();?>images/manager.png" class="img-responsive"  height="auto" width="50"></td>
                                    <?php } ?>
                                    <td><?=$data->username?></td>
                                    <td><?=$data->email?></td>
                                    <td><?=$data->phone_no?></td>
                                    <td><?=ucfirst($data->user_type)?></td>
                                    <td><?=$data->created_at?></td>
                                    <td><a href="<?php echo base_url()?>/admin/welcome/change_status?id=<?php echo $data->employer_id; ?>&status=<?php echo ($data->status=='active')? 'inactive':'active'; ?>"><?php echo ($data->status=='active')? 'Make InActive':' Make Active' ?></a></td>
                                    <!-- <td><button type="button" id="formButton" onclick="showHide();">Favourites</button></td> -->
                                </tr>
                               <?php $sn=0; 
                               foreach($data->favourite_employees as $fav){
                                $srn++;?>
                               
                                <tr style="background-color:#bab9b6">
                                <th><?=$srn?></th>
                                <td><?=$data->favourite_employees[$sn]['employee_id']?></td>
                                <?php if($data->favourite_employees[$sn]['image'] != ""){ ?>
                                    <td><img src="<?=base_url();?>images/<?=$data->favourite_employees[$sn]['image']?>" class="img-responsive" height="auto" width="50"></td>
                                    <?php } else{ ?>
                                    <td><img src="<?=base_url();?>images/manager.png" class="img-responsive"  height="auto" width="50"></td>
                                    <?php } ?>
                                <td><?=$data->favourite_employees[$sn]['username']?></td>
                                <td><?=$data->favourite_employees[$sn]['email']?></td>
                                <td><?=$data->favourite_employees[$sn]['phone_no']?></td>
                                <td><?=$data->favourite_employees[$sn]['user_type']?></td>
                                <td><?=date("d-m-Y", strtotime($data->favourite_employees[$sn]['created_at']))?></td>
                                <td><a href="<?php echo base_url()?>/admin/welcome/change_status?id=<?php echo $data->favourite_employees[$sn]['employee_id']; ?>&status=<?php echo ($data->favourite_employees[$sn]['status']=='active')? 'inactive':'active'; ?>"><?php echo ($data->favourite_employees[$sn]['status']=='active')? 'Make InActive':' Make Active' ?></a></td> 
                                 
                            </tr>
                            <?php
                             $sn++;
                            } 
                            $srn++;}?>
                            </tbody>
                        </table>
                        <!-- <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                              
                        </thead>
                        </table> -->
                    </div>
                </div>
            </div>
         </div>
    </div><!-- .animated -->
</div>
<script>

// function showHide(){
//     let element = document.getElementById("mytable");
//     let hidden = $("#hidden").attr() ;//element.getAttribute("hidden");

//     if (hidden) {
//        element.removeAttribute("hidden");
//     } else {
//        element.setAttribute("hidden", "hidden");
//     }
//   }

//   let toggle = button => {
//     let element = document.getElementById("mytable");
//     let hidden = element.getAttribute("hidden");

//     if (hidden) {
//        element.removeAttribute("hidden");
//     } else {
//        element.setAttribute("hidden", "hidden");
//     }
//   }
</script>
<script>

    $(document).ready(function () {
        //Helper function to keep table row from collapsing when being sorted
        var fixHelperModified = function (e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function (index) {
                $(this).width($originals.eq(index).width());
            });
            return $helper;
        };

        //Make diagnosis table sortable
        $("#bootstrap-data-table-export tbody").sortable({
            helper: fixHelperModified,
            stop: function (event, ui) {
                renumber_table('#bootstrap-data-table-export')
            }
        }).disableSelection();

    });

    //Renumber table rows
    function renumber_table(tableID) {
        var postData = [];
        $(tableID + " tr").each(function () {
            count = $(this).parent().children().index($(this)) + 1;
            $(this).find('.priority :input.order').val(count);
            var tableId = $(this).find('.priority :input.table_id').val();
            if(tableId>0) {
                postData[count] = tableId;
            }
        });
        
        // Posting data to controller to update database.
        $.ajax({
            url: "<?=base_url();?>admin/service/editPriorityIds",
            method: "POST",
            data: { postData },
            success: function(response) {
                console.log(response);
            }
        });
    }



</script>
