tinymce_plugins="more,advhr,advimage,advlink,emotions,inlinepopups,insertdatetime,searchreplace,paste,fullscreen,nonbreaking,wordcount,autosave,insertaudio,insertresource,insertvideo,insertyoutube,embed";

tinyMCE_GZ.init({
            // user-defined plugins and themes should be identical to those in "tinyMCE.init" below.-->
      plugins : tinymce_plugins,
      themes : 'advanced',
      languages : 'en',
      disk_cache : false,
      debug : false
});

tinyMCE.init({
            // General options
            mode : "exact",
            elements : "postText,postExtendedText",
            theme : "advanced",
            plugins : tinymce_plugins,

            relative_urls : false,
            remove_script_host : false,

                // Theme options
            theme_advanced_buttons1: "formatselect,fontsizeselect,fontselect,forecolor,backcolor,bold,italic,underline,strikethrough,sub,sup,|,justifyleft,justifycenter,justifyright,justifyfull",
            theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,indent,outdent,blockquote,|,undo,redo,|,hr,advhr,charmap,insertdate,inserttime,nonbreaking,|,fullscreen",
            theme_advanced_buttons3 : "link,unlink,anchor,|,emotions,image,insertresource,insertaudio,insertvideo,insertyoutube,embed,|,code,more,|,cleanup,removeformat",
            theme_advanced_buttons4 : "",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,
            theme_advanced_resize_horizontal : false,
});
