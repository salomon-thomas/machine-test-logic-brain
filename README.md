# Blog Project Documentation

This documentation provides an overview of the project and guides you through setting it up, understanding the routes, controllers, Livewire components, and running test cases. It also covers database migration and seeding.

## Table of Contents
- [Project Setup](#project-setup)
- [Routes](#routes)
- [Controllers](#controllers)
- [Livewire Components](#livewire-components)
- [Test Cases](#test-cases)
- [Database Migration and Seeding](#database-migration-and-seeding)

## Project Setup <a name="project-setup"></a>

To set up the project after cloning it from GitHub, follow these steps:

1. Ensure you have PHP, Composer,NodeJs, npm and Laravel installed on your machine.
2. Open a terminal and navigate to the project directory.
3. Run the following command to install the project dependencies:
```
composer install

npm install
```
4. Copy the `.env.example` file to `.env`:
```
cp .env.example .env
```
5. Generate an application key:
```
php artisan key:generate
```
6. Configure the database connection in the `.env` file with your database credentials.
7. Run the database migrations to create the required tables:
```
php artisan migrate
```
8. (Optional) Seed the database with sample data:
```
php artisan db:seed
```
9. Start the development server:
```
php artisan serve

npm run dev
```
10. You can now access the project in your web browser at `http://localhost:8000`.

## Routes <a name="routes"></a>

The following routes are available in the project:

- **GET|HEAD /** - Homepage to display all blogs (Livewire component: `BlogList`)
- **GET|HEAD api/blogs** - API endpoint to fetch all blogs (API\BlogController@index)
- **POST api/blogs** - API endpoint to create a new blog (API\BlogController@store)
- **DELETE api/blogs/{id}** - API endpoint to delete a blog (API\BlogController@destroy)
- **GET|HEAD api/blogs/{id}** - API endpoint to fetch a specific blog (API\BlogController@show)
- **PUT api/blogs/{id}** - API endpoint to update a blog (API\BlogController@update)
- **POST api/login** - API endpoint for user login (API\AuthController@login)
- **GET|HEAD blogs/create** - Form to create a new blog (Controller: `BlogController`, Method: `create`)
- **GET|HEAD blogs/import** - Form to import blogs (Livewire component: `BlogImport`)
- **POST blogs/store** - Store a new blog (Controller: `BlogController`, Method: `store`)
- **PUT blogs/{blog}** - Update a blog (Controller: `BlogController`, Method: `update`)
- **DELETE blogs/{blog}** - Delete a blog (Controller: `BlogController`, Method: `destroy`)
- **GET|HEAD blogs/{blog}** - Show a specific blog (Controller: `BlogController`, Method: `show`)
- **GET|HEAD blogs/{blog}/edit** - Edit a specific blog (Controller: `BlogController`, Method: `edit`)
- **GET|HEAD login** - User login page (Livewire component: `Login`)
- **POST logout** - User logout (Controller: `Auth\LoginController`, Method: `logout`)
- **GET|HEAD register** - User registration page (Livewire component: `Register`)
- **GET|HEAD users/create** - Form to create a new user (Livewire component: `CreateUser`)

## Controllers <a name="controllers"></a>

### BlogController (web)
- `create` - Display the form to create a new blog post.
- `store` - Store a new blog post.
- `edit` - Display the form to edit a blog post.
- `update` - Update a blog post.
- `show` - Show a specific blog post.
- `destroy` - Delete a blog post.

### BlogController (API)
- `index` - Fetch all blog posts.
- `store` - Create a new blog post.
- `show` - Fetch a specific blog post.
- `update` - Update a blog post.
- `destroy` - Delete a blog post.

### AuthController (API)
- `login` - User login.

## Livewire Components <a name="livewire-components"></a>

The following Livewire components are used in the project:

- `BlogList` - Display a list of all blogs.
- `BlogShow` - Display a specific blog.
- `BlogImport` - Form to import blogs.
- `CreateUser` - Form to create a new user.
- `Login` - User login form.
- `Register` - User registration form.

## Test Cases <a name="test-cases"></a>

The project includes test cases to ensure proper functionality. The test cases are organized into the following classes:

- `APITest` - Test cases for API endpoints.
- `BlogTest` - Test cases for blog functionality.
- `CommentTest` - Test cases for comment functionality.
- `UserTest` - Test cases for user functionality.

To run the test cases, open a terminal and navigate to the project directory. Then, run the following command:

```
php artisan test
```

The test cases will be executed, and the results will be displayed in the terminal.

## Database Migration and Seeding <a name="database-migration-and-seeding"></a>

The project uses Laravel's migration and seeding functionality to set up the database. The migrations are located in the `database/migrations` directory, and the seeders are located in the `database/seeders` directory.

To migrate the database tables, run the following command:

```
php artisan migrate
```

To seed the database with sample data, run the following command:

```
php artisan db:seed
```

These commands will set up the necessary tables and populate them with sample data.

Note: If you want to customize the seed data, you can modify the seeder files located in the `database/seeders` directory.

---
NB: Sample CV file added for upload testing

This documentation provides an overview of the project setup, routes, controllers, Livewire components, test cases, and database migration and seeding. Use this documentation as a reference to understand the project structure and to run the project and its associated test cases successfully.