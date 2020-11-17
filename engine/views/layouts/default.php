<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=MAIN_PATH?>/assets/css/bootstrap.min.css">
    <!-- custom style -->
    <link rel="stylesheet" href="<?=MAIN_PATH?>/assets/css/custom.css">
    <?= $this->_content('head');?>
    <title><?=$this->site_title()?></title>
  </head>
  <body>

    <?= $this->_content('body');?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?=MAIN_PATH?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="<?=MAIN_PATH?>/assets/js/bootstrap.min.js"></script>
  </body>
</html>
