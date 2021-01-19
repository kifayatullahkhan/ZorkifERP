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
$query_RS_ByTypeExpensePayment = "SELECT * FROM erp_expenses_payment_types";
$RS_ByTypeExpensePayment = mysql_query($query_RS_ByTypeExpensePayment, $Conn) or die(mysql_error());
$row_RS_ByTypeExpensePayment = mysql_fetch_assoc($RS_ByTypeExpensePayment);
$totalRows_RS_ByTypeExpensePayment = mysql_num_rows($RS_ByTypeExpensePayment);
?>
<div class="1">
<h2>By ExpenseType Expense Payment Detail </h2>
  <form name="form1" method="post" action="erp_bytype_expenses_payment_onvoucher_detail.php">
    <table border="1">
      <tr>
        <th>ExpenseType</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="ExpenseType"></label>
            <input name="ExpenseType" type="hidden" value="<?php echo $row_RS_ByTypeExpensePayment['ExpenseTypeID']; ?>" size="50" readonly="readonly"/>
            <select name="ExpenseType" id="ExpenseType">
            <?php do {  ?>
           <option value="<?php echo $row_RS_ByTypeExpensePayment['ExpenseTypeID']; ?>" ><?php echo $row_RS_ByTypeExpensePayment['ExpenseType']; ?></option>
          <?php } while($row_RS_ByTypeExpensePayment = mysql_fetch_assoc($RS_ByTypeExpensePayment));?>
          </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_ByTypeExpensePayment = mysql_fetch_assoc($RS_ByTypeExpensePayment)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ByTypeExpensePayment);
?>
