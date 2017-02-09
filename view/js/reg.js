/**
 * Created by Vyacheslav on 08/02/2017.
 */


$(function readyDOM()
    {
        console.log('ready');
        $('#regForm').submit(reg);

    }
);

function reg()
{
    if($('#regLogin').val().trim() === '') {alert('Не введён логин.');return false;}
    if($('#regPassword').val().trim() === '')  {alert('Не введён пароль.');return false;}
    if($('#regLogin').val().length > 30) {alert('Логин должен быть менее 30 символов.');return false;}
    if($('#regPassword').val().length > 30)  {alert('Пароль должен быть менее 30 символов.');return false;}
    if($('#regLogin').val().length < 4) {alert('Логин должен быть более 4 символов.');return false;}
    if($('#regPassword').val().length < 4)  {alert('Пароль должен быть более 4 символов.');return false;}


    $.ajax(
        {
            type: "POST",
            url: 'reg/add',
            data: {
                login: $('#regLogin').val(),
                password: $('#regPassword').val()},
            success:
                function(result)
                {
                    console.log(result);
                    switch (result.code)
                    {
                        case 'noreg':
                            alert('Регистрация не удалась.');
                            break;
                        case 'success':
                            alert('Вы зарегестрированы.');
                            window.location.href = '/auth';
                            break;
                        case 'auth':
                            alert('Вы уже авторизированы.');
                            window.location.href = '/';
                            break;
                        default:
                            alert('Неизвестная ошибка.');

                    }
                    return false;

                }
        }
    );
    return false;
}
