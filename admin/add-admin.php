<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: admin.php?page=' . $corepage[0]);
	}
}

if (isset($_POST['addadmin'])) {
	$aId = $_POST['aId'];
	$titleName = $_POST['titleName'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$dob = $_POST['dob'];
	$nic = $_POST['nic'];
	$phone = $_POST['phone'];
	$gender = $_POST['gender'];

	$photo = explode('.', $_FILES['photo']['name']);
	$photo = end($photo);
	$photo_name = $aId . '.' . $photo;

	$email = $_POST['email'];
	$accessLevel = $_POST['accessLevel'];

	$key = rand(100, 100000);
	$password = $nic . '@' . $key;

	$query = "INSERT INTO `admin`(`aId`, `titleName`, `name`, `address`, `dob`, `nic`, `phone`, `password`, `gender`, `photo`, `email`, `accessLevel`)  VALUES ('$aId','$titleName','$name', '$address', '$dob','$nic','$phone','$password','$gender','$photo_name','$email','$accessLevel');";
	if (mysqli_query($db_con, $query)) {
		$datainsert['insertsucess'] = '<p style="color: green;">admin Inserted!</p>';
		move_uploaded_file($_FILES['photo']['tmp_name'], '../userimages/' . $photo_name);
	} else {
		$datainsert['inserterror'] = '<p style="color: red;">Student Not Inserted, please input right informations!</p>';
	}
}
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Add admin<small class="text-warning"> Add New admin!</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
		<li class="breadcrumb-item active" aria-current="page">Add admin</li>
	</ol>
</nav>

<div class="row">

	<div class="col-sm-6">
		<?php if (isset($datainsert)) { ?>
			<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
				<div class="toast-header">
					<strong class="mr-auto">admin Insert Alert</strong>
					<small><?php echo date('d-M-Y'); ?></small>
					<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="toast-body">
					<?php
					if (isset($datainsert['insertsucess'])) {
						echo $datainsert['insertsucess'];
					}
					if (isset($datainsert['inserterror'])) {
						echo $datainsert['inserterror'];
					}
					?>
				</div>
			</div>
		<?php } ?>
		<form enctype="multipart/form-data" method="POST" action="">


			<div class="form-group">
				<label for="aId">Admin ID</label>
				<input name="aId" type="text" class="form-control" id="aId" value="<?= isset($aId) ? $aId : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="titleName">Title</label>
				<select name="titleName" class="form-control" id="titleName" required="">
					<option value="Mr.">Mr.</option>
					<option value="Ms.">Ms.</option>
					<option value="Mrs.">Mrs.</option>
				</select>
			</div>

			<div class="form-group">
				<label for="name">Name</label>
				<input name="name" type="text" class="form-control" id="name" value="<?= isset($name) ? $name : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="address">Address</label>
				<input name="address" type="text" value="<?= isset($address) ? $address : ''; ?>" class="form-control" id="address" required="">
			</div>

			<div class="form-group">
				<label for="dob">Date Of Birth</label>
				<input name="dob" type="date" class="form-control" id="dob" value="<?= isset($dob) ? $dob : ''; ?>" required="">
			</div>



			<div class="form-group">
				<label for="nic">NIC</label>
				<input name="nic" type="text" class="form-control" id="nic" value="<?= isset($nic) ? $nic : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="phone">Phone</label>
				<input name="phone" type="text" class="form-control" id="phone" pattern="[0-9]{10}" value="<?= isset($phone) ? $phone : ''; ?>" placeholder="01........." required="">
			</div>


			<div class="form-group">
				<label for="gender">Gender</label>
				<select name="gender" class="form-control" id="gender" required="">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Other">Other</option>
				</select>
			</div>

			<label for="photo">Photo</label>
			<br>
			<div class="input-group">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="photo" aria-describedby="customFileInput" name="photo">
					<label class="custom-file-label" for="photo">Select Image file</label>
				</div>
			</div>
			<br>

			<div class="form-group">
				<label for="email">Email</label>
				<input name="email" type="text" class="form-control" id="email" value="<?= isset($email) ? $email : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="accessLevel">Access Level</label>
				<select name="accessLevel" class="form-control" id="accessLevel" required="">
					<option value="SuperAdmin">Super Admin</option>
					<option value="Admin">Admin</option>
				</select>
			</div>

			<div class="form-group text-center">
				<input name="addadmin" value="Add admin" type="submit" class="btn btn-danger">
			</div>
		</form>
	</div>
</div>