<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add User</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./user" class="text-decoration-none">Users</a></li>
            <li class="breadcrumb-item">Add User</li>
        </ol>
        <form action="user_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User form
                                <div class="float-end">
                                    <button type="submit" name="add_user" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="fname" class="required">First Name</label>
                                    <input type="text" class="form-control" placeholder="Enter First Name" name="fname" id="fname" required>
                                    <div id="fname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Middle Name" name="mname" id="mname">
                                    <div id="mname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="lname" class="required">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" id="lname" required>
                                    <div id="lname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="suffix">Suffix</label>
                                        <select class="form-control" name="suffix" id="suffix" required>
                                            <option value="" selected>Select Suffix</option>
                                            <option value=" ">None</option>
                                            <option value="Jr">Jr</option>
                                            <option value="Sr">Sr</option>
                                            <option value="I">I</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                            <option value="V">V</option>
                                            <option value="VI">VI</option>
                                        </select>
                                        <div id="suffix-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="gender" class="required">Gender</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="" selected disabled>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div id="gender-error"></div>
                                    </div>
                                </div>
    
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" required>
                                    <div id="email-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="phone" class="required">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone" name="phone" maxlength="11" id="phone" required>
                                    <div id="phone-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="password" class="required">Password</label>
                                    <!-- <a href="javascript:void(0)" class="password-toggle float-end text-decoration-none" onclick="togglePassword('password')">
                                        <i class="fa fa-eye"></i> Show
                                    </a> -->
                                    <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
									<a href="javascript:void(0)"  style="position: relative; top: -2rem; left: -3%; cursor: pointer; color: black;" onclick="togglePassword('password')">
                                        <span class="password-toggle float-end"><i class="fa fa-eye"></i> Show</span>
                                    </a>
                                    <div id="password-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="role" class="required">Role</label>
                                        <select class="form-control" name="role" id="role" required>
                                            <option value="" selected>Select Role</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Renter">Rentee</option>
                                        </select>
                                        <div id="role-error"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<script type="text/javascript">
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);

        if (passwordInput) {
            const passwordToggle = passwordInput.parentElement.querySelector('.password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                if (passwordToggle) {
                    passwordToggle.innerHTML = '<i class="fa fa-eye-slash"></i> Hide';
                }
            } else {
                passwordInput.type = 'password';
                if (passwordToggle) {
                    passwordToggle.innerHTML = '<i class="fa fa-eye"></i> Show';
                }
            }
        }
    }
</script>
<?php include ('../includes/bottom.php'); ?>