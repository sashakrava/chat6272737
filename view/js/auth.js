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
    if($('#authLogin').val().trim() === '') return false;
    if($('#authPassword').val().trim() === '')  return false;
    if($('#authLogin').val().length > 30) return false;
    if($('#authPassword').val().length > 30)  return false;
    if($('#authLogin').val().length < 4) return false;
    if($('#authPassword').val().length < 4)  return false;

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
                            alert('Успешно');
                            window.location.href = '/';
                            break;
                        case 'success':
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