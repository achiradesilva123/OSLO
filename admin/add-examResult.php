<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: admin.php?page=' . $corepage[0]);
	}
}

if (isset($_POST['addexamresults'])) {
	$student_id = $_POST['student_id'];
  $exam_id = $_POST['exam_id'];
  $marks = $_POST['marks'];
  

	$query ="INSERT INTO `exam_marks`(`student_id`, `exam_id`, `marks`) VALUES ('$student_id ','$exam_id ','$marks');"; 
  if (mysqli_query($db_con, $query)) {
		$datainsert['insertsucesss'] = '<p style="color: green;">Exam Results Inserted!</p>';
	} else {
		$datainsert['inserterrorr'] = '<p style="color: red;">Exam Results Not Inserted, please input right informations!</p>';
	}
}
?>
<h1 class="text-primary"><i class="fas fa-clipboard-list"></i> Add Exam Results<small class="text-warning"> Exam Results!</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
		<li class="breadcrumb-item active" aria-current="page">Add Exam Results</li>
	</ol>
</nav>

<div class="row">

	<div class="col-sm-6">
		<?php if (isset($datainsert)) { ?>
			<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
				<div class="toast-header">
					<strong class="mr-auto">Exam Insert Alert</strong>
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
    $query1 = "SELECT * FROM `student`";
    $result1 = mysqli_query($db_con, $query1);
    $query2 = "SELECT * FROM `exam`";
    $result2 = mysqli_query($db_con, $query2);
    ?>

		<form enctype="multipart/form-data" method="POST" action="">
		
    <div class="form-group">
      <label for="student_id">Student</label>
      <select name="student_id" class="form-control" id="student_id" value="<?= isset($student_id) ? $student_id: '' ?>">
        <?php while ($row = mysqli_fetch_array($result1)) :; ?>

          <option value="<?php echo $row[0]; ?>"><?php echo $row[0];?> - <?php echo $row[2];?></option>

        <?php endwhile; ?>
      </select>
      </div>
      

      <div class="form-group">
      <label for="exam_id">Exam</label>
      <select name="exam_id" class="form-control" id="exam_id" value="<?= isset($exam_id) ? $exam_id : '' ?>">
        <?php while ($row1 = mysqli_fetch_array($result2)) :; ?>

          <option value="<?php echo $row1[0]; ?>"><?php echo $row1[0];?> - <?php echo $row1[2];?></option>

        <?php endwhile; ?>
      </select>
      </div>

      <div class="form-group">
				<label for="marks">Marks %</label>
				<input name="marks" type="text" class="form-control" id="marks" value="<?= isset($marks) ? $marks: ''; ?>" required="">
			</div>

     
     

			<div class="form-group text-center">
				<input name="addexamresults" value="Add" type="submit" class="btn btn-danger">
			</div>
		</form>
	</div>
</div>

<!-- All class table  -->

<br>

<?php if(isset($_GET['delete']) || isset($_GET['edit'])) {?>
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
    <div class="toast-header">
      <strong class="mr-auto">Exam Results Edit Alert</strong>
      <small><?php echo date('d-M-Y'); ?></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?php 
        if (isset($_GET['delete'])) {
          if ($_GET['delete']=='succes') {
            echo "<p style='color: green; font-weight: bold;'>Exam Results Deleted Successfully!</p>";
          }  
        }
        if (isset($_GET['delete'])) {
          if ($_GET['delete']=='erro') {
            echo "<p style='color: red'; font-weight: bold;>Exam Results Not Deleted!</p>";
          }  
        }
        if (isset($_GET['edit'])) {
          if ($_GET['edit']=='successs') {
            echo "<p style='color: green; font-weight: bold; '>Exam Results Edited Successfully!</p>";
          }  
        }
        if (isset($_GET['edit'])) {
          if ($_GET['edit']=='errorr') {
            echo "<p style='color: red; font-weight: bold;'>Exam Results Not Edited!</p>";
          }  
        }
      ?>
    </div>
  </div>
    <?php } ?>
<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Student</th> 
      <th scope="col">Exam</th>
      <th scope="col">Marks</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $query3=mysqli_query($db_con,'SELECT * FROM `exam_marks` ORDER BY `exam_marks`.`student_id` DESC;');
      while ($result3 = mysqli_fetch_array($query3)) { ?>
      <tr>
        <?php 
        echo '
		      <td>'.$result3['student_id'].'</td>
          <td>'.$result3['exam_id'].'</td>
          <td>'.$result3['marks'].'</td>
          <td>
            <a class="btn btn-xs btn-warning" href="admin.php?page=edit-examResult&student_id='.base64_encode($result3['student_id']).'">
              <i class="fa fa-edit"></i></a>

             &nbsp; <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="admin.php?page=deleteexamresult&student_id='.base64_encode($result3['student_id']).'">
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