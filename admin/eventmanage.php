<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator	</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
    <link href="path/to/component-chosen.min.css" rel="stylesheet">
    <!-- Table search and file export css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php"> <?php echo $_SESSION["user"]; ?> </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" href="home.php"><i class="fa fa-dashboard"></i> Status</a>
                    </li>
                   
					<li>
                        <a href="eventbook.php"><i class="fa fa-bar-chart-o"></i> Event Booking</a>
                    </li>
                    <li>
                        <a href="eventmanage.php"><i class="fa fa-bar-chart-o"></i> Event Managing</a>
                    </li>
                    <li>
                        <a href="payment.php"><i class="fa fa-qrcode"></i> Payment</a>
                    </li>
                   
                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                   


                    
					</ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Status <small>Event Managing </small>
                        </h1>
                        <div>
				<a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New Event</a>
			</div>
                    </div>
                </div>
<div>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="row">
			<?php
				if(isset($_SESSION['error'])){
					echo
					"
					<div class='alert alert-danger text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['error']."
					</div>
					";
					unset($_SESSION['error']);
				}
				if(isset($_SESSION['success'])){
					echo
					"
					<div class='alert alert-success text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['success']."
					</div>
					";
					unset($_SESSION['success']);
				}
			?>



			</div>
			
			</div> <br></br> 
			<div>
                <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<table id="dataTable" class="table table-bordered">
					<thead>
						<th>ID</th>
						<th>Event Name</th>
						<th>Decoration</th>
						<th>Planner's Name</th>
						<th>Contact No</th>
						<th>Event Price</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php
							include_once('connection.php');
							$sql = "SELECT * FROM eventmanage";

							//use for MySQLi-OOP
							$query = $conn->query($sql);
							while($row = $query->fetch_assoc()){
								echo 
								"<tr>
									<td>".$row['id']."</td>
									<td>".$row['ename']."</td>
									<td>".$row['decoration']."</td>
									<td>".$row['pname']."</td>
									<td>".$row['contact']."</td>
									<td>".$row['price']."</td>
									<td>
										<a href='#edit_".$row['id']."' class='btn btn-warning' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Edit</a>
										<a href='#delete_".$row['id']."' class='btn btn-danger' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
									</td>
								</tr>";
								include('eventedit_delete_modal.php');
							}

						?>
					</tbody>
				</table>
			</div></div></div></div>
	
	</div>
</div>
<?php include('eventadd_modal.php') ?>


<!-- datatable -->
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>


<!-- generate datatable on our table -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            order: [
                [4, 'asc']
            ],
            buttons: [
                'excel', 'csv', 'pdf', 'print'
            ]
        });
    });
</script>
</body>
</html>