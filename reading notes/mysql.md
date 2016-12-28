<center>批量插入数据<center>


---

* insert 语句合并
* 设置max_allowed_packet = 20M
	* 默认1M (show VARIABLES like '%max_allowed_packet%';)
	* 修改方法
		* 进入mysql命令行模式下
		* set global max_allowed_packet = 2*1024*1024*10
		* quit
		* 重新进入mysql命令行查看 max_allowed_packet
* 保证 插入一万条以上
* 发送post-json字符串时，有时会遇到json将汉字转码 "汉字" => "\uva3241"，之类的数据

	* php >= 5.4 可用 `json_encode($str, JSON_UNESCAPED_UNICODE)`  避免
	* php < 5.4 
		* ```json_encode($str, JSON_UNESCAPED_UNICODE)```
		* ```
			function encode_json($str) {  
   				 return urldecode(json_encode(url_encode($str)));      
			}  
		  
			function url_encode($str) {  
			    if(is_array($str)) {  
			        foreach($str as $key=>$value) {  
			            $str[urlencode($key)] = url_encode($value);  
			        }  
			    } else {  
			        $str = urlencode($str);  
		    }  
		      
		    return $str;  
			}  
		 ```  
	

* 结合http的传输提高效率
	* 利用http的gizp压缩文本将获得的数据进行gzip压缩,高效传输
		* php开启(对单个json来处理)
			```
				ob_start("ob_gzhandler");

			```
		* 可将几兆的json串控制在1M左右