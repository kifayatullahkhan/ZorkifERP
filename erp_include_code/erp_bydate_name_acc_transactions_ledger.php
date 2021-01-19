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
$query_RS_BankFAccLedger = "SELECT * FROM erp_financial_account_bank_names";
$RS_BankFAccLedger = mysql_query($query_RS_BankFAccLedger, $Conn) or die(mysql_error());
$row_RS_BankFAccLedger = mysql_fetch_assoc($RS_BankFAccLedger);
$totalRows_RS_BankFAccLedger = mysql_num_rows($RS_BankFAccLedger);
?>
<div class="1">
<h2>ByDate And Bank Name Finanacial Account Transaction Ledger</h2>
  <form name="form1" method="post" action="erp_bydate_name_acc_transactions_ledger_detail.php">
    <table border="1">
      <tr>
        <th>From</th>
        <th>To</th>
        <th>BankName</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td><label for="From"></label>
        <input type="text" name="From" id="From" onfocus="showCalendarControl(this);" value="<?php echo date("d-m-Y"); ?>"></td>
          <td><label for="To"></label>
        <input type="text" name="To" id="To" onfocus="showCalendarControl(this);" value="<?php echo date("d-m-Y"); ?>"></td>
          <td>
            <label for="BankName"></label>
            <input name="BankName" type="hidden" value="<?php echo $row_RS_BankFAccLedger['BankID']; ?>" size="50" readonly="readonly"/>
            <select name="BankName" id="BankName">
             <?php do {  ?>
           <option value="<?php echo $row_RS_BankFAccLedger['BankID']; ?>" ><?php echo $row_RS_BankFAccLedger['BankName']; ?></option>
          <?php }  while ($row_RS_BankFAccLedger = mysql_fetch_assoc($RS_BankFAccLedger)); ?>
            </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_BankFAccLedger = mysql_fetch_assoc($RS_BankFAccLedger)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_BankFAccLedger);
?>
