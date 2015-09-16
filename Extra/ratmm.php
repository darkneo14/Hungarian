<?php

$s1=array(array());
$s2=array(array());
$size2=0;
$size1=0;
$n=5;
function push1($a,$b,$c)
{
	$GLOBALS['size1']++;
	$arr=array($a,$b,$c);
	array_push($GLOBALS['s1'],$arr);
	echo $a." ".$b." ".$c."\n";
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
if($src[0]==$dest[0] $$ $src[1]==$dest[0])
return 0;
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
$b=array(0,0,0,0);
$min=PHP_INT_MAX;
	$wt=$m[$src[0]][$src[1]];
	$m[$src[0]][$src[1]]=-1;
	$fwt=PHP_INT_MAX;
while(!isEmpty1())
{

	$flg=0;
	echo "yo";
	while($flg==0 && !isEmpty1())
	{
	
		$a=pop1();
		$src[0]=$a[0];
		$src[1]=$a[1];
		$cnt1=$a[2];
		push2($src[0],$src[1],$m[$src[0]][$src[1]]);
		$m[$src[0]][$src[1]]=-1;	
		echo $src[0]." ".$src[1]."\n";
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
	echo "\n".$cnt."\n";
if($wt<$fwt && $flg==1)
{
	echo "min";
$min=$cnt;
$fwt=$wt;
$GLOBALS['f']=$GLOBALS['s2'];
//$GLOBALS['f']=$m;
}

}
return $fwt;
}

$m=array(array(1,0,1,0,0),
		 array(1,1,1,1,3),
		 array(1,0,1,0,2),
		 array(0,0,6,0,4),
		 array(0,0,1,5,1)
		 );
$s=array(0,0);
$d=array(4,4);
$mn=ratm($m,5,$s,$d);
//$mn=$GLOBALS['min'];
echo "ans is=>\n".$mn."\n";
$fwt=0;
$mn++;
while($mn)
{
	$s=array_pop($GLOBALS['f']);
	$fwt+=$m[$s[0]][$s[1]];
	echo $s[0]." ".$s[1]." ".$s[2]."\n";
	$mn--;
}
echo "Final Weight=".$fwt;
/*$mz=$GLOBALS['f'];
for($i=0;$i<$n;$i++)
{
	for($j=0;$j<$n;$j++)
		echo $mz[$i][$j]." ";
	echo "\n";
}*/

//http://ideone.com/JZb0dO

?>