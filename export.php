<?php
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    header('Location: index.php');
    exit;
}
require_once 'classes/db.php';
require_once 'classes/conn.php';

require_once 'XLSXWriter/xlsxwriter.class.php';


if(isset($_POST['exportexel'])){

    $id = $_POST['id'];
    $stmt = $pdo->query("SELECT * FROM data WHERE id = ".$id);
    $row = $stmt->fetch();
    $xmldata = simplexml_load_file("upload/xml/".$row['code'].".xml") or die("Failed to load");

    if($xmldata){

        $plaintiff_lastname = $xmldata->NewCase->plaintiff->lastname;
        $plaintiff_firstname = $xmldata->NewCase->plaintiff->firstname;
        $plaintiff_companyname = $xmldata->NewCase->plaintiff->companyname;
        $plaintiff_street = $xmldata->NewCase->plaintiff->street;
        $plaintiff_streetnumber = $xmldata->NewCase->plaintiff->streetnumber;
        $plaintiff_postalcode = $xmldata->NewCase->plaintiff->postalcode;
        $plaintiff_place = $xmldata->NewCase->plaintiff->place;
        $plaintiff_countrycode = $xmldata->NewCase->plaintiff->countrycode;
        $plaintiff_phonenumber = $xmldata->NewCase->plaintiff->phonenumber;
        $plaintiff_faxnumber = $xmldata->NewCase->plaintiff->faxnumber;
        $plaintiff_email = $xmldata->NewCase->plaintiff->email;
        $plaintiff_belongstogroup = $xmldata->NewCase->plaintiff->belongstogroup;
    
    
        $debtor_lastname = $xmldata->NewCase->debtor->lastname;
        $debtor_firstname = $xmldata->NewCase->debtor->firstname;
        $debtor_companyname = $xmldata->NewCase->debtor->companyname;
        $debtor_street = $xmldata->NewCase->debtor->street;
        $debtor_streetnumber = $xmldata->NewCase->debtor->streetnumber;
        $debtor_postalcode = $xmldata->NewCase->debtor->postalcode;
        $debtor_place = $xmldata->NewCase->debtor->place;
        $debtor_countrycode = $xmldata->NewCase->debtor->countrycode;
        $debtor_phonenumber = $xmldata->NewCase->debtor->phonenumber;
        $debtor_email = $xmldata->NewCase->debtor->email;
        $debtor_vatnr = $xmldata->NewCase->debtor->vatnr;
        $debtor_debtornrpartner = $xmldata->NewCase->debtor->debtornrpartner;

        $header = array(
            'lastname[plaintiff]' => 'string',
            'firstname[plaintiff]' => 'string',
            'companyname[plaintiff]' => 'string',
            'street[plaintiff]' => 'string',
            'streetnumber[plaintiff]' => 'string',
            'postalcode[plaintiff]' => 'string',
            'place[plaintiff]' => 'string',
            'countrycode[plaintiff]' => 'string',
            'phonenumber[plaintiff]' => 'string',
            'faxnumber[plaintiff]' => 'string',
            'email[plaintiff]' => 'string',
            'belongstogroup[plaintiff]' => 'string',

            'lastname[debtor]' => 'string',
            'firstname[debtor]' => 'string',
            'companyname[debtor]' => 'string',
            'street[debtor]' => 'string',
            'streetnumber[debtor]' => 'string',
            'postalcode[debtor]' => 'string',
            'place[debtor]' => 'string',
            'countrycode[debtor]' => 'string',
            'phonenumber[debtor]' => 'string',
            'email[debtor]' => 'string',
            'vatnr[debtor]' => 'string',
            'debtornrpartner[debtor]' => 'string',
        );
        $data = array(
            array($plaintiff_lastname,$plaintiff_firstname,$plaintiff_companyname,$plaintiff_street,$plaintiff_streetnumber,$plaintiff_postalcode,$plaintiff_place,$plaintiff_countrycode,$plaintiff_phonenumber,$plaintiff_faxnumber,$plaintiff_email,$plaintiff_belongstogroup,$debtor_lastname,$debtor_firstname,$debtor_companyname,$debtor_street,$debtor_streetnumber,$debtor_postalcode,$debtor_place,$debtor_countrycode,$debtor_phonenumber,$debtor_email,$debtor_vatnr,$debtor_debtornrpartner),
        );
        
        $writer = new XLSXWriter();
        $writer->writeSheetHeader('Sheet1', $header );
        foreach($data as $row)
            $writer->writeSheetRow('Sheet1', $row );
        $writer->writeToFile('upload/exel/exelfile.xlsx');
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename('exelfile.xlsx').'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('upload/exel/exelfile.xlsx'));
        readfile('upload/exel/exelfile.xlsx');

    }

}


?>