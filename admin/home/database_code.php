<?php
    if (!defined('DB_SERVER')){
        include ('../includes/authentication.php');
        $user_id = $_SESSION['auth_user']['user_id'];
        // DB connection parameters
        $host = DB_SERVER;
        $user = DB_USERNAME;
        $password = DB_PASSWORD;
        $db = DB_NAME;
        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        try{
           $conn = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $e){
           echo $e->getMessage();
        }
    }

    // Backup Database
    if(isset($_POST["backup_db"])){
        $db_date = date;
        $con->set_charset("utf8");

        // Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }

        $sqlScript = "";
        foreach ($tables as $table) {
            
            // Prepare SQLscript for creating table structure
            $query = "SHOW CREATE TABLE $table";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_row($result);
            
            $sqlScript .= "\n\n" . $row[1] . ";\n\n";
            
            
            $query = "SELECT * FROM $table";
            $result = mysqli_query($con, $query);
            
            $columnCount = mysqli_num_fields($result);
            
            // Prepare SQLscript for dumping data for each table
            for ($i = 0; $i < $columnCount; $i ++) {
                while ($row = mysqli_fetch_row($result)) {
                    $sqlScript .= "INSERT INTO $table VALUES(";
                    for ($j = 0; $j < $columnCount; $j ++) {
                        $row[$j] = $row[$j];
                        
                        if (isset($row[$j])) {
                            $sqlScript .= '"' . $row[$j] . '"';
                        } else {
                            $sqlScript .= '""';
                        }
                        if ($j < ($columnCount - 1)) {
                            $sqlScript .= ',';
                        }
                    }
                    $sqlScript .= ");\n";
                }
            }
            
            $sqlScript .= "\n"; 
        }

        if(!empty($sqlScript)){
            $status = 'Backup successful';
            // Save the SQL script to a backup file in the backups / directory
            $db_filename = DB_NAME . '_backup_' . date('Ymd_His') . '.sql';
            $backup_file_name = base_app.'assets/files/database/' . $db_filename ;
            $fileHandler = fopen($backup_file_name, 'w+');
            $number_of_lines = fwrite($fileHandler, $sqlScript);
            fclose($fileHandler);
        } else {
            $status = 'Backup failed';
        }

        $query = "INSERT INTO `database_mgmt`(`database_name`, `database_date`, `database_status`) VALUES ('$db_filename','$db_date','$status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['status'] = "Backup database successfully";
            $_SESSION['status_code'] = "success";
            header("Location: " . base_url . "admin/home/database");
            exit(0);
        }
        else{
            $_SESSION['status'] = "Backup database was not added";
            $_SESSION['status_code'] = "error";
            header("Location: " . base_url . "admin/home/database");
            exit(0);
        }
    }

    // Restore Database
    function restoreMysqlDB($filePath, $con){
        $sql = '';
        $error = '';

        if (!file_exists($filePath)) {
            $_SESSION['status'] = "Database file not found";
            $_SESSION['status_code'] = "warning";
            header("Location: " . base_url . "admin/home/database");
            exit(0);
        }

        // Disable foreign key checks
        mysqli_query($con, "SET FOREIGN_KEY_CHECKS=0");

        // SQL query to drop all tables
        $qry = "SHOW TABLES";
        $result = mysqli_query($con, $qry);
    
        while ($row = mysqli_fetch_row($result)) {
            $tableName = $row[0];
            
            // Exclude 'database_mgmt' table
            if ($tableName !== 'database_mgmt') {
                $qry = "DROP TABLE IF EXISTS $tableName";
                mysqli_query($con, $qry);
            }
        }

        // Enable foreign key checks
        mysqli_query($con, "SET FOREIGN_KEY_CHECKS=0");
    
        if(file_exists($filePath)) {
            $lines = file($filePath);
        
            foreach ($lines as $line) {
        
                // Ignoring comments from the SQL script
                if (substr($line, 0, 2) == '--' || $line == '') {
                    continue;
                }
        
                $sql .= $line;
        
                if (substr(trim($line), - 1, 1) == ';') {
                    $result = mysqli_query($con, $sql);
                    if (! $result) {
                        $error .= mysqli_error($con) . "\n";
                    }
                    $sql = '';
                }
            } // end foreach
        }

        if (!$result) {
            $_SESSION['status'] = "Database restore failed";
            $_SESSION['status_code'] = "error";
        } else {
            $_SESSION['status'] = "Database restore completed successfully";
            $_SESSION['status_code'] = "success";
            exec('rm ' . $filePath);
        }

        header("Location: " . base_url . "admin/home/database");
        exit(0);
    }

    if (isset($_POST["restore_db"])) {
        $db_filename = $_POST['db_filename'];
        restoreMysqlDB(base_app.'assets/files/database/'.$db_filename, $con);
    }

    function uploadMysqlDB($filePath, $con){
        $sql = '';
        $error = '';

        if (!file_exists($filePath)) {
            $_SESSION['status'] = "Database file not found";
            $_SESSION['status_code'] = "warning";
            header("Location: " . base_url . "admin/home/database");
            exit(0);
        }

        // Disable foreign key checks
        mysqli_query($con, "SET FOREIGN_KEY_CHECKS=0");

        // SQL query to drop all tables
        $qry = "SHOW TABLES";
        $result = mysqli_query($con, $qry);

        while ($row = mysqli_fetch_row($result)) {
            $tableName = $row[0];
            
            // Exclude 'database_mgmt' table
            if ($tableName !== 'database_mgmt') {
                $qry = "DROP TABLE IF EXISTS $tableName";
                mysqli_query($con, $qry);
            }
        }

        // Disable foreign key checks
        mysqli_query($con, "SET FOREIGN_KEY_CHECKS=0");

        if(file_exists($filePath)) {
            $lines = file($filePath);

            foreach ($lines as $line) {

                // Ignoring comments from the SQL script
                if (substr($line, 0, 2) == '--' || $line == '') {
                    continue;
                }

                $sql .= $line;
        
                if (substr(trim($line), - 1, 1) == ';') {
                    $result = mysqli_query($con, $sql);
                    if (! $result) {
                        $error .= mysqli_error($con) . "\n";
                    }
                    $sql = '';
                }
            } // end foreach
        
            if (!$result) {
                $_SESSION['status'] = "Database restore failed";
                $_SESSION['status_code'] = "error";
            } else {
                unlink($filePath);
                $_SESSION['status'] = "Database restore completed successfully";
                $_SESSION['status_code'] = "success";
                exec('rm ' . $filePath);
            }
        }

        header("Location: " . base_url . "admin/home/database");
        exit(0);
    }

    if (isset($_POST["upload_db"])) {
        if (! empty($_FILES)) {
            // Validating SQL file type by extensions
            if (! in_array(strtolower(pathinfo($_FILES["db_file_upload"]["name"], PATHINFO_EXTENSION)), array("sql"))){
                $response = array(
                    "type" => "error",
                    "message" => "Invalid File Type"
                );
            } else{
                if (is_uploaded_file($_FILES["db_file_upload"]["tmp_name"])) {
                    move_uploaded_file($_FILES["db_file_upload"]["tmp_name"],'../../assets/files/database/uploads/'.$_FILES["db_file_upload"]["name"]);
                    $response = uploadMysqlDB(base_app.'assets/files/database/uploads/'.$_FILES["db_file_upload"]["name"], $con);
                }
            }
        }
    }
?>