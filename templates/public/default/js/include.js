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

js.include('/templates/public/default/bootstrap/js/bootstrap.js'); //Инклюдим файл с twitter bootstrap

js.include('/templates/public/default/js/class.js'); //Инклюдим файл с классами
js.include('/templates/public/default/js/binds.js'); //Инклюдим файл с биндами

js.include('/templates/public/default/js/globalite.js'); //Подключаем фиговину для реализации мультиязычной поддержки

js.include('/templates/public/default/js/lang/rus.js'); //Подключаем файл с русским языком
js.include('/templates/public/default/js/lang/eng.js'); //Подключаем файл с английским языком