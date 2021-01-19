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
$ckdateget=$_POST['From'];
		$dt_frm=$ckdateget;
			$ckday=substr($ckdateget,0,2);
			$ckmonth=substr($ckdateget,3,2);	
			$ckyear=substr($ckdateget,6,4);
			 $from="$ckyear-$ckmonth-$ckday";
		
$ckdateget=$_POST['To'];
		$dt_to=$ckdateget;
			$ckday=substr($ckdateget,0,2);
			$ckmonth=substr($ckdateget,3,2);	
			$ckyear=substr($ckdateget,6,4);
			 $to="$ckyear-$ckmonth-$ckday";

// POST Form

mysql_select_db($database_Conn, $Conn);
$query_RS_FinancialAccWithdrawl = "SELECT erp_financial_account_bank_names.BankName, financial_account_bank_withdrawl.WithdrawalByName, financial_account_bank_withdrawl.Dated, financial_account_bank_withdrawl.ChecqueNo, financial_account_bank_withdrawl.`Description`, financial_account_bank_withdrawl.Amount FROM financial_account_bank_withdrawl JOIN erp_financial_account_bank_names ON erp_financial_account_bank_names.BankID = financial_account_bank_withdrawl.BankID WHERE financial_account_bank_withdrawl.Dated BETWEEN '$from' AND '$to'";
$RS_FinancialAccWithdrawl = mysql_query($query_RS_FinancialAccWithdrawl, $Conn) or die(mysql_error());
$row_RS_FinancialAccWithdrawl = mysql_fetch_assoc($RS_FinancialAccWithdrawl);
$totalRows_RS_FinancialAccWithdrawl = mysql_num_rows($RS_FinancialAccWithdrawl);
?>
<div class="1">
<h2> By Date Financial Account Bank Withdrawl Detail </h2>
  <form name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>From</strong></td>
        <td><strong><?php echo $ckdateget=$_POST['From']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>To</strong></td>
        <td><strong><?php echo $ckdateget=$_POST['To']; ?></strong></td>
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
        <th>WithdrawalByName</th>
        <th>Date</th>
        <th>ChecqueNo</th>
        <th>Description</th>
        <th>Amount</th>
      </tr>
      <?php $TotalAmount=0; do { ?>
        <tr>
          <td><?php echo $row_RS_FinancialAccWithdrawl['BankName']; ?></td>
          <td><?php echo $row_RS_FinancialAccWithdrawl['WithdrawalByName']; ?></td>
          <td><?php echo $row_RS_FinancialAccWithdrawl['Dated']; ?></td>
          <td><?php echo $row_RS_FinancialAccWithdrawl['ChecqueNo']; ?></td>
          <td><?php echo $row_RS_FinancialAccWithdrawl['Description']; ?></td>
          <td><?php echo $row_RS_FinancialAccWithdrawl['Amount']; ?></td>
        </tr>
        <?php $TotalAmount= $TotalAmount+$row_RS_FinancialAccWithdrawl['Amount'];?>
        <?php } while ($row_RS_FinancialAccWithdrawl = mysql_fetch_assoc($RS_FinancialAccWithdrawl)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>Total Withdrawl Amount </strong></td>
          <td><strong><?php echo $TotalAmount; ?></strong></td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_FinancialAccWithdrawl);
?>
