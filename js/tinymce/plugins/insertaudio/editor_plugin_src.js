/**
 * editor_plugin_src.js
 *
 * Copyright 2010, Lifetype Team, http://www.lifetype.net
 * Released under GPLv2 License.
 */

(function() {
    tinymce.PluginManager.requireLangPack('insertaudio');
    tinymce.create('tinymce.plugins.InsertAudioPlugin', {
        init : function(ed, url) {
            // Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceInsertAudio');
            ed.addCommand('mceInsertAudio', function() {
                ed.windowManager.open({
                    file : url + '/dialog.htm',
                    width : 500,
                    height : 120,
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            // Register insertAudio button
            ed.addButton('insertaudio', {
                title : 'insertaudio.desc',
                cmd : 'mceInsertAudio',
                image : url + '/img/insertaudio.gif'
            });
        },

        getInfo : function() {
            return {
                longname : 'Insert Audio',
                author : 'LifeType Team',
                authorurl : 'http://www.lifetype.net',
                infourl : 'http://www.lifetype.net',
                version : tinymce.majorVersion + "." + tinymce.minorVersion
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('insertaudio', tinymce.plugins.InsertAudioPlugin);
})();
