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
			
			function option_save_error(){echo '<div class="notice notice-error is-dismissible"><p>抱歉,不能全为空！</p></div>';}
			add_action( 'admin_notices', 'option_save_error' ); 

		}
		
		else{
								    //处理数据   
    $option1 = stripslashes($_POST['send_email_subject']); 
    $option2 = stripslashes($_POST['send_email_to']);   
    $option3 = stripslashes($_POST['send_email_message']);     
    update_option('send_email_subject', $option1);//更新选项 
    update_option('send_email_to', $option2);//更新选项 
    update_option('send_email_message', $option3);//更新选项  
    function option_save_success(){	echo '<div class="is_dismissible  notice notice-success "><p>保存成功！</p></div>';} 
    add_action( 'admin_notices', 'option_save_success' );
			}
	
}
 


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
    $subject = stripslashes($_POST['send_email_subject']);   
    $message = stripslashes($_POST['send_email_message']); 
		$headers = "Content-Type: text/html; charset=\"".get_option('blog_charset')."\"\n";
		
		$result =wp_mail($to, $subject, $message, $headers);
		if($result){echo '<div class="notice notice-success is_dismissible "><p>发送成功！</p></div>';}
			else {echo '<div class="notice notice-error is_dismissible "><p>发送失败！</p></div>';}
		
	

	}
   global $show_draft_tag;
	if(isset($_POST['show_draft']) && $_POST['show_draft'] =='显示上次保存内容'){ $show_draft_tag = true;} 
			elseif(isset($_POST['show_draft']) && $_POST['show_draft'] =='不显示上次保存内容'){$show_draft_tag = false;}
			
	if($show_draft_tag){ 
		$show_draft_button_name = '不显示上次保存内容' ;
		$show_send_email_to = get_option('send_email_to');
		$show_send_email_subject = get_option('send_email_subject');
		$show_send_email_message = get_option('send_email_message');
		} 
		else {
		$show_draft_button_name = '显示上次保存内容' ;	
		$show_send_email_to = '';
		$show_send_email_subject = '';
		$show_send_email_message = '';
			}
	
 unset($phpmailer);
	?>
	
	
	
	
<div class="wrap">

<h3>发送邮件</h3>

		<form method="POST">
			<table class="optiontable form-table">
				<tr valign="top">
					<th scope="row"><label for="subject">主题</label></th>
					<td><input name="send_email_subject" type="text" id="send_email_subject" value="<?php echo $show_send_email_subject;?>" size="40" class="code" />
					<span class="description">请输入发信主题</span></td>
				</tr>	
					<tr valign="top">
					<th scope="row"><label for="to">收件地址</label></th>
					<td><input name="send_email_to" type="text" id="send_email_to" value="<?php echo $show_send_email_to;?>" size="40" class="code" />
					<span class="description">请输入收件人地址</span></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="send_email_message">内容</label></th>
					<td>
							<?php wp_editor( $show_send_email_message, 'send_email_message',array('teeny' => true ));  ?>	
							 
					</td>
				</tr>
			</table>
		<p class="submit"><input type="submit" name="send_email_action" id="send_email_action" class="button-primary" value="发送邮件" /></p>
		<p><input type="submit" name="option_save" class="button-primary"  id="submit"  value="保存" /></p>
		<p><input type="submit" name="show_draft" class="button-primary"  id="submit"  value="<?php echo $show_draft_button_name;?>" /></p>
		</form>

</div>



<?php
	
} // End of send_naihai_wp_mail_smtp_options_page() function definition



 


?>