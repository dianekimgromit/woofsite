<?php 
  // PLEASE EDIT DB ENV SETTINGS
  $host = "";
  $db = "";
  $user = ""; 
  $pass = "";

  function addHistory($userID, $action) {
    global $host, $user, $pass, $db;
    $sql = "INSERT INTO History (userID, date, action) VALUES ($userID, NOW(), '$action')";

    try {
      $mysqli = new mysqli($host, $user, $pass, $db);
      $result = $mysqli->query($sql);
      return $result;
    } catch (mysqli_sql_exception $e) {
      $error = $e->getMessage();
      error_log("An error occurred: " . $error);
      return $error;
    } catch (Error $e) {
      echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
      echo "Exception: " . $e->getMessage();
    } finally {
      if (isset($mysqli)) {
        $mysqli->close();
      }
    }
  }

  function signUp($email, $fname, $lname, $password) {
    global $host, $user, $pass, $db;
    $sql = "INSERT INTO Users (email, fname, lname, password, description) VALUES ('$email', '$fname', '$lname', '$password', 'Please update this description')";

    $mysqli = null;
    try {
      $mysqli = new mysqli($host, $user, $pass, $db);
      $result = $mysqli->query($sql);
      return $result;
    } catch (mysqli_sql_exception $e) {
      $error = $e->getMessage();
      return $error;
      error_log("An error occurred: " . $error);
    } catch (Error $e) {
      echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
      echo "Exception: " . $e->getMessage();
    } finally {
      if (isset($mysqli)) {
        $mysqli->close();
      }
    }
  }

  function logIn($email) {
    global $host, $user, $pass, $db;
    $sql = "SELECT userID, email, fname, password
              FROM Users 
              WHERE email = '$email'";
    $mysqli = null;
    try {
      $mysqli = new mysqli($host, $user, $pass, $db);
      $result = $mysqli->query($sql);
      return $result;
    } catch (mysqli_sql_exception $e) {
      // Handle specific MySQLi exceptions
      $error = $e->getMessage();
      return $error;
      error_log("An error occurred: " . $error);
    } catch (Error $e) {
      echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
      echo "Exception: " . $e->getMessage();
    } finally {
      if (isset($mysqli)) {
        $mysqli->close();
      }
    }

  }

  function getFavorites($userID) {
    global $host, $user, $pass, $db;
    $sql = "SELECT id, imageLink
              FROM SavedImages 
              WHERE userID = '$userID'";
    $mysqli = null;
    try {
      $mysqli = new mysqli($host, $user, $pass, $db);
      $result = $mysqli->query($sql);
      return $result;
    } catch (mysqli_sql_exception $e) {
      $error = $e->getMessage();
      return $error;
      error_log("An error occurred: " . $error);
    } catch (Error $e) {
      echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
      echo "Exception: " . $e->getMessage();
    } finally {
      if (isset($mysqli)) {
        $mysqli->close();
      }
    }
  }

  function addFavorite($id, $userID, $imageLink) {
    global $host, $user, $pass, $db;
    $sql = "INSERT INTO SavedImages (id, userID, imageLink) VALUES ('$id', '$userID', '$imageLink')";

    $mysqli = null;
    try {
      $mysqli = new mysqli($host, $user, $pass, $db);
      $result = $mysqli->query($sql);
      addHistory($userID, "Favorite added - ID: " . $id);

      return $result;
    } catch (mysqli_sql_exception $e) {
      $error = $e->getMessage();
      error_log("An error occurred: " . $error);
      return $error;
    } catch (Error $e) {
      echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
      echo "Exception: " . $e->getMessage();
    } finally {
      if (isset($mysqli)) {
        $mysqli->close();
      }
    }
  }

  function updateDesc($userID, $desc) {
    global $host, $user, $pass, $db;
    $sql = "UPDATE Users SET description='$desc' WHERE userID=$userID";

    $mysqli = null;
    try {
      $mysqli = new mysqli($host, $user, $pass, $db);
      $result = $mysqli->query($sql);
      addHistory($userID, "Description updated to " . $desc);
      return $result;
    } catch (mysqli_sql_exception $e) {
      // Handle specific MySQLi exceptions
      $error = $e->getMessage();
      error_log("An error occurred: " . $error);
      return $error;
    } catch (Error $e) {
      echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
      echo "Exception: " . $e->getMessage();
    } finally {
      if (isset($mysqli)) {
        $mysqli->close();
      }
    }
  }

  function deleteFavorite($id, $userID) {
    global $host, $user, $pass, $db;
    $sql = "DELETE FROM SavedImages WHERE id='$id' AND userID=$userID";
    error_log("--" . $sql);

    $mysqli = null;
    try {
      $mysqli = new mysqli($host, $user, $pass, $db);
      $result = $mysqli->query($sql);
      addHistory($userID, "Favorite deleted - ID: " . $id);
      return $result;
    } catch (mysqli_sql_exception $e) {
      $error = $e->getMessage();
      error_log("An error occurred: " . $error);
      return $error;
    } catch (Error $e) {
      echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
      echo "Exception: " . $e->getMessage();
    } finally {
      if (isset($mysqli)) {
        $mysqli->close();
      }
    }
  }

  function getDescription($userID) {
    global $host, $user, $pass, $db;
    $sql = "SELECT description
              FROM Users 
              WHERE userID = $userID";
    $mysqli = null;
    try {
      $mysqli = new mysqli($host, $user, $pass, $db);
      $result = $mysqli->query($sql);
      return $result;
    } catch (mysqli_sql_exception $e) {
      $error = $e->getMessage();
      return $error;
      error_log("An error occurred: " . $error);
    } catch (Error $e) {
      echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
      echo "Exception: " . $e->getMessage();
    } finally {
      if (isset($mysqli)) {
        $mysqli->close();
      }
    }
  }

?>