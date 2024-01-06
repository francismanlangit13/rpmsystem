<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit User</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./user" class="text-decoration-none">Users</a></li>
            <li class="breadcrumb-item">Edit User</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM `user` WHERE `user_id` = '$id' AND `status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <form action="user_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User form
                                <div class="float-end">
                                    <button type="submit" name="edit_user" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                                    <input type="hidden" name="user_id" value="<?=$row['user_id']?>">
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="fname" class="required">First Name</label>
                                    <input type="text" class="form-control" placeholder="Enter First Name" name="fname" id="fname" value="<?=$row['fname']?>" required>
                                    <div id="fname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="mname">Middle Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Middle Name" name="mname" id="mname" value="<?=$row['mname']?>">
                                    <div id="mname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="lname" class="required">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name" name="lname" id="lname" value="<?=$row['lname']?>" required>
                                    <div id="lname-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="suffix">Suffix</label>
                                        <select class="form-control" id="suffix" name="suffix">
                                            <option value="" selected>Select Suffix</option>
                                            <option value=" " <?= isset($row['suffix']) && $row['suffix'] == ' ' ? 'selected' : '' ?>>None</option>
                                            <option value="Jr" <?= isset($row['suffix']) && $row['suffix'] == 'Jr' ? 'selected' : '' ?>>Jr</option>
                                            <option value="Sr" <?= isset($row['suffix']) && $row['suffix'] == 'Sr' ? 'selected' : '' ?>>Sr</option>
                                            <option value="I" <?= isset($row['suffix']) && $row['suffix'] == 'I' ? 'selected' : '' ?>>I</option>
                                            <option value="II" <?= isset($row['suffix']) && $row['suffix'] == 'II' ? 'selected' : '' ?>>II</option>
                                            <option value="III" <?= isset($row['suffix']) && $row['suffix'] == 'III' ? 'selected' : '' ?>>III</option>
                                            <option value="IV" <?= isset($row['suffix']) && $row['suffix'] == 'IV' ? 'selected' : '' ?>>IV</option>
                                            <option value="V" <?= isset($row['suffix']) && $row['suffix'] == 'V' ? 'selected' : '' ?>>V</option>
                                            <option value="VI" <?= isset($row['suffix']) && $row['suffix'] == 'VI' ? 'selected' : '' ?>>VI</option>
                                        </select>
                                        <div id="suffix-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="gender" class="required">Gender</label>
                                        <select class="form-control" name="gender" id="gender" required>
                                            <option value="" selected disabled>Select Gender</option>
                                            <option value="Male" <?= isset($row['gender']) && $row['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                            <option value="Female" <?= isset($row['gender']) && $row['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                        </select>
                                        <div id="gender-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="civil_status" class="required">Civil Status</label>
                                    <select class="form-control" name="civil_status" id="civil_status" <?php if($row['type'] == 'Renter'){ echo "required";} ?>>
                                        <option value="" selected>Select Civil Status</option>
                                        <option value="Single" <?= isset($row['civil_status']) && $row['civil_status'] == 'Single' ? 'selected' : '' ?>>Single</option>
                                        <option value="Married" <?= isset($row['civil_status']) && $row['civil_status'] == 'Married' ? 'selected' : '' ?>>Married</option>
                                        <option value="Widowed" <?= isset($row['civil_status']) && $row['civil_status'] == 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                                        <option value="Separated" <?= isset($row['civil_status']) && $row['civil_status'] == 'Separated' ? 'selected' : '' ?>>Separated</option>
                                    </select>
                                    <div id="civil_status-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="birthday" class="required">Birthday</label>
                                    <input type="date" class="form-control" name="birthday" id="birthday" value="<?=$row['birthday']?>" required>
                                    <div id="birthday-error"></div>
                                </div>
    
                                <div class="col-md-3 mb-3">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" value="<?=$row['email']?>" required>
                                    <div id="email-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="phone" class="required">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Phone" name="phone" maxlength="11" id="phone" value="<?=$row['phone']?>" required>
                                    <div id="phone-error"></div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="role" class="required">Role</label>
                                        <select class="form-control" name="role" id="role" required>
                                            <option value="" selected disabled>Select Role</option>
                                            <option value="Admin" <?= isset($row['type']) && $row['type'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                            <option value="Staff" <?= isset($row['type']) && $row['type'] == 'Staff' ? 'selected' : '' ?>>Staff</option>
                                            <option value="Renter" <?= isset($row['type']) && $row['type'] == 'Renter' ? 'selected' : '' ?>>Rentee</option>
                                        </select>
                                        <div id="role-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="status" class="required">Status</label>
                                        <select class="form-control" name="status" id="status" required>
                                            <option value="" selected disabled>Select Role</option>
                                            <option value="Active" <?= isset($row['status']) && $row['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                            <option value="Inactive" <?= isset($row['status']) && $row['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                        <div id="status-error"></div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 <?php if($row['type'] == 'Admin'){ echo "d-none";} ?>" id="Container">
                                    <label for="address" class="required">Address</label>
                                    <textarea type="text" class="form-control" placeholder="Enter Address" rows="3" name="address" id="address" autocomplete="off"><?=$row['address']?></textarea>
                                    <div id="address-error"></div>
                                </div>

                                <div class="col-md-4 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>" id="Container2">
                                    <label for="occupation" class="required">Occupation</label>
                                    <input type="text" class="form-control" placeholder="Enter Occupation" name="occupation" id="occupation" autocomplete="off" value="<?=$row['occupation']?>">
                                    <div id="occupation-error"></div>
                                </div>

                                <div class="col-md-4 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>" id="Container3">
                                    <label for="company" class="required">Company</label>
                                    <input type="text" class="form-control" placeholder="Enter Company" name="company" id="company" autocomplete="off" value="<?=$row['company']?>">
                                    <div id="company-error"></div>
                                </div>

                                <div class="col-md-4">
                                    <label for="dp" class="required">Valid ID Attachment</label>
                                    <input type="file" name="image1" class="form-control btn btn-secondary" style="padding-bottom:2.2rem;" id="image1" accept=".jpg, .jpeg, .png" onchange="previewImage('frame1', 'image1')">
                                </div>

                                <div class="col-md-8">
                                </div>

                                <div class="col-md-4 text-center">
                                    <br>
                                    <h6>JPG or PNG no larger than 5 MB</h6> 
                                    <img class="mt-2" id="frame1" src ="<?php echo base_url ?>assets/files/system/no-image.png" alt="Valid ID" width="240px" height="180px"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php } } else{ ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User info</h4>
                        </div>
                        <div class="card-body">
                            <h4>No records found.</h4>
                        </div>
                    </div>
                </div>
            </div>
        <?php } } ?>
    </div>
</main>
<script>
    document.getElementById('role').addEventListener('change', function () {
        var Container = document.getElementById('Container');
        var Container1 = document.getElementById('Container1');
        var Container2 = document.getElementById('Container2');
        var Container3 = document.getElementById('Container3');
        var civil_status = document.getElementById('civilstatus');
        var civil_status1 = document.getElementById('civilstatus');

        if (this.value === 'Renter') {
            Container.classList.remove('d-none');
            Container1.classList.remove('d-none');
            Container2.classList.remove('d-none');
            Container3.classList.remove('d-none');
            civil_status.required = true;
            civil_status1.disabled = false;
        } else {
            Container.classList.add('d-none');
            Container1.classList.add('d-none');
            Container2.classList.add('d-none');
            Container3.classList.add('d-none');
            civil_status.required = false;
            civil_status1.disabled = true;
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>