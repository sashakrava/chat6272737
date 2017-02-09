<body>
<header>
    <h3>Авторизация</h3>
</header>
<content>
    <?php if ($this->getModel()->getUserId() > 0): ?>
    <div>Вы уже авторизированы.</div>
    <?php else: ?>
    <div>
        <form id="authForm">
            <input id="authLogin" type="text" placeholder="Login" maxlength="30"/><br>
            <input id="authPassword" type="password" placeholder="Password" maxlength="30"/><br>
            <button>Авторизироваться</button>
        </form>
    </div>
    <?php endif; ?>
</content>
<footer>

</footer>

<script type="text/javascript" src="./view/js/auth.js"></script>

</body>