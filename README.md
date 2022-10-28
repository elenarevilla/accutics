# Accutics Code Challenge

## Aliases

In order to ease development, ensure you have following Aliases setup
```shell
alias sail="./vendor/bin/sail"
alias phpunit="./vendor/bin/phpunit"
```
## Installation
Copy over `.env` file and populate it with your environment's variables. You will also want to verify/change a few variables for your environment.
```
cp -p .env.example .env
```

Install composer dependencies by running:

```shell
docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    /bin/bash -c \
    "composer self-update; composer install"
```

Run sail containers:
```shell
sail up -d
```

Generate the app key by running:
```shell
sail artisan key:generate
```

## Usage

### With Sail

This project supports [Laravel Sail](https://laravel.com/docs/8.x/sail) as a local development environment.

To get started, simply run `sail up -d` and the application will be served on [`http://localhost`](http://localhost)

To run artisan commands, simply run `sail artisan migrate`

To run compose commands, simply run `sail composer install`

Stop the application by running `sail down`

[Read more about how to use Laravel Sail in the official documentation here](https://laravel.com/docs/8.x/sail)

## Documentation

### Campaigns

Available endpoints for campaigns

#### Get campaigns

```
[GET] http://localhost/api/campaigns?page=1&per_page=20&sort_column=created_at&sort_order=asc
```

Optional parameters:
- page
- per_page
- sort_column
- sort_order

#### Create campaign

```
[POST] http://localhost/api/campaigns 

{
	"name": "Hello World Campaign",
	"author_id": "a42bad6c-6361-37f5-bcfe-56624074be60",
	"inputs": [
		{
			"type" : "channel",
			"value": "102"
		},
		{
			"type" : "source",
			"value": "105"
		}
	]
}
```

Required parameters:
- name
- author_id

Optional parameters:
- inputs

### Users

Available endpoints for users. Users are static

#### Get users
```
[GET] http://localhost/api/users?username=john
```

Optional filtering parameters:
- username
- email

## Testing
You can find tests in the `/tests` folder, and you can run them by using `sail artisan test`.
