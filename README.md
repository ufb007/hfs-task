# HFS task

## Technologies Used
 - Laravel Framework as API endpoint
 - Laravel/Sail setup
 - MySQL Database integration
 - Vue 3 for Front End Single Page Application (SPA) (Template: Vue Notus by Creative Tim)

## Installation

There are a few things need to install before starting up servers:

### Create environment file

Copy `.env.example` file and change to `.env` on document root

### Install composer dependencies

Navigate to folder and in command line:
```
composer install
```

#### Migrate database
Run command to migrate the database from the document root. This would need to be done using Laravel Artisan Sail method.

```
./vender/bin/sail artisan migrate
```

#### Seed Database
Many ready made examples that will be available to view.
```
./vender/bin/sail artisan db:seed
```

### Install Node packages
Go into the folder `/front-end` and run the `npm install` command.
```
npm install
```

## Run docker containers

One command to do it all (detached mode activated).

```
docker-compose up -d
```
or
```
./vender/bin/sail up -d
```

The backend API runs on the port `8081`

```
http://localhost:8081
```

This may take a little while as it installs the docker images and sets up server containers for Backend, Frontend and the MySQL server. This will also start up the front end service (npm run serve) within the container.

### Access application from browser
This opens up port `3000`;

```
http://localhost:3000
```

You should be directed to the page `http://localhost:3000/topics/categories`.