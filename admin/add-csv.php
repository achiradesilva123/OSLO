<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: admin.php?page=' . $corepage[0]);
	}
}
?>

<h1 class="text-primary"><i class="fas fa-users"></i> Student Attendence</h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
		<li class="breadcrumb-item active" aria-current="page">Attendence</li>
	</ol>
</nav>



<?php

$qt = "SELECT * FROM `class`";
$re2 = mysqli_query($db_con, $qt);

?>

<h1 class="text-primary"><small class="text-warning"> Import Attendance CSV to Database!</small></h1>
<br>

<div class="row">

	<div class="col-sm-6">
		<form action="upload.php" enctype="multipart/form-data" method="POST">

			<div class="form-group">
				<label for="class_id">Class ID</label>
				<select name="class_id" class="form-control" id="" value="<?= isset($class_id) ? $class_id : '' ?>" required>
					<option value="">Select Class</option>
					<?php while ($r2 = mysqli_fetch_array($re2)) :; ?>

						<option value="<?php echo $r2[0]; ?>"><?php echo $r2[0]; ?> - <?php echo $r2[1]; ?> - <?php echo $r2[2]; ?></option>

					<?php endwhile; ?>
				</select>

			</div>

			<div class="form-group">
				<label for="attdate">Attend Date</label>
				<input name="attdate" type="date" class="form-control" id="attdate" value="<?= isset($attdate) ? $attdate : ''; ?>" required>
			</div>

			<label for="file">File</label>
			<br>
			<div class="input-group">
				<div class="custom-file">
					<input type="file" class="form-control" name="file">
				</div>
				<div class="input-group-append">
					<input type="submit" name="Import" value="Import" class="btn btn-primary">
				</div>
			</div>
		</form>
	</div>
</div>

<br><br>

<table class="table  table-striped table-hover table-bordered" id="data">
	<thead class="thead-dark">
		<tr>
			<th>Student ID</th>
			<th>Class</th>
			<th>Attend Date</th>
			<th>Time</th>
		</tr>
	</thead>
	<?php
	$SQLSELECT = "SELECT * FROM `attendance`;";
	$result_set =  mysqli_query($db_con, $SQLSELECT);
	while ($row = mysqli_fetch_array($result_set)) {
	?>

		<tr>
			<td><?php echo $row['std_id']; ?></td>
			<td><?php echo $row['class_id']; ?></td>
			<td><?php echo $row['attend_date']; ?></td>
			<td><?php echo $row['time']; ?></td>
		</tr>
	<?php
	}
	?>
</table>



<?php

$qt = "SELECT * FROM `class`";
$re2 = mysqli_query($db_con, $qt);

?>
<!-- Export data -->
<br><br>
<h1 class="text-primary"><small class="text-warning"> Export Attendance to CSV!</small></h1>
<br>

<div class="row">

	<div class="col-sm-6">
		<form action="upload.php" enctype="multipart/form-data" method="POST">

			<div class="form-group">
				<label for="class_id">Class ID</label>
				<select name="class_id" class="form-control" id="" value="<?= isset($class_id) ? $class_id : '' ?>" required>
					<option value="">Select Class</option>
					<?php while ($r2 = mysqli_fetch_array($re2)) :; ?>

						<option value="<?php echo $r2[0]; ?>"><?php echo $r2[0]; ?> - <?php echo $r2[1]; ?> - <?php echo $r2[2]; ?></option>

					<?php endwhile; ?>
				</select>

			</div>

			<div class="form-group">
				<label for="attdate">Attend Date</label>
				<input name="attdate" type="date" class="form-control" id="attdate" value="<?= isset($attdate) ? $attdate : ''; ?>" required>
			</div>



			<div class="form-group">
				<div class="col-md-4 col-md-offset-4">
					<input type="submit" name="Export" class="btn btn-success" value="Export to Excel" />
				</div>
			</div>
		</form>
	</div>
</div>