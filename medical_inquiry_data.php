<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT micode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['micode'];


    $tmpinvno = "000000" . $no;
    $lenth = strlen($tmpinvno);
    $no = trim("MI/") . substr($tmpinvno, $lenth - 7);

    $ResponseXML .= "<id><![CDATA[$no]]></id>";
   
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        
        $sql1 = "select * from inqurey_med where refno = '" . $_GET['refno_txt'] . "'";
        $result1 = $conn->query($sql1);
        
        if ($row1 = $result1->fetch()) {
            exit("Duplicate ....!!!");
        }
        

       $sql1 = "Insert into inqurey_med(refno,pportno,country,gamca,eno,mpdate,xrayno,subname,mpname,sex,status,agency,age,custrem,doctor1,doctor2,doctor3,doctor4,doctor5,lab1,lab2,lab3,xray1,xray2)values 
                        ('" . $_GET['refno_txt'] . "','" . $_GET['pportno_txt'] ."','" . $_GET['ctry_txt'] ."','" . $_GET['gamca_txt'] ."','" . $_GET['eno_txt'] ."','" . $_GET['date_txt'] ."','" . $_GET['xrayno_txt'] ."','" . $_GET['subname_txt'] ."','" . $_GET['name_txt'] ."','" . $_GET['sex_txt'] ."','" . $_GET['status_txt'] ."','" . $_GET['agency_txt'] ."','" . $_GET['age_txt'] ."','" . $_GET['custrem_txt'] ."','" . $_GET['doctor1_txt'] ."','" . $_GET['doctor2_txt'] ."','" . $_GET['doctor3_txt'] ."','" . $_GET['doctor4_txt'] ."','" . $_GET['doctor5_txt'] ."','" . $_GET['lab1_txt'] ."','" . $_GET['lab2_txt'] ."','" . $_GET['lab3_txt'] ."','" . $_GET['xray1_txt'] ."','" . $_GET['xray2_txt'] ."')";
        $result = $conn->query($sql1);
        $sql = "SELECT micode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['micode'];
        $no2 = $no + 1;
        $sql = "update invpara set micode = $no2 where micode = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "cancel") {
    try {
        $sql = "update inqurey_med set cancel = '1'  where refno = '" . $_GET['refno_txt'] . "'";
        $result = $conn->query($sql);
        echo "cancel";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

?>