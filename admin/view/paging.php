 <div class="row">
 <div class="col-xs-6">
 <div class="dataTables_info" id="example1_info">Page <?php print($cur);?> of <?php print($max_pages);?>
( <?php print($num);?> records )
</div>
</div>
<div class="col-log-6">
<div class="dataTables_paginate paging_bootstrap">
<ul class="pagination pull-right" style="margin-right:30px;">
<?php
if(($start-$per_page) >= 0)
{
    $next = $start-$per_page;
?>
<li class="prev">
<a href="<?php print("$thispage".($next>=0?("&start=").$next:""));?>&search=search&val=<?php echo $val; ?>&startdate=<?php echo $startdate;?>&enddate=<?php echo $enddate;?>&advsearch=<?php echo $option;?>">← Previous</a>
</li> 
<?php
}
?>

<?php 
$eitherside = ($showeachside * $per_page);
if($start+1 > $eitherside)print (" .... ");
$pg=1;
for($y=0;$y<$num;$y+=$per_page)
{
    $class=($y==$start)?"pageselected":"";
    if(($y > ($start - $eitherside)) && ($y < ($start + $eitherside)))
    {
?>
<li><a class="<?php print($class);?>" href="<?php print("$thispage".($y>=0?("&start=").$y:""));?>&search=search&val=<?php echo $val; ?>&startdate=<?php echo $startdate;?>&enddate=<?php echo $enddate;?>&advsearch=<?php echo $option;?>"><?php print($pg);?></a> </li>
<?php
    }
    $pg++;
}
?>

<?php
    for($x=$start;$x<min($num,($start+$per_page)+1);$x++)print($items[$x]);
?>
<?php 
if($start+$per_page<$num)
{
?>
<li class="next"><a href="<?php print("$thispage&start=".max(0,$start+$per_page));?>&&search=search&val=<?php echo $val; ?>&startdate=<?php echo $startdate;?>&enddate=<?php echo $enddate;?>&advsearch=<?php echo $option;?>">Next → </a> </li>
<?php
}
?>
</ul>
</div>
</div>
</div>