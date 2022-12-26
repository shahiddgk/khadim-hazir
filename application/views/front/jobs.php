<?php echo "<pre>hereeee"; print_r($data); exit(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="header-text">
                <p class="text text-light"> <?php echo $this->lang->line('what_job'); ?>  <button class="btn btn-outline" onclick="document.location.href='<?php echo base_url()?>welcome/index/<?php echo $catid; ?>'"> <?php echo $subcategory; ?><i class='fa fa-close'></i></button></p>
               
            </div>
        </div>
        <table>
        
            <tr>
                <th class="text-light"> <?php echo $this->lang->line('job_title'); ?></th>
                <th class="text-light"> <?php echo $this->lang->line('location'); ?></th>
                <th class="text-light"> <?php echo $this->lang->line('company'); ?></th>
            </tr>
            <?php if(count($models->result())>0){
                foreach($models->result() as $model) { ?>
           
            <tr onclick="open_jobdetail('<?php echo $model->job_id; ?>');">
                <td class="text-light" ><?php echo $model->name; ?></td>
                <td class="text-light"><?php echo $model->job_location; ?></td>
                <td class="text-light"><?php echo $model->company_name; ?></td>
            </tr>
            <? } } else{ ?>
            <tr>
               <td rowspan="4" class="text-light" style="text-align:center;"><?php echo $this->lang->line('no_data_found'); ?></td>
            </tr> 
           <?php } ?>
          
        </table>ٖ
    </div>
</div>