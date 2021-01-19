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
$query_RS_PurchasePayment = "SELECT erp_purchasepayments.OrderReferenceNo ,erp_supplierscompanies.SupplierName ,  erp_purchasepayments.PaymentDate , erp_purchasepayments.TotalPayment , erp_purchasepayments.PaymentPaid , erp_purchasepayments.PaymentLeft , erp_purchasepayments.Comments , erp_purchasepayments.PaymentStatus  FROM erp_purchasepayments  JOIN erp_purchaseordersproformainvoice ON erp_purchasepayments.OrderReferenceNo = erp_purchaseordersproformainvoice.OrderReferenceNo JOIN erp_supplierscompanies ON erp_supplierscompanies.SupplierID = erp_purchaseordersproformainvoice.SupplierID WHERE erp_purchasepayments.PurchasePaymentID = '$Order_No' ";
$RS_PurchasePayment = mysql_query($query_RS_PurchasePayment, $Conn) or die(mysql_error());
$row_RS_PurchasePayment = mysql_fetch_assoc($RS_PurchasePayment);
$totalRows_RS_PurchasePayment = mysql_num_rows($RS_PurchasePayment);
?>
<div class="1">
<h2>By Order Reference No. Purchase Payment Detail</h2>
  <form name="form1" method="post" action="">
  <table width="200" border="1">
      <tr>
        <td><strong>OrderReferenceNo</strong></td>
        <td><strong><?php echo $row_RS_PurchasePayment['OrderReferenceNo']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>SupplierName</strong></td>
        <td><strong><?php echo $row_RS_PurchasePayment['SupplierName']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>PaymentDate</strong></td>
        <td><strong><?php echo $row_RS_PurchasePayment['PaymentDate']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>PaymentStatus</strong></td>
        <td><strong><?php echo $row_RS_PurchasePayment['PaymentStatus']; ?></strong></td>
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
        <th>TotalPayment</th>
        <th>PaymentPaid</th>
        <th>PaymentLeft</th>
        <th>Comments</th>
      </tr>
      <?php $TotalAmount=0; $AmountPaid=0; $AmountLeft=0; do { ?>
        <tr>
          <td><?php echo $row_RS_PurchasePayment['TotalPayment']; ?></td>
          <td><?php echo $row_RS_PurchasePayment['PaymentPaid']; ?></td>
          <td><?php echo $row_RS_PurchasePayment['PaymentLeft']; ?></td>
          <td><?php echo $row_RS_PurchasePayment['Comments']; ?></td>
        </tr>
        <?php $TotalAmount=$TotalAmount+$row_RS_PurchasePayment['TotalPayment']; ?>
        <?php $AmountPaid=$AmountPaid+$row_RS_PurchasePayment['PaymentPaid'];?>
        <?php $AmountLeft=$AmountLeft+$row_RS_PurchasePayment['PaymentLeft'];?>
        <?php } while ($row_RS_PurchasePayment = mysql_fetch_assoc($RS_PurchasePayment)); ?>
        <tr>
          <td><strong>Total Amount: <?php echo $TotalAmount; ?></strong></td>
          <td><strong>Amount Paid: <?php echo $AmountPaid; ?></strong></td>
          <td><strong>Amount Payable: <?php echo $AmountLeft; ?></strong></td>
          <td>&nbsp;</td>
        </tr>
    </table>
  </form>

</div>
<?php
mysql_free_result($RS_PurchasePayment);
?>
