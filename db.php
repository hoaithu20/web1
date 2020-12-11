<?php

function tft_add_row ($db, $tablename, $mahoivien , $tenhoivien , $ngayvaohoi, $noicongtac ) {
	mysqli_query ($db,"insert into hoivien (mahoivien, tenhoivien, ngayvaohoi, noicongtac) values ('$mahoivien', '$tenhoivien', '$ngayvaohoi', '$noicongtac')");
}
function tft_add_row2 ($db, $tablename, $mahoivien  , $magiaithuong  , $ngayduocnhan ) {
	mysqli_query ($db,"insert into hoivien_giaithuong (mahoivien, magiaithuong, ngayduocnhan) values ('$mahoivien', '$magiaithuong', '$ngayduocnhan')");
}
function tft_add_row3 ($db, $tablename, $thisinhID  , $monthiID  , $diem ) {
	mysqli_query ($db,"insert into giaithuong(magiaithuong, tengiaithuong) values ('$magiaithuong', '$tengiaithuong')");
}

// update
function tft_update_row ($db,$tablename, $key, $mahoivien , $tenhoivien , $ngayvaohoi, $noicongtac ) {
	mysqli_query ($db,"update $tablename set mahoivien='$mahoivien', tenhoivien='$tenhoivien', ngayvaohoi='$ngayvaohoi', noicongtac='$noicongtac' where mahoivien='$key' ");
}
function tft_update_row2 ($db,$tablename, $key, $magiaithuong  , $tengiaithuong ) {
	mysqli_query ($db,"update $tablename set magiaithuong='$magiaithuong', tengiaithuong='$tengiaithuong' where monthiID='$key' ");
}
function tft_update_row3 ($db,$tablename, $key, $mahoivien  , $magiaithuong  , $ngayduocnhan) {
	$pos = strpos($key, "+");
	$key1 = substr($key, 0, $pos);
	$key2 = substr($key, $pos+1);
	mysqli_query ($db,"update $tablename set mahoivien='$mahoivien', magiaithuong='$magiaithuong', ngayduocnhan='$ngayduocnhan' where mahoivien ='$key1' and magiaithuong='$key2' ");
}

//delete
function tft_delete_row ($db, $tablename, $key ) {
	mysqli_query ($db,"delete from $tablename where mahoivien=$key ");
}

function tft_delete_row2 ($db, $tablename, $key1, $key2 ) {
	mysqli_query ($db,"delete from $tablename where mahoivien='$key1' and magiaithuong='$key2' ");
}

//read
function tft_read_one ($db, $tablename, $key ) {
	return mysqli_query ($db,"select * from $tablename where mahoivien = $key");
}
function tft_read_one2 ($db, $tablename, $key ) {
	return mysqli_query ($db,"select * from $tablename where magiaithuong = $key");
}
function tft_read_one3 ($db, $tablename, $key ) {
	$pos = strpos($key, "+");
	$key1 = substr($key, 0, $pos);
	$key2 = substr($key, $pos+1);
	return mysqli_query ($db,"select * from $tablename where mahoivien='$key1' and magiaithuong='$key2'");
}


//
function tft_read_all ($db,$tablename) {
	return mysqli_query ($db,"select * from $tablename order by mahoivien");
}

function tft_read_all2 ($db,$tablename) {
	return mysqli_query ($db,"select * from $tablename order by magiaithuong");
}

?>
