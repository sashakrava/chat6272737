<body>
<header>
    <div class="title"><h1>Чат</h1></div>
    <?php if ($this->getModel()->getUserId() >  0): ?>
        <div class="login">Логин: <?php echo($this->getModel()->getLogin()); else:?></div>
        <div class="login"><a href="/auth">Войти</a></div>
    <?php endif; ?>
</header>
<content><br/><br/><br/>
    <div id="chat">
    </div>
    <div>
        <form id="sendMessageForm">
            <input id="sendMessageText" type="text" placeholder="Text input" maxlength="140" autocomplete="off">
        </form>
    </div>
</content>
<footer>

</footer>

<script type="text/javascript" src="./view/js/index.js"></script>

</body>