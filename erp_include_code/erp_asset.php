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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO asset (AssetName, AssetValue, Depreciation) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['AssetName'], "text"),
                       GetSQLValueString($_POST['AssetValue'], "int"),
                       GetSQLValueString($_POST['Depreciation'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM asset WHERE AssetID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE asset SET AssetName=%s, AssetValue=%s, Depreciation=%s WHERE AssetID=%s",
                       GetSQLValueString($_POST['AssetName'], "text"),
                       GetSQLValueString($_POST['AssetValue'], "int"),
                       GetSQLValueString($_POST['Depreciation'], "text"),
                       GetSQLValueString($_POST['AssetID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

mysql_select_db($database_Conn, $Conn);
$query_RS_ShowAllAsset = "SELECT * FROM asset";

//Seach Code Start
if(isset($_POST['txtSearch']) && strlen($_POST['txtSearch'])>0) {
	
$query_RS_ShowAllAsset= "SELECT * FROM asset WHERE AssetName Like '%" . $_POST['txtSearch'] ."'";		
}
//Search Code End

$RS_ShowAllAsset = mysql_query($query_RS_ShowAllAsset, $Conn) or die(mysql_error());
$row_RS_ShowAllAsset = mysql_fetch_assoc($RS_ShowAllAsset);
$totalRows_RS_ShowAllAsset = mysql_num_rows($RS_ShowAllAsset);

$colname_RS_GetSelectedAsset = "-1";
if (isset($_GET['EditID'])) {
  $colname_RS_GetSelectedAsset = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RS_GetSelectedAsset = sprintf("SELECT * FROM asset WHERE AssetID = %s", GetSQLValueString($colname_RS_GetSelectedAsset, "int"));
$RS_GetSelectedAsset = mysql_query($query_RS_GetSelectedAsset, $Conn) or die(mysql_error());
$row_RS_GetSelectedAsset = mysql_fetch_assoc($RS_GetSelectedAsset);
$totalRows_RS_GetSelectedAsset = mysql_num_rows($RS_GetSelectedAsset);

?>
<?php if ($totalRows_RS_GetSelectedAsset == 0) { // Show if recordset empty ?>
  <div class="1">
    <h2>Asset Detail</h2>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">AssetName:</td>
          <td><input type="text" name="AssetName" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">AssetValue:</td>
          <td><input type="text" name="AssetValue" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Depreciation:</td>
          <td><input type="text" name="Depreciation" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Insert record" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
  </div>
  <?php } // Show if recordset empty ?>
<?php if ($totalRows_RS_GetSelectedAsset > 0) { // Show if recordset not empty ?>
  <div class="1">
    <h2>Edit Asset Detail</h2>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">AssetName:</td>
          <td><input type="text" name="AssetName" value="<?php echo htmlentities($row_RS_GetSelectedAsset['AssetName'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">AssetValue:</td>
          <td><input type="text" name="AssetValue" value="<?php echo htmlentities($row_RS_GetSelectedAsset['AssetValue'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Depreciation:</td>
          <td><input type="text" name="Depreciation" value="<?php echo htmlentities($row_RS_GetSelectedAsset['Depreciation'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Update record" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form2" />
      <input type="hidden" name="AssetID" value="<?php echo $row_RS_GetSelectedAsset['AssetID']; ?>" />
    </form>
  </div>
  <?php } // Show if recordset not empty ?>
<div class="1">
<form action="" method="post" name="FrmSearch" id="FrmSearch">
    <label for="txtSearch">Enter Text to Search</label>
    <input type="text" name="txtSearch" id="txtSearch">
    <input type="submit" name="BtnSearch" id="BtnSearch" value="Search">
    (Do blank search to show all records)
  </form>
</div>
&nbsp;
<div class="1">
  <table border="1">
    <tr>
      <th colspan="2">Action</th>
      <th>AssetName</th>
      <th>AssetValue</th>
      <th>Depreciation</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><a href="?DeleteID=<?php echo $row_RS_ShowAllAsset['AssetID']; ?>">Delete</a></td>
        <td><a href="?EditID=<?php echo $row_RS_ShowAllAsset['AssetID']; ?>">Edit</a></td>
        <td><?php echo $row_RS_ShowAllAsset['AssetName']; ?></td>
        <td><?php echo $row_RS_ShowAllAsset['AssetValue']; ?></td>
        <td><?php echo $row_RS_ShowAllAsset['Depreciation']; ?></td>
      </tr>
      <?php } while ($row_RS_ShowAllAsset = mysql_fetch_assoc($RS_ShowAllAsset)); ?>
  </table>
</div>
<div class="1"></div>
<?php
mysql_free_result($RS_ShowAllAsset);

mysql_free_result($RS_GetSelectedAsset);
?>
