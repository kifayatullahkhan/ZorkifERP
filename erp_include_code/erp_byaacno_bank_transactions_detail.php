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

//POST form
$AccNo = $_POST['AccountNumber'];
//POST form

mysql_select_db($database_Conn, $Conn);
$query_RS_financialAccDrCr = "SELECT erp_financial_account_bank_names.BankName, erp_financial_account_bank_names.AccountNumber, erp_financial_account_bank_transactions.Dated, erp_financial_account_bank_transactions.`Description`, erp_financial_account_bank_transactions.DebitAmount, erp_financial_account_bank_transactions.CreditAmount FROM erp_financial_account_bank_names JOIN erp_financial_account_bank_transactions ON erp_financial_account_bank_names.BankID = erp_financial_account_bank_transactions.BankID WHERE erp_financial_account_bank_names.AccountNumber = '$AccNo'";
$RS_financialAccDrCr = mysql_query($query_RS_financialAccDrCr, $Conn) or die(mysql_error());
$row_RS_financialAccDrCr = mysql_fetch_assoc($RS_financialAccDrCr);
$totalRows_RS_financialAccDrCr = mysql_num_rows($RS_financialAccDrCr);
?>
<div class="1">
<h2>By Account No Financial Account Bank Transactions Detail</h2>
  <form name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>AccountNumber</strong></td>
        <td><strong><?php echo $row_RS_financialAccDrCr['AccountNumber']; ?></strong></td>
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
        <th>BankName</th>
        <th>Date</th>
        <th>Description</th>
        <th>Debit</th>
        <th>Credit</th>
      </tr>
      <?php $Debit=0; $Credit=0; do { ?>
        <tr>
          <td><?php echo $row_RS_financialAccDrCr['BankName']; ?></td>
          <td><?php echo $row_RS_financialAccDrCr['Dated']; ?></td>
          <td><?php echo $row_RS_financialAccDrCr['Description']; ?></td>
          <td><?php echo $row_RS_financialAccDrCr['DebitAmount']; ?></td>
          <td><?php echo $row_RS_financialAccDrCr['CreditAmount']; ?></td>
        </tr>
        <?php $Debit=$Debit+$row_RS_financialAccDrCr['DebitAmount']; ?>
        <?php $Credit=$Credit+$row_RS_financialAccDrCr['CreditAmount'];?>
        <?php } while ($row_RS_financialAccDrCr = mysql_fetch_assoc($RS_financialAccDrCr)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>Balance</strong></td>
          <td><strong>Dr : <?php echo $Debit; ?></strong></td>
          <td><strong>Cr : <?php echo $Credit; ?></strong></td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_financialAccDrCr);
?>