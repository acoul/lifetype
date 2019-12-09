
(function(win){var whiteSpaceRe=/^\s*|\s*$/g,undefined;var tinymce={majorVersion:'3',minorVersion:'3.9',releaseDate:'2010-09-08',_init:function(){var t=this,d=document,na=navigator,ua=na.userAgent,i,nl,n,base,p,v;t.isOpera=win.opera&&opera.buildNumber;t.isWebKit=/WebKit/.test(ua);t.isIE=!t.isWebKit&&!t.isOpera&&(/MSIE/gi).test(ua)&&(/Explorer/gi).test(na.appName);t.isIE6=t.isIE&&/MSIE [56]/.test(ua);t.isGecko=!t.isWebKit&&/Gecko/.test(ua);t.isMac=ua.indexOf('Mac')!=-1;t.isAir=/adobeair/i.test(ua);t.isIDevice=/(iPad|iPhone)/.test(ua);if(win.tinyMCEPreInit){t.suffix=tinyMCEPreInit.suffix;t.baseURL=tinyMCEPreInit.base;t.query=tinyMCEPreInit.query;return;}
t.suffix='';nl=d.getElementsByTagName('base');for(i=0;i<nl.length;i++){if(v=nl[i].href){if(/^https?:\/\/[^\/]+$/.test(v))
v+='/';base=v?v.match(/.*\//)[0]:'';}}
function getBase(n){if(n.src&&/tiny_mce(|_gzip|_jquery|_prototype|_full)(_dev|_src)?.js/.test(n.src)){if(/_(src|dev)\.js/g.test(n.src))
t.suffix='_src';if((p=n.src.indexOf('?'))!=-1)
t.query=n.src.substring(p+1);t.baseURL=n.src.substring(0,n.src.lastIndexOf('/'));if(base&&t.baseURL.indexOf('://')==-1&&t.baseURL.indexOf('/')!==0)
t.baseURL=base+t.baseURL;return t.baseURL;}
return null;};nl=d.getElementsByTagName('script');for(i=0;i<nl.length;i++){if(getBase(nl[i]))
return;}
n=d.getElementsByTagName('head')[0];if(n){nl=n.getElementsByTagName('script');for(i=0;i<nl.length;i++){if(getBase(nl[i]))
return;}}
return;},is:function(o,t){if(!t)
return o!==undefined;if(t=='array'&&(o.hasOwnProperty&&o instanceof Array))
return true;return typeof(o)==t;},each:function(o,cb,s){var n,l;if(!o)
return 0;s=s||o;if(o.length!==undefined){for(n=0,l=o.length;n<l;n++){if(cb.call(s,o[n],n,o)===false)
return 0;}}else{for(n in o){if(o.hasOwnProperty(n)){if(cb.call(s,o[n],n,o)===false)
return 0;}}}
return 1;},map:function(a,f){var o=[];tinymce.each(a,function(v){o.push(f(v));});return o;},grep:function(a,f){var o=[];tinymce.each(a,function(v){if(!f||f(v))
o.push(v);});return o;},inArray:function(a,v){var i,l;if(a){for(i=0,l=a.length;i<l;i++){if(a[i]===v)
return i;}}
return-1;},extend:function(o,e){var i,l,a=arguments;for(i=1,l=a.length;i<l;i++){e=a[i];tinymce.each(e,function(v,n){if(v!==undefined)
o[n]=v;});}
return o;},trim:function(s){return(s?''+s:'').replace(whiteSpaceRe,'');},create:function(s,p){var t=this,sp,ns,cn,scn,c,de=0;s=/^((static) )?([\w.]+)(:([\w.]+))?/.exec(s);cn=s[3].match(/(^|\.)(\w+)$/i)[2];ns=t.createNS(s[3].replace(/\.\w+$/,''));if(ns[cn])
return;if(s[2]=='static'){ns[cn]=p;if(this.onCreate)
this.onCreate(s[2],s[3],ns[cn]);return;}
if(!p[cn]){p[cn]=function(){};de=1;}
ns[cn]=p[cn];t.extend(ns[cn].prototype,p);if(s[5]){sp=t.resolve(s[5]).prototype;scn=s[5].match(/\.(\w+)$/i)[1];c=ns[cn];if(de){ns[cn]=function(){return sp[scn].apply(this,arguments);};}else{ns[cn]=function(){this.parent=sp[scn];return c.apply(this,arguments);};}
ns[cn].prototype[cn]=ns[cn];t.each(sp,function(f,n){ns[cn].prototype[n]=sp[n];});t.each(p,function(f,n){if(sp[n]){ns[cn].prototype[n]=function(){this.parent=sp[n];return f.apply(this,arguments);};}else{if(n!=cn)
ns[cn].prototype[n]=f;}});}
t.each(p['static'],function(f,n){ns[cn][n]=f;});if(this.onCreate)
this.onCreate(s[2],s[3],ns[cn].prototype);},walk:function(o,f,n,s){s=s||this;if(o){if(n)
o=o[n];tinymce.each(o,function(o,i){if(f.call(s,o,i,n)===false)
return false;tinymce.walk(o,f,n,s);});}},createNS:function(n,o){var i,v;o=o||win;n=n.split('.');for(i=0;i<n.length;i++){v=n[i];if(!o[v])
o[v]={};o=o[v];}
return o;},resolve:function(n,o){var i,l;o=o||win;n=n.split('.');for(i=0,l=n.length;i<l;i++){o=o[n[i]];if(!o)
break;}
return o;},addUnload:function(f,s){var t=this;f={func:f,scope:s||this};if(!t.unloads){function unload(){var li=t.unloads,o,n;if(li){for(n in li){o=li[n];if(o&&o.func)
o.func.call(o.scope,1);}
if(win.detachEvent){win.detachEvent('onbeforeunload',fakeUnload);win.detachEvent('onunload',unload);}else if(win.removeEventListener)
win.removeEventListener('unload',unload,false);t.unloads=o=li=w=unload=0;if(win.CollectGarbage)
CollectGarbage();}};function fakeUnload(){var d=document;if(d.readyState=='interactive'){function stop(){d.detachEvent('onstop',stop);if(unload)
unload();d=0;};if(d)
d.attachEvent('onstop',stop);win.setTimeout(function(){if(d)
d.detachEvent('onstop',stop);},0);}};if(win.attachEvent){win.attachEvent('onunload',unload);win.attachEvent('onbeforeunload',fakeUnload);}else if(win.addEventListener)
win.addEventListener('unload',unload,false);t.unloads=[f];}else
t.unloads.push(f);return f;},removeUnload:function(f){var u=this.unloads,r=null;tinymce.each(u,function(o,i){if(o&&o.func==f){u.splice(i,1);r=f;return false;}});return r;},explode:function(s,d){return s?tinymce.map(s.split(d||','),tinymce.trim):s;},_addVer:function(u){var v;if(!this.query)
return u;v=(u.indexOf('?')==-1?'?':'&')+this.query;if(u.indexOf('#')==-1)
return u+v;return u.replace('#',v+'#');}};tinymce._init();win.tinymce=win.tinyMCE=tinymce;})(window);tinymce.create('tinymce.util.Dispatcher',{scope:null,listeners:null,Dispatcher:function(s){this.scope=s||this;this.listeners=[];},add:function(cb,s){this.listeners.push({cb:cb,scope:s||this.scope});return cb;},addToTop:function(cb,s){this.listeners.unshift({cb:cb,scope:s||this.scope});return cb;},remove:function(cb){var l=this.listeners,o=null;tinymce.each(l,function(c,i){if(cb==c.cb){o=cb;l.splice(i,1);return false;}});return o;},dispatch:function(){var s,a=arguments,i,li=this.listeners,c;for(i=0;i<li.length;i++){c=li[i];s=c.cb.apply(c.scope,a);if(s===false)
break;}
return s;}});(function(){var each=tinymce.each;tinymce.create('tinymce.util.URI',{URI:function(u,s){var t=this,o,a,b;u=tinymce.trim(u);s=t.settings=s||{};if(/^(mailto|tel|news|javascript|about|data):/i.test(u)||/^\s*#/.test(u)){t.source=u;return;}
if(u.indexOf('/')===0&&u.indexOf('//')!==0)
u=(s.base_uri?s.base_uri.protocol||'http':'http')+'://mce_host'+u;if(!/^\w*:?\/\//.test(u))
u=(s.base_uri.protocol||'http')+'://mce_host'+t.toAbsPath(s.base_uri.path,u);u=u.replace(/@@/g,'(mce_at)');u=/^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(u);each(["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],function(v,i){var s=u[i];if(s)
s=s.replace(/\(mce_at\)/g,'@@');t[v]=s;});if(b=s.base_uri){if(!t.protocol)
t.protocol=b.protocol;if(!t.userInfo)
t.userInfo=b.userInfo;if(!t.port&&t.host=='mce_host')
t.port=b.port;if(!t.host||t.host=='mce_host')
t.host=b.host;t.source='';}},setPath:function(p){var t=this;p=/^(.*?)\/?(\w+)?$/.exec(p);t.path=p[0];t.directory=p[1];t.file=p[2];t.source='';t.getURI();},toRelative:function(u){var t=this,o;if(u==="./")
return u;u=new tinymce.util.URI(u,{base_uri:t});if((u.host!='mce_host'&&t.host!=u.host&&u.host)||t.port!=u.port||t.protocol!=u.protocol)
return u.getURI();o=t.toRelPath(t.path,u.path);if(u.query)
o+='?'+u.query;if(u.anchor)
o+='#'+u.anchor;return o;},toAbsolute:function(u,nh){var u=new tinymce.util.URI(u,{base_uri:this});return u.getURI(this.host==u.host&&this.protocol==u.protocol?nh:0);},toRelPath:function(base,path){var items,bp=0,out='',i,l;base=base.substring(0,base.lastIndexOf('/'));base=base.split('/');items=path.split('/');if(base.length>=items.length){for(i=0,l=base.length;i<l;i++){if(i>=items.length||base[i]!=items[i]){bp=i+1;break;}}}
if(base.length<items.length){for(i=0,l=items.length;i<l;i++){if(i>=base.length||base[i]!=items[i]){bp=i+1;break;}}}
if(bp==1)
return path;for(i=0,l=base.length-(bp-1);i<l;i++)
out+="../";for(i=bp-1,l=items.length;i<l;i++){if(i!=bp-1)
out+="/"+items[i];else
out+=items[i];}
return out;},toAbsPath:function(base,path){var i,nb=0,o=[],tr,outPath;tr=/\/$/.test(path)?'/':'';base=base.split('/');path=path.split('/');each(base,function(k){if(k)
o.push(k);});base=o;for(i=path.length-1,o=[];i>=0;i--){if(path[i].length==0||path[i]==".")
continue;if(path[i]=='..'){nb++;continue;}
if(nb>0){nb--;continue;}
o.push(path[i]);}
i=base.length-nb;if(i<=0)
outPath=o.reverse().join('/');else
outPath=base.slice(0,i).join('/')+'/'+o.reverse().join('/');if(outPath.indexOf('/')!==0)
outPath='/'+outPath;if(tr&&outPath.lastIndexOf('/')!==outPath.length-1)
outPath+=tr;return outPath;},getURI:function(nh){var s,t=this;if(!t.source||nh){s='';if(!nh){if(t.protocol)
s+=t.protocol+'://';if(t.userInfo)
s+=t.userInfo+'@';if(t.host)
s+=t.host;if(t.port)
s+=':'+t.port;}
if(t.path)
s+=t.path;if(t.query)
s+='?'+t.query;if(t.anchor)
s+='#'+t.anchor;t.source=s;}
return t.source;}});})();(function(){var each=tinymce.each;tinymce.create('static tinymce.util.Cookie',{getHash:function(n){var v=this.get(n),h;if(v){each(v.split('&'),function(v){v=v.split('=');h=h||{};h[unescape(v[0])]=unescape(v[1]);});}
return h;},setHash:function(n,v,e,p,d,s){var o='';each(v,function(v,k){o+=(!o?'':'&')+escape(k)+'='+escape(v);});this.set(n,o,e,p,d,s);},get:function(n){var c=document.cookie,e,p=n+"=",b;if(!c)
return;b=c.indexOf("; "+p);if(b==-1){b=c.indexOf(p);if(b!=0)
return null;}else
b+=2;e=c.indexOf(";",b);if(e==-1)
e=c.length;return unescape(c.substring(b+p.length,e));},set:function(n,v,e,p,d,s){document.cookie=n+"="+escape(v)+
((e)?"; expires="+e.toGMTString():"")+
((p)?"; path="+escape(p):"")+
((d)?"; domain="+d:"")+
((s)?"; secure":"");},remove:function(n,p){var d=new Date();d.setTime(d.getTime()-1000);this.set(n,'',d,p,d);}});})();tinymce.create('static tinymce.util.JSON',{serialize:function(o){var i,v,s=tinymce.util.JSON.serialize,t;if(o==null)
return'null';t=typeof o;if(t=='string'){v='\bb\tt\nn\ff\rr\""\'\'\\\\';return'"'+o.replace(/([\u0080-\uFFFF\x00-\x1f\"])/g,function(a,b){i=v.indexOf(b);if(i+1)
return'\\'+v.charAt(i+1);a=b.charCodeAt().toString(16);return'\\u'+'0000'.substring(a.length)+a;})+'"';}
if(t=='object'){if(o.hasOwnProperty&&o instanceof Array){for(i=0,v='[';i<o.length;i++)
v+=(i>0?',':'')+s(o[i]);return v+']';}
v='{';for(i in o)
v+=typeof o[i]!='function'?(v.length>1?',"':'"')+i+'":'+s(o[i]):'';return v+'}';}
return''+o;},parse:function(s){try{return eval('('+s+')');}catch(ex){}}});tinymce.create('static tinymce.util.XHR',{send:function(o){var x,t,w=window,c=0;o.scope=o.scope||this;o.success_scope=o.success_scope||o.scope;o.error_scope=o.error_scope||o.scope;o.async=o.async===false?false:true;o.data=o.data||'';function get(s){x=0;try{x=new ActiveXObject(s);}catch(ex){}
return x;};x=w.XMLHttpRequest?new XMLHttpRequest():get('Microsoft.XMLHTTP')||get('Msxml2.XMLHTTP');if(x){if(x.overrideMimeType)
x.overrideMimeType(o.content_type);x.open(o.type||(o.data?'POST':'GET'),o.url,o.async);if(o.content_type)
x.setRequestHeader('Content-Type',o.content_type);x.setRequestHeader('X-Requested-With','XMLHttpRequest');x.send(o.data);function ready(){if(!o.async||x.readyState==4||c++>10000){if(o.success&&c<10000&&x.status==200)
o.success.call(o.success_scope,''+x.responseText,x,o);else if(o.error)
o.error.call(o.error_scope,c>10000?'TIMED_OUT':'GENERAL',x,o);x=null;}else
w.setTimeout(ready,10);};if(!o.async)
return ready();t=w.setTimeout(ready,10);}}});(function(){var extend=tinymce.extend,JSON=tinymce.util.JSON,XHR=tinymce.util.XHR;tinymce.create('tinymce.util.JSONRequest',{JSONRequest:function(s){this.settings=extend({},s);this.count=0;},send:function(o){var ecb=o.error,scb=o.success;o=extend(this.settings,o);o.success=function(c,x){c=JSON.parse(c);if(typeof(c)=='undefined'){c={error:'JSON Parse error.'};}
if(c.error)
ecb.call(o.error_scope||o.scope,c.error,x);else
scb.call(o.success_scope||o.scope,c.result);};o.error=function(ty,x){ecb.call(o.error_scope||o.scope,ty,x);};o.data=JSON.serialize({id:o.id||'c'+(this.count++),method:o.method,params:o.params});o.content_type='application/json';XHR.send(o);},'static':{sendRPC:function(o){return new tinymce.util.JSONRequest().send(o);}}});}());(function(tinymce){var each=tinymce.each,is=tinymce.is,isWebKit=tinymce.isWebKit,isIE=tinymce.isIE,blockRe=/^(H[1-6R]|P|DIV|ADDRESS|PRE|FORM|T(ABLE|BODY|HEAD|FOOT|H|R|D)|LI|OL|UL|CAPTION|BLOCKQUOTE|CENTER|DL|DT|DD|DIR|FIELDSET|NOSCRIPT|MENU|ISINDEX|SAMP)$/,boolAttrs=makeMap('checked,compact,declare,defer,disabled,ismap,multiple,nohref,noresize,noshade,nowrap,readonly,selected'),mceAttribs=makeMap('src,href,style,coords,shape'),encodedChars={'&':'&amp;','"':'&quot;','<':'&lt;','>':'&gt;'},encodeCharsRe=/[<>&\"]/g,simpleSelectorRe=/^([a-z0-9],?)+$/i,tagRegExp=/<(\w+)((?:\s+\w+(?:\s*=\s*(?:(?:"[^"]*")|(?:'[^']*')|[^>\s]+))?)*)(\s*\/?)>/g,attrRegExp=/(\w+)(?:\s*=\s*(?:(?:"((?:\\.|[^"])*)")|(?:'((?:\\.|[^'])*)')|([^>\s]+)))?/g;function makeMap(str){var map={},i;str=str.split(',');for(i=str.length;i>=0;i--)
map[str[i]]=1;return map;};tinymce.create('tinymce.dom.DOMUtils',{doc:null,root:null,files:null,pixelStyles:/^(top|left|bottom|right|width|height|borderWidth)$/,props:{"for":"htmlFor","class":"className",className:"className",checked:"checked",disabled:"disabled",maxlength:"maxLength",readonly:"readOnly",selected:"selected",value:"value",id:"id",name:"name",type:"type"},DOMUtils:function(d,s){var t=this,globalStyle;t.doc=d;t.win=window;t.files={};t.cssFlicker=false;t.counter=0;t.boxModel=!tinymce.isIE||d.compatMode=="CSS1Compat";t.stdMode=d.documentMode===8;t.settings=s=tinymce.extend({keep_values:false,hex_colors:1,process_html:1},s);if(tinymce.isIE6){try{d.execCommand('BackgroundImageCache',false,true);}catch(e){t.cssFlicker=true;}}
if(s.valid_styles){t._styles={};each(s.valid_styles,function(value,key){t._styles[key]=tinymce.explode(value);});}
tinymce.addUnload(t.destroy,t);},getRoot:function(){var t=this,s=t.settings;return(s&&t.get(s.root_element))||t.doc.body;},getViewPort:function(w){var d,b;w=!w?this.win:w;d=w.document;b=this.boxModel?d.documentElement:d.body;return{x:w.pageXOffset||b.scrollLeft,y:w.pageYOffset||b.scrollTop,w:w.innerWidth||b.clientWidth,h:w.innerHeight||b.clientHeight};},getRect:function(e){var p,t=this,sr;e=t.get(e);p=t.getPos(e);sr=t.getSize(e);return{x:p.x,y:p.y,w:sr.w,h:sr.h};},getSize:function(e){var t=this,w,h;e=t.get(e);w=t.getStyle(e,'width');h=t.getStyle(e,'height');if(w.indexOf('px')===-1)
w=0;if(h.indexOf('px')===-1)
h=0;return{w:parseInt(w)||e.offsetWidth||e.clientWidth,h:parseInt(h)||e.offsetHeight||e.clientHeight};},getParent:function(n,f,r){return this.getParents(n,f,r,false);},getParents:function(n,f,r,c){var t=this,na,se=t.settings,o=[];n=t.get(n);c=c===undefined;if(se.strict_root)
r=r||t.getRoot();if(is(f,'string')){na=f;if(f==='*'){f=function(n){return n.nodeType==1;};}else{f=function(n){return t.is(n,na);};}}
while(n){if(n==r||!n.nodeType||n.nodeType===9)
break;if(!f||f(n)){if(c)
o.push(n);else
return n;}
n=n.parentNode;}
return c?o:null;},get:function(e){var n;if(e&&this.doc&&typeof(e)=='string'){n=e;e=this.doc.getElementById(e);if(e&&e.id!==n)
return this.doc.getElementsByName(n)[1];}
return e;},getNext:function(node,selector){return this._findSib(node,selector,'nextSibling');},getPrev:function(node,selector){return this._findSib(node,selector,'previousSibling');},select:function(pa,s){var t=this;return tinymce.dom.Sizzle(pa,t.get(s)||t.get(t.settings.root_element)||t.doc,[]);},is:function(n,selector){var i;if(n.length===undefined){if(selector==='*')
return n.nodeType==1;if(simpleSelectorRe.test(selector)){selector=selector.toLowerCase().split(/,/);n=n.nodeName.toLowerCase();for(i=selector.length-1;i>=0;i--){if(selector[i]==n)
return true;}
return false;}}
return tinymce.dom.Sizzle.matches(selector,n.nodeType?[n]:n).length>0;},add:function(p,n,a,h,c){var t=this;return this.run(p,function(p){var e,k;e=is(n,'string')?t.doc.createElement(n):n;t.setAttribs(e,a);if(h){if(h.nodeType)
e.appendChild(h);else
t.setHTML(e,h);}
return!c?p.appendChild(e):e;});},create:function(n,a,h){return this.add(this.doc.createElement(n),n,a,h,1);},createHTML:function(n,a,h){var o='',t=this,k;o+='<'+n;for(k in a){if(a.hasOwnProperty(k))
o+=' '+k+'="'+t.encode(a[k])+'"';}
if(tinymce.is(h))
return o+'>'+h+'</'+n+'>';return o+' />';},remove:function(node,keep_children){return this.run(node,function(node){var parent,child;parent=node.parentNode;if(!parent)
return null;if(keep_children){while(child=node.firstChild){if(!tinymce.isIE||child.nodeType!==3||child.nodeValue)
parent.insertBefore(child,node);else
node.removeChild(child);}}
return parent.removeChild(node);});},setStyle:function(n,na,v){var t=this;return t.run(n,function(e){var s,i;s=e.style;na=na.replace(/-(\D)/g,function(a,b){return b.toUpperCase();});if(t.pixelStyles.test(na)&&(tinymce.is(v,'number')||/^[\-0-9\.]+$/.test(v)))
v+='px';switch(na){case'opacity':if(isIE){s.filter=v===''?'':"alpha(opacity="+(v*100)+")";if(!n.currentStyle||!n.currentStyle.hasLayout)
s.display='inline-block';}
s[na]=s['-moz-opacity']=s['-khtml-opacity']=v||'';break;case'float':isIE?s.styleFloat=v:s.cssFloat=v;break;default:s[na]=v||'';}
if(t.settings.update_styles)
t.setAttrib(e,'_mce_style');});},getStyle:function(n,na,c){n=this.get(n);if(!n)
return false;if(this.doc.defaultView&&c){na=na.replace(/[A-Z]/g,function(a){return'-'+a;});try{return this.doc.defaultView.getComputedStyle(n,null).getPropertyValue(na);}catch(ex){return null;}}
na=na.replace(/-(\D)/g,function(a,b){return b.toUpperCase();});if(na=='float')
na=isIE?'styleFloat':'cssFloat';if(n.currentStyle&&c)
return n.currentStyle[na];return n.style[na];},setStyles:function(e,o){var t=this,s=t.settings,ol;ol=s.update_styles;s.update_styles=0;each(o,function(v,n){t.setStyle(e,n,v);});s.update_styles=ol;if(s.update_styles)
t.setAttrib(e,s.cssText);},setAttrib:function(e,n,v){var t=this;if(!e||!n)
return;if(t.settings.strict)
n=n.toLowerCase();return this.run(e,function(e){var s=t.settings;switch(n){case"style":if(!is(v,'string')){each(v,function(v,n){t.setStyle(e,n,v);});return;}
if(s.keep_values){if(v&&!t._isRes(v))
e.setAttribute('_mce_style',v,2);else
e.removeAttribute('_mce_style',2);}
e.style.cssText=v;break;case"class":e.className=v||'';break;case"src":case"href":if(s.keep_values){if(s.url_converter)
v=s.url_converter.call(s.url_converter_scope||t,v,n,e);t.setAttrib(e,'_mce_'+n,v,2);}
break;case"shape":e.setAttribute('_mce_style',v);break;}
if(is(v)&&v!==null&&v.length!==0)
e.setAttribute(n,''+v,2);else
e.removeAttribute(n,2);});},setAttribs:function(e,o){var t=this;return this.run(e,function(e){each(o,function(v,n){t.setAttrib(e,n,v);});});},getAttrib:function(e,n,dv){var v,t=this;e=t.get(e);if(!e||e.nodeType!==1)
return false;if(!is(dv))
dv='';if(/^(src|href|style|coords|shape)$/.test(n)){v=e.getAttribute("_mce_"+n);if(v)
return v;}
if(isIE&&t.props[n]){v=e[t.props[n]];v=v&&v.nodeValue?v.nodeValue:v;}
if(!v)
v=e.getAttribute(n,2);if(/^(checked|compact|declare|defer|disabled|ismap|multiple|nohref|noshade|nowrap|readonly|selected)$/.test(n)){if(e[t.props[n]]===true&&v==='')
return n;return v?n:'';}
if(e.nodeName==="FORM"&&e.getAttributeNode(n))
return e.getAttributeNode(n).nodeValue;if(n==='style'){v=v||e.style.cssText;if(v){v=t.serializeStyle(t.parseStyle(v),e.nodeName);if(t.settings.keep_values&&!t._isRes(v))
e.setAttribute('_mce_style',v);}}
if(isWebKit&&n==="class"&&v)
v=v.replace(/(apple|webkit)\-[a-z\-]+/gi,'');if(isIE){switch(n){case'rowspan':case'colspan':if(v===1)
v='';break;case'size':if(v==='+0'||v===20||v===0)
v='';break;case'width':case'height':case'vspace':case'checked':case'disabled':case'readonly':if(v===0)
v='';break;case'hspace':if(v===-1)
v='';break;case'maxlength':case'tabindex':if(v===32768||v===2147483647||v==='32768')
v='';break;case'multiple':case'compact':case'noshade':case'nowrap':if(v===65535)
return n;return dv;case'shape':v=v.toLowerCase();break;default:if(n.indexOf('on')===0&&v)
v=(''+v).replace(/^function\s+\w+\(\)\s+\{\s+(.*)\s+\}$/,'$1');}}
return(v!==undefined&&v!==null&&v!=='')?''+v:dv;},getPos:function(n,ro){var t=this,x=0,y=0,e,d=t.doc,r;n=t.get(n);ro=ro||d.body;if(n){if(isIE&&!t.stdMode){n=n.getBoundingClientRect();e=t.boxModel?d.documentElement:d.body;x=t.getStyle(t.select('html')[0],'borderWidth');x=(x=='medium'||t.boxModel&&!t.isIE6)&&2||x;return{x:n.left+e.scrollLeft-x,y:n.top+e.scrollTop-x};}
r=n;while(r&&r!=ro&&r.nodeType){x+=r.offsetLeft||0;y+=r.offsetTop||0;r=r.offsetParent;}
r=n.parentNode;while(r&&r!=ro&&r.nodeType){x-=r.scrollLeft||0;y-=r.scrollTop||0;r=r.parentNode;}}
return{x:x,y:y};},parseStyle:function(st){var t=this,s=t.settings,o={};if(!st)
return o;function compress(p,s,ot){var t,r,b,l;t=o[p+'-top'+s];if(!t)
return;r=o[p+'-right'+s];if(t!=r)
return;b=o[p+'-bottom'+s];if(r!=b)
return;l=o[p+'-left'+s];if(b!=l)
return;o[ot]=l;delete o[p+'-top'+s];delete o[p+'-right'+s];delete o[p+'-bottom'+s];delete o[p+'-left'+s];};function compress2(ta,a,b,c){var t;t=o[a];if(!t)
return;t=o[b];if(!t)
return;t=o[c];if(!t)
return;o[ta]=o[a]+' '+o[b]+' '+o[c];delete o[a];delete o[b];delete o[c];};st=st.replace(/&(#?[a-z0-9]+);/g,'&$1_MCE_SEMI_');each(st.split(';'),function(v){var sv,ur=[];if(v){v=v.replace(/_MCE_SEMI_/g,';');v=v.replace(/url\([^\)]+\)/g,function(v){ur.push(v);return'url('+ur.length+')';});v=v.split(':');sv=tinymce.trim(v[1]);sv=sv.replace(/url\(([^\)]+)\)/g,function(a,b){return ur[parseInt(b)-1];});sv=sv.replace(/rgb\([^\)]+\)/g,function(v){return t.toHex(v);});if(s.url_converter){sv=sv.replace(/url\([\'\"]?([^\)\'\"]+)[\'\"]?\)/g,function(x,c){return'url('+s.url_converter.call(s.url_converter_scope||t,t.decode(c),'style',null)+')';});}
o[tinymce.trim(v[0]).toLowerCase()]=sv;}});compress("border","","border");compress("border","-width","border-width");compress("border","-color","border-color");compress("border","-style","border-style");compress("padding","","padding");compress("margin","","margin");compress2('border','border-width','border-style','border-color');if(isIE){if(o.border=='medium none')
o.border='';}
return o;},serializeStyle:function(o,name){var t=this,s='';function add(v,k){if(k&&v){if(k.indexOf('-')===0)
return;switch(k){case'font-weight':if(v==700)
v='bold';break;case'color':case'background-color':v=v.toLowerCase();break;}
s+=(s?' ':'')+k+': '+v+';';}};if(name&&t._styles){each(t._styles['*'],function(name){add(o[name],name);});each(t._styles[name.toLowerCase()],function(name){add(o[name],name);});}else
each(o,add);return s;},loadCSS:function(u){var t=this,d=t.doc,head;if(!u)
u='';head=t.select('head')[0];each(u.split(','),function(u){var link;if(t.files[u])
return;t.files[u]=true;link=t.create('link',{rel:'stylesheet',href:tinymce._addVer(u)});if(isIE&&d.documentMode){link.onload=function(){d.recalc();link.onload=null;};}
head.appendChild(link);});},addClass:function(e,c){return this.run(e,function(e){var o;if(!c)
return 0;if(this.hasClass(e,c))
return e.className;o=this.removeClass(e,c);return e.className=(o!=''?(o+' '):'')+c;});},removeClass:function(e,c){var t=this,re;return t.run(e,function(e){var v;if(t.hasClass(e,c)){if(!re)
re=new RegExp("(^|\\s+)"+c+"(\\s+|$)","g");v=e.className.replace(re,' ');v=tinymce.trim(v!=' '?v:'');e.className=v;if(!v){e.removeAttribute('class');e.removeAttribute('className');}
return v;}
return e.className;});},hasClass:function(n,c){n=this.get(n);if(!n||!c)
return false;return(' '+n.className+' ').indexOf(' '+c+' ')!==-1;},show:function(e){return this.setStyle(e,'display','block');},hide:function(e){return this.setStyle(e,'display','none');},isHidden:function(e){e=this.get(e);return!e||e.style.display=='none'||this.getStyle(e,'display')=='none';},uniqueId:function(p){return(!p?'mce_':p)+(this.counter++);},setHTML:function(e,h){var t=this;return this.run(e,function(e){var x,i,nl,n,p,x;h=t.processHTML(h);if(isIE){function set(){while(e.firstChild)
e.firstChild.removeNode();try{e.innerHTML='<br />'+h;e.removeChild(e.firstChild);}catch(ex){x=t.create('div');x.innerHTML='<br />'+h;each(x.childNodes,function(n,i){if(i)
e.appendChild(n);});}};if(t.settings.fix_ie_paragraphs)
h=h.replace(/<p><\/p>|<p([^>]+)><\/p>|<p[^\/+]\/>/gi,'<p$1 _mce_keep="true">&nbsp;</p>');set();if(t.settings.fix_ie_paragraphs){nl=e.getElementsByTagName("p");for(i=nl.length-1,x=0;i>=0;i--){n=nl[i];if(!n.hasChildNodes()){if(!n._mce_keep){x=1;break;}
n.removeAttribute('_mce_keep');}}}
if(x){h=h.replace(/<p ([^>]+)>|<p>/ig,'<div $1 _mce_tmp="1">');h=h.replace(/<\/p>/gi,'</div>');set();if(t.settings.fix_ie_paragraphs){nl=e.getElementsByTagName("DIV");for(i=nl.length-1;i>=0;i--){n=nl[i];if(n._mce_tmp){p=t.doc.createElement('p');n.cloneNode(false).outerHTML.replace(/([a-z0-9\-_]+)=/gi,function(a,b){var v;if(b!=='_mce_tmp'){v=n.getAttribute(b);if(!v&&b==='class')
v=n.className;p.setAttribute(b,v);}});for(x=0;x<n.childNodes.length;x++)
p.appendChild(n.childNodes[x].cloneNode(true));n.swapNode(p);}}}}}else
e.innerHTML=h;return h;});},processHTML:function(h){var t=this,s=t.settings,codeBlocks=[];if(!s.process_html)
return h;if(isIE){h=h.replace(/&apos;/g,'&#39;');h=h.replace(/\s+(disabled|checked|readonly|selected)\s*=\s*[\"\']?(false|0)[\"\']?/gi,'');}
h=h.replace(/<a( )([^>]+)\/>|<a\/>/gi,'<a$1$2></a>');if(s.keep_values){if(/<script|noscript|style/i.test(h)){function trim(s){s=s.replace(/(<!--\[CDATA\[|\]\]-->)/g,'\n');s=s.replace(/^[\r\n]*|[\r\n]*$/g,'');s=s.replace(/^\s*(\/\/\s*<!--|\/\/\s*<!\[CDATA\[|<!--|<!\[CDATA\[)[\r\n]*/g,'');s=s.replace(/\s*(\/\/\s*\]\]>|\/\/\s*-->|\]\]>|-->|\]\]-->)\s*$/g,'');return s;};h=h.replace(/<script([^>]+|)>([\s\S]*?)<\/script>/gi,function(v,attribs,text){if(!attribs)
attribs=' type="text/javascript"';attribs=attribs.replace(/src=\"([^\"]+)\"?/i,function(a,url){if(s.url_converter)
url=t.encode(s.url_converter.call(s.url_converter_scope||t,t.decode(url),'src','script'));return'_mce_src="'+url+'"';});if(tinymce.trim(text)){codeBlocks.push(trim(text));text='<!--\nMCE_SCRIPT:'+(codeBlocks.length-1)+'\n// -->';}
return'<mce:script'+attribs+'>'+text+'</mce:script>';});h=h.replace(/<style([^>]+|)>([\s\S]*?)<\/style>/gi,function(v,attribs,text){if(text){codeBlocks.push(trim(text));text='<!--\nMCE_SCRIPT:'+(codeBlocks.length-1)+'\n-->';}
return'<mce:style'+attribs+'>'+text+'</mce:style><style '+attribs+' _mce_bogus="1">'+text+'</style>';});h=h.replace(/<noscript([^>]+|)>([\s\S]*?)<\/noscript>/g,function(v,attribs,text){return'<mce:noscript'+attribs+'><!--'+t.encode(text).replace(/--/g,'&#45;&#45;')+'--></mce:noscript>';});}
h=h.replace(/<!\[CDATA\[([\s\S]+)\]\]>/g,'<!--[CDATA[$1]]-->');function processTags(html){return html.replace(tagRegExp,function(match,elm_name,attrs,end){return'<'+elm_name+attrs.replace(attrRegExp,function(match,name,value,val2,val3){var mceValue;name=name.toLowerCase();value=value||val2||val3||"";if(boolAttrs[name]){if(value==='false'||value==='0')
return;return name+'="'+name+'"';}
if(mceAttribs[name]&&attrs.indexOf('_mce_'+name)==-1){mceValue=t.decode(value);if(s.url_converter&&(name=="src"||name=="href"))
mceValue=s.url_converter.call(s.url_converter_scope||t,mceValue,name,elm_name);if(name=='style')
mceValue=t.serializeStyle(t.parseStyle(mceValue),name);return name+'="'+value+'"'+' _mce_'+name+'="'+t.encode(mceValue)+'"';}
return match;})+end+'>';});};h=processTags(h);h=h.replace(/MCE_SCRIPT:([0-9]+)/g,function(val,idx){return codeBlocks[idx];});}
return h;},getOuterHTML:function(e){var d;e=this.get(e);if(!e)
return null;if(e.outerHTML!==undefined)
return e.outerHTML;d=(e.ownerDocument||this.doc).createElement("body");d.appendChild(e.cloneNode(true));return d.innerHTML;},setOuterHTML:function(e,h,d){var t=this;function setHTML(e,h,d){var n,tp;tp=d.createElement("body");tp.innerHTML=h;n=tp.lastChild;while(n){t.insertAfter(n.cloneNode(true),e);n=n.previousSibling;}
t.remove(e);};return this.run(e,function(e){e=t.get(e);if(e.nodeType==1){d=d||e.ownerDocument||t.doc;if(isIE){try{if(isIE&&e.nodeType==1)
e.outerHTML=h;else
setHTML(e,h,d);}catch(ex){setHTML(e,h,d);}}else
setHTML(e,h,d);}});},decode:function(s){var e,n,v;if(/&[\w#]+;/.test(s)){e=this.doc.createElement("div");e.innerHTML=s;n=e.firstChild;v='';if(n){do{v+=n.nodeValue;}while(n=n.nextSibling);}
return v||s;}
return s;},encode:function(str){return(''+str).replace(encodeCharsRe,function(chr){return encodedChars[chr];});},insertAfter:function(node,reference_node){reference_node=this.get(reference_node);return this.run(node,function(node){var parent,nextSibling;parent=reference_node.parentNode;nextSibling=reference_node.nextSibling;if(nextSibling)
parent.insertBefore(node,nextSibling);else
parent.appendChild(node);return node;});},isBlock:function(n){if(n.nodeType&&n.nodeType!==1)
return false;n=n.nodeName||n;return blockRe.test(n);},replace:function(n,o,k){var t=this;if(is(o,'array'))
n=n.cloneNode(true);return t.run(o,function(o){if(k){each(tinymce.grep(o.childNodes),function(c){n.appendChild(c);});}
return o.parentNode.replaceChild(n,o);});},rename:function(elm,name){var t=this,newElm;if(elm.nodeName!=name.toUpperCase()){newElm=t.create(name);each(t.getAttribs(elm),function(attr_node){t.setAttrib(newElm,attr_node.nodeName,t.getAttrib(elm,attr_node.nodeName));});t.replace(newElm,elm,1);}
return newElm||elm;},findCommonAncestor:function(a,b){var ps=a,pe;while(ps){pe=b;while(pe&&ps!=pe)
pe=pe.parentNode;if(ps==pe)
break;ps=ps.parentNode;}
if(!ps&&a.ownerDocument)
return a.ownerDocument.documentElement;return ps;},toHex:function(s){var c=/^\s*rgb\s*?\(\s*?([0-9]+)\s*?,\s*?([0-9]+)\s*?,\s*?([0-9]+)\s*?\)\s*$/i.exec(s);function hex(s){s=parseInt(s).toString(16);return s.length>1?s:'0'+s;};if(c){s='#'+hex(c[1])+hex(c[2])+hex(c[3]);return s;}
return s;},getClasses:function(){var t=this,cl=[],i,lo={},f=t.settings.class_filter,ov;if(t.classes)
return t.classes;function addClasses(s){each(s.imports,function(r){addClasses(r);});each(s.cssRules||s.rules,function(r){switch(r.type||1){case 1:if(r.selectorText){each(r.selectorText.split(','),function(v){v=v.replace(/^\s*|\s*$|^\s\./g,"");if(/\.mce/.test(v)||!/\.[\w\-]+$/.test(v))
return;ov=v;v=v.replace(/.*\.([a-z0-9_\-]+).*/i,'$1');if(f&&!(v=f(v,ov)))
return;if(!lo[v]){cl.push({'class':v});lo[v]=1;}});}
break;case 3:addClasses(r.styleSheet);break;}});};try{each(t.doc.styleSheets,addClasses);}catch(ex){}
if(cl.length>0)
t.classes=cl;return cl;},run:function(e,f,s){var t=this,o;if(t.doc&&typeof(e)==='string')
e=t.get(e);if(!e)
return false;s=s||this;if(!e.nodeType&&(e.length||e.length===0)){o=[];each(e,function(e,i){if(e){if(typeof(e)=='string')
e=t.doc.getElementById(e);o.push(f.call(s,e,i));}});return o;}
return f.call(s,e);},getAttribs:function(n){var o;n=this.get(n);if(!n)
return[];if(isIE){o=[];if(n.nodeName=='OBJECT')
return n.attributes;if(n.nodeName==='OPTION'&&this.getAttrib(n,'selected'))
o.push({specified:1,nodeName:'selected'});n.cloneNode(false).outerHTML.replace(/<\/?[\w:\-]+ ?|=[\"][^\"]+\"|=\'[^\']+\'|=[\w\-]+|>/gi,'').replace(/[\w:\-]+/gi,function(a){o.push({specified:1,nodeName:a});});return o;}
return n.attributes;},destroy:function(s){var t=this;if(t.events)
t.events.destroy();t.win=t.doc=t.root=t.events=null;if(!s)
tinymce.removeUnload(t.destroy);},createRng:function(){var d=this.doc;return d.createRange?d.createRange():new tinymce.dom.Range(this);},nodeIndex:function(node,normalized){var idx=0,lastNodeType,lastNode,nodeType;if(node){for(lastNodeType=node.nodeType,node=node.previousSibling,lastNode=node;node;node=node.previousSibling){nodeType=node.nodeType;if(normalized&&nodeType==3){if(nodeType==lastNodeType||!node.nodeValue.length)
continue;}
idx++;lastNodeType=nodeType;}}
return idx;},split:function(pe,e,re){var t=this,r=t.createRng(),bef,aft,pa;function trim(node){var i,children=node.childNodes;if(node.nodeType==1&&node.getAttribute('_mce_type')=='bookmark')
return;for(i=children.length-1;i>=0;i--)
trim(children[i]);if(node.nodeType!=9){if(node.nodeType==3&&node.nodeValue.length>0)
return;if(node.nodeType==1){children=node.childNodes;if(children.length==1&&children[0]&&children[0].nodeType==1&&children[0].getAttribute('_mce_type')=='bookmark')
node.parentNode.insertBefore(children[0],node);if(children.length||/^(br|hr|input|img)$/i.test(node.nodeName))
return;}
t.remove(node);}
return node;};if(pe&&e){r.setStart(pe.parentNode,t.nodeIndex(pe));r.setEnd(e.parentNode,t.nodeIndex(e));bef=r.extractContents();r=t.createRng();r.setStart(e.parentNode,t.nodeIndex(e)+1);r.setEnd(pe.parentNode,t.nodeIndex(pe)+1);aft=r.extractContents();pa=pe.parentNode;pa.insertBefore(trim(bef),pe);if(re)
pa.replaceChild(re,e);else
pa.insertBefore(e,pe);pa.insertBefore(trim(aft),pe);t.remove(pe);return re||e;}},bind:function(target,name,func,scope){var t=this;if(!t.events)
t.events=new tinymce.dom.EventUtils();return t.events.add(target,name,func,scope||this);},unbind:function(target,name,func){var t=this;if(!t.events)
t.events=new tinymce.dom.EventUtils();return t.events.remove(target,name,func);},_findSib:function(node,selector,name){var t=this,f=selector;if(node){if(is(f,'string')){f=function(node){return t.is(node,selector);};}
for(node=node[name];node;node=node[name]){if(f(node))
return node;}}
return null;},_isRes:function(c){return/^(top|left|bottom|right|width|height)/i.test(c)||/;\s*(top|left|bottom|right|width|height)/i.test(c);}});tinymce.DOM=new tinymce.dom.DOMUtils(document,{process_html:0});})(tinymce);(function(ns){function Range(dom){var t=this,doc=dom.doc,EXTRACT=0,CLONE=1,DELETE=2,TRUE=true,FALSE=false,START_OFFSET='startOffset',START_CONTAINER='startContainer',END_CONTAINER='endContainer',END_OFFSET='endOffset',extend=tinymce.extend,nodeIndex=dom.nodeIndex;extend(t,{startContainer:doc,startOffset:0,endContainer:doc,endOffset:0,collapsed:TRUE,commonAncestorContainer:doc,START_TO_START:0,START_TO_END:1,END_TO_END:2,END_TO_START:3,setStart:setStart,setEnd:setEnd,setStartBefore:setStartBefore,setStartAfter:setStartAfter,setEndBefore:setEndBefore,setEndAfter:setEndAfter,collapse:collapse,selectNode:selectNode,selectNodeContents:selectNodeContents,compareBoundaryPoints:compareBoundaryPoints,deleteContents:deleteContents,extractContents:extractContents,cloneContents:cloneContents,insertNode:insertNode,surroundContents:surroundContents,cloneRange:cloneRange});function setStart(n,o){_setEndPoint(TRUE,n,o);};function setEnd(n,o){_setEndPoint(FALSE,n,o);};function setStartBefore(n){setStart(n.parentNode,nodeIndex(n));};function setStartAfter(n){setStart(n.parentNode,nodeIndex(n)+1);};function setEndBefore(n){setEnd(n.parentNode,nodeIndex(n));};function setEndAfter(n){setEnd(n.parentNode,nodeIndex(n)+1);};function collapse(ts){if(ts){t[END_CONTAINER]=t[START_CONTAINER];t[END_OFFSET]=t[START_OFFSET];}else{t[START_CONTAINER]=t[END_CONTAINER];t[START_OFFSET]=t[END_OFFSET];}
t.collapsed=TRUE;};function selectNode(n){setStartBefore(n);setEndAfter(n);};function selectNodeContents(n){setStart(n,0);setEnd(n,n.nodeType===1?n.childNodes.length:n.nodeValue.length);};function compareBoundaryPoints(h,r){var sc=t[START_CONTAINER],so=t[START_OFFSET],ec=t[END_CONTAINER],eo=t[END_OFFSET];if(h===0)
return _compareBoundaryPoints(sc,so,sc,so);if(h===1)
return _compareBoundaryPoints(sc,so,ec,eo);if(h===2)
return _compareBoundaryPoints(ec,eo,ec,eo);if(h===3)
return _compareBoundaryPoints(ec,eo,sc,so);};function deleteContents(){_traverse(DELETE);};function extractContents(){return _traverse(EXTRACT);};function cloneContents(){return _traverse(CLONE);};function insertNode(n){var startContainer=this[START_CONTAINER],startOffset=this[START_OFFSET],nn,o;if((startContainer.nodeType===3||startContainer.nodeType===4)&&startContainer.nodeValue){if(!startOffset){startContainer.parentNode.insertBefore(n,startContainer);}else if(startOffset>=startContainer.nodeValue.length){dom.insertAfter(n,startContainer);}else{nn=startContainer.splitText(startOffset);startContainer.parentNode.insertBefore(n,nn);}}else{if(startContainer.childNodes.length>0)
o=startContainer.childNodes[startOffset];if(o)
startContainer.insertBefore(n,o);else
startContainer.appendChild(n);}};function surroundContents(n){var f=t.extractContents();t.insertNode(n);n.appendChild(f);t.selectNode(n);};function cloneRange(){return extend(new Range(dom),{startContainer:t[START_CONTAINER],startOffset:t[START_OFFSET],endContainer:t[END_CONTAINER],endOffset:t[END_OFFSET],collapsed:t.collapsed,commonAncestorContainer:t.commonAncestorContainer});};function _getSelectedNode(container,offset){var child;if(container.nodeType==3)
return container;if(offset<0)
return container;child=container.firstChild;while(child&&offset>0){--offset;child=child.nextSibling;}
if(child)
return child;return container;};function _isCollapsed(){return(t[START_CONTAINER]==t[END_CONTAINER]&&t[START_OFFSET]==t[END_OFFSET]);};function _compareBoundaryPoints(containerA,offsetA,containerB,offsetB){var c,offsetC,n,cmnRoot,childA,childB;if(containerA==containerB){if(offsetA==offsetB)
return 0;if(offsetA<offsetB)
return-1;return 1;}
c=containerB;while(c&&c.parentNode!=containerA)
c=c.parentNode;if(c){offsetC=0;n=containerA.firstChild;while(n!=c&&offsetC<offsetA){offsetC++;n=n.nextSibling;}
if(offsetA<=offsetC)
return-1;return 1;}
c=containerA;while(c&&c.parentNode!=containerB){c=c.parentNode;}
if(c){offsetC=0;n=containerB.firstChild;while(n!=c&&offsetC<offsetB){offsetC++;n=n.nextSibling;}
if(offsetC<offsetB)
return-1;return 1;}
cmnRoot=dom.findCommonAncestor(containerA,containerB);childA=containerA;while(childA&&childA.parentNode!=cmnRoot)
childA=childA.parentNode;if(!childA)
childA=cmnRoot;childB=containerB;while(childB&&childB.parentNode!=cmnRoot)
childB=childB.parentNode;if(!childB)
childB=cmnRoot;if(childA==childB)
return 0;n=cmnRoot.firstChild;while(n){if(n==childA)
return-1;if(n==childB)
return 1;n=n.nextSibling;}};function _setEndPoint(st,n,o){var ec,sc;if(st){t[START_CONTAINER]=n;t[START_OFFSET]=o;}else{t[END_CONTAINER]=n;t[END_OFFSET]=o;}
ec=t[END_CONTAINER];while(ec.parentNode)
ec=ec.parentNode;sc=t[START_CONTAINER];while(sc.parentNode)
sc=sc.parentNode;if(sc==ec){if(_compareBoundaryPoints(t[START_CONTAINER],t[START_OFFSET],t[END_CONTAINER],t[END_OFFSET])>0)
t.collapse(st);}else
t.collapse(st);t.collapsed=_isCollapsed();t.commonAncestorContainer=dom.findCommonAncestor(t[START_CONTAINER],t[END_CONTAINER]);};function _traverse(how){var c,endContainerDepth=0,startContainerDepth=0,p,depthDiff,startNode,endNode,sp,ep;if(t[START_CONTAINER]==t[END_CONTAINER])
return _traverseSameContainer(how);for(c=t[END_CONTAINER],p=c.parentNode;p;c=p,p=p.parentNode){if(p==t[START_CONTAINER])
return _traverseCommonStartContainer(c,how);++endContainerDepth;}
for(c=t[START_CONTAINER],p=c.parentNode;p;c=p,p=p.parentNode){if(p==t[END_CONTAINER])
return _traverseCommonEndContainer(c,how);++startContainerDepth;}
depthDiff=startContainerDepth-endContainerDepth;startNode=t[START_CONTAINER];while(depthDiff>0){startNode=startNode.parentNode;depthDiff--;}
endNode=t[END_CONTAINER];while(depthDiff<0){endNode=endNode.parentNode;depthDiff++;}
for(sp=startNode.parentNode,ep=endNode.parentNode;sp!=ep;sp=sp.parentNode,ep=ep.parentNode){startNode=sp;endNode=ep;}
return _traverseCommonAncestors(startNode,endNode,how);};function _traverseSameContainer(how){var frag,s,sub,n,cnt,sibling,xferNode;if(how!=DELETE)
frag=doc.createDocumentFragment();if(t[START_OFFSET]==t[END_OFFSET])
return frag;if(t[START_CONTAINER].nodeType==3){s=t[START_CONTAINER].nodeValue;sub=s.substring(t[START_OFFSET],t[END_OFFSET]);if(how!=CLONE){t[START_CONTAINER].deleteData(t[START_OFFSET],t[END_OFFSET]-t[START_OFFSET]);t.collapse(TRUE);}
if(how==DELETE)
return;frag.appendChild(doc.createTextNode(sub));return frag;}
n=_getSelectedNode(t[START_CONTAINER],t[START_OFFSET]);cnt=t[END_OFFSET]-t[START_OFFSET];while(cnt>0){sibling=n.nextSibling;xferNode=_traverseFullySelected(n,how);if(frag)
frag.appendChild(xferNode);--cnt;n=sibling;}
if(how!=CLONE)
t.collapse(TRUE);return frag;};function _traverseCommonStartContainer(endAncestor,how){var frag,n,endIdx,cnt,sibling,xferNode;if(how!=DELETE)
frag=doc.createDocumentFragment();n=_traverseRightBoundary(endAncestor,how);if(frag)
frag.appendChild(n);endIdx=nodeIndex(endAncestor);cnt=endIdx-t[START_OFFSET];if(cnt<=0){if(how!=CLONE){t.setEndBefore(endAncestor);t.collapse(FALSE);}
return frag;}
n=endAncestor.previousSibling;while(cnt>0){sibling=n.previousSibling;xferNode=_traverseFullySelected(n,how);if(frag)
frag.insertBefore(xferNode,frag.firstChild);--cnt;n=sibling;}
if(how!=CLONE){t.setEndBefore(endAncestor);t.collapse(FALSE);}
return frag;};function _traverseCommonEndContainer(startAncestor,how){var frag,startIdx,n,cnt,sibling,xferNode;if(how!=DELETE)
frag=doc.createDocumentFragment();n=_traverseLeftBoundary(startAncestor,how);if(frag)
frag.appendChild(n);startIdx=nodeIndex(startAncestor);++startIdx;cnt=t[END_OFFSET]-startIdx;n=startAncestor.nextSibling;while(cnt>0){sibling=n.nextSibling;xferNode=_traverseFullySelected(n,how);if(frag)
frag.appendChild(xferNode);--cnt;n=sibling;}
if(how!=CLONE){t.setStartAfter(startAncestor);t.collapse(TRUE);}
return frag;};function _traverseCommonAncestors(startAncestor,endAncestor,how){var n,frag,commonParent,startOffset,endOffset,cnt,sibling,nextSibling;if(how!=DELETE)
frag=doc.createDocumentFragment();n=_traverseLeftBoundary(startAncestor,how);if(frag)
frag.appendChild(n);commonParent=startAncestor.parentNode;startOffset=nodeIndex(startAncestor);endOffset=nodeIndex(endAncestor);++startOffset;cnt=endOffset-startOffset;sibling=startAncestor.nextSibling;while(cnt>0){nextSibling=sibling.nextSibling;n=_traverseFullySelected(sibling,how);if(frag)
frag.appendChild(n);sibling=nextSibling;--cnt;}
n=_traverseRightBoundary(endAncestor,how);if(frag)
frag.appendChild(n);if(how!=CLONE){t.setStartAfter(startAncestor);t.collapse(TRUE);}
return frag;};function _traverseRightBoundary(root,how){var next=_getSelectedNode(t[END_CONTAINER],t[END_OFFSET]-1),parent,clonedParent,prevSibling,clonedChild,clonedGrandParent,isFullySelected=next!=t[END_CONTAINER];if(next==root)
return _traverseNode(next,isFullySelected,FALSE,how);parent=next.parentNode;clonedParent=_traverseNode(parent,FALSE,FALSE,how);while(parent){while(next){prevSibling=next.previousSibling;clonedChild=_traverseNode(next,isFullySelected,FALSE,how);if(how!=DELETE)
clonedParent.insertBefore(clonedChild,clonedParent.firstChild);isFullySelected=TRUE;next=prevSibling;}
if(parent==root)
return clonedParent;next=parent.previousSibling;parent=parent.parentNode;clonedGrandParent=_traverseNode(parent,FALSE,FALSE,how);if(how!=DELETE)
clonedGrandParent.appendChild(clonedParent);clonedParent=clonedGrandParent;}};function _traverseLeftBoundary(root,how){var next=_getSelectedNode(t[START_CONTAINER],t[START_OFFSET]),isFullySelected=next!=t[START_CONTAINER],parent,clonedParent,nextSibling,clonedChild,clonedGrandParent;if(next==root)
return _traverseNode(next,isFullySelected,TRUE,how);parent=next.parentNode;clonedParent=_traverseNode(parent,FALSE,TRUE,how);while(parent){while(next){nextSibling=next.nextSibling;clonedChild=_traverseNode(next,isFullySelected,TRUE,how);if(how!=DELETE)
clonedParent.appendChild(clonedChild);isFullySelected=TRUE;next=nextSibling;}
if(parent==root)
return clonedParent;next=parent.nextSibling;parent=parent.parentNode;clonedGrandParent=_traverseNode(parent,FALSE,TRUE,how);if(how!=DELETE)
clonedGrandParent.appendChild(clonedParent);clonedParent=clonedGrandParent;}};function _traverseNode(n,isFullySelected,isLeft,how){var txtValue,newNodeValue,oldNodeValue,offset,newNode;if(isFullySelected)
return _traverseFullySelected(n,how);if(n.nodeType==3){txtValue=n.nodeValue;if(isLeft){offset=t[START_OFFSET];newNodeValue=txtValue.substring(offset);oldNodeValue=txtValue.substring(0,offset);}else{offset=t[END_OFFSET];newNodeValue=txtValue.substring(0,offset);oldNodeValue=txtValue.substring(offset);}
if(how!=CLONE)
n.nodeValue=oldNodeValue;if(how==DELETE)
return;newNode=n.cloneNode(FALSE);newNode.nodeValue=newNodeValue;return newNode;}
if(how==DELETE)
return;return n.cloneNode(FALSE);};function _traverseFullySelected(n,how){if(how!=DELETE)
return how==CLONE?n.cloneNode(TRUE):n;n.parentNode.removeChild(n);};};ns.Range=Range;})(tinymce.dom);(function(){function Selection(selection){var t=this,invisibleChar='\uFEFF',range,lastIERng,dom=selection.dom,TRUE=true,FALSE=false;function getRange(){var ieRange=selection.getRng(),domRange=dom.createRng(),element,collapsed;element=ieRange.item?ieRange.item(0):ieRange.parentElement();if(element.ownerDocument!=dom.doc)
return domRange;if(ieRange.item||!element.hasChildNodes()){domRange.setStart(element.parentNode,dom.nodeIndex(element));domRange.setEnd(domRange.startContainer,domRange.startOffset+1);return domRange;}
collapsed=selection.isCollapsed();function findEndPoint(start){var marker,container,offset,nodes,startIndex=0,endIndex,index,parent,checkRng,position;checkRng=ieRange.duplicate();checkRng.collapse(start);marker=dom.create('a');parent=checkRng.parentElement();if(!parent.hasChildNodes()){domRange[start?'setStart':'setEnd'](parent,0);return;}
parent.appendChild(marker);checkRng.moveToElementText(marker);position=ieRange.compareEndPoints(start?'StartToStart':'EndToEnd',checkRng);if(position>0){domRange[start?'setStartAfter':'setEndAfter'](parent);dom.remove(marker);return;}
nodes=tinymce.grep(parent.childNodes);endIndex=nodes.length-1;while(startIndex<=endIndex){index=Math.floor((startIndex+endIndex)/2);parent.insertBefore(marker,nodes[index]);checkRng.moveToElementText(marker);position=ieRange.compareEndPoints(start?'StartToStart':'EndToEnd',checkRng);if(position>0){startIndex=index+1;}else if(position<0){endIndex=index-1;}else{found=true;break;}}
container=position>0||index==0?marker.nextSibling:marker.previousSibling;if(container.nodeType==1){dom.remove(marker);offset=dom.nodeIndex(container);container=container.parentNode;if(!start||index>0)
offset++;}else{if(position>0||index==0){checkRng.setEndPoint(start?'StartToStart':'EndToEnd',ieRange);offset=checkRng.text.length;}else{checkRng.setEndPoint(start?'StartToStart':'EndToEnd',ieRange);offset=container.nodeValue.length-checkRng.text.length;}
dom.remove(marker);}
domRange[start?'setStart':'setEnd'](container,offset);};findEndPoint(true);if(!collapsed)
findEndPoint();return domRange;};this.addRange=function(rng){var ieRng,ctrlRng,startContainer,startOffset,endContainer,endOffset,doc=selection.dom.doc,body=doc.body;function setEndPoint(start){var container,offset,marker,tmpRng,nodes;marker=dom.create('a');container=start?startContainer:endContainer;offset=start?startOffset:endOffset;tmpRng=ieRng.duplicate();if(container==doc){container=body;offset=0;}
if(container.nodeType==3){container.parentNode.insertBefore(marker,container);tmpRng.moveToElementText(marker);tmpRng.moveStart('character',offset);dom.remove(marker);ieRng.setEndPoint(start?'StartToStart':'EndToEnd',tmpRng);}else{nodes=container.childNodes;if(nodes.length){if(offset>=nodes.length){dom.insertAfter(marker,nodes[nodes.length-1]);}else{container.insertBefore(marker,nodes[offset]);}
tmpRng.moveToElementText(marker);}else{marker=doc.createTextNode(invisibleChar);container.appendChild(marker);tmpRng.moveToElementText(marker.parentNode);tmpRng.collapse(TRUE);}
ieRng.setEndPoint(start?'StartToStart':'EndToEnd',tmpRng);dom.remove(marker);}}
this.destroy();startContainer=rng.startContainer;startOffset=rng.startOffset;endContainer=rng.endContainer;endOffset=rng.endOffset;ieRng=body.createTextRange();if(startContainer==endContainer&&startContainer.nodeType==1&&startOffset==endOffset-1){if(startOffset==endOffset-1){try{ctrlRng=body.createControlRange();ctrlRng.addElement(startContainer.childNodes[startOffset]);ctrlRng.select();ctrlRng.scrollIntoView();return;}catch(ex){}}}
setEndPoint(true);setEndPoint();ieRng.select();ieRng.scrollIntoView();};this.getRangeAt=function(){if(!range||!tinymce.dom.RangeUtils.compareRanges(lastIERng,selection.getRng())){range=getRange();lastIERng=selection.getRng();}
try{range.startContainer.nextSibling;}catch(ex){range=getRange();lastIERng=null;}
return range;};this.destroy=function(){lastIERng=range=null;};if(selection.dom.boxModel){(function(){var doc=dom.doc,body=doc.body,started,startRng;doc.documentElement.unselectable=TRUE;function rngFromPoint(x,y){var rng=body.createTextRange();try{rng.moveToPoint(x,y);}catch(ex){rng=null;}
return rng;};function selectionChange(e){var pointRng;if(e.button){pointRng=rngFromPoint(e.x,e.y);if(pointRng){if(pointRng.compareEndPoints('StartToStart',startRng)>0)
pointRng.setEndPoint('StartToStart',startRng);else
pointRng.setEndPoint('EndToEnd',startRng);pointRng.select();}}else
endSelection();}
function endSelection(){dom.unbind(doc,'mouseup',endSelection);dom.unbind(doc,'mousemove',selectionChange);started=0;};dom.bind(doc,'mousedown',function(e){if(e.target.nodeName==='HTML'){if(started)
endSelection();started=1;startRng=rngFromPoint(e.x,e.y);if(startRng){dom.bind(doc,'mouseup',endSelection);dom.bind(doc,'mousemove',selectionChange);startRng.select();}}});})();}};tinymce.dom.TridentSelection=Selection;})();(function(){var chunker=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,done=0,toString=Object.prototype.toString,hasDuplicate=false,baseHasDuplicate=true;[0,0].sort(function(){baseHasDuplicate=false;return 0;});var Sizzle=function(selector,context,results,seed){results=results||[];context=context||document;var origContext=context;if(context.nodeType!==1&&context.nodeType!==9){return[];}
if(!selector||typeof selector!=="string"){return results;}
var parts=[],m,set,checkSet,extra,prune=true,contextXML=Sizzle.isXML(context),soFar=selector,ret,cur,pop,i;do{chunker.exec("");m=chunker.exec(soFar);if(m){soFar=m[3];parts.push(m[1]);if(m[2]){extra=m[3];break;}}}while(m);if(parts.length>1&&origPOS.exec(selector)){if(parts.length===2&&Expr.relative[parts[0]]){set=posProcess(parts[0]+parts[1],context);}else{set=Expr.relative[parts[0]]?[context]:Sizzle(parts.shift(),context);while(parts.length){selector=parts.shift();if(Expr.relative[selector]){selector+=parts.shift();}
set=posProcess(selector,set);}}}else{if(!seed&&parts.length>1&&context.nodeType===9&&!contextXML&&Expr.match.ID.test(parts[0])&&!Expr.match.ID.test(parts[parts.length-1])){ret=Sizzle.find(parts.shift(),context,contextXML);context=ret.expr?Sizzle.filter(ret.expr,ret.set)[0]:ret.set[0];}
if(context){ret=seed?{expr:parts.pop(),set:makeArray(seed)}:Sizzle.find(parts.pop(),parts.length===1&&(parts[0]==="~"||parts[0]==="+")&&context.parentNode?context.parentNode:context,contextXML);set=ret.expr?Sizzle.filter(ret.expr,ret.set):ret.set;if(parts.length>0){checkSet=makeArray(set);}else{prune=false;}
while(parts.length){cur=parts.pop();pop=cur;if(!Expr.relative[cur]){cur="";}else{pop=parts.pop();}
if(pop==null){pop=context;}
Expr.relative[cur](checkSet,pop,contextXML);}}else{checkSet=parts=[];}}
if(!checkSet){checkSet=set;}
if(!checkSet){Sizzle.error(cur||selector);}
if(toString.call(checkSet)==="[object Array]"){if(!prune){results.push.apply(results,checkSet);}else if(context&&context.nodeType===1){for(i=0;checkSet[i]!=null;i++){if(checkSet[i]&&(checkSet[i]===true||checkSet[i].nodeType===1&&Sizzle.contains(context,checkSet[i]))){results.push(set[i]);}}}else{for(i=0;checkSet[i]!=null;i++){if(checkSet[i]&&checkSet[i].nodeType===1){results.push(set[i]);}}}}else{makeArray(checkSet,results);}
if(extra){Sizzle(extra,origContext,results,seed);Sizzle.uniqueSort(results);}
return results;};Sizzle.uniqueSort=function(results){if(sortOrder){hasDuplicate=baseHasDuplicate;results.sort(sortOrder);if(hasDuplicate){for(var i=1;i<results.length;i++){if(results[i]===results[i-1]){results.splice(i--,1);}}}}
return results;};Sizzle.matches=function(expr,set){return Sizzle(expr,null,null,set);};Sizzle.find=function(expr,context,isXML){var set;if(!expr){return[];}
for(var i=0,l=Expr.order.length;i<l;i++){var type=Expr.order[i],match;if((match=Expr.leftMatch[type].exec(expr))){var left=match[1];match.splice(1,1);if(left.substr(left.length-1)!=="\\"){match[1]=(match[1]||"").replace(/\\/g,"");set=Expr.find[type](match,context,isXML);if(set!=null){expr=expr.replace(Expr.match[type],"");break;}}}}
if(!set){set=context.getElementsByTagName("*");}
return{set:set,expr:expr};};Sizzle.filter=function(expr,set,inplace,not){var old=expr,result=[],curLoop=set,match,anyFound,isXMLFilter=set&&set[0]&&Sizzle.isXML(set[0]);while(expr&&set.length){for(var type in Expr.filter){if((match=Expr.leftMatch[type].exec(expr))!=null&&match[2]){var filter=Expr.filter[type],found,item,left=match[1];anyFound=false;match.splice(1,1);if(left.substr(left.length-1)==="\\"){continue;}
if(curLoop===result){result=[];}
if(Expr.preFilter[type]){match=Expr.preFilter[type](match,curLoop,inplace,result,not,isXMLFilter);if(!match){anyFound=found=true;}else if(match===true){continue;}}
if(match){for(var i=0;(item=curLoop[i])!=null;i++){if(item){found=filter(item,match,i,curLoop);var pass=not^!!found;if(inplace&&found!=null){if(pass){anyFound=true;}else{curLoop[i]=false;}}else if(pass){result.push(item);anyFound=true;}}}}
if(found!==undefined){if(!inplace){curLoop=result;}
expr=expr.replace(Expr.match[type],"");if(!anyFound){return[];}
break;}}}
if(expr===old){if(anyFound==null){Sizzle.error(expr);}else{break;}}
old=expr;}
return curLoop;};Sizzle.error=function(msg){throw"Syntax error, unrecognized expression: "+msg;};var Expr=Sizzle.selectors={order:["ID","NAME","TAG"],match:{ID:/#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,CLASS:/\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,ATTR:/\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,TAG:/^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,CHILD:/:(only|nth|last|first)-child(?:\((even|odd|[\dn+\-]*)\))?/,POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,PSEUDO:/:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/},leftMatch:{},attrMap:{"class":"className","for":"htmlFor"},attrHandle:{href:function(elem){return elem.getAttribute("href");}},relative:{"+":function(checkSet,part){var isPartStr=typeof part==="string",isTag=isPartStr&&!/\W/.test(part),isPartStrNotTag=isPartStr&&!isTag;if(isTag){part=part.toLowerCase();}
for(var i=0,l=checkSet.length,elem;i<l;i++){if((elem=checkSet[i])){while((elem=elem.previousSibling)&&elem.nodeType!==1){}
checkSet[i]=isPartStrNotTag||elem&&elem.nodeName.toLowerCase()===part?elem||false:elem===part;}}
if(isPartStrNotTag){Sizzle.filter(part,checkSet,true);}},">":function(checkSet,part){var isPartStr=typeof part==="string",elem,i=0,l=checkSet.length;if(isPartStr&&!/\W/.test(part)){part=part.toLowerCase();for(;i<l;i++){elem=checkSet[i];if(elem){var parent=elem.parentNode;checkSet[i]=parent.nodeName.toLowerCase()===part?parent:false;}}}else{for(;i<l;i++){elem=checkSet[i];if(elem){checkSet[i]=isPartStr?elem.parentNode:elem.parentNode===part;}}
if(isPartStr){Sizzle.filter(part,checkSet,true);}}},"":function(checkSet,part,isXML){var doneName=done++,checkFn=dirCheck,nodeCheck;if(typeof part==="string"&&!/\W/.test(part)){part=part.toLowerCase();nodeCheck=part;checkFn=dirNodeCheck;}
checkFn("parentNode",part,doneName,checkSet,nodeCheck,isXML);},"~":function(checkSet,part,isXML){var doneName=done++,checkFn=dirCheck,nodeCheck;if(typeof part==="string"&&!/\W/.test(part)){part=part.toLowerCase();nodeCheck=part;checkFn=dirNodeCheck;}
checkFn("previousSibling",part,doneName,checkSet,nodeCheck,isXML);}},find:{ID:function(match,context,isXML){if(typeof context.getElementById!=="undefined"&&!isXML){var m=context.getElementById(match[1]);return m?[m]:[];}},NAME:function(match,context){if(typeof context.getElementsByName!=="undefined"){var ret=[],results=context.getElementsByName(match[1]);for(var i=0,l=results.length;i<l;i++){if(results[i].getAttribute("name")===match[1]){ret.push(results[i]);}}
return ret.length===0?null:ret;}},TAG:function(match,context){return context.getElementsByTagName(match[1]);}},preFilter:{CLASS:function(match,curLoop,inplace,result,not,isXML){match=" "+match[1].replace(/\\/g,"")+" ";if(isXML){return match;}
for(var i=0,elem;(elem=curLoop[i])!=null;i++){if(elem){if(not^(elem.className&&(" "+elem.className+" ").replace(/[\t\n]/g," ").indexOf(match)>=0)){if(!inplace){result.push(elem);}}else if(inplace){curLoop[i]=false;}}}
return false;},ID:function(match){return match[1].replace(/\\/g,"");},TAG:function(match,curLoop){return match[1].toLowerCase();},CHILD:function(match){if(match[1]==="nth"){var test=/(-?)(\d*)n((?:\+|-)?\d*)/.exec(match[2]==="even"&&"2n"||match[2]==="odd"&&"2n+1"||!/\D/.test(match[2])&&"0n+"+match[2]||match[2]);match[2]=(test[1]+(test[2]||1))-0;match[3]=test[3]-0;}
match[0]=done++;return match;},ATTR:function(match,curLoop,inplace,result,not,isXML){var name=match[1].replace(/\\/g,"");if(!isXML&&Expr.attrMap[name]){match[1]=Expr.attrMap[name];}
if(match[2]==="~="){match[4]=" "+match[4]+" ";}
return match;},PSEUDO:function(match,curLoop,inplace,result,not){if(match[1]==="not"){if((chunker.exec(match[3])||"").length>1||/^\w/.test(match[3])){match[3]=Sizzle(match[3],null,null,curLoop);}else{var ret=Sizzle.filter(match[3],curLoop,inplace,true^not);if(!inplace){result.push.apply(result,ret);}
return false;}}else if(Expr.match.POS.test(match[0])||Expr.match.CHILD.test(match[0])){return true;}
return match;},POS:function(match){match.unshift(true);return match;}},filters:{enabled:function(elem){return elem.disabled===false&&elem.type!=="hidden";},disabled:function(elem){return elem.disabled===true;},checked:function(elem){return elem.checked===true;},selected:function(elem){elem.parentNode.selectedIndex;return elem.selected===true;},parent:function(elem){return!!elem.firstChild;},empty:function(elem){return!elem.firstChild;},has:function(elem,i,match){return!!Sizzle(match[3],elem).length;},header:function(elem){return(/h\d/i).test(elem.nodeName);},text:function(elem){return"text"===elem.type;},radio:function(elem){return"radio"===elem.type;},checkbox:function(elem){return"checkbox"===elem.type;},file:function(elem){return"file"===elem.type;},password:function(elem){return"password"===elem.type;},submit:function(elem){return"submit"===elem.type;},image:function(elem){return"image"===elem.type;},reset:function(elem){return"reset"===elem.type;},button:function(elem){return"button"===elem.type||elem.nodeName.toLowerCase()==="button";},input:function(elem){return(/input|select|textarea|button/i).test(elem.nodeName);}},setFilters:{first:function(elem,i){return i===0;},last:function(elem,i,match,array){return i===array.length-1;},even:function(elem,i){return i%2===0;},odd:function(elem,i){return i%2===1;},lt:function(elem,i,match){return i<match[3]-0;},gt:function(elem,i,match){return i>match[3]-0;},nth:function(elem,i,match){return match[3]-0===i;},eq:function(elem,i,match){return match[3]-0===i;}},filter:{PSEUDO:function(elem,match,i,array){var name=match[1],filter=Expr.filters[name];if(filter){return filter(elem,i,match,array);}else if(name==="contains"){return(elem.textContent||elem.innerText||Sizzle.getText([elem])||"").indexOf(match[3])>=0;}else if(name==="not"){var not=match[3];for(var j=0,l=not.length;j<l;j++){if(not[j]===elem){return false;}}
return true;}else{Sizzle.error("Syntax error, unrecognized expression: "+name);}},CHILD:function(elem,match){var type=match[1],node=elem;switch(type){case'only':case'first':while((node=node.previousSibling)){if(node.nodeType===1){return false;}}
if(type==="first"){return true;}
node=elem;case'last':while((node=node.nextSibling)){if(node.nodeType===1){return false;}}
return true;case'nth':var first=match[2],last=match[3];if(first===1&&last===0){return true;}
var doneName=match[0],parent=elem.parentNode;if(parent&&(parent.sizcache!==doneName||!elem.nodeIndex)){var count=0;for(node=parent.firstChild;node;node=node.nextSibling){if(node.nodeType===1){node.nodeIndex=++count;}}
parent.sizcache=doneName;}
var diff=elem.nodeIndex-last;if(first===0){return diff===0;}else{return(diff%first===0&&diff/first>=0);}}},ID:function(elem,match){return elem.nodeType===1&&elem.getAttribute("id")===match;},TAG:function(elem,match){return(match==="*"&&elem.nodeType===1)||elem.nodeName.toLowerCase()===match;},CLASS:function(elem,match){return(" "+(elem.className||elem.getAttribute("class"))+" ").indexOf(match)>-1;},ATTR:function(elem,match){var name=match[1],result=Expr.attrHandle[name]?Expr.attrHandle[name](elem):elem[name]!=null?elem[name]:elem.getAttribute(name),value=result+"",type=match[2],check=match[4];return result==null?type==="!=":type==="="?value===check:type==="*="?value.indexOf(check)>=0:type==="~="?(" "+value+" ").indexOf(check)>=0:!check?value&&result!==false:type==="!="?value!==check:type==="^="?value.indexOf(check)===0:type==="$="?value.substr(value.length-check.length)===check:type==="|="?value===check||value.substr(0,check.length+1)===check+"-":false;},POS:function(elem,match,i,array){var name=match[2],filter=Expr.setFilters[name];if(filter){return filter(elem,i,match,array);}}}};var origPOS=Expr.match.POS,fescape=function(all,num){return"\\"+(num-0+1);};for(var type in Expr.match){Expr.match[type]=new RegExp(Expr.match[type].source+(/(?![^\[]*\])(?![^\(]*\))/.source));Expr.leftMatch[type]=new RegExp(/(^(?:.|\r|\n)*?)/.source+Expr.match[type].source.replace(/\\(\d+)/g,fescape));}
var makeArray=function(array,results){array=Array.prototype.slice.call(array,0);if(results){results.push.apply(results,array);return results;}
return array;};try{Array.prototype.slice.call(document.documentElement.childNodes,0)[0].nodeType;}catch(e){makeArray=function(array,results){var ret=results||[],i=0;if(toString.call(array)==="[object Array]"){Array.prototype.push.apply(ret,array);}else{if(typeof array.length==="number"){for(var l=array.length;i<l;i++){ret.push(array[i]);}}else{for(;array[i];i++){ret.push(array[i]);}}}
return ret;};}
var sortOrder;if(document.documentElement.compareDocumentPosition){sortOrder=function(a,b){if(!a.compareDocumentPosition||!b.compareDocumentPosition){if(a==b){hasDuplicate=true;}
return a.compareDocumentPosition?-1:1;}
var ret=a.compareDocumentPosition(b)&4?-1:a===b?0:1;if(ret===0){hasDuplicate=true;}
return ret;};}else if("sourceIndex"in document.documentElement){sortOrder=function(a,b){if(!a.sourceIndex||!b.sourceIndex){if(a==b){hasDuplicate=true;}
return a.sourceIndex?-1:1;}
var ret=a.sourceIndex-b.sourceIndex;if(ret===0){hasDuplicate=true;}
return ret;};}else if(document.createRange){sortOrder=function(a,b){if(!a.ownerDocument||!b.ownerDocument){if(a==b){hasDuplicate=true;}
return a.ownerDocument?-1:1;}
var aRange=a.ownerDocument.createRange(),bRange=b.ownerDocument.createRange();aRange.setStart(a,0);aRange.setEnd(a,0);bRange.setStart(b,0);bRange.setEnd(b,0);var ret=aRange.compareBoundaryPoints(Range.START_TO_END,bRange);if(ret===0){hasDuplicate=true;}
return ret;};}
Sizzle.getText=function(elems){var ret="",elem;for(var i=0;elems[i];i++){elem=elems[i];if(elem.nodeType===3||elem.nodeType===4){ret+=elem.nodeValue;}else if(elem.nodeType!==8){ret+=Sizzle.getText(elem.childNodes);}}
return ret;};(function(){var form=document.createElement("div"),id="script"+(new Date()).getTime();form.innerHTML="<a name='"+id+"'/>";var root=document.documentElement;root.insertBefore(form,root.firstChild);if(document.getElementById(id)){Expr.find.ID=function(match,context,isXML){if(typeof context.getElementById!=="undefined"&&!isXML){var m=context.getElementById(match[1]);return m?m.id===match[1]||typeof m.getAttributeNode!=="undefined"&&m.getAttributeNode("id").nodeValue===match[1]?[m]:undefined:[];}};Expr.filter.ID=function(elem,match){var node=typeof elem.getAttributeNode!=="undefined"&&elem.getAttributeNode("id");return elem.nodeType===1&&node&&node.nodeValue===match;};}
root.removeChild(form);root=form=null;})();(function(){var div=document.createElement("div");div.appendChild(document.createComment(""));if(div.getElementsByTagName("*").length>0){Expr.find.TAG=function(match,context){var results=context.getElementsByTagName(match[1]);if(match[1]==="*"){var tmp=[];for(var i=0;results[i];i++){if(results[i].nodeType===1){tmp.push(results[i]);}}
results=tmp;}
return results;};}
div.innerHTML="<a href='#'></a>";if(div.firstChild&&typeof div.firstChild.getAttribute!=="undefined"&&div.firstChild.getAttribute("href")!=="#"){Expr.attrHandle.href=function(elem){return elem.getAttribute("href",2);};}
div=null;})();if(document.querySelectorAll){(function(){var oldSizzle=Sizzle,div=document.createElement("div");div.innerHTML="<p class='TEST'></p>";if(div.querySelectorAll&&div.querySelectorAll(".TEST").length===0){return;}
Sizzle=function(query,context,extra,seed){context=context||document;if(!seed&&context.nodeType===9&&!Sizzle.isXML(context)){try{return makeArray(context.querySelectorAll(query),extra);}catch(e){}}
return oldSizzle(query,context,extra,seed);};for(var prop in oldSizzle){Sizzle[prop]=oldSizzle[prop];}
div=null;})();}
(function(){var div=document.createElement("div");div.innerHTML="<div class='test e'></div><div class='test'></div>";if(!div.getElementsByClassName||div.getElementsByClassName("e").length===0){return;}
div.lastChild.className="e";if(div.getElementsByClassName("e").length===1){return;}
Expr.order.splice(1,0,"CLASS");Expr.find.CLASS=function(match,context,isXML){if(typeof context.getElementsByClassName!=="undefined"&&!isXML){return context.getElementsByClassName(match[1]);}};div=null;})();function dirNodeCheck(dir,cur,doneName,checkSet,nodeCheck,isXML){for(var i=0,l=checkSet.length;i<l;i++){var elem=checkSet[i];if(elem){elem=elem[dir];var match=false;while(elem){if(elem.sizcache===doneName){match=checkSet[elem.sizset];break;}
if(elem.nodeType===1&&!isXML){elem.sizcache=doneName;elem.sizset=i;}
if(elem.nodeName.toLowerCase()===cur){match=elem;break;}
elem=elem[dir];}
checkSet[i]=match;}}}
function dirCheck(dir,cur,doneName,checkSet,nodeCheck,isXML){for(var i=0,l=checkSet.length;i<l;i++){var elem=checkSet[i];if(elem){elem=elem[dir];var match=false;while(elem){if(elem.sizcache===doneName){match=checkSet[elem.sizset];break;}
if(elem.nodeType===1){if(!isXML){elem.sizcache=doneName;elem.sizset=i;}
if(typeof cur!=="string"){if(elem===cur){match=true;break;}}else if(Sizzle.filter(cur,[elem]).length>0){match=elem;break;}}
elem=elem[dir];}
checkSet[i]=match;}}}
Sizzle.contains=document.compareDocumentPosition?function(a,b){return!!(a.compareDocumentPosition(b)&16);}:function(a,b){return a!==b&&(a.contains?a.contains(b):true);};Sizzle.isXML=function(elem){var documentElement=(elem?elem.ownerDocument||elem:0).documentElement;return documentElement?documentElement.nodeName!=="HTML":false;};var posProcess=function(selector,context){var tmpSet=[],later="",match,root=context.nodeType?[context]:context;while((match=Expr.match.PSEUDO.exec(selector))){later+=match[0];selector=selector.replace(Expr.match.PSEUDO,"");}
selector=Expr.relative[selector]?selector+"*":selector;for(var i=0,l=root.length;i<l;i++){Sizzle(selector,root[i],tmpSet);}
return Sizzle.filter(later,tmpSet);};window.tinymce.dom.Sizzle=Sizzle;})();(function(tinymce){var each=tinymce.each,DOM=tinymce.DOM,isIE=tinymce.isIE,isWebKit=tinymce.isWebKit,Event;tinymce.create('tinymce.dom.EventUtils',{EventUtils:function(){this.inits=[];this.events=[];},add:function(o,n,f,s){var cb,t=this,el=t.events,r;if(n instanceof Array){r=[];each(n,function(n){r.push(t.add(o,n,f,s));});return r;}
if(o&&o.hasOwnProperty&&o instanceof Array){r=[];each(o,function(o){o=DOM.get(o);r.push(t.add(o,n,f,s));});return r;}
o=DOM.get(o);if(!o)
return;cb=function(e){if(t.disabled)
return;e=e||window.event;if(e&&isIE){if(!e.target)
e.target=e.srcElement;tinymce.extend(e,t._stoppers);}
if(!s)
return f(e);return f.call(s,e);};if(n=='unload'){tinymce.unloads.unshift({func:cb});return cb;}
if(n=='init'){if(t.domLoaded)
cb();else
t.inits.push(cb);return cb;}
el.push({obj:o,name:n,func:f,cfunc:cb,scope:s});t._add(o,n,cb);return f;},remove:function(o,n,f){var t=this,a=t.events,s=false,r;if(o&&o.hasOwnProperty&&o instanceof Array){r=[];each(o,function(o){o=DOM.get(o);r.push(t.remove(o,n,f));});return r;}
o=DOM.get(o);each(a,function(e,i){if(e.obj==o&&e.name==n&&(!f||(e.func==f||e.cfunc==f))){a.splice(i,1);t._remove(o,n,e.cfunc);s=true;return false;}});return s;},clear:function(o){var t=this,a=t.events,i,e;if(o){o=DOM.get(o);for(i=a.length-1;i>=0;i--){e=a[i];if(e.obj===o){t._remove(e.obj,e.name,e.cfunc);e.obj=e.cfunc=null;a.splice(i,1);}}}},cancel:function(e){if(!e)
return false;this.stop(e);return this.prevent(e);},stop:function(e){if(e.stopPropagation)
e.stopPropagation();else
e.cancelBubble=true;return false;},prevent:function(e){if(e.preventDefault)
e.preventDefault();else
e.returnValue=false;return false;},destroy:function(){var t=this;each(t.events,function(e,i){t._remove(e.obj,e.name,e.cfunc);e.obj=e.cfunc=null;});t.events=[];t=null;},_add:function(o,n,f){if(o.attachEvent)
o.attachEvent('on'+n,f);else if(o.addEventListener)
o.addEventListener(n,f,false);else
o['on'+n]=f;},_remove:function(o,n,f){if(o){try{if(o.detachEvent)
o.detachEvent('on'+n,f);else if(o.removeEventListener)
o.removeEventListener(n,f,false);else
o['on'+n]=null;}catch(ex){}}},_pageInit:function(win){var t=this;if(t.domLoaded)
return;t.domLoaded=true;each(t.inits,function(c){c();});t.inits=[];},_wait:function(win){var t=this,doc=win.document;if(win.tinyMCE_GZ&&tinyMCE_GZ.loaded){t.domLoaded=1;return;}
if(doc.attachEvent){doc.attachEvent("onreadystatechange",function(){if(doc.readyState==="complete"){doc.detachEvent("onreadystatechange",arguments.callee);t._pageInit(win);}});if(doc.documentElement.doScroll&&win==win.top){(function(){if(t.domLoaded)
return;try{doc.documentElement.doScroll("left");}catch(ex){setTimeout(arguments.callee,0);return;}
t._pageInit(win);})();}}else if(doc.addEventListener){t._add(win,'DOMContentLoaded',function(){t._pageInit(win);});}
t._add(win,'load',function(){t._pageInit(win);});},_stoppers:{preventDefault:function(){this.returnValue=false;},stopPropagation:function(){this.cancelBubble=true;}}});Event=tinymce.dom.Event=new tinymce.dom.EventUtils();Event._wait(window);tinymce.addUnload(function(){Event.destroy();});})(tinymce);(function(tinymce){tinymce.dom.Element=function(id,settings){var t=this,dom,el;t.settings=settings=settings||{};t.id=id;t.dom=dom=settings.dom||tinymce.DOM;if(!tinymce.isIE)
el=dom.get(t.id);tinymce.each(('getPos,getRect,getParent,add,setStyle,getStyle,setStyles,'+'setAttrib,setAttribs,getAttrib,addClass,removeClass,'+'hasClass,getOuterHTML,setOuterHTML,remove,show,hide,'+'isHidden,setHTML,get').split(/,/),function(k){t[k]=function(){var a=[id],i;for(i=0;i<arguments.length;i++)
a.push(arguments[i]);a=dom[k].apply(dom,a);t.update(k);return a;};});tinymce.extend(t,{on:function(n,f,s){return tinymce.dom.Event.add(t.id,n,f,s);},getXY:function(){return{x:parseInt(t.getStyle('left')),y:parseInt(t.getStyle('top'))};},getSize:function(){var n=dom.get(t.id);return{w:parseInt(t.getStyle('width')||n.clientWidth),h:parseInt(t.getStyle('height')||n.clientHeight)};},moveTo:function(x,y){t.setStyles({left:x,top:y});},moveBy:function(x,y){var p=t.getXY();t.moveTo(p.x+x,p.y+y);},resizeTo:function(w,h){t.setStyles({width:w,height:h});},resizeBy:function(w,h){var s=t.getSize();t.resizeTo(s.w+w,s.h+h);},update:function(k){var b;if(tinymce.isIE6&&settings.blocker){k=k||'';if(k.indexOf('get')===0||k.indexOf('has')===0||k.indexOf('is')===0)
return;if(k=='remove'){dom.remove(t.blocker);return;}
if(!t.blocker){t.blocker=dom.uniqueId();b=dom.add(settings.container||dom.getRoot(),'iframe',{id:t.blocker,style:'position:absolute;',frameBorder:0,src:'javascript:""'});dom.setStyle(b,'opacity',0);}else
b=dom.get(t.blocker);dom.setStyles(b,{left:t.getStyle('left',1),top:t.getStyle('top',1),width:t.getStyle('width',1),height:t.getStyle('height',1),display:t.getStyle('display',1),zIndex:parseInt(t.getStyle('zIndex',1)||0)-1});}}});};})(tinymce);(function(tinymce){function trimNl(s){return s.replace(/[\n\r]+/g,'');};var is=tinymce.is,isIE=tinymce.isIE,each=tinymce.each;tinymce.create('tinymce.dom.Selection',{Selection:function(dom,win,serializer){var t=this;t.dom=dom;t.win=win;t.serializer=serializer;each(['onBeforeSetContent','onBeforeGetContent','onSetContent','onGetContent'],function(e){t[e]=new tinymce.util.Dispatcher(t);});if(!t.win.getSelection)
t.tridentSel=new tinymce.dom.TridentSelection(t);tinymce.addUnload(t.destroy,t);},getContent:function(s){var t=this,r=t.getRng(),e=t.dom.create("body"),se=t.getSel(),wb,wa,n;s=s||{};wb=wa='';s.get=true;s.format=s.format||'html';t.onBeforeGetContent.dispatch(t,s);if(s.format=='text')
return t.isCollapsed()?'':(r.text||(se.toString?se.toString():''));if(r.cloneContents){n=r.cloneContents();if(n)
e.appendChild(n);}else if(is(r.item)||is(r.htmlText))
e.innerHTML=r.item?r.item(0).outerHTML:r.htmlText;else
e.innerHTML=r.toString();if(/^\s/.test(e.innerHTML))
wb=' ';if(/\s+$/.test(e.innerHTML))
wa=' ';s.getInner=true;s.content=t.isCollapsed()?'':wb+t.serializer.serialize(e,s)+wa;t.onGetContent.dispatch(t,s);return s.content;},setContent:function(h,s){var t=this,r=t.getRng(),c,d=t.win.document;s=s||{format:'html'};s.set=true;h=s.content=t.dom.processHTML(h);t.onBeforeSetContent.dispatch(t,s);h=s.content;if(r.insertNode){h+='<span id="__caret">_</span>';if(r.startContainer==d&&r.endContainer==d){d.body.innerHTML=h;}else{r.deleteContents();if(d.body.childNodes.length==0){d.body.innerHTML=h;}else{r.insertNode(r.createContextualFragment(h));}}
c=t.dom.get('__caret');r=d.createRange();r.setStartBefore(c);r.setEndBefore(c);t.setRng(r);t.dom.remove('__caret');}else{if(r.item){d.execCommand('Delete',false,null);r=t.getRng();}
r.pasteHTML(h);}
t.onSetContent.dispatch(t,s);},getStart:function(){var rng=this.getRng(),startElement,parentElement,checkRng,node;if(rng.duplicate||rng.item){if(rng.item)
return rng.item(0);checkRng=rng.duplicate();checkRng.collapse(1);startElement=checkRng.parentElement();parentElement=node=rng.parentElement();while(node=node.parentNode){if(node==startElement){startElement=parentElement;break;}}
if(startElement&&startElement.nodeName=='BODY')
return startElement.firstChild||startElement;return startElement;}else{startElement=rng.startContainer;if(startElement.nodeType==1&&startElement.hasChildNodes())
startElement=startElement.childNodes[Math.min(startElement.childNodes.length-1,rng.startOffset)];if(startElement&&startElement.nodeType==3)
return startElement.parentNode;return startElement;}},getEnd:function(){var t=this,r=t.getRng(),e,eo;if(r.duplicate||r.item){if(r.item)
return r.item(0);r=r.duplicate();r.collapse(0);e=r.parentElement();if(e&&e.nodeName=='BODY')
return e.lastChild||e;return e;}else{e=r.endContainer;eo=r.endOffset;if(e.nodeType==1&&e.hasChildNodes())
e=e.childNodes[eo>0?eo-1:eo];if(e&&e.nodeType==3)
return e.parentNode;return e;}},getBookmark:function(type,normalized){var t=this,dom=t.dom,rng,rng2,id,collapsed,name,element,index,chr='\uFEFF',styles;function findIndex(name,element){var index=0;each(dom.select(name),function(node,i){if(node==element)
index=i;});return index;};if(type==2){function getLocation(){var rng=t.getRng(true),root=dom.getRoot(),bookmark={};function getPoint(rng,start){var container=rng[start?'startContainer':'endContainer'],offset=rng[start?'startOffset':'endOffset'],point=[],node,childNodes,after=0;if(container.nodeType==3){if(normalized){for(node=container.previousSibling;node&&node.nodeType==3;node=node.previousSibling)
offset+=node.nodeValue.length;}
point.push(offset);}else{childNodes=container.childNodes;if(offset>=childNodes.length&&childNodes.length){after=1;offset=Math.max(0,childNodes.length-1);}
point.push(t.dom.nodeIndex(childNodes[offset],normalized)+after);}
for(;container&&container!=root;container=container.parentNode)
point.push(t.dom.nodeIndex(container,normalized));return point;};bookmark.start=getPoint(rng,true);if(!t.isCollapsed())
bookmark.end=getPoint(rng);return bookmark;};return getLocation();}
if(type)
return{rng:t.getRng()};rng=t.getRng();id=dom.uniqueId();collapsed=tinyMCE.activeEditor.selection.isCollapsed();styles='overflow:hidden;line-height:0px';if(rng.duplicate||rng.item){if(!rng.item){rng2=rng.duplicate();rng.collapse();rng.pasteHTML('<span _mce_type="bookmark" id="'+id+'_start" style="'+styles+'">'+chr+'</span>');if(!collapsed){rng2.collapse(false);rng2.pasteHTML('<span _mce_type="bookmark" id="'+id+'_end" style="'+styles+'">'+chr+'</span>');}}else{element=rng.item(0);name=element.nodeName;return{name:name,index:findIndex(name,element)};}}else{element=t.getNode();name=element.nodeName;if(name=='IMG')
return{name:name,index:findIndex(name,element)};rng2=rng.cloneRange();if(!collapsed){rng2.collapse(false);rng2.insertNode(dom.create('span',{_mce_type:"bookmark",id:id+'_end',style:styles},chr));}
rng.collapse(true);rng.insertNode(dom.create('span',{_mce_type:"bookmark",id:id+'_start',style:styles},chr));}
t.moveToBookmark({id:id,keep:1});return{id:id};},moveToBookmark:function(bookmark){var t=this,dom=t.dom,marker1,marker2,rng,root,startContainer,endContainer,startOffset,endOffset;if(t.tridentSel)
t.tridentSel.destroy();if(bookmark){if(bookmark.start){rng=dom.createRng();root=dom.getRoot();function setEndPoint(start){var point=bookmark[start?'start':'end'],i,node,offset,children;if(point){for(node=root,i=point.length-1;i>=1;i--){children=node.childNodes;if(children.length)
node=children[point[i]];}
if(start)
rng.setStart(node,point[0]);else
rng.setEnd(node,point[0]);}};setEndPoint(true);setEndPoint();t.setRng(rng);}else if(bookmark.id){function restoreEndPoint(suffix){var marker=dom.get(bookmark.id+'_'+suffix),node,idx,next,prev,keep=bookmark.keep;if(marker){node=marker.parentNode;if(suffix=='start'){if(!keep){idx=dom.nodeIndex(marker);}else{node=marker.firstChild;idx=1;}
startContainer=endContainer=node;startOffset=endOffset=idx;}else{if(!keep){idx=dom.nodeIndex(marker);}else{node=marker.firstChild;idx=1;}
endContainer=node;endOffset=idx;}
if(!keep){prev=marker.previousSibling;next=marker.nextSibling;each(tinymce.grep(marker.childNodes),function(node){if(node.nodeType==3)
node.nodeValue=node.nodeValue.replace(/\uFEFF/g,'');});while(marker=dom.get(bookmark.id+'_'+suffix))
dom.remove(marker,1);if(prev&&next&&prev.nodeType==next.nodeType&&prev.nodeType==3){idx=prev.nodeValue.length;prev.appendData(next.nodeValue);dom.remove(next);if(suffix=='start'){startContainer=endContainer=prev;startOffset=endOffset=idx;}else{endContainer=prev;endOffset=idx;}}}}};function addBogus(node){if(!isIE&&dom.isBlock(node)&&!node.innerHTML)
node.innerHTML='<br _mce_bogus="1" />';return node;};restoreEndPoint('start');restoreEndPoint('end');if(startContainer){rng=dom.createRng();rng.setStart(addBogus(startContainer),startOffset);rng.setEnd(addBogus(endContainer),endOffset);t.setRng(rng);}}else if(bookmark.name){t.select(dom.select(bookmark.name)[bookmark.index]);}else if(bookmark.rng)
t.setRng(bookmark.rng);}},select:function(node,content){var t=this,dom=t.dom,rng=dom.createRng(),idx;idx=dom.nodeIndex(node);rng.setStart(node.parentNode,idx);rng.setEnd(node.parentNode,idx+1);if(content){function setPoint(node,start){var walker=new tinymce.dom.TreeWalker(node,node);do{if(node.nodeType==3&&tinymce.trim(node.nodeValue).length!=0){if(start)
rng.setStart(node,0);else
rng.setEnd(node,node.nodeValue.length);return;}
if(node.nodeName=='BR'){if(start)
rng.setStartBefore(node);else
rng.setEndBefore(node);return;}}while(node=(start?walker.next():walker.prev()));};setPoint(node,1);setPoint(node);}
t.setRng(rng);return node;},isCollapsed:function(){var t=this,r=t.getRng(),s=t.getSel();if(!r||r.item)
return false;if(r.compareEndPoints)
return r.compareEndPoints('StartToEnd',r)===0;return!s||r.collapsed;},collapse:function(b){var t=this,r=t.getRng(),n;if(r.item){n=r.item(0);r=this.win.document.body.createTextRange();r.moveToElementText(n);}
r.collapse(!!b);t.setRng(r);},getSel:function(){var t=this,w=this.win;return w.getSelection?w.getSelection():w.document.selection;},getRng:function(w3c){var t=this,s,r;if(w3c&&t.tridentSel)
return t.tridentSel.getRangeAt(0);try{if(s=t.getSel())
r=s.rangeCount>0?s.getRangeAt(0):(s.createRange?s.createRange():t.win.document.createRange());}catch(ex){}
if(!r)
r=t.win.document.createRange?t.win.document.createRange():t.win.document.body.createTextRange();if(t.selectedRange&&t.explicitRange){if(r.compareBoundaryPoints(r.START_TO_START,t.selectedRange)===0&&r.compareBoundaryPoints(r.END_TO_END,t.selectedRange)===0){r=t.explicitRange;}else{t.selectedRange=null;t.explicitRange=null;}}
return r;},setRng:function(r){var s,t=this;if(!t.tridentSel){s=t.getSel();if(s){t.explicitRange=r;s.removeAllRanges();s.addRange(r);t.selectedRange=s.getRangeAt(0);}}else{if(r.cloneRange){t.tridentSel.addRange(r);return;}
try{r.select();}catch(ex){}}},setNode:function(n){var t=this;t.setContent(t.dom.getOuterHTML(n));return n;},getNode:function(){var t=this,rng=t.getRng(),sel=t.getSel(),elm;if(rng.setStart){if(!rng)
return t.dom.getRoot();elm=rng.commonAncestorContainer;if(!rng.collapsed){if(rng.startContainer==rng.endContainer){if(rng.startOffset-rng.endOffset<2){if(rng.startContainer.hasChildNodes())
elm=rng.startContainer.childNodes[rng.startOffset];}}
if(tinymce.isWebKit&&sel.anchorNode&&sel.anchorNode.nodeType==1)
return sel.anchorNode.childNodes[sel.anchorOffset];}
if(elm&&elm.nodeType==3)
return elm.parentNode;return elm;}
return rng.item?rng.item(0):rng.parentElement();},getSelectedBlocks:function(st,en){var t=this,dom=t.dom,sb,eb,n,bl=[];sb=dom.getParent(st||t.getStart(),dom.isBlock);eb=dom.getParent(en||t.getEnd(),dom.isBlock);if(sb)
bl.push(sb);if(sb&&eb&&sb!=eb){n=sb;while((n=n.nextSibling)&&n!=eb){if(dom.isBlock(n))
bl.push(n);}}
if(eb&&sb!=eb)
bl.push(eb);return bl;},destroy:function(s){var t=this;t.win=null;if(t.tridentSel)
t.tridentSel.destroy();if(!s)
tinymce.removeUnload(t.destroy);}});})(tinymce);(function(tinymce){tinymce.create('tinymce.dom.XMLWriter',{node:null,XMLWriter:function(s){function getXML(){var i=document.implementation;if(!i||!i.createDocument){try{return new ActiveXObject('MSXML2.DOMDocument');}catch(ex){}
try{return new ActiveXObject('Microsoft.XmlDom');}catch(ex){}}else
return i.createDocument('','',null);};this.doc=getXML();this.valid=tinymce.isOpera||tinymce.isWebKit;this.reset();},reset:function(){var t=this,d=t.doc;if(d.firstChild)
d.removeChild(d.firstChild);t.node=d.appendChild(d.createElement("html"));},writeStartElement:function(n){var t=this;t.node=t.node.appendChild(t.doc.createElement(n));},writeAttribute:function(n,v){if(this.valid)
v=v.replace(/>/g,'%MCGT%');this.node.setAttribute(n,v);},writeEndElement:function(){this.node=this.node.parentNode;},writeFullEndElement:function(){var t=this,n=t.node;n.appendChild(t.doc.createTextNode(""));t.node=n.parentNode;},writeText:function(v){if(this.valid)
v=v.replace(/>/g,'%MCGT%');this.node.appendChild(this.doc.createTextNode(v));},writeCDATA:function(v){this.node.appendChild(this.doc.createCDATASection(v));},writeComment:function(v){if(tinymce.isIE)
v=v.replace(/^\-|\-$/g,' ');this.node.appendChild(this.doc.createComment(v.replace(/\-\-/g,' ')));},getContent:function(){var h;h=this.doc.xml||new XMLSerializer().serializeToString(this.doc);h=h.replace(/<\?[^?]+\?>|<html>|<\/html>|<html\/>|<!DOCTYPE[^>]+>/g,'');h=h.replace(/ ?\/>/g,' />');if(this.valid)
h=h.replace(/\%MCGT%/g,'&gt;');return h;}});})(tinymce);(function(tinymce){tinymce.create('tinymce.dom.StringWriter',{str:null,tags:null,count:0,settings:null,indent:null,StringWriter:function(s){this.settings=tinymce.extend({indent_char:' ',indentation:0},s);this.reset();},reset:function(){this.indent='';this.str="";this.tags=[];this.count=0;},writeStartElement:function(n){this._writeAttributesEnd();this.writeRaw('<'+n);this.tags.push(n);this.inAttr=true;this.count++;this.elementCount=this.count;},writeAttribute:function(n,v){var t=this;t.writeRaw(" "+t.encode(n)+'="'+t.encode(v)+'"');},writeEndElement:function(){var n;if(this.tags.length>0){n=this.tags.pop();if(this._writeAttributesEnd(1))
this.writeRaw('</'+n+'>');if(this.settings.indentation>0)
this.writeRaw('\n');}},writeFullEndElement:function(){if(this.tags.length>0){this._writeAttributesEnd();this.writeRaw('</'+this.tags.pop()+'>');if(this.settings.indentation>0)
this.writeRaw('\n');}},writeText:function(v){this._writeAttributesEnd();this.writeRaw(this.encode(v));this.count++;},writeCDATA:function(v){this._writeAttributesEnd();this.writeRaw('<![CDATA['+v+']]>');this.count++;},writeComment:function(v){this._writeAttributesEnd();this.writeRaw('<!-- '+v+'-->');this.count++;},writeRaw:function(v){this.str+=v;},encode:function(s){return s.replace(/[<>&"]/g,function(v){switch(v){case'<':return'&lt;';case'>':return'&gt;';case'&':return'&amp;';case'"':return'&quot;';}
return v;});},getContent:function(){return this.str;},_writeAttributesEnd:function(s){if(!this.inAttr)
return;this.inAttr=false;if(s&&this.elementCount==this.count){this.writeRaw(' />');return false;}
this.writeRaw('>');return true;}});})(tinymce);(function(tinymce){var extend=tinymce.extend,each=tinymce.each,Dispatcher=tinymce.util.Dispatcher,isIE=tinymce.isIE,isGecko=tinymce.isGecko;function wildcardToRE(s){return s.replace(/([?+*])/g,'.$1');};tinymce.create('tinymce.dom.Serializer',{Serializer:function(s){var t=this;t.key=0;t.onPreProcess=new Dispatcher(t);t.onPostProcess=new Dispatcher(t);try{t.writer=new tinymce.dom.XMLWriter();}catch(ex){t.writer=new tinymce.dom.StringWriter();}
t.settings=s=extend({dom:tinymce.DOM,valid_nodes:0,node_filter:0,attr_filter:0,invalid_attrs:/^(_mce_|_moz_|sizset|sizcache)/,closed:/^(br|hr|input|meta|img|link|param|area)$/,entity_encoding:'named',entities:'160,nbsp,161,iexcl,162,cent,163,pound,164,curren,165,yen,166,brvbar,167,sect,168,uml,169,copy,170,ordf,171,laquo,172,not,173,shy,174,reg,175,macr,176,deg,177,plusmn,178,sup2,179,sup3,180,acute,181,micro,182,para,183,middot,184,cedil,185,sup1,186,ordm,187,raquo,188,frac14,189,frac12,190,frac34,191,iquest,192,Agrave,193,Aacute,194,Acirc,195,Atilde,196,Auml,197,Aring,198,AElig,199,Ccedil,200,Egrave,201,Eacute,202,Ecirc,203,Euml,204,Igrave,205,Iacute,206,Icirc,207,Iuml,208,ETH,209,Ntilde,210,Ograve,211,Oacute,212,Ocirc,213,Otilde,214,Ouml,215,times,216,Oslash,217,Ugrave,218,Uacute,219,Ucirc,220,Uuml,221,Yacute,222,THORN,223,szlig,224,agrave,225,aacute,226,acirc,227,atilde,228,auml,229,aring,230,aelig,231,ccedil,232,egrave,233,eacute,234,ecirc,235,euml,236,igrave,237,iacute,238,icirc,239,iuml,240,eth,241,ntilde,242,ograve,243,oacute,244,ocirc,245,otilde,246,ouml,247,divide,248,oslash,249,ugrave,250,uacute,251,ucirc,252,uuml,253,yacute,254,thorn,255,yuml,402,fnof,913,Alpha,914,Beta,915,Gamma,916,Delta,917,Epsilon,918,Zeta,919,Eta,920,Theta,921,Iota,922,Kappa,923,Lambda,924,Mu,925,Nu,926,Xi,927,Omicron,928,Pi,929,Rho,931,Sigma,932,Tau,933,Upsilon,934,Phi,935,Chi,936,Psi,937,Omega,945,alpha,946,beta,947,gamma,948,delta,949,epsilon,950,zeta,951,eta,952,theta,953,iota,954,kappa,955,lambda,956,mu,957,nu,958,xi,959,omicron,960,pi,961,rho,962,sigmaf,963,sigma,964,tau,965,upsilon,966,phi,967,chi,968,psi,969,omega,977,thetasym,978,upsih,982,piv,8226,bull,8230,hellip,8242,prime,8243,Prime,8254,oline,8260,frasl,8472,weierp,8465,image,8476,real,8482,trade,8501,alefsym,8592,larr,8593,uarr,8594,rarr,8595,darr,8596,harr,8629,crarr,8656,lArr,8657,uArr,8658,rArr,8659,dArr,8660,hArr,8704,forall,8706,part,8707,exist,8709,empty,8711,nabla,8712,isin,8713,notin,8715,ni,8719,prod,8721,sum,8722,minus,8727,lowast,8730,radic,8733,prop,8734,infin,8736,ang,8743,and,8744,or,8745,cap,8746,cup,8747,int,8756,there4,8764,sim,8773,cong,8776,asymp,8800,ne,8801,equiv,8804,le,8805,ge,8834,sub,8835,sup,8836,nsub,8838,sube,8839,supe,8853,oplus,8855,otimes,8869,perp,8901,sdot,8968,lceil,8969,rceil,8970,lfloor,8971,rfloor,9001,lang,9002,rang,9674,loz,9824,spades,9827,clubs,9829,hearts,9830,diams,338,OElig,339,oelig,352,Scaron,353,scaron,376,Yuml,710,circ,732,tilde,8194,ensp,8195,emsp,8201,thinsp,8204,zwnj,8205,zwj,8206,lrm,8207,rlm,8211,ndash,8212,mdash,8216,lsquo,8217,rsquo,8218,sbquo,8220,ldquo,8221,rdquo,8222,bdquo,8224,dagger,8225,Dagger,8240,permil,8249,lsaquo,8250,rsaquo,8364,euro',valid_elements:'*[*]',extended_valid_elements:0,invalid_elements:0,fix_table_elements:1,fix_list_elements:true,fix_content_duplication:true,convert_fonts_to_spans:false,font_size_classes:0,apply_source_formatting:0,indent_mode:'simple',indent_char:'\t',indent_levels:1,remove_linebreaks:1,remove_redundant_brs:1,element_format:'xhtml'},s);t.dom=s.dom;t.schema=s.schema;if(s.entity_encoding=='named'&&!s.entities)
s.entity_encoding='raw';if(s.remove_redundant_brs){t.onPostProcess.add(function(se,o){o.content=o.content.replace(/(<br \/>\s*)+<\/(p|h[1-6]|div|li)>/gi,function(a,b,c){if(/^<br \/>\s*<\//.test(a))
return'</'+c+'>';return a;});});}
if(s.element_format=='html'){t.onPostProcess.add(function(se,o){o.content=o.content.replace(/<([^>]+) \/>/g,'<$1>');});}
if(s.fix_list_elements){t.onPreProcess.add(function(se,o){var nl,x,a=['ol','ul'],i,n,p,r=/^(OL|UL)$/,np;function prevNode(e,n){var a=n.split(','),i;while((e=e.previousSibling)!=null){for(i=0;i<a.length;i++){if(e.nodeName==a[i])
return e;}}
return null;};for(x=0;x<a.length;x++){nl=t.dom.select(a[x],o.node);for(i=0;i<nl.length;i++){n=nl[i];p=n.parentNode;if(r.test(p.nodeName)){np=prevNode(n,'LI');if(!np){np=t.dom.create('li');np.innerHTML='&nbsp;';np.appendChild(n);p.insertBefore(np,p.firstChild);}else
np.appendChild(n);}}}});}
if(s.fix_table_elements){t.onPreProcess.add(function(se,o){if(!tinymce.isOpera||opera.buildNumber()>=1767){each(t.dom.select('p table',o.node).reverse(),function(n){var parent=t.dom.getParent(n.parentNode,'table,p');if(parent.nodeName!='TABLE'){try{t.dom.split(parent,n);}catch(ex){}}});}});}},setEntities:function(s){var t=this,a,i,l={},v;if(t.entityLookup)
return;a=s.split(',');for(i=0;i<a.length;i+=2){v=a[i];if(v==34||v==38||v==60||v==62)
continue;l[String.fromCharCode(a[i])]=a[i+1];v=parseInt(a[i]).toString(16);}
t.entityLookup=l;},setRules:function(s){var t=this;t._setup();t.rules={};t.wildRules=[];t.validElements={};return t.addRules(s);},addRules:function(s){var t=this,dr;if(!s)
return;t._setup();each(s.split(','),function(s){var p=s.split(/\[|\]/),tn=p[0].split('/'),ra,at,wat,va=[];if(dr)
at=tinymce.extend([],dr.attribs);if(p.length>1){each(p[1].split('|'),function(s){var ar={},i;at=at||[];s=s.replace(/::/g,'~');s=/^([!\-])?([\w*.?~_\-]+|)([=:<])?(.+)?$/.exec(s);s[2]=s[2].replace(/~/g,':');if(s[1]=='!'){ra=ra||[];ra.push(s[2]);}
if(s[1]=='-'){for(i=0;i<at.length;i++){if(at[i].name==s[2]){at.splice(i,1);return;}}}
switch(s[3]){case'=':ar.defaultVal=s[4]||'';break;case':':ar.forcedVal=s[4];break;case'<':ar.validVals=s[4].split('?');break;}
if(/[*.?]/.test(s[2])){wat=wat||[];ar.nameRE=new RegExp('^'+wildcardToRE(s[2])+'$');wat.push(ar);}else{ar.name=s[2];at.push(ar);}
va.push(s[2]);});}
each(tn,function(s,i){var pr=s.charAt(0),x=1,ru={};if(dr){if(dr.noEmpty)
ru.noEmpty=dr.noEmpty;if(dr.fullEnd)
ru.fullEnd=dr.fullEnd;if(dr.padd)
ru.padd=dr.padd;}
switch(pr){case'-':ru.noEmpty=true;break;case'+':ru.fullEnd=true;break;case'#':ru.padd=true;break;default:x=0;}
tn[i]=s=s.substring(x);t.validElements[s]=1;if(/[*.?]/.test(tn[0])){ru.nameRE=new RegExp('^'+wildcardToRE(tn[0])+'$');t.wildRules=t.wildRules||{};t.wildRules.push(ru);}else{ru.name=tn[0];if(tn[0]=='@')
dr=ru;t.rules[s]=ru;}
ru.attribs=at;if(ra)
ru.requiredAttribs=ra;if(wat){s='';each(va,function(v){if(s)
s+='|';s+='('+wildcardToRE(v)+')';});ru.validAttribsRE=new RegExp('^'+s.toLowerCase()+'$');ru.wildAttribs=wat;}});});s='';each(t.validElements,function(v,k){if(s)
s+='|';if(k!='@')
s+=k;});t.validElementsRE=new RegExp('^('+wildcardToRE(s.toLowerCase())+')$');},findRule:function(n){var t=this,rl=t.rules,i,r;t._setup();r=rl[n];if(r)
return r;rl=t.wildRules;for(i=0;i<rl.length;i++){if(rl[i].nameRE.test(n))
return rl[i];}
return null;},findAttribRule:function(ru,n){var i,wa=ru.wildAttribs;for(i=0;i<wa.length;i++){if(wa[i].nameRE.test(n))
return wa[i];}
return null;},serialize:function(n,o){var h,t=this,doc,oldDoc,impl,selected;t._setup();o=o||{};o.format=o.format||'html';t.processObj=o;if(isIE){selected=[];each(n.getElementsByTagName('option'),function(n){var v=t.dom.getAttrib(n,'selected');selected.push(v?v:null);});}
n=n.cloneNode(true);if(isIE){each(n.getElementsByTagName('option'),function(n,i){t.dom.setAttrib(n,'selected',selected[i]);});}
impl=n.ownerDocument.implementation;if(impl.createHTMLDocument&&(tinymce.isOpera&&opera.buildNumber()>=1767)){doc=impl.createHTMLDocument("");each(n.nodeName=='BODY'?n.childNodes:[n],function(node){doc.body.appendChild(doc.importNode(node,true));});if(n.nodeName!='BODY')
n=doc.body.firstChild;else
n=doc.body;oldDoc=t.dom.doc;t.dom.doc=doc;}
t.key=''+(parseInt(t.key)+1);if(!o.no_events){o.node=n;t.onPreProcess.dispatch(t,o);}
t.writer.reset();t._info=o;t._serializeNode(n,o.getInner);o.content=t.writer.getContent();if(oldDoc)
t.dom.doc=oldDoc;if(!o.no_events)
t.onPostProcess.dispatch(t,o);t._postProcess(o);o.node=null;return tinymce.trim(o.content);},_postProcess:function(o){var t=this,s=t.settings,h=o.content,sc=[],p;if(o.format=='html'){p=t._protect({content:h,patterns:[{pattern:/(<script[^>]*>)(.*?)(<\/script>)/g},{pattern:/(<noscript[^>]*>)(.*?)(<\/noscript>)/g},{pattern:/(<style[^>]*>)(.*?)(<\/style>)/g},{pattern:/(<pre[^>]*>)(.*?)(<\/pre>)/g,encode:1},{pattern:/(<!--\[CDATA\[)(.*?)(\]\]-->)/g}]});h=p.content;if(s.entity_encoding!=='raw')
h=t._encode(h);if(!o.set){h=h.replace(/<p>\s+<\/p>|<p([^>]+)>\s+<\/p>/g,s.entity_encoding=='numeric'?'<p$1>&#160;</p>':'<p$1>&nbsp;</p>');if(s.remove_linebreaks){h=h.replace(/\r?\n|\r/g,' ');h=h.replace(/(<[^>]+>)\s+/g,'$1 ');h=h.replace(/\s+(<\/[^>]+>)/g,' $1');h=h.replace(/<(p|h[1-6]|blockquote|hr|div|table|tbody|tr|td|body|head|html|title|meta|style|pre|script|link|object) ([^>]+)>\s+/g,'<$1 $2>');h=h.replace(/<(p|h[1-6]|blockquote|hr|div|table|tbody|tr|td|body|head|html|title|meta|style|pre|script|link|object)>\s+/g,'<$1>');h=h.replace(/\s+<\/(p|h[1-6]|blockquote|hr|div|table|tbody|tr|td|body|head|html|title|meta|style|pre|script|link|object)>/g,'</$1>');}
if(s.apply_source_formatting&&s.indent_mode=='simple'){h=h.replace(/<(\/?)(ul|hr|table|meta|link|tbody|tr|object|body|head|html|map)(|[^>]+)>\s*/g,'\n<$1$2$3>\n');h=h.replace(/\s*<(p|h[1-6]|blockquote|div|title|style|pre|script|td|li|area)(|[^>]+)>/g,'\n<$1$2>');h=h.replace(/<\/(p|h[1-6]|blockquote|div|title|style|pre|script|td|li)>\s*/g,'</$1>\n');h=h.replace(/\n\n/g,'\n');}}
h=t._unprotect(h,p);h=h.replace(/<!--\[CDATA\[([\s\S]+)\]\]-->/g,'<![CDATA[$1]]>');if(s.entity_encoding=='raw')
h=h.replace(/<p>&nbsp;<\/p>|<p([^>]+)>&nbsp;<\/p>/g,'<p$1>\u00a0</p>');h=h.replace(/<noscript([^>]+|)>([\s\S]*?)<\/noscript>/g,function(v,attribs,text){return'<noscript'+attribs+'>'+t.dom.decode(text.replace(/<!--|-->/g,''))+'</noscript>';});}
o.content=h;},_serializeNode:function(n,inner){var t=this,s=t.settings,w=t.writer,hc,el,cn,i,l,a,at,no,v,nn,ru,ar,iv,closed,keep,type,scopeName;if(!s.node_filter||s.node_filter(n)){switch(n.nodeType){case 1:if(n.hasAttribute?n.hasAttribute('_mce_bogus'):n.getAttribute('_mce_bogus'))
return;iv=keep=false;hc=n.hasChildNodes();nn=n.getAttribute('_mce_name')||n.nodeName.toLowerCase();type=n.getAttribute('_mce_type');if(type){if(!t._info.cleanup){iv=true;return;}else
keep=1;}
if(isIE){scopeName=n.scopeName;if(scopeName&&scopeName!=='HTML'&&scopeName!=='html')
nn=scopeName+':'+nn;}
if(nn.indexOf('mce:')===0)
nn=nn.substring(4);if(!keep){if(!t.validElementsRE||!t.validElementsRE.test(nn)||(t.invalidElementsRE&&t.invalidElementsRE.test(nn))||inner){iv=true;break;}}
if(isIE){if(s.fix_content_duplication){if(n._mce_serialized==t.key)
return;n._mce_serialized=t.key;}
if(nn.charAt(0)=='/')
nn=nn.substring(1);}else if(isGecko){if(n.nodeName==='BR'&&n.getAttribute('type')=='_moz')
return;}
if(s.validate_children){if(t.elementName&&!t.schema.isValid(t.elementName,nn)){iv=true;break;}
t.elementName=nn;}
ru=t.findRule(nn);if(!ru){iv=true;break;}
nn=ru.name||nn;closed=s.closed.test(nn);if((!hc&&ru.noEmpty)||(isIE&&!nn)){iv=true;break;}
if(ru.requiredAttribs){a=ru.requiredAttribs;for(i=a.length-1;i>=0;i--){if(this.dom.getAttrib(n,a[i])!=='')
break;}
if(i==-1){iv=true;break;}}
w.writeStartElement(nn);if(ru.attribs){for(i=0,at=ru.attribs,l=at.length;i<l;i++){a=at[i];v=t._getAttrib(n,a);if(v!==null)
w.writeAttribute(a.name,v);}}
if(ru.validAttribsRE){at=t.dom.getAttribs(n);for(i=at.length-1;i>-1;i--){no=at[i];if(no.specified){a=no.nodeName.toLowerCase();if(s.invalid_attrs.test(a)||!ru.validAttribsRE.test(a))
continue;ar=t.findAttribRule(ru,a);v=t._getAttrib(n,ar,a);if(v!==null)
w.writeAttribute(a,v);}}}
if(type&&keep)
w.writeAttribute('_mce_type',type);if(nn==='script'&&tinymce.trim(n.innerHTML)){w.writeText('// ');w.writeCDATA(n.innerHTML.replace(/<!--|-->|<\[CDATA\[|\]\]>/g,''));hc=false;break;}
if(ru.padd){if(hc&&(cn=n.firstChild)&&cn.nodeType===1&&n.childNodes.length===1){if(cn.hasAttribute?cn.hasAttribute('_mce_bogus'):cn.getAttribute('_mce_bogus'))
w.writeText('\u00a0');}else if(!hc)
w.writeText('\u00a0');}
break;case 3:if(s.validate_children&&t.elementName&&!t.schema.isValid(t.elementName,'#text'))
return;return w.writeText(n.nodeValue);case 4:return w.writeCDATA(n.nodeValue);case 8:return w.writeComment(n.nodeValue);}}else if(n.nodeType==1)
hc=n.hasChildNodes();if(hc&&!closed){cn=n.firstChild;while(cn){t._serializeNode(cn);t.elementName=nn;cn=cn.nextSibling;}}
if(!iv){if(!closed)
w.writeFullEndElement();else
w.writeEndElement();}},_protect:function(o){var t=this;o.items=o.items||[];function enc(s){return s.replace(/[\r\n\\]/g,function(c){if(c==='\n')
return'\\n';else if(c==='\\')
return'\\\\';return'\\r';});};function dec(s){return s.replace(/\\[\\rn]/g,function(c){if(c==='\\n')
return'\n';else if(c==='\\\\')
return'\\';return'\r';});};each(o.patterns,function(p){o.content=dec(enc(o.content).replace(p.pattern,function(x,a,b,c){b=dec(b);if(p.encode)
b=t._encode(b);o.items.push(b);return a+'<!--mce:'+(o.items.length-1)+'-->'+c;}));});return o;},_unprotect:function(h,o){h=h.replace(/\<!--mce:([0-9]+)--\>/g,function(a,b){return o.items[parseInt(b)];});o.items=[];return h;},_encode:function(h){var t=this,s=t.settings,l;if(s.entity_encoding!=='raw'){if(s.entity_encoding.indexOf('named')!=-1){t.setEntities(s.entities);l=t.entityLookup;h=h.replace(/[\u007E-\uFFFF]/g,function(a){var v;if(v=l[a])
a='&'+v+';';return a;});}
if(s.entity_encoding.indexOf('numeric')!=-1){h=h.replace(/[\u007E-\uFFFF]/g,function(a){return'&#'+a.charCodeAt(0)+';';});}}
return h;},_setup:function(){var t=this,s=this.settings;if(t.done)
return;t.done=1;t.setRules(s.valid_elements);t.addRules(s.extended_valid_elements);if(s.invalid_elements)
t.invalidElementsRE=new RegExp('^('+wildcardToRE(s.invalid_elements.replace(/,/g,'|').toLowerCase())+')$');if(s.attrib_value_filter)
t.attribValueFilter=s.attribValueFilter;},_getAttrib:function(n,a,na){var i,v;na=na||a.name;if(a.forcedVal&&(v=a.forcedVal)){if(v==='{$uid}')
return this.dom.uniqueId();return v;}
v=this.dom.getAttrib(n,na);switch(na){case'rowspan':case'colspan':if(v=='1')
v='';break;}
if(this.attribValueFilter)
v=this.attribValueFilter(na,v,n);if(a.validVals){for(i=a.validVals.length-1;i>=0;i--){if(v==a.validVals[i])
break;}
if(i==-1)
return null;}
if(v===''&&typeof(a.defaultVal)!='undefined'){v=a.defaultVal;if(v==='{$uid}')
return this.dom.uniqueId();return v;}else{if(na=='class'&&this.processObj.get)
v=v.replace(/\s?mceItem\w+\s?/g,'');}
if(v==='')
return null;return v;}});})(tinymce);(function(tinymce){tinymce.dom.ScriptLoader=function(settings){var QUEUED=0,LOADING=1,LOADED=2,states={},queue=[],scriptLoadedCallbacks={},queueLoadedCallbacks=[],loading=0,undefined;function loadScript(url,callback){var t=this,dom=tinymce.DOM,elm,uri,loc,id;function done(){dom.remove(id);if(elm)
elm.onreadystatechange=elm.onload=elm=null;callback();};id=dom.uniqueId();if(tinymce.isIE6){uri=new tinymce.util.URI(url);loc=location;if(uri.host==loc.hostname&&uri.port==loc.port&&(uri.protocol+':')==loc.protocol){tinymce.util.XHR.send({url:tinymce._addVer(uri.getURI()),success:function(content){var script=dom.create('script',{type:'text/javascript'});script.text=content;document.getElementsByTagName('head')[0].appendChild(script);dom.remove(script);done();}});return;}}
elm=dom.create('script',{id:id,type:'text/javascript',src:tinymce._addVer(url)});elm.onload=done;elm.onreadystatechange=function(){var state=elm.readyState;if(state=='complete'||state=='loaded')
done();};(document.getElementsByTagName('head')[0]||document.body).appendChild(elm);};this.isDone=function(url){return states[url]==LOADED;};this.markDone=function(url){states[url]=LOADED;};this.add=this.load=function(url,callback,scope){var item,state=states[url];if(state==undefined){queue.push(url);states[url]=QUEUED;}
if(callback){if(!scriptLoadedCallbacks[url])
scriptLoadedCallbacks[url]=[];scriptLoadedCallbacks[url].push({func:callback,scope:scope||this});}};this.loadQueue=function(callback,scope){this.loadScripts(queue,callback,scope);};this.loadScripts=function(scripts,callback,scope){var loadScripts;function execScriptLoadedCallbacks(url){tinymce.each(scriptLoadedCallbacks[url],function(callback){callback.func.call(callback.scope);});scriptLoadedCallbacks[url]=undefined;};queueLoadedCallbacks.push({func:callback,scope:scope||this});loadScripts=function(){var loadingScripts=tinymce.grep(scripts);scripts.length=0;tinymce.each(loadingScripts,function(url){if(states[url]==LOADED){execScriptLoadedCallbacks(url);return;}
if(states[url]!=LOADING){states[url]=LOADING;loading++;loadScript(url,function(){states[url]=LOADED;loading--;execScriptLoadedCallbacks(url);loadScripts();});}});if(!loading){tinymce.each(queueLoadedCallbacks,function(callback){callback.func.call(callback.scope);});queueLoadedCallbacks.length=0;}};loadScripts();};};tinymce.ScriptLoader=new tinymce.dom.ScriptLoader();})(tinymce);tinymce.dom.TreeWalker=function(start_node,root_node){var node=start_node;function findSibling(node,start_name,sibling_name,shallow){var sibling,parent;if(node){if(!shallow&&node[start_name])
return node[start_name];if(node!=root_node){sibling=node[sibling_name];if(sibling)
return sibling;for(parent=node.parentNode;parent&&parent!=root_node;parent=parent.parentNode){sibling=parent[sibling_name];if(sibling)
return sibling;}}}};this.current=function(){return node;};this.next=function(shallow){return(node=findSibling(node,'firstChild','nextSibling',shallow));};this.prev=function(shallow){return(node=findSibling(node,'lastChild','lastSibling',shallow));};};(function(){var transitional={};function unpack(lookup,data){var key;function replace(value){return value.replace(/[A-Z]+/g,function(key){return replace(lookup[key]);});};for(key in lookup){if(lookup.hasOwnProperty(key))
lookup[key]=replace(lookup[key]);}
replace(data).replace(/#/g,'#text').replace(/(\w+)\[([^\]]+)\]/g,function(str,name,children){var i,map={};children=children.split(/\|/);for(i=children.length-1;i>=0;i--)
map[children[i]]=1;transitional[name]=map;});};unpack({Z:'#|H|K|N|O|P',Y:'#|X|form|R|Q',X:'p|T|div|U|W|isindex|fieldset|table',W:'pre|hr|blockquote|address|center|noframes',U:'ul|ol|dl|menu|dir',ZC:'#|p|Y|div|U|W|table|br|span|bdo|object|applet|img|map|K|N|Q',T:'h1|h2|h3|h4|h5|h6',ZB:'#|X|S|Q',S:'R|P',ZA:'#|a|G|J|M|O|P',R:'#|a|H|K|N|O',Q:'noscript|P',P:'ins|del|script',O:'input|select|textarea|label|button',N:'M|L',M:'em|strong|dfn|code|q|samp|kbd|var|cite|abbr|acronym',L:'sub|sup',K:'J|I',J:'tt|i|b|u|s|strike',I:'big|small|font|basefont',H:'G|F',G:'br|span|bdo',F:'object|applet|img|map|iframe'},'script[]'+'style[]'+'object[#|param|X|form|a|H|K|N|O|Q]'+'param[]'+'p[S]'+'a[Z]'+'br[]'+'span[S]'+'bdo[S]'+'applet[#|param|X|form|a|H|K|N|O|Q]'+'h1[S]'+'img[]'+'map[X|form|Q|area]'+'h2[S]'+'iframe[#|X|form|a|H|K|N|O|Q]'+'h3[S]'+'tt[S]'+'i[S]'+'b[S]'+'u[S]'+'s[S]'+'strike[S]'+'big[S]'+'small[S]'+'font[S]'+'basefont[]'+'em[S]'+'strong[S]'+'dfn[S]'+'code[S]'+'q[S]'+'samp[S]'+'kbd[S]'+'var[S]'+'cite[S]'+'abbr[S]'+'acronym[S]'+'sub[S]'+'sup[S]'+'input[]'+'select[optgroup|option]'+'optgroup[option]'+'option[]'+'textarea[]'+'label[S]'+'button[#|p|T|div|U|W|table|G|object|applet|img|map|K|N|Q]'+'h4[S]'+'ins[#|X|form|a|H|K|N|O|Q]'+'h5[S]'+'del[#|X|form|a|H|K|N|O|Q]'+'h6[S]'+'div[#|X|form|a|H|K|N|O|Q]'+'ul[li]'+'li[#|X|form|a|H|K|N|O|Q]'+'ol[li]'+'dl[dt|dd]'+'dt[S]'+'dd[#|X|form|a|H|K|N|O|Q]'+'menu[li]'+'dir[li]'+'pre[ZA]'+'hr[]'+'blockquote[#|X|form|a|H|K|N|O|Q]'+'address[S|p]'+'center[#|X|form|a|H|K|N|O|Q]'+'noframes[#|X|form|a|H|K|N|O|Q]'+'isindex[]'+'fieldset[#|legend|X|form|a|H|K|N|O|Q]'+'legend[S]'+'table[caption|col|colgroup|thead|tfoot|tbody|tr]'+'caption[S]'+'col[]'+'colgroup[col]'+'thead[tr]'+'tr[th|td]'+'th[#|X|form|a|H|K|N|O|Q]'+'form[#|X|a|H|K|N|O|Q]'+'noscript[#|X|form|a|H|K|N|O|Q]'+'td[#|X|form|a|H|K|N|O|Q]'+'tfoot[tr]'+'tbody[tr]'+'area[]'+'base[]'+'body[#|X|form|a|H|K|N|O|Q]');tinymce.dom.Schema=function(){var t=this,elements=transitional;t.isValid=function(name,child_name){var element=elements[name];return!!(element&&(!child_name||element[child_name]));};};})();(function(tinymce){tinymce.dom.RangeUtils=function(dom){var INVISIBLE_CHAR='\uFEFF';this.walk=function(rng,callback){var startContainer=rng.startContainer,startOffset=rng.startOffset,endContainer=rng.endContainer,endOffset=rng.endOffset,ancestor,startPoint,endPoint,node,parent,siblings,nodes;nodes=dom.select('td.mceSelected,th.mceSelected');if(nodes.length>0){tinymce.each(nodes,function(node){callback([node]);});return;}
function collectSiblings(node,name,end_node){var siblings=[];for(;node&&node!=end_node;node=node[name])
siblings.push(node);return siblings;};function findEndPoint(node,root){do{if(node.parentNode==root)
return node;node=node.parentNode;}while(node);};function walkBoundary(start_node,end_node,next){var siblingName=next?'nextSibling':'previousSibling';for(node=start_node,parent=node.parentNode;node&&node!=end_node;node=parent){parent=node.parentNode;siblings=collectSiblings(node==start_node?node:node[siblingName],siblingName);if(siblings.length){if(!next)
siblings.reverse();callback(siblings);}}};if(startContainer.nodeType==1&&startContainer.hasChildNodes())
startContainer=startContainer.childNodes[startOffset];if(endContainer.nodeType==1&&endContainer.hasChildNodes())
endContainer=endContainer.childNodes[Math.min(startOffset==endOffset?endOffset:endOffset-1,endContainer.childNodes.length-1)];ancestor=dom.findCommonAncestor(startContainer,endContainer);if(startContainer==endContainer)
return callback([startContainer]);for(node=startContainer;node;node=node.parentNode){if(node==endContainer)
return walkBoundary(startContainer,ancestor,true);if(node==ancestor)
break;}
for(node=endContainer;node;node=node.parentNode){if(node==startContainer)
return walkBoundary(endContainer,ancestor);if(node==ancestor)
break;}
startPoint=findEndPoint(startContainer,ancestor)||startContainer;endPoint=findEndPoint(endContainer,ancestor)||endContainer;walkBoundary(startContainer,startPoint,true);siblings=collectSiblings(startPoint==startContainer?startPoint:startPoint.nextSibling,'nextSibling',endPoint==endContainer?endPoint.nextSibling:endPoint);if(siblings.length)
callback(siblings);walkBoundary(endContainer,endPoint);};};tinymce.dom.RangeUtils.compareRanges=function(rng1,rng2){if(rng1&&rng2){if(rng1.item||rng1.duplicate){if(rng1.item&&rng2.item&&rng1.item(0)===rng2.item(0))
return true;if(rng1.isEqual&&rng2.isEqual&&rng2.isEqual(rng1))
return true;}else{return rng1.startContainer==rng2.startContainer&&rng1.startOffset==rng2.startOffset;}}
return false;};})(tinymce);(function(tinymce){var DOM=tinymce.DOM,is=tinymce.is;tinymce.create('tinymce.ui.Control',{Control:function(id,s){this.id=id;this.settings=s=s||{};this.rendered=false;this.onRender=new tinymce.util.Dispatcher(this);this.classPrefix='';this.scope=s.scope||this;this.disabled=0;this.active=0;},setDisabled:function(s){var e;if(s!=this.disabled){e=DOM.get(this.id);if(e&&this.settings.unavailable_prefix){if(s){this.prevTitle=e.title;e.title=this.settings.unavailable_prefix+": "+e.title;}else
e.title=this.prevTitle;}
this.setState('Disabled',s);this.setState('Enabled',!s);this.disabled=s;}},isDisabled:function(){return this.disabled;},setActive:function(s){if(s!=this.active){this.setState('Active',s);this.active=s;}},isActive:function(){return this.active;},setState:function(c,s){var n=DOM.get(this.id);c=this.classPrefix+c;if(s)
DOM.addClass(n,c);else
DOM.removeClass(n,c);},isRendered:function(){return this.rendered;},renderHTML:function(){},renderTo:function(n){DOM.setHTML(n,this.renderHTML());},postRender:function(){var t=this,b;if(is(t.disabled)){b=t.disabled;t.disabled=-1;t.setDisabled(b);}
if(is(t.active)){b=t.active;t.active=-1;t.setActive(b);}},remove:function(){DOM.remove(this.id);this.destroy();},destroy:function(){tinymce.dom.Event.clear(this.id);}});})(tinymce);tinymce.create('tinymce.ui.Container:tinymce.ui.Control',{Container:function(id,s){this.parent(id,s);this.controls=[];this.lookup={};},add:function(c){this.lookup[c.id]=c;this.controls.push(c);return c;},get:function(n){return this.lookup[n];}});tinymce.create('tinymce.ui.Separator:tinymce.ui.Control',{Separator:function(id,s){this.parent(id,s);this.classPrefix='mceSeparator';},renderHTML:function(){return tinymce.DOM.createHTML('span',{'class':this.classPrefix});}});(function(tinymce){var is=tinymce.is,DOM=tinymce.DOM,each=tinymce.each,walk=tinymce.walk;tinymce.create('tinymce.ui.MenuItem:tinymce.ui.Control',{MenuItem:function(id,s){this.parent(id,s);this.classPrefix='mceMenuItem';},setSelected:function(s){this.setState('Selected',s);this.selected=s;},isSelected:function(){return this.selected;},postRender:function(){var t=this;t.parent();if(is(t.selected))
t.setSelected(t.selected);}});})(tinymce);(function(tinymce){var is=tinymce.is,DOM=tinymce.DOM,each=tinymce.each,walk=tinymce.walk;tinymce.create('tinymce.ui.Menu:tinymce.ui.MenuItem',{Menu:function(id,s){var t=this;t.parent(id,s);t.items={};t.collapsed=false;t.menuCount=0;t.onAddItem=new tinymce.util.Dispatcher(this);},expand:function(d){var t=this;if(d){walk(t,function(o){if(o.expand)
o.expand();},'items',t);}
t.collapsed=false;},collapse:function(d){var t=this;if(d){walk(t,function(o){if(o.collapse)
o.collapse();},'items',t);}
t.collapsed=true;},isCollapsed:function(){return this.collapsed;},add:function(o){if(!o.settings)
o=new tinymce.ui.MenuItem(o.id||DOM.uniqueId(),o);this.onAddItem.dispatch(this,o);return this.items[o.id]=o;},addSeparator:function(){return this.add({separator:true});},addMenu:function(o){if(!o.collapse)
o=this.createMenu(o);this.menuCount++;return this.add(o);},hasMenus:function(){return this.menuCount!==0;},remove:function(o){delete this.items[o.id];},removeAll:function(){var t=this;walk(t,function(o){if(o.removeAll)
o.removeAll();else
o.remove();o.destroy();},'items',t);t.items={};},createMenu:function(o){var m=new tinymce.ui.Menu(o.id||DOM.uniqueId(),o);m.onAddItem.add(this.onAddItem.dispatch,this.onAddItem);return m;}});})(tinymce);(function(tinymce){var is=tinymce.is,DOM=tinymce.DOM,each=tinymce.each,Event=tinymce.dom.Event,Element=tinymce.dom.Element;tinymce.create('tinymce.ui.DropMenu:tinymce.ui.Menu',{DropMenu:function(id,s){s=s||{};s.container=s.container||DOM.doc.body;s.offset_x=s.offset_x||0;s.offset_y=s.offset_y||0;s.vp_offset_x=s.vp_offset_x||0;s.vp_offset_y=s.vp_offset_y||0;if(is(s.icons)&&!s.icons)
s['class']+=' mceNoIcons';this.parent(id,s);this.onShowMenu=new tinymce.util.Dispatcher(this);this.onHideMenu=new tinymce.util.Dispatcher(this);this.classPrefix='mceMenu';},createMenu:function(s){var t=this,cs=t.settings,m;s.container=s.container||cs.container;s.parent=t;s.constrain=s.constrain||cs.constrain;s['class']=s['class']||cs['class'];s.vp_offset_x=s.vp_offset_x||cs.vp_offset_x;s.vp_offset_y=s.vp_offset_y||cs.vp_offset_y;m=new tinymce.ui.DropMenu(s.id||DOM.uniqueId(),s);m.onAddItem.add(t.onAddItem.dispatch,t.onAddItem);return m;},update:function(){var t=this,s=t.settings,tb=DOM.get('menu_'+t.id+'_tbl'),co=DOM.get('menu_'+t.id+'_co'),tw,th;tw=s.max_width?Math.min(tb.clientWidth,s.max_width):tb.clientWidth;th=s.max_height?Math.min(tb.clientHeight,s.max_height):tb.clientHeight;if(!DOM.boxModel)
t.element.setStyles({width:tw+2,height:th+2});else
t.element.setStyles({width:tw,height:th});if(s.max_width)
DOM.setStyle(co,'width',tw);if(s.max_height){DOM.setStyle(co,'height',th);if(tb.clientHeight<s.max_height)
DOM.setStyle(co,'overflow','hidden');}},showMenu:function(x,y,px){var t=this,s=t.settings,co,vp=DOM.getViewPort(),w,h,mx,my,ot=2,dm,tb,cp=t.classPrefix;t.collapse(1);if(t.isMenuVisible)
return;if(!t.rendered){co=DOM.add(t.settings.container,t.renderNode());each(t.items,function(o){o.postRender();});t.element=new Element('menu_'+t.id,{blocker:1,container:s.container});}else
co=DOM.get('menu_'+t.id);if(!tinymce.isOpera)
DOM.setStyles(co,{left:-0xFFFF,top:-0xFFFF});DOM.show(co);t.update();x+=s.offset_x||0;y+=s.offset_y||0;vp.w-=4;vp.h-=4;if(s.constrain){w=co.clientWidth-ot;h=co.clientHeight-ot;mx=vp.x+vp.w;my=vp.y+vp.h;if((x+s.vp_offset_x+w)>mx)
x=px?px-w:Math.max(0,(mx-s.vp_offset_x)-w);if((y+s.vp_offset_y+h)>my)
y=Math.max(0,(my-s.vp_offset_y)-h);}
DOM.setStyles(co,{left:x,top:y});t.element.update();t.isMenuVisible=1;t.mouseClickFunc=Event.add(co,'click',function(e){var m;e=e.target;if(e&&(e=DOM.getParent(e,'tr'))&&!DOM.hasClass(e,cp+'ItemSub')){m=t.items[e.id];if(m.isDisabled())
return;dm=t;while(dm){if(dm.hideMenu)
dm.hideMenu();dm=dm.settings.parent;}
if(m.settings.onclick)
m.settings.onclick(e);return Event.cancel(e);}});if(t.hasMenus()){t.mouseOverFunc=Event.add(co,'mouseover',function(e){var m,r,mi;e=e.target;if(e&&(e=DOM.getParent(e,'tr'))){m=t.items[e.id];if(t.lastMenu)
t.lastMenu.collapse(1);if(m.isDisabled())
return;if(e&&DOM.hasClass(e,cp+'ItemSub')){r=DOM.getRect(e);m.showMenu((r.x+r.w-ot),r.y-ot,r.x);t.lastMenu=m;DOM.addClass(DOM.get(m.id).firstChild,cp+'ItemActive');}}});}
t.onShowMenu.dispatch(t);if(s.keyboard_focus){Event.add(co,'keydown',t._keyHandler,t);DOM.select('a','menu_'+t.id)[0].focus();t._focusIdx=0;}},hideMenu:function(c){var t=this,co=DOM.get('menu_'+t.id),e;if(!t.isMenuVisible)
return;Event.remove(co,'mouseover',t.mouseOverFunc);Event.remove(co,'click',t.mouseClickFunc);Event.remove(co,'keydown',t._keyHandler);DOM.hide(co);t.isMenuVisible=0;if(!c)
t.collapse(1);if(t.element)
t.element.hide();if(e=DOM.get(t.id))
DOM.removeClass(e.firstChild,t.classPrefix+'ItemActive');t.onHideMenu.dispatch(t);},add:function(o){var t=this,co;o=t.parent(o);if(t.isRendered&&(co=DOM.get('menu_'+t.id)))
t._add(DOM.select('tbody',co)[0],o);return o;},collapse:function(d){this.parent(d);this.hideMenu(1);},remove:function(o){DOM.remove(o.id);this.destroy();return this.parent(o);},destroy:function(){var t=this,co=DOM.get('menu_'+t.id);Event.remove(co,'mouseover',t.mouseOverFunc);Event.remove(co,'click',t.mouseClickFunc);if(t.element)
t.element.remove();DOM.remove(co);},renderNode:function(){var t=this,s=t.settings,n,tb,co,w;w=DOM.create('div',{id:'menu_'+t.id,'class':s['class'],'style':'position:absolute;left:0;top:0;z-index:200000'});co=DOM.add(w,'div',{id:'menu_'+t.id+'_co','class':t.classPrefix+(s['class']?' '+s['class']:'')});t.element=new Element('menu_'+t.id,{blocker:1,container:s.container});if(s.menu_line)
DOM.add(co,'span',{'class':t.classPrefix+'Line'});n=DOM.add(co,'table',{id:'menu_'+t.id+'_tbl',border:0,cellPadding:0,cellSpacing:0});tb=DOM.add(n,'tbody');each(t.items,function(o){t._add(tb,o);});t.rendered=true;return w;},_keyHandler:function(e){var t=this,kc=e.keyCode;function focus(d){var i=t._focusIdx+d,e=DOM.select('a','menu_'+t.id)[i];if(e){t._focusIdx=i;e.focus();}};switch(kc){case 38:focus(-1);return;case 40:focus(1);return;case 13:return;case 27:return this.hideMenu();}},_add:function(tb,o){var n,s=o.settings,a,ro,it,cp=this.classPrefix,ic;if(s.separator){ro=DOM.add(tb,'tr',{id:o.id,'class':cp+'ItemSeparator'});DOM.add(ro,'td',{'class':cp+'ItemSeparator'});if(n=ro.previousSibling)
DOM.addClass(n,'mceLast');return;}
n=ro=DOM.add(tb,'tr',{id:o.id,'class':cp+'Item '+cp+'ItemEnabled'});n=it=DOM.add(n,'td');n=a=DOM.add(n,'a',{href:'javascript:;',onclick:"return false;",onmousedown:'return false;'});DOM.addClass(it,s['class']);ic=DOM.add(n,'span',{'class':'mceIcon'+(s.icon?' mce_'+s.icon:'')});if(s.icon_src)
DOM.add(ic,'img',{src:s.icon_src});n=DOM.add(n,s.element||'span',{'class':'mceText',title:o.settings.title},o.settings.title);if(o.settings.style)
DOM.setAttrib(n,'style',o.settings.style);if(tb.childNodes.length==1)
DOM.addClass(ro,'mceFirst');if((n=ro.previousSibling)&&DOM.hasClass(n,cp+'ItemSeparator'))
DOM.addClass(ro,'mceFirst');if(o.collapse)
DOM.addClass(ro,cp+'ItemSub');if(n=ro.previousSibling)
DOM.removeClass(n,'mceLast');DOM.addClass(ro,'mceLast');}});})(tinymce);(function(tinymce){var DOM=tinymce.DOM;tinymce.create('tinymce.ui.Button:tinymce.ui.Control',{Button:function(id,s){this.parent(id,s);this.classPrefix='mceButton';},renderHTML:function(){var cp=this.classPrefix,s=this.settings,h,l;l=DOM.encode(s.label||'');h='<a id="'+this.id+'" href="javascript:;" class="'+cp+' '+cp+'Enabled '+s['class']+(l?' '+cp+'Labeled':'')+'" onmousedown="return false;" onclick="return false;" title="'+DOM.encode(s.title)+'">';if(s.image)
h+='<img class="mceIcon" src="'+s.image+'" />'+l+'</a>';else
h+='<span class="mceIcon '+s['class']+'"></span>'+(l?'<span class="'+cp+'Label">'+l+'</span>':'')+'</a>';return h;},postRender:function(){var t=this,s=t.settings;tinymce.dom.Event.add(t.id,'click',function(e){if(!t.isDisabled())
return s.onclick.call(s.scope,e);});}});})(tinymce);(function(tinymce){var DOM=tinymce.DOM,Event=tinymce.dom.Event,each=tinymce.each,Dispatcher=tinymce.util.Dispatcher;tinymce.create('tinymce.ui.ListBox:tinymce.ui.Control',{ListBox:function(id,s){var t=this;t.parent(id,s);t.items=[];t.onChange=new Dispatcher(t);t.onPostRender=new Dispatcher(t);t.onAdd=new Dispatcher(t);t.onRenderMenu=new tinymce.util.Dispatcher(this);t.classPrefix='mceListBox';},select:function(va){var t=this,fv,f;if(va==undefined)
return t.selectByIndex(-1);if(va&&va.call)
f=va;else{f=function(v){return v==va;};}
if(va!=t.selectedValue){each(t.items,function(o,i){if(f(o.value)){fv=1;t.selectByIndex(i);return false;}});if(!fv)
t.selectByIndex(-1);}},selectByIndex:function(idx){var t=this,e,o;if(idx!=t.selectedIndex){e=DOM.get(t.id+'_text');o=t.items[idx];if(o){t.selectedValue=o.value;t.selectedIndex=idx;DOM.setHTML(e,DOM.encode(o.title));DOM.removeClass(e,'mceTitle');}else{DOM.setHTML(e,DOM.encode(t.settings.title));DOM.addClass(e,'mceTitle');t.selectedValue=t.selectedIndex=null;}
e=0;}},add:function(n,v,o){var t=this;o=o||{};o=tinymce.extend(o,{title:n,value:v});t.items.push(o);t.onAdd.dispatch(t,o);},getLength:function(){return this.items.length;},renderHTML:function(){var h='',t=this,s=t.settings,cp=t.classPrefix;h='<table id="'+t.id+'" cellpadding="0" cellspacing="0" class="'+cp+' '+cp+'Enabled'+(s['class']?(' '+s['class']):'')+'"><tbody><tr>';h+='<td>'+DOM.createHTML('a',{id:t.id+'_text',href:'javascript:;','class':'mceText',onclick:"return false;",onmousedown:'return false;'},DOM.encode(t.settings.title))+'</td>';h+='<td>'+DOM.createHTML('a',{id:t.id+'_open',tabindex:-1,href:'javascript:;','class':'mceOpen',onclick:"return false;",onmousedown:'return false;'},'<span></span>')+'</td>';h+='</tr></tbody></table>';return h;},showMenu:function(){var t=this,p1,p2,e=DOM.get(this.id),m;if(t.isDisabled()||t.items.length==0)
return;if(t.menu&&t.menu.isMenuVisible)
return t.hideMenu();if(!t.isMenuRendered){t.renderMenu();t.isMenuRendered=true;}
p1=DOM.getPos(this.settings.menu_container);p2=DOM.getPos(e);m=t.menu;m.settings.offset_x=p2.x;m.settings.offset_y=p2.y;m.settings.keyboard_focus=!tinymce.isOpera;if(t.oldID)
m.items[t.oldID].setSelected(0);each(t.items,function(o){if(o.value===t.selectedValue){m.items[o.id].setSelected(1);t.oldID=o.id;}});m.showMenu(0,e.clientHeight);Event.add(DOM.doc,'mousedown',t.hideMenu,t);DOM.addClass(t.id,t.classPrefix+'Selected');},hideMenu:function(e){var t=this;if(t.menu&&t.menu.isMenuVisible){if(e&&e.type=="mousedown"&&(e.target.id==t.id+'_text'||e.target.id==t.id+'_open'))
return;if(!e||!DOM.getParent(e.target,'.mceMenu')){DOM.removeClass(t.id,t.classPrefix+'Selected');Event.remove(DOM.doc,'mousedown',t.hideMenu,t);t.menu.hideMenu();}}},renderMenu:function(){var t=this,m;m=t.settings.control_manager.createDropMenu(t.id+'_menu',{menu_line:1,'class':t.classPrefix+'Menu mceNoIcons',max_width:150,max_height:150});m.onHideMenu.add(t.hideMenu,t);m.add({title:t.settings.title,'class':'mceMenuItemTitle',onclick:function(){if(t.settings.onselect('')!==false)
t.select('');}});each(t.items,function(o){if(o.value===undefined){m.add({title:o.title,'class':'mceMenuItemTitle',onclick:function(){if(t.settings.onselect('')!==false)
t.select('');}});}else{o.id=DOM.uniqueId();o.onclick=function(){if(t.settings.onselect(o.value)!==false)
t.select(o.value);};m.add(o);}});t.onRenderMenu.dispatch(t,m);t.menu=m;},postRender:function(){var t=this,cp=t.classPrefix;Event.add(t.id,'click',t.showMenu,t);Event.add(t.id+'_text','focus',function(){if(!t._focused){t.keyDownHandler=Event.add(t.id+'_text','keydown',function(e){var idx=-1,v,kc=e.keyCode;each(t.items,function(v,i){if(t.selectedValue==v.value)
idx=i;});if(kc==38)
v=t.items[idx-1];else if(kc==40)
v=t.items[idx+1];else if(kc==13){v=t.selectedValue;t.selectedValue=null;t.settings.onselect(v);return Event.cancel(e);}
if(v){t.hideMenu();t.select(v.value);}});}
t._focused=1;});Event.add(t.id+'_text','blur',function(){Event.remove(t.id+'_text','keydown',t.keyDownHandler);t._focused=0;});if(tinymce.isIE6||!DOM.boxModel){Event.add(t.id,'mouseover',function(){if(!DOM.hasClass(t.id,cp+'Disabled'))
DOM.addClass(t.id,cp+'Hover');});Event.add(t.id,'mouseout',function(){if(!DOM.hasClass(t.id,cp+'Disabled'))
DOM.removeClass(t.id,cp+'Hover');});}
t.onPostRender.dispatch(t,DOM.get(t.id));},destroy:function(){this.parent();Event.clear(this.id+'_text');Event.clear(this.id+'_open');}});})(tinymce);(function(tinymce){var DOM=tinymce.DOM,Event=tinymce.dom.Event,each=tinymce.each,Dispatcher=tinymce.util.Dispatcher;tinymce.create('tinymce.ui.NativeListBox:tinymce.ui.ListBox',{NativeListBox:function(id,s){this.parent(id,s);this.classPrefix='mceNativeListBox';},setDisabled:function(s){DOM.get(this.id).disabled=s;},isDisabled:function(){return DOM.get(this.id).disabled;},select:function(va){var t=this,fv,f;if(va==undefined)
return t.selectByIndex(-1);if(va&&va.call)
f=va;else{f=function(v){return v==va;};}
if(va!=t.selectedValue){each(t.items,function(o,i){if(f(o.value)){fv=1;t.selectByIndex(i);return false;}});if(!fv)
t.selectByIndex(-1);}},selectByIndex:function(idx){DOM.get(this.id).selectedIndex=idx+1;this.selectedValue=this.items[idx]?this.items[idx].value:null;},add:function(n,v,a){var o,t=this;a=a||{};a.value=v;if(t.isRendered())
DOM.add(DOM.get(this.id),'option',a,n);o={title:n,value:v,attribs:a};t.items.push(o);t.onAdd.dispatch(t,o);},getLength:function(){return this.items.length;},renderHTML:function(){var h,t=this;h=DOM.createHTML('option',{value:''},'-- '+t.settings.title+' --');each(t.items,function(it){h+=DOM.createHTML('option',{value:it.value},it.title);});h=DOM.createHTML('select',{id:t.id,'class':'mceNativeListBox'},h);return h;},postRender:function(){var t=this,ch;t.rendered=true;function onChange(e){var v=t.items[e.target.selectedIndex-1];if(v&&(v=v.value)){t.onChange.dispatch(t,v);if(t.settings.onselect)
t.settings.onselect(v);}};Event.add(t.id,'change',onChange);Event.add(t.id,'keydown',function(e){var bf;Event.remove(t.id,'change',ch);bf=Event.add(t.id,'blur',function(){Event.add(t.id,'change',onChange);Event.remove(t.id,'blur',bf);});if(e.keyCode==13||e.keyCode==32){onChange(e);return Event.cancel(e);}});t.onPostRender.dispatch(t,DOM.get(t.id));}});})(tinymce);(function(tinymce){var DOM=tinymce.DOM,Event=tinymce.dom.Event,each=tinymce.each;tinymce.create('tinymce.ui.MenuButton:tinymce.ui.Button',{MenuButton:function(id,s){this.parent(id,s);this.onRenderMenu=new tinymce.util.Dispatcher(this);s.menu_container=s.menu_container||DOM.doc.body;},showMenu:function(){var t=this,p1,p2,e=DOM.get(t.id),m;if(t.isDisabled())
return;if(!t.isMenuRendered){t.renderMenu();t.isMenuRendered=true;}
if(t.isMenuVisible)
return t.hideMenu();p1=DOM.getPos(t.settings.menu_container);p2=DOM.getPos(e);m=t.menu;m.settings.offset_x=p2.x;m.settings.offset_y=p2.y;m.settings.vp_offset_x=p2.x;m.settings.vp_offset_y=p2.y;m.settings.keyboard_focus=t._focused;m.showMenu(0,e.clientHeight);Event.add(DOM.doc,'mousedown',t.hideMenu,t);t.setState('Selected',1);t.isMenuVisible=1;},renderMenu:function(){var t=this,m;m=t.settings.control_manager.createDropMenu(t.id+'_menu',{menu_line:1,'class':this.classPrefix+'Menu',icons:t.settings.icons});m.onHideMenu.add(t.hideMenu,t);t.onRenderMenu.dispatch(t,m);t.menu=m;},hideMenu:function(e){var t=this;if(e&&e.type=="mousedown"&&DOM.getParent(e.target,function(e){return e.id===t.id||e.id===t.id+'_open';}))
return;if(!e||!DOM.getParent(e.target,'.mceMenu')){t.setState('Selected',0);Event.remove(DOM.doc,'mousedown',t.hideMenu,t);if(t.menu)
t.menu.hideMenu();}
t.isMenuVisible=0;},postRender:function(){var t=this,s=t.settings;Event.add(t.id,'click',function(){if(!t.isDisabled()){if(s.onclick)
s.onclick(t.value);t.showMenu();}});}});})(tinymce);(function(tinymce){var DOM=tinymce.DOM,Event=tinymce.dom.Event,each=tinymce.each;tinymce.create('tinymce.ui.SplitButton:tinymce.ui.MenuButton',{SplitButton:function(id,s){this.parent(id,s);this.classPrefix='mceSplitButton';},renderHTML:function(){var h,t=this,s=t.settings,h1;h='<tbody><tr>';if(s.image)
h1=DOM.createHTML('img ',{src:s.image,'class':'mceAction '+s['class']});else
h1=DOM.createHTML('span',{'class':'mceAction '+s['class']},'');h+='<td>'+DOM.createHTML('a',{id:t.id+'_action',href:'javascript:;','class':'mceAction '+s['class'],onclick:"return false;",onmousedown:'return false;',title:s.title},h1)+'</td>';h1=DOM.createHTML('span',{'class':'mceOpen '+s['class']});h+='<td>'+DOM.createHTML('a',{id:t.id+'_open',href:'javascript:;','class':'mceOpen '+s['class'],onclick:"return false;",onmousedown:'return false;',title:s.title},h1)+'</td>';h+='</tr></tbody>';return DOM.createHTML('table',{id:t.id,'class':'mceSplitButton mceSplitButtonEnabled '+s['class'],cellpadding:'0',cellspacing:'0',onmousedown:'return false;',title:s.title},h);},postRender:function(){var t=this,s=t.settings;if(s.onclick){Event.add(t.id+'_action','click',function(){if(!t.isDisabled())
s.onclick(t.value);});}
Event.add(t.id+'_open','click',t.showMenu,t);Event.add(t.id+'_open','focus',function(){t._focused=1;});Event.add(t.id+'_open','blur',function(){t._focused=0;});if(tinymce.isIE6||!DOM.boxModel){Event.add(t.id,'mouseover',function(){if(!DOM.hasClass(t.id,'mceSplitButtonDisabled'))
DOM.addClass(t.id,'mceSplitButtonHover');});Event.add(t.id,'mouseout',function(){if(!DOM.hasClass(t.id,'mceSplitButtonDisabled'))
DOM.removeClass(t.id,'mceSplitButtonHover');});}},destroy:function(){this.parent();Event.clear(this.id+'_action');Event.clear(this.id+'_open');}});})(tinymce);(function(tinymce){var DOM=tinymce.DOM,Event=tinymce.dom.Event,is=tinymce.is,each=tinymce.each;tinymce.create('tinymce.ui.ColorSplitButton:tinymce.ui.SplitButton',{ColorSplitButton:function(id,s){var t=this;t.parent(id,s);t.settings=s=tinymce.extend({colors:'000000,993300,333300,003300,003366,000080,333399,333333,800000,FF6600,808000,008000,008080,0000FF,666699,808080,FF0000,FF9900,99CC00,339966,33CCCC,3366FF,800080,999999,FF00FF,FFCC00,FFFF00,00FF00,00FFFF,00CCFF,993366,C0C0C0,FF99CC,FFCC99,FFFF99,CCFFCC,CCFFFF,99CCFF,CC99FF,FFFFFF',grid_width:8,default_color:'#888888'},t.settings);t.onShowMenu=new tinymce.util.Dispatcher(t);t.onHideMenu=new tinymce.util.Dispatcher(t);t.value=s.default_color;},showMenu:function(){var t=this,r,p,e,p2;if(t.isDisabled())
return;if(!t.isMenuRendered){t.renderMenu();t.isMenuRendered=true;}
if(t.isMenuVisible)
return t.hideMenu();e=DOM.get(t.id);DOM.show(t.id+'_menu');DOM.addClass(e,'mceSplitButtonSelected');p2=DOM.getPos(e);DOM.setStyles(t.id+'_menu',{left:p2.x,top:p2.y+e.clientHeight,zIndex:200000});e=0;Event.add(DOM.doc,'mousedown',t.hideMenu,t);t.onShowMenu.dispatch(t);if(t._focused){t._keyHandler=Event.add(t.id+'_menu','keydown',function(e){if(e.keyCode==27)
t.hideMenu();});DOM.select('a',t.id+'_menu')[0].focus();}
t.isMenuVisible=1;},hideMenu:function(e){var t=this;if(e&&e.type=="mousedown"&&DOM.getParent(e.target,function(e){return e.id===t.id+'_open';}))
return;if(!e||!DOM.getParent(e.target,'.mceSplitButtonMenu')){DOM.removeClass(t.id,'mceSplitButtonSelected');Event.remove(DOM.doc,'mousedown',t.hideMenu,t);Event.remove(t.id+'_menu','keydown',t._keyHandler);DOM.hide(t.id+'_menu');}
t.onHideMenu.dispatch(t);t.isMenuVisible=0;},renderMenu:function(){var t=this,m,i=0,s=t.settings,n,tb,tr,w;w=DOM.add(s.menu_container,'div',{id:t.id+'_menu','class':s['menu_class']+' '+s['class'],style:'position:absolute;left:0;top:-1000px;'});m=DOM.add(w,'div',{'class':s['class']+' mceSplitButtonMenu'});DOM.add(m,'span',{'class':'mceMenuLine'});n=DOM.add(m,'table',{'class':'mceColorSplitMenu'});tb=DOM.add(n,'tbody');i=0;each(is(s.colors,'array')?s.colors:s.colors.split(','),function(c){c=c.replace(/^#/,'');if(!i--){tr=DOM.add(tb,'tr');i=s.grid_width-1;}
n=DOM.add(tr,'td');n=DOM.add(n,'a',{href:'javascript:;',style:{backgroundColor:'#'+c},_mce_color:'#'+c});});if(s.more_colors_func){n=DOM.add(tb,'tr');n=DOM.add(n,'td',{colspan:s.grid_width,'class':'mceMoreColors'});n=DOM.add(n,'a',{id:t.id+'_more',href:'javascript:;',onclick:'return false;','class':'mceMoreColors'},s.more_colors_title);Event.add(n,'click',function(e){s.more_colors_func.call(s.more_colors_scope||this);return Event.cancel(e);});}
DOM.addClass(m,'mceColorSplitMenu');Event.add(t.id+'_menu','click',function(e){var c;e=e.target;if(e.nodeName=='A'&&(c=e.getAttribute('_mce_color')))
t.setColor(c);return Event.cancel(e);});return w;},setColor:function(c){var t=this;DOM.setStyle(t.id+'_preview','backgroundColor',c);t.value=c;t.hideMenu();t.settings.onselect(c);},postRender:function(){var t=this,id=t.id;t.parent();DOM.add(id+'_action','div',{id:id+'_preview','class':'mceColorPreview'});DOM.setStyle(t.id+'_preview','backgroundColor',t.value);},destroy:function(){this.parent();Event.clear(this.id+'_menu');Event.clear(this.id+'_more');DOM.remove(this.id+'_menu');}});})(tinymce);tinymce.create('tinymce.ui.Toolbar:tinymce.ui.Container',{renderHTML:function(){var t=this,h='',c,co,dom=tinymce.DOM,s=t.settings,i,pr,nx,cl;cl=t.controls;for(i=0;i<cl.length;i++){co=cl[i];pr=cl[i-1];nx=cl[i+1];if(i===0){c='mceToolbarStart';if(co.Button)
c+=' mceToolbarStartButton';else if(co.SplitButton)
c+=' mceToolbarStartSplitButton';else if(co.ListBox)
c+=' mceToolbarStartListBox';h+=dom.createHTML('td',{'class':c},dom.createHTML('span',null,'<!-- IE -->'));}
if(pr&&co.ListBox){if(pr.Button||pr.SplitButton)
h+=dom.createHTML('td',{'class':'mceToolbarEnd'},dom.createHTML('span',null,'<!-- IE -->'));}
if(dom.stdMode)
h+='<td style="position: relative">'+co.renderHTML()+'</td>';else
h+='<td>'+co.renderHTML()+'</td>';if(nx&&co.ListBox){if(nx.Button||nx.SplitButton)
h+=dom.createHTML('td',{'class':'mceToolbarStart'},dom.createHTML('span',null,'<!-- IE -->'));}}
c='mceToolbarEnd';if(co.Button)
c+=' mceToolbarEndButton';else if(co.SplitButton)
c+=' mceToolbarEndSplitButton';else if(co.ListBox)
c+=' mceToolbarEndListBox';h+=dom.createHTML('td',{'class':c},dom.createHTML('span',null,'<!-- IE -->'));return dom.createHTML('table',{id:t.id,'class':'mceToolbar'+(s['class']?' '+s['class']:''),cellpadding:'0',cellspacing:'0',align:t.settings.align||''},'<tbody><tr>'+h+'</tr></tbody>');}});(function(tinymce){var Dispatcher=tinymce.util.Dispatcher,each=tinymce.each;tinymce.create('tinymce.AddOnManager',{AddOnManager:function(){var self=this;self.items=[];self.urls={};self.lookup={};self.onAdd=new Dispatcher(self);},get:function(n){return this.lookup[n];},requireLangPack:function(n){var s=tinymce.settings;if(s&&s.language)
tinymce.ScriptLoader.add(this.urls[n]+'/langs/'+s.language+'.js');},add:function(id,o){this.items.push(o);this.lookup[id]=o;this.onAdd.dispatch(this,id,o);return o;},load:function(n,u,cb,s){var t=this;if(t.urls[n])
return;if(u.indexOf('/')!=0&&u.indexOf('://')==-1)
u=tinymce.baseURL+'/'+u;t.urls[n]=u.substring(0,u.lastIndexOf('/'));if(!t.lookup[n])
tinymce.ScriptLoader.add(u,cb,s);}});tinymce.PluginManager=new tinymce.AddOnManager();tinymce.ThemeManager=new tinymce.AddOnManager();}(tinymce));(function(tinymce){var each=tinymce.each,extend=tinymce.extend,DOM=tinymce.DOM,Event=tinymce.dom.Event,ThemeManager=tinymce.ThemeManager,PluginManager=tinymce.PluginManager,explode=tinymce.explode,Dispatcher=tinymce.util.Dispatcher,undefined,instanceCounter=0;tinymce.documentBaseURL=window.location.href.replace(/[\?#].*$/,'').replace(/[\/\\][^\/]+$/,'');if(!/[\/\\]$/.test(tinymce.documentBaseURL))
tinymce.documentBaseURL+='/';tinymce.baseURL=new tinymce.util.URI(tinymce.documentBaseURL).toAbsolute(tinymce.baseURL);tinymce.baseURI=new tinymce.util.URI(tinymce.baseURL);tinymce.onBeforeUnload=new Dispatcher(tinymce);Event.add(window,'beforeunload',function(e){tinymce.onBeforeUnload.dispatch(tinymce,e);});tinymce.onAddEditor=new Dispatcher(tinymce);tinymce.onRemoveEditor=new Dispatcher(tinymce);tinymce.EditorManager=extend(tinymce,{editors:[],i18n:{},activeEditor:null,init:function(s){var t=this,pl,sl=tinymce.ScriptLoader,e,el=[],ed;function execCallback(se,n,s){var f=se[n];if(!f)
return;if(tinymce.is(f,'string')){s=f.replace(/\.\w+$/,'');s=s?tinymce.resolve(s):0;f=tinymce.resolve(f);}
return f.apply(s||this,Array.prototype.slice.call(arguments,2));};s=extend({theme:"simple",language:"en"},s);t.settings=s;Event.add(document,'init',function(){var l,co;execCallback(s,'onpageload');switch(s.mode){case"exact":l=s.elements||'';if(l.length>0){each(explode(l),function(v){if(DOM.get(v)){ed=new tinymce.Editor(v,s);el.push(ed);ed.render(1);}else{each(document.forms,function(f){each(f.elements,function(e){if(e.name===v){v='mce_editor_'+instanceCounter++;DOM.setAttrib(e,'id',v);ed=new tinymce.Editor(v,s);el.push(ed);ed.render(1);}});});}});}
break;case"textareas":case"specific_textareas":function hasClass(n,c){return c.constructor===RegExp?c.test(n.className):DOM.hasClass(n,c);};each(DOM.select('textarea'),function(v){if(s.editor_deselector&&hasClass(v,s.editor_deselector))
return;if(!s.editor_selector||hasClass(v,s.editor_selector)){e=DOM.get(v.name);if(!v.id&&!e)
v.id=v.name;if(!v.id||t.get(v.id))
v.id=DOM.uniqueId();ed=new tinymce.Editor(v.id,s);el.push(ed);ed.render(1);}});break;}
if(s.oninit){l=co=0;each(el,function(ed){co++;if(!ed.initialized){ed.onInit.add(function(){l++;if(l==co)
execCallback(s,'oninit');});}else
l++;if(l==co)
execCallback(s,'oninit');});}});},get:function(id){if(id===undefined)
return this.editors;return this.editors[id];},getInstanceById:function(id){return this.get(id);},add:function(editor){var self=this,editors=self.editors;editors[editor.id]=editor;editors.push(editor);self._setActive(editor);self.onAddEditor.dispatch(self,editor);return editor;},remove:function(editor){var t=this,i,editors=t.editors;if(!editors[editor.id])
return null;delete editors[editor.id];for(i=0;i<editors.length;i++){if(editors[i]==editor){editors.splice(i,1);break;}}
if(t.activeEditor==editor)
t._setActive(editors[0]);editor.destroy();t.onRemoveEditor.dispatch(t,editor);return editor;},execCommand:function(c,u,v){var t=this,ed=t.get(v),w;switch(c){case"mceFocus":ed.focus();return true;case"mceAddEditor":case"mceAddControl":if(!t.get(v))
new tinymce.Editor(v,t.settings).render();return true;case"mceAddFrameControl":w=v.window;w.tinyMCE=tinyMCE;w.tinymce=tinymce;tinymce.DOM.doc=w.document;tinymce.DOM.win=w;ed=new tinymce.Editor(v.element_id,v);ed.render();if(tinymce.isIE){function clr(){ed.destroy();w.detachEvent('onunload',clr);w=w.tinyMCE=w.tinymce=null;};w.attachEvent('onunload',clr);}
v.page_window=null;return true;case"mceRemoveEditor":case"mceRemoveControl":if(ed)
ed.remove();return true;case'mceToggleEditor':if(!ed){t.execCommand('mceAddControl',0,v);return true;}
if(ed.isHidden())
ed.show();else
ed.hide();return true;}
if(t.activeEditor)
return t.activeEditor.execCommand(c,u,v);return false;},execInstanceCommand:function(id,c,u,v){var ed=this.get(id);if(ed)
return ed.execCommand(c,u,v);return false;},triggerSave:function(){each(this.editors,function(e){e.save();});},addI18n:function(p,o){var lo,i18n=this.i18n;if(!tinymce.is(p,'string')){each(p,function(o,lc){each(o,function(o,g){each(o,function(o,k){if(g==='common')
i18n[lc+'.'+k]=o;else
i18n[lc+'.'+g+'.'+k]=o;});});});}else{each(o,function(o,k){i18n[p+'.'+k]=o;});}},_setActive:function(editor){this.selectedInstance=this.activeEditor=editor;}});})(tinymce);(function(tinymce){var DOM=tinymce.DOM,Event=tinymce.dom.Event,extend=tinymce.extend,Dispatcher=tinymce.util.Dispatcher,each=tinymce.each,isGecko=tinymce.isGecko,isIE=tinymce.isIE,isWebKit=tinymce.isWebKit,is=tinymce.is,ThemeManager=tinymce.ThemeManager,PluginManager=tinymce.PluginManager,inArray=tinymce.inArray,grep=tinymce.grep,explode=tinymce.explode;tinymce.create('tinymce.Editor',{Editor:function(id,s){var t=this;t.id=t.editorId=id;t.execCommands={};t.queryStateCommands={};t.queryValueCommands={};t.isNotDirty=false;t.plugins={};each(['onPreInit','onBeforeRenderUI','onPostRender','onInit','onRemove','onActivate','onDeactivate','onClick','onEvent','onMouseUp','onMouseDown','onDblClick','onKeyDown','onKeyUp','onKeyPress','onContextMenu','onSubmit','onReset','onPaste','onPreProcess','onPostProcess','onBeforeSetContent','onBeforeGetContent','onSetContent','onGetContent','onLoadContent','onSaveContent','onNodeChange','onChange','onBeforeExecCommand','onExecCommand','onUndo','onRedo','onVisualAid','onSetProgressState'],function(e){t[e]=new Dispatcher(t);});t.settings=s=extend({id:id,language:'en',docs_language:'en',theme:'simple',skin:'default',delta_width:0,delta_height:0,popup_css:'',plugins:'',document_base_url:tinymce.documentBaseURL,add_form_submit_trigger:1,submit_patch:1,add_unload_trigger:1,convert_urls:1,relative_urls:1,remove_script_host:1,table_inline_editing:0,object_resizing:1,cleanup:1,accessibility_focus:1,custom_shortcuts:1,custom_undo_redo_keyboard_shortcuts:1,custom_undo_redo_restore_selection:1,custom_undo_redo:1,doctype:tinymce.isIE6?'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">':'<!DOCTYPE>',visual_table_class:'mceItemTable',visual:1,font_size_style_values:'xx-small,x-small,small,medium,large,x-large,xx-large',apply_source_formatting:1,directionality:'ltr',forced_root_block:'p',valid_elements:'@[id|class|style|title|dir<ltr?rtl|lang|xml::lang|onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|onkeyup],a[rel|rev|charset|hreflang|tabindex|accesskey|type|name|href|target|title|class|onfocus|onblur],strong/b,em/i,strike,u,#p,-ol[type|compact],-ul[type|compact],-li,br,img[longdesc|usemap|src|border|alt=|title|hspace|vspace|width|height|align],-sub,-sup,-blockquote[cite],-table[border|cellspacing|cellpadding|width|frame|rules|height|align|summary|bgcolor|background|bordercolor],-tr[rowspan|width|height|align|valign|bgcolor|background|bordercolor],tbody,thead,tfoot,#td[colspan|rowspan|width|height|align|valign|bgcolor|background|bordercolor|scope],#th[colspan|rowspan|width|height|align|valign|scope],caption,-div,-span,-code,-pre,address,-h1,-h2,-h3,-h4,-h5,-h6,hr[size|noshade],-font[face|size|color],dd,dl,dt,cite,abbr,acronym,del[datetime|cite],ins[datetime|cite],object[classid|width|height|codebase|*],param[name|value],embed[type|width|height|src|*],script[src|type],map[name],area[shape|coords|href|alt|target],bdo,button,col[align|char|charoff|span|valign|width],colgroup[align|char|charoff|span|valign|width],dfn,fieldset,form[action|accept|accept-charset|enctype|method],input[accept|alt|checked|disabled|maxlength|name|readonly|size|src|type|value|tabindex|accesskey],kbd,label[for],legend,noscript,optgroup[label|disabled],option[disabled|label|selected|value],q[cite],samp,select[disabled|multiple|name|size],small,textarea[cols|rows|disabled|name|readonly],tt,var,big',extended_valid_elements:'iframe[*]',hidden_input:1,padd_empty_editor:1,render_ui:1,init_theme:1,force_p_newlines:1,indentation:'30px',keep_styles:1,fix_table_elements:1,inline_styles:1,convert_fonts_to_spans:true},s);t.documentBaseURI=new tinymce.util.URI(s.document_base_url||tinymce.documentBaseURL,{base_uri:tinyMCE.baseURI});t.baseURI=tinymce.baseURI;t.execCallback('setup',t);},render:function(nst){var t=this,s=t.settings,id=t.id,sl=tinymce.ScriptLoader;if(!Event.domLoaded){Event.add(document,'init',function(){t.render();});return;}
tinyMCE.settings=s;if(!t.getElement())
return;if(tinymce.isIDevice)
return;if(!/TEXTAREA|INPUT/i.test(t.getElement().nodeName)&&s.hidden_input&&DOM.getParent(id,'form'))
DOM.insertAfter(DOM.create('input',{type:'hidden',name:id}),id);if(tinymce.WindowManager)
t.windowManager=new tinymce.WindowManager(t);if(s.encoding=='xml'){t.onGetContent.add(function(ed,o){if(o.save)
o.content=DOM.encode(o.content);});}
if(s.add_form_submit_trigger){t.onSubmit.addToTop(function(){if(t.initialized){t.save();t.isNotDirty=1;}});}
if(s.add_unload_trigger){t._beforeUnload=tinyMCE.onBeforeUnload.add(function(){if(t.initialized&&!t.destroyed&&!t.isHidden())
t.save({format:'raw',no_events:true});});}
tinymce.addUnload(t.destroy,t);if(s.submit_patch){t.onBeforeRenderUI.add(function(){var n=t.getElement().form;if(!n)
return;if(n._mceOldSubmit)
return;if(!n.submit.nodeType&&!n.submit.length){t.formElement=n;n._mceOldSubmit=n.submit;n.submit=function(){tinymce.triggerSave();t.isNotDirty=1;return t.formElement._mceOldSubmit(t.formElement);};}
n=null;});}
function loadScripts(){if(s.language)
sl.add(tinymce.baseURL+'/langs/'+s.language+'.js');if(s.theme&&s.theme.charAt(0)!='-'&&!ThemeManager.urls[s.theme])
ThemeManager.load(s.theme,'themes/'+s.theme+'/editor_template'+tinymce.suffix+'.js');each(explode(s.plugins),function(p){if(p&&p.charAt(0)!='-'&&!PluginManager.urls[p]){if(p=='safari')
return;PluginManager.load(p,'plugins/'+p+'/editor_plugin'+tinymce.suffix+'.js');}});sl.loadQueue(function(){if(!t.removed)
t.init();});};loadScripts();},init:function(){var n,t=this,s=t.settings,w,h,e=t.getElement(),o,ti,u,bi,bc,re;tinymce.add(t);if(s.theme){s.theme=s.theme.replace(/-/,'');o=ThemeManager.get(s.theme);t.theme=new o();if(t.theme.init&&s.init_theme)
t.theme.init(t,ThemeManager.urls[s.theme]||tinymce.documentBaseURL.replace(/\/$/,''));}
each(explode(s.plugins.replace(/\-/g,'')),function(p){var c=PluginManager.get(p),u=PluginManager.urls[p]||tinymce.documentBaseURL.replace(/\/$/,''),po;if(c){po=new c(t,u);t.plugins[p]=po;if(po.init)
po.init(t,u);}});if(s.popup_css!==false){if(s.popup_css)
s.popup_css=t.documentBaseURI.toAbsolute(s.popup_css);else
s.popup_css=t.baseURI.toAbsolute("themes/"+s.theme+"/skins/"+s.skin+"/dialog.css");}
if(s.popup_css_add)
s.popup_css+=','+t.documentBaseURI.toAbsolute(s.popup_css_add);t.controlManager=new tinymce.ControlManager(t);if(s.custom_undo_redo){t.onBeforeExecCommand.add(function(ed,cmd,ui,val,a){if(cmd!='Undo'&&cmd!='Redo'&&cmd!='mceRepaint'&&(!a||!a.skip_undo)){if(!t.undoManager.hasUndo())
t.undoManager.add();}});t.onExecCommand.add(function(ed,cmd,ui,val,a){if(cmd!='Undo'&&cmd!='Redo'&&cmd!='mceRepaint'&&(!a||!a.skip_undo))
t.undoManager.add();});}
t.onExecCommand.add(function(ed,c){if(!/^(FontName|FontSize)$/.test(c))
t.nodeChanged();});if(isGecko){function repaint(a,o){if(!o||!o.initial)
t.execCommand('mceRepaint');};t.onUndo.add(repaint);t.onRedo.add(repaint);t.onSetContent.add(repaint);}
t.onBeforeRenderUI.dispatch(t,t.controlManager);if(s.render_ui){w=s.width||e.style.width||e.offsetWidth;h=s.height||e.style.height||e.offsetHeight;t.orgDisplay=e.style.display;re=/^[0-9\.]+(|px)$/i;if(re.test(''+w))
w=Math.max(parseInt(w)+(o.deltaWidth||0),100);if(re.test(''+h))
h=Math.max(parseInt(h)+(o.deltaHeight||0),100);o=t.theme.renderUI({targetNode:e,width:w,height:h,deltaWidth:s.delta_width,deltaHeight:s.delta_height});t.editorContainer=o.editorContainer;}
if(document.domain&&location.hostname!=document.domain)
tinymce.relaxedDomain=document.domain;DOM.setStyles(o.sizeContainer||o.editorContainer,{width:w,height:h});h=(o.iframeHeight||h)+(typeof(h)=='number'?(o.deltaHeight||0):'');if(h<100)
h=100;t.iframeHTML=s.doctype+'<html><head xmlns="http://www.w3.org/1999/xhtml">';if(s.document_base_url!=tinymce.documentBaseURL)
t.iframeHTML+='<base href="'+t.documentBaseURI.getURI()+'" />';t.iframeHTML+='<meta http-equiv="X-UA-Compatible" content="IE=7" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';if(tinymce.relaxedDomain)
t.iframeHTML+='<script type="text/javascript">document.domain = "'+tinymce.relaxedDomain+'";</script>';bi=s.body_id||'tinymce';if(bi.indexOf('=')!=-1){bi=t.getParam('body_id','','hash');bi=bi[t.id]||bi;}
bc=s.body_class||'';if(bc.indexOf('=')!=-1){bc=t.getParam('body_class','','hash');bc=bc[t.id]||'';}
t.iframeHTML+='</head><body id="'+bi+'" class="mceContentBody '+bc+'"></body></html>';if(tinymce.relaxedDomain){if(isIE||(tinymce.isOpera&&parseFloat(opera.version())>=9.5))
u='javascript:(function(){document.open();document.domain="'+document.domain+'";var ed = window.parent.tinyMCE.get("'+t.id+'");document.write(ed.iframeHTML);document.close();ed.setupIframe();})()';else if(tinymce.isOpera)
u='javascript:(function(){document.open();document.domain="'+document.domain+'";document.close();ed.setupIframe();})()';}
n=DOM.add(o.iframeContainer,'iframe',{id:t.id+"_ifr",src:u||'javascript:""',frameBorder:'0',style:{width:'100%',height:h}});t.contentAreaContainer=o.iframeContainer;DOM.get(o.editorContainer).style.display=t.orgDisplay;DOM.get(t.id).style.display='none';if(!isIE||!tinymce.relaxedDomain)
t.setupIframe();e=n=o=null;},setupIframe:function(){var t=this,s=t.settings,e=DOM.get(t.id),d=t.getDoc(),h,b;if(!isIE||!tinymce.relaxedDomain){d.open();d.write(t.iframeHTML);d.close();}
if(!isIE){try{if(!s.readonly)
d.designMode='On';}catch(ex){}}
if(isIE){b=t.getBody();DOM.hide(b);if(!s.readonly)
b.contentEditable=true;DOM.show(b);}
t.dom=new tinymce.dom.DOMUtils(t.getDoc(),{keep_values:true,url_converter:t.convertURL,url_converter_scope:t,hex_colors:s.force_hex_style_colors,class_filter:s.class_filter,update_styles:1,fix_ie_paragraphs:1,valid_styles:s.valid_styles});t.schema=new tinymce.dom.Schema();t.serializer=new tinymce.dom.Serializer(extend(s,{valid_elements:s.verify_html===false?'*[*]':s.valid_elements,dom:t.dom,schema:t.schema}));t.selection=new tinymce.dom.Selection(t.dom,t.getWin(),t.serializer);t.formatter=new tinymce.Formatter(this);t.formatter.register({alignleft:[{selector:'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',styles:{textAlign:'left'}},{selector:'img,table',styles:{'float':'left'}}],aligncenter:[{selector:'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',styles:{textAlign:'center'}},{selector:'img',styles:{display:'block',marginLeft:'auto',marginRight:'auto'}},{selector:'table',styles:{marginLeft:'auto',marginRight:'auto'}}],alignright:[{selector:'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',styles:{textAlign:'right'}},{selector:'img,table',styles:{'float':'right'}}],alignfull:[{selector:'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',styles:{textAlign:'justify'}}],bold:[{inline:'strong'},{inline:'span',styles:{fontWeight:'bold'}},{inline:'b'}],italic:[{inline:'em'},{inline:'span',styles:{fontStyle:'italic'}},{inline:'i'}],underline:[{inline:'span',styles:{textDecoration:'underline'},exact:true},{inline:'u'}],strikethrough:[{inline:'span',styles:{textDecoration:'line-through'},exact:true},{inline:'u'}],forecolor:{inline:'span',styles:{color:'%value'}},hilitecolor:{inline:'span',styles:{backgroundColor:'%value'}},fontname:{inline:'span',styles:{fontFamily:'%value'}},fontsize:{inline:'span',styles:{fontSize:'%value'}},fontsize_class:{inline:'span',attributes:{'class':'%value'}},blockquote:{block:'blockquote',wrapper:1,remove:'all'},removeformat:[{selector:'b,strong,em,i,font,u,strike',remove:'all',split:true,expand:false,block_expand:true,deep:true},{selector:'span',attributes:['style','class'],remove:'empty',split:true,expand:false,deep:true},{selector:'*',attributes:['style','class'],split:false,expand:false,deep:true}]});each('p h1 h2 h3 h4 h5 h6 div address pre div code dt dd samp'.split(/\s/),function(name){t.formatter.register(name,{block:name,remove:'all'});});t.formatter.register(t.settings.formats);t.undoManager=new tinymce.UndoManager(t);t.undoManager.onAdd.add(function(um,l){if(!l.initial)
return t.onChange.dispatch(t,l,um);});t.undoManager.onUndo.add(function(um,l){return t.onUndo.dispatch(t,l,um);});t.undoManager.onRedo.add(function(um,l){return t.onRedo.dispatch(t,l,um);});t.forceBlocks=new tinymce.ForceBlocks(t,{forced_root_block:s.forced_root_block});t.editorCommands=new tinymce.EditorCommands(t);t.serializer.onPreProcess.add(function(se,o){return t.onPreProcess.dispatch(t,o,se);});t.serializer.onPostProcess.add(function(se,o){return t.onPostProcess.dispatch(t,o,se);});t.onPreInit.dispatch(t);if(!s.gecko_spellcheck)
t.getBody().spellcheck=0;if(!s.readonly)
t._addEvents();t.controlManager.onPostRender.dispatch(t,t.controlManager);t.onPostRender.dispatch(t);if(s.directionality)
t.getBody().dir=s.directionality;if(s.nowrap)
t.getBody().style.whiteSpace="nowrap";if(s.custom_elements){function handleCustom(ed,o){each(explode(s.custom_elements),function(v){var n;if(v.indexOf('~')===0){v=v.substring(1);n='span';}else
n='div';o.content=o.content.replace(new RegExp('<('+v+')([^>]*)>','g'),'<'+n+' _mce_name="$1"$2>');o.content=o.content.replace(new RegExp('</('+v+')>','g'),'</'+n+'>');});};t.onBeforeSetContent.add(handleCustom);t.onPostProcess.add(function(ed,o){if(o.set)
handleCustom(ed,o);});}
if(s.handle_node_change_callback){t.onNodeChange.add(function(ed,cm,n){t.execCallback('handle_node_change_callback',t.id,n,-1,-1,true,t.selection.isCollapsed());});}
if(s.save_callback){t.onSaveContent.add(function(ed,o){var h=t.execCallback('save_callback',t.id,o.content,t.getBody());if(h)
o.content=h;});}
if(s.onchange_callback){t.onChange.add(function(ed,l){t.execCallback('onchange_callback',t,l);});}
if(s.convert_newlines_to_brs){t.onBeforeSetContent.add(function(ed,o){if(o.initial)
o.content=o.content.replace(/\r?\n/g,'<br />');});}
if(s.fix_nesting&&isIE){t.onBeforeSetContent.add(function(ed,o){o.content=t._fixNesting(o.content);});}
if(s.preformatted){t.onPostProcess.add(function(ed,o){o.content=o.content.replace(/^\s*<pre.*?>/,'');o.content=o.content.replace(/<\/pre>\s*$/,'');if(o.set)
o.content='<pre class="mceItemHidden">'+o.content+'</pre>';});}
if(s.verify_css_classes){t.serializer.attribValueFilter=function(n,v){var s,cl;if(n=='class'){if(!t.classesRE){cl=t.dom.getClasses();if(cl.length>0){s='';each(cl,function(o){s+=(s?'|':'')+o['class'];});t.classesRE=new RegExp('('+s+')','gi');}}
return!t.classesRE||/(\bmceItem\w+\b|\bmceTemp\w+\b)/g.test(v)||t.classesRE.test(v)?v:'';}
return v;};}
if(s.cleanup_callback){t.onBeforeSetContent.add(function(ed,o){o.content=t.execCallback('cleanup_callback','insert_to_editor',o.content,o);});t.onPreProcess.add(function(ed,o){if(o.set)
t.execCallback('cleanup_callback','insert_to_editor_dom',o.node,o);if(o.get)
t.execCallback('cleanup_callback','get_from_editor_dom',o.node,o);});t.onPostProcess.add(function(ed,o){if(o.set)
o.content=t.execCallback('cleanup_callback','insert_to_editor',o.content,o);if(o.get)
o.content=t.execCallback('cleanup_callback','get_from_editor',o.content,o);});}
if(s.save_callback){t.onGetContent.add(function(ed,o){if(o.save)
o.content=t.execCallback('save_callback',t.id,o.content,t.getBody());});}
if(s.handle_event_callback){t.onEvent.add(function(ed,e,o){if(t.execCallback('handle_event_callback',e,ed,o)===false)
Event.cancel(e);});}
t.onSetContent.add(function(){t.addVisual(t.getBody());});if(s.padd_empty_editor){t.onPostProcess.add(function(ed,o){o.content=o.content.replace(/^(<p[^>]*>(&nbsp;|&#160;|\s|\u00a0|)<\/p>[\r\n]*|<br \/>[\r\n]*)$/,'');});}
if(isGecko){function fixLinks(ed,o){each(ed.dom.select('a'),function(n){var pn=n.parentNode;if(ed.dom.isBlock(pn)&&pn.lastChild===n)
ed.dom.add(pn,'br',{'_mce_bogus':1});});};t.onExecCommand.add(function(ed,cmd){if(cmd==='CreateLink')
fixLinks(ed);});t.onSetContent.add(t.selection.onSetContent.add(fixLinks));if(!s.readonly){try{d.designMode='Off';d.designMode='On';}catch(ex){}}}
setTimeout(function(){if(t.removed)
return;t.load({initial:true,format:(s.cleanup_on_startup?'html':'raw')});t.startContent=t.getContent({format:'raw'});t.initialized=true;t.onInit.dispatch(t);t.execCallback('setupcontent_callback',t.id,t.getBody(),t.getDoc());t.execCallback('init_instance_callback',t);t.focus(true);t.nodeChanged({initial:1});if(s.content_css){tinymce.each(explode(s.content_css),function(u){t.dom.loadCSS(t.documentBaseURI.toAbsolute(u));});}
if(s.auto_focus){setTimeout(function(){var ed=tinymce.get(s.auto_focus);ed.selection.select(ed.getBody(),1);ed.selection.collapse(1);ed.getWin().focus();},100);}},1);e=null;},focus:function(sf){var oed,t=this,ce=t.settings.content_editable,ieRng,controlElm,doc=t.getDoc();if(!sf){ieRng=t.selection.getRng();if(ieRng.item){controlElm=ieRng.item(0);}
if(!ce)
t.getWin().focus();if(controlElm&&controlElm.ownerDocument==doc){ieRng=doc.body.createControlRange();ieRng.addElement(controlElm);ieRng.select();}}
if(tinymce.activeEditor!=t){if((oed=tinymce.activeEditor)!=null)
oed.onDeactivate.dispatch(oed,t);t.onActivate.dispatch(t,oed);}
tinymce._setActive(t);},execCallback:function(n){var t=this,f=t.settings[n],s;if(!f)
return;if(t.callbackLookup&&(s=t.callbackLookup[n])){f=s.func;s=s.scope;}
if(is(f,'string')){s=f.replace(/\.\w+$/,'');s=s?tinymce.resolve(s):0;f=tinymce.resolve(f);t.callbackLookup=t.callbackLookup||{};t.callbackLookup[n]={func:f,scope:s};}
return f.apply(s||t,Array.prototype.slice.call(arguments,1));},translate:function(s){var c=this.settings.language||'en',i18n=tinymce.i18n;if(!s)
return'';return i18n[c+'.'+s]||s.replace(/{\#([^}]+)\}/g,function(a,b){return i18n[c+'.'+b]||'{#'+b+'}';});},getLang:function(n,dv){return tinymce.i18n[(this.settings.language||'en')+'.'+n]||(is(dv)?dv:'{#'+n+'}');},getParam:function(n,dv,ty){var tr=tinymce.trim,v=is(this.settings[n])?this.settings[n]:dv,o;if(ty==='hash'){o={};if(is(v,'string')){each(v.indexOf('=')>0?v.split(/[;,](?![^=;,]*(?:[;,]|$))/):v.split(','),function(v){v=v.split('=');if(v.length>1)
o[tr(v[0])]=tr(v[1]);else
o[tr(v[0])]=tr(v);});}else
o=v;return o;}
return v;},nodeChanged:function(o){var t=this,s=t.selection,n=(isIE?s.getNode():s.getStart())||t.getBody();if(t.initialized){o=o||{};n=isIE&&n.ownerDocument!=t.getDoc()?t.getBody():n;o.parents=[];t.dom.getParent(n,function(node){if(node.nodeName=='BODY')
return true;o.parents.push(node);});t.onNodeChange.dispatch(t,o?o.controlManager||t.controlManager:t.controlManager,n,s.isCollapsed(),o);}},addButton:function(n,s){var t=this;t.buttons=t.buttons||{};t.buttons[n]=s;},addCommand:function(n,f,s){this.execCommands[n]={func:f,scope:s||this};},addQueryStateHandler:function(n,f,s){this.queryStateCommands[n]={func:f,scope:s||this};},addQueryValueHandler:function(n,f,s){this.queryValueCommands[n]={func:f,scope:s||this};},addShortcut:function(pa,desc,cmd_func,sc){var t=this,c;if(!t.settings.custom_shortcuts)
return false;t.shortcuts=t.shortcuts||{};if(is(cmd_func,'string')){c=cmd_func;cmd_func=function(){t.execCommand(c,false,null);};}
if(is(cmd_func,'object')){c=cmd_func;cmd_func=function(){t.execCommand(c[0],c[1],c[2]);};}
each(explode(pa),function(pa){var o={func:cmd_func,scope:sc||this,desc:desc,alt:false,ctrl:false,shift:false};each(explode(pa,'+'),function(v){switch(v){case'alt':case'ctrl':case'shift':o[v]=true;break;default:o.charCode=v.charCodeAt(0);o.keyCode=v.toUpperCase().charCodeAt(0);}});t.shortcuts[(o.ctrl?'ctrl':'')+','+(o.alt?'alt':'')+','+(o.shift?'shift':'')+','+o.keyCode]=o;});return true;},execCommand:function(cmd,ui,val,a){var t=this,s=0,o,st;if(!/^(mceAddUndoLevel|mceEndUndoLevel|mceBeginUndoLevel|mceRepaint|SelectAll)$/.test(cmd)&&(!a||!a.skip_focus))
t.focus();o={};t.onBeforeExecCommand.dispatch(t,cmd,ui,val,o);if(o.terminate)
return false;if(t.execCallback('execcommand_callback',t.id,t.selection.getNode(),cmd,ui,val)){t.onExecCommand.dispatch(t,cmd,ui,val,a);return true;}
if(o=t.execCommands[cmd]){st=o.func.call(o.scope,ui,val);if(st!==true){t.onExecCommand.dispatch(t,cmd,ui,val,a);return st;}}
each(t.plugins,function(p){if(p.execCommand&&p.execCommand(cmd,ui,val)){t.onExecCommand.dispatch(t,cmd,ui,val,a);s=1;return false;}});if(s)
return true;if(t.theme&&t.theme.execCommand&&t.theme.execCommand(cmd,ui,val)){t.onExecCommand.dispatch(t,cmd,ui,val,a);return true;}
if(tinymce.GlobalCommands.execCommand(t,cmd,ui,val)){t.onExecCommand.dispatch(t,cmd,ui,val,a);return true;}
if(t.editorCommands.execCommand(cmd,ui,val)){t.onExecCommand.dispatch(t,cmd,ui,val,a);return true;}
t.getDoc().execCommand(cmd,ui,val);t.onExecCommand.dispatch(t,cmd,ui,val,a);},queryCommandState:function(cmd){var t=this,o,s;if(t._isHidden())
return;if(o=t.queryStateCommands[cmd]){s=o.func.call(o.scope);if(s!==true)
return s;}
o=t.editorCommands.queryCommandState(cmd);if(o!==-1)
return o;try{return this.getDoc().queryCommandState(cmd);}catch(ex){}},queryCommandValue:function(c){var t=this,o,s;if(t._isHidden())
return;if(o=t.queryValueCommands[c]){s=o.func.call(o.scope);if(s!==true)
return s;}
o=t.editorCommands.queryCommandValue(c);if(is(o))
return o;try{return this.getDoc().queryCommandValue(c);}catch(ex){}},show:function(){var t=this;DOM.show(t.getContainer());DOM.hide(t.id);t.load();},hide:function(){var t=this,d=t.getDoc();if(isIE&&d)
d.execCommand('SelectAll');t.save();DOM.hide(t.getContainer());DOM.setStyle(t.id,'display',t.orgDisplay);},isHidden:function(){return!DOM.isHidden(this.id);},setProgressState:function(b,ti,o){this.onSetProgressState.dispatch(this,b,ti,o);return b;},load:function(o){var t=this,e=t.getElement(),h;if(e){o=o||{};o.load=true;h=t.setContent(is(e.value)?e.value:e.innerHTML,o);o.element=e;if(!o.no_events)
t.onLoadContent.dispatch(t,o);o.element=e=null;return h;}},save:function(o){var t=this,e=t.getElement(),h,f;if(!e||!t.initialized)
return;o=o||{};o.save=true;if(!o.no_events){t.undoManager.typing=0;t.undoManager.add();}
o.element=e;h=o.content=t.getContent(o);if(!o.no_events)
t.onSaveContent.dispatch(t,o);h=o.content;if(!/TEXTAREA|INPUT/i.test(e.nodeName)){e.innerHTML=h;if(f=DOM.getParent(t.id,'form')){each(f.elements,function(e){if(e.name==t.id){e.value=h;return false;}});}}else
e.value=h;o.element=e=null;return h;},setContent:function(h,o){var t=this;o=o||{};o.format=o.format||'html';o.set=true;o.content=h;if(!o.no_events)
t.onBeforeSetContent.dispatch(t,o);if(!tinymce.isIE&&(h.length===0||/^\s+$/.test(h))){o.content=t.dom.setHTML(t.getBody(),'<br _mce_bogus="1" />');o.format='raw';}
o.content=t.dom.setHTML(t.getBody(),tinymce.trim(o.content));if(o.format!='raw'&&t.settings.cleanup){o.getInner=true;o.content=t.dom.setHTML(t.getBody(),t.serializer.serialize(t.getBody(),o));}
if(!o.no_events)
t.onSetContent.dispatch(t,o);return o.content;},getContent:function(o){var t=this,h;o=o||{};o.format=o.format||'html';o.get=true;if(!o.no_events)
t.onBeforeGetContent.dispatch(t,o);if(o.format!='raw'&&t.settings.cleanup){o.getInner=true;h=t.serializer.serialize(t.getBody(),o);}else
h=t.getBody().innerHTML;h=h.replace(/^\s*|\s*$/g,'');o.content=h;if(!o.no_events)
t.onGetContent.dispatch(t,o);return o.content;},isDirty:function(){var t=this;return tinymce.trim(t.startContent)!=tinymce.trim(t.getContent({format:'raw',no_events:1}))&&!t.isNotDirty;},getContainer:function(){var t=this;if(!t.container)
t.container=DOM.get(t.editorContainer||t.id+'_parent');return t.container;},getContentAreaContainer:function(){return this.contentAreaContainer;},getElement:function(){return DOM.get(this.settings.content_element||this.id);},getWin:function(){var t=this,e;if(!t.contentWindow){e=DOM.get(t.id+"_ifr");if(e)
t.contentWindow=e.contentWindow;}
return t.contentWindow;},getDoc:function(){var t=this,w;if(!t.contentDocument){w=t.getWin();if(w)
t.contentDocument=w.document;}
return t.contentDocument;},getBody:function(){return this.bodyElement||this.getDoc().body;},convertURL:function(u,n,e){var t=this,s=t.settings;if(s.urlconverter_callback)
return t.execCallback('urlconverter_callback',u,e,true,n);if(!s.convert_urls||(e&&e.nodeName=='LINK')||u.indexOf('file:')===0)
return u;if(s.relative_urls)
return t.documentBaseURI.toRelative(u);u=t.documentBaseURI.toAbsolute(u,s.remove_script_host);return u;},addVisual:function(e){var t=this,s=t.settings;e=e||t.getBody();if(!is(t.hasVisual))
t.hasVisual=s.visual;each(t.dom.select('table,a',e),function(e){var v;switch(e.nodeName){case'TABLE':v=t.dom.getAttrib(e,'border');if(!v||v=='0'){if(t.hasVisual)
t.dom.addClass(e,s.visual_table_class);else
t.dom.removeClass(e,s.visual_table_class);}
return;case'A':v=t.dom.getAttrib(e,'name');if(v){if(t.hasVisual)
t.dom.addClass(e,'mceItemAnchor');else
t.dom.removeClass(e,'mceItemAnchor');}
return;}});t.onVisualAid.dispatch(t,e,t.hasVisual);},remove:function(){var t=this,e=t.getContainer();t.removed=1;t.hide();t.execCallback('remove_instance_callback',t);t.onRemove.dispatch(t);t.onExecCommand.listeners=[];tinymce.remove(t);DOM.remove(e);},destroy:function(s){var t=this;if(t.destroyed)
return;if(!s){tinymce.removeUnload(t.destroy);tinyMCE.onBeforeUnload.remove(t._beforeUnload);if(t.theme&&t.theme.destroy)
t.theme.destroy();t.controlManager.destroy();t.selection.destroy();t.dom.destroy();if(!t.settings.content_editable){Event.clear(t.getWin());Event.clear(t.getDoc());}
Event.clear(t.getBody());Event.clear(t.formElement);}
if(t.formElement){t.formElement.submit=t.formElement._mceOldSubmit;t.formElement._mceOldSubmit=null;}
t.contentAreaContainer=t.formElement=t.container=t.settings.content_element=t.bodyElement=t.contentDocument=t.contentWindow=null;if(t.selection)
t.selection=t.selection.win=t.selection.dom=t.selection.dom.doc=null;t.destroyed=1;},_addEvents:function(){var t=this,i,s=t.settings,lo={mouseup:'onMouseUp',mousedown:'onMouseDown',click:'onClick',keyup:'onKeyUp',keydown:'onKeyDown',keypress:'onKeyPress',submit:'onSubmit',reset:'onReset',contextmenu:'onContextMenu',dblclick:'onDblClick',paste:'onPaste'};function eventHandler(e,o){var ty=e.type;if(t.removed)
return;if(t.onEvent.dispatch(t,e,o)!==false){t[lo[e.fakeType||e.type]].dispatch(t,e,o);}};each(lo,function(v,k){switch(k){case'contextmenu':if(tinymce.isOpera){t.dom.bind(t.getBody(),'mousedown',function(e){if(e.ctrlKey){e.fakeType='contextmenu';eventHandler(e);}});}else
t.dom.bind(t.getBody(),k,eventHandler);break;case'paste':t.dom.bind(t.getBody(),k,function(e){eventHandler(e);});break;case'submit':case'reset':t.dom.bind(t.getElement().form||DOM.getParent(t.id,'form'),k,eventHandler);break;default:t.dom.bind(s.content_editable?t.getBody():t.getDoc(),k,eventHandler);}});t.dom.bind(s.content_editable?t.getBody():(isGecko?t.getDoc():t.getWin()),'focus',function(e){t.focus(true);});if(tinymce.isGecko){t.dom.bind(t.getDoc(),'DOMNodeInserted',function(e){var v;e=e.target;if(e.nodeType===1&&e.nodeName==='IMG'&&(v=e.getAttribute('_mce_src')))
e.src=t.documentBaseURI.toAbsolute(v);});}
if(isGecko){function setOpts(){var t=this,d=t.getDoc(),s=t.settings;if(isGecko&&!s.readonly){if(t._isHidden()){try{if(!s.content_editable)
d.designMode='On';}catch(ex){}}
try{d.execCommand("styleWithCSS",0,false);}catch(ex){if(!t._isHidden())
try{d.execCommand("useCSS",0,true);}catch(ex){}}
if(!s.table_inline_editing)
try{d.execCommand('enableInlineTableEditing',false,false);}catch(ex){}
if(!s.object_resizing)
try{d.execCommand('enableObjectResizing',false,false);}catch(ex){}}};t.onBeforeExecCommand.add(setOpts);t.onMouseDown.add(setOpts);}
if(tinymce.isWebKit){t.onClick.add(function(ed,e){e=e.target;if(e.nodeName=='IMG'||(e.nodeName=='A'&&t.dom.hasClass(e,'mceItemAnchor')))
t.selection.getSel().setBaseAndExtent(e,0,e,1);});}
t.onMouseUp.add(t.nodeChanged);t.onKeyUp.add(function(ed,e){var c=e.keyCode;if((c>=33&&c<=36)||(c>=37&&c<=40)||c==13||c==45||c==46||c==8||(tinymce.isMac&&(c==91||c==93))||e.ctrlKey)
t.nodeChanged();});t.onReset.add(function(){t.setContent(t.startContent,{format:'raw'});});if(s.custom_shortcuts){if(s.custom_undo_redo_keyboard_shortcuts){t.addShortcut('ctrl+z',t.getLang('undo_desc'),'Undo');t.addShortcut('ctrl+y',t.getLang('redo_desc'),'Redo');}
t.addShortcut('ctrl+b',t.getLang('bold_desc'),'Bold');t.addShortcut('ctrl+i',t.getLang('italic_desc'),'Italic');t.addShortcut('ctrl+u',t.getLang('underline_desc'),'Underline');for(i=1;i<=6;i++)
t.addShortcut('ctrl+'+i,'',['FormatBlock',false,'h'+i]);t.addShortcut('ctrl+7','',['FormatBlock',false,'<p>']);t.addShortcut('ctrl+8','',['FormatBlock',false,'<div>']);t.addShortcut('ctrl+9','',['FormatBlock',false,'<address>']);function find(e){var v=null;if(!e.altKey&&!e.ctrlKey&&!e.metaKey)
return v;each(t.shortcuts,function(o){if(tinymce.isMac&&o.ctrl!=e.metaKey)
return;else if(!tinymce.isMac&&o.ctrl!=e.ctrlKey)
return;if(o.alt!=e.altKey)
return;if(o.shift!=e.shiftKey)
return;if(e.keyCode==o.keyCode||(e.charCode&&e.charCode==o.charCode)){v=o;return false;}});return v;};t.onKeyUp.add(function(ed,e){var o=find(e);if(o)
return Event.cancel(e);});t.onKeyPress.add(function(ed,e){var o=find(e);if(o)
return Event.cancel(e);});t.onKeyDown.add(function(ed,e){var o=find(e);if(o){o.func.call(o.scope);return Event.cancel(e);}});}
if(tinymce.isIE){t.dom.bind(t.getDoc(),'controlselect',function(e){var re=t.resizeInfo,cb;e=e.target;if(e.nodeName!=='IMG')
return;if(re)
t.dom.unbind(re.node,re.ev,re.cb);if(!t.dom.hasClass(e,'mceItemNoResize')){ev='resizeend';cb=t.dom.bind(e,ev,function(e){var v;e=e.target;if(v=t.dom.getStyle(e,'width')){t.dom.setAttrib(e,'width',v.replace(/[^0-9%]+/g,''));t.dom.setStyle(e,'width','');}
if(v=t.dom.getStyle(e,'height')){t.dom.setAttrib(e,'height',v.replace(/[^0-9%]+/g,''));t.dom.setStyle(e,'height','');}});}else{ev='resizestart';cb=t.dom.bind(e,'resizestart',Event.cancel,Event);}
re=t.resizeInfo={node:e,ev:ev,cb:cb};});t.onKeyDown.add(function(ed,e){switch(e.keyCode){case 8:if(t.selection.getRng().item){ed.dom.remove(t.selection.getRng().item(0));return Event.cancel(e);}}});}
if(tinymce.isOpera){t.onClick.add(function(ed,e){Event.prevent(e);});}
if(s.custom_undo_redo){function addUndo(){t.undoManager.typing=0;t.undoManager.add();};t.dom.bind(t.getDoc(),'focusout',function(e){if(!t.removed&&t.undoManager.typing)
addUndo();});t.onKeyUp.add(function(ed,e){if((e.keyCode>=33&&e.keyCode<=36)||(e.keyCode>=37&&e.keyCode<=40)||e.keyCode==13||e.keyCode==45||e.ctrlKey)
addUndo();});t.onKeyDown.add(function(ed,e){var rng,parent,bookmark;if(isIE&&e.keyCode==46){rng=t.selection.getRng();if(rng.parentElement){parent=rng.parentElement();if(e.ctrlKey){rng.moveEnd('word',1);rng.select();}
t.selection.getSel().clear();if(rng.parentElement()==parent){bookmark=t.selection.getBookmark();try{parent.innerHTML=parent.innerHTML;}catch(ex){}
t.selection.moveToBookmark(bookmark);}
e.preventDefault();return;}}
if((e.keyCode>=33&&e.keyCode<=36)||(e.keyCode>=37&&e.keyCode<=40)||e.keyCode==13||e.keyCode==45){if(t.undoManager.typing)
addUndo();return;}
if(!t.undoManager.typing){t.undoManager.add();t.undoManager.typing=1;}});t.onMouseDown.add(function(){if(t.undoManager.typing)
addUndo();});}},_isHidden:function(){var s;if(!isGecko)
return 0;s=this.selection.getSel();return(!s||!s.rangeCount||s.rangeCount==0);},_fixNesting:function(s){var d=[],i;s=s.replace(/<(\/)?([^\s>]+)[^>]*?>/g,function(a,b,c){var e;if(b==='/'){if(!d.length)
return'';if(c!==d[d.length-1].tag){for(i=d.length-1;i>=0;i--){if(d[i].tag===c){d[i].close=1;break;}}
return'';}else{d.pop();if(d.length&&d[d.length-1].close){a=a+'</'+d[d.length-1].tag+'>';d.pop();}}}else{if(/^(br|hr|input|meta|img|link|param)$/i.test(c))
return a;if(/\/>$/.test(a))
return a;d.push({tag:c});}
return a;});for(i=d.length-1;i>=0;i--)
s+='</'+d[i].tag+'>';return s;}});})(tinymce);(function(tinymce){var each=tinymce.each,undefined,TRUE=true,FALSE=false;tinymce.EditorCommands=function(editor){var dom=editor.dom,selection=editor.selection,commands={state:{},exec:{},value:{}},settings=editor.settings,bookmark;function execCommand(command,ui,value){var func;command=command.toLowerCase();if(func=commands.exec[command]){func(command,ui,value);return TRUE;}
return FALSE;};function queryCommandState(command){var func;command=command.toLowerCase();if(func=commands.state[command])
return func(command);return-1;};function queryCommandValue(command){var func;command=command.toLowerCase();if(func=commands.value[command])
return func(command);return FALSE;};function addCommands(command_list,type){type=type||'exec';each(command_list,function(callback,command){each(command.toLowerCase().split(','),function(command){commands[type][command]=callback;});});};tinymce.extend(this,{execCommand:execCommand,queryCommandState:queryCommandState,queryCommandValue:queryCommandValue,addCommands:addCommands});function execNativeCommand(command,ui,value){if(ui===undefined)
ui=FALSE;if(value===undefined)
value=null;return editor.getDoc().execCommand(command,ui,value);};function isFormatMatch(name){return editor.formatter.match(name);};function toggleFormat(name,value){editor.formatter.toggle(name,value?{value:value}:undefined);};function storeSelection(type){bookmark=selection.getBookmark(type);};function restoreSelection(){selection.moveToBookmark(bookmark);};addCommands({'mceResetDesignMode,mceBeginUndoLevel':function(){},'mceEndUndoLevel,mceAddUndoLevel':function(){editor.undoManager.add();},'Cut,Copy,Paste':function(command){var doc=editor.getDoc(),failed;try{execNativeCommand(command);}catch(ex){failed=TRUE;}
if(failed||!doc.queryCommandSupported(command)){if(tinymce.isGecko){editor.windowManager.confirm(editor.getLang('clipboard_msg'),function(state){if(state)
open('http://www.mozilla.org/editor/midasdemo/securityprefs.html','_blank');});}else
editor.windowManager.alert(editor.getLang('clipboard_no_support'));}},unlink:function(command){if(selection.isCollapsed())
selection.select(selection.getNode());execNativeCommand(command);selection.collapse(FALSE);},'JustifyLeft,JustifyCenter,JustifyRight,JustifyFull':function(command){var align=command.substring(7);each('left,center,right,full'.split(','),function(name){if(align!=name)
editor.formatter.remove('align'+name);});toggleFormat('align'+align);},'InsertUnorderedList,InsertOrderedList':function(command){var listElm,listParent;execNativeCommand(command);listElm=dom.getParent(selection.getNode(),'ol,ul');if(listElm){listParent=listElm.parentNode;if(/^(H[1-6]|P|ADDRESS|PRE)$/.test(listParent.nodeName)){storeSelection();dom.split(listParent,listElm);restoreSelection();}}},'Bold,Italic,Underline,Strikethrough':function(command){toggleFormat(command);},'ForeColor,HiliteColor,FontName':function(command,ui,value){toggleFormat(command,value);},FontSize:function(command,ui,value){var fontClasses,fontSizes;if(value>=1&&value<=7){fontSizes=tinymce.explode(settings.font_size_style_values);fontClasses=tinymce.explode(settings.font_size_classes);if(fontClasses)
value=fontClasses[value-1]||value;else
value=fontSizes[value-1]||value;}
toggleFormat(command,value);},RemoveFormat:function(command){editor.formatter.remove(command);},mceBlockQuote:function(command){toggleFormat('blockquote');},FormatBlock:function(command,ui,value){return toggleFormat(value||'p');},mceCleanup:function(){var bookmark=selection.getBookmark();editor.setContent(editor.getContent({cleanup:TRUE}),{cleanup:TRUE});selection.moveToBookmark(bookmark);},mceRemoveNode:function(command,ui,value){var node=value||selection.getNode();if(node!=editor.getBody()){storeSelection();editor.dom.remove(node,TRUE);restoreSelection();}},mceSelectNodeDepth:function(command,ui,value){var counter=0;dom.getParent(selection.getNode(),function(node){if(node.nodeType==1&&counter++==value){selection.select(node);return FALSE;}},editor.getBody());},mceSelectNode:function(command,ui,value){selection.select(value);},mceInsertContent:function(command,ui,value){selection.setContent(value);},mceInsertRawHTML:function(command,ui,value){selection.setContent('tiny_mce_marker');editor.setContent(editor.getContent().replace(/tiny_mce_marker/g,function(){return value}));},mceSetContent:function(command,ui,value){editor.setContent(value);},'Indent,Outdent':function(command){var intentValue,indentUnit,value;intentValue=settings.indentation;indentUnit=/[a-z%]+$/i.exec(intentValue);intentValue=parseInt(intentValue);if(!queryCommandState('InsertUnorderedList')&&!queryCommandState('InsertOrderedList')){each(selection.getSelectedBlocks(),function(element){if(command=='outdent'){value=Math.max(0,parseInt(element.style.paddingLeft||0)-intentValue);dom.setStyle(element,'paddingLeft',value?value+indentUnit:'');}else
dom.setStyle(element,'paddingLeft',(parseInt(element.style.paddingLeft||0)+intentValue)+indentUnit);});}else
execNativeCommand(command);},mceRepaint:function(){var bookmark;if(tinymce.isGecko){try{storeSelection(TRUE);if(selection.getSel())
selection.getSel().selectAllChildren(editor.getBody());selection.collapse(TRUE);restoreSelection();}catch(ex){}}},mceToggleFormat:function(command,ui,value){editor.formatter.toggle(value);},InsertHorizontalRule:function(){selection.setContent('<hr />');},mceToggleVisualAid:function(){editor.hasVisual=!editor.hasVisual;editor.addVisual();},mceReplaceContent:function(command,ui,value){selection.setContent(value.replace(/\{\$selection\}/g,selection.getContent({format:'text'})));},mceInsertLink:function(command,ui,value){var link=dom.getParent(selection.getNode(),'a');if(tinymce.is(value,'string'))
value={href:value};if(!link){execNativeCommand('CreateLink',FALSE,'javascript:mctmp(0);');each(dom.select('a[href=javascript:mctmp(0);]'),function(link){dom.setAttribs(link,value);});}else{if(value.href)
dom.setAttribs(link,value);else
editor.dom.remove(link,TRUE);}},selectAll:function(){var root=dom.getRoot(),rng=dom.createRng();rng.setStart(root,0);rng.setEnd(root,root.childNodes.length);editor.selection.setRng(rng);}});addCommands({'JustifyLeft,JustifyCenter,JustifyRight,JustifyFull':function(command){return isFormatMatch('align'+command.substring(7));},'Bold,Italic,Underline,Strikethrough':function(command){return isFormatMatch(command);},mceBlockQuote:function(){return isFormatMatch('blockquote');},Outdent:function(){var node;if(settings.inline_styles){if((node=dom.getParent(selection.getStart(),dom.isBlock))&&parseInt(node.style.paddingLeft)>0)
return TRUE;if((node=dom.getParent(selection.getEnd(),dom.isBlock))&&parseInt(node.style.paddingLeft)>0)
return TRUE;}
return queryCommandState('InsertUnorderedList')||queryCommandState('InsertOrderedList')||(!settings.inline_styles&&!!dom.getParent(selection.getNode(),'BLOCKQUOTE'));},'InsertUnorderedList,InsertOrderedList':function(command){return dom.getParent(selection.getNode(),command=='insertunorderedlist'?'UL':'OL');}},'state');addCommands({'FontSize,FontName':function(command){var value=0,parent;if(parent=dom.getParent(selection.getNode(),'span')){if(command=='fontsize')
value=parent.style.fontSize;else
value=parent.style.fontFamily.replace(/, /g,',').replace(/[\'\"]/g,'').toLowerCase();}
return value;}},'value');if(settings.custom_undo_redo){addCommands({Undo:function(){editor.undoManager.undo();},Redo:function(){editor.undoManager.redo();}});}};})(tinymce);(function(tinymce){var Dispatcher=tinymce.util.Dispatcher;tinymce.UndoManager=function(editor){var self,index=0,data=[];function getContent(){return tinymce.trim(editor.getContent({format:'raw',no_events:1}));};return self={typing:0,onAdd:new Dispatcher(self),onUndo:new Dispatcher(self),onRedo:new Dispatcher(self),add:function(level){var i,settings=editor.settings,lastLevel;level=level||{};level.content=getContent();lastLevel=data[index];if(lastLevel&&lastLevel.content==level.content){if(index>0||data.length==1)
return null;}
if(settings.custom_undo_redo_levels){if(data.length>settings.custom_undo_redo_levels){for(i=0;i<data.length-1;i++)
data[i]=data[i+1];data.length--;index=data.length;}}
level.bookmark=editor.selection.getBookmark(2,true);if(index<data.length-1){if(index==0)
data=[];else
data.length=index+1;}
data.push(level);index=data.length-1;self.onAdd.dispatch(self,level);editor.isNotDirty=0;return level;},undo:function(){var level,i;if(self.typing){self.add();self.typing=0;}
if(index>0){level=data[--index];editor.setContent(level.content,{format:'raw'});editor.selection.moveToBookmark(level.bookmark);self.onUndo.dispatch(self,level);}
return level;},redo:function(){var level;if(index<data.length-1){level=data[++index];editor.setContent(level.content,{format:'raw'});editor.selection.moveToBookmark(level.bookmark);self.onRedo.dispatch(self,level);}
return level;},clear:function(){data=[];index=self.typing=0;},hasUndo:function(){return index>0||self.typing;},hasRedo:function(){return index<data.length-1;}};};})(tinymce);(function(tinymce){var Event=tinymce.dom.Event,isIE=tinymce.isIE,isGecko=tinymce.isGecko,isOpera=tinymce.isOpera,each=tinymce.each,extend=tinymce.extend,TRUE=true,FALSE=false;function cloneFormats(node){var clone,temp,inner;do{if(/^(SPAN|STRONG|B|EM|I|FONT|STRIKE|U)$/.test(node.nodeName)){if(clone){temp=node.cloneNode(false);temp.appendChild(clone);clone=temp;}else{clone=inner=node.cloneNode(false);}
clone.removeAttribute('id');}}while(node=node.parentNode);if(clone)
return{wrapper:clone,inner:inner};};function isAtEnd(rng,par){var rng2=par.ownerDocument.createRange();rng2.setStart(rng.endContainer,rng.endOffset);rng2.setEndAfter(par);return rng2.cloneContents().textContent.length==0;};function isEmpty(n){n=n.innerHTML;n=n.replace(/<(img|hr|table|input|select|textarea)[ \>]/gi,'-');n=n.replace(/<[^>]+>/g,'');return n.replace(/[ \u00a0\t\r\n]+/g,'')=='';};function splitList(selection,dom,li){var listBlock,block;if(isEmpty(li)){listBlock=dom.getParent(li,'ul,ol');if(!dom.getParent(listBlock.parentNode,'ul,ol')){dom.split(listBlock,li);block=dom.create('p',0,'<br _mce_bogus="1" />');dom.replace(block,li);selection.select(block,1);}
return FALSE;}
return TRUE;};tinymce.create('tinymce.ForceBlocks',{ForceBlocks:function(ed){var t=this,s=ed.settings,elm;t.editor=ed;t.dom=ed.dom;elm=(s.forced_root_block||'p').toLowerCase();s.element=elm.toUpperCase();ed.onPreInit.add(t.setup,t);t.reOpera=new RegExp('(\\u00a0|&#160;|&nbsp;)<\/'+elm+'>','gi');t.rePadd=new RegExp('<p( )([^>]+)><\\\/p>|<p( )([^>]+)\\\/>|<p( )([^>]+)>\\s+<\\\/p>|<p><\\\/p>|<p\\\/>|<p>\\s+<\\\/p>'.replace(/p/g,elm),'gi');t.reNbsp2BR1=new RegExp('<p( )([^>]+)>[\\s\\u00a0]+<\\\/p>|<p>[\\s\\u00a0]+<\\\/p>'.replace(/p/g,elm),'gi');t.reNbsp2BR2=new RegExp('<%p()([^>]+)>(&nbsp;|&#160;)<\\\/%p>|<%p>(&nbsp;|&#160;)<\\\/%p>'.replace(/%p/g,elm),'gi');t.reBR2Nbsp=new RegExp('<p( )([^>]+)>\\s*<br \\\/>\\s*<\\\/p>|<p>\\s*<br \\\/>\\s*<\\\/p>'.replace(/p/g,elm),'gi');function padd(ed,o){if(isOpera)
o.content=o.content.replace(t.reOpera,'</'+elm+'>');o.content=o.content.replace(t.rePadd,'<'+elm+'$1$2$3$4$5$6>\u00a0</'+elm+'>');if(!isIE&&!isOpera&&o.set){o.content=o.content.replace(t.reNbsp2BR1,'<'+elm+'$1$2><br /></'+elm+'>');o.content=o.content.replace(t.reNbsp2BR2,'<'+elm+'$1$2><br /></'+elm+'>');}else
o.content=o.content.replace(t.reBR2Nbsp,'<'+elm+'$1$2>\u00a0</'+elm+'>');};ed.onBeforeSetContent.add(padd);ed.onPostProcess.add(padd);if(s.forced_root_block){ed.onInit.add(t.forceRoots,t);ed.onSetContent.add(t.forceRoots,t);ed.onBeforeGetContent.add(t.forceRoots,t);}},setup:function(){var t=this,ed=t.editor,s=ed.settings,dom=ed.dom,selection=ed.selection;if(s.forced_root_block){ed.onBeforeExecCommand.add(t.forceRoots,t);ed.onKeyUp.add(t.forceRoots,t);ed.onPreProcess.add(t.forceRoots,t);}
if(s.force_br_newlines){if(isIE){ed.onKeyPress.add(function(ed,e){var n;if(e.keyCode==13&&selection.getNode().nodeName!='LI'){selection.setContent('<br id="__" /> ',{format:'raw'});n=dom.get('__');n.removeAttribute('id');selection.select(n);selection.collapse();return Event.cancel(e);}});}}
if(s.force_p_newlines){if(!isIE){ed.onKeyPress.add(function(ed,e){if(e.keyCode==13&&!e.shiftKey&&!t.insertPara(e))
Event.cancel(e);});}else{tinymce.addUnload(function(){t._previousFormats=0;});ed.onKeyPress.add(function(ed,e){t._previousFormats=0;if(e.keyCode==13&&!e.shiftKey&&ed.selection.isCollapsed()&&s.keep_styles)
t._previousFormats=cloneFormats(ed.selection.getStart());});ed.onKeyUp.add(function(ed,e){if(e.keyCode==13&&!e.shiftKey){var parent=ed.selection.getStart(),fmt=t._previousFormats;if(!parent.hasChildNodes()&&fmt){parent=dom.getParent(parent,dom.isBlock);if(parent&&parent.nodeName!='LI'){parent.innerHTML='';if(t._previousFormats){parent.appendChild(fmt.wrapper);fmt.inner.innerHTML='\uFEFF';}else
parent.innerHTML='\uFEFF';selection.select(parent,1);ed.getDoc().execCommand('Delete',false,null);t._previousFormats=0;}}}});}
if(isGecko){ed.onKeyDown.add(function(ed,e){if((e.keyCode==8||e.keyCode==46)&&!e.shiftKey)
t.backspaceDelete(e,e.keyCode==8);});}}
if(tinymce.isWebKit){function insertBr(ed){var rng=selection.getRng(),br,div=dom.create('div',null,' '),divYPos,vpHeight=dom.getViewPort(ed.getWin()).h;rng.insertNode(br=dom.create('br'));rng.setStartAfter(br);rng.setEndAfter(br);selection.setRng(rng);if(selection.getSel().focusNode==br.previousSibling){selection.select(dom.insertAfter(dom.doc.createTextNode('\u00a0'),br));selection.collapse(TRUE);}
dom.insertAfter(div,br);divYPos=dom.getPos(div).y;dom.remove(div);if(divYPos>vpHeight)
ed.getWin().scrollTo(0,divYPos);};ed.onKeyPress.add(function(ed,e){if(e.keyCode==13&&(e.shiftKey||(s.force_br_newlines&&!dom.getParent(selection.getNode(),'h1,h2,h3,h4,h5,h6,ol,ul')))){insertBr(ed);Event.cancel(e);}});}
ed.onPreProcess.add(function(ed,o){each(dom.select('p,h1,h2,h3,h4,h5,h6,div',o.node),function(p){if(isEmpty(p)){each(dom.select('span,em,strong,b,i',o.node),function(n){if(!n.hasChildNodes()){n.appendChild(ed.getDoc().createTextNode('\u00a0'));return FALSE;}});}});});if(isIE){if(s.element!='P'){ed.onKeyPress.add(function(ed,e){t.lastElm=selection.getNode().nodeName;});ed.onKeyUp.add(function(ed,e){var bl,n=selection.getNode(),b=ed.getBody();if(b.childNodes.length===1&&n.nodeName=='P'){n=dom.rename(n,s.element);selection.select(n);selection.collapse();ed.nodeChanged();}else if(e.keyCode==13&&!e.shiftKey&&t.lastElm!='P'){bl=dom.getParent(n,'p');if(bl){dom.rename(bl,s.element);ed.nodeChanged();}}});}}},find:function(n,t,s){var ed=this.editor,w=ed.getDoc().createTreeWalker(n,4,null,FALSE),c=-1;while(n=w.nextNode()){c++;if(t==0&&n==s)
return c;if(t==1&&c==s)
return n;}
return-1;},forceRoots:function(ed,e){var t=this,ed=t.editor,b=ed.getBody(),d=ed.getDoc(),se=ed.selection,s=se.getSel(),r=se.getRng(),si=-2,ei,so,eo,tr,c=-0xFFFFFF;var nx,bl,bp,sp,le,nl=b.childNodes,i,n,eid;for(i=nl.length-1;i>=0;i--){nx=nl[i];if(nx.nodeType===1&&nx.getAttribute('_mce_type')){bl=null;continue;}
if(nx.nodeType===3||(!t.dom.isBlock(nx)&&nx.nodeType!==8&&!/^(script|mce:script|style|mce:style)$/i.test(nx.nodeName))){if(!bl){if(nx.nodeType!=3||/[^\s]/g.test(nx.nodeValue)){if(si==-2&&r){if(!isIE){if(r.startContainer.nodeType==1&&(n=r.startContainer.childNodes[r.startOffset])&&n.nodeType==1){eid=n.getAttribute("id");n.setAttribute("id","__mce");}else{if(ed.dom.getParent(r.startContainer,function(e){return e===b;})){so=r.startOffset;eo=r.endOffset;si=t.find(b,0,r.startContainer);ei=t.find(b,0,r.endContainer);}}}else{if(r.item){tr=d.body.createTextRange();tr.moveToElementText(r.item(0));r=tr;}
tr=d.body.createTextRange();tr.moveToElementText(b);tr.collapse(1);bp=tr.move('character',c)*-1;tr=r.duplicate();tr.collapse(1);sp=tr.move('character',c)*-1;tr=r.duplicate();tr.collapse(0);le=(tr.move('character',c)*-1)-sp;si=sp-bp;ei=le;}}
bl=ed.dom.create(ed.settings.forced_root_block);nx.parentNode.replaceChild(bl,nx);bl.appendChild(nx);}}else{if(bl.hasChildNodes())
bl.insertBefore(nx,bl.firstChild);else
bl.appendChild(nx);}}else
bl=null;}
if(si!=-2){if(!isIE){bl=b.getElementsByTagName(ed.settings.element)[0];r=d.createRange();if(si!=-1)
r.setStart(t.find(b,1,si),so);else
r.setStart(bl,0);if(ei!=-1)
r.setEnd(t.find(b,1,ei),eo);else
r.setEnd(bl,0);if(s){s.removeAllRanges();s.addRange(r);}}else{try{r=s.createRange();r.moveToElementText(b);r.collapse(1);r.moveStart('character',si);r.moveEnd('character',ei);r.select();}catch(ex){}}}else if(!isIE&&(n=ed.dom.get('__mce'))){if(eid)
n.setAttribute('id',eid);else
n.removeAttribute('id');r=d.createRange();r.setStartBefore(n);r.setEndBefore(n);se.setRng(r);}},getParentBlock:function(n){var d=this.dom;return d.getParent(n,d.isBlock);},insertPara:function(e){var t=this,ed=t.editor,dom=ed.dom,d=ed.getDoc(),se=ed.settings,s=ed.selection.getSel(),r=s.getRangeAt(0),b=d.body;var rb,ra,dir,sn,so,en,eo,sb,eb,bn,bef,aft,sc,ec,n,vp=dom.getViewPort(ed.getWin()),y,ch,car;rb=d.createRange();rb.setStart(s.anchorNode,s.anchorOffset);rb.collapse(TRUE);ra=d.createRange();ra.setStart(s.focusNode,s.focusOffset);ra.collapse(TRUE);dir=rb.compareBoundaryPoints(rb.START_TO_END,ra)<0;sn=dir?s.anchorNode:s.focusNode;so=dir?s.anchorOffset:s.focusOffset;en=dir?s.focusNode:s.anchorNode;eo=dir?s.focusOffset:s.anchorOffset;if(sn===en&&/^(TD|TH)$/.test(sn.nodeName)){if(sn.firstChild.nodeName=='BR')
dom.remove(sn.firstChild);if(sn.childNodes.length==0){ed.dom.add(sn,se.element,null,'<br />');aft=ed.dom.add(sn,se.element,null,'<br />');}else{n=sn.innerHTML;sn.innerHTML='';ed.dom.add(sn,se.element,null,n);aft=ed.dom.add(sn,se.element,null,'<br />');}
r=d.createRange();r.selectNodeContents(aft);r.collapse(1);ed.selection.setRng(r);return FALSE;}
if(sn==b&&en==b&&b.firstChild&&ed.dom.isBlock(b.firstChild)){sn=en=sn.firstChild;so=eo=0;rb=d.createRange();rb.setStart(sn,0);ra=d.createRange();ra.setStart(en,0);}
sn=sn.nodeName=="HTML"?d.body:sn;sn=sn.nodeName=="BODY"?sn.firstChild:sn;en=en.nodeName=="HTML"?d.body:en;en=en.nodeName=="BODY"?en.firstChild:en;sb=t.getParentBlock(sn);eb=t.getParentBlock(en);bn=sb?sb.nodeName:se.element;if(n=t.dom.getParent(sb,'li,pre')){if(n.nodeName=='LI')
return splitList(ed.selection,t.dom,n);return TRUE;}
if(sb&&(sb.nodeName=='CAPTION'||/absolute|relative|fixed/gi.test(dom.getStyle(sb,'position',1)))){bn=se.element;sb=null;}
if(eb&&(eb.nodeName=='CAPTION'||/absolute|relative|fixed/gi.test(dom.getStyle(sb,'position',1)))){bn=se.element;eb=null;}
if(/(TD|TABLE|TH|CAPTION)/.test(bn)||(sb&&bn=="DIV"&&/left|right/gi.test(dom.getStyle(sb,'float',1)))){bn=se.element;sb=eb=null;}
bef=(sb&&sb.nodeName==bn)?sb.cloneNode(0):ed.dom.create(bn);aft=(eb&&eb.nodeName==bn)?eb.cloneNode(0):ed.dom.create(bn);aft.removeAttribute('id');if(/^(H[1-6])$/.test(bn)&&isAtEnd(r,sb))
aft=ed.dom.create(se.element);n=sc=sn;do{if(n==b||n.nodeType==9||t.dom.isBlock(n)||/(TD|TABLE|TH|CAPTION)/.test(n.nodeName))
break;sc=n;}while((n=n.previousSibling?n.previousSibling:n.parentNode));n=ec=en;do{if(n==b||n.nodeType==9||t.dom.isBlock(n)||/(TD|TABLE|TH|CAPTION)/.test(n.nodeName))
break;ec=n;}while((n=n.nextSibling?n.nextSibling:n.parentNode));if(sc.nodeName==bn)
rb.setStart(sc,0);else
rb.setStartBefore(sc);rb.setEnd(sn,so);bef.appendChild(rb.cloneContents()||d.createTextNode(''));try{ra.setEndAfter(ec);}catch(ex){}
ra.setStart(en,eo);aft.appendChild(ra.cloneContents()||d.createTextNode(''));r=d.createRange();if(!sc.previousSibling&&sc.parentNode.nodeName==bn){r.setStartBefore(sc.parentNode);}else{if(rb.startContainer.nodeName==bn&&rb.startOffset==0)
r.setStartBefore(rb.startContainer);else
r.setStart(rb.startContainer,rb.startOffset);}
if(!ec.nextSibling&&ec.parentNode.nodeName==bn)
r.setEndAfter(ec.parentNode);else
r.setEnd(ra.endContainer,ra.endOffset);r.deleteContents();if(isOpera)
ed.getWin().scrollTo(0,vp.y);if(bef.firstChild&&bef.firstChild.nodeName==bn)
bef.innerHTML=bef.firstChild.innerHTML;if(aft.firstChild&&aft.firstChild.nodeName==bn)
aft.innerHTML=aft.firstChild.innerHTML;if(isEmpty(bef))
bef.innerHTML='<br />';function appendStyles(e,en){var nl=[],nn,n,i;e.innerHTML='';if(se.keep_styles){n=en;do{if(/^(SPAN|STRONG|B|EM|I|FONT|STRIKE|U)$/.test(n.nodeName)){nn=n.cloneNode(FALSE);dom.setAttrib(nn,'id','');nl.push(nn);}}while(n=n.parentNode);}
if(nl.length>0){for(i=nl.length-1,nn=e;i>=0;i--)
nn=nn.appendChild(nl[i]);nl[0].innerHTML=isOpera?'&nbsp;':'<br />';return nl[0];}else
e.innerHTML=isOpera?'&nbsp;':'<br />';};if(isEmpty(aft))
car=appendStyles(aft,en);if(isOpera&&parseFloat(opera.version())<9.5){r.insertNode(bef);r.insertNode(aft);}else{r.insertNode(aft);r.insertNode(bef);}
aft.normalize();bef.normalize();function first(n){return d.createTreeWalker(n,NodeFilter.SHOW_TEXT,null,FALSE).nextNode()||n;};r=d.createRange();r.selectNodeContents(isGecko?first(car||aft):car||aft);r.collapse(1);s.removeAllRanges();s.addRange(r);y=ed.dom.getPos(aft).y;ch=aft.clientHeight;if(y<vp.y||y+ch>vp.y+vp.h){ed.getWin().scrollTo(0,y<vp.y?y:y-vp.h+25);}
return FALSE;},backspaceDelete:function(e,bs){var t=this,ed=t.editor,b=ed.getBody(),dom=ed.dom,n,se=ed.selection,r=se.getRng(),sc=r.startContainer,n,w,tn,walker;if(!bs&&r.collapsed&&sc.nodeType==1&&r.startOffset==sc.childNodes.length){walker=new tinymce.dom.TreeWalker(sc.lastChild,sc);for(n=sc.lastChild;n;n=walker.prev()){if(n.nodeType==3){r.setStart(n,n.nodeValue.length);r.collapse(true);se.setRng(r);return;}}}
if(sc&&ed.dom.isBlock(sc)&&!/^(TD|TH)$/.test(sc.nodeName)&&bs){if(sc.childNodes.length==0||(sc.childNodes.length==1&&sc.firstChild.nodeName=='BR')){n=sc;while((n=n.previousSibling)&&!ed.dom.isBlock(n));if(n){if(sc!=b.firstChild){w=ed.dom.doc.createTreeWalker(n,NodeFilter.SHOW_TEXT,null,FALSE);while(tn=w.nextNode())
n=tn;r=ed.getDoc().createRange();r.setStart(n,n.nodeValue?n.nodeValue.length:0);r.setEnd(n,n.nodeValue?n.nodeValue.length:0);se.setRng(r);ed.dom.remove(sc);}
return Event.cancel(e);}}}}});})(tinymce);(function(tinymce){var DOM=tinymce.DOM,Event=tinymce.dom.Event,each=tinymce.each,extend=tinymce.extend;tinymce.create('tinymce.ControlManager',{ControlManager:function(ed,s){var t=this,i;s=s||{};t.editor=ed;t.controls={};t.onAdd=new tinymce.util.Dispatcher(t);t.onPostRender=new tinymce.util.Dispatcher(t);t.prefix=s.prefix||ed.id+'_';t._cls={};t.onPostRender.add(function(){each(t.controls,function(c){c.postRender();});});},get:function(id){return this.controls[this.prefix+id]||this.controls[id];},setActive:function(id,s){var c=null;if(c=this.get(id))
c.setActive(s);return c;},setDisabled:function(id,s){var c=null;if(c=this.get(id))
c.setDisabled(s);return c;},add:function(c){var t=this;if(c){t.controls[c.id]=c;t.onAdd.dispatch(c,t);}
return c;},createControl:function(n){var c,t=this,ed=t.editor;each(ed.plugins,function(p){if(p.createControl){c=p.createControl(n,t);if(c)
return false;}});switch(n){case"|":case"separator":return t.createSeparator();}
if(!c&&ed.buttons&&(c=ed.buttons[n]))
return t.createButton(n,c);return t.add(c);},createDropMenu:function(id,s,cc){var t=this,ed=t.editor,c,bm,v,cls;s=extend({'class':'mceDropDown',constrain:ed.settings.constrain_menus},s);s['class']=s['class']+' '+ed.getParam('skin')+'Skin';if(v=ed.getParam('skin_variant'))
s['class']+=' '+ed.getParam('skin')+'Skin'+v.substring(0,1).toUpperCase()+v.substring(1);id=t.prefix+id;cls=cc||t._cls.dropmenu||tinymce.ui.DropMenu;c=t.controls[id]=new cls(id,s);c.onAddItem.add(function(c,o){var s=o.settings;s.title=ed.getLang(s.title,s.title);if(!s.onclick){s.onclick=function(v){if(s.cmd)
ed.execCommand(s.cmd,s.ui||false,s.value);};}});ed.onRemove.add(function(){c.destroy();});if(tinymce.isIE){c.onShowMenu.add(function(){ed.focus();bm=ed.selection.getBookmark(1);});c.onHideMenu.add(function(){if(bm){ed.selection.moveToBookmark(bm);bm=0;}});}
return t.add(c);},createListBox:function(id,s,cc){var t=this,ed=t.editor,cmd,c,cls;if(t.get(id))
return null;s.title=ed.translate(s.title);s.scope=s.scope||ed;if(!s.onselect){s.onselect=function(v){ed.execCommand(s.cmd,s.ui||false,v||s.value);};}
s=extend({title:s.title,'class':'mce_'+id,scope:s.scope,control_manager:t},s);id=t.prefix+id;if(ed.settings.use_native_selects)
c=new tinymce.ui.NativeListBox(id,s);else{cls=cc||t._cls.listbox||tinymce.ui.ListBox;c=new cls(id,s);}
t.controls[id]=c;if(tinymce.isWebKit){c.onPostRender.add(function(c,n){Event.add(n,'mousedown',function(){ed.bookmark=ed.selection.getBookmark(1);});Event.add(n,'focus',function(){ed.selection.moveToBookmark(ed.bookmark);ed.bookmark=null;});});}
if(c.hideMenu)
ed.onMouseDown.add(c.hideMenu,c);return t.add(c);},createButton:function(id,s,cc){var t=this,ed=t.editor,o,c,cls;if(t.get(id))
return null;s.title=ed.translate(s.title);s.label=ed.translate(s.label);s.scope=s.scope||ed;if(!s.onclick&&!s.menu_button){s.onclick=function(){ed.execCommand(s.cmd,s.ui||false,s.value);};}
s=extend({title:s.title,'class':'mce_'+id,unavailable_prefix:ed.getLang('unavailable',''),scope:s.scope,control_manager:t},s);id=t.prefix+id;if(s.menu_button){cls=cc||t._cls.menubutton||tinymce.ui.MenuButton;c=new cls(id,s);ed.onMouseDown.add(c.hideMenu,c);}else{cls=t._cls.button||tinymce.ui.Button;c=new cls(id,s);}
return t.add(c);},createMenuButton:function(id,s,cc){s=s||{};s.menu_button=1;return this.createButton(id,s,cc);},createSplitButton:function(id,s,cc){var t=this,ed=t.editor,cmd,c,cls;if(t.get(id))
return null;s.title=ed.translate(s.title);s.scope=s.scope||ed;if(!s.onclick){s.onclick=function(v){ed.execCommand(s.cmd,s.ui||false,v||s.value);};}
if(!s.onselect){s.onselect=function(v){ed.execCommand(s.cmd,s.ui||false,v||s.value);};}
s=extend({title:s.title,'class':'mce_'+id,scope:s.scope,control_manager:t},s);id=t.prefix+id;cls=cc||t._cls.splitbutton||tinymce.ui.SplitButton;c=t.add(new cls(id,s));ed.onMouseDown.add(c.hideMenu,c);return c;},createColorSplitButton:function(id,s,cc){var t=this,ed=t.editor,cmd,c,cls,bm;if(t.get(id))
return null;s.title=ed.translate(s.title);s.scope=s.scope||ed;if(!s.onclick){s.onclick=function(v){if(tinymce.isIE)
bm=ed.selection.getBookmark(1);ed.execCommand(s.cmd,s.ui||false,v||s.value);};}
if(!s.onselect){s.onselect=function(v){ed.execCommand(s.cmd,s.ui||false,v||s.value);};}
s=extend({title:s.title,'class':'mce_'+id,'menu_class':ed.getParam('skin')+'Skin',scope:s.scope,more_colors_title:ed.getLang('more_colors')},s);id=t.prefix+id;cls=cc||t._cls.colorsplitbutton||tinymce.ui.ColorSplitButton;c=new cls(id,s);ed.onMouseDown.add(c.hideMenu,c);ed.onRemove.add(function(){c.destroy();});if(tinymce.isIE){c.onShowMenu.add(function(){ed.focus();bm=ed.selection.getBookmark(1);});c.onHideMenu.add(function(){if(bm){ed.selection.moveToBookmark(bm);bm=0;}});}
return t.add(c);},createToolbar:function(id,s,cc){var c,t=this,cls;id=t.prefix+id;cls=cc||t._cls.toolbar||tinymce.ui.Toolbar;c=new cls(id,s);if(t.get(id))
return null;return t.add(c);},createSeparator:function(cc){var cls=cc||this._cls.separator||tinymce.ui.Separator;return new cls();},setControlType:function(n,c){return this._cls[n.toLowerCase()]=c;},destroy:function(){each(this.controls,function(c){c.destroy();});this.controls=null;}});})(tinymce);(function(tinymce){var Dispatcher=tinymce.util.Dispatcher,each=tinymce.each,isIE=tinymce.isIE,isOpera=tinymce.isOpera;tinymce.create('tinymce.WindowManager',{WindowManager:function(ed){var t=this;t.editor=ed;t.onOpen=new Dispatcher(t);t.onClose=new Dispatcher(t);t.params={};t.features={};},open:function(s,p){var t=this,f='',x,y,mo=t.editor.settings.dialog_type=='modal',w,sw,sh,vp=tinymce.DOM.getViewPort(),u;s=s||{};p=p||{};sw=isOpera?vp.w:screen.width;sh=isOpera?vp.h:screen.height;s.name=s.name||'mc_'+new Date().getTime();s.width=parseInt(s.width||320);s.height=parseInt(s.height||240);s.resizable=true;s.left=s.left||parseInt(sw/2.0)-(s.width/2.0);s.top=s.top||parseInt(sh/2.0)-(s.height/2.0);p.inline=false;p.mce_width=s.width;p.mce_height=s.height;p.mce_auto_focus=s.auto_focus;if(mo){if(isIE){s.center=true;s.help=false;s.dialogWidth=s.width+'px';s.dialogHeight=s.height+'px';s.scroll=s.scrollbars||false;}}
each(s,function(v,k){if(tinymce.is(v,'boolean'))
v=v?'yes':'no';if(!/^(name|url)$/.test(k)){if(isIE&&mo)
f+=(f?';':'')+k+':'+v;else
f+=(f?',':'')+k+'='+v;}});t.features=s;t.params=p;t.onOpen.dispatch(t,s,p);u=s.url||s.file;u=tinymce._addVer(u);try{if(isIE&&mo){w=1;window.showModalDialog(u,window,f);}else
w=window.open(u,s.name,f);}catch(ex){}
if(!w)
alert(t.editor.getLang('popup_blocked'));},close:function(w){w.close();this.onClose.dispatch(this);},createInstance:function(cl,a,b,c,d,e){var f=tinymce.resolve(cl);return new f(a,b,c,d,e);},confirm:function(t,cb,s,w){w=w||window;cb.call(s||this,w.confirm(this._decode(this.editor.getLang(t,t))));},alert:function(tx,cb,s,w){var t=this;w=w||window;w.alert(t._decode(t.editor.getLang(tx,tx)));if(cb)
cb.call(s||t);},resizeBy:function(dw,dh,win){win.resizeBy(dw,dh);},_decode:function(s){return tinymce.DOM.decode(s).replace(/\\n/g,'\n');}});}(tinymce));(function(tinymce){function CommandManager(){var execCommands={},queryStateCommands={},queryValueCommands={};function add(collection,cmd,func,scope){if(typeof(cmd)=='string')
cmd=[cmd];tinymce.each(cmd,function(cmd){collection[cmd.toLowerCase()]={func:func,scope:scope};});};tinymce.extend(this,{add:function(cmd,func,scope){add(execCommands,cmd,func,scope);},addQueryStateHandler:function(cmd,func,scope){add(queryStateCommands,cmd,func,scope);},addQueryValueHandler:function(cmd,func,scope){add(queryValueCommands,cmd,func,scope);},execCommand:function(scope,cmd,ui,value,args){if(cmd=execCommands[cmd.toLowerCase()]){if(cmd.func.call(scope||cmd.scope,ui,value,args)!==false)
return true;}},queryCommandValue:function(){if(cmd=queryValueCommands[cmd.toLowerCase()])
return cmd.func.call(scope||cmd.scope,ui,value,args);},queryCommandState:function(){if(cmd=queryStateCommands[cmd.toLowerCase()])
return cmd.func.call(scope||cmd.scope,ui,value,args);}});};tinymce.GlobalCommands=new CommandManager();})(tinymce);(function(tinymce){tinymce.Formatter=function(ed){var formats={},each=tinymce.each,dom=ed.dom,selection=ed.selection,TreeWalker=tinymce.dom.TreeWalker,rangeUtils=new tinymce.dom.RangeUtils(dom),isValid=ed.schema.isValid,isBlock=dom.isBlock,forcedRootBlock=ed.settings.forced_root_block,nodeIndex=dom.nodeIndex,INVISIBLE_CHAR='\uFEFF',MCE_ATTR_RE=/^(src|href|style)$/,FALSE=false,TRUE=true,undefined,pendingFormats={apply:[],remove:[]};function isArray(obj){return obj instanceof Array;};function getParents(node,selector){return dom.getParents(node,selector,dom.getRoot());};function isCaretNode(node){return node.nodeType===1&&(node.face==='mceinline'||node.style.fontFamily==='mceinline');};function get(name){return name?formats[name]:formats;};function register(name,format){if(name){if(typeof(name)!=='string'){each(name,function(format,name){register(name,format);});}else{format=format.length?format:[format];each(format,function(format){if(format.deep===undefined)
format.deep=!format.selector;if(format.split===undefined)
format.split=!format.selector||format.inline;if(format.remove===undefined&&format.selector&&!format.inline)
format.remove='none';if(format.selector&&format.inline){format.mixed=true;format.block_expand=true;}
if(typeof(format.classes)==='string')
format.classes=format.classes.split(/\s+/);});formats[name]=format;}}};function apply(name,vars,node){var formatList=get(name),format=formatList[0],bookmark,rng,i;function moveStart(rng){var container=rng.startContainer,offset=rng.startOffset,walker,node;if(container.nodeType==1||container.nodeValue===""){container=container.nodeType==1?container.childNodes[offset]:container;if(container){walker=new TreeWalker(container,container.parentNode);for(node=walker.current();node;node=walker.next()){if(node.nodeType==3&&!isWhiteSpaceNode(node)){rng.setStart(node,0);break;}}}}
return rng;};function setElementFormat(elm,fmt){fmt=fmt||format;if(elm){each(fmt.styles,function(value,name){dom.setStyle(elm,name,replaceVars(value,vars));});each(fmt.attributes,function(value,name){dom.setAttrib(elm,name,replaceVars(value,vars));});each(fmt.classes,function(value){value=replaceVars(value,vars);if(!dom.hasClass(elm,value))
dom.addClass(elm,value);});}};function applyRngStyle(rng){var newWrappers=[],wrapName,wrapElm;wrapName=format.inline||format.block;wrapElm=dom.create(wrapName);setElementFormat(wrapElm);rangeUtils.walk(rng,function(nodes){var currentWrapElm;function process(node){var nodeName=node.nodeName.toLowerCase(),parentName=node.parentNode.nodeName.toLowerCase(),found;if(isEq(nodeName,'br')){currentWrapElm=0;if(format.block)
dom.remove(node);return;}
if(format.wrapper&&matchNode(node,name,vars)){currentWrapElm=0;return;}
if(format.block&&!format.wrapper&&isTextBlock(nodeName)){node=dom.rename(node,wrapName);setElementFormat(node);newWrappers.push(node);currentWrapElm=0;return;}
if(format.selector){each(formatList,function(format){if(dom.is(node,format.selector)&&!isCaretNode(node)){setElementFormat(node,format);found=true;}});if(!format.inline||found){currentWrapElm=0;return;}}
if(isValid(wrapName,nodeName)&&isValid(parentName,wrapName)){if(!currentWrapElm){currentWrapElm=wrapElm.cloneNode(FALSE);node.parentNode.insertBefore(currentWrapElm,node);newWrappers.push(currentWrapElm);}
currentWrapElm.appendChild(node);}else{currentWrapElm=0;each(tinymce.grep(node.childNodes),process);currentWrapElm=0;}};each(nodes,process);});each(newWrappers,function(node){var childCount;function getChildCount(node){var count=0;each(node.childNodes,function(node){if(!isWhiteSpaceNode(node)&&!isBookmarkNode(node))
count++;});return count;};function mergeStyles(node){var child,clone;each(node.childNodes,function(node){if(node.nodeType==1&&!isBookmarkNode(node)&&!isCaretNode(node)){child=node;return FALSE;}});if(child&&matchName(child,format)){clone=child.cloneNode(FALSE);setElementFormat(clone);dom.replace(clone,node,TRUE);dom.remove(child,1);}
return clone||node;};childCount=getChildCount(node);if(childCount===0){dom.remove(node,1);return;}
if(format.inline||format.wrapper){if(!format.exact&&childCount===1)
node=mergeStyles(node);each(formatList,function(format){each(dom.select(format.inline,node),function(child){removeFormat(format,vars,child,format.exact?child:null);});});if(matchNode(node.parentNode,name,vars)){dom.remove(node,1);node=0;return TRUE;}
if(format.merge_with_parents){dom.getParent(node.parentNode,function(parent){if(matchNode(parent,name,vars)){dom.remove(node,1);node=0;return TRUE;}});}
if(node){node=mergeSiblings(getNonWhiteSpaceSibling(node),node);node=mergeSiblings(node,getNonWhiteSpaceSibling(node,TRUE));}}});};if(format){if(node){rng=dom.createRng();rng.setStartBefore(node);rng.setEndAfter(node);applyRngStyle(expandRng(rng,formatList));}else{if(!selection.isCollapsed()||!format.inline){bookmark=selection.getBookmark();applyRngStyle(expandRng(selection.getRng(TRUE),formatList));selection.moveToBookmark(bookmark);selection.setRng(moveStart(selection.getRng(TRUE)));ed.nodeChanged();}else
performCaretAction('apply',name,vars);}}};function remove(name,vars,node){var formatList=get(name),format=formatList[0],bookmark,i,rng;function moveStart(rng){var container=rng.startContainer,offset=rng.startOffset,walker,node,nodes,tmpNode;if(container.nodeType==3&&offset>=container.nodeValue.length-1){container=container.parentNode;offset=nodeIndex(container)+1;}
if(container.nodeType==1){nodes=container.childNodes;container=nodes[Math.min(offset,nodes.length-1)];walker=new TreeWalker(container);if(offset>nodes.length-1)
walker.next();for(node=walker.current();node;node=walker.next()){if(node.nodeType==3&&!isWhiteSpaceNode(node)){tmpNode=dom.create('a',null,INVISIBLE_CHAR);node.parentNode.insertBefore(tmpNode,node);rng.setStart(node,0);selection.setRng(rng);dom.remove(tmpNode);return;}}}};function process(node){var children,i,l;children=tinymce.grep(node.childNodes);for(i=0,l=formatList.length;i<l;i++){if(removeFormat(formatList[i],vars,node,node))
break;}
if(format.deep){for(i=0,l=children.length;i<l;i++)
process(children[i]);}};function findFormatRoot(container){var formatRoot;each(getParents(container.parentNode).reverse(),function(parent){var format;if(!formatRoot&&parent.id!='_start'&&parent.id!='_end'){format=matchNode(parent,name,vars);if(format&&format.split!==false)
formatRoot=parent;}});return formatRoot;};function wrapAndSplit(format_root,container,target,split){var parent,clone,lastClone,firstClone,i,formatRootParent;if(format_root){formatRootParent=format_root.parentNode;for(parent=container.parentNode;parent&&parent!=formatRootParent;parent=parent.parentNode){clone=parent.cloneNode(FALSE);for(i=0;i<formatList.length;i++){if(removeFormat(formatList[i],vars,clone,clone)){clone=0;break;}}
if(clone){if(lastClone)
clone.appendChild(lastClone);if(!firstClone)
firstClone=clone;lastClone=clone;}}
if(split&&(!format.mixed||!isBlock(format_root)))
container=dom.split(format_root,container);if(lastClone){target.parentNode.insertBefore(lastClone,target);firstClone.appendChild(target);}}
return container;};function splitToFormatRoot(container){return wrapAndSplit(findFormatRoot(container),container,container,true);};function unwrap(start){var node=dom.get(start?'_start':'_end'),out=node[start?'firstChild':'lastChild'];if(isBookmarkNode(out))
out=out[start?'firstChild':'lastChild'];dom.remove(node,true);return out;};function removeRngStyle(rng){var startContainer,endContainer;rng=expandRng(rng,formatList,TRUE);if(format.split){startContainer=getContainer(rng,TRUE);endContainer=getContainer(rng);if(startContainer!=endContainer){startContainer=wrap(startContainer,'span',{id:'_start',_mce_type:'bookmark'});endContainer=wrap(endContainer,'span',{id:'_end',_mce_type:'bookmark'});splitToFormatRoot(startContainer);splitToFormatRoot(endContainer);startContainer=unwrap(TRUE);endContainer=unwrap();}else
startContainer=endContainer=splitToFormatRoot(startContainer);rng.startContainer=startContainer.parentNode;rng.startOffset=nodeIndex(startContainer);rng.endContainer=endContainer.parentNode;rng.endOffset=nodeIndex(endContainer)+1;}
rangeUtils.walk(rng,function(nodes){each(nodes,function(node){process(node);});});};if(node){rng=dom.createRng();rng.setStartBefore(node);rng.setEndAfter(node);removeRngStyle(rng);return;}
if(!selection.isCollapsed()||!format.inline){bookmark=selection.getBookmark();removeRngStyle(selection.getRng(TRUE));selection.moveToBookmark(bookmark);if(match(name,vars,selection.getStart())){moveStart(selection.getRng(true));}
ed.nodeChanged();}else
performCaretAction('remove',name,vars);};function toggle(name,vars,node){if(match(name,vars,node))
remove(name,vars,node);else
apply(name,vars,node);};function matchNode(node,name,vars,similar){var formatList=get(name),format,i,classes;function matchItems(node,format,item_name){var key,value,items=format[item_name],i;if(items){if(items.length===undefined){for(key in items){if(items.hasOwnProperty(key)){if(item_name==='attributes')
value=dom.getAttrib(node,key);else
value=getStyle(node,key);if(similar&&!value&&!format.exact)
return;if((!similar||format.exact)&&!isEq(value,replaceVars(items[key],vars)))
return;}}}else{for(i=0;i<items.length;i++){if(item_name==='attributes'?dom.getAttrib(node,items[i]):getStyle(node,items[i]))
return format;}}}
return format;};if(formatList&&node){for(i=0;i<formatList.length;i++){format=formatList[i];if(matchName(node,format)&&matchItems(node,format,'attributes')&&matchItems(node,format,'styles')){if(classes=format.classes){for(i=0;i<classes.length;i++){if(!dom.hasClass(node,classes[i]))
return;}}
return format;}}}};function match(name,vars,node){var startNode,i;function matchParents(node){node=dom.getParent(node,function(node){return!!matchNode(node,name,vars,true);});return matchNode(node,name,vars);};if(node)
return matchParents(node);if(selection.isCollapsed()){for(i=pendingFormats.apply.length-1;i>=0;i--){if(pendingFormats.apply[i].name==name)
return true;}
for(i=pendingFormats.remove.length-1;i>=0;i--){if(pendingFormats.remove[i].name==name)
return false;}
return matchParents(selection.getNode());}
node=selection.getNode();if(matchParents(node))
return TRUE;startNode=selection.getStart();if(startNode!=node){if(matchParents(startNode))
return TRUE;}
return FALSE;};function matchAll(names,vars){var startElement,matchedFormatNames=[],checkedMap={},i,ni,name;if(selection.isCollapsed()){for(ni=0;ni<names.length;ni++){for(i=pendingFormats.remove.length-1;i>=0;i--){name=names[ni];if(pendingFormats.remove[i].name==name){checkedMap[name]=true;break;}}}
for(i=pendingFormats.apply.length-1;i>=0;i--){for(ni=0;ni<names.length;ni++){name=names[ni];if(!checkedMap[name]&&pendingFormats.apply[i].name==name){checkedMap[name]=true;matchedFormatNames.push(name);}}}}
startElement=selection.getStart();dom.getParent(startElement,function(node){var i,name;for(i=0;i<names.length;i++){name=names[i];if(!checkedMap[name]&&matchNode(node,name,vars)){checkedMap[name]=true;matchedFormatNames.push(name);}}});return matchedFormatNames;};function canApply(name){var formatList=get(name),startNode,parents,i,x,selector;if(formatList){startNode=selection.getStart();parents=getParents(startNode);for(x=formatList.length-1;x>=0;x--){selector=formatList[x].selector;if(!selector)
return TRUE;for(i=parents.length-1;i>=0;i--){if(dom.is(parents[i],selector))
return TRUE;}}}
return FALSE;};tinymce.extend(this,{get:get,register:register,apply:apply,remove:remove,toggle:toggle,match:match,matchAll:matchAll,matchNode:matchNode,canApply:canApply});function matchName(node,format){if(isEq(node,format.inline))
return TRUE;if(isEq(node,format.block))
return TRUE;if(format.selector)
return dom.is(node,format.selector);};function isEq(str1,str2){str1=str1||'';str2=str2||'';str1=''+(str1.nodeName||str1);str2=''+(str2.nodeName||str2);return str1.toLowerCase()==str2.toLowerCase();};function getStyle(node,name){var styleVal=dom.getStyle(node,name);if(name=='color'||name=='backgroundColor')
styleVal=dom.toHex(styleVal);if(name=='fontWeight'&&styleVal==700)
styleVal='bold';return''+styleVal;};function replaceVars(value,vars){if(typeof(value)!="string")
value=value(vars);else if(vars){value=value.replace(/%(\w+)/g,function(str,name){return vars[name]||str;});}
return value;};function isWhiteSpaceNode(node){return node&&node.nodeType===3&&/^([\s\r\n]+|)$/.test(node.nodeValue);};function wrap(node,name,attrs){var wrapper=dom.create(name,attrs);node.parentNode.insertBefore(wrapper,node);wrapper.appendChild(node);return wrapper;};function expandRng(rng,format,remove){var startContainer=rng.startContainer,startOffset=rng.startOffset,endContainer=rng.endContainer,endOffset=rng.endOffset,sibling,lastIdx;function findParentContainer(container,child_name,sibling_name,root){var parent,child;root=root||dom.getRoot();for(;;){parent=container.parentNode;if(parent==root||(!format[0].block_expand&&isBlock(parent)))
return container;for(sibling=parent[child_name];sibling&&sibling!=container;sibling=sibling[sibling_name]){if(sibling.nodeType==1&&!isBookmarkNode(sibling))
return container;if(sibling.nodeType==3&&!isWhiteSpaceNode(sibling))
return container;}
container=container.parentNode;}
return container;};if(startContainer.nodeType==1&&startContainer.hasChildNodes()){lastIdx=startContainer.childNodes.length-1;startContainer=startContainer.childNodes[startOffset>lastIdx?lastIdx:startOffset];if(startContainer.nodeType==3)
startOffset=0;}
if(endContainer.nodeType==1&&endContainer.hasChildNodes()){lastIdx=endContainer.childNodes.length-1;endContainer=endContainer.childNodes[endOffset>lastIdx?lastIdx:endOffset-1];if(endContainer.nodeType==3)
endOffset=endContainer.nodeValue.length;}
if(isBookmarkNode(startContainer.parentNode))
startContainer=startContainer.parentNode;if(isBookmarkNode(startContainer))
startContainer=startContainer.nextSibling||startContainer;if(isBookmarkNode(endContainer.parentNode))
endContainer=endContainer.parentNode;if(isBookmarkNode(endContainer))
endContainer=endContainer.previousSibling||endContainer;if(format[0].inline||format[0].block_expand){startContainer=findParentContainer(startContainer,'firstChild','nextSibling');endContainer=findParentContainer(endContainer,'lastChild','previousSibling');}
if(format[0].selector&&format[0].expand!==FALSE&&!format[0].inline){function findSelectorEndPoint(container,sibling_name){var parents,i,y;if(container.nodeType==3&&container.nodeValue.length==0&&container[sibling_name])
container=container[sibling_name];parents=getParents(container);for(i=0;i<parents.length;i++){for(y=0;y<format.length;y++){if(dom.is(parents[i],format[y].selector))
return parents[i];}}
return container;};startContainer=findSelectorEndPoint(startContainer,'previousSibling');endContainer=findSelectorEndPoint(endContainer,'nextSibling');}
if(format[0].block||format[0].selector){function findBlockEndPoint(container,sibling_name,sibling_name2){var node;if(!format[0].wrapper)
node=dom.getParent(container,format[0].block);if(!node)
node=dom.getParent(container.nodeType==3?container.parentNode:container,isBlock);if(node&&format[0].wrapper)
node=getParents(node,'ul,ol').reverse()[0]||node;if(!node){node=container;while(node[sibling_name]&&!isBlock(node[sibling_name])){node=node[sibling_name];if(isEq(node,'br'))
break;}}
return node||container;};startContainer=findBlockEndPoint(startContainer,'previousSibling');endContainer=findBlockEndPoint(endContainer,'nextSibling');if(format[0].block){if(!isBlock(startContainer))
startContainer=findParentContainer(startContainer,'firstChild','nextSibling');if(!isBlock(endContainer))
endContainer=findParentContainer(endContainer,'lastChild','previousSibling');}}
if(startContainer.nodeType==1){startOffset=nodeIndex(startContainer);startContainer=startContainer.parentNode;}
if(endContainer.nodeType==1){endOffset=nodeIndex(endContainer)+1;endContainer=endContainer.parentNode;}
return{startContainer:startContainer,startOffset:startOffset,endContainer:endContainer,endOffset:endOffset};}
function removeFormat(format,vars,node,compare_node){var i,attrs,stylesModified;if(!matchName(node,format))
return FALSE;if(format.remove!='all'){each(format.styles,function(value,name){value=replaceVars(value,vars);if(typeof(name)==='number'){name=value;compare_node=0;}
if(!compare_node||isEq(getStyle(compare_node,name),value))
dom.setStyle(node,name,'');stylesModified=1;});if(stylesModified&&dom.getAttrib(node,'style')==''){node.removeAttribute('style');node.removeAttribute('_mce_style');}
each(format.attributes,function(value,name){var valueOut;value=replaceVars(value,vars);if(typeof(name)==='number'){name=value;compare_node=0;}
if(!compare_node||isEq(dom.getAttrib(compare_node,name),value)){if(name=='class'){value=dom.getAttrib(node,name);if(value){valueOut='';each(value.split(/\s+/),function(cls){if(/mce\w+/.test(cls))
valueOut+=(valueOut?' ':'')+cls;});if(valueOut){dom.setAttrib(node,name,valueOut);return;}}}
if(name=="class")
node.removeAttribute('className');if(MCE_ATTR_RE.test(name))
node.removeAttribute('_mce_'+name);node.removeAttribute(name);}});each(format.classes,function(value){value=replaceVars(value,vars);if(!compare_node||dom.hasClass(compare_node,value))
dom.removeClass(node,value);});attrs=dom.getAttribs(node);for(i=0;i<attrs.length;i++){if(attrs[i].nodeName.indexOf('_')!==0)
return FALSE;}}
if(format.remove!='none'){removeNode(node,format);return TRUE;}};function removeNode(node,format){var parentNode=node.parentNode,rootBlockElm;if(format.block){if(!forcedRootBlock){function find(node,next,inc){node=getNonWhiteSpaceSibling(node,next,inc);return!node||(node.nodeName=='BR'||isBlock(node));};if(isBlock(node)&&!isBlock(parentNode)){if(!find(node,FALSE)&&!find(node.firstChild,TRUE,1))
node.insertBefore(dom.create('br'),node.firstChild);if(!find(node,TRUE)&&!find(node.lastChild,FALSE,1))
node.appendChild(dom.create('br'));}}else{if(parentNode==dom.getRoot()){if(!format.list_block||!isEq(node,format.list_block)){each(tinymce.grep(node.childNodes),function(node){if(isValid(forcedRootBlock,node.nodeName.toLowerCase())){if(!rootBlockElm)
rootBlockElm=wrap(node,forcedRootBlock);else
rootBlockElm.appendChild(node);}else
rootBlockElm=0;});}}}}
if(format.selector&&format.inline&&!isEq(format.inline,node))
return;dom.remove(node,1);};function getNonWhiteSpaceSibling(node,next,inc){if(node){next=next?'nextSibling':'previousSibling';for(node=inc?node:node[next];node;node=node[next]){if(node.nodeType==1||!isWhiteSpaceNode(node))
return node;}}};function isBookmarkNode(node){return node&&node.nodeType==1&&node.getAttribute('_mce_type')=='bookmark';};function mergeSiblings(prev,next){var marker,sibling,tmpSibling;function compareElements(node1,node2){if(node1.nodeName!=node2.nodeName)
return FALSE;function getAttribs(node){var attribs={};each(dom.getAttribs(node),function(attr){var name=attr.nodeName.toLowerCase();if(name.indexOf('_')!==0&&name!=='style')
attribs[name]=dom.getAttrib(node,name);});return attribs;};function compareObjects(obj1,obj2){var value,name;for(name in obj1){if(obj1.hasOwnProperty(name)){value=obj2[name];if(value===undefined)
return FALSE;if(obj1[name]!=value)
return FALSE;delete obj2[name];}}
for(name in obj2){if(obj2.hasOwnProperty(name))
return FALSE;}
return TRUE;};if(!compareObjects(getAttribs(node1),getAttribs(node2)))
return FALSE;if(!compareObjects(dom.parseStyle(dom.getAttrib(node1,'style')),dom.parseStyle(dom.getAttrib(node2,'style'))))
return FALSE;return TRUE;};if(prev&&next){function findElementSibling(node,sibling_name){for(sibling=node;sibling;sibling=sibling[sibling_name]){if(sibling.nodeType==3&&!isWhiteSpaceNode(sibling))
return node;if(sibling.nodeType==1&&!isBookmarkNode(sibling))
return sibling;}
return node;};prev=findElementSibling(prev,'previousSibling');next=findElementSibling(next,'nextSibling');if(compareElements(prev,next)){for(sibling=prev.nextSibling;sibling&&sibling!=next;){tmpSibling=sibling;sibling=sibling.nextSibling;prev.appendChild(tmpSibling);}
dom.remove(next);each(tinymce.grep(next.childNodes),function(node){prev.appendChild(node);});return prev;}}
return next;};function isTextBlock(name){return/^(h[1-6]|p|div|pre|address|dl|dt|dd)$/.test(name);};function getContainer(rng,start){var container,offset,lastIdx;container=rng[start?'startContainer':'endContainer'];offset=rng[start?'startOffset':'endOffset'];if(container.nodeType==1){lastIdx=container.childNodes.length-1;if(!start&&offset)
offset--;container=container.childNodes[offset>lastIdx?lastIdx:offset];}
return container;};function performCaretAction(type,name,vars){var i,currentPendingFormats=pendingFormats[type],otherPendingFormats=pendingFormats[type=='apply'?'remove':'apply'];function hasPending(){return pendingFormats.apply.length||pendingFormats.remove.length;};function resetPending(){pendingFormats.apply=[];pendingFormats.remove=[];};function perform(caret_node){each(pendingFormats.apply.reverse(),function(item){apply(item.name,item.vars,caret_node);});each(pendingFormats.remove.reverse(),function(item){remove(item.name,item.vars,caret_node);});dom.remove(caret_node,1);resetPending();};for(i=currentPendingFormats.length-1;i>=0;i--){if(currentPendingFormats[i].name==name)
return;}
currentPendingFormats.push({name:name,vars:vars});for(i=otherPendingFormats.length-1;i>=0;i--){if(otherPendingFormats[i].name==name)
otherPendingFormats.splice(i,1);}
if(hasPending()){ed.getDoc().execCommand('FontName',false,'mceinline');pendingFormats.lastRng=selection.getRng();each(dom.select('font,span'),function(node){var bookmark;if(isCaretNode(node)){bookmark=selection.getBookmark();perform(node);selection.moveToBookmark(bookmark);ed.nodeChanged();}});if(!pendingFormats.isListening&&hasPending()){pendingFormats.isListening=true;each('onKeyDown,onKeyUp,onKeyPress,onMouseUp'.split(','),function(event){ed[event].addToTop(function(ed,e){if(hasPending()&&!tinymce.dom.RangeUtils.compareRanges(pendingFormats.lastRng,selection.getRng())){each(dom.select('font,span'),function(node){var textNode,rng;if(isCaretNode(node)){textNode=node.firstChild;if(textNode){perform(node);rng=dom.createRng();rng.setStart(textNode,textNode.nodeValue.length);rng.setEnd(textNode,textNode.nodeValue.length);selection.setRng(rng);ed.nodeChanged();}else
dom.remove(node);}});if(e.type=='keyup'||e.type=='mouseup')
resetPending();}});});}}};};})(tinymce);tinymce.onAddEditor.add(function(tinymce,ed){var filters,fontSizes,dom,settings=ed.settings;if(settings.inline_styles){fontSizes=tinymce.explode(settings.font_size_style_values);function replaceWithSpan(node,styles){tinymce.each(styles,function(value,name){if(value)
dom.setStyle(node,name,value);});dom.rename(node,'span');};filters={font:function(dom,node){replaceWithSpan(node,{backgroundColor:node.style.backgroundColor,color:node.color,fontFamily:node.face,fontSize:fontSizes[parseInt(node.size)-1]});},u:function(dom,node){replaceWithSpan(node,{textDecoration:'underline'});},strike:function(dom,node){replaceWithSpan(node,{textDecoration:'line-through'});}};function convert(editor,params){dom=editor.dom;if(settings.convert_fonts_to_spans){tinymce.each(dom.select('font,u,strike',params.node),function(node){filters[node.nodeName.toLowerCase()](ed.dom,node);});}};ed.onPreProcess.add(convert);ed.onInit.add(function(){ed.selection.onSetContent.add(convert);});}});