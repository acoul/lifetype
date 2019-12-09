/**
 * editor_plugin_src.js
 *
 * Copyright 2010, Lifetype Team, http://www.lifetype.net
 * Released under GPLv2 License.
 */

(function() {
    tinymce.PluginManager.requireLangPack('insertyoutube');
    tinymce.create('tinymce.plugins.InsertYoutubePlugin', {
        init : function(ed, url) {
            var t = this;
                t.ed = ed;
                t.url = url;

            ed.onBeforeSetContent.add(function(ed, o) {
                o.content = t._insertToEditor(t, o.content);
            });

            ed.onPostProcess.add(function(ed, o) {
                if (o.set){
                    o.content = t._insertToEditor(t, o.content);
                }
                if (o.get){
                    o.content = t._getFromEditor(t, o.content);
                }
            });

            ed.addCommand('mceInsertYoutube', function() {
                ed.windowManager.open({
                    file : url + '/videoinput.html',
                    width : 500,
                    height : 300,
                    inline : 1
                }, {
                    plugin_url : url
                });
            });

            // Register insertresource button
            ed.addButton('insertyoutube', {
                title : 'insertyoutube.desc',
                cmd : 'mceInsertYoutube',
                image : url + '/img/youtube.png'
            });
        },

        getInfo : function() {
            return {
                longname : 'Insert Video',
                author : 'LifeType Team',
                authorurl : 'http://www.lifetype.net',
                infourl : 'http://www.lifetype.net',
                version : tinymce.majorVersion + "." + tinymce.minorVersion
            };
        },

        _insertToEditor : function(t, content) {
            // Parse all object tags and replace them with img
            cdom = tinymce.DOM.create('div');
            tinymce.DOM.setHTML(cdom, content);
            elems = tinymce.DOM.select('iframe', cdom);

            tinymce.each(elems, function(e) {
                src = e.src;
                cls = t._getVideoType(src);
                if (src && cls) {
                    height = e.height;
                    width = e.width;
                    imgHTML = t._getVideoImgHTML(src, height, width, cls);
                    tinymce.DOM.setOuterHTML(e, imgHTML);
                }
            });

            content = cdom.innerHTML;
            tinymce.DOM.remove(cdom);

            return content;
        },

        _getFromEditor : function(t, content) {
            // Parse all img[class=ltVideo*] tags and replace them with object+embed
            cdom = tinymce.DOM.create('div');
            tinymce.DOM.setHTML(cdom, content);
            elems = tinymce.DOM.select('img[class^=ltYoutube]', cdom);

            tinymce.each(elems, function(e) {
                cls = t._isValidVideoType(e.className);
                src = e.alt;
                if (src && cls) {
                    height = e.height;
                    width = e.width;
                    embedHTML = t._getVideoFlashHTML(src, height, width, cls);
                    tinymce.DOM.setOuterHTML(e, embedHTML);
                }
            });

            content = cdom.innerHTML;
            tinymce.DOM.remove(cdom);

            return content;
        },

        _getVideoType : function(url)
        {
          var sites = {
                YouTube     : {regexp : /^http:\/\/.{2,3}\.youtube\.com\//, cls : 'ltYoutube'},
            };

            var cls = '';
            for (site in sites) {
                if (url.match(sites[site].regexp)) {
                    cls = sites[site].cls;
                    break;
                }
            }

            return( cls );
        },

        _isValidVideoType: function(cls) {
            return (cls == 'ltYoutube');
        },

        _getVideoImgHTML : function(src, height, width, cls) {
            html = '<img width="' + width + '" height="' + height + '"' +
                   ' src="' + this.url + '/img/spacer.gif' + '" title="' + src + '"' +
                   ' alt="' + src + '" class="'+ cls +'" />';

            return html;
        },

        _getVideoFlashHTML : function(url, height, width, cls)
        {
            html = '<iframe class="'+cls+'" width="'+width+'" height="'+height+'" src="'+url+
                '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
            return html;
        }

    });

    // Register plugin
    tinymce.PluginManager.add('insertyoutube', tinymce.plugins.InsertYoutubePlugin);
})();
