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
$query_RS_SalePayment = "SELECT erp_customerpayments.OrderReferenceNo ,  erp_customers.CustomerName , erp_customerpayments.PaymentDate ,  erp_customerpayments.TotalAmount , erp_customerpayments.AmountPaid ,  erp_customerpayments.AmountLeft ,  erp_customerpayments.Comments, erp_customerpayments.PaymentStatus FROM erp_customerpayments JOIN erp_customerorders ON erp_customerorders.OrderReferenceNo = erp_customerpayments.OrderReferenceNo JOIN erp_customers ON erp_customers.CustomerID = erp_customerpayments.CustomerID WHERE erp_customerpayments.CustomerPaymentID = '$Order_No' ";
$RS_SalePayment = mysql_query($query_RS_SalePayment, $Conn) or die(mysql_error());
$row_RS_SalePayment = mysql_fetch_assoc($RS_SalePayment);
$totalRows_RS_SalePayment = mysql_num_rows($RS_SalePayment);
?>
<div class="1">
<h2>By Order Reference No. Sale Payment Detail</h2>
  <form name="form1" method="post" action="">
  <table width="200" border="1">
      <tr>
        <td><strong>OrderReferenceNo</strong></td>
        <td><strong><?php echo $row_RS_SalePayment['OrderReferenceNo']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>CustomerName</strong></td>
        <td><strong><?php echo $row_RS_SalePayment['CustomerName']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>PaymentDate</strong></td>
        <td><strong><?php echo $row_RS_SalePayment['PaymentDate']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>PaymentStatus</strong></td>
        <td><strong><?php echo $row_RS_SalePayment['PaymentStatus']; ?></strong></td>
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
        <th>TotalAmount</th>
        <th>AmountPaid</th>
        <th>AmountLeft</th>
        <th>Comments</th>
      </tr>
      <?php $TotalAmount=0; $AmountPaid=0; $AmountLeft=0; do { ?>
        <tr>
          <td><?php echo $row_RS_SalePayment['TotalAmount']; ?></td>
          <td><?php echo $row_RS_SalePayment['AmountPaid']; ?></td>
          <td><?php echo $row_RS_SalePayment['AmountLeft']; ?></td>
          <td><?php echo $row_RS_SalePayment['Comments']; ?></td>
        </tr>
        <?php $TotalAmount=$TotalAmount+$row_RS_SalePayment['TotalAmount'];?>
        <?php $AmountPaid=$AmountPaid+$row_RS_SalePayment['AmountPaid'];?>
        <?php $AmountLeft=$AmountLeft+$row_RS_SalePayment['AmountLeft'];?>
        <?php } while ($row_RS_SalePayment = mysql_fetch_assoc($RS_SalePayment)); ?>
        <tr>
          <td><strong>Total Amount: <?php echo $TotalAmount; ?></strong></td>
          <td><strong>Amount Recieved: <?php echo $AmountPaid; ?></strong></td>
          <td><strong>Amount Left: <?php echo $AmountLeft; ?></strong></td>
          <td>&nbsp;</td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_SalePayment);
?>
