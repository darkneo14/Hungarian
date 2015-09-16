<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php require_once('Connections/con_hung.php'); ?>

<?php

$time=2000;

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
echo $tm;
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
<body>
</body>
</html>