功能:
1.Wordpress SMTP配置

2.发送邮件至任意人

3.邮件草稿保存和提取

4.wordpress默认编辑器编辑正文

5.附件添加 图像上传

6.邮件格式 html

7.快速调用Send Email 并实现数据的自动填充[version 0.2]

插件介绍: [https://blog.zhfsky.com/2016/08/04/send-mail.html](https://blog.zhfsky.com/2016/08/04/send-mail.html)


插件下载:  [https://blog.zhfsky.com/2016/08/04/send-mail.html](https://blog.zhfsky.com/2016/08/04/send-mail.html)

Github  [https://github.com/naihaishy/Send-Email](https://github.com/naihaishy/Send-Email)




版本介绍:

2016/08/05 0:55 version 0.2 增加了参数传递 

1.让后台其他页面或者数据调用Send Email 进行快速发邮件

2.在需要快速调用Send Email的地方 添加 url 参数 &address={email_address}&info={infomation}

3.address为收件人地址 info 为快速插入到正文中的内容 

4.举例 有数据  
$item['name']='小张';
$item['age'] ='20';
$item['email']="12345678@qq.com";
$item['love'] ='他喜欢打篮球 看书 热爱登山';
$nh ="\n";//换行

<?php 
sprintf('<a href="?page=%s&action=%s&address=%s&info=%s">发送邮件</a>','send_email', 'mail', 
 urlencode( $item['email'] ), urlencode('姓名:'.$item['name'].$nh.'年龄:'.$item['age'].$nh.'爱好:'.$item['love']))
);
?>

这样在点击发送邮件时，即可快速转到Send Email页面，并且已经将小张的邮件地址填充到收件人表单，小张的基本信息也已经填充到了正文。

5.如需仔细理解 请转到介绍页面 

6.urlencode urldecode

 
2016/08/04 version 0.1 最初版本



