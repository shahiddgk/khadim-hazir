<?php //echo "<pre>"; print_r($categories); exit; ?>

<?php //echo "<pre>"; print_r($categories);exit;?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Category List</strong>
                        <a href="<?=site_url().'admin/category/add_category'?>" style="float: right;"> 
                    <button type="button" class="btn btn-outline-success btn-sm">Add a Category</button></a>
                    </div>
                    <div class="card-body">
                        <table  id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Arabic Name</th>
                                    <th scope="col">Urdu Name</th>
                                    <th scope="col">Price USD</th>
                                    <th scope="col">Price AED</th>
                                    <th scope="col">Price PKR</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($categories)){ 
                                    $srn = 1; 
                                    foreach($categories as $key=>$value) {  
                                        //echo $value->name;print_r($value);exit;
                                        ?>
                                <tr>
                                    <th scope="row"><?=$srn ?></th>
                                    <td><?=$value->name?></td>
                                    <td><?=$value->ar_name?></td>
                                    <td><?=$value->ur_name?></td>
                                    <td><?=$value->price?></td>                                    
                                    <td><?=$value->ar_price?></td> 
                                    <td><?=$value->ur_price?></td> 
                                    <?php if(isset($value->image)){ ?>
                                    <td><img src="<?=base_url();?>uploads/category/<?=$value->image;?>" class="img-responsive" alt="category" height="auto" width="50"></td>
                                    <?php } else{ ?>
                                    <td></td>
                                    <?php } ?>
                                    <td><a href="<?=site_url("admin/category/edit_category/").$value->id?>"><button
                                                type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
                                        <a href="<?=site_url("admin/category/delete_category/").$value->id?>">
                                            <button type="button" class="btn btn-outline-danger btn-sm">Delete</button></a></td>
                                </tr>
                                <?php $srn++; } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>