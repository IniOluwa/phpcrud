## **BookCrud** is a simple webapp with user authentication and basic CRUD operations in PHP.


#### BookCrud Features :rocket:
- Signup
- Login
- Create
- Retreive
- Update
- Delete

#### _How to install_ **BookCrud** :octocat:
- git clone this repository 
- install these dependencies
    - PHP
    - Apache
    - MySql

#### __Usage__ :metal:
- Navigate to the repository
- Run book/index.php
- Create an account
    - book/signup.php
- Login
    - book/login.php
- View contents for management
    - book/view_contents.php

#### __Connecting to the database__ :+1:
- Create a _constants.php_ file in includes/
- Create your constants in this format
    - define("DB_SERVER", "your_server");
    - define("DB_USER", "your_user_name");
    - define("DB_PASSWORD", "your_password);
    - define("DB_NAME", "bookcrud_db");