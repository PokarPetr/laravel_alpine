# Laravel Hello

This project is an example Laravel application set up to work with Nginx, MySQL, and PHP.

## Requirements

Before getting started, make sure you have the following tools installed:

- Docker
- Docker Compose
- Make (for executing commands)

## Installation and Setup

1. **Pull the Docker image:**

    If you haven't cloned the repository from Docker Hub yet, run the following command:

    ```bash
    docker pull pokarpetrdeveloper/laravel_hello
    ```

2. **Start the containers using Make:**

    In the project root directory, execute the command:

    ```bash
    make nginxup
    ```

    This command will start the Nginx, MySQL, and PHP containers. Make sure that the `Makefile` is present in the project root and is configured to run containers via `docker-compose`.

		**If you don’t have `make` installed**, you can run the following command instead:

		 ```bash
		 sudo docker-compose up -d nginx
		 ```


3. **Run database migrations:**

    To run Laravel database migrations, execute:

    ```bash
    make artisan-migrate
    ```

		OR

		```bash
    sudo docker-compose run --rm artisan migrate
    ```

    This command will run the `php artisan migrate` command to perform database migrations.

4. **Seed database :**

    To seed the database with primary data, execute:

    ```bash
    make artisan-db-seed
    ```

		OR

		```bash
    sudo docker-compose run --rm artisan db:seed
    ```

    This command will populate the database with data using the seeders.

5. **Fix permissions for the `storage` directory:**

    If you encounter permission issues with the `storage` directory (for example, if Laravel can't write to `storage`), execute the following command:

    ```bash
    sudo chmod 777 -R ./src/storage
    ```

    This command will set the appropriate permissions for the `storage` folder to allow writing.

6. **Access the application:**

    After the containers are up and running, the application will be available at:

    ```bash
    http://localhost:8085
    ```

    You can navigate to this URL in your browser to access the application.

## Stopping the Containers

To stop the containers, run:

```bash
make nginxdown
```


# Laravel Hello

Этот проект — пример приложения на Laravel, настроенный для работы с Nginx, MySQL и PHP.

## Требования

Перед тем как начать, убедитесь, что у вас установлены следующие инструменты:

- Docker
- Docker Compose
- Make (для выполнения команд)

## Установка и запуск

1. **Клонируйте репозиторий:**

    Если вы еще не клонировали репозиторий с Docker Hub, выполните команду:

    ```bash
    docker pull pokarpetrdeveloper/laravel_hello
    ```

2. **Запуск контейнеров с помощью Make:**

    В корне проекта выполните команду:

    ```bash
    make nginxup
    ```

    Эта команда поднимет контейнеры для Nginx, MySQL и PHP. Убедитесь, что файл `Makefile` присутствует в корне проекта и настроен для запуска контейнеров через `docker-compose`.

	*Если `make` не установлен**, используйте:

		 ```bash
		 sudo docker-compose up -d nginx
		 ```

3. **Выполнение миграции базы данных:**

    Для выполнения миграций Laravel выполните команду:

    ```bash
    make artisan-migrate
    ```

		или

		```bash
    sudo docker-compose run --rm artisan migrate
    ```

    Эта команда запускает миграции базы данных с использованием `php artisan migrate`.
4. **Наполнение базы данных первичными данными :**

    Для наполнения базы данных выполните команду:

    ```bash
    make artisan-db-seed
    ```

		OR

		```bash
    sudo docker-compose run --rm artisan db:seed
    ```

    Эта команда запускает сидеры для наполнения базы данных.

5. **Исправление прав на директорию `storage`:**

    В случае возникновения проблем с правами на директории (например, если Laravel не может записывать в `storage`), выполните следующую команду:

    ```bash
    sudo chmod 777 -R ./src/storage
    ```

    Эта команда установит необходимые права на папку `storage` для записи файлов.

6. **Доступ к приложению:**

    После того, как контейнеры запустятся, приложение будет доступно по следующему адресу:

    ```bash
    http://localhost:8085
    ```

    Вы можете перейти по этому адресу в браузере для доступа к вашему приложению.

## Остановка контейнеров

Чтобы остановить контейнеры, выполните:

```bash
make nginxdown
