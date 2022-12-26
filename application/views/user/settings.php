<div class="col-md-4">

    <aside class="profile-nav alt">
        <section class="card">
            <div class="card-header user-header alt bg-dark">
                <div class="media">
                    <a href="#">
                        <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?=base_url()?>images/admin.gif">
                    </a>
                    <div class="media-body">
                        <h2 class="text-light display-6">Admin</h2>
                        <p>Profile Setting</p>
                    </div>
                </div>
            </div>
           

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="#"> <i class="fa fa-envelope-o"></i> User Name:&nbsp;&nbsp;<?=$name;?> </a>
                </li>
                <li class="list-group-item">
                    <a href="#"> <i class="fa fa-tasks"></i> Password: &nbsp;&nbsp;<?=$password;?></a>
                </li>
                <li class="list-group-item">
                    <a href="#"> <i class="fa fa-bell-o"></i> Email Id:&nbsp;&nbsp;<?=$email;?> </a>
                </li>
            </ul>

        </section>
    </aside>
</div>
<div class="card">
    <div class="card-header">Change Setting</div>
    <div class="card-body card-block">
            <form action="<?=site_url('/admin/welcome/update')?>" method="post" class="">
            <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">User Name</div>
                            <input type="text" value="<?=$name;?>" id="username3" name="username" class="form-control">
                            <input type="hidden" value="<?=$id;?>" id="username3" name="id" class="form-control">
                    </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">Password</div>
                            <input type="text" value="<?=$password;?>" id="email3" name="password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">Email</div>
                            <input type="email" value="<?=$email;?>" id="email3" name="email" class="form-control">
                    </div>
                </div>
                    <div class="form-actions form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div>
        </form>
    </div>
</div>