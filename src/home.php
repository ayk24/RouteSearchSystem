<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user'])) {
	header("Location: login.php");
}

$query = "SELECT * FROM users WHERE user_id=".$_SESSION['user']."";
$result = $mysqli->query($query);
if (!$result) {
	print('Failed query.' . $mysqli->error);
	$mysqli->close();
	exit();
}
while ($row = $result->fetch_assoc()) {
	$username = $row['username'];
	$email = $row['email'];
}
$result->close();
?>

<script type="text/javascript">
var userid = '<?php echo $_SESSION['user']; ?>';
</script>

<!DOCTYPE html>
<html>

<!-- route の 表示など メインのページ -->

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="initial-scale=1.0">
    <title>Route Search</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://maps.google.se/maps/api/js?key=<APIKEY>">
    </script>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">

    <!-- BootstrapのCSS読み込み -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Custom -->
    <link href="../css/cover.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- JavaScript -->
    <script src="../js/googlemap.js" type="text/javascript"></script>

</head>

<!-- navi -->
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Route Search</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./show_history.php">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./show_shareinfo.php">Share</a>
                </li>
                <div style="position:absolute;top:15px;left:1650px;">
                    <li class="nav-item">Logined -> <?php echo $username; ?></li>
                </div>
            </ul>
        </div>
    </nav>
</header>

<!-- main -->

<body onLoad="initialize()">

    <div style="position:absolute;top:70px;left:1700px;">
        <a href="logout.php?logout">Log out</a>
    </div>

    <div style="position:absolute;top:100px;left:100px;">

        <div style="position:absolute;left:950px;">
            <div id="directionsPanel" class="panel"></div>
        </div>

        <div id="map_canvas" margin-top="200px;" class="map"></div>

        <form action="#" method="post" onSubmit="calcRoute();return false;" id="routeForm">

            <div class="form1-position">
                <label> From:　<input type="text" id="from" name="from" placeholder=" 出発地" class="form"></label>
            </div>
            <div class="form2-position">
                <label> 　 To:　<input type="text" id="to" name="to" placeholder=" 目的地" class="form"></label>
            </div>
            <div class="button1-position">
                <div class="btn-group btn-group-toggle" style="width:120px;height:35px" data-toggle="buttons">

                    <label class="btn btn-light">
                        <input type="radio" name="travelMode" value="DRIVING" autocomplete="off" checked>
                        <i class="fas fa-car"></i>
                    </label>

                    <label class="btn btn-light">
                        <input type="radio" name="travelMode" value="TRANSIT" autocomplete="off">
                        <i class="fas fa-bus"></i>
                    </label>

                    <label class="btn btn-light">
                        <input type="radio" name="travelMode" value="WALKING" autocomplete="off">
                        <i class="fas fa-walking"></i>
                    </label>
                </div>
            </div>
            <div class="button2-position">
                <input type="submit" name="search" class="btn btn-light" style="width:120px;height:35px" value="検索">
            </div>
        </form>
    </div>
</body>

</html>