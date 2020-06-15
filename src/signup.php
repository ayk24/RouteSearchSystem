<?php
session_start();
if( isset($_SESSION['user']) != "") {
	header("Location: home.php");
}

include_once 'dbconnect.php';
?>

<!DOCTYPE HTML>
<html lang="ja">

<!-- アカウントの作成 -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Signin for Route Search System</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sign.css" rel="stylesheet">
</head>

<body class="text-center">
    <?php
        if(isset($_POST['signup'])) {
	    $username = $mysqli->real_escape_string($_POST['username']);
	    $email = $mysqli->real_escape_string($_POST['email']);
	    $password = $mysqli->real_escape_string($_POST['password']);
	    $password = password_hash($password, PASSWORD_BCRYPT);
    
        $query = "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";
    
        if($mysqli->query($query)) {  ?>
    <div class="alert alert-success" role="alert">Success!</div>
    <?php } else { ?>
    <div class="alert alert-danger" role="alert">Error</div>
    <?php
	    }
        }?>

    <form method="post" class="form-sign">
        <img class="mb-4" src="../img/earth.png" width="100" height="100">
        <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
        <input type="text" class="form-control" name="username" placeholder="User name" required />
        <input type="email" class="form-control" name="email" placeholder="Email address" required />
        <input type="password" class="form-control" name="password" placeholder="Password" required />
        <button type="submit" class="btn btn-lg btn-dark btn-block" name="signup">Sign up</button>

        <p style="margin-top: 16px;"></p>
        <a href="login.php">Sign in</a>
    </form>

    </div>
</body>

</html>