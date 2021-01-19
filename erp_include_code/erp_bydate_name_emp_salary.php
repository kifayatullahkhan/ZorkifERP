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
$query_RS_ByNameSalary = "SELECT * FROM erp_employee_details";
$RS_ByNameSalary = mysql_query($query_RS_ByNameSalary, $Conn) or die(mysql_error());
$row_RS_ByNameSalary = mysql_fetch_assoc($RS_ByNameSalary);
$totalRows_RS_ByNameSalary = mysql_num_rows($RS_ByNameSalary);

mysql_select_db($database_Conn, $Conn);
$query_RS_ByMonthSalary = "SELECT erp_employee_salary.SalaryMonth FROM erp_employee_salary Group BY erp_employee_salary.SalaryMonth";
$RS_ByMonthSalary = mysql_query($query_RS_ByMonthSalary, $Conn) or die(mysql_error());
$row_RS_ByMonthSalary = mysql_fetch_assoc($RS_ByMonthSalary);
$totalRows_RS_ByMonthSalary = mysql_num_rows($RS_ByMonthSalary);

mysql_select_db($database_Conn, $Conn);
$query_RS_ByYearSalary = "SELECT erp_employee_salary.SalaryYear FROM erp_employee_salary Group By erp_employee_salary.SalaryYear ORDER by erp_employee_salary.SalaryYear ASC ";
$RS_ByYearSalary = mysql_query($query_RS_ByYearSalary, $Conn) or die(mysql_error());
$row_RS_ByYearSalary = mysql_fetch_assoc($RS_ByYearSalary);
$totalRows_RS_ByYearSalary = mysql_num_rows($RS_ByYearSalary);
?>
<div class="1">
<h2>ByDate and Name Employee Salary Detail</h2>
  <form id="form1" name="form1" method="post" action="erp_bydate_name_emp_salary_detail.php">
    <table width="200" border="1">
      <tr>
        <th>EmployeeName</th>
        <th>SalaryMonth</th>
        <th>SalaryYear</th>
        <th>&nbsp;</th>
      </tr>
      <tr>
        
        <!-- For Emp Name-->
        
        <td>
		<?php do { ?>
            <label for="EmployeeName"></label>
            <input name="EmployeeName" type="hidden" value="<?php echo $row_RS_ByNameSalary['EmployeeID']; ?>" size="50" readonly="readonly"/>
            <select name="EmployeeName" id="EmployeeName">
            <?php do {  ?>
           <option value="<?php echo $row_RS_ByNameSalary['EmployeeID']; ?>" ><?php echo $row_RS_ByNameSalary['EmployeeName']; ?></option>
          <?php }  while ($row_RS_ByNameSalary = mysql_fetch_assoc($RS_ByNameSalary));?>
          </select>
          <?php }while ($row_RS_ByNameSalary = mysql_fetch_assoc($RS_ByNameSalary)); ?>
          </td>
        
        <!-- For Salary Month-->
       
        <td>
		<?php do { ?>
            <label for="SalaryMonth"></label>
            <input name="SalaryMonth" type="hidden" value="<?php echo $row_RS_ByMonthSalary['SalaryMonth']; ?>" size="50" readonly="readonly"/>
            <select name="SalaryMonth" id="SalaryMonth">
            <?php do {  ?>
           <option value="<?php echo $row_RS_ByMonthSalary['SalaryMonth']; ?>" ><?php echo $row_RS_ByMonthSalary['SalaryMonth']; ?></option>
          <?php }  while ($row_RS_ByMonthSalary = mysql_fetch_assoc($RS_ByMonthSalary));?>
          </select>
          <?php } while ($row_RS_ByMonthSalary = mysql_fetch_assoc($RS_ByMonthSalary)); ?>
          </td>
        
        <!-- For salary Year-->
        
        <td>
		<?php do { ?>
        <label for="SalaryYear"></label>
        <input name="SalaryYear" type="hidden" value="<?php echo $row_RS_ByYearSalary['SalaryYear']; ?>" size="50" readonly="readonly"/>
            <select name="SalaryYear" id="SalaryYear">
            <?php do {  ?>
           <option value="<?php echo $row_RS_ByYearSalary['SalaryYear']; ?>" ><?php echo $row_RS_ByYearSalary['SalaryYear']; ?></option>
          <?php }   while ($row_RS_ByYearSalary = mysql_fetch_assoc($RS_ByYearSalary));?>
          </select>
        <?php }  while ($row_RS_ByYearSalary = mysql_fetch_assoc($RS_ByYearSalary)); ?>
        </td>
        
        <!-- Form submition-->
        
        <td align="right"><input type="submit" name="Submit" id="Submit" value="Next" /></td>
        
      </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ByNameSalary);

mysql_free_result($RS_ByMonthSalary);

mysql_free_result($RS_ByYearSalary);
?>