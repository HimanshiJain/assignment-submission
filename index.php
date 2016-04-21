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
<html>
<head>
    <meta charset="UTF-8">

    <title>Login| Assignment Submission System</title>
    <link href="css/normalize.css" rel="stylesheet">
    <link href=
    'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'
    rel='stylesheet prefetch'>
    <link crossorigin="anonymous" href=
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity=
    "sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
    rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <script crossorigin="anonymous" integrity=
    "sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
    src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
    </script>

    <div class="container">
        <div style="margin-top: 10%">
            <?php
                if(isset($_GET["error"]))
                {
                    echo "<div class=\"alert alert-danger alert-dismissible\" role=\"alert\" id=\"error-box\">".$_GET["error"]."</div>";
                }
            ?>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 form-box">
                <div class="form-top">
                    <div>
                        <h3>Login to Assignment Submission System</h3>
                        <p>Enter your email and password to log in</p>
                    </div>
                </div>
                <div class="form-bottom">
                    <form action="logincheck.php" class="login-form" method="post" role=
                    "form">
                    <input type="hidden" name="formid" value="<?php echo $_SESSION['formid']; ?>"/>
                        <div class="form-group">
                            <label class="sr-only" for=
                            "form-username">Email</label>
                            <div class="input-group">
                                <input class="form-username form-control" id=
                                "form-username" name="email"
                                placeholder="Email Here" type="text">
                                <span class="input-group-addon"><i class=
                                "glyphicon glyphicon-envelope"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for=
                            "form-password">Password</label>
                            <div class="input-group">
                            <input class=
                            "form-password form-control" id="form-password"
                            name="password" placeholder="Password Here"
                            type="password">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src=
    'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'>
    </script> 
    <script src="js/index.js">
    </script>
</body>
</html>