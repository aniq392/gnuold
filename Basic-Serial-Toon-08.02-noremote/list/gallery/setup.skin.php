<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록
if($boset['gap_r'] == "") $boset['gap_r'] = 15;
if($boset['gap_b'] == "") $boset['gap_b'] = 30;

?>
<table>
<caption>목록스킨설정</caption>
<colgroup>
	<col class="grid_2">
	<col>
</colgroup>
<thead>
<tr>
	<th scope="col">구분</th>
	<th scope="col">설정</th>
</tr>
</thead>
<tbody>
<tr>
	<td align="center">스타일</td>
	<td>
		<?php echo help('무한스크롤은 페이지하단 자동감지로 모바일에서 사이드 출력시 페이지가 길어져 작동하지 않을 수 있으며, 상단 페이징과 버튼이 자동출력 됩니다.');?>
		<select name="boset[mode]">
			<option value="">일반목록</option>
			<option value="1"<?php echo get_selected('1', $boset['mode']);?>>더보기</option>
			<option value="2"<?php echo get_selected('2', $boset['mode']);?>>무한스크롤</option>
		</select>
		&nbsp;
		더보기색	
		<select name="boset[moreb]">
			<?php echo apms_color_options($boset['moreb']);?>
		</select>
		&nbsp;
		<label><input type="checkbox" name="boset[masonry]" value="1"<?php echo ($boset['masonry']) ? ' checked' : '';?>> 메이선리</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lightbox]" value="1"<?php echo ($boset['lightbox']) ? ' checked' : '';?>> 라이트박스</label>
	</td>
</tr>
<tr>
	<td align="center">목록수</td>
	<td>
		<input type="text" name="bo_page_rows" value="<?php echo $board['bo_page_rows'];?>" size="4" class="frm_input" > 개 - PC
		&nbsp;
		<input type="text" name="bo_mobile_page_rows" value="<?php echo $board['bo_mobile_page_rows'];?>" size="4" class="frm_input" > 개 - 모바일
	</td>
</tr>
<tr>
	<td align="center">썸네일</td>
	<td>
		<?php echo help('메이선리 적용시 썸네일 높이를 0으로 설정해 주세요.');?>
		<input type="text" name="bo_gallery_width" value="<?php echo $board['bo_gallery_width'];?>" size="4" class="frm_input" > 
		x
		<input type="text" name="bo_gallery_height" value="<?php echo $board['bo_gallery_height'];?>" size="4" class="frm_input" > px - PC
		&nbsp;
		<input type="text" name="bo_mobile_gallery_width" value="<?php echo $board['bo_mobile_gallery_width'];?>" size="4" class="frm_input" > 
		x
		<input type="text" name="bo_mobile_gallery_height" value="<?php echo $board['bo_mobile_gallery_height'];?>" size="4" class="frm_input" > px - 모바일
	</td>
</tr>
<tr>
	<td align="center">이미지</td>
	<td>
		<select name="boset[shadow]">
			<?php echo apms_shadow_options($boset['shadow']);?>
		</select>
		&nbsp;
		가로수
		<input type="text" name="bo_gallery_cols" value="<?php echo $board['bo_gallery_cols'];?>" size="4" class="frm_input" > 개 - PC
	</td>
</tr>
<tr>
	<td align="center">간격설정</td>
	<td>
		<input type="text" name="boset[gap_r]" value="<?php echo ($boset['gap_r']);?>" size="4" class="frm_input"> px 좌우간격
		&nbsp;
		<input type="text" name="boset[gap_b]" value="<?php echo ($boset['gap_b']);?>" size="4" class="frm_input"> px 상하간격
	</td>
</tr>
<tr>
	<td align="center">날짜출력</td>
	<td>
		<select name="boset[date]">
			<option value=""<?php echo get_selected('', $boset['date']); ?>>출력안함</option>
			<?php echo apms_color_options($boset['date']);?>
		</select>
		&nbsp;
		<label><input type="checkbox" name="boset[trans]" value="1"<?php echo ($boset['trans']) ? ' checked' : '';?>> 반투명표시</label>
		&nbsp;
		<label><input type="checkbox" name="boset[right]" value="1"<?php echo ($boset['right']) ? ' checked' : '';?>> 우측표시</label>
	</td>
</tr>
<tr>
	<td align="center">제목길이</td>
	<td>
		<input type="text" name="bo_subject_len" value="<?php echo $board['bo_subject_len'];?>" size="4" class="frm_input" > 자 - PC
		&nbsp;
		<input type="text" name="bo_mobile_subject_len" value="<?php echo $board['bo_mobile_subject_len'];?>" size="4" class="frm_input" > 자 - 모바일
		&nbsp;
		<label><input type="checkbox" name="boset[sone]" value="1"<?php echo ($boset['sone']) ? ' checked' : '';?>> PC에서 제목 한줄표시</label>
	</td>
</tr>
</tbody>
</table>