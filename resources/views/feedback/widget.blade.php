<!DOCTYPE html>
<html>
    <head>
        @vite(['resources/css/widget.css', 'resources/js/widget.js'])
    </head>
    <body>
        <div class="form">
            <form action="{{ route('ticket.store') }}" method="post" id="widgetform">
                @csrf
                <div class="head">Оставьте свой отзыв</div>
                <div class="message ok">&nbsp;</div>
                <div class="form_field">
                    <div class="message error">&nbsp;</div>
                    <input type="text" name="name" value="" placeholder="Ваше имя">
                </div>
                <div class="form_field">
                    <div class="message error">&nbsp;</div>
                    <input type="text" name="phone" value="" placeholder="Оставьте свой телефон">
                </div>
                <div class="form_field">
                    <div class="message error">&nbsp;</div>
                    <input type="text" name="email" value="" placeholder="Укажите email">
                </div>
                <div class="form_field">
                    <div class="message error">&nbsp;</div>
                    <input type="text" name="theme" value="" placeholder="Тема сообщения">
                </div>
                <div class="form_field">
                    <div class="message error">&nbsp;</div>
                    <textarea name="text" placeholder="Текст сообщения"></textarea>
                </div>
                <div class="form_field">
                    <div class="message error">&nbsp;</div>
                    <input type="file" name="files[]" multiple="multiple">
                </div>
                <div class="form_field">
                    <input type="submit" name="send">
                </div>
            </form>
        </div>
    </body>
</html>