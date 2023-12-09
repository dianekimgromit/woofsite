<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
  	<meta name="description" content="Woofsite allows people to search dog pictures and save them to their unique username. Dog pictures are fetched from https://api.thedogapi.com rest api.">
    
    <title>WoofSite</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link href="./common.css" rel="stylesheet" type="text/css" />
    <link href="./index.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="./img/favi.png" type="image/x-icon"/>
  </head>
  <body>
    <?php include '_header.html'; ?>

    <main class='main_bg fi-short' role='main'>
      <div class='row'> 
        <p id='js-message-title' class='font_l ind_l title-margin'>Search for Dog's pictures</p>
        <div id='js-dog-pics-wr' class='pic-wr'>
        </div>
        <div id='js-search-wr' style="margin: 24px 5%;">
            <label style="font-size:1.2rem;margin-right: 18px;" for="js-breed">Type a breed name (e.g., poodle) : </label>
            <input type="text" class="search-input input-box mt6" id="js-breed" name="breed"><BR /><BR />
            </div>
        <div id='js-breed-list-title' class='r border-bottom'>
            <div style="text-align: center" class="c1 li_title">Breed</div>
            <div class="c2 li_title">Temperament</div>
        </div>
        <div id="js-breed-list" style="margin-top: 12px;">
        </div>
      </div>
    </main>

    <?php include '_footer.html'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./js/breeds.js"></script>
    <script type="text/javascript" src="./js/index.js"></script>

  </body>
</html>