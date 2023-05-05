<?php 
error_reporting(0);
require_once './pages/auth/pageHandler.php';

ob_start();
session_start();
// echo "Hello from PHP!";
$_SESSION['currentPage'] = 'dashboard';

// ini_set('display_errors',0);


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="karthick">

    <title>Decommission Analyzer - Dashboard</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Styles -->
    <style>
    #angularGauge,
    #pieChart,
    #actionPie,
    #targetPie {
        width: 100%;
        height: 100%;
    }

    .list-group-item:hover {
        transform: scale(1.02);
        cursor: default !important;
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
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
                                                Total No. of Diligenta Hosted Applications </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">120</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-city fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total No. of Capita Hosted Applications</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">21</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-building fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Lines Of Business Covered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">14</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-balance-scale-right fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Data Points Gathered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">42</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow" id="totalApps">
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">TOTAL NO. OF APPLICATIONS COVERED AS PART OF POC
                                        <span class="float-right">20</span>
                                    </h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="120"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->

                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Highlights</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <!-- <div class="chart-area"> -->
                                    <div class="list-group">
                                        <button type="button" class="list-group-item list-group-item-action">
                                            Understanding of Application Target mapping from
                                            Capita SME
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">Translation
                                            of the Application Target mapping to a
                                            POA Map</button>
                                        <button type="button" class="list-group-item list-group-item-action">Data
                                            Gathering session with Capita SME</button>
                                        <button type="button" class="list-group-item list-group-item-action">Data
                                            Collated & Compiled in Baseline Inventory (for
                                            XX applications)</button>
                                        <button type="button" class="list-group-item list-group-item-action">Portability
                                            Index</button>
                                        <button type="button" class="list-group-item list-group-item-action">Risk and
                                            Criticality Index</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- Assumptions -->
                        <!-- <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Assumptions</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="custom-white">
                                        <li>The current decommissioning sequence is based on
                                            inputs received from interviews in June 2020. Any major change to
                                            applications post the given interview ,will impact the decommissioning
                                            roadmap & plan accordingly.</li>
                                        <li>Sequence and Demise pattern for Applications
                                            which do not have source code are on basis of Inputs provided during
                                            interviews & dependencies information only</li>
                                        <li>Decommissioning sequence for certain applications
                                            with action to lead as "Decommission" needs discussion with Allianz
                                            Italy as the dependent applications either have action to lead as
                                            "Integrate" or "Remains”</li>
                                        <li>Action to Lead changed for 12 Applications</li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <div class="row">

                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Overall POC Status</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <div id="angularGauge"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Gathered</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <div id="pieChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Summary of Actions</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <div id="actionPie"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Summary by Target Application
                                        preferred</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <div id="targetPie"></div>
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

    <!-- Chart Scripts -->
    <script src="js/4/core.js"></script>
    <script src="js/4/charts.js"></script>
    <script src="js/4/animated.js"></script>
    <script src="js/4/kelly.js"></script>

    <script>
    $(document).ready(function() {
        $("body").tooltip({
            selector: '[data-toggle=tooltip]'
        });
    });
    </script>

    <!-- Chart code -->
    <script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        am4core.options.commercialLicense = true;
        // Themes end

        // create chart
        var chart = am4core.create("angularGauge", am4charts.GaugeChart);
        chart.innerRadius = -15;

        var axis = chart.xAxes.push(new am4charts.ValueAxis());
        axis.min = 0;
        axis.max = 100;
        axis.strictMinMax = true;

        var colorSet = new am4core.ColorSet();

        var gradient = new am4core.LinearGradient();
        gradient.stops.push({
            color: am4core.color("red")
        })
        gradient.stops.push({
            color: am4core.color("yellow")
        })
        gradient.stops.push({
            color: am4core.color("green")
        })

        axis.renderer.line.stroke = gradient;
        axis.renderer.line.strokeWidth = 15;
        axis.renderer.line.strokeOpacity = 1;

        axis.renderer.grid.template.disabled = true;

        var hand = chart.hands.push(new am4charts.ClockHand());
        hand.radius = am4core.percent(97);

        setInterval(function() {
            hand.showValue(100, 1000, am4core.ease.cubicOut);
        }, 2000);


    }); // end am4core.ready()
    </script>

    <script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("pieChart", am4charts.PieChart);

        // Add data
        chart.data = [{
            "country": "Data Gathered from workshops",
            "litres": 100
        }];

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "litres";
        pieSeries.dataFields.category = "country";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.labels.template.wrap = true;
        pieSeries.labels.template.maxWidth = 90;
        pieSeries.labels.template.fontSize = 11;

        // This creates initial animation
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;

    }); // end am4core.ready()
    </script>

    <!-- Chart code -->
    `<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("actionPie", am4charts.PieChart);

        // Add data
        chart.data = [{
            "country": "Replace",
            "litres": 57
        }, {
            "country": "Replace / Remove",
            "litres": 26
        }, {
            "country": "Remain",
            "litres": 18
        }, {
            "country": "Rehost / Consolidate",
            "litres": 16
        }, {
            "country": "Rekey",
            "litres": 14
        }, {
            "country": "Sustain",
            "litres": 8
        }, {
            "country": "Migrate",
            "litres": 4
        }, {
            "country": "Remove",
            "litres": 3
        }];

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "litres";
        pieSeries.dataFields.category = "country";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        // pieSeries.labels.template.wrap = true;
        // pieSeries.labels.template.maxWidth = 90;
        pieSeries.labels.template.fontSize = 11;

        // This creates initial animation
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;

    }); // end am4core.ready()
    </script>`

    <script>
    $(".list-group-item").hover(
        function() {
            $(this).toggleClass("active");
        }
    );

    $("#totalApps").hover(
        function() {
            $(this).toggleClass("border-primary");
        }
    );
    </script>

    <script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_kelly);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("targetPie", am4charts.PieChart);

        // Add data
        chart.data = [{
            "country": "CFE",
            "litres": 37
        }, {
            "country": "Target not required",
            "litres": 27
        }, {
            "country": "CFE + ENGAGE1/DOC1",
            "litres": 19
        }, {
            "country": "COMPASS",
            "litres": 14
        }, {
            "country": "Cash Manager Replacement",
            "litres": 11
        }, {
            "country": "ENGAGE1, DOC1",
            "litres": 7
        }, {
            "country": "GIS, C:OZ",
            "litres": 5
        }, {
            "country": "Others",
            "litres": 26
        }];

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "litres";
        pieSeries.dataFields.category = "country";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.labels.template.wrap = true;
        pieSeries.labels.template.maxWidth = 95;
        pieSeries.labels.template.fontSize = 11;

        // This creates initial animation
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;

    }); // end am4core.ready()
    </script>


</body>

</html>