## About Cricket Example Application

## Setup

1. Go To root folder 
2. git clone https://github.com/trisghosh/laravel-vue-sample-app.git
3. git checkout dev
4. Copy .env.example file to .env and edit database credentials there
5. Run composer install
6. Run php artisan key:generate
7. Run php artisan migrate

## To Build 

npm run development

npm run development -- --watch

## VUE 

In order to run the AJAX added the following MIX variable in .env file :

MIX_AJAX_URL="${APP_URL}"

## Routes
<pre>
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
| Domain | Method   | URI                    | Name             | Action                                                                 | Middleware   |
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD | /                      |                  | App\Http\Controllers\TeamController@index                              | web          |
|        | GET|HEAD | api/player/{id}        |                  | App\Http\Controllers\PlayersController@playerdetails                   | api          |
|        | GET|HEAD | api/points/{team_id}   |                  | App\Http\Controllers\TeamController@pointDetails                       | api          |
|        | GET|HEAD | api/team/{id}          |                  | App\Http\Controllers\TeamController@teamdetails                        | api          |
|        | GET|HEAD | api/user               |                  | Closure                                                                | api,auth:api |
|        | GET|HEAD | home                   | home             | App\Http\Controllers\HomeController@index                              | web,auth     |
|        | GET|HEAD | login                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST     | login                  |                  | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | POST     | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST     | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | GET|HEAD | password/reset         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | POST     | password/reset         | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD | password/reset/{token} | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | GET|HEAD | player/create          |                  | App\Http\Controllers\PlayersController@create                          | web,auth     |
|        | GET|HEAD | players                |                  | App\Http\Controllers\PlayersController@index                           | web          |
|        | POST     | players                | players          | App\Http\Controllers\PlayersController@store                           | web,auth     |
|        | GET|HEAD | players/{team_id}      | players          | App\Http\Controllers\PlayersController@teamLists                       | web          |
|        | GET|HEAD | points                 |                  | App\Http\Controllers\TeamController@points                             | web          |
|        | GET|HEAD | points/{team_id}       |                  | App\Http\Controllers\TeamController@pointDetails                       | web          |
|        | GET|HEAD | register               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST     | register               |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
|        | POST     | team                   | team             | App\Http\Controllers\TeamController@store                              | web,auth     |
|        | GET|HEAD | team/create            |                  | App\Http\Controllers\TeamController@create                             | web,auth     |
|        | GET|HEAD | team/result            |                  | App\Http\Controllers\TeamController@result                             | web,auth     |
|        | POST     | team/result            | result           | App\Http\Controllers\TeamController@result                             | web,auth     |
+--------+----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
</pre>

## API


## Vue Modal

Used VUE modal js to show the data in modal. 


## License
