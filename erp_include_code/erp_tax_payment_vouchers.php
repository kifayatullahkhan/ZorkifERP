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

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO erp_tax_payment_vouchers (VoucherNo, VoucherReferenceNo, Dated, Username) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['VoucherNo'], "text"),
                       GetSQLValueString($_POST['VoucherReferenceNo'], "text"),
                       GetSQLValueString($_POST['Dated'], "date"),
                       GetSQLValueString($_POST['Username'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
  $updateSQL = sprintf("UPDATE erp_tax_payment_vouchers SET VoucherNo=%s, VoucherReferenceNo=%s, Dated=%s, Username=%s WHERE VoucherID=%s",
                       GetSQLValueString($_POST['VoucherNo'], "text"),
                       GetSQLValueString($_POST['VoucherReferenceNo'], "text"),
                       GetSQLValueString($_POST['Dated'], "date"),
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['VoucherID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

$maxRows_RS_ShowTaxPaymentVouchers = 20;
$pageNum_RS_ShowTaxPaymentVouchers = 0;
if (isset($_GET['pageNum_RS_ShowTaxPaymentVouchers'])) {
  $pageNum_RS_ShowTaxPaymentVouchers = $_GET['pageNum_RS_ShowTaxPaymentVouchers'];
}
$startRow_RS_ShowTaxPaymentVouchers = $pageNum_RS_ShowTaxPaymentVouchers * $maxRows_RS_ShowTaxPaymentVouchers;

mysql_select_db($database_Conn, $Conn);
$query_RS_ShowTaxPaymentVouchers = "SELECT * FROM erp_tax_payment_vouchers";

// Search Code Start Here
if(isset($_POST['txtSearch']) && strlen($_POST['txtSearch'])>0) {
	
$query_RS_ShowTaxPaymentVouchers = "SELECT * FROM erp_tax_payment_vouchers WHERE erp_tax_payment_vouchers.VoucherNo Like '%" . $_POST['txtSearch'] ."'";		
}
// End of Search Code

$query_limit_RS_ShowTaxPaymentVouchers = sprintf("%s LIMIT %d, %d", $query_RS_ShowTaxPaymentVouchers, $startRow_RS_ShowTaxPaymentVouchers, $maxRows_RS_ShowTaxPaymentVouchers);
$RS_ShowTaxPaymentVouchers = mysql_query($query_limit_RS_ShowTaxPaymentVouchers, $Conn) or die(mysql_error());
$row_RS_ShowTaxPaymentVouchers = mysql_fetch_assoc($RS_ShowTaxPaymentVouchers);

if (isset($_GET['totalRows_RS_ShowTaxPaymentVouchers'])) {
  $totalRows_RS_ShowTaxPaymentVouchers = $_GET['totalRows_RS_ShowTaxPaymentVouchers'];
} else {
  $all_RS_ShowTaxPaymentVouchers = mysql_query($query_RS_ShowTaxPaymentVouchers);
  $totalRows_RS_ShowTaxPaymentVouchers = mysql_num_rows($all_RS_ShowTaxPaymentVouchers);
}
$totalPages_RS_ShowTaxPaymentVouchers = ceil($totalRows_RS_ShowTaxPaymentVouchers/$maxRows_RS_ShowTaxPaymentVouchers)-1;

$colname_RS_GetSelectedPaymentVoucher = "-1";
if (isset($_GET['EditID'])) {
  $colname_RS_GetSelectedPaymentVoucher = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RS_GetSelectedPaymentVoucher = sprintf("SELECT * FROM erp_tax_payment_vouchers WHERE VoucherID = %s", GetSQLValueString($colname_RS_GetSelectedPaymentVoucher, "int"));
$RS_GetSelectedPaymentVoucher = mysql_query($query_RS_GetSelectedPaymentVoucher, $Conn) or die(mysql_error());
$row_RS_GetSelectedPaymentVoucher = mysql_fetch_assoc($RS_GetSelectedPaymentVoucher);
$totalRows_RS_GetSelectedPaymentVoucher = mysql_num_rows($RS_GetSelectedPaymentVoucher);

$queryString_RS_ShowTaxPaymentVouchers = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RS_ShowTaxPaymentVouchers") == false && 
        stristr($param, "totalRows_RS_ShowTaxPaymentVouchers") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RS_ShowTaxPaymentVouchers = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RS_ShowTaxPaymentVouchers = sprintf("&totalRows_RS_ShowTaxPaymentVouchers=%d%s", $totalRows_RS_ShowTaxPaymentVouchers, $queryString_RS_ShowTaxPaymentVouchers);
?>
<?php if ($totalRows_RS_GetSelectedPaymentVoucher == 0) { // Show if recordset empty ?>
  <div class="1">
    <h2>Tax Details</h2>
    <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">VoucherNo:</td>
          <td><input type="text" name="VoucherNo" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">VoucherReferenceNo:</td>
          <td><input type="text" name="VoucherReferenceNo" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Dated:</td>
          <td><input type="text" name="Dated" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Username:</td>
          <td><input type="text" name="Username" value="" size="32"></td>
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
<?php if ($totalRows_RS_GetSelectedPaymentVoucher > 0) { // Show if recordset not empty ?>
  <div class="1">
    <h2>Edit Details</h2>
    <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">VoucherNo:</td>
          <td><input type="text" name="VoucherNo" value="<?php echo htmlentities($row_RS_GetSelectedPaymentVoucher['VoucherNo'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">VoucherReferenceNo:</td>
          <td><input type="text" name="VoucherReferenceNo" value="<?php echo htmlentities($row_RS_GetSelectedPaymentVoucher['VoucherReferenceNo'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Dated:</td>
          <td><input type="text" name="Dated" value="<?php echo htmlentities($row_RS_GetSelectedPaymentVoucher['Dated'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Username:</td>
          <td><input type="text" name="Username" value="<?php echo htmlentities($row_RS_GetSelectedPaymentVoucher['Username'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Update record"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form3">
      <input type="hidden" name="VoucherID" value="<?php echo $row_RS_GetSelectedPaymentVoucher['VoucherID']; ?>">
    </form>
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
      <th>VoucherNo</th>
      <th>VoucherReferenceNo</th>
      <th>Dated</th>
      <th>Username</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><a href="?DeleteID=<?php echo $row_RS_ShowTaxPaymentVouchers['VoucherID']; ?>">Delete</a></td>
        <td><a href="?EditID=<?php echo $row_RS_ShowTaxPaymentVouchers['VoucherID']; ?>">Edit</a></td>
        <td><?php echo $row_RS_ShowTaxPaymentVouchers['VoucherNo']; ?></td>
        <td><?php echo $row_RS_ShowTaxPaymentVouchers['VoucherReferenceNo']; ?></td>
        <td><?php echo $row_RS_ShowTaxPaymentVouchers['Dated']; ?></td>
        <td><?php echo $row_RS_ShowTaxPaymentVouchers['Username']; ?></td>
      </tr>
      <?php } while ($row_RS_ShowTaxPaymentVouchers = mysql_fetch_assoc($RS_ShowTaxPaymentVouchers)); ?>
  </table>
</form>
</div>
&nbsp;
<div class="1">
  <table border="0">
    <tr>
      <td><?php if ($pageNum_RS_ShowTaxPaymentVouchers > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RS_ShowTaxPaymentVouchers=%d%s", $currentPage, 0, $queryString_RS_ShowTaxPaymentVouchers); ?>">First</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RS_ShowTaxPaymentVouchers > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RS_ShowTaxPaymentVouchers=%d%s", $currentPage, max(0, $pageNum_RS_ShowTaxPaymentVouchers - 1), $queryString_RS_ShowTaxPaymentVouchers); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RS_ShowTaxPaymentVouchers < $totalPages_RS_ShowTaxPaymentVouchers) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RS_ShowTaxPaymentVouchers=%d%s", $currentPage, min($totalPages_RS_ShowTaxPaymentVouchers, $pageNum_RS_ShowTaxPaymentVouchers + 1), $queryString_RS_ShowTaxPaymentVouchers); ?>">Next</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_RS_ShowTaxPaymentVouchers < $totalPages_RS_ShowTaxPaymentVouchers) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RS_ShowTaxPaymentVouchers=%d%s", $currentPage, $totalPages_RS_ShowTaxPaymentVouchers, $queryString_RS_ShowTaxPaymentVouchers); ?>">Last</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
</div>
<?php
mysql_free_result($RS_ShowTaxPaymentVouchers);

mysql_free_result($RS_GetSelectedPaymentVoucher);
?>
