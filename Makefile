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
