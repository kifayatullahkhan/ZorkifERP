<div style="width:600px; background-color:#FFFFFF;">
  <!-- Green Title Bar of the Page Center Text-->
  <!-- Container Area of the  Page Body Text-->
  <div id="PageBodyAreaforText"><br />
    <div style="background-color:#FFFFFF">
    
    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],9,$database_Conn,$Conn)>=1    || Get_Allow_Everyone_AccessessRights(9,$database_Conn,$Conn)>=1) {?>  
       
<div id="CP_HotelManagementSystem" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Hotel Management Management (Reservation and Payments)</div>
        <div class="CollapsiblePanelContent">
         <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="hotel_reservation.php"><img src="images/cpanel/add-new-expense.png" alt="Guest Reservations" width="56" height="53" border="0" /><br />
                    Reservations</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="hotel_client_details.php"><img src="images/cpanel/add-new-exp-account.png" alt="Guests as Clients" width="56" height="53" border="0" /><br />
                    
                    Clients</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="hotel_client_payments_and_check_out.php"><img src="images/cpanel/view-expenses.png" alt="Client Payments" width="56" height="53" border="0" /><br />
                    Client Payments</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="hotel_client_reports.php"><img src="images/cpanel/view-specific-date-expenses-report.png" alt="Payment Reports" width="56" height="53" border="0" /><br />
                    Reports</a></div>
                </div></td>
              </tr>
              <!--Row 2 start -->
              <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_hotel_client.php"><img src="images/cpanel/hotel_client.png" alt="Payment Reports" width="56" height="53" border="0" /><br />
                   By Client Name Hotel Details</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_hotel_client.php"><img src="images/cpanel/date_hotel_client.png" alt="Payment Reports" width="56" height="53" border="0" /><br />
                    ByDate Hotel Client Details</a></div>
                </div></td>
              
            </table>
          </div>
        </div>
    </div>
    <p>&nbsp;</p>
       <?php  } // end of Group Based Show Area ?>   

    <?php if(GetAccessRightsForThisSectionInERP($_SESSION['MM_UserGroup'],10,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(10,$database_Conn,$Conn)>=1) {?>      
      <div id="CP_ERPConfigSetup" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">ERP Configuration Setup</div>
        <div class="CollapsiblePanelContent"><br />
            <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0" class="DataEntryView">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_clearingagent.php"><img src="images/cpanel/ticketsystem-admin.png" alt="Clearing Agents Details" width="56" height="53" border="0" /><br />
                     Clearing Agents</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_productionitems.php"><img src="images/cpanel/icon7.jpg" alt="Production Items" width="56" height="53" border="0" /><br />
                    Production Items</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_productionitemtype.php"><img src="images/cpanel/add_product.png" alt="Production Item Types" width="56" height="53" border="0" /><br />
                  Production Item Types</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_productionitemunittypes.php"><img src="images/cpanel/back-to-main.png" alt="Weighing Units of Products" width="56" height="53" border="0" /><br />
                  Weighing  Units</a></div>
                </div></td>
              </tr>
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_otherproductioncostfactors.php"><img src="images/cpanel/add-new-exp-account.png" alt="Cost Factor for Purchase Orders" width="56" height="53" border="0" /><br />
                    Cost Factors</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_werehouses.php"><img src="images/cpanel/home1.jpg" alt="Wearhouses" width="56" height="53" border="0" /><br />
                    Wearhouses</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_inventoryitemstypes.php"><img src="images/cpanel/scm.png" alt="Manage Invantory Item Categories" width="56" height="53" border="0" /><br />
                    Invantory Items <br />
                    Category</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_inventoryitems.php"><img src="images/cpanel/system2.jpg" alt="Manage Invantory" width="56" height="53" border="0" /><br />
                    Invantory Items</a></div>
                </div></td>
              </tr>
              <tr>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_inventoryitemsunits.php"><img src="images/cpanel/system.jpg" alt="Item Weighing Units" width="56" height="53" border="0" /><br />
                    Invantory Items<br />
                    Weighing Units</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_accounts_capital_account.php"><img src="images/cpanel/add-new-income.png" alt="Setup Up Owner's Capital Share for the Business" width="56" height="53" border="0" /><br />
                    Setup Capital <br />
                    Account</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_asset.php"><img src="images/cpanel/asset.png" alt="Asset detail" width="56" height="53" border="0" /><br />
                    Asset</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="#"><img src="images/cpanel/database_backup.gif" alt="DB Backup" width="56" height="53" border="0" /><br />
                    Backup DB</a></div>
                </div></td>
              </tr>
              <!-- Row 5-->
              <tr>
              <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_tax_payment_types.php"><img src="images/cpanel/Tax_Types.png" alt="Tax" width="56" height="53" border="0" /><br />
                Tax Payment Type</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_tax_payment_vouchers.php"><img src="images/cpanel/Tax_Pay_Vouchar.png" alt="TaxType" width="56" height="53" border="0" /><br />
                 Tax payment Voucher</a></div>
                </div></td>
               <td align="center"><div class="roundedmenubox">
               <div align="center"><a href="erp_tax_payment_voucher_details.php"><img src="images/cpanel/By_Date_Tax_Pay.png" alt="TaxDetail" width="56" height="53" border="0" /><br />
              Tax payment <br/>
              Voucher Detail</a></div>
                </div></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>   
      <?php  } // end of Group Based Show Area ?>

   
   
   
   
   
    <?php if(GetAccessRightsForThisSectionInERP($_SESSION['MM_UserGroup'],11,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(11,$database_Conn,$Conn)>=1) {?>  
       
      <a name="WebManagement" id="WebManagement"></a>
      <div id="CP_ERP_Purchase_Order_and_Invoice_Proforma" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Purchase Order and Proforma Invoices</div>
        <div class="CollapsiblePanelContent">
          <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_purchaseorders.php"><img src="images/cpanel/purchase_order.gif" alt="Purchase Orders" width="56" height="53" border="0" /><br />
                    Purchase Orders</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_purchaseordersproformainvoice.php"><img src="images/cpanel/invoice.gif" alt="Proforma Invoices from Purchase Orders" width="55" height="53" border="0" /><br />
                    Proforma Invoice</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_purchase_payment_vouchers_to_supplier.php"><img src="images/cpanel/reports.gif" alt="Payment Vouchers" width="56" height="53" border="0" /><br />
                    Payment Voucher</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_otherexpensesonsupplierinvoice.php"><img src="images/cpanel/add-new-income.png" alt="Expenses on Purchase Orders" width="56" height="53" border="0" /><br />
                    Other Expenses<br />
                    (C&amp;F)</a></div>
                </div></td>
              </tr>
              <tr>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_supplierscompanies.php"><img src="images/cpanel/suppliers.gif" alt="Supplier's List" width="56" height="53" border="0" /><br />
                    Suppliers</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_item_wise_purchase.php"><img src="images/cpanel/Item_Wise_Purchase.png" alt="Item wise purchase" width="56" height="53" border="0" /><br />
                    Item Wise Purchase Report</a></td>
                    <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_supplier_wise_purchase.php"><img src="images/cpanel/supplier_item_purchase.png" alt="Supplier and item wise purchase" width="56" height="53" border="0" /><br />
                    Suppliers And Item Wise Purchase Report</a></td>
                    <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_order_no_purchase.php"><img src="images/cpanel/Ref_No_Purchase.png" alt="Ref order no purchase" width="56" height="53" border="0" /><br />
                    ReferenceNo purchase Report</a></td>
                  <tr>  <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_purchase.php"><img src="images/cpanel/By_Date_Purchase.png" alt="By Date Purchase" width="56" height="53" border="0" /><br />
                    By Date Purchase Report</a></td>
                    <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_voucher_no_purchase.php"><img src="images/cpanel/Purchase_By_Vouchar.png" alt="Purchase by Vouchar no" width="56" height="53" border="0" /><br />
                    Voucher No Purchase report</a></td>
                    <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_supplier_purchase.php"><img src="images/cpanel/Supplier_Wise_Purchase.png" alt="Supplier wise purchase" width="56" height="53" border="0" /><br />
                   Supplier Wise Purchase</a></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_pitem_stock_position.php"><img src="images/cpanel/purchase_stock.png" alt="Purchase stock" width="56" height="53" border="0" /><br />
                   Purchase items Stock position </a></td>
                   </tr><tr>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_purchase_payment.php"><img src="images/cpanel/Purchase_Payment.png" alt="Purchase Payment" width="56" height="53" border="0" /><br />
                   Purchase Payments </a></td></tr>
            </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>       
       <?php  } // end of Group Based Show Area ?>








    <?php if(GetAccessRightsForThisSectionInERP($_SESSION['MM_UserGroup'],12,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(12,$database_Conn,$Conn)>=1) {?>       
       
      <a name="NewsManagement" id="NewsManagement"></a>
      <div id="CP_ERPSalesOrders" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Sales Orders  (By Salesman)</div>
        <div class="CollapsiblePanelContent">
               <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_customerorders.php?ActionID=QUOTATION"><img src="images/cpanel/quotation.gif" alt="Quotations to Customers" width="56" height="53" border="0" /><br />
                    Quotations</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_customerorders.php"><img src="images/cpanel/order_form.gif" alt="Customer's Order Form" width="56" height="53" border="0" /><br />
                    Order Form</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_customers.php"><img src="images/cpanel/add-group.png" alt="List of Customers" width="56" height="53" border="0" /><br />
                    Customers</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_customer_payment.php"><img src="images/cpanel/Sale_Payment.png" alt="Customer Payment" width="56" height="53" border="0" /><br />
                  CustomerPayments</a></div>
                </div></td>
              </tr>
              <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_item_wise_sale.php"><img src="images/cpanel/item_wise_sale.png" alt="Item Wise Sale" width="56" height="53" border="0" /><br />
                  Item wise Sale Report </a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_customer_wise_sale.php"><img src="images/cpanel/Customer_Item_Wise_Sale.png" alt="Customer And Item Wise" width="56" height="53" border="0" /><br />
                  Customer And Item Wise Sale Report</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_order_no_sale.php"><img src="images/cpanel/Ref_No_Sale.png" alt=" By Ref No Sale " width="56" height="53" border="0" /><br />
                  Reference No Sale Report </a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_sale.php"><img src="images/cpanel/By_Date_Sale.png" alt="By Date Sale" width="56" height="53" border="0" /><br />
                 By Date Sale Report</a></div>
                </div></td></tr>
                <tr><td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_customer_sale.php"><img src="images/cpanel/customer_wise_sale.png" alt="Customer Wise Sale" width="56" height="53" border="0" /><br />
                 Customer Wise Sale</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_invitem_stock_position.php"><img src="images/cpanel/Inventory_Stock.png" alt="Inventory Items Stock" width="56" height="53" border="0" /><br />
                 InvItem Stock Position</a></div>
                </div></td>
                </tr>
            </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>    
       <?php  } // end of Group Based Show Area ?>
            








    <?php if(GetAccessRightsForThisSectionInERP($_SESSION['MM_UserGroup'],13,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(13,$database_Conn,$Conn)>=1) {?>     
       
      <div id="CP_ERPSalesOrderProcessing" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Sales Orders  and Sales Order Processing</div>
        <div class="CollapsiblePanelContent">
             <div align="center" class="CPanelTableView">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_customerorders.php?ActionID=QUOTATION"><img src="images/cpanel/quotation.gif" alt="Quotations to Customers" width="56" height="53" border="0" /><br />
                  Quotations</a></div>
              </div></td>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_customerorders.php"><img src="images/cpanel/order_form.gif" alt="Customer's Order Form" width="56" height="53" border="0" /><br />
                  Order Form</a></div>
              </div></td>
              <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_customerorders_for_invoice.php"><img src="images/cpanel/invoice.gif" alt="Prepare Invoice for Customer Orders" width="56" height="53" border="0" /><br />
                  Prepare Invoice</a></div>
              </div></td>
              <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_customerorders_for_invoice_delivery_order_form.php"><img src="images/cpanel/delivery_order_form.gif" alt="Delivery Order Form Send The Invoice Copy to the Delivery Department " width="56" height="53" border="0" /><br />
                  Delivery Order <br />
                  Form</a></div>
              </div></td>
            </tr>
            <tr>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_customers.php"><img src="images/cpanel/add-group.png" alt="List of Customers" width="56" height="53" border="0" /><br />
                  Customers</a></div>
              </div></td>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_executed_pending_purchase.php"><img src="images/cpanel/pending_done_purchase.png" alt="" width="56" height="53" border="0" /><br />
                 Executed pending Purchase Report</a></div></td>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_executed_pending_sales.php"><img src="images/cpanel/pending_done_sale.png" alt="" width="56" height="53" border="0" /><br />
                   Executed pending Sale Report</a></div></td>
              <td width="90" align="center">&nbsp;</td>
              </tr>
          </table>
          </div>
        </div>
      </div>
      <p>&nbsp;  </p>
      <?php  } // end of Group Based Show Area ?>      
       








    <?php if(GetAccessRightsForThisSectionInERP($_SESSION['MM_UserGroup'],14,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(14,$database_Conn,$Conn)>=1) {?>  
	   
<div id="CP_ERPInventory" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Inventory System</div>
        <div class="CollapsiblePanelContent">
        <div align="center" class="CPanelTableView">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_inventoryitems_positions.php"><img src="images/cpanel/stock_levels.gif" alt="Shows the Invantory Stock levels of items in all wearhouses" width="56" height="53" border="0" /><br />
                  View Stock<br />
                  Position</a></div>
              </div></td>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_inventoryitems.php"><img src="images/cpanel/software-forms.png" alt="Inventory Item Setup" width="56" height="53" border="0" /><br />
                  Invantory Items Setup</a></div>
              </div></td>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_inventoryitems_stock_updater.php"><img src="images/cpanel/add-edit-course.png" alt="Update Invantory Stock Quantities." width="56" height="53" border="0" /><br />
                  Stock Update</a></div>
              </div></td>
              <td width="90" align="center" class="DataEntryView">&nbsp;</td>
              </tr>
          </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>  
      <?php  } // end of Group Based Show Area ?>      
      






    <?php if(GetAccessRightsForThisSectionInERP($_SESSION['MM_UserGroup'],15,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(15,$database_Conn,$Conn)>=1) {?>  
       
<div id="CP_ERPAccountingSystem" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Accounting System</div>
        <div class="CollapsiblePanelContent">
         <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_expense_payment_vouchers.php"><img src="images/cpanel/expenses.gif" alt="Expenses Management" width="56" height="53" border="0" /><br />
                    Expenses</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_expense_view_details_list.php"><img src="images/cpanel/expenses_view.gif" alt="View Expenses" width="56" height="53" border="0" /><br />
                    View Expenses</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_expenses_payment_types.php"><img src="images/cpanel/expenses_types.gif" alt="Tpyes/Cateogries of Expenses" width="56" height="53" border="0" /><br />
                    Expenses Types</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_financial_bank_transactions_debit.php"><img src="images/cpanel/bank_deposit.gif" alt="Bank Deposits of Income Amount" width="56" height="53" border="0" /><br />
                    Bank <br />
                    Deposits</a></div>
                </div></td>
                </tr>
                <tr>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_financial_bank_transactions_credit.php"><img src="images/cpanel/bank_withdrawl.gif" alt="Withdrawls of amount from Bank Account" width="56" height="53" border="0" /><br />
                    Bank<br />
Withdrawls</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_financial_bank_transactions_statement.php"><img src="images/cpanel/bank_statement.gif" alt="Show Bank Statement" width="56" height="53" border="0" /><br />
                    Bank<br />
Statement</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_financial_bank_names.php"><img src="images/cpanel/banks.gif" alt="Bank Details" width="56" height="53" border="0" /><br />
                    Banks</a></div>
                </div></td>
                <!-- Capital Account Detail-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_capital_detail.php"><img src="images/cpanel/Capital.png" alt="Capital" width="56" height="53" border="0" /><br />
                    Capital Detail</a></div>
                </div></td>
                </tr>
                <!-- Row 3 start--> 
                <tr>
                <!-- ByBankName F-Acc Transactions-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_financial_acc_bank_transactions.php"><img src="images/cpanel/By_Bank_Name.png" alt="By Bank Name" width="56" height="53" border="0" /><br />
                    ByBankName F-Acc Transactions</a></div>
                 </div></td>
                <!-- ByAccount No F-Acc Transactions-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_byaacno_bank_transactions.php"><img src="images/cpanel/By_Acc_No.png" alt="By Acc no F-Acc" width="56" height="53" border="0" /><br />
                    ByAccount No F- Bank Transactions</a></div>
                </div></td>
                 <!-- ByDate F-Acc Transactions-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_bank_transactions.php"><img src="images/cpanel/By_Date_Bank.png" alt="By Date" width="56" height="53" border="0" /><br />
                    ByDate F-Bank Transactions</a></div>
                </div></td>
                <!-- ByDate Name F-Acc Transactions-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_name_acc_transactions_ledger.php"><img src="images/cpanel/By_Date_BankName.png" alt="" width="56" height="53" border="0" /><br />
                    ByDate Name F-Acc Transactions</a></div>
                 </div></td>  
                </tr>
                <!-- Row 4 start-->
                <tr>
                <!-- ByDepositor Name F-Acc Bank Deposits-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_financial_acc_bank_deposits.php"><img src="images/cpanel/By_Depositor.png" alt="" width="56" height="53" border="0" /><br />
                    ByDepositor Name F-Acc Bank Deposits</a></div>
                </div></td>
                <!-- ByDate F-Acc Bank Deposits-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_acc_bank_deposits.php"><img src="images/cpanel/By_Date_Depositor.png" alt="" width="56" height="53" border="0" /><br />
                    ByDate F-Acc Bank Deposits</a></div>
                </div></td>
                <!-- ByWithDrawl Name F-Acc Bank WithDrawl-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_financial_acc_bank_withdrawl.php"><img src="images/cpanel/By_Withdrawler.png" alt="" width="56" height="53" border="0" /><br />
                    ByWithDrawl Name F-Acc Bank WithDrawl</a></div>
                </div></td>
                <!-- ByDate Bank Account WithDrawl-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_acc_bank_withdrawl.php"><img src="images/cpanel/By_Date_Withdrawler.png" alt="" width="56" height="53" border="0" /><br />
                    ByDate Bank Account WithDrawl</a></div>
                </div></td>
                </tr>
                <!-- Row 5 start-->
                <tr>
                <!-- ByDate Exp-Payment On Voucher-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_expenses_payment_onvoucher.php"><img src="images/cpanel/by_date_exp_vouchar.png" alt="" width="56" height="53" border="0" /><br />
                    ByDate Exp-Payment On Voucher </a></div>
                </div></td>
                <!-- ByType Exp-Payment On Voucher-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bytype_expenses_payment_onvoucher.php"><img src="images/cpanel/by_type_exp_vouchar.png" alt="" width="56" height="53" border="0" /><br />
                    ByType Exp-Payment On Voucher </a></div>
                </div></td>
                <!-- ByDate Name F-Acc Transactions Ledger-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_name_acc_transactions_ledger.php"><img src="images/cpanel/by_date_name_bank.png" alt="" width="56" height="53" border="0" /><br />
                    ByDate Name F-Acc Transactions Ledger</a></div>
                 </div></td>
                <!-- All Banks F-Acc Transactions Ledger-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bank_ledger.php"><img src="images/cpanel/bank_ledger.png" alt="" width="56" height="53" border="0" /><br />
                    All Banks F-Acc Transactions Ledger</a></div>
                 </div></td>
              </tr>
              <!-- Row 6 start -->
              <tr>
             <!-- ByName Customer Ledger-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_customer_ledger.php"><img src="images/cpanel/by_name_cus_ledger.png" alt="" width="56" height="53" border="0" /><br />
                   ByName Customer Ledger</a></div>
                </div></td>
                <!-- Complete Sales Ledger-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_sale_ledger.php"><img src="images/cpanel/sale_ledger.png" alt="" width="56" height="53" border="0" /><br />
                    Complete Sales Ledger</a></div>
                 </div></td>
                 <!-- ByName Supplier Ledger-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_supplier_ledger.php"><img src="images/cpanel/by_name_supplier_ledger.png" alt="" width="56" height="53" border="0" /><br />
                 ByName Supplier Ledger</a></div>
                </div></td>
                 <!-- Complete Purchase Ledger-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_purchase_ledger.php"><img src="images/cpanel/supplier_ledger.png" alt="" width="56" height="53" border="0" /><br />
                    Complete Purchase Ledger</a></div>
                 </div></td>
              </tr>
              <!-- Row 7 start -->
              <tr>
              <!-- ByMonth Emp Salary Ledger-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_bymonth_emp_salary_ledger.php"><img src="images/cpanel/by_month_emp_salary.png" alt="" width="56" height="53" border="0" /><br />
                    ByMonth Emp Salary Ledger</a></div>
                 </div></td>
                <!-- By year All Emp Salary Ledger -->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_emp_salary_ledger.php"><img src="images/cpanel/by_year_emp_salary.png" alt="" width="56" height="53" border="0" /><br />
                    By year All Emp Salary Ledger </a></div>
                 </div></td>
                 <!-- All Expenses Ledger-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_expenses_ledger.php"><img src="images/cpanel/expenses_ledger.png" alt="ExpenseLedger" width="56" height="53" border="0" /><br />
                    All Expenses Ledger</a></div>
                 </div></td>
                <!-- Trial Balance Sheet-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_trial_balance.php"><img src="images/cpanel/Trial.png" alt="Trial" width="56" height="53" border="0" /><br />
                    Trial Balance Sheet</a></div>
                </div></td> 
              </tr>
               <!-- Row 8 start -->
              <tr>
              <!-- Income Statement-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href=" erp_income_statement.php"><img src="images/cpanel/income.png" alt="income statment" width="56" height="53" border="0" /><br />
                    Income Statement</a></div>
                 </div></td>
                 <!-- Balance Sheet-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href=" erp_balance_sheet.php"><img src="images/cpanel/balance.png" alt="Balance Sheet" width="56" height="53" border="0" /><br />
                    Balance Sheet</a></div>
                 </div></td>
                 <!-- Hotel Ledger-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href=" erp_hotel_ledger.php"><img src="images/cpanel/hotel_ledger.png" alt="" width="56" height="53" border="0" /><br />
                    Hotel Ledger</a></div>
                 </div></td>
                 <!-- Asset Detail-->
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href=" erp_asset_detail.php"><img src="images/cpanel/asset_detail.png" alt="" width="56" height="53" border="0" /><br />
                    Asset Detail</a></div>
                 </div></td>
                 </tr>
                 <!--Row 9 -->
                 <tr>
                 <!-- Account Recievable-->
                <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_account_recieveable.php"><img src="images/cpanel/account_reciveable.png" alt="" width="56" height="53" border="0" /><br />
                 Account Recievable</a></div>
                </div></td>
                 <!-- Account Payable-->
                <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_account_payable.php"><img src="images/cpanel/account_payable.png" alt="" width="56" height="53" border="0" /><br />
                Account Payable</a></div>
                </div></td>
                <!-- Purchase Payments-->
                <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_complete_purchase_payment.php"><img src="images/cpanel/purchase_payment.png" alt="" width="56" height="53" border="0" /><br />
                Purchase Payments</a></div>
                </div></td>
                 <!-- Customer Payments-->
                <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_complete_sale_payment.php"><img src="images/cpanel/sale_payment.png" alt="" width="56" height="53" border="0" /><br />
                 Sale Payments</a></div>
                </div></td>
                 </tr>
                 <!--Row 10 -->
                 <tr>
                 <!-- Order no Payments-->
                <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_order_no_sale_payment.php"><img src="images/cpanel/sale_ref_no_pay.png" alt="Bank Details" width="56" height="53" border="0" /><br />
                 Sale OrderRefNo Payments</a></div>
                </div></td>
                 <!-- Order no Payments-->
                <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_order_no_purchase_payment.php"><img src="images/cpanel/purchase_ref_no_pay.png" alt="" width="56" height="53" border="0" /><br />
                Purchase OrderRefNo Payments</a></div>
                </div></td>
                <!--By Date Tax Payments -->
                <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_bydate_tax_payments.php"><img src="images/cpanel/by_date_tax_pay.png" alt="Bank Details" width="56" height="53" border="0" /><br />
                By Date Tax Payments</a></div>
                </div></td>
                 <!--By Type Tax Payments -->
                <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_bytype_tax_payments.php"><img src="images/cpanel/tax_types.png" alt="" width="56" height="53" border="0" /><br />
                By Type Tax Payments</a></div>
                </div></td>
                 </tr>
                 <tr>
                 <!--By Vouchar No tax Type -->
                <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_byvoucher_no_tax_payments.php"><img src="images/cpanel/tax_pay_vouchar.png" alt="" width="56" height="53" border="0" /><br />
                By Vouchar No tax Type</a></div>
                </div></td>
                 </tr>
            </table>
           
          </div>
        </div>
    </div>
    <p>&nbsp;</p>
       <?php  } // end of Group Based Show Area ?>    

  
  
  
  
      
       
    <?php if(GetAccessRightsForThisSectionInERP($_SESSION['MM_UserGroup'],16,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(16,$database_Conn,$Conn)>=1) {?>  
<div id="CP_ERPDeliveryOrderForm" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Delivery Order Form (Wearhouse Orders Dilivery)</div>
        <div class="CollapsiblePanelContent">
           <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_customerorders_for_invoice_delivery_order_form.php"><img src="images/cpanel/delivery_order_form.gif" alt="Delivery Order Form Send The Invoice Copy to the Delivery Department " width="56" height="53" border="0" /><br />
                  Delivery<br />
Order Form</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_inventoryitems_positions.php"><img src="images/cpanel/stock_levels.gif" alt="Shows the Invantory Stock levels of items in all wearhouses" width="56" height="53" border="0" /><br />
                    View Stock<br />
Position</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_warehouse_stock_position.php"><img src="images/cpanel/warehouse_stock.png" alt="Shows the Invantory Stock levels of items in all wearhouses" width="56" height="53" border="0" /><br />
                    WareHouse Stock Position</a></td>
                <td width="90" align="center">&nbsp;</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>      
       
       <?php  } // end of Group Based Show Area ?>
       





    <?php if(GetAccessRightsForThisSectionInERP($_SESSION['MM_UserGroup'],17,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(17,$database_Conn,$Conn)>=1) {?>  
  
      <div id="CP_ERPProductionUnit" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Production Unit</div>
        <div class="CollapsiblePanelContent">
           <div align="center" class="CPanelTableView">
             <table border="0" cellspacing="10" cellpadding="0">
               <tr>
                 <td width="90" align="center"><div class="roundedmenubox">
                   <div align="center"><a href="erp_productionitemusage_chemical.php"><img src="images/cpanel/icon0.jpg" alt="This is used to Update the Raw meterial Stock levels used in productions." width="56" height="53" border="0" /><br />
                     Production<br />
Usage</a></div>
                 </div></td>
                 <td width="90" align="center"><div class="roundedmenubox">
                   <div align="center"><a href="erp_productionitemusage_packing.php"><img src="images/cpanel/icon13.jpg" alt="This is used to show the raw packing meterials used in packing of the production items." width="56" height="53" border="0" /><br />
                     Packing<br />
Usage</a></div>
                 </div></td>
                 <td width="90" align="center">&nbsp;</td>
                 <td width="90" align="center">&nbsp;</td>
               </tr>
             </table>
           </div>
        </div>
      </div>
    <p>&nbsp;</p>       
       <?php  } // end of Group Based Show Area ?>
            






    <?php if(GetAccessRightsForThisSectionInERP($_SESSION['MM_UserGroup'],18,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(18,$database_Conn,$Conn)>=1) {?>  
  
      <div id="CP_ERPWearhouseDeliveryForm" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Testing</div>
        <div class="CollapsiblePanelContent">
           <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_customerorders_for_invoice_delivery_order_form.php"><img src="images/cpanel/add-pagefooter-section.png" width="56" height="53" border="0" /><br />
                    Delivery<br />
Order Form</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="picture_gallery_view.php"><img src="images/cpanel/view-gallery.png" width="56" height="53" border="0" /><br />
                    View<br />
                    Gallery</a></div>
                </div></td>
                <td width="90" align="center">&nbsp;</td>
                <td width="90" align="center">&nbsp;</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    <p>&nbsp;</p>       
       <?php  } // end of Group Based Show Area ?>
            



    <?php if(GetAccessRightsForThisSectionInERP($_SESSION['MM_UserGroup'],19,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(19,$database_Conn,$Conn)>=1) {?>  
       
<div id="CP_ERPReports" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Reports (Testing)</div>
        <div class="CollapsiblePanelContent">
         <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="hotel_reservation.php"><img src="images/cpanel/add-new-expense.png" width="56" height="53" border="0" /><br />
                    Reservations</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="hotel_client_details.php"><img src="images/cpanel/add-new-exp-account.png" width="56" height="53" border="0" /><br />
                    
                    Clients</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="hotel_client_payments_and_check_out.php"><img src="images/cpanel/view-expenses.png" alt="" width="56" height="53" border="0" /><br />
                    Client Payments</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="hotel_client_reports.php"><img src="images/cpanel/view-specific-date-expenses-report.png" width="56" height="53" border="0" /><br />
                    Reports</a></div>
                </div></td>
              </tr>
            </table>
          </div>
        </div>
    </div>
    <p>&nbsp;</p>
       <?php  } // end of Group Based Show Area ?>   


              
       <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],20,$database_Conn,$Conn)>=1 || Get_Allow_Everyone_AccessessRights(20,$database_Conn,$Conn)>=1) {?>  

     <div id="CP_EnterpriseMessagingSystem" class="CollapsiblePanel">
       <div class="CollapsiblePanelTab" tabindex="0">Enterprise Messaging System</div>
        <div class="CollapsiblePanelContent">
         <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="ems_send_messages.php"><img src="images/cpanel/message2.gif" alt="Send EMS Message to Other User" width="56" height="53" border="0" /><br />
                  Send<br />
Message</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="ems_view_messages.php"><img src="images/cpanel/messages.gif" alt="View Messages in your inbox" width="56" height="53" border="0" /><br />
                     View Messages</a></div>
                </div></td>
                <td width="90" align="center">&nbsp;</td>
                <td width="90" align="center">&nbsp;</td>
              </tr>
            </table>
          </div>
        </div>
  </div>
    <p>&nbsp;</p>
      <?php  } // end of Group Based Show Area ?> 
       


    <?php if(GetAccessRightsForThisSectionInERP($_SESSION['MM_UserGroup'],21,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(21,$database_Conn,$Conn)>=1) {?>  
       
<div id="CP_ERPTaskManagement" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Task Management</div>
        <div class="CollapsiblePanelContent">
         <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_taskmanagement.php"><img src="images/cpanel/add-new-expense.png" alt="Add A Task that you want to monitor" width="56" height="53" border="0" /><br />
                    Add Task</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_task_manag_update.php"><img src="images/cpanel/add-new-exp-account.png" alt="Update your Task Status" width="56" height="53" border="0" /><br />
                    
                    Update Tasks</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="erp_task_manag_update.php"><img src="images/cpanel/view-expenses.png" alt="Maintain Notes" width="56" height="53" border="0" /><br />
                    Notes</a></div>
                </div></td>
                <td width="90" align="center">&nbsp;</td>
              </tr>
            </table>
          </div>
        </div>
    </div>
    <p>&nbsp;</p>
       <?php  } // end of Group Based Show Area ?>   
        
    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],22,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(22,$database_Conn,$Conn)>=1) {?>  
       
    <div id="CP_ShipmentTrakingSystem" class="CollapsiblePanel">
      <div class="CollapsiblePanelTab" tabindex="0">Shipment Tracking System</div>
      <div class="CollapsiblePanelContent">
                <div align="center" class="CPanelTableView">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_shipment.php"><img src="images/cpanel/add-new-expense.png" alt="Management your Shipment Tracking" width="56" height="53" border="0" /><br />
                  Shipment</a></div>
                </div></td>
              <td width="90" align="center"><div class="roundedmenubox"> <a href="erp_shipment_transaction.php"><img src="images/cpanel/add-new-exp-account.png" alt="Shipment Transactions" width="56" height="53" border="0" /><br />
                
                Transactions</a></div></td>
              <td width="90" align="center"><div class="roundedmenubox"> <a href="erp_tracking.php"><img src="images/cpanel/add-new-exp-account.png" alt="Track your shipments" width="56" height="53" border="0" /><br />
                
                Tracking</a></div></td>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><br />
                  </div>
                </div></td>
              </tr>            
          </table>
        </div>
      
      
      </div>
    </div>
        <p>&nbsp;</p>
      <?php  } // end of Group Based Show Area ?>   


    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],23,$database_Conn,$Conn)>=1  || Get_Allow_Everyone_AccessessRights(23,$database_Conn,$Conn)>=1) {?> 

<div id="CP_EmployeeManagement" class="CollapsiblePanel">
      <div class="CollapsiblePanelTab" tabindex="0">Employee Management System</div>
      <div class="CollapsiblePanelContent">
      <div align="center" class="CPanelTableView">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_emp_location.php"><img src="images/cpanel/add-news.png" alt="Employee Location" width="56" height="53" border="0" /><br />
                  Location</a></div>
                </div></td>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_emp_position.php"><img src="images/cpanel/add-new-exp-account.png" alt="Employee Position" width="56" height="53" border="0" /><br />
                  
                  Position</a></div>
                </div></td>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_add_emp_details.php"><img src="images/cpanel/view-expenses.png" alt="Employee Details" width="56" height="53" border="0" /><br />
                  Employee<br />
Deatils</a></div>
                </div></td>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="erp_emp_bank_details.php"><img src="images/cpanel/view-specific-date-expenses-report.png" alt="Employee Bank Details" width="56" height="53" border="0" /><br />
                  Employee <br />
                  Bank Details</a></div>
                </div></td>
              </tr>
            <!-- 2nd row -->
            <tr>
              <td>
                <div class="roundedmenubox">
                  <div align="center"><a href="erp_emp_atandance_in.php"><img src="images/cpanel/view-specific-date-expenses-report.png" alt="Employee Atandance Signin" width="56" height="53" border="0" /><br />
                    Atandance<br />
                    (Signin)</a></div>
                  </div>
                </td>
              
              <td>
                <div class="roundedmenubox">
                  <div align="center"><a href="erp_emp_atandance_out.php"><img src="images/cpanel/view-specific-date-expenses-report.png" alt="Employee Atandance Signout" width="56" height="53" border="0" /><br />
                    Atandance <br />
                    (Signout)</a></div>
                  </div>
                </td>
              <td>
                <div class="roundedmenubox">
                  <div align="center"><a href="erp_emp_dependent.php"><img src="images/cpanel/view-specific-date-expenses-report.png" alt="Employee Children and other dependents" width="56" height="53" border="0" /><br />
                    Employee <br />
                    Dependents</a></div>
                  </div>
                </td>
              <td>
                <div class="roundedmenubox">
                  <div align="center"><a href="erp_emp_salary.php"><img src="images/cpanel/view-specific-date-expenses-report.png" alt="Employee Salary" width="56" height="53" border="0" /><br />
                    Employee<br />
                    Salary </a></div>
                  </div>
                </td>
            </tr>
             <!-- 3rd row -->
            <tr>
              <td>
                <div class="roundedmenubox">
                  <div align="center"><a href="erp_employee_salary.php"><img src="images/cpanel/by_name_salary.png" alt="BY Emp Salary" width="56" height="53" border="0" /><br />
                    ByEmployee Name<br />
                    Salary Detail</a></div>
                  </div>
                </td>
              
              <td>
                <div class="roundedmenubox">
                  <div align="center"><a href="erp_bymonth_emp_salary.php"><img src="images/cpanel/by_month_salary.png" alt="By Month Emp Salary" width="56" height="53" border="0" /><br />
                    ByMonth Employee <br />
                    Salary Detail</a></div>
                  </div>
                </td>
              <td>
                <div class="roundedmenubox">
                  <div align="center"><a href="erp_byyear_emp_salary.php"><img src="images/cpanel/by_year_salary.png" alt="By Year Emp Salary" width="56" height="53" border="0" /><br />
                    ByYear Employee <br />
                    Salary Detail</a></div>
                  </div>
                </td>
              <td>
                <div class="roundedmenubox">
                  <div align="center"><a href="erp_bydate_name_emp_salary.php"><img src="images/cpanel/by_date_name_salary.png" alt="By Date Emp Salary" width="56" height="53" border="0" /><br />
                    ByDate and Name<br />
                    Salary Detail </a></div>
                  </div>
                </td>
            </tr>
            </table>
        </div>
      
      </div>
    </div>
      <?php  } // end of Group Based Show Area ?>   

       
       
       
 
       
       
    </div>
  </div>
</div>
<script type="text/javascript">
    var CP_HotelManagementSystem = new Spry.Widget.CollapsiblePanel("CP_HotelManagementSystem"); 
	var CP_ERPConfigSetup = new Spry.Widget.CollapsiblePanel("CP_ERPConfigSetup");
	var CP_ERP_Purchase_Order_and_Invoice_Proforma = new Spry.Widget.CollapsiblePanel("CP_ERP_Purchase_Order_and_Invoice_Proforma");	
	var CP_ERPSalesOrders = new Spry.Widget.CollapsiblePanel("CP_ERPSalesOrders");
	var CP_ERPSalesOrderProcessing = new Spry.Widget.CollapsiblePanel("CP_ERPSalesOrderProcessing");
	var CP_ERPInventory = new Spry.Widget.CollapsiblePanel("CP_ERPInventory");
	var CP_ERPAccountingSystem = new Spry.Widget.CollapsiblePanel("CP_ERPAccountingSystem");	
    var CP_ERPDeliveryOrderForm = new Spry.Widget.CollapsiblePanel("CP_ERPDeliveryOrderForm");
	var CP_ERPProductionUnit = new Spry.Widget.CollapsiblePanel("CP_ERPProductionUnit");	
	var CP_ERPWearhouseDeliveryForm = new Spry.Widget.CollapsiblePanel("CP_ERPWearhouseDeliveryForm");
	var CP_ERPReports = new Spry.Widget.CollapsiblePanel("CP_ERPReports");
    var CP_EnterpriseMessagingSystem = new Spry.Widget.CollapsiblePanel("CP_EnterpriseMessagingSystem");
    var CP_ERPTaskManagement = new Spry.Widget.CollapsiblePanel("CP_ERPTaskManagement");
	var CP_ShipmentTrakingSystem = new Spry.Widget.CollapsiblePanel("CP_ShipmentTrakingSystem");
	var CollapsiblePanel4_ERPSetup = new Spry.Widget.CollapsiblePanel("CP_EmployeeManagement");


</script>
