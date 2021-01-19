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
$query_RS_Purchase = "SELECT ((erp_purchaseordersproformainvoicedetails.Quantity* erp_purchaseordersproformainvoicedetails.Price_Per_Unit) + (erp_otherexpensesonsupplierinvoice.CustomDuty+ erp_otherexpensesonsupplierinvoice.PortDuty + erp_otherexpensesonsupplierinvoice.DeleryOrder + erp_otherexpensesonsupplierinvoice.Transportation + erp_otherexpensesonsupplierinvoice.ClearingAgentCharges + erp_otherexpensesonsupplierinvoice.LabourCharges + erp_otherexpensesonsupplierinvoice.LABTestingCharges + erp_otherexpensesonsupplierinvoice.Detention_Mina + erp_otherexpensesonsupplierinvoice.Detention_Container + erp_otherexpensesonsupplierinvoice.OtherCharges)) AS Debit     FROM erp_supplierscompanies  JOIN erp_purchaseordersproformainvoice  ON erp_supplierscompanies.SupplierID = erp_purchaseordersproformainvoice.SupplierID  JOIN erp_otherexpensesonsupplierinvoice  ON erp_purchaseordersproformainvoice.POPIID = erp_otherexpensesonsupplierinvoice.POPIID  JOIN erp_purchaseordersproformainvoicedetails  ON erp_purchaseordersproformainvoicedetails.POPIID = erp_purchaseordersproformainvoice.POPIID  JOIN erp_productionitems  ON erp_purchaseordersproformainvoicedetails.PItemID = erp_productionitems.PItemID  WHERE erp_purchaseordersproformainvoice.OrderDate BETWEEN '$from' AND '$to' AND erp_purchaseordersproformainvoice.OrderStatus = 'DONE' AND erp_supplierscompanies.SupplierID =  erp_otherexpensesonsupplierinvoice.SupplierID";
$RS_Purchase = mysql_query($query_RS_Purchase, $Conn) or die(mysql_error());
$row_RS_Purchase = mysql_fetch_assoc($RS_Purchase);
$totalRows_RS_Purchase = mysql_num_rows($RS_Purchase);

mysql_select_db($database_Conn, $Conn);
$query_RS_Sale = "SELECT ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) -((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100))AS Credit FROM erp_customerorderdetails JOIN erp_customerorders ON erp_customerorders.CustomerOrderID=erp_customerorderdetails.CustomerOrderID WHERE  erp_customerorders.OrderDate BETWEEN '$from' AND '$to'";
$RS_Sale = mysql_query($query_RS_Sale, $Conn) or die(mysql_error());
$row_RS_Sale = mysql_fetch_assoc($RS_Sale);
$totalRows_RS_Sale = mysql_num_rows($RS_Sale);

mysql_select_db($database_Conn, $Conn);
$query_RS_InvItems = "SELECT (erp_inventoryitems.InvItemSalesPrice* erp_inventoryitems.StockPositionQuantity) As InvStock FROM erp_inventoryitems";
$RS_InvItems = mysql_query($query_RS_InvItems, $Conn) or die(mysql_error());
$row_RS_InvItems = mysql_fetch_assoc($RS_InvItems);
$totalRows_RS_InvItems = mysql_num_rows($RS_InvItems);

mysql_select_db($database_Conn, $Conn);
$query_RS_Cash = "SELECT erp_financial_account_bank_transactions.DebitAmount FROM erp_financial_account_bank_transactions";
$RS_Cash = mysql_query($query_RS_Cash, $Conn) or die(mysql_error());
$row_RS_Cash = mysql_fetch_assoc($RS_Cash);
$totalRows_RS_Cash = mysql_num_rows($RS_Cash);

mysql_select_db($database_Conn, $Conn);
$query_RS_AccountRecevable = "SELECT  erp_customerpayments.AmountLeft FROM erp_customerpayments JOIN erp_customerorders ON erp_customerorders.OrderReferenceNo = erp_customerpayments.OrderReferenceNo JOIN erp_customers ON erp_customers.CustomerID = erp_customerpayments.CustomerID WHERE erp_customerpayments.PaymentStatus = 'PENDING' AND erp_customerpayments.PaymentDate BETWEEN '$from' AND '$to'";
$RS_AccountRecevable = mysql_query($query_RS_AccountRecevable, $Conn) or die(mysql_error());
$row_RS_AccountRecevable = mysql_fetch_assoc($RS_AccountRecevable);
$totalRows_RS_AccountRecevable = mysql_num_rows($RS_AccountRecevable);

mysql_select_db($database_Conn, $Conn);
$query_RS_PrePaidExpenses = "SELECT  erp_expense_payment_voucher_details.Amount FROM erp_expenses_payment_types JOIN erp_expense_payment_voucher_details ON erp_expenses_payment_types.ExpenseTypeID = erp_expense_payment_voucher_details.ExpenseTypeID JOIN erp_expense_payment_vouchers ON erp_expense_payment_voucher_details.VoucherID = erp_expense_payment_vouchers.VoucherID WHERE erp_expenses_payment_types.ExpenseTypeID  BETWEEN '4' AND '5' AND erp_expense_payment_vouchers.Dated BETWEEN '$from' AND '$to'";
$RS_PrePaidExpenses = mysql_query($query_RS_PrePaidExpenses, $Conn) or die(mysql_error());
$row_RS_PrePaidExpenses = mysql_fetch_assoc($RS_PrePaidExpenses);
$totalRows_RS_PrePaidExpenses = mysql_num_rows($RS_PrePaidExpenses);

mysql_select_db($database_Conn, $Conn);
$query_RS_Asset = "SELECT asset.AssetValue FROM asset";
$RS_Asset = mysql_query($query_RS_Asset, $Conn) or die(mysql_error());
$row_RS_Asset = mysql_fetch_assoc($RS_Asset);
$totalRows_RS_Asset = mysql_num_rows($RS_Asset);

mysql_select_db($database_Conn, $Conn);
$query_RS_Depreciation = "SELECT asset.Depreciation FROM asset";
$RS_Depreciation = mysql_query($query_RS_Depreciation, $Conn) or die(mysql_error());
$row_RS_Depreciation = mysql_fetch_assoc($RS_Depreciation);
$totalRows_RS_Depreciation = mysql_num_rows($RS_Depreciation);

mysql_select_db($database_Conn, $Conn);
$query_RS_AccountPayable = "SELECT erp_purchasepayments.PaymentLeft  FROM erp_purchasepayments  JOIN erp_purchaseordersproformainvoice ON erp_purchasepayments.OrderReferenceNo = erp_purchaseordersproformainvoice.OrderReferenceNo JOIN erp_supplierscompanies ON erp_supplierscompanies.SupplierID = erp_purchaseordersproformainvoice.SupplierID WHERE erp_purchasepayments.PaymentStatus = 'PENDING' AND erp_purchasepayments.PaymentDate BETWEEN '$from' AND '$to'";
$RS_AccountPayable = mysql_query($query_RS_AccountPayable, $Conn) or die(mysql_error());
$row_RS_AccountPayable = mysql_fetch_assoc($RS_AccountPayable);
$totalRows_RS_AccountPayable = mysql_num_rows($RS_AccountPayable);

mysql_select_db($database_Conn, $Conn);
$query_RS_IncomeTax = "SELECT erp_tax_payment_voucher_details.TaxAmount FROM erp_tax_payment_types JOIN erp_tax_payment_voucher_details ON erp_tax_payment_voucher_details.TaxTypeID = erp_tax_payment_types.TaxTypeID JOIN erp_tax_payment_vouchers ON erp_tax_payment_vouchers.VoucherID = erp_tax_payment_voucher_details.VoucherID WHERE erp_tax_payment_vouchers.Dated  BETWEEN '$from' AND '$to'";
$RS_IncomeTax = mysql_query($query_RS_IncomeTax, $Conn) or die(mysql_error());
$row_RS_IncomeTax = mysql_fetch_assoc($RS_IncomeTax);
$totalRows_RS_IncomeTax = mysql_num_rows($RS_IncomeTax);

mysql_select_db($database_Conn, $Conn);
$query_RS_CapitalAccount = "SELECT (erp_accounts_capital_account.Partner1Amount + erp_accounts_capital_account.Partner2Amount + erp_accounts_capital_account.Partner3Amount) AS Capital FROM erp_accounts_capital_account";
$RS_CapitalAccount = mysql_query($query_RS_CapitalAccount, $Conn) or die(mysql_error());
$row_RS_CapitalAccount = mysql_fetch_assoc($RS_CapitalAccount);
$totalRows_RS_CapitalAccount = mysql_num_rows($RS_CapitalAccount);

mysql_select_db($database_Conn, $Conn);
$query_RS_HotelIncome = "SELECT ( hotel_client_details.TotalAmountPaid *1) AS OtherIncome  FROM hotel_client_details JOIN  hotel_reservations_types  ON hotel_client_details.ReservationTypeID = hotel_reservations_types.ReservationTypeID JOIN hotel_rooms_or_sections ON hotel_client_details.RoomSectionID = hotel_rooms_or_sections.RoomSectionID WHERE hotel_client_details.StartDate BETWEEN '$from' AND '$to'";
$RS_HotelIncome = mysql_query($query_RS_HotelIncome, $Conn) or die(mysql_error());
$row_RS_HotelIncome = mysql_fetch_assoc($RS_HotelIncome);
$totalRows_RS_HotelIncome = mysql_num_rows($RS_HotelIncome);

$Year=substr($_POST['From'],6,4);
$EYear=substr($_POST['To'],6,4);

mysql_select_db($database_Conn, $Conn);
$query_RS_EmpYearlySalary = "SELECT erp_employee_salary.NetPaySalaryAmount  FROM erp_employee_salary  JOIN  erp_employee_details ON erp_employee_salary.EmployeeID = erp_employee_details.EmployeeID WHERE erp_employee_salary.PaymentStatus = 'DONE' AND erp_employee_salary.SalaryYear BETWEEN '$Year' AND '$EYear'";
$RS_EmpYearlySalary = mysql_query($query_RS_EmpYearlySalary, $Conn) or die(mysql_error());
$row_RS_EmpYearlySalary = mysql_fetch_assoc($RS_EmpYearlySalary);
$totalRows_RS_EmpYearlySalary = mysql_num_rows($RS_EmpYearlySalary);
?>
<!--Purchase -->
<div class="1">
  <form id="form1" name="form1" method="post" action="">
    <table border="1">
      <?php $Purchase=0; do { ?>
        <?php $Purchase=$Purchase+$row_RS_Purchase['Debit'];?>
        <?php } while ($row_RS_Purchase = mysql_fetch_assoc($RS_Purchase)); ?>
    </table>
  </form>
</div>
<!--Sale -->
<div class="1">
  <form id="form2" name="form2" method="post" action="">
    <table border="1">
      <?php $Sale=0; do { ?>
        <?php $Sale=$Sale+$row_RS_Sale['Credit'];?>
        <?php } while ($row_RS_Sale = mysql_fetch_assoc($RS_Sale)); ?>
    </table>
  </form>
</div>
<!--Inv Items -->
<div class="1">
  <form id="form3" name="form3" method="post" action="">
     <table border="1">
	  <?php $InvItem=0; do { ?>
        <?php $InvItem=$InvItem+$row_RS_InvItems['InvStock'];?>
        <?php } while ($row_RS_InvItems = mysql_fetch_assoc($RS_InvItems)); ?>
    </table>
  </form>
</div>
<!--Bank -->
<div class="1">
  <form id="form4" name="form4" method="post" action="">
    <table border="1">
      <?php $Cash=0; do { ?>
        <?php $Cash=$Cash+$row_RS_Cash['DebitAmount'];?>
        <?php } while ($row_RS_Cash = mysql_fetch_assoc($RS_Cash)); ?>
    </table>
  </form>
</div>
<!--Account Recievable -->
<div class="1">
  <form id="form5" name="form5" method="post" action="">
    <table border="1">
      <?php $AccRecievable=0; do { ?>
        <?php $AccRecievable=$AccRecievable+$row_RS_AccountRecevable['AmountLeft'];?>
        <?php } while ($row_RS_AccountRecevable = mysql_fetch_assoc($RS_AccountRecevable)); ?>
    </table>
  </form>
</div>
<!--Expenses -->
<div class="1">
  <form id="form6" name="form6" method="post" action="">
    <table border="1">
      <?php $PrePaidExpances=0; do { ?>
        <?php $PrePaidExpances=$PrePaidExpances+$row_RS_PrePaidExpenses['Amount'];?>
        <?php } while ($row_RS_PrePaidExpenses = mysql_fetch_assoc($RS_PrePaidExpenses)); ?>
    </table>
  </form>
</div>
<!--Asset -->
<div class="1">
  <form id="form7" name="form7" method="post" action="">
    <table border="1">
      <?php $Asset=0; do { ?>
        <?php $Asset=$Asset+$row_RS_Asset['AssetValue'];?>
        <?php } while ($row_RS_Asset = mysql_fetch_assoc($RS_Asset)); ?>
    </table>
  </form>
</div>
<!--Dereciation -->
<div class="1">
  <form id="form8" name="form8" method="post" action="">
    <table border="1">
      <?php $Deprec=0; do { ?>
        <?php $Deprec=$Deprec+$row_RS_Depreciation['Depreciation'];?>
        <?php } while ($row_RS_Depreciation = mysql_fetch_assoc($RS_Depreciation)); ?>
    </table>
  </form>
</div>
<!-- Account Payable -->
<div class="1">
  <form id="form9" name="form9" method="post" action="">
    <table border="1">
      <?php $AccPayable=0; do { ?>
        <?php $AccPayable=$AccPayable+$row_RS_AccountPayable['PaymentLeft'];?>
        <?php } while ($row_RS_AccountPayable = mysql_fetch_assoc($RS_AccountPayable)); ?>
    </table>
  </form>
</div>
<!--Income Tax -->
<div class="1">
  <form id="form10" name="form10" method="post" action="">
    <table border="1">
      <?php $Tax=0; do { ?>
        <?php $Tax=$Tax+$row_RS_IncomeTax['TaxAmount'];?>
        <?php } while ($row_RS_IncomeTax = mysql_fetch_assoc($RS_IncomeTax)); ?>
    </table>
  </form>
</div>
<!--Capital Detail -->
<div class="1">
  <form id="form11" name="form11" method="post" action="">
    <table border="1">
      <?php $Capital=0; do { ?>
        <?php $Capital=$Capital+$row_RS_CapitalAccount['Capital'];?>
        <?php } while ($row_RS_CapitalAccount = mysql_fetch_assoc($RS_CapitalAccount)); ?>
    </table>
  </form>
</div>
<!--Hotel Income -->
<div class="1">
  <form id="form12" name="form12" method="post" action="">
    <table border="1">
      <?php $OtherIncome=0; do { ?>
        <?php $OtherIncome=$OtherIncome+$row_RS_HotelIncome['OtherIncome'];?>
        <?php } while ($row_RS_HotelIncome = mysql_fetch_assoc($RS_HotelIncome)); ?>
    </table>
  </form>
</div>
<!--Emp yearly Salary -->
<div class="1">
  <form id="form15" name="form15" method="post" action="">
    <table border="1">
      <?php $Y_Salary=0; do { ?>
        <?php $Y_Salary=$Y_Salary+$row_RS_EmpYearlySalary['NetPaySalaryAmount'];?>
        <?php } while ($row_RS_EmpYearlySalary = mysql_fetch_assoc($RS_EmpYearlySalary)); ?>
    </table>
  </form>
</div>
<!-- Time Period-->
<div class="1">
<h1>Balance Sheet</h1>
  <form id="form13" name="form13" method="post" action="">
     <table width="200%" border="1">
      <tr>
        <td><strong>From</strong></td>
        <td><strong><?php echo $ckdateget=$_POST['From']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>To</strong></td>
        <td><strong><?php echo $ckdateget=$_POST['To']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>System Date</strong></td>
        <td><strong><?php echo date('d-m-Y'); ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<!--Balance Sheet -->
<div class="1">
  <form id="form14" name="form14" method="post" action="">
    <table width="200%" border="1">
      <tr>
        <td colspan="3"><h3>Assets</h3></td>
      </tr>
      <tr>
        <td><strong><i>Current Assets</i></strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Cash</td>
        <td>&nbsp;</td>
        <td><?php $Cash;
		echo number_format($Cash, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>Account Receviable</td>
        <td>&nbsp;</td>
        <td><?php $AccRecievable;
		echo number_format($AccRecievable, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>Inventory</td>
        <td>&nbsp;</td>
        <td><?php $OpeningStock = $InvItem + $Purchase - $Sale;
			     $ClosingStock = $OpeningStock + $Purchase - $Sale ;
			 echo number_format($ClosingStock, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>Prepaid Expenses</td>
        <td>&nbsp;</td>
        <td><?php $PrePaidExpances;
		echo number_format($PrePaidExpances, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><i>Total Current Asset</i></td>
        <td><?php $TotalCurrentAsset = $Cash + $AccRecievable + $ClosingStock + $PrePaidExpances;
		echo number_format($TotalCurrentAsset, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td><strong><i>Fixed (Long-Term) Assets</i></strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Property,Plant,and Equipment</td>
        <td>&nbsp;</td>
        <td><?php $Asset;
		echo number_format($Asset, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>Less : Accumulated Deprection</td>
        <td>&nbsp;</td>
        <td><?php $Deprec;
		echo number_format($Deprec, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><i>Total Fixed Assets</i></td>
        <td><?php  $TotalFixedAsset=$Asset-$Deprec;
		echo number_format($TotalFixedAsset, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td><strong>TotalAsset</strong></td>
        <td>&nbsp;</td>
        <td><?php $TotalAsset = $TotalCurrentAsset + $TotalFixedAsset;
		echo number_format($TotalAsset, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td colspan="3"><h3>Liabilities and Owner's Equity</h3></td>
      </tr>
      <tr>
        <td><strong><i>Current Liabilities</i></strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Account Payable</td>
        <td>&nbsp;</td>
        <td><?php $AccPayable;
		echo number_format($AccPayable, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>Income Tax Payable</td>
        <td>&nbsp;</td>
        <td><?php $Tax;
		echo number_format($Tax, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>Accrued Salaries and Wages</td>
        <td>&nbsp;</td>
        <td><?php $Y_Salary;
		echo number_format($Y_Salary, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><i>Total Long-Term Liabilities</i></td>
        <td><?php $TotalLongtermLibilities = $AccPayable + $Tax + $Y_Salary;
		echo number_format($TotalLongtermLibilities, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td><strong><i>Owner Equity</i></strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Owner Investment</td>
        <td>&nbsp;</td>
        <td><?php $Capital;
		echo number_format($Capital, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>Retained Earnings</td>
        <td>&nbsp;</td>
        <td><?php $OtherIncome;
		echo number_format($OtherIncome, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><i>Total owner's equity</i></td>
        <td><?php  $TotalOwnerEquity = $Capital + $OtherIncome;
		echo number_format($TotalOwnerEquity, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td><strong>Total Liabilities and Owner's Equity</strong></td>
        <td>&nbsp;</td>
        <td><strong><?php $TotalLibilitiesAndOwnerEquity = $TotalLongtermLibilities + $TotalOwnerEquity;
		echo number_format($TotalLibilitiesAndOwnerEquity, 2, '.', ',');?></strong></td>
      </tr>
      <tr>
        <td colspan="3"><h3>Common Financial Ratios</h3></td>
      </tr>
      <!--Debt Ratio (Total Liabilities / Total Assets) -->
      <tr>
        <td colspan="2"><strong>Debt Ratio</strong></td>
        <td><?php $DebtRatio= $TotalLongtermLibilities / $TotalAsset; 
		echo number_format($DebtRatio, 2, '.', ',');?></td>
      </tr>
      <!-- Current Ratio (Current Assets / Current Liabilities)-->
      <tr>
        <td colspan="2"><strong>Current Ratio</strong></td>
        <td><?php $CurrentRatio = $TotalCurrentAsset / $TotalLongtermLibilities;
		echo number_format($CurrentRatio, 2, '.', ',');?></td>
      </tr>
      <!-- Working Capital (Current Assets - Current Liabilities)-->
      <tr>
        <td colspan="2"><strong>Working Capital</strong></td>
        <td><?php $WorkingCapital =$TotalCurrentAsset - $TotalLongtermLibilities;
		echo number_format($WorkingCapital, 2, '.', ',');?></td>
      </tr>
      <!-- Assets-to-Equity Ratio (Total Assets / Owner's Equity)-->
      <tr>
        <td colspan="2"><strong>Assets-to-Equity Ratio</strong></td>
        <td><?php $AssetstoEquityRatio = $TotalCurrentAsset / $TotalOwnerEquity;
		echo number_format($AssetstoEquityRatio, 2, '.', ',');?></td>
      </tr> 
      <!-- Debt-to-Equity Ratio (Total Liabilities / Owner's Equity)-->
      <tr>
        <td colspan="2"><strong>Debt-to-Equity Ratio</strong></td>
        <td><?php $DebttoEquityRatio = $TotalLongtermLibilities / $TotalOwnerEquity;
		echo number_format($DebttoEquityRatio, 2, '.', ',');?></td>
      </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_Purchase);

mysql_free_result($RS_Sale);

mysql_free_result($RS_InvItems);

mysql_free_result($RS_Cash);

mysql_free_result($RS_AccountRecevable);

mysql_free_result($RS_PrePaidExpenses);

mysql_free_result($RS_Asset);

mysql_free_result($RS_Depreciation);

mysql_free_result($RS_AccountPayable);

mysql_free_result($RS_IncomeTax);

mysql_free_result($RS_CapitalAccount);

mysql_free_result($RS_HotelIncome);

mysql_free_result($RS_EmpYearlySalary);
?>
