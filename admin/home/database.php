<?php include ('../includes/header.php'); ?>
<style type="text/css">
    #datatablesSimple th:nth-child(7) {
        width: 15% !important;
    }
    .table th, .table td {
        white-space: nowrap;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Backup and Restore
            <button class="btn btn-success btn-icon-split float-end mt-2" data-toggle="modal" data-target="#Modal_backupDB"> 
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Backup Database</span>
            </button>
        </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="./home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Backup and Restore</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Backup and Restore
                <div class="float-end">
                    <button class="btn btn-dark btn-icon-split float-end mt-2" data-toggle="modal" data-target="#Modal_uploadDB"> 
                        <span class="icon text-white-50">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="text">Upload Database</span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Database Name</th>
                            <th>Database Date</th>
                            <th>Status</th>
                            <th>Buttons</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Database Name</th>
                            <th>Database Date</th>
                            <th>Status</th>
                            <th>Buttons</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $i = 0;
                            $query = "SELECT *, DATE_FORMAT(database_date, '%M %d, %Y %h:%i %p') as new_database_date FROM `database_mgmt` WHERE `database_status` != 'Archive'";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $row){
                                    $i++
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['database_name']; ?></td>
                            <td><?= $row['new_database_date']; ?></td>
                            <td><?= $row['database_status']; ?></td>
                            <td>
                                <div class="d-flex">
                                    <div class="col-md-6" style="margin-right: 0.05rem">
                                        <button type="button" class="btn btn-info btn-icon-split" data-toggle="modal" value="<?=$row['database_name']; ?>" data-target="#Modal_restoreDB" onclick="restoreModal(this)" title="Restore">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash-restore"></i>
                                            </span>
                                            <span class="text"></span>
                                        </button>
                                    </div>
                                    <div class="col-md-6" style="margin-right: 0.05rem">
                                        <button type="button" class="btn btn-primary btn-icon-split" value="<?=$row['database_name']; ?>" onclick="downloadDB(this)" title="Download">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-download"></i>
                                            </span>
                                            <span class="text"></span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php } } else{ } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- Modal Database Backup -->
<div class="modal fade" id="Modal_backupDB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Save changes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to perform a backup database?
            </div>
            <div class="modal-footer">
                <form action="database_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="backup_db" id="backupButton" class="btn btn-success">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Database Restore -->
<div class="modal fade" id="Modal_restoreDB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Save changes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to perform a restore database?
            </div>
            <div class="modal-footer">
                <form action="database_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="hidden" id="filename" name="db_filename">
                    <button type="submit" name="restore_db" id="restoreButton" class="btn btn-success">Restore</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Database Restore Manual -->
<div class="modal fade" id="Modal_uploadDB" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Database (Manual)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="database_code.php" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Database</label>
                        <input type="file" class="form-control" id="exampleFormControlFile1" name="db_file_upload" required>
                        <i class="text-danger">Warning upload wrong database file may crash the system.</i>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="upload_db" id="uploadButton" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function downloadDB(button) {
        var base_url = "<?php echo base_url ?>"; // Make sure to replace this with your actual base URL
        var databaseName = button.value; // Replace with your actual database name
        var downloadUrl = base_url + 'assets/files/database/' + databaseName;

        // Create a temporary anchor element for the download
        var downloadLink = document.createElement("a");
        downloadLink.href = downloadUrl;
        downloadLink.download = databaseName;

        // Append the link to the body and trigger the click event
        document.body.appendChild(downloadLink);
        downloadLink.click();

        // Remove the link from the body after the download starts
        document.body.removeChild(downloadLink);
    }
</script>

<!-- JavaScript for restore database get filename -->
<script>
    function restoreModal(button) {
        var filename = button.value;
        document.getElementById("filename").value = filename;
    }
</script>
<?php include ('../includes/bottom.php'); ?>