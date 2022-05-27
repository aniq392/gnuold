<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<div class="well well-sm text-center" style="margin-bottom:15px;">
	<div class="list-top pull-right">
		<div class="btn-group">
			<?php if ($rss_href) { ?>
				<a href="<?php echo $rss_href; ?>" class="btn btn-<?php echo $btn2;?> btn-sm" title="RSS"><i class="fa fa-rss"></i></a>
			<?php } ?>
			<a href="#" class="btn btn-<?php echo $btn1;?> btn-sm" data-toggle="modal" data-target="#searchModal" onclick="return false;"><i class="fa fa-search" title="검색" ></i></a>
			<?php if ($is_checkbox || $setup_href || $admin_href) { ?>
				<?php if ($is_checkbox) { ?>
					<button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn-black btn-sm" title="선택삭제"><i class="fa fa-times"></i></button>
					<button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn btn-black btn-sm" title="선택복사"><i class="fa fa-clipboard"></i></button>
					<button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn btn-black btn-sm" title="선택이동"><i class="fa fa-arrows"></i></button>
				<?php } ?>
				<?php if ($admin_href) { ?>
					<a href="<?php echo $admin_href; ?>" class="btn btn-black btn-sm" title="게시판설정"><i class="fa fa-cog"></i></a>
				<?php } ?>
				<?php if ($setup_href) { ?>
					<a href="<?php echo $setup_href; ?>" class="btn btn-color btn-sm win_memo" title="추가설정"><i class="fa fa-cogs"></i></a>
				<?php } ?>
			<?php } ?>
			<?php if ($list_href) { ?>
				<a href="<?php echo $list_href ?>" class="btn btn-<?php echo $btn1;?> btn-sm" title="글목록"><i class="fa fa-bars"></i></a>
			<?php } ?>
			<?php if ($write_href) { ?>
				<a href="<?php echo $write_href ?>" class="btn btn-<?php echo $btn2;?> btn-sm" title="글쓰기"><i class="fa fa-pencil"></i></a>
			<?php } ?>
		</div>
	</div>
	<div class="list-top pull-left">
		<ul class="pagination pagination-sm en no-margin">
			<?php if($prev_part_href) { ?>
				<li><a href="<?php echo $prev_part_href;?>">이전검색</a></li>
			<?php } ?>
			<?php echo apms_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&amp;page=');?>
			<?php if($next_part_href) { ?>
				<li><a href="<?php echo $next_part_href;?>">다음검색</a></li>
			<?php } ?>
		</ul>
	</div>
	<div class="clearfix"></div>
</div>
