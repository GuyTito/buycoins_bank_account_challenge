A simple app to verify a user using their bank account. This is an answer to an engineering challenge by [Buycoins](https://buycoins.africa/). This is the [link](https://buycoins.notion.site/Buycoins-Engineering-Challenge-a906753db59d4bf28fcd127798eadba7) to the challenge. In case the link does not work, I saved a copy of the webpage as a pdf in the root folder of this project.



## Requirements
* PHP 7.4+
* MySQL
* Composer
* NPM

# Installation
## Clone the repo and cd into project
```
git clone https://github.com/GuyTito/buycoins_bank_account_challenge.git
cd buycoins_bank_account_challenge
```

## Install dependencies
```
composer install
```

## Create .env
```
copy .env.example .env
```

## Generate app encryption key
```
php artisan key:generate
```

## Set correct App url in .env
```
APP_URL=http://localhost:8000
```

## Create an empty database and Set correct database credentials
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=buycoins_bank_account_challenge
DB_USERNAME=root
DB_PASSWORD=
```

## Migrate database
```
php artisan migrate
```

## Run server
```
php artisan serve
```

## Visit the url
http://localhost:8000

