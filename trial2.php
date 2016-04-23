
<?php
    session_start();
    require("modules/config.php");
    require("modules/functions.php");
    if(isset($_SESSION["logged_in"]))
        redirect();
    $_SESSION["formid"] = md5(rand(1,7919)*rand(1,7919));
    //1000th prime no - 7919
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="fav1.ico">

    <title>Login| Assignment Submission System</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap2.min.css" rel="stylesheet">
    <style>
    /* Move down content because we have a fixed navbar that is 50px tall */
    </style>
  </head>
  <body>
    <div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  
  
</div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.9.1.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(window).load(function(){
          $('#modalMsgBox').modal('show');
      });
    </script>
  </body>
</html>
