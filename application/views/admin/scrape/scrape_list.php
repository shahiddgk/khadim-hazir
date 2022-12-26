<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- <a href="<?=site_url().'/admin/scrape/add_scrape'?>"> <button type="button" class="btn btn-outline-success btn-sm">Scrape New Jobs</button></a> -->
                    <div class="card-header">
                        <strong class="card-title">Scrape Jobs List</strong>
                    </div>
                     <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Sub Category</th>
                                    <th>Location</th>
                                    <th>Company</th>
                                    <th>Website</th>
                                    <th>Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($response as $data) { ?>
                                <tr>
                                    <td><?=$data['job_title']?></td>
                                    <td><?=$data['subcategory']?></td>
                                    <td><?=$data['job_location']?></td>
                                    <td><?=$data['company_name']?></td>
                                    <td><?=$data['website_name'].'.com'?></td>
                                    <td><?= substr($data['details'], 0, 50) ?>... <a href="<?=site_url("admin/scrape/edit_scrape_job/").$data['id']?>">Read More</a>;
                                    </td>
                                    <td>
                                    <div class="btn-group">
                                        <a href="<?=site_url("admin/scrape/edit_scrape_job/").$data['id']?>"> <button type="button" class="btn btn-outline-primary btn-sm">Move to Jobs</button></a> <a href="<?=site_url("admin/scrape/delete_scrape_job/").$data['id']?>"> <button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a>
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