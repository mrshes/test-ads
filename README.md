# Тестовое задание
### Дата выполнения: **24.07.2022**
### Используемый стек:
- [Laravel 9.x](https://laravel.com/)
- [Vue.js](https://vuejs.org/) + [Vuetify](https://vuetifyjs.com/en/) (в качестве фронтенд Фреймворк)

- Php 8.1
- MySql 8.0 (в качастве базы данных)

### Для запуска *back-end*:
> 1. composer install
> 2. php artisan passport:keys
> 3. php artisan passport:client --personal
> 4. php artisan migrate
> 5. php artisan storage:link

### Для запуска *front-end*:
> 1. npm install
> 2. npm run dev

# Текст задания:

Доска объявлений

Laravel + Nuxt

Laravel работает в качестве api, используем роуты /api/...

Функционал:
1. Регистрация/авторизация:
   - почта, имя, пароль (стандартная регистрация/авторизация через php artisan make:auth).
   - Для токенов используем что угодно (passport, jwt и тд)

2. Публикация объявления в личном кабинете:
   - название (required);
   - фото (одно, required).

3. Вывод всех объявлений на главной с пагинацией
   Роут следующего вида:
   - /?page={page}
   - В объявлении выводим название и имя создателя (пользователя).

Дизайн не важен, важен реализованный функционал, можно использовать BootstrapVue или Vuetify.