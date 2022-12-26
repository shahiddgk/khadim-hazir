<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="<?=site_url('admin/welcome');?>">
                    <!-- <img src="<?=base_url()?>assets/images/azoozywhite.png" width="300" alt="" class="d-inline-block align-middle mr-2"> -->
                    </a>
                </div>
                <?php
	   if($this->session->userdata('msg')){ ?>
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                        
                                        <?php echo $this->session->userdata('msg'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                </div>
                    <?php $this->session->unset_userdata('msg');
        }?>
       
       
                <div class="login-form">
                    <form action="<?=site_url('admin/welcome/login_action')?>" method='post'>
                        <div class="form-group">
                            <label>UserName</label>
                            <input <?php  if($this->input->cookie('user')!='') { ?> value="<?php echo $this->input->cookie('user')?>" <?php }  elseif($this->input->post('admin_email')!='') { ?>  value="<?php echo $this->input->post('admin_email')?>" <?php }  ?> type="text" name="username" class="form-control" placeholder="enter email" required>
                        </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" <?php if($this->input->cookie('pass')!='') { ?> value="<?php echo $this->input->cookie('pass')?>" <?php } ?> name="password" class="form-control" placeholder="Password" required>
                        </div>
                                <div class="checkbox">
                                    <label>
                                <input <?php if($this->input->cookie('check_rem')!='') { ?> checked <?php } ?> type="checkbox" name="rememberme"> Remember Me
                            </label>
                                    <label class="pull-right">
                                <a href="<?=site_url("/admin/welcome/forget_password") ?>">Forgotten Password?</a>
                            </label>

                                </div>
                                <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                                <!-- <div class="social-login-content">
                                    <div class="social-button">
                                        <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                                        <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                                    </div>
                                </div>
                                <div class="register-link m-t-15 text-center">
                                    <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                                </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
