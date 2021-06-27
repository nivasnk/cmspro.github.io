<?php
session_start();
include('include/config.php');
include('smtp/PHPMailerAutoload.php');
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else {
  if(isset($_POST['update']))
  {
	$complaintnumber=$_GET['cid'];
	$status=$_POST['status'];
	$remark=$_POST['remark'];
	$email=$_POST['email'];
 
    $query=mysqli_query($con,"insert into complaintremark(complaintNumber,status,remark) values('$complaintnumber','$status','$remark')");
    $sql=mysqli_query($con,"update tblcomplaints set status='$status' where complaintNumber='$complaintnumber'");

    echo "<script>alert('Complaint details updated successfully');</script>";  

    $msg=$remark;
	$mail = new PHPMailer(); 
	$mail->SMTPDebug  = 0;
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
	$mail->Subject = 'Sindhu Portal Alert';
	$mail->Body =$msg;
	$uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['uploaded_file']['name']));
    if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $uploadfile))
    $mail->addAttachment($uploadfile,$_FILES['uploaded_file']['name']); 
	$mail->AddAddress($email);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		//echo $mail->ErrorInfo;
	}else{
		return 'Sent';
	}
	


  }

 ?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}ser
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>User Profile</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="anuj.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
$complaintnumber=$_GET['cid'];
$sql="SELECT * FROM `tblcomplaints` WHERE `complaintNumber`='$complaintnumber'";
$res=mysqli_query($con,$sql);
$rows1=mysqli_fetch_assoc($res);
$userId=$rows1['userId'];

$sql1="SELECT * FROM `users` WHERE id='$userId'";
$res1=mysqli_query($con,$sql1);
$row=mysqli_fetch_assoc($res1);


if(isset($_POST['update'] )){
 $email=$_POST['email'];
 $remark=$_POST['remark'];
 $allowedExtensions =array("pdf", "doc", "docx", "jpg", "jpeg");

?>	
	<script type="text/javascript">
    
      Email.send({
        Host: "smtp.gmail.com",
        Username: "itcellzpsindhudurg@gmail.com",
        Password: "Itcell@228817",
        To: "<?php echo $email; ?>",
        From: "itcellzpsindhudurg@gmail.com",
        Subject: "Sindhudurg Online Complaint Portal",
        Body: "<?php echo $remark; ?>",
        Attachment:[
            {
                filename :"logo.jpg",
                filepath:"https://nsdl.co.in/images/logo.jpg" ,
            }]
      })
        .then(function (message) {
          alert("mail has been sent successfully")
        });

  </script>
  
<?	
}

?>
<div style="margin-left:50px;">
 <form name="updateticket" id="updatecomplaint" method="post" enctype="multipart/form-data"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    
    <tr height="50">
      <td><b>Complaint Number</b></td>
      <td><?php echo htmlentities($_GET['cid']); ?></td>
    </tr>
    <tr height="50">
      <td><b>Status</b></td>
	  
      <td><select name="status" required="required">
      <option value="">Select Status</option>
      <option value="in process">In Process</option>
    <option value="closed">Closed</option>
        
      </select></td>
    </tr>
	
	<tr height="50">
	<td><b>Email Id</b></td>
		<td><input type='text' readonly name='email' size='50' value='<?php echo $row['userEmail']; ?>'></td></tr>
	  
      <tr height="50">
      <td><b>Remark</b></td>
      <td><textarea name="remark" cols="50" rows="10" required="required"></textarea></td>
    </tr>
    

    <tr height="50">
      <td><b>Attachment</b></td>
    <td>
        
<input type="file" name="uploaded_file"/><br>

        </td>
        </tr>

        <tr height="50">
      <td>&nbsp;</td>
      <td><input type="submit" name="update" value="Submit" ></td>
    </tr>



       <tr><td colspan="2">&nbsp;</td></tr>
    
    <tr>
  <td></td>
      
        
      <td >   
      <input name="Submit2" type="submit" class="txtbox4" value="Close this window" onClick="return f5();" style="cursor: pointer;"  /></td>
    </tr>
    
    

 
</table>
 </form>
</div>

 

</body>
</html>

     <?php } ?>
     
   