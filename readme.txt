=== Send Email ===
Contributors: Naihai
Tags: email
Requires at least: 0.2
Tested up to: 4.6
Stable tag: 4.5

WordPress Send Email Plugin

== Installation ==
上传到wordpress插件plugin目录，后台激活即可

== Frequently Asked Questions ==
1.如何配置SMTP ?


== Changelog ==
2016/08/05 0:55 version 0.2 增加了参数传递 

1.让后台其他页面或者数据调用Send Email 进行快速发邮件

2.在需要快速调用Send Email的地方 添加 url 参数 &address={email_address}&info={infomation}

3.address为收件人地址 info 为快速插入到正文中的内容 

4.举例 有数据  

	$item[\'name\']=\'小张\';
	$item[\'age\'] =\'20\';
	$item[\'email\']=\"12345678@qq.com\";
	$item[\'love\'] =\'他喜欢打篮球 看书 热爱登山\';
	$nh =\"\\n\";//换行
	发送邮件\',\'send_email\', \'mail\', 
	 urlencode( $item[\'email\'] ), urlencode(\'姓名:\'.$item[\'name\'].$nh.\'年龄:\'.$item[\'age\'].$nh.\'爱好:\'.$item[\'love\']))
	);
	?>

这样在点击发送邮件时，即可快速转到Send Email页面，并且已经将小张的邮件地址填充到收件人表单，小张的基本信息也已经填充到了正文。

5.如需仔细理解 请转到介绍页面 

6.urlencode urldecode

 
2016/08/04 version 0.1 最初版本

1.英文半角逗号隔开多个收件人地址实现多人发信