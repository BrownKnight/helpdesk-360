<!--Contributions made by: Daniel Namyslaw - General Functioning of this page, and populating it with elements and graphs from our data.
Aman Dhoot - Created the general design of the page, such as navbar.
This page generates the navigation bar on top of the page, as well as the title and the checkboxes and select boxes.
On click of the checkboxes or select box, the corresponding function will be run which populates the screen.-->

<?php
session_start();
//If the user is not logged in, send them to login page
if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Analytics - Helpdesk 360</title>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/glyphs/css/glyph.css">


    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <link rel="stylesheet" href="currentAnalytics.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>



    <script src="js/script.js"></script>
    <script src="js/analyticsUserData.js"></script>
    <script src="js/analytics.js"></script>
    <script src="js/analyticsDays.js"></script>
    <script src="scripts/analyticsProblemType.js"></script>

</head>
<body class="bg-light" onload="charts4()" >
<!--creates the navigation bar at the top of the page and fills it will links as well as user box which can be used to log out.-->
<nav class="navbar  navbar-expand-md navbar-dark bg-dark flex-sm-nowrap">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".collapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php if ($_SESSION['accesslevel']){ ?>
    <a class="navbar-brand nav-abs order-1" href="specialistHome.php"><img src="img/helpdesk-logo.png" alt="Helpdesk-360 Logo" height="33px"></a>
    <div class="navbar-collapse collapse order-3 order-md-1">
        <ul class="navbar-nav">
            <?php } else { ?>
            <a class="navbar-brand nav-abs order-1" href="index.php"><img src="img/helpdesk-logo.png" alt="Helpdesk-360 Logo" height="33px"></a>
            <div class="navbar-collapse collapse order-3 order-md-1">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="specialistHome.php">Specialist Home</a>
                    </li>
                    <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="ticketList.php">View Tickets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="currentAnalytics.php">Analytics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin.php">Admin</a>
            </li>
        </ul>
    </div>
    <div class="ml-auto order-2 order-md-3" style="white-space: nowrap">
        <a id="accountPopover" class="navbar-text nav-link nav-account" href="#" data-toggle="popover" title="Account" data-placement="bottom"> <?= $_SESSION['username'] ?> <i class="icon-user"></i></a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 text-center mt-4" style="font-size: 4em">Analytics</h1>
        </div>
    </div>
    <div class="d-flex justify-content-center w-100 flex-wrap">

        <!--generates a group of checkboxes, once clicked will run a function to create the graphs from our data.-->
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-primary">
                <input type="checkbox" checked autocomplete="off" onchange="charts()" id = "Priority" class ="CheckedBox"> Priority
            </label>
            <label class="btn btn-primary">
                <input type="checkbox" autocomplete="off" onchange="charts2()" id ="Time" class ="CheckedBox"> Days taken to close
            </label>
            <label class="btn btn-primary">
                <input type="checkbox" autocomplete="off" onchange="charts3()" id ="ProblemType" class ="CheckedBox"> Problem Types
            </label>


        </div>

    </div>

</div>
<div class="row">
    <div class="col-md-8">
        <!--This div is what the graph is loaded into once generated by Chartist.js.-->
        <div id ="graphFrame" class="ct-chart ct-double-octave"></div>

    </div>
    <div class="col-md-4">
        <!--This generates the select box, which allows you to pick a user and see their personal graph, will be invisible until button 'Time' is pressed.-->
        <div id="selectbox" style= "display: none">
            <label for="employeeSelect">Select employee:</label>
            <select id="employeeSelect" onchange="charts5()">
            </select>

        </div>
        <!--this generates a checkbox that once clicked will generate a graph for problem types based on their average time taken to close.
        Will be invisible until 'ProblemType' is pressed. -->
        <div id="Avg" style="display: none">
            <input type="checkbox" id="AverageTime" onchange="charts6()">Average time for problem types
        </div>
    </div>
</div>

</div>



</body>
</html>
