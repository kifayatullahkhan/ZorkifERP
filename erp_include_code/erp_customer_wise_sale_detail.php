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
$Customer_name=$_POST['CustomerName'];
// POST Form 

mysql_select_db($database_Conn, $Conn);
$query_RS_CustomerWiseSalesDetail = "SELECT erp_customers.CustomerName, erp_customerorders.OrderReferenceNo, erp_inventoryitems.InvItemDescription,  erp_customerorders.OrderDate, erp_customerorders.OrderStatus,erp_customerorderdetails.Quantity,(erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) AS TotalPrice, erp_customerorderdetails.DiscountInPercentage,  ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100)AS TotalDiscount,  ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) -((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100))AS Credit FROM erp_customers JOIN erp_customerorders ON erp_customers.CustomerID = '$Customer_name' JOIN erp_inventoryitems ON  erp_inventoryitems.InvItemID = '$Item_name' JOIN erp_customerorderdetails ON erp_customerorders.CustomerOrderID = erp_customerorderdetails.CustomerOrderID WHERE erp_customerorders.CustomerID = '$Customer_name' AND erp_customerorderdetails.InvItemID= '$Item_name' ";
$RS_CustomerWiseSalesDetail = mysql_query($query_RS_CustomerWiseSalesDetail, $Conn) or die(mysql_error());
$row_RS_CustomerWiseSalesDetail = mysql_fetch_assoc($RS_CustomerWiseSalesDetail);
$totalRows_RS_CustomerWiseSalesDetail = mysql_num_rows($RS_CustomerWiseSalesDetail);
?>
<div class="1">
<h2>Customer and Item Sales Detail </h2>
  <form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>CustomerName</strong></td>
        <td><strong><?php echo $row_RS_CustomerWiseSalesDetail['CustomerName']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>ItemDescription</strong></td>
        <td><strong><?php echo $row_RS_CustomerWiseSalesDetail['InvItemDescription']; ?></strong>      </td>
        <tr>
        <td><strong>OrderStatus</strong></td>
        <td><strong><?php echo $row_RS_CustomerWiseSalesDetail['OrderStatus']; ?></strong></td>
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
      <?php $Debit=0; $C_Debit=0; $C_Credit=0; do { ?>
        <tr>
          <td><?php echo $row_RS_CustomerWiseSalesDetail['OrderReferenceNo']; ?></td>
          <td><?php echo $row_RS_CustomerWiseSalesDetail['OrderDate']; ?></td>
          <td><?php echo $row_RS_CustomerWiseSalesDetail['Quantity']; ?></td>
          <td><?php $Debit['Debit']; ?></td>
          <td><?php echo $row_RS_CustomerWiseSalesDetail['Credit']; ?></td>        
        </tr>
		<?php $C_Debit=$C_Debit+$Debit['Debit'];?>
		<?php $C_Credit=$C_Credit+$row_RS_CustomerWiseSalesDetail['Credit'];?>
		<?php } while ($row_RS_CustomerWiseSalesDetail = mysql_fetch_assoc($RS_CustomerWiseSalesDetail)); ?>
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
mysql_free_result($RS_CustomerWiseSalesDetail);
?>
