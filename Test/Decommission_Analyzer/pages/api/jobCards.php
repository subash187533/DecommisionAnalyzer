<?php
    $m = new MongoClient();
    $db = $m->test_decommission_analyzer;
    $collection = $db->job_cards;
    $uniqueApps = $collection->distinct('Application Name');
    // print_r($uniqueApps);
    $appSet = array();
    $dataSet = array();

    foreach($uniqueApps as $app) {
        $dataByApp = $collection->find(array('Application Name' => $app));
        foreach($dataByApp as $data) {        
            $data["Application Name"] = str_replace("'","", $data["Application Name"]);
            $dataSet[] = array (
                "Application Name" => $data["Application Name"],
                "Action To Lead" => $data["Action To Lead"],
                "Application Type" => $data["Application Type"],
                "Line of Business" => $data["Line of Business"],
                "Technology Stack" => $data["Technology Stack"],
                "Application Functionality" => $data["Application Functionality"],
                "Point Of Arrival" => $data["Point of Arrival (POA)"],
                "POA Status" => $data["POA Status"],
                "POA Ready" => $data["POA Ready By"],
                "Application Active" => $data["Application Active"],
                "Decommission Start Date" => $data["Decommission Start Date"],
                "Decommission End Date" => $data["Decommission End Date"],
                "Age of Application" => $data["Age of Application"],
                "Gap Analysis" => $data["DPD: Gap Analysis"],
                "Data Migration" => $data["DPD: Data Migration"],
                "User Migration" => $data["DPD: User Migration"],
                "Switch-Off" => $data["DPD: Switch-Off"],
                "Big Bang" => $data["DPD: Big Bang"],
                "Decommission Sequence" => $data["Decommission Sequence"],
                "Application Ownership" => $data["Application Ownership"],
                "Total no of days to decommission" => $data["Total no of days to decommission (indicative)"],
                "Legal Compliance Handled" => $data["Legal Compliance Handled"],
                "Resources Required to Decommission" => $data["Resources Required to Decommission"],
                "Level of Documentation" => $data["Level of Documentation"],
                "Support Level" => $data["Support Level"]
            );
        } 
        $appSet[] = array($app=>$dataSet);
        $dataSet = array();
    }

    // print_r($appSet);
    // echo json_encode($appSet);
?>