# The default environment file
ENVIRONMENT_FILE=$(shell pwd)/.env

# The default project directory
PROJECT_DIRECTORY=$(shell pwd)

build-and-up: build up composer-install check-env
 	- docker-compose -f docker-compose.yml exec blog php artisan optimize:clear

build:
	- docker-compose -f docker-compose.yml build && docker-compose -f docker-compose.yml pull

up:
	- docker-compose -f docker-compose.yml up -d

down:
	- docker-compose -f docker-compose.yml down

composer-install:
	- docker-compose -f docker-compose.yml exec blog composer install

clean-dependencies:
	- rm -rf vendor

check-env:
ifeq (,$(wildcard ./.env))
	cp .env.example .env
endif

pint-test:
	- docker-compose -f docker-compose.yml exec blog vendor/bin/pint --test --dirty --config pint.json

pint:
	- docker-compose -f docker-compose.yml exec blog vendor/bin/pint --config pint.json
