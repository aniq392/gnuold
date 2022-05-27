<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 보드설정값
$bo_set = "
	bo_1 = '$bo_1',
	bo_2 = '$bo_2'
";

sql_query(" update {$g5['board_table']} set $bo_set where bo_table = '{$bo_table}' ", false);


?>
