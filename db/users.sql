CREATE TABLE roles (
    role_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
)ENGINE=InnoDB;

CREATE TABLE employees (
    employee_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30),
    last_name VARCHAR(30),
    login VARCHAR(30),
    password VARCHAR(30),
    role_id INT UNSIGNED,
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
)ENGINE=InnoDB;