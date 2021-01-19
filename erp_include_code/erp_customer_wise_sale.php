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
$query_RS_SelectCustomer = "SELECT * FROM erp_customers";
$RS_SelectCustomer = mysql_query($query_RS_SelectCustomer, $Conn) or die(mysql_error());
$row_RS_SelectCustomer = mysql_fetch_assoc($RS_SelectCustomer);
$totalRows_RS_SelectCustomer = mysql_num_rows($RS_SelectCustomer);

mysql_select_db($database_Conn, $Conn);
$query_RS_SelectItem = "SELECT * FROM erp_inventoryitems";
$RS_SelectItem = mysql_query($query_RS_SelectItem, $Conn) or die(mysql_error());
$row_RS_SelectItem = mysql_fetch_assoc($RS_SelectItem);
$totalRows_RS_SelectItem = mysql_num_rows($RS_SelectItem);
?>
<h2>Customer and Item Sales Detail </h2>
<div class="1">
  <form name="form1" method="post" action="erp_customer_wise_sale_detail.php">
    <table width="200" border="1">
      <tr>
        <th>CustomerName</th>
        <th>Item Description</th>
        <th>&nbsp;</th>
      </tr>
      <tr>
        <td><?php do { ?>
        <label for="CustomerName"></label>
        <input name="CustomerName" type="hidden" value="<?php echo $row_RS_SelectCustomer['CustomerID']; ?>" size="50" readonly="readonly"/>
          <select name="CustomerName" id="CustomerName">
          <?php do {  ?>
           <option value="<?php echo $row_RS_SelectCustomer['CustomerID']; ?>" ><?php echo $row_RS_SelectCustomer['CustomerName']; ?></option>
          <?php }  while ($row_RS_SelectCustomer = mysql_fetch_assoc($RS_SelectCustomer));?>
        </select>
         <?php } while ($row_RS_SelectCustomer = mysql_fetch_assoc($RS_SelectCustomer)); ?>
        </td>
        <td>
           <?php do { ?>
        <label for="ItemName"></label>
         <input name="ItemName" type="hidden" value="<?php echo $row_RS_SelectItem['InvItemID']; ?>" size="50" readonly="readonly"/>
          <select name="ItemName" id="ItemName">
          <?php do {  ?>
           <option value="<?php echo $row_RS_SelectItem['InvItemID']; ?>" ><?php echo $row_RS_SelectItem['InvItemDescription']; ?></option>
          <?php }  while ($row_RS_SelectItem = mysql_fetch_assoc($RS_SelectItem)); ?>
        </select>
         <?php } while ($row_RS_SelectItem = mysql_fetch_assoc($RS_SelectItem)); ?>
        </td>
        <td align="right"><input type="submit" name="submit" id="submit" value="Next" /></td>
      </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_SelectCustomer);

mysql_free_result($RS_SelectItem);
?>
