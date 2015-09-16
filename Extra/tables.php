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

$ar=array(900, 940, 950, 1100, 1500, 1800);
$ar1=array(1000, 1040, 1050, 1200, 1600, 1900);
$ans=tablemin($ar,$ar1);
echo $ans;


//http://ideone.com/pUA34Y

?>
