<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 boset[배열키] 형태로 등록

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
		<select name="boset[lbody]">
			<option value=""<?php echo get_selected('', $boset['lbody']);?>>기본 스타일</option>
			<option value="box"<?php echo get_selected('box', $boset['lbody']);?>>박스 스타일</option>
			<option value="round"<?php echo get_selected('round', $boset['lbody']);?>>라운드 스타일</option>
			<option value="line"<?php echo get_selected('line', $boset['lbody']);?>>라인 스타일</option>
			<option value="line-round"<?php echo get_selected('line-round', $boset['lbody']);?>>라인 라운드 스타일</option>

		</select>
		&nbsp;
		테두리색
		<select name="boset[lborder]">
			<?php echo apms_color_options($boset['lborder']);?>
		</select>
		&nbsp;
		<select name="boset[shadow]">
			<?php echo apms_shadow_options($boset['shadow']);?>
		</select>
	</td>
</tr>

<tr>
	<td align="center">썸네일</td>
	<td>
		<?php echo help('기본 400x300(4:3) - 높이 0 입력시 메이슨리 스타일로 자동 전환');?>
		<input type="text" name="boset[thumb_w]" value="<?php echo $boset['thumb_w'];?>" size="4" class="frm_input">
		x
		<input type="text" name="boset[thumb_h]" value="<?php echo $boset['thumb_h'];?>" size="4" class="frm_input"> px
		-
		확대
		<input type="text" name="boset[thumb_s]" value="<?php echo $boset['thumb_s'];?>" size="4" class="frm_input"> 배 - ex) 유튜브 전용 : 1.35
	</td>
</tr>
<tr>
	<td align="center">이미지</td>
	<td>
		<input type="text" name="boset[gap]" value="<?php echo $boset['gap'];?>" size="4" class="frm_input"> px 간격
		(기본 15px)
		&nbsp;
		<label><input type="checkbox" name="boset[vicon]" value="1"<?php echo get_checked('1', $boset['vicon']);?>> 동영상 표시 아이콘 출력안함</label>
	</td>
</tr>
<!--
<tr>
	<td align="center">텍스트</td>
	<td>
		<input type="text" name="boset[lcont]" value="<?php echo $boset['lcont'];?>" size="4" class="frm_input"> 자 내용
		(기본 100자, 0 미출력)
		-
		제목/내용
		<input type="text" name="boset[cline]" value="<?php echo $boset['cline'];?>" size="4" class="frm_input"> 줄 출력
		(기본 4줄)
	</td>
</tr>
-->
<tr>
	<td align="center">목록수</td>
	<td>
		<input type="text" name="bo_page_rows" value="<?php echo $board['bo_page_rows'];?>" size="4" class="frm_input" > 개 - PC
		&nbsp;
		<input type="text" name="bo_mobile_page_rows" value="<?php echo $board['bo_mobile_page_rows'];?>" size="4" class="frm_input" > 개 - 모바일
	</td>
</tr>
<tr>
	<td align="center">가로수</td>
	<td>
		<input type="text" name="boset[item]" value="<?php echo $boset['item']; ?>" class="frm_input" size="4"> 개
		(기본 3개, 반응형 기본 lg 3개, md 3개, sm 2개, xs 1개)
		<div class="h10"></div>
		<table>
		<thead>
		<tr>
			<th scope="col">구분</th>
			<th scope="col">lg(1199px~)</th>
			<th scope="col">md(991px~)</th>
			<th scope="col">sm(767px~)</th>
			<th scope="col">xs(480px~)</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td align="center">가로수</td>
			<td align="center">
				<input type="text" name="boset[lg]" value="<?php echo $boset['lg']; ?>" class="frm_input" size="4">
			</td>
			<td align="center">
				<input type="text" name="boset[md]" value="<?php echo $boset['md']; ?>" class="frm_input" size="4">
			</td>
			<td align="center">
				<input type="text" name="boset[sm]" value="<?php echo $boset['sm']; ?>" class="frm_input" size="4">
			</td>
			<td align="center">
				<input type="text" name="boset[xs]" value="<?php echo $boset['xs']; ?>" class="frm_input" size="4">
			</td>
		</tr>
		<tr>
			<td align="center">BP</td>
			<td align="center">
				<input type="text" name="boset[lgbp]" value="<?php echo $boset['lgbp']; ?>" class="frm_input" size="4">
			</td>
			<td align="center">
				<input type="text" name="boset[mdbp]" value="<?php echo $boset['mdbp']; ?>" class="frm_input" size="4">
			</td>
			<td align="center">
				<input type="text" name="boset[smbp]" value="<?php echo $boset['smbp']; ?>" class="frm_input" size="4">
			</td>
			<td align="center">
				<input type="text" name="boset[xsbp]" value="<?php echo $boset['xsbp']; ?>" class="frm_input" size="4">
			</td>
		</tr>
		</tbody>
		</table>
	</td>
</tr>
<!--
<tr>
	<td align="center">보임설정</td>
	<td>
		<label><input type="checkbox" name="boset[ldate]" value="1"<?php echo get_checked('1', $boset['ldate']);?>> 날짜</label>
		&nbsp;
		<label><input type="checkbox" name="boset[ldown]" value="1"<?php echo get_checked('1', $boset['ldown']);?>> 다운</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lvisit]" value="1"<?php echo get_checked('1', $boset['lvisit']);?>> 방문</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lgood]" value="1"<?php echo get_checked('1', $boset['lgood']);?>> 추천</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lnogood]" value="1"<?php echo get_checked('1', $boset['lnogood']);?>> 비추</label>
		&nbsp;
		<label><input type="checkbox" name="boset[ldpoint]" value="1"<?php echo get_checked('1', $boset['ldpoint']);?>> 다운점수</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lmb]" value="1"<?php echo get_checked('1', $boset['lmb']);?>> 회원사진</label>
	</td>
</tr>
<tr>
	<td align="center">숨김설정</td>
	<td>
		<label><input type="checkbox" name="boset[lcate]" value="1"<?php echo get_checked('1', $boset['lcate']);?>> 분류</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lname]" value="1"<?php echo get_checked('1', $boset['lname']);?>> 이름</label>
		&nbsp;
		<label><input type="checkbox" name="boset[lhit]" value="1"<?php echo get_checked('1', $boset['lhit']);?>> 조회</label>
	</td>
</tr>
<tr>
	<td align="center">날짜모양</td>
	<td>
		<input type="text" name="boset[dtype]" value="<?php echo $boset['dtype'];?>" size="8" class="frm_input" >
		(Y.m.d, Y/m/d 등 날짜타입)
	</td>
</tr>
-->
</tbody>
</table>