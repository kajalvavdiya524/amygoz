<?php $total_user = count($members); ?>
<div>
	<h3>There are <?php echo $total_user; ?> members available for your search of "<?php echo $search_word; ?>"</h3>
 </div>
	
<div>
<?php 	$i = 0;
		$j = 1; 
?>
<?php foreach ($members as $member) { ?>
    <?php if ($j % 4 == '0') { ?>
        <div>
    <?php } ?>
			<div class="user_box">
						<a class="pull-left" href="<?php echo url::base() . $member->username; ?>">
                        <div>
                            <div><?php if ($member->photo->profile_pic_s) { ?>
                                    <img src="<?php echo url::base() . "upload/" . $member->photo->profile_pic_s ?>" class="img-rounded pull-left">
                                <?php } else { ?>
                                    <img src="<?php echo url::base()."img/no_image_s.png";?>" class="img-rounded pull-left">
                                <?php } ?>
                            </div>

                           
                        </div>
						
							<div class="clear">
							<span class="searchname"><?php echo $member->user_detail->first_name . " " . $member->user_detail->last_name; ?> <br></span>
							<?php echo $member->user_detail->location;?>
							</div>
						</a>
            <?php if (($j % 4 == '0') OR ($j == $total_user)) {
                        ?>
            </div>        <div class="clear"></div>
			<?php } ?>
                <?php $j++; ?>
            </div>
        <?php } ?>
    </div>	
