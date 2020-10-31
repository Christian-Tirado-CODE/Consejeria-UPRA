<?php
include_once 'connection.php';
session_start();

// Here we create a variable that calls the prepare() method of the database object
// The SQL query you want to run is entered as the parameter, and placeholders are written like this :placeholder_name

$stmt = $conn->prepare("INSERT INTO expediente (id_fijo, id_especial, nota_c, estatus_c, año_aprobo_c, convalidación_c, equivalencia_c, créditos_C_E, estatus_R) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Now we tell the script which variable each placeholder actually refers to using the bindParam() method
// First parameter is the placeholder in the statement above - the second parameter is a variable that it should refer to



$stmt->bind_param('iisisssii', $_SESSION['id_est'], $meetingDate);





// Execute the query using the data we just defined
// The execute() method returns TRUE if it is successful and FALSE if it is not, allowing you to write your own messages here
if ($stmt->execute()) {
     header('Location: ../est_profile.php');
} else {
  echo "Unable to create record";
}


	$stmt->close();

?>