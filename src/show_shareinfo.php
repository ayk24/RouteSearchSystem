<!DOCTYPE html>
<html lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="initial-scale=1.0">
    <title>Share Route</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">

    <!-- BootstrapのCSS読み込み -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="../css/history.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Route Search</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./show_history.php">History</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./show_shareinfo.php">Share<span class="sr-only">(current)</span></a>
                </li>

            </ul>
        </div>
    </nav>
</header>

<body>
    <?php
    session_start();
    include_once 'dbconnect.php';

    $user_id = $_SESSION['user'];
    $username = "";
    $origin = "";
    $destination = "";
    $time = "";
    $distance = "";

    $sql = "SELECT username, origin, destination, travelMode, time, distance FROM history, users WHERE history.user_id = users.user_id AND share = 1 AND users.user_id != ?";
    
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

    ?>
    <div style="margin-top:100px;">
        <div class="container">
            <div class="table-wrapper">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>FROM</th>
                            <th>TO</th>
                            <th>TRANSPORTATION</th>
                            <th>TIME</th>
                            <th>DISTANCE</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
            
                        $stmt->bind_result($username, $origin, $destination, $travelMode, $time, $distance);

                        while ($stmt->fetch()) {
                            echo "<tr>\n"; 
                            echo "<td>${username}</td>\n";
                            echo "<td>${origin}</td>\n";
                            echo "<td>${destination}</td>\n";
                            echo "<td>${travelMode}</td>\n";
                            echo "<td>${time}</td>\n";
                            echo "<td>${distance}</td>\n";
                            echo "</tr>\n";
                        }
                        echo "</tbody>\n</table>\n";
                        $stmt->close();
                    }
                        $mysqli->close();
                        ?>
                    </tbody>
            </div>
        </div>
    </div>
</body>

</html>