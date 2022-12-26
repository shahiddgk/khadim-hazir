<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<div class="content mt-3">
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <a href="<?=site_url().'/admin/websites/add'?>"> <button type="button" class="btn btn-outline-success btn-sm">Add New Website</button></a>
                    <div class="card-header">
                        <strong class="card-title">Websites</strong>
                    </div>
                     <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Arabic Name</th>
                                    <th>URL</th>
                                    <th>Strings</th>
                                    <th>Token</th>
                                    <th>Image</th>
                                    <th>Brands</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($websites as $data) { ?>
                                <tr>
                                    <td class='priority' style="display:none;"> 
                                        <input type="hidden" name="sequence" value="1" size="2" class="order" />
                                        <input type="hidden" name="table_id" value="<?=$data[ENG]['table_id']?>" size="2" class="table_id" />
                                    </td>
                                    <td><?=$data[ENG]['name']?></td>
                                    <td><?=$data[ARB]['name']?></td>
                                    <td><?=$data[ENG]['url']?></td>
                                    <td><?=$data[ENG]['strings']?></td>
                                    <td><?=$data[ENG]['token']?></td>
                                    <td><img src="<?=base_url();?>uploads/websites/thumbs/<?=$data[ENG]['image_name'];?>"></td>
                                    <td>
                                    <?php
                                        //print_r($brands[$data[ENG]['table_id']]);exit;
                                        if(isset($brands[$data[ENG]['table_id']]) && count($brands[$data[ENG]['table_id']])>0) {
                                            print implode(",", $brands[$data[ENG]['table_id']]);
                                        } else { echo "All";  }?>
                                    </td>
                                    
                                    
                                    <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="smallmodalLabel">Small Modal</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                    >>>>>>>>>>>>>>>>>>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary">Confirm</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <td><a href="<?=site_url("admin/websites/edit/").$data[ENG]['table_id']?>"> <button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a> 
                                        <a href="<?=site_url("admin/websites/delete_website/").$data[ENG]['table_id']?>"> <button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a></td>
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
            url: "<?=base_url();?>admin/websites/editPriorityIds",
            method: "POST",
            data: { postData },
            success: function(response) {
                console.log(response);
            }
        });
    }
</script>