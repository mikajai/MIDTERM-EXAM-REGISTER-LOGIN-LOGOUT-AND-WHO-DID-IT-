<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editing Client Info</title>
    
    <style>
        body {
            font-family: Times New Roman;
            background-color: #ADBC9F;
            margin: 0;
            padding: 20px;
        }

        .edit h1{
            color: #12372A;
            text-align: center;
            margin-bottom: 30px;
        }

        .edit img {
            width: 100px;
            height: 100px;
            display: inline-block;
            vertical-align: middle; 
            margin-top: -110px;
            margin-bottom: 0px;
            margin-left: 0px
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        p {
            margin: 8px 0;
        }

        label {
            color: #12372A;
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="date"],
        input[type="tel"],
        
        select {
            width: 98%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button-sub {
            text-align: right;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <?php $getNewClientByID = getNewClientByID($pdo, $_GET['client_id']); ?>
    <div class='edit'>
        <h1> You are editing the Client's Information... </h1>
        <img src="shutter charm.png"> 
    </div>
    <form action="core/handleForms.php?client_id=<?php echo $_GET['client_id']; ?>" method="POST">

        <p><label for="firstName"> First Name: </label> <input type="text" name="first_name" required></p>
        <p><label for="lastName"> Last Name: </label> <input type="text" name="last_name" required></p>
        <p><label for="birth_date"> Birthdate: </label> <input type="date" name="birth_date" required></p>
        <p><label for="contact_num"> Contact Number: </label> <input type="tel" name="contact_num" required></p>
        <p>
            <label for="service_application"> Service Application: </label> 
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
        <div class="button-sub">
            <input type="submit" name="editNewClientBtn" value="Update Client Info">
        </div>
    </form>
</body>
</html>