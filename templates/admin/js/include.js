js = new Object;
js.loadedModules = new Array;
js.include = function(path) {
    if(js.loadedModules[path]) return;
    js.loadedModules[path] = true;
    $.ajax({
        url: path,
        dataType: "script",
        async: false,
        success: function(js){if(jQuery.browser.safari){eval(js);}}
    });
 
} //Взял этот с крипт с сайта netopalto.ru большое спасибо автору за этот скрипт.

js.include('/templates/admin/js/comm/jquery.validate.js'); //Инклюдим файл с валидатором 
js.include('/templates/admin/bootstrap/js/bootstrap.js'); //Инклюдим файл с twitter bootstrap

js.include('/templates/admin/bootstrap/js/bootstrap-switch.js'); //Инклюдим файл с twitter bootstrap switch button


js.include('/templates/admin/js/comm/pjax.js');
js.include('/templates/admin/js/comm/jquery-ui-1.10.3.custom.min.js'); //Инклюдим файл Jquery UI
js.include('/templates/admin/js/comm/timepicker.js'); //Инклюдим файл с timepicker
js.include('/templates/admin/js/comm/checkbox.jquery.js'); //Инклюдим файл с красивыми чекбоксами
js.include('/templates/admin/js/comm/jquery.form.js'); //Инклюдим файл с асинхронной отправкой формы
js.include('/templates/admin/js/comm/msgGrowl.js'); //Инклюдим файл с красивыми алертами
js.include('/templates/admin/js/comm/Application.js'); //Инклюдим файл со всякими вкусностями

js.include('/templates/admin/js/class.js'); //Инклюдим файл с классами
js.include('/templates/admin/js/binds.js'); //Инклюдим файл с биндами
js.include('/templates/admin/js/functions.js'); //Инклюдим файл с функциями
js.include('/templates/admin/js/loader.js'); //Инклюдим файл с автозагрузками скриптами

switch ($base_text_editor) {
    case 'elrte':
        js.include('/templates/admin/js/elrite/js/elrte.min.js'); //Подключаем редактор elrite
        js.include('/templates/admin/js/elrite/js/i18n/elrte.'+$base_language+'.js'); //Подключаем русский язык для elrite
    break;
    
    case 'tinymce':
        js.include('/templates/admin/js/tinymce/tinymce.min.js'); //Подключаем редактор tinymce
    break;
}

js.include('/templates/admin/js/elfinder/js/elfinder.min.js');
js.include('/templates/admin/js/elfinder/js/i18n/elfinder.'+$base_language+'.js');
js.include('/templates/admin/js/globalite.js'); //Подключаем фиговину для реализации мультиязычной поддержки

js.include('/templates/admin/js/lang/rus.js'); //Подключаем файл с русским языком
js.include('/templates/admin/js/lang/eng.js'); //Подключаем файл с английским языком