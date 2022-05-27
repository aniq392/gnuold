<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 목록모드
$is_mode = (isset($boset['mode']) && $boset['mode']) ? $boset['mode'] : '';

if($is_mode) {
 	apms_script('imagesloaded');
	apms_script('infinite');
}

// 상단 페이징/버튼
if($is_mode == "2")
	include_once($list_skin_path.'/list.top.skin.php');

if($is_category) 
	include_once($board_skin_path.'/category.skin.php'); // 카테고리

?>
