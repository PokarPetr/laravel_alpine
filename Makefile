create-laravel:
	docker-compose run --rm composer create-project laravel/laravel .

nginxup:
	docker-compose up -d nginx

nginxdown:
	docker-compose down

artisan-migrate:
	docker-compose run --rm artisan migrate
	
artisan-db-seed:
	docker-compose run --rm artisan db:seed

start-install:
	mkdir -p ./src/storage/framework/views
	mkdir -p ./src/storage/framework/sessions
	mkdir -p ./src/storage/framework/cache	
	chown -R $(whoami):$(whoami) ./src/storage
	chmod -R 777 ./src/storage
	docker-compose run --rm composer install
	docker-compose run --rm node npm install
	docker-compose up -d nginx
	docker-compose run --rm artisan migrate
	docker-compose run --rm artisan db:seed --class=SeatsSeeder
	docker-compose run --rm artisan db:seed --class=AirportsSeeder
	docker-compose run --rm artisan db:seed --class=AircraftsSeeder
	docker-compose run --rm artisan db:seed --class=AircompanySeeder
	
nginx-restart:
	docker-compose down
	docker-compose up -d nginx
	
	



