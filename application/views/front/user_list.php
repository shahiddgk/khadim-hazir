<style>
    .text-heading {
    text-align: center;
    }
</style>
<div class="container">
    <!-- alert massage start -->
    <?php if ($this->session->flashdata('msg')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('msg'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php } ?>
        <!-- alert massage end -->
        <div class="text-heading pt-5" text-align="center">
            <h4>list of users in <?php echo $sub_categories[0]['name'] ?> </h4>
        </div>
    <div class="row pt-5 no-gutters">        
        <?php foreach($users as $user) { ?>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <ul class="list-group">
                    <!-- <a class="category-link" href="<?= base_url('user/user_lists/'.$user['eng']['sub_id'])?>" > -->
                        <li class="list-group-item list-item-clr d-flex p-3">
                            <div class="align-items-left pr-3">
                                <img class="card-img-left" height="60" width="60" src="<?=base_url();?>images/<?=$user['images'];?>" alt="Card image cap">
                            </div>
                            <div class="align-items-right">
                                <div class="listing-title">
                                    <b><?=$user['name']?></b>
                                </div>
                                <div class="listing-phone">
                                    <h6><?=$user['phone_no']?></h6>
                                </div>
                                <div class="listing-email">
                                    <h6><?=$user['email']?></h6>
                                </div>
                                <div>
                                    <span class="rating-span"><i class="fas fa-star"></i></span>
                                    <span class="rating-text">2.1(20.5K)</span>
                                </div>
                            </div>
                        </li>
                    </a>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>
