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
$Order_No=$_POST['OrderReferenceNo'];
// POST Form

mysql_select_db($database_Conn, $Conn);
$query_RS_OrderNoPurchase = "SELECT erp_supplierscompanies.SupplierName, erp_purchaseordersproformainvoice.OrderReferenceNo, erp_purchaseordersproformainvoice.OrderDate,  erp_productionitems.PItemDescription,erp_purchaseordersproformainvoice.OrderStatus, erp_purchaseordersproformainvoicedetails.Quantity, erp_purchaseordersproformainvoicedetails.Price_Per_Unit,  (erp_purchaseordersproformainvoicedetails.Quantity* erp_purchaseordersproformainvoicedetails.Price_Per_Unit) AS PurchaseTotal, (erp_otherexpensesonsupplierinvoice.CustomDuty+ erp_otherexpensesonsupplierinvoice.PortDuty + erp_otherexpensesonsupplierinvoice.DeleryOrder + erp_otherexpensesonsupplierinvoice.Transportation + erp_otherexpensesonsupplierinvoice.ClearingAgentCharges + erp_otherexpensesonsupplierinvoice.LabourCharges + erp_otherexpensesonsupplierinvoice.LABTestingCharges + erp_otherexpensesonsupplierinvoice.Detention_Mina + erp_otherexpensesonsupplierinvoice.Detention_Container + erp_otherexpensesonsupplierinvoice.OtherCharges) AS OtherExpenses,  ((erp_purchaseordersproformainvoicedetails.Quantity* erp_purchaseordersproformainvoicedetails.Price_Per_Unit) + (erp_otherexpensesonsupplierinvoice.CustomDuty+ erp_otherexpensesonsupplierinvoice.PortDuty + erp_otherexpensesonsupplierinvoice.DeleryOrder + erp_otherexpensesonsupplierinvoice.Transportation + erp_otherexpensesonsupplierinvoice.ClearingAgentCharges + erp_otherexpensesonsupplierinvoice.LabourCharges + erp_otherexpensesonsupplierinvoice.LABTestingCharges + erp_otherexpensesonsupplierinvoice.Detention_Mina + erp_otherexpensesonsupplierinvoice.Detention_Container + erp_otherexpensesonsupplierinvoice.OtherCharges)) AS Debit FROM erp_supplierscompanies  JOIN erp_purchaseordersproformainvoice    ON erp_supplierscompanies.SupplierID = erp_purchaseordersproformainvoice.SupplierID   JOIN erp_otherexpensesonsupplierinvoice  ON erp_purchaseordersproformainvoice.POPIID = erp_otherexpensesonsupplierinvoice.POPIID  JOIN erp_purchaseordersproformainvoicedetails    ON erp_purchaseordersproformainvoicedetails.POPIID = erp_purchaseordersproformainvoice.POPIID   JOIN erp_productionitems   ON erp_productionitems.PItemID = erp_purchaseordersproformainvoicedetails.PItemID  WHERE erp_purchaseordersproformainvoicedetails.POPIID='$Order_No' AND erp_supplierscompanies.SupplierID =  erp_otherexpensesonsupplierinvoice.SupplierID";
$RS_OrderNoPurchase = mysql_query($query_RS_OrderNoPurchase, $Conn) or die(mysql_error());
$row_RS_OrderNoPurchase = mysql_fetch_assoc($RS_OrderNoPurchase);
$totalRows_RS_OrderNoPurchase = mysql_num_rows($RS_OrderNoPurchase);
?>
<div class="1">
<h2>Order Refrence No Purchase Detail</h2>
  <form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>OrderReferenceNo</strong></td>
        <td><strong><?php echo $row_RS_OrderNoPurchase['OrderReferenceNo']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>SupplierName</strong></td>
        <td><strong><?php echo $row_RS_OrderNoPurchase['SupplierName']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>OrderDate</strong></td>
        <td><strong><?php echo $row_RS_OrderNoPurchase['OrderDate']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>OrderStatus</strong></td>
        <td><strong><?php echo $row_RS_OrderNoPurchase['OrderStatus']; ?></strong></td>
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
        <th>ItemDescription</th>
        <th>Quantity</th>
        <th>Price_Per_Unit</th>
        <th>PurchaseTotal</th>
        <th>OtherExpenses</th>
        <th>Debit</th>
        <th>Credit</th>
      </tr>
      <?php $Credit=0; $S_Debit=0; $S_Credit=0; do { ?>
        <tr>
          <td><?php echo $row_RS_OrderNoPurchase['PItemDescription']; ?></td>
          <td><?php echo $row_RS_OrderNoPurchase['Quantity']; ?></td>
          <td><?php echo $row_RS_OrderNoPurchase['Price_Per_Unit']; ?></td>
          <td><?php echo $row_RS_OrderNoPurchase['PurchaseTotal']; ?></td>
          <td><?php echo $row_RS_OrderNoPurchase['OtherExpenses']; ?></td>
          <td><?php echo $row_RS_OrderNoPurchase['Debit']; ?></td>
           <td><?php $Credit['Credit']; ?></td>
        </tr>
        <?php $S_Debit=$S_Debit+$row_RS_OrderNoPurchase['Debit'];?>
        <?php $S_Credit=$S_Credit+$Credit['Credit'];?>
        <?php } while ($row_RS_OrderNoPurchase = mysql_fetch_assoc($RS_OrderNoPurchase)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
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
mysql_free_result($RS_OrderNoPurchase);
?>
