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
	$PaymentLeft=$_POST['TotalPayment']-$_POST['PaymentPaid'];
  $insertSQL = sprintf("INSERT INTO erp_purchasepayments (OrderReferenceNo, SupplierID, PaymentDate, TotalPayment, PaymentPaid, PaymentLeft, Comments, PaymentStatus) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['OrderReferenceNo'], "text"),
                       GetSQLValueString($_POST['SupplierID'], "text"),
                       GetSQLValueString($_POST['PaymentDate'], "date"),
                       GetSQLValueString($_POST['TotalPayment'], "double"),
                       GetSQLValueString($_POST['PaymentPaid'], "double"),
                       GetSQLValueString($PaymentLeft, "double"),
                       GetSQLValueString($_POST['Comments'], "text"),
                       GetSQLValueString($_POST['PaymentStatus'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM erp_purchasepayments WHERE PurchasePaymentID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
	$PaymentLeft=$_POST['TotalPayment']-$_POST['PaymentPaid'];
  $updateSQL = sprintf("UPDATE erp_purchasepayments SET OrderReferenceNo=%s, SupplierID=%s, PaymentDate=%s, TotalPayment=%s, PaymentPaid=%s, PaymentLeft=%s, Comments=%s, PaymentStatus=%s WHERE PurchasePaymentID=%s",
                       GetSQLValueString($_POST['OrderReferenceNo'], "text"),
                       GetSQLValueString($_POST['SupplierID'], "text"),
                       GetSQLValueString($_POST['PaymentDate'], "date"),
                       GetSQLValueString($_POST['TotalPayment'], "double"),
                       GetSQLValueString($_POST['PaymentPaid'], "double"),
                       GetSQLValueString($PaymentLeft, "double"),
                       GetSQLValueString($_POST['Comments'], "text"),
                       GetSQLValueString($_POST['PaymentStatus'], "text"),
                       GetSQLValueString($_POST['PurchasePaymentID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

mysql_select_db($database_Conn, $Conn);
$query_RS_PurchaseDetail = "SELECT erp_purchaseordersproformainvoice. OrderReferenceNo, (erp_purchaseordersproformainvoicedetails.Quantity* erp_purchaseordersproformainvoicedetails.Price_Per_Unit) AS TotalAmount FROM erp_purchaseordersproformainvoice JOIN erp_purchaseordersproformainvoicedetails ON erp_purchaseordersproformainvoice.POPIID = erp_purchaseordersproformainvoicedetails.POPIID";
$RS_PurchaseDetail = mysql_query($query_RS_PurchaseDetail, $Conn) or die(mysql_error());
$row_RS_PurchaseDetail = mysql_fetch_assoc($RS_PurchaseDetail);
$totalRows_RS_PurchaseDetail = mysql_num_rows($RS_PurchaseDetail);

$maxRows_RS_PaymentPurchase = 20;
$pageNum_RS_PaymentPurchase = 0;
if (isset($_GET['pageNum_RS_PaymentPurchase'])) {
  $pageNum_RS_PaymentPurchase = $_GET['pageNum_RS_PaymentPurchase'];
}
$startRow_RS_PaymentPurchase = $pageNum_RS_PaymentPurchase * $maxRows_RS_PaymentPurchase;

mysql_select_db($database_Conn, $Conn);
$query_RS_PaymentPurchase = "SELECT * FROM erp_purchasepayments";

// Search Code Start Here
if(isset($_POST['txtSearch']) && strlen($_POST['txtSearch'])>0) {
	
$query_RS_PaymentPurchase = "SELECT * FROM erp_purchasepayments WHERE erp_purchasepayments.OrderReferenceNo Like '%" . $_POST['txtSearch'] ."'";		
}
// End of Search Code

$query_limit_RS_PaymentPurchase = sprintf("%s LIMIT %d, %d", $query_RS_PaymentPurchase, $startRow_RS_PaymentPurchase, $maxRows_RS_PaymentPurchase);
$RS_PaymentPurchase = mysql_query($query_limit_RS_PaymentPurchase, $Conn) or die(mysql_error());
$row_RS_PaymentPurchase = mysql_fetch_assoc($RS_PaymentPurchase);

if (isset($_GET['totalRows_RS_PaymentPurchase'])) {
  $totalRows_RS_PaymentPurchase = $_GET['totalRows_RS_PaymentPurchase'];
} else {
  $all_RS_PaymentPurchase = mysql_query($query_RS_PaymentPurchase);
  $totalRows_RS_PaymentPurchase = mysql_num_rows($all_RS_PaymentPurchase);
}
$totalPages_RS_PaymentPurchase = ceil($totalRows_RS_PaymentPurchase/$maxRows_RS_PaymentPurchase)-1;

$colname_RS_GetSelectedPayment = "-1";
if (isset($_GET['EditID'])) {
  $colname_RS_GetSelectedPayment = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RS_GetSelectedPayment = sprintf("SELECT * FROM erp_purchasepayments WHERE PurchasePaymentID = %s", GetSQLValueString($colname_RS_GetSelectedPayment, "int"));
$RS_GetSelectedPayment = mysql_query($query_RS_GetSelectedPayment, $Conn) or die(mysql_error());
$row_RS_GetSelectedPayment = mysql_fetch_assoc($RS_GetSelectedPayment);
$totalRows_RS_GetSelectedPayment = mysql_num_rows($RS_GetSelectedPayment);

$queryString_RS_PaymentPurchase = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RS_PaymentPurchase") == false && 
        stristr($param, "totalRows_RS_PaymentPurchase") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RS_PaymentPurchase = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RS_PaymentPurchase = sprintf("&totalRows_RS_PaymentPurchase=%d%s", $totalRows_RS_PaymentPurchase, $queryString_RS_PaymentPurchase);
?>
<?php if ($totalRows_RS_GetSelectedPayment == 0) { // Show if recordset empty ?>
  <div class="1">
    <h2>Purchase Payment Detail</h2>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">OrderReferenceNo:</td>
          <td><input type="text" name="OrderReferenceNo" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">SupplierID:</td>
          <td><input type="text" name="SupplierID" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">PaymentDate:</td>
          <td><input type="text" name="PaymentDate" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">TotalPayment:</td>
          <td><input type="text" name="TotalPayment" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">PaymentPaid:</td>
          <td><input type="text" name="PaymentPaid" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Comments:</td>
          <td><input type="text" name="Comments" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">PaymentStatus:</td>
          <td><input type="text" name="PaymentStatus" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Insert record" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form2" />
    </form>
  </div>
  <?php } // Show if recordset empty ?>
<?php if ($totalRows_RS_GetSelectedPayment > 0) { // Show if recordset not empty ?>
  <div class="1">
    <h2>Edit Detial</h2>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form3" id="form3">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">OrderReferenceNo:</td>
          <td><input type="text" name="OrderReferenceNo" value="<?php echo htmlentities($row_RS_GetSelectedPayment['OrderReferenceNo'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">SupplierID:</td>
          <td><input type="text" name="SupplierID" value="<?php echo htmlentities($row_RS_GetSelectedPayment['SupplierID'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">PaymentDate:</td>
          <td><input type="text" name="PaymentDate" value="<?php echo htmlentities($row_RS_GetSelectedPayment['PaymentDate'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">TotalPayment:</td>
          <td><input type="text" name="TotalPayment" value="<?php echo htmlentities($row_RS_GetSelectedPayment['TotalPayment'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">PaymentPaid:</td>
          <td><input type="text" name="PaymentPaid" value="<?php echo htmlentities($row_RS_GetSelectedPayment['PaymentPaid'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Comments:</td>
          <td><input type="text" name="Comments" value="<?php echo htmlentities($row_RS_GetSelectedPayment['Comments'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">PaymentStatus:</td>
          <td><input type="text" name="PaymentStatus" value="<?php echo htmlentities($row_RS_GetSelectedPayment['PaymentStatus'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Update record" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form3" />
      <input type="hidden" name="PurchasePaymentID" value="<?php echo $row_RS_GetSelectedPayment['PurchasePaymentID']; ?>" />
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
<div class="1">
<h2>View Detail</h2>
<form id="form1" name="form1" method="post" action="">
  <table border="1">
    <tr>
      <th colspan="2">Action</th>
      <th>OrderReferenceNo</th>
      <th>SupplierID</th>
      <th>PaymentDate</th>
      <th>TotalPayment</th>
      <th>PaymentPaid</th>
      <th>PaymentLeft</th>
      <th>Comments</th>
      <th>PaymentStatus</th>
    </tr>
    <?php  do { ?>
      <tr>
        <td><a href="?DeleteID=<?php echo $row_RS_PaymentPurchase['PurchasePaymentID']; ?>">Delete</a></td>
        <td><a href="?EditID=<?php echo $row_RS_PaymentPurchase['PurchasePaymentID']; ?>">Edit</a></td>
        <td><?php echo $row_RS_PaymentPurchase['OrderReferenceNo']; ?></td>
        <td><?php echo $row_RS_PaymentPurchase['SupplierID']; ?></td>
        <td><?php echo $row_RS_PaymentPurchase['PaymentDate']; ?></td>
        <td><?php echo $row_RS_PaymentPurchase['TotalPayment']; ?></td>
        <td><?php echo $row_RS_PaymentPurchase['PaymentPaid']; ?></td>
        <td><?php echo $row_RS_PaymentPurchase['PaymentLeft']; ?></td>
        <td><?php echo $row_RS_PaymentPurchase['Comments']; ?></td>
        <td><?php echo $row_RS_PaymentPurchase['PaymentStatus']; ?></td>
      </tr>
      <?php } while ($row_RS_PaymentPurchase = mysql_fetch_assoc($RS_PaymentPurchase)); ?>
  </table>
</form>
</div>
&nbsp;
<div class="1">
  <table border="0">
    <tr>
      <td><?php if ($pageNum_RS_PaymentPurchase > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RS_PaymentPurchase=%d%s", $currentPage, 0, $queryString_RS_PaymentPurchase); ?>">First</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RS_PaymentPurchase > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RS_PaymentPurchase=%d%s", $currentPage, max(0, $pageNum_RS_PaymentPurchase - 1), $queryString_RS_PaymentPurchase); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RS_PaymentPurchase < $totalPages_RS_PaymentPurchase) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RS_PaymentPurchase=%d%s", $currentPage, min($totalPages_RS_PaymentPurchase, $pageNum_RS_PaymentPurchase + 1), $queryString_RS_PaymentPurchase); ?>">Next</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_RS_PaymentPurchase < $totalPages_RS_PaymentPurchase) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RS_PaymentPurchase=%d%s", $currentPage, $totalPages_RS_PaymentPurchase, $queryString_RS_PaymentPurchase); ?>">Last</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
</div>
<?php
mysql_free_result($RS_PurchaseDetail);

mysql_free_result($RS_PaymentPurchase);

mysql_free_result($RS_GetSelectedPayment);
?>
