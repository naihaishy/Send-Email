=== Send Email ===
Contributors: Naihai
Tags: email
Requires at least: 0.2
Tested up to: 4.6
Stable tag: 4.5

WordPress Send Email Plugin

== Installation ==
�ϴ���wordpress���pluginĿ¼����̨�����

== Frequently Asked Questions ==
1.�������SMTP ?


== Changelog ==
2016/08/05 0:55 version 0.2 �����˲������� 

1.�ú�̨����ҳ��������ݵ���Send Email ���п��ٷ��ʼ�

2.����Ҫ���ٵ���Send Email�ĵط� ��� url ���� &address={email_address}&info={infomation}

3.addressΪ�ռ��˵�ַ info Ϊ���ٲ��뵽�����е����� 

4.���� ������  

	$item[\'name\']=\'С��\';
	$item[\'age\'] =\'20\';
	$item[\'email\']=\"12345678@qq.com\";
	$item[\'love\'] =\'��ϲ�������� ���� �Ȱ���ɽ\';
	$nh =\"\\n\";//����
	�����ʼ�\',\'send_email\', \'mail\', 
	 urlencode( $item[\'email\'] ), urlencode(\'����:\'.$item[\'name\'].$nh.\'����:\'.$item[\'age\'].$nh.\'����:\'.$item[\'love\']))
	);
	?>

�����ڵ�������ʼ�ʱ�����ɿ���ת��Send Emailҳ�棬�����Ѿ���С�ŵ��ʼ���ַ��䵽�ռ��˱���С�ŵĻ�����ϢҲ�Ѿ���䵽�����ġ�

5.������ϸ��� ��ת������ҳ�� 

6.urlencode urldecode

 
2016/08/04 version 0.1 ����汾

1.Ӣ�İ�Ƕ��Ÿ�������ռ��˵�ַʵ�ֶ��˷���