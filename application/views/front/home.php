
<div class="container">
    <div class="row pt-5 no-gutters">
        
        <?php 
         foreach($categories as $row) { ?>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <ul class="list-group">
                    <a class="category-link" href="<?= base_url('welcome/subCategory/'.$row['eng']['category_id'])?>" >
                        <li class="list-group-item list-item-clr d-flex p-3">
                            <div class="align-items-left pr-3">
                                <img class="card-img-left" height="60" width="60" src="<?=base_url();?>uploads/category/<?=$row['eng']['image'];?>" alt="Card image cap">
                            </div>
                            <div class="align-items-right">
                                <div class="listing-title">
                                    <b><?=$row[$this->language]['name']?></b>
                                </div>
                                <div>
                                    <span class="rating-span"><i class="fas fa-star"></i></span>
                                    <span class="rating-text">4.1(20.5K)</span>
                                </div>
                                <div>From <b>$200</b></div>
                            </div>
                        </li>
                    </a>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>