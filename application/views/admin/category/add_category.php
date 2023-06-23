<div class="container">   
            <div class="card">
                <strong class="card-header">Add Category</strong>
                <div class="card-body card-block">
                    <form action="<?=site_url('admin/category/insert_category')?>" method="post"
                        enctype="multipart/form-data">
                        <div class="row">
                        <div class="col col-md">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Category Name</div>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        </div>
                        <div class="col col-md">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Arabic Name</div>
                                <input type="text" name="ar_name" class="form-control">
                            </div>
                        </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col col-md">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Urdu Name</div>
                                <input type="text" name="ur_name" class="form-control">
                            </div>
                        </div>
                        </div>
                        <div class="col col-md">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Price in USD</div>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                        </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col col-md">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Price in AED</div>
                                <input type="number" class="form-control" name="ar_price" required>
                            </div>
                        </div>
                        </div>
                        <div class="col col-md">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Price in PKR</div>
                                <input type="number" class="form-control" name="ur_price" required>
                            </div>
                        </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col col-md">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Slug</div>
                                <input type="text" class="form-control" name="slug" required>
                            </div>
                        </div>
                        </div>
                        <div class="col col-md">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">Image</div>
                                <input type="file" name="image_file" class="form-control form-control-file"
                                    accept="image/*">
                            </div>
                        </div>
                        </div>
                        <div class="w-100"></div>
                    </div>
                        <div class="form-group">
                        <div style="text-align: center">
                            <button type="submit" class="btn btn-primary btn-sm" style="width : 100px">Submit</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>