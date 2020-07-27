<?php

include('db_connect.php');

$email = $title = $description = '';
$errors = array('email' => '', 'title' => '', 'description' => '');

if(isset($_POST['submit'])){
    


    // check title
    if(empty($_POST['title'])){
        $errors['title'] = 'A title is required';
    } else{
        $title = $_POST['title'];
    }

    // check description
    if(empty($_POST['description'])){
        $errors['description'] = 'At least one description is required';
    }

    if(array_filter($errors)){
        //echo 'errors in form';
    } else {
        // escape sql chars
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $user = $_SESSION['username'];

        // create sql
        $sql = "INSERT INTO forum(title, description ,user) VALUES('$title','$description', '$user')";

        // save to db and check
        if(mysqli_query($conn, $sql)){
            // success
            header('Location: index.php');
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
        
    }

} // end POST check

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add a topic Page</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>
    
<style>
h4{
    font-size:1.5rem;
}
label{
    font-size:1.2rem;
    margin: 0 3rem 0 0; 
}
.btn{
    padding: .5rem 1rem;
    background-color: white;
    width: 5rem;
}
</style>
</head>

<body>

<section class="form">
    <h4 class="centre">Add a topic</h4>
    <form class="white" action="add.php" method="POST">
        <label>Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text">&nbsp;<?php echo $errors['title']; ?></div>

        <label>description</label>
        <input type="text" name="description" value="<?php echo htmlspecialchars($description) ?>">
        <div class="red-text">&nbsp;<?php echo $errors['description']; ?></div>
        <div class="centre">
            <input type="submit" name="submit" value="Submit" class="btn">
        </div>
    </form>
</section>
</body>

</html>