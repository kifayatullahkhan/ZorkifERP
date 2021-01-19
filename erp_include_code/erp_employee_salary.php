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
$query_RS_EmployeeSalary = "SELECT * FROM erp_employee_details";
$RS_EmployeeSalary = mysql_query($query_RS_EmployeeSalary, $Conn) or die(mysql_error());
$row_RS_EmployeeSalary = mysql_fetch_assoc($RS_EmployeeSalary);
$totalRows_RS_EmployeeSalary = mysql_num_rows($RS_EmployeeSalary);
?>
<div class="1">
<h2>ByName Employee Salary Detail</h2>
  <form id="form1" name="form1" method="post" action="erp_employee_salary_detail.php">
    <table border="1">
      <tr>
        <th>EmployeeName</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="EmployeeName"></label>
             <input name="CustomerName" type="hidden" value="<?php echo $row_RS_EmployeeSalary['EmployeeID']; ?>" size="50" readonly="readonly"/>
            <select name="EmployeeName" id="EmployeeName">
             <?php do { ?>
           <option value="<?php echo $row_RS_EmployeeSalary['EmployeeID']; ?>" ><?php echo $row_RS_EmployeeSalary['EmployeeName']; ?></option>
          <?php }  while ($row_RS_EmployeeSalary = mysql_fetch_assoc($RS_EmployeeSalary)); ?>
          </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next" /></td>
        </tr>
        <?php } while ($row_RS_EmployeeSalary = mysql_fetch_assoc($RS_EmployeeSalary)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_EmployeeSalary);
?>
