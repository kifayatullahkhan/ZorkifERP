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
$Status=$_POST['OrderStatus'];
//POST Form

mysql_select_db($database_Conn, $Conn);
$query_RS_ExePenPurchaseDetail = "SELECT erp_productionitems.PItemDescription, erp_purchaseordersproformainvoice.OrderReferenceNo, erp_supplierscompanies.SupplierName,erp_purchaseordersproformainvoice.OrderStatus, erp_purchaseordersproformainvoicedetails.Quantity, erp_purchaseordersproformainvoicedetails.Price_Per_Unit, (erp_purchaseordersproformainvoicedetails.Quantity* erp_purchaseordersproformainvoicedetails.Price_Per_Unit) AS Debit FROM erp_productionitems  JOIN erp_purchaseordersproformainvoicedetails  ON erp_purchaseordersproformainvoicedetails.PItemID =erp_productionitems.PItemID   JOIN erp_purchaseordersproformainvoice   ON erp_purchaseordersproformainvoice.POPIID = erp_purchaseordersproformainvoicedetails.POPIID     JOIN erp_supplierscompanies  ON erp_supplierscompanies.SupplierID =  erp_purchaseordersproformainvoice.SupplierID WHERE erp_purchaseordersproformainvoice.OrderStatus = '$Status'";
$RS_ExePenPurchaseDetail = mysql_query($query_RS_ExePenPurchaseDetail, $Conn) or die(mysql_error());
$row_RS_ExePenPurchaseDetail = mysql_fetch_assoc($RS_ExePenPurchaseDetail);
$totalRows_RS_ExePenPurchaseDetail = mysql_num_rows($RS_ExePenPurchaseDetail);
?>
<div class="1">
<h2>Executed and Pending Purchase Orders Detail</h2>
  <form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>OrderStatus</strong></td>
        <td><strong><?php echo $row_RS_ExePenPurchaseDetail['OrderStatus']; ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<div class="1">
  <form id="form2" name="form2" method="post" action="">
    <table border="1">
      <tr>
        <th>PItemDescription</th>
        <th>OrderReferenceNo</th>
        <th>SupplierName</th>
        <th>Quantity</th>
        <th>Credit</th>
        <th>Debit</th>
      </tr>
      <?php  $Total_Amount=0; $Credit=0; $TotalAmount=0; do { ?>
        <tr>
          <td><?php echo $row_RS_ExePenPurchaseDetail['PItemDescription']; ?></td>
          <td><?php echo $row_RS_ExePenPurchaseDetail['OrderReferenceNo']; ?></td>
          <td><?php echo $row_RS_ExePenPurchaseDetail['SupplierName']; ?></td>
          <td><?php echo $row_RS_ExePenPurchaseDetail['Quantity']; ?></td>
          <td><?php echo $Credit['Credit']; ?></td>
          <td><?php echo $row_RS_ExePenPurchaseDetail['Debit']; ?></td>
        </tr>		
        <?php $TotalAmount=$TotalAmount+$Credit['Credit'];?>
        <?php $Total_Amount=$Total_Amount+$row_RS_ExePenPurchaseDetail['Debit'];?>
        <?php } while ($row_RS_ExePenPurchaseDetail = mysql_fetch_assoc($RS_ExePenPurchaseDetail)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>TotalAmount</strong></td>
          <td><strong><?php echo $TotalAmount;?></strong></td>
          <td><strong><?php echo $Total_Amount;?></strong></td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ExePenPurchaseDetail);
?>
