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
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-around">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#criteriaModal"> <i
                                            class="fas fa-filter"></i> Select Criteria</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="criteriaModal" tabindex="-1" role="dialog"
                                        aria-labelledby="criteriaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="criteriaModalLabel">Select the Job Card
                                                        Criteria</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Select All" id="selectAllCheck">
                                                        <label class="form-check-label" for="selectAllCheck">Select
                                                            All</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Application Name" id="appNameCheck">
                                                        <label class="form-check-label" for="appNameCheck">Application
                                                            Name</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Action To Lead" id="actionToLeadCheck">
                                                        <label class="form-check-label" for="actionToLeadCheck">Action
                                                            To
                                                            Lead</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Application Type" id="appTypeCheck">
                                                        <label class="form-check-label" for="appTypeCheck">Application
                                                            Type</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Line of Business" id="lobCheck">
                                                        <label class="form-check-label" for="lobCheck">Line of
                                                            Business</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Technology Stack" id="techStackCheck">
                                                        <label class="form-check-label" for="techStackCheck">Technology
                                                            Stack</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Application Functionality" id="appFuncCheck">
                                                        <label class="form-check-label" for="appFuncCheck">Application
                                                            Functionality</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Application Ownership" id="appOwnerCheck">
                                                        <label class="form-check-label" for="appOwnerCheck">Application
                                                            Ownership</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Application Active" id="appActiveCheck">
                                                        <label class="form-check-label" for="appActiveCheck">Application
                                                            Active</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Point Of Arrival" id="poaCheck">
                                                        <label class="form-check-label" for="poaCheck">Point Of
                                                            Arrival</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="POA Status" id="poaStatusCheck">
                                                        <label class="form-check-label" for="poaStatusCheck">POA
                                                            Status</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="POA Ready by" id="poaReadyCheck">
                                                        <label class="form-check-label" for="poaReadyCheck">POA Ready
                                                            by</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Decommission Start Date" id="decomStartCheck">
                                                        <label class="form-check-label"
                                                            for="decomStartCheck">Decommission Start Date</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Decommission End Date" id="decomEndCheck">
                                                        <label class="form-check-label" for="decomEndCheck">Decommission
                                                            End Date</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Age of Application" id="ageCheck">
                                                        <label class="form-check-label" for="ageCheck">Age of
                                                            Application</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Decommission Sequence" id="decomSeqCheck">
                                                        <label class="form-check-label" for="decomSeqCheck">Decommission
                                                            Sequence</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Resources Required" id="resReqCheck">
                                                        <label class="form-check-label" for="resReqCheck">Resources
                                                            Required</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Days to Decommission" id="daysCheck">
                                                        <label class="form-check-label" for="daysCheck">Days to
                                                            Decommission</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Level of Documentation" id="docLevelCheck">
                                                        <label class="form-check-label" for="docLevelCheck">Level of
                                                            Documentation</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Support Level" id="supLevelCheck">
                                                        <label class="form-check-label" for="supLevelCheck">Support
                                                            Level</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Legal Compliance Handled" id="legalCompHandleCheck">
                                                        <label class="form-check-label" for="legalCompHandleCheck">Legal
                                                            Compliance Handled</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Gap Analysis" id="gapCheck">
                                                        <label class="form-check-label" for="gapCheck">Gap
                                                            Analysis</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Data Migration" id="dataMigrationCheck">
                                                        <label class="form-check-label" for="dataMigrationCheck">Data
                                                            Migration</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="User Migration" id="userMigrationCheck">
                                                        <label class="form-check-label" for="userMigrationCheck">User
                                                            Migration</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="Switch-Off" id="switchOffCheck">
                                                        <label class="form-check-label"
                                                            for="switchOffCheck">Switch-Off</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Big Bang"
                                                            id="bigBangCheck">
                                                        <label class="form-check-label" for="bigBangCheck">Big
                                                            Bang</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        id="clearModal">Clear</button>
                                                    <button type="button" class="btn btn-primary" id="saveModal"
                                                        data-dismiss="modal">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    <a href="#" class="btn btn-primary"><i class="fas fa-download"></i></a>
                                </div>
                                <!-- Card Body -->
                                <!-- Job Card -->
                                <div class="card-body text-center">
                                    <div class="row job-card-row">
                                        <div class="col-sm-3" id="appName">
                                            <div class="job-card-header">Application Name</div>
                                            <div class="job-card-content" id="appNameText">Cash Manager</div>
                                        </div>
                                        <div class="col-sm-3" id="actionToLead">
                                            <div class="job-card-header">Action to Lead</div>
                                            <div class="job-card-content" id="actionToLeadText">Replace</div>
                                        </div>
                                        <div class="col-sm-3" id="appType">
                                            <div class="job-card-header">Application Type</div>
                                            <div class="job-card-content" id="appTypeText">Desktop</div>
                                        </div>
                                        <div class="col-sm-3" id="lob">
                                            <div class="job-card-header">Line of Business</div>
                                            <div class="job-card-content" id="lobText">Financial/Actuarial</div>
                                        </div>
                                    </div>
                                    <div class="row job-card-row">
                                        <div class="col-sm-3" id="techStack">
                                            <div class="job-card-header">Technology Stack</div>
                                            <div class="job-card-content" id="techStackText">Xbase++</div>
                                        </div>
                                        <div class="col-sm-6" id="appFunc">
                                            <div class="job-card-header">Application Functionality
                                            </div>
                                            <div class="job-card-content" id="appFuncText">
                                                Matching tool to compare monthly paid and dues and report mismatches,
                                                retains data from previous month - for future processing
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="appOwner">
                                            <div class="job-card-header">Application Ownership</div>
                                            <div class="job-card-content" id="appOwnerText">In-house</div>
                                        </div>
                                    </div>
                                    <div class="row job-card-row">
                                        <div class="col-sm-3" id="appActive">
                                            <div class="job-card-header">Application Active</div>
                                            <div class="job-card-content" id="appActiveText">YES</div>
                                        </div>
                                        <div class="col-sm-3" id="poa">
                                            <div class="job-card-header">Point Of Arrival (POA)
                                            </div>
                                            <div class="job-card-content" id="poaText">
                                                Cash Mangr Replacement</div>
                                        </div>
                                        <div class="col-sm-3" id="poaStatus">
                                            <div class="job-card-header">POA Status</div>
                                            <div class="job-card-content" id="poaStatusText">
                                                To be Started</div>
                                        </div>
                                        <div class="col-sm-3" id="poaReady">
                                            <div class="job-card-header">POA Ready By</div>
                                            <div class="job-card-content" id="poaReadyText">
                                                Q3'23'</div>
                                        </div>
                                    </div>
                                    <div class="row job-card-row">
                                        <div class="col-sm-3" id="decomPatternDetail">
                                            <div class="job-card-header">Decomission Pattern Detail
                                            </div>
                                            <table id="myTable" class="table table-striped">
                                                <tbody>
                                                    <tr id="gapAnalysis">
                                                        <td class="dpd-td">
                                                            Gap Analysis </td>
                                                        <td class="dpd-td" id="gapAnalysisText">No</td>
                                                    </tr>
                                                    <tr id="dataMigration">
                                                        <td class="dpd-td">
                                                            Data Migration </td>
                                                        <td class="dpd-td" id="dataMigrationText">Yes</td>
                                                    </tr>
                                                    <tr id="userMigration">
                                                        <td class="dpd-td">
                                                            User Migration </td>
                                                        <td class="dpd-td" id="userMigrationText">Yes</td>
                                                    </tr>
                                                    <tr id="switchOff">
                                                        <td class="dpd-td">
                                                            Switch-Off </td>
                                                        <td class="dpd-td" id="switchOffText">Yes</td>
                                                    </tr>
                                                    <tr id="bigBang">
                                                        <td class="dpd-td">
                                                            Big Bang </td>
                                                        <td class="dpd-td" id="bigBangText">No</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-sm-3">
                                            <div id="decomStart">
                                                <div class="job-card-header">Decommission Start Date
                                                </div>
                                                <div class="job-card-content mb-4" id="decomStartText">TBD</div>
                                            </div>
                                            <div id="decomSeq">
                                                <div class="job-card-header">Decommission Sequence</div>
                                                <div class="job-card-content mb-4" id="decomSeqText">18</div>
                                            </div>
                                            <div id="docLevel">
                                                <div class="job-card-header">Level of Documentation
                                                </div>
                                                <div class="job-card-content mb-4" id="docLevelText">Shared Team</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div id="decomEnd">
                                                <div class="job-card-header">Decommission End Date</div>
                                                <div class="job-card-content mb-4" id="decomEndText">TBD</div>
                                            </div>
                                            <div id="resReq">
                                                <div class="job-card-header">Resources required</div>
                                                <div class="job-card-content mb-4" id="resReqText">3</div>
                                            </div>
                                            <div id="supLevel">
                                                <div class="job-card-header">Support Level</div>
                                                <div class="job-card-content mb-4" id="supLevelText">Shared Service
                                                    Model</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div id="age">
                                                <div class="job-card-header">Age of Application</div>
                                                <div class="job-card-content mb-4" id="ageText">> 20 Years</div>
                                            </div>
                                            <div id="days">
                                                <div class="job-card-header">Days to decommission(indicative)</div>
                                                <div class="job-card-content mb-4" id="daysText">6</div>
                                            </div>
                                            <div id="legalCompHandle">
                                                <div class="job-card-header">Legal Compliance Handled</div>
                                                <div class="job-card-content mb-4" id="legalCompHandleText">Yes</div>
                                            </div>
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
    //  API Inclusion 
    <?php include './pages/api/jobCards.php'; ?>
    var appData = <?php echo json_encode($appSet); ?>;

    $('#selJobCards').change(function() {
        app = $("#selJobCards").val();
        console.log(app);
        $.each(appData, function() {
            $.each(this, function(k, v) {
                if (k == app) {
                    console.log(v);

                    // $('#actionToLead').attr('placeholder', v[0]['Action To Lead']);
                    $('#appNameText').text(v[0]['Application Name']);
                    $('#actionToLeadText').text(v[0]['Action To Lead']);
                    $('#appTypeText').text(v[0]['Application Type']);
                    $('#lobText').text(v[0]['Line of Business']);
                    $('#techStackText').text(v[0]['Technology Stack']);
                    $('#appFuncText').text(v[0]['Application Functionality']);
                    $('#appOwnerText').text(v[0]['Application Ownership']);
                    $('#appActiveText').text(v[0]['Application Active']);
                    $('#poaText').text(v[0]['Point Of Arrival']);
                    $('#poaStatusText').text(v[0]['POA Status']);
                    $('#poaReadyText').text(v[0]['POA Ready']);
                    $('#gapAnalysisText').text(v[0]['Gap Analysis']);
                    $('#dataMigrationText').text(v[0]['Data Migration']);
                    $('#userMigrationText').text(v[0]['User Migration']);
                    $('#switchOffText').text(v[0]['Switch-Off']);
                    $('#bigBangText').text(v[0]['Big Bang']);
                    $('#decomStartText').text(v[0]['Decommission Start Date']);
                    $('#decomSeqText').text(v[0]['Decommission Sequence']);
                    $('#docLevelText').text(v[0]['Level of Documentation']);
                    $('#decomEndText').text(v[0]['Decommission End Date']);
                    $('#resReqText').text(v[0]['Resources Required to Decommission']);
                    $('#supLevelText').text(v[0]['Support Level']);
                    $('#ageText').text(v[0]['Age of Application']);
                    $('#daysText').text(v[0]['Total no of days to decommission']);
                    $('#legalCompHandleText').text(v[0]['Legal Compliance Handled']);

                    return;
                }
            });
        });
    });
    </script>

    <script>
    // Select All
    $('#selectAllCheck').click(function() {
        if ($("#selectAllCheck").is(':checked')) {
            $(".form-check-input").prop('checked', true);
        } else {
            $(".form-check-input").prop('checked', false);
        }
    });

    // Clear
    $("#clearModal").click(function() {
        $(".form-check-input").prop('checked', false);
    });

    // Change colour of DPD Table td Elements
    $('td').each(function() {
        var cellText = $(this).text();
        if (cellText == "No") {
            $(this).css('background-color', 'red')
        }
        if (cellText == "Yes") {
            $(this).css('background-color', 'green')
        }
    });

    // On change of Application
    $('#selJobCards').change(function() {
        if ($('#gapAnalysisText').text() == "No") {
            $('#gapAnalysisText').css('background-color', 'red');
        } else if ($('#gapAnalysisText').text() == "Yes") {
            $('#gapAnalysisText').css('background-color', 'green');
        }
        if ($('#dataMigrationText').text() == "No") {
            $('#dataMigrationText').css('background-color', 'red');
        } else if ($('#dataMigrationText').text() == "Yes") {
            $('#dataMigrationText').css('background-color', 'green');
        }
        if ($('#userMigrationText').text() == "No") {
            $('#userMigrationText').css('background-color', 'red');
        } else if ($('#userMigrationText').text() == "Yes") {
            $('#userMigrationText').css('background-color', 'green');
        }
        if ($('#switchOffText').text() == "No") {
            $('#switchOffText').css('background-color', 'red');
        } else if ($('#switchOffText').text() == "Yes") {
            $('#switchOffText').css('background-color', 'green');
        }
        if ($('#bigBangText').text() == "No") {
            $('#bigBangText').css('background-color', 'red');
        } else if ($('#bigBangText').text() == "Yes") {
            $('#bigBangText').css('background-color', 'green');
        }
    });

    // Filter the JobCard content
    $("#saveModal").click(function() {
        if ($("#appNameCheck").is(':checked')) {
            $('#appName').show();
        } else {
            $('#appName').hide();
        }

        if ($("#actionToLeadCheck").is(':checked')) {
            $('#actionToLead').show();
        } else {
            $('#actionToLead').hide();
        }
        if ($("#appTypeCheck").is(':checked')) {
            $('#appType').show();
        } else {
            $('#appType').hide();
        }
        if ($("#lobCheck").is(':checked')) {
            $('#lob').show();
        } else {
            $('#lob').hide();
        }
        if ($("#techStackCheck").is(':checked')) {
            $('#techStack').show();
        } else {
            $('#techStack').hide();
        }
        if ($("#appFuncCheck").is(':checked')) {
            $('#appFunc').show();
        } else {
            $('#appFunc').hide();
        }
        if ($("#appOwnerCheck").is(':checked')) {
            $('#appOwner').show();
        } else {
            $('#appOwner').hide();
        }
        if ($("#appActiveCheck").is(':checked')) {
            $('#appActive').show();
        } else {
            $('#appActive').hide();
        }
        if ($("#poaCheck").is(':checked')) {
            $('#poa').show();
        } else {
            $('#poa').hide();
        }
        if ($("#poaStatusCheck").is(':checked')) {
            $('#poaStatus').show();
        } else {
            $('#poaStatus').hide();
        }
        if ($("#poaReadyCheck").is(':checked')) {
            $('#poaReady').show();
        } else {
            $('#poaReady').hide();
        }
        if ($("#decomStartCheck").is(':checked')) {
            $('#decomStart').show();
        } else {
            $('#decomStart').hide();
        }
        if ($("#decomEndCheck").is(':checked')) {
            $('#decomEnd').show();
        } else {
            $('#decomEnd').hide();
        }
        if ($("#ageCheck").is(':checked')) {
            $('#age').show();
        } else {
            $('#age').hide();
        }
        if ($("#decomSeqCheck").is(':checked')) {
            $('#decomSeq').show();
        } else {
            $('#decomSeq').hide();
        }
        if ($("#resReqCheck").is(':checked')) {
            $('#resReq').show();
        } else {
            $('#resReq').hide();
        }
        if ($("#daysCheck").is(':checked')) {
            $('#days').show();
        } else {
            $('#days').hide();
        }
        if ($("#docLevelCheck").is(':checked')) {
            $('#docLevel').show();
        } else {
            $('#docLevel').hide();
        }
        if ($("#supLevelCheck").is(':checked')) {
            $('#supLevel').show();
        } else {
            $('#supLevel').hide();
        }
        if ($("#legalCompHandleCheck").is(':checked')) {
            $('#legalCompHandle').show();
        } else {
            $('#legalCompHandle').hide();
        }
        if ($("#gapCheck").is(':checked')) {
            var gapFlag = true;
            $('#gapAnalysis').show();
        } else {
            $('#gapAnalysis').hide();
        }
        if ($("#dataMigrationCheck").is(':checked')) {
            var dataFlag = true;
            $('#dataMigration').show();
        } else {
            $('#dataMigration').hide();
        }
        if ($("#userMigrationCheck").is(':checked')) {
            var userFlag = true;
            $('#userMigration').show();
        } else {
            $('#userMigration').hide();
        }
        if ($("#switchOffCheck").is(':checked')) {
            var switchFlag = true;
            $('#switchOff').show();
        } else {
            $('#switchOff').hide();
        }
        if ($("#bigBangCheck").is(':checked')) {
            var bigFlag = true;
            $('#bigBang').show();
        } else {
            $('#bigBang').hide();
        }

        if (gapFlag || dataFlag || userFlag || switchFlag || bigFlag) {
            $('#decomPatternDetail').show();
        } else {
            $('#decomPatternDetail').hide();
        }

    });
    </script>

</body>

</html>