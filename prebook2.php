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
<?php require_once('Connections/con_hung.php'); ?>

<?php

$time=$_POST["Time"];

?>

<?php

function quicksort( $arr, $left = 0 , $right = NULL )
{

static $array = array();
if( $right == NULL )
{
$array = $arr;
$right = count($array)-1;//last element of the array
}
 
$i = $left;
$j = $right;
 
$tmp = $array[(int)( ($left+$right)/2 )];

do{
while( $array[$i] < $tmp )
$i++;
 
while( $tmp < $array[$j] )
$j--;
 
if( $i <= $j )
{
$w = $array[$i];
$array[$i] = $array[$j];
$array[$j] = $w;
 
$i++;
$j--;
}
}while( $i <= $j );

if( $left < $j )
quicksort($array, $left, $j);

if( $i < $right )
quicksort($array, $i, $right);

return $array;
}

function tablemin($s,$f)
{
	$n=count($s);
	
	$s=quicksort($s);
	$f=quicksort($f);
	//echo "hi";
	$p=1;
	$result=1;
   $i=1;
   $j=0;
 
   while ($i<$n && $j<$n)
   {
      if ($s[$i]<$f[$j])
      {
          $p++;
          $i++;
          if($p>$result)  
              $result=$p;
      }
      else 
      {
          $p--;
          $j++;
      }
   }
 
   return $result;
}
?>
<?php

mysql_select_db($database_con_hung,$con_hung);
$query_time="SELECT stime,ftime FROM tables";
$qtm=mysql_query($query_time,$con_hung) or die(mysql_error());
$qt=mysql_fetch_assoc($qtm);
$st=array();
$ft=array();
do{
	array_push($st,$qt['stime']);
	array_push($ft,$qt['ftime']);
}while($qt=mysql_fetch_assoc($qtm));

array_push($st,$time);
array_push($ft,$time+100);
$n=count($st);
	
$tm=tablemin($st,$ft);

$flg=0;
//echo $tm;
if($tm<=10)
{
$fi=$n;
$st=$time;
$ft=$time+100;
mysql_select_db($database_con_hung,$con_hung);
$final_ans = "INSERT INTO `tables`(`number`, `stime`, `ftime`) VALUES ('$fi','$st','$ft')";

mysql_query($final_ans,$con_hung) or die(mysql_error());
$flg=1;
}


?>

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
          <?php
		  if($flg==1)
		  {?>
          <h3>Thank You!!! Your Booking has been recieved. You will be Contaced soon to confirm the booking</h3>
          <?php } 
		  else
		  {?>
          <h3>Sorry We are completely booked at this time. Please try another time slot or another day Perhaps.</h3>
          <?php } ?>
          
          
          
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