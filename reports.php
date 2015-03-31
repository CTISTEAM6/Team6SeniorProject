<?php
session_start();
include "../DB/dbconnect.php";
include "../functions.php";
$flag=detectIntrusion($_SESSION["permissions"],5);
if(!($flag!="-1"&&$flag!="0"))
    header("location:../logout.php");
$c="
<html>
<head>
<link href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' rel='stylesheet' type='text/css' />
        <link href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css' rel='stylesheet' type='text/css' />
        <!-- Ionicons -->
        <link href='//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' rel='stylesheet' type='text/css' />
        <!-- Theme style -->
        <link href='../css/AdminLTE.css' rel='stylesheet' type='text/css' />
        <link href='../css/slideupboxes.css' rel='stylesheet' type='text/css' />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
          <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'></script>
        <![endif]-->
</head>
<section class='slide-up-boxes'>

			<a href='clubsByMembers.php'>
				<h5>Existing Club Number: ".$_SESSION['clubCount']."</h5>
				<div>You can display that how many students include in clubs, and the statuses of the members</div>
			</a>

			<a href='placesReport.php'>
				<h5>Place Allocations</h5>
				<div>You can display the places of activities</div>
			</a>

			<a href='listActivitiesByType.php'>
				<h5>Activities by Type</h5>
				<div>Activity type reports include the information about the content of the activities</div>
			</a>

			<a href='listActivitiesByClubs.php'>
				<h5>Total # of Activities ".$_SESSION['activityCount']."</h5>
				<div>The report shows the information about the activities that are done by Clubs</div>
			</a>

			<a href='activityTypes.php'>
				<h5>Activity Types</h5>
				<div>You can see the type of the activities</div>
			</a>

			<a href='activityTypes.php?activityKind=1'>
				<h5>Activity Kinds</h5>
				<div>You can see the kinds of the activities</div>
			</a>

			<a href='activitiesByMonth.php'>
				<h5>Activities by Month</h5>
				<div>See the number of activities by months</div>
			</a>

			<a href='activitiesBySemester.php'>
				<h5>Activities by Semester</h5>
				<div>See the number of activities by semester</div>
			</a>

			<a href='activitiesByMonth.php'>
				<h5>Activities by Month</h5>
				<div>See the number of activities by months</div>
			</a>
						<a href='activitiesByMonth.php'>
				<h5>Activities by Month</h5>
				<div>See the number of activities by months</div>
			</a>
						<a href='activitiesByMonth.php'>
				<h5>Activities by Month</h5>
				<div>See the number of activities by months</div>
			</a>
						<a href='activitiesByMonth.php'>
				<h5>Activities by Month</h5>
				<div>See the number of activities by months</div>
			</a>
						<a href='activitiesByMonth.php'>
				<h5>Activities by Month</h5>
				<div>See the number of activities by months</div>
			</a>


		</section>
                    <!-- Small boxes (Stat box) -->
                    <div class='row' style='margin-top:1%; margin-left:1%; width:98%;'>


                    </div><!-- /.row --></html>";
echo $c;
?>
