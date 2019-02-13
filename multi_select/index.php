<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
<form action="index.php" method="post">
	<table border="1" width="50%">
		<thead>
		<tr>
			<th><input type="checkbox" id="select_all"></th>
			<th>id</th>
			<th>name</th>
		</tr>
		</thead>
		<?php 
			$database = mysqli_connect('localhost','root','','multi_select');
			$query = "SELECT * FROM data";
			$run = mysqli_query($database, $query);
			while($fetch = mysqli_fetch_array($run)){
		?>
			<tr>
				<td><input type="checkbox" name="status[]" value="<?= $fetch['id']; ?>"></td>
				<td><?= $fetch['id']  ?></td>
				<td><?= $fetch['name']  ?></td>
			</tr>
		<?php		
			}
		 ?>
		 <tr>
		 	<th colspan="3"><button name="btn">DELETE</button></th>
		 </tr>
	</table>
</form>

<?php 
	if(isset($_POST['btn'])){
		$allid = $_POST['status'];
		for($a = 0; $a < sizeof($allid); $a++){
			$singleid =  $allid[$a];
			$delete = "DELETE FROM data WHERE id = $singleid";
			mysqli_query($database, $delete);
		}
			header('location:index.php');
	}
 ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script>
	$('#select_all').change(function() {
	    var checkboxes = $(this).closest('form').find(':checkbox');
	    checkboxes.prop('checked', $(this).is(':checked'));
	});
 </script>
</body>
</html>