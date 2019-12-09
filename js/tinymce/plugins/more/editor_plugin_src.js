/**
 * editor_plugin_src.js
 *
 * Copyright 2010, Lifetype Team, http://www.lifetype.net
 * Released under GPLv2 License.
 */

(function() {
    tinymce.create('tinymce.plugins.MorePlugin', {
        init : function(ed, url) {
            var mb = '<img src="' + url + '/img/trans.gif" class="mceMore mceItemNoResize" />',
                cls = 'mceMore',
                clsp = '.'+cls,
                sep = ed.getParam('more_separator', "[@more@]"),
                mbRE = new RegExp(sep.replace(/[\?\.\*\[\]\(\)\{\}\+\^\$\:]/g, function(a) {return '\\' + a;}), 'g');

            var t = this;

            // Register commands
            ed.addCommand(cls, function() {
                elems = ed.dom.select(clsp, ed.getBody());
                if (elems.length < 1) {
                    ed.execCommand('mceInsertContent', 0, mb);
                } else {
                    tinymce.each(elems, function(e) {
                        ed.dom.remove(e);
                    });
                }
            });

            // Register buttons
            ed.addButton('more', {title : 'more.desc', image : url + '/img/icon.gif', cmd : cls});

            ed.onInit.add(function() {
                if (ed.settings.content_css !== false) {
                    ed.dom.loadCSS(url + "/css/content.css");
                }

                if (ed.theme.onResolveName) {
                    ed.theme.onResolveName.add(function(th, o) {
                        if (o.node.nodeName == 'IMG' && ed.dom.hasClass(o.node, cls))
                            o.name = 'more';
                    });
                }
            });

            ed.onClick.add(function(ed, e) {
                e = e.target;

                if (e.nodeName === 'IMG' && ed.dom.hasClass(e, cls))
                    ed.selection.select(e);
            });

            ed.onNodeChange.add(function(ed, cm, n) {
                elems = ed.dom.select(clsp, ed.getBody());
                if (elems.length < 1)
                    cm.setActive('more', false);
                else
                    cm.setActive('more', true);
            });

            ed.onBeforeSetContent.add(function(ed, o) {
                o.content = o.content.replace(mbRE, mb);
            });

            ed.onPostProcess.add(function(ed, o) {
                if (o.get)
                    o.content = o.content.replace(/<img[^>]+>/g, function(im) {
                        if (im.indexOf('class="mceMore') !== -1)
                            im = sep;

                        return im;
                    });
            });
        },

        getInfo : function() {
            return {
                longname : 'More',
                author : 'LifeType Team',
                authorurl : 'http://www.lifetype.net',
                infourl : 'http://www.lifetype.net',
                version : tinymce.majorVersion + "." + tinymce.minorVersion
            };
        },
    });

    // Register plugin
    tinymce.PluginManager.add('more', tinymce.plugins.MorePlugin);
})();
