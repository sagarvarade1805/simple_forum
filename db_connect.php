<?php 
    session_start();
	// connect to the database
	$conn = mysqli_connect('localhost', 'id14468675_sagarv', 'JF#_3>ei[C(*6&GF', 'id14468675_sagar');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$username = $email = $passward1 = $passward2 = $full_name= $gender= $user_type= '';
	$errors = array('user_type'=>'','gender'=>'','full_name'=> '','topic' =>'','description' =>'','username' =>'', 'email' => '', 'passward1' => '', 'passward2' => '', 'pass' => '');
    if(isset($_POST['register'])){
		$username = $_POST['username'];
		$passward1 = $_POST['passward1'];
		$passward2 = $_POST['passward2'];
		$full_name = $_POST['full_name'];
        
        if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
        }
        if(empty($_POST['username'])){
			$errors['username'] = 'An username is required';
        }
        if(empty($_POST['passward1'])){
			$errors['passward1'] = 'An passward is required';
        }
        if($passward2 != $passward1){
            $errors['passward2'] = 'Passward didnt matched pleamse try again';
		}
		if (empty($_POST['gender'])) {
			$errors['gender'] = 'Gender is required';
		  } else {
			$gender = test_input($_POST['gender']);
		}
		if (empty($_POST['user_type'])) {
			$errors['user_type'] = 'user_type is required';
		  } else {
			$user_type = test_input($_POST['user_type']);
		}
		
		

        if(array_filter($errors)){
            //echo 'errors in form';
		} else {


            // create sql
            $pass = md5($passward1);
			$sql = "INSERT INTO user(username,email,passward,namme, gender, type) VALUES('$username','$email','$pass','$full_name','$gender', '$user_type')";

			// save to db and check
			mysqli_query($conn, $sql);
            $_SESSION['username'] = $username;
			$_SESSION['success'] = 'Welcome to forum ';
			$_SESSION['type'] = $user_type;
			header('Location: login.php');

			
		}

	}
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$passward = $_POST['passward'];
		if(empty($_POST['username'])){
			$errors['username'] = 'An username is required';
        }
        if(empty($_POST['passward'])){
			$errors['passward'] = 'An passward is required';
		}
		if (empty($_POST['user_type'])) {
			$errors['user_type'] = 'user type is required';
		  } else {
			$user_type = test_input($_POST['user_type']);
		}
		if(array_filter($errors)){
            //echo 'errors in form';
		} else {


            // create sql
            $pass = md5($passward);
			$sql = "SELECT * FROM user WHERE username = '$username' AND  passward = '$pass' AND type = '$user_type'";

			// get the query result
			$result = mysqli_query($conn, $sql);
	
			// fetch result in array format
			$lodu = mysqli_fetch_assoc($result);
			if(mysqli_num_rows($result) == 1){
				$_SESSION['username'] = $username;
				$_SESSION['success'] = 'Welcome to forum  ';
				$_SESSION['type'] = $user_type;
				header('Location: index.php');
			}
			else{
				$errors['pass'] = 'Wrong username/passward/user type!';

			}
			
		}

	}
	if(isset($_GET['logout'])){
		unset($_SESSION['username']);
		unset($_SESSION['success']);
		session_destroy();
		
		header('Location: login.php');

	}
	


?>