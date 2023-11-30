<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add Utilities Type</h1>
        <ol class="breadcrumb mb-4 mt-3">
            <li class="breadcrumb-item active"><a href="../home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="./utilities_type" class="text-decoration-none">Utilities Type</a></li>
            <li class="breadcrumb-item">Add Utilities Type</li>
        </ol>
        <form action="utilities_type_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Utilities Type form
                                <div class="float-end">
                                    <button type="submit" name="add_utilities_type" class="btn btn-primary"><i class="fas fa-plus"></i> Add</button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="utilities_type_name" class="required">Utilities Type</label>
                                    <input type="text" class="form-control" placeholder="Enter Utilities Type" name="utilities_type_name" id="utilities_type_name" required>
                                    <div id="utilities_type_name-error"></div>
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