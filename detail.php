<?php 

	include('db_connect.php');
	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM forum WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}

	}


	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM forum WHERE id = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$pizza = mysqli_fetch_assoc($result);
		$sqla = "SELECT * FROM answers WHERE q_id = $id";
		$resuljt = mysqli_query($conn, $sqla);
		$ansform = mysqli_fetch_all($resuljt, MYSQLI_ASSOC);
		mysqli_free_result($resuljt);


	}
	if(isset($_POST['anser'])){
		$answer = $_POST['ans'];
		$userd = $_SESSION['username'];
		$d = mysqli_real_escape_string($conn, $_POST['o_delete']);
		$sql = "INSERT INTO answers(q_id,user,answer) VALUES('$d','$userd','$answer')";
		if(mysqli_query($conn, $sql)){
            // success
            header('Location: index.php');
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
	}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Details</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=M PLUS Rounded 1c' rel='stylesheet'>
<style>
.details{
	padding: 2rem;
	width:75%;
	margin:0 auto;
}
h4{
	font-size:1.5rem;
	padding-left:1rem
}
p{
	font-size:1rem;
	padding: .5rem 1rem
}
.question{
	border: 2px solid black;
    border-radius: 1rem;
}
.answers{
	font-size:1.1rem;
	border: 2px solid black;
    border-radius: 1rem;
	margin: 1rem;
	margin-left: 4rem;
	padding-bottom: 2rem;
}
.answers p{
	
	font-size: 1rem;
	float:right;
}
h6{
	font-size: 1.2rem;
	padding: .3rem 1rem .2rem 1rem
}
#w3review{
	font-size:1.2rem;
	padding:.5rem;
	border-radius: .8rem;
	outline: none;
}
#w3review:focus{
    border: 1px solid black;
}
.answer{
	margin: 1rem;
	margin-left: 4rem;
	margin-top: -3rem;

}

.btn{
    background-color: grey;
	color: white;
	text-align: center;
}
.brand{
	width:40%;
	margin-left: 4rem;
}
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
textarea{
	width:95%;
}
#btnn{
	width:20rem;
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
<div class="details">


		<?php if($pizza): ?>
			<div class="question">
				<h4><?php echo $pizza['title']; ?></h4>
				<p><strong>Description : </strong><?php echo $pizza['description']; ?></p>
				<p class="by">~Posted by <?php echo $pizza['user']; ?></p>
			</div>
			
			<br>

			<!-- DELETE FORM -->


		<?php else: ?>
			<h1>No such question exists.</h1>
		<?php endif ?>
		<?php foreach($ansform as $answt): ?>

        <div class="answers">
            <h6><?php echo htmlspecialchars($answt['answer']); ?></h6>
			<p>~Answered by <?php echo htmlspecialchars($answt['user']); ?></p>
        </div>

<?php endforeach; ?>
	<?php if($pizza): ?>

		<br>
		<form action="detail.php" method="POST" class="answer">
			<input type="hidden" name="o_delete" value="<?php echo $pizza['id']; ?>">
			<label for="w3review">Write your answer here</label>
			<textarea id="w3review" name="ans" rows="2" cols="118"></textarea>
			<br>
			<button class="btn" name="anser" type="submit" >post</button>
		</form>
		<?php if($_SESSION['type'] == 'admin'){ ?>
			<form action="detail.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
				<input type="submit" id="btnn" name="delete" value="Delete this question completely from databse" class="brand">
			</form>
		<?php } ?>
	<?php endif ?>
<!-- //Answers to question -->

</div>

    </body>
</html>