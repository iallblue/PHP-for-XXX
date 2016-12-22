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

