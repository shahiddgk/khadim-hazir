<div class="carBrand-outer">
    <div class="container">
        <div class="row">
            <?php foreach($brands->result() as $data) { ?>
                <div class="car-brand">
                    <a href="JavaScript:Void(0);" onclick="load_models(<?=$data->table_id?>);"><img src="<?=base_url()?>uploads/brands/<?=$data->image_name?>" class="img-responsive" alt="carBrand"></a>
                        
                </div>
            <?php } ?>
        </div>
    </div>
</div>
            
 


    
   