<!DOCTYPE html>
<html lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="initial-scale=1.0">
    <title>Show History</title>

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

    <script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        var checkbox = $('table tbody input[type="checkbox"]');

        checkbox.click(function() {

            var tblTbody = document.getElementById('history_table');
            document.getElementById("history_table").value = "";

            var row = $(this).closest('tr').index();
            var history_id = parseInt(tblTbody.rows[row].cells[1].innerText);

            if (this.checked) {
                var checked = 1;
            } else {
                var checked = 0;
                $("#selectAll").prop("checked", false);
            }

            $(function() {
                $.ajax({
                    url: "./checked.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        "history_id": history_id,
                        "checked": checked,
                    }
                }).done(function(response) {
                    console.log(response);
                }).fail(function(errorThrown) {
                    console.log(errorThrown);
                });
            });
        });
    });
    </script>
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
                <li class="nav-item active">
                    <a class="nav-link" href="./show_history.php">History<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./show_shareinfo.php">Share</a>
                </li>

            </ul>
        </div>
    </nav>
</header>

<body>
    <?php
    session_start();
    include_once 'dbconnect.php';

    $history_id = 0;
    $user_id = $_SESSION['user'];
    $share;
    $origin = "";
    $destination = "";
    $time = "";
    $distance = "";

    $sql = "SELECT history_id, share, origin, destination, travelMode, time, distance FROM history WHERE user_id=?";

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
                            <th></th>
                            <th>ID</th>
                            <!-- <th>SHARE</th> -->
                            <th>FROM</th>
                            <th>TO</th>
                            <th>TRANSPORTATION</th>
                            <th>TIME</th>
                            <th>DISTANCE</th>
                        </tr>
                    </thead>
                    <tbody id="history_table">
                        <?php
        
                    $stmt->bind_result($history_id, $share, $origin, $destination, $travelMode, $time, $distance);

                    while ($stmt->fetch()) {
                        echo "<tr>\n"; 
                        if($share == 1){
                            echo '<td><span class="custom-checkbox">
                            <input type="checkbox" id="checkbox" checked="checked">
                            <label for="checkbox"></label></span></td>';

                        }else{
                        echo '<td><span class="custom-checkbox">
                                <input type="checkbox" id="checkbox">
                                <label for="checkbox"></label></span></td>';
                        }
                        echo "<td id=history_id>${history_id}</td>\n";
                        // echo "<td>${share}</td>\n";
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
            </div>
        </div>
    </div>
</body>

</html>