<?php
/**
 * 模拟登录
 * 小白(me)只能模拟登录自己的站,╮(╯▽╰)╭,希望下一步可以模拟登录教务处_+_
 */
header("Content-type:text/html;charset=utf-8");
set_time_limit(0);//不限制脚本执行时间 默认30s

//初始化变量
$cookie_file = dirname(__FILE__) . "\\cookie.txt";
$login_url = "http://shop.azbabyqueen.com/index.php/index/Index.html";
$verify_code_url = "http://shop.azbabyqueen.com/index.php/login/verify.html";

if (!$_POST) {
	$curl = curl_init();
	$timeout = 5;
	curl_setopt($curl, CURLOPT_URL, $login_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($curl,CURLOPT_COOKIEJAR,$cookie_file); //获取COOKIE并存储
	$contents = curl_exec($curl);
	curl_close($curl);

	//取出验证码
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $verify_code_url);
	curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$img = curl_exec($curl);
	curl_close($curl);
	echo "正在创建验证码,请耐心等待~~~";
	$fp = fopen("verifyCode.jpg","w");//创建验证码
	fwrite($fp,$img);
	fclose($fp);
	sleep(3);
	//手动输入验证码
	echo "<form action=\"\" method=\"post\"><input type=\"text\" name=\"code\"><img src=\"verifyCode.jpg\" /><br><input type=\"submit\" value=\"submit\"></form>";

} else {
	$code = $_POST['code'];
	$post = "username=xxxx&password=xxxx&code=$code";
	$url = "http://shop.azbabyqueen.com/index.php/login/ajaxCheck.html";
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
	curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
	curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);
	$result=curl_exec($curl);
	curl_close($curl);
	//echo $result;
	//根据返回结果判断登录结果
	if ($result == "success") {
		echo "登录成功";
		//接下来,就可以以登录状态去用代码去做想做的事了~_~
		// $url = "http://shop.azbabyqueen.com/index.php/user/index.html";
		// $ch=curl_init($url);
		// curl_setopt($ch,CURLOPT_HEADER,0);
		// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		// curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file); //使用提交后得到的cookie数据做参数
		// $contents=curl_exec($ch);
		// curl_close($ch);
		// echo $contents;
	} else {
		echo "登录失败";
	}
	
}





?>