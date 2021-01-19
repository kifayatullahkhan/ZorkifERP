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
$query_RS_SelectVoucherNo = "SELECT * FROM erp_purchase_payment_vouchers";
$RS_SelectVoucherNo = mysql_query($query_RS_SelectVoucherNo, $Conn) or die(mysql_error());
$row_RS_SelectVoucherNo = mysql_fetch_assoc($RS_SelectVoucherNo);
$totalRows_RS_SelectVoucherNo = mysql_num_rows($RS_SelectVoucherNo);
?>
<div class="1">
<h2>Voucher Reference No Purchase Detail</h2>
  <form name="form1" method="post" action="erp_voucher_no_purchase_detail.php">
    <table border="1">
      <tr>
        <th colspan="2">VoucherReferenceNo</th>
        
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="VoucherReferenceNo"></label>
            <input name="VoucherReferenceNo" type="Hidden" value="<?php echo $row_RS_SelectVoucherNo['VoucherID']; ?>" size="50" readonly="readonly"/> 
            <select name="VoucherReferenceNo" id="VoucherReferenceNo">
            <?php 
do {  
?>
           <option value="<?php echo $row_RS_SelectVoucherNo['VoucherID']; ?>" ><?php echo $row_RS_SelectVoucherNo['VoucherReferenceNo']; ?></option>
          <?php
}  while ($row_RS_SelectVoucherNo = mysql_fetch_assoc($RS_SelectVoucherNo));
?>
          </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_SelectVoucherNo = mysql_fetch_assoc($RS_SelectVoucherNo)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_SelectVoucherNo);
?>
