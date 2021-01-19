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

//Form POST
$Type=$_POST['TaxType'];
//Form POST

mysql_select_db($database_Conn, $Conn);
$query_RS_ByTypeTaxpayment = "SELECT erp_tax_payment_types.TaxType , erp_tax_payment_vouchers.VoucherReferenceNo ,  erp_tax_payment_vouchers.Dated , erp_tax_payment_voucher_details.NetProfit , erp_tax_payment_voucher_details.TaxPercentage , erp_tax_payment_voucher_details.TaxAmount FROM erp_tax_payment_types JOIN erp_tax_payment_voucher_details ON erp_tax_payment_voucher_details.TaxTypeID = erp_tax_payment_types.TaxTypeID JOIN erp_tax_payment_vouchers ON erp_tax_payment_vouchers.VoucherID = erp_tax_payment_voucher_details.VoucherID WHERE erp_tax_payment_types.TaxTypeID = '$Type'";
$RS_ByTypeTaxpayment = mysql_query($query_RS_ByTypeTaxpayment, $Conn) or die(mysql_error());
$row_RS_ByTypeTaxpayment = mysql_fetch_assoc($RS_ByTypeTaxpayment);
$totalRows_RS_ByTypeTaxpayment = mysql_num_rows($RS_ByTypeTaxpayment);
?>
<div class="1">
<h2>By Tax Type Tax Payment Details</h2>
  <form name="form1" method="post" action="">
  <table width="200" border="1">
      <tr>
        <td><strong>TaxType</strong></td>
        <td><strong><?php echo $row_RS_ByTypeTaxpayment['TaxType']; ?></strong></td>
      </tr>
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
        <th>VoucherReferenceNo</th>
        <th>Dated</th>
        <th>NetProfit</th>
        <th>TaxPercentage</th>
        <th>TaxAmount</th>
      </tr>
      <?php $TaxAmount=0; do { ?>
        <tr>
          <td><?php echo $row_RS_ByTypeTaxpayment['VoucherReferenceNo']; ?></td>
          <td><?php echo $row_RS_ByTypeTaxpayment['Dated']; ?></td>
          <td><?php echo $row_RS_ByTypeTaxpayment['NetProfit']; ?></td>
          <td><?php echo $row_RS_ByTypeTaxpayment['TaxPercentage']; ?></td>
          <td><?php echo $row_RS_ByTypeTaxpayment['TaxAmount']; ?></td>
        </tr>
        <?php $TaxAmount=$TaxAmount+$row_RS_ByTypeTaxpayment['TaxAmount'];?>
        <?php } while ($row_RS_ByTypeTaxpayment = mysql_fetch_assoc($RS_ByTypeTaxpayment)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>Tax Amount</strong></td>
          <td><strong><?php echo $TaxAmount; ?></strong></td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ByTypeTaxpayment);
?>
