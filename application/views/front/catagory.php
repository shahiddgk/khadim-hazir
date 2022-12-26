<div class="searchBar">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6">
                <div class="searchForm">
                    <span id="searchLabel">الخطوة الاولي</span>
                    <input type="text" placeholder="سيارتك من وين؟" aria-describedby="searchLabel">
                </div>
            </div>
        </div>
    </div>
</div>
            
<div class="car-accessories">
    <div class="container">
        <?php  foreach($catagories->result() as $data) { ?>
            <a class="accessories" href="#<?=$data->table_id?>">
                <span ><img src="<?=base_url();?>uploads/catagories/<?=$data->icon;?>"></span>
                <?=$data->name?>
            </a>
        <?php } ?>
    </div>
</div>
<?php foreach($catagories->result() as $data) { ?> 
<div id="<?=$data->table_id?>" class="_fancybox">
    <div class="fancybox-content_inn">
        <div class="fancy-title">
            <h2 class="brakes"><?=$data->name?></h2>
        </div>
            
    <div class="is-search-outer">
        <div class="is-searchWrap">
            <div class="is-search">
                <input type="text" placeholder="">
                <input type="submit" value="" />
            </div>
        </div>
        <div class="search-results">
            <ul>
                <?php 
                    if(isset($parts[$data->table_id])) {
                        foreach($parts[$data->table_id] as $part) { ?>
                            <li><a href="#"><?=$part['name']?></a></li>
                        <?php 
                        }
                    } 
                ?>
            </ul>
        </div>
    </div>
            
    </div>
</div>
<?php } ?>
            

            
            <div class="pagination">
            	<a href="#" class="prev"> السابق ></a>
            </div>