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
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Select an Job Card to View</h6>
                                    <div class="dropdown no-arrow">
                                        <select class="form-control" name="jobCards" id="selJobCards">
                                            <option selected disabled>Choose Job Card</option>
                                            <?php
                                                    foreach($jobCards as $jobCard) {
                                                        echo "<option>". $jobCard. "</option>";
                                                    }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body text-center">
                                    <!-- <embed id="document" src="./data/Job_Cards/JobCards.pdf" width="1106" height="672"
                                        type="application/pdf"> -->
                                        
										<div class="col-xl-12 col-lg-12">
											<div
												class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
												<h6 class="m-0 font-weight-bold text-primary">JOB CARD - Cash Manager </h6>	
											</div>
										</div>
										<div class="row" style="margin-top:20px;">
											<div class="col-sm-3">
												<div style="text-align:center;"><strong>Application Name</strong></div>
												<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">Cash Manager</div>
											</div>
											<div  class="col-sm-3">
												<div style="text-align:center;"><strong>Action To Lead</strong></div>
												<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">Replace</div>
											</div>
											<div  class="col-sm-3">
												<div style="text-align:center;"><strong>Application Type</strong></div>
												<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">Desktop</div>
											</div>
											<div  class="col-sm-3">
												<div style="text-align:center;"><strong>Line of Business</strong></div>
												<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">Financial/Actuarial</div>
											</div>
										</div>
										<div class="row" style="margin-top:20px;">
											<div class="col-sm-3">
												<div style="text-align:center;"><strong>Technology Stack</strong></div>
												<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">Xbase++ <BR> </BR></div>
											</div>
											<div class="col-sm-6">
												<div style="text-align:center;"><strong>Application Functionality</strong></div>
												<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">
												Matching tool to compare monthly paid and dues and report mismatches, retains data from previous month - for future processing
												</div>
											</div>
											<div class="col-sm-3">
												<div style="text-align:center;"><strong>Application Ownership</strong></div>
												<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">In-house <BR> </BR></div>
											</div>
										</div>
										<div class="row" style="margin-top:20px;">
											<div class="col-sm-3">
												<div style="text-align:center;"><strong>Application Active</strong></div>
												<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">YES</div>
											</div>
											<div  class="col-sm-3">
												<div style="text-align:center;"><strong>Point Of Arrival (POA)</strong></div>
												<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">Cash Mangr Replacement</div>
											</div>
											<div  class="col-sm-3">
												<div style="text-align:center;"><strong>POA Status</strong></div>
												<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">To be Started</div>
											</div>
											<div  class="col-sm-3">
												<div style="text-align:center;"><strong>POA Ready By</strong></div>
												<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">Q3'23'</div>
											</div>
										</div>
										<div class="row" style="margin-top:20px;">
											
											<div class="col-sm-3">
												<div style="text-align:center;"><strong>Decomission Pattern Detail</strong></div>
												<table id="myTable" class="table table-striped">
													<tbody>
														<tr style="padding:4px !important;">
														 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;">Gap Analysis </td>
														 <td style="background-color:#E10600;text-align:center;color:#FFFFFF;padding:4px !important;" id="#"> <?php echo "No"?></td>
														</tr>
														<tr>
														 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Migration </td>
														 <td style="background-color:#006E33;text-align:center;color:#FFFFFF;padding:4px !important;" id="#"> <?php echo "Yes"?></td>
														</tr>
														<tr>
														 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> User Migration </td>
														 <td style="background-color:#006E33;text-align:center;color:#FFFFFF;padding:4px !important;" id="#"><?php echo "Yes"?></td>
														</tr>
														<tr>
														 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Switch-Off </td>
														 <td style="background-color:#006E33;text-align:center;color:#FFFFFF;padding:4px !important;" id="#"> <?php echo "Yes"?></td>
														</tr>
														<tr>
														 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Big Bang </td>
														 <td style="background-color:#E10600;text-align:center;color:#FFFFFF;padding:4px !important;" id="#"> <?php echo "No"?></td>
														</tr>
													</tbody>
												</table>
											</div>
											
											



											<div class="col-sm-3">
												<div style="text-align:center;"><strong>Decommission Start Date</strong></div>
													<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">TBD</div>
												<div style="text-align:center;"><strong>Decommission Sequence</strong></div>
													<div style="margin-bottom:15px;">18</div>
												<div style="text-align:center;"><strong>Level of Documentation</strong></div>
													<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">Shared Team</div>
											</div>
											<div class="col-sm-3">
												<div style="text-align:center;"><strong>Decommission End Date</strong></div>
													<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">TBD</div>
												<div style="text-align:center;"><strong>Resources required to Decomission</strong></div>
													<div style="margin-bottom:15px;">3</div>
												<div style="text-align:center;"><strong>Support Level</strong></div>
													<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">Shared Service Model</div>
											</div>
											<div class="col-sm-3">
												<div style="text-align:center;"><strong>Age of Application</strong></div>
													<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">> 20 YEARS</div>
												<div style="text-align:center;"><strong>Days to decommission (indicative)</strong></div>
													<div style="margin-bottom:15px;">6</div>
												<div style="text-align:center;"><strong>Legal Compliance Handled</strong></div>
													<div style="background-color:#342668;text-align:center;color:#FFFFFF;padding:4px;margin-bottom:15px;">YES</div>
											</div>
										</div>
								</div>
                            </div>
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
    var lob = $("#selJobCards").prop("selectedIndex", 0).val();
    $('#selJobCards').change(function() {
        lob = $("#selJobCards").val();
        var parent = $('embed#document').parent();
        var newElement = "<embed src='./data/Job_Cards/" + lob +
            ".pdf' id='document' width='1106' height='672' type='application/pdf'>";
        $('embed#document').remove();
        parent.append(newElement);
    });
    </script>

</body>

</html>