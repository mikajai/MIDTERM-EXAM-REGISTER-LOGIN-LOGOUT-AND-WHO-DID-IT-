<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<?php

// if no user is logged in, it will redirect it to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <style>
        body {
			font-family: Times New Roman;
            background-color: #ADBC9F;
            margin: 0;
            padding: 10px;
        }

        .header {
            background-color: #436850;
            padding: 12px;
            border-radius: 10px;
            
        }

        .name-fields, .birth-contact-service_app-fields {
            display: flex;     
        }

        .name-fields p, .birth-contact-service_app-fields p {
            flex: 1;
            margin-top: 0.5;
        }

        label {
            color: #12372A;
            display: block; 
            font-weight: bold;
            margin-top: 0.5;
            margin-left: 5px;
        }

        input[type="text"] {
            width: 95%; 
            padding: 10px;
            margin-top: 3px;
            margin-left: 5px;
            border: 1px solid #12372A; 
            border-radius: 5px;
        }

        input[type="date"] {
            width: 85%; 
            padding: 10px;
            margin-top: 3px;
            margin-left: 5px;
            border: 1px solid #12372A; 
            border-radius: 5px;
        }
        
        input[type="tel"] {
            width: 85%; 
            margin-right: 2px;
            padding: 10px;
            margin-top: 3px;
            border: 1px solid #12372A; 
            border-radius: 5px;
        }
        
        select {
            width: 100%; 
            padding: 10px;
            margin-top: 3px;
            border: 1px solid #12372A; 
            border-radius: 5px;
        }

        .insert-button{
            text-align: right;
            margin-top: 45px;
            margin-left: 10px;
        }

        a {
            display: inline-block;
            color: #12372A;
            margin-top: 20px;
            text-decoration: none;
        }

        .container {
            border: 1px solid #9b9595;
            border-radius: 8px; 
            padding: 20px; 
            margin: 2px;
            background-color: #f9f9f9;
            display: inline-block;
            border: 1px solid #12372A; 
        }

        .container h3 {
            margin: 1px 0; 
            font-size: 16px;
            color: #000000;
        }

        .navbar img {
            width: 150px;
            height: 150px;
            display: inline-block;
            vertical-align: middle; 
            margin-top: -15px
        }
    </style>
    
</head>
<body>
    
    <!-- header and navigation bar -->
    <div class="header">
        <div class="navbar" style="color: #FBFADA; text-align: right; font-size: 20px;">
            <?php echo 'Hello! Welcome to Shutter Charm Photography Services ~ ' . htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php" style="color: #FBFADA;">Logout</a>
            <img src="shutter charm.png"> <!-- logo -->
        </div>
    </div>
    
    <form action="core/handleForms.php" method="POST">

        <div class="name-fields">
            <p><label for="firstName">First Name:</label>
                <input type="text" name="first_name" required></p>
            <p><label for="lastName">Last Name:</label>
                <input type="text" name="last_name" required></p>
        </div>

        <div class="birth-contact-service_app-fields">
            <p><label for="birth_date">Birthdate:</label>
                <input type="date" name="birth_date" required></p>
            <p><label for="contact_num">Contact Number:</label>
                <input type="tel" name="contact_num" required></p>
        
            <p><label for="service_application"> Service Application: </label> 
                <select name="service_application" required>
                        <option value="Pet Photography"> Pet Photography </option>
                        <option value="Event Photography"> Event Photography </option>
                        <option value="Food Photography"> Food Photography </option>
                        <option value="Fashion Photography"> Fashion Photography </option>
                        <option value="Portrait Photography"> Portrait Photography </option>
                        <option value="Commercial Photography"> Commercial Photography </option>
                        <option value="Others"> Others </option>
                </select>
            </p>
        
            <div class="insert-button">
                    <input type="submit" name="insertNewClientBtn" value="Save Application">
            </div>
       
        </div>
    </form>


    <!-- to view all the applications made -->
    <?php $getAllNewClients = getAllNewClients($pdo); ?>
        <?php foreach ($getAllNewClients as $row) { ?>
        <div class="container">

            <!-- To display client application for service -->

            <h3>Client ID: <?php echo $row['client_id']; ?></h3>
            <h3>First Name: <?php echo $row['first_name']; ?></h3>
            <h3>Last Name: <?php echo $row['last_name']; ?></h3>
            <h3>Birthdate: <?php echo $row['birth_date']; ?></h3>
            <h3>Contact Number: <?php echo $row['contact_num']; ?></h3>
            <h3>Service Application: <?php echo $row['service_application']; ?></h3>
            <h3>Created by: <?php echo ($row['created_by']); ?></h3>    <!-- displays who created the application based on the logged user -->
            <h3>Updated by: <?php echo ($row['updated_by'] ?: 'N/A'); ?></h3> <!-- displays who updated the application -->

            <div class="editAndDelete" style="float: right; margin-right: 10px;">
			<a href="viewPhotographer.php?client_id=<?php echo $row['client_id']; ?>"> Assigned Photographer | </a>
			<a href="editClientRec.php?client_id=<?php echo $row['client_id']; ?>"> Edit | </a>
			<a href="deleteClientRec.php?client_id=<?php echo $row['client_id']; ?>"> Delete </a>
		    </div>

        </div>
        <?php } ?>
</body>
</html>
