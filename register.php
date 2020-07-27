<?php 

    include('db_connect.php');


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register Page</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=M PLUS Rounded 1c' rel='stylesheet'>
<style>
.registrat{
    width: 30%;
    margin: 2rem auto;
    border: 2px solid black;
    border-radius: 2rem;
    box-shadow: 1rem 1rem 1rem white;
    background-color: grey;
    color: white;
    padding: 1rem;
}
.home{
    margin: 1rem auto;
    width: 85%;
    font-family: 'ABeeZee';
}
.input{
    width: 100%;
    padding: 0 0;
}
label{
    padding: 0rem 1rem;
    font-size: 1.3rem;
}

#spec{
    width: 5%;
    padding: 0 0;
    margin: 0 0;
    color: black;
    outline: none;
}
#spec1{
    padding: 0 0;
    margin-right: 2rem;
}

</style>
</head>

<body>
    <div class="form">
        <h1>Register</h1>
        <form method="post" action="register.php">
        <div class="input">
                <label for="full_name">Full Name</label>
                <input type="text" placeholder="Full Name:" name="full_name" value="<?php echo htmlspecialchars($full_name) ?>" required>
                <div class="red-text">&nbsp;<?php echo $errors['full_name']; ?></div>
            </div>
            <div class="input">
                <label for="username">Username</label>
                <input type="text" placeholder="Username:" name="username" value="<?php echo htmlspecialchars($username) ?>" required>
                <div class="red-text">&nbsp;<?php echo $errors['username']; ?></div>
            </div>
            <div class="input">
                <label for="email">Email</label>
                <input type="email" placeholder="email:" name="email" value="<?php echo htmlspecialchars($email) ?>" required>
                <div class="red-text">&nbsp;<?php echo $errors['email']; ?></div>
            </div>
            <div class="input">
                <label for="passward1">Passward</label>
                <input type="password" placeholder="Password:" name="passward1" minlength="8" value="<?php echo htmlspecialchars($passward1) ?>" required>
                <div class="red-text">&nbsp;<?php echo $errors['passward1']; ?></div>
            </div>
            <div class="input">
                <label for="passward2">Passward confirm</label>
                <input type="password" placeholder="Password confirem:"  name="passward2" value="<?php echo htmlspecialchars($passward2) ?>" required>
                <div class="red-text">&nbsp;<?php echo $errors['passward2']; ?></div>
            </div>
            <div class="input">
                <label for="dob">Date of birth</label>
                <input type="date" name="dob">
            </div>
            <div class="radio">
                <input id="spec" type="radio"  name="gender" value="male">
                <label id="spec1" for="male">Male</label>
                <input id="spec" type="radio"  name="gender" value="female">
                <label id="spec1" for="female">Female</label>
                <input id="spec" type="radio"  name="gender" value="other">
                <label id="spec1" for="other">Other</label>
                <div class="red-text">&nbsp;<?php echo $errors['gender'] ; ?></div>
            </div>
            <div class="radio">
                <input id="spec" type="radio"  name="user_type" value="admin">
                <label id="spec1" for="admin">admin</label>
                <input id="spec" type="radio"  name="user_type" value="normal">
                <label id="spec1" for="normal">normal</label>
                <div class="red-text">&nbsp;<?php echo $errors['user_type'] ; ?></div>
            </div>

            <div class="centre">
                <button class="btn" name="register" type="submit" >Register</button>
            </div>
        </form>
        <p class="bottomline">Already registered?? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>