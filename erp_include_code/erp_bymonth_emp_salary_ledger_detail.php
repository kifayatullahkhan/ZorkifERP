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

//From POST
$Month= $_POST['SalaryMonth'];
$Year= $_POST['SalaryYear'];
//Form POST

mysql_select_db($database_Conn, $Conn);
$query_RS_EmpSalary = "SELECT erp_employee_details.EmployeeName, erp_employee_salary.SalaryMonth, erp_employee_salary.SalaryYear, erp_employee_details.EmploymentDate, erp_employee_salary.PaymentStatus, erp_employee_details.Commession , erp_employee_salary.BasicSalaryAmount, erp_employee_salary.BonusSalaryAmount, erp_employee_salary.OverTimeSalaryAmount,  erp_employee_salary.DeductionFromSalaryAmount, erp_employee_salary.TaxRate, erp_employee_salary.NetPaySalaryAmount  FROM erp_employee_salary  JOIN  erp_employee_details ON erp_employee_salary.EmployeeID = erp_employee_details.EmployeeID WHERE erp_employee_salary.PaymentStatus = 'DONE' AND erp_employee_salary.SalaryMonth = '$Month' AND erp_employee_salary.SalaryYear ='$Year'";
$RS_EmpSalary = mysql_query($query_RS_EmpSalary, $Conn) or die(mysql_error());
$row_RS_EmpSalary = mysql_fetch_assoc($RS_EmpSalary);
$totalRows_RS_EmpSalary = mysql_num_rows($RS_EmpSalary);
?>
<div class="1">
<h2>ByMonth Employee Salary Ledger Detail</h2>
  <form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>SalaryMonth</strong></td>
        <td><strong><?php echo $row_RS_EmpSalary['SalaryMonth']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>SalaryYear</strong></td>
        <td><strong><?php echo $row_RS_EmpSalary['SalaryYear']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>PaymentStatus</strong></td>
        <td><strong><?php echo $row_RS_EmpSalary['PaymentStatus']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>SystemDate</strong></td>
        <td><strong><?php echo date('d-m-Y'); ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<div class="1">
  <form id="form2" name="form2" method="post" action="">
    <table border="1">
      <tr>
        <th>EmployeeName </th>
        <th>EmploymentDate</th>
        <th>Debit</th>
        <th>Credit</th>
      </tr>
      <?php $Debit=0; $S_Debit=0; $S_Credit=0;  do { ?>
        <tr> 
          <td><?php echo $row_RS_EmpSalary['EmployeeName']; ?></td>
          <td><?php echo $row_RS_EmpSalary['EmploymentDate']; ?></td>
          <td><?php $Debit['Debit']; ?></td>
          <td><?php echo $row_RS_EmpSalary['NetPaySalaryAmount']; ?></td>
        </tr>
        <?php $S_Debit=$S_Debit+$Debit['Debit'];?>
        <?php $S_Credit=$S_Credit+$row_RS_EmpSalary['NetPaySalaryAmount']; ?>
        <?php } while ($row_RS_EmpSalary = mysql_fetch_assoc($RS_EmpSalary)); ?>
        <tr>
          <td>&nbsp;</td>
          <td><strong>Balance</strong></td>
          <td><strong>Dr : <?php echo $S_Debit; ?></strong></td>
          <td><strong>Cr : <?php echo $S_Credit; ?></strong></td>
        </tr>
    </table>
  </form>

</div>
<?php
mysql_free_result($RS_EmpSalary);
?>
