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
$query_RS_WareHouse = "SELECT * FROM erp_werehouses";
$RS_WareHouse = mysql_query($query_RS_WareHouse, $Conn) or die(mysql_error());
$row_RS_WareHouse = mysql_fetch_assoc($RS_WareHouse);
$totalRows_RS_WareHouse = mysql_num_rows($RS_WareHouse);
?>
<div class="1">
<h2>WareHouse Stock Position </h2>
  <form name="form1" method="post" action="erp_warehouse_stock_position_detail.php">
    <table border="1">
      <tr>
        <th>From</th>
        <th>To</th>
        <th>WHName</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td><label for="From"></label>
        <input type="text" name="From" id="From" onfocus="showCalendarControl(this);" value="<?php echo date("d-m-Y"); ?>"></td>
          <td><label for="To"></label>
        <input type="text" name="To" id="To" onfocus="showCalendarControl(this);" value="<?php echo date("d-m-Y"); ?>"></td>
          <td>
            <label for="WHName"></label>
            <input name="WHName" type="hidden" value="<?php echo $row_RS_WareHouse['WHID']; ?>" size="50" readonly="readonly"/>
            <select name="WHName" id="WHName">
            <?php do {  ?>
           <option value="<?php echo $row_RS_WareHouse['WHID']; ?>" ><?php echo $row_RS_WareHouse['WHName']; ?></option>
          <?php }  while ($row_RS_WareHouse = mysql_fetch_assoc($RS_WareHouse)); ?>
          </select></td>
          <td><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_WareHouse = mysql_fetch_assoc($RS_WareHouse)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_WareHouse);
?>
