<p align="center"> <h1> Meetup on Laravel </h1> </p> 


<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

Laravel is a web application framework with expressive, elegant syntax.
Laravel is accessible, powerful, and provides tools required for large, robust applications.

## About  
Social network application has REST API service, Web UI ( VueJs support ).

- User gets an invitation to become a member in a Group
- When a User in a Group, he can invite people from different groups to one/all of his groups.


**Group**  has the following types: (currently)
- private
- closed
- public

**Invitation [Subscription]**  has the following status: (currently)
- pending :   has a request to join  the group.
- active :    active member
- canceled:   inactive member 
- left:       inactive member 
- blocked :   blocked from this group

##### Main Entities 
     Group, User, Subscription, GroupInterests     

## Technologies :

 - Laravel 6, + Php 7.4 + PHPUnit 8.5.2
    - __Laravel-mix__  Djs/css Webpack compiler*
    - __Carbon__  *(Human) Readable Dates.*
    - __Passport__  *oauth*
    - __Factory Faker + Seeder__ *store fake data* 
    - __Resource for each Entity Model represented__ *filter json response*
    - __Homestead container env.__
    - __3 types of pagination__ *( api, simple, numeric)*
    - etc...

- Mysql 5.7
- Vuejs2 + npm	


## Rest Service: ##
It's apis supported below
- [POST] : Login and get oauth access-token
- [GET] :  Retrieve list of groups, users and invitations 
- [POST] : To send invitation

Postman collections attached in ./meetup-data/

### Instructions
    >> Php artisan migrate  | php artisan migrate:refresh
    >> php artisan db:seed
    >> php artisan passport:install

### Run below commands:
#### When a Change on Php code? 
###### Make sure [.env →  APP_DEBUG=false ] and run:
    >> ./vendor/bin/phpunit
    >> ./vendor/bin/phpstan analyse
##### On js/css files:
	>> npm run dev




  