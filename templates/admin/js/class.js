var dlg = false;
var mysx_functions = new Object({
    sortTable: function (label) {
        $data_type = $(label).data('sort-type');
        $data_class = $(label).data('sort-class');
        switch ($data_type) {
            case 'ondiv':
                $(label).find($data_class).not(':has('+$data_class+')').tooltip({
                    'placement': 'top',
                    'delay': {
                        show: 500,
                        hide: 100
                    }
                }).css('cursor', 'move');
                $(label).sortable({
                    axis: 'y',
                    cursor: 'move',
                    scroll: true,
                    containment: $(label),
                    cancel: 'div a, div input, div select',
                    helper: function(e, tr)
                    {
                        var $originals = tr.children();
                        var $helper = tr.clone();
                        $helper.children().each(function(index)
                        {
                            $(this).width($originals.eq(index).width())
                        });
                        $helper.addClass('active');
                        return $helper;
                    }

                }); 
            break;
            
            default:
                $(label).find('tr').not(':has(tr)').tooltip({
                    'placement': 'top',
                    'delay': {
                        show: 500,
                        hide: 100
                    }
                }).css('cursor', 'move');
                $(label).sortable({
                    axis: 'y',
                    cursor: 'move',
                    scroll: true,
                    containment: $(label),
                    cancel: 'td a, td input, td select',
                    helper: function(e, tr)
                    {
                        var $originals = tr.children();
                        var $helper = tr.clone();
                        $helper.children().each(function(index)
                        {
                            $(this).width($originals.eq(index).width())
                        });
                        $helper.addClass('active');
                        return $helper;
                    }

                }); 
            break;
        }
    },
    checkbox_select:function (label) {
        $inputs = $(label).find("input").data("inputs");
        $checked = $(label).find("input").prop("checked");
        
        if (!$checked)
        {
            $($inputs).parent().css("background-position","0 -17px");
            $($inputs).prop("checked", true);
        }
        else
        {
            $($inputs).parent().css("background-position","0 0");
            $($inputs).prop("checked", false);
        }
    },
            
    niceCheck: function (label) {
             $input = $(label).find("input").eq(0);
             if(!$input.prop("checked")) {
                    $(label).css("background-position","0 -17px");	
                    $input.prop("checked", true)
            } else {
                    $(label).css("background-position","0 0");	
                    $input.prop("checked", false)
            }
    },
    
    pjax: function (label) {
        $href = $(label).data("href");
        $container = $(label).data("container");
        $.pjax({url: $href, container: $container});
    },
            

    formSubmit: function(label) {

    var selector = $(label).data('form');
    var action = $(label).data('action');
    var after = $(label).data('after');

    $(selector).validate();
    
    if ($(selector).valid())
    {
        $('#page-loading').fadeIn(100);
        var options = {
            beforeSubmit: function(formData) {
                formData.push({
                    name: "action",
                    value: action
                });
            },
            success: function(data) {
                $('#page-loading').fadeOut(100);
                $("#errors_block").hide();
                $errors_data = $(data).find("#errors_block");
                $success_data = $(data).find("#success_block");
                if ($success_data.size() < 1)
                {
                    $("#errors_block").html($errors_data.html());
                    $("#errors_block").fadeIn();
                }
                else
                {
                    $message = $success_data.find("#status_success").text();
                    $link = (after == "exit") ? $success_data.find("#url_success_exit").text(): $success_data.find("#url_success").text();
                    eval($message);
                    setTimeout(function () {
                        document.location.href = $link;
                    }, 1200);
                }
                return true;
            }
        };
        $(selector).ajaxSubmit(options);
    }
},
        
deleteConfirm: function (label) {
 $href = "/admin/syscom/ajax_delete/"+$(label).data("href");
        $modal = $(label).data("modal");
        var ids = new Array();
        $('input[name=ids]:checked').each(function() {
            ids.push($(this).val());
        });
        $.post($href, {
            ids: ids
        }, function(data) {
            $block = $(data).find("#status_delete_block");
            showMessage($block.find("#delete_text").text(), "delete_status".l(), $block.find("#delete_status").text())
            setTimeout(function () {
                document.location.reload();
            }, 1200);
        });
    return true; 
},

showHidden: function(label, type) {
    $class = $(label).data("class");
    if (type == 'show')
    {
        $(label).find($class).css("visibility", "visible");
    }
    else
    {
        $(label).find($class).css("visibility", "hidden");
    }
},
      
translitUrl: function (label) {
    $title = $(label).data('title');
    $url = $(label).data('url');
    $.post('/admin/syscom/getTranslitUrl', {text_translit: $($title).val()}, function (data) {
        $text = $(data).find("#translit_text").text();
        $($url).val($text);
    });
},
save_positions: function (label) {        
    $arr = new Array();
    $type = $(label).data('type');
    $('input[name=ids]').each(function() {
        $arr.push($(this).val());
    });
    
    $.post('/admin/syscom/ajax_save_position/'+$type, {positions: $arr}, function(data) 
    {
        $block = $(data).find("#save_position_status_block");
        showMessage($block.find("#position_text").text(), "sort_status".l(), $block.find("#position_status").text())
    });
},

checkCloudConnect: function (label) {
    $type = $(label).data('service');
    $login = $($(label).data('login')).val();
    $password = $($(label).data('password')).val();
    $.post('/admin/syscom/ajax_cloud_check/'+$type, {login: $login, password: $password}, function (data) {
        $block = $(data).find("#status_block_connect").text();
        eval($block);
    });
},

checkFTPConnect: function (label) {
    $server = $($(label).data('server')).val();
    $port = $($(label).data('port')).val();
    $login = $($(label).data('login')).val();
    $password = $($(label).data('password')).val();
    $.post('/admin/syscom/ajax_ftp_check/', {login: $login, password: $password, host: $server, port: $port}, function (data) {
        $block = $(data).find("#status_block_connect").text();
        eval($block);
    });
},

saveFTPFile: function (label) {
    $file = $(label).data('link');
    $.post('/admin/syscom/ajax_ftp_save/', {file: $file}, function (data) {
        $block = $(data).find("#status_block_save").text();
        eval($block);
        $(label).removeClass('sx_ftp_save');
        $(label).addClass('sx_ftp_delete');
        $(label).html('<i class="icon-remove"></i>'+"remove_from_ftp".l());
    });
},
        
deleteFTPFile: function (label) {
    $file = $(label).data('link');
    $.post('/admin/syscom/ajax_ftp_delete/', {file: $file}, function (data) {
        $block = $(data).find("#status_block_delete").text();
        eval($block);
        $(label).removeClass('sx_ftp_delete');
        $(label).addClass('sx_ftp_save');
        $(label).html('<i class="icon-file"></i>'+"save_on_ftp".l());
    });
},

        
saveCloudFile: function (label) {
    $file = $(label).data('link');
    $type = $(label).data('service');
    $.post('/admin/syscom/ajax_cloud_save/'+$type, {file: $file}, function (data) {
        $block = $(data).find("#status_block_save").text();
        eval($block);
        $(label).removeClass('sx_cloud_save');
        $(label).addClass('sx_cloud_delete');
        $(label).html('<i class="icon-remove"></i>'+"remove_from_disk".l());
    });
},

deleteCloudFile: function (label) {
    $file = $(label).data('link');
    $type = $(label).data('service');
    $.post('/admin/syscom/ajax_cloud_delete/'+$type, {file: $file}, function (data) {
        $block = $(data).find("#status_block_delete").text();
        eval($block);
        $(label).removeClass('sx_cloud_delete');
        $(label).addClass('sx_cloud_save');
        $(label).html('<i class="icon-file"></i>'+"save_on_disk".l());
    });
},

activeMenu:function (label) {
    $path = document.location.pathname
            //.replace(/\//gm, "\\/");
    $(".subnavbar .mainnav a").each(function () {
        $(this).parents(".subnavbar .mainnav li").removeClass("active");
        $link = $(this).attr("href").replace(/\//gm, "\\/");
        //console.log($link)
        if (/$link/.test($path))
        {
            console.log('active '+$path);
        }
    });
},

changeStatus:function (label) {
    $id = $(label).data('id');
    $type = $(label).data('type');
    $.post('/admin/syscom/ajax_changeactive/', {type: $type, id: $id}).success(function (data) {
        $block = $(data).find("#change_status_active").text();
        eval($block);
    });
},

changeStatusPage:function (label) {
    $id = $(label).data('id');
    $type = $(label).data('type');
    $status = $(label).val();
    $.post('/admin/syscom/ajax_changeactive/', {type:$type, id:$id, status:$status}).success(function (data) {
        $block = $(data).find("#change_status_active").text();
        eval($block);
    });
},

selectIcon:function (label) {
    $icon_classes = $(label).find("i").attr("class");
    $icon = $icon_classes.split(" ");
    $ul = $(label).parent().parent();
    $input = $ul.data("input");
    $image = $ul.data("bimage");
    $modal = $ul.data("modal");
    $($image).attr("class", $icon[0]);
    $($input).val($icon[0]);
    $($modal).fadeOut();
    $("#modal-background").fadeOut();
},

typeWidget:function (label) {
    $html_block = $(label).data("html");
    $module_block = $(label).data("module");
    $value = $(label).val();
    
    if($value == "html")
    {
        $($html_block).fadeIn();
        $($module_block).fadeOut();
    }
    else
    {
        $($html_block).fadeOut();
        $($module_block).fadeIn(); 
    }
},

datepicker: function (label) {
    $def_date = $(label).data("date");
    
    $(label).attr("data-date", $(label).val());

    $(label).datetimepicker({
        timezone: false,
    });
    
    
    if ($def_date == undefined)
        $(label).datetimepicker('setDate', (new Date()) );
}
});

var mysx_modal = new Object({
    show: function (label) {
        $modal = $(label).data("modal");
        $spec_title = $(label).data("modal-title");
        $confirm_attribute = $(label).data("modal-value");
        $confim_button = $($modal).find(".confirm_modal_button");

        if ($confirm_attribute != undefined)
        {
            if ($confirm_attribute.length > 2)
            {
                $attr = $confirm_attribute.split(":");
                $confim_button.attr($attr[0], $attr[1]);
            }
        }
        
        if ($($modal).find(".modal_spec_title").size() > 0)
        {
            $($modal).find(".modal_spec_title").text($spec_title);
        }
        $($modal).fadeIn();
        $("#modal-background").fadeIn();
    },
            
    hide: function (label) {
        $modal = $(label).data("modal");
        if ($($modal).find(".modal_spec_title").size() > 0)
        {
            $($modal).find(".modal_spec_title").text("");
        }
        $($modal).fadeOut();
        $("#modal-background").fadeOut();
    },
    
    
elfinder: function (label)
{
    fId = $(label).data("input-id");
    path_info = ($(label).data("path") != undefined) ? $(label).data("path") : '';
    type = ($(label).data("type") != undefined) ? $(label).data("type") : "image";
    elblock = $(label).data("block");
    path = '';
    
    if (!dlg)
    {
        dlg = $(elblock).dialogelfinder({
            url: '/admin/syscom/load_elfinder/'+path_info,
            requestType : 'post',
            lang: $base_language,
            commands: [
                'open', 'reload', 'home', 'up', 'back', 'forward', 'getfile', 'quicklook',
                'download', 'rm', 'rename', 'mkdir', 'mkfile', 'upload', 'edit', 'preview', 'extract', 'archive', 'search', 'info', 'view', 'help', 'sort'
            ],
            uiOptions: {
                // toolbar configuration
                toolbar: [
                    ['back', 'forward'],
                    ['reload'],
                    ['home', 'up'],
                    ['mkdir', 'mkfile', 'upload'],
                    ['download'],
                    ['info'],
                    ['quicklook'],
                    ['rm'],
                    ['duplicate', 'rename', 'edit'],
                    ['extract', 'archive'],
                    ['view', 'sort'],
                    ['help'],
                    ['search']
                ],
                // directories tree options
                tree: {
                    // expand current root on init
                    openRootOnLoad: true,
                    // auto load current dir parents
                    syncTree: true
                },
            },
            commandsOptions: {
                getfile: {
                    oncomplete: 'close' // close/hide elFinder
                }
            },
            getFileCallback: function(file) {
                console.log(file);
                file_path = file.replace(new RegExp("http:\/\/"+document.location.host), '');
                $('#' + fId).val(file_path);

                if (type == 'image' && $('#' + fId + '-preview').length)
                {
                    var img = document.createElement('img');
                    img.src = $('#' + fId).val();
                    img.className = "img-polaroid";
                    $('#' + fId + '-preview').html(img);
                }
            },
            contextmenu: {
                files: [
                    'edit', 'rename', '|', 'download', '|',
                    'rm', '|', 'archive', 'extract', '|', 'info'
                ]
            },
            customData: {
                //cms_token: elfToken,
                //path: path
            }
        });
    }
    else
        dlg.show();
    return false;
},
    
});

var mysx_menu = new Object({
    selectType: function (label) {
        $value = $(label).val();
        $fblock = $(label).data('first');
        $sblock = $(label).data('second');
        $tblock = $(label).data('threed');
        $this = $($fblock);
        $this_2 = $($sblock);
        $this_3 = $($tblock)
        $this.removeClass("hide");
        if ($value == 1)
        {
            $this_2.addClass("hide");
            $this_3.addClass("hide");
            $this.find("label").text("link_on_category".l());
            $this_2.addClass("hide");
            $.get('/admin/syscom/getCategorys_opt/', function (data) {
                $options = $(data).find("#select-category");
                $this.find("select").html(($options.html()));
            });
        }
        
        if ($value == 2)
        {
            $this_3.addClass("hide");
            $this.find("label").text("category".l());
            $.get('/admin/syscom/getCategorys_opt/', function (data) {
                $options = $(data).find("#select-category");
                $this.find("select").html(($options.html()));
            });
        }
        
        if ($value == 3)
        {
            $this.find("label").text("link_on".l());
            $this_2.addClass("hide");
            $this_3.addClass("hide");
            $.get('/admin/syscom/getSystem_opt/', function (data) {
                $options = $(data).find("#select-system");
                $this.find("select").html(($options.html()));
            });
        }
        
        if ($value == 4)
        {
            $this_2.addClass("hide");
            $this.addClass("hide");
            $this_3.removeClass("hide");
            $this.addClass("hide");
        }
    },
    
    selectCategory: function (label) {
        $value = $(label).val();
        $sblock = $(label).data('second');
        $fblock = $(label).data('first');
        $tblock = $(label).data('type');
        $this_3 = $($tblock);
        $this_2 = $($sblock);
        $this_1 = $($fblock);
        
        if ($this_3.find("select").val() == 2)
        {
            $this_2.removeClass("hide");
            $.get('/admin/syscom/getPages_opt/'+$value, function (data) {
                $options = $(data).find("#select-page");
                $this_2.find("select").html(($options.html()));
            });
        }
        else
        {
            $this_2.addClass("hide");
        }
    }
});


var mysx_change_function = new Object({
        changeTemplate:function(label) {
            $image = $(label).find("option:selected").data("png");
            $div_block = $($(label).data("div"));
            $template = $(label).val();
            $author = $(label).find("option:selected").data("author");
            $contacts = $(label).find("option:selected").data("contacts");
            $contacts_exp = $contacts.split(',, ');
            $contacts_exp.pop();
            $div_block.find(".contacts tbody").find("tr").remove();
            $div_block.find(".base tbody").find("tr").remove();
            for (var key in $contacts_exp) {
                var val = $contacts_exp[key].split("::");
                $div_block.find(".contacts tbody").append('<tr><td>'+val[0]+':</td> <td>'+val[1]+'</td></tr>');
            }
            
            $div_block.find(".base tbody").append('<tr><td>'+"template".l()+':</td><td>'+$template+'</td></tr>');
            
            $div_block.find(".base tbody").append('<tr><td>'+"author".l()+':</td><td>'+$author+'</td></tr>');
            
            $div_block.find(".base tbody").append('<tr><td colspan="2"><img width="250px" height="250px" src="'+$image+'" /></td></tr>');
        },
                
        submitTemplate:function(label) {
            $value = $($(label).data("value")).val();
            $.post('/admin/settings', {
                    templatedir: $value,
                    change_template_base: 1,
                }, function(data) {
                    $block = $(data).find("#template_status_block");
                    eval($block.find("#status_success").text());
                });
        },
        
        generate_keywords: function (label) {
            $get = $(label).data("get");
            $put = $(label).data("put");
            $input = $(label).data("input");
            switch ($base_text_editor) {
                case 'elrte':
                    $get_data = $($get).elrte('val');
                break;

                case 'tinymce':
                    $get_data = tinyMCE.get($get.replace('#', '')).getContent();
                break;
                
                default:
                    $get_data = $($get).val();
                break;
            }

            $.post('/admin/syscom/ajax_getkeywords', {keywords: $get_data, put: $input}).success(function (data) {
                $get_data = $(data).find("#keywords_gen").html();
                $($put).html($get_data);
                $($put).parent().fadeIn();
            });
        },
        
        put_keywords: function(label) {
            $put_input = $(label).data("put");
            $value = $(label).text()+', ';
            $old_data = $($put_input).val();
            $($put_input).val($old_data + $value);
        },
        
        get_additional_rows: function(label) {
            $category = $(label).val();
            $item = $(label).data('item');
            $block_insert = $(label).data('insert');
            $.post('/admin/syscom/ajax_getafields', {category: $category, item: $item}).success(function (data) {
                $data = $(data).find("#additional_fields_html_block").html();
                $($block_insert).html($data);
            });
        },
        
        commentStatusSet: function(label) {
            $status = $(label).data("status");
            $type = $(label).data("type");
            $ids = new Array();
            $('input[name=ids]:checked').each(function() {
                $ids.push($(this).val());
            });
            $.post('/admin/syscom/ajax_changeactive/', {type: $type, id: $ids, status: $status}).success(function (data) {
                $block = $(data).find("#change_status_active").text();
                eval($block);
                setTimeout(function () {
                      document.location.reload();
                  }, 1200);
            });
        },
});



var mysx_backup = new Object({

deleteConfirm:function (label) {
        $modal = $(label).data("modal");
        $value = $(label).data("remove-file");
        console.log($value);
        $.post('/admin/settings', {
            backup: $value,
            remove_this_backup: 1,
        }, function(data) {
            $block = $(data).find("#backup_status_block");
            eval($block.find("#status_success").text());
        });
        mysx_modal.hide($modal);
        return false;
    },
    
deleteModal:function (label) {
            $b_name = $(label).data("name");
            $b_span_name = $(label).data("span-name");
            $value = $(label).data("value");
            $value_data = $(label).data("value-data");
            $($b_span_name).text($b_name);
            $($value_data).attr("data-value", $value);
            console.log($($value_data).data("value"));
            mysx_modal.show(label);
        },
        
createBackup:function (label) {
            $inval = $($(label).data('select')).val();
            $.post('/admin/settings/', {
                    submit_this_backup: 1,
                    select_backup_type: $inval,
                }, function(data) {
                    $block = $(data).find("#backup_status_block");
                    eval($block.find("#status_success").text());
                });
                return true;
        },
});

var mysx_filters = new Object({
    
filterPage:function (label) {
    $get = document.location.search;
    $values = $(label).data("value");
    $type = $(label).data("type");
    
    switch ($type) {
        case 'category':
            $type = "filterCat";
        break;
        
        case 'sortby':
            $type = "filterSortBy";
        break;
    }
    
    if ($get.length > 1)
    {
        if (new RegExp($type).test($get))
        {
            if (new RegExp($type+"=.*&").test($get))
            {
                $replace = document.location.href.replace(new RegExp("("+$type+"=).*?(&)"), '$1' + $values + '$2');
            }
            else
            {
                $replace = document.location.href.replace(new RegExp("("+$type+"=).*"), '$1' + $values);
            }
            document.location.href = $replace;
        }
        else
        {
             document.location.href = document.location.href+"&"+$type+"="+$values;
        }
    }
    else
    {
        document.location.href = document.location.href.replace(/\?/, '')+"?"+$type+"="+$values;
    }
}
});


var mysx_modules = new Object({
    
module_install: function(label) {
    $module_name = $(label).data("module");
    $.post('/admin/modules/install', {install_this_module: 1, module: $module_name})
    .success(function(data) {
        $('#page-loading').fadeOut(100);
        $("#errors_block").hide();
        $errors_data = $(data).find("#errors_block");
        $success_data = $(data).find("#status_module_install");
        if ($success_data.size() < 1)
        {
            $("#errors_block").html($errors_data.html());
            $("#errors_block").fadeIn();
        }
        else
        {
            $message = $success_data.find("#status_success").text();
            $link = $success_data.find("#url_success").text();
            eval($message);
            setTimeout(function () {
                document.location.href = $link;
            }, 1200);
        }
    });
}
});