# Laravel Hello

This project is an example Laravel application set up to work with Nginx, MySQL, and PHP.

## Requirements

Before getting started, make sure you have the following tools installed:

- Docker
- Docker Compose
- Make

## Installation and Setup

1. **Check if Docker and Docker Compose are installed:**

   Ensure that Docker and Docker Compose are installed on your machine.

2. **Clone the repository:**

   Clone this GitHub repository to your local machine.

3. **Navigate to the project folder:**

   Go to the project directory:

   ```bash
   cd laravel_alpine
   ```
4. **Run the installation command using Make:**

    Run the following command to install and set up everything:

    ```bash
   make start-install

    ```

   If you don’t have make installed, you can run the following commands manually:

   ```bash
        mkdir -p ./src/storage/framework/views
        mkdir -p ./src/storage/framework/sessions
        mkdir -p ./src/storage/framework/cache
        chown -R $(whoami):$(whoami) ./src/storage
        chmod -R 777 ./src/storage
        docker-compose run --rm composer install
        docker-compose up -d nginx
        docker-compose run --rm artisan migrate
        docker-compose run --rm artisan db:seed --class=SeatsSeeder
        docker-compose run --rm artisan db:seed --class=AirportsSeeder
        docker-compose run --rm artisan db:seed --class=AircraftsSeeder
    ```

5. **Access the application:**

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

1. ## Проверьте наличие установленных Docker и Docker Compose:

    Убедитесь, что Docker и Docker Compose установлены на вашей машине.

2. ## Клонируйте репозиторий:

    Клонируйте этот репозиторий с GitHub на вашу локальную машину.

3. ## Перейдите в папку проекта:

    Перейдите в папку проекта:

     ```bash
   cd laravel_alpine
    ```
4. ## Запустите команду установки с помощью Make:

    Выполните следующую команду для установки и настройки всего:

    ```bash
   make start-install

    ```
    Если утилита make не установлена, выполните команды вручную:

    ```bash
        mkdir -p ./src/storage/framework/views
        mkdir -p ./src/storage/framework/sessions
        mkdir -p ./src/storage/framework/cache
        chown -R $(whoami):$(whoami) ./src/storage
        chmod -R 777 ./src/storage
        docker-compose run --rm composer install
        docker-compose up -d nginx
        docker-compose run --rm artisan migrate
        docker-compose run --rm artisan db:seed --class=SeatsSeeder
        docker-compose run --rm artisan db:seed --class=AirportsSeeder
        docker-compose run --rm artisan db:seed --class=AircraftsSeeder
    ```

5. **Доступ к приложению:**

    После того, как контейнеры запустятся, приложение будет доступно по следующему адресу:

    ```bash
    http://localhost:8085
    ```

    Вы можете перейти по этому адресу в браузере для доступа к вашему приложению.

## Остановка контейнеров

    Чтобы остановить контейнеры, выполните:

    ```bash
    make nginxdown
    ```
