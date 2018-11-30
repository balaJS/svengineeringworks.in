<?php
session_start();
if(!isset($_SESSION['user'])){
	header('location:index.php');
}

?>
<html>
	<head>
		<title>AMC application</title>
		<!-- scripts & css links start -->
		<?php include 'script.php';?>
		<!-- scripts & css links close-->
	</head>

	<body>
		<?php include 'navbar.php';?>
		<?php if(!isset($_GET['value'])){ ?>
		<div class="container insertsection">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-5">
					<form action="backend.php" method="post" enctype="#">

						<div class="form-group">
						    <label for="name">Name:</label>
						    <input type="text" class="form-control" name="name" id="name" required>
						</div>

						<div class="form-group">
						    <label for="email">Email:</label>
						    <input type="email" class="form-control" name="email" id="email">
						</div>

						<div class="form-group">
						    <label for="mobile">Mobile:</label>
						    <input type="text" class="form-control" name="mobile" id="mobile" required>
						</div>

						<div class="form-group">
						    <label for="address">Address:</label>
						    <textarea class="form-control" name="address" id="address"></textarea><br>
						</div>

						<div class="form-group">
						    <label for="dates">Date:</label>
						    <input type="date" class="form-control" name="sms_sending_date" id="dates" required>
						</div>

						<div class="form-group">
						    <button type="submit" class="form-control btn btn-primary" name="amc-insert-btn">Add</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	<?php
	 }else{ 
	 	include 'config.php';
	 	$id=$_GET['value'];
	 	$query="select * from customers where status='Y' && id='$id'";
		$source=mysqli_query($conn,$query);
		$data=mysqli_fetch_assoc($source);
	 ?>

		<div class="container editsection">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-5">
					<form action="backend.php" method="post" enctype="#">

						<div class="form-group">
						    <label for="name">Name:</label>
						    <input type="text" class="form-control" name="name" required value="<?php echo $data['name'];?>">
						</div>

						<div class="form-group">
						    <label for="email">Email:</label>
						    <input type="email" class="form-control" name="email" value="<?php echo $data['email'];?>">
						</div>

						<div class="form-group">
						    <label for="mobile">Mobile:</label>
						    <input type="text" class="form-control" name="mobile" required value="<?php echo $data['mobile'];?>">
						</div>

						<div class="form-group">
						    <label for="address">Address:</label>
						    <textarea class="form-control" name="address"> <?php echo $data['address'];?></textarea>
						</div>

						<div class="form-group">
						    <label for="dates">Date:</label>
						    <input type="date" class="form-control" name="sms_sending_date" required value="<?php echo $data['sending_date'];?>">
						</div>

						<div class="form-group">
							<input type="hidden" name="id" required value="<?php echo $data['id'];?>">
							<button type="submit" class="form-control btn btn-primary" name="amc-update-btn">Update</button>
						</div>


					</form>
				</div>
			</div>
		</div>
	<?php }?>

		<div class="container">
			Msg:<br>
			S.V.ENGINEERING,<br>
			Mr.Amuthan,<br>
			Your machine service experiy date 05.04.2018.We will coming for monthly maintence on 06.04.2018.
			monthly maintence service charge is Rs.1000 only.
			Thank you S.V engg.<br>
			Customer care number - 9843317798.<br>
			Click here <link> for more details.
		</div>
	</body>
</html>