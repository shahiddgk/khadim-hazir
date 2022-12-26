<? foreach($models->result() as $model) {?>
    <li ><a href="javascript:void(0)" onclick="selectModel(<?=$model->table_id?>, '<?=$model->name?>');" ><?=$model->name?></a></li>
<? } ?>

