<div class="marTop20">
    <input type="hidden" id="page_name" value="payment" />

    <table class="table table-bordered">

        <tr>
            <th>User</th>
            <th>Payment Date</th>
            <th>Payment Expires</th>
            <th>Plan</th>
            <th>Price</th>
        </tr>
        
        <?php foreach($payments as $payment) { ?>
        <tr>
            <td>
                <a href="<?php echo url::base().$payment->user->username; ?>">
                    <?php echo $payment->user->user_detail->first_name ." ".$payment->user->user_detail->last_name;?>
                </a>
            </td>
            <td><?php echo date('j M, Y', strtotime($payment->payment_date));?></td>
            <td><?php echo date('j M, Y', strtotime($payment->payment_expires));?></td>
            <td><?php echo ucwords($payment->plan);?></td>
            <td><?php echo $payment->price;?></td>
        </tr>
        <?php } ?>
        
    </table>
    
    <div class="page_footer" style="text-align: center;">
        <img style="display:none;" src="<?php echo url::base()."img/ajax-loader.gif"?>" id="loading"/>
    </div>

</div>