<style>
aside.profile-nav.alt {
    margin-top: 35px;
}
.checked{
    color: orange;
}
</style>


<body>
<div class="container">
    <?php foreach ($users as $user): ?>
    <div class="row">
        <div class="col-md-6">
            <img class="img-fluid rounded-circle" height="256px" width="256px" src="<?=base_url();?>images/<?=$user['images'];?>"
                alt="Card image cap">
        </div>
        <div class="col-md-6">
            <aside class="profile-nav alt">
                <h2>User Detail</h2>
                <section class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <p href="#"> <i class="fa fa-user "></i> Name: <?php echo $user['name'];?> </p>
                        </li>
                        <li class="list-group-item">
                            <p href="#"> <i class="fa fa-phone"></i> Phone: <?php echo $user['phone_no'];?></p>
                        </li>
                        <li class="list-group-item">
                            <p href="#"> <i class="fa fa-envelope"></i> Email: <?php echo $user['email'];?> </p>
                        </li>
                    </ul>
                </section>
            </aside>
            <div class="rating">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
            <a href="<?php echo base_url('user/send_mail_user/'.$user['id']) ?>" class="btn btn-primary mt-3">Book Now</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</body>