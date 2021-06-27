<?php
include('smtp/PHPMailerAutoload.php');
if(isset($_POST['upload']))
{
    $msg='test me';
	$mail = new PHPMailer(); 
	$mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.hostinger.in";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "sindhuportal@themagicstitchers.com";
	$mail->Password = "Magic@2000";
	$mail->SetFrom("sindhuportal@themagicstitchers.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['uploaded_file']['name']));
    if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $uploadfile))
    $mail->addAttachment($uploadfile,$_FILES['uploaded_file']['name']); 
	$mail->AddAddress("nivaskuperkar16@gmail.com");
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}

}
?>

<form method='post' enctype="multipart/form-data">
    <input type='file' name='uploaded_file' id='uploaded_file' multiple='multiple' />
    <input type='submit' name='upload'/> 
    </form>