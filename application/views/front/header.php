<!DOCTYPE html>
<html lang="en">
<style>
    a#dropdownMenuLink {
    color: white;
}
.dropdown-menu.show {
  margin-left: -40px;
}
</style>
<head>
    <!-- rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" -->
    <link rel="stylesheet" media href="<?=base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" media href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" media href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" media href="<?php echo base_url()?>assets/css/custom.css">
    <!--<link rel="stylesheet" href="<?php echo base_url() . 'assets/toastr/toastr.css' ?>">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Khadim Hazir.">
    <title>Khadim Hazir</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
         <nav class="navbar navbar-expand-lg py-3 navbar-dark bg-dark shadow-sm">
           <a href="<?php echo base_url()?>" class="navbar-brand">
             <!-- Logo Image -->
             <img src="<?=base_url()?>assets/images/khwhite.png" width="300" alt="" class="d-inline-block align-middle mr-2">
             <!-- Logo Text -->
            </a>
        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler clickable">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarSupportedContent" class="collapse navbar-collapse d-flex justify-content-end">
        <!-- Example single danger button -->
        <div class="dropdown show">
          <a class="btn btn-primary btn-lg dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= ucfirst($this->language); ?>
          </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="nav-link" href="javascript:void(0);" onclick="change_lang('eng');">English</a>
            <a class="nav-link" href="javascript:void(0);" onclick="change_lang('arb');">Arabic</a>
            <a class="nav-link" href="javascript:void(0);" onclick="change_lang('urd');">Urdu</a>
        </div>
        </div>
        <!-- BEGIN # BOOTSNIP INFO -->
        </div>
        <?php if ($this->session->userdata('user_logged_in')) { ?>
        <p class="text-end">
        <div class="dropdown clickable">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenuLink" aria-expanded="false">
            <img class="user-avatar rounded-circle" src="<?php echo base_url(); ?>images/<?php echo $_SESSION['images']?>" alt="User Avatar" height="50">
          </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="<?=site_url('welcome/update_profile')?>"><i class="fa fa-user"></i> Update Profile</a>
        <!-- <a class="dropdown-item" href="<?=site_url('welcome/change_password')?>"><i class="fa fa-lock"></i> Change Password</a> -->
        <a class="dropdown-item" href="<?=site_url('welcome/user_logout')?>"><i class="bi bi-door-open-fill"></i> Logout</a>
        </div>
        </div>
        </p> 
        <!-- <p class="text-center"><button type="button" class="btn btn-success btn-lg" <?php if($this->session->userdata('paymentstatus')=='paid'){ ?> data-toggle="modal" data-target="#subscriptionModal" <?php } ?>><?php echo $this->lang->line('welcome').' '.$this->session->userdata('username'); ?></button></p>  -->
        <!-- <p class="text-center"><a href="<?php echo base_url()?>welcome/logout" class="btn btn-success btn-lg" role="button"><?php echo $this->lang->line('logout'); ?></a></p> -->                       
        <?php } else { ?>
        <div class="dropdown show">
            <a class="btn btn-primary btn-lg dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $this->lang->line('register'); ?>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="<?= base_url('user/sign_up'); ?>"><?= $this->lang->line('register'); ?></a>
            <a class="dropdown-item" href="<?= base_url('user/sign_in'); ?>"><?= $this->lang->line('login'); ?></a>
        </div>
        </div>
        <?php } ?>
            </nav>
    </div>
    </div>
</body>
<div class="loading" id="loader" style="display: none;"></div>

<script>
    function change_lang(lang){
        $.ajax({
            url: "<?=base_url();?>welcome/set_session/"+lang,
            method: "GET",
            success: function(response) {
                window.location.href = '<?=base_url();?>welcome?'+lang;
            }
        });
    }
</script>