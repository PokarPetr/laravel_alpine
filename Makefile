create-laravel:
	sudo docker-compose run --rm composer create-project laravel/laravel .

nginxup:
	sudo docker-compose up -d nginx

nginxdown:
	sudo docker-compose down

artisan-migrate:
	sudo docker-compose run --rm artisan migrate
