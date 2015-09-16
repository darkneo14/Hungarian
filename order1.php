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
$qtyall=array(0,0,0,0,0,0,0,0);
$qty[0]=$_POST["qty1"];
$qty[1]=$_POST["qty2"];
$qty[2]=$_POST["qty3"];
$qty[3]=$_POST["qty4"];
$qty[4]=$_POST["qty5"];
$qty[5]=$_POST["qty6"];
$qty[6]=$_POST["qty7"];
$qty[7]=$_POST["qty8"];
$qty[8]=$_POST["qty9"];
for($i=0;$i<9;$i++)
{
	if($qty[$i]=="")
		$qty[$i]=0;
}

$price=array(150,200,120,500,600,550,300,350,250);
?>

<?php

$mat=array(array(10,15,20,25,35,30,20,16,19),
			array(8,19,13,22,30,35,40,25,20),
			array(12,14,18,26,25,30,15,20,20),
			array(14,18,24,20,22,28,35,32,33),
			array(10,12,15,32,27,20,22,21,20),
			array(15,10,12,29,20,23,14,18,16),
			array(20,23,25,30,35,34,12,25,14),
			array(14,15,10,20,22,20,30,29,28),
			array(12,13,14,24,22,22,19,18,17)
			);
	
?>
<?php

$n=9;
$sx=array();
$sy=array();
$size=0;
function push($a,$b)
{
	$GLOBALS['size']++;
	array_push($GLOBALS['sx'],$a);
	array_push($GLOBALS['sy'],$b);
	//echo $a." ";
	//echo $b."\n";
}

function pop()
{
	//echo"pop\n";
	$s=array(0,0);
	$s[0]=array_pop($GLOBALS['sx']);
	$s[1]=array_pop($GLOBALS['sy']);
	//echo $s[0]." ".$s[1];
	$GLOBALS['size']--;
	return($s);
}

function isEmpty()
{
	if(!$GLOBALS['size'])
		return(1);
	return(0);
}

function checkSelect($m,$x,$y)
{
	if($m[$x][$y])
	return(0);
	for($i=0;$i<=$x;$i++)
	{
		if($m[$i][$y]==-1 )
		return(0);
	}
	return(1);
}

function isFull($n)
{
	//echo $n;
	//echo $GLOBALS['size'];
	if($GLOBALS['size']==$n)
		return(1);
	return(0);
}

function selection($m,$n)			// finding the optimal solution based on the zeros placed in the m matrix and store in stack array...
{
	//echo "\n";
	/*for($i=0;$i<$n;$i++)
	{
		for($j=0;$j<$n;$j++)
		{
			echo $m[$i][$j]." ";
		}
		echo "\n";
		
	}*/
	for($i=0;$i<$n;$i++)
	{
		if($m[0][$i]==0)
		{
			push(0,$i);
			$m[0][$i]=-1;
			break;
		}
	}
	$row=1;
	$clm=0;
	while(!isFull($n))
	{
		//echo "yo";
		$flag=0;
		for($i=$clm;$i<$n;$i++)
		{
			if(checkSelect($m,$row,$i))
			{
				//echo "push\nrow=>".$row."clm=>".$i;
				$flag=1;
				push($row,$i);
				$m[$row][$i]=-1;
				//echo "\n";
	/*for($i=0;$i<$n;$i++)
	{
		for($j=0;$j<$n;$j++)
		{
			echo $m[$i][$j]." ";
		}
		echo "\n";
	}*/
				$row++;
				$clm=0;
				break;			
			}
		}
		if(!$flag)
		{
			//$temp=array(0,0);
			$temp=pop();
			$row=$temp[0];
			$clm=$temp[1];
			//echo "pop\nrow=>".$row."clm=>".$clm."\n";
			$m[$row][$clm]=0;
			$clm++;
			
		}

	}
	
	
}


function check($c,$r)			//Check if all zeros in mat are cut or not
{
$n=9;
	for($i=0;$i<$n;$i++)
	{
		if($r[$i] || $c[$i])
			return(1);
	}
return(0);

}


// electives vs teacher based on previous student avg marks..
//knapsack for choosing students for an elective based on scores..
function Hungarian($m,$n)
{
/*$m=array();

for($i=0;$i<$n;$i++)				// making copy of initial array
	$m[]=array($mat[i]);*/


$r=array();							//for frequency of zeros in each rows
$c=array();							//for frequency of zeros in each column
$rcut=array();						//for where row is cut=1
$ccut=array();						//for where column is cut=1

for($i=0;$i<$n;$i++)				//initializing
{
	$r[]=0;
	$c[]=0;
	$rcut[]=0;
	$ccut[]=0;
}


for($i=0;$i<$n;$i++)				
{
	$min=PHP_INT_MAX;
	for($j=0;$j<$n;$j++)						// finding min in each row
	{
			if($m[$i][$j]<$min)
			$min=$m[$i][$j];
	}
	for($j=0;$j<$n;$j++)						// subtracting min element from all row elements and if zero incrementing in 'r'
	{
			$m[$i][$j]-=$min;
			//if($m[$i][$j]==0)
			//$r[$i]+=1;
			
	}

}

for($i=0;$i<$n;$i++)
{
	$min=PHP_INT_MAX;
	
	for($j=0;$j<$n;$j++)						// finding min in each column
	{
			if($m[$j][$i]<$min)
			$min=$m[$j][$i];
	}
	//echo "min=>".$min." ";
	for($j=0;$j<$n;$j++)						// subtracting min element from all column elements and if zero incrementing in 'c'
	{
			$m[$j][$i]-=$min;
			if($m[$j][$i]==0)
			$c[$i]+=1;	
			//echo $m[$j][$i]." ";
	}
	//echo"\n";
}
for($i=0;$i<$n;$i++)
{
for($j=0;$j<$n;$j++)						// subtracting min element from all row elements and if zero incrementing in 'r'
	{
			
			if($m[$i][$j]==0)
			$r[$i]+=1;
			
	}
}

/*for($i=0;$i<$n;$i++)
{
	$min=PHP_INT_MAX;
	
	for($j=0;$j<$n;$j++)					
	{
			
			echo $m[$i][$j]." ";
	}
	echo "\n";
}*/

/*for($j=0;$j<$n;$j++)						
	{
			echo $r[$j]." ";
	}
	echo "\n";
for($j=0;$j<$n;$j++)						
	{
			
				if($c[$i]>$r[$i] && !($ccut[$i]))
	{
		for($j=0;$j<$n;$j++)
		{
			if($m[$i][$j]==0 && $c[$j] )
			$c[$j]-=1;
		}
		$r[$i]=0;
		$rcut[$i]=1;
	}echo $c[$j]." ";
	else }
	echo "\n";*/
$f=0;
while(!$f)										//main condition..while number of cuts !=n
{
//echo "hi\n";
while(check($r,$c))							// while all elements of r and c are not zero
{
$maxr=0;
$maxc=0;
$maxri=0;
$maxci=0;

for($i=0;$i<$n;$i++)						//cut kar rahe hain ....
{
	for($k=0;$k<$n;$k++)
	{
	if($m[$i][$k]==0)
	{
	if($c[$k]>$r[$i] && !($ccut[$k]) && !($rcut[$i]))
	{
		for($j=0;$j<$n;$j++)
		{
			if($m[$j][$k]==0 && $r[$j] )
			$r[$j]-=1;
		}
		$c[$k]=0;
		$ccut[$k]=1;
	}	
	else if($r[$i]>=$c[$k] && !($rcut[$i]) && !($ccut[$k]))
	{
		for($j=0;$j<$n;$j++)
		{
			
			if($m[$i][$j]==0 && $c[$j])
			{
				$c[$j]-=1;
			}
		}
		$r[$i]=0;
		$rcut[$i]=1;
	}
	}
	}
}




//test
/*echo "r and c\n";
	for($j=0;$j<$n;$j++)						
	{
			echo $r[$j]." ";
	}
	echo "\n";
	for($j=0;$j<$n;$j++)						
	{
			echo $c[$j]." ";
	}
	echo "\n";
	echo "rcut and cut\n";
	for($j=0;$j<$n;$j++)						
	{
			echo $rcut[$j]." ";
	}
	echo "\n";
	for($j=0;$j<$n;$j++)						
	{
			echo $ccut[$j]." ";
	}
	echo "\n";*/
	
	//test

}

$cnt=0;
for($i=0;$i<$n;$i++)								// counting number of rows and colums cut till now
{
	if($rcut[$i])
	$cnt++;
	if($ccut[$i])
	$cnt++;
}	
if($cnt==$n)											// final condition...if number of rows cut+ number of colunm cut = size of matrix
{
	$f=1;
	continue;
}

$minuc=PHP_INT_MAX;											// uncovered minimum element
for($i=0;$i<$n;$i++)											// finding min uncovered element
{
	if(!$rcut[$i])
	{
		for($j=0;$j<$n;$j++)
		{
			if(!$ccut[$j])
			{
				//echo $m[$i][$j]." ";
				if($m[$i][$j]<$minuc)
				$minuc=$m[$i][$j];
			}		
		}
		//echo "\n";
	}
}
//echo "min uc=>".$minuc."\n";
/*echo "\n";
for($i=0;$i<$n;$i++)						
	{
		for($j=0;$j<$n;$j++)						
		{
			echo $m[$i][$j]." ";
		}
		echo "\n";
	}*/

for($i=0;$i<$n;$i++)										//subtracting min uc value from all uc elements
{
	if(!$rcut[$i])
	{
		for($j=0;$j<$n;$j++)
		{
				
			$m[$i][$j]-=$minuc;
		}
	}
}
/*echo "\n";
for($i=0;$i<$n;$i++)						
	{
		for($j=0;$j<$n;$j++)						
		{
			echo $m[$i][$j]." ";
		}
		echo "\n";
	}*/

for($i=0;$i<$n;$i++)
{
	if($ccut[$i])
	{
		for($j=0;$j<$n;$j++)
		$m[$j][$i]+=$minuc;
	}
}

/*echo "\n";
for($i=0;$i<$n;$i++)						
	{
		for($j=0;$j<$n;$j++)						
		{
			echo $m[$i][$j]." ";
		}
		echo "\n";
	}*/

for($i=0;$i<$n;$i++)				//initializing
{
$r[$i]=0;
$c[$i]=0;
$rcut[$i]=0;
$ccut[$i]=0;
}
for($i=0;$i<$n;$i++)				
{
	for($j=0;$j<$n;$j++)						// subtracting min element from all row elements and if zero incrementing in 'r'
	{
			if($m[$i][$j]==0)
			$r[$i]+=1;
	}
}
for($i=0;$i<$n;$i++)
{
	for($j=0;$j<$n;$j++)						// subtracting min element from all column elements and if zero incrementing in 'c'
	{
			if($m[$j][$i]==0)
			$c[$i]+=1;	
	}
}

/*echo "r and c\n";
	for($j=0;$j<$n;$j++)						
	{
			echo $r[$j]." ";
	}
	echo "\n";
	for($j=0;$j<$n;$j++)						
	{
			echo $c[$j]." ";
	}
	echo "\n";
	echo "rcut and cut\n";
	for($j=0;$j<$n;$j++)						
	{
			echo $rcut[$j]." ";
	}
	echo "\n";
	for($j=0;$j<$n;$j++)						
	{
			echo $ccut[$j]." ";
	}
	echo "\n";
	
*/

}

//echo "\nFinally";
// age selection karni hain according to zeros...
selection($m,$n);


}


hungarian($mat,$n);
$sum=0;
$amts=0;
for($i=0;$i<9;$i++)
$amts+=$qty[$i]*$price[$i];
while(!isEmpty())
{
	$a=array(0,0);
$a=pop();
//echo $a[1]." ".$qty[$a[1]];
$sum+=$qty[$a[1]]*$mat[$a[0]][$a[1]];
//echo "ans=>".$mat[$a[0]][$a[1]]."\n";
}

//ans=>22 ans=>10 ans=>14 ans=>10 ans=>20 ans=>20 ans=>15 ans=>8 ans=>16

//echo $sum;
//if($sum>=60)
$sum=$sum/60;
//echo $sum;
?>
<?php
$fi="final";
$sum=(float)$sum;
$sum=number_format($sum,2);
mysql_select_db($database_con_hung,$con_hung);
$final_ans = "UPDATE `output` SET `out`='$sum' WHERE name='$fi'";

mysql_query($final_ans,$con_hung) or die(mysql_error());


mysql_select_db($database_con_hung, $con_hung);
$query_name = "SELECT region, distance FROM adress";
$name = mysql_query($query_name, $con_hung) or die(mysql_error());
$row_name = mysql_fetch_assoc($name);
$totalRows_name = mysql_num_rows($name);
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
            <li class="active"><a href="menu.php">Menu</a></li>
            <li><a href="prebook.php>Pre Booking</a></li>
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
          
          <h3>Your Billing Amount is-> Rs.<?php
		  echo "\n".$amts;
          ?></h3>
          
          
                      <div id="example_75">
              <h3>Our Regions of Dilivery</h3>
              
<table width="600" border="1">
                   <div id="example_table">
                   <tr>
                     <td><h3>Location</h3></td>
                     <td><h3>Region</h3></td>
                     
                   </tr>
                  <?php do { ?> <tr>
                     <td><?php echo $row_name['distance']; ?></td>
                     <td><?php echo $row_name['region']; ?></td>
                     
                   </tr><?php } while ($row_name = mysql_fetch_assoc($name)); ?>
  </table>
  <div id="example_emp">
  <h3>Enter Your Adress Region Here</h3>
                 <form  action="order2.php" method="post">
                 
    Region
    <input type="text" id="regions" name="regions" width="40px">
    <input type="submit" formaction="order2.php"></td>
 

                 </form>
                 </div>
            </div>
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