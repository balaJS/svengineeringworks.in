<?php
session_start();
if(!isset($_SESSION['user'])){
	header('location:index.php');
}

include 'config.php';

$query="select * from customers";
$source=mysqli_query($conn,$query);
$customers=array();

while($data=mysqli_fetch_assoc($source)){
	
	if($data['status']==='Y'){
		$customers['active'][]=$data;
	}else{
		$customers['inactive'][]=$data;
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>AMC list</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include 'script.php';?>
  <!-- data tables examples -->
  <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js" type="text/javascript"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css">

</head>
<body>
<?php include 'navbar.php';?>
<div class="container-fluid">
  <h2>Customer list</h2>
  <div class="row">
  	<div class="col-md-6">
		  <table class="table table-bordered ui celled" id="activecustomer">
			    <thead>
			      <tr>
			      	<th>Serial no</th>
			        <th>Name</th>
			        <th>Amount</th>
			        <th>Mobile</th>
			        <!-- <th>Email</th>
			        <th>Address</th> -->
			        <th>Date</th>
			        <th>Action</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php $i=1; foreach ($customers['active'] as $key => $value) {?>
			    
			      <tr>
			      	<td><?php echo $i;?></td>
			        <td><?php echo $value['name'];?></td>
			        <td><?php echo $value['amount'];?></td>
			        <td><?php echo $value['mobile'];?></td>
			        <!-- <td><?php echo $value['email'];?></td>
			        <td><?php echo $value['address'];?></td> -->
			        <td><?php echo $value['sending_date'];?></td>
			        <td><a href="index2.php?value=<?php echo $value['id'];?>">Edit</a></td>
			      </tr>
			      <?php $i++; }?>
			    </tbody>
			</table>  		
  	</div>
  	<div class="col-md-6">
  		  <table class="table table-bordered ui celled" id="inactivecustomer">
		    <thead>
		      <tr>
		      	<th>Serial no</th>
		        <th>Name</th>
		        <th>Amount</th>
		        <th>Mobile</th>
		        <!-- <th>Email</th>
		        <th>Address</th> -->
		        <th>Date</th>
		        <th>Action</th>
		      </tr>
		    </thead>
		    <tbody>
		    <?php $i=1; foreach ($customers['inactive'] as $key => $value) {?>
		    
		      <tr>
		      	<td><?php echo $i;?></td>
		        <td><?php echo $value['name'];?></td>
		        <td><?php echo $value['amount'];?></td>
		        <td><?php echo $value['mobile'];?></td>
		        <!-- <td><?php echo $value['email'];?></td>
		        <td><?php echo $value['address'];?></td> -->
		        <td><?php echo $value['sending_date'];?></td>
		        <td><a href="index2.php?value=<?php echo $value['id'];?>">Edit</a></td>
		      </tr>
		      <?php $i++; }?>
		    </tbody>
		  </table>
  	</div>
  </div>

</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#activecustomer').DataTable();
	    $('#inactivecustomer').DataTable();
	} );
</script>
</body>
</html>
