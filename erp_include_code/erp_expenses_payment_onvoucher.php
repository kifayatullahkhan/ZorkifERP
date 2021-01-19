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

mysql_select_db($database_Conn, $Conn);
$query_RS_ExpensePayment = "SELECT * FROM erp_expense_payment_vouchers";
$RS_ExpensePayment = mysql_query($query_RS_ExpensePayment, $Conn) or die(mysql_error());
$row_RS_ExpensePayment = mysql_fetch_assoc($RS_ExpensePayment);
$totalRows_RS_ExpensePayment = mysql_num_rows($RS_ExpensePayment);
?>
<div class="1">
<h2>By VoucherReferenceNo Expense Payment Detail </h2>
  <form name="form1" method="post" action="erp_expenses_payment_onvoucher_detail.php">
    <table border="1">
      <tr>
        <th>VoucherReferenceNo</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="VoucherReferenceNo"></label>
            <input name="CustomerName" type="hidden" value="<?php echo $row_RS_ExpensePayment['VoucherID']; ?>" size="50" readonly="readonly"/>
            <select name="VoucherReferenceNo" id="VoucherReferenceNo">
            <?php do {  ?>
           <option value="<?php echo $row_RS_ExpensePayment['VoucherID']; ?>" ><?php echo $row_RS_ExpensePayment['VoucherReferenceNo']; ?></option>
          <?php } while ($row_RS_ExpensePayment = mysql_fetch_assoc($RS_ExpensePayment));?>
          </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_ExpensePayment = mysql_fetch_assoc($RS_ExpensePayment)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ExpensePayment);
?>
