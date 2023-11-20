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
                $sql = "SELECT * FROM `user` WHERE `user_id` = '$id' AND `status` != 'Archive' AND `type` != 'Renter'";
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
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" value="<?=$row['fname']?>" id="fname" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="mname">Middle Name</label>
                                <input type="text" class="form-control" value="<?=$row['mname']?>" id="mname" disabled>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" value="<?=$row['lname']?>" id="lname" disabled>
                            </div>

                            <!-- <div class="col-md-3 mb-3">
                                <label for="suffix">Suffix</label>
                                <input type="text" class="form-control" value="<?=$row['suffix']?>" id="suffix" disabled>
                            </div> -->

                            <div class="col-md-3 mb-3">
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
                                <input type="text" class="form-control" value="<?=$row['type']?>" id="role" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" value="<?=$row['status']?>" id="status" disabled>
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