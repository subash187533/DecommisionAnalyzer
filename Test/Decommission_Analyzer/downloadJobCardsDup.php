<?php 
error_reporting(0);
require_once './pages/auth/pageHandler.php';

ob_start();
session_start();
// echo "Hello from PHP!";
$_SESSION['currentPage'] = 'jobCards';

$m = new MongoClient();
$db = $m->test_decommission_analyzer;
$collection = $db->job_cards;
$jobCards = $collection->distinct('Application Name');
sort($jobCards);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Decommission Analyzer - Job Cards</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
    .job-card-row {
        margin-top: 10px;

    }

    .job-card-content {
        background-color: #342668;
        color: white;
        padding: 4px;
        margin-bottom: 10px;
        border-radius: .35rem;
    }

    .job-card-header {
        margin-bottom: 10px;
        font-weight: bold;
    }

    /* burst div */
    /* .burst-12 {
        background: red;
        width: 80px;
        height: 80px;
        position: relative;
        text-align: center;
        left: 90px;
        top: 10px;
        z-index: -1;
    }

    .burst-12:before,
    .burst-12:after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 80px;
        width: 80px;
        background: red;
    }

    .burst-12:before {
        transform: rotate(30deg);
    }

    .burst-12:after {
        transform: rotate(60deg);
    } */

    .dpd-td {
        background-color: #342668;
        color: #FFFFFF;
        padding: 7px !important;
        border-radius: .35rem;
    }
	
	.circle {
    background: #342668;
    border-radius: 50%;
    width: 100px;
    height: 100px;
	color: white;
	padding: 4px;
	margin-bottom: 27px;
	margin-top: 30px;
	margin-left: 90px;
	display: flex;
	align-items: center;
	align-content: center;
	justify-content: center;
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
                        <h1 class="h3 mb-0 text-gray-800">Job Cards</h1>
                        <button onclick="CreatePDFfromHTML()" type="button" class="btn btn-primary" id="download"><i class="fas fa-download"></i></button>
                    
                    </div>
					
					            

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12 html-content">
                            <!-- Card Body -->
                            <!-- Job Card -->
                            <?php
                                    $jobCardsCursor = $collection->find();
                                    foreach($jobCardsCursor as $jobCardsObject) { 
										# code...
                                        // print_r($jobCardsObject);
                                        ?>
                            <div class="card shadow mb-4">
                                <div class="card-body text-center" id="jobCardBody">
									<div class="row job-card-row">
										<div class="col-sm-12" style="padding-right: 218px;padding-left: 217px;" id="appName">
                                            <div class="job-card-header">Application Name</div>
                                            <div class="job-card-content" id="appNameText"><?php echo $jobCardsObject['Application Name']; ?></div>
                                        </div>
									</div>
                                    <div id="appGeneral">
                                        <div class="row job-card-row">
                                            <div class="col-sm-3" id="actionToLead">
                                                <div class="job-card-header">Action to Lead</div>
                                                <div class="job-card-content" id="actionToLeadText"><?php echo $jobCardsObject['Action To Lead']; ?></div>
                                            </div>
                                            <div class="col-sm-6" id="appFunc">
                                                <div class="job-card-header">Application Functionality
                                                </div>
                                                <div class="job-card-content" id="appFuncText">
                                                <?php echo $jobCardsObject['Application Functionality']; ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" id="legalCompHandle">
                                                <div class="job-card-header">Legal Compliance Handled</div>
                                                <div class="job-card-content mb-4" id="legalCompHandleText"><?php echo $jobCardsObject['Legal Compliance Handled']; ?></div>
                                            </div>
                                        </div>
                                        <div class="row job-card-row">
                                            <div class="col-sm-3" id="appType">
                                                <div class="job-card-header">Application Type</div>
                                                <div class="job-card-content" id="appTypeText"><?php echo $jobCardsObject['Application Type']; ?></div>
                                            </div>
                                            <div class="col-sm-3" id="age">
                                                <div class="job-card-header">Age of Application</div>
                                                <div class="job-card-content mb-4" id="ageText"><?php echo $jobCardsObject['Age of Application']; ?></div>
                                            </div>
                                            <div class="col-sm-3" id="docLevel">
                                                <div class="job-card-header">Level of Documentation
                                                </div>
                                                <div class="job-card-content mb-4" id="docLevelText"><?php echo $jobCardsObject['Level of Documentation']; ?></div>
                                            </div>
                                            <div class="col-sm-3" id="supLevel">
                                                <div class="job-card-header">Current Support Level</div>
                                                <div class="job-card-content mb-4" id="supLevelText"><?php echo $jobCardsObject['Support Level']; ?></div>
                                            </div>
                                        </div>
                                        <div class="row job-card-row">
                                            <div class="col-sm-3" id="lob">
                                                <div class="job-card-header">Line of Business</div>
                                                <div class="job-card-content" id="lobText"><?php echo $jobCardsObject['Line of Business']; ?></div>
                                            </div>
                                            <div class="col-sm-3" id="techStack">
                                                <div class="job-card-header">Technology Stack</div>
                                                <div class="job-card-content mb-4" id="techStackText"><?php echo $jobCardsObject['Technology Stack']; ?></div>
                                            </div>
                                            <div class="col-sm-3" id="appOwner">
                                                <div class="job-card-header">Application Ownership</div>
                                                <div class="job-card-content mb-4" id="appOwnerText"><?php echo $jobCardsObject['Application Ownership']; ?></div>
                                            </div>
                                            <div class="col-sm-3" id="appActive">
                                                <div class="job-card-header">Application Active</div>
                                                <div class="job-card-content mb-4 appActiveText"><?php echo $jobCardsObject['Application Active']; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="decomm">
                                        <div class="row job-card-row">
                                            <div class="col-sm-3">
                                                <div id="poa">
                                                    <div class="job-card-header">Point Of Arrival (POA)</div>
                                                    <div class="job-card-content mb-4" id="poaText"><?php echo $jobCardsObject['Point of Arrival (POA)']; ?></div>
                                                </div>
                                                <div id="poaStatus">
                                                    <div class="job-card-header">POA Status</div>
                                                    <div class="job-card-content mb-4" id="poaStatusText"><?php echo $jobCardsObject['POA Status']; ?></div>
                                                </div>
                                                <div id="poaReady">
                                                    <div class="job-card-header">POA Ready By</div>
                                                    <div class="job-card-content mb-4" id="poaReadyText"><?php echo $jobCardsObject['POA Ready By']; ?></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div id="decomStart">
                                                    <div class="job-card-header">Decommission Start Date
                                                    </div>
                                                    <div class="job-card-content mb-4" id="decomStartText"><?php echo $jobCardsObject['Decommission Start Date']; ?></div>
                                                </div>
                                                <div id="decomEnd">
                                                    <div class="job-card-header">Decommission End Date</div>
                                                    <div class="job-card-content mb-4" id="decomEndText"><?php echo $jobCardsObject['Decommission End Date']; ?></div>
                                                </div>
                                                <div id="days">
                                                    <div class="job-card-header">Days to decommission(indicative)</div>
                                                    <div class="job-card-content mb-4" id="daysText"><?php echo $jobCardsObject['Total no of days to decommission (indicative)']; ?></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div id="decomSeq">
                                                    <div class="job-card-header">Decommission Sequence</div>
                                                    <div class="circle" style="font-size: 25px;" id="decomSeqText"><?php echo $jobCardsObject['Decommission Sequence']; ?></div>
                                                </div>
                                                <div id="resReq">
                                                    <div class="job-card-header">Resources required</div>
                                                    <div class="job-card-content mb-4" id="resReqText"><?php echo $jobCardsObject['Resources Required to Decommission']; ?></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" id="decomPatternDetail">
                                                <div class="job-card-header">Decomission Pattern Details
                                                </div>
                                                <table id="myTable" class="table table-striped">
                                                    <tbody>
                                                        <tr id="gapAnalysis">
                                                            <td class="dpd-td">Gap Analysis </td>
                                                            <td class="dpd-td" id="gapAnalysisText"><?php echo $jobCardsObject['DPD: Gap Analysis']; ?></td>
                                                        </tr>
                                                        <tr id="dataMigration">
                                                            <td class="dpd-td">
                                                                Data Migration </td>
                                                            <td class="dpd-td" id="dataMigrationText"><?php echo $jobCardsObject['DPD: Data Migration']; ?></td>
                                                        </tr>
                                                        <tr id="userMigration">
                                                            <td class="dpd-td">
                                                                User Migration </td>
                                                            <td class="dpd-td" id="userMigrationText"><?php echo $jobCardsObject['DPD: User Migration']; ?></td>
                                                        </tr>
                                                        <tr id="switchOff">
                                                            <td class="dpd-td">
                                                                Switch-Off </td>
                                                            <td class="dpd-td" id="switchOffText"><?php echo $jobCardsObject['DPD: Switch-Off']; ?></td>
                                                        </tr>
                                                        <tr id="bigBang">
                                                            <td class="dpd-td">
                                                                Big Bang </td>
                                                            <td class="dpd-td" id="bigBangText"><?php echo $jobCardsObject['DPD: Big Bang']; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php   
                            }
                            ?>
                        </div>
                    </div>


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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->

    <script>
        $( document ).ready(function() {
            $('#myTable td').each(function() {
                // console.log($(this).text());
                if($(this).text() == "Yes") {
                    $(this).css("background-color","green");
                } else if($(this).text() == "No") {
                    $(this).css("background-color","red");
                }
            });

            $('.appActiveText').each(function() {
                // console.log($(this).text());
                if($(this).text() == "Yes") {
                    $(this).css("background-color","green");
                } else if($(this).text() == "No") {
                    $(this).css("background-color","red");
                }
            })
        });
    </script>


    <!-- Scripts For download  -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
	<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>	
	
	<script>
	//download
		// function CreatePDFfromHTML() {
		// 	app = $("#selJobCards").val();
		// 	var HTML_Width = $(".html-content").width();
		// 	var HTML_Height = $(".html-content").height();
		// 	var top_left_margin = 15;
		// 	var canvas_image_width = HTML_Width;
		// 	var canvas_image_height = HTML_Height;
            
		// 	html2canvas($(".html-content")[0]).then(function (canvas) {
		// 		var imgData = canvas.toDataURL("image/jpeg", 1.0);
		// 		var pdf = new jsPDF('p', 'pt', [canvas_image_width+25, canvas_image_height+25]);
		// 		pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
				
		// 		pdf.save("JobCards.pdf");
				
		// 	});
		// }
        $( document ).ready(function() {
            app = $("#selJobCards").val();
            var HTML_Width = $(".html-content").width();
            var HTML_Height = $(".html-content").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;
            
            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
            
            html2canvas($(".html-content")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]); 
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height); 
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                
                pdf.save(app+".pdf");
                //$(".html-content").hide();
            });
        });
            </script>
            
            </body>
            
            </html>