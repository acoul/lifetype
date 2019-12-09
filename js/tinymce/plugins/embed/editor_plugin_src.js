/**
 * editor_plugin_src.js
 *
 * Copyright 2010, Lifetype Team, http://www.lifetype.net
 * Released under GPLv2 License.
 *
 * Original author : Chili Pepper Design, http://www.chilipepperdesign.com
 */

(function() {

    /**
    *  Base64 encode / decode
    *  http://www.webtoolkit.info/
    **/
    var Base64 = {

        // private property
        _keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

        // public method for encoding
        encode : function (input) {
            var output = "";
            var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
            var i = 0;

            input = Base64._utf8_encode(input);

            while (i < input.length) {

                chr1 = input.charCodeAt(i++);
                chr2 = input.charCodeAt(i++);
                chr3 = input.charCodeAt(i++);

                enc1 = chr1 >> 2;
                enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                enc4 = chr3 & 63;

                if (isNaN(chr2)) {
                    enc3 = enc4 = 64;
                } else if (isNaN(chr3)) {
                    enc4 = 64;
                }

                output = output +
                this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

            }

            return output;
        },

        // public method for decoding
        decode : function (input) {
            var output = "";
            var chr1, chr2, chr3;
            var enc1, enc2, enc3, enc4;
            var i = 0;

            input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

            while (i < input.length) {

                enc1 = this._keyStr.indexOf(input.charAt(i++));
                enc2 = this._keyStr.indexOf(input.charAt(i++));
                enc3 = this._keyStr.indexOf(input.charAt(i++));
                enc4 = this._keyStr.indexOf(input.charAt(i++));

                chr1 = (enc1 << 2) | (enc2 >> 4);
                chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                chr3 = ((enc3 & 3) << 6) | enc4;

                output = output + String.fromCharCode(chr1);

                if (enc3 != 64) {
                    output = output + String.fromCharCode(chr2);
                }
                if (enc4 != 64) {
                    output = output + String.fromCharCode(chr3);
                }

            }

            output = Base64._utf8_decode(output);

            return output;

        },

        // private method for UTF-8 encoding
        _utf8_encode : function (string) {
            string = string.replace(/\r\n/g,"\n");
            var utftext = "";

            for (var n = 0; n < string.length; n++) {

                var c = string.charCodeAt(n);

                if (c < 128) {
                    utftext += String.fromCharCode(c);
                }
                else if((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
                else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }

            }

            return utftext;
        },

        // private method for UTF-8 decoding
        _utf8_decode : function (utftext) {
            var string = "";
            var i = 0;
            var c = c1 = c2 = 0;

            while ( i < utftext.length ) {

                c = utftext.charCodeAt(i);

                if (c < 128) {
                    string += String.fromCharCode(c);
                    i++;
                }
                else if((c > 191) && (c < 224)) {
                    c2 = utftext.charCodeAt(i+1);
                    string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                    i += 2;
                }
                else {
                    c2 = utftext.charCodeAt(i+1);
                    c3 = utftext.charCodeAt(i+2);
                    string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                    i += 3;
                }

            }

            return string;
        }

    };

    tinymce.PluginManager.requireLangPack('embed');
    tinymce.create('tinymce.plugins.EmbedPlugin', {
        init : function(ed, url) {
            var t = this;
                t.ed = ed;
                t.url = url;

            ed.onBeforeSetContent.add(function(ed, o) {
                o.content = t._insertToEditor(t, o.content, 1);
            });

            ed.onPostProcess.add(function(ed, o) {
                if (o.set){
                    o.content = t._insertToEditor(t, o.content);
                }
                if (o.get){
                    o.content = t._getFromEditor(t, o.content);
                }
            });

            ed.onInit.add(function() {
                if (ed.settings.content_css !== false)
                    ed.dom.loadCSS(url + "/css/content.css");

                ed.selection.onBeforeSetContent.add(function(ed, o) {
                    o.content = t._insertToEditor(t, o.content, 2);
                });
            });

            // Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
            ed.addCommand('mceEmbed', function() {
                ed.windowManager.open({
                    file : url + '/dialog.htm',
                    width : 500 + parseInt(ed.getLang('embed.delta_width', 0)),
                    height : 320 + parseInt(ed.getLang('embed.delta_height', 0)),
                    inline : 1
                }, {
                    plugin_url : url // Plugin absolute URL
                });
            });

            // Register embed button
            ed.addButton('embed', {
                title : 'embed.desc',
                cmd : 'mceEmbed',
                image : url + '/img/embed.gif'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function(ed, cm, n) {
                cm.setActive('embed', n.nodeName == 'IMG');
            });
        },

        getInfo : function() {
            return {
                longname : 'Embed',
                author : 'LifeType Team',
                authorurl : 'http://www.lifetype.net',
                infourl : 'http://www.lifetype.net',
                version : tinymce.majorVersion + "." + tinymce.minorVersion
            };
        },

        _insertToEditor : function(t, content, mode) {
            // Parse all object tags and replace them with img
            cdom = tinymce.DOM.create('div');
            tinymce.DOM.setHTML(cdom, content);
            if( mode == 1)
                elems = tinymce.DOM.select('object:not([class=ltPlayer]):not([class^=ltVideo])', cdom);
            else
                elems = tinymce.DOM.select('object', cdom);

            tinymce.each(elems, function(e) {
                e.className = 'ltEmbed';
                data = Base64.encode(tinymce.DOM.getOuterHTML(e));
                height = e.height;
                width = e.width;
                imgHTML = t._getEmbedImgHTML(data, height, width);
                tinymce.DOM.setOuterHTML(e, imgHTML);
            });

            content = cdom.innerHTML;
            tinymce.DOM.remove(cdom);

            return content;
        },

        _getFromEditor : function(t, content) {
            // Parse all img[class=ltVideo*] tags and replace them with object+embed
            cdom = tinymce.DOM.create('div');
            tinymce.DOM.setHTML(cdom, content);
            elems = tinymce.DOM.select('img[class=ltEmbed]', cdom);

            tinymce.each(elems, function(e) {
                src = e.alt;
                embedHTML = Base64.decode(src);
                tinymce.DOM.setOuterHTML(e, embedHTML);
            });

            content = cdom.innerHTML;
            tinymce.DOM.remove(cdom);

            return content;
        },

        _getEmbedImgHTML : function(data, height, width) {
            html = '<img width="' + width + '" height="' + height + '"' +
                   ' src="' + this.url + '/img/spacer.gif' + '" title="' + data + '"' +
                   ' alt="' + data + '" class="ltEmbed" />';

            return html;
        }
    });

    // Register plugin
    tinymce.PluginManager.add('embed', tinymce.plugins.EmbedPlugin);
})();
