<body>
<header>
    <h3>Регистрация</h3>
</header>
<content>
        <?php if ($this->getModel()->getUserId() > 0): ?>
        <div>Вы уже авторизированы.</div>
    <?php else: ?>
        <div>
            <form id="regForm">
                <input id="regLogin" type="text" placeholder="Login" maxlength="30"/><br>
                <input id="regPassword" type="password" placeholder="Password" maxlength="30"/><br>
                <button>Зарегестрироваться</button>
            </form>
        </div>
    <?php endif; ?>
</content>
<footer>

</footer>

<script type="text/javascript" src="./view/js/reg.js"></script>

</body>