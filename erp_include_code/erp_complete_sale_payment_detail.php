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
$query_RS_SalesPayment = "SELECT erp_customerpayments.OrderReferenceNo ,  erp_customers.CustomerName , erp_customerpayments.PaymentDate ,  erp_customerpayments.TotalAmount , erp_customerpayments.AmountPaid ,  erp_customerpayments.AmountLeft ,  erp_customerpayments.Comments, erp_customerpayments.PaymentStatus FROM erp_customerpayments JOIN erp_customerorders ON erp_customerorders.OrderReferenceNo = erp_customerpayments.OrderReferenceNo JOIN erp_customers ON erp_customers.CustomerID = erp_customerpayments.CustomerID WHERE  erp_customerpayments.PaymentDate BETWEEN '$from' AND '$to'";
$RS_SalesPayment = mysql_query($query_RS_SalesPayment, $Conn) or die(mysql_error());
$row_RS_SalesPayment = mysql_fetch_assoc($RS_SalesPayment);
$totalRows_RS_SalesPayment = mysql_num_rows($RS_SalesPayment);
?>
<div class="1">
<h2>Complete Sale Payment Detail</h2>
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
        <th>CustomerName</th>
        <th>PaymentDate</th>
        <th>TotalAmount</th>
        <th>AmountPaid</th>
        <th>AmountLeft</th>
        <th>Comments</th>
      </tr>
      <?php $TotalAmount=0; $AmountPaid=0; $AmountLeft=0; do { ?>
        <tr>
          <td><?php echo $row_RS_SalesPayment['OrderReferenceNo']; ?></td>
          <td><?php echo $row_RS_SalesPayment['CustomerName']; ?></td>
          <td><?php echo $row_RS_SalesPayment['PaymentDate']; ?></td>
          <td><?php echo $row_RS_SalesPayment['TotalAmount']; ?></td>
          <td><?php echo $row_RS_SalesPayment['AmountPaid']; ?></td>
          <td><?php echo $row_RS_SalesPayment['AmountLeft']; ?></td>
          <td><?php echo $row_RS_SalesPayment['Comments']; ?></td>
        </tr>
        <?php $TotalAmount=$TotalAmount+$row_RS_SalesPayment['TotalAmount'];?>
        <?php $AmountPaid=$AmountPaid+$row_RS_SalesPayment['AmountPaid'];?>
        <?php $AmountLeft=$AmountLeft+$row_RS_SalesPayment['AmountLeft'];?>
        <?php } while ($row_RS_SalesPayment = mysql_fetch_assoc($RS_SalesPayment)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>Total Amount: <?php echo $TotalAmount; ?></strong></td>
          <td><strong>Amount Recieved: <?php echo $AmountPaid; ?></strong></td>
          <td><strong>Amount Left: <?php echo $AmountLeft; ?></strong></td>
          <td>&nbsp;</td>
        </tr>
    </table>
  </form>

</div>
<?php
mysql_free_result($RS_SalesPayment);
?>
