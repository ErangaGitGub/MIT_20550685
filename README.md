Name 			- S.P.E.S.Nawarathna
Registration Number	- 2020/MIT/068
Index Number		- 20550685
Project Title 		- Automation of Currency Exchange Process at the Bank of Ceylon Pay Office
GitHub URL		- https://github.com/ErangaGitGub/MIT_20550685


# Installation
*	Install the XAMPP server for PHP and MySQL.
*	Install Glassfish server
*	Deploy the PayOfficeService.war file in glassfish server
API\PayOfficeService\dist\ PayOfficeService.war
*	Create the payoffdb and appdb MySQL databases using the below SQL scripts 
\DB\payoffdb.sql
\DB\appdb.sql
*	Set the database parameters in the below mentioned file including the username and password.
Application\config\database.php
*	Create a new folder with the name “payoffice” inside the htdocs folder.
*	Copy the source folders from UI/payoffice folder to the newly created folder.
*	Start the “Apache” and “MySQL” services through the XAMPP Control Panel.
*	Use http://localhost/payoffice/auth URL to login to the system.
