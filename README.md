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

Example Response: 
```
{
	"current_page": 1,
	"data": [
		{
			"id": 1,
			"name": "Ms World Campaign",
			"code": "MX-150022",
			"author_id": "a42bad6c-6361-37f5-bcfe-56624074be60",
			"created_at": "2022-10-28T19:46:25.000000Z",
			"updated_at": "2022-10-28T19:46:25.000000Z",
			"inputs": [
				{
					"id": 1,
					"campaign_id": 1,
					"type": "channel",
					"value": "102",
					"created_at": "2022-10-28T19:46:25.000000Z",
					"updated_at": "2022-10-28T19:46:25.000000Z"
				},
				{
					"id": 2,
					"campaign_id": 1,
					"type": "source",
					"value": "105",
					"created_at": "2022-10-28T19:46:25.000000Z",
					"updated_at": "2022-10-28T19:46:25.000000Z"
				}
			]
		}
	],
	"first_page_url": "http:\/\/localhost\/api\/campaigns?page=1",
	"from": 1,
	"next_page_url": null,
	"path": "http:\/\/localhost\/api\/campaigns",
	"per_page": "20",
	"prev_page_url": null,
	"to": 1
}
```

#### Create campaign

```
[POST] http://localhost/api/campaigns 

{
	"name": "Hello World Campaign",
	"author_id": "a42bad6c-6361-37f5-bcfe-56624074be60",
	"code": "MX-150022",
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
- code

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

Example Response:

```
[
	{
		"id": "a42bad6c-6361-37f5-bcfe-56624074be60",
		"name": "John Doe",
		"username": "johndoe",
		"email": "johndoe@test.com",
		"campaigns": [
			{
				"id": 1,
				"name": "Ms World Campaign",
				"code": "MX-150022",
				"author_id": "a42bad6c-6361-37f5-bcfe-56624074be60",
				"created_at": "2022-10-28T19:46:25.000000Z",
				"updated_at": "2022-10-28T19:46:25.000000Z",
				"inputs": [
					{
						"id": 1,
						"campaign_id": 1,
						"type": "channel",
						"value": "102",
						"created_at": "2022-10-28T19:46:25.000000Z",
						"updated_at": "2022-10-28T19:46:25.000000Z"
					},
					{
						"id": 2,
						"campaign_id": 1,
						"type": "source",
						"value": "105",
						"created_at": "2022-10-28T19:46:25.000000Z",
						"updated_at": "2022-10-28T19:46:25.000000Z"
					}
				]
			}
		]
	}
]
```

## Testing
You can find tests in the `/tests` folder, and you can run them by using `sail artisan test`.
