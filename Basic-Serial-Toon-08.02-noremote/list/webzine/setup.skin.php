<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록
if(!$boset['img_w']) $boset['img_w'] = 160;
if(!$boset['cont']) $boset['cont'] = 100;
if(!$boset['m_cont']) $boset['m_cont'] = 100;

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
		<select name="boset[align]">
			<option value=""<?php echo get_selected('', $boset['align']); ?>>좌측위치</option>
			<option value="1"<?php echo get_selected('1', $boset['align']); ?>>우측위치</option>
		</select>
		&nbsp;
		너비
		<input type="text" name="boset[img_w]" value="<?php echo $boset['img_w'];?>" size="4" class="frm_input" > px 
		- 기본값 : 160
		&nbsp;
		<label><input type="checkbox" name="boset[noimg]" value="1"<?php echo ($boset['noimg']) ? ' checked' : '';?>> No-Image 출력안함</label>
	</td>
</tr>
<tr>
	<td align="center">제목길이</td>
	<td>
		<input type="text" name="bo_subject_len" value="<?php echo $board['bo_subject_len'];?>" size="4" class="frm_input" > 자 - PC
		&nbsp;
		<input type="text" name="bo_mobile_subject_len" value="<?php echo $board['bo_mobile_subject_len'];?>" size="4" class="frm_input" > 자 - 모바일
	</td>
</tr>
<tr>
	<td align="center">내용길이</td>
	<td>
		<input type="text" name="boset[cont]" value="<?php echo $boset['cont'];?>" size="4" class="frm_input" > 자 - PC
		&nbsp;
		<input type="text" name="boset[m_cont]" value="<?php echo $boset['m_cont'];?>" size="4" class="frm_input" > 자 - 모바일
	</td>
</tr>
<tr>
	<td align="center">출력설정</td>
	<td>
		<select name="boset[shadow]">
			<?php echo apms_shadow_options($boset['shadow']);?>
		</select>
		&nbsp;
		<label><input type="checkbox" name="boset[name]" value="1"<?php echo ($boset['name']) ? ' checked' : '';?>> 이름출력</label>
		&nbsp;
		<select name="boset[tack]">
			<option value=""<?php echo get_selected('', $boset['tack']); ?>>이미지</option>
			<option value="1"<?php echo get_selected('1', $boset['tack']); ?>>제목</option>
			<option value="2"<?php echo get_selected('2', $boset['tack']); ?>>이미지/제목</option>
		</select>
		라벨
	</td>
</tr>
</tbody>
</table>