Чтобы развернуть проект выполните след команды

git clone https://github.com/toshaby/smart<br>
cd smart

composer install<br>
npm install<br>
npm run build<br>

cp .env.example .env<br>
php artisan key:generate<br>

Отредактируйте .env укажите свои доступы к mysql/mariadb, укажите домен, также можно часовой пояс

php artisan migrate --seed<br>
в консоли, во время создания пользователей отобразится эмейл и пароль менеджера, который будет иметь доступ к админ панели

php artisan storage:link

Для создания больше тестовых данных можно еще запустить дополнительные сидеры

php artisan db:seed --class=CustomerSeeder<br>
php artisan db:seed --class=TicketSeeder<br>

Пример вставки виджета для создания тикета<br>
<iframe style="position:fixed;bottom:10px;right:10px;width:400px;height:550px;" src="http://your.domain/feedback-widget"></iframe>

Примеры api

####
POST /api/tickets<br>
запрос или Content-type application/json или multipart/form-data(в этом случае можно передать файлы, множественное поле files[])<br>
обязателен http заголовок Accept: application/json
***
Создание тикета с одинковым телефоном\email возможно раз в сутки
***
<pre>
{
    "name":"toha",
    "phone":"+380988369752",
    "email":"toha233@mail.ru",
    "theme":"Тестовая тема",
    "text":"Пишем текст"
}
</pre>
ответ
<pre>
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
</pre>
или
<pre>
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
</pre>
####

####
GET /api/tickets/statistics<br>
обязательно заголовок Accept: application/json
<pre>
ответ
{
    "data": {
        "day": 2,
        "week": 3,
        "month": 7
    }
}
</pre>

