<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//창열기
$boset['modal'] = (isset($boset['modal'])) ? $boset['modal'] : '';

$is_modal_js = $is_link_target = '';
if($boset['smodal'] == "1") { //모달
	$is_modal_js = apms_script('modal');
} else if($boset['smodal'] == "2") { //링크#1
	$is_link_target = ' target="_blank"';
}

$head_class = (isset($boset['shcolor']) && $boset['shcolor']) ? 'border-'.$boset['shcolor'] : 'border-black';

?>

<div class="serial-list">
	<div class="div-head <?php echo $head_class;?>">
		<span class="wr-thumb">이미지</span>
		<span class="wr-num hidden-xs">회차</span>
		<span class="wr-subject">연재 목록</span>
		<span class="wr-star">별점</span>
		<span class="wr-date hidden-xs">날짜</span>
		<span class="wr-hit hidden-xs">조회</span>
		<?php if($is_good) { ?>
			<span class="wr-good hidden-xs">추천</span>
		<?php } ?>
	</div>
	<ul class="list-body">
	<?php
	for ($i=0; $i < $list_cnt; $i++) { 

		//아이콘 체크
		$wr_icon = '';
		if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
			$wr_icon = '<span class="wr-icon wr-secret"></span>';
		} else if ($list[$i]['icon_hot']) {
			$wr_icon = '<span class="wr-icon wr-hot"></span>';
		} else if ($list[$i]['icon_new']) {
			$wr_icon = '<span class="wr-icon wr-new"></span>';
		}

		// 현재글 스타일 체크
		$li_css = '';
		if ($wr_id == $list[$i]['wr_id']) {
			$li_css = ' bg-light';
			$list[$i]['num'] = '<span class="wr-text orangered">열람중</span>';
			$list[$i]['subject'] = '<b class="red">'.$list[$i]['subject'].'</b>';
		}

		// 링크이동
		$list[$i]['target'] = '';
		if($is_link_target && !$list[$i]['is_notice'] && $list[$i]['wr_link1']) {
			$list[$i]['target'] = $is_link_target;
			$list[$i]['href'] = $list[$i]['link_href'][1];
		}

	?>
		<li class="list-item<?php echo $li_css;?>">

			<div class="wr-thumb">
					<?php 
						$wr_vicon = ($is_vicon && ($list[$i]['as_list'] == "2" || $list[$i]['as_list'] == "3")) ? '<i class="fa fa-play-circle-o wr-vicon"></i>' : ''; // 비디오 아이콘
						$img = apms_wr_thumbnail($bo_table, $list[$i], 80, 50, false, true); // 썸네일
						if($img['src']) { 
					?>
							<div class="thumb-img">
									<div class="img-item">
										<a href="<?php echo $list[$i]['href']; ?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
											<?php echo $wr_vicon;?>
											<img src="<?php echo $img['src'];?>">
										</a>
									</div>
							</div>
						<?php }  ?>
			</div>

			<div class="wr-num hidden-xs"><?php echo $list[$i]['num']; ?></div>

			<?php $vstar = apms_post_star($list[$i], $vstar_color); ?>

			<div class="wr-subject">
				<a href="<?php echo $list[$i]['href']; ?>" class="item-subject"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
					<?php if ($list[$i]['wr_comment']) { ?>
						<span class="orangered visible-xs pull-right wr-comment">
							<i class="fa fa-comment lightgray"></i>
							<b><?php echo $list[$i]['wr_comment']; ?></b>
						</span>
					<?php } ?>
					<?php echo $wr_icon; ?>
					<?php echo $list[$i]['subject']; ?>
					<?php if ($list[$i]['wr_comment']) { ?>
						<span class="count orangered hidden-xs"><?php echo $list[$i]['wr_comment']; ?></span>
					<?php } ?>
				</a>
				<div class="item-details text-muted font-12 visible-xs ellipsis">
					<span>
						<i class="fa fa-clock-o"></i>
						<?php echo apms_date($list[$i]['date'], 'orangered', 'before', 'Y.m.d', 'Y.m.d'); ?>
					</span>
					<?php if($is_good) { ?>
						<span><i class="fa fa-thumbs-up"></i> <?php echo $list[$i]['wr_good'];?></span>
					<?php } ?>
				</div>
			</div>
			<div class="wr-star">
				<span><?php echo $vstar['star'];?> (<?php echo $vstar['score']; //평균 별점 점수  ?>)</span>
			</div>
			<div class="wr-date hidden-xs">
				<?php echo apms_date($list[$i]['date'], 'orangered', 'H:i', 'Y.m.d', 'Y.m.d'); ?>
			</div>
			<div class="wr-hit hidden-xs">
				<?php echo $list[$i]['wr_hit'];?>
			</div>
			<?php if($is_good) { ?>
				<div class="wr-good hidden-xs">
					<?php echo $list[$i]['wr_good'];?>
				</div>
			<?php } ?>
		</li>
	<?php } ?>
	</ul>
	<div class="clearfix"></div>
	<?php if (!$list_cnt) { ?>
		<div class="wr-none">연재글이 없습니다.</div>
	<?php } ?>
</div>

<div class="serial-page text-center">
	<ul class="pagination en no-margin">
		<?php echo $serial_pages;?>
	</ul>
</div>
