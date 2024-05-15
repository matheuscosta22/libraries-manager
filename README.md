LIBRARIES MANAGER:

After cloning the project, you need to follow these steps:

- Copy and use the .env.example file as .env

Install Composer dependencies
```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

The project is using SAIL (https://laravel.com/docs/11.x/sail), below are the main commands:


- To upload the project containers
    ```sh
    ./vendor/bin/sail up -d
    ```
- To bring down
  ```sh
    ./vendor/bin/sail up -d
    ```
- Access container
  ```sh
    ./vendor/bin/sail shell
    ```
------------------------------------
If everything is correct, you can now interact with the REST API via port 80 in your local environment. There is already a user to log in email: admin@gmail.com, password: password

The routes are :

LOGIN:

POST api/login

DELETE api/logout

--------------------------------------
BOOK CRUD:

GET api/books

POST api/books

GET api/books/{book}

PUT api/books/{book}

DELETE api/books/{book}


--------------------------------------
GET STORE BOOKS AVAILABLE:

GET api/books/available/{store}

--------------------------------------
STORE CRUD:

GET api/stores

POST api/stores

GET api/stores/{store}

PUT api/stores/{store}

DELETE api/stores/{store}

--------------------------------------

STORE BOOK:

POST api/stores

DELETE api/stores/{store}
