
<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#">
                    <img src="<?=base_url()?>assets/images/azoozi.com updated logo.png" width="200" alt="" class="d-inline-block align-middle mr-2">
                    </a>
                </div>
                <?php if($this->session->userdata('valid_email')){ ?>
                                     <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                        
                                        <?php echo $this->session->userdata('valid_email'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                  <?php $this->session->unset_userdata('valid_email'); } 
               if($this->session->userdata('email')){ ?>
                                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                        
                                        <?php echo $this->session->userdata('email'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                  <?php $this->session->unset_userdata('email'); } ?>
                <div class="login-form">
                    <form action="<?=site_url("welcome/send_mail")?>" method="POST">
                        <div class="form-group">
                            <label>Enter valid Email to Reset password</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                            <button type="submit" class="btn btn-primary btn-flat m-b-15">Submit</button>

                    </form>
                    <a href="<?=site_url("/admin/welcome")?>"> <button type="button" class="btn btn-outline-primary btn-sm">Back to Login</button></a>
                </div>
                
            </div>
        </div>
    </div>
