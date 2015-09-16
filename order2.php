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
$reg=$_POST["regions"];
$reg1=strtoupper($reg);
$reg=ord(strtolower($reg)) - 96;

mysql_select_db($database_con_hung,$con_hung);
$query_x="SELECT `x` FROM adress where region='$reg1'";
$ox=mysql_query($query_x,$con_hung) or die(mysql_error());
$otx=mysql_fetch_assoc($ox);
$x=$otx['x'];
mysql_select_db($database_con_hung,$con_hung);
$query_y="SELECT `y` FROM adress where region='$reg1'";
$oy=mysql_query($query_y,$con_hung) or die(mysql_error());
$oty=mysql_fetch_assoc($oy);
$y=$oty['y'];

//echo $x." ".$y;
?>

<?php


$mat=array(array(1,3,10,20,5,4,1,2,4),
			array(0,10,0,0,0,1,0,0,5),
			array(0,1,19,2,3,10,21,3,11,2),
			array(0,2,0,7,0,0,1,0,0,3),
			array(2,3,0,11,2,0,3,0,0,0),
			array(0,1,0,0,0,0,12,0,0,0),
			array(21,3,0,0,0,0,1,13,13,3),
			array(11,0,0,0,0,0,2,0,0,8),
			array(3,2,11,3,12,15,3,0,0,20),
			array(0,0,3,19,0,4,0,0,0,2)
			);



$s1=array(array());
$s2=array(array());
$size2=0;
$size1=0;
$n=10;
function push1($a,$b,$c)
{
	$GLOBALS['size1']++;
	$arr=array($a,$b,$c);
	array_push($GLOBALS['s1'],$arr);
	//echo $a." ".$b." ".$c."\n";
	//echo $b."\n";
	
}

function pop1()
{
	//echo"pop\n";
	$s=array(0,0,0);
	$s=array_pop($GLOBALS['s1']);
	//echo $s[0]." ".$s[1];
	$GLOBALS['size1']--;
	return($s);
}

function isEmpty1()
{
	if(!$GLOBALS['size1'])
		return(1);
	return(0);
}

function push2($a,$b,$w)
{
	$GLOBALS['size2']++;
	$arr=array($a,$b,$w);
	array_push($GLOBALS['s2'],$arr);
	//echo $a." ";
	//echo $b."\n";
}

function pop2()
{
	//echo"pop\n";
	$s=array(0,0,0);
	$s=array_pop($GLOBALS['s2']);
	//echo $s[0]." ".$s[1];
	$GLOBALS['size2']--;
	return($s);
}

function isEmpty2()
{
	if(!$GLOBALS['size2'])
		return(1);
	return(0);
}




function check($x,$y,$m)
{
	$n=$GLOBALS['n'];
	if($x<0 || $y<0 || $x>=$n || $y>=$n)
		return(0);
	if($m[$x][$y]==-1 || $m[$x][$y]==0)
		return(0);
	
	return(1);

}

function ratm($m,$n,$src,$dest)
{
$cnt=1;
//echo "yo";
//Test
/*for($i=0;$i<$n;$i++)
{
	for($j=0;$j<$n;$j++)
		echo $m[$i][$j]." ";
	echo "\n";
}*/
//Test


push2($src[0],$src[1],$m[$src[0]][$src[1]]);
if($src[0]==$dest[0] && $src[1]==$dest[1])
return $m[$src[0]][$src[1]];

if(check($src[0]+1,$src[1],$m))
	{
		//echo "1";
		push1($src[0]+1,$src[1],$cnt);
	}

if(check($src[0]-1,$src[1],$m))
	{
		//echo "2";
		push1($src[0]-1,$src[1],$cnt);
	}

if(check($src[0],$src[1]+1,$m))
	{
		//echo "3";
		push1($src[0],$src[1]+1,$cnt);
	}

if(check($src[0],$src[1]-1,$m))
	{
		//echo "4";
		push1($src[0],$src[1]-1,$cnt);
	}


$a=array(0,0,0);
$b=array(0,0,0);
$min=PHP_INT_MAX;
$fwt=PHP_INT_MAX;
$wt=$m[$src[0]][$src[1]];
$m[$src[0]][$src[1]]=-1;
while(!isEmpty1())
{

	$flg=0;
	//echo "yo";
	while($flg==0 && !isEmpty1())
	{
	
		$a=pop1();
		$src[0]=$a[0];
		$src[1]=$a[1];
		$cnt1=$a[2];
		$wt+=$m[$src[0]][$src[1]];
		push2($src[0],$src[1],$m[$src[0]][$src[1]]);
		$m[$src[0]][$src[1]]=-1;	
		//echo $src[0]." ".$src[1]."\n";
		//$cnt++;
		if($src[0]==$dest[0] && $src[1]==$dest[1])
		{
			$flg=1;
			break;
		}
		while(($cnt-$cnt1))
		{
			$b=pop2();
			$x1=$b[0];
			$x2=$b[1];
			$wt1=$b[2];
			$wt-=$wt1;
			$cnt--;
			$m[$x1][$x2]=$wt1;
		
		}
		$cnt++;
	if(check($src[0]+1,$src[1],$m))
		push1($src[0]+1,$src[1],$cnt);

	if(check($src[0]-1,$src[1],$m))
		push1($src[0]-1,$src[1],$cnt);

	if(check($src[0],$src[1]+1,$m))
		push1($src[0],$src[1]+1,$cnt);

	if(check($src[0],$src[1]-1,$m))
		push1($src[0],$src[1]-1,$cnt);	
			

	}
	//echo "\n".$cnt."\n";
if($wt<$fwt && $flg==1)
{
	//echo "min";
$min=$cnt;
$fwt=$wt;
$GLOBALS['f']=$GLOBALS['s2'];
//$GLOBALS['f']=$m;
}

}
return $fwt;
}

/*$m=array(array(1,0,1,0,0),
		 array(1,1,1,1,3),
		 array(1,0,1,0,2),
		 array(0,0,6,0,4),
		 array(0,0,1,5,1)
		 );*/
$s=array(0,0);
$d=array($x,$y);
$fwt=ratm($mat,10,$s,$d);
//echo $fwt;
//$mn=$GLOBALS['min'];
//echo "ans is=>\n".$mn."\n";
/*$fwt=0;
$mn++;
while($mn)
{
	$s=array_pop($GLOBALS['f']);
	$fwt+=$mat[$s[0]][$s[1]];
	//echo $s[0]." ".$s[1]." ".$s[2]."\n";
	$mn--;
}
//echo "Final Weight=".$fwt;
$mz=$GLOBALS['f'];
for($i=0;$i<$n;$i++)
{
	for($j=0;$j<$n;$j++)
		echo $mz[$i][$j]." ";
	echo "\n";
}*/

//http://ideone.com/JZb0dO

?>
<?php

mysql_select_db($database_con_hung,$con_hung);
$query_out="SELECT `out` FROM output where name='Final'";
$oq=mysql_query($query_out,$con_hung) or die(mysql_error());
$otq=mysql_fetch_assoc($oq);
$ot=$otq['out'];

$fout=$ot+number_format($fwt/60,2);
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
            <li><a href="prebook.php">Pre Booking</a></li>
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
          
          <div class="final">
          <h3 style="font-size: 18px">Thank You for choosing Four Seasons</h3>
          
          </br>
          <h3 style="font-size: 18px">Your Estimated Dilivery Time is -> <?php
          echo $fout." hrs";
		  //echo $x." ".$y;
		  ?></h3>
          
          </div>
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