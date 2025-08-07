<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql ="UPDATE editography_order set billno='$_POST[billno]',employee_id='$_SESSION[employee_id]',customer_id='$_POST[customer_id]',orderdate='$dt',reqdate='$_POST[reqdate]',status='Active' WHERE status='Pending'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);

	$sql = "INSERT INTO payment(paymentid,editographyorderid,transactiontype,customer_id,paid_amt,paymentdate,note,status)
	VALUES('$_POST[paymentid]','$_POST[billno]','$_POST[transactiontype]','$_POST[customer_id]','$_POST[paid_amt]','$dt','$_POST[note]','Active')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		$insid = mysqli_insert_id($con);
		echo "<script>alert('Editography payment done successfully..')</script>";
		echo "<script>window.location='editographybill.php?billid=$insid';</script>";
	}
}
else
{
	$sqlDELETE="DELETE FROM editography_order where status='Pending'";
	mysqli_query($con,$sqlDELETE);
}
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM editography_order LEFT JOIN editography ON editography.editography_id = editography_order.editographyorder_id WHERE editographyorderid='$_GET[editid]' ";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?> 
<style>
	.table>thead:first-child>tr:first-child>th {
    border-top: 0;
    background: deeppink;}
</style>
<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"> <span>Editography Order</span></h2>
						<p >Kindly enter the Editography Order..</p>
    				</div>
					<?php
					//include("sidebar.php");
					?>
    				<div class="col-md-12 col-sm-12 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
					
				<form action="" method="post">
				
					<div  class="col-md-4" >
						<label>Bill No.</label>
						<input class="form-control" type="text" name="billno" id="billno" readonly value="<?php 
						$sql = "SELECT MAX(billno) FROM editography_order where status='Active'";
						$qsql = mysqli_query($con,$sql);
						$rs = mysqli_fetch_array($qsql);
						echo $rs[0] + 1;
						?>" style="background-color: white;color: black;" >
					</div>
					
				<div class="col-md-4">	
						<label>Customer</label>
						<select class="form-control" name="customer_id" id="customer_id" style="color: black;">
							<option value=''>Select Customer</option>
							<?php
							$sqlcustomer = "SELECT * FROM customer where status='Active'";
							$qsqlcustomer = mysqli_query($con,$sqlcustomer);
							while($rscustomer = mysqli_fetch_array($qsqlcustomer))
							{
								if($rscustomer['customer_id']==$rsedit['customer_id'])
								{
									echo "<option value='$rscustomer[customer_id]' selected>$rscustomer[customer_name]</option>";
								}
								else
								{
									echo "<option value='$rscustomer[customer_id]'>$rscustomer[customer_name]</option>";
								}
							}
							?>
						</select>
				</div>
				<div  class="col-md-4" >
					<label>Request Date</label>
					<input class="form-control" type="date" name="reqdate" id="reqdate" placeholder="Request date" value="<?php echo $rsedit['deliverydate']; ?>" >
				</div>
					<div class="clearfix"> </div>
			<hr>
			</div>
  			<div class="contact-form" style="width:100%;">
				<div  class="col-md-4" >
						<label>Editography Type</label>
						<select class="form-control" name="editographytypeid" id="editographytypeid" onchange="loaddefaultprice(this.value)" style="color: black;">
							<option value=''>Select</option>
							<?php
							$sqleditographytype = "SELECT * FROM editography where status='Active'";
							$qsqleditographytype = mysqli_query($con,$sqleditographytype);
							while($rseditographytype = mysqli_fetch_array($qsqleditographytype))
							{
								if($rseditographytype['editography_id']==$rsedit['editography_id'])
								{
									echo "<option value='$rseditographytype[editography_id]' selected >$rseditographytype[editography_type]</option>";
								}
								else
								{
									echo "<option value='$rseditographytype[editography_id]' >$rseditographytype[editography_type]</option>";
								}
							}
							?>
						</select>
				</div>
				<div class="col-md-3" id="divdefaultprice">
					<label>Cost</label>
					<input class="form-control" type="text" name="cost" id="cost" placeholder="Cost" value="<?php echo $rsedit['cost']; ?>"  onkeyup="changetotal(cost.value,qty.value)"  onchange="changetotal(cost.value,qty.value)" >
				</div>
				<div class="col-md-2">
					<label>Quantity</label>
					<input class="form-control" type="text" name="qty" id="qty" placeholder="Quantity" value="1" onkeyup="changetotal(cost.value,qty.value)"  onchange="changetotal(cost.value,qty.value)" >
				</div> 
				<div class="col-md-3" id="divdefaultprice">
					<label>Total Cost</label>
					<input class="form-control" type="text" name="tcost" id="tcost" placeholder="Total Cost"  >
				</div>
				<div class="col-md-12">
					<label>Description or editography matter:</label>
					<textarea class='form-control' name="description" id="description" placeholder="Enter description here"><?php echo $rsedit['description']; ?></textarea>
				</div>
				<div class="col-md-4">
					<button class="form-control" name="btnadd" id="btnadd" value="Add" type="button" >Add</button>
				</div>
					
				<div class="clearfix"> </div>	
					
				<div class="col-md-12" id="divvieworderededitography">
					<hr>
					<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr style="background-color:deeppink;color:white;">
								<th>Editography type</th>
								<th>Cost</th>
								<th>Quantity</th>
								<th>Total</th>
								<th style="width:10px;"><center>Delete</center></th>
							</tr>
						</thead>
						<tbody>
							<tr style="background-color:deeppink;color:white;">
								<td colspan="5" style="text-align: center;">Not added Any items</td>
							</tr>
						</tbody>
					</table>
				</div>
					
					<div class="clearfix"> </div>
			</div>
			
			
			
			<div class="contact-form" style="width:100%;">

					<div class="col-md-4">
						<label>Total Amount</label>
						<input class="form-control" type="text" name="totalamt" id="totalamt" placeholder="Total Amount"  style="background-color: white;color:yellow;" readonly  >
					</div>
					<div class="col-md-4">
						<label>Paid Amount</label>
						<input class="form-control" type="text" name="paid_amt" id="paid_amt" placeholder="Paid Amount" value="0" onkeyup="calculateamt()"  onchange="calculateamt()">
					</div>
					<div class="col-md-4">
						<label>Balance Amount</label>
						<input class="form-control" type="text" name="balamt" id="balamt" placeholder="Balance Amount"  style="background-color: white;color:yellow;" readonly >
					</div>
						
					<div class="form-left col-md-12">
						<label>Payment Type</label>
						<select class="form-control" name="transactiontype" id="transactiontype" onchange="funpaymenttype(this.value)">
						<option value='' style='color: red;'>Select payment type</option>
						<?php
						$arr = array("UPI","Cash payment","Cheque");
						foreach($arr as $value)
						{
								echo "<option value='$value' style='color: red;'>$value</option>";
						}
						?>
						</select>
					</div>
					<div class="col-md-12">
						<label>Note</label>
						<textarea class='form-control' name="note" placeholder="Enter note here"><?php echo $rsedit['description']; ?></textarea>
					</div>
					<center><input class="form-control" type="submit" name="submit" value="Click here to Complete the order" ></center>
					<div class="clearfix"> </div>
			</div>
			
				</form>
					
					</div>

    			</div>
    		</div>
    	</section>
    	<!-- end contact -->
<?php
include("footer.php");
?>
<script>
function loaddefaultprice(defaultcostid)
{
	    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cost").value = this.responseText;
				//alert(this.responseText);
				changetotal(this.responseText,document.getElementById("qty").value);
            }
        };
        xmlhttp.open("GET","ajaxdefaultprice.php?defaultcostid="+defaultcostid,true);
        xmlhttp.send();
}

function changetotal(itemcost,qty)
{
	document.getElementById("tcost").value = itemcost * qty;
}

$(document).ready(function(){
    $("#btnadd").click(function(){
		var billno = document.getElementById("billno").value;
		var customer_id = document.getElementById("customer_id").value;
		var editographytypeid = document.getElementById("editographytypeid").value;
		var cost = document.getElementById("cost").value;
		var qty =  document.getElementById("qty").value;
		var description = document.getElementById("description").value;
		var reqdate = document.getElementById("reqdate").value;
		
        $.post("jseditographyorder.php",
        {
			billno: billno,
			editographytypeid: editographytypeid,
			cost: cost,
			qty: qty,
			description: description,
			customer_id: customer_id,
			reqdate: reqdate		  
        },
        function(data,status){
			document.getElementById("editographytypeid").value="Select";
			document.getElementById("cost").value="";
			document.getElementById("qty").value="1";
			document.getElementById("description").value="";
			document.getElementById("tcost").value="";	
			document.getElementById("divvieworderededitography").innerHTML =data;			
           	// alert("Data: " + data + "\nStatus: " + status);
		  	document.getElementById("totalamt").value = document.getElementById("amt").value;
		   	calculateamt();
        });
    });
});
function deleterecord(delid)
{
	    $.post("jseditographyorder.php",
        {
			delid: delid		  
        },
        function(data,status)
		{
		document.getElementById("divvieworderededitography").innerHTML =data;
		// alert("Data: " + data + "\nStatus: " + status);
        });
}
function calculateamt()
{
	document.getElementById("balamt").value = parseFloat(document.getElementById("totalamt").value) - parseFloat(document.getElementById("paid_amt").value);
}
</script>