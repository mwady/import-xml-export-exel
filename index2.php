<?php

$xmldata = simplexml_load_file("SekundiCases.xml") or die("Failed to load");

$export_data = array(
    array(
        'plaintiff companyname' => $xmldata->NewCase->plaintiff->companyname,
        'plaintiff street' => $xmldata->NewCase->plaintiff->street,
        'plaintiff streetnumber' => $xmldata->NewCase->plaintiff->streetnumber,
        'plaintiff postalcode' => $xmldata->NewCase->plaintiff->postalcode,
        'plaintiff place' => $xmldata->NewCase->plaintiff->place,
        'plaintiff countrycode' => $xmldata->NewCase->plaintiff->countrycode,
        'plaintiff phonenumber' => $xmldata->NewCase->plaintiff->phonenumber,
        'plaintiff faxnumber' => $xmldata->NewCase->plaintiff->faxnumber,
        'plaintiff belongstogroup' => $xmldata->NewCase->plaintiff->belongstogroup,


        'debtor companyname' => $xmldata->NewCase->debtor->companyname,
        'debtor street' => $xmldata->NewCase->debtor->street,
        'debtor streetnumber' => $xmldata->NewCase->debtor->streetnumber,
        'debtor postalcode' => $xmldata->NewCase->debtor->postalcode,
        'debtor place' => $xmldata->NewCase->debtor->place,
        'debtor countrycode' => $xmldata->NewCase->debtor->countrycode,
        'debtor phonenumber' => $xmldata->NewCase->debtor->phonenumber,
    )
);

// $fileName = "export_data" . rand(1,100) . ".xls";
// if ($export_data) {
// 	function filterData(&$str) {
// 		$str = preg_replace("/\t/", "\\t", $str);
// 		$str = preg_replace("/\r?\n/", "\\n", $str);
// 		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
// 	}
 
// 	// headers for download
// 	header("Content-Disposition: attachment; filename=\"$fileName\"");
// 	header("Content-Type: application/vnd.ms-excel");
 
// 	$flag = false;
// 	foreach($export_data as $row) {
// 		if(!$flag) {
// 			// display column names as first row
// 			echo implode("\t", array_keys($row)) . "\n";
// 			$flag = true;
// 		}
// 		// filter data
// 		array_walk($row, 'filterData');
// 		echo implode("\t", array_values($row)) . "\n";
// 	}
// 	exit;			
// }