<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: admin.php?page=' . $corepage[0]);
	}
}

if (isset($_POST['addclass'])) {
	$cId  = $_POST['cId'];
  $batchName = $_POST['batchName'];
  $subName = $_POST['subName'];
  $monthFee = $_POST['monthFee'];
  
	$query ="INSERT INTO `class`(`cId`, `batchName`, `subName`, `monthFee`) VALUES ('$cId','$batchName','$subName','$monthFee');"; 
  if (mysqli_query($db_con, $query)) {
		$datainsert['insertsucesss'] = '<p style="color: green;">Class Inserted!</p>';
	} else {
		$datainsert['inserterrorr'] = '<p style="color: red;">Class Not Inserted, please input right informations!</p>';
	}
}
?>
<h1 class="text-primary"><i class="fas fa-book-open"></i> Add Class<small class="text-warning"> Add New Class!</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
		<li class="breadcrumb-item active" aria-current="page">Add Class</li>
	</ol>
</nav>

<div class="row">

	<div class="col-sm-6">
		<?php if (isset($datainsert)) { ?>
			<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
				<div class="toast-header">
					<strong class="mr-auto">Class Insert Alert</strong>
					<small><?php echo date('d-M-Y'); ?></small>
					<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="toast-body">
					<?php
					if (isset($datainsert['insertsucesss'])) {
						echo $datainsert['insertsucesss'];
					}
					if (isset($datainsert['inserterrorr'])) {
						echo $datainsert['inserterrorr'];
					}
					?>
				</div>
			</div>
		<?php } ?>

    <?php
		$qu = "SELECT `cId` FROM `class` LIMIT 0, 1";
		$re = mysqli_query($db_con, $qu);
		$re1 = mysqli_fetch_array($re);
		?>

		<form enctype="multipart/form-data" method="POST" action="">


     <div class="form-group">
				<label for="cId">Class ID</label>
				<input name="cId" type="text" class="form-control" id="cId" value="<?= isset($cId) ? $cId : ''; ?>" required="">
			</div>

      <div class="example"><b>
			<?php echo "Example of Class ID :-  ".$re1[0]; ?>
			</b>
			</div>

      <br>

      <div class="form-group">
				<label for="batchName">Batch Name</label>
				<input name="batchName" type="text" class="form-control" id="batchName" value="<?= isset($batchName) ? $batchName : ''; ?>" required="">
			</div>

      <div class="form-group">
				<label for="subName">Subject Name</label>
				<input name="subName" type="text" class="form-control" id="subName" value="<?= isset($subName) ? $subName : ''; ?>" required="">
			</div>

    
      <div class="form-group">
		    <label for="monthFee">Monthly Fee (Rs.)</label>
		    <input name="monthFee" type="text" class="form-control" id="monthFee" value="<?= isset($monthFee)? $monthFee: '' ; ?>" required="">
	  	</div>

  
			<div class="form-group text-center">
				<input name="addclass" value="Add Class" type="submit" class="btn btn-danger">
			</div>
		</form>
	</div>
</div>

<!-- All class table  -->

<br>

<?php if(isset($_GET['delete']) || isset($_GET['edit'])) {?>
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
    <div class="toast-header">
      <strong class="mr-auto">Class Edit Alert</strong>
      <small><?php echo date('d-M-Y'); ?></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?php 
        if (isset($_GET['delete'])) {
          if ($_GET['delete']=='succes') {
            echo "<p style='color: green; font-weight: bold;'>Class Deleted Successfully!</p>";
          }  
        }
        if (isset($_GET['delete'])) {
          if ($_GET['delete']=='erro') {
            echo "<p style='color: red'; font-weight: bold;>Class Not Deleted!</p>";
          }  
        }
        if (isset($_GET['edit'])) {
          if ($_GET['edit']=='successs') {
            echo "<p style='color: green; font-weight: bold; '>Class Edited Successfully!</p>";
          }  
        }
        if (isset($_GET['edit'])) {
          if ($_GET['edit']=='errorr') {
            echo "<p style='color: red; font-weight: bold;'>Class Not Edited!</p>";
          }  
        }
      ?>
    </div>
  </div>
    <?php } ?>
<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Class ID</th>
      <th scope="col">Batch</th>
      <th scope="col">Subject</th>
      <th scope="col">Fee</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $query=mysqli_query($db_con,'SELECT * FROM `class` ORDER BY `class`.`cId` DESC;');
      while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php 
        echo '
          <td>'.$result['cId'].'</td>
          <td>'.$result['batchName'].'</td>
          <td>'.$result['subName'].'</td>
          <td>'.$result['monthFee'].'</td>
              
          <td>
            <a class="btn btn-xs btn-warning" href="admin.php?page=edit-Class&cId='.base64_encode($result['cId']).'">
              <i class="fa fa-edit"></i></a>

             &nbsp; <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="admin.php?page=delete-Class&cId='.base64_encode($result['cId']).'">
             <i class="fas fa-trash-alt"></i></a></td>';?>
      </tr>  
     <?php } ?>
    
  </tbody>
</table>
<script type="text/javascript">
  function confirmationDelete(anchor)
{
   var conf = confirm('Are you sure want to delete this record?');
   if(conf)
      window.location=anchor.attr("href");
}
</script>