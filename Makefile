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
	chown -R $(whoami):$(whoami) ~/.docker
	sudo chmod -R 777 ~/.docker
	docker-compose run --rm --entrypoint="" composer composer clear-cache
	docker-compose run --rm --entrypoint="" composer composer install
	docker-compose run --rm node npm cache clean --force
	docker-compose run --rm node npm install
	docker-compose up -d nginx
	@echo "Build version 1.1"
	@echo "Waiting for MySQL to be ready..."
	sleep 10
	docker-compose run --rm artisan migrate
	docker-compose run --rm artisan db:seed --class=SeatsSeeder
	docker-compose run --rm artisan db:seed --class=AirportsSeeder
	docker-compose run --rm artisan db:seed --class=AircraftsSeeder
	docker-compose run --rm artisan db:seed --class=AircompanySeeder
	
nginx-restart:
	docker-compose down
	docker-compose up -d nginx
	
	



