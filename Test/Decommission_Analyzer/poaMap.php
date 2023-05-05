<?php 
error_reporting(0);
require_once './pages/auth/pageHandler.php';
session_start();
$_SESSION['currentPage'] = 'poaMap';

// PHP To get the LOB's from DB 
$m = new MongoClient();
$db = $m->test_decommission_analyzer;
$collection = $db->poa;
$lobs = $collection->distinct("LOB");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Decommission Analyzer - POA Map</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style>
    #sankeyChart {
        width: 100%;
        height: 100%;
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
                        <h1 class="h3 mb-0 text-gray-800">Point of Arrival by Applications</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Select an LOB to Filterout POA</h6>
                                    <div class="dropdown no-arrow">
                                        <select class="form-control" name="lob" id="selLob">
                                            <option selected disabled>Choose LOB</option>
                                            <?php
                                                sort($lobs);
                                                foreach($lobs as $lob) {
                                                    if($lob == "") continue;
                                            ?>
                                            <option><?php echo $lob; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div id="chartDiv" class="chart-area">
                                        <div id="sankeyChart"></div>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Sankey Chart Scripts -->
    <script src="js/4/core.js"></script>
    <script src="js/4/charts.js"></script>
    <script src="js/4/animated.js"></script>

    <!-- Chart code -->
    <script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        am4core.options.commercialLicense = true;
        // Themes end

        var chart = am4core.create("sankeyChart", am4charts.SankeyDiagram);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        <?php


            $uniquelobs = $collection->distinct('LOB');
            // print_r($uniquelobs);
            $lobSet = array();
            $dataSet = array();

            foreach($uniquelobs as $lob) {
                $dataByLob = $collection->find(array('LOB' => $lob));
                foreach($dataByLob as $data) {        
                    $dataSet[] = array (
                        "from" => $data["Applications"],
                        "to" => $data["TargetApplication"],
                        "value" => 1
                    );
                } 
                $lobSet[] = array($lob=>$dataSet);
                $dataSet = array();
            }

        ?>

        var lobData = '<?php echo json_encode($lobSet);?>';
        lobData = JSON.parse(lobData);

        // console.log(lobData);

        var lob = $("#selLob").prop("selectedIndex", 0).val();
        $('#selLob').change(function() {
            lob = $("#selLob").val();
            // console.log(lob);
            $.each(lobData, function() {
                $.each(this, function(k, v) {
                    if (k == lob) {
                        chart.data = v;
                        $('#chartDiv').height(chart.data.length * 50);
                        console.log(v);
                        return;
                    }

                });
            });
        });

        // When no lob is selected, show all the applications
        chart.data = [
            <?php
                $datas = $collection->find();
                foreach($datas as $data) {
                    // $value = $collection->find(array("Applications" => $data["Applications"], "TargetApplication" => $data["TargetApplication"]))-> count();
                    // echo '{"from":"'. $data["Applications"]. '", "to":"'. $data["TargetApplication"]. '", "value": '. $value .'},';
                    echo '{"from":"'. $data["Applications"]. '", "to":"'. $data["TargetApplication"]. '", "value": 1},';
                }
            ?>
        ];
        $('#chartDiv').height(chart.data.length * 50);

        chart.links.template.tooltipText = "{fromName} → {toName} ";
        let hoverState = chart.links.template.states.create("hover");
        hoverState.properties.fillOpacity = 4.6;

        chart.dataFields.fromName = "from";
        chart.dataFields.toName = "to";
        chart.dataFields.value = "value";
        chart.fontSize = 12;

        // for right-most label to fit
        chart.paddingRight = 140;

        chart.nodes.template.nameLabel.label.truncate = false;
        chart.nodes.template.nameLabel.label.wrap = true;


        am4charts.SankeyNode.showTooltipOn = "always";

        var targetName = "{toName}";
        var output = "";
        $.ajax({
            type: "POST",
            url: "./pages/api/postPoaTarget.php",
            datatype: "html",
            data: targetName,
            success: function(data) {
                console.log(data);
                output = data;
                }
        });

        

        // make nodes draggable
        var nodeTemplate = chart.nodes.template;
        nodeTemplate.inert = true;
        nodeTemplate.readerTitle = output;
        nodeTemplate.showSystemTooltip = true;
        nodeTemplate.width = 20;
        nodeTemplate.cursorOverStyle = am4core.MouseCursorStyle.pointer;

        // Exporting
        chart.exporting.menu = new am4core.ExportMenu();
        chart.exporting.filePrefix = "poa";

        // make nodes draggable
        // var nodeTemplate = chart.nodes.template;
        // nodeTemplate.readerTitle = "Click to show/hide or drag to rearrange";
        // nodeTemplate.showSystemTooltip = true;
        // nodeTemplate.cursorOverStyle = am4core.MouseCursorStyle.pointer

    }); // end am4core.ready()
    </script>

</body>



</html>