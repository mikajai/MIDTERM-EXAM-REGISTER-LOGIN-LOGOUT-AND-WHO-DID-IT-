<?php  

require_once 'dbConfig.php';


// to insert new user in the database
function insertNewUser($pdo, $username, $user_firstname, $user_lastname, $user_password) {

    $checkingUserSQL = "SELECT * FROM users WHERE username = ?";
    $checkingUserSQLstmt = $pdo->prepare($checkingUserSQL);
    $checkingUserSQLstmt->execute([$username]);

    if ($checkingUserSQLstmt->rowCount() == 0) {

        $sql = "INSERT INTO users (username, user_firstname, user_lastname, user_password) 
                VALUES (?,?,?, ?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$username, $user_firstname, $user_lastname, $user_password]);

        if ($executeQuery) {
            $_SESSION['message'] = "User is successfully inserted.";
            return true;
        }
        else {
            $_SESSION['message'] = "An error occured.";
        }
    }
    else {
        $_SESSION['message'] = "User already exists.";
    }
}

// stores the registered username and password made by the user
function loginUser($pdo, $username, $user_password) {

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() == 1) {
        $userInfoRow = $stmt->fetch();
        $userIDFromDB = $userInfoRow['user_id'];
        $usernameFromDB = $userInfoRow['username'];
        $user_passwordFromDB = $userInfoRow['user_password'];

        if ($user_password == $user_passwordFromDB) {
            $_SESSION['user_id'] = $userIDFromDB;
            $_SESSION['username'] = $usernameFromDB;
            $_SESSION['message'] = "Login successful";
            return true;
        }
        else {
            $_SESSION['message'] = "Your password is invalid, but the user exists.";
        }
    }

    if ($stmt->rowCount() == 0) {
        $_SESSION['message'] = "Your username does not exists. Please register first.";
    }
}

// to insert data into action log in the database
function insertOnActionLog($pdo, $username, $action_made) {
    $sql = "INSERT INTO action_log (username, action_made) 
            VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$username, $action_made]);

    if ($executeQuery) {
        return true;
    }
}

// inserting of new client record
function newClientRec($pdo, $first_name, $last_name, $birth_date, $contact_num, $service_application, $created_by) {

    $sql = "INSERT INTO client_records (first_name, last_name, birth_date, contact_num, service_application, created_by) 
            VALUES(?,?,?,?,?,?)";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $birth_date, $contact_num, $service_application, $created_by]);

    if ($executeQuery) {
        return true;
    }
}

// to show all client application record
function getAllNewClients($pdo) {
    $sql = "SELECT
                client_records.*,
                users.username AS created_by,
                updater.username AS updated_by
            FROM client_records
            JOIN users ON client_records.created_by = users.user_id
            LEFT JOIN users AS updater ON client_records.updated_by = updater.user_id";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

// getting the client by their id
function getNewClientByID ($pdo, $client_id){
    $sql = "SELECT * FROM client_records WHERE client_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$client_id]);

    if ($executeQuery){
        return $stmt->fetch();
    }
}

// for updating client record
function updateNewClientRec($pdo, $first_name, $last_name, $birth_date, $contact_num, $service_application, $client_id, $updated_by){

    $sql = "UPDATE client_records
            SET first_name = ?,
                last_name = ?,
                birth_date = ?,
                contact_num = ?,
                service_application = ?,
                updated_by = ?
            WHERE client_id = ?
        ";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$first_name, $last_name, $birth_date, $contact_num, $service_application, $updated_by, $client_id]);

    if ($executeQuery){
        return true;
    }
}

// for client deletion
function deleteNewClientRec($pdo, $client_id) {
    $deleteClientPhotogRec = "DELETE FROM photographer WHERE client_id = ?";
    $deleteStmt = $pdo->prepare($deleteClientPhotogRec);
    $executeDeleteQuery = $deleteStmt->execute([$client_id]);

    if ($executeDeleteQuery) {
        $sql = "DELETE FROM client_records WHERE client_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$client_id]);

        if ($executeQuery) {
            return true;
        }
    }
}

// for showing photographer record
function getPhotographerByClientRec($pdo, $client_id) {
    $sql = "SELECT
                photographer.photographer_id AS photographer_id,
                photographer.photographer_name AS photographer_name,
                photographer.available_schedule AS available_schedule,
                photographer.date_added AS date_added,
                CONCAT(client_records.first_name, ' ',client_records.last_name) AS client_name,
                users.username AS added_by
            FROM photographer
            JOIN client_records ON photographer.client_id = client_records.client_id
            JOIN users ON photographer.user_id = users.user_id
            WHERE photographer.client_id = ?
            GROUP BY photographer.photographer_id
            ";

    $stmt = $pdo->prepare($sql); 
    $executeQuery = $stmt->execute([$client_id]);
    
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

// for photographer insertion 
function insertPhotographer($pdo, $photographer_name, $available_schedule, $user_id, $client_id) {
    $sql = "INSERT INTO photographer (photographer_name, available_schedule, user_id, client_id)
            VALUES (?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$photographer_name, $available_schedule, $user_id, $client_id]);

    if ($executeQuery) {
        return true;
    }
}

// getting photographer by their id
function getPhotographerByID($pdo, $photographer_id) {
	$sql = "SELECT 
				photographer.photographer_id AS photographer_id,
                photographer.photographer_name AS photographer_name,
                photographer.available_schedule AS available_schedule,
				photographer.date_added AS date_added,
				CONCAT(client_records.first_name, ' ',client_records.last_name) AS client_name
			FROM photographer
			JOIN client_records ON photographer.client_id = client_records.client_id
			WHERE photographer.photographer_id  = ? 
			GROUP BY photographer.photographer_id
            ";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$photographer_id]);
	
    if ($executeQuery) {
		return $stmt->fetch();
	}
}

// for updating photographer record
function updatePhotographer($pdo, $photographer_name, $available_schedule, $photographer_id) {
	$sql = "UPDATE photographer
			SET photographer_name = ?,
				available_schedule = ?
			WHERE photographer_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$photographer_name, $available_schedule, $photographer_id]);

	if ($executeQuery) {
		return true;
	}
}

// for deletion of photographer in the list
function deletePhotographer($pdo, $photographer_id) {
	$sql = "DELETE FROM photographer WHERE photographer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$photographer_id]);
	if ($executeQuery) {
		return true;
	}
}
?>