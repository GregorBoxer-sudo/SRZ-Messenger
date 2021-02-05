# SRZ-Messenger

https://docs.google.com/document/d/1AW7I1kLx_LlGN_nbQE43joOdSn5mnM2fA2ZUST9VvsM/edit?usp=sharing

Use on the server/localhost:

A server with MySQL and PHP is needed to use the messenger. To set up the messenger, copy the files into the web directory. Create a database. You can do this under localhost/PHPMyAdmin. Optionally you can create a restricted user for the messenger (recommended - needs data permissions). Import the table as a SQL file. In PHPMyAdmin, you can select the desired database and select the SQL file in the tab "import". You can find it in the Git folder as chats.sql. Next, edit the file "dbh.php" in the directory "PHP". You have to enter the name of your newly created database and the desired user's log-in data. Do not forget to change the hostname. If the database is not on another server, the host will be the "localhost" by default. Once you have adjusted everything, you can start using the messenger directly.