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
$query_RS_financialAccDrCr = "SELECT * FROM erp_financial_account_bank_names";
$RS_financialAccDrCr = mysql_query($query_RS_financialAccDrCr, $Conn) or die(mysql_error());
$row_RS_financialAccDrCr = mysql_fetch_assoc($RS_financialAccDrCr);
$totalRows_RS_financialAccDrCr = mysql_num_rows($RS_financialAccDrCr);
?>
<div class="1">
<h2>Financial Account Bank Transactions Detail</h2>
  <form name="form1" method="post" action="erp_financial_acc_bank_transactions_detail.php">
    <table border="1">
      <tr>
        <th>BankName</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="BankName"></label>
            <input name="BankName" type="hidden" value="<?php echo $row_RS_financialAccDrCr['BankID']; ?>" size="50" readonly="readonly" />
            <select name="BankName" id="BankName">
            <?php do {  ?>
           <option value="<?php echo $row_RS_financialAccDrCr['BankID']; ?>" ><?php echo $row_RS_financialAccDrCr['BankName']; ?></option>
          <?php }  while ($row_RS_financialAccDrCr = mysql_fetch_assoc($RS_financialAccDrCr));?>
            </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_financialAccDrCr = mysql_fetch_assoc($RS_financialAccDrCr)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_financialAccDrCr);
?>
