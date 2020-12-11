<?php
include 'html.php';
include 'db.php';

$db = mysqli_connect('localhost', 'root', '','hoivien');
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_query($db,"SET NAMES 'utf8'");
mysqli_query($db,"SET CHARACTER SET 'utf8'");

global $cmd, $tablename, $rb, $c, $mahoivien, $tenhoivien, $ngayvaohoi, $noicongtac;
if(isset($_POST["cmd"])) $cmd=$_POST["cmd"];
if(isset($_POST["mahoivien"])) $mahoivien=$_POST["mahoivien"];
if(isset($_POST["tenhoivien"])) $tenhoivien=$_POST["tenhoivien"];
if(isset($_POST["ngayvaohoi"])) $ngayvaohoi=$_POST["ngayvaohoi"];
if(isset($_POST["noicongtac"])) $noicongtac=$_POST["noicongtac"];
if(isset($_POST["magiaithuong"])) $magiaithuong=$_POST["magiaithuong"];
if(isset($_POST["ngayduocnhan"])) $diem=$_POST["ngayduocnhan"];

if(isset($_POST["rb"])) $rb=$_POST["rb"];
if(isset($_POST["c"])) $c=$_POST["c"];


$tablename2='hoivien_giaithuong';
$tablename1='giaithuong';
$tablename='hoivien';
$active_row = '';
$errmess = '';
if (isset($cmd))
	switch ($cmd) {
		case 'Nhập':
            if (isset ($mahoivien) && isset ($tenhoivien) && isset ($ngayvaohoi) && isset ($noicongtac) 
            &&  ($mahoivien!='') && ($tenhoivien!='') && ($ngayvaohoi!='') && ($noicongtac!='') ) {
                if (isset($rb) && ($rb!='')) {// Sửa
                    tft_update_row ($db, $tablename, $rb, $mahoivien , $tenhoivien , $ngayvaohoi, $noicongtac );
                }
                else // Thêm mới
					tft_add_row($db,$tablename, $mahoivien, $tenhoivien, $ngayvaohoi, $noicongtac);
					
					$kq = mysqli_query ($db,"select * from hoivien order by mahoivien");
					
					$rb = $mahoivien= $tenhoivien = $ngayvaohoi= $noicongtac= '';
			} else {
				$errmess = 'Cac truong phai khac rong';
				$kq = mysqli_query ($db,"select * from hoivien order by mahoivien");
				$rb = $mahoivien = $tenhoivien = $ngayvaohoi = $noicongtac= '';

			}
			break;
		case 'Xóa':
			if (isset ($c))
				 foreach ($c as $key => $val){
					tft_delete_row($db, $tablename, $key);
					$errmess = 'Xóa thành công';
				    $kq = mysqli_query ($db,"select * from hoivien order by mahoivien");
		
				}
			else
			$errmess = 'Phai danh dau dong muon xoa';
			$kq = mysqli_query ($db,"select * from hoivien order by mahoivien");
			$rb = $mahoivien = $tenhoivien = $ngayvaohoi = $noicongtac= '';
			break;
	
}
else {
	if (isset($rb) && $rb!='') { // Nút chọn sửa được tích
		$temp = tft_read_one($db,$tablename, $rb);
		
		$row = mysqli_fetch_array ($temp, MYSQLI_BOTH);
		
		$mahoivien = $row['mahoivien'];
		$tenhoivien = $row['tenhoivien'];
		$ngayvaohoi = $row['ngayvaohoi'];
		$noicongtac = $row['noicongtac'];
		$kq = mysqli_query ($db,"select * from hoivien order by mahoivien");
		
	} else {
		$rb = $mahoivien = $tenhoivien = $ngayvaohoi = $noicongtac='';
		$kq = mysqli_query ($db,"select * from hoivien order by mahoivien");
	}
}

// Giao diện người dùng
echo htOpen ('Quan ly danh sach '. $tablename);
echo formOpen ();
echo func_title ('Quản lý danh sách hội viên');
echo '<center>'. tblOpen ('40%');
echo tr ( td('Mã hội viên : ','35%') . td (textbox('mahoivien', $mahoivien, '30', '64'), '45%'));
echo tr ( td('Tên hội viên :', '35%') . td (textbox('tenhoivien', $tenhoivien, '30', '64'), '45%'));
echo tr ( td('Ngày vào hội :', '35%') . td (textbox1('ngayvaohoi', $ngayvaohoi, '30', '64'), '45%'));
echo tr ( td('Nơi công tác :', '35%') . td (textbox('noicongtac', $noicongtac, '30', '64'), '45%'));

echo tr ( td (cmd ('Nhập') .cmd ('Xóa')) , 'center' );
echo tblClose().'<br />';
echo $errmess=='' ? '' : '<font color="RED">' . $errmess . '</font>';
echo tblOpen ('70%', '1', '0'); // độ rộng của bảng

echo tr ( td('Stt', '5%') . td('&nbsp;', '5%'). td(radio ('', 'rb', '1', ''), '5%') . td('Mã hội viên', '10%'). td('Tên hội viên', '20%'). td('Ngày vào hội', '10%') .td('Nơi công tác', '15%'), 'center');
// 
 $ci= 1; 
while ($r = mysqli_fetch_array ($kq,MYSQLI_BOTH))	{
	
	echo tr ( td($ci++).td(cb('c['.$r['mahoivien'].']')).td(radio($r['mahoivien'], 'rb', '1', $rb)) . td($r['mahoivien']). td('&nbsp;' . $r['tenhoivien'], '', 'left') .td('&nbsp;' . $r['ngayvaohoi'], '', 'left') . td('&nbsp;' . $r['noicongtac'] , '', 'center'), 'center');
}

echo tblClose().'</center>';

echo formClose() . htClose();
?>