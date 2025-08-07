<div class="menu-wrap">
    <nav class="menu">
        <ul class="clearfix">
<?php
if(isset($_SESSION['employee_id']))
{
?>
			<li><a href="empaccount.php"  class="current-item">Dashboard</a></li>
			
			<li>
                <a href="#">My Account <span class="arrow">&#9660;</span></a>
 
                <ul class="sub-menu">
                    <li><a href="employeeprofile.php">Edit Profile</a></li>
                    <li><a href="updateemppassword.php">Change password</a></li>
                </ul>
				
            </li>
			<li>
                <a href="#">Settings<span class="arrow">&#9660;</span></a>
 
                <ul class="sub-menu">
                    <li><a href="location.php">Add Location</a></li>
                    <li><a href="viewlocation.php">View Location</a></li>
                </ul>
				
            </li>
			<li>
                <a href="#">Customer<span class="arrow">&#9660;</span></a>
 
                <ul class="sub-menu">
                    <li><a href="customer.php">Add Customer</a></li>
                    <li><a href="viewcustomer.php">View Customer</a></li>
                </ul>
				
            </li>
			
			<li>
                <a href="#">Employee <span class="arrow">&#9660;</span></a>
 
                <ul class="sub-menu">
                    <li><a href="employee.php">Add Employee</a></li>
                    <li><a href="viewemployee.php?emptype=Administrator">View Administrators</a></li>
                    <li><a href="viewemployee.php?emptype=Staff">View Staffs</a></li>
                    <li><a href="viewemployee.php?emptype=Photographer">View Photographers</a></li>
                    <li><a href="viewemployee.php?emptype=Editor">View Editors</a></li>
                    <li><a href="viewemployee.php?emptype=Event Manager">View Event Managers</a></li>
                </ul>
				
            </li>
			<li>
                <a href="#">Event Package<span class="arrow">&#9660;</span></a>
                <ul class="sub-menu">
                    <li><a href="eventpackage.php">Add package</a></li>
                    <li><a href="vieweventpackage.php">View package</a></li>
                    <li><a href="eventtype.php">Add Event type</a></li>
                    <li><a href="vieweventtype.php">View Event type</a></li>
                </ul>
			</li>
			<li>
                <a href="#">Editography<span class="arrow">&#9660;</span></a>
                <ul class="sub-menu">
                    <li><a href="editographyorder.php">New order</a></li>
                    <li><a href="vieweditographypayment.php">View Editography Orders</a></li>
                    <li><a href="editographytype.php">Editography type</a></li>
                    <li><a href="vieweditographytype.php">View Editography type</a></li>
                </ul>
			</li>
			<li>
                <a href="#">Orders<span class="arrow">&#9660;</span></a>
 
                <ul class="sub-menu">
                    <li><a href="editographyorder.php">Editography</a></li>
                    <li><a href="displaylocation.php?selected=Event">Event booking</a></li>
                    <li><a href="displaylocation.php?selected=Photographer">Photographers booking</a></li>
                </ul>
				
            </li>
				<li>
                <a href="#">Report<span class="arrow">&#9660;</span></a>
 
                <ul class="sub-menu">
					<li><a href="vieweventbookingrecord.php">Event booking report</a></li>
					<li><a href="viewphotographybooking.php">Photography booking report</a></li>
					<li><a href="vieweditographyorder.php">Editography booking report</a></li>
                    <li><a href="viewpayment.php">Payment report</a></li>
                   
                </ul>
				</li>
				
				<li><a href="logout.php"  class="current-item">Logout</a></li>
            
<?php
}
if(isset($_SESSION['customer_id']))
{
?>
				<li><a href="customeraccount.php"  class="current-item">Account</a></li>
				
				<li>
					<a href="#">Profile<span class="arrow">&#9660;</span></a>
	 
					<ul class="sub-menu">
						<li><a href="customerprofile.php">Customer profile</a></li>
						<li><a href="updatecustpassword.php">Change password</a></li>
					</ul>
				</li>
				
				<li><a href="vieweventbookingrecord.php"  class="current-item">Event Booking</a></li>	
				
				<li><a href="viewphotographybooking.php"  class="current-item">Photography Booking</a></li>	
				
				<li><a href="logout.php"  class="current-item">Logout</a></li>
<?php
}
?>
    </nav>
</div>
<style>
 
.clearfix:after {
    display:block;
    clear:both;
}
 
/*----- Menu Outline -----*/
.menu-wrap {
    width:100%;
    box-shadow:0px 1px 3px rgba(0,0,0,0.2);
    background:#131212;
}
 
.menu {
    width:100%;
    margin:0px auto;
    background: white;
}
 
.menu li {
    margin:0px;
    list-style:none;
    font-family:'Ek Mukta';
}
 
.menu a {
    transition:all linear 0.15s;
    color:black;
    background: #fff;
}
 
.menu li:hover > a, .menu .current-item > a {
    text-decoration:none;
    color:#ffffff;
}
 
.menu .arrow {
    font-size:11px;
    line-height:0%;
}
 
/*----- Top Level -----*/
.menu > ul > li {
    float:left;
    display:inline-block;
    position:relative;
    font-size:19px;
}
 
.menu > ul > li > a {
    padding:10px 30px;
    display:inline-block;
    color: black;
    text-shadow:0px 1px 0px rgba(0,0,0,0.4);
}
 
.menu > ul > li:hover > a, .menu > ul > .current-item > a {
    background:#fff;
    color: black;
}
 
/*----- Bottom Level -----*/
.menu li:hover .sub-menu {
    z-index:1;
    opacity:1;
}
 
.sub-menu {
    width:160%;
    padding:5px 0px;
    position:absolute;
    top:100%;
    left:0px;
    z-index:-1;
    opacity:0;
    transition:opacity linear 0.15s;
    box-shadow:0px 2px 3px rgba(0,0,0,0.2);
    background:#fff;
}
 
.sub-menu li {
    display:block;
    font-size:16px;
}
 
.sub-menu li a {
    padding:10px 30px;
    display:block;
}
 
.sub-menu li a:hover, .sub-menu .current-item a {
    background:#000000;
}
</style>