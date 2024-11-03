<?php

// for validating user password
function validateUserPassword($user_password) {

    if (strlen($user_password) > 8) {
        $hasLower = false;
        $hasUpper = false;
        $hasNumber = false;

        for ($i = 0; $i < strlen($user_password); $i++) {

            if (ctype_lower($user_password[$i])) {
                $hasLower = true;
            }
            else if (ctype_upper($user_password[$i])){
                $hasUpper = true;
            }
            else if (ctype_digit($user_password[$i])) {
                $hasNumber = true;
            }

            if ($hasLower && $hasUpper && $hasNumber) {
                return true;
            }
        }
    }
    else {
        return false;
    }
}

// for sanitizing user input or data
function sanitizeUserInput($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}