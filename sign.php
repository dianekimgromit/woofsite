<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
  	<meta name="description" content="This page allow a new user to sign up or an existiner user to log in. Once a user is logged in, the user can navigate other sites without re-logging in.">

    <title>WoofSite: Sign up / Log in</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link href="./common.css" rel="stylesheet" type="text/css" />
    <link href="./index.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="./img/favi.png" type="image/x-icon"/>
  </head>


  <body>
    <?php include '_header.html'; ?>      

    <?php 
      require_once '_db.php';

      $email = '';
      $fname = '';
      $lname = '';
      $password = '';
      $error = '';
      $type = '';

      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
        if (isset($_POST['type'])) {
          $type = $_POST['type'];
        }
        if (isset($_POST['email'])) {
          $email = $_POST['email'];
        }
        if (isset($_POST['fname'])) {
          $fname = $_POST['fname'];
        }
        if (isset($_POST['lname'])) {
          $lname = $_POST['lname'];
        }
        if (isset($_POST['password'])) {
          $password = $_POST['password'];
        }

        if ($type == 'signup') {
          $result = signUp($email, $fname, $lname, $password);
          if ($result != 1) {
            $error = "Signup Failed " . $result;
          }
        } else if ($type == 'login') {
          $result = logIn($email);
          $row = $result->fetch_assoc();
          if ($row == null) {
            $error = 'Log In Failed. Please try again.';
          } else if ($row['password'] == $password) {
            $userID = $row['userID'];
            $fname = $row['fname'];
            addHistory($userID, $fname . " logged in");
            echo "<script>
                    localStorage.setItem('userID', '$userID');
                    localStorage.setItem('fname', '$fname');
                    window.location.href='./saved.php?userID=$userID';
                  </script>";
          } else {
            $error = 'Log In Failed. Please try again.';
          }
        }

      }      
    ?>

    <main class='main_bg fi-short' role='main'>
      <div id='js-signup-wr' class='row sign hidden'> 
          <span id='js-message-title' class='font_l ind_l'>Sign up</span>
          <span onclick='handleLoginClick()' class='ind_l text-link pointer'>Already registered? Please log in here</span>
          <div class='title-margin'></div>
          <form method="POST" id="js-signup-form" class="form-wr" action="">
              <label for="email">Email</label><BR />
              <input type="email" class="w100 input-box mt6" id="email" name="email" required><BR /><BR />
              
              <label for="fname">First Name</label><BR />
              <input type="text" class="w100 input-box mt6" id="fname" name="fname" required><BR /><BR />

              <label for="lname">Last Name</label><BR />
              <input type="text" class="w100 input-box mt6" id="lname" name="lname" required><BR /><BR />
              
              <label for="password">Password</label><BR />
              <input type="password" class="w100 input-box mt6" id="password" name="password" required><BR /><BR />
              
              <label for="confirmPassword">Confirm Password</label><BR />
              <input type="password" class="w100 input-box mt6" id="confirmPassword" name="confirmPassword" required><BR /><BR />
              
              <label>
                  <input type="checkbox" id="agreement" name="agreement">
                  I have read and agree to all terms and conditions of WoofSite.
              </label><BR /><BR /><BR />
              <input type="hidden" name="type" value="signup">
              <button id="js-signup-submit-btn" type="submit" class="btn-red w100 input-box mt6 pointer">Create Account</button>
          </form>
      </div>
      <div id='js-login-wr' class='row sign'> 
      <span style="color: #B22E19; " class="text-link">Demo account: demo/123</span><BR /><BR />
        
          <span id='js-login-title' class='font_l ind_l'>Log In</span>
          <span id='js-signup-link-to-disable'  onclick='handleSignupClick()' class='ind_l text-link pointer'>Not a member yet? Please sign up here</span>
          <div class='title-margin'></div>
          <form method="POST" id="js-login-form" class="form-wr" action="">
            <label for="l-email">Email or Username</label><BR />
            <input type="text" class="w100 input-box mt6" id="l-email" placeholder="demo" name="email" required><BR /><BR />
            <label for="l-password">Password</label><BR />
            <input type="password" class="w100 input-box mt6" id="l-password" placeholder="123" name="password" required><BR /><BR /><BR />
            <input type="hidden" name="type" value="login">
            <button id="js-login-submit-btn" type="submit" class="btn-red w100 input-box mt6 pointer">Log In</button>
          </form>
      </div>


    </main>
    <?php include '_footer.html'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./js/index.js"></script>
    <?php 
      if ($type == 'signup' && $error == '') {
        error_log(": re" . $result);
        echo "<script>
                document.getElementById('js-signup-wr').classList.add('hidden');
                document.getElementById('js-login-wr').classList.remove('hidden');
                document.getElementById('js-signup-link-to-disable').classList.add('hidden');
                document.getElementById('js-login-title').innerHTML = 'Sign Up Success! Please Log in.';
              </script>";
      }

      if ($error != '') {
        echo "<script>renderError('" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "');</script>";
      }
    ?>
  </body>
</html>