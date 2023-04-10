# RestAPI Laravel using Laravel Sanctum for Authentication and Gate for Authorization

This is a Laravel application as a multiple role blog system, API only, no need to do frontend. A normal user can CRUD his own posts, a manager can CRUD all posts, and an admin can CRUD all posts and users.

## Deployment
Make sure active directory is on root project. Execute following commands:
- `git pull origin master`
- Done

## How to use

- Clone the repository with `git clone`
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run `composer install`
- Run `php artisan migrate`
- Run `php artisan serve` to run the application

## API Route

- Register : http://127.0.0.1:8000/api/register using POST method. In Body tab, choose __form-data__, input __name__, __email__, and __password__
- Login : http://127.0.0.1:8000/api/login using POST method. In Body tab, choose __form-data__, input __email__ and __password__. Copy the token for the next API route.
- Get self identity : http://127.0.0.1:8000/api/user using GET method. In Body tab, choose __form-data__, input __email__ and __password__. In Authorization tab, choose Bearer Token type, paste the Token.
- Logout : http://127.0.0.1:8000/api/logout using POST method. In Body tab, choose __form-data__, input __email__ and __password__. In Authorization tab, choose Bearer Token type, paste the Token.
- CRUD blogs : http://127.0.0.1:8000/api/blogs
	- Create blog : using POST method. In Body tab, choose __form-data__, input __title__, __content__, and __status__. In Authorization tab, choose Bearer Token type, paste the Token.
	- Retrieve all blog (just for 'admin' and 'manager' role) : http://127.0.0.1:8000/api/blogs/[id] using GET method. In Authorization tab, choose Bearer Token type, paste the Token.
	- Retrieve certain blog : http://127.0.0.1:8000/api/blogs/[id] using GET method. In Authorization tab, choose Bearer Token type, paste the Token.
	- Update certain blog : http://127.0.0.1:8000/api/blogs/[id] using PUT method. In Params tab, input __title__, __content__, and __status__. In Authorization tab, choose Bearer Token type, paste the Token.
	- Delete certain blog : http://127.0.0.1:8000/api/blogs/[id] using DELETE method. In Authorization tab, choose Bearer Token type, paste the Token.
- CRUD users (just for 'admin' role): http://127.0.0.1:8000/api/users
	- Create user : using POST method. In Body tab, choose __form-data__, input __name__, __email__ , __password__, and __role__. In Authorization tab, choose Bearer Token type, paste the Token.
	- Retrieve all user (just for 'admin' and 'manager' role) : http://127.0.0.1:8000/api/users/[id] using GET method. In Authorization tab, choose Bearer Token type, paste the Token.
	- Retrieve certain user : http://127.0.0.1:8000/api/users/[id] using GET method. In Authorization tab, choose Bearer Token type, paste the Token.
	- Update certain user : http://127.0.0.1:8000/api/users/[id] using PUT method. In Params tab, input __name__, __email__ , __password__, and __role__. In Authorization tab, choose Bearer Token type, paste the Token.
	- Delete certain user : http://127.0.0.1:8000/api/users/[id] using DELETE method. In Authorization tab, choose Bearer Token type, paste the Token.
