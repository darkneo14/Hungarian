
<?php

$mat=array(array(10,19,8,15,19),
           array(10,18,7,17,19),
           array(13,16,9,14,19),
           array(12,19,8,18,19),
           array(14,17,10,19,19)
           );


/*class stack
{
	public $x=0;
	public $y=0;
}

$s=array();
$size=0;
$temp=new stack();

*/
$n=5;
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
$n=5;
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

for($i=0;$i<$n;$i++)						// 
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
//echo "yes\n";
while(!isEmpty())
{
	$a=array(0,0);
$a=pop();
echo "ans=>".$mat[$a[0]][$a[1]]."\n";
}

?>



https://ideone.com/VVtTLk