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
$ckdateget=$_POST['From'];
		$dt_frm=$ckdateget;
			$ckday=substr($ckdateget,0,2);
			$ckmonth=substr($ckdateget,3,2);	
			$ckyear=substr($ckdateget,6,4);
			 $from="$ckyear-$ckmonth-$ckday";
		
$ckdateget=$_POST['To'];
		$dt_to=$ckdateget;
			$ckday=substr($ckdateget,0,2);
			$ckmonth=substr($ckdateget,3,2);	
			$ckyear=substr($ckdateget,6,4);
			 $to="$ckyear-$ckmonth-$ckday";
// POST Form 

mysql_select_db($database_Conn, $Conn);
$query_RS_PurchaseLedger = "SELECT erp_purchaseordersproformainvoice.OrderDate, erp_purchaseordersproformainvoice.OrderReferenceNo, erp_supplierscompanies.SupplierName, erp_productionitems.PItemDescription,erp_purchaseordersproformainvoice.OrderStatus,   (erp_purchaseordersproformainvoicedetails.Quantity* erp_purchaseordersproformainvoicedetails.Price_Per_Unit) AS PurchaseTotal, (erp_otherexpensesonsupplierinvoice.CustomDuty+ erp_otherexpensesonsupplierinvoice.PortDuty + erp_otherexpensesonsupplierinvoice.DeleryOrder + erp_otherexpensesonsupplierinvoice.Transportation + erp_otherexpensesonsupplierinvoice.ClearingAgentCharges + erp_otherexpensesonsupplierinvoice.LabourCharges + erp_otherexpensesonsupplierinvoice.LABTestingCharges + erp_otherexpensesonsupplierinvoice.Detention_Mina + erp_otherexpensesonsupplierinvoice.Detention_Container + erp_otherexpensesonsupplierinvoice.OtherCharges) AS OtherExpenses,  ((erp_purchaseordersproformainvoicedetails.Quantity* erp_purchaseordersproformainvoicedetails.Price_Per_Unit) + (erp_otherexpensesonsupplierinvoice.CustomDuty+ erp_otherexpensesonsupplierinvoice.PortDuty + erp_otherexpensesonsupplierinvoice.DeleryOrder + erp_otherexpensesonsupplierinvoice.Transportation + erp_otherexpensesonsupplierinvoice.ClearingAgentCharges + erp_otherexpensesonsupplierinvoice.LabourCharges + erp_otherexpensesonsupplierinvoice.LABTestingCharges + erp_otherexpensesonsupplierinvoice.Detention_Mina + erp_otherexpensesonsupplierinvoice.Detention_Container + erp_otherexpensesonsupplierinvoice.OtherCharges)) AS Debit     FROM erp_supplierscompanies  JOIN erp_purchaseordersproformainvoice  ON erp_supplierscompanies.SupplierID = erp_purchaseordersproformainvoice.SupplierID  JOIN erp_otherexpensesonsupplierinvoice  ON erp_purchaseordersproformainvoice.POPIID = erp_otherexpensesonsupplierinvoice.POPIID  JOIN erp_purchaseordersproformainvoicedetails  ON erp_purchaseordersproformainvoicedetails.POPIID = erp_purchaseordersproformainvoice.POPIID  JOIN erp_productionitems  ON erp_purchaseordersproformainvoicedetails.PItemID = erp_productionitems.PItemID  WHERE erp_purchaseordersproformainvoice.OrderDate BETWEEN '$from' AND '$to' AND erp_purchaseordersproformainvoice.OrderStatus = 'DONE' AND erp_supplierscompanies.SupplierID =  erp_otherexpensesonsupplierinvoice.SupplierID";
$RS_PurchaseLedger = mysql_query($query_RS_PurchaseLedger, $Conn) or die(mysql_error());
$row_RS_PurchaseLedger = mysql_fetch_assoc($RS_PurchaseLedger);
$totalRows_RS_PurchaseLedger = mysql_num_rows($RS_PurchaseLedger);
?>
<div class="1">
<h2>  Complete Purchase Ledger Detail</h2>
  <form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>FROM</strong></td>
        <td><strong><?php echo $ckdateget=$_POST['From']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>TO</strong></strong></td>
        <td><strong><?php echo $ckdateget=$_POST['To'];?></strong></td>
      </tr>
      <tr>
        <td><strong>OrderStatus</strong></td>
        <td><strong><?php echo $row_RS_PurchaseLedger['OrderStatus']; ?></strong></td>
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
        <th>OrderDate</th>
        <th>OrderReferenceNo</th>
        <th>SupplierName</th>
        <th>PItemDescription</th>
        <th>PurchaseTotal</th>
        <th>OtherExpenses</th>
        <th>Debit</th>
        <th>Credit</th>
      </tr>
      <?php $Credit=0; $S_Debit=0; $S_Credit=0; do { ?>
        <tr>
          <td><?php echo $row_RS_PurchaseLedger['OrderDate']; ?></td>
          <td><?php echo $row_RS_PurchaseLedger['OrderReferenceNo']; ?></td>
          <td><?php echo $row_RS_PurchaseLedger['SupplierName']; ?></td>
          <td><?php echo $row_RS_PurchaseLedger['PItemDescription']; ?></td>
          <td><?php echo $row_RS_PurchaseLedger['PurchaseTotal']; ?></td>
          <td><?php echo $row_RS_PurchaseLedger['OtherExpenses']; ?></td>
          <td><?php echo $row_RS_PurchaseLedger['Debit']; ?></td>
          <td><?php $Credit['Credit']; ?></td>
        </tr>
        <?php $S_Debit=$S_Debit+$row_RS_PurchaseLedger['Debit'];?>
        <?php $S_Credit=$S_Credit+$Credit['Credit'];?>
        <?php } while ($row_RS_PurchaseLedger = mysql_fetch_assoc($RS_PurchaseLedger)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>Balance</strong></td>
          <td><strong>Dr : <?php echo $S_Debit;?></strong></td>
          <td><strong>Cr : <?php echo $S_Credit;?></strong></td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_PurchaseLedger);
?>
