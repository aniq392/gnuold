<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 썸네일 - 기본 400x300 크기(4:3)
$thumb_w = (isset($boset['thumb_w']) && ($boset['thumb_w'] > 0 || $boset['thumb_w'] == "0")) ? (int)$boset['thumb_w'] : 400;
$thumb_h = (isset($boset['thumb_h']) && ($boset['thumb_h'] > 0 || $boset['thumb_h'] == "0")) ? (int)$boset['thumb_h'] : 300;
$thumb_s = (isset($boset['thumb_s']) && $boset['thumb_s']) ? $boset['thumb_s'] : ''; //유튜브 1.35
$img_h = apms_img_height($thumb_w, $thumb_h, '56.25');

// 썸네일 높이가 0이면 자동 메이슨리 전환
if($thumb_h) {
	$is_masonry = false;
} else {
 	apms_script('imagesloaded');
	apms_script('masonry');
	$is_masonry = true;
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css" media="screen">', 0);

// 간격 - 기본 15px
$gap = (isset($boset['gap']) && ($boset['gap'] > 0 || $boset['gap'] == "0")) ? (int)$boset['gap'] : 15;

// 반응형 - 기본 3개 나열
$item = (isset($boset['item']) && $boset['item'] > 0) ? (int)$boset['item'] : 3;
$lg = (isset($boset['lg']) && $boset['lg'] > 0) ? (int)$boset['lg'] : 3;
$md = (isset($boset['md']) && $boset['md'] > 0) ? (int)$boset['md'] : 3;
$sm = (isset($boset['sm']) && $boset['sm'] > 0) ? (int)$boset['sm'] : 2;
$xs = (isset($boset['xs']) && $boset['xs'] > 0) ? (int)$boset['xs'] : 1;

// 글내용 - 기본 100자
$is_cont = (isset($boset['lcont']) && ($boset['lcont'] > 0 || $boset['lcont'] == "0")) ? (int)$boset['lcont'] : 100;

// 줄수 - 기본 4줄
$is_line = (isset($boset['cline']) && $boset['cline'] >= 1) ? (int)$boset['cline'] : 4;
$is_line = ($is_cont) ? $is_line * 20 + 5 : $is_line * 20; //line-height:20px, 제목과 내용간격 5px

// 썸네일 포토
$fa_color = (isset($boset['ibg']) && $boset['ibg']) ? ' bg-'.$boset['icolor'] : ' bg-light '.$boset['icolor'];
$fa_photo = (isset($boset['ficon']) && $boset['ficon']) ? apms_fa($boset['ficon']) : '<i class="fa fa-picture-o"></i>';

// 날짜
$is_dtype = (isset($boset['dtype']) && $boset['dtype']) ? $boset['dtype'] : 'Y.m.d';

// 숨김설정
$is_vicon = (isset($boset['vicon']) && $boset['vicon']) ? false : true;
$is_name = (isset($boset['lname']) && $boset['lname']) ? false : true;
$is_hit = (isset($boset['lhit']) && $boset['lhit']) ? false : true;
$is_category = (isset($boset['lcate']) && $boset['lcate']) ? false : $is_category;

// 보임설정
$is_date = (isset($boset['ldate']) && $boset['ldate']) ? true : false;
$is_down = (isset($boset['ldown']) && $boset['ldown']) ? true : false;
$is_dpoint = (isset($boset['ldpoint']) && $boset['ldpoint']) ? true : false;
$is_visit = (isset($boset['lvisit']) && $boset['lvisit']) ? true : false;
$is_good = (isset($boset['lgood']) && $boset['lgood']) ? true : false;
$is_nogood = (isset($boset['lnogood']) && $boset['lnogood']) ? true : false;
$is_mb = (isset($boset['lmb']) && $boset['lmb']) ? ' is-photo' : '';
$is_shadow = (isset($boset['shadow']) && $boset['shadow']) ? apms_shadow($boset['shadow']) : '';

$is_style = (isset($boset['lbody']) && $boset['lbody']) ? $boset['lbody'] : 'basic';

?>
<style>
	.list-body .list-row { float:left; width:<?php echo apms_img_width($item);?>%; } 
	.list-body .list-row .img-wrap { padding-bottom:<?php echo $img_h;?>% !important; }
	<?php if($thumb_s) { //스케일 ?>
	.list-body .list-row .wr-img { -webkit-transform: scale(<?php echo $thumb_s;?>); -moz-transform: scale(<?php echo $thumb_s;?>); -o-transform: scale(<?php echo $thumb_s;?>); -ms-transform: scale(<?php echo $thumb_s;?>); transform: scale(<?php echo $thumb_s;?>); }
	<?php } ?>
	<?php if($gap) { //간격 ?>
	.list-body { overflow:hidden; margin-right:-<?php echo $gap;?>px; margin-bottom:-<?php echo $gap;?>px; }
	.list-body .list-col { margin-right:<?php echo $gap;?>px; margin-bottom: <?php echo $gap;?>px; }
	<?php } ?>
	<?php if(!$is_masonry) { //제목과 내용 높이 ?>
	.list-body .list-desc { height:<?php echo $is_line;?>px; }
	<?php } ?>
	<?php if(_RESPONSIVE_) { //반응형일 때만 작동 ?>
		<?php if($lg) { ?>
		@media (max-width: <?php echo (isset($boset['lgbp']) && $boset['lgbp'] > 0) ? $boset['lgbp'] : 1199;?>px) { 
			.responsive .list-body .list-row { width:<?php echo apms_img_width($lg);?>%; } 
		}
		<?php } ?>
		<?php if($md) { ?>
		@media (max-width: <?php echo (isset($boset['mdbp']) && $boset['mdbp'] > 0) ? $boset['mdbp'] : 991;?>px) { 
			.responsive .list-body .list-row { width:<?php echo apms_img_width($md);?>%; } 
		}
		<?php } ?>
		<?php if($sm) { ?>
		@media (max-width: <?php echo (isset($boset['smbp']) && $boset['smbp'] > 0) ? $boset['smbp'] : 767;?>px) { 
			.responsive .list-body .list-row { width:<?php echo apms_img_width($sm);?>%; } 
		}
		<?php } ?>
		<?php if($xs) { ?>
		@media (max-width: <?php echo (isset($boset['xsbp']) && $boset['xsbp'] > 0) ? $boset['xsbp'] : 480;?>px) { 
			.responsive .list-body .list-row { width:<?php echo apms_img_width($xs);?>%; } 
		}
		<?php } ?>
	<?php } ?>
</style>
<div class="list-board">
	<?php if($notice_count > 0) { //공지사항 ?>
		<div class="wr-notice">
			<ul class="list-group no-margin">
			<?php for ($i=0; $i < $notice_count; $i++) { 
					if(!$list[$i]['is_notice']) break; //공지가 아니면 끝냄 
			?>
				 <li class="list-group-item">
					<a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js;?>>
						<span class="hidden-xs pull-right text-muted">
							<i class="fa fa-clock-o"></i> <?php echo date("Y.m.d", $list[$i]['date']);?>
						</span>
						<i class="fa fa-bell orangered"></i>
						<strong><?php echo $list[$i]['subject'];?></strong>
						<?php if($list[$i]['wr_comment']) { ?>
							<span class="count red"><?php echo $list[$i]['wr_comment'];?></span>
						<?php } ?>
					</a>
				</li>
			<?php } ?>
			</ul>
		</div>
	<?php } ?>
	<div class="list-body <?php echo $is_style;?>-body <?php echo (isset($boset['lborder']) && $boset['lborder']) ? $boset['lborder'] : 'color';?>-body<?php echo $is_mb;?>">
	<?php
	for ($i=0; $i < $list_cnt; $i++) { 

$tag_list1 = $list[$i]['as_tag']; 
preg_match("/(완결)/",$tag_list1,$matches); 
$tag_ing=$matches[0];
$star = apms_post_star($list[$i], 'fa-lg orange');

		//공지글 제외
		if($list[$i]['is_notice']) continue; 

		//라벨 체크
		$wr_label = '';
		$is_lock = false;
		if ($list[$i]['icon_secret'] || $list[$i]['is_lock']) {
			$is_lock = true;
			$wr_label = '<div class="label-cap bg-orange">Lock</div>';	
		} else {
			if ($wr_id == $list[$i]['wr_id']) {
				$wr_label = '<div class="label-cap bg-green">Now</div>';	
			} else if ($tag_ing) {
				$wr_label = '<div class="label-cap bg-red">완결</div>';	
			} else if ($list[$i]['icon_hot']) {
				$wr_label = '<div class="label-cap bg-red">Hot</div>';	
			} else if ($list[$i]['icon_new']) {
				$wr_label = '<div class="label-cap bg-blue">New</div>';	
			}
		}

		// 링크이동
		$list[$i]['target'] = '';
		if($is_link_target && !$list[$i]['is_notice'] && $list[$i]['wr_link1']) {
			$list[$i]['target'] = $is_link_target;
			$list[$i]['href'] = $list[$i]['link_href'][1];
		}

		// 썸네일
		$wr_vicon = ($is_vicon && ($list[$i]['as_list'] == "2" || $list[$i]['as_list'] == "3")) ? '<i class="fa fa-play-circle-o wr-vicon"></i>' : ''; // 비디오 아이콘
		$thumb = apms_wr_thumbnail($bo_table, $list[$i], $thumb_w, $thumb_h, false, true); // 썸네일
		$wr_thumb = ($thumb['src']) ? '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" class="wr-img">' : '<div class="thumb-icon'.$fa_color.'"><div class="wr-fa">'.$fa_photo.'</div></div>';

		// 날짜
		$wr_date = ($is_date) ? '<div class="wr-date en">'.date($is_dtype, $list[$i]['date']).'</div>' : '';

		// 회원사진
		$wr_mb = '';
		if($is_mb) {
			$wr_mb = apms_photo_url($list[$i]['mb_id']);
			$wr_mb = ($wr_mb) ? '<span class="wr-mb"><img src="'.$wr_mb.'"></span>' : '<span class="wr-mb"><i class="fa fa-user"></i></span>';
		}

	?>
		<div class="list-row">
			<div class="list-col">
				<div class="list-box<?php echo ($wr_id == $list[$i]['wr_id']) ? ' active' : '';?>">
					<div class="list-front">
						<div class="list-img">
							<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
								<?php if($is_masonry && $thumb['src']) { ?>
									<div class="list-thumb">
										<?php echo $wr_label;?>
										<?php echo $wr_vicon;?>
										<?php echo $wr_date;?>
										<?php echo $wr_thumb;?>
									</div>
								<?php } else { ?>
									<div class="imgframe">
										<div class="img-wrap">
											<?php echo $wr_label;?>
											<?php echo $wr_vicon;?>
											<?php echo $wr_date;?>
											<div class="img-item">
												<?php echo $wr_thumb;?>
											</div>
										</div>
									</div>
								<?php } ?>
							</a>
							<?php if ($is_checkbox) { ?>
								<div class="list-chk">
									<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
								</div>
							<?php } ?>
							<div class="in-lable trans-bg-blue"><a href="<?php echo $list[$i]['href'];?>"<?php echo $is_modal_js;?><?php echo $target;?>><font color="white"><?php echo $list[$i]['subject'];?></font></a></div>

								<div style="position: absolute;top:0px; width:100px; left:0px; padding: 0px 10px; font-size: 9px;">
									<?php echo $star['star']; //평균 별점 점수 ?>
								</div>
						</div>
						<?php echo $is_shadow; //그림자 ?>

						<div class="list-text">
<!--
							<?php if($is_category) { ?>
								<div class="div-title-underline-thin font-12">
									<?php echo ($list[$i]['ca_name']) ? $list[$i]['ca_name'] : '미분류';?>
								</div>
								<div class="clearfix"></div>
							<?php } ?>
							<div class="list-desc">
								<a href="<?php echo $list[$i]['href'];?>"<?php echo $list[$i]['target'];?><?php echo $is_modal_js;?>>
									<strong class="en"><?php echo $list[$i]['wr_subject'];?></strong>
									<?php if($is_cont) { ?>
										<div class="h5"></div>
										<div class="text-muted font-12">
											<?php echo apms_cut_text($list[$i]['wr_content'], $is_cont); ?>
										</div>
									<?php } ?>
								</a>
							</div>

							<div class="list-info font-12">
								<div class="pull-left">
									<?php echo $wr_mb;?>
									<?php echo ($is_name) ? $list[$i]['name'] : ''; ?>
								</div>
								<div class="pull-right en font-14">
									<i class="fa fa-commenting blue"></i> 
									<?php echo $list[$i]['wr_comment'];?>
									<?php if($is_dpoint) { ?>
										<i class="fa fa-gift green"></i>
										<?php echo $list[$i]['as_down'];?>
									<?php } ?>
									<?php if($is_down) { ?>
										<i class="fa fa-download skyblue"></i>
										<?php echo $list[$i]['as_download'];?>
									<?php } ?>
									<?php if($is_visit) { ?>
										<i class="fa fa-share navy"></i>
										<?php echo ($list[$i]['wr_link1_hit'] + $list[$i]['wr_link2_hit']);?>
									<?php } ?>
									<?php if($is_good) { ?>
										<i class="fa fa-heart orangered"></i> 
										<?php echo $list[$i]['wr_good'];?>
									<?php } ?>
									<?php if($is_nogood) { ?>
										<i class="fa fa-meh-o"></i> 
										<?php echo $list[$i]['wr_nogood'];?>
									<?php } ?>
									<?php if($is_hit) { ?>
										<i class="fa fa-eye violet"></i> 
										<?php echo $list[$i]['wr_hit'];?>
									<?php } ?>
								</div>
								<div class="clearfix"></div>
							</div>
-->
						</div>	
						<div class="clearfix"></div>

					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
	<div class="clearfix"></div>
	<?php if (!$is_list) { ?>
		<div class="wr-none">게시물이 없습니다.</div>
	<?php } ?>
</div>
<?php if($is_masonry) { ?>
<script>
	$(function(){
		var $container = $('.list-body');
		$container.imagesLoaded(function(){
			$container.masonry({
				columnWidth : '.list-row',
				itemSelector : '.list-row',
				isAnimated: true
			});
		});
	});
</script>
<?php } ?>
<div class="h20"></div>