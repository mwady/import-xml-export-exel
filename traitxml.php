<?php

session_start();

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: index.php');
    exit;
}
require_once 'classes/db.php';
require_once 'classes/conn.php';

$code = $_GET['id'];
$xmldata = simplexml_load_file("upload/xml/".$code.".xml") or die("Failed to load");

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

    $sth=$pdo->prepare("insert into data(plaintiff_lastname,plaintiff_firstname,plaintiff_companyname,plaintiff_street,plaintiff_streetnumber,plaintiff_postalcode,plaintiff_place,plaintiff_countrycode,plaintiff_phonenumber,plaintiff_faxnumber,plaintiff_email,plaintiff_belongstogroup,debtor_lastname,debtor_firstname,debtor_companyname,debtor_street,debtor_streetnumber,debtor_postalcode,debtor_place,debtor_countrycode,debtor_phonenumber,debtor_email,debtor_vatnr,debtor_debtornrpartner,code) values (:plaintiff_lastname,:plaintiff_firstname,:plaintiff_companyname,:plaintiff_street,:plaintiff_streetnumber,:plaintiff_postalcode,:plaintiff_place,:plaintiff_countrycode,:plaintiff_phonenumber,:plaintiff_faxnumber,:plaintiff_email,:plaintiff_belongstogroup,:debtor_lastname,:debtor_firstname,:debtor_companyname,:debtor_street,:debtor_streetnumber,:debtor_postalcode,:debtor_place,:debtor_countrycode,:debtor_phonenumber,:debtor_email,:debtor_vatnr,:debtor_debtornrpartner,:code)"); 

    $sth->bindParam(':plaintiff_lastname',$plaintiff_lastname);
    $sth->bindParam(':plaintiff_firstname',$plaintiff_firstname);
    $sth->bindParam(':plaintiff_companyname',$plaintiff_companyname);
    $sth->bindParam(':plaintiff_street',$plaintiff_street);
    $sth->bindParam(':plaintiff_streetnumber',$plaintiff_streetnumber);
    $sth->bindParam(':plaintiff_postalcode',$plaintiff_postalcode);
    $sth->bindParam(':plaintiff_place',$plaintiff_place);
    $sth->bindParam(':plaintiff_countrycode',$plaintiff_countrycode);
    $sth->bindParam(':plaintiff_phonenumber',$plaintiff_phonenumber);
    $sth->bindParam(':plaintiff_faxnumber',$plaintiff_faxnumber);
    $sth->bindParam(':plaintiff_email',$plaintiff_email);
    $sth->bindParam(':plaintiff_belongstogroup',$plaintiff_belongstogroup);

    $sth->bindParam(':debtor_lastname',$debtor_lastname);
    $sth->bindParam(':debtor_firstname',$debtor_firstname);
    $sth->bindParam(':debtor_companyname',$debtor_companyname);
    $sth->bindParam(':debtor_street',$debtor_street);
    $sth->bindParam(':debtor_streetnumber',$debtor_streetnumber);
    $sth->bindParam(':debtor_postalcode',$debtor_postalcode);
    $sth->bindParam(':debtor_place',$debtor_place);
    $sth->bindParam(':debtor_countrycode',$debtor_countrycode);
    $sth->bindParam(':debtor_phonenumber',$debtor_phonenumber);
    $sth->bindParam(':debtor_email',$debtor_email);
    $sth->bindParam(':debtor_vatnr',$debtor_vatnr);
    $sth->bindParam(':debtor_debtornrpartner',$debtor_debtornrpartner);
    $sth->bindParam(':code',$code);
    $sth->execute(); 

    header('Location: modifxml.php?id='.$code);

}




?>