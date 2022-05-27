<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$boset['serial_skin'] = (isset($boset['serial_skin']) && $boset['serial_skin']) ? $boset['serial_skin'] : 'basic';
$serial_skin_url = $board_skin_url.'/serial/'.$boset['serial_skin'];
$serial_skin_path = $board_skin_path.'/serial/'.$boset['serial_skin'];

include_once($serial_skin_path.'/view_comment.skin.php');

?>