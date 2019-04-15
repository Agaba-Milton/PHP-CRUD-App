 
<?php

session_start();

//here we are connecting to the database of our app with the localhost, username, plus the database name 'crud'//
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$location = '';

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];
    $mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')") or die($mysqli->error);

//A session message and type when the save button is saved 
$_SESSION['message'] = "Record has been saved!";   
$_SESSION['msg_type'] = "success";   

//redirecting the user back to the index page
header("location: index.php");
}


//if the the delete button is pressed in order to delete the pointed out record from the database table//
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

//A session message and type when the delete button is pressed 
$_SESSION['message'] = "Record has been deleted!";   
$_SESSION['msg_type'] = "danger";     

//redirecting the user back to the index page
header("location: index.php");
}


//if the edit button is clicked, so that the record to be edited is select from the database table if any//
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
//update
    $update = true;    
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if (count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
        
    }
}

//Update 
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error);


$_SESSION['message'] = "Record has been updated!";   
$_SESSION['msg_type'] = "warning"; 



}
?>


