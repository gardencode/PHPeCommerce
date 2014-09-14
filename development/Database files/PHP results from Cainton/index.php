<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf-8">
    <link   href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<h3>Students</h3>
		</div>
		<div class="row">
		<p><a class="btn btn-large btn-success" href="formcreate.php">Create</a></p>
		<table class="table table-striped table-bordered table-hover">
			<tbody>
				<tr>
					<th>Product ID</th>
			        <th>Category ID</th>
			        <th>Product Name</th>
			        <th>Description</th>
			        <th>Imge</th>
				</tr>
				<?php include 'result.php'; ?>
			</tbody>
		</table>
		</div>
	</div>
</body>
</html>