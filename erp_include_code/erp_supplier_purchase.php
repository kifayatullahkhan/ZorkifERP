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
$query_RS_SelectSupplier = "SELECT * FROM erp_supplierscompanies";
$RS_SelectSupplier = mysql_query($query_RS_SelectSupplier, $Conn) or die(mysql_error());
$row_RS_SelectSupplier = mysql_fetch_assoc($RS_SelectSupplier);
$totalRows_RS_SelectSupplier = mysql_num_rows($RS_SelectSupplier);
?>
<div class="1">
<h2>By Supplier Name Purchase Detail</h2>
  <form id="form1" name="form1" method="post" action="erp_supplier_purchase_detail.php">
    <table border="1">
      <tr>
        <th>SupplierName</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
          <label for="SupplierName"></label>
          <input name="SupplierName" type="hidden" value="<?php echo $row_RS_SelectSupplier['SupplierID']; ?>" size="50" readonly="readonly" />
          
          <select name="SupplierName" id="SupplierName">
         <?php do { ?>
           <option value="<?php echo $row_RS_SelectSupplier['SupplierID']; ?>" ><?php echo $row_RS_SelectSupplier['SupplierName']; ?></option>
          <?php }  while ($row_RS_SelectSupplier = mysql_fetch_assoc($RS_SelectSupplier));?>
        </select>
          </td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next" /></td>
        </tr>
        <?php } while ($row_RS_SelectSupplier = mysql_fetch_assoc($RS_SelectSupplier)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_SelectSupplier);
?>
