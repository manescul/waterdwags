install: --up --setup-fresh

start: --up setup

stop: --down

setup: --composer-install --artisan-migrate

--setup-fresh: composer-install artisan-migrate-fresh

--up:
	docker-compose up -d

--down:
	docker-compose down

--composer-install:
	docker exec waterdwags_app bash -c "composer install"

--artisan-migrate:
	docker exec waterdwags_app bash -c "php artisan migrate"

--artisan-migrate-fresh:
	docker exec waterdwags_app bash -c "php artisan migrate:fresh"
