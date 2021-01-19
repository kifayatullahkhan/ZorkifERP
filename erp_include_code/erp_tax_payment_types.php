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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO erp_tax_payment_types (TaxType, `Description`) VALUES (%s, %s)",
                       GetSQLValueString($_POST['TaxType'], "text"),
                       GetSQLValueString($_POST['Description'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM erp_tax_payment_types WHERE TaxTypeID=%s",
                       GetSQLValueString($_GET['DeleteID'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form3")) {
  $updateSQL = sprintf("UPDATE erp_tax_payment_types SET TaxType=%s, `Description`=%s WHERE TaxTypeID=%s",
                       GetSQLValueString($_POST['TaxType'], "text"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['TaxTypeID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

$maxRows_RS_ShowTaxPaymentTypes = 20;
$pageNum_RS_ShowTaxPaymentTypes = 0;
if (isset($_GET['pageNum_RS_ShowTaxPaymentTypes'])) {
  $pageNum_RS_ShowTaxPaymentTypes = $_GET['pageNum_RS_ShowTaxPaymentTypes'];
}
$startRow_RS_ShowTaxPaymentTypes = $pageNum_RS_ShowTaxPaymentTypes * $maxRows_RS_ShowTaxPaymentTypes;

mysql_select_db($database_Conn, $Conn);
$query_RS_ShowTaxPaymentTypes = "SELECT * FROM erp_tax_payment_types";

// Search Code Start Here
if(isset($_POST['txtSearch']) && strlen($_POST['txtSearch'])>0) {
	
$query_RS_ShowTaxPaymentTypes = "SELECT * FROM erp_tax_payment_types WHERE erp_tax_payment_types.TaxType Like '%" . $_POST['txtSearch'] ."'";		
}
// End of Search Code

$query_limit_RS_ShowTaxPaymentTypes = sprintf("%s LIMIT %d, %d", $query_RS_ShowTaxPaymentTypes, $startRow_RS_ShowTaxPaymentTypes, $maxRows_RS_ShowTaxPaymentTypes);
$RS_ShowTaxPaymentTypes = mysql_query($query_limit_RS_ShowTaxPaymentTypes, $Conn) or die(mysql_error());
$row_RS_ShowTaxPaymentTypes = mysql_fetch_assoc($RS_ShowTaxPaymentTypes);

if (isset($_GET['totalRows_RS_ShowTaxPaymentTypes'])) {
  $totalRows_RS_ShowTaxPaymentTypes = $_GET['totalRows_RS_ShowTaxPaymentTypes'];
} else {
  $all_RS_ShowTaxPaymentTypes = mysql_query($query_RS_ShowTaxPaymentTypes);
  $totalRows_RS_ShowTaxPaymentTypes = mysql_num_rows($all_RS_ShowTaxPaymentTypes);
}
$totalPages_RS_ShowTaxPaymentTypes = ceil($totalRows_RS_ShowTaxPaymentTypes/$maxRows_RS_ShowTaxPaymentTypes)-1;

$colname_RS_GetSelectedTaxPayment = "-1";
if (isset($_GET['EditID'])) {
  $colname_RS_GetSelectedTaxPayment = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_RS_GetSelectedTaxPayment = sprintf("SELECT * FROM erp_tax_payment_types WHERE TaxTypeID = %s", GetSQLValueString($colname_RS_GetSelectedTaxPayment, "int"));
$RS_GetSelectedTaxPayment = mysql_query($query_RS_GetSelectedTaxPayment, $Conn) or die(mysql_error());
$row_RS_GetSelectedTaxPayment = mysql_fetch_assoc($RS_GetSelectedTaxPayment);
$totalRows_RS_GetSelectedTaxPayment = mysql_num_rows($RS_GetSelectedTaxPayment);
?>
<?php if ($totalRows_RS_GetSelectedTaxPayment == 0) { // Show if recordset empty ?>
  <div class="1">
    <h2>Tax Details</h2>
    <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">TaxType:</td>
          <td><input type="text" name="TaxType" value="" size="32"></td>
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
<?php if ($totalRows_RS_GetSelectedTaxPayment > 0) { // Show if recordset not empty ?>
  <div class="1">
    <h2>Edit Details</h2>
    <form method="post" name="form3" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right">TaxType:</td>
          <td><input type="text" name="TaxType" value="<?php echo htmlentities($row_RS_GetSelectedTaxPayment['TaxType'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">Description:</td>
          <td><input type="text" name="Description" value="<?php echo htmlentities($row_RS_GetSelectedTaxPayment['Description'], ENT_COMPAT, ''); ?>" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right">&nbsp;</td>
          <td><input type="submit" value="Update record"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form3">
      <input type="hidden" name="TaxTypeID" value="<?php echo $row_RS_GetSelectedTaxPayment['TaxTypeID']; ?>">
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
<h2>View Details</h2>
<form name="form1" method="post" action="">
  <table border="1">
    <tr>
      <th colspan="2">Action</th>
      <th>TaxType</th>
      <th>Description</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><a href="?DeleteID=<?php echo $row_RS_ShowTaxPaymentTypes['TaxTypeID']; ?>">Delete</a></td>
        <td><a href="?EditID=<?php echo $row_RS_ShowTaxPaymentTypes['TaxTypeID']; ?>">Edit</a></td>
        <td><?php echo $row_RS_ShowTaxPaymentTypes['TaxType']; ?></td>
        <td><?php echo $row_RS_ShowTaxPaymentTypes['Description']; ?></td>
      </tr>
      <?php } while ($row_RS_ShowTaxPaymentTypes = mysql_fetch_assoc($RS_ShowTaxPaymentTypes)); ?>
  </table>
</form>
</div>
&nbsp;
<div class="1"></div>
<?php
mysql_free_result($RS_ShowTaxPaymentTypes);

mysql_free_result($RS_GetSelectedTaxPayment);
?>
