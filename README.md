# Quick Deal Test
____

## Краткое описание
Тестовое Api для QuickDeal. Под капотом laravel v.9.0 + postgreSQL. В качестве сервера использован octane/openswoole, прокси - traefik. Все миграции и установка composer выполняются автоматически.

## Подготовка перед запуском:
1. Создание файла конфигурации в корне проекта. **Необходимо указать свои значения во все защищенные поля. Например: API_APP_KEY**
```
cp .env .env.common
```
2. Запуск и сборка контейнеров:
```
docker-compose up -d --build
```


## Доступные консоли инструментов:
 - traefik [http://traefik.localhost]
 - pgadmin [http://pgadmin.localhost]

## Тестовые данные для pgadmin:
- PGADMIN_EMAIL=test@gmail.com 
- PGADMIN_PASSWORD=password
