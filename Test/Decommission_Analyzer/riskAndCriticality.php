<?php 
error_reporting(0);
require_once './pages/auth/pageHandler.php';
session_start();
$_SESSION['currentPage'] = 'riskAndCriticality';

$m = new MongoClient();
$db = $m->test_decommission_analyzer;
$collection = $db->risk_criticality;

$lobs = $collection->distinct("LOB");

$totalApplications = $collection->count();
$lowPortable = $collection->find(array("riskcriticalityscore" => array('$gt' => 0, '$lt' => 4)))->count();
$mediumPortable = $collection->find(array("riskcriticalityscore" => array('$gt' => 4, '$lt' => 8)))->count();
$highPortable = $collection->find(array("riskcriticalityscore" => array('$gt' => 8, '$lt' => 1)))->count();

// echo $totalApplications. $lowPortable. $mediumPortable. $highPortable;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Decommission Analyzer - Risk and Criticality</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
    #chartDiv,
    #chartdiv {
        height: 575px;
    }

    #balloon {
        position: absolute;
        top: 359px;
        left: 867px;
        border: 2px solid #ccc;
        background: rgba(255, 255, 255, 0.8);
        padding: 6px;
        font-size: 10px;
        color: #000;
        margin: 40px 0 0 20px;
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
                        <h1 class="h3 mb-0 text-gray-800">Risk & Criticality Metrics by Applications</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Applications</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalApplications; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fab fa-elementor fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" data-toggle="tooltip" data-placement="top"
                            title="Index greater than 8">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                High Risk Applications</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $highPortable; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sort-amount-up fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" data-toggle="tooltip" data-placement="top"
                            title="Index between 4 and 8">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Medium Risk Applications</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $mediumPortable; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-random fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4" data-toggle="tooltip" data-placement="top"
                            title="Index lesser than 4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Low Risk Applications</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $lowPortable; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sort-amount-down-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Application With Risk / Criticality
                                    </h6>
                                    <!-- LOB Select Dropdown -->
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
                                        <div id="chartdiv"></div>
                                        <div id="balloon"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Risk and Criticality Index Table</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="inboundTable" width="100%"
                                            cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <?php 
                                                $header = $collection->findOne();
                                                foreach($header as $key=>$value) {
                                                    if($key == '_id') continue;
                                                    echo "<th>". $key. "</th>";
                                                }
                                            ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $results = $collection->find();
                                                // print_r($results);
                                                foreach($results as $result) {
                                                    echo "<tr>";
                                                    foreach($result as $key=>$value) {
                                                        if($key == '_id') continue;
                                                    echo "<td>". $value. "</td>";
                                                    }  
                                                    echo "</tr>";
                                                }
                                            ?>
                                            </tbody>
                                        </table>
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

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- Buttons Scripts -->
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.flash.min.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>

    <!-- Resources -->
    <script src="js/3/amcharts.js"></script>
    <script src="js/3/serial.js"></script>
    <script src="js/3/export.min.js"></script>
    <link rel="stylesheet" href="css/3/export.css" type="text/css" media="all" />
    <script src="js/3/light.js"></script>

    <script type="text/javascript" src="js/3/loader.js"></script>

    <!-- Chart code -->
    <script>
    function initializeChart() {
        var dataProvider = chart.dataProvider;
        var colorRanges = chart.colorRanges;

        // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
        function ColorLuminance(hex, lum) {

            // validate hex string
            hex = String(hex).replace(/[^0-9a-f]/gi, '');
            if (hex.length < 6) {
                hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
            }
            lum = lum || 0;

            // convert to decimal and change luminosity
            var rgb = "#",
                c, i;
            for (i = 0; i < 3; i++) {
                c = parseInt(hex.substr(i * 2, 2), 16);
                c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                rgb += ("00" + c).substr(c.length);
            }

            return rgb;
        }

        if (colorRanges) {

            var item;
            var range;
            var valueProperty;
            var value;
            var average;
            var variation;
            for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                item = dataProvider[i];

                for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                    range = colorRanges[x];
                    valueProperty = range.valueProperty;
                    value = item[valueProperty];

                    if (value >= range.start && value <= range.end) {
                        average = (range.start - range.end) / 2;

                        if (value <= average)
                            variation = (range.variation * -1) / value * average;
                        else if (value > average)
                            variation = range.variation / value * average;

                        item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                    }
                }
            }
        }
    }
    AmCharts.addInitHandler(function(chart) {
        initializeChart();

    }, ["serial"]);



    var chart = AmCharts.makeChart("chartdiv", {
        "hideCredits": true,
        "type": "serial",
        "theme": "light",
        "colorRanges": [{
            "start": 0,
            "end": 4,
            "color": "#1CC88A",
            "variation": 0,
            "valueProperty": "Risk Criticality Index",
            "colorProperty": "color"
        }, {
            "start": 4,
            "end": 8,
            "color": "#F6C23E",
            "variation": 0,
            "valueProperty": "Risk Criticality Index",
            "colorProperty": "color"
        }, {
            "start": 8,
            "end": 10,
            "color": "#E74A3B",
            "variation": 0,
            "valueProperty": "Risk Criticality Index",
            "colorProperty": "color"
        }],

        "dataProvider": [
            <?php 
                $results = $collection->find()->sort(array("riskcriticalityscore" => -1));
                foreach($results as $result) {
                    // if($result["riskcriticalityscore"] > 6) {
                    //     $result["riskcriticalityscore"] = 9;
                    // }
                    echo "{";
                    echo '"Application":"'. $result["appname"]. '",';
                    echo '"Risk Criticality Index":'. $result["riskcriticalityscore"]. ',';
                    echo '"App Revenue Impact":"'. $result["apprevenueimpact"]. '",';
                    echo '"App Criticality":"'. $result["appcriticality"]. '",';
                    echo '"App Data Gateway":"'. $result["appdatagateway"]. '",';
                    echo '"App Legal":"'. $result["applegal"]. '",';
                    echo '"App interface":"'. $result["appinterface"] . '"';
                    echo "},";                    
                }
            ?>
        ],

        "valueAxes": [{
            "gridColor": "#FFFFFF",
            "gridAlpha": 0.2,
            "dashLength": 0,
            "title": "Risk Criticality Index",
            "position": "top"
        }],
        "gridAboveGraphs": true,
        "startDuration": 1,
        "graphs": [{
            // "balloonText": "[[Application]]:<br/>Risk Criticality Index:[[Risk Criticality Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
            "labelText": "[[Risk Criticality Index]]",
            "fillAlphas": 0.8,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "Risk Criticality Index",
            "colorField": "color",
            "balloon": {
                "adjustBorderColor": true,
                "color": "#000000",
                "cornerRadius": 5,
                "fillColor": "#FFFFFF",
                "fillAlpha": 20
            }
        }],
        "chartCursor": {
            "categoryBalloonEnabled": true,
            "cursorAlpha": 0,
            "zoomable": false
        },
        "categoryField": "Application",
        "rotate": true,
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 25,
            "gridAlpha": 0,
            "title": "Applications",
            "fontSize": 8
        },
        "export": {
            "enabled": true,
            "fileName": "portability_metrics"
        }

    });
    <?php
        $uniquelobs = $collection->distinct('LOB');
        // print_r($uniquelobs);
        $lobSet = array();
        $dataSet = array();

        foreach($uniquelobs as $lob) {
            $dataByLob = $collection->find(array('LOB' => $lob))->sort(array('riskcriticalityscore' => -1));
            foreach($dataByLob as $data) {        
                $data["appname"] = str_replace("'","", $data["appname"]);
                $dataSet[] = array (
                    "Application" => $data["appname"],
                    "Risk Criticality Index" => $data["riskcriticalityscore"],
                    "App Revenue Impact" => $data["apprevenueimpact"],
                    "App Criticality" => $data["appcriticality"],
                    "App Data Gateway" => $data["appdatagateway"],
                    "App Legal" => $data["applegal"],
                    "App Interface" => $data["appinterface"]
                );
            } 
            $lobSet[] = array($lob=>$dataSet);
            $dataSet = array();
        }
    ?>

    var lobData = '<?php echo json_encode($lobSet);?>';
    lobData = JSON.parse(lobData);
    console.log(lobData);

    var lob = $("#selLob").prop("selectedIndex", 0).val();
    $('#selLob').change(function() {
        lob = $("#selLob").val();
        // console.log(lob);
        $.each(lobData, function() {
            $.each(this, function(k, v) {
                if (k == lob) {
                    chart.dataProvider = v;
                    initializeChart();
                    chart.validateData();
                    // $('#chartDiv').height(chart.dataProvider.length * 150);
                    // $('#chartdiv').height(chart.dataProvider.length * 150);
                    console.log(chart.dataProvider);
                    return;
                }

            });
        });
    });

    chart.addListener("rollOverGraphItem", function(event) {
        var b = document.getElementById("balloon");
        b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
            "Risk Criticality Index " + ": <b>" + event.item.dataContext["Risk Criticality Index"] +
            "</b><br>" +
            "App Revenue Impact " + ": <b>" + event.item.dataContext["App Revenue Impact"] + "</b><br>" +
            "App Criticality " + ": <b>" + event.item.dataContext["App Criticality"] + "</b><br>" +
            "App Data Gateway " + ": <b>" + event.item.dataContext["App Data Gateway"] + "</b><br>" +
            "App Legal " + ": <b>" + event.item.dataContext["App Legal"] + "</b><br>" +
            "App Interface " + ": <b>" + event.item.dataContext["App Interface"] + "</b>";
        //console.log('event.item.category= ', event.item);
        //b.style.display = "block";
        b.style.color = event.item.color;
        // b.style.color = "#4E73DF";
    });
    </script>

</body>



</html>