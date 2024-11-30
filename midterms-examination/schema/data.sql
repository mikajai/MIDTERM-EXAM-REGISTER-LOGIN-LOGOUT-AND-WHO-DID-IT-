CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR (50),
    user_firstname VARCHAR (50),
    user_lastname VARCHAR (50),
    user_password VARCHAR (50),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE photographer (
    photographer_id INT AUTO_INCREMENT PRIMARY KEY,
    photographer_name VARCHAR (50),
    available_schedule DATE,
    client_id INT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE client_records (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR (50),
    last_name VARCHAR (50),
    birth_date DATE,
    contact_num VARCHAR (50),
    service_application VARCHAR (50),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    created_by INT,
    updated_by INT,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE action_log (
    action_log_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR (50),
    action_made VARCHAR (255),
    date_action_made TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
