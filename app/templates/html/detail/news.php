<?if(isset($array['content']['content'])){?>
	<?=minc::pos("breadcrumbs", $array["name"])?>
	<section style="    margin-top: 20px;" class="sppb-section " style="background-color:#ffffff;">
		<div class="sppb-container">
			<div class="sppb-row">
				<div class="sppb-col-sm-12">
					<div class="sppb-addon-container mdbox">
						<?foreach($array['content']['content'] as $ket => $element){ ?>
							<?=$element['desc']?>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	</section>

<? } ?>