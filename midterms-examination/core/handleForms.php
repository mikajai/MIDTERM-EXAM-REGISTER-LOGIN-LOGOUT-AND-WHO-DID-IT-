<?php  

require_once 'models.php';
require_once 'dbConfig.php';
require_once 'validate.php';

// to handle the registration page
if (isset($_POST['regBtn'])) {

    // checks and sanitizes user input
    $username = sanitizeUserInput($_POST['username']);
    $user_firstname = sanitizeUserInput($_POST['user_firstname']);
	$user_lastname = sanitizeUserInput($_POST['user_lastname']);
    $user_password = ($_POST['user_password']);
    $confirm_password = ($_POST['confirm_password']);

    if (!empty($username) && !empty($user_firstname) && !empty($user_lastname) && !empty($user_password) && !empty($confirm_password)) {

        if ($user_password == $confirm_password) {

            if (validateUserPassword($user_password)) {

                $insertQuery = insertNewUser($pdo, $username, $user_firstname,  $user_firstname, sha1($user_password));

                if ($insertQuery) {
                    header("Location: ../login.php");
                }
                else {
                    header("Location: ../register.php");
                }
            }
            else {
                $_SESSION['message'] = "Password must be more than 8 characters containing numbers and letters in upper and lower cases.";
                header("Location: ../register.php");
            }
        }
        else {
            $_SESSION['message'] = "Both passwords must be the same.";
            header("Location: ../register.php");
        }
    }
    else {
        $_SESSION['message'] = "Please make sure that all input fields are not empty.";
        header("Location: ../register.php");
    }
    
}

// to handle the login page
if (isset($_POST['loginBtn'])) {

    $username = sanitizeUserInput($_POST['username']); // checks and sanitizes the username
    $user_password = sha1($_POST['user_password']); // sha1 to secure the user password

    if (!empty($username) && !empty($user_password)) {

        $loginQuery = loginUser($pdo, $username, $user_password);

        if ($loginQuery) {
            insertOnActionLog($pdo, $_SESSION['username'], "{$_SESSION['username']} logged in the system.");
            header("Location: ../index.php");
        }
        else {
            header("Location: ../login.php");
        }
    }
    else {
        $_SESSION['message'] = "Please make sure that all input fields are not empty.";
        header("Location: ../login.php");
    }
}

// to handle insertion of new client applications
if (isset($_POST['insertNewClientBtn'])) {

    $query = newClientRec ($pdo, $_POST['first_name'], $_POST['last_name'],
    $_POST['birth_date'], $_POST['contact_num'], $_POST['service_application'], $_SESSION['user_id']);

        if ($query) {
            insertOnActionLog($pdo, $_SESSION['username'], "Inserted new application for {$_POST['first_name']} {$_POST['last_name']}"); // action to be stored in the database inside action log table
            header("Location: ../index.php");
        }
        else {
            echo "Insertion failed";
        }
}

// to handle editing or updating client record
if (isset($_POST['editNewClientBtn'])) {
    $query = updateNewClientRec($pdo, $_POST['first_name'], $_POST['last_name'], $_POST['birth_date'], $_POST['contact_num'], $_POST['service_application'], $_GET['client_id'], $_SESSION['user_id']);

    if ($query){
        insertOnActionLog($pdo, $_SESSION['username'], "Updated an application for {$_POST['first_name']} {$_POST['last_name']}"); // action to be stored in the database inside action log table
        header("Location: ../index.php");
    }
    else {
        echo "Editing client information failed";
    }
}

// to handle the client record deletion
if (isset($_POST['deleteNewClientBtn'])) {
    $query = deleteNewClientRec($pdo, $_GET['client_id']);

    if ($query) {
        insertOnActionLog($pdo, $_SESSION['username'], "Deleted a client record with ID {$_GET['client_id']}"); // action to be stored in the database inside action log table
        header("Location: ../index.php");
    }
    else {
        echo "Client Information Deletion failed";
    }
}

// to handle the insertion of photographers
if (isset($_POST['insertNewPhotographerBtn'])) {
	$query = insertPhotographer($pdo, $_POST['photographer_name'], $_POST['available_schedule'], $_SESSION['user_id'], $_GET['client_id']);

	if ($query) {
        insertOnActionLog($pdo, $_SESSION['username'], "Assigned a photograper for client {$_GET['client_id']}"); // action to be stored in the database inside action log table
		header("Location: ../viewPhotographer.php?client_id=" . $_GET['client_id']);
	}
	else {
		echo "The insertion failed";
	}
}

// to handle edits or updates made on he photographer list
if (isset($_POST['editPhotographerBtn'])) {
	$query = updatePhotographer($pdo, $_POST['photographer_name'], $_POST['available_schedule'], $_GET['photographer_id']);

	if ($query) {
        insertOnActionLog($pdo, $_SESSION['username'], "Reassigned a photographer for client {$_GET['client_id']}"); // action to be stored in the database inside action log table
		header("Location: ../viewPhotographer.php?client_id=" . $_GET['client_id']);
	}
	else {
		echo "Update failed";
	}

}

// to handle the deletion of photographer record
if (isset($_POST['deletePhotographerBtn'])) {
	$query = deletePhotographer($pdo, $_GET['photographer_id']);

	if ($query) {
        insertOnActionLog($pdo, $_SESSION['username'], "Deleted the assigned photographer for client {$_GET['client_id']}"); // action to be stored in the database inside action log table
		header("Location: ../viewPhotographer.php?client_id=" . $_GET['client_id']);
        exit();
	}
	else {
		echo "The deletion failed";
	}
}

// back button
if (isset($_POST['backBtn'])) {
    header("Location: ../index.php");
    exit();
}

// back button found in the photographer list
if (isset($_POST['deletePhotogbackBtn'])) {
    header("Location: ../index.php");
    exit();
}




?>