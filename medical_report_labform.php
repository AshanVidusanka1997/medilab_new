<?php

include './connection_sql.php';
?>





<?php

include './connection_sql.php';

include 'barcode128.php';



$mid = $_GET["txt_ref"];



    $sql1 = "SELECT * FROM mediprint where passport_no = '" . $mid . "'";
    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch();

    $sql2 = "SELECT * FROM sregdetails where patientno = '" . $row1["passport_no"] . "'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch();


    $sql3 = "SELECT * FROM med_dele where refno = '" . $mid . "'";
    $result3 = $conn->query($sql3);
    $row3 = $result3->fetch();


    $pubdate= $row1["tdate"] ;
    $da = strtotime($pubdate);
    $dat = date('H:i:s', $da);

    echo '<br>
        <div id="page-wrap"> 
<div> 
<table style="width:100%;margin-top:45px;">

  <tr >
    <td colspan="3"  align="left"><p style="height: 30%; ">'.bar128(stripcslashes($row1["passport_no"])).'</p></td>

  </tr>
  <tr>
     <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td align="center">' . $row1["c_date"] . '</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
  </tr>
  <tr>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td  align="center">' .$dat . '</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
  </tr>
  <tr>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
  </tr>
  <tr>
    <td>' . $row1["country"] . '</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp</td>
    <td>&nbsp</td>
  </tr>
  <tr>
    <td>' . $row1["name"] . '</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>&nbsp</td>
    <td>&nbsp</td>
  </tr>
  <tr>
    <td>' . $row1["sex"] . '</td>
    <td>' . $row1["status"] . '</td>
    <td></td>
    <td>' . $row1["nationality"] . '</td>
    <td></td>
    <td>&nbsp</td>
    <td>&nbsp</td>
  </tr>
  <tr>
    <td>' . $row1["passport_no"] . '</td>
    <td>' . $row1["date_of_issue"] . '</td>
    <td>&nbsp</td>
    <td>Sri Lanka</td>
    <td></td>
    <td>&nbsp</td>
    <td>&nbsp</td>
  </tr>
   <tr>
    <td>' . $row2["POS_APP"] . '</td>
    <td  align="center">' . $row1["agency"] . '</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
    <td>&nbsp</td>
  </tr>
</table>
</div>
<br>';
?>




