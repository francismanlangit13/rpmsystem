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
                $sql = "SELECT *, DATE_FORMAT(birthday, '%M %d, %Y') as new_birthday FROM `user` WHERE `user_id` = '$id' AND `status` != 'Archive'";
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
                            <div class="col-md-3 mb-3">
                                <label for="fname"><b>First Name</b></label>
                                <input type="text" class="form-control-plaintext" value="<?=$row['fname']?>" id="fname" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="mname"><b>Middle Name</b></label>
                                <input type="text" class="form-control-plaintext" value="<?=$row['mname']?>" id="mname" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="lname"><b>Last Name</b></label>
                                <input type="text" class="form-control-plaintext" value="<?=$row['lname']?>" id="lname" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="suffix"><b>Suffix</b></label>
                                <input type="text" class="form-control-plaintext" value="<?=$row['suffix']?>" id="suffix" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="gender"><b>Gender</b></label>
                                <input type="text" class="form-control-plaintext" value="<?=$row['gender']?>" id="gender" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="civil_status"><b>Civil Status</b></label>
                                <input type="text" class="form-control-plaintext" value="<?=$row['civil_status']?>" id="civil_status" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="birthday"><b>Birthday</b></label>
                                <input type="text" class="form-control-plaintext" value="<?=$row['new_birthday']?>" id="birthday" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="email"><b>Email</b></label>
                                <input type="text" class="form-control-plaintext" value="<?=$row['email']?>" id="email" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="phone"><b>Phone Number</b></label>
                                <input type="text" class="form-control-plaintext" value="<?=$row['phone']?>" id="phone" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="role"><b>Role</b></label>
                                <input type="text" class="form-control-plaintext" value="<?php if($row['type'] == 'Renter'){ echo"Rentee";} else{ echo $row['type']; } ?>" id="role" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="status"><b>Status</b></label>
                                <input type="text" class="form-control-plaintext" value="<?=$row['status']?>" id="status" disabled>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="address"><b>Address</b></label>
                                <textarea type="text" class="form-control-plaintext" rows="3" id="address" autocomplete="off" disabled><?=$row['address']?></textarea>
                            </div>

                            <div class="col-md-4 text-center">
                                <h6><b>Valid ID Attachment</b></h6> 
                                <a href="
                                    <?php
                                        if(!empty($row['valid_id'])){ 
                                            echo base_url . 'assets/files/attachment/' . $row['valid_id'];
                                        } else { echo base_url . 'assets/files/system/no-image.png'; }
                                    ?>" class="glightbox d-block" data-gallery="QRCode">
                                    <img class="zoom img-fluid img-bordered-sm" id="frame1"
                                    src="
                                        <?php
                                            if(!empty($row['valid_id'])) {
                                                echo base_url . 'assets/files/attachment/' . $row['valid_id'];
                                            } else { echo base_url . 'assets/files/system/no-image.png'; } 
                                        ?>
                                    " alt="image" style="height: 180px; max-width: 240px; object-fit: cover;">
                                </a>
                            </div>

                            <div class="col-md-4 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>">
                                <label for="occupation"><b>Occupation</b></label>
                                <input type="text" class="form-control-plaintext" id="occupation" autocomplete="off" value="<?=$row['occupation']?>" disabled>
                                <div class="row">
                                    <div class="col-md-12 mt-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>">
                                        <?php
                                            $used_property = $row['property_id'];
                                            $property = "SELECT * FROM `property` INNER JOIN `property_type` ON `property`.`property_type_id` = `property_type`.`property_type_id`  WHERE `property`.`property_id` = '$used_property'";
                                            $property_result = $con->query($property);
                                            $propertyrow = $property_result->fetch_assoc()
                                        ?>
                                        <label for="property"><b>Property</b></label>
                                        <textarea type="text" class="form-control-plaintext" id="property"><?=$propertyrow['property_unit_code'];?> (Purok <?=$propertyrow['property_purok'];?>, <?=$propertyrow['property_barangay'];?>, <?=$propertyrow['property_city'];?> <?=$propertyrow['property_zipcode'];?>) <?=$propertyrow['property_type_name'];?></textarea>
                                        <div class="row">
                                            <div class="col-md-6 mt-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>">
                                                <label for="cash_advance"><b>Cash Advance</b></label>
                                                <input type="number" class="form-control-plaintext" id="cash_advance" value="<?=$row['cash_advance']?>" disabled>
                                            </div>

                                            <div class="col-md-6 mt-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>">
                                                <label for="cash_deposit"><b>Cash Deposit</b></label>
                                                <input type="number" class="form-control-plaintext" id="cash_deposit" value="<?=$row['cash_deposit']?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>">
                                <label for="company"><b>Company</b></label>
                                <input type="text" class="form-control-plaintext" id="company" autocomplete="off" value="<?=$row['company']?>" disabled>
                                <div class="row">
                                    <div class="col-md-6 mt-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>">
                                        <label for="startrent"><b>Start Rent</b></label>
                                        <input type="date" class="form-control-plaintext" id="startrent" value="<?=$row['startrent']?>" disabled>
                                    </div>

                                    <div class="col-md-6 mt-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>">
                                        <label for="endrent"><b>End Rent</b></label>
                                        <input type="date" class="form-control-plaintext" id="endrent" value="<?=$row['endrent']?>" disabled>
                                    </div>

                                    <div class="col-md-12 mt-3 <?php if($row['type'] != 'Renter'){ echo "d-none";} ?>">
                                        <?php
                                            $used_property = $row['property_id'];
                                            $property_result = $con->query("SELECT property.user_id FROM `property` WHERE `property_id` = '$used_property'");
                                            $staff_user_id = $property_result->fetch_assoc();
                                            $staff_id = $staff_user_id['user_id'];

                                            $stmt_result = $con->query("SELECT CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS staff_fullname FROM `user` WHERE `user_id` = $staff_id ");
                                            $new_row = $stmt_result->fetch_assoc();
                                        ?>
                                        <label for="landlady_landlord"><b>Landlady / Landlord</b></label>
                                        <input type="text" class="form-control-plaintext" id="landlady_landlord" value="<?=$new_row['staff_fullname']?>" disabled>
                                    </div>
                                </div>
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