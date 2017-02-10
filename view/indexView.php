
<content>
    <div class="title"><h1>Чат</h1></div>
    <?php if ($this->getModel()->getUserId() >  0): ?>
        <div class="login">Логин: <?php echo($this->getModel()->getLogin());?>  | <a href="/auth/logout">Выход</a> <?php else: ?></div>
        <div class="login"><a href="/auth">Войти</a> | <a href="/reg">Регистрация</a></div>
    <?php endif; ?>

    <div id="chat" class="chat">
    </div>
    <div>
        <form id="sendMessageForm">
            <input id="sendMessageText" type="text" placeholder="Text input" maxlength="140" autocomplete="off">
        </form>
    </div>
</content>

<script type="text/javascript" src="./view/js/index.js"></script>
