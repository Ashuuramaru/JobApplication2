CREATE TABLE Applicants (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    first_name VARCHAR(50) NOT NULL, 
    last_name VARCHAR(50) NOT NULL, 
    experience INT NOT NULL,       
    specialization VARCHAR(100) NOT NULL, 
    degree VARCHAR(100) NOT NULL,   
    contact VARCHAR(15) NOT NULL,   
    email VARCHAR(100) NOT NULL,     
    UNIQUE (email)                   
);

CREATE TABLE user_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    details TEXT,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_accounts(id) ON DELETE CASCADE
);
