CREATE USER 'eCommerUser'@'%' IDENTIFIED WITH mysql_native_password BY 'p@ssw0rd';
GRANT ALL ON eCommerce.* TO 'eCommerUser'@'%';