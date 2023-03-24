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
                                <input type="text" name="category_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Arabic Name</div>
                                <input type="text" name="arabic_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Urdu Name</div>
                                <input type="text" name="urdu_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Price</div>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">currency</div>
                                <select name="currency" class="form-control">
                                    <option value="PKR">PKR</option>
                                    <option value="USD">USD</option>
                                    <option value="SAR">SAR</option>
                                </select>
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
                                    <th scope="col">Price</th>
                                    <th scope="col">Crruncy</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($categories)){ $srn = 1; foreach($categories as $data) {  ?>
                                <tr>
                                    <th scope="row"><?=$srn ?></th>
                                    <td><?=$data['eng']['name']?></td>
                                    <td><?=$data['arb']['name']?></td>
                                    <td><?=$data['urd']['name']?></td>
                                    <td><?=$data['eng']['price']?></td>
                                    <td><?=$data['eng']['currency']?></td>
                                    <?php if(isset($data['eng']['image'])){ ?>
                                    <td><img src="<?=base_url();?>uploads/category/<?=$data['eng']['image'];?>"
                                            class="img-responsive" alt="category" height="auto" width="50"></td>
                                    <?php } else{ ?>
                                    <td></td>
                                    <?php } ?>
                                    <td><a
                                            href="<?=site_url("admin/category/edit_category/").$data['eng']['category_id']?>"><button
                                                type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
                                        <a
                                            href="<?=site_url("admin/category/delete_category/").$data['eng']['category_id']?>">
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm">Delete</button></a></td>
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