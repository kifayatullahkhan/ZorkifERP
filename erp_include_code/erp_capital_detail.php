<?php //require_once('../../Connections/Conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_Conn, $Conn);
$query_RS_CapitalDetail = "SELECT * FROM erp_accounts_capital_account";
$RS_CapitalDetail = mysql_query($query_RS_CapitalDetail, $Conn) or die(mysql_error());
$row_RS_CapitalDetail = mysql_fetch_assoc($RS_CapitalDetail);
$totalRows_RS_CapitalDetail = mysql_num_rows($RS_CapitalDetail);
?>
<div class="1">
<h2>Capital Account Detail</h2>
  <form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
      <tr>
        <td><strong>SystemDate</strong></td>
        <td><strong><?php echo date('d-m-Y'); ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<div class="1">
  <form name="form2" method="post" action="">
    <table border="1">
      <tr>
        <th>CapitalID</th>
        <th>Partner1Name</th>
        <th>Partner1Amount</th>
        <th>Partner2Name</th>
        <th>Partner2Amount</th>
        <th>Partner3Name</th>
        <th>Partner3Amount</th>
      </tr>
      <?php $C_Amount=0; do { ?>
        <tr>
          <td><?php echo $row_RS_CapitalDetail['CapitalID']; ?></td>
          <td><?php echo $row_RS_CapitalDetail['Partner1Name']; ?></td>
          <td><?php echo $row_RS_CapitalDetail['Partner1Amount']; ?></td>
          <td><?php echo $row_RS_CapitalDetail['Partner2Name']; ?></td>
          <td><?php echo $row_RS_CapitalDetail['Partner2Amount']; ?></td>
          <td><?php echo $row_RS_CapitalDetail['Partner3Name']; ?></td>
          <td><?php echo $row_RS_CapitalDetail['Partner3Amount']; ?></td>
        </tr>
        <?php $C_Amount=$C_Amount+$row_RS_CapitalDetail['CapitalAmount'];?>
        <?php } while ($row_RS_CapitalDetail = mysql_fetch_assoc($RS_CapitalDetail)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>Total Capital Amount</strong></td>
          <td><strong><?php echo $C_Amount;?></strong></td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_CapitalDetail);
?>
