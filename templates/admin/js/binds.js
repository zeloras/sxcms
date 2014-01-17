$('form').bind('form-pre-serialize', function(e) {
    switch ($base_text_editor) {
        case 'elrte':
            $('textarea').each(function () {
                $texarea_id = $(this).attr('id');
                $value = $("#"+$texarea_id).elrte('val');
                $(this).val($value);
            });
        break;

        case 'tinymce':
            tinyMCE.triggerSave(); 
        break;
    }
});

$("#sx_checkbox_general").bind('click', function() {
    mysx_functions.checkbox_select(this);
});

$(".niceCheck").bind('click', function() {
    mysx_functions.niceCheck(this);
});

$(".sx_modal_show").bind('click', function () {
    mysx_modal.show(this);
});

$(".sx_modal_hide").bind('click', function () {
    mysx_modal.hide(this);
});

$(".formSubmit").bind('click', function () {
    mysx_functions.formSubmit(this);
});

$('.sx_remove_function').live('click', function() {
    mysx_functions.deleteConfirm(this);
});
    

$('#sidebar .btn:has(.icon-plus), #category .btn:has(.icon-plus), #links .btn:has(.icon-plus)').die('click').bind('click', function() {
    var $this = $(this);
    $this.closest('.row-links').next().show();
    $this.closest('.row-category').next().show();
    $this.closest('.row-item-sidebar').next().show();
    $this.hide().prev().show();
});
$('#sidebar .btn:has(.icon-minus), #category .btn:has(.icon-minus), #links .btn:has(.icon-minus)').die('click').bind('click', function() {
    var $this = $(this);
    $this.closest('.row-links').next().hide();
    $this.closest('.row-category').next().hide();
    $this.closest('.row-item-sidebar').next().hide();
    $this.hide().next().show();
});

$('.sx_sort_table').bind('mouseover', function () {
    mysx_functions.sortTable(this);
});

$(".pjax_button").bind('click', function () {
    mysx_functions.pjax(this);
});

$('.show_hidden').bind('mouseover', function () {
    mysx_functions.showHidden(this, 'show');
});

$('.show_hidden').bind('mouseout', function () {
    mysx_functions.showHidden(this, 'hide');
});

$('.sx_menu_type').bind('change', function () {
    mysx_menu.selectType(this);
});

$('.sx_menu_first').bind('change', function () {
    mysx_menu.selectCategory(this);
});

$('.sx_translit_url').bind('click', function () {
    mysx_functions.translitUrl(this);
});

$(".sx_save_positions").bind("sortstop", function() {
    mysx_functions.save_positions(this);
});

$('.sx_template_view').bind('change', function () {
    mysx_change_function.changeTemplate(this);
});

$('.sx_save_template').bind('click', function () {
    mysx_change_function.submitTemplate(this);
});

$('.sx_remove_backup_modal').bind('click', function() {
    mysx_backup.deleteModal(this);
});

$('.sx_new_backup').bind('click',function() {
    mysx_backup.createBackup(this);
});

$('.sx_delete_backup').bind('click', function () {
    mysx_backup.deleteConfirm(this);
});

$('.sx_ftp_check').bind('click', function () {
    mysx_functions.checkFTPConnect(this);
});

$('.sx_cloud_check').bind('click', function () {
    mysx_functions.checkCloudConnect(this);
});

$('.sx_cloud_save').bind('click', function () {
    mysx_functions.saveCloudFile(this);
});

$('.sx_cloud_delete').bind('click', function () {
    mysx_functions.deleteCloudFile(this);
});

$('.sx_ftp_save').bind('click', function () {
    mysx_functions.saveFTPFile(this);
});

$('.sx_ftp_delete').bind('click', function () {
    mysx_functions.deleteFTPFile(this);
});

$('.sx_change_active').bind('change', function () {
    mysx_functions.changeStatus(this);
});

$('.sx_change_status').bind('change', function () {
    mysx_functions.changeStatusPage(this);
});

$('.sx_select_icons a').bind('click', function () {
    mysx_functions.selectIcon(this);
});

$('.sx_filter_lists').bind('click', function () {
    mysx_filters.filterPage(this);
});

$('.sx_change_widget_type').bind('change', function () {
    mysx_functions.typeWidget(this);
});

$('.sx_module_install').bind('click', function () {
    mysx_modules.module_install(this);
});

$('.sx_elfinder').bind('click', function () {
    mysx_modal.elfinder(this);
});

$('.sx_timepicker').bind('click', function () {
    mysx_functions.datepicker(this)
});

$('.sx_generate_keywords').bind('click', function () {
    mysx_change_function.generate_keywords(this)
});

$('.sx_category_fields').bind('change', function () {
    mysx_change_function.get_additional_rows(this);
});

$('.sx_change_comment_status').bind('click', function () {
    mysx_change_function.commentStatusSet(this);
});

var intval = setInterval(function () 
{
    if ($('.sx_put_keyword').size() > 0)
    {
        $('.sx_put_keyword').bind('click', function () {
            mysx_change_function.put_keywords(this);
        });
        clearInterval(intval);
    }
}, 400);