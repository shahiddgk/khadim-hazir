<?php //echo "<pre>"; print_r($categories); exit; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <strong class="card-header">Add Category</strong>
                <div class="card-body card-block">
                    <form action="<?=site_url('admin/category/insert_category')?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Category Name</div>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Arabic Name</div>
                                <input type="text" name="ar_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Urdu Name</div>
                                <input type="text" name="ur_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Price in USD</div>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Price in AED</div>
                                <input type="number" class="form-control" name="ar_price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Price in PKR</div>
                                <input type="number" class="form-control" name="ur_price" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Image</div>
                                <input type="file" name="image_file" class="form-control form-control-file"
                                    accept="image/*">
                            </div>
                        </div>
                        <div class="form-actions form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php //echo "<pre>"; print_r($categories);exit;?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Category List</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
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