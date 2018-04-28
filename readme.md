# Larticles Laravel/Vue App

> Laravel 5.5 API that uses the API resources with a Vue.js frontend

## Quick Start

``` bash
# Install Dependencies
composer install

# Run Migrations
php artisan migrate

# Import Data
php artisan db:seed

# Add virtual host if using Apache

# If you get an error about an encryption key
php artisan key:generate

# Install JS Dependencies
npm install

# Watch Files
npm run watch
```

# Set Path for Application in app.js

if you are using sub directory than you need to set path for AppURL and StorageUrl in app.js

## Endpoints

### List all User with links and meta
``` bash
GET api/usersdetails
```
### Get User details
``` bash
GET api/usersdetails/{id}
```

### Delete User
``` bash
DELETE api/usersdetails/{id}
```

### Add User
``` bash
POST api/usersdetails
```

### Update User
``` bash
PUT api/usersdetails

```


```

## App Info

### Author

Vishant Goswami

### Version

1.0.0

### License

This project is licensed under the MIT License
