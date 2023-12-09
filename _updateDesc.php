<?php 
  require_once '_db.php';
  
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['userID'])) {
      $userID = $_GET['userID'];
    }
    if (isset($_GET['desc'])) {
      $desc = $_GET['desc'];
    }
    $desc = htmlspecialchars($desc);

    $response = updateDesc($userID, $desc);
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

