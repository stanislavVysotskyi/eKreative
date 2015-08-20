A Symfony project created on August 18, 2015, 10:18 pm.
# eKreative test task
To install and configure the project, follow these steps:  

1. Configure your apache for work with the new virtual host.
2. Use git clone for getting project to your PC  
    [ git clone https://github.com/stanislavVysotskyi/eKreative.git ]  
3. Check symfony2 recommendation in console  
    [ php app/check.php ]  
4. Configure DB connect  
    [ http://ekreative.com/web/app_dev.php/_configurator/ ]  
5. Generate a New Doctrine Entity Stub  
    [ php app/console doctrine:schema:update --force ]  
    
After this steps you can try open test site http://ekreative.com/web/app_dev.php/ and use created app  
  
# Email service  
After send messages in site side, they are DOES NOT send to Email. For send message to Email you must use command line or   
cron.  
[ php app/console ekreative:send your_google_email your_password ]  
  
All message will be sent to users from your Google Account.

# PHPUnit test
For start unit test, write command in your terminal:  
[ phpunit -c app src/eKreativeBundle/Tests/Utility/ ]