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

// POST Form
 $Vchar_No=$_POST['VoucherReferenceNo'];
// POST Form 

mysql_select_db($database_Conn, $Conn);
$query_RS_VoucherNoDetail = "SELECT erp_purchase_payment_vouchers.VoucherReferenceNo, erp_purchase_payment_vouchers_details.Description, erp_purchase_payment_vouchers.Dated,  erp_supplierscompanies.SupplierName,erp_purchase_payment_vouchers.Status, erp_purchase_payment_vouchers_details.Amount, (erp_otherexpensesonsupplierinvoice.CustomDuty+ erp_otherexpensesonsupplierinvoice.PortDuty + erp_otherexpensesonsupplierinvoice.DeleryOrder + erp_otherexpensesonsupplierinvoice.Transportation + erp_otherexpensesonsupplierinvoice.ClearingAgentCharges + erp_otherexpensesonsupplierinvoice.LabourCharges + erp_otherexpensesonsupplierinvoice.LABTestingCharges + erp_otherexpensesonsupplierinvoice.Detention_Mina + erp_otherexpensesonsupplierinvoice.Detention_Container + erp_otherexpensesonsupplierinvoice.OtherCharges) AS OtherExpenses , ((erp_purchase_payment_vouchers_details.Amount) + (erp_otherexpensesonsupplierinvoice.CustomDuty+ erp_otherexpensesonsupplierinvoice.PortDuty + erp_otherexpensesonsupplierinvoice.DeleryOrder + erp_otherexpensesonsupplierinvoice.Transportation + erp_otherexpensesonsupplierinvoice.ClearingAgentCharges + erp_otherexpensesonsupplierinvoice.LabourCharges + erp_otherexpensesonsupplierinvoice.LABTestingCharges + erp_otherexpensesonsupplierinvoice.Detention_Mina + erp_otherexpensesonsupplierinvoice.Detention_Container + erp_otherexpensesonsupplierinvoice.OtherCharges)) AS Debit  FROM erp_purchase_payment_vouchers  JOIN erp_purchase_payment_vouchers_details  ON erp_purchase_payment_vouchers.VoucherID =erp_purchase_payment_vouchers_details.VoucherID  JOIN erp_otherexpensesonsupplierinvoice  ON erp_purchase_payment_vouchers_details.POPIID = erp_otherexpensesonsupplierinvoice.POPIID  JOIN erp_supplierscompanies  ON erp_supplierscompanies.SupplierID  = erp_purchase_payment_vouchers.SupplierID  WHERE  erp_purchase_payment_vouchers.VoucherID = '$Vchar_No' AND erp_purchase_payment_vouchers.SupplierID =  erp_otherexpensesonsupplierinvoice.SupplierID";
$RS_VoucherNoDetail = mysql_query($query_RS_VoucherNoDetail, $Conn) or die(mysql_error());
$row_RS_VoucherNoDetail = mysql_fetch_assoc($RS_VoucherNoDetail);
$totalRows_RS_VoucherNoDetail = mysql_num_rows($RS_VoucherNoDetail);
?>
<div class="1">
<h2>Voucher Reference No Purchase Detail</h2>
  <form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>VoucherReferenceNo</strong></td>
        <td><strong><?php echo $row_RS_VoucherNoDetail['VoucherReferenceNo']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>SupplierName</strong></td>
        <td><strong><?php echo $row_RS_VoucherNoDetail['SupplierName']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>Date</strong></td>
        <td><strong><?php echo $row_RS_VoucherNoDetail['Dated']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>Status</strong></td>
        <td><strong><?php echo $row_RS_VoucherNoDetail['Status']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>SystemDate</strong></td>
        <td><strong><?php echo date('d-m-Y'); ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<div class="1">
  <form id="form2" name="form2" method="post" action="">
    <table border="1">
      <tr>
        <th>Description</th>
        <th>Amount</th>
        <th>OtherExpenses</th>
        <th>Debit</th>
        <th>Credit</th>
      </tr>
      <?php $Credit=0; $S_Debit=0; $S_Credit=0; do { ?>
        <tr>
          <td><?php echo $row_RS_VoucherNoDetail['Description']; ?></td>
          <td><?php echo $row_RS_VoucherNoDetail['Amount']; ?></td>
          <td><?php echo $row_RS_VoucherNoDetail['OtherExpenses']; ?></td>
          <td><?php echo $row_RS_VoucherNoDetail['Debit']; ?></td>
          <td><?php $Credit['Debit']; ?></td>
        </tr>
        <?php $S_Debit=$S_Debit+$row_RS_VoucherNoDetail['Debit'];?>
        <?php $S_Credit=$S_Credit+$Credit['Credit'];?>
        <?php } while ($row_RS_VoucherNoDetail = mysql_fetch_assoc($RS_VoucherNoDetail)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>TotalAmount</strong></td>
          <td><strong>Dr : <?php echo $S_Debit;?></strong></td>
          <td><strong>Cr : <?php echo $S_Credit;?></strong></td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_VoucherNoDetail);
?>
