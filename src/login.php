<?php
ob_start();
session_start();
if( isset($_SESSION['user']) != "") {
	header("Location: home.php");
}
include_once 'dbconnect.php';
?>

<?php
if(isset($_POST['login'])) {
	$email = $mysqli->real_escape_string($_POST['email']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$query = "SELECT * FROM users WHERE email='$email'";
	$result = $mysqli->query($query);
	if (!$result) {
		print('Failed query.' . $mysqli->error);
		$mysqli->close();
		exit();
	}

    while ($row = $result->fetch_assoc()) {
		$db_hashed_pwd = $row['password'];
		$user_id = $row['user_id'];
	}

    $result->close();
	if (password_verify($password, $db_hashed_pwd)) {
		$_SESSION['user'] = $user_id;
		header("Location: home.php");
		exit;
	} else { ?>
<div class="alert alert-danger" role="alert">Not Correct.</div>
<?php }
} ?>

<!DOCTYPE HTML>

<!-- ログインページ -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signin for Route Search System</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sign.css" rel="stylesheet">
</head>

<body class="text-center">

    <form method="post" class="form-sign">
        <img class="mb-4" src="../img/earth.png" width="100" height="100">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" class="form-control" name="email" placeholder="Email address" required />
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" required />
        <button class="btn btn-lg btn-dark btn-block" type="submit" name="login">Sign in</button>

        <p style="margin-top: 16px;"></p>
        <a href="signup.php">Sign up</a>
    </form>
</body>

</html>