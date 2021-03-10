<?php
	include('../db/conn.php');
	session_start();
?>
	<link rel="stylesheet" href="style/main.css">
<?php 
			$i = 0;
			$query1 = "SELECT * FROM `user` order by points desc;";
			if($result1 = mysqli_query($con,$query1)){
				while($row = mysqli_fetch_assoc($result1)){
					$data[$i] = $row;
					if($data[$i]['email']==@$_SESSION['email'])
					    {$_SESSION['rank']=$i+1;}
					$i++;
					
				}
			}	
		?>
		<table border=0 width="100%" style="color: #dadada;  background-color: #0b538eb5;">
    	<?php
    		for($i=0;$i<20;$i++){
    		$name = $data[$i]['name'];
    		$pt = $data[$i]['points'];
    	?>
		<tr>
            <td width="100%" style="font-size:150%;    box-shadow: inset 0px 0px 6px 1px #9E9E9E;">
                <b><?php echo $i+1 ?>&#46;</b>&nbsp;<b style="font-weight:100;"><?php echo $name?></b>&nbsp;<b style="color: #f9d25ce3;">&#40;<?php echo $pt?>&#41;</b>
            </td>
		</tr>
		
	<?php }?>
	</table>