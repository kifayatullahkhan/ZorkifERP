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

// POST Form 
$ckdateget=$_POST['From'];
		$dt_frm=$ckdateget;
			$ckday=substr($ckdateget,0,2);
			$ckmonth=substr($ckdateget,3,2);	
			$ckyear=substr($ckdateget,6,4);
			 $from="$ckyear-$ckmonth-$ckday";
		
$ckdateget=$_POST['To'];
		$dt_to=$ckdateget;
			$ckday=substr($ckdateget,0,2);
			$ckmonth=substr($ckdateget,3,2);	
			$ckyear=substr($ckdateget,6,4);
			 $to="$ckyear-$ckmonth-$ckday";
// POST Form 


mysql_select_db($database_Conn, $Conn);
$query_RS_PurchaseStock = "SELECT  erp_werehouses.WHName , erp_productionitems.PItemDescription , erp_productionitemtype.PITypeName , erp_productionitemunittypes.PIUTName , erp_purchaseordersproformainvoicedetails. Price_Per_Unit , erp_purchaseordersproformainvoicedetails.Quantity , SUM(erp_productionitemsusage.QuantityUsed ) AS ItemUsed  FROM erp_productionitems JOIN  erp_productionitemsusage ON  erp_productionitemsusage.PItemID =  erp_productionitems.PItemID JOIN   erp_purchaseordersproformainvoicedetails ON    erp_purchaseordersproformainvoicedetails.PItemID =  erp_productionitems.PItemID JOIN   erp_werehouses ON    erp_werehouses.WHID = erp_productionitems.WHID JOIN   erp_productionitemtype ON   erp_productionitemtype.PITID = erp_productionitems.PITID JOIN erp_productionitemunittypes ON  erp_productionitemunittypes.PIUTID = erp_productionitems.PIUTID JOIN  erp_purchaseordersproformainvoice ON   erp_purchaseordersproformainvoicedetails.POPIID = erp_purchaseordersproformainvoice.POPIID  WHERE erp_purchaseordersproformainvoice.OrderDate BETWEEN '$from' AND '$to' AND erp_purchaseordersproformainvoice.OrderStatus = 'DONE' AND erp_productionitems.PItemID = erp_purchaseordersproformainvoicedetails.PItemID  GROUP BY  erp_productionitems.PItemID ORDER BY erp_productionitems.PItemID";
$RS_PurchaseStock = mysql_query($query_RS_PurchaseStock, $Conn) or die(mysql_error());
$row_RS_PurchaseStock = mysql_fetch_assoc($RS_PurchaseStock);
$totalRows_RS_PurchaseStock = mysql_num_rows($RS_PurchaseStock);
?>
<div class="1">
<h2>Purchased Items Stock Postion</h2>
  <form id="form1" name="form1" method="post" action="">
   <table width="200" border="1">
     <tr>
        <td><strong>From</strong></td>
        <td><strong><?php echo $ckdateget=$_POST['From']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>To</strong></td>
        <td><strong><?php echo $ckdateget=$_POST['To']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>WareHouseName</strong></td>
        <td><strong><?php echo $row_RS_PurchaseStock['WHName']; ?></strong></td>
      </tr>
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
        <th>PItemDescription</th>
        <th>PITypeName</th>
        <th>PIUTName</th>
        <th>Price_Per_Unit</th>
        <th>Quantity</th>
        <th>ItemUsed</th>
        <th>ItemLeft</th>
      </tr>
      <?php $QtyIn =0; $QtyOut=0; do { ?>
        <tr>
          <td><?php echo $row_RS_PurchaseStock['PItemDescription']; ?></td>
          <td><?php echo $row_RS_PurchaseStock['PITypeName']; ?></td>
          <td><?php echo $row_RS_PurchaseStock['PIUTName']; ?></td>
          <td><?php echo $row_RS_PurchaseStock['Price_Per_Unit']; ?></td>
          <td><?php echo $QtyIn=$row_RS_PurchaseStock['Quantity']; ?></td>
          <td><?php echo $QtyOut=$row_RS_PurchaseStock['ItemUsed']; ?></td>
          <td><?php echo $QtyIn-$QtyOut; ?></td>
        </tr>
        <?php } while ($row_RS_PurchaseStock = mysql_fetch_assoc($RS_PurchaseStock)); ?>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_PurchaseStock);
?>
