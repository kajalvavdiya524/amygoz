<?php
//header('Content-Type: application/json');
	
	//$response=array();

	$conn = mysqli_connect('localhost', 'ipintooc', 'Harvard41##', 'ipintooc_main');
	if($conn)
	{
		//echo "connected successfull";
		$SQL = "select user_details.*,users.email from user_details inner join users on users.user_detail_id =user_details.id ";
		$q = mysqli_query($conn,$SQL);
		while($row = $q->fetch_assoc())
		{
			$res[] = $row;
		}?>
		<table>
			<th>Name:</th>
			<th>email</th>
			<th>Contact number: <?php echo count($res)?></th>
			
		<?php	foreach($res as $a)
		{
			$name =  $a['first_name']." ".$a['last_name'];
			$contact_number = $a['phone']; 
			$email = $a['email'];?>
			<tr>
					<td>
						<?php echo $name;?>
					</td>

					<td>
						<?php echo $email;?>
					</td>
					
					<td>
						<?php echo $contact_number;?>
					</td>
			</tr>		
<?php } ?>

				
			</table>

		



	<?php } ?>
