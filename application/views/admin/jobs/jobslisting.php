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
                                    <th>#</th>
                                    <th>Job Id</th>
                                    <th>Image</th>
                                    <th>Employer Name</th>
                                    <th>Job Category</th>
                                    <th>Job Describtion</th>
                                    <th>Maximum price</th>
                                    <th>Created At</th>
                                    <th>Applies</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                            // echo "<pre>"; print_r($users); exit;
                            $srn=1;
                            foreach($users as $key=>$value){ 
                                // echo "<pre>"; print_r($data); exit;?>
                                <tr>
                                <th class="text: center py-2"><?=$srn?></th>
                                <td class="text: center py-2"><?=$value->id?></td>
                                  <td class="text: center py-2">
                                <?php if(($value->image)!=""){ ?>
                                <img class="img-responsive img-rounded" id=profile src="<?=base_url();?>images/<?=$value->image?>" class="img-responsive" height="auto" width="50"/>
                                <?php } else{ ?>
                                <img class="img-responsive img-rounded" id=profile src="<?=base_url();?>images/manager.png" class="img-responsive"  height="auto" width="50"/>
                                <?php } ?></td>
                                    <td class="text: center py-2"><?=$value->username?></td>
                                    <td class="text: center py-2"><?=$value->name?></td>
                                    <td class="text: center py-2"><?=$value->en_job_description?></td>
                                    <td class="text: center py-2"><?=$value->en_max_price?></td>
                                    <td class="text: center py-2"><?=date("d-m-Y", strtotime($value->created_at))?></td>
                                    <td class="text: center py-2"><button type="button" class="btn btn-outline-primary"><a href="<?=site_url('admin/welcome/appliesPerJob?id='.$value->id.'')?>">Employees</a> </button></td>
                                </tr>
                            <?php $srn++;} ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </div>
    </div><!-- .animated -->
</div>

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