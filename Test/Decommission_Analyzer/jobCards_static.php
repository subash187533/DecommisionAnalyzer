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
                                    <!-- <iframe
                                        src="https://capgemini-my.sharepoint.com/personal/thilagavathi_b_capgemini_com/_layouts/15/Doc.aspx?sourcedoc={44c77e2b-e833-461c-9bc8-636ab3c29896}&amp;action=embedview&amp;wdAr=1.7777777777777777"
                                        width="962px" height="565px" frameborder="0">This is an embedded <a
                                            target="_blank" href="https://office.com">Microsoft Office</a> presentation,
                                        powered by <a target="_blank"
                                            href="https://office.com/webapps">Office</a>.</iframe> -->
                                    <embed id="document" src="./data/Job_Cards/JobCards.pdf" width="1106" height="672"
                                        type="application/pdf">
                                    <!-- <embed src="./data/PHP_SLIDES.pdf" type="application/pdf"> -->
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