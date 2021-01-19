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
$query_RS_AssetDetail = "SELECT * FROM asset";
$RS_AssetDetail = mysql_query($query_RS_AssetDetail, $Conn) or die(mysql_error());
$row_RS_AssetDetail = mysql_fetch_assoc($RS_AssetDetail);
$totalRows_RS_AssetDetail = mysql_num_rows($RS_AssetDetail);
?>
<div class="1">
<h2> Total Asset Value </h2>
  <form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
      <tr>
        <td><strong>SystemDate</strong></td>
        <td><strong><?php echo date('d-m-Y'); ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<div class="1">
  <form id="form2" name="form2" method="post" action="">
    <table border="1">
      <tr>
        <th>AssetName</th>
        <th>AssetValue</th>
        <th>Depreciation</th>
      </tr>
      <?php $TotalAsset=0; $TotalDep=0; do { ?>
        <tr>
          <td><?php echo $row_RS_AssetDetail['AssetName']; ?></td>
          <td><?php echo $row_RS_AssetDetail['AssetValue']; ?></td>
          <td><?php echo $row_RS_AssetDetail['Depreciation']; ?></td>
        </tr>
        <?php $TotalAsset=$TotalAsset+$row_RS_AssetDetail['AssetValue'];?>
        <?php $TotalDep=$TotalDep+$row_RS_AssetDetail['Depreciation'];?>
        <?php } while ($row_RS_AssetDetail = mysql_fetch_assoc($RS_AssetDetail)); ?>
        <tr>
          <td><strong>TotalAssetValue</strong></td>
          <td><strong><?php echo $TotalAsset;?></strong></td>
          <td><strong><?php echo $TotalDep;?></strong></td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_AssetDetail);
?>
