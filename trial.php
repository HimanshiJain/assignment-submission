
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
      body {
        padding-top: 50px;
        padding-bottom: 20px;
      }
    </style>
  </head>
  <body>



    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          
          <a class="navbar-brand" href="#"><strong>Assignment Submission System</strong></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form action="logincheck.php" method="post" class="navbar-form navbar-right">
            <input type="hidden" name="formid" value="<?php echo $_SESSION['formid']; ?>"/>
            <div class="form-group">
              <input class="form-username form-control" id="form-username" name="email" placeholder="Email" type="text">
            </div>
            <div class="form-group">
              <input class="form-password form-control" id="form-password" name="password" placeholder="Password" type="password">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <img src="images/index3.jpg" style="width:100%;">
    <div class="jumbotron">
      <div class="container text-center">
        <h1>Welcome to Assignment Submission System</h1>
      </div>
    </div>
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Students</h2>
          <p>
          <ul>
            <li>View assignments of courses enrolled</li>
            <li>Get notified by Mail Notification</li>
            <li>Submit the assignment online</li>
          </ul>
          </p>

        </div>
        <div class="col-md-4">
          <h2>Teachers</h2>
          <p>
          <ul>
            <li>Add/Delete courses</li>
            <li>Upload Assignment for Students</li>
            <li>Evaluate assignments and mark them</li>
          </ul>
          </p>
       </div>
        <div class="col-md-4">
          <h2>Admins</h2>
          <p>
          <ul>
            <li>Add Students</li>
            <li>Add Teachers</li>
            <li>Modify courses</li>
          </ul>
          </p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Divyangna Gopalka | Feroz Ahmad | Himanshi Jain</p>
      </footer>
    </div> <!-- /container -->
    <?php
      if(isset($_GET["error"]))
      { ?>
        <div class="modal fade" tabindex="-1" id="modalMsgBox" role="dialog">
          <div class="modal-dialog">    
          <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hey there!</h4>
              </div>
              <div class="modal-body">
                <div class="alert alert-danger alert-dismissible" role="alert" id="error-box"><?php echo $_GET["error"];?></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    <?php } ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.9.1.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
    <?php
      if(isset($_GET["error"]))
      { ?>
          <script type="text/javascript">
            $(window).load(function(){
              $('#modalMsgBox').modal('show');
            });
          </script>
        <?php
      }
    ?>    
  </body>
</html>
