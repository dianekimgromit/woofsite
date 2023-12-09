<?php 
  require_once '_db.php';
  
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['dogId'])) {
      error_log("**" . $_GET['dogId']);
      $dogId = $_GET['dogId'];
    }
    if (isset($_GET['userID'])) {
      $userID = $_GET['userID'];
    }

    $response = deleteFavorite($dogId, $userID);
    error_log("--res" . $response);
    if ($response == 1) {
      echo "Success";
    } else if (strpos($response, "Duplicate") !== false) {
      echo "Duplicate";
    } else {
      echo "Error";
    }
  }
?>

