<style>
aside.profile-nav.alt {
    margin-top: 35px;
}

.checked {
    color: orange;
}

.col-md-12.text-center {
    padding-top: 50px;
}
</style>


<body style="overflow-y: scroll;">
    <div class="container">
        <?php foreach ($users as $user): ?>
        <div class="row">
            <div class="col-md-6">
                <img class="img-fluid rounded-circle" height="256px" width="256px"
                    src="<?=base_url();?>images/<?=$user['images'];?>" alt="Card image cap">
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
                    <?php if ($user_rating) : ?>
                    <?php $filled_stars = floor($user_rating['rating']); ?>
                    <?php $empty_stars = 5 - $filled_stars; ?>
                    <?php for ($i = 1; $i <= $filled_stars; $i++) : ?>
                    <span class="fa fa-star checked"></span>
                    <?php endfor; ?>
                    <?php if ($user_rating['rating'] - $filled_stars > 0) : ?>
                    <span class="fa fa-star-half-alt checked"></span>
                    <?php $empty_stars--; ?>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $empty_stars; $i++) : ?>
                    <span class="fa fa-star"></span>
                    <?php endfor; ?>
                    <span class="rating-count">(<?php echo $user_rating['total_rating']; ?>)</span>
                    <?php else : ?>
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <span class="fa fa-star"></span>
                    <?php endfor; ?>
                    <span class="rating-count">(0)</span>
                    <?php endif; ?>
                </div>





                <a href="<?php echo base_url('user/add_review/'.$user['id']); ?>" class="btn btn-primary mt-3">Add
                    Review</a>
                <a href="<?php echo base_url('user/send_mail_user/'.$user['id']) ?>" class="btn btn-primary mt-3">Book
                    Now</a>

            </div>
        </div>
        <?php endforeach; ?>
    </div>



    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="section-heading text-uppercase">Who Employers Hire This User</h2>
                <p class="section-subheading">Here are the employers who have hired this user in the past.</p>
            </div>
            <?php if (!empty($hiring)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Employer Name</th>
                        <th>Employer Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hiring as $hiring_details): ?>
                    <tr>
                        <td><?php echo $hiring_details['employer_name']; ?></td>
                        <td><?php echo $hiring_details['employer_email']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="col-md-12 text-center">
                <p class="lead">No employers have hired this user yet.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>


</body>