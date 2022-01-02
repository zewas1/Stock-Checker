# Stock-Checker

In order to run this application a local web server with an SMTP server and composer are needed. You can run it with XAMPP's apache.

Download xampp: https://www.apachefriends.org/download.html PHP 8.0.11 for your operating system.

Download and install composer: https://getcomposer.org/download/

Start XAMPP's apache service via XAMPP control panel.

Clone the git project into xampp/htdocs folder for e.g. xampp/htdocs/StockChecker

Navigate to the root directory of the project (you can use cmd, gitbash, terminal) for e.g. cd xampp/htdocs/StockChecker

Install required dependencies with the following command: composer require symfony/runtime

There are two main uses of current application:

1. You can get any stock's base information in json via route localhost/StockChecker/public/index.php/stock/{stock symbol}
e.g. localhost/StockChecker/public/index.php/stock/aapl

2. You can run stock checking command via terminal from the root directory by typing php bin/console app:stock-check {stock symbol}
e.g. php bin/console app:stock-check aapl

Command's workflow: contacts API to gain details about the stock -> runs through the trigger service -> if any triggers are checked, triggers and email alert

#.env
Prior to using the application .env has to be configured as per .env.example file.

1. create an account on https://iexcloud.io/
2. put API_TOKEN (received unique token after registration) and API_URI (https://cloud.iexapis.com/stable/stock/) on .env configuration
3. Configure email details for triggers:
  email_to - recipient's email address
  email_host - smpt server hostname (for e.g. smtp.gmail.com, if you would like to send emails through google smtp server)
  email_port - smtp port, default is 25, but if you're going to use google smtp 587 is recommended.
  email_username - username of sender's email address e.g. some-email@gmail.com
  email_password - password of sender's email address

If you're going to be using google smpt, also check https://support.google.com/accounts/answer/6010255?hl=en this setting for configuration.
