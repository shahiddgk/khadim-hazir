<style>
    .alert {
        margin-bottom: 1rem;
    }
    .mouse{
        cursor: pointer;
        }
    .card-header.usertop {
        background: gray;
    }
    button.btn.btn-primary {
        border-radius: 4px;
        margin-left: 27px !important;
    }
    label.form-control.col-md-2 {
        background: floralwhite;
    }
    .input-group-addon {
        font-size: 1rem !important;
        font-weight: 400 !important;
        line-height: 1.25 !important;
        padding: 0.5rem 0.75rem;
        color: #495057 !important;
        text-align: center;
        background: #e9ecef !important;
        border: 1px solid rgba(0, 0, 0, 0.15) !important;
        border-radius: 0.25rem !important;
    }    
</style>


<div class="container">
    <!-- alert massage start -->
    <?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $this->session->flashdata('success'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <?php } ?>
    <!-- alert massage end --> 
    <div class="row">
         <div class="col-md-5 pt-5">
            <aside class="profile-nav alt">
                <section class="card">
                    <div class="card-header usertop">
                        <div class="media">
                            <a href="#">
                            <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="<?php echo base_url(); ?>images/<?php echo $images?>">
                            </a>
                            <div class="media-body">
                                <h2 class="text-light display-6">&nbsp;&nbsp;<?=$name;?></h2>
                                <p class="text-white"><?php echo $this->lang->line('Profile_Setting'); ?></p>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fa fa-user"></i> <?php echo $this->lang->line('name'); ?>: <?=$name;?>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-phone"></i> <?php echo $this->lang->line('phone'); ?>: <?=$phone_no;?>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-envelope"></i> <?php echo $this->lang->line('email'); ?>: <?=$email;?>
                        </li>
                    </ul>
                </section>
            </aside>
        </div>
        <div class="col-md-7 pt-5">
            <div class="card">
                <div class="card-header"><?php echo $this->lang->line('change_setting'); ?></div>
                <div class="card-body card-block ">
                <form action="<?=site_url('welcome/update')?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><?php echo $this->lang->line('name'); ?></div>
                            <input type="text" value="<?=$name;?>" id="username3" name="name" class="form-control">
                            <input type="hidden" value="<?=$id;?>" id="username3" name="id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">                        
                        <div class="input-group-addon"><?php echo $this->lang->line('phone'); ?></div>
                        <input type="text" value="<?=$phone_no;?>" name="phone_no" class="form-control" pattern="\d*">                        
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">                        
                        <div class="input-group-addon"><?php echo $this->lang->line('email'); ?></div>
                        <input type="email" value="<?=$email;?>" name="email" class="form-control">                        
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">                        
                        <div class="input-group-addon"><?php echo $this->lang->line('new password'); ?></div>
                        <input type="password" name="password" class="form-control">                        
                        </div>
                    </div>
                    <div class="form-group mouse">
                        <div class="input-group">
                        <?php echo $this->lang->line('profile pic'); ?></div>
                        <input type="file" accept="image/*" id="profile-pic" name="images" class="form-control-file mouse">
                        </div>
                    </div>
                    <div class="form-actions form-group">
                        <div class="input-group">                        
                        <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('update'); ?></button>                        
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
