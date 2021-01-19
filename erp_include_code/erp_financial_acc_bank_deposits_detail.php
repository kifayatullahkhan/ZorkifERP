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
$DepositorName=$_POST['DepositerName'];
//POST form

mysql_select_db($database_Conn, $Conn);
$query_RS_FinancialAccDebositor = "SELECT erp_financial_account_bank_names.BankName, financial_account_bank_deposits.DepositerName, financial_account_bank_deposits.ReciptNo, financial_account_bank_deposits.Dated, financial_account_bank_deposits.Amount FROM financial_account_bank_deposits JOIN  erp_financial_account_bank_names ON erp_financial_account_bank_names.BankID =financial_account_bank_deposits.BankID WHERE financial_account_bank_deposits.DepositerName = '$DepositorName' ";
$RS_FinancialAccDebositor = mysql_query($query_RS_FinancialAccDebositor, $Conn) or die(mysql_error());
$row_RS_FinancialAccDebositor = mysql_fetch_assoc($RS_FinancialAccDebositor);
$totalRows_RS_FinancialAccDebositor = mysql_num_rows($RS_FinancialAccDebositor);
?>
<div class="1">
<h2>Financial Account Bank Deposits Detail</h2>
  <form name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>DepositerName</strong></td>
        <td><strong><?php echo $row_RS_FinancialAccDebositor['DepositerName']; ?></strong></td>
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
        <th>ReciptNo</th>
        <th>Date</th>
        <th>Amount</th>
      </tr>
      <?php $TotalAmount=0; do { ?>
        <tr>
          <td><?php echo $row_RS_FinancialAccDebositor['BankName']; ?></td>
          <td><?php echo $row_RS_FinancialAccDebositor['ReciptNo']; ?></td>
          <td><?php echo $row_RS_FinancialAccDebositor['Dated']; ?></td>
          <td><?php echo $row_RS_FinancialAccDebositor['Amount']; ?></td>
        </tr>
        <?php $TotalAmount=$TotalAmount+$row_RS_FinancialAccDebositor['Amount'];?>
        <?php } while ($row_RS_FinancialAccDebositor = mysql_fetch_assoc($RS_FinancialAccDebositor)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>Total Depoisit Amount</strong></td>
          <td><strong><?php echo $TotalAmount; ?></strong></td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_FinancialAccDebositor);
?>
