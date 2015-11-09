Nav Appaiya - Signin with google
============

Signin with your google account

![alt tag](http://phppot.com/wp-content/uploads/2014/06/php_google_oauth_login.jpg)



Database structure for saving the users
============

CREATE TABLE IF NOT EXISTS `google_users` (
  `google_id` decimal(21,0) NOT NULL,
  `google_name` varchar(60) NOT NULL,
  `google_email` varchar(60) NOT NULL,
  `google_link` varchar(60) NOT NULL,
  `google_picture_link` varchar(60) NOT NULL,
  PRIMARY KEY (`google_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



AUTH
============
- client id
897178703229-63li8od4rkl7pvsaf12idthgq5d7eq98.apps.googleusercontent.com

- secret key
897178703229-63li8od4rkl7pvsaf12idthgq5d7eq98.apps.googleusercontent.com

- developer key
AIzaSyDW8I8paaMNvzVlEcOuhSrL0rXEyTnf9pY

- redirect url
http://navappaiya.dev/oauth2callback

