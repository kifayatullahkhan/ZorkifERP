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
$OrderNo=$_POST['VoucherReferenceNo'];
//Form POST

mysql_select_db($database_Conn, $Conn);
$query_RS_ExpensePayment = "SELECT erp_expense_payment_vouchers.VoucherReferenceNo, erp_expenses_payment_types.ExpenseType, erp_expense_payment_vouchers.Dated , erp_expense_payment_voucher_details.`Description`, erp_expense_payment_voucher_details.Amount FROM erp_expenses_payment_types JOIN erp_expense_payment_voucher_details ON erp_expenses_payment_types.ExpenseTypeID = erp_expense_payment_voucher_details.ExpenseTypeID JOIN erp_expense_payment_vouchers ON erp_expense_payment_voucher_details.VoucherID = erp_expense_payment_vouchers.VoucherID WHERE erp_expense_payment_voucher_details.VoucherID = '$OrderNo'";
$RS_ExpensePayment = mysql_query($query_RS_ExpensePayment, $Conn) or die(mysql_error());
$row_RS_ExpensePayment = mysql_fetch_assoc($RS_ExpensePayment);
$totalRows_RS_ExpensePayment = mysql_num_rows($RS_ExpensePayment);
?>
<div class="1">
<h2>By VoucherReferenceNo Expense Payment Detail </h2>
  <form name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>VoucherReferenceNo</strong></td>
        <td><strong><?php echo $row_RS_ExpensePayment['VoucherReferenceNo']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>Date</strong></td>
        <td><strong><?php echo $row_RS_ExpensePayment['Dated']; ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<div class="1">
  <form name="form2" method="post" action="">
    <table border="1">
      <tr>
        <th>ExpenseType</th>
        <th>Description</th>
        <th>Amount</th>
      </tr>
      <?php $Total_Amount=0; do { ?>
        <tr>
          <td><?php echo $row_RS_ExpensePayment['ExpenseType']; ?></td>
          <td><?php echo $row_RS_ExpensePayment['Description']; ?></td>
          <td><?php echo $row_RS_ExpensePayment['Amount']; ?></td>
        </tr>
        <?php $Total_Amount=$Total_Amount+$row_RS_ExpensePayment['Amount'];?>
        <?php } while ($row_RS_ExpensePayment = mysql_fetch_assoc($RS_ExpensePayment)); ?>
        <tr>
          <td>&nbsp;</td>
          <td><strong>TotalAmount</strong></td>
          <td><strong><?php echo $Total_Amount;?></strong></td>
        </tr>
    </table>
  </form>

</div>
<?php
mysql_free_result($RS_ExpensePayment);
?>
