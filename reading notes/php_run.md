### <center>php基本运行模式</center>

---

* 标准(I/O)设备(系统变量)
	* 标准输入 - 0 - STDIN
	* 标准输入 - 1 - STDOUT
	* 标准错误 - 2 - STDERR
	* 我们平时所接触到的所有程序，在进行和操作系统命令行交互的时候,均是通过这三个文件来进行 输入 输出的。
	
* php的运行模式
	* cli模式(php命令行接口模式)
	* 以apache模块运行(依靠apache的进程)
	* cgi(通用网关接口)
	* fastcgi(cgi的加强版)
		