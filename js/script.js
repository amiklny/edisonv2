var Arnly = {};

if (!Arnly.hasOwnProperty('Edison'))
    Arnly.Edison = {};

/*
PARAMS:
MESSAGE
TYPE
*/
Arnly.showError = function (params = {})
{
    if (typeof params == undefined || !params)
        return alert('Arnly.showError: не переданы параметры.');

    if (typeof params.TYPE == undefined || !params.TYPE)
        params.TYPE = 'alert';

    if (typeof params.MESSAGE == undefined || !params.MESSAGE)
        return alert('Arnly.showError: params.MESSAGE - не переданы параметры.');

    if (params.TYPE == 'console')
        return console.dir(params.MESSAGE);

   return alert(params.MESSAGE);
}

/*
PARAMS:
STRING
*/
Arnly.isNumeric = function (params = {})
{
    return /^-?\d+$/.test(params.STRING);
}

/*
PARAMS:
STRING
*/
Arnly.Edison.CheckedInputData = function (params = {})
{
    if (typeof params.STRING == undefined || params.STRING == '')
        return Arnly.showError({MESSAGE: 'Не указаны данные.'});

    if (params.STRING.length < 2)
        return Arnly.showError({MESSAGE: 'Не достаточно количества символов.'});

    if (params.STRING.length > 2)
        return Arnly.showError({MESSAGE: 'Превышено количества символов.'});

    if (!Arnly.isNumeric({STRING: params.STRING}))
        return Arnly.showError({MESSAGE: 'Введенные данные не являются целым числом.'});

    return true;
}


/*
PARAMS:
NUMBER

EXAMPLE:
Arnly.Edison.Ajax()
*/
Arnly.Edison.Ajax = function (params = {})
{
    $.ajax({
        method: 'POST',
        url: '/edisonv2/lib/ajax.php',
        type: 'json',
        data: {NUMBER: $('input[name="arnly-value"]').val()}
    }).done(function(data) {
        console.dir(data);
        if (data.result == 'success')
        {
            var answers = '', authority = '';

            if (data.output.HISTORY)
                $('.arnly-history').html(data.output.HISTORY.join(', '));

            if (data.output.ANSWERS)
            {
                $.each(data.output.ANSWERS, function(i, e) {
                    answers += i + ': ' + e.join(', ') + '<br>';
                });
                $('.arnly-answers').html(answers);
            }

            if (data.output.AUTHORITY)
            {
                $.each(data.output.AUTHORITY, function(i, e) {
                    authority += i + ': ' + e + '<br>';
                });
                $('.arnly-authority').html(authority);
            }
        }
        else
        {
            Arnly.showError({MESSAGE: 'Arnly.Edison.OneSideAjax: Произошла ошибка:' + data.message ? data.message : 'Arnly.Edison.OneSideAjax - Ошибка сервера.'});
        }

        $('.arnly-send-to-ajax').removeClass('disabled');
    });
}


$(document).ready(function() {
    $('.arnly-send-to-ajax').on('click', function() {
        if (Arnly.Edison.CheckedInputData({STRING : $('input[name="arnly-value"]').val()}))
        {
            $(this).addClass('disabled');
            Arnly.Edison.Ajax();
        }
    });
});