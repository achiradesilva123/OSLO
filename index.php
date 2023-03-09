<?php require_once 'db_con.php';
session_start();
if (!isset($_SESSION['success_message'])) {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Home</title>
  <link rel="stylesheet" href="css/home.css?v=<?php echo time(); ?>" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body>


  <div id=main>
    <div>
      <?php include('header.php'); ?>


      <?php
      if (isset($_SESSION['success_message'])) {
      ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
          <strong>Hey !</strong> <?= $_SESSION['success_message']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php
        unset($_SESSION['success_message']);
      }
      ?>

      <div id=main>
        <!-- headline and the paragraph -->
        <div class="header-text">
          <h1>
            <span class="brand-name">Wisdom Tutors</span>
          </h1>
          <span class="square1"></span> <span class="square2"></span>
          <span class="square3"></span> <span class="square4"></span>
          <p>
            Professional Skills That Position You at the Top of the Candidate List.
            <br />
            Join lot of Learners From Around The Country Already Learning On
            Wisdom Tutors <br />
            Classes in 3 Languages. Expert Tutors. <br />
            Over 20 Classes.<span id="dots">...</span>
            <span id="more">Surf with us from your any degital device with lifetime Access.
              <br />
              We are proudly conducting these Classes to help our new generation
              sharp their skills with every knowledge and every skill and achieve
              everything they want by overriding the barrirs. Have a great journey
              with us and mostly welcome to our page.</span>
          </p>

          <!-- read more button -->
          <button type="button" id="btn-read" onclick="read()">Read More</button>
        </div>
        <div class="motto">
          <i>Education is the movement from dark to light.<br /><span style="background-color: aqua">-Allen Bloom-</span>
          </i>
        </div>

        <!-- square boxes 2 -->
        <div class="square-boxes2">
          <span class="square1"></span>
          <span class="line1"></span><br />
          <span class="line2"> </span> <br />
          <span class="square1"></span>
        </div>
      </div>


      <!-- script part for read more button -->
      <script type="text/javascript">
        var i = 0;

        function read() {
          if (!i) {
            document.getElementById("more").style.display = "inline";
            document.getElementById("dots").style.display = "none";
            document.getElementById("btn-read").innerHTML = "Read Less";
            i = 1;
          } else {
            document.getElementById("more").style.display = "none";
            document.getElementById("dots").style.display = "inline";
            document.getElementById("btn-read").innerHTML = "Read More";
            i = 0;
          }
        }
      </script>


      <div class="h">
        <?php include('footer.php'); ?>
      </div>
    </div>
  </div>
</body>

</html>