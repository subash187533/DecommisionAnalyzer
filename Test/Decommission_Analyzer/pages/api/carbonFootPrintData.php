<?php

$m = new MongoClient();
$db = $m->test_decommission_analyzer;
$collection = $db->carbon_foot_print;

$totalServers = $collection->count();
// $notApplicableServers = $collection->count(array("Decommission_Status" => "Not Applicable"));
// $completedServers = $collection->count(array("Decommission_Status" => "Completed"));
// $serversToBeDecommissioned = $totalServers - ($notApplicableServers + $completedServers);
$needsToBeDecommissioned = $collection->count(array("Decommission_Status" => array('$in' => array("Not Applicable", "Completed"))));
$serversToBeDecommissioned = $totalServers - $needsToBeDecommissioned;
// echo $notApplicableServers + $completedServers;s
// echo $needsToBeDecommissioned . "-----Needs";


$totalLinuxServers = $collection->count(array("Server_OS" => "Linux"));
$totalWindowsServers = $collection->find(array("Server_OS" => "Windows"))->count();
$naLinuxServers = $collection->find(array("Server_OS" => "Linux", "Decommission_Status" => "Not Applicable"))->count();
$naWindowsServers = $collection->find(array("Server_OS" => "Windows", "Decommission_Status" => "Not Applicable"))->count();
$decommissionedLinuxServers = $totalLinuxServers - $naLinuxServers;
$decommissionedWindowsServers = $totalWindowsServers - $naWindowsServers;

$linuxOnPremiseServers = $collection->find(array("Server_OS" => "Linux", "Server_Type" => "On-Premise"))->count();
$windowsOnPremiseServers = $collection->find(array("Server_OS" => "Windows", "Server_Type" => "On-Premise"))->count();

$linuxCloudServers = $collection->find(array("Server_OS" => "Linux", "Server_Type" => "Cloud"))->count();
$windowsCloudServers = $collection->find(array("Server_OS" => "Windows", "Server_Type" => "Cloud"))->count();

$futureCarbonFootPrintAgg =  $collection->aggregate(array('$match' => array("Decommission_Status" => "Not Applicable")), array('$group' => array('_id' => 'null', 'future_carbon_footprint' => array('$sum' => '$Energy_Consumption'))));
$futureCarbonFootPrint = $futureCarbonFootPrintAgg['result'][0]['future_carbon_footprint'];

$currentCarbonFootPrintAgg =  $collection->aggregate(array('$match' => array('$or' => array(array("Decommission_Status" => "To be started"), array("Decommission_Status" => "In progress"), array("Decommission_Status" => "Not Applicable")))), array('$group' => array('_id' => 'null', 'current_carbon_footprint' => array('$sum' => '$Energy_Consumption'))));
$currentCarbonFootPrint = $currentCarbonFootPrintAgg['result'][0]['current_carbon_footprint'];

// $futureCarbonFootPrint = $currentCarbonFootPrint - $futureCarbonFootPrint;

$reductionPercentage = round((($currentCarbonFootPrint - $futureCarbonFootPrint) / $currentCarbonFootPrint) * 100);

$currentGreenEmissionAgg =  $collection->aggregate(
     array('$match' => array(
          '$or' => array(
               array("Decommission_Status" => "To be started"),
               array("Decommission_Status" => "In progress"),
               array("Decommission_Status" => "Not Applicable")
          ),
          '$and' => array(
               array("Type_of_Energy_Consumption" => "Green")
          )
     )),
     array('$group' => array(
          '_id' => 'null',
          'current_green_emission' => array(
               '$sum' => '$Energy_Consumption'
          )
     ))
);
$currentGreenEmission = $currentGreenEmissionAgg['result'][0]['current_green_emission'];

$currentNonGreenEmissionAgg =  $collection->aggregate(
     array('$match' => array(
          '$or' => array(
               array("Decommission_Status" => "To be started"),
               array("Decommission_Status" => "In progress"),
               array("Decommission_Status" => "Not Applicable")
          ),
          '$and' => array(
               array("Type_of_Energy_Consumption" => "Non-Green")
          )
     )),
     array('$group' => array(
          '_id' => 'null',
          'current_non_green_emission' => array(
               '$sum' => '$Energy_Consumption'
          )
     ))
);
$currentNonGreenEmission = $currentNonGreenEmissionAgg['result'][0]['current_non_green_emission'];

$ceQ322Agg =  $collection->aggregate(
     array('$match' => array(
          '$or' => array(
               array("Decommission_Status" => "To be started"),
               array("Decommission_Status" => "In progress")
          )
     )),
     array('$group' => array(
          '_id' => 'null',
          'ce_q3_22' => array(
               '$sum' => '$Energy_Consumption'
          )
     ))
);
$ceQ322 = $ceQ322Agg['result'][0]['ce_q3_22'];

$prQ322Agg =  $collection->aggregate(
     array('$match' => array(
          '$or' => array(
               array(
                    '$and' => array(
                         array('Decommission_Status' => "To be started"),
                         array('Date_of_Decommissioning' => "Dec-21")
                    )
               ),
               array(
                    '$and' => array(
                         array('Decommission_Status' => "In progress"),
                         array('Date_of_Decommissioning' => "Dec-21")
                    )
               ),
               array(
                    '$and' => array(
                         array('Decommission_Status' => "To be started"),
                         array('Date_of_Decommissioning' => "Nov-21")
                    )
               ),
               array(
                    '$and' => array(
                         array('Decommission_Status' => "In progress"),
                         array('Date_of_Decommissioning' => "Nov-21")
                    )
               ),
               array(
                    '$and' => array(
                         array('Decommission_Status' => "To be started"),
                         array('Date_of_Decommissioning' => "Oct-21")
                    )
               ),
               array(
                    '$and' => array(
                         array('Decommission_Status' => "In progress"),
                         array('Date_of_Decommissioning' => "Oct-21")
                    )
               ),
          )
     )),
     array('$group' => array(
          '_id' => 'null',
          'pr_q3_22' => array(
               '$sum' => '$Energy_Consumption'
          )
     ))
);
$prQ322 = $prQ322Agg['result'][0]['pr_q3_22'];

$ceQ422Agg =  $collection->aggregate(
     array('$match' => array(
          'Date_of_Decommissioning' => array('$nin' => array("Oct-21", "Nov-21", "Dec-21")),
          'Decommission_Status' => array('$in' => array("To be started", "In progress"))
     )),
     array('$project' => array(
          '_id' => 0,
          'Energy_Consumption' => 1
     )),
     array('$group' => array(
          '_id' => 'null',
          'ce_q4_22' => array(
               '$sum' => '$Energy_Consumption'
          )
     ))
);
// print_r($ceQ422Agg);
$ceQ422 = $ceQ422Agg['result'][0]['ce_q4_22'];

$prQ422Agg =  $collection->aggregate(
     array('$match' => array(
          'Date_of_Decommissioning' => array('$in' => array("Jan-22", "Feb-22", "Mar-22")),
          'Decommission_Status' => array('$in' => array("To be started", "In progress"))
     )),
     array('$project' => array(
          '_id' => 0,
          'Energy_Consumption' => 1
     )),
     array('$group' => array(
          '_id' => 'null',
          'pr_q4_22' => array(
               '$sum' => '$Energy_Consumption'
          )
     ))
);
// print_r($prQ422Agg);
$prQ422 = $prQ422Agg['result'][0]['pr_q4_22'];

$ceQ123Agg =  $collection->aggregate(
     array('$match' => array(
          'Date_of_Decommissioning' => array('$nin' => array("Oct-21", "Nov-21", "Dec-21", "Jan-22", "Feb-22", "Mar-22")),
          'Decommission_Status' => array('$in' => array("To be started", "In progress"))
     )),
     array('$project' => array(
          '_id' => 0,
          'Energy_Consumption' => 1
     )),
     array('$group' => array(
          '_id' => 'null',
          'ce_q1_23' => array(
               '$sum' => '$Energy_Consumption'
          )
     ))
);
// print_r($ceQ123Agg);
$ceQ123 = $ceQ123Agg['result'][0]['ce_q1_23'];

$prQ123Agg =  $collection->aggregate(
     array('$match' => array(
          'Date_of_Decommissioning' => array('$in' => array("Apr-22", "May-22", "Jun-22")),
          'Decommission_Status' => array('$in' => array("To be started", "In progress"))
     )),
     array('$project' => array(
          '_id' => 0,
          'Energy_Consumption' => 1
     )),
     array('$group' => array(
          '_id' => 'null',
          'pr_q1_23' => array(
               '$sum' => '$Energy_Consumption'
          )
     ))
);
// print_r($prQ123Agg);
$prQ123 = $prQ123Agg['result'][0]['pr_q1_23'];

$ceQ223Agg =  $collection->aggregate(
     array('$match' => array(
          'Date_of_Decommissioning' => array('$nin' => array("Oct-21", "Nov-21", "Dec-21", "Jan-22", "Feb-22", "Mar-22", "Apr-22", "May-22", "Jun-22")),
          'Decommission_Status' => array('$in' => array("To be started", "In progress"))
     )),
     array('$project' => array(
          '_id' => 0,
          'Energy_Consumption' => 1
     )),
     array('$group' => array(
          '_id' => 'null',
          'ce_q2_23' => array(
               '$sum' => '$Energy_Consumption'
          )
     ))
);
// print_r($ceQ223Agg);
$ceQ223 = $ceQ223Agg['result'][0]['ce_q2_23'];

$prQ223Agg =  $collection->aggregate(
     array('$match' => array(
          'Date_of_Decommissioning' => array('$in' => array("Jul-22", "Aug-22", "Sep-22")),
          'Decommission_Status' => array('$in' => array("To be started", "In progress"))
     )),
     array('$project' => array(
          '_id' => 0,
          'Energy_Consumption' => 1
     )),
     array('$group' => array(
          '_id' => 'null',
          'pr_q2_23' => array(
               '$sum' => '$Energy_Consumption'
          )
     ))
);
// print_r($prQ223Agg);
$prQ223 = $prQ223Agg['result'][0]['pr_q2_23'];

// Echo Values to check the API data -------------------------------------------------------------------

// echo "Not applicable" . $notApplicableServers . "<br>";
// echo "Servers to be decommisssioned-> " . $serversToBeDecommissioned . "<br>";
// echo "Linux Servers-> " . $linuxServers . "<br>";
// echo "Windows Servers-> " . $windowsServers . "<br>";
// echo "Linux On-Premise Servers-> " . $linuxOnPremiseServers . "<br>";
// echo "Windows On-Premise Servers-> " . $windowsOnPremiseServers . "<br>";
// echo "Linux Cloud Servers-> " . $linuxCloudServers . "<br>";
// echo "Windows Cloud Servers-> " . $windowsCloudServers . "<br>";
// echo "Current Carbon Footprint-> " . $currentCarbonFootPrint . "<br>";
// echo "Future Carbon Footprint-> " . $futureCarbonFootPrint . "<br>";
// echo "Reduction Percentage-> " . $reductionPercentage . "%<br>";
// echo "Current Green Emission-> " . $currentGreenEmission . "<br>";
// echo "Current Non Green Emission-> " . $currentNonGreenEmission . "<br>";
// echo "Carbon Emission Q3'22-> " . $ceQ322 . "<br>";
// echo "Planned Reduction Q3'22-> " . $prQ322 . "<br>";
// echo "Carbon Emission Q4'22-> " . $ceQ422 . "<br>";
// echo "Planned Reduction Q4'22-> " . $prQ422 . "<br>";
// echo "Carbon Emission Q1'23-> " . $ceQ123 . "<br>";
// echo "Planned Reduction Q1'23-> " . $prQ123 . "<br>";
// echo "Carbon Emission Q1'23-> " . $ceQ223 . "<br>";
// echo "Planned Reduction Q1'23-> " . $prQ223 . "<br>";
