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
$query_RS_FinancialAccWithdrawl = "SELECT financial_account_bank_withdrawl.WithdrawalByName FROM financial_account_bank_withdrawl GROUP BY financial_account_bank_withdrawl.WithdrawalByName";
$RS_FinancialAccWithdrawl = mysql_query($query_RS_FinancialAccWithdrawl, $Conn) or die(mysql_error());
$row_RS_FinancialAccWithdrawl = mysql_fetch_assoc($RS_FinancialAccWithdrawl);
$totalRows_RS_FinancialAccWithdrawl = mysql_num_rows($RS_FinancialAccWithdrawl);
?>
<div class="1">
<h2> Financial Account Bank Withdrawl Detail</h2>
  <form name="form1" method="post" action="erp_financial_acc_bank_withdrawl_detail.php">
    <table border="1">
      <tr>
        <th>WithdrawalByName</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="WithdrawalByName"></label>
            <input name="WithdrawalByName" type="hidden" value="<?php echo $row_RS_FinancialAccWithdrawl['WithdrawalByName']; ?>" size="50" readonly="readonly"/>
            <select name="WithdrawalByName" id="WithdrawalByName">
            <?php do {  ?>
           <option value="<?php echo $row_RS_FinancialAccWithdrawl['WithdrawalByName']; ?>" ><?php echo $row_RS_FinancialAccWithdrawl['WithdrawalByName']; ?></option>
          <?php }  while ($row_RS_FinancialAccWithdrawl = mysql_fetch_assoc($RS_FinancialAccWithdrawl));?>
            </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_FinancialAccWithdrawl = mysql_fetch_assoc($RS_FinancialAccWithdrawl)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_FinancialAccWithdrawl);
?>
