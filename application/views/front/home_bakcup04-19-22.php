<div class="container" id="home-page-div">
    <div class="row">
        <div class="col-md-8">
            <div class="text-area">
                <h1><?php echo $this->lang->line('hello'); ?></h1> <br>
                <p class="text"><?php echo $this->lang->line('what_job'); ?></p>
                <p><?php echo $this->lang->line('i_am_interested'); ?> <span id="back-button"></span></p>
                
            </div>
            <div class="category-list" id="category-list">
                <div class="categoryitems">
                    <?php foreach($categories->result() as $row) { ?>
                    <button class="btn btn-outline" onclick="filtercategory('<?=$row->table_id?>','<?=$row->name?>');" > <?=$row->name?> </button>
                    
                    <?php } ?>
                </div>
            </div>
            <div class="category-list" id="sub-category-list">
            <?php foreach($categories->result() as $row) { ?>
                <div class="categoryitems subcategoyritems" id="sub-<?=$row->table_id?>" style="display:none;">
                    <?php foreach($subcategories->result() as $sub) { 
                        if($row->table_id==$sub->region_id){?>
                    <button class="btn btn-outline"  onclick="gotojobs('<?=$sub->table_id?>');"> <?=$sub->name?> </button>
                    <?php } } ?>
                </div>
                <?php } ?>
            </div>
           
        </div>
        
        <div class="col-md-4">
            <div class="content">
                <img class="img-fluid" src="<?=base_url()?>assets/images/other.png" alt="">
            </div>
        </div>
    </div>ٖ
</div>
<script language="javascript">
$( document ).ready(function() {
   
    var subcat = '<?php echo $subcateid; ?>';
   
    if(subcat!=""){
       var categoryname = '<?php echo $subname; ?>';
        filtercategory(subcat, categoryname);
    }
});
function filtercategory(categoryid, categoryname) {
    $('#category-list').hide();
    $('#back-button').html("<button onclick='backtocategory();' type='button' class='btn btn-jobs'>"+categoryname+"<i class='fa fa-close'></i></button>");
    $('#sub-'+categoryid).slideToggle("slow");
}
function backtocategory(){
    $('#category-list').show();
    $('#back-button').html('');
    $('.subcategoyritems').hide();
}

function gotojobs(subcategory){
    window.location.href = "<?=base_url();?>welcome/load_models/"+subcategory;
   
}
</script>