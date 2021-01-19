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
$query_RS_ByVoucharNoTaxPayments = "SELECT * FROM erp_tax_payment_vouchers";
$RS_ByVoucharNoTaxPayments = mysql_query($query_RS_ByVoucharNoTaxPayments, $Conn) or die(mysql_error());
$row_RS_ByVoucharNoTaxPayments = mysql_fetch_assoc($RS_ByVoucharNoTaxPayments);
$totalRows_RS_ByVoucharNoTaxPayments = mysql_num_rows($RS_ByVoucharNoTaxPayments);
?>
<div class="1">
<h2>Bby Vouchar No. Tax Payment Details</h2>
  <form name="form1" method="post" action="erp_byvoucher_no_tax_payments_detail.php">
    <table border="1">
      <tr>
        <th>VoucherNo</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="VoucherReferenceNo"></label>
             <input name="TaxType" type="hidden" value="<?php echo $row_RS_ByVoucharNoTaxPayments['VoucherID']; ?>" size="50" readonly="readonly" />
            <select name="VoucherReferenceNo" id="VoucherReferenceNo">
            <?php do {  ?>
           <option value="<?php echo $row_RS_ByVoucharNoTaxPayments['VoucherID']; ?>" ><?php echo $row_RS_ByVoucharNoTaxPayments['VoucherReferenceNo']; ?></option>
          <?php }  while ($row_RS_ByVoucharNoTaxPayments = mysql_fetch_assoc($RS_ByVoucharNoTaxPayments)); ?>
          </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_ByVoucharNoTaxPayments = mysql_fetch_assoc($RS_ByVoucharNoTaxPayments)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ByVoucharNoTaxPayments);
?>
