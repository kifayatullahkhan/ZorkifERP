<?php // require_once('../../Connections/Conn.php'); ?>
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

// Capital Account
mysql_select_db($database_Conn, $Conn);
$query_RS_CapitalDetail = "SELECT * FROM erp_accounts_capital_account";
$RS_CapitalDetail = mysql_query($query_RS_CapitalDetail, $Conn) or die(mysql_error());
$row_RS_CapitalDetail = mysql_fetch_assoc($RS_CapitalDetail);
$totalRows_RS_CapitalDetail = mysql_num_rows($RS_CapitalDetail);

//Supplier Detail
mysql_select_db($database_Conn, $Conn);
$query_RS_SupplierDebit = "SELECT ((erp_purchaseordersproformainvoicedetails.Quantity* erp_purchaseordersproformainvoicedetails.Price_Per_Unit) + (erp_otherexpensesonsupplierinvoice.CustomDuty+ erp_otherexpensesonsupplierinvoice.PortDuty + erp_otherexpensesonsupplierinvoice.DeleryOrder + erp_otherexpensesonsupplierinvoice.Transportation + erp_otherexpensesonsupplierinvoice.ClearingAgentCharges + erp_otherexpensesonsupplierinvoice.LabourCharges + erp_otherexpensesonsupplierinvoice.LABTestingCharges + erp_otherexpensesonsupplierinvoice.Detention_Mina + erp_otherexpensesonsupplierinvoice.Detention_Container + erp_otherexpensesonsupplierinvoice.OtherCharges)) AS Debit     FROM erp_supplierscompanies  JOIN erp_purchaseordersproformainvoice  ON erp_supplierscompanies.SupplierID = erp_purchaseordersproformainvoice.SupplierID  JOIN erp_otherexpensesonsupplierinvoice  ON erp_purchaseordersproformainvoice.POPIID = erp_otherexpensesonsupplierinvoice.POPIID  JOIN erp_purchaseordersproformainvoicedetails  ON erp_purchaseordersproformainvoicedetails.POPIID = erp_purchaseordersproformainvoice.POPIID  JOIN erp_productionitems  ON erp_purchaseordersproformainvoicedetails.PItemID = erp_productionitems.PItemID  WHERE erp_purchaseordersproformainvoice.OrderDate BETWEEN '$from' AND '$to' AND erp_purchaseordersproformainvoice.OrderStatus = 'DONE' AND erp_supplierscompanies.SupplierID =  erp_otherexpensesonsupplierinvoice.SupplierID ";
$RS_SupplierDebit = mysql_query($query_RS_SupplierDebit, $Conn) or die(mysql_error());
$row_RS_SupplierDebit = mysql_fetch_assoc($RS_SupplierDebit);
$totalRows_RS_SupplierDebit = mysql_num_rows($RS_SupplierDebit);

//Customer Detail
mysql_select_db($database_Conn, $Conn);
$query_RS_CustomerQuery = "SELECT ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) -((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100))AS Credit FROM erp_customerorderdetails JOIN erp_customerorders ON erp_customerorders.CustomerOrderID=erp_customerorderdetails.CustomerOrderID WHERE  erp_customerorders.OrderDate BETWEEN '$from' AND '$to'";
$RS_CustomerQuery = mysql_query($query_RS_CustomerQuery, $Conn) or die(mysql_error());
$row_RS_CustomerQuery = mysql_fetch_assoc($RS_CustomerQuery);
$totalRows_RS_CustomerQuery = mysql_num_rows($RS_CustomerQuery);

//Financial Acc Bank Detail
mysql_select_db($database_Conn, $Conn);
$query_RS_financialAccDrCr = "SELECT erp_financial_account_bank_names.BankName, erp_financial_account_bank_names.AccountNumber, erp_financial_account_bank_transactions.Dated, erp_financial_account_bank_transactions.`Description`, erp_financial_account_bank_transactions.DebitAmount, erp_financial_account_bank_transactions.CreditAmount FROM erp_financial_account_bank_names JOIN erp_financial_account_bank_transactions ON erp_financial_account_bank_names.BankID = erp_financial_account_bank_transactions.BankID WHERE erp_financial_account_bank_transactions.Dated BETWEEN '$from' AND '$to'";
$RS_financialAccDrCr = mysql_query($query_RS_financialAccDrCr, $Conn) or die(mysql_error());
$row_RS_financialAccDrCr = mysql_fetch_assoc($RS_financialAccDrCr);
$totalRows_RS_financialAccDrCr = mysql_num_rows($RS_financialAccDrCr);

// Expense Payment Detail
mysql_select_db($database_Conn, $Conn);
$query_RS_ExpensePayment = "SELECT erp_expense_payment_vouchers.VoucherReferenceNo, erp_expenses_payment_types.ExpenseType, erp_expense_payment_vouchers.Dated , erp_expense_payment_voucher_details.`Description`, erp_expense_payment_voucher_details.Amount FROM erp_expenses_payment_types JOIN erp_expense_payment_voucher_details ON erp_expenses_payment_types.ExpenseTypeID = erp_expense_payment_voucher_details.ExpenseTypeID JOIN erp_expense_payment_vouchers ON erp_expense_payment_voucher_details.VoucherID = erp_expense_payment_vouchers.VoucherID WHERE erp_expense_payment_vouchers.Dated BETWEEN '$from' AND '$to' AND erp_expenses_payment_types.ExpenseTypeID BETWEEN  '1' AND '3'";
$RS_ExpensePayment = mysql_query($query_RS_ExpensePayment, $Conn) or die(mysql_error());
$row_RS_ExpensePayment = mysql_fetch_assoc($RS_ExpensePayment);
$totalRows_RS_ExpensePayment = mysql_num_rows($RS_ExpensePayment);

// Emp Yearly Salary Detail
$Year=substr($_POST['From'],6,4);
$EYear=substr($_POST['To'],6,4);

mysql_select_db($database_Conn, $Conn);
$query_RS_EmpSalary = "SELECT erp_employee_details.EmployeeName, erp_employee_salary.SalaryMonth, erp_employee_salary.SalaryYear, erp_employee_details.EmploymentDate, erp_employee_salary.PaymentStatus, erp_employee_details.Commession , erp_employee_salary.BasicSalaryAmount, erp_employee_salary.BonusSalaryAmount, erp_employee_salary.OverTimeSalaryAmount,  erp_employee_salary.DeductionFromSalaryAmount, erp_employee_salary.TaxRate, erp_employee_salary.NetPaySalaryAmount  FROM erp_employee_salary  JOIN  erp_employee_details ON erp_employee_salary.EmployeeID = erp_employee_details.EmployeeID WHERE erp_employee_salary.PaymentStatus = 'DONE' AND erp_employee_salary.SalaryYear BETWEEN '$Year' AND '$EYear'";
$RS_EmpSalary = mysql_query($query_RS_EmpSalary, $Conn) or die(mysql_error());
$row_RS_EmpSalary = mysql_fetch_assoc($RS_EmpSalary);
$totalRows_RS_EmpSalary = mysql_num_rows($RS_EmpSalary);

//Emp Monthly Salary Detail
mysql_select_db($database_Conn, $Conn);
$query_RS_EmpSalaryMonthly = "SELECT erp_employee_details.EmployeeName, erp_employee_salary.SalaryMonth, erp_employee_salary.SalaryYear, erp_employee_details.EmploymentDate, erp_employee_salary.PaymentStatus, erp_employee_details.Commession , erp_employee_salary.BasicSalaryAmount, erp_employee_salary.BonusSalaryAmount, erp_employee_salary.OverTimeSalaryAmount,  erp_employee_salary.DeductionFromSalaryAmount, erp_employee_salary.TaxRate, erp_employee_salary.NetPaySalaryAmount  FROM erp_employee_salary  JOIN  erp_employee_details ON erp_employee_salary.EmployeeID = erp_employee_details.EmployeeID WHERE erp_employee_salary.PaymentStatus = 'DONE' AND erp_employee_salary.SalaryMonth BETWEEN '$from' AND '$to'";
$RS_EmpSalaryMonthly = mysql_query($query_RS_EmpSalaryMonthly, $Conn) or die(mysql_error());
$row_RS_EmpSalaryMonthly = mysql_fetch_assoc($RS_EmpSalaryMonthly);
$totalRows_RS_EmpSalaryMonthly = mysql_num_rows($RS_EmpSalaryMonthly);

//Hotel Income
mysql_select_db($database_Conn, $Conn);
$query_RS_HotelIncome = "SELECT hotel_client_details.TotalAmountPaid   FROM hotel_client_details JOIN  hotel_reservations_types  ON hotel_client_details.ReservationTypeID = hotel_reservations_types.ReservationTypeID JOIN hotel_rooms_or_sections ON hotel_client_details.RoomSectionID = hotel_rooms_or_sections.RoomSectionID WHERE hotel_client_details.StartDate BETWEEN '$from' AND '$to'";
$RS_HotelIncome = mysql_query($query_RS_HotelIncome, $Conn) or die(mysql_error());
$row_RS_HotelIncome = mysql_fetch_assoc($RS_HotelIncome);
$totalRows_RS_HotelIncome = mysql_num_rows($RS_HotelIncome);

//Account Recieveable
mysql_select_db($database_Conn, $Conn);
$query_RS_AccountRecevable = "SELECT  erp_customerpayments.AmountLeft FROM erp_customerpayments JOIN erp_customerorders ON erp_customerorders.OrderReferenceNo = erp_customerpayments.OrderReferenceNo JOIN erp_customers ON erp_customers.CustomerID = erp_customerpayments.CustomerID WHERE erp_customerpayments.PaymentStatus = 'PENDING' AND erp_customerpayments.PaymentDate BETWEEN '$from' AND '$to'";
$RS_AccountRecevable = mysql_query($query_RS_AccountRecevable, $Conn) or die(mysql_error());
$row_RS_AccountRecevable = mysql_fetch_assoc($RS_AccountRecevable);
$totalRows_RS_AccountRecevable = mysql_num_rows($RS_AccountRecevable);

//Account Payable
mysql_select_db($database_Conn, $Conn);
$query_RS_AccountPayable = "SELECT erp_purchasepayments.PaymentLeft  FROM erp_purchasepayments  JOIN erp_purchaseordersproformainvoice ON erp_purchasepayments.OrderReferenceNo = erp_purchaseordersproformainvoice.OrderReferenceNo JOIN erp_supplierscompanies ON erp_supplierscompanies.SupplierID = erp_purchaseordersproformainvoice.SupplierID WHERE erp_purchasepayments.PaymentStatus = 'PENDING' AND erp_purchasepayments.PaymentDate BETWEEN '$from' AND '$to'";
$RS_AccountPayable = mysql_query($query_RS_AccountPayable, $Conn) or die(mysql_error());
$row_RS_AccountPayable = mysql_fetch_assoc($RS_AccountPayable);
$totalRows_RS_AccountPayable = mysql_num_rows($RS_AccountPayable);

//Prepaid Insurance
mysql_select_db($database_Conn, $Conn);
$query_RS_PrePaidInsurance = "SELECT  erp_expense_payment_voucher_details.Amount FROM erp_expenses_payment_types JOIN erp_expense_payment_voucher_details ON erp_expenses_payment_types.ExpenseTypeID = erp_expense_payment_voucher_details.ExpenseTypeID JOIN erp_expense_payment_vouchers ON erp_expense_payment_voucher_details.VoucherID = erp_expense_payment_vouchers.VoucherID WHERE erp_expenses_payment_types.ExpenseTypeID  BETWEEN '4' AND '5' AND erp_expense_payment_vouchers.Dated BETWEEN '$from' AND '$to'";
$RS_PrePaidInsurance = mysql_query($query_RS_PrePaidInsurance, $Conn) or die(mysql_error());
$row_RS_PrePaidInsurance = mysql_fetch_assoc($RS_PrePaidInsurance);
$totalRows_RS_PrePaidInsurance = mysql_num_rows($RS_PrePaidInsurance);

// Asset Land
mysql_select_db($database_Conn, $Conn);
$query_RS_Land = "SELECT asset.AssetValue FROM asset WHERE asset.AssetName = 'LAND'";
$RS_Land = mysql_query($query_RS_Land, $Conn) or die(mysql_error());
$row_RS_Land = mysql_fetch_assoc($RS_Land);
$totalRows_RS_Land = mysql_num_rows($RS_Land);

//Asset Building
mysql_select_db($database_Conn, $Conn);
$query_RS_Building = "SELECT asset.AssetValue FROM asset WHERE asset.AssetName = 'Building'";
$RS_Building = mysql_query($query_RS_Building, $Conn) or die(mysql_error());
$row_RS_Building = mysql_fetch_assoc($RS_Building);
$totalRows_RS_Building = mysql_num_rows($RS_Building);

//Asset Equipment
mysql_select_db($database_Conn, $Conn);
$query_RS_Equipments = "SELECT asset.AssetValue FROM asset WHERE asset.AssetName = 'Equipments'";
$RS_Equipments = mysql_query($query_RS_Equipments, $Conn) or die(mysql_error());
$row_RS_Equipments = mysql_fetch_assoc($RS_Equipments);
$totalRows_RS_Equipments = mysql_num_rows($RS_Equipments);

//Asset Furniture
mysql_select_db($database_Conn, $Conn);
$query_RS_Furniture = "SELECT asset.AssetValue FROM asset WHERE asset.AssetName = 'Furniture'";
$RS_Furniture = mysql_query($query_RS_Furniture, $Conn) or die(mysql_error());
$row_RS_Furniture = mysql_fetch_assoc($RS_Furniture);
$totalRows_RS_Furniture = mysql_num_rows($RS_Furniture);

//Asset Car
mysql_select_db($database_Conn, $Conn);
$query_RS_Car = "SELECT asset.AssetValue FROM asset WHERE asset.AssetName = 'Car'";
$RS_Car = mysql_query($query_RS_Car, $Conn) or die(mysql_error());
$row_RS_Car = mysql_fetch_assoc($RS_Car);
$totalRows_RS_Car = mysql_num_rows($RS_Car);

// Accumaulated Depreciation Building
mysql_select_db($database_Conn, $Conn);
$query_RS_ADBuilding = "SELECT asset.Depreciation FROM asset WHERE asset.AssetName = 'Building'";
$RS_ADBuilding = mysql_query($query_RS_ADBuilding, $Conn) or die(mysql_error());
$row_RS_ADBuilding = mysql_fetch_assoc($RS_ADBuilding);
$totalRows_RS_ADBuilding = mysql_num_rows($RS_ADBuilding);

// Accumaulated Depreciation Furniture
mysql_select_db($database_Conn, $Conn);
$query_RS_ADFurniture = "SELECT asset.Depreciation FROM asset WHERE asset.AssetName = 'Furniture'";
$RS_ADFurniture = mysql_query($query_RS_ADFurniture, $Conn) or die(mysql_error());
$row_RS_ADFurniture = mysql_fetch_assoc($RS_ADFurniture);
$totalRows_RS_ADFurniture = mysql_num_rows($RS_ADFurniture);

// Accumaulated Depreciation Car
mysql_select_db($database_Conn, $Conn);
$query_RS_ADCar = "SELECT asset.Depreciation FROM asset WHERE asset.AssetName = 'Car'";
$RS_ADCar = mysql_query($query_RS_ADCar, $Conn) or die(mysql_error());
$row_RS_ADCar = mysql_fetch_assoc($RS_ADCar);
$totalRows_RS_ADCar = mysql_num_rows($RS_ADCar);

// Accumaulated Depreciation Equipments
mysql_select_db($database_Conn, $Conn);
$query_RS_ADEquipments = "SELECT asset.Depreciation FROM asset WHERE asset.AssetName = 'Equipments'";
$RS_ADEquipments = mysql_query($query_RS_ADEquipments, $Conn) or die(mysql_error());
$row_RS_ADEquipments = mysql_fetch_assoc($RS_ADEquipments);
$totalRows_RS_ADEquipments = mysql_num_rows($RS_ADEquipments);

//Asset Other Asset
mysql_select_db($database_Conn, $Conn);
$query_RS_OtherAsset = "SELECT asset.AssetValue FROM asset WHERE asset.AssetID = '4'";
$RS_OtherAsset = mysql_query($query_RS_OtherAsset, $Conn) or die(mysql_error());
$row_RS_OtherAsset = mysql_fetch_assoc($RS_OtherAsset);
$totalRows_RS_OtherAsset = mysql_num_rows($RS_OtherAsset);

// Accumaulated Depreciation Equipments
mysql_select_db($database_Conn, $Conn);
$query_RS_ADOtherAsset = "SELECT asset.Depreciation FROM asset WHERE asset.AssetID = '4'";
$RS_ADOtherAsset = mysql_query($query_RS_ADOtherAsset, $Conn) or die(mysql_error());
$row_RS_ADOtherAsset = mysql_fetch_assoc($RS_ADOtherAsset);
$totalRows_RS_ADOtherAsset = mysql_num_rows($RS_ADOtherAsset);
?>
<!-- Capital Account-->
<div class="1">
  <form id="form1" name="form1" method="post" action="">
    <table border="1">
      <?php $C_Amount=0; do { ?>
        <?php $C_Amount=$C_Amount+$row_RS_CapitalDetail['CapitalAmount'];?>
        <?php } while ($row_RS_CapitalDetail = mysql_fetch_assoc($RS_CapitalDetail)); ?>
    </table>
  </form>
</div>
<!--Purchase-->
<div class="1">
  <form id="form2" name="form2" method="post" action="">
    <table border="1">
      <?php $S_Total=0;  do { ?>
        <?php $S_Total=$S_Total+$row_RS_SupplierDebit['Debit'];?>
        <?php } while ($row_RS_SupplierDebit = mysql_fetch_assoc($RS_SupplierDebit)); ?>
    </table>
  </form>
</div>
<!--Sale-->
<div class="1">
  <form id="form3" name="form3" method="post" action="">
    <table border="1">
      <?php $C_Total=0; do { ?>
      <?php $C_Total=$C_Total+$row_RS_CustomerQuery['Credit']; ?>
        <?php } while ($row_RS_CustomerQuery = mysql_fetch_assoc($RS_CustomerQuery)); ?>
    </table>
  </form>
</div>
<!--Financial Account Bank Balance-->
<div class="1">
  <form id="form4" name="form4" method="post" action="">
    <table border="1">
      <?php $B_Debit=0; $B_Credit=0;  do { ?>
        <?php $B_Debit=$B_Debit+$row_RS_financialAccDrCr['DebitAmount']; ?>
        <?php $B_Credit=$B_Credit+$row_RS_financialAccDrCr['CreditAmount'];?>
        <?php } while ($row_RS_financialAccDrCr = mysql_fetch_assoc($RS_financialAccDrCr)); ?>
    </table>
  </form>
</div>
<!--Expenses Balance-->
<div class="1">
  <form id="form5" name="form5" method="post" action="">
    <table border="1">
      <?php $E_Credit=0; do { ?>
        <?php $E_Credit=$E_Credit+$row_RS_ExpensePayment['Amount'];?>
        <?php } while ($row_RS_ExpensePayment = mysql_fetch_assoc($RS_ExpensePayment)); ?>
    </table>
  </form>
</div>
<!-- For Yearly Emp Salary Balance-->
<div class="1">
  <form id="form6" name="form6" method="post" action="">
    <table border="1">
      <?php $Y_S_Credit=0; do { ?>
        <?php $Y_S_Credit=$Y_S_Credit+$row_RS_EmpSalary['NetPaySalaryAmount']; ?>
        <?php } while ($row_RS_EmpSalary = mysql_fetch_assoc($RS_EmpSalary)); ?>
    </table>
  </form>
</div>
<!-- For Month Emp Salary Balance-->
<div class="1">
  <form id="form7" name="form7" method="post" action="">
    <table border="1">
      <?php $M_S_Credit=0; do { ?>
        <?php $M_S_Credit=$M_S_Credit=$row_RS_EmpSalaryMonthly['NetPaySalaryAmount'];?>
        <?php } while ($row_RS_EmpSalaryMonthly = mysql_fetch_assoc($RS_EmpSalaryMonthly)); ?>
    </table>
  </form>
</div>
<!-- Hotel income-->
<div class="1">
  <form id="form8" name="form8" method="post" action="">
    <table border="1">
      <?php $H_Debit=0; do { ?>
        <?php $H_Debit=$H_Debit+$row_RS_HotelIncome['TotalAmountPaid'];?>
        <?php } while ($row_RS_HotelIncome = mysql_fetch_assoc($RS_HotelIncome)); ?>
    </table>
  </form>
</div>
<!-- Account Receveable-->
<div class="1">
  <form id="form10" name="form10" method="post" action="">
    <table border="1">
      <?php $AccReceveable=0; do { ?>
        <?php $AccReceveable=$AccReceveable = $row_RS_AccountRecevable['AmountLeft'];?>
        <?php } while ($row_RS_AccountRecevable = mysql_fetch_assoc($RS_AccountRecevable)); ?>
    </table>
  </form>
</div>
<!-- Account payable-->
<div class="1">
  <form id="form11" name="form11" method="post" action="">
    <table border="1">
      <?php $AccPayable=0; do { ?>
        <?php $AccPayable = $AccPayable +$row_RS_AccountPayable['PaymentLeft'];?>
        <?php } while ($row_RS_AccountPayable = mysql_fetch_assoc($RS_AccountPayable)); ?>
    </table>
  </form>
</div>
<!-- PrePaid Insurance-->
<div class="1">
  <form id="form12" name="form12" method="post" action="">
    <table border="1">
      <?php $Insurance=0; do { ?>
        <?php $Insurance=$Insurance+$row_RS_PrePaidInsurance['Amount'];?>
        <?php } while ($row_RS_PrePaidInsurance = mysql_fetch_assoc($RS_PrePaidInsurance)); ?>
    </table>
  </form>
</div>
<!-- Asset Land-->
<div class="1">
  <form id="form13" name="form13" method="post" action="">
    <table border="1">
      <?php $ALand=0; do { ?>
        <?php $ALand=$ALand+$row_RS_Land['AssetValue'];?>
        <?php } while ($row_RS_Land = mysql_fetch_assoc($RS_Land)); ?>
    </table>
  </form>
</div>
<!-- Asset buliding-->
<div class="1">
  <form id="form14" name="form14" method="post" action="">
    <table border="1">
      <?php $ABuilding=0; do { ?>
        <?php $ABuilding=$ABuilding+$row_RS_Building['AssetValue'];?>
        <?php } while ($row_RS_Building = mysql_fetch_assoc($RS_Building)); ?>
    </table>
  </form>
</div>
<!-- Asset Equipments-->
<div class="1">
  <form id="form15" name="form15" method="post" action="">
    <table border="1">
      <?php $AEquipments=0; do { ?>
        <?php $AEquipments=$AEquipments+$row_RS_Equipments['AssetValue'];?>
        <?php } while ($row_RS_Equipments = mysql_fetch_assoc($RS_Equipments)); ?>
    </table>
  </form>
</div>
<!-- Asset Furniture-->
<div class="1">
  <form id="form16" name="form16" method="post" action="">
    <table border="1">
      <?php $AFurniture=0; do { ?>
        <?php $AFurniture=$AFurniture+$row_RS_Furniture['AssetValue'];?>
        <?php } while ($row_RS_Furniture = mysql_fetch_assoc($RS_Furniture)); ?>
    </table>
  </form>
</div>
<!-- Asset Car-->
<div class="1">
  <form id="form17" name="form17" method="post" action="">
    <table border="1">>
      <?php $ACar=0; do { ?>
        <?php $ACar=$ACar+$row_RS_Car['AssetValue'];?>
        <?php } while ($row_RS_Car = mysql_fetch_assoc($RS_Car)); ?>
    </table>
  </form>
</div>
<!-- Accumulated Dereciatiion of Building-->
<div class="1">
  <form id="form18" name="form18" method="post" action="">
    <table border="1">
      <?php $DBuilding=0; do { ?>
        <?php $DBuilding=$DBuilding+$row_RS_ADBuilding['Depreciation'];?>
        <?php } while ($row_RS_ADBuilding = mysql_fetch_assoc($RS_ADBuilding)); ?>
    </table>
  </form>
</div>
<!-- Accumulated Dereciatiion of Furniture-->
<div class="1">
  <form id="form19" name="form19" method="post" action="">
    <table border="1">
      <?php $DFurniture=0; do { ?>
        <?php $DFurniture=$DFurniture+$row_RS_ADFurniture['Depreciation'];?>
        <?php } while ($row_RS_ADFurniture = mysql_fetch_assoc($RS_ADFurniture)); ?>
    </table>
  </form>
</div>
<!-- Accumulated Dereciatiion of Car-->
<div class="1">
  <form id="form20" name="form20" method="post" action="">
    <table border="1">
      <?php $DCar=0; do { ?>
        <?php $DCar=$DCar+$row_RS_ADCar['Depreciation'];?>
        <?php } while ($row_RS_ADCar = mysql_fetch_assoc($RS_ADCar)); ?>
    </table>
  </form>
</div>
<!-- Accumulated Dereciatiion of Equipments-->
<div class="1">
  <form id="form21" name="form21" method="post" action="">
    <table border="1">
      <?php $DEquipments=0; do { ?>
        <?php $DEquipments=$DEquipments + $row_RS_ADEquipments['Depreciation'];?>
        <?php } while ($row_RS_ADEquipments = mysql_fetch_assoc($RS_ADEquipments)); ?>
    </table>
  </form>
</div>
<!-- Other Asset-->
<div class="1">
  <form id="form22" name="form22" method="post" action="">
    <table border="1">
      <?php $OtherAsset=0; do { ?>
        <?php $OtherAsset=$OtherAsset+$row_RS_OtherAsset['AssetValue'];?>
        <?php } while ($row_RS_OtherAsset = mysql_fetch_assoc($RS_OtherAsset)); ?>
    </table>
  </form>
</div>
<!-- Accumulated Dereciatiion of other Asset-->
<div class="1">
  <form id="form23" name="form23" method="post" action="">
    <table border="1">
      <?php $DOtherAsset=0; do { ?>
        <?php $DOtherAsset=$DOtherAsset+$row_RS_ADOtherAsset['Depreciation'];?>
        <?php } while ($row_RS_ADOtherAsset = mysql_fetch_assoc($RS_ADOtherAsset)); ?>
    </table>
  </form>
</div>
<!--Time Period For Trail Balance-->
<div class="1">
<h2>Trial Balance Sheet </h2>
  <form id="form9" name="form9" method="post" action="">
      <table width="200" border="1">
      <tr>
        <td><strong>From</strong></td>
        <td><strong><?php echo $ckdateget=$_POST['From']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>To</strong></td>
        <td><strong><?php echo $ckdateget=$_POST['To']; ?></strong></strong></td>
      </tr>
      <tr>
        <td><strong>SystemDate</strong></td>
        <td><strong><?php echo date('d-m-Y'); ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<!--Trail Balance Sheet-->
<div class="1">
  <form id="form9" name="form9" method="post" action="">
      <table width="200" border="1">
      <tr>
        <th>Ledger Account</th>
        <th>DR. Balance(RS.)</th>
        <th>CR. Balance (RS.)</th>
      </tr>
      <tr>
        <td>Capital</td>
        <td><?php $C_Amount; 
		echo number_format($C_Amount, 2, '.', ',');?></td>
        <td><?php $C_Amount;
		echo number_format($C_Amount, 2, '.', ','); ?></td>
      </tr>
      <tr>
        <td>Bank</td>
        <td><?php $B_Debit; 
		echo number_format($B_Debit, 2, '.', ',');?></td>
        <td><?php $B_Credit;
		echo number_format($B_Credit, 2, '.', ','); ?></td>
      </tr>
      <tr>
        <td>Purchase</td>
        <td><?php $S_Total; 
		echo number_format($S_Total, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
        <tr>
        <td>AccountRecieveable</td>
        <td><?php $AccReceveable; 
		echo number_format($AccReceveable, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Land</td>
        <td><?php $ALand; 
		echo number_format($ALand, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Building</td>
        <td><?php $ABuilding; 
		echo number_format($ABuilding, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Furniture</td>
        <td><?php $AFurniture; 
		echo number_format($AFurniture, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
     <tr>
        <td>Equipments</td>
        <td><?php $AEquipments; 
		echo number_format($AEquipments, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>COE Car</td>
        <td><?php $ACar; 
		echo number_format($ACar, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Other Asset</td>
        <td><?php $OtherAsset; 
		echo number_format($OtherAsset, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Hotel Income</td>
        <td><?php $H_Debit; 
		echo number_format($H_Debit, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
       <tr>
        <td>AccountPayable</td>
        <td>&nbsp;</td>
        <td><?php $AccPayable; 
		echo number_format($AccPayable, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>Sales</td>
        <td>&nbsp;</td>
        <td><?php $C_Total; 
		echo number_format($C_Total, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>A/D Building</td>
        <td>&nbsp;</td>
        <td><?php $DBuilding; 
		echo number_format($DBuilding, 2, '.', ',');?></td>
      </tr> 
      <tr>
        <td>A/D Furnitue</td>
        <td>&nbsp;</td>
        <td><?php $DFurniture; 
		echo number_format($DFurniture, 2, '.', ',');?></td>
      </tr> 
      <tr>
        <td>A/D Equipments</td>
        <td>&nbsp;</td>
        <td><?php $DEquipments; 
		echo number_format($DEquipments, 2, '.', ',');?></td>
      </tr> 
      <tr>
        <td>A/D COE Car</td>
        <td>&nbsp;</td>
        <td><?php $DCar; 
		echo number_format($DCar, 2, '.', ',');?></td>
      </tr> 
      <tr>
        <td>A/D Other Asset</td>
        <td>&nbsp;</td>
        <td><?php $DOtherAsset; 
		echo number_format($DOtherAsset, 2, '.', ',');?></td>
      </tr> 
      <tr>
        <td>PrePaid Insurance</td>
        <td>&nbsp;</td>
        <td><?php $Insurance; 
		echo number_format($Insurance, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>Expenses</td>
        <td>&nbsp;</td>
        <td><?php $E_Credit; 
		echo number_format($E_Credit, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td>Yearly Salary</td>
        <td>&nbsp;</td>
        <td><?php  $Y_S_Credit; 
		echo number_format($Y_S_Credit, 2, '.', ',');?></td>
      </tr>
     <!-- <tr>
        <td>Monthly Salary</td>
        <td>&nbsp;</td>
        <td><?php $M_S_Credit; 
		echo number_format($M_S_Credit, 2, '.', ',');?></td>
      </tr> -->
      <tr>
      <!-- Total of Dr Cr -->
      <?php $DRBalance = $AccReceveable +  $ALand +  $ABuilding +  $AFurniture +  $AEquipments +  $ACar +  $OtherAsset +  $C_Amount +  $S_Total + $B_Debit +  $H_Debit;?>
      <?php $CRBalance = $AccPayable + $DBuilding + $DFurniture + $DEquipments + $DCar + $DOtherAsset + $Insurance + $C_Amount + $C_Total + $B_Credit + $E_Credit +  $Y_S_Credit +  $M_S_Credit;?>
      <!--Adjusted Amount -->
        
        <?php if ($DRBalance>$CRBalance)
		{
	$Adjusted = $DRBalance - $CRBalance;
			echo "<tr><td>Adjusted Amount</td><td>&nbsp;</td><td>". $Adjusted."</td></tr>"; 
			} ?>
	<?php if ($CRBalance>$DRBalance)
		{
		    $Adjusted = $CRBalance - $DRBalance ;
			echo "<tr><td>Adjusted Amount</td><td>".$Adjusted."</td><td>&nbsp;</td></tr>";
			}  ?>
      <tr>
        <td><strong>Balance</strong></td>
        <td><strong><?php if ($CRBalance>$DRBalance)
		{
		    $Adjusted = $CRBalance - $DRBalance ;  echo number_format($DRBalance+$Adjusted, 2, '.', ','); } else{echo number_format($DRBalance, 2, '.', ',');} ?> </strong></td>
        <td><strong><?php if ($DRBalance>$CRBalance)
		{
	$Adjusted = $DRBalance - $CRBalance; echo $CRBalance+$Adjusted; }else {echo $CRBalance;} ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_CapitalDetail);

mysql_free_result($RS_SupplierDebit);

mysql_free_result($RS_CustomerQuery);

mysql_free_result($RS_financialAccDrCr);

mysql_free_result($RS_ExpensePayment);

mysql_free_result($RS_EmpSalary);

mysql_free_result($RS_EmpSalaryMonthly);

mysql_free_result($RS_HotelIncome);

mysql_free_result($RS_AccountRecevable);

mysql_free_result($RS_AccountPayable);

mysql_free_result($RS_PrePaidInsurance);

mysql_free_result($RS_Land);

mysql_free_result($RS_Building);

mysql_free_result($RS_Equipments);

mysql_free_result($RS_Furniture);

mysql_free_result($RS_Car);

mysql_free_result($RS_ADBuilding);

mysql_free_result($RS_ADFurniture);

mysql_free_result($RS_ADCar);

mysql_free_result($RS_ADEquipments);

mysql_free_result($RS_OtherAsset);

mysql_free_result($RS_ADOtherAsset);
?>
