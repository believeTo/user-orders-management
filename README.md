# Система учета пользователей и заказов

## Установка за 3 минуты:

### 1. База данных
```sql
CREATE DATABASE test_db;
```

### 2. Конфигурация
```bash
cp App/config/Config.example.php App/config/Config.php
# Отредактируйте Config.php (укажите данные БД)
```

### 3. Установка
```bash
composer install
php console migrate
php console seed
```

Или через браузер: `http://ваш-домен/setup.php`

## Использование:
Откройте: `http://ваш-домен/`