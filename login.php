<?php
    include('db_connect.php');
    /*
        <?php if(): ?>
        <?php endif ?>
    */
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>
<style>
.sp{
    width:15%;
    padding:0 0;
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
.input{
    margin: 1rem auto;
}
.sp{
    margin: .3rem -.5rem;
}
</style>
</head>

<body>
    <div class="form">
        <h1>Login</h1>
        <form method="POST" action="login.php">
            <div class="input">
                <label for="username">Username</label>
                <input type="text" placeholder="Username:" name="username" value="<?php echo htmlspecialchars($username) ?>" required>
            </div>
            <div class="input">
                <label for="passward">Passward</label>
                <input type="password" placeholder="Password:" id="myInput" name="passward" required>
                <input class="sp" type="checkbox" onclick="myFunction()">Show Password
            </div>
            <div class="radio">
                <input id="spec" type="radio"  name="user_type" value="admin">
                <label id="spec1" for="admin">admin</label>
                <input id="spec" type="radio"  name="user_type" value="normal">
                <label id="spec1" for="normal">normal</label>
                <div class="red-text">&nbsp;<?php echo $errors['user_type'] ; ?></div>
            </div>
            <div class="red-text">&nbsp;<?php echo $errors['pass']; ?></div>
            <div class="centre">
                <button class="btn" name="login" type="submit" >Login</button>
            </div>

        </form>
        <p class="bottomline">Not registered?? <a href="register.php">Register here</a></p>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>