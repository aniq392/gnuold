<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 표지번호
$sid = ($wr_1) ? $wr_1 : $wr_id;

// 연재글수
$cnt = sql_fetch("select count(*) as cnt from $write_table where wr_is_comment = '0' and wr_1 <> '' and wr_1 = '{$sid}' ", false);

// 표지갱신
$sql_serial = "wr_2 = '{$cnt['cnt']}'";
if($wr_1) {
	if($w != 'u') {
		$sql_serial .= ", as_update = '".G5_TIME_YMDHIS."'";
	}
} else {
    $sup = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\/\^\*]/", "", $sup);
	$sql_serial .= ", as_update = '{$sup}'";
}

sql_query(" update $write_table set $sql_serial where wr_id = '{$sid}' ", false);

@include_once($serial_skin_path.'/write_update.tail.skin.php');

// 목록으로 이동하기
if($w == '' && isset($is_direct) && $is_direct) {
	if ($file_upload_msg)
		alert($file_upload_msg, G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table);
	else
		goto_url(G5_HTTP_BBS_URL.'/board.php?bo_table='.$bo_table);
}

?>