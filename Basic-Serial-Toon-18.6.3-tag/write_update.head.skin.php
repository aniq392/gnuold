<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 회원전용
if($is_guest) {
	alert('회원만 등록이 가능합니다.');
}

// 글등록 회원체크
if($w != 'u' && !$is_admin && $boset['smb_list'] && !$wr_1) {
	$smb_arr = explode(',', $boset['smb_list']);
	if(count($smb_arr) > 0) {
		if(!in_array($member['mb_id'], $smb_arr)) {
			alert('지정된 회원만 등록이 가능합니다.');
		}
	}
}

// 시리즈이면...
if($w != 'u' && $wr_1) {
	$swr = get_write($write_table, $wr_1);
	if(!$swr['wr_id']) {
		alert('지정한 표지는 없는 표지입니다.');
	}
	if($is_admin || $swr['mb_id'] == $member['mb_id'] || $boset['swrite']) {
		;
	} else {
		alert('자신의 표지에만 글등록이 가능합니다.');
	}
}

// 스킨설정
$boset['serial_skin'] = (isset($boset['serial_skin']) && $boset['serial_skin']) ? $boset['serial_skin'] : 'basic';
$serial_skin_url = $board_skin_url.'/serial/'.$boset['serial_skin'];
$serial_skin_path = $board_skin_path.'/serial/'.$boset['serial_skin'];

// 간단쓰기 제목처리
if($w == '' && isset($is_subject) && $is_subject) {
	$wr_subject = apms_cut_text($wr_content, 30); // 글내용 30자 자르기
}

@include_once($serial_skin_path.'/write_update.head.skin.php');
?>