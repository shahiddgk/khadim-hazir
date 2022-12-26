<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="<?=site_url().'/admin/models/add_model'?>"> <button type="button" class="btn btn-outline-success btn-sm">Add New Job</button></a>
                            <a href="<?=site_url().'/admin/models/add_file_jobs'?>"> <button type="button" class="btn btn-outline-success btn-sm">Add Excel File</button></a>
                        </div>
                    </div>
                    <div class="card-header">
                        <strong class="card-title">Job Posts</strong>
                    </div>
                     <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered" style="table-layout: fixed;">
                            <thead>
                                <tr>
                                    <th>Post Title</th>
                                    <th>Arabic Title</th>
                                    <th>Sub Category</th>
                                    <th>Job Location</th>
                                    <th>Company</th>
                                    <th>Website</th>
                                    <!-- <th>Created At</th> -->
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($models as $data) { ?>
                                <tr>
                                    <td class='priority' style="display:none;"> 
                                        <input type="hidden" name="sequence" value="1" size="2" class="order" />
                                        <input type="hidden" name="table_id" value="<?=$data[ENG]['job_id']?>" size="2" class="table_id" />
                                    </td>
                                    <td><?=$data[ENG]['name']?></td>
                                    <td><?=$data[ARB]['name']?></td>
                                    <td><?=$data[ENG]['brand_name']?></td>
                                    <td><?=$data[ENG]['job_location']?></td>
                                    <td><?=$data[ENG]['company_name']?></td>
                                    <td><?=$data[ENG]['website_url']?></td>
                                    <!-- <td><?=$data[ENG]['post_date']?></td> -->
                                    <td><?= substr($data[ENG]['details'], 0, 70) ?>... <a href="<?=site_url("admin/models/edit_model/").$data[ENG]['job_id']?>">Read More</a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="<?=site_url("admin/models/edit_model/").$data[ENG]['job_id']?>"> <button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a> <a href="<?=site_url("admin/models/delete_model/").$data[ENG]['job_id']?>"> <button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a>
                                        </div>
                                    </td>
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
            url: "<?=base_url();?>admin/models/editPriorityIds",
            method: "POST",
            data: { postData },
            success: function(response) {
                console.log(response);
            }
        });
    }
</script>