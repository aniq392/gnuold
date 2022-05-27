<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 표지삭제시 연재글 있는지 체크
if(!$write['wr_1']) {
	$cnt = sql_fetch("select count(*) as cnt from $write_table where wr_is_comment = '0' and wr_1 <> '' and wr_1 = '{$write['wr_id']}' ", false);

	if ($cnt['cnt']) {
		alert('이 표지와 관련된 연재글이 존재하므로 삭제 할 수 없습니다.\\n\\n우선 연재글부터 삭제하여 주십시오.');
	}
}

?>