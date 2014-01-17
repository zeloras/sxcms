function showMessage($message, $title, $type)
{
    $title = ($title == null) ? 'Информация' : $title;
    $type = ($type == null) ? 'info' : $type;
    $.msgGrowl ({type: $type, title: $title, text: $message});
}

function initElrte()
{
elRTE.prototype.options.panels.mypanelbar = [
     'bold', 'italic', 'underline', 'forecolor', 'justifyleft', 'justifyright',
     'justifycenter', 'justifyfull', 'formatblock', 'fontsize', 'fontname', 'insertorderedlist', 'insertunorderedlist',
     'link', 'image'
];
    elRTE.prototype.options.toolbars.mypanelbar = ['mypanelbar'];
    var opts = {
            cssClass : 'el-rte',
            lang     : $base_language,
            height   : 250,
            fmAllow  : true,
            width    : 700,
            toolbar  : 'mypanelbar',
            cssfiles : ['css/elrte-inner.css']
    }

    var elrite = $('.load_texteditor').elrte(opts);
}

function initTinyMce()
{
tinymce.triggerSave(); 
tinymce.init({
    skin: "lightgray",
    skin_url: '/templates/admin/js/tinymce/skins/lightgray',
    selector: ".load_texteditor",
    language_url: "/templates/admin/js/tinymce/langs/"+$base_language+".js",
    relative_urls: false,
    convert_urls: true,
    document_base_url: "/templates/admin/js/tinymce/",
    plugins: [
        "lists link image charmap print preview hr anchor",
        "searchreplace wordcount code fullscreen",
        "insertdatetime media table contextmenu",
        "textcolor"
    ],
    toolbar1: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor",
    image_advtab: true,
});
}
function mktime() {	// Get Unix timestamp for a date
	// 
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +   improved by: baris ozdil

	var i = 0, d = new Date(), argv = arguments, argc = argv.length;

	var dateManip = {
		0: function(tt){ return d.setHours(tt); },
		1: function(tt){ return d.setMinutes(tt); },
		2: function(tt){ return d.setSeconds(tt); },
		3: function(tt){ return d.setMonth(parseInt(tt)-1); },
		4: function(tt){ return d.setDate(tt); },
		5: function(tt){ return d.setYear(tt); }
	};

	for( i = 0; i < argc; i++ ){
		if(argv[i] && isNaN(argv[i])){
			return false;
		} else if(argv[i]){
			// arg is number, let's manipulate date object
			if(!dateManip[i](argv[i])){
				// failed
				return false;
			}
		}
	}
    return Math.floor(d.getTime()/1000);
}
