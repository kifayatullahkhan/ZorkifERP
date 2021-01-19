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
$query_RS_CustomerName = "SELECT * FROM erp_customers";
$RS_CustomerName = mysql_query($query_RS_CustomerName, $Conn) or die(mysql_error());
$row_RS_CustomerName = mysql_fetch_assoc($RS_CustomerName);
$totalRows_RS_CustomerName = mysql_num_rows($RS_CustomerName);
?>
<div class="1">
<h2>By Customer Name Sale Detail</h2>
  <form name="form1" method="post" action="erp_customer_sale_detail.php">
    <table border="1">
      <tr>
        <th>CustomerName</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="CustomerName"></label>
             <input name="CustomerName" type="hidden" value="<?php echo $row_RS_CustomerName['CustomerID']; ?>" size="50" readonly="readonly"/>
            <select name="CustomerName" id="CustomerName">
            <?php do {  ?>
           <option value="<?php echo $row_RS_CustomerName['CustomerID']; ?>" ><?php echo $row_RS_CustomerName['CustomerName']; ?></option>
          <?php } while ($row_RS_CustomerName = mysql_fetch_assoc($RS_CustomerName));?>
          </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_CustomerName = mysql_fetch_assoc($RS_CustomerName)); ?>
    </table>
  </form>
</div>
<?Php
mysql_free_result($RS_CustomerName);
?>
