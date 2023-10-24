
# Локальное развертывание

### 1) Установить Docker (Для windows также установить WSL2)
Windows: запускаем Docker Desktop. Запускаем wsl2 и выполняем команды.  
Linux: сразу выполняем команды в терминале

### 2) Устанавливаем дополнительное ПО:

* PHP 8.2
* composer 2
* nodeJS 18
* npm
* зависимости php:

    - php8.2-xml
    - php8.2-curl
    - php8.2-intl
    - php8.2-mbstring

### 3) Клонируем проект

```
git clone NAME https://github.com/AlexeyCamacho/storageApp.git
```

### 4) Устанавливаем зависимости

```
composer install
npm install
```

### 5) Создаём .env файл

```
cp .env.example .env
```

### 6) Заполняем .ENV файл

- DB_CONNECTION=mysql
- DB_HOST=mysql
- DB_PORT=3306
- DB_DATABASE=storageapp
- DB_USERNAME=sail
- DB_PASSWORD=password
- CACHE_DRIVER=redis

### 7) Генерируем ключ приложения
```
php artisan key:generate
```

### 8) Очищаем кеш
```
php artisan optimize:clear
```

### 9) Запускаем контейнер
```
./vendor/bin/sail up
```

### 10) Выполняем миграции
```
./vendor/bin/sail artisan migrate
```
### 11) Заполняем базу начальными данными
```
./vendor/bin/sail artisan db:seed --class=RoomSeeder
```
### 12) Собираем Frontend
```
npm run build
или
npm run dev
```

WebServer: localhost  
PhpMyAdmin: localhost:8080
