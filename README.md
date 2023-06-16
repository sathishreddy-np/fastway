# Fastway

This repository contains the source code for the Fastway project by SATHISH KUMAR REDDY NUKA PAPU GARI.

## Installation

```shell
# Clone the repository
git clone https://github.com/sathishreddy-np/fastway.git

# Navigate to the project directory
cd fastway

# Copy the .env.example file to .env  in Linux Systems
cp .env.example .env
```

## Configuration

Open the `.env` file and update the following environment variables:

| Variable        | Value                   |
|-----------------|-------------------------|
| DB_DATABASE     | fastway                 |
| DB_USERNAME     | Your MySQL username     |
| DB_PASSWORD     | Your MySQL password     |

Make sure to replace `Your MySQL username` and `Your MySQL password` with the appropriate values for your MySQL database configuration.

```shell
# Install project dependencies using Composer
composer install

# Generate an application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Execute the store:coingecko command
php artisan store:coingecko
```


```shell
# Database schema migration file names
2023_06_16_135314_create_bitcoins_table.php
2023_06_16_171106_create_bit_tokens_table.php
```

```shell
# Laravel Artisan Command File Name
Coingecko.php
```

