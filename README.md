Hello Lehman Black! Thank you for considering joining the Lawline team. Below is a coding exercise that will allow you
to highlight your skills.

You have up to 48 hours to submit, however, we respect your time and expect this to only take a few hours. Please make
commits reguarly so we can track your progress.

### Getting Started

1. Fork the [code challenge](https://github.com/furthered/code-test) repository on Github
2. Run composer install
3. Perform the configuration for a [fresh install of Laravel](https://laravel.com/docs/7.x)
4. Update the first line of this README with your name (so that it reads "Hello, YOUR NAME!"). Commit this change. This
will serve as a starting timestamp.
5. Complete the exercise below.
6. Commit progress regularly.
7. When your're done, upload your code.
8. Email James [james.terrono@furthered.com](mailto:james.terrono@furthered.com) with any questions/issues

### Requirements

- You have up to 48 hours to submit.
- Create a simple RESTful API written in Laravel/PHP.
    - All responses should be JSON
    - All requests should be JSON
- **Bonus:** UI Interface implemented in a JS Framework

## The Exercise

The exercise consists of **users**, **subscriptions** and **products**. A user will have the ability to add & remove
products within their account. A user must have an active subscription to add a product to their account.

#### Users

Each user must have, but is not limited to:

- ID
- First Name
- Last Name
- Email (unique)

**Please note:**

- These users are the only users that are able to make requests via the API.
- User creation/maintenance is not done through the API (see Database section below).
- Users can own many products

#### Products

Each product must have, but is not limited to:

- ID
- Name
- Description
- Price
- Image

#### Database

- MySQL
- All tables in the database must be created programatically
- The user table should be seeded with at least five users

#### Authentication

You must implement an authentication system so that the API knows which of the users is making the request. All requests should ensure that an authorized user is making the request. In the event of an unauthorized user, an error should be thrown.

#### Requests

The following requests should be implemented:

- Add product
    - All fields required except ID and image
- Update product
    - All fields required except image
- Delete product
- Get product
- Upload product image
- Get list of all products
- Attach product to requesting user
- Remove product from requesting user
- List products attached to requesting user

#### Tests

You must write tests to back up your code. You are free to use any testing tools or frameworks you like.

### UI (Bonus)

Create a simple ui interface, written in your favorite JS Framework (Preferred: VueJS) for a user to

- Authenticate
- View all avaliable products
- Add/Remove products


## Completion

When you are finished you will push up the application to a personal git repo. Then please notify James via email
[james.terrono@furthered.com](mailto:james.terrono@furthered.com?subject=Lawline%20Code%20Challenge) with the subject Lawline Code Challenge and the link to the github repo. Please include:

- Instructions on how to create and seed database tables
- Instructions on how authentication works
- Instructions on how to compile assets (if anything)
- Anything else you think James should know to run the application (if anything)

James is available for any questions you may have via email at james.terrono@furthered.com.

![Good Luck](http://www.reactiongifs.us/wp-content/uploads/2014/01/good_luck_morgan_freeman.gif)

## Evaluating

### Setup
* clone the git repo
* run `compoesr install`
    * if an error occurs about needing laravel/ui run `composer update`
* create a `.env` with the appropriate database information
    * I typically run MySQL through docker: `docker run --name code-test-db -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=laravel -p3306:3306  mysql:5.7`
* run the following to complete laravel install
```
php artisan key:generate
php artisan migrate
php artisan db:seed

# Fixes uploaded files not showing up
php artisan storage:link

npm install
npm run dev
```
* the app is now able to be started using `php artisan serve`

### Authentication
The API is secured using the `auth.basic` middleware. API tokens are typically preferred, but using
HTTP basic auth allowed for a quicker start with the rest of development. Basic auth doesn't require
the extra User infomation and database setup.

One disadvantage of using the `auth.basic` middleware is that you will get prompted by the browser
for your login information again after you submit the login form.

User roles and permissions are not implemented so the product creation form is accessible to any
logged in user.


### Making API Requests
The main application uses most of the API routes for all resources, but you can use `curl` to test
the endpoints manually.

The products API is built using Laravel's Resource controllers and follows those conventions for
CRUD operations.

Additionally we have some custom routes to access user specific product information. (`/api/products/mine`).
The full list of supported routes can be viewed by running `php artisan route:list`

The database is seeded with 5 users, but you can use the following credentials to make requests

```
user: jsmith@example.com
pass: qwerty
```

Here are some examples

```
# list products
curl -vvv -L -XGET -u 'jsmith@example.com:qwerty' -H "Content-Type: application/json" 'http://localhost:8000/api/products'
```

```
# show products
curl -vvv -L -XGET -u 'jsmith@example.com:qwerty' -H "Content-Type: application/json" 'http://localhost:8000/api/products/1'
```

```
# create a product without an image
curl -vvv -L -XPOST -u 'jsmith@example.com:qwerty' -H "Content-Type: application/json" 'http://localhost:8000/api/products' -d '{"name":"Example Product","description":"This is created with curl","price":12.34}'
```

```
# update a product without an image
curl -vvv -L -XPOST -u 'jsmith@example.com:qwerty' -H "Content-Type: application/json" 'http://localhost:8000/api/products' -d '{"name":"Example Updated Product","description":"This is updated with curl","price":9.99}'
```

```
# delete a product
curl -vvv -L -XDELETE -u 'jsmith@example.com:qwerty' -H "Content-Type: application/json" 'http://localhost:8000/api/products/1'
```

### Unit Testing
Tests for the `ProductsController` are in the `tests/Unit/API`.

Use `php artisan test` to run the tests.

Tests for `MyProductsController` were skipped due to time contraints and the fact that they would
be basically the same as `ProductsController` tests.

No tests exists for the frontend Vue code, but I am familiar with testing using `jest` with React.

### Frontend

The application can be accessed from [http://localhost:8000](http://localhost:8000)

You will need to click the login button in the top right to take you to the page with all of
the products.

The Profile, My Products, and Products sections are all populated using API requests. Each of these
sections use custom Vue components.

None of the users are seeded with products, so the My Products section will be empty until you
add products.

### Adding products

The create product form can be found at [/api/products/create](http://localhost:8000/api/products/create).

I have included a sample image that you can use in the `public/images` folder. Uploaded images are in `storage/app/images`
