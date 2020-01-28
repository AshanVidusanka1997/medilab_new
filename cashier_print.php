<?php

include './connection_sql.php';
?>





<?php

include './connection_sql.php';


$mid = $_GET["refno_txt"];



    $sql1 = "SELECT * FROM cashier where refno = '" . $mid . "'";


    $result1 = $conn->query($sql1);
    $row1 = $result1->fetch();

    




    echo '<br>
        <div id="page-wrap"> 
<div> 
<table style="width:100%">
  <tr >
    <th colspan="5"><h3>MEDILAB LANKA (PVT) LTD</h3></th>
  </tr>
  <tr>
    <th colspan="5">No 260, Deans Road, Colombo 10</th>
  </tr>
  <tr>
    <th colspan="5">TEL : 011-5836661, 011-5851223</th>
  </tr>
  <tr>
    <th colspan="5">WEB :www.medilablanka.com</th>
  </tr>
   <tr>
    <th colspan="5">Recipt Copy</th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td  width="50%" align="right" height="50">Date </td>
    <td  width="1%"> : </td>
    <td  width="50%" align="left" height="50">' . $row1["cdate"] . '</td>
    <td></td>
  </tr>
  <tr>
    <td ></td>
    <td width="50%" align="right" height="40"> Lab No</td>
    <td  width="1%"> : </td>
    <td width="50%" align="left" height="40">' . $row1["labno"] . '</td>


  </tr>
  <tr>
    <td ></td>
    <td width="50%"  align="right" height="40">Name</td>
    <td  width="1%"> : </td>
    <td width="50%"  align="left" height="40">' . $row1["fname"] . '</td>
  </tr>
  <tr>
    <td></td>
    <td width="50%"  align="right" height="40"> Passport No</td>
    <td  width="1%"> : </td>
    <td width="50%" align="left" height="40"> ' . $row1["pno"] . ' </td>
  </tr>
  <tr>
    <td></td>
    <td width="50%" align="right" height="40">Country</td>
    <td  width="1%"> : </td>
    <td width="50%" align="left" height="40">' . $row1["cou_name"] . ' </td>
  </tr>
  <tr>
    <td></td>
    <td width="50%" align="right" height="40">Amount</td>
    <td  width="1%"> : </td>
    <td width="50%" align="left" height="40">' . $row1["pamt"] . ' </td>

  </tr>
</table>
</div>
<br>';
?>




