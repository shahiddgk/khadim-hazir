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

     
        <form action="<?=base_url('user/login_user');?>" method="post" class="w-50" id="registrationForm">
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


<script src="text/javascript">

    // function handleCredentialResponse(response) {
    //     // decodeJwtResponse() is a custom function defined by you
    //     // to decode the credential response.
    //     const responsePayload = decodeJwtResponse(response.credential);

    //     console.log("ID: " + responsePayload.sub);
    //     console.log('Full Name: ' + responsePayload.name);
    //     console.log('Given Name: ' + responsePayload.given_name);
    //     console.log('Family Name: ' + responsePayload.family_name);
    //     console.log("Image URL: " + responsePayload.picture);
    //     console.log("Email: " + responsePayload.email);
    // }

    // function onSignIn(googleUser) {
    //     // send the Google user profile to your server
    //     var profile = googleUser.getBasicProfile();
    //     console.log("Profile".profile);
    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', '/user/google_login');
    //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //     xhr.onload = function() {
    //         console.log(xhr.responseText);
    //     };
    //     xhr.send('id_token=' + googleUser.getAuthResponse().id_token);
    // }

    // function signInWithGoogle() {
    //     alert('Signing in with Google');
    //     gapi.auth2.getAuthInstance().signIn().then(
    //     function(googleUser) {
    //         alert('here success');  
    //         console.log(googleUser);
    //     }, 
    //     function(error) {
    //         alert('here failure');  
    //         console.log(googleUser);
    //     });
    // }
</script>