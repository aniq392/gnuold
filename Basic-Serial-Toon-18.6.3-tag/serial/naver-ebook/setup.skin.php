<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록

if(!$boset['shcolor']) $boset['shcolor'] = 'black';
if(!$boset['vstar']) $boset['vstar'] = 'crimson';

?>

<table>
<caption>연재스킨</caption>
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
	<td align="center">목록헤드</td>
	<td>
		<select name="boset[shcolor]">
			<?php echo apms_color_options($boset['shcolor']);?>
		</select>
	</td>
</tr>
<tr>
	<td align="center">목록링크</td>
	<td>
		<select name="boset[smodal]">
			<option value=""<?php echo get_selected('', $boset['smodal']);?>>글내용 - 현재창</option>
			<option value="1"<?php echo get_selected('1', $boset['smodal']);?>>글내용 - 모달창</option>
			<option value="2"<?php echo get_selected('2', $boset['smodal']);?>>링크#1 - 새창</option>
		</select>
	</td>
</tr>
<tr>
	<td align="center">E-Book 가로</td>
	<td>
		<input type="text" name="boset[w_wr_8_text]" value="<?php echo $boset['w_wr_8_text'];?>" size="20" class="frm_input" placeholder="가로 ('100%')">px
	</td>
</tr>
<tr>
	<td align="center">E-Book 세로</td>
	<td>
		<input type="text" name="boset[w_wr_9_text]" value="<?php echo $boset['w_wr_9_text'];?>" size="20" class="frm_input" placeholder="세로 800">px
	</td>
</tr>
<tr>
	<td align="center">
		별점색상
	</td>
	<td>
		<select name="boset[vstar]">
			<?php echo apms_color_options($boset['vstar']);?>
		</select>
	</td>
</tr>
</tbody>
</table>
