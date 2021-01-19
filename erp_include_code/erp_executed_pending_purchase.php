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
$query_RS_ExePenPurchase = "SELECT erp_purchaseordersproformainvoice.OrderStatus FROM erp_purchaseordersproformainvoice group by erp_purchaseordersproformainvoice.OrderStatus";
$RS_ExePenPurchase = mysql_query($query_RS_ExePenPurchase, $Conn) or die(mysql_error());
$row_RS_ExePenPurchase = mysql_fetch_assoc($RS_ExePenPurchase);
$totalRows_RS_ExePenPurchase = mysql_num_rows($RS_ExePenPurchase);
?>
<div class="1">
<h2>Executed and Pending Purchase Orders Detail</h2>
  <form name="form1" method="post" action="erp_executed_pending_purchase_detail.php">
    <table border="1">
      <tr>
        <th>OrderStatus</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="OrderStatus"></label>
              <input name="ItemName" type="hidden" value="<?php echo $row_RS_ExePenPurchase['OrderStatus']; ?>" size="50" readonly="readonly"/>
            <select name="OrderStatus" id="OrderStatus">
             <?php do {  ?>
           <option value="<?php echo $row_RS_ExePenPurchase['OrderStatus']; ?>" ><?php echo $row_RS_ExePenPurchase['OrderStatus']; ?></option>
          <?php } while ($row_RS_ExePenPurchase = mysql_fetch_assoc($RS_ExePenPurchase)); ?>
          </select></td>
          <td align="right"><input type="submit" name="submit" id="submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_ExePenPurchase = mysql_fetch_assoc($RS_ExePenPurchase)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ExePenPurchase);
?>
