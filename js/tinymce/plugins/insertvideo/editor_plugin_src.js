/**
 * editor_plugin_src.js
 *
 * Copyright 2010, Lifetype Team, http://www.lifetype.net
 * Released under GPLv2 License.
 */

(function() {
    tinymce.PluginManager.requireLangPack('insertvideo');
    tinymce.create('tinymce.plugins.InsertVideoPlugin', {
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

            ed.addCommand('mceInsertVideo', function() {
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
            ed.addButton('insertvideo', {
                title : 'insertvideo.desc',
                cmd : 'mceInsertVideo',
                image : url + '/img/vimeo.png'
            });

            ed.onInit.add(function() {
                if (ed.settings.content_css !== false)
                    ed.dom.loadCSS(url + "/css/content.css");
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
            elems = tinymce.DOM.select('object[data]', cdom);

            tinymce.each(elems, function(e) {
                src = e.data;
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
            elems = tinymce.DOM.select('img[class^=ltVideo]', cdom);

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
                GoogleVideo : {regexp : /^http:\/\/video\.google\.com\//, cls : 'ltVideoGoogleVideo'},
                Metacafe    : {regexp : /^http:\/\/www\.metacafe\.com\//, cls : 'ltVideoMetacafe'},
                Ifilm       : {regexp : /^http:\/\/www\.ifilm\.com\//, cls : 'ltVideoIfilm'},
                VideoGoear  : {regexp : /^http:\/\/www\.goear.com\//, cls : 'ltVideoGoear'},
                Grouper     : {regexp : /^http:\/\/www\.grouper\.com\//, cls : 'ltVideoGrouper'},
                DailyMotion : {regexp : /^http:\/\/www\.dailymotion\.com\//, cls : 'ltVideoDailymot'},
                Vimeo       : {regexp : /^http:\/\/vimeo\.com\//, cls : 'ltVideoVimeo'}
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
            result = cls.match(/^ltVideo(GoogleVideo|Metacafe|Ifilm|Goear|Grouper|Dailymot|Vimeo)/);

            return (result ? 'ltVideo'+result[1] : false);
        },

        _getVideoImgHTML : function(src, height, width, cls) {
            html = '<img width="' + width + '" height="' + height + '"' +
                   ' src="' + this.url + '/img/spacer.gif' + '" title="' + src + '"' +
                   ' alt="' + src + '" class="'+ cls +'" />';

            return html;
        },

        _getVideoFlashHTML : function(url, height, width, cls)
        {
            html = '<object type="application/x-shockwave-flash" width="' + width + '" height="' + height + '" data="' + url + '" class="' + cls + '">' +
                   '<param name="movie" value="' + url + '" />' +
                   '<param name="wmode" value="transparent" />' +
                   '<param name="allowScriptAccess" value="sameDomain" />' +
                   '<param name="quality" value="best" />' +
                   '<param name="bgcolor" value="#ffffff" />';
            if (cls == 'ltVideoGoear') {
                html += '<param name="FlashVars" value="' + url.substring( 43, url.length ) + '" />';
            } else {
                html += '<param name="FlashVars" value="playerMode=embedded" />';
            }

            html += '</object>';

            return html;
        }

    });

    // Register plugin
    tinymce.PluginManager.add('insertvideo', tinymce.plugins.InsertVideoPlugin);
})();
