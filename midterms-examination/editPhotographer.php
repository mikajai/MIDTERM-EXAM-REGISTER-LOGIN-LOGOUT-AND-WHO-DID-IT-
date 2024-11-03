<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editing Photographer Info</title>
	
	<style>
		body {
            font-family: Times New Roman;
            margin: 20px;
            background-color: #ADBC9F;
        }

        .edit h1{
            color: #12372A;
            text-align: center;
            margin-bottom: 30px;
            margin-top: 40px;
        }

        .edit img {
            width: 100px;
            height: 100px;
            display: inline-block;
            vertical-align: middle; 
            margin-top: -100px;
            margin-bottom: 0px;
            margin-left: 0px
        }
		
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        p {
            margin: 10px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 80%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="date"] {
            width: 80%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

		.editpho-button{
            margin-top: 20px;
		}

        a {
            display: inline-block;
            margin-top: 20px;
            color: #12372A;
            font-weight: bold;
            text-decoration: none;
        }

	</style>

</head>
<body>
    <div class='edit'>
        <h1>Edit Photographer's Information</h1>
        <img src="shutter charm.png"> 
    </div>

	<?php $getPhotographerByID = getPhotographerByID($pdo, $_GET['photographer_id']); ?>
	
	<form action="core/handleForms.php?photographer_id=<?php echo $_GET['photographer_id']; ?> 
	&client_id=<?php echo $_GET['client_id']; ?>" method="POST">
		<p>
            <label for="photographer_name">Photographer Name: </label> 
            <input type="text" name="photographer_name" value="<?php echo $getPhotographerByID['photographer_name']; ?>">
		</p>
		<p>
			<label for="available_schedule">Available Schedule: </label> 
			<input type="date" name="available_schedule" value="<?php echo $getPhotographerByID['available_schedule']; ?>">
		</p>

		<div class="editpho-button">
			<input type="submit" name="editPhotographerBtn" value="Update Info">
        </div>

	</form>
	<a href="viewPhotographer.php?client_id=<?php echo $_GET['client_id']; ?>"> View Photographers List</a>
</body>
</html>
