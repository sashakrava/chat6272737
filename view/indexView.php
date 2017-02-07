<body>
<header>
    <div>Чат</div>
    <? if(1!=1); ?>
    <div>test1</div>
    <? endif; ?>
</header>
<content>
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