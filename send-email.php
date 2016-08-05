<?php 
/*
Plugin Name: Send Email
Plugin URI: blog.zhfsky.com/sendmail
Description: 发送邮件
Author: Naihai
Author URI:www.zhfsky.com
Version: 0.0.1

*/
 


require_once('wp_mail_smtp.php');

 //保存数据
if(isset($_POST['option_save'])) {
		//至少填写一个
		if( (empty($_POST['send_email_subject']) && empty($_POST['send_email_to']) && empty($_POST['send_email_message']) ) ){ 
			 echo '<div class="notice notice-error is-dismissible"><p>抱歉,不能全为空！</p></div>';
			
		}
		
		else{
								    //处理数据   
    $option1 = stripslashes($_POST['send_email_subject']); 
    $option2 = stripslashes($_POST['send_email_to']);   
    $option3 = stripslashes($_POST['send_email_message']);     
    $option4 = stripslashes($_POST['send_email_attachments']); 
    update_option('send_email_subject', $option1);//更新选项 
    update_option('send_email_to', $option2);//更新选项 
    update_option('send_email_message', $option3);//更新选项  
    update_option('send_email_attachments', $option4);//更新选项  
    echo '<div class="notice notice-success is-dismissible"><p>保存成功！</p></div>';
			}
	
}
 
/*
	@其他页面调用send email  使用 参数 address= 进行传递

	@使用urlencode()进行邮箱地址转换，该插件使用urldecode取回原字符串
	@获取原邮箱地址后直接显示
*/
//function get_email_address($show_send_email_to){
//		$email_address_query =$_GET['address'];
//		$show_send_email_to =	urldecode($email_address_query);
//		return $show_send_email_to;
//	
//	}



function send_email_menu(){      
    add_menu_page( '发送邮件', '发送邮件', 'edit_themes', 'send_email','send_naihai_wp_mail_smtp_options_page','dashicons-email',86);      
}     
add_action('admin_menu', 'send_email_menu');   


// Define the function
function send_naihai_wp_mail_smtp_options_page() {
	
	// Load the options
	global  $phpmailer;
	

	 
	if (isset($_POST['send_email_action']) && isset($_POST['send_email_subject']) && isset($_POST['send_email_message']) && isset($_POST['send_email_to'])) {
		
		
    $to = stripslashes($_POST['send_email_to']); 
    //$to =array('448435279@qq.com','zhf@hustca.com');
    $subject = stripslashes($_POST['send_email_subject']);   
    $message = stripslashes($_POST['send_email_message']); 
		$headers = "Content-Type: text/html; charset=\"".get_option('blog_charset')."\"\n";
		$attachments = stripslashes($_POST['send_email_attachments']);
		/*
				@将附件格式化 wp_mail要求附件地址为服务器绝对地址
				@通过编辑器媒体上传的附件 xxx.com/wp-contents/uploads/2016/08/send-email.zip格式
				@$pat  preg_match_all 正则匹配 链接 url及标题 这里只需要url
				@str_replace 将url转成服务器绝对路径
				@保存在数据库中的附件信息与wordpress普通附件一样 
		*/ 
		$pat = '/<a(.*?)href="(.*?)"(.*?)>(.*?)<\/a>/i'; 
		preg_match_all($pat, $attachments, $m);
    $attachments = $m[2]; 
		$httpurl = site_url().'/wp-content/uploads/';
		$replace = WP_CONTENT_DIR.'/uploads/';
		$attachments = str_replace($httpurl, $replace, $attachments);

		//$attachments =array(WP_CONTENT_DIR.'/uploads/2016/08/send-email.zip');
		//var_dump ($attachments) ;
		$result =wp_mail($to, $subject, $message, $headers, $attachments);
		if($result){echo '<div class="notice notice-success is-dismissible "><p>发送成功！</p></div>';}
			else {echo '<div class="notice notice-error is-dismissible "><p>发送失败！</p></div>';}
			
	 
		
	

	} //end if 
	
   global $show_draft_tag;
   global $show_send_email_to,$show_send_email_subject,$show_send_email_message,$show_send_email_attachments;
   
	if(isset($_POST['show_draft']) && $_POST['show_draft'] =='显示上次保存内容'){ $show_draft_tag = true;} 
			elseif(isset($_POST['show_draft']) && $_POST['show_draft'] =='不显示上次保存内容'){$show_draft_tag = false;}
			
	if($show_draft_tag){ 
			$show_draft_button_name = '不显示上次保存内容' ;
			$show_send_email_to = get_option('send_email_to');
			$show_send_email_subject = get_option('send_email_subject');
			$show_send_email_message = get_option('send_email_message');  
			$show_send_email_attachments = get_option('send_email_attachments');
		 
		} 
	elseif(!empty($_GET['address']) || !empty($_GET['info'])) {
		  if(!empty($_GET['address']))$show_send_email_to =	urldecode($_GET['address']);
	  	if(!empty($_GET['info']))	$show_send_email_message = urldecode($_GET['info']);
			$show_draft_button_name = '显示上次保存内容' ;
			}	
	else{
		
			$show_send_email_to = '';
			$show_send_email_subject = '';
			$show_send_email_message = '';
			$show_draft_button_name = '显示上次保存内容' ;
			$show_send_email_attachments='';
				
				}
		
 
 unset($phpmailer);
	?>
	
	
	
	
<div class="wrap send_email_class">

<h1>发送邮件
<a class="page-title-action" href="?page=send_email&action=usehelp">使用说明</a></h1>
		<form method="POST">
			<table class="optiontable form-table">
				<tr valign="top">
					<th scope="row"><label for="send_email_subject">主题</label></th>
					<td><input name="send_email_subject" type="text" id="send_email_subject" value="<?php echo $show_send_email_subject;?>" size="40" class="code" />
					<span class="description">请输入发信主题</span></td>
				</tr>	
					<tr valign="top">
					<th scope="row"><label for="send_email_to">收件地址</label></th>
					<td><input name="send_email_to" type="text" id="send_email_to" value="<?php echo $show_send_email_to;?>" size="40" class="code" />
					<span class="description">请输入收件人地址 &nbsp;发送多个请以逗号隔开  </span>[ <span style="color:green;">英文半角 , </span>]</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="send_email_message">内容</label></th>
					<td>
							<?php wp_editor( $show_send_email_message, 'send_email_message',array('teeny' => true ));  ?>	
							 
					</td>
				</tr>				
				<tr valign="top">
					<th scope="row"><label for="send_email_attachments">添加附件</label></th>
					<td><?php wp_editor( $show_send_email_attachments, 'send_email_attachments',array('teeny' => true,'textarea_rows'=>'2','quicktags'=>false,'wpautop'=>false ));  ?>	
					<span class="description">你可以上传附件</span></td>
				</tr>
			</table>
		<p class="submit"><input type="submit" name="send_email_action" id="send_email_action" class="button-primary" value="发送邮件" /></p>
		<p><input type="submit" name="option_save" class="button-primary"  id="submit"  value="保存" /></p>
		<p><input type="submit" name="show_draft" class="button-primary"  id="submit"  value="<?php echo $show_draft_button_name;?>" /></p>
		</form>

</div>



<?php 
	
} // End of send_naihai_wp_mail_smtp_options_page() function definition



 
/*
	@使用说明
	@page=send_email&action=usehelp
	
*/
 function send_email_use_help(){

		$out ='<div class="wrap">';
		$out .='<h1>使用说明</h1>';
		$out .='<div class="notice notice-success is-dismissible"><p>成功删除!</p><br/><p><a href="https://blog.zhfsky.com/wp-admin/admin.php?page=hustca_form">返回表单页面</a></p></div>';
		$out .='<div class="notice notice-warning is-dismissible"><p>请慎重操作，不可挽回！</p>	</div>';
		$out='</div>';
		echo $out; 
	 
	}


if(!empty($_GET['action'])){
	
	if( $_GET['action'] == 'usehelp'){ 
			
			send_email_use_help();
			//echo '<style>.send_email_class{display:none;}</style>' ;
			
			}
	
	}
		  
		
		
 





?>