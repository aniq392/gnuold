<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css" media="screen">', 0);

// 표지번호
$sid = ($view['wr_1']) ? $view['wr_1'] : $wr_id;

// 글쓰기 링크
if ($write_href) {
	$write_href .= '&amp;sid='.$sid;
}

// 이전글, 다음글 링크
unset($prev);
unset($next);

// 윗글을 얻음
$sql = " select wr_id, wr_subject from {$write_table} where wr_is_comment = 0 and wr_num = '{$write['wr_num']}' and wr_reply < '{$write['wr_reply']}' and wr_1 = '{$sid}' and wr_1 <> '' order by wr_num desc, wr_reply desc limit 1 ";
$next = sql_fetch($sql);
// 위의 쿼리문으로 값을 얻지 못했다면
if (!$next['wr_id'])     {
	$sql = " select wr_id, wr_subject from {$write_table} where wr_is_comment = 0 and wr_num < '{$write['wr_num']}' and wr_1 = '{$sid}' and wr_1 <> '' order by wr_num desc, wr_reply desc limit 1 ";
	$next = sql_fetch($sql);
}

// 아래글을 얻음
$sql = " select wr_id, wr_subject from {$write_table} where wr_is_comment = 0 and wr_num = '{$write['wr_num']}' and wr_reply > '{$write['wr_reply']}' and wr_1 = '{$sid}' and wr_1 <> '' order by wr_num, wr_reply limit 1 ";
$prev = sql_fetch($sql);
// 위의 쿼리문으로 값을 얻지 못했다면
if (!$prev['wr_id']) {
	$sql = " select wr_id, wr_subject from {$write_table} where wr_is_comment = 0 and wr_num > '{$write['wr_num']}' and wr_1 = '{$sid}' and wr_1 <> '' order by wr_num, wr_reply limit 1 ";
    $prev = sql_fetch($sql);
}

// 이전글 링크
$prev_href = '';
if ($prev['wr_id']) {
    $prev_wr_subject = get_text(cut_str($prev['wr_subject'], 255));
    $prev_href = './board.php?bo_table='.$bo_table.'&amp;wr_id='.$prev['wr_id'].$qstr;
}

// 다음글 링크
$next_href = '';
if ($next['wr_id']) {
    $next_wr_subject = get_text(cut_str($next['wr_subject'], 255));
    $next_href = './board.php?bo_table='.$bo_table.'&amp;wr_id='.$next['wr_id'].$qstr;
}

// 값정리
$boset['video'] = (isset($boset['video']) && $boset['video']) ? $boset['video'] : '';
$boset['serial_skin'] = (isset($boset['serial_skin']) && $boset['serial_skin']) ? $boset['serial_skin'] : 'basic';
$serial_skin_url = $board_skin_url.'/serial/'.$boset['serial_skin'];
$serial_skin_path = $board_skin_path.'/serial/'.$boset['serial_skin'];

// 모달 타켓
$modal_target = (APMS_PIM) ? ' target="_parent"' : '';
$modal_query = (APMS_PIM) ? '&amp;pim=1' : '';

// 아이콘
$view['photo'] = ($view['photo']) ? '<img src="'.$view['photo'].'" alt="'.$view['wr_name'].'">' : '';
if($view['as_icon']) {
	$view_icon = apms_fa(apms_emo($view['as_icon']));
	$view['photo'] = ($view_icon) ? $view_icon : $view['photo'];
}
?>
<?php if($boset['video'] || $view['photo']) { ?>
<style>
<?php if($view['photo']) { ?>
	.view-wrap h1 .talker-photo i { <?php echo (isset($boset['ibg']) && $boset['ibg']) ? 'background:'.apms_color($boset['icolor']).'; color:#fff' : 'color:'.apms_color($boset['icolor']);?>; }
<?php } ?>
<?php if($boset['video']) { ?>
	.view-wrap .apms-autowrap { max-width:<?php echo (G5_IS_MOBILE) ? '100%' : $boset['video'];?> !important; }
<?php } ?>
</style>
<?php } ?>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<div class="view-wrap<?php echo (G5_IS_MOBILE) ? ' view-mobile font-14' : '';?><?php echo (APMS_PIM) ? ' view-modal' : '';?>">

	<?php 
		// 내용스킨
		if(is_file($serial_skin_path.'/view.skin.php')) {
			if($view['wr_1']){
				include_once($serial_skin_path.'/view.skin.php');
				}
				else {     
				include_once($serial_skin_path.'/title.view.skin.php');
				}
		} else {
			echo '<div class="well text-center"><i class="fa fa-bell red"></i> 설정하신 연재스킨('.$boset['serial_skin'].')이 존재하지 않습니다.</div>';
		}

	?>

	<div class="clearfix"></div>
<style>
/* 오늘 본 상품 */
.remote { position: absolute; top: -100px; left: 15px; }
#stv {z-index:1001;position:absolute;right:300px; top:280px;width:88px}
#stv_list {position:absolute;width:88px;border:1px solid #eee;background:#fff; }
#stv_list h2 {font-size:14px; margin:0px; padding:7px 0; background:#1dc800; color:#fff; text-align:center;letter-spacing:-0.1em}
#stv_pg {display:block;margin:5px 0 0}
#stv_list p {padding:20px 0;text-align:center}
#stv_btn {font-size:16px; padding-top:8px; text-align:center;zoom:1}
#stv_btn:after {display:block;visibility:hidden;clear:both;content:""}
#stv_btn i {cursor:pointer; color:#aaa; }
#stv_btn button {float:left;margin:0;padding:5px 0 4px;width:44px;border:0;background:#555;color:#fff;text-align:center}
#stv_ul {margin:5px 0 10px;padding:0;list-style:none}
.stv_item {display:none;padding:0 9px;text-align:center;word-break:break-all}
.stv_item img {margin:5px 0}

#stv_nb {margin:0;padding:0;border-top:1px solid #eee;background:#fafafa;list-style:none}
#stv_nb li {text-align:center; border-bottom:1px solid #eee;}
#stv_nb li:last-child { border-bottom:0px; }
#stv_nb a {display:block; padding:3px 0px; letter-spacing:-1px; }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script> 
<script>
function remote1_onoff() {
        if (GetCookie('toggledata')=="1") {
           $(".remotog1-on").toggle();
           $(".remotog1-off").toggle();
           $(".remote").toggle();
           document.cookie = "toggledata=0;";
        } else {
           $(".remotog1-on").toggle();
           $(".remotog1-off").toggle();
           $(".remote").toggle();
           document.cookie = "toggledata=1;";
        }       
}

function GetCookie(name) {
  var value=null, search=name+"=";
  if (document.cookie.length > 0) {
    var offset = document.cookie.indexOf(search);
    if (offset != -1) {
      offset += search.length;
      var end = document.cookie.indexOf(";", offset);
      if (end == -1) end = document.cookie.length;
      value = unescape(document.cookie.substring(offset, end));
    }
  }
  return value;
}
</script>
<?php if($view['wr_1']){ ?>
<div class="remote hidden-xs" style="cursor:move;">
	<div class="container">
		<!-- 오늘 본 상품 시작 { -->
		<aside id="stv">
			<div id="stv_list">
				<h2>
					리모컨
					<span id="stv_pg"></span>
				</h2>
				<ul id="stv_nb">
				<?php if ($prev_href) { ?>
					<li><a href="<?php echo $prev_href.$modal_query; ?>" <?php echo tooltip('이전화', 'left');?>> <i class="fa fa-arrow-left" aria-hidden="true"></i> </a></li>
					<?php } else { ?>
					<li><a href="#" <?php echo tooltip('이전화가 없습니다', 'left');?> style="cursor: not-allowed;"> <i class="fa fa-arrow-left" aria-hidden="true"></i> </a></li>
				<?php }?>
				<?php if ($next_href) { ?>
					<li><a href="<?php echo $next_href.$modal_query; ?>" <?php echo tooltip('다음화', 'left');?>> <i class="fa fa-arrow-right" aria-hidden="true"></i> </a></li>
					<?php } else { ?>
					<li><a href="#" <?php echo tooltip('다음화가 없습니다', 'left');?> style="cursor: not-allowed;"> <i class="fa fa-arrow-right" aria-hidden="true"></i> </a></li>
				<?php }?>
					<li><a href="<?php echo $list_href ?>" <?php echo tooltip('웹툰목록', 'left');?>><i class="fa fa-list" aria-hidden="true"></i></a></li>
				</ul>

			</div>
		</aside>

		<script src="<?php echo G5_JS_URL ?>/scroll_oldie.js"></script>
		<!-- } 오늘 본 상품 끝 -->
	</div>
</div>
<?php  } ?>
<script>
if (GetCookie('toggledata')=="1") {
$(".remote").toggle(); 
$(".remotog1-on").toggle(); 
} else {
$(".remotog1-off").toggle(); 
}
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".remote").draggable();
    });
</script>
	<div class="view-btn text-right">
		<div class="btn-group" role="group">
			<?php if ($prev_href) { ?>
				<a role="button" href="<?php echo $prev_href.$modal_query; ?>" class="btn btn-<?php echo $btn1;?> btn-sm" title="이전글">
					<i class="fa fa-chevron-circle-left"></i><span class="hidden-xs"> 이전</span>
				</a>
			<?php } ?>
			<?php if ($next_href) { ?>
				<a role="button" href="<?php echo $next_href.$modal_query; ?>" class="btn btn-<?php echo $btn1;?> btn-sm" title="다음글">
					<i class="fa fa-chevron-circle-right"></i><span class="hidden-xs"> 다음</span>
				</a>
			<?php } ?>
			<?php if ($copy_href) { ?>
				<a role="button" href="<?php echo $copy_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm" onclick="board_move(this.href); return false;" title="복사">
					<i class="fa fa-clipboard"></i><span class="hidden-xs"> 복사</span>
				</a>
			<?php } ?>
			<?php if ($move_href) { ?>
				<a role="button" href="<?php echo $move_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm" onclick="board_move(this.href); return false;" title="이동">
					<i class="fa fa-share"></i><span class="hidden-xs"> 이동</span>
				</a>
			<?php } ?>
			<?php if ($delete_href) { ?>
				<a role="button" href="<?php echo $delete_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm" title="삭제" onclick="<?php echo (APMS_PIM) ? 'modal_' : '';?>del(this.href); return false;">
					<i class="fa fa-times"></i><span class="hidden-xs"> 삭제</span>
				</a>
			<?php } ?>
			<?php if ($update_href) { ?>
				<a role="button" href="<?php echo $update_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm" title="수정"<?php echo $modal_target;?>>
					<i class="fa fa-plus"></i><span class="hidden-xs"> 수정</span>
				</a>
			<?php } ?>
			<?php if (!APMS_PIM) { // 모달에서는 출력안함 ?>
				<?php if ($search_href) { ?>
					<a role="button" href="<?php echo $search_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm">
						<i class="fa fa-search"></i><span class="hidden-xs"> 검색</span>
					</a>
				<?php } ?>
				<a role="button" href="<?php echo $list_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm">
					<i class="fa fa-bars"></i><span class="hidden-xs"> 목록</span>
				</a>
			<?php } ?>
			<?php if ($write_href) { ?>
				<a role="button" href="<?php echo $write_href ?>" class="btn btn-<?php echo $btn2;?> btn-sm"<?php echo $modal_target;?>>
					<i class="fa fa-pencil"></i><span class="hidden-xs"> 글쓰기</span>
				</a>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<script>
<?php if(APMS_PIM) { ?>
function modal_del(href) {
	if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
		var iev = -1;
		if (navigator.appName == 'Microsoft Internet Explorer') {
			var ua = navigator.userAgent;
			var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
			if (re.exec(ua) != null)
				iev = parseFloat(RegExp.$1);
		}

		// IE6 이하에서 한글깨짐 방지
		if (iev != -1 && iev < 7) {
			parent.document.location.href = encodeURI(href);
		} else {
			parent.document.location.href = href;
		}
	}
}
<?php } ?>
function board_move(href){
	window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
$(function() {
	$(".view-content a").each(function () {
		$(this).attr("target", "_blank");
    }); 

	$("a.view_image").click(function() {
		window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
		return false;
	});
	<?php if ($board['bo_download_point'] < 0) { ?>
	$("a.view_file_download").click(function() {
		if(!g5_is_member) {
			alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
			return false;
		}

		var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

		if(confirm(msg)) {
			var href = $(this).attr("href")+"&js=on";
			$(this).attr("href", href);

			return true;
		} else {
			return false;
		}
	});
	<?php } ?>
});
</script>

<?php
//글목록용
if(($stx && $boset['sstx']) || $is_serial_admin) {
	;
} else {
	$wr_id = $sid;
}
?>