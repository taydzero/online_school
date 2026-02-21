# Инструкция по запуску проекта

Проект полностью контейнеризирован с использованием Docker. Для запуска не требуется установленный PHP или Node.js на хостовой машине.

## Требования
*   Docker
*   Docker Compose

## Запуск проекта

1.  **Сборка и запуск контейнеров:**
    В корне проекта выполните команду:
    ```bash
    docker-compose up -d --build
    ```

2.  **Настройка окружения (только при первом запуске):**
    Установите зависимости, создайте ключи и выполните миграции:
    ```bash
    # Установка PHP зависимостей
    docker-compose exec app composer install

    # Генерация ключа приложения
    docker-compose exec app php artisan key:generate

    # Создание символьной ссылки для хранилища (фото курсов)
    docker-compose exec app php artisan storage:link

    # Выполнение миграций и создание админа
    docker-compose exec app php artisan migrate:fresh --seed

    # Сборка фронтенда (CSS/JS)
    docker-compose exec app npm install
    docker-compose exec app npm run build
    ```

3.  **Права доступа (для Linux/WSL):**
    Если возникнут проблемы с записью логов или загрузкой фото:
    ```bash
    chmod -R 777 .
    ```

## Доступ к проекту
*   **Главная страница:** [http://localhost](http://localhost)
*   **Админ-панель:** [http://localhost/course-admin](http://localhost/course-admin) (Логин: `admin@edu.com`, Пароль: `course2025`)
*   **API:** [http://localhost/school-api](http://localhost/school-api)

## Остановка проекта
```bash
docker-compose down
```

