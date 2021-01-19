<?php // require_once('../../Connections/Conn.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$TaxAmount=$_POST['NetProfit']*$_POST['TaxPercentage']/100;

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO erp_tax_payment_voucher_details (TaxTypeID, VoucherID, NetProfit, TaxPercentage, TaxAmount, `Description`) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['TaxTypeID'], "int"),
                       GetSQLValueString($_POST['VoucherID'], "int"),
                       GetSQLValueString($_POST['NetProfit'], "double"),
                       GetSQLValueString($_POST['TaxPercentage'], "double"),
                       GetSQLValueString($TaxAmount, "double"),
                       GetSQLValueString($_POST['Description'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM erp_tax_payment_voucher_details WHERE TaxPaymentID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}

$TaxAmount=$_POST['NetProfit']*$_POST['TaxPercentage']/100;

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
  $updateSQL = sprintf("UPDATE erp_tax_payment_voucher_details SET TaxTypeID=%s, VoucherID=%s, NetProfit=%s, TaxPercentage=%s, TaxAmount=%s, `Description`=%s WHERE TaxPaymentID=%s",
                       GetSQLValueString($_POST['TaxTypeID'], "int"),
                       GetSQLValueString($_POST['VoucherID'], "int"),
                       GetSQLValueString($_POST['NetProfit'], "double"),
                       GetSQLValueString($_POST['TaxPercentage'], "double"),
                       GetSQLValueString($TaxAmount , "double"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['TaxPaymentID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

$maxRows_Rs_ShowAlltaxVoucherDetail = 20;
$pageNum_Rs_ShowAlltaxVoucherDetail = 0;
if (isset($_GET['pageNum_Rs_ShowAlltaxVoucherDetail'])) {
  $pageNum_Rs_ShowAlltaxVoucherDetail = $_GET['pageNum_Rs_ShowAlltaxVoucherDetail'];
}
$startRow_Rs_ShowAlltaxVoucherDetail = $pageNum_Rs_ShowAlltaxVoucherDetail * $maxRows_Rs_ShowAlltaxVoucherDetail;

mysql_select_db($database_Conn, $Conn);
$query_Rs_ShowAlltaxVoucherDetail = "SELECT * FROM erp_tax_payment_voucher_details";

// Search Code Start Here
if(isset($_POST['txtSearch']) && strlen($_POST['txtSearch'])>0) {
	
$query_Rs_ShowAlltaxVoucherDetail = "SELECT * FROM erp_tax_payment_voucher_details WHERE erp_tax_payment_vouchers.TaxPaymentID Like '%" . $_POST['txtSearch'] ."'";		
}
// End of Search Code

$query_limit_Rs_ShowAlltaxVoucherDetail = sprintf("%s LIMIT %d, %d", $query_Rs_ShowAlltaxVoucherDetail, $startRow_Rs_ShowAlltaxVoucherDetail, $maxRows_Rs_ShowAlltaxVoucherDetail);
$Rs_ShowAlltaxVoucherDetail = mysql_query($query_limit_Rs_ShowAlltaxVoucherDetail, $Conn) or die(mysql_error());
$row_Rs_ShowAlltaxVoucherDetail = mysql_fetch_assoc($Rs_ShowAlltaxVoucherDetail);

if (isset($_GET['totalRows_Rs_ShowAlltaxVoucherDetail'])) {
  $totalRows_Rs_ShowAlltaxVoucherDetail = $_GET['totalRows_Rs_ShowAlltaxVoucherDetail'];
} else {
  $all_Rs_ShowAlltaxVoucherDetail = mysql_query($query_Rs_ShowAlltaxVoucherDetail);
  $totalRows_Rs_ShowAlltaxVoucherDetail = mysql_num_rows($all_Rs_ShowAlltaxVoucherDetail);
}
$totalPages_Rs_ShowAlltaxVoucherDetail = ceil($totalRows_Rs_ShowAlltaxVoucherDetail/$maxRows_Rs_ShowAlltaxVoucherDetail)-1;

$colname_RS_GetSelectedTaxVoucherDetail = "-1";
if (isset($_GET['EditID'])) {
  $colname_RS_GetSelectedTaxVoucherDetail = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RS_GetSelectedTaxVoucherDetail = sprintf("SELECT * FROM erp_tax_payment_voucher_details WHERE TaxPaymentID = %s", GetSQLValueString($colname_RS_GetSelectedTaxVoucherDetail, "int"));
$RS_GetSelectedTaxVoucherDetail = mysql_query($query_RS_GetSelectedTaxVoucherDetail, $Conn) or die(mysql_error());
$row_RS_GetSelectedTaxVoucherDetail = mysql_fetch_assoc($RS_GetSelectedTaxVoucherDetail);
$totalRows_RS_GetSelectedTaxVoucherDetail = mysql_num_rows($RS_GetSelectedTaxVoucherDetail);

$queryString_Rs_ShowAlltaxVoucherDetail = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Rs_ShowAlltaxVoucherDetail") == false && 
        stristr($param, "totalRows_Rs_ShowAlltaxVoucherDetail") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Rs_ShowAlltaxVoucherDetail = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Rs_ShowAlltaxVoucherDetail = sprintf("&totalRows_Rs_ShowAlltaxVoucherDetail=%d%s", $totalRows_Rs_ShowAlltaxVoucherDetail, $queryString_Rs_ShowAlltaxVoucherDetail);
?>
<?php if ($totalRows_RS_GetSelectedTaxVoucherDetail == 0) { // Show if recordset empty ?>
  <div class="1">
    <h2>Tax Details</h2>
    <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">TaxTypeID:</td>
          <td><input type="text" name="TaxTypeID" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">VoucherID:</td>
          <td><input type="text" name="VoucherID" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">NetProfit:</td>
          <td><input type="text" name="NetProfit" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">TaxPercentage:</td>
          <td><input type="text" name="TaxPercentage" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Description:</td>
          <td><input type="text" name="Description" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Insert record"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form2">
    </form>
  </div>
  <?php } // Show if recordset empty ?>
&nbsp;
<?php if ($totalRows_RS_GetSelectedTaxVoucherDetail > 0) { // Show if recordset not empty ?>
  <div class="1">
    <h2>Edit Details</h2>
    <p>&nbsp;</p>
    <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">TaxTypeID:</td>
          <td><input type="text" name="TaxTypeID" value="<?php echo htmlentities($row_RS_GetSelectedTaxVoucherDetail['TaxTypeID'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">VoucherID:</td>
          <td><input type="text" name="VoucherID" value="<?php echo htmlentities($row_RS_GetSelectedTaxVoucherDetail['VoucherID'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">NetProfit:</td>
          <td><input type="text" name="NetProfit" value="<?php echo htmlentities($row_RS_GetSelectedTaxVoucherDetail['NetProfit'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">TaxPercentage:</td>
          <td><input type="text" name="TaxPercentage" value="<?php echo htmlentities($row_RS_GetSelectedTaxVoucherDetail['TaxPercentage'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Description:</td>
          <td><input type="text" name="Description" value="<?php echo htmlentities($row_RS_GetSelectedTaxVoucherDetail['Description'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Update record"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form3">
      <input type="hidden" name="TaxPaymentID" value="<?php echo $row_RS_GetSelectedTaxVoucherDetail['TaxPaymentID']; ?>">
    </form>
    <p>&nbsp;</p>
  </div>
  <?php } // Show if recordset not empty ?>
&nbsp;
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
<h2>View Details</h2>
<form name="form1" method="post" action="">
  <table border="1">
    <tr>
      <th colspan="2">Action</th>
      <th>TaxTypeID</th>
      <th>VoucherID</th>
      <th>NetProfit</th>
      <th>TaxPercentage</th>
      <th>TaxAmount</th>
      <th>Description</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><a href="?DeleteID=<?php echo $row_Rs_ShowAlltaxVoucherDetail['TaxPaymentID']; ?>">Delete</a></td>
        <td><a href="?EditID=<?php echo $row_Rs_ShowAlltaxVoucherDetail['TaxPaymentID']; ?>">Edit</a></td>
        <td><?php echo $row_Rs_ShowAlltaxVoucherDetail['TaxTypeID']; ?></td>
        <td><?php echo $row_Rs_ShowAlltaxVoucherDetail['VoucherID']; ?></td>
        <td><?php echo $row_Rs_ShowAlltaxVoucherDetail['NetProfit']; ?></td>
        <td><?php echo $row_Rs_ShowAlltaxVoucherDetail['TaxPercentage']; ?></td>
        <td><?php echo $row_Rs_ShowAlltaxVoucherDetail['TaxAmount']; ?></td>
        <td><?php echo $row_Rs_ShowAlltaxVoucherDetail['Description']; ?></td>
      </tr>
      <?php } while ($row_Rs_ShowAlltaxVoucherDetail = mysql_fetch_assoc($Rs_ShowAlltaxVoucherDetail)); ?>
  </table>
</form></div>
&nbsp;
<div class="1">
  <table border="0">
    <tr>
      <td><?php if ($pageNum_Rs_ShowAlltaxVoucherDetail > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Rs_ShowAlltaxVoucherDetail=%d%s", $currentPage, 0, $queryString_Rs_ShowAlltaxVoucherDetail); ?>">First</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_Rs_ShowAlltaxVoucherDetail > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_Rs_ShowAlltaxVoucherDetail=%d%s", $currentPage, max(0, $pageNum_Rs_ShowAlltaxVoucherDetail - 1), $queryString_Rs_ShowAlltaxVoucherDetail); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_Rs_ShowAlltaxVoucherDetail < $totalPages_Rs_ShowAlltaxVoucherDetail) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Rs_ShowAlltaxVoucherDetail=%d%s", $currentPage, min($totalPages_Rs_ShowAlltaxVoucherDetail, $pageNum_Rs_ShowAlltaxVoucherDetail + 1), $queryString_Rs_ShowAlltaxVoucherDetail); ?>">Next</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_Rs_ShowAlltaxVoucherDetail < $totalPages_Rs_ShowAlltaxVoucherDetail) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_Rs_ShowAlltaxVoucherDetail=%d%s", $currentPage, $totalPages_Rs_ShowAlltaxVoucherDetail, $queryString_Rs_ShowAlltaxVoucherDetail); ?>">Last</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
</div>
<?php
mysql_free_result($Rs_ShowAlltaxVoucherDetail);

mysql_free_result($RS_GetSelectedTaxVoucherDetail);
?>
