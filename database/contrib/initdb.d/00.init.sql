CREATE DATABASE IF NOT EXISTS dashboard
  CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_general_ci
;

CREATE USER IF NOT EXISTS 'symfony'@'%'
  IDENTIFIED BY 'pass'
  PASSWORD EXPIRE NEVER
;

GRANT ALL ON dashboard.* TO 'symfony'@'%';
