# REST API Документация

Все запросы к API должны содержать заголовок `Accept: application/json`. Для защищенных эндпоинтов требуется заголовок `Authorization: Bearer {token}`.

Базовый URL: `http://localhost/school-api`

## 1. Регистрация студента
**URL:** `/registr`  
**Метод:** `POST`

**Пример запроса:**
```bash
curl -X POST http://localhost/school-api/registr \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{
        "email": "student@example.com",
        "password": "Password123!"
     }'
```

## 2. Авторизация (Получение токена)
**URL:** `/auth`  
**Метод:** `POST`

**Пример запроса:**
```bash
curl -X POST http://localhost/school-api/auth \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -d '{
        "email": "student@example.com",
        "password": "Password123!"
     }'
```
*В ответе придет `token`, который нужно использовать для следующих запросов.*

## 3. Список курсов (с пагинацией)
**URL:** `/courses`  
**Метод:** `GET`

**Пример запроса:**
```bash
curl -X GET http://localhost/school-api/courses \
     -H "Authorization: Bearer {ВАШ_ТОКЕН}" \
     -H "Accept: application/json"
```

## 4. Уроки конкретного курса
**URL:** `/courses/{course_id}`  
**Метод:** `GET`

**Пример запроса:**
```bash
curl -X GET http://localhost/school-api/courses/1 \
     -H "Authorization: Bearer {ВАШ_ТОКЕН}" \
     -H "Accept: application/json"
```

## 5. Запись на курс
**URL:** `/courses/{course_id}/buy`  
**Метод:** `POST`

**Пример запроса:**
```bash
curl -X POST http://localhost/school-api/courses/1/buy \
     -H "Authorization: Bearer {ВАШ_ТОКЕН}" \
     -H "Accept: application/json"
```

## 6. Мои курсы (Записи)
**URL:** `/orders`  
**Метод:** `GET`

**Пример запроса:**
```bash
curl -X GET http://localhost/school-api/orders \
     -H "Authorization: Bearer {ВАШ_ТОКЕН}" \
     -H "Accept: application/json"
```

## 7. Отмена записи
**URL:** `/orders/{enrollment_id}`  
**Метод:** `GET`

**Пример запроса:**
```bash
curl -X GET http://localhost/school-api/orders/1 \
     -H "Authorization: Bearer {ВАШ_ТОКЕН}" \
     -H "Accept: application/json"
```

