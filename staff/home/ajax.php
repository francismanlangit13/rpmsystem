<?php include('../includes/authentication.php'); 

    // Prepare the SQL statement with placeholders for the email, phone, and reference_number parameters
    $stmt = $con->prepare('SELECT COUNT(*) as count FROM user WHERE email = ? OR phone = ?');

    // Bind the parameters to the placeholders and execute the statement
    $stmt->bind_param('ss', $_POST['email'], $_POST['phone']);
    $stmt->execute();

    // Fetch the result as an associative array
    $result = $stmt->get_result()->fetch_assoc();

    // Return the result as JSON
    header('Content-Type: application/json');
    echo json_encode(array('exists' => ($result['count'] > 0)));
?>