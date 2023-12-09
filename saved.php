<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
  	<meta name="description" content="This page for logged-in users only. Logged-in users can view, edit, delete from their Favorite bockets.">

    <title>WoofSite - My Favorites</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link href="./common.css" rel="stylesheet" type="text/css" />
    <link href="./index.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="./img/favi.png" type="image/x-icon"/>
  </head>


  <body>
    <?php 
     include '_header.html';
      require_once '_db.php';

      if (isset($_GET['userID'])) {
        $userID = $_GET['userID'];
      } else {
        exit();
      }
      $result = getFavorites($userID);
      
      $desc = getDescription($userID);
      error_log(print_r($desc, true));
      $row = $desc->fetch_assoc();
      if ($row == null) {
        error_log("No desc found");
      } else {
        $description = $row['description'];
      }
    ?>

    <main class='main_bg fi-short' role='main'>
      <div id='js-login-wr' class='row sign'> 
          <span id='js-login-title' class='font_l ind_l'><span id='js-fav-name' class='font_el'></span>'s Favorites</span>
          <span id='js-signup-link-to-disable'  onclick="window.location.href='./main.php'" class='ind_l text-link pointer'>Search for more pics?</span>
          <div class='title-margin'></div>
          <form method="POST" id="js-login-form" action="">
              <label for="js-note" class="label">Description: </label><br />
              <textarea style="width: 100%; height: auto;" class="rem1 input-box textarea" id="js-note" name="note" rows="6" cols="50"><?php echo $description ?></textarea><br /><br />
              <input type="hidden" name="type" value="desc">
              <button disabled='true' id="js-update-desc-btn" onclick="updateDesc();" type="button" style="height:46px;font-size:1.2rem;" class="w100 input-box mt6">Save</button>
          </form>
      </div>
      <div id='js-dog-pics-wr' class='pic-wr'>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <div onclick="deleteFavorite('<?php echo $row['id'] ?>')" class='pic-item fi-short pointer'>
              <img class='pic' alt="<?php echo $row['id'] ?>" src='<?php echo $row['imageLink'] ?>'>
              <i class="fa fa-trash icon fi-short pointer" style="color:#B22E19;font-size:8rem;"></i>
          </div>
        <?php endwhile; ?>
      </div>



    </main>
    <?php include '_footer.html'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./js/index.js"></script>

  </body>
</html>