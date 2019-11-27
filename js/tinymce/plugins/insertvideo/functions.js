function init() {
    tinyMCEPopup.requireLangPack();
    tinyMCEPopup.resizeToInnerSize();
}

function isValidUrl( url )
{
    var regexp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    return regexp.test(url);
}

function getVimeoLink( url )
{
    var regexp = /http:\/\/(?:www\.)?vimeo.com\/([0-9]+)/i;
    result = regexp.exec( url );
    if(!result){
        return url;
    }
    videoId = result[1];
    url = "http://vimeo.com/moogaloop.swf?clip_id="+videoId+"&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=0a7ac2&amp;fullscreen=1";
    return url;
}

function getYouTubeLink( url )
{
    var regexp;
    // check if this is a URL pointing to a youtube link or to a youtube video
    //if( url.substring( 0, 31 ) == "http://www.youtube.com/watch?v=" ) {
    if( url.match( /http:\/\/.{2,3}\.youtube.com\/.*?v=/i )) {
        // and if it's a link to a normal youtube page, build the right link to the video player
        regexp = /http:\/\/.{2,3}\.youtube.com\/.*?v=([\-0-9a-zA-z_]*).*/i;
        result = regexp.exec( url );
        if( result ) {
            videoId = result[1];
        }
        else {
            // let's try to make a best guess...
            videoId = url.substring( 31, url.length );
        }

        url = "http://www.youtube.com/v/" + videoId;
    }
    else if ( url.substring( 0, 27 ) == "http://youtube.com/watch?v=" ) {
        // Checks if the URL is missing WWW.
        // and if it's a link to a normal youtube page, build the right link to the video player
        regexp = /http:\/\/youtube.com\/.*?v=([\-0-9a-zA-z_]*).*/i;
        result = regexp.exec( url );
        if( result ) {
            videoId = result[1];
        }
        else {
            // let's try to make a best guess...
            videoId = url.substring( 27, url.length );
        }

        url = "http://www.youtube.com/v/" + videoId;
    }
    else {
        regexp = /.*?v=([\-0-9a-zA-z_]*).*/i;
        result = regexp.exec( url );
        if( result ) {
            videoId = result[1];
            url = "http://www.youtube.com/v/" + videoId;
        }
    }

    return( url );
}

function getGoogleVideoLink( url )
{
    // check if it's a link to a video page or a link to the video player
    if( url.substring( 0, 40 ) == "http://video.google.com/videoplay?docid=" ) {
        // if it's a link to a video page, generate the right one
        var regexp = /http:\/\/video.google.com\/.*?docid=([\-0-9a-zA-z_]*).*/i;
        result = regexp.exec( url );
        if( result ) {
            videoId = result[1];
        }
        else {
            videoId = url.substring( 40, url.length );
        }

        url = "http://video.google.com/googleplayer.swf?docId=" + videoId;
    }

    return( url );
}

function getMetacafeVideoLink( url )
{
    // check if it's a link to a video page or a link to the video player
    if( url.substring( 0, 30 ) == "http://www.metacafe.com/watch/" ) {
        // if it's a link to a video page, generate the right one
        var regexp = /http:\/\/www.metacafe.com\/watch\/.*?docid=([\-0-9a-zA-z_]*).*/i;
        result = regexp.exec( url );
        if( result ) {
            videoId = result[1];
        }
        else {
            videoId = url.substring( 30, url.length - 1 );
        }

        url = "http://www.metacafe.com/fplayer/" + videoId + ".swf";
    }

    return( url );
}

function getiFilmVideoLink( url )
{
    // check if it's a link to a video page or a link to the video player
    if( url.substring( 0, 27 ) == "http://www.ifilm.com/video/" ) {
        // if it's a link to a video page, generate the right one
        var regexp = /http:\/\/www.ifilm.com\/video\/.*?docid=([\-0-9a-zA-z_]*).*/i;
        result = regexp.exec( url );
        if( result ) {
            videoId = result[1];
        }
        else {
            videoId = url.substring( 27, url.length );
        }

        url = "http://www.ifilm.com/efp?flvbaseclip=" + videoId ;
    }

    return( url );
}

function getGoearVideoLink( url )
{
    // check if it's a link to a video page or a link to the video player
    if( url.substring( 0, 34 ) == "http://www.goear.com/listen.php?v=" ) {
        // if it's a link to a video page, generate the right one
        var regexp = /http:\/\/www.goear.com\/.*?v=([\-0-9a-zA-z_]*).*/i;
        result = regexp.exec( url );
        if( result ) {
            videoId = result[1];
        }
        else {
            videoId = url.substring( 34, url.length );
        }
        url = "http://www.goear.com/files/external.swf?file=" + videoId ;
    }

    return( url );
}

function getGrouperVideoLink( url )
{
    // check if it's a link to a video page or a link to the video player
    if( url.substring( 0, 46 ) == "http://grouper.com/video/MediaDetails.aspx?id=" ) {
        // if it's a link to a video page, generate the right one
        var regexp = /http:\/\/www.grouper.com\/video\/MediaDetails.aspx.*?id=([\-0-9a-zA-z_]*).*/i;
        result = regexp.exec( url );
        if( result ) {
            videoId = result[1];
        }
        else {
            videoId = url.substring( 46, url.length );
        }

        url = "http://grouper.com/mtg/mtgPlayer.swf?gvars=vurl~http%3a%2f%2fgrouper.com%2frss%2fflv.ashx%3fid%3d" + videoId + "_rf%7e-9_vfver~8_ap~1_extid~-1";
    }

    return( url );
}

function getDailymotionLink( url )
{
    // check if this is a URL pointing to a dailymotion embedded video link
    var regexp = /object\swidth="([0-9]+)"\sheight="([0-9]+)".+value="(http:\/\/www\.dailymotion\.com\/swf\/\w+).*"/;
    result = regexp.exec( url );
    return( result );
}

function insertVideoCode()
{
    // get and check the URL
    urlField = document.forms[0].url;
    url = urlField.value;
    if( url === "" || !isValidUrl( url )) {
        window.alert( tinyMCEPopup.getLang('insertvideo_dlg.badurl', 0) );
        return( false );
    }

    // check if a destination system was selected
    vimeo = document.getElementById("vimeo");
    youtube = document.getElementById("youtube");
    gvideo = document.getElementById("gvideo");
    metacafe = document.getElementById("metacafe");
    ifilm = document.getElementById("ifilm");
    goear = document.getElementById("goear");
    grouper = document.getElementById("grouper");
    dailymot = document.getElementById("dailymot");

    if( vimeo.checked === false &&
        youtube.checked === false &&
        gvideo.checked === false &&
        metacafe.checked === false &&
        ifilm.checked === false &&
        goear.checked === false &&
        grouper.checked === false &&
        dailymot.checked === false ) {
        window.alert( tinyMCEPopup.getLang('insertvideo_dlg.selectiontype', 0) );
        return( false );
    }

    if( vimeo.checked === true ) {
        link = getVimeoLink( url );
        css="ltVideoVimeo";
        width=425;
        height=355;
    }
    if( youtube.checked === true ) {
        link = getYouTubeLink( url );
        css="ltVideoYouTube";
        width=425;
        height=355;
    }
    if( gvideo.checked === true ) {
        link = getGoogleVideoLink( url );
        css="ltVideoGoogleVideo";
        width=425;
        height=355;
    }
    if( metacafe.checked === true ) {
        link = getMetacafeVideoLink( url );
        css="ltVideoMetacafe";
        width=400;
        height=345;
    }
    if( ifilm.checked === true ) {
        link = getiFilmVideoLink( url );
        css="ltVideoIfilm";
        width=448;
        height=365;
    }
    if( goear.checked === true ) {
        link = getGoearVideoLink( url );
        css="ltVideoGoear";
        width=366;
        height=75;
    }
    if( grouper.checked === true ) {
        link = getGrouperVideoLink( url );
        css="ltVideoGrouper";
        width=496;
        height=398;
    }
    if( dailymot.checked === true ) {
        result = getDailymotionLink( url );
        width = result[1];
        height = result[2];
        link = result[3];
        css="ltVideoDailymot";
    }
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
