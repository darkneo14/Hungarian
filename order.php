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


<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<style type="text/css">#menu a, .bg, .bg2, #ContactForm a {behavior:url("../js/PIE.htc")}</style>
<![endif]-->


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
            <li><a href="technology.html">Pre Booking</a></li>
            <li class="active"><a href="order.php">Order</a></li>
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
          
          <div class="plc"><h3>Place Your Order</h3></div>
          <h2>OUR MENU</h2>
          <form action="order1.php" method="post">
          <div class="menu">
          <h3>Staters </h3>
          <h4>Qty</h4>
          <uol>
          </br>
            <li>
            Macaroni and three cheese bites on bacon jam..........................................................<input type="number" style="width: 30px;" id="qty1" name="qty1" min="0"></li>
              <li>Crispy chicken ribs with gremolata aioli....................................................................<input type="number" style="width: 30px;" id="qty2" name="qty2" min="0"></li>
              <li>Peperonata toast w white anchovies & salted ricotta ..................................................<input type="number" style="width: 30px;" id="qty3" name="qty3" min="0">
            </li>
          </uol>
          <h3>Main Course</h3>
          <uol>
            <li>
            Seared salmon, pearl cous cous, raisins, roasted cauliflower & skordalia..............................
            <input type="number" style="width: 30px;" id="qty4" name="qty4" min="0"></li>
              <li>Slow roasted lamb salad w freekah pomegranate & tahini yoghurt .....................................<input type="number" style="width: 30px;" id="qty5" name="qty5" min="0"></li>
              <li>Roast cauliflower, Lebanese cous cous & baby spinach w caulliflower  & date puree ...............<input type="number" style="width: 30px;" id="qty6" name="qty6" min="0">
            </li>
          </uol>
          <h3>Desserts</h3>
          <uol>
            <li>
            Smashed meringue w hazelnut cream & crushed fruit......................................................<input type="number" style="width: 30px;" id="qty7" name="qty7" min="0"></li>
              <li>Gary’s cheese cake, toasted nut crumble & rhubarb syrup ...............................................<input type="number" style="width: 30px;" id="qty8" name="qty8" min="0"> </li>
              <li>Chocolate pear tart w pedro ximinez sauce, fresh blackberry & vanilla ice cream ...................<input type="number" style="width: 30px;" id="qty9" name="qty9" min="0">
            </li>
          </uol>
          </br>
          <input type="submit" formaction="order1.php" style="width: 50px;">
          </div>
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