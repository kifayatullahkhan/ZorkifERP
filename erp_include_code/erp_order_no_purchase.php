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
$query_RS_PurchasOrder = "SELECT * FROM erp_purchaseordersproformainvoice";
$RS_PurchasOrder = mysql_query($query_RS_PurchasOrder, $Conn) or die(mysql_error());
$row_RS_PurchasOrder = mysql_fetch_assoc($RS_PurchasOrder);
$totalRows_RS_PurchasOrder = mysql_num_rows($RS_PurchasOrder);
?>
<div class="1">
<h2>Order Refrence No Purchase Detail</h2>
  <form id="form1" name="form1" method="post" action="erp_order_no_purchase_detail.php">
    <table border="1">
      <tr>
        <th>OrderReferenceNo</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td><label for="OrderReferenceNo"></label>
             <input name="OrderReferenceNo" type="hidden" value="<?php echo $row_RS_PurchasOrder['POPIID']; ?>" size="50" readonly="readonly" />
            <select name="OrderReferenceNo" id="OrderReferenceNo">
            <?php do {  ?>
           <option value="<?php echo $row_RS_PurchasOrder['POPIID']; ?>" ><?php echo $row_RS_PurchasOrder['OrderReferenceNo']; ?></option>
          <?php } while ($row_RS_PurchasOrder = mysql_fetch_assoc($RS_PurchasOrder));?>
          </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next" /></td>
        </tr>
        <?php } while ($row_RS_PurchasOrder = mysql_fetch_assoc($RS_PurchasOrder)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_PurchasOrder);
?>
