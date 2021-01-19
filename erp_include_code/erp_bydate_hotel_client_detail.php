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
$query_RS_HotelClient = "SELECT hotel_client_details.FullName, hotel_client_details.StartDate, hotel_client_details.StartTime, hotel_client_details.EndDate, hotel_client_details.EndTime, hotel_client_details.AgreementSerialNo,hotel_reservations_types.ReservationTypeName, hotel_rooms_or_sections.RoomNoSectionName, hotel_client_details.SecurityAmount, hotel_client_details.SecurityDeducted, hotel_client_details.AdvanceAmount, hotel_client_details.BalanceAmount, hotel_client_details.OtherCharges, hotel_client_details.TotalAmountPaid  FROM hotel_client_details JOIN  hotel_reservations_types  ON hotel_client_details.ReservationTypeID = hotel_reservations_types.ReservationTypeID JOIN hotel_rooms_or_sections ON hotel_client_details.RoomSectionID = hotel_rooms_or_sections.RoomSectionID WHERE hotel_client_details.StartDate BETWEEN '$from' AND '$to' ";
$RS_HotelClient = mysql_query($query_RS_HotelClient, $Conn) or die(mysql_error());
$row_RS_HotelClient = mysql_fetch_assoc($RS_HotelClient);
$totalRows_RS_HotelClient = mysql_num_rows($RS_HotelClient);
?>
<div class="1">
<h2>By Date Hotel Client Detail</h2>
  <form name="form1" method="post" action="">
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
        <th>ClientName</th>
        <th>StartDate</th>
        <th>StartTime</th>
        <th>AgreementSerialNo</th>
        <th>ReservationTypeName</th>
        <th>RoomNoSectionName</th>
        <th>SecurityAmount</th>
        <th>SecurityDeducted</th>
        <th>AdvanceAmount</th>
        <th>BalanceAmount</th>
        <th>OtherCharges</th>
        <th>TotalAmountPaid</th>
      </tr>
      <?php $TotalAmount=0; do { ?>
        <tr>
          <td><?php echo $row_RS_HotelClient['FullName']; ?></td>
          <td><?php echo $row_RS_HotelClient['StartDate']; ?></td>
          <td><?php echo $row_RS_HotelClient['StartTime']; ?></td>
          <td><?php echo $row_RS_HotelClient['AgreementSerialNo']; ?></td>
          <td><?php echo $row_RS_HotelClient['ReservationTypeName']; ?></td>
          <td><?php echo $row_RS_HotelClient['RoomNoSectionName']; ?></td>
          <td><?php echo $row_RS_HotelClient['SecurityAmount']; ?></td>
          <td><?php echo $row_RS_HotelClient['SecurityDeducted']; ?></td>
          <td><?php echo $row_RS_HotelClient['AdvanceAmount']; ?></td>
          <td><?php echo $row_RS_HotelClient['BalanceAmount']; ?></td>
          <td><?php echo $row_RS_HotelClient['OtherCharges']; ?></td>
          <td><?php echo $row_RS_HotelClient['TotalAmountPaid']; ?></td>
        </tr>
        <?php $TotalAmount=$TotalAmount+$row_RS_HotelClient['TotalAmountPaid'];?>
        <?php } while ($row_RS_HotelClient = mysql_fetch_assoc($RS_HotelClient)); ?>
         <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><strong>Amount Paid</strong></td>
          <td><strong><?php echo $TotalAmount; ?></strong></td>
        </tr>
    </table>
  </form>
</div>
<?php
mysql_free_result($RS_HotelClient);
?>
