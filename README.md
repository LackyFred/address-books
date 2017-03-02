address_book
============

A website for add information to users in contact.

Make a command : 
```
composer install
``` 

Complete the datas after all Bundles of vendor are install

Update the DB :
```
php app/console doctrine:schema:update --force
```

If you want some fixtures write the command :
```
php app/console doctrine:fixtures:load
```

Run the server :  
```
php app/console server:run
```

The account to be connect are in src/AppBundle/DataFixtures, there are all acounts with 'testapp' like password

Website multilanguage by Url:

fr: /

en: /en/


A Symfony project created on February 26, 2016, 1:00 pm.
