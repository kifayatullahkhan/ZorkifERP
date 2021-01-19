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


//Sale
mysql_select_db($database_Conn, $Conn);
$query_RS_Sale = "SELECT ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) -((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100))AS Credit FROM erp_customerorderdetails JOIN erp_customerorders ON erp_customerorders.CustomerOrderID=erp_customerorderdetails.CustomerOrderID WHERE  erp_customerorders.OrderDate BETWEEN '$from' AND '$to'";
$RS_Sale = mysql_query($query_RS_Sale, $Conn) or die(mysql_error());
$row_RS_Sale = mysql_fetch_assoc($RS_Sale);
$totalRows_RS_Sale = mysql_num_rows($RS_Sale);

//Purchase
mysql_select_db($database_Conn, $Conn);
$query_RS_Purchase = "SELECT ((erp_purchaseordersproformainvoicedetails.Quantity* erp_purchaseordersproformainvoicedetails.Price_Per_Unit) + (erp_otherexpensesonsupplierinvoice.CustomDuty+ erp_otherexpensesonsupplierinvoice.PortDuty + erp_otherexpensesonsupplierinvoice.DeleryOrder + erp_otherexpensesonsupplierinvoice.Transportation + erp_otherexpensesonsupplierinvoice.ClearingAgentCharges + erp_otherexpensesonsupplierinvoice.LabourCharges + erp_otherexpensesonsupplierinvoice.LABTestingCharges + erp_otherexpensesonsupplierinvoice.Detention_Mina + erp_otherexpensesonsupplierinvoice.Detention_Container + erp_otherexpensesonsupplierinvoice.OtherCharges)) AS Debit     FROM erp_supplierscompanies  JOIN erp_purchaseordersproformainvoice  ON erp_supplierscompanies.SupplierID = erp_purchaseordersproformainvoice.SupplierID  JOIN erp_otherexpensesonsupplierinvoice  ON erp_purchaseordersproformainvoice.POPIID = erp_otherexpensesonsupplierinvoice.POPIID  JOIN erp_purchaseordersproformainvoicedetails  ON erp_purchaseordersproformainvoicedetails.POPIID = erp_purchaseordersproformainvoice.POPIID  JOIN erp_productionitems  ON erp_purchaseordersproformainvoicedetails.PItemID = erp_productionitems.PItemID  WHERE erp_purchaseordersproformainvoice.OrderDate BETWEEN '$from' AND '$to' AND erp_purchaseordersproformainvoice.OrderStatus = 'DONE' AND erp_supplierscompanies.SupplierID =  erp_otherexpensesonsupplierinvoice.SupplierID";
$RS_Purchase = mysql_query($query_RS_Purchase, $Conn) or die(mysql_error());
$row_RS_Purchase = mysql_fetch_assoc($RS_Purchase);
$totalRows_RS_Purchase = mysql_num_rows($RS_Purchase);

//InvItems Stock Cost
mysql_select_db($database_Conn, $Conn);
$query_RS_InvItems = "SELECT (erp_inventoryitems.InvItemSalesPrice* erp_inventoryitems.StockPositionQuantity) As InvStock FROM erp_inventoryitems";
$RS_InvItems = mysql_query($query_RS_InvItems, $Conn) or die(mysql_error());
$row_RS_InvItems = mysql_fetch_assoc($RS_InvItems);
$totalRows_RS_InvItems = mysql_num_rows($RS_InvItems);

//ProductionItems Stock Cost
mysql_select_db($database_Conn, $Conn);
$query_RS_PurchaseStock = "SELECT (erp_productionitems.StockPositionQuantity * erp_purchaseordersproformainvoicedetails.Price_Per_Unit) AS PurchaseStockCost  FROM erp_productionitems JOIN  erp_productionitemsusage ON  erp_productionitemsusage.PItemID =  erp_productionitems.PItemID JOIN   erp_purchaseordersproformainvoicedetails ON    erp_purchaseordersproformainvoicedetails.PItemID =  erp_productionitems.PItemID JOIN   erp_werehouses ON    erp_werehouses.WHID = erp_productionitems.WHID JOIN   erp_productionitemtype ON   erp_productionitemtype.PITID = erp_productionitems.PITID JOIN erp_productionitemunittypes ON  erp_productionitemunittypes.PIUTID = erp_productionitems.PIUTID JOIN  erp_purchaseordersproformainvoice ON   erp_purchaseordersproformainvoicedetails.POPIID = erp_purchaseordersproformainvoice.POPIID WHERE erp_purchaseordersproformainvoice.OrderDate BETWEEN '$from' AND '$to' AND erp_purchaseordersproformainvoice.OrderStatus = 'DONE' AND erp_productionitems.PItemID = erp_purchaseordersproformainvoicedetails.PItemID ORDER BY erp_productionitems.PItemID";
$RS_PurchaseStock = mysql_query($query_RS_PurchaseStock, $Conn) or die(mysql_error());
$row_RS_PurchaseStock = mysql_fetch_assoc($RS_PurchaseStock);
$totalRows_RS_PurchaseStock = mysql_num_rows($RS_PurchaseStock);

//Production Cost
mysql_select_db($database_Conn, $Conn);
$query_RS_ProductionCost = "SELECT (erp_productionitemsusage.QuantityUsed * erp_purchaseordersproformainvoicedetails. Price_Per_Unit + erp_otherproductioncostfactors.ElectricityCost +  erp_otherproductioncostfactors.EmployeeCost) AS ProductionCost FROM erp_otherproductioncostfactors , erp_purchaseordersproformainvoicedetails , erp_productionitemsusage, erp_purchaseordersproformainvoice WHERE erp_purchaseordersproformainvoicedetails.PItemID = erp_productionitemsusage.PItemID AND erp_purchaseordersproformainvoice.POPIID = erp_purchaseordersproformainvoicedetails.POPIID AND erp_purchaseordersproformainvoice.OrderStatus = 'DONE'";
$RS_ProductionCost = mysql_query($query_RS_ProductionCost, $Conn) or die(mysql_error());
$row_RS_ProductionCost = mysql_fetch_assoc($RS_ProductionCost);
$totalRows_RS_ProductionCost = mysql_num_rows($RS_ProductionCost);

//Expenses
mysql_select_db($database_Conn, $Conn);
$query_RS_Expenses = "SELECT erp_expense_payment_voucher_details.Amount FROM erp_expenses_payment_types JOIN erp_expense_payment_voucher_details ON erp_expenses_payment_types.ExpenseTypeID = erp_expense_payment_voucher_details.ExpenseTypeID JOIN erp_expense_payment_vouchers ON erp_expense_payment_voucher_details.VoucherID = erp_expense_payment_vouchers.VoucherID WHERE erp_expense_payment_vouchers.Dated BETWEEN '$from' AND '$to'";
$RS_Expenses = mysql_query($query_RS_Expenses, $Conn) or die(mysql_error());
$row_RS_Expenses = mysql_fetch_assoc($RS_Expenses);
$totalRows_RS_Expenses = mysql_num_rows($RS_Expenses);

//Employee yearly Salary
$Year=substr($_POST['From'],6,4);
$EYear=substr($_POST['To'],6,4);

mysql_select_db($database_Conn, $Conn);
$query_RS_EmpYearlySalary = "SELECT erp_employee_salary.NetPaySalaryAmount  FROM erp_employee_salary  JOIN  erp_employee_details ON erp_employee_salary.EmployeeID = erp_employee_details.EmployeeID WHERE erp_employee_salary.PaymentStatus = 'DONE' AND erp_employee_salary.SalaryYear BETWEEN '$Year' AND '$EYear'";
$RS_EmpYearlySalary = mysql_query($query_RS_EmpYearlySalary, $Conn) or die(mysql_error());
$row_RS_EmpYearlySalary = mysql_fetch_assoc($RS_EmpYearlySalary);
$totalRows_RS_EmpYearlySalary = mysql_num_rows($RS_EmpYearlySalary);

//Income Tax
mysql_select_db($database_Conn, $Conn);
$query_RS_IncomeTax = "SELECT erp_tax_payment_voucher_details.TaxAmount FROM erp_tax_payment_types JOIN erp_tax_payment_voucher_details ON erp_tax_payment_voucher_details.TaxTypeID = erp_tax_payment_types.TaxTypeID JOIN erp_tax_payment_vouchers ON erp_tax_payment_vouchers.VoucherID = erp_tax_payment_voucher_details.VoucherID WHERE erp_tax_payment_vouchers.Dated  BETWEEN '$from' AND '$to'";
$RS_IncomeTax = mysql_query($query_RS_IncomeTax, $Conn) or die(mysql_error());
$row_RS_IncomeTax = mysql_fetch_assoc($RS_IncomeTax);
$totalRows_RS_IncomeTax = mysql_num_rows($RS_IncomeTax);

// Asset Derectiation
mysql_select_db($database_Conn, $Conn);
$query_RS_Deprection = "SELECT  asset.Depreciation FROM asset";
$RS_Deprection = mysql_query($query_RS_Deprection, $Conn) or die(mysql_error());
$row_RS_Deprection = mysql_fetch_assoc($RS_Deprection);
$totalRows_RS_Deprection = mysql_num_rows($RS_Deprection);

//Other or Hotel Income
mysql_select_db($database_Conn, $Conn);
$query_RS_HotelIncome = "SELECT ( hotel_client_details.TotalAmountPaid *1) AS OtherIncome  FROM hotel_client_details JOIN  hotel_reservations_types  ON hotel_client_details.ReservationTypeID = hotel_reservations_types.ReservationTypeID JOIN hotel_rooms_or_sections ON hotel_client_details.RoomSectionID = hotel_rooms_or_sections.RoomSectionID WHERE hotel_client_details.StartDate BETWEEN '$from' AND '$to'";
$RS_HotelIncome = mysql_query($query_RS_HotelIncome, $Conn) or die(mysql_error());
$row_RS_HotelIncome = mysql_fetch_assoc($RS_HotelIncome);
$totalRows_RS_HotelIncome = mysql_num_rows($RS_HotelIncome);
?>
<!-- Sale -->
<div class="1">
  <form id="form1" name="form1" method="post" action="">
    <table border="1">
      <?php $Sale=0; do { ?>
        <?php $Sale=$Sale+$row_RS_Sale['Credit'];?>
        <?php } while ($row_RS_Sale = mysql_fetch_assoc($RS_Sale)); ?>
    </table>
  </form>
</div>
<!-- Purchase -->
<div class="1">
  <form id="form2" name="form2" method="post" action="">
    <table border="1">
      <?php $Purchase=0; do { ?>
        <?php $Purchase=$Purchase+$row_RS_Purchase['Debit']; ?>
        <?php } while ($row_RS_Purchase = mysql_fetch_assoc($RS_Purchase)); ?>
    </table>
  </form>
</div>
<!-- Inv Items -->
<div class="1">
  <form id="form3" name="form3" method="post" action="">
    <table border="1">
      <?php $InvItem=0; do { ?>
        <?php $InvItem=$InvItem+$row_RS_InvItems['InvStock'];?>
        <?php } while ($row_RS_InvItems = mysql_fetch_assoc($RS_InvItems)); ?>
    </table>
  </form>
</div>
<!-- PStockCost -->
<div class="1">
  <form id="form4" name="form4" method="post" action="">
    <table border="1">
      <?php $PurchaseStock=0; do { ?>
        <?php $PurchaseStock=$PurchaseStock+$row_RS_PurchaseStock['PurchaseStockCost'];?>
        <?php } while ($row_RS_PurchaseStock = mysql_fetch_assoc($RS_PurchaseStock)); ?>
    </table>
  </form>
</div>
<!-- ProductionStock -->
<div class="1">
  <form id="form5" name="form5" method="post" action="">
    <table border="1">
      <?php $ProductionCost=0; do { ?>
        <?php $ProductionCost=$ProductionCost+$row_RS_ProductionCost['ProductionCost'];?>
        <?php } while ($row_RS_ProductionCost = mysql_fetch_assoc($RS_ProductionCost)); ?>
    </table>
  </form>
</div>
<!-- Expenses -->
<div class="1">
  <form id="form6" name="form6" method="post" action="">
    <table border="1">
      <?php $Expenses=0; do { ?>
        <?php $Expenses=$Expenses+$row_RS_Expenses['Amount'];?>
        <?php } while ($row_RS_Expenses = mysql_fetch_assoc($RS_Expenses)); ?>
    </table>
  </form>
</div>
<!--yearly Salary -->
<div class="1">
  <form id="form7" name="form7" method="post" action="">
    <table border="1">
      <?php $Y_Salary=0; do { ?>
        <?php $Y_Salary=$Y_Salary+$row_RS_EmpYearlySalary['NetPaySalaryAmount'];?>
        <?php } while ($row_RS_EmpYearlySalary = mysql_fetch_assoc($RS_EmpYearlySalary)); ?>
    </table>
  </form>
</div>
<!--income Tax -->
<div class="1">
  <form id="form8" name="form8" method="post" action="">
    <table border="1">
      <?php $Tax=0; do { ?>
        <?php $Tax=$Tax+$row_RS_IncomeTax['TaxAmount'];?>
        <?php } while ($row_RS_IncomeTax = mysql_fetch_assoc($RS_IncomeTax)); ?>
    </table>
  </form>
</div>
<!--Depreciation -->
<div class="1">
  <form id="form9" name="form9" method="post" action="">
    <table border="1">
      <?php $Depreciation=0; do { ?>
        <?php $Depreciation=$Depreciation+$row_RS_Deprection['Depreciation'];?>
        <?php } while ($row_RS_Deprection = mysql_fetch_assoc($RS_Deprection)); ?>
    </table>
  </form>
</div>
<!-- Other Income-->
<div class="1">
  <form id="form10" name="form10" method="post" action="">
    <table border="1">
      <?php $OtherIncome=0; do { ?>
        <?php $OtherIncome=$OtherIncome+$row_RS_HotelIncome['OtherIncome'];?>
        <?php } while ($row_RS_HotelIncome = mysql_fetch_assoc($RS_HotelIncome)); ?>
    </table>
  </form>
</div>
<!-- Time Period Of Income Statement -->
<div class="1">
<h2>Income Statement</h2>
  <form id="form11" name="form11" method="post" action="">
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
        <td><strong>System Date</strong></td>
        <td><strong><?php echo date('d-m-Y'); ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<!-- Income Statement -->
<div class="1">
  <form id="form12" name="form12" method="post" action="">
  <table width="200" border="1">
      <tr>
        <th>Particulars</th>
        <th>Amount</th>
        <th>Amount</th>
      </tr>
      <!-- Sales = customerorderdetail between from and to and(quanity*unitprice) -->
      <tr>
        <td>Sale</td>
        <td>&nbsp;</td>
        <td><?php $Sale;
		echo number_format($Sale, 2, '.', ','); ?></td>
      </tr>
      <!-- OpeningStock = InvItem + Purchase - Sale -->
      <tr>
        <td>OpeningStock</td> 
        <td><?php $OpeningStock = $InvItem + $Purchase - $Sale; 
		echo number_format($OpeningStock, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
      <!-- Purchases = Purchase between from and to and (Quanity*UnitPrice) -->
      <tr>
        <td>Purchase</td>
        <td><?php $Purchase; 
		echo number_format($Purchase, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
      <!-- Production Cost -->
      <tr>
        <td>ProductionCost</td>
        <td><?php $ProductionCost;
		echo number_format($ProductionCost, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
      <!-- Closing Stock = OpeningStock + purchase - sale -->
      <tr>
        <td>ClosingStock</td>
        <td><?php $ClosingStock = $OpeningStock + $Purchase - $Sale ;
		echo number_format($ClosingStock, 2, '.', ',');?></td>
        <td>&nbsp;</td>
      </tr>
      <!-- Cost of goods Sold = Sale - (purchase + Production Cost) -->
      <tr>
        <td><strong>Cost of Goods Sold</strong></td>
        <td>&nbsp;</td>
        <td><?php $CostOfGoodsSold = $Sale - ($Purchase + $ProductionCost);
		echo number_format($CostOfGoodsSold, 2, '.', ',');?></td>
      </tr>
      <!--Gross Profit = Sale - Cost of Good Sold -->
      <tr>
        <td>Gross Profit</td>
        <td>&nbsp;</td>
        <td><?php $GrossProfit = $Sale - $CostOfGoodsSold;
		echo number_format($GrossProfit, 2, '.', ',');?></td>
      </tr>
      <!-- Gross margin = GrossProfit / Sale-->
      <tr>
        <td>Gross Margin</td>
        <td>&nbsp;</td>
        <td><?php $GrossMargin = $GrossProfit / $Sale;
		echo number_format($GrossMargin, 2, '.', ',');?></td>
      </tr>
      <tr>
        <td><strong>Opertaing Expenses</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <!-- Salaries paid to employees -->
      <tr>
        <td>Salries Paid</td>
        <td>&nbsp;</td>
        <td><?php $Y_Salary;
		echo number_format($Y_Salary, 2, '.', ','); ?></td>
      </tr>
      <!-- Other Expenses made by Administration-->
      <tr>
        <td>Other Expenses</td>
        <td>&nbsp;</td>
        <td><?php $Expenses; 
		echo number_format($Expenses, 2, '.', ',');?></td>
      </tr>
      <!-- Operating expenses = Salaries paid + expenses-->
      <tr>
        <td>Operating Expenses</td>
        <td>&nbsp;</td>
        <td><?php $OperatingExpenses = $Y_Salary + $Expenses ;
		echo number_format($OperatingExpenses, 2, '.', ',');?></td>
      </tr>
      <!-- operating Profit = Gross Profit - Operating Expenses-->
      <tr>
        <td>Operating Profit</td>
        <td>&nbsp;</td>
        <td><?php $OperatingProfit = $GrossProfit - $OperatingExpenses;
		echo number_format($OperatingProfit, 2, '.', ',');?></td>
      </tr>
      <!-- Intrest on Expenses-->
      <tr>
        <td>Income Taxes</td>
        <td>&nbsp;</td>
        <td><?php $Tax; 
		echo number_format($Tax, 2, '.', ',');?></td> 
      </tr>
      <tr>
        <td>Deprection</td>
        <td>&nbsp;</td>
        <td><?php $Depreciation; 
		echo number_format($Depreciation, 2, '.', ',');?></td>
      </tr>
      <!--Hotel Income -->
      <tr>
        <td>OtherIncome</td>
        <td>&nbsp;</td>
        <td><?php $OtherIncome;
		echo number_format($OtherIncome, 2, '.', ',');?></td>
      </tr>
      <!-- Net Income from Continuing Operations -->
      <!-- Operating Profit - Interest Expense, Income Taxes, and Depreciation = Net Income from Continuing Operations -->
      <tr>
        <td><strong>NetIncome</strong></td>
        <td>&nbsp;</td>
        <td><strong><?php $NetIncome = $OperatingProfit + $OtherIncome -( $Tax +$Depreciation );
		echo number_format($NetIncome, 2, '.', ',');?></strong></td>
      </tr>
      <!-- <tr>
        <td><strong>Non Opertaing Expenses</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Discontinued Operations</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Extraordinary Items</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
     
      <tr>
        <td>Other items</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      Net Income from Continuing Operations - Non Opertaing Expenses (extraordinary items, discontinued operations) = net income 
       <tr>
        <td>Net Income</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> -->
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_Sale);

mysql_free_result($RS_Purchase);

mysql_free_result($RS_InvItems);

mysql_free_result($RS_PurchaseStock);

mysql_free_result($RS_ProductionCost);

mysql_free_result($RS_Expenses);

mysql_free_result($RS_EmpYearlySalary);

mysql_free_result($RS_IncomeTax);

mysql_free_result($RS_Deprection);

mysql_free_result($RS_HotelIncome);
?>
