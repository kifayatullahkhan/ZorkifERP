<?php mysql_select_db($database_Conn, $Conn); ?>
<link href="../include_code/CalendarControl.css" rel="stylesheet" type="text/css" >
<script src="../include_code/CalendarControl.js" language="javascript"></script>
<div class="1">
<h2> Complete Purchase Payment Detail </h2>
<form id="form2" name="form2" method="post" action="erp_complete_purchase_payment_detail.php">
  <table width="200" border="1">
    <tr>
      <th>From</th>
      <th>To</th>
      <th>&nbsp;</th>
    </tr>
    <tr>
      <td><label for="From"></label>
        <input type="text" name="From" id="From" onfocus="showCalendarControl(this);" value="<?php echo date("d-m-Y"); ?>"></td>
      <td><label for="To"></label>
        <input type="text" name="To" id="To" onfocus="showCalendarControl(this);" value="<?php echo date("d-m-Y"); ?>"></td>
        <td align="right"><input type="submit" name="Submit" id="Submit" value="Next" /> </td>
    </tr>
  </table>
</form>
</div>