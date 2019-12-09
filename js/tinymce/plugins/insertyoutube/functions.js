function init() {
    tinyMCEPopup.requireLangPack();
    tinyMCEPopup.resizeToInnerSize();
}

function isValidUrl( url )
{
    var regexp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    return regexp.test(url);
}

function getYouTubeLink( url )
{
    var regexp;
    // check if this is a URL pointing to a youtube link or to a youtube video
    if( url.match( /https?:\/\/(.{2,3}\.)?youtube.com\/.*?v=/i )) {
        // and if it's a link to a normal youtube page, build the right link to the video player
        regexp = /https?:\/\/(.{2,3}\.)?youtube.com\/.*?v=([\-0-9a-zA-z_]*).*/i;
        result = regexp.exec(url);
        if(result){
            videoId = result[2];
            url = "https://www.youtube.com/embed/" + videoId;
        }
    }
    else {
        regexp = /.*?v=([\-0-9a-zA-z_]*).*/i;
        result = regexp.exec(url);
        if(result){
            videoId = result[1];
            url = "https://www.youtube.com/embed/" + videoId;
        }
    }
    
    return (url);
}

function insertYoutubeCode()
{
    // get and check the URL
    urlField = document.forms[0].url;
    url = urlField.value;
    if( url === "" || !isValidUrl( url )) {
        window.alert( tinyMCEPopup.getLang('insertyoutube_dlg.badurl', 0) );
        return( false );
    }

    link = getYouTubeLink( url );
    css="ltYoutube";
    width=425;
    height=355;

    insertFlash( link, css, width, height );

    return true;
}

function insertFlash( file, css, width, height ) {
    var html = '<img src="' + tinyMCEPopup.getWindowArg('plugin_url') + '/img/spacer.gif" mce_src="' + tinyMCEPopup.getWindowArg('plugin_url') + '/img/spacer.gif" ' +
               'width="' + width + '" height="' + height + '" ' +
               'border="0" alt="' + file + '" title="' + file + '" class="' + css + '" />';

    tinyMCEPopup.execCommand("mceInsertContent", true, html);
    tinyMCEPopup.close();
}
