
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP CRUD</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php require_once 'process.php'; ?>


<!--sessions part and confirmation-->
<?php
if (isset($_SESSION['message'])): ?>

<div class="alert alert-<?=$_SESSION['msg_type']?>">

<?php
echo $_SESSION['message'];
unset($_SESSION['message']);
?>

</div>
<?php endif ?>

<div class="container">
<!--connecting to database whenever the save button is pressed to see existing records-->
<?php
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
?>



<div class="row justify-content-center">
<table class="table">
<th>
<tr>
<th>Name</th>
<th>Location</th>
<th colspan="2">Action</th>
</tr>
</th>


<!--looping through fetch_assoc in order to fetch the database records from the table-->
<?php
while ($row = $result->fetch_assoc()): ?>
<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['location']; ?></td>

<td>
<a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>

<a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
</td>

</tr>
<?php endwhile; ?>
</table>
</div>

<!--special function to work or display arrays-->
<?php 
function pre_r($array) {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
?>


<div class="row justify-content-center">
<form action="process.php" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="form-group">
<label>Name</label>
<input type="text" name="name" class="form-control" value="<?php echo $name; ?>"
placeholder="Enter your name">
</div>

<div class="form-group">
<label>Location</label>
<input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Enter your location">
</div>
<div class="form-group">

<?php  
if ($update == true):
?>
<button type="submit" class="btn btn-primary"name="update">Update</button>
<?php else: ?>

<button type="submit" class="btn btn-primary"name="save">save</button>
<?php endif; ?>
</div>
</form>
</div>
</div>
</body>
</html>           