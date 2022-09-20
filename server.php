<?php 
	session_start();
    //connect to the database
    include ('connection.php');
	// initialize variables
	$username = "";
	$email = "";
    $fullname = "";
    $results = "";
$counter = 1;

	$id = 0;
    $errors = array();
	$update = false;
/* =================== save ================*/
	if (isset($_POST['save'])) {
		$username = $_POST['username'];
		$email = $_POST['email'];
        $fullname = $_POST['fullname'];

		mysqli_query($db, "INSERT INTO users (username, email, fullname) VALUES ('$username', '$email', '$fullname')"); 
		$_SESSION['message'] = "Successfuly Added"; 
		header('location: index.php');
        
        if(empty($username)){
            echo("Username is required");
        }
	}
/* =================== /save ================*/

/* =================== edit ================*/
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM  users WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$username = $n['username'];
			$email = $n['email'];
            $fullname = $n['fullname'];
		}
	}
/* =================== /edit ================*/
/* =================== update ================*/

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];

        mysqli_query($db, "UPDATE users SET username='$username', email='$email', fullname='$fullname' WHERE id=$id");
        $_SESSION['message'] = "Successfuly updated!"; 
        header('location: index.php');
    } 
/* =================== /update ================*/

/* =================== delete ================*/

    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM users WHERE id=$id");
        $_SESSION['message'] = "Successfuly deleted!"; 
        header('location: index.php');
    }
/* =================== /delete ================*/

/* =================== search ================*/

    if (isset($_POST['search'])) { 
        $valueToSearch = $_POST['valueToSearch'];
      if (count($errors) == 0) {
        $query = "SELECT * FROM `users` WHERE CONCAT(`username`, `email`,`fullname`) LIKE '%".$valueToSearch."%'";
        $search_result = mysqli_query($db, $query);
        if(empty($valueToSearch)){
            $_SESSION['message'] = "No value to Search";
        }
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 0) {
            $_SESSION['message'] = "No data Found!"; 
        }else{
//            $_SESSION['message'] = "Results"; 
        }
      }
    }else{
        $query = "SELECT * FROM `users`";
        $search_result = mysqli_query($db, $query);
        
    }

/* =================== /search ================*/
?>

