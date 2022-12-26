<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
                    
        <div class="col-md-12">
            <div class="card">
            <a href="<?=site_url().'/admin/autoparts/add_part'?>"> <button type="button" class="btn btn-outline-success btn-sm">
            
            Add New Part</button></a>
                <div class="card-header">
                    <strong class="card-title">Parts Catagories</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Arabic Name</th>
                                <th>Catagory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($autoparts as $data) { ?>
                            <tr>
                                <td class='priority' style="display:none;"> 
                                    <input type="hidden" name="sequence" value="1" size="2" class="order" />
                                    <input type="hidden" name="table_id" value="<?=$data[ENG]['table_id']?>" size="2" class="table_id" />
                                </td>
                                <td><?=$data[ENG]['name']?></td>
                                <td><?=$data[ARB]['name']?></td>
                                <td><?=$data[ENG]['catagory_name']?></td>
                                <td><a href="<?=site_url("admin/autoparts/edit_part/").$data[ENG]['table_id']?>"> <button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a> 
                                    <a href="<?=site_url("admin/autoparts/delete_part/").$data[ENG]['table_id']?>"> <button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a></td>
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
            url: "<?=base_url();?>admin/autoparts/editPriorityIds",
            method: "POST",
            data: { postData },
            success: function(response) {
                console.log(response);
            }
        });
    }
</script>