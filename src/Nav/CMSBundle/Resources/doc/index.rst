Notes on the NavCMSBundle
===
Users:
The User entity for this bundle has been kept simple:

id
username
password (hashed using password_hash($password, PASSWORD_BCRYPT) )

This user entity is used as Model and as a Interface
for authenticating users from the database. Therefore it
implements  the UserInterface from the Symfony Security Component.
By implementing this, we need to use 3 methodsd from this interface:

- getSalt()
- getRoles()
- eraseCreadentials()

===
Database:
A database dump is include for trying out this application. Use the symfony.sql
dump if you want to see this application in action. You could also
try to run the app/console doctrine:schema:update to update all tables

===
Todo's:
- Make the Notification Bundle work at contact page
