<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Utilities Type</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./utilities_type" class="text-decoration-none">Utilities Type</a></li>
            <li class="breadcrumb-item">Edit Utilities Type</li>
        </ol>
        <?php
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM `utilities_type` WHERE `utilities_type_id` = '$id' AND `utilities_type_status` != 'Archive'";
                $sql_run = mysqli_query($con, $sql);

                if(mysqli_num_rows($sql_run) > 0) {
                    foreach($sql_run as $row){
        ?>
        <form action="utilities_type_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Utilities Type form
                                <div class="float-end">
                                    <button type="submit" name="edit_utilities_type" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                                    <input type="hidden" name="utilities_type_id" value="<?=$row['utilities_type_id']?>">
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="utilities_type_name" class="required">Utilities Type</label>
                                    <input type="text" class="form-control" placeholder="Enter Utilities Type" name="utilities_type_name" id="utilities_type_name" value="<?= $row['utilities_type_name']; ?>" required>
                                    <div id="utilities_type_name-error"></div>
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
                            <h4>Utilities Type info</h4>
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