<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$is_tag_direct = (isset($boset['cts']) && $boset['cts']) ? ' tag-direct' : '';
?>
<div class="list-tags">
	<form name="staglist" id="staglist" method="post" onsubmit="return staglist_submit(this);" role="form" class="form-horizontal">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
	<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
	<input type="hidden" name="stx" value="<?php echo $stx ?>">
	<input type="hidden" name="spt" value="<?php echo $spt ?>">
	<input type="hidden" name="sca" value="<?php echo $sca ?>">
	<input type="hidden" name="sst" value="<?php echo $sst ?>">
	<input type="hidden" name="sod" value="<?php echo $sod ?>">
	<input type="hidden" name="tag" value="" id="stag_val">

	<div class="table-responsive">
		<table class="table div-table">
		<colgroup>
			<col width="100">
			<col>
		</colgroup>
		<tbody>
		<?php if($boset['intro']) { ?>
			<tr>
				<td class="text-center active">
					<b><?php echo ($boset['intxt']) ? $boset['intxt'] : '안내'; ?></b>
				</td>
				<td>
					<?php echo $boset['intro'];?>
				</td>
			</tr>
		<?php } ?>
		<?php
			$z = 1;
			for($k=1; $k <= $boset['ctn']; $k++) {
				$ctag_name = trim($boset['ct'.$k]);
				$ctag_list = trim($boset['ctc'.$k]);
				
				if(!$ctag_name || !$ctag_list) continue;
		?>
				<tr>
				<td class="text-center active">
					<b><?php echo $ctag_name;?></b>
				</td>
				<td>
					<div class="tags-item" data-toggle="buttons">
					<?php
					$stags = explode(',', $ctag_list);
					$stags_cnt = count($stags);
					for($i=0; $i < $stags_cnt; $i++) {

						$ti = trim($stags[$i]);
						
						if(!$ti) 
							continue;

						if($ti == "|") { // 줄바꿈처리
							echo '<div class="tags-line"></div>'.PHP_EOL;
							continue;
						}

						$stag_active = $stag_checked = '';
						if($sql_stag) {
							if(in_array($ti, $stag)) {
								$stag_active = ' active';
								$stag_checked = ' checked';
							}
						}
					?>
<!--						<label class="btn btn-xs chk-tag<?php echo $stag_active;?><?php echo $is_tag_direct;?>"> -->
						<label class="btn btn-xs btn-lightgreen<?php echo $stag_active;?><?php echo $is_tag_direct;?>">
							<input name="stag[]" type="checkbox" value="<?php echo $ti;?>"<?php echo $stag_checked;?>>
							<span><?php echo $ti;?></span>
						</label>
					<?php } ?>
					</div>
				</td>
				</tr>
			<?php $z++; } ?>
		</tbody>
		<tfoot>
			<tr>
			<td colspan="2">
			<!--
				<div class="row row-15">
					<div class="col-sm-2 col-sm-offset-6 col-xs-2 col-15">
						<select name="sto" id="sto" class="form-control input-sm">
							<option value="">또는</option>
							<option value="1"<?php echo get_selected($sto, "1") ?>>그리고</option>
						</select>	
					</div>
					<div class="col-sm-2 col-xs-2 col-15">
						<button type="submit" class="btn btn-<?php echo $btn2;?> btn-sm btn-block">
							<i class="fa fa-tags"></i> 글목록
						</button>
					</div>
					<div class="col-sm-2 col-xs-2 col-15">
						<a role="button" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=<?php echo $bo_table;?>&amp;sca=<?php echo urlencode($sca);?>" role="button" class="btn btn-<?php echo $btn1;?> btn-sm btn-block">
							<i class="fa fa-power-off"></i> 초기화
						</a>
					</div>
				</div>
				-->
			</td>
			</tr>
		</tfoot>
		</table>
	</div>
	</form>
	<script>
		function staglist_submit(f) {
			var chk_cnt = 0;
			var stag = '';
			for (var i=0; i<f.length; i++) {
				if (f.elements[i].name == "stag[]" && f.elements[i].checked) {
					chk_cnt++;
					if(chk_cnt == "1") {
						stag = f.elements[i].value;
					} else {
						stag = stag + ',' + f.elements[i].value;
					}
				}
			}
			$("#stag_val").val(stag);
			return true;
		}
		<?php if($is_tag_direct) { ?>
		$(function(){
			$('.tag-direct').on('click', function () {
				var clicked_tag = $(this);

				if(clicked_tag.hasClass('active')) {
					clicked_tag.removeClass('active');
					clicked_tag.find('input').attr('checked', false);
				} else {
					clicked_tag.addClass('active');
					clicked_tag.find('input').attr('checked', true);
				}

				var f = document.getElementById("staglist");
				if (staglist_submit(f)) {
					$("#staglist").submit();
				}
			});
		});
		<?php } ?>
	</script>
</div>