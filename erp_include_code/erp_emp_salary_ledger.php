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
$query_RS_ByYearEmpSalary = "SELECT erp_employee_salary.SalaryYear FROM erp_employee_salary GROUP BY erp_employee_salary.SalaryYear ORDER by erp_employee_salary.SalaryYear ASC";
$RS_ByYearEmpSalary = mysql_query($query_RS_ByYearEmpSalary, $Conn) or die(mysql_error());
$row_RS_ByYearEmpSalary = mysql_fetch_assoc($RS_ByYearEmpSalary);
$totalRows_RS_ByYearEmpSalary = mysql_num_rows($RS_ByYearEmpSalary);
?>
<div class="1">
<h2>By Year All Employee Salary Ledger Detail</h2>
  <form name="form1" method="post" action="erp_emp_salary_ledger_detail.php">
    <table border="1">
      <tr>
        <th>SalaryYear</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="SalaryYear"></label>
            <input name="SalaryYear" type="hidden" value="<?php echo $row_RS_ByYearEmpSalary['SalaryYear']; ?>" size="50" readonly="readonly"/>
            <select name="SalaryYear" id="SalaryYear">
            <?php do { ?>
           <option value="<?php echo $row_RS_ByYearEmpSalary['SalaryYear']; ?>" ><?php echo $row_RS_ByYearEmpSalary['SalaryYear']; ?></option>
           <?php } while ($row_RS_ByYearEmpSalary = mysql_fetch_assoc($RS_ByYearEmpSalary)); ?>
          </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_ByYearEmpSalary = mysql_fetch_assoc($RS_ByYearEmpSalary)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ByYearEmpSalary);
?>
