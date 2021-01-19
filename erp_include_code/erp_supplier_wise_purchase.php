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
$query_RS_SelectSupplier = "SELECT * FROM erp_supplierscompanies ";
$RS_SelectSupplier = mysql_query($query_RS_SelectSupplier, $Conn) or die(mysql_error());
$row_RS_SelectSupplier = mysql_fetch_assoc($RS_SelectSupplier);
$totalRows_RS_SelectSupplier = mysql_num_rows($RS_SelectSupplier);

mysql_select_db($database_Conn, $Conn);
$query_RS_SelectItem = "SELECT * FROM erp_productionitems";
$RS_SelectItem = mysql_query($query_RS_SelectItem, $Conn) or die(mysql_error());
$row_RS_SelectItem = mysql_fetch_assoc($RS_SelectItem);
$totalRows_RS_SelectItem = mysql_num_rows($RS_SelectItem);
?>
<div class="1">
<h2>Supplier And Item Purchase Detail</h2>
    <form id="form1" name="form1" method="post" action="erp_supplier_wise_purchase_detail.php">
    <table width="200" border="1">
      <tr>
        <th>PItemDescription</th>
        <th>SupplierName</th>
        <th>&nbsp;</th>
      </tr>
      
      
      <tr>
        <td>
         <?php do { ?>
       
        <label for="ItemName"></label>
           <input name="ItemName" type="hidden" value="<?php echo $row_RS_SelectItem['PItemID']; ?>" size="50" readonly="readonly"/>
          
          
          <select name="ItemName" id="ItemName">
        <?php do { ?>
           <option value="<?php echo $row_RS_SelectItem['PItemID']; ?>" ><?php echo $row_RS_SelectItem['PItemDescription']; ?></option>
          <?php }  while ($row_RS_SelectItem = mysql_fetch_assoc($RS_SelectItem)); ?>
        </select>
          
		  
		  <?php } while ($row_RS_SelectItem = mysql_fetch_assoc($RS_SelectItem)); ?>
        </td>
        
        
        
        <td>
          <?php do { ?>
        
        <label for="SupplierName"></label>
          <input name="SupplierName" type="hidden" value="<?php echo $row_RS_SelectSupplier['SupplierID']; ?>" size="50" readonly="readonly" />
          
          <select name="SupplierName" id="SupplierName">
         <?php do { ?>
           <option value="<?php echo $row_RS_SelectSupplier['SupplierID']; ?>" ><?php echo $row_RS_SelectSupplier['SupplierName']; ?></option>
          <?php }  while ($row_RS_SelectSupplier = mysql_fetch_assoc($RS_SelectSupplier));?>
        </select>
       
	   <?php } while ($row_RS_SelectSupplier = mysql_fetch_assoc($RS_SelectSupplier)); ?>
       </td>
        <td align="right"><input type="submit" name="Submit" id="Submit" value="Next" /></td>
      </tr>
    </table>
  </form>
</div>

<?php
mysql_free_result($RS_SelectSupplier);

mysql_free_result($RS_SelectItem);
?>

