<?php
// echo "Hit in api and returns message";
// echo "<pre>";

$m = new MongoClient();
$db = $m->test_decommission_analyzer;
$cfpCol = $db->carbon_foot_print;
$result = $db->dropCollection('carbon_foot_print');

$message = fileParser($_FILES["fileInput"]);
echo $message;

function fileParser($fileDetails)
{
     $fileOpen = fopen($fileDetails['tmp_name'], 'r');
     $iteration = 0;
     $queryArray = array();
     while (!feof($fileOpen)) {
          $iteration++;
          $singleRow = fgetcsv($fileOpen);

          if ($iteration == 1) {
               continue;
          }
          if ($singleRow[0] == 'null' || $singleRow[0] == '') {
               continue;
          }
          // print_r($singleRow);

          $queryArray['S_No'] = $singleRow[0];
          $queryArray['Server_Name'] = $singleRow[1];
          $queryArray['Server_OS'] = $singleRow[2];
          $queryArray['Server_Type'] = $singleRow[3];
          $queryArray['Type_of_Energy_Consumption'] = $singleRow[4];
          $queryArray['Decommission_Status'] = $singleRow[5];
          $queryArray['Date_of_Decommissioning'] = $singleRow[6];

          if ($queryArray['Server_Type']  == 'Cloud' && $queryArray['Type_of_Energy_Consumption'] == 'Green') {
               $queryArray['Energy_Consumption'] = 160;
          } elseif ($queryArray['Server_Type']  == 'Cloud' && $queryArray['Type_of_Energy_Consumption'] == 'Non-Green') {
               $queryArray['Energy_Consumption'] = 458;
          } elseif ($queryArray['Server_Type']  == 'On-Premise' && $queryArray['Type_of_Energy_Consumption'] == 'Green') {
               $queryArray['Energy_Consumption'] = 320;
          } elseif ($queryArray['Server_Type']  == 'On-Premise' && $queryArray['Type_of_Energy_Consumption'] == 'Non-Green') {
               $queryArray['Energy_Consumption'] = 916;
          }

          // echo $queryArray['Energy_Consumption'] . "\n";
          uploadToMongo($queryArray);
          $queryArray = array();
     }
     return "File Uploaded Successfully";
}

function uploadToMongo($queryArray)
{
     global $m, $db, $cfpCol;
     // connection needs to be global\
     $cfpCol->insert($queryArray);
     // var_dump($result);
}
