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
        <h1 class="mt-4">Notification</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Notification</li>
        </ol>
        <form action="notification_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Notification form
                                <div class="float-end">
                                    <button type="submit" name="send_notification" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Send</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- Select2 Example -->
                            <div class="col-md-5 mb-3">
                                <?php
                                    $user_id = $_SESSION['auth_user']['user_id'];
                                    $staff = "SELECT *, CONCAT(fname, ' ', mname, ' ', lname, ' ', suffix) AS fullname FROM `property` INNER JOIN `user` ON property.rented_by = user.user_id WHERE property.user_id = '$user_id' AND `type` = 'Renter' AND `status` != 'Archive'";
                                    $staff_result = $con->query($staff);
                                ?>
                                <label for="renter" class="required">Rented By</label>
                                <select class="form-control select3" id="renter" name="renter" style="width: 100%;" required>
                                    <option value="">Select Rented By</option>
                                    <option value=" ">None</option>
                                    <?php 
                                        if ($staff_result->num_rows > 0) {
                                        while($staffrow = $staff_result->fetch_assoc()) {
                                    ?>
                                    <option value="<?=$staffrow['user_id'];?>"><?=$staffrow['fullname'];?></option>
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

                            <div class="col-md-12 mb-3">
                                <label for="body" class="required">Body</label>
                                <textarea type="text" class="form-control" placeholder="Enter Body" name="body" id="body" required></textarea>
                                <div id="body-error"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<script>
    document.getElementById('property_status').addEventListener('change', function () {
        var dateContainer = document.getElementById('dateContainer');
        var propertyDate = document.getElementById('property_date');

        if (this.value === 'Rented') {
            dateContainer.classList.remove('d-none');
            propertyDate.required = true;
        } else {
            dateContainer.classList.add('d-none');
            propertyDate.required = false;
        }
    });
</script>
<?php include ('../includes/bottom.php'); ?>