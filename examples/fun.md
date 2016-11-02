
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

```

arr1[0][0] arr1[0][1] arr1[0][2] arr1[0][3]...
                                           ===>result[0][0]  
arr2[0][0] arr2[1][0] arr2[2][0] arr2[3][0]...


```

* 文件加锁(保证多个进程可以同时写入)

```
	$fp = fopen("note.txt","w+");
	if (flock($fp,LOCK_EX)) {
		//获得写锁
		fwrite($fp,"you can write something");
		//解锁	
		flock($fp,LOCK_UN);
	} else {
		echo "the file is locked now";
	}
	fclose($fp);

```
* 多进程调度
[php多任务调度](http://www.laruence.com/2015/05/28/3038.html)

* php调试工具 `xdebug`
>下载安装：自行百度


<br>

* global

```
$j = 10;
function test() {
	for($j = 0; $j < 10; $j++) {
		global $j;
		$j++;

	}	
}
test();
echo $j;
//输出12(共执行了两次自增-global)
```

> 语言永远都是一个工具,优劣难分,各有千秋,重要的是用它的人。