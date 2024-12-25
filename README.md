
<p style="text-align: center;"><img src="public/assets/images/core/logo.svg"  width="300"></p>

# Lumo

Lumo is a simple boilerplate for building Laravel applications. It comes with...

- Laravel 11
- TailwindCSS
- Livewire
- Breeze authentication
- FlyonUI components

## Installation

Clone the project

```bash
git clone git@github.com:angus-boilerplates/Lumo.git
```

Go to the project directory

```bash
cd Lumo
```

## Laravel sail

If you plan to develop using [Laravel Sail](https://laravel.com/docs/11.x/sail) you can follow these instructions.

> Ensure you have Docker installed on your system
### Install composer dependencies

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

### Generate a `.env` file

```bash
cp .env.example .env
```

### Add the `sail` alias to your shell

Open your `.bashrc` or `.zshrc` file and add the following alias

```
alias sail="./vendor/bin/sail"
```

### Start the development server

```bash
sail up
```

> This will launch the compose project, new commands will need to be executed in a new terminal window.

### Generate an application key

```bash
sail artisan key:generate
```

### Migration and seed the database

```bash
sail artisan migrate --seed
```

### Install NPM dependencies

```bash
sail npm install
```

### Start the VITE development server

```bash
sail npm run dev
```

### Visit the application

Visit the application in your browser at [http://localhost](http://localhost)

## Dockerize the app

This app can be dockerized for deployment and testing in CI/CD pipelines.

### Production

The production image builds a production ready docker container with all the required services such as nginx, php-fpm etc.

#### Build the image
```bash
docker build --target prod -t lumo-prod-image .
```

#### Run the image

Running the production image requires the container to have access to environment variables, these can be passed in using the `-e` flag.

Below is an example of running the container with the required environment variables.

```bash
docker run -d -p 9000:80 --name lumo \
    -e APP_NAME=Lumo \
    -e APP_ENV=production \
    -e APP_KEY=base64:NHZpNnVnM2p0b2VmZnV6MDN1ZDJmeWt1bDJpemlxeDA= \
    -e DB_CONNECTION=PUT_DB_CONNECTION_HERE \
    lumo-prod-image
```


### Testing

The test image builds a container that is optimized for running tests, the entrypoint is set to run the tests and exit when complete.

#### Build the image

```bash
docker build --target test -t lumo-test-image .
```

#### Run the image

Unlike the production image, the test image has environment variabes baked into the Dockerfile. So to run the tests you can simply run the image.

```bash
docker run --name lumo-tests lumo-test-image
```


## Setting up PHPStorm php interpreter

If you are using PHPStorm you can set up the PHP interpreter to use the Laravel Sail container.

1. Go to `Settings` > `PHP` > `Test Frameworks`
2. Click on `+` and select `PHPUnit by Remote Interpreter`
3. Click on `...` next to "CLI Interpreter"
4. Click on `+` and select `From Docker, Vagrant, VM, WSL, Remote...`
5. Select `Docker Compose`
6. Select `Service` as `laravel.test`
7. Click Apply and OK
8. In the `PHHPUnit Library` section ensure the "Path to script" is set to `/var/www/html/vendor/autoload.php`
9. Click Apply and OK

## Setting up PHPStorm Xdebug

To be able to debug your application in PHPStorm you will need to set up Xdebug configuration in your `.env` file.

1. Ensure the `SAIL_XDEBUG_MODE=develop,debug,coverage` is set in the `.env` file

## Authors

- [@angusgoody](https://github.com/angusgoody)




