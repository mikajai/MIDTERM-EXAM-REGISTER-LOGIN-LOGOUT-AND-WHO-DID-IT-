<?php 

require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration Form</title>

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
            align-items: center;
            padding-left: -10px; 
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
            text-align: left;
            margin-left: 45px
        }


        h1, p {
            margin-bottom: 20px;
            color: #12372A;
        }

        label {
            font-weight: bold;
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

	<h1> Register here </h1>
    
    <?php if (isset($_SESSION['message'])) { ?>
        <h3 style="color: #436850;"><?php echo $_SESSION['message']; ?></h3>
    <?php } unset($_SESSION['message']); ?>
    
	<form action="core/handleForms.php" method="POST">

		<div class="fields">
			<p>
                <label for="user_firstname">First Name: </label>
                <input type="text" placeholder="Your first name here" class="fields" name="user_firstname">
            </p>
            <p>
                <label for="user_lastname">Last Name: </label>
                <input type="text" placeholder="Your last name here" class="fields" name="user_lastname">
            </p>
            <p>
                <label for="username">Username: </label>
                <input type="text" placeholder="Username here" class="fields" name="username">
            </p>
			<p>
                <label for="user_password">Password: </label>
                <input type="password" placeholder="Password here" class="fields" name="user_password">
            </p>
            <p>
                <label for="username">Confirm Password: </label>
                <input type="password" placeholder="Confirm your password here" class="fields" name="confirm_password">
                <input type="submit" value="Register" id="submitBtn" name="regBtn">
		    </p>
		</div>
	</form>
</body>
</html>