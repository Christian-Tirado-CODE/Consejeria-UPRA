<?php
session_start();
if (isset($_POST['confirm-submit'])) {
require 'dbconnect.php';
    $stdnt_number = $_SESSION['stdnt_number'];
    $ids = (isset($_POST['crse_label'])) ? $_POST['crse_label'] : array();
    $clase = mysqli_real_escape_string($conn, $_POST['clase']);
  
    if (count($ids) > 0) { 
      foreach ($ids as $crse_label) {          
        if($clase == 'general'){
          $sql = "UPDATE student_record SET crse_status = 4 WHERE stdnt_number = '$stdnt_number' AND crse_label = $crse_label";
                  // Prepare statement
                  $stmt = $conn->prepare($sql);
                  // execute the query
                  $stmt->execute();
        }elseif($clase == 'HUMA'){
          $sql = "UPDATE counseling_special_details SET crse_confirmation = 1 WHERE stdnt_number = '$stdnt_number' AND crse_label = $crse_label";
                  // Prepare statement
                  $stmt = $conn->prepare($sql);
                  // execute the query
                  $stmt->execute();
        }elseif($clase == 'CISO'){
          $sql = "UPDATE counseling_special_details SET crse_confirmation = 1 WHERE stdnt_number = '$stdnt_number' AND crse_label = $crse_label";
                  // Prepare statement
                  $stmt = $conn->prepare($sql);
                  // execute the query
                  $stmt->execute();
        }elseif($clase == 'FREE'){
          $sql = "UPDATE counseling_special_details SET crse_confirmation = 1 WHERE stdnt_number = '$stdnt_number' AND crse_label = $crse_label";
                  // Prepare statement
                  $stmt = $conn->prepare($sql);
                  // execute the query
                  $stmt->execute();
        }elseif($clase == 'DEP'){
          $sql = "UPDATE counseling_special_details SET crse_confirmation = 1 WHERE stdnt_number = '$stdnt_number' AND crse_label = $crse_label";
                  // Prepare statement
                  $stmt = $conn->prepare($sql);
                  // execute the query
                  $stmt->execute();
        }
        
                  //exit
      }
      header("Location: ../consejeria.php");
                  exit();
    }
   
    
}
?>