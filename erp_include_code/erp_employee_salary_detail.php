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
$Emp_name= $_POST['EmployeeName'];
//Form POST

mysql_select_db($database_Conn, $Conn);
$query_RS_EmpSalary = "SELECT erp_employee_details.EmployeeName, erp_employee_salary.SalaryMonth, erp_employee_salary.SalaryYear, erp_employee_details.EmploymentDate, erp_employee_salary.PaymentStatus, erp_employee_details.Commession , erp_employee_salary.BasicSalaryAmount, erp_employee_salary.BonusSalaryAmount, erp_employee_salary.OverTimeSalaryAmount,  erp_employee_salary.DeductionFromSalaryAmount, erp_employee_salary.TaxRate, erp_employee_salary.NetPaySalaryAmount  FROM erp_employee_details  JOIN  erp_employee_salary ON erp_employee_salary.EmployeeID = '$Emp_name' WHERE erp_employee_salary.PaymentStatus = 'DONE' AND erp_employee_salary.EmployeeID = '$Emp_name' GROUP BY erp_employee_salary.SalaryMonth ";
$RS_EmpSalary = mysql_query($query_RS_EmpSalary, $Conn) or die(mysql_error());
$row_RS_EmpSalary = mysql_fetch_assoc($RS_EmpSalary);
$totalRows_RS_EmpSalary = mysql_num_rows($RS_EmpSalary);
?>
<div class="1">
<h2>ByName Employee Salary Detail</h2>
  <form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>EmployeeName</strong></td>
        <td><strong><?php echo $row_RS_EmpSalary['EmployeeName']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>EmploymentDate</strong></td>
        <td><strong><?php echo $row_RS_EmpSalary['EmploymentDate']; ?></strong></td>
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
        <th>SalaryMonth</th>
        <th>SalaryYear</th>
        <th>Commession</th>
        <th>BasicSalary</th>
        <th>BonusSalary</th>
        <th>OverTimeSalary</th>
        <th>DeductionFromSalary</th>
        <th>TaxRate</th>
        <th>NetPaySalaryAmount</th>
      </tr>
      <?php $Salary=0; do { ?>
        <tr>
          <td><?php echo $row_RS_EmpSalary['SalaryMonth']; ?></td>
          <td><?php echo $row_RS_EmpSalary['SalaryYear']; ?></td>
          <td><?php echo $row_RS_EmpSalary['Commession']; ?></td>
          <td><?php echo $row_RS_EmpSalary['BasicSalaryAmount']; ?></td>
          <td><?php echo $row_RS_EmpSalary['BonusSalaryAmount']; ?></td>
          <td><?php echo $row_RS_EmpSalary['OverTimeSalaryAmount']; ?></td>
          <td><?php echo $row_RS_EmpSalary['DeductionFromSalaryAmount']; ?></td>
          <td><?php echo $row_RS_EmpSalary['TaxRate']; ?></td>
          <td><?php echo $row_RS_EmpSalary['NetPaySalaryAmount']; ?></td>
        </tr>
        <?php $Salary=$Salary+$row_RS_EmpSalary['NetPaySalaryAmount']; ?>
        <?php } while ($row_RS_EmpSalary = mysql_fetch_assoc($RS_EmpSalary)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>TotalSalary</strong></td>
          <td><strong><?php echo $Salary; ?></strong></td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_EmpSalary);
?>
