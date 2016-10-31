
* 矩阵相乘


```

 /**
 * 矩阵相乘
 */
header("content-type:text/html;charset=utf-8");
/**
 * [init arr]
 * @param  integer $n    初始化数组-行
 * @param  integer $m    初始化数组-列
 * @param  integer $min  随机数开始值
 * @param  integer $max  随机数终止值
 * @param  array   &$arr 初始化数组
 */
function init($n = 0, $m = 0, $min = 0,$max = 0,&$arr = array()) {
	//控制行
	for ($i = 0; $i < $n; ++$i) {
		//控制列
		for ($j = 0; $j < $m; ++$j) {
			//use rand($min,$max)
			$arr[$i][$j] = rand($min,$max);
		}
	}
}
/**
 * 输出数组
 * @param  array  $arr 待输出的数组
 */
function out($arr = array()) {
	//测试输出
	for ($i = 0; $i < count($arr); ++$i) {
		for ($j = 0; $j < count($arr[$i]); ++$j) {
			echo $arr[$i][$j] . "\t";
		}
		echo "<br>";
	}
}
/**
 * 二维数组相乘
 * @param  array  $arr1    数组一
 * @param  array  $arr2    数组二
 * @param  array  &$result 结果数组
 */
function calculate($arr1 = array(),$arr2 = array(),&$result = array()) {
	//初始值 n-m-k
	//n = count($arr1)
	//m = count($arr2)
	//k = count($arr2[$n])
	for ($i = 0; $i < count($arr1); ++$i) {
		for ($k = 0; $k < count($arr2[$i]); ++$k) {
			for ($j = 0; $j < count($arr2); ++$j) {
				@$result[$i][$k] += $arr1[$i][$j] * $arr2[$j][$k];
			}	
		}
	}
	//sleep(1);
}

/**
 * @start time
 */
function proStartTime() {
    global $startTime;
    $mktime = explode(" ",microtime());
    $startTime = $mktime[1] + $mktime[0];
}

/**
 * @End time
 */
function proEndTime() {
    global $startTime;
    $mktime = explode(" ", microtime());
    $endtime = $mktime[1] + $mktime[0];
    $totaltime = $endtime - $startTime;
    $totaltime = number_format($totaltime, 7);
    echo "<br/>process time: ".$totaltime . "<br>";
}

$arr1 = array();
$arr2 = array();
$result = array();
//初始化矩阵一
init(3,4,1,3,$arr1);
//初始化矩阵二
init(4,5,1,3,$arr2);
//$start = microtime();//返回当前的unix的时间戳和微秒数
proStartTime();
calculate($arr1,$arr2,$result);


echo "arr1输出:<br>";
out($arr1);
echo "arr2输出:<br>";
out($arr2);
echo "结果数组输出:<br>";
out($result);
proEndTime();

	// end of script

```