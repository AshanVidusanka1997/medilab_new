<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Medical List</title>

        <style>
            table
            {
                border-collapse:collapse;
            }
            table, td, th
            {
                border:1px solid black;
                font-family:Arial, Helvetica, sans-serif;
                padding:5px;
            }
            th
            {
                font-weight:bold;
                font-size:14px;

            }
            td
            {
                font-size:14px;
                border-bottom:none;
                border-top:none;
            }
        </style>

    </head>

    <body>


        <?php
        require_once("connectioni.php");
        $rep = trim($_GET["rep"]);

        $sql_head = "select * from invpara";
        $result_head = mysqli_query($GLOBALS['dbinv'], $sql_head);
        $row_head = mysqli_fetch_array($result_head);


        $tb = "<center><span class=\"style1\">" . $row_head["COMPANY"] . "</span></center><br>";



        $tb .= "<center>Medical List";

        $tb .= "<center><table border=1><tr>";

        $tb .= "<tr>";
        $tb .= "<th width=\"70\"  background=\"\">Lab No</th>";
        $tb .= "<th width=\"100\"  background=\"\">PP No</th>";
        $tb .= "<th width=\"200\"  background=\"\">Name</th>";
        $tb .= "<th width=\"250\"  background=\"\">Country</th>";
        $tb .= "<th width=\"70\"  background=\"\">Amount</th>";
        $tb .= "<th width=\"180\"  background=\"\">Refund</th>";
        $tb .= "<th width=\"180\"  background=\"\">Balance</th>";
        $tb .= "<th width=\"180\"  background=\"\">Sex</th>";



        if ($_GET['option1'] == "1") { 

             $sql = "Select * from sregdetails ";
            if ($_GET['option5'] == "1") {
                $sql .= "where  srdate BETWEEN ('" . $_GET['from_date'] . "') AND ('" . $_GET['to_date'] . "')  and cancel='0'  order by newref ";
            }
        } elseif ( $_GET['option2'] == "1") {
            $sql = "Select * from sregdetails where newref='RC' ";

            if ($_GET['option5'] == "1") {
                $sql .= "and   srdate BETWEEN ('" . $_GET['from_date'] . "') AND ('" . $_GET['to_date'] . "') and cancel='0' order by labref  ";
            }           
        }elseif ( $_GET['option6'] == "1") {
            $sql = "Select * from sregdetails where newref='NM' ";
            if ($_GET['option5'] == "1") {
                $sql .= "and  srdate BETWEEN ('" . $_GET['from_date'] . "') AND ('" . $_GET['to_date'] . "') and cancel='0'  order by labref  ";
            }           
        }elseif ( $_GET['option7'] == "1") {
            $sql = "Select * from sregdetails where newref='MMR' ";

            if ($_GET['option5'] == "1") {
                $sql .= "and srdate BETWEEN ('" . $_GET['from_date'] . "') AND ('" . $_GET['to_date'] . "') and cancel='0' order by labref ";
            }
        } elseif ($_GET['option3'] == "1") {
            $sql = "Select * from sregdetails  ";
            if ($_GET['option5'] == "1") {

                $sql .= "where  srdate BETWEEN ('" . $_GET['from_date'] . "') AND ('" . $_GET['to_date'] . "')and cancel='0' order by labref   ";
            }
           
        } elseif ($_GET['option4'] == "1") {
            $sql = "Select * from sregdetails  ";
            if ($_GET['option5'] == "1") {
                $sql .= "where  srdate BETWEEN ('" . $_GET['from_date'] . "') AND ('" . $_GET['to_date'] . "') and cancel='0' order by labref    ";
            }           
        }else {
             $sql = "Select * from sregdetails  ";           
        }

        $result = mysqli_query($GLOBALS['dbinv'], $sql);

        $mbrand = "";

        while ($row = mysqli_fetch_array($result)) {
            // if( $mbrand!=$row['newref']){
            //      $tb .= "<td style=\"text-align: center;\"><b>" . $row['newref'] . "<b></td>";
            //  }

            $tb .= "<tr><td style=\"text-align: center;\">" . $row['labref'] . "</td>";
            $tb .= "<td style=\"text-align: center;\">" . $row['patientno'] . "</td>";
            $tb .= "<td style=\"text-align: center;\">" . $row['fname'] ." ". $row['lastname']. "</td>";
            $tb .= "<td style=\"text-align: center;\">" . $row['countryname'] . "</td>";
            $tb .= "<td style=\"text-align: center;\">" . $row['csh_amt'] . "</td>";
            $tb .= "<td style=\"text-align: center;\">" . $row['refamt'] . "</td>";
            $tb .= "<td style=\"text-align: center;\">" . $row['time'] . "</td>";
            $tb .= "<td style=\"text-align: center;\">" . $row['sex'] . "</td>";

            
            $tb .= "</tr>";

        }
        $tb .= "</table>";



        echo $tb;
        ?>


    </body>
</html>
  