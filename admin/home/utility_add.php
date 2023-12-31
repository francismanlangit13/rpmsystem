<?php include ('../includes/header.php'); ?>
<head>
    <!-- Select2 CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add Other Bills</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./utility" class="text-decoration-none">Other Bills</a></li>
            <li class="breadcrumb-item">Add Other Bills</li>
        </ol>
        <form action="utility_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Other Bills form
                                <div class="float-end">
                                    <button type="submit" name="add_utility" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Select2 Example -->
                                <div class="col-md-4 mb-3">
                                    <?php
                                        $staff = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `user` INNER JOIN `property` ON property.rented_by = user.user_id WHERE `type` = 'Renter'";
                                        $staff_result = $con->query($staff);
                                    ?>
                                    <label for="renter" class="required">Rented By</label>
                                    <select class="form-control select3" id="renter" name="renter" style="width: 100%;" required>
                                        <option value="">Select Rented By</option>
                                        <?php 
                                            if ($staff_result->num_rows > 0) {
                                            while($staffrow = $staff_result->fetch_assoc()) {
                                        ?>
                                        <option value="<?=$staffrow['rented_by'];?>"><?=$staffrow['fullname'];?></option>
                                        <?php } } ?>
                                    </select>
                                    <div id="renter-error"></div>
                                </div>
                                <!-- Initialize Select2 -->
                                <script>
                                    $(document).ready(function () {
                                        // Initialize Select2 Elements
                                        $('.select3').select2();
                                    });
                                </script>

                                <div class="col-md-4 mb-3">
                                    <?php
                                        $stmt = "SELECT * FROM `utility_type` WHERE `utility_type_id` != '1' AND `utility_type_status` != 'Archive'";
                                        $stmt_run = mysqli_query($con,$stmt);
                                    ?>
                                    <label for="utility_type_id" class="required">Utility Type</label>
                                    <select class="form-control" id="utility_type_id" name="utility_type_id" required>
                                        <option value="">Select Utility Type</option>
                                        <?php
                                            // use a while loop to fetch data
                                            while ($utility_type = mysqli_fetch_array($stmt_run,MYSQLI_ASSOC)):;
                                        ?>
                                            <option value="<?= $utility_type["utility_type_id"]; ?>"><?= $utility_type["utility_type_name"]; ?></option>
                                        <?php
                                            endwhile; // While loop must be terminated
                                        ?>
                                    </select>
                                    <div id="utility_type_id-error"></div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="utility_amount" class="required">Bill Amount</label>
                                    <input type="text" class="form-control" placeholder="Enter Utility Amount" name="utility_amount" id="utility_amount" required>
                                    <div id="utility_amount-error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<?php include ('../includes/bottom.php'); ?>