<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: admin.php?page=' . $corepage[0]);
	}
}

if (isset($_POST['addexam'])) {
  $examId = $_POST['examId'];
  $class_id = $_POST['class_id'];
  $examName = $_POST['examName'];
  $examTime = $_POST['examTime'];
  $examDate = $_POST['examDate'];

  $query = "INSERT INTO `exam`(`examId`, `class_id`, `examName`, `examTime`, `examDate`) VALUES ('$examId','$class_id','$examName','$examTime','$examDate');";
  if (mysqli_query($db_con, $query)) {
    $datainsert['insertsucesss'] = '<p style="color: green;">Exam Inserted!</p>';
  } else {
    $datainsert['inserterrorr'] = '<p style="color: red;">Exam Not Inserted, please input right informations!</p>';
  }
}
?>
<h1 class="text-primary"><i class="fas fa-clipboard-list"></i> Add Exam<small class="text-warning"> Add New Exam!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Exam</li>
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
   $qt = "SELECT * FROM `class`";
   $re2 = mysqli_query($db_con, $qt);
    ?>

    <form enctype="multipart/form-data" method="POST" action="">

     <div class="form-group">
        <label for="examId">Exam ID</label>
        <input name="examId" type="text" class="form-control" id="examId" value="<?= isset($examId) ? $examId : ''; ?>" required="">
      </div>

      <div class="form-group">
        <label for="class_id">Class ID</label>
        <select name="class_id" class="form-control" id="" value="<?= isset($class_id) ? $class_id : '' ?>">

          <?php while ($r2 = mysqli_fetch_array($re2)) :; ?>

            <option value="<?php echo $r2[0]; ?>"><?php echo $r2[0]; ?> - <?php echo $r2[1]; ?> - <?php echo $r2[2]; ?> </option>

          <?php endwhile; ?>
        </select>

      </div>
    
      <div class="form-group">
        <label for="examName">Exam Name</label>
        <input name="examName" type="text" class="form-control" id="examName" value="<?= isset($examName) ? $examName : ''; ?>" required="">
      </div>

     

      <div class="form-group">
        <label for="examTime">Time</label>
        <input name="examTime" type="time" class="form-control" id="examTime" value="<?= isset($examTime) ? $examTime : ''; ?>" required="">
      </div>

      <div class="form-group">
        <label for="examDate">Date</label>
        <input name="examDate" type="date" class="form-control" id="examDate" value="<?= isset($examDate) ? $examDate : ''; ?>" required="">
      </div>

      <div class="form-group text-center">
        <input name="addexam" value="Add Exam" type="submit" class="btn btn-danger">
      </div>
    </form>
  </div>
</div>

<!-- All class table  -->

<br>

<?php if (isset($_GET['delete']) || isset($_GET['edit'])) { ?>
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
    <div class="toast-header">
      <strong class="mr-auto">Exam Edit Alert</strong>
      <small><?php echo date('d-M-Y'); ?></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?php
      if (isset($_GET['delete'])) {
        if ($_GET['delete'] == 'succes') {
          echo "<p style='color: green; font-weight: bold;'>Exam Deleted Successfully!</p>";
        }
      }
      if (isset($_GET['delete'])) {
        if ($_GET['delete'] == 'erro') {
          echo "<p style='color: red'; font-weight: bold;>Exam Not Deleted!</p>";
        }
      }
      if (isset($_GET['edit'])) {
        if ($_GET['edit'] == 'successs') {
          echo "<p style='color: green; font-weight: bold; '>Exam Edited Successfully!</p>";
        }
      }
      if (isset($_GET['edit'])) {
        if ($_GET['edit'] == 'errorr') {
          echo "<p style='color: red; font-weight: bold;'>Exam Not Edited!</p>";
        }
      }
      ?>
    </div>
  </div>
<?php } ?>
<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Class</th>
      <th scope="col">Name</th>
      <th scope="col">Time</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = mysqli_query($db_con, 'SELECT * FROM `exam` ORDER BY `exam`.`examId` DESC;');
    while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php
        echo '
		      <td>' . $result['examId'] . '</td>
          <td>' . $result['class_id'] . '</td>
          <td>' . $result['examName'] . '</td>
          <td>' . $result['examTime'] . '</td>
          <td>' . $result['examDate'] . '</td>
      
          <td>
            <a class="btn btn-xs btn-warning" href="admin.php?page=edit-exam&examId=' . base64_encode($result['examId']) . '">
              <i class="fa fa-edit"></i></a>

             &nbsp; <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="admin.php?page=delete-exam&examId=' . base64_encode($result['examId']) . '">
             <i class="fas fa-trash-alt"></i></a></td>'; ?>
      </tr>
    <?php } ?>

  </tbody>
</table>
<script type="text/javascript">
  function confirmationDelete(anchor) {
    var conf = confirm('Are you sure want to delete this record?');
    if (conf)
      window.location = anchor.attr("href");
  }
</script>