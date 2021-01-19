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
$query_RS_HotelClient = "SELECT hotel_client_details.FullName FROM hotel_client_details";
$RS_HotelClient = mysql_query($query_RS_HotelClient, $Conn) or die(mysql_error());
$row_RS_HotelClient = mysql_fetch_assoc($RS_HotelClient);
$totalRows_RS_HotelClient = mysql_num_rows($RS_HotelClient);
?>
<div class="1">
<h2>By Client Name Hotel Details</h2>
  <form name="form1" method="post" action="erp_hotel_client_detail.php">
    <table border="1">
      <tr>
        <th>ClientName</th>
        <th>&nbsp;</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            <label for="FullName"></label>
            <input name="FullName" type="hidden" value="<?php echo $row_RS_HotelClient['FullName']; ?>" size="50" readonly="readonly"/>
            <select name="FullName" id="FullName">
            <?php do {  ?>
           <option value="<?php echo $row_RS_HotelClient['FullName']; ?>" ><?php echo $row_RS_HotelClient['FullName']; ?></option>
          <?php }  while ($row_RS_HotelClient = mysql_fetch_assoc($RS_HotelClient));?>
          </select></td>
          <td align="right"><input type="submit" name="Submit" id="Submit" value="Next"></td>
        </tr>
        <?php } while ($row_RS_HotelClient = mysql_fetch_assoc($RS_HotelClient)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_HotelClient);
?>
