-- Создание таблицы категорий
CREATE TABLE IF NOT EXISTS category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    slug VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Создание таблицы ресурсов
CREATE TABLE IF NOT EXISTS resources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    link VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    category_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE
);

-- Создание таблицы типов работы
CREATE TABLE IF NOT EXISTS job_type (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Создание таблицы вакансий
CREATE TABLE IF NOT EXISTS jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    company VARCHAR(255) NOT NULL,
    specialization VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    salary VARCHAR(50),
    salary_numeric DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Промежуточная таблица для связи вакансий и типов работы
CREATE TABLE IF NOT EXISTS job_job_type (
    job_id INT NOT NULL,
    job_type_id INT NOT NULL,
    FOREIGN KEY (job_id) REFERENCES jobs(id) ON DELETE CASCADE,
    FOREIGN KEY (job_type_id) REFERENCES job_type(id) ON DELETE CASCADE,
    PRIMARY KEY (job_id, job_type_id)
);

-- Заполнение таблицы категорий
INSERT INTO category (name, slug) VALUES 
('Web Development', 'web-development'),
('Graphic Design', 'graphic-design'),
('Data Science', 'data-science'),
('Marketing', 'marketing');

-- Заполнение таблицы ресурсов
INSERT INTO resources (image, link, title, content, category_id) VALUES
('resource1.jpg', 'https://example.com/web-dev', 'Web Dev Guide', 'A complete guide to web development', 1),
('resource2.jpg', 'https://example.com/design', 'Design Basics', 'Fundamentals of graphic design', 2),
('resource3.jpg', 'https://example.com/data-science', 'Data Science Handbook', 'Comprehensive data science book', 3),
('resource4.jpg', 'https://example.com/marketing', 'Marketing Strategies', 'Advanced digital marketing strategies', 4);


-- Заполнение таблицы типов работы
INSERT INTO job_type (name) VALUES 
('Full-time'),
('Part-time'),
('Remote'),
('Contract'),
('Freelance'),
('Internship'),
('Competitive salary');

-- Заполнение таблицы вакансий
INSERT INTO jobs (image, company, specialization, country, salary, salary_numeric) VALUES
('company1.jpg', 'TechCorp', 'Backend Developer', 'USA', '2000$', 2000),
('company2.jpg', 'DesignStudio', 'UI/UX Designer', 'Germany', 'Договорная', NULL),
('company3.jpg', 'DataSolutions', 'Data Analyst', 'UK', '1500$', 1500),
('company4.jpg', 'CyberSecurity Inc.', 'Security Specialist', 'Canada', 'Competitive salary', NULL);

-- Связь вакансий с типами работы
INSERT INTO job_job_type (job_id, job_type_id) VALUES
(1, 1), -- Full-time
(1, 3), -- Remote
(2, 5), -- Freelance
(3, 2), -- Part-time
(4, 1), -- Full-time
(4, 7); -- Competitive salary