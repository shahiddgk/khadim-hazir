<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<div class="content mt-3">
     <div class="animated fadeIn">
        <div class="row">
    <div class="col-md-12">
            <div class="card">
                <a href="<?=site_url().'admin/service/add_service'?>"> <button type="button" class="btn btn-outline-success btn-sm">Add Subcategory</button></a>
                <div class="card-header">
                    <strong class="card-title">Sub Categories</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                                <tr>
                                    <th>Sub Category</th>
                                    <th>Category</th>
                                    <th>Arabic Name</th>
                                    <th>Urdu Name</th>
                                    <th>Price</th>
                                    <th>currency</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($sub_categories)) {
                                //echo "<pre>"; print_r($sub_categories); exit;
                                foreach($sub_categories as $data) { ?>
                                <tr>
                                    <td><?=$data['eng']['name']?></td>
                                    <td><?=$data['eng']['category_name']['name']?></td>
                                    <td><?=$data['arb']['name']?></td>
                                    <td><?=$data['urd']['name']?></td>
                                    <td><?=$data['eng']['price']?></td>
                                    <td><?=$data['eng']['currency']?></td>
                                    <?php if(isset($data['eng']['image'])){ ?>
                                    <td><img src="<?=base_url();?>uploads/category/<?=$data['eng']['image'];?>" class="img-responsive" alt="sub-category" height="auto" width="50"></td>
                                    <?php } else{ ?>
                                    <td></td>
                                    <?php } ?>
                                    <td><a href="<?=site_url("admin/service/edit_service/").$data['eng']['sub_id']?>"> <button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a> <a href="<?=site_url("admin/service/delete_service/").$data['eng']['sub_id']?>"> <button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a></td>
                                </tr>
                            <?php } } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
         </div>
    </div><!-- .animated -->
</div>

<!-- <script>

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
</script> -->