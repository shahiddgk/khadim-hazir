<style>
    .login-form {
        border: 1px solid #ccc;
        background-color: #f8f9fa;
    }
</style>

<div class="container">
    <div class="row justify-content-center login-form pt-5 m-5">
        <div class="col-12">
            <a class="btn btn-outline-primary" href="#" role="button" style="text-transform:none">
                <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                Continue with Google
            </a>
        </div>

     
        <form action="<?=base_url('welcome/login_user');?>" method="post" class="w-50" id="registrationForm">
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <div class="col-sm-9">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">
                    <i class="fas fa-lock"></i> Password
                </label>
                <div class="col-sm-9">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>
