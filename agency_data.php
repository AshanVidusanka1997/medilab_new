<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT agn_code FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['agn_code'];
//    uniq
    $uniq = uniqid();
    
    $tmpinvno = "0" . $row["agn_code"];
    $lenth = strlen($tmpinvno);
    //$no = trim("0") . substr($tmpinvno, $lenth - 7);

    
    
    
    $ResponseXML .= "<agn_txt><![CDATA[$no]]></agn_txt>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";
    
    
    
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

            $sql = "delete from agency where agncode = '" . $_GET['agn_txt'] . "'";
        
       $result = $conn->query($sql);

    $sql1 = "Insert into agency(agncode,uniq,medicaltype,amount)values 
                        ('" . $_GET['agn_txt'] . "','" . $_GET['uniq'] ."','" . $_GET['mtype_txt'] ."','" . $_GET['amt_txt'] ."')";
        $result = $conn->query($sql1);
//        echo $sql;

        $sql = "SELECT agn_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['agn_code'];
        $no2 = $no + 1;
        $sql = "update invpara set agn_code = $no2 where agn_code = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "update") {
    try {
        $sql = "update customer set name = '" . $_GET['name'] . "' ,address = '" . $_GET['address'] . "' ,dob = '" . $_GET['dob'] .  "'  where cid = '" . $_GET['cid'] . "'";
        $result = $conn->query($sql);
//        cid = '" . $_GET['cid'] . "',
        echo "update";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "delete") {
   
        $sql = "delete from agency where agncode = '" . $_GET['agn_txt'] . "'";
        $result = $conn->query($sql);
      //  echo $sql;
        echo "delete";
   
}

?>