<h5><?=$data['mess']?></h5>
<? if(isset($data['error'])){?>
<div class="errors">
	<p>
	<?=$data['error']?>
	</p>
</div>
<? } else { ?>
<?
$fullname = $data['user'][0]['last_name'] ." ". $data['user'][0]['first_name'] ." ". $data['user'][0]['middle_name'];
?>

<? } ?>
