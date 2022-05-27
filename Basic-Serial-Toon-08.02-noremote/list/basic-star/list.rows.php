<?php
if (!defined('_GNUBOARD_')) {
	// AJAX일 때
	$is_ajax = true;
	include_once('../../../../../common.php');
	include_once(G5_BBS_PATH.'/list.rows.php');
	$list_cnt = count($list);
	if(!$list_cnt) exit;

	// 창열기
	$is_modal_js = $is_link_target = '';
	if($boset['modal'] == "1") { // 모달
		$is_modal_js = ' onclick="view_modal(this.href); return false;"';
	} else if($boset['modal'] == "2") { //링크#1
		$is_link_target = ' target="_blank"';
	}

	// 라벨
	$labels = array();
	$label_cnt = 0;
	if($boset['label']) {
		$labels = apms_label_list($boset);
		$label_cnt = count($labels);
		if(!$label_cnt) $label_cnt = 1;
	}

	if(!$boset['list_skin']) $boset['list_skin'] = 'basic'; // 목록스킨

	$list_skin_url = $board_skin_url.'/list/'.$boset['list_skin'];
	$list_skin_path = $board_skin_path.'/list/'.$boset['list_skin'];

	// 숨김설정
	$is_num = (isset($boset['lnum']) && $boset['lnum']) ? false : true;
	$is_name = (isset($boset['lname']) && $boset['lname']) ? false : true;
	$is_date = (isset($boset['ldate']) && $boset['ldate']) ? false : true;
	$is_hit = (isset($boset['lhit']) && $boset['lhit']) ? false : true;
	$is_vicon = (isset($boset['vicon']) && $boset['vicon']) ? false : true;

	// 보임설정
	$is_category = (isset($boset['lcate']) && $boset['lcate']) ? true : false;
	$is_thumb = (isset($boset['lthumb']) && $boset['lthumb']) ? true : false;
	$is_down = (isset($boset['ldown']) && $boset['ldown']) ? true : false;
	$is_visit = (isset($boset['lvisit']) && $boset['lvisit']) ? true : false;
	$is_good = (isset($boset['lgood']) && $boset['lgood']) ? true : false;
	$is_nogood = (isset($boset['lnogood']) && $boset['lnogood']) ? true : false;
	$is_reply = (isset($boset['lreply']) && $boset['lreply']) ? true : false;
	$is_star = (isset($boset['vstar']) && $boset['vstar']) ? $boset['vstar'] : '';

	// 포토
	$fa_photo = (isset($boset['ficon']) && $boset['ficon']) ? apms_fa($boset['ficon']) : '<i class="fa fa-user"></i>';

	// 날짜
	$is_dtype = (isset($boset['dtype']) && $boset['dtype']) ? $boset['dtype'] : 'Y.m.d';
	$is_dtxt = (isset($boset['dtxt']) && $boset['dtxt']) ? true : false;

	// 출력설정
	$num_notice = ($is_thumb) ? '*' : '<span class="wr-icon wr-notice"></span>';
}

for ($i=0; $i < $list_cnt; $i++) { 

	// 라벨
	$wr_label = '';
	if($label_cnt) { 
		list($label_name, $label_color) = apms_label_icon($list[$i]['ca_name'], $labels, $label_cnt, $boset['label_name'], $boset['label_color']);
		$wr_label = ($label_name) ? '<span class="tack-icon bg-'.$label_color.'">'.$label_name.'</span>' : '';
	}

	//아이콘 체크
	$wr_icon = '';
	$is_lock = false;
	if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
		$wr_icon = '<span class="wr-icon wr-secret"></span>';
		$is_lock = true;
	} else if ($list[$i]['icon_hot']) {
		$wr_icon = '<span class="wr-icon wr-hot"></span>';
	} else if ($list[$i]['icon_new']) {
		$wr_icon = '<span class="wr-icon wr-new"></span>';
	} else if ($list[$i]['icon_video']) {
		$wr_icon = '<span class="wr-icon wr-video"></span>';
	} else if ($list[$i]['icon_image']) {
		$wr_icon = '<span class="wr-icon wr-image"></span>';
	} else if ($list[$i]['icon_file']) {
		$wr_icon = '<span class="wr-icon wr-file"></span>';
	}

	// 공지, 현재글 스타일 체크
	$li_css = '';
	if ($list[$i]['is_notice']) { // 공지사항
		$li_css = ' bg-light';
		$list[$i]['num'] = $num_notice;
		$list[$i]['ca_name'] = '';
		$list[$i]['subject'] = '<b>'.$list[$i]['subject'].'</b>';
		$wr_icon = ($is_thumb) ? '' : '<b class="wr-hidden">[알림]</b>';
	} else {
		if($is_category && $list[$i]['ca_name']) {
			$list[$i]['subject'] = '['.$list[$i]['ca_name'].'] '.$list[$i]['subject'];
		}
		if ($wr_id == $list[$i]['wr_id']) {
			$li_css = ' bg-light';
			$list[$i]['num'] = '<span class="wr-text orangered">열람중</span>';
			$list[$i]['subject'] = '<b class="red">'.$list[$i]['subject'].'</b>';
		}
	}

	// 링크이동
	$list[$i]['target'] = '';
	if($is_link_target && !$list[$i]['is_notice'] && $list[$i]['wr_link1']) {
		$list[$i]['target'] = $is_link_target;
		$list[$i]['href'] = $list[$i]['link_href'][1];
	}

?>
	<li class="list-item<?php echo $li_css;?>">
		<?php if ($is_checkbox) { ?>
			<div class="wr-chk">
				<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
			</div>
		<?php } ?>
		<?php if($is_num) { ?>
			<div class="wr-num hidden-xs"><?php echo $list[$i]['num']; ?></div>
		<?php } ?>
		<?php if($is_thumb) { ?>
			<div class="wr-thumb">
				<?php if ($list[$i]['is_notice']) { ?>
					<span class="wr-icon wr-notice"></span>
				<?php } else {
					$wr_vicon = ($is_vicon && ($list[$i]['as_list'] == "2" || $list[$i]['as_list'] == "3")) ? '<i class="fa fa-play-circle-o wr-vicon"></i>' : ''; // 비디오 아이콘
					$img = apms_wr_thumbnail($bo_table, $list[$i], 50, 50, false, true); // 썸네일
					if($img['src']) { 
				?>
						<div class="thumb-img">
							<div class="img-wrap" style="padding-bottom:100%;">
								<div class="img-item">
									<a href="<?php echo $list[$i]['href']; ?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
										<?php echo $wr_vicon;?>
										<img src="<?php echo $img['src'];?>">
									</a>
								</div>
							</div>
						</div>
					<?php } else { ?>
						<div class="thumb-icon">
							<a href="<?php echo $list[$i]['href']; ?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
								<?php
									// 아이콘
									$thumb_icon = ($list[$i]['as_icon']) ? apms_fa(apms_emo($list[$i]['as_icon'])) : '';
									if(!$thumb_icon) {
										$thumb_icon = apms_photo_url($list[$i]['mb_id']);
										$thumb_icon = ($thumb_icon) ? '<img src="'.$thumb_icon.'">' : $fa_photo;
									}
									echo $wr_vicon;
									echo $thumb_icon;
								?>
							</a>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		<?php } ?>
		<div class="wr-subject">
			<a href="<?php echo $list[$i]['href']; ?>" class="item-subject"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
				<?php if ($list[$i]['wr_comment']) { ?>
					<span class="orangered visible-xs pull-right wr-comment">
						<i class="fa fa-comment lightgray"></i>
						<b><?php echo $list[$i]['wr_comment']; ?></b>
					</span>
				<?php } ?>
				<?php echo $list[$i]['icon_reply']; ?>
				<?php echo $wr_label; ?>
				<?php echo $wr_icon; ?>
				<?php echo $list[$i]['subject']; ?>
				<?php if ($list[$i]['wr_comment']) { ?>
					<span class="count orangered hidden-xs"><?php echo $list[$i]['wr_comment']; ?></span>
				<?php } ?>
			</a>
			<?php if(!$list[$i]['is_notice']) { //공지가 아닐경우 ?>
				<div class="item-details text-muted font-12 visible-xs ellipsis">
					<?php if($is_name) { ?>
						<span><?php echo $list[$i]['name']; ?></span>
					<?php } ?>
					<?php if($is_star) { 
						$lvstar = apms_post_star($list[$i], $is_star);
					?>
						<span><?php echo $lvstar['star'];?></span>
					<?php } ?>
					<span><i class="fa fa-eye"></i> <?php echo $list[$i]['wr_hit']; ?></span>
					<?php if($is_down) { ?>
						<span><i class="fa fa-download"></i> <?php echo $list[$i]['as_download'];?></span>
					<?php } ?>
					<?php if($is_visit) { ?>
						<span><i class="fa fa-share"></i> <?php echo ($list[$i]['wr_link1_hit'] + $list[$i]['wr_link2_hit']);?></span>
					<?php } ?>
					<?php if($is_good) { ?>
						<span><i class="fa fa-thumbs-up"></i> <?php echo $list[$i]['wr_good'];?></span>
					<?php } ?>
					<?php if($is_nogood) { ?>
						<span><i class="fa fa-thumbs-down"></i> <?php echo $list[$i]['wr_nogood'];?></span>
					<?php } ?>
					<span>
						<i class="fa fa-clock-o"></i>
						<?php echo apms_date($list[$i]['date'], 'orangered', 'before', 'm.d', 'Y.m.d'); ?>
					</span>
				</div>
			<?php } ?>
		</div>
		<?php if($is_name) { ?>
			<div class="wr-name hidden-xs">
				<?php echo $list[$i]['name'];?>
			</div>
		<?php } ?>
		<?php if($is_date) { ?>
			<div class="wr-date hidden-xs">
				<?php echo apms_date($list[$i]['date'], 'orangered', 'H:i', 'm.d', 'Y.m.d'); ?>
			</div>
		<?php } ?>
		<?php if($is_hit) { ?>
			<div class="wr-hit hidden-xs">
				<?php echo $list[$i]['wr_hit'];?>
			</div>
		<?php } ?>
		<?php if($is_down) { ?>
			<div class="wr-down hidden-xs">
				<?php echo $list[$i]['as_download'];?>
			</div>
		<?php } ?>
		<?php if($is_visit) { ?>
			<div class="wr-visit hidden-xs">
				<?php echo ($list[$i]['wr_link1_hit'] + $list[$i]['wr_link2_hit']);?>
			</div>
		<?php } ?>
		<?php if($is_good) { ?>
			<div class="wr-good hidden-xs">
				<?php echo $list[$i]['wr_good'];?>
			</div>
		<?php } ?>
		<?php if($is_nogood) { ?>
			<div class="wr-nogood hidden-xs">
				<?php echo $list[$i]['wr_nogood'];?>
			</div>
		<?php } ?>
		<?php if($is_star) { ?>
			<div class="wr-star hidden-xs">
				<?php echo $lvstar['star'];?>
			</div>
		<?php } ?>
		<?php if($is_reply) { ?> 
			<div class="wr-reply">
				<span class="wr-icon reply-<?php echo ($list[$i]['wr_comment']) ? 'end' : 'wait';?>"></span>
			</div>
		<?php } ?>
	</li>
<?php } ?>
