Чтобы развернуть проект выполните след команды

git clone https://github.com/toshaby/smart
cd smart

composer install
npm install
npm run build

cp .env.example .env
php artisan key:generate

Отредактируйте .env укажите свои доступы к mysql/mariadb, укажите домен, также можно часовой пояс

php artisan migrate --seed
в консоли, во время создания пользователей отобразится эмейл и пароль менеджера, который будет иметь доступ к админ панели

php artisan storage:link

Для создания больше тестовых данных можно еще запустить дополнительные сидеры

php artisan db:seed --class=CustomerSeeder
php artisan db:seed --class=TicketSeeder

Пример вставки виджета для создания тикета
<iframe style="position:fixed;bottom:10px;right:10px;width:400px;height:550px;" src="http://your.domain/feedback-widget"></iframe>

Примеры api

####
POST /api/tickets
запрос или Content-type application/json или multipart/form-data(в этом случае можно передать файлы, множественное поле files[])
обязателен http заголовок Accept: application/json
***
Создание тикета с одинковым телефоном\email возможно раз в сутки
***
{
    "name":"toha",
    "phone":"+380988369752",
    "email":"toha233@mail.ru",
    "theme":"Тестовая тема",
    "text":"Пишем текст"
}
ответ
{
    "data": {
        "id": 12,
        "theme": "Тестовая тема",
        "text": "Пишем текст",
        "name": "toha",
        "phone": "+380988369752",
        "email": "toha233@mail.ru"
    }
}
или
{
    "message": "Укажите телефон если не указан Email (and 3 more errors)",
    "errors": {
        "phone": [
            "Укажите телефон если не указан Email"
        ],
        "email": [
            "Укажите Email если не указан телефон"
        ],
        "theme": [
            "Укажите тему сообщения"
        ],
        "text": [
            "Текст сообщения обязателен"
        ]
    }
}
####

####
GET /api/tickets/statistics
обязательно заголовок Accept: application/json

ответ
{
    "data": {
        "day": 2,
        "week": 3,
        "month": 7
    }
}


