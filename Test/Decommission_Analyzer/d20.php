<?php
error_reporting(0);
require_once './pages/auth/pageHandler.php';

include './pages/api/carbonFootPrintData.php';


ob_start();
session_start();
// echo "Hello from PHP!";
$_SESSION['currentPage'] = 'dashboard';

// ini_set('display_errors',0);

// print_r($_GET);
$showDiv = false;
if ($_GET['u'] == 's') {
     $showDiv = true;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="karthick">

    <title>Decommission Analyzer - Carbon Footprint</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="css/progress-bar.css" rel="stylesheet">
	
	<link rel=”stylesheet” href=”https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css”>
   
	
	

    <!-- Styles -->
    <style>
    #serverTypes,
    #toBeDecommissioned,
    #currentActivities,
    #futureActivities,
    #reductionActivities,
    #emmissionBydate {
        width: 100%;
        height: 100%;
    }

    .list-group-item:hover {
        transform: scale(1.02);
        cursor: default !important;
    }

    .chartdivafterdonut {
        width: 100%;
        height: 500px;
		max-width: 105%;
		padding-bottom: 110px;
    }

    .buttonchart {
        float: right;
        border: 1px solid grey;
        background-color: #5F6DD5;
        color: white;
    }

    .buttonchart:hover {
        background-color: #2B3582;
    }
	.show1{
		
		display: block !important;
		
	}
	.hide1{
		display: none !important;
	}
	
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include './pages/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include './pages/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <img src="./img/carbon-foot-print-logo.png" alt="" srcset="" height="115">
                        <!-- <h1 class="h3 mb-0 text-gray-800" style="margin-left: 13px;">Carbon Footprint</h1> -->
                        <img src="./img/reduce_your_carbon_footprint.jpg" alt="" srcset="" width="115" height="115"
                            style="margin-right: 40px;">
                    </div>

                    <div class="row " style="display: flex; justify-content: center; align-items:center; margin-top: -100px;">
                        <div class="col-md-4 mb-4" style="margin-left: 233px; ">  
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fileInput"
                                        aria-describedby="fileInputAddOn" accept=".csv">
                                    <label id="fileLabel" class="custom-file-label" for="fileInput">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <a onclick="uploadFile()" class="btn btn-success" style="color: white;"><i
                                    class="fa fa-check"></i> Upload</a>
                        </div>
                        <div class="col-md-3">
                            <!-- data-autohide="false" Add this inside toast div to make it stay forever -->
                            <div role="alert" aria-live="assertive" aria-atomic="true" class="toast"
                                style="border-radius: .5rem; background-color: yellow; color: black;" data-delay=2000>
                                <div class="toast-body">
                                    <p style="display: contents;">Hello, world! This is a toast message.</p>
                                    <button type="button" class="close" style="margin-top: -2px;" data-dismiss="toast"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <?php
                         if ($showDiv) {
                         ?>
                    
                    <div  style="display: block; width: 100%;" >
                        <div style=" display: inline-block; width: 40%;">
                            <!-- Row 1 -->

                            <a class=" row btn mb-2" id="onee"  style="width: 65%; display: flex; box-shadow: none; "
                                data-toggle="collapse"  href="#"  role="button" aria-expanded="false"
                                >

                                <div class="col-md-12">
                                    <div class="card border-left-primary shadow h-100 py-2" id="one">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Total no. of Servers in XXX's Landscape</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $totalServers; ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-server fa-2x text-gray-300"
                                                        style="color: #4B5DEF !important;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>


                            <!-- Row 2 -->

                            <a class="row btn mb-2" id="twoo" style="width: 65%; display: flex; box-shadow: none;"
                                data-toggle="collapse"  href="#" role="button" aria-expanded="false"
                                aria-controls="row1">
                                <div class="col-md-12">
                                    <div class="card border-left-success shadow h-100 py-2" id="two">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Total no. of Servers to be Decommissioned</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $serversToBeDecommissioned ; ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-eraser fa-2x text-gray-300"
                                                        style="color: #40EA7F !important;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </a>


                            <!-- Row 3 -->

                            <a class=" row  btn mb-2 threee" style="  width: 60%; margin-left: 0px; box-shadow: none; "
                                id="currentEmissionButton" data-toggle="collapse" href="#" role="button"
                                aria-expanded="false" aria-controls="row2">
                                <div class="col-md-12 card border-left-danger shadow h-100 py-2" id="three">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                    Current Carbon Footprint</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo $currentCarbonFootPrint; ?> Kg CO2e</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-burn fa-2x text-gray-300"
                                                    style="color: #F7492E !important;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>



                            <!-- Row 4 -->

                            <a class="row btn mb-2 fourr" style=" width: 60%; margin-left: 0px; box-shadow: none;"
                                id="futureEmissionButton" data-toggle="collapse" href="#" role="button"
                                aria-expanded="false" aria-controls="row4">
                                <div class="col-md-12 card border-left-warning shadow h-100 py-2" id="four">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Future Carbon Footprint</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo $futureCarbonFootPrint; ?> Kg CO2e</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-building fa-2x text-gray-300"
                                                    style="color: #F7BD2E !important;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
							
							
                            <!-- Row 5 -->
                            <a class="row btn mb-2" id="fivee" style="width: 257%;  display: flex; box-shadow: none; "
                                href="#row2" role="button">
                                <div class="col-md-12" id="tile5">
                                    <div class="card border-left-success shadow h-100 py-2" id="five">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div
                                                        class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Reduction in total Carbon Footprint</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $reductionPercentage; ?> %</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-arrow-down fa-2x text-gray-300"
                                                        style="color: red !important;"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </a>

                           




                        </div>
                        <div class="container" style=" display: inline-block; width: 60%; float : right;">
                            <div class="row mt-4 collapse" id="row11"
                                style="margin-left:-200px; width: 127%; height: 100%; margin-bottom: -300px; transition-duration: 0.5s; display: none;"> 
                                <div class="col-md-12"
                                    style=" padding-right: 10px; width: 100%; height: 100%; margin-top: -20px;">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header -->
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Distribution by server type
                                                (OS)
                                            </h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body" style="margin-bottom: 100px;" >
                                            <div class="chart-area">
                                                <div id="serverTypes" style="height: 130%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
							<div class="row mt-4 collapse" id="afterdonutlinux"
                                style="margin-left: -200px; width: 127%; height: 100%; transition-duration: 0.5s; display: none;">
                                <div class="col-md-12" style=" width: 100%; height: 100%; margin-top: -20px; margin-right: 350px;">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header -->
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Decommissioning Summary -
                                                Overall Server Distribution (By Linux OS Type)
                                            </h6><span><button class="buttonchart"
                                                    onclick="buttonhidefunction()">Back</button></span>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body" style="margin-bottom: 130px; padding: 0px;"> 
                                            <div class="chart-area">
                                                <div class="chartdivafterdonut" id="chartdivafterlinux"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="row mt-4 collapse" id="afterdonutwindows"
                                style="margin-left: -200px; width: 127%; height: 100%; transition-duration: 0.5s; display: none; ">
                                <div class="col-md-12" style=" width: 100%; height: 100%; margin-top: -20px; ">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header -->
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Decommissioning Summary -
                                                Overall Server Distribution (By Windows OS Type)
                                            </h6><span><button class="buttonchart"
                                                    onclick="buttonhidefunction()">Back</button></span>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body" style="margin-bottom: 130px; padding: 0px; transition-duration: 0.5s;">
                                            <div class="chart-area" style=""> 
                                                <div class="chartdivafterdonut" id="chartdivafterwindows" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
							
 
                            <div class="row mt-4 collapse" id="row12"
                                style="margin-left: -200px; transition-duration: 0.5s; display: none;">
                                <div class="col-md-12"
                                    style=" padding-right: 10px; width: 100%; height: 120%; margin-top: -20px;">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header -->
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Decommissioning Summary -
                                                Overall
                                                Server Distribution (by OS Type)</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body" style="margin-bottom: 100px;" >
                                            <div class="chart-area">
                                                <div id="toBeDecommissioned"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-- Progress Bar -->
                            <div class="row" style="margin-top: -50px;">
                                <div class="col-md-8" id="currentProgress" ></div>
                                <div class="col-md-8" style="padding-right: 55px;" id="futureProgress"></div>
                            </div>
                            <div class="progress-bar-container d-none" id="progressBar"
                                style="margin-top: 70px; margin-left:0px;">
                                <!-- <input type="radio" class="radio" name="progress" value="five" id="five">
                                   <label for="five" class="label">Very Low</label> -->

                                <input type="radio" class="radio" name="progress" value="twentyfive" id="twentyfive"
                                    checked disabled>
                                <label for="twentyfive" class="label">Low</label>

                                <input type="radio" class="radio" name="progress" value="fifty" id="fifty" disabled>
                                <label for="fifty" class="label">Medium</label>

                                <input type="radio" class="radio" name="progress" value="seventyfive" id="seventyfive"
                                    disabled>
                                <label for="seventyfive" class="label">High</label>

                                <!-- <input type="radio" class="radio" name="progress" value="onehundred" id="onehundred">
                                   <label for="onehundred" class="label">Very High</label> -->

                                <div class="progress">
                                    <div class="progress-bar" ></div>
                                </div>
                            </div>

                            <!-- Toggled Chars for row 2 -->
                            <div class="row" id="chart2" >
                                <div class="col-md-12 collapse" id="row2"
                                    style="margin-left: -100px; margin-right: 85px; padding-right: 15px; transition-duration: 0.5s; width:60%; display: none; ">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header -->
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Current Emission % by Energy
                                                Consumption</h6>
                                        </div>
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="chart-area">
                                                <div id="currentActivities"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 collapse" id="row4"
                                    style="margin-left: -100px; margin-right: 70px; transition-duration: 0.5s; margin-top: 0px;display: none;">
                                    <div class="card shadow mb-4">
                                        <!-- Card Header -->
                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Monthly Reduction in Carbon
                                                Footprint
                                                via Decommissioning</h6>

                                        </div>

                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="chart-area">

                                                <div id="emmissionBydate" style="height: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <?php

                         }
                         ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include './pages/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
	
	
	
     <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	 <script src=”https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js”></script>
     <script src=”https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js”></script>
     <script src=”https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js”></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Chart Scripts -->
    <script src="js/4/core.js"></script>
    <script src="js/4/charts.js"></script>
    <script src="js/4/animated.js"></script>
    <script src="js/4/kelly.js"></script>
    <script src="js/4/material.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/moonrisekingdom.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/dataviz.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/frozen.js"></script>

    <!-- Resources after donutchart-->
   <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
   <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
   <script src="https://cdn.amcharts.com/lib/4/plugins/forceDirected.js"></script>
   <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>


    <script>
    $(document).ready(function() {
        $("body").tooltip({
            selector: '[data-toggle=tooltip]'
        });
		
			if($(window).width() < 1500) {
				$('#row11').css('margin-left', '0');
				$('#row12').css('margin-left', '0');
			}
			
		



        // Progress bar click
        $('#currentEmissionButton').click(function(e) {
            // alert(1);
            if ($('#row2').hasClass('show')) {
                $(".progress-bar-container").removeClass("d-none"); 
            } else {
                if ($(".progress-bar-container").hasClass("d-none")) {
                    $(".progress-bar-container").removeClass("d-none");
                    
                }
            }
			
				
			

            // if ($(".progress-bar-container").hasClass("d-none")) {
            //      $(".progress-bar-container").removeClass("d-none");
            // } else {
            //      $(".progress-bar-container").addClass("d-none");
            // }
            $('#twentyfive').removeAttr('checked');
            $('#seventyfive').attr('checked', true);

            // $('html,body').animate({
                // scrollTop: $("#currentEmissionButton").offset().top
            // }, 'slow');
            // $('#currentProgress').insert($('#progressBar').descendants()[0]);
            $("#progressBar").appendTo("#currentProgress");


        });
		
	
		
		
        var flag1 = 0;
        $('#onee').click(function(e) {
		   
            //alert("hhhh");				
            if ((flag1 == 1) ||($('#afterdonutwindows').hasClass('show1')) || ($('#afterdonutlinux').hasClass('show1'))) {
                flag1 = 0;
                $('#one').css("background-color", "white");
                $('#row11').hide(600)

            } else {
                flag1 = 1;
                 $('#row11').show(600);
				 $('#one').css("background-color", "#CCCEFC");
				
				 $('#two').css("background-color", "white");
				 $('#row12').hide(600);
				 flag2 = 0;
				 
				 $('#three').css("background-color", "white");
				 $('#row2').hide(600);
				 $("#progressBar").addClass("hide1").fadeIn('slow');
				 flag3 = 0;
				 
				 
				 $('#four').css("background-color", "white");
				 $('#row4').hide(600);
				 $("#progressBar").addClass("hide1").fadeIn('slow');
				 flag4 = 0;
		
            }
			
			 $('html,body').animate({
                scrollTop: $("#onee").offset().top
            }, 'slow');
			

        });
        var flag2 = 0;
        $('#twoo').click(function(e) {
            if ((flag2 == 1) || ($('#afterdonutwindows').hasClass('show1')) || ($('#afterdonutlinux').hasClass('show1'))) {
                flag2 = 0;
                $('#two').css("background-color", "white");
				$('#row12').hide(600);
              
            } 
				
			else {
                flag2 = 1;
                $('#two').css("background-color", "#CCFCCC");
				$('#row12').show(600);
               
				
				 $('#one').css("background-color", "white");
				 $('#row11').hide(600);
				 flag1 = 0;
				 
				 
				 $('#three').css("background-color", "white");
				 $('#row2').hide(600);
				 $("#progressBar").addClass("hide1").fadeIn('slow');
				 flag3 = 0;
				 
				 
				 $('#four').css("background-color", "white");
				 $('#row4').hide(600);
				 $("#progressBar").addClass("hide1").fadeIn('slow');
				 flag4 = 0;


            }
			
			$('html,body').animate({
                scrollTop: $("#onee").offset().top
            }, 'slow');

        });
        var flag3 = 0;
        $('.threee').click(function(e) {
            if ((flag3 == 1) || ($('#afterdonutwindows').hasClass('show1')) || ($('#afterdonutlinux').hasClass('show1'))) {
                flag3 = 0;
                $('#three').css("background-color", "white");
				$('#row2').hide(600);
               
				$("#progressBar").addClass("hide1").fadeIn('slow');
				$(".progress-bar").css("width","0%");
				
				
            } else {
                flag3 = 1;
				$("#progressBar").removeClass("hide1");
                $('#three').css("background-color", "#FC9C8D");
				$('#row2').show(600);
               
				
				$(".progress-bar").animate({
                  width: "75%"
                }, 5500);
				
				
				 $('#two').css("background-color", "white");
				 $('#row12').hide(600);
				 flag2 = 0;
				 
				 
				 $('#one').css("background-color", "white");
				 $('#row11').hide(600);
				 flag1 = 0;
				 
				  $('#four').css("background-color", "white");
				 $('#row4').hide(600);
				  flag4 = 0;

            }
			
			$('html,body').animate({
                scrollTop: $("#onee").offset().top
            }, 'slow');

        });
        var flag4 = 0;
        $('.fourr').click(function(e) {
            if ((flag4 == 1) || ($('#afterdonutwindows').hasClass('show1')) || ($('#afterdonutlinux').hasClass('show1'))) {
                flag4 = 0;
                $('#four').css("background-color", "white");
				$('#row4').hide(600);
                
				$("#progressBar").addClass("hide1").fadeIn('slow');
				$(".progress-bar").css("width","0%");
            } else {
                flag4 = 1;
				$("#progressBar").removeClass("hide1");
                $('#four').css("background-color", "#FCE183");
			    $('#row4').show(600);
                
				
				
				$(".progress-bar").animate({
                  width: "30%"
                }, 2500);
				
				
				
				 $('#two').css("background-color", "white");
				 $('#row12').hide(600);
				 flag2 = 0;
				 
				 
				 $('#one').css("background-color", "white");
				 $('#row11').hide(600);
				 flag1 = 0;
				 
				 
				 $('#three').css("background-color", "white");
				 $('#row2').hide(600);
				 flag3 = 0;

            }
			$('html,body').animate({
                scrollTop: $("#onee").offset().top
            }, 'slow');


        });
        var flag5 = 0;
        $('#fivee').click(function(e) {
            if (flag5 == 1) {
                flag5 = 0;
                $('#five').css("background-color", "white");
            } else {
                flag5 = 1;
                $('#five').css("background-color", "#80FFCE");

            }

        });
		
		

       
                



        $('#futureEmissionButton').click(function(e) {
            // alert(1);
            if ($('#row4').hasClass('show')) {
                $(".progress-bar-container").addClass("d-none");
            } else {
                if ($(".progress-bar-container").hasClass("d-none")) {
                    $(".progress-bar-container").removeClass("d-none");
                }
            }
            // if ($(".progress-bar-container").hasClass("d-none")) {
            //      $(".progress-bar-container").removeClass("d-none");
            // } else {
            //      $(".progress-bar-container").addClass("d-none");
            // }
            $('#seventyfive').removeAttr('checked');
            $('#twentyfive').attr('checked', true);
            // $('html,body').animate({ 
                // scrollTop: $("#futureEmissionButton").offset().top
            // }, 'slow');
            $("#progressBar").appendTo("#futureProgress");
        });
    });
	
	
	
	
    </script>

    <script>
    $("#fileInput").change(function() {
        filename = this.files[0].name;
        $('#fileLabel').text(filename);
        // console.log(filename);
    });

    function uploadFile() {

        var file = document.getElementById("fileInput").files[0];
        // console.log(file['name']);
        var formdata = new FormData();
        formdata.append("fileInput", file);

        var ajax = new XMLHttpRequest();
        ajax.addEventListener("load", completeHandler, false);
        ajax.open("POST", "./pages/api/carbonFootPrintDataUploader.php");
        ajax.send(formdata);

        // $.post("./carbonFootPrint_new.php", {
        //      upload: 'success'
        // });
        setTimeout(function() {
            window.location.href = './d20.php?u=s';
        }, 2000);
        // window.open("");
    }

    function completeHandler(event) {
        var messageFromAPI = event.target.responseText;

        // $('#testDiv p').text(messageFromAPI);

        $('.toast-body p').text(messageFromAPI);
        $('.toast').addClass("bg-success");
        $('.toast').css('color', 'white');
        $('.toast').toast('show');
    }
    </script>

    <!-- Chart code -->
    <!-- Server Types Chart -->
    <script>
    am4core.ready(function() {
        am4core.options.commercialLicense = true;


        am4core.useTheme(am4themes_material);
        am4core.useTheme(am4themes_animated);


        var chart = am4core.create("serverTypes", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.legend = new am4charts.Legend();

        chart.data = [{
                country: "Linux",
                litres: <?php echo $totalLinuxServers; ?>
            },
            {
                country: "Windows",
                litres: <?php echo $totalWindowsServers; ?>
            },

        ];

        chart.innerRadius = 80;

        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "litres";
        series.dataFields.category = "country";
        series.dataFields.hidden = "hidden";


        // Disable Chart label and Tick
        series.labels.template.disabled = false;
        series.ticks.template.disabled = false;

        series.slices.template.events.on("hit", function(ev) {
            //alert('clicked');
            var currentText = ev.target.dataItem.properties.category;
            console.log(currentText);
            //console.log(ev);
            afterDonutChart(currentText);

        }, this);

    });
 

    function afterDonutChart(currentText) {
        if (currentText == "Windows") {
            $('#afterdonutwindows').addClass('show1').fadeIn('slow');
			$('#afterdonutwindows').removeClass('hide1');
            $('#row11').hide(600);   
			$('#one').css("background-color", "white");
			
			
			
		
				 
        }
        if (currentText == "Linux") {
            $('#afterdonutlinux').addClass('show1');
            $('#afterdonutlinux').removeClass('hide1');
             $('#row11').hide(600); 
			$('#one').css("background-color", "white");
			
			
			
		}
		
		

    }

    function buttonhidefunction() {
        $('#afterdonutlinux').addClass('hide1').fadeIn('slow');
        $('#afterdonutwindows').addClass('hide1').fadeIn('slow');
		$('#afterdonutlinux').removeClass('show1');
        $('#afterdonutwindows').removeClass('show1');
         $('#row11').show(600);     
		 $('#one').css("background-color", "#CCCEFC");
		 flag1 = 1;
 		 
		 $('#two').css("background-color", "white");
	     $('#row12').hide(600);
	     flag2 = 0;
				 
		 $('#three').css("background-color", "white");
		 $('#row2').hide(600);
		 $("#progressBar").addClass("hide1").fadeIn('slow');
		 flag3 = 0;	 
				 
		 $('#four').css("background-color", "white");
		 $('#row4').hide(600);
		 $("#progressBar").addClass("hide1").fadeIn('slow');
		 flag4 = 0;		 
				 
		 


    }
    </script>

    <!-- To be Decommissioned Chart -->
    <script>
    am4core.ready(function() {


        am4core.useTheme(am4themes_animated);
        am4core.unuseTheme(am4themes_material);


        var chart = am4core.create('toBeDecommissioned', am4charts.XYChart)
        chart.colors.step = 2;

        chart.legend = new am4charts.Legend()
        chart.legend.position = 'top'
        chart.legend.paddingBottom = 20
        chart.legend.labels.template.maxWidth = 95

        var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
        xAxis.dataFields.category = 'category'
        xAxis.renderer.cellStartLocation = 0.1
        xAxis.renderer.cellEndLocation = 0.9
        xAxis.renderer.grid.template.location = 0;

        var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
        yAxis.min = 0;
        yAxis.max = 50;

        function createSeries(value, name) {
            var series = chart.series.push(new am4charts.ColumnSeries())
            series.dataFields.valueY = value
            series.dataFields.categoryX = 'category'
            series.name = name

            series.events.on("hidden", arrangeColumns);
            series.events.on("shown", arrangeColumns);

            var bullet = series.bullets.push(new am4charts.LabelBullet())
            bullet.interactionsEnabled = false
            bullet.dy = -10;
            bullet.label.text = '{valueY}'
            bullet.label.fill = am4core.color('#111111')

            return series;
        }

        chart.data = [{
                category: 'Linux',
                first: <?php echo $totalLinuxServers; ?>,
                second: <?php echo $decommissionedLinuxServers; ?>
            },
            {
                category: 'Windows',
                first: <?php echo $totalWindowsServers; ?>,
                second: <?php echo $decommissionedWindowsServers; ?>
            },
        ]


        createSeries('first', 'Total Servers');
        createSeries('second', 'Servers to Decommission');
        // createSeries('third', 'The Third');

        function arrangeColumns() {

            var series = chart.series.getIndex(0);

            var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
            if (series.dataItems.length > 1) {
                var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
                var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
                var delta = ((x1 - x0) / chart.series.length) * w;
                if (am4core.isNumber(delta)) {
                    var middle = chart.series.length / 2;

                    var newIndex = 0;
                    chart.series.each(function(series) {
                        if (!series.isHidden && !series.isHiding) {
                            series.dummyData = newIndex;
                            newIndex++;
                        } else {
                            series.dummyData = chart.series.indexOf(series);
                        }
                    })
                    var visibleCount = newIndex;
                    var newMiddle = visibleCount / 2;

                    chart.series.each(function(series) {
                        var trueIndex = chart.series.indexOf(series);
                        var newIndex = series.dummyData;

                        var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                        series.animate({
                            property: "dx",
                            to: dx
                        }, series.interpolationDuration, series.interpolationEasing);
                        series.bulletsContainer.animate({
                            property: "dx",
                            to: dx
                        }, series.interpolationDuration, series.interpolationEasing);
                    })
                }
            }
        }

    });
    </script>

    <!-- Emission by Activities Chart -->
    <script>
    am4core.ready(function() {


        am4core.useTheme(am4themes_animated);


        // Create chart instance
        var chart = am4core.create("currentActivities", am4charts.PieChart);

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "litres";
        pieSeries.dataFields.category = "country";

        // Let's cut a hole in our Pie chart the size of 30% the radius
        chart.innerRadius = am4core.percent(30);

        // Put a thick white border around each Slice
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.slices.template
            // change the cursor on hover to make it apparent the object can be interacted with
            .cursorOverStyle = [{
                "property": "cursor",
                "value": "pointer"
            }];

        pieSeries.alignLabels = false;
        pieSeries.labels.template.bent = true;
        pieSeries.labels.template.radius = 3;
        pieSeries.labels.template.padding(0, 0, 0, 0);

        pieSeries.ticks.template.disabled = true;
        pieSeries.labels.template.disabled = true;

        // Move Chart Color by 5 steps
        pieSeries.colors.step = 5;

        // Create a base filter effect (as if it's not there) for the hover to return to
        var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
        shadow.opacity = 0;

        // Create hover state
        var hoverState = pieSeries.slices.template.states.getKey(
            "hover"); // normally we have to create the hover state, in this case it already exists

        // Slightly shift the shadow and make it more prominent on hover
        var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
        hoverShadow.opacity = 0.7;
        hoverShadow.blur = 5;

        // Add a legend
        chart.legend = new am4charts.Legend();

        chart.data = [{
            "country": "Green",
            "litres": <?php echo $currentGreenEmission; ?>
        }, {
            "country": "Non-Green",
            "litres": <?php echo $currentNonGreenEmission; ?>
        }];

    });
    </script>

    <!-- Emission by Future activities Chart -->
    <script>
    am4core.ready(function() {

        am4core.useTheme(am4themes_animated);
        am4core.useTheme(am4themes_material);

        var chart = am4core.create("futureActivities", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.data = [{
            "country": "Fuel & Energy",
            "litres": 68
        }, {
            "country": "IT Assets (Servers)",
            "litres": 32
        }];

        chart.innerRadius = am4core.percent(50);
        chart.depth = 50;

        chart.legend = new am4charts.Legend();
        chart.legend.position = 'top'
        chart.legend.paddingBottom = 20
        chart.legend.labels.template.maxWidth = 95

        var series = chart.series.push(new am4charts.PieSeries3D());
        series.dataFields.value = "litres";
        series.dataFields.depthValue = "litres";
        series.dataFields.category = "country";
        series.slices.template.cornerRadius = 5;
        series.colors.step = 5;

        series.ticks.template.disabled = true;
        series.labels.template.disabled = true;

    });
    </script>

    <!-- Emission Reduction Chart -->
    <script>
    am4core.ready(function() {

        am4core.useTheme(am4themes_animated);
        am4core.useTheme(am4themes_kelly);

        var chart = am4core.create("reductionActivities", am4charts.PieChart);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.data = [{
            country: "Fuel & Energy",
            value: 58
        }, {
            country: "IT Assets (Servers)",
            value: 42
        }];

        var series = chart.series.push(new am4charts.PieSeries());
        series.dataFields.value = "value";
        series.dataFields.radiusValue = "value";
        series.dataFields.category = "country";
        series.slices.template.cornerRadius = 6;
        series.colors.step = 8;

        series.ticks.template.disabled = true;
        series.labels.template.disabled = true;

        series.hiddenState.properties.endAngle = -90;

        chart.legend = new am4charts.Legend();

    });
    </script>

    <!-- Future Emisssion By Date Chart-->
    <script>
    am4core.ready(function() {


        am4core.unuseTheme(am4themes_kelly);
        am4core.useTheme(am4themes_animated);
        am4core.useTheme(am4themes_material);


        var chart = am4core.create('emmissionBydate', am4charts.XYChart)
        chart.colors.step = 2;

        chart.legend = new am4charts.Legend()
        chart.legend.position = 'top'
        chart.legend.paddingBottom = 20
        chart.legend.labels.template.maxWidth = 95

        var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
        xAxis.dataFields.category = 'category'
        xAxis.renderer.cellStartLocation = 0.1
        xAxis.renderer.cellEndLocation = 0.9
        xAxis.renderer.grid.template.location = 0;

        var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
        yAxis.min = 0;

        function createSeries(value, name) {
            var series = chart.series.push(new am4charts.ColumnSeries())
            series.dataFields.valueY = value
            series.dataFields.categoryX = 'category'
            series.name = name

            series.events.on("hidden", arrangeColumns);
            series.events.on("shown", arrangeColumns);

            var bullet = series.bullets.push(new am4charts.LabelBullet())
            bullet.interactionsEnabled = false
            bullet.dy = -10;
            bullet.label.text = '{valueY}'
            bullet.label.fill = am4core.color('#111111')
            bullet.label.fontSize = 14;

            return series;
        }

        chart.data = [{
                category: "Q3'22",
                first: <?php echo $ceQ322 ?>,
                second: <?php echo $prQ322 ?>
            },
            {
                category: "Q4'22",
                first: <?php echo $ceQ422 ?>,
                second: <?php echo $prQ422 ?>
            },
            {
                category: "Q1'23",
                first: <?php echo $ceQ123 ?>,
                second: <?php echo $prQ123 ?>
            },
            {
                category: "Q2'23",
                first: <?php echo $ceQ223 ?>,
                second: <?php echo $prQ223 ?>
            },
        ]


        createSeries('first', 'Carbon Emission');
        createSeries('second', 'Planned Reduction');
        // createSeries('third', 'The Third');

        function arrangeColumns() {

            var series = chart.series.getIndex(0);

            var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
            if (series.dataItems.length > 1) {
                var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
                var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
                var delta = ((x1 - x0) / chart.series.length) * w;
                if (am4core.isNumber(delta)) {
                    var middle = chart.series.length / 2;

                    var newIndex = 0;
                    chart.series.each(function(series) {
                        if (!series.isHidden && !series.isHiding) {
                            series.dummyData = newIndex;
                            newIndex++;
                        } else {
                            series.dummyData = chart.series.indexOf(series);
                        }
                    })
                    var visibleCount = newIndex;
                    var newMiddle = visibleCount / 2;

                    chart.series.each(function(series) {
                        var trueIndex = chart.series.indexOf(series);
                        var newIndex = series.dummyData;

                        var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                        series.animate({
                            property: "dx",
                            to: dx
                        }, series.interpolationDuration, series.interpolationEasing);
                        series.bulletsContainer.animate({
                            property: "dx",
                            to: dx
                        }, series.interpolationDuration, series.interpolationEasing);
                    })
                }
            }
        }

    });
    </script>

<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdivafterwindows", am4plugins_forceDirected.ForceDirectedTree);
chart.legend = new am4charts.Legend();

var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

networkSeries.data = [{
  name: 'Windows' , 
  children: [{
    name: 'Total \nServers: \n<?php echo $totalWindowsServers; ?>',  value: 25,
	tooltip1: "Total Servers: <?php echo $totalWindowsServers; ?>",value:1
	
  }, {
    name: 'Servers To \n Decommission:\n<?php echo $decommissionedWindowsServers; ?> ', value: 40,
	tooltip1: "Servers To Decommission: <?php echo $decommissionedWindowsServers; ?>", value:1
  }]
 

}];

networkSeries.dataFields.linkWith = "linkWith";
networkSeries.dataFields.name = "name";
networkSeries.dataFields.id = "name";
networkSeries.dataFields.value = "value";
networkSeries.dataFields.children = "children";
networkSeries.nodes.template.tooltipText = "{tooltip1}";
networkSeries.nodes.template.fillOpacity = 1;
networkSeries.nodes.template.label.text = "{name}"
networkSeries.fontSize = 12;
networkSeries.maxLevels = 4;
networkSeries.maxRadius = am4core.percent(12);
networkSeries.manyBodyStrength = -16;
networkSeries.nodes.template.label.hideOversized = true;
networkSeries.nodes.template.label.truncate = true;
chart.legend.labels.template.text = " [bold {color}]{tooltip1}[/]";
networkSeries.nodes.template.outerCircle.filters.push(new am4core.DropShadowFilter());
networkSeries.nodes.template.circle.filters.push(new am4core.DropShadowFilter());
networkSeries.links.template.strokeWidth=4;
networkSeries.links.template.strokeOpacity=1;
networkSeries.links.template.distance=1.5;

//chart.legend.ticks.template.disabled = false;
//networkSeries.ticks.template.disabled = false;

 
}); // end am4core.ready()




am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdivafterlinux", am4plugins_forceDirected.ForceDirectedTree);
chart.legend = new am4charts.Legend();

var networkSeries = chart.series.push(new am4plugins_forceDirected.ForceDirectedSeries())

networkSeries.data = [{
  name: 'Linux ' , 
  children: [{
    name: 'Total \n Servers: \n<?php echo $totalLinuxServers; ?>', value: 30,
	tooltip1: "Total Servers: <?php echo $totalLinuxServers; ?>",value:1
  }, {
    name: 'Servers To \nDecommission:\n<?php echo $decommissionedLinuxServers; ?> ', value:40,
    tooltip1: "Servers To Decommission: <?php echo $decommissionedLinuxServers; ?>",value:1
  }]


}];
 

networkSeries.dataFields.linkWith = "linkWith";
networkSeries.dataFields.name = "name";
networkSeries.dataFields.id = "name";
networkSeries.dataFields.value = "value";
networkSeries.dataFields.children = "children";
networkSeries.nodes.template.tooltipText = "{tooltip1}";
networkSeries.nodes.template.fillOpacity = 1;
networkSeries.nodes.template.label.text = "{name}"
//chart.legend.itemContainers.template.tooltipText = "{tooltip1}";
networkSeries.fontSize = 12; 
networkSeries.maxLevels = 4;
networkSeries.maxRadius = am4core.percent(12);
networkSeries.manyBodyStrength = -16; 
networkSeries.nodes.template.label.hideOversized = true;
networkSeries.nodes.template.label.truncate = true;
chart.legend.labels.template.text = " [bold {color}]{tooltip1}[/]";
//networkSeries.legendSettings.labelText = "Series: [bold {color}]{tooltip1}[/]";
networkSeries.nodes.template.outerCircle.filters.push(new am4core.DropShadowFilter());
networkSeries.nodes.template.circle.filters.push(new am4core.DropShadowFilter());
networkSeries.links.template.strokeWidth=4;
networkSeries.links.template.strokeOpacity=1;
networkSeries.links.template.distance=1.5;



}); // end am4core.ready()
</script>

   
   
   



</body>

</html>