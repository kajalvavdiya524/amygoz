<div class="container">
    <div class="<?php if(!Auth::instance()->logged_in()) { ?>static-pages-not <?php } else { ?> static-pages <?php } ?> row">
    
        <div>
            <fieldset class="fieldset">
                <legend>Amygoz Public Personality Directory</legend>

                <p>Browse members by first name starting with characters: </p>
                <nav>
                    <ul class="pagination noMar">
                        <?php foreach(range('A', 'Z') as $letter) { ?>
                            <li <?php if($letter === $startswith) { ?>class="active"<?php }?>>
                                <a href="<?php echo url::base().'directory/public-personality/'.$letter?>"><?php echo $letter; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>

                <hr />
                <p>Members:</p>
                
                <?php if(empty($users)) { ?>
                    <p class="marLeft20 text-info">No member starting with '<?php echo $startswith; ?>'</p>
                <?php } else { ?>
                    <ul class="list-unstyled directory-list row noMar" style="padding-left:20px;">
                        <?php foreach($users as $user) { ?>
                            <li class="col-md-4">
                                <a href="<?php echo url::base()."public/".$user->username; ?>">
                                    <?php echo $user->user_detail->get_name(); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </fieldset>
        
        </div>
       
    </div>

</div>
