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
$query_RS_FinancialAccDebositor = "SELECT financial_account_bank_deposits.DepositerName FROM financial_account_bank_deposits GROUP BY financial_account_bank_deposits.DepositerName ";
$RS_FinancialAccDebositor = mysql_query($query_RS_FinancialAccDebositor, $Conn) or die(mysql_error());
$row_RS_FinancialAccDebositor = mysql_fetch_assoc($RS_FinancialAccDebositor);
$totalRows_RS_FinancialAccDebositor = mysql_num_rows($RS_FinancialAccDebositor);
?>
<div class="1">
<h2>Financial Account Bank Deposits Detail</h2>
  <form name="form1" method="post" action="erp_financial_acc_bank_deposits_detail.php">
    <table border="1">
      <tr>
        <th>DepositerName</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="DepositerName"></label>
            <input name="DepositerName" type="hidden" value="<?php echo $row_RS_FinancialAccDebositor['DepositerName']; ?>" size="50" readonly="readonly"/>
            <select name="DepositerName" id="DepositerName">
            <?php do {  ?>
           <option value="<?php echo $row_RS_FinancialAccDebositor['DepositerName']; ?>" ><?php echo $row_RS_FinancialAccDebositor['DepositerName']; ?></option>
          <?php }  while ($row_RS_FinancialAccDebositor = mysql_fetch_assoc($RS_FinancialAccDebositor));?>
            </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_FinancialAccDebositor = mysql_fetch_assoc($RS_FinancialAccDebositor)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_FinancialAccDebositor);
?>
