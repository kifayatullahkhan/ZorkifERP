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
	$AmountLeft=$_POST['TotalAmount']-$_POST['AmountPaid'];
  $insertSQL = sprintf("INSERT INTO erp_customerpayments (OrderReferenceNo, CustomerID, PaymentDate, TotalAmount, AmountPaid, AmountLeft, Comments, PaymentStatus) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['OrderReferenceNo'], "text"),
                       GetSQLValueString($_POST['CustomerID'], "int"),
                       GetSQLValueString($_POST['PaymentDate'], "date"),
                       GetSQLValueString($_POST['TotalAmount'], "double"),
                       GetSQLValueString($_POST['AmountPaid'], "double"),
                       GetSQLValueString($AmountLeft, "double"),
                       GetSQLValueString($_POST['Comments'], "text"),
                       GetSQLValueString($_POST['PaymentStatus'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM erp_customerpayments WHERE CustomerPaymentID=%s",
                       GetSQLValueString($_GET['DeleteID'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
	$AmountLeft=$_POST['TotalAmount']-$_POST['AmountPaid'];
  $updateSQL = sprintf("UPDATE erp_customerpayments SET OrderReferenceNo=%s, CustomerID=%s, PaymentDate=%s, TotalAmount=%s, AmountPaid=%s, AmountLeft=%s, Comments=%s, PaymentStatus=%s WHERE CustomerPaymentID=%s",
                       GetSQLValueString($_POST['OrderReferenceNo'], "text"),
                       GetSQLValueString($_POST['CustomerID'], "int"),
                       GetSQLValueString($_POST['PaymentDate'], "date"),
                       GetSQLValueString($_POST['TotalAmount'], "double"),
                       GetSQLValueString($_POST['AmountPaid'], "double"),
                       GetSQLValueString($AmountLeft,"double"),
                       GetSQLValueString($_POST['Comments'], "text"),
                       GetSQLValueString($_POST['PaymentStatus'], "text"),
                       GetSQLValueString($_POST['CustomerPaymentID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

mysql_select_db($database_Conn, $Conn);
$query_RS_PaymentsDetails = "SELECT erp_customerorders.CustomerOrderID, erp_customerorders.OrderReferenceNo, ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) -((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100))AS TotalAmount FROM erp_customerorders Join erp_customerorderdetails ON erp_customerorders.CustomerOrderID = erp_customerorderdetails.CustomerOrderID WHERE erp_customerorders.CustomerOrderID = erp_customerorderdetails.CustomerOrderID";
$RS_PaymentsDetails = mysql_query($query_RS_PaymentsDetails, $Conn) or die(mysql_error());
$row_RS_PaymentsDetails = mysql_fetch_assoc($RS_PaymentsDetails);
$totalRows_RS_PaymentsDetails = mysql_num_rows($RS_PaymentsDetails);

$maxRows_RS_CustomerPayments = 20;
$pageNum_RS_CustomerPayments = 0;
if (isset($_GET['pageNum_RS_CustomerPayments'])) {
  $pageNum_RS_CustomerPayments = $_GET['pageNum_RS_CustomerPayments'];
}
$startRow_RS_CustomerPayments = $pageNum_RS_CustomerPayments * $maxRows_RS_CustomerPayments;

mysql_select_db($database_Conn, $Conn);
$query_RS_CustomerPayments = "SELECT * FROM erp_customerpayments";

// Search Code Start Here
if(isset($_POST['txtSearch']) && strlen($_POST['txtSearch'])>0) {
	
$query_RS_CustomerPayments = "SELECT * FROM erp_customerpayments WHERE erp_customerpayments.OrderReferenceNo Like '%" . $_POST['txtSearch'] ."'";		
}
// End of Search Code


$query_limit_RS_CustomerPayments = sprintf("%s LIMIT %d, %d", $query_RS_CustomerPayments, $startRow_RS_CustomerPayments, $maxRows_RS_CustomerPayments);
$RS_CustomerPayments = mysql_query($query_limit_RS_CustomerPayments, $Conn) or die(mysql_error());
$row_RS_CustomerPayments = mysql_fetch_assoc($RS_CustomerPayments);

if (isset($_GET['totalRows_RS_CustomerPayments'])) {
  $totalRows_RS_CustomerPayments = $_GET['totalRows_RS_CustomerPayments'];
} else {
  $all_RS_CustomerPayments = mysql_query($query_RS_CustomerPayments);
  $totalRows_RS_CustomerPayments = mysql_num_rows($all_RS_CustomerPayments);
}
$totalPages_RS_CustomerPayments = ceil($totalRows_RS_CustomerPayments/$maxRows_RS_CustomerPayments)-1;

$colname_RS_GetSelectedPayment = "-1";
if (isset($_GET['EditID'])) {
  $colname_RS_GetSelectedPayment = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RS_GetSelectedPayment = sprintf("SELECT * FROM erp_customerpayments WHERE CustomerPaymentID = %s", GetSQLValueString($colname_RS_GetSelectedPayment, "int"));
$RS_GetSelectedPayment = mysql_query($query_RS_GetSelectedPayment, $Conn) or die(mysql_error());
$row_RS_GetSelectedPayment = mysql_fetch_assoc($RS_GetSelectedPayment);
$totalRows_RS_GetSelectedPayment = mysql_num_rows($RS_GetSelectedPayment);

$queryString_RS_CustomerPayments = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_RS_CustomerPayments") == false && 
        stristr($param, "totalRows_RS_CustomerPayments") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RS_CustomerPayments = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RS_CustomerPayments = sprintf("&totalRows_RS_CustomerPayments=%d%s", $totalRows_RS_CustomerPayments, $queryString_RS_CustomerPayments);
?>
<?php if ($totalRows_RS_GetSelectedPayment == 0) { // Show if recordset empty ?>
  <div class="1">
    <h2>Customer Payment Detail</h2>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
        <table align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">OrderReferenceNo:</td>
            <td><input type="text" name="OrderReferenceNo" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">CustomerID:</td>
            <td><input type="text" name="CustomerID" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">PaymentDate:</td>
            <td><input type="text" name="PaymentDate" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">TotalAmount:</td>
            <td><input type="text" name="TotalAmount" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">AmountPaid:</td>
            <td><input type="text" name="AmountPaid" value="" size="32" /></td>
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
&nbsp;
<?php if ($totalRows_RS_GetSelectedPayment > 0) { // Show if recordset not empty ?>
  <div class="1">
    <h2>Edit Detail</h2>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form3" id="form3">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">OrderReferenceNo:</td>
          <td><input type="text" name="OrderReferenceNo" value="<?php echo htmlentities($row_RS_GetSelectedPayment['OrderReferenceNo'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">CustomerID:</td>
          <td><input type="text" name="CustomerID" value="<?php echo htmlentities($row_RS_GetSelectedPayment['CustomerID'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">PaymentDate:</td>
          <td><input type="text" name="PaymentDate" value="<?php echo htmlentities($row_RS_GetSelectedPayment['PaymentDate'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">TotalAmount:</td>
          <td><input type="text" name="TotalAmount" value="<?php echo htmlentities($row_RS_GetSelectedPayment['TotalAmount'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">AmountPaid:</td>
          <td><input type="text" name="AmountPaid" value="<?php echo htmlentities($row_RS_GetSelectedPayment['AmountPaid'], ENT_COMPAT, ''); ?>" size="32" /></td>
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
      <input type="hidden" name="CustomerPaymentID" value="<?php echo $row_RS_GetSelectedPayment['CustomerPaymentID']; ?>" />
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
</form></div>
&nbsp;
<div class="1">
<h2>View Detail</h2>
<form id="form1" name="form1" method="post" action="">
  <table border="1">
    <tr>
      <th colspan="2">Action</th>
      <th>OrderReferenceNo</th>
      <th>CustomerID</th>
      <th>PaymentDate</th>
      <th>TotalAmount</th>
      <th>AmountPaid</th>
      <th>AmountLeft</th>
      <th>Comments</th>
      <th>PaymentStatus</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><a href="?DeleteID=<?php echo $row_RS_CustomerPayments['CustomerPaymentID']; ?>">Delete</a></td>
        <td><a href="?EditID=<?php echo $row_RS_CustomerPayments['CustomerPaymentID']; ?>">Edit</a></td>
        <td><?php echo $row_RS_CustomerPayments['OrderReferenceNo']; ?></td>
        <td><?php echo $row_RS_CustomerPayments['CustomerID']; ?></td>
        <td><?php echo $row_RS_CustomerPayments['PaymentDate']; ?></td>
        <td><?php echo $row_RS_CustomerPayments['TotalAmount']; ?></td>
        <td><?php echo $row_RS_CustomerPayments['AmountPaid']; ?></td>
        <td><?php echo $row_RS_CustomerPayments['AmountLeft']; ?></td>
        <td><?php echo $row_RS_CustomerPayments['Comments']; ?></td>
        <td><?php echo $row_RS_CustomerPayments['PaymentStatus']; ?></td>
      </tr>
      <?php } while ($row_RS_CustomerPayments = mysql_fetch_assoc($RS_CustomerPayments)); ?>
  </table>
</form></div>
&nbsp;
<div class="1">
  <table border="0">
    <tr>
      <td><?php if ($pageNum_RS_CustomerPayments > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RS_CustomerPayments=%d%s", $currentPage, 0, $queryString_RS_CustomerPayments); ?>">First</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RS_CustomerPayments > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_RS_CustomerPayments=%d%s", $currentPage, max(0, $pageNum_RS_CustomerPayments - 1), $queryString_RS_CustomerPayments); ?>">Previous</a>
          <?php } // Show if not first page ?></td>
      <td><?php if ($pageNum_RS_CustomerPayments < $totalPages_RS_CustomerPayments) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RS_CustomerPayments=%d%s", $currentPage, min($totalPages_RS_CustomerPayments, $pageNum_RS_CustomerPayments + 1), $queryString_RS_CustomerPayments); ?>">Next</a>
          <?php } // Show if not last page ?></td>
      <td><?php if ($pageNum_RS_CustomerPayments < $totalPages_RS_CustomerPayments) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_RS_CustomerPayments=%d%s", $currentPage, $totalPages_RS_CustomerPayments, $queryString_RS_CustomerPayments); ?>">Last</a>
          <?php } // Show if not last page ?></td>
    </tr>
  </table>
</div>
&nbsp;
<?php
mysql_free_result($RS_PaymentsDetails);

mysql_free_result($RS_CustomerPayments);

mysql_free_result($RS_GetSelectedPayment);
?>
