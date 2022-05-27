<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//목록수
$spage_rows = (G5_IS_MOBILE) ? $boset['smpage_rows'] : $boset['spage_rows'];

if(!$spage_rows || $spage_rows < 1)
	$spage_rows = 10;

// 페이지가 없으면 첫 페이지 (1 페이지)
if (!$spage || $spage < 1) { 
	$spage = 1; 
} 

// 공통 쿼리
$sql_serial = "from $write_table where wr_is_comment = '0' and wr_1 <> '' and wr_1 = '{$sid}'";

// 목록 정리
$stotal = sql_fetch("select count(*) as cnt $sql_serial ", false);
$stotal_count = $stotal['cnt'];
$stotal_page  = ceil($stotal_count / $spage_rows);  // 전체 페이지 계산
$spage_start = ($spage - 1) * $spage_rows; // 시작 열을 구함

$result = sql_query(" select * $sql_serial order by wr_num, wr_reply limit $spage_start, $spage_rows ", false);
for ($i=0; $row=sql_fetch_array($result); $i++) { 

	$list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
	$list_num = $stotal_count - ($spage - 1) * $spage_rows;
	$list[$i]['href'] = $list[$i]['href'].'&amp;spage='.$spage;
	$list[$i]['num'] = $list_num - $i;
}

$list_cnt = count($list);

$serial_pages = apms_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $spage, $stotal_page, './board.php?bo_table='.$bo_table.'&amp;wr_id='.$sid.$qstr.'&amp;spage=');

// 스킨호출
include_once($serial_skin_path.'/serial.skin.php');
?>