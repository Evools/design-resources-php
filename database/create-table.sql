CREATE TABLE category (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    slug VARCHAR(255) NOT NULL
);

CREATE TABLE resources (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    category_id INT(11),
    FOREIGN KEY (category_id) REFERENCES category(id)
);

CREATE TABLE job_type (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE jobs (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    company VARCHAR(255) NOT NULL,
    specialization VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    job_type_id INT(11),
    salary VARCHAR(255),
    FOREIGN KEY (job_type_id) REFERENCES job_type(id)
);