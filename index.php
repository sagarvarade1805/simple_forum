<?php
    include('db_connect.php');

	$sqll = 'SELECT id , title , description, user FROM forum ORDER BY id';

	// get the result set (set of rows)
	$resultt = mysqli_query($conn, $sqll);

	// fetch the resulting rows as an array
	$pizzas = mysqli_fetch_all($resultt, MYSQLI_ASSOC);

	// free the $resultt from memory (good practise)
	mysqli_free_result($resultt);

	// close connection
    mysqli_close($conn);
    if(!isset($_SESSION['success'])){
        header('Location: login.php');
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=M PLUS Rounded 1c' rel='stylesheet'>
    <style>
        .nav{
            height: 5rem;
            background-color: rgb(1, 247, 255);
            width: 100%;
        }
        h3{
            float: left;
            font-size: 1.5rem;
            padding: 1rem
        }
        .logout {
            float: right;
            color: grey;
            font-size: 1.2rem;
            padding: 1rem 2rem;
        }
        .topics{
            font-size: 1.2rem;
            margin: 1.5rem;
            border: 2px solid black;
            border-radius: 1rem;
        }
        .head{
            font-size: 1.5rem;
            padding: .5rem 1.5rem;
        }
        .by{
            padding: .1rem 1.5rem;
        }
        .brand-text{
    float: right;
    margin-top: -1.5rem;
    padding-right: 2rem;
    color: blue;
    text-decoration: none;
    
}
.home{
    margin: 1rem auto;
    width: 85%;
    font-family: 'ABeeZee';
}
.span{
    font-size:1rem;
}
.add a{
    padding: .3rem .7rem;
    background-color: grey;
    color:white;
    text-decoration: none;
    border-radius: .3rem;
    
}
</style>
</head>

<body>
    <nav class="nav">
        
        <?php if(isset($_SESSION['success'])): ?>
            <h3>
                <?php
                    echo $_SESSION['success'];
                    echo $_SESSION['username'];
                    echo ' (' . $_SESSION['type'] . ')';
                ?>
            </h3>
            <a class="logout" href="index.php?logout=1">Logout</a>
        <?php endif ?>
    </nav>
    <div class="add">
        <a href="add.php">Add a forum</a>
    </div>
    <div class="home">
        <?php foreach($pizzas as $pizza): ?>
            <div class="topics">
                <div>
                    <h6 class="head"><?php echo htmlspecialchars($pizza['title']); ?></h6>
                    <div class="by">
                        <?php echo htmlspecialchars($pizza['description']); ?>
                        <br>
                        <span class="span">~by &nbsp;<?php echo htmlspecialchars($pizza['user']); ?></span>
                    </div>

                </div>
                <a class="brand-text" href="detail.php?id=<?php echo $pizza['id'] ?>">more info</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>