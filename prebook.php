<!DOCTYPE html>
<html lang="en">
<head>
<title>4 Seasons</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/jquery-1.6.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/tms-0.3.js"></script>
<script type="text/javascript" src="js/tms_presets.js"></script>
<script type="text/javascript" src="js/script.js"></script>




</head>
<body id="page4">
<div class="body1">
  <div class="main">
    <!--header -->
    <header>
      <div class="wrapper">
        <h1><a href="home.php" id="logo">4 Sesons Restaraunt</a></h1>
        <nav>
          <ul id="menu">
            <li><a href="home.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li class="active"><a href="prebook.php">Pre Booking</a></li>
            <li><a href="order.php">Order</a></li>
            <li><a href="contacts.php">Contact</a></li>
          </ul>
        </nav>
      </div>
      
    </header>
    <!-- / header -->
    <!-- content -->
    
  </div>
</div>
<div class="body2">
  <div class="main">
    <article id="content2">
      <div class="wrapper">
        <section class="col2">
          
          <div class="plc"><h3>Book A Table for Tommorow</h3></div>
          <form  action="prebook2.php" method="post">
                 
    <h3>Enter Your Contact No. and Booking Time-></h3>
   
    <table width="400" border="1">
  <tr>
    <td>Contact number</td>
    <td><input type="text" id="number" name="number" width="100px"></td>
  </tr>
  <tr>
    <td>Time</td>
    <td><input type="text" id="Time" name="Time" width="100px"></td>
  </tr>
  <tr>
    <td></td>
    <td><input type="reset"> <input type="submit" formaction="prebook2.php"></td>
  </tr>
</table>

    </td>
 

          </form>
          
          
        </section>
      </div>
    </article>
    <!-- / content -->
  </div>
</div>
<div class="main">
  <!-- footer -->
  <footer>
    <div class="wrapper">
      <section class="col2">
        <div id="footer_link">Copyright &copy; 4 Seasons All Rights Reserved<br>
          </div>
      </section>
      
    </div>
    <!-- {%FOOTER_LINK} -->
  </footer>
  <!-- / footer -->
</div>
</body>
</html>