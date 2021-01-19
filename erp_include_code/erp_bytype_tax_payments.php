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
$query_RS_ByTaxTypePayments = "SELECT * FROM erp_tax_payment_types";
$RS_ByTaxTypePayments = mysql_query($query_RS_ByTaxTypePayments, $Conn) or die(mysql_error());
$row_RS_ByTaxTypePayments = mysql_fetch_assoc($RS_ByTaxTypePayments);
$totalRows_RS_ByTaxTypePayments = mysql_num_rows($RS_ByTaxTypePayments);
?>
<div class="1">
<h2>By Tax Type Tax Payment Details</h2>
  <form name="form1" method="post" action="erp_bytype_tax_payments_detial.php">
    <table border="1">
      <tr>
        <th>TaxType</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="TaxType"></label>
            <input name="TaxType" type="hidden" value="<?php echo $row_RS_ByTaxTypePayments['TaxTypeID']; ?>" size="50" readonly="readonly" />
            <select name="TaxType" id="TaxType">
            <?php do {  ?>
           <option value="<?php echo $row_RS_ByTaxTypePayments['TaxTypeID']; ?>" ><?php echo $row_RS_ByTaxTypePayments['TaxType']; ?></option>
          <?php }  while ($row_RS_ByTaxTypePayments = mysql_fetch_assoc($RS_ByTaxTypePayments));?>
            </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_ByTaxTypePayments = mysql_fetch_assoc($RS_ByTaxTypePayments)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ByTaxTypePayments);
?>
