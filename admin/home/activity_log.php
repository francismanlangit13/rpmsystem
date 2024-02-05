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
        <h1 class="mt-4">Activity Logs</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="./home" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item">Activity Logs</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Activity Logs
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Log Message</th>
                            <th>Type</th>
                            <th>By</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Log Message</th>
                            <th>Type</th>
                            <th>By</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            $i = 0;
                            $query = "SELECT *, CONCAT(`fname`, ' ', `mname`, ' ', `lname`, ' ', `suffix`) AS `fullname`,CONCAT(activity_log.type) AS activity_type, DATE_FORMAT(log_date, '%M %d, %Y %h:%i %p') as new_log_date FROM `activity_log` INNER JOIN `user` ON `user`.`user_id` = `activity_log`.`user_id` WHERE 1 ORDER BY log_date DESC";
                            $query_run = mysqli_query($con, $query);
                            if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $row){
                                    $i++
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['log_message']; ?></td>
                            <td><?= $row['activity_type']; ?></td>
                            <td><?= $row['fullname']; ?></td>
                            <td><?= $row['new_log_date']; ?></td>
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
                    <button type="submit" name="backup_db" id="backupButton" class="btn btn-success">Backup</button>
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