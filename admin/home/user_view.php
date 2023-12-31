<?php include ('../includes/header.php'); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">View User</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./user" class="text-decoration-none">Users</a></li>
            <li class="breadcrumb-item">View User</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM `user` WHERE `user_id` = '$id' AND `status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User info</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" value="<?=$row['fname']?>" id="fname" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="mname">Middle Name</label>
                                <input type="text" class="form-control" value="<?=$row['mname']?>" id="mname" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" value="<?=$row['lname']?>" id="lname" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="suffix">Suffix</label>
                                <input type="text" class="form-control" value="<?=$row['suffix']?>" id="suffix" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="gender">Gender</label>
                                <input type="text" class="form-control" value="<?=$row['gender']?>" id="gender" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" value="<?=$row['email']?>" id="email" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" value="<?=$row['phone']?>" id="phone" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" value="<?php if($row['type'] == 'Renter'){ echo"Rentee";} else{ echo $row['type']; } ?>" id="role" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" value="<?=$row['status']?>" id="status" disabled>
                            </div>

                            <div class="col-md-12 mb-3 <?php if($row['type'] == 'Admin'){ echo "d-none";} ?>" id="Container">
                                <label for="address" class="required">Address</label>
                                <textarea type="text" class="form-control" rows="3" id="address" autocomplete="off" disabled><?=$row['address']?></textarea>
                            </div>

                            <div class="col-md-4 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>" id="Container1">
                                <label for="civilstatus" class="required">Civil Status</label>
                                <input type="text" class="form-control" value="<?=$row['civil_status']?>" id="civilstatus" disabled>
                            </div>

                            <div class="col-md-4 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>" id="Container2">
                                <label for="occupation" class="required">Occupation</label>
                                <input type="text" class="form-control" name="occupation" id="occupation" autocomplete="off" value="<?=$row['occupation']?>" disabled>
                                <div id="occupation-error"></div>
                            </div>

                            <div class="col-md-4 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>" id="Container3">
                                <label for="company" class="required">Company</label>
                                <input type="text" class="form-control" name="company" id="company" autocomplete="off" value="<?=$row['company']?>" disabled>
                                <div id="company-error"></div>
                            </div>

                            <div class="col-md-4 text-center">
                                <br>
                                <h6>Valid ID Attachment</h6> 
                                <a href="
                                    <?php
                                        if(isset($row['valid_id'])){
                                            if(!empty($row['valid_id'])){ 
                                                echo base_url . 'assets/files/attachment/' . $row['valid_id'];
                                        } else { echo base_url . 'assets/files/system/no-image.png'; } }
                                    ?>" class="glightbox d-block" data-gallery="QRCode">
                                    <img class="zoom img-fluid img-bordered-sm" id="frame1"
                                    src="
                                        <?php
                                            if(isset($row['valid_id'])){
                                                if(!empty($row['valid_id'])) {
                                                    echo base_url . 'assets/files/attachment/' . $row['valid_id'];
                                            } else { echo base_url . 'assets/files/system/no-image.png'; } }
                                        ?>
                                    " alt="image" style="height: 180px; max-width: 240px; object-fit: cover;">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
<?php include ('../includes/bottom.php'); ?>