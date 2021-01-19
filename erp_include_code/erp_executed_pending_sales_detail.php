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
$Status=$_POST['OrderStatus'];
//POST Form 

mysql_select_db($database_Conn, $Conn);
$query_RS_ExePenSalesDetail = "SELECT  erp_inventoryitems.InvItemDescription,  erp_customerorders.OrderReferenceNo,   erp_customerorders.OrderDate,erp_customerorders.OrderStatus, (erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) AS TotalPrice,  erp_customerorderdetails.DiscountInPercentage, erp_customerorderdetails.Quantity, ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100)AS  TotalDiscount,  ((erp_customerorderdetails.Quantity* erp_customerorderdetails.Price_Per_Unit) -((erp_customerorderdetails.Quantity*  erp_customerorderdetails.Price_Per_Unit)*erp_customerorderdetails.DiscountInPercentage/100))AS Credit FROM erp_customers JOIN erp_customerorders ON  erp_customerorders.CustomerID = erp_customers.CustomerID JOIN erp_customerorderdetails ON erp_customerorders.CustomerOrderID = erp_customerorderdetails.CustomerOrderID JOIN erp_inventoryitems ON  erp_inventoryitems.InvItemID = erp_customerorderdetails.InvItemID WHERE erp_customerorders.OrderStatus ='$Status'";
$RS_ExePenSalesDetail = mysql_query($query_RS_ExePenSalesDetail, $Conn) or die(mysql_error());
$row_RS_ExePenSalesDetail = mysql_fetch_assoc($RS_ExePenSalesDetail);
$totalRows_RS_ExePenSalesDetail = mysql_num_rows($RS_ExePenSalesDetail);
?>
<div class="1">
<h2>Executed and Pending Sales Orders Detail</h2>
  <form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
      <tr>
        <td><strong>OrderStatus</strong></td>
        <td><strong><?php echo $row_RS_ExePenSalesDetail['OrderStatus']; ?></strong></td>
      </tr>
    </table>
  </form>
</div>
<div class="1">
  <form id="form2" name="form2" method="post" action="">
    <table border="1">
      <tr>
        <th>InvItemDescription</th>
        <th>OrderReferenceNo</th>
        <th>OrderDate</th>
        <th>Quantity</th>
        <th>Credit</th>
        <th>Debit</th>
      </tr>
      <?php $Total_Amount=0; $Debit=0; $TotalAmount=0; do { ?>
        <tr>
          <td><?php echo $row_RS_ExePenSalesDetail['InvItemDescription']; ?></td>
          <td><?php echo $row_RS_ExePenSalesDetail['OrderReferenceNo']; ?></td>
          <td><?php echo $row_RS_ExePenSalesDetail['OrderDate']; ?></td>
          <td><?php echo $row_RS_ExePenSalesDetail['Quantity']; ?></td>
          <td><?php echo $row_RS_ExePenSalesDetail['Credit']; ?></td>
          <td><?php echo $Debit['Debit']; ?></td>
        </tr> 
		<?php $Total_Amount=$Total_Amount+$row_RS_ExePenSalesDetail['Credit'];?>
        <?php $TotalAmount=$TotalAmount+$Debit['Debit'];?>
        <?php } while ($row_RS_ExePenSalesDetail = mysql_fetch_assoc($RS_ExePenSalesDetail)); ?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>TotalAmount</strong></td>
          <td><strong><?php echo $Total_Amount;?></strong></td>
          <td><strong><?php echo $TotalAmount;?></strong></td>
        </tr>
       
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_ExePenSalesDetail);
?>
