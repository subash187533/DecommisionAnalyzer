<?php 
  $output = getTargetAppCount();
  echo $output;

  function getTargetAppCount() {
    $m = new MongoClient();
    $db = $m->test_decommission_analyzer;
    $collection = $db->poa;
    return "Hello";
  }
?> 