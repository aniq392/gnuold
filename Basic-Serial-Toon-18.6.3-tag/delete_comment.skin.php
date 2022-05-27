<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 보드설정
$boset = array();
$boset = apms_boset();

// 스킨설정
$boset['serial_skin'] = (isset($boset['serial_skin']) && $boset['serial_skin']) ? $boset['serial_skin'] : 'basic';
$serial_skin_url = $board_skin_url.'/serial/'.$boset['serial_skin'];
$serial_skin_path = $board_skin_path.'/serial/'.$boset['serial_skin'];

@include_once($serial_skin_path.'/delete_comment.skin.php');

?>