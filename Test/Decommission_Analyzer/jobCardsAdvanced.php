<?php 
error_reporting(0);
require_once './pages/auth/pageHandler.php';

ob_start();
session_start();
// echo "Hello from PHP!";
$_SESSION['currentPage'] = 'jobCards';

$jobCards = array(
    "Age Analysis",
    "APR",
    "AXAL Mainframe Downloads",
    "Cash Manager 2",
    "Cash Manager Archive View",
    "Cash Manager Upload",
    "Cash Manager",
    "Civil Service Deductions",
    "CKB",
    "Cobra",
    "Copernicus",
    "Death Claim Folios",
    "Direct Debit Mandate",
    "Late Interest",
    "PC Dumps",
    "PPF Hard Disclosure Quotes",
    "Quick Dump",
    "SLPM",
    "Surrenders Database Data Conversion",
    "Surrenders SLUA",
);

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
    input {
        text-align: center;
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
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                <!-- Button trigger modal -->
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
                                                    <input class="form-check-input" type="checkbox" value="Select All"
                                                        id="selectAll">
                                                    <label class="form-check-label" for="selectAll">Select All</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="Action To Lead" id="atlCheck">
                                                    <label class="form-check-label" for="atlCheck">Action To
                                                        Lead</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="Application Type" id="atCheck">
                                                    <label class="form-check-label" for="atCheck">Application
                                                        Type</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="Decommission Pattern" id="dpCheck">
                                                    <label class="form-check-label" for="dpCheck">Decommission
                                                        Pattern</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="Application Active" id="aaCheck">
                                                    <label class="form-check-label" for="aaCheck">Application
                                                        Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="Decommssion Start Data" id="dsdCheck">
                                                    <label class="form-check-label" for="dsdCheck">Decommssion Start
                                                        Data</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="Decommssion End Data" id="dedCheck">
                                                    <label class="form-check-label" for="dedCheck">Decommssion End
                                                        Data</label>
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
                            </div>
                        </div>

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
                                    <!-- <a href="#" class="btn btn-primary"><i class="fas fa-download"></i></a> -->
                                </div>
                                <!-- Card Body -->
                                <div class="card-body text-center" id="mainContent">
                                    <!-- <embed id="document" src="./data/Job_Cards/JobCards.pdf" width="1106" height="672" type="application/pdf"> -->
                                    <!-- <form> -->
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary" id="appName"
                                            style="border-radius: 40px !important;" role="button"
                                            aria-disabled="true">Application Name</a>
                                    </div>
                                    <div class="form-group" id="actionToLeadBlock">
                                        <label class="font-weight-bold" for="actionToLead">Action To Lead</label>
                                        <input type="text" class="form-control" id="actionToLead"
                                            placeholder="Decommission" readonly>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4" id="appTypeBlock">
                                            <label class="font-weight-bold" for="appType">Application Type</label>
                                            <input type="text" class="form-control" id="appType"
                                                placeholder="Application Type" readonly>
                                        </div>
                                        <div class="form-group col-md-8" id="decommPatternBlock">
                                            <label class="font-weight-bold" for="decommPattern">Decommission
                                                Pattern</label>
                                            <textarea class="form-control" rows="1" id="decommPattern"
                                                readonly> asdkfhlahdflkjhaskldf aljkshgfoikasjdl;fk asodfaksjdf sdfhj lkjasldf  oh alsdflj</textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4" id="appActiveBlock">
                                            <label class="font-weight-bold" for="appActive">Application
                                                Active</label>
                                            <a href="#" class="btn btn-success form-control" id="appActive">Yes /
                                                No</a>
                                        </div>
                                        <div class="form-group col-md-4" id="decommStartBlock">
                                            <label class="font-weight-bold" for="decommStart">Decommssion Start
                                                Data</label>
                                            <input type="text" class="form-control" id="decommStart" placeholder="TBD"
                                                readonly>
                                        </div>
                                        <div class="form-group col-md-4" id="decommEndBlock">
                                            <label class="font-weight-bold" for="decommEnd">Decommssion End
                                                Data</label>
                                            <input type="text" class="form-control" id="decommEnd" placeholder="TBD"
                                                readonly>
                                        </div>
                                    </div>
                                    <!-- <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label class="font-weight-bold" for="appAge">Age of Application</label>
                                                <input type="text" class="form-control" id="appAge" placeholder="> 20 Years" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="font-weight-bold" for="decommPatternDetail">Decommission Pattern Detail</label>   
                                                <div class="form-control" id="decommPatternDetail">
                                                    <table class="table table-hover table-responsive">
                                                        <tbody>
                                                            <tr>
                                                                <td>Data Migration</td>
                                                                <td>Yes</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Gap Analysis</td>
                                                                <td>No</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Big Bang</td>
                                                                <td>Yes</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> -->
                                    <!-- </form> -->
                                    <button class="btn btn-primary" onclick="javascript:demoFromHTML();">PDF</button>
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

    <!-- JS PDF -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.debug.js"></script>

    <script>
    // $('#cmd').click(CreatePDFfromHTML());

    function demoFromHTML() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#mainContent')[0];

        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function(element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function(dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }, margins
        );
    }
    </script>

    <script>
    //  API Inclusion 
    <?php include './pages/api/jobCards.php'; ?>
    var appData = <?php echo json_encode($appSet); ?>;
    // appData = JSON.parse(appData);

    // var app = $("#selJobCards").prop("selectedIndex", 0).val();
    $('#selJobCards').change(function() {
        app = $("#selJobCards").val();
        console.log(app);
        $.each(appData, function() {
            $.each(this, function(k, v) {
                if (k == app) {
                    console.log(v);

                    $('#actionToLead').attr('placeholder', v[0]['Action To Lead']);

                    return;
                }
            });
        });
    });
    </script>

    <script>
    // $('#appName').hide();
    // $('#actionToLeadBlock').hide();
    // $('#appTypeBlock').hide();
    // $('#decommPatternBlock').hide();
    // $('#appActiveBlock').hide();
    // $('#decommStartBlock').hide();
    // $('#decommEndBlock').hide();
    // $('#cmd').hide();

    $("#saveModal").click(function() {

        if ($('.form-check-input').is(':checked')) {
            // alert('checked');
            $('#appName').show();
            $('#cmd').show();
        } else {
            $('#appName').hide();
            $('#cmd').hide();
        }


        if ($("#atlCheck").is(':checked')) {
            $('#actionToLeadBlock').show();
        } else {
            $('#actionToLeadBlock').hide();
        }

        if ($("#atCheck").is(':checked')) {
            $('#appTypeBlock').show();
        } else {
            $('#appTypeBlock').hide();
        }

        if ($("#dpCheck").is(':checked')) {
            $('#decommPatternBlock').show();
        } else {
            $('#decommPatternBlock').hide();
        }

        if ($("#aaCheck").is(':checked')) {
            $('#appActiveBlock').show();
        } else {
            $('#appActiveBlock').hide();
        }

        if ($("#dsdCheck").is(':checked')) {
            $('#decommStartBlock').show();
        } else {
            $('#decommStartBlock').hide();
        }

        if ($("#dedCheck").is(':checked')) {
            $('#decommEndBlock').show();
        } else {
            $('#decommEndBlock').hide();
        }
    });

    $("#clearModal").click(function() {
        $('#selectAll').prop('checked', false);
        $('#atlCheck').prop('checked', false);
        $('#atCheck').prop('checked', false);
        $('#dpCheck').prop('checked', false);
        $('#aaCheck').prop('checked', false);
        $('#dsdCheck').prop('checked', false);
        $('#dedCheck').prop('checked', false);
    });


    $('#selectAll').click(function() {
        if ($("#selectAll").is(':checked')) {
            $(".form-check-input").prop('checked', true);
        } else {
            $(".form-check-input").prop('checked', false);
        }

    });
    </script>

</body>

</html>