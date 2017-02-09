/**
 * Created by Vyacheslav on 30/01/2017.
 */

var lastTime = 0;
var isWait = false;

$(document).ready(
    function()
    {
        console.log('ready');
        $('#sendMessageForm').submit(sendMessage);
        showAllMessage();
        setTimeout(updateChat, 500);
    }
);

function showMessages(messages)
{
    $.each(messages, function(i, messData) {
        if (messData.date > lastTime)
            lastTime = messData.date;
        var date = new Date(messData.date*1000).toTimeString().split(' ')[0];
        var msg = messData.login + '[' + date + ']:' + messData.text;
        //console.log(msg);
        $("<div/>", {
            class: "msg",
            text: msg
        }).appendTo($('#chat'));
    });
}

function sendMessage()
{
    console.log('sendMessage start');
    console.log($('#sendMessageText').val());
    if($('#sendMessageText').val() == '')   return;
    $.ajax(
        {
            type: "POST",
            url: 'index/send',
            data: {msg: $('#sendMessageText').val()},
            success:
                function(result)
                {
                    console.log(result);
                    switch (result.code)
                    {
                        case 'nologin':
                            alert('Нет авторизации');
                            break;
                        case 'nomsg':
                            alert('Пустое сообщение');
                            break;
                        case 'nopaste':
                            alert('Не удалось отправить');
                            break;
                        case 'success':
                            $('#sendMessageText').val('');
                            $('#sendMessageText').addClass('success');
                            setTimeout(function () {
                                $('#sendMessageText').removeClass('success');
                            },500);
                            break;
                        default:
                            alert('Неизвестная ошибка');

                    }

                }
        }
    );
    return false;
}

function showAllMessage()
{
    $.ajax(
        {
            type: "POST",
            url: 'index/get',
            data: {count: 'all'},
            success:
                function(result)
                {
                    console.log(result);
                    if(result.length > 0)
                    {
                        showMessages(result);
                    }
                }
        }
    );

}

function updateChat()
{
    console.log(lastTime);
    $.ajax(
        {
            type: "POST",
            url: 'index/get',
            data: {count: 'new', lastTime: lastTime},
            success: function (result)
            {
                // isWait = false;
                console.log(result);
                if(result.length > 0)
                {
                    showMessages(result);
                    setTimeout(updateChat, 500);
                }
            }
        }
    );
}
