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
$Item_name=$_POST['ItemName'];
//POST Form 

mysql_select_db($database_Conn, $Conn);
$query_RS_ItemWiseSalesDetail = "SELECT erp_inventoryitems.InvItemDescription,  erp_customerorders.OrderReferenceNo,   erp_customerorders.OrderDate, erp_customerorders.OrderStatus,erp_customerorderdetails.Quantity,(erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) AS TotalPrice,  erp_customerorderdetails.DiscountInPercentage,  ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100)AS  TotalDiscount,  ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) -((erp_customerorderdetails.Quantity*  erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100))AS Credit FROM erp_customers JOIN erp_customerorders ON  erp_customerorders.CustomerID = erp_customers.CustomerID JOIN erp_customerorderdetails ON erp_customerorders.CustomerOrderID = erp_customerorderdetails.CustomerOrderID JOIN erp_inventoryitems ON  erp_inventoryitems.InvItemID = erp_customerorderdetails.InvItemID WHERE erp_inventoryitems.InvItemID = '$Item_name' ";
$RS_ItemWiseSalesDetail = mysql_query($query_RS_ItemWiseSalesDetail, $Conn) or die(mysql_error());
$row_RS_ItemWiseSalesDetail = mysql_fetch_assoc($RS_ItemWiseSalesDetail);
$totalRows_RS_ItemWiseSalesDetail = mysql_num_rows($RS_ItemWiseSalesDetail);
?>
<div class="1">
<h2>Inventory Item Sales Detail</h2>
  <form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>ItemDescription</strong></td>
        <td><strong><?php echo $row_RS_ItemWiseSalesDetail['InvItemDescription']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>OrderStatus</strong></td>
        <td><strong><?php echo $row_RS_ItemWiseSalesDetail['OrderStatus']; ?></strong></td>
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
        <th>OrderReferenceNo</th>
        <th>OrderDate</th>
        <th>Quantity</th>
        <th>Debit</th>
        <th>Credit</th>
      </tr>
      <?php  $Debit=0; $C_Debit=0; $C_Credit=0; do { ?>
        <tr>
          <td><?php echo $row_RS_ItemWiseSalesDetail['OrderReferenceNo']; ?></td>
          <td><?php echo $row_RS_ItemWiseSalesDetail['OrderDate']; ?></td>
          <td><?php echo $row_RS_ItemWiseSalesDetail['Quantity']; ?></td>
          <td><?php $Debit['Debit']; ?></td>
          <td><?php echo $row_RS_ItemWiseSalesDetail['Credit']; ?></td>
        </tr> 
        <?php $C_Debit=$C_Debit+$Debit['Debit'];?>
		<?php $C_Credit=$C_Credit+$row_RS_ItemWiseSalesDetail['Credit'];?>
        <?php } while ($row_RS_ItemWiseSalesDetail = mysql_fetch_assoc($RS_ItemWiseSalesDetail)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>TotalAmount</strong></td>
          <td><strong>Dr : <?php echo $C_Debit;?></strong></td>
          <td><strong>Cr : <?php echo $C_Credit;?></strong></td>
        </tr>
       
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ItemWiseSalesDetail);
?>
