/**
 * Created by Vyacheslav on 05/02/2017.
 */

$(function readyDOM()
    {
        console.log('ready');
        $('#authForm').submit(auth);

    }
);

function auth()
{

    if($('#authLogin').val().trim() === '') {alert('Не введён логин.');return false;}
    if($('#authPassword').val().trim() === '')  {alert('Не введён пароль.');return false;}
    if($('#authLogin').val().length > 30) {alert('Логин должен быть менее 30 символов.');return false;}
    if($('#authPassword').val().length > 30)  {alert('Пароль должен быть менее 30 символов.');return false;}
    if($('#authLogin').val().length < 4) {alert('Логин должен быть более 4 символов.');return false;}
    if($('#authPassword').val().length < 4)  {alert('Пароль должен быть более 4 символов.');return false;}
    //
    // if($('#authLogin').val().trim() === '') return false;
    // if($('#authPassword').val().trim() === '') return false;
    // if($('#authLogin').val().length > 30) return false;
    // if($('#authPassword').val().length > 30) return false;
    // if($('#authLogin').val().length < 4) return false;
    // if($('#authPassword').val().length < 4) return false;


    $.ajax(
        {
            type: "POST",
            url: 'auth/login',
            data: {
                login: $('#authLogin').val(),
                password: $('#authPassword').val()},
            success:
                function(result)
                {
                    console.log(result);
                    switch (result.code)
                    {
                        case 'nologin':
                            alert('Логин или пароль неправильны.');
                            break;
                        case 'success':
                            alert('Авторизация удалась.');
                            window.location.href = '/';
                            break;
                        default:
                            alert('Неизвестная ошибка');

                    }
                    return false;

                }
        }
    );
    return false;
}