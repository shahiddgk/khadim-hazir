<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
                    
        <div class="col-md-12">
            <div class="card">
            <a href="<?=site_url().'/autoparts/add_part'?>"> <button type="button" class="btn btn-outline-success btn-sm">
            
            Add New Part</button></a>
                <div class="card-header">
                    <strong class="card-title">Parts Catagories</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> Website Name</th>
                                <th>Param 1</th>
                                <th>Param 2</th>
                                <th>Param 3</th>
                                <th>Param 4</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($catagories as $data) { ?>
                            <tr>
                                <td><?=$data[ENG]['name']?></td>
                                <td><?=$data[ARB]['name']?></td>
                                <td><?=$data[ENG]['name']?></td>
                                <td><?=$data[ARB]['name']?></td>
                                <td><?=$data[ENG]['catagory_name']?></td>
                                <td><a href="<?=site_url("autoparts/edit_part/").$data[ENG]['table_id']?>"> <button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a> <a href="<?=site_url("autoparts/delete_part/").$data[ENG]['table_id']?>"> <button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a></td>
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