# Waterdwags

## Considerations on Laravel
Without having any Laravel knowledge this application was a mix of 70% learning and 30% coding. The Lumen project I worked 2 years ago was of no use as the framework changed a lot since then.  

## Considerations on running the application
The application is built on top of the default Laravel project that is created by default via composer. I did not clean it up not to risk clearing more code than necessary, hence the initial code is still in.

To observe that the app is indeed deferring the persistence step run a few /adddog requests and then call /listdogs. None or less than the added dogs should be returned. The persistence delay is controlled by the **SIMULATION__DB_LONG_PROCESS_TIME_IN_SECONDS** environment variable.
 
## Requirements
- Docker
- Docker-compose

## Installation
To install the application follow the **Install** step. This step runs a fresh Artisan migration clearing up the database.  
Subsequent usages can simply follow the **Start** step which only makes sure that composer dependencies and migrations are all up to date.
To stop the application use the **Stop** instructions.

For other cases use docker-compose and docker commands not detailed here.

## Usage
Use the Postman collection to access some usage examples to add and list the dogs

### Install
    make install
- Brings up the Docker containers (webserver, application and database) and forces an image build step
- Installs composer dependencies
- Runs a ***fresh*** Artisan migration

### Start
    make start
- Starts containers without a forced build
- Installs composer dependencies
- Runs an Artisan migration

### Stop
    make stop
- Brings down the Docker containers

### Setup
    make setup
- Installs composer dependencies
- Runs an Artisan migration
