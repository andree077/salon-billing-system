<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPMS || Customer List</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet">
<link href="invoices.css" rel="stylesheet"> 

<!-- //font-awesome icons -->
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="invoices.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		 <?php include_once('includes/sidebar.php');?>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		 <?php include_once('includes/header.php');?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h3 class="title1">Invoice</h3>
		
					<form action="process_invoice.php" method="post">
					<div class="container">
					<input type="text" id="customerSearch" name="customerSearch" oninput="searchCustomers(this.value)">
						<div id="customerList" class="dropdown"></div>
					<table>
						<tr>
							<td>Name:</td>
							<td><input type="text" id="customerName" name="customerName"></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="text" id="customerEmail" name="customerEmail"></td>
						</tr>
						<tr>
							<td>Phone:</td>
							<td><input type="text" id="customerPhone" name="customerPhone"></td>
						</tr>
						<tr>
							<td>Gender:</td>
							<td><input type="text" id="customerGender" name="customerGender"></td>
						</tr>
					</table>
					
					<button id="addCustomerButton">Add New Customer</button>


				</div>
					<!-- Add other invoice fields here -->
					<div id="serviceDetails">
					<h2>Service Details</h2>
					<div class="service-row">
						<input type="text" id="service-name" class="service-name" placeholder="Service Name" oninput="searchServices(this.value)">
						<div id="serviceList" class="dropdown"></div>
						<input type="text" id="service-cost" class="service-cost" placeholder="Service Cost">
						<input type="text" id="employee-name" class="employee-name" placeholder="Employee Name" oninput="searchEmployees(this.value)">
						<div id="employeeList" class="dropdown"></div>
						<input type="text" id="tips" class="tips" placeholder="Tips">
					</div>
					<button type="button" id="addService">Add Service</button>
				</div>

				<div id="serviceTable" style="display: none;">
					<table>
						<thead>
							<tr>
								<th>Service Name</th>
								<th>Service Cost</th>
								<th>Employee Name</th>
								<th>Tips</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<!-- Service entries will be added here -->
						</tbody>
					</table>
				</div>

					<button type="button" id="generateInvoice">Generate Invoice</button>
					
					<div id="invoice"></div>
					</form>
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		 <?php include_once('includes/footer.php');?>
        <!--//footer-->
	</div>
	<!-- Classie -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js"> </script>
</body>
</html>
<?php }  ?>