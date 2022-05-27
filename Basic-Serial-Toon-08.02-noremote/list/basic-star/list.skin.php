<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css" media="screen">', 0);

// 헤드스킨
$head_class = '';
if(isset($boset['hskin']) && $boset['hskin']) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/head/'.$boset['hskin'].'.css" media="screen">', 0);
} else {
	$head_class = (isset($boset['hcolor']) && $boset['hcolor']) ? ' border-'.$boset['hcolor'] : ' border-black';
}

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

?>
<?php if($is_thumb || $is_mode == "1") { ?>
	<style>
	<?php if($is_thumb) { ?>
	.list-board .list-body .thumb-icon a { 
		<?php echo (isset($boset['ibg']) && $boset['ibg']) ? 'background:'.apms_color($boset['icolor']).'; color:#fff' : 'color:'.apms_color($boset['icolor']);?>; 
	}
	<?php } ?>
	<?php if($is_mode == "1") { ?>
	.list-board .list-more a:hover { 
		color:<?php echo (isset($boset['moreb']) && $boset['moreb']) ? apms_color($boset['moreb']) : 'orangered';?>; 
	}
	<?php } ?>
	</style>
<?php } ?>
<div class="list-board">
	<div class="list-head div-head<?php echo $head_class;?>">
		<?php if ($is_checkbox) { ?>
			<span class="wr-chk"><input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"></span>
		<?php } ?>
		<?php if($is_num) { ?>
			<span class="wr-num hidden-xs">번호</span>
		<?php } ?>
		<?php if($is_thumb) { ?>
			<span class="wr-thumb">포토</span>
		<?php } ?>
		<span class="wr-subject">제목</span>
		<?php if($is_name) { ?>
			<span class="wr-name hidden-xs">이름</span>
		<?php } ?>
		<?php if($is_date) { ?>
			<span class="wr-date hidden-xs"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜</a></span>
		<?php } ?>
		<?php if($is_hit) { ?>
			<span class="wr-hit hidden-xs"><?php echo subject_sort_link('wr_hit', $qstr2, 1) ?>조회</a></span>
		<?php } ?>
		<?php if($is_down) { ?>
			<span class="wr-down hidden-xs"><?php echo subject_sort_link('as_download', $qstr2, 1) ?>다운</a></span>
		<?php } ?>
		<?php if($is_visit) { ?>
			<span class="wr-visit hidden-xs"><?php echo subject_sort_link('wr_link1_hit', $qstr2, 1) ?>방문</a></span>
		<?php } ?>
		<?php if($is_good) { ?>
			<span class="wr-good hidden-xs"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천</a></span>
		<?php } ?>
		<?php if($is_nogood) { ?>
			<span class="wr-nogood hidden-xs"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추</a></span>
		<?php } ?>
		<?php if($is_star) { ?>
			<span class="wr-star">별점</span>
		<?php } ?>
		<?php if($is_reply) { ?>
			<span class="wr-reply">상태</span>
		<?php } ?>
	</div>
	<ul id="list-body" class="list-body">
	<?php 
		$is_ajax = false;
		include_once($list_skin_path.'/list.rows.php'); 
	?>
	</ul>
	<div class="clearfix"></div>
	<?php if (!$is_list) { ?>
		<div class="wr-none">게시물이 없습니다.</div>
	<?php } ?>
	<?php if($is_mode) { ?>
		<div id="list-nav">
			<a href="<?php echo $list_skin_url;?>/list.rows.php?bo_table=<?php echo $bo_table;?>&amp;lskin=<?php echo $boset['list_skin'];?><?php echo preg_replace("/&amp;page\=([0-9]+)/", "", $qstr);?>&amp;npg=<?php echo ($page > 1) ? ($page - 1) : 0;?>&amp;page=2"></a>
		</div>
		<?php if($is_mode == "1") { ?>
			<div class="list-more">
				<a id="list-more" class="cursor" title="더보기">
					<i class="fa fa-arrow-circle-down"></i>
				</a>
			</div>
		<?php } ?>
		<script type="text/javascript">
			$(function(){
				var $container = $('#list-body');
				$container.infinitescroll({
					navSelector  : '#list-nav',    // selector for the paged navigation
					nextSelector : '#list-nav a',  // selector for the NEXT link (to page 2)
					itemSelector : '.list-item',     // selector for all items you'll retrieve
					loading: {
						msgText: '로딩 중...',
						finishedMsg: '더이상 글이 없습니다.',
						img: '<?php echo APMS_PLUGIN_URL;?>/img/loader.gif',
					}
				}, function( newElements ) { // trigger Masonry as a callback
					var $newElems = $( newElements ).css({ opacity: 0 });
					$newElems.imagesLoaded(function(){
						$container.append($newElems);
					}).animate({ opacity: 1 });
				});
				<?php if($is_mode == "1") { ?>
				$(window).unbind('.infscr');
				$('#list-more').click(function(){
				   $container.infinitescroll('retrieve');
				   $('#list-nav').show();
					return false;
				});
				$(document).ajaxError(function(e,xhr,opt){
					if(xhr.status==404) $('#list-nav').remove();
				});
				<?php } ?>
			});
		</script>
	<?php } ?>
</div>
<?php if ($is_checkbox) { ?>
	<div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-body">
					<div class="form-group">
						<button type="button" class="btn-chkall btn btn-<?php echo $btn2;?> btn-sm btn-block btn-chkall"><i class="fa fa-check"></i> 전체선택</button>
					</div>
					<div class="form-group">
						<button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn-<?php echo $btn1;?> btn-sm btn-block"><i class="fa fa-times"></i> 선택삭제</button>
					</div>
					<div class="form-group">
						<button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn-<?php echo $btn1;?> btn-sm btn-block"><i class="fa fa-clipboard"></i> 선택복사</button>
					</div>
					<button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn-<?php echo $btn1;?> btn-sm btn-block"><i class="fa fa-arrows"></i> 선택이동</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>