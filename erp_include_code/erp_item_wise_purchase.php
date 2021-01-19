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
$query_RS_ItemWisePurchase = "SELECT * FROM erp_productionitems";
$RS_ItemWisePurchase = mysql_query($query_RS_ItemWisePurchase, $Conn) or die(mysql_error());
$row_RS_ItemWisePurchase = mysql_fetch_assoc($RS_ItemWisePurchase);
$totalRows_RS_ItemWisePurchase = mysql_num_rows($RS_ItemWisePurchase);
?>
<div class="1">
<h2>Item Wise Purchase Detail </h2>
  <form name="form1" method="post" action="erp_item_wise_purchase_detail.php">
    <table border="1">
      <tr>
        <th>Item Description</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="ItemName"></label>
            <input name="ItemName" type="hidden" value="<?php echo $row_RS_ItemWisePurchase['PItemID']; ?>" size="50" readonly="readonly"/>
            <select name="ItemName" id="ItemName">
            <?php do { ?>
           <option value="<?php echo $row_RS_ItemWisePurchase['PItemID']; ?>" ><?php echo $row_RS_ItemWisePurchase['PItemDescription']; ?></option>
          <?php }  while ($row_RS_ItemWisePurchase = mysql_fetch_assoc($RS_ItemWisePurchase));?>
            </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_ItemWisePurchase = mysql_fetch_assoc($RS_ItemWisePurchase)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ItemWisePurchase);
?>
