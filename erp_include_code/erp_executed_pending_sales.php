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
$query_RS_ExePenSales = "SELECT erp_customerorders.OrderStatus FROM erp_customerorders GROUP BY erp_customerorders.OrderStatus";
$RS_ExePenSales = mysql_query($query_RS_ExePenSales, $Conn) or die(mysql_error());
$row_RS_ExePenSales = mysql_fetch_assoc($RS_ExePenSales);
$totalRows_RS_ExePenSales = mysql_num_rows($RS_ExePenSales);
?>
<div class="1">
<h2>Executed and Pending Sales Orders Detail</h2>
  <form name="form1" method="post" action="erp_executed_pending_sales_detail.php">
    <table border="1">
      <tr>
        <th>OrderStatus</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="OrderStatus"></label>
            <input name="OrderStatus" type="hidden" value="<?php echo $row_RS_ExePenSales['OrderStatus']; ?>" size="50" readonly="readonly"/>
            <select name="OrderStatus" id="OrderStatus">
            <?php do {  ?>
           <option value="<?php echo $row_RS_ExePenSales['OrderStatus']; ?>" ><?php echo $row_RS_ExePenSales['OrderStatus']; ?></option>
          
		  <?php } while ($row_RS_ExePenSales = mysql_fetch_assoc($RS_ExePenSales));?>
          </select></td>
          <td align="right"><input type="submit" name="submit" id="submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_ExePenSales = mysql_fetch_assoc($RS_ExePenSales)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ExePenSales);
?>
