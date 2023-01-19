<style>
    form {
        border: 1px solid #ccc;
        background-color: #f8f9fa;
    }
</style>

<div class="container">
    <!-- alert massage start -->
    <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $this->session->flashdata('success'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
    </button>
    </div> -->
    <!-- alert massage end -->
    <div class="row justify-content-center">
        <form action="<?=base_url('welcome/create_user');?>" method="post" class="w-50 p-3" id="registrationForm">
            <div class="form-group row">
                <label for="user_type" class="col-sm-3 col-form-label">
                    <i class="fas fa-user-circle"></i> User Type
                </label>
                <div class="col-sm-9 d-flex">
                    <label for="employee">
                        <input type="radio" id="employee" name="user_type" value="employee">
                        <img src="<?=base_url();?>uploads/general/employee.png" alt="Employee icon" height="80" width="80">
                        <span class="text-center">Employee</span>
                    </label>
    
                    <label for="employer">
                        <input type="radio" id="employer" name="user_type" value="employer">
                        <img src="<?=base_url();?>uploads/general/businessman.png" alt="Employee icon" height="80" width="80">
                        <span class="text-center">Employer</span>
                    </label>
                </div>
            </div>               
            <div id="dropdown" style="display: none;">
            <div class="form-group row">
                <label for="categories" class="col-sm-3">
                    <i class="fa fa-list"></i> Categories
                </label>
                <div class="col-sm-9">
                    <select id="category" name="category_id" class="form-control" onchange="showSubcategory()">
                        <option value="">Select a category</option>
                        <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                </div>
                <div class="form-group row">
                    <label for="subcategory" id="subcategory-label" class="col-sm-3 col-form-label">
                       <i class="fa fa-list"></i> Subcategory
                   </label>
                   <div class="col-sm-9">
                    <select id="sub-category" name="sub_id" class="form-control">
                        <option value="">Select a subcategory</option>
                    </select>
                </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="fullName" class="col-sm-3 col-form-label">
                    <i class="fas fa-user"></i> Full Name
                </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="fullName" name="full_name"  placeholder="Enter your full name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <div class="col-sm-9">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="phoneNo" class="col-sm-3 col-form-label">
                    <i class="fas fa-phone"></i> Phone No
                </label>
                <div class="col-sm-9">
                <input type="tel" class="form-control" id="phoneNo" name="phone_no" placeholder="Enter your phone number" required>
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
                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById("employee").addEventListener("click", function() {
    document.getElementById("dropdown").style.display = "block";
    });

    document.getElementById("employer").addEventListener("click", function() {
    document.getElementById("dropdown").style.display = "none";
    });

  function showSubcategory() {
    var categoryId = document.getElementById("category").value;
        if (categoryId) {
            $.ajax({
                url: "<?php echo base_url('welcome/ajax_subcategory'); ?>",
                type: "POST",
                data: {
                    "category_id": categoryId
                },
                success: function(response) { 
                    data = JSON.parse(response);
                    console.log("result".data);
                    $("#sub-category").html("<option value=''>Select a subcategory</option>");
                    $.each(data, function(key, value) {
                        $("#sub-category").append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });

                    // $("#subcategory-label").show();
                    $("#sub-category").show();
                }
            });
        }
    }
</script>