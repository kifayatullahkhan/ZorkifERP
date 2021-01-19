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
$query_RS_SaleOrderRefNo = "SELECT * FROM erp_customerpayments";
$RS_SaleOrderRefNo = mysql_query($query_RS_SaleOrderRefNo, $Conn) or die(mysql_error());
$row_RS_SaleOrderRefNo = mysql_fetch_assoc($RS_SaleOrderRefNo);
$totalRows_RS_SaleOrderRefNo = mysql_num_rows($RS_SaleOrderRefNo);
?>
<div class="1">
<h2>By Order Reference No. Sale Payment Detail</h2>
  <form name="form1" method="post" action="erp_order_no_sale_payment_detail.php">
    <table border="1">
      <tr>
        <th>OrderReferenceNo</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="OrderReferenceNo"></label>
            <input name="OrderReferenceNo" type="hidden" value="<?php echo $row_RS_SaleOrderRefNo['CustomerPaymentID']; ?>" size="50" readonly="readonly" />
            <select name="OrderReferenceNo" id="OrderReferenceNo">
            <?php do {  ?>
           <option value="<?php echo $row_RS_SaleOrderRefNo['CustomerPaymentID']; ?>" ><?php echo $row_RS_SaleOrderRefNo['OrderReferenceNo']; ?></option>
          <?php } while ($row_RS_SaleOrderRefNo = mysql_fetch_assoc($RS_SaleOrderRefNo)); ?>
          </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_SaleOrderRefNo = mysql_fetch_assoc($RS_SaleOrderRefNo)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_SaleOrderRefNo);
?>
