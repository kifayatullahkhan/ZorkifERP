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
$query_RS_PurchasePayments = "SELECT erp_purchasepayments.OrderReferenceNo ,erp_supplierscompanies.SupplierName ,  erp_purchasepayments.PaymentDate , erp_purchasepayments.TotalPayment , erp_purchasepayments.PaymentPaid , erp_purchasepayments.PaymentLeft , erp_purchasepayments.Comments , erp_purchasepayments.PaymentStatus  FROM erp_purchasepayments  JOIN erp_purchaseordersproformainvoice ON erp_purchasepayments.OrderReferenceNo = erp_purchaseordersproformainvoice.OrderReferenceNo JOIN erp_supplierscompanies ON erp_supplierscompanies.SupplierID = erp_purchaseordersproformainvoice.SupplierID WHERE  erp_purchasepayments.PaymentDate BETWEEN '$from' AND '$to' ";
$RS_PurchasePayments = mysql_query($query_RS_PurchasePayments, $Conn) or die(mysql_error());
$row_RS_PurchasePayments = mysql_fetch_assoc($RS_PurchasePayments);
$totalRows_RS_PurchasePayments = mysql_num_rows($RS_PurchasePayments);
?>
<div class="1">
<h2>Complete Purchase Payment Detail</h2>
  <form name="form1" method="post" action="">
  <table width="200" border="1">
      <tr>
        <td><strong>From</strong></td>
        <td><strong><?php echo $ckdateget=$_POST['From']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>To</strong></td>
        <td><strong><?php echo $ckdateget=$_POST['To']; ?></strong></td>
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
        <th>OrderReferenceNo</th>
        <th>SupplierName</th>
        <th>PaymentDate</th>
        <th>TotalPayment</th>
        <th>AmountPaid</th>
        <th>AmountLeft</th>
        <th>Comments</th>
      </tr>
      <?php $TotalAmount=0; $AmountPaid=0; $AmountLeft=0; do { ?>
        <tr>
          <td><?php echo $row_RS_PurchasePayments['OrderReferenceNo']; ?></td>
          <td><?php echo $row_RS_PurchasePayments['SupplierName']; ?></td>
          <td><?php echo $row_RS_PurchasePayments['PaymentDate']; ?></td>
          <td><?php echo $row_RS_PurchasePayments['TotalPayment']; ?></td>
          <td><?php echo $row_RS_PurchasePayments['PaymentPaid']; ?></td>
          <td><?php echo $row_RS_PurchasePayments['PaymentLeft']; ?></td>
          <td><?php echo $row_RS_PurchasePayments['Comments']; ?></td>
        </tr>
        <?php $TotalAmount=$TotalAmount+$row_RS_PurchasePayments['TotalPayment']; ?>
        <?php $AmountPaid=$AmountPaid+$row_RS_PurchasePayments['PaymentPaid'];?>
        <?php $AmountLeft=$AmountLeft+$row_RS_PurchasePayments['PaymentLeft'];?>
        <?php } while ($row_RS_PurchasePayments = mysql_fetch_assoc($RS_PurchasePayments)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>Total Amount: <?php echo $TotalAmount; ?></strong></td>
          <td><strong>Amount Paid: <?php echo $AmountPaid; ?></strong></td>
          <td><strong>Amount Payable: <?php echo $AmountLeft; ?></strong></td>
          <td>&nbsp;</td>
        </tr>
    </table>
  </form>

</div>
<?php
mysql_free_result($RS_PurchasePayments);
?>
