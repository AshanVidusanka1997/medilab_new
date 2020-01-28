<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');

// print_r($_POST);

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT mpcode FROM invpara";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['mpcode'];

    //echo print_r($row);
//    uniq
    $uniq = uniqid();

    $tmpinvno = "000000" . $no;
    $lenth = strlen($tmpinvno);
    $no = trim("MedPR/") . substr($tmpinvno, $lenth - 7);




    $ResponseXML .= "<id><![CDATA[$no]]></id>";
  


    $ResponseXML .= "</new>";

    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {


    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        
         $sql1 = "select * from print_med where refno = '" . $_GET['refno_txt'] . "'";
        $result1 = $conn->query($sql1);
        //echo $sql;
        if ($row1 = $result1->fetch()) {
            exit("Duplicate ....!!!");
        }

       


        $sql1 = "Insert into print_med(refno,pport,mprdate,agency,country,gccno,mdate,mprname,height,weight,sex,age,nation,mprefno,posapp,status,addremark1,addremark2,addremark3,rem1np,rem2np,x_addrem,add_xray_rem,seri_no,xrayno,l_addrem,add_labrem,labrem,doissue)values 
                      ('" . $_GET['refno_txt'] . "','" . $_GET['pport_txt'] . "','" . $_GET['date_txt'] . "','" . $_GET['agency_txt'] . "','" . $_GET['ctry_txt'] . "','" . $_GET['gccno_txt'] . "','" . $_GET['mdate_txt'] . "','" . $_GET['name_txt'] . "','" . $_GET['height_txt'] . "','" . $_GET['weight_txt'] . "','" . $_GET['sex_txt'] . "','" . $_GET['age_txt'] . "','" . $_GET['nation_txt'] . "','" . $_GET['mprefno_txt'] . "','" . $_GET['posapp_txt'] . "','" . $_GET['status_txt'] . "','" . $_GET['addremark1_txt'] . "','" . $_GET['addremark2_txt'] . "','" . $_GET['addremark3_txt'] . "','" . $_GET['rem1np_txt'] . "','" . $_GET['rem2np_txt'] . "','" . $_GET['x_addrem_txt'] . "','" . $_GET['add_xray_rem_txt'] . "','" . $_GET['seri_no_txt'] . "','" . $_GET['xrayno_txt'] . "','" . $_GET['l_addrem_txt'] . "','" . $_GET['add_labrem_txt'] . "','" . $_GET['labrem_txt'] . "','" . $_GET['doissue_txt'] . "')";

        $result = $conn->query($sql1);
        $sql = "SELECT mpcode FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $no = $row['mpcode'];
        $no2 = $no + 1;
        $sql = "update invpara set mpcode = $no2 where mpcode = $no";
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

    $sql = "delete from print_med where refno = '" . $_GET['refno_txt'] . "'";
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