
### Database Schema

* The database has 4 tables: `authentication`, `customer`, `waitlist`, and `appointment`. The datbase schema is subjective to change and business requirements. 

#### Authentication Table

* This table stores the login credentials for the customers. The authentication table will have audit loggin for security purposes. 

#### Customer Table

* This table stores information about the customers, such as their name and phone number.

#### Waitlist Table

* This table stores information about the customers who are on the waitlist for an appointment, including the date and time they're available, and the quantity of people.

#### Appointment Table

* This table stores information about the appointments that have been booked, including the date and time, and the quantity of people.

### How to Use

* To use this database, you will need to create the tables by running the SQL scripts provided in this repository. You can also create a developer role in the database for access control purposes. Database name would be strawberry 

### Connecting to database 
* Refer to database-connection.php



