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
$Customer_name=$_POST['CustomerName'];
// POST Form 

mysql_select_db($database_Conn, $Conn);
$query_RS_CustomerSale = "SELECT erp_customers.CustomerName, erp_customerorders.OrderReferenceNo, erp_inventoryitems.InvItemDescription,  erp_customerorders.OrderDate, erp_customerorders.OrderStatus,erp_customerorderdetails.Quantity, (erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) AS TotalPrice, erp_customerorderdetails.DiscountInPercentage,   ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100)AS TotalDiscount,   ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) -((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100))AS Credit FROM erp_customers  JOIN erp_customerorders  ON erp_customers.CustomerID = '$Customer_name'  JOIN erp_customerorderdetails  ON erp_customerorders.CustomerOrderID = erp_customerorderdetails.CustomerOrderID JOIN erp_inventoryitems  ON  erp_inventoryitems.InvItemID = erp_customerorderdetails.InvItemID   WHERE erp_customerorders.CustomerID = '$Customer_name' ";
$RS_CustomerSale = mysql_query($query_RS_CustomerSale, $Conn) or die(mysql_error());
$row_RS_CustomerSale = mysql_fetch_assoc($RS_CustomerSale);
$totalRows_RS_CustomerSale = mysql_num_rows($RS_CustomerSale);
?>
<div class="1">
<h2>By Customer Name Sale Detail</h2>
  <form name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>CustomerName</strong></td>
        <td><strong><?php echo $row_RS_CustomerSale['CustomerName']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>OrderStatus</strong></td>
        <td><strong><?php echo $row_RS_CustomerSale['OrderStatus']; ?></strong></td>
      </tr>
      <tr>
        <td><strong>SystemDate</strong></td>
        <td><strong><?php echo date('d-m-Y'); ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<div class="1">
  <form name="form2" method="post" action="">
    <table border="1">
      <tr>
        <th>OrderReferenceNo</th>
        <th>InvItemDescription</th>
        <th>OrderDate</th>
        <th>Quantity</th>
        <th>TotalPrice</th>
        <th>DiscountInPercentage</th>
        <th>TotalDiscount</th>
        <th>Debit</th>
        <th>Credit</th>
      </tr>
      <?php $Debit=0; $C_Debit=0; $C_Credit=0; do { ?>
        <tr>
          <td><?php echo $row_RS_CustomerSale['OrderReferenceNo']; ?></td>
          <td><?php echo $row_RS_CustomerSale['InvItemDescription']; ?></td>
          <td><?php echo $row_RS_CustomerSale['OrderDate']; ?></td>
          <td><?php echo $row_RS_CustomerSale['Quantity']; ?></td>
          <td><?php echo $row_RS_CustomerSale['TotalPrice']; ?></td>
          <td><?php echo $row_RS_CustomerSale['DiscountInPercentage']; ?></td>
          <td><?php echo $row_RS_CustomerSale['TotalDiscount']; ?></td>
          <td><?php $Debit['Debit']; ?></td>
          <td><?php echo $row_RS_CustomerSale['Credit']; ?></td>
        </tr>
        <?php $C_Debit=$C_Debit+$Debit['Debit'];?>
		<?php $C_Credit=$C_Credit+$row_RS_CustomerSale['Credit'];?>
        <?php } while ($row_RS_CustomerSale = mysql_fetch_assoc($RS_CustomerSale)); ?>
         <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
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
mysql_free_result($RS_CustomerSale);
?>
