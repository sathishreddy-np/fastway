# Fastway

This repository contains the source code for the Fastway project.

## Installation

```shell
# Clone the repository
git clone https://github.com/sathishreddy-np/fastway.git

# Navigate to the project directory
cd fastway

# Copy the .env.example file to .env
cp .env.example .env

# Open the .env file and make the following changes:
# - DB_DATABASE=fastway
# - DB_USERNAME=Your MySQL username
# - DB_PASSWORD=Your MySQL password

# Install project dependencies using Composer
composer install

# Generate an application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Execute the store:coingecko command
php artisan store:coingecko
