<?php
    session_start();
    $_SESSION["formid"] = md5(rand(1,7919)*rand(1,7919));
    //1000th prime no - 7919
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login| Assignment Submission System</title>
    <link href="css/normalize.css" rel="stylesheet">
    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet prefetch'>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div id="error-box">
        <?php
            if(isset($_GET["error"]))
            {
                echo $_GET["error"];
            }
        ?>
    </div>
    <div>
       
        <form accept-charset="utf-8" action="logincheck.php" method="POST">
        <fieldset>
        <legend>Admin Login</legend>
        <input type="hidden" name="formid" value="<?php echo $_SESSION['formid']; ?>"/>
            <div>
                <div>
                    <label for=
                    "user-email">Email</label>
                    <input name="email" id=
                    "user-email" maxlength="255"
                    placeholder="Email" size="35" type=
                    "email">
                </div>
            </div>
            <br>
            <div>
                <div>
                    <label for=
                    "user-pw">Password </label>
                    <input name="password" id=
                    "user-pw" maxlength="255" placeholder=
                    "Password" size="30" type="password">
                </div>
            </div>
            <div>
                <input type="submit" name="admin" value="Login">
            </div>
        </form>
        </fieldset>
    </div>
</body>
</html>