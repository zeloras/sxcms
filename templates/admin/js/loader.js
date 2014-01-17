$(document).ready(function () {
mysx_functions.activeMenu();
$('.sx_popover').popover({html: true});
switch ($base_text_editor) {
    case 'elrte':
        initElrte();
    break;
    
    case 'tinymce':
        initTinyMce();
    break;
    
    case 'native':
        console.log('Init native client');
    break;
}
});