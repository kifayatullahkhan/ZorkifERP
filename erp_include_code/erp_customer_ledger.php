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
$query_RS_CustomerLedger = "SELECT * FROM erp_customers";
$RS_CustomerLedger = mysql_query($query_RS_CustomerLedger, $Conn) or die(mysql_error());
$row_RS_CustomerLedger = mysql_fetch_assoc($RS_CustomerLedger);
$totalRows_RS_CustomerLedger = mysql_num_rows($RS_CustomerLedger);
?>
<div class="1">
<h2>By Date Customer Ledger</h2>
  <form name="form1" method="post" action="erp_customer_ledger_detail.php">
    <table border="1">
      <tr>
        <th>From</th>
        <th>To</th>
        <th>CustomerName</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td><label for="From"></label>
        <input type="text" name="From" id="From" onfocus="showCalendarControl(this);" value="<?php echo date("d-m-Y"); ?>"></td>
          <td><label for="To"></label>
        <input type="text" name="To" id="To" onfocus="showCalendarControl(this);" value="<?php echo date("d-m-Y"); ?>"></td>
          <td>
            <label for="CustomerName"></label>
            <input name="CustomerName" type="hidden" value="<?php echo $row_RS_CustomerLedger['CustomerID']; ?>" size="50" readonly="readonly"/>
            <select name="CustomerName" id="CustomerName">
            <?php do {  ?>
           <option value="<?php echo $row_RS_CustomerLedger['CustomerID']; ?>" ><?php echo $row_RS_CustomerLedger['CustomerName']; ?></option>
          <?php }  while ($row_RS_CustomerLedger = mysql_fetch_assoc($RS_CustomerLedger)); ?>
            </select></td>
          <td><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_CustomerLedger = mysql_fetch_assoc($RS_CustomerLedger)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_CustomerLedger);
?>
