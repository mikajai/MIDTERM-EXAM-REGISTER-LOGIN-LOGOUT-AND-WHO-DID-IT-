<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Shutter Charm Photography Services </title>
	<style>
        body {
            font-family: Times New Roman;
            background-color: #ADBC9F;
            margin: 20px;
            
        }

        .header {
            background-color: #436850;
            padding: 12px;
            border-radius: 10px; 
            display: flex;
            align-items: center; /* Centers content vertically */
            padding-left: -10px;  /* Optional: Adds space to the left */
        }

        .header img {
            width: 150px;
            height: 150px;
            display: inline-block;
            vertical-align: middle; 
            margin-top: -20px;
            margin-bottom: -20px;
            margin-left: 20px

        }

        .header h1 {
            color: #ADBC9F;
            margin: 0;
            text-align: left; /* Aligns text to the left */
            margin-left: 45px
        }

        h1{
            color: #12372A;
        }

        p{
            color: #12372A;
            font-size: 18px;
        }

        a{
            font-size: 15px;
            color: #12372A;
            font-weight: bold;
            text-decoration: none;
        }

        .fields p {
            color: #12372A;
            font-weight: bold;
            font-size: 20px;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
        }

        .fields input[type="text"],
        .fields input[type="password"] {
            width: 30%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            border-color: #12372A;
        }

    </style>
</head>
<body>
    <div class="header" style="color: #FBFADA; text-align: right; font-size: 20px;">
        <h1> Welcome to Shutter Charm Photography Services [ ◉¯] ˙✧˖° </h1>
        <img src="shutter charm.png"> 
    </div>
	
    <h1> ✧ Login here ✧ </h1>

    <?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: #436850;"><?php echo $_SESSION['message']; ?></h1>
	<?php } unset($_SESSION['message']); ?>
    
	<form action="core/handleForms.php" method="POST">

		<div class="fields">
			<p>
                <label for="username">Username: </label>
                <input type="text" placeholder="username here" class="fields" name="username">
            </p>
			<p>
                <label for="username">Password: </label>
                <input type="password" placeholder="password here" class="fields" name="user_password">
                <input type="submit" value="Login" id="loginBtn" name="loginBtn">
            </p>
		</div>

	</form>
    <a href="register.php">Click here to Register first</a></p>

</body>
</html>