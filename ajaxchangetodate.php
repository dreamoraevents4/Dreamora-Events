<input type="date" class="form-control" name="bookingtdate" id='bookingtdate' placeholder="To date" max="
<?php 
    echo  date('Y-m-d', strtotime("+365 days"));
 ?>
 "  min="
 <?php echo $_GET['fdate'];
  ?>
  " onchange='calculatedays(bookingfdate.value,bookingtdate.value)' >