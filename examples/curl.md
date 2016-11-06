### curl各项采集设置

* 需要referer采集

> 网站的请求需要判断来源网址,如果不是自己的网站,则拒绝访问,可以通过添加CURLOPT_REFERER参数模拟来源

```
$refer = "http://referercom.com";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //返回数据不直接输出
curl_setopt($ch, CURLOPT_POST, 1);            //发送POST类型数据
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);  //POST数据，$post可以是数组，也可以是拼接
curl_setopt($ch,CURLOPT_REFERER,$refer); //模拟来源
$content = curl_exec($ch);                    //执行并存储结果
curl_close($ch);

```

* 需要cookie的支持

> 模拟登录需要cookie参数,可通过 `CURLOPT_COOKIE`:直接以字符串的形式使用cookie; `CURLOPT_COOKIEFILE`:以文件方式提交cookie;`CURLOPT_COOKIEJAR`:保存提交后反馈的cookie数据(cookie是用户合法提交网络请求的标识,所以模拟自动登陆需要cookie)

```
header("content-Type: text/html; charset=UTF-8");
$cookie_file = dirname(__FILE__) . "\\cookie.txt"; //win
$login_url="http://bbs.php100.com/login.php";
$post_fields="cktime=36000&step=2&pwuser=username&pwpwd=password";

//提交登录表单请求
$ch=curl_init($login_url);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$post_fields);
curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie_file); //存储提交后得到的cookie数据
curl_exec($ch);
curl_close($ch);

//登录成功后，获取bbs首页数据
$url="http://bbs.php100.com/index.php";
$ch=curl_init($url);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie_file); //使用提交后得到的cookie数据做参数
$contents=curl_exec($ch);
curl_close($ch);
//转码显示
echo iconv('gbk', 'UTF-8', $contents);

```

* 压缩网页采集（gzip）

> 如果页面被压缩,则采集回来的内容是乱码,无论是使用iconv还是强大的mb_convert_encoding都无法还原数据,则可以通过CURLOPT_ENCODING参数
eg：

```
$url = 'http://news.sohu.com';

$ch = curl_init();
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//返回数据不直接输出
curl_setopt($ch,CURLOPT_ENCODING,"gzip");//指定gzip压缩
$content = curl_exec($ch);//执行并存储结果
curl_close($ch);
echo $content;

```
###### 其中支持的编码有 `identity`,`deflate`,`gzip`;如果为空字符串""，请求头会发送所有支持的编码类型。后面一句表明，使用curl_setopt($ch, CURLOPT_ENCODING, "");也是可以的，但是不能不加这个参数。


>摘抄自： [采集笔记](http://www.zjmainstay.cn/php-curl)
