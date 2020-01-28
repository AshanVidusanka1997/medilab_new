<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');

function generateId($id, $ref, $switch) {

    if ($switch == "pre") {
        $temp = substr($id, strlen($ref));
        $id = (int) $temp;

        return $id;
    } else if ($switch == "post") {

        $temp = substr("0000000" . $id, -7);
        $id = $ref . $temp;

        return $id;
    }
}

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT regicode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['regicode'];

 
    $tmpinvno = "000000" . $no;
    $lenth = strlen($tmpinvno);
    $no = trim("SR/") . substr($tmpinvno, $lenth - 7);
    $post = generateId($no, "IT/", "post");
    $uniq = uniqid();


    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";

    $ResponseXML .= "</new>";

    echo $ResponseXML;
}


if ($_GET["Command"] == "getlab") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";


    $date1=date("Y-m-d");

   



    $ResponseXML = "";
    $ResponseXML .= "<new>";

   

     $sqlauto = "SELECT labno,date1 FROM invpara";
    $resultauto = $conn->query($sqlauto);
    $rowauto = $resultauto->fetch();

    if ($date1==$rowauto['date1']) {
      
    }else{
         $sql11 = "update invpara set labno ='1' ";   
        $result11 = $conn->query($sql11);
    }

    $sql = "SELECT labno FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['labno'];
 
 
    $tmpinvno = "000000" . $no;
    $lenth = strlen($tmpinvno);
    $no = substr($tmpinvno, $lenth - 7);
    

    $ResponseXML .= "<id1><![CDATA[$no]]></id1>";
   

    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        
        $sql1 = "select * from sregdetails where refno = '" . $_GET['txt_refno'] . "'";
        //echo $sql;
        $result1 = $conn->query($sql1);
        
        if ($row1 = $result1->fetch()) {
            exit("Duplicated ....!!!");
        } 
         $sql1 = "Insert into sregdetails(refno,srdate,patientno,fname,lastname,age_years,age_months,bdate,sex,nation,country,countryname,no_chid,lastchildage,medicode,mediname,medistatus,meditype,agname,dest,xrayno,serino,PLA_OF_IS,gno,POS_APP,gccno,address,dtisu,med_time,remaks,labref,newref,finger1,finger2,cheqno,cheq_amt,cheq_date,csh_amt,paid_amt,bank,refamt,dt_refund,gflag,img,uniq,serialNo,H,W,DPI,Quality,NFIQ,Tempbase)values 
                      ('" . $_GET['txt_refno']. "','" . $_GET['txt_srdate']. "','" . $_GET['txt_patno']. "','" . $_GET['txt_fname']. "','" . $_GET['txt_lname']. "','" . $_GET['txt_ageyrs']. "','" . $_GET['txt_agemnths']. "','" . $_GET['txt_dob']. "','" . $_GET['txt_gender']. "','" . $_GET['txt_nation']. "','" . $_GET['txt_count']. "','" . $_GET['txt_countname']. "','" . $_GET['txt_nochld']. "','" . $_GET['txt_lchldage']. "','" . $_GET['txt_medicode']. "','" . $_GET['txt_mediname']. "','" . $_GET['txt_medistatus']. "','" . $_GET['txt_type']. "','" . $_GET['agname_txt']. "','" . $_GET['txt_dest']. "','" . $_GET['txt_xrayno']. "','" . $_GET['txt_serino']. "','" . $_GET['txt_pla_of_iss']. "','" . $_GET['txt_gno']. "','" . $_GET['txt_posapp']. "','" . $_GET['txt_gccno']. "','" . $_GET['txt_cusadd']. "','" . $_GET['txt_dtofissu']. "','" . $_GET['txt_time']. "','" . $_GET['txt_rem']. "','" . $_GET['txt_labref']. "','" . $_GET['txt_newref']. "','" . $_GET['txt_fn1']. "','" . $_GET['txt_fn2']. "','" . $_GET['txt_cheqno']. "','" . $_GET['txt_cheqamt']. "','" . $_GET['txt_cheqdt']. "','" . $_GET['txt_cash']. "','1','" . $_GET['txt_bank']. "','" . $_GET['txt_rfamt']. "','" . $_GET['txt_rfdt']. "','" . $_GET['gflag']. "','" . $_GET['uniq']. ".jpg','" . $_GET['uniq'] . "','" . $_GET['SerialNumber']. "','" . $_GET['ImageHeight']. "','" . $_GET['ImageWidth']. "','" . $_GET['ImageDPI']. "','" . $_GET['ImageQuality']. "','" . $_GET['NFIQ']. "','" . $_GET['TemplateBase64_txt']. "')";

           // Table1
        
            $tableAry1 = json_decode($_GET['Jtable1'],true);
            
            $size1 = sizeof(json_decode($_GET['Jtable1'],true));
            

            for ($i=0; $i < $size1 ; $i++) { 
                $tableArysub = $tableAry1[i];
                $sql = "Insert into mediprint_main(refno,passportNo,mediDescript,uniq,amount)values
                        ('" . $_GET['txt_refno'] . "','" . $_GET['txt_patno'] . "','" . $tableAry1[$i][Medical_Description] . "','" . $_GET['uniq'] . "','" . $tableAry1[$i][Amount] . "')";
                $result = $conn->query($sql);

            }
            // end Table1

          $date1=date("Y-m-d");


        $result = $conn->query($sql1);
        $sql = "SELECT regicode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['regicode'];
        $no2 = $no + 1;
        $sql = "update invpara set regicode = $no2 where regicode = $no";
        $result = $conn->query($sql);


         $sql = "SELECT labno FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['labno'];
        $no2 = $no + 1;
        $sql = "update invpara set labno = $no2 where labno = $no";
        $result = $conn->query($sql);

        $sql11 = "update invpara set date1 ='" .  $date1 . "' ";   
        $result11 = $conn->query($sql11);

        //echo $sql11;

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_POST['Command'] == "imgsave") {

    if (!isset($_POST['img'])) {
        $target_dir = "img/";
        $imageFileType = $_FILES["file"]["tmp_name"];
        $path = $_FILES['file']["name"];
        $imageFileType = pathinfo($path, PATHINFO_EXTENSION);

        $target_file = $target_dir . $_POST['id'] . "." . $imageFileType;

echo print_r($_FILES);
        (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file));
    } else {
        $target_file = $_POST['img'];
    }

}

if ($_GET["Command"] == "update_item") {

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
    try {
        $sql = "update sregdetails set srdate = '" . $_GET['txt_srdate'] . "' ,  patientno = '" . $_GET['txt_patno'] . "' , fname = '" . $_GET['txt_fname'] . "' , lastname = '" . $_GET['txt_lname'] . "' , age_years = '" . $_GET['txt_ageyrs'] . "' , age_months = '" . $_GET['txt_agemnths'] . "' , bdate = '" . $_GET['txt_dob'] . "' , sex = '" . $_GET['txt_gender'] . "' , nation = '" . $_GET['txt_nation'] . "' , country = '" . $_GET['txt_count'] . "' , countryname = '" . $_GET['txt_countname'] . "' , no_chid = '" . $_GET['txt_nochld'] . "' , lastchildage = '" . $_GET['txt_lchldage'] . "' , medicode = '" . $_GET['txt_medicode'] . "' , mediname = '" . $_GET['txt_mediname'] . "' , medistatus = '" . $_GET['txt_medistatus'] . "' , agname = '" . $_GET['agname_txt'] . "' , meditype = '" . $_GET['txt_type'] . "' , dest = '" . $_GET['txt_dest'] . "' , xrayno = '" . $_GET['txt_xrayno'] . "' , serino = '" . $_GET['txt_serino'] . "' , PLA_OF_IS = '" . $_GET['txt_pla_of_iss '] . "' , gno = '" . $_GET['txt_gno'] . "' , POS_APP = '" . $_GET['txt_posapp'] . "' , gccno = '" . $_GET['txt_gccno'] . "' , address = '" . $_GET['txt_cusadd'] . "' , dtisu = '" . $_GET['txt_dtofissu'] . "' , med_time = '" . $_GET['txt_time'] . "' , remaks = '" . $_GET['txt_rem'] . "' , labref = '" . $_GET['txt_labref'] . "' , newref = '" . $_GET['txt_newref'] . "' , finger1 = '" . $_GET['txt_fn1'] . "' , cheqno = '" . $_GET['txt_cheqno'] . "' , cheq_amt = '" . $_GET['txt_cheqamt'] . "' , cheq_date = '" . $_GET['txt_cheqdt'] . "' , csh_amt = '" . $_GET['txt_cash'] . "' , PLA_OF_IS = '" . $_GET['txt_pla_of_iss'] . "' , bank = '" . $_GET['txt_bank'] . "' , refamt = '" . $_GET['txt_rfamt'] . "' , dt_refund = '" . $_GET['txt_rfdt'] . "',serialNo = '" . $_GET['SerialNumber'] . "',H = '" . $_GET['ImageHeight'] . "',W = '" . $_GET['ImageWidth'] . "', DPI = '" . $_GET['ImageDPI'] . "', Quality = '" . $_GET['ImageQuality'] . "',NFIQ = '" . $_GET['NFIQ'] . "',Tempbase = '" . $_GET['TemplateBase64_txt'] . "' where refno = '" . $_GET['txt_refno'] . "'";

        



          $result = $conn->query($sql);

        $conn->commit();
        echo "Updated";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "update") {
    try {
        $sql = "update customer set name = '" . $_GET['name'] . "' ,address = '" . $_GET['address'] . "' ,dob = '" . $_GET['dob'] . "'  where cid = '" . $_GET['cid'] . "'";
        $result = $conn->query($sql);
//        cid = '" . $_GET['cid'] . "',
        echo "update";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET["Command"] == "delete") {

    $sql = "delete from sregdetails where refno = '" . $_GET['refno_txt'] . "'";
    $result = $conn->query($sql);
    //  echo $sql;
    echo "delete";
}


if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";



    if ($_GET["Command1"] == "add_tmp") {


        $sql = "Insert into treatments_temp(t_refno,uniq,av_trments)values 
     ('" . $_GET['refno_txt'] . "','" . $_GET['uniq'] . "','" . $_GET['av_treat'] . "')";

        $result = $conn->query($sql);
        // echo $sql;
    }

    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                             <thead>
                                <tr>
                                  
                                    <th style='width: 70%;'>Available Treatments</th>
                                  
                                </tr>
                                <tr>
                                    <th style='width: 10%;'>Add/Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                            <input type='text' placeholder=''  id='av_treat' class='form-control input-sm'>
                                        </td>

                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    $sql1 = "SELECT * from treatments_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['av_trments'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}


if ($_GET["Command"] == "removerow") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $sql = "delete from treatments_temp where id = '" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    $ResponseXML .= "<sales_table><![CDATA[<table id='myTable' class='table table-bordered'>
                            <thead>
                                
                                    <tr>
                                    <th style='width: 70%;'>Available Treatments</th>
                                </tr>
                                <tr>
                                    <th style='width: 10%;'>Add/Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                     <td>
                                            <input type='text' placeholder=''  id='av_treat' class='form-control input-sm'>
                                        </td>


                                        
                                        <td><a onclick='add_tmp();' class='btn btn-default btn-sm'> <span class='fa fa-plus'></span> &nbsp; </a></td>


                                </tr>";




    $sql1 = "SELECT * FROM treatments_temp where uniq = '" . $_GET['uniq'] . "'";


    foreach ($conn->query($sql1) as $row2) {

        $ResponseXML .= "<tr><td>" . $row2['av_trments'] . "</td><td><a onclick='remove_tmp(" . $row2['id'] . ");' class='btn btn-default btn-sm'><span class=''></span> &nbsp; REMOVE</a></td></tr>";
    }

    $ResponseXML .= "</tbody></table>";
    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>