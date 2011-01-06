/*
  DO NOT EDIT THIS SOURCE, Try README in Perfidies instead
  Source code built from http://github.com/ozten/Perfidies-of-the-Web
  which reuses:
   jQuery Copyright (c) 2009 John Resig  http://jquery.com/
   PluginDetect Eric Gerds http://www.pinlady.net/PluginDetect/
   BrowserDetect PPK http://www.quirksmode.org/js/detect.html
   jquery.jsonp 1.1.0 (c)2009 Julian Aubourg | MIT License http://code.google.com/p/jquery-jsonp/
*/
;// Version: 38c6d94a4a2de877004a7c757a2efcae -
/*jslint browser: true, plusplus: false */
/*global Pfs, PluginDetect, window*/
// jslint that we should fix below
/*jslint eqeqeq: false*/

/**
 * Browser detection based on QuirksMode code
 *
 * See also: http://www.quirksmode.org/js/detect.html
 * License: http://www.quirksmode.org/about/copyright.html
 */
/*jslint laxbreak: true */
window.BrowserDetect = {
    detect: function () {
        return {
            browser: 
                this.searchString(this.dataBrowser) || "???",
            version: 
                this.searchRev(this.versionSearchString, navigator.userAgent)
                || this.searchRev(this.versionSearchString, navigator.appVersion)
                || "???",
            build: 
                navigator.buildID
                || this.searchRev(this.buildSearchString, navigator.userAgent)
                || this.searchRev(this.buildSearchString, navigator.appVersion)
                || "???",
            os: 
                this.searchString(this.dataOS) || "???"
        };
    },
    searchString: function (data) {
        var i, dataString, dataProp;
        for (i = 0; i < data.length; i++) {
            dataString = data[i].string;
            dataProp = data[i].prop;
            this.versionSearchString = data[i].versionSearch || data[i].identity;
            this.buildSearchString = data[i].buildSearch || data[i].identity;
            if (dataString) {
                if (dataString.indexOf(data[i].subString) != -1) {
                    return data[i].identity;
                }
            } else if (dataProp) {
                return data[i].identity;
            }
        }
        return undefined;
    },
    searchRev: function (searchString, dataString) {
        var index = dataString.indexOf(searchString),
	    val;
        if (index == -1) {
            return undefined;
        }
        val = dataString.substring(index + searchString.length + 1);
        return val.split(' ')[0];
    },
    dataBrowser: [
        {
            string: navigator.userAgent,
            subString: "Chrome",
            identity: "Chrome"
        },
        {
            string: navigator.userAgent,
            subString: "OmniWeb",
            versionSearch: "OmniWeb/",
            identity: "OmniWeb"
        },
        {
            string: navigator.vendor,
            subString: "Apple",
            identity: "Safari",
            versionSearch: "Version",
            buildSearch: "Safari"
        },
        {
            prop: window.opera,
            identity: "Opera",
            buildSearch: "Presto"
        },
        {	    
            string: navigator.vendor,
            subString: "iCab",
            identity: "iCab"
        },
        {
            string: navigator.vendor,
            subString: "KDE",
            identity: "Konqueror"
        },
        {
            string: navigator.userAgent,
            subString: "Firefox",
            identity: "Firefox"
        },
        {
            string: navigator.userAgent,
            subString: "Minefield",
            identity: "Minefield",
            versionSearch: "Minefield"
        },
        {
            string: navigator.vendor,
            subString: "Camino",
            identity: "Camino"
        },
        {
            // for newer Netscapes (6+)
            string: navigator.userAgent,
            subString: "Netscape",
            identity: "Netscape"
        },
        {
            string: navigator.userAgent,
            subString: "MSIE",
            identity: "Explorer",
            versionSearch: "MSIE"
        },
        {
            string: navigator.userAgent,
            subString: "Gecko",
            identity: "Mozilla",
            versionSearch: "rv"
        },
        { 
            // for older Netscapes (4-)
            string: navigator.userAgent,
            subString: "Mozilla",
            identity: "Netscape",
            versionSearch: "Mozilla"
        }
    ],
    dataOS : [
        {
            string: navigator.platform,
            subString: "Win",
            identity: "Windows"
        },
        {
            string: navigator.platform,
            subString: "Mac",
            identity: "Mac"
        },
        {
            string: navigator.userAgent,
            subString: "iPhone",
            identity: "iPhone/iPod"
        },
        {
            string: navigator.platform,
            subString: "Linux",
            identity: "Linux"
        }
    ]
};
/* PluginDetect v0.7.0 by Eric Gerds www.pinlady.net/PluginDetect [ onWindowLoaded getVersion Java(OTF) QT DevalVR Shockwave Flash WMP Silverlight VLC ] */var PluginDetect={handler:function(c,b,a){return function(){c(b,a)}},isDefined:function(b){return typeof b!="undefined"},isArray:function(b){return(b&&b.constructor===Array)},isFunc:function(b){return typeof b=="function"},isString:function(b){return typeof b=="string"},num:function(a){return(this.isString(a)&&(/\d/).test(a))},getNumRegx:/[\d][\d\.\_,-]*/,splitNumRegx:/[\.\_,-]/g,getNum:function(b,c){var d=this,a=d.num(b)?(d.isDefined(c)?new RegExp(c):d.getNumRegx).exec(b):null;return a?a[0].replace(d.splitNumRegx,","):null},compareNums:function(h,f,d){var e=this,c,b,a,g=parseInt;if(e.num(h)&&e.num(f)){if(e.isDefined(d)&&d.compareNums){return d.compareNums(h,f)}c=h.split(e.splitNumRegx);b=f.split(e.splitNumRegx);for(a=0;a<Math.min(c.length,b.length);a++){if(g(c[a],10)>g(b[a],10)){return 1}if(g(c[a],10)<g(b[a],10)){return -1}}}return 0},formatNum:function(b){var c=this,a,d;if(!c.num(b)){return null}d=b.replace(/\s/g,"").split(c.splitNumRegx).concat(["0","0","0","0"]);for(a=0;a<4;a++){if(/^(0+)(.+)$/.test(d[a])){d[a]=RegExp.$2}}if(!(/\d/).test(d[0])){d[0]="0"}return d.slice(0,4).join(",")},$$hasMimeType:function(a){return function(d){if(!a.isIE){var c,b,e,f=a.isString(d)?[d]:d;for(e=0;e<f.length;e++){c=navigator.mimeTypes[f[e]];if(c&&(b=c.enabledPlugin)){if(b.name||b.description){return c}}}}return null}},findNavPlugin:function(g,d){var a=this.isString(g)?g:g.join(".*"),e=d===false?"":"\\d",b,c=new RegExp(a+".*"+e+"|"+e+".*"+a,"i"),f=navigator.plugins;for(b=0;b<f.length;b++){if(c.test(f[b].description)||c.test(f[b].name)){return f[b]}}return null},AXO:window.ActiveXObject,getAXO:function(b,a){var g=null,f,d=false,c=this;try{g=new c.AXO(b);d=true}catch(f){}if(c.isDefined(a)){delete g;return d}return g},convertFuncs:function(f){var a,g,d,b=/^[\$][\$]/,c={};for(a in f){if(b.test(a)){c[a]=1}}for(a in c){try{g=a.slice(2);if(g.length>0&&!f[g]){f[g]=f[a](f)}}catch(d){}}},initScript:function(){var $=this,nav=navigator,userAgent=(nav&&$.isString(nav.userAgent)?nav.userAgent:""),vendor=(nav&&$.isString(nav.vendor)?nav.vendor:"");$.convertFuncs($);$.isIE=/*@cc_on!@*/false;$.IEver=$.isIE&&((/MSIE\s*(\d\.?\d*)/i).exec(userAgent))?parseFloat(RegExp.$1,10):-1;$.ActiveXEnabled=false;if($.isIE){var x,progid=["Msxml2.XMLHTTP","Msxml2.DOMDocument","Microsoft.XMLDOM","ShockwaveFlash.ShockwaveFlash","TDCCtl.TDCCtl","Shell.UIHelper","Scripting.Dictionary","wmplayer.ocx"];for(x=0;x<progid.length;x++){if($.getAXO(progid[x],1)){$.ActiveXEnabled=true;break}}$.head=$.isDefined(document.getElementsByTagName)?document.getElementsByTagName("head")[0]:null}$.isGecko=!$.isIE&&$.isString(navigator.product)&&(/Gecko/i).test(navigator.product)&&(/Gecko\s*\/\s*\d/i).test(userAgent);$.GeckoRV=$.isGecko?$.formatNum((/rv\s*\:\s*([\.\,\d]+)/i).test(userAgent)?RegExp.$1:"0.9"):null;$.isSafari=!$.isIE&&(/Safari\s*\/\s*\d/i).test(userAgent)&&(/Apple/i).test(vendor);$.isChrome=!$.isIE&&(/Chrome\s*\/\s*\d/i).test(userAgent);$.isOpera=!$.isIE&&(/Opera\s*[\/]?\s*\d/i).test(userAgent);$.addWinEvent("load",$.handler($.runWLfuncs,$))},init:function(d,a){var c=this,b;if(!c.isString(d)){return -3}if(d.length==1){c.getVersionDelimiter=d;return -3}d=d.toLowerCase().replace(/\s/g,"");if(!c.isDefined(c[d])){return -3}b=c[d];c.plugin=b;if(!c.isDefined(b.installed)||a==true){b.installed=b.version=b.version0=b.getVersionDone=null;b.$=c}c.garbage=false;if(c.isIE&&!c.ActiveXEnabled){if(b!==c.java){return -2}}return 1},fPush:function(b,a){var c=this;if(c.isArray(a)&&(c.isFunc(b)||(c.isArray(b)&&b.length>0&&c.isFunc(b[0])))){a[a.length]=b}},callArray:function(b){var c=this,a;if(c.isArray(b)){for(a=0;a<b.length;a++){if(b[a]===null){return}c.call(b[a]);b[a]=null}}},call:function(c){var b=this,a=b.isArray(c)?c.length:-1;if(a>0&&b.isFunc(c[0])){c[0](b,a>1?c[1]:0,a>2?c[2]:0,a>3?c[3]:0)}else{if(b.isFunc(c)){c(b)}}},getVersionDelimiter:",",$$getVersion:function(a){return function(g,d,c){var e=a.init(g),f,b;if(e<0){return null}f=a.plugin;if(f.getVersionDone!=1){f.getVersion(d,c);if(f.getVersionDone===null){f.getVersionDone=1}}a.cleanup();b=(f.version||f.version0);return b?b.replace(a.splitNumRegx,a.getVersionDelimiter):b}},cleanup:function(){var a=this;if(a.garbage&&a.isDefined(window.CollectGarbage)){window.CollectGarbage()}},isActiveXObject:function(b){var d=this,a,g,f="/",c='<object width="1" height="1" style="display:none" '+d.plugin.getCodeBaseVersion(b)+">"+d.plugin.HTML+"<"+f+"object>";if(d.head.firstChild){d.head.insertBefore(document.createElement("object"),d.head.firstChild)}else{d.head.appendChild(document.createElement("object"))}d.head.firstChild.outerHTML=c;try{d.head.firstChild.classid=d.plugin.classID}catch(g){}a=false;try{if(d.head.firstChild.object){a=true}}catch(g){}try{if(a&&d.head.firstChild.readyState<4){d.garbage=true}}catch(g){}d.head.removeChild(d.head.firstChild);return a},codebaseSearch:function(c){var e=this;if(!e.ActiveXEnabled){return null}if(e.isDefined(c)){return e.isActiveXObject(c)}var j=[0,0,0,0],g,f,b=e.plugin.digits,i=function(k,l){return e.isActiveXObject((k==0?l:j[0])+","+(k==1?l:j[1])+","+(k==2?l:j[2])+","+(k==3?l:j[3]))},h,d,a=false;for(g=0;g<b.length;g++){h=b[g]*2;j[g]=0;for(f=0;f<20;f++){if(h==1&&g>0&&a){break}if(h-j[g]>1){d=Math.round((h+j[g])/2);if(i(g,d)){j[g]=d;a=true}else{h=d}}else{if(h-j[g]==1){h--;if(!a&&i(g,h)){a=true}break}else{if(!a&&i(g,h)){a=true}break}}}if(!a){return null}}return j.join(",")},addWinEvent:function(d,c){var e=this,a=window,b;if(e.isFunc(c)){if(a.addEventListener){a.addEventListener(d,c,false)}else{if(a.attachEvent){a.attachEvent("on"+d,c)}else{b=a["on"+d];a["on"+d]=e.winHandler(c,b)}}}},winHandler:function(d,c){return function(){d();if(typeof c=="function"){c()}}},WLfuncs:[0],runWLfuncs:function(a){a.winLoaded=true;a.callArray(a.WLfuncs);if(a.onDoneEmptyDiv){a.onDoneEmptyDiv()}},winLoaded:false,$$onWindowLoaded:function(a){return function(b){if(a.winLoaded){a.call(b)}else{a.fPush(b,a.WLfuncs)}}},div:null,divWidth:50,pluginSize:1,emptyDiv:function(){var c=this,a,d,b;if(c.div&&c.div.childNodes){for(a=c.div.childNodes.length-1;a>=0;a--){b=c.div.childNodes[a];if(b&&b.childNodes){for(d=b.childNodes.length-1;d>=0;d--){b.removeChild(b.childNodes[d])}c.div.removeChild(b)}}}},onDoneEmptyDiv:function(){var a=this;if(!a.winLoaded){return}if(a.WLfuncs&&a.WLfuncs.length>0&&a.isFunc(a.WLfuncs[a.WLfuncs.length-1])){return}if(a.java){if(a.java.OTF==3){return}if(a.java.funcs&&a.java.funcs.length>0&&a.isFunc(a.java.funcs[a.java.funcs.length-1])){return}}a.emptyDiv()},getObject:function(c,a){var g,d=this,f=null,b=d.getContainer(c);try{if(b&&b.firstChild){f=b.firstChild}if(a&&f){f.focus()}}catch(g){}return f},getContainer:function(a){return(a&&a[0]?a[0]:null)},instantiate:function(i,c,f,a,j){var l,m=document,h=this,q,p=m.createElement("span"),o,g,n="/";var k=function(s,r){var u=s.style,d,t;if(!u){return}u.outline="none";u.border="none";u.padding="0px";u.margin="0px";u.visibility="visible";if(h.isArray(r)){for(d=0;d<r.length;d=d+2){try{u[r[d]]=r[d+1]}catch(t){}}return}},b=function(){var s,t="pd33993399",r=null,d=(m.getElementsByTagName("body")[0]||m.body);if(!d){try{m.write('<div id="'+t+'">o<'+n+"div>");r=m.getElementById(t)}catch(s){}}d=(m.getElementsByTagName("body")[0]||m.body);if(d){if(d.firstChild&&h.isDefined(d.insertBefore)){d.insertBefore(h.div,d.firstChild)}else{d.appendChild(h.div)}if(r){d.removeChild(r)}}else{}};if(!h.isDefined(a)){a=""}if(h.isString(i)&&(/[^\s]/).test(i)){q="<"+i+' width="'+h.pluginSize+'" height="'+h.pluginSize+'" ';for(o=0;o<c.length;o=o+2){if(/[^\s]/.test(c[o+1])){q+=c[o]+'="'+c[o+1]+'" '}}q+=">";for(o=0;o<f.length;o=o+2){if(/[^\s]/.test(f[o+1])){q+='<param name="'+f[o]+'" value="'+f[o+1]+'" />'}}q+=a+"<"+n+i+">"}else{q=a}if(!h.div){h.div=m.createElement("div");g=m.getElementById("plugindetect");if(g){h.div=g}else{h.div.id="plugindetect";b()}k(h.div,["width",h.divWidth+"px","height",(h.pluginSize+3)+"px","fontSize",(h.pluginSize+3)+"px","lineHeight",(h.pluginSize+3)+"px","verticalAlign","baseline","display","block"]);if(!g){k(h.div,["position","absolute","right","0px","top","0px"])}}if(h.div&&h.div.parentNode){h.div.appendChild(p);k(p,["fontSize",(h.pluginSize+3)+"px","lineHeight",(h.pluginSize+3)+"px","verticalAlign","baseline","display","inline"]);try{if(p&&p.parentNode){p.focus()}}catch(l){}try{p.innerHTML=q}catch(l){}if(p.childNodes.length==1){k(p.childNodes[0],["display","inline"])}return[p]}return[null]},quicktime:{mimeType:["video/quicktime","application/x-quicktimeplayer","image/x-macpaint","image/x-quicktime"],progID:"QuickTimeCheckObject.QuickTimeCheck.1",progID0:"QuickTime.QuickTime",classID:"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B",minIEver:7,HTML:'<param name="src" value="A14999.mov" /><param name="controller" value="false" />',getCodeBaseVersion:function(a){return'codebase="#version='+a+'"'},digits:[8,64,16,0],getVersion:function(){var c=null,f,d=this.$,g=true;if(!d.isIE){if(navigator.platform&&(/linux/i).test(navigator.platform)){g=false}if(g){f=d.findNavPlugin(["QuickTime","(Plug-in|Plugin)"]);if(f&&f.name&&d.hasMimeType(this.mimeType)){c=d.getNum(f.name)}}this.installed=c?1:-1}else{var e;if(d.IEver>=this.minIEver&&d.getAXO(this.progID0,1)){c=d.codebaseSearch()}else{e=d.getAXO(this.progID);if(e&&e.QuickTimeVersion){c=e.QuickTimeVersion.toString(16);c=c.charAt(0)+"."+c.charAt(1)+"."+c.charAt(2)}}this.installed=c?1:(d.getAXO(this.progID0,1)?0:-1)}c=d.formatNum(c);if(c){var b=c.split(d.splitNumRegx);if(d.isIE&&d.compareNums(c,"7,50,0,0")>=0&&d.compareNums(c,"7,60,0,0")<0){b=[b[0],b[1].charAt(0),b[1].charAt(1),b[2]]}b[3]="0";c=b.join(",")}this.version=d.formatNum(c)}},java:{mimeType:"application/x-java-applet",classID:"clsid:8AD9C840-044E-11D1-B3E9-00805F499D93",DTKclassID:"clsid:CAFEEFAC-DEC7-0000-0000-ABCDEFFEDCBA",DTKmimeType:["application/java-deployment-toolkit","application/npruntime-scriptable-plugin;DeploymentToolkit"],JavaVersions:[[1,9,2,30],[1,8,2,30],[1,7,2,30],[1,6,1,30],[1,5,1,30],[1,4,2,30],[1,3,1,30]],searchJavaPluginAXO:function(){var h=null,a=this,c=a.$,g=[],j=[1,5,0,14],i=[1,6,0,2],f=[1,3,1,0],e=[1,4,2,0],d=[1,5,0,7],b=false;if(!c.ActiveXEnabled){return null};if(c.IEver>=a.minIEver){g=a.searchJavaAXO(i,i,b);if(g.length>0&&b){g=a.searchJavaAXO(j,j,b)}}else{if(g.length==0){g=a.searchJavaAXO(f,e,false)}}if(g.length>0){h=g[0]}a.JavaPlugin_versions=[].concat(g);return h},searchJavaAXO:function(l,i,m){var n,f,h=this.$,p,k,a,e,g,j,b,q=[];if(h.compareNums(l.join(","),i.join(","))>0){i=l}i=h.formatNum(i.join(","));var o,d="1,4,2,0",c="JavaPlugin."+l[0]+""+l[1]+""+l[2]+""+(l[3]>0?("_"+(l[3]<10?"0":"")+l[3]):"");for(n=0;n<this.JavaVersions.length;n++){f=this.JavaVersions[n];p="JavaPlugin."+f[0]+""+f[1];g=f[0]+"."+f[1]+".";for(a=f[2];a>=0;a--){b="JavaWebStart.isInstalled."+g+a+".0";if(h.compareNums(f[0]+","+f[1]+","+a+",0",i)>=0&&!h.getAXO(b,1)){continue}o=h.compareNums(f[0]+","+f[1]+","+a+",0",d)<0?true:false;for(e=f[3];e>=0;e--){k=a+"_"+(e<10?"0"+e:e);j=p+k;if(h.getAXO(j,1)&&(o||h.getAXO(b,1))){q[q.length]=g+k;if(!m){return q}}if(j==c){return q}}if(h.getAXO(p+a,1)&&(o||h.getAXO(b,1))){q[q.length]=g+a;if(!m){return q}}if(p+a==c){return q}}}return q},minIEver:7,getFromMimeType:function(a){var h,f,c=this.$,j=new RegExp(a),d,k,i={},e=0,b,g=[""];for(h=0;h<navigator.mimeTypes.length;h++){k=navigator.mimeTypes[h];if(j.test(k.type)&&k.enabledPlugin){k=k.type.substring(k.type.indexOf("=")+1,k.type.length);d="a"+c.formatNum(k);if(!c.isDefined(i[d])){i[d]=k;e++}}}for(f=0;f<e;f++){b="0,0,0,0";for(h in i){if(i[h]){d=h.substring(1,h.length);if(c.compareNums(d,b)>0){b=d}}}g[f]=i["a"+b];i["a"+b]=null}if(!(/windows|macintosh/i).test(navigator.userAgent)){g=[g[0]]}return g},queryJavaHandler:function(c){var b=c.java,a=window.java,d;b.hasRun=true;try{if(c.isDefined(a.lang)&&c.isDefined(a.lang.System)){b.value=[a.lang.System.getProperty("java.version")+" ",a.lang.System.getProperty("java.vendor")+" "]}}catch(d){}},queryJava:function(){var c=this,d=c.$,b=navigator.userAgent,f;if(d.isDefined(window.java)&&navigator.javaEnabled()&&!c.hasRun){if(d.isGecko){if(d.hasMimeType("application/x-java-vm")){try{var g=document.createElement("div"),a=document.createEvent("HTMLEvents");a.initEvent("focus",false,true);g.addEventListener("focus",d.handler(c.queryJavaHandler,d),false);g.dispatchEvent(a)}catch(f){}if(!c.hasRun){c.queryJavaHandler(d)}}}else{if((/opera.9\.(0|1)/i).test(b)&&(/mac/i).test(b)){}else{if(!c.hasRun){c.queryJavaHandler(d)}}}}return c.value},forceVerifyTag:[],jar:[],VENDORS:["Sun Microsystems Inc.","Apple Computer, Inc."],init:function(){var a=this,b=a.$;a.hasRun=false;a.value=[null,null];a.tryApplet=[2,2,2];a.DOMobj=[0,0,0,0,0,0];a.Applet0Index=3;a.queryDTKresult=null;a.OTF=0;a.BridgeResult=[[null,null],[null,null],[null,null]];a.JavaActive=[0,0,0];a.All_versions=[];a.DeployTK_versions=[];a.MimeType_versions=[];a.JavaPlugin_versions=[];a.funcs=[];var c=a.NOTF;if(c){c.$=b;if(c.javaInterval){clearInterval(c.javaInterval)}c.EventJavaReady=null;c.javaInterval=null;c.count=0;c.intervalLength=250;c.countMax=33}},getVersion:function(e,j){var g,d=this,f=d.$,i=vendor=versionEnabled=null,c=navigator.javaEnabled();if(d.getVersionDone===null){d.init()}var k;if(f.isArray(j)){for(k=0;k<d.tryApplet.length;k++){if(typeof j[k]=="number"){d.tryApplet[k]=j[k]}}}for(k=0;k<d.forceVerifyTag.length;k++){d.tryApplet[k]=d.forceVerifyTag[k]}if(f.isString(e)){d.jar[d.jar.length]=e}if(d.getVersionDone==0){if(!d.version||d.useAnyTag()){g=d.queryExternalApplet(e);if(g[0]){d.installed=1;d.EndGetVersion(g[0],g[1])}}return}var h=d.queryDeploymentToolKit();if(f.num(h)){i=h;vendor=d.VENDORS[0]}if(!f.isIE){var n,l,b,m,a;a=f.hasMimeType(d.mimeType);m=(a&&c)?true:false;if(d.MimeType_versions.length==0&&a){g=d.getFromMimeType("application/x-java-applet.*jpi-version.*=");if(g[0]!=""){if(!i){i=g[0]}d.MimeType_versions=g}}if(!i&&a){g="Java[^\\d]*Plug-in";b=f.findNavPlugin(g);if(b){g=new RegExp(g,"i");n=g.test(b.description)?f.getNum(b.description):null;l=g.test(b.name)?f.getNum(b.name):null;if(n&&l){i=(f.compareNums(f.formatNum(n),f.formatNum(l))>=0)?n:l}else{i=n||l}}}if(!i&&a&&(/macintosh.*safari/i).test(navigator.userAgent)){b=f.findNavPlugin("Java.*\\d.*Plug-in.*Cocoa",false);if(b){n=f.getNum(b.description);if(n){i=n}}}if(i){d.version0=i;if(c){versionEnabled=i}}if(!versionEnabled||d.useAnyTag()){b=d.queryExternalApplet(e);if(b[0]){versionEnabled=b[0];vendor=b[1]}}if(!versionEnabled){b=d.queryJava();if(b[0]){d.version0=b[0];versionEnabled=b[0];vendor=b[1];if(d.installed==-0.5){d.installed=0.5}}}if(d.installed===null&&!versionEnabled&&m&&!(/macintosh.*ppc/i).test(navigator.userAgent)){g=d.getFromMimeType("application/x-java-applet.*version.*=");if(g[0]!=""){versionEnabled=g[0]}}if(!versionEnabled&&m){if(/macintosh.*safari/i.test(navigator.userAgent)){if(d.installed===null){d.installed=0}else{if(d.installed==-0.5){d.installed=0.5}}}}}else{if(!i&&h!=-1){i=d.searchJavaPluginAXO();if(i){vendor=d.VENDORS[0]}}if(!i){d.JavaFix()}if(i){d.version0=i;if(c&&f.ActiveXEnabled){versionEnabled=i}}if(!versionEnabled||d.useAnyTag()){g=d.queryExternalApplet(e);if(g[0]){versionEnabled=g[0];vendor=g[1]}}}if(d.installed===null){d.installed=versionEnabled?1:(i?-0.2:-1)}d.EndGetVersion(versionEnabled,vendor)},EndGetVersion:function(b,d){var a=this,c=a.$;if(a.version0){a.version0=c.formatNum(c.getNum(a.version0))}if(b){a.version=c.formatNum(c.getNum(b));a.vendor=(c.isString(d)?d:"")}if(a.getVersionDone!=1){a.getVersionDone=0}},queryDeploymentToolKit:function(){var d=this,g=d.$,i,b,c,h=null,a=null;if((g.isGecko&&g.compareNums(g.GeckoRV,g.formatNum("1.6"))<=0)||g.isSafari||(g.isIE&&!g.ActiveXEnabled)){d.queryDTKresult=0}if(d.queryDTKresult!==null){return d.queryDTKresult}if(g.isIE&&g.IEver>=6){d.DOMobj[0]=g.instantiate("object",[],[]);h=g.getObject(d.DOMobj[0])}else{if(!g.isIE&&(c=g.hasMimeType(d.DTKmimeType))&&c.type){d.DOMobj[0]=g.instantiate("object",["type",c.type],[]);h=g.getObject(d.DOMobj[0])}}if(h){if(g.isIE&&g.IEver>=6){try{h.classid=d.DTKclassID}catch(i){}}try{var c,f=h.jvms;if(f){a=f.getLength();if(typeof a=="number"){for(b=0;b<a;b++){c=f.get(a-1-b);if(c){c=c.version;if(g.getNum(c)){d.DeployTK_versions[b]=c}}}}}}catch(i){}}d.queryDTKresult=d.DeployTK_versions.length>0?d.DeployTK_versions[0]:(a==0?-1:0);return d.queryDTKresult},queryExternalApplet:function(g){var d=this,i=d.$,l=d.BridgeResult,c=d.DOMobj,k=d.Applet0Index,a="&nbsp;&nbsp;&nbsp;&nbsp;",f="A.class";if(!i.isString(g)||!(/\.jar\s*$/).test(g)||(/\\/).test(g)){return[null,null]}if(d.OTF<1){d.OTF=1}if((i.isGecko||i.isChrome||(i.isOpera&&!navigator.javaEnabled()))&&!i.hasMimeType(d.mimeType)&&!d.queryJava()[0]){return[null,null]}if(d.OTF<2){d.OTF=2}if(!c[1]&&d.canUseObjectTag()){c[1]=i.instantiate("object",[],[],a)}if(!c[2]){c[2]=i.instantiate("",[],[],a)}var n=g,h="",q;if((/[\/]/).test(g)){q=g.split("/");n=q[q.length-1];q[q.length-1]="";h=q.join("/")}var e=["archive",n,"code",f],b=["mayscript","true"],p=["scriptable","true"].concat(b);if(!c[k]&&d.canUseObjectTag()&&d.canTryApplet(0)){c[k]=i.isIE?i.instantiate("object",["type",d.mimeType].concat(e),["codebase",h].concat(e).concat(p),a,d):i.instantiate("object",["type",d.mimeType,"archive",n,"classid","java:"+f],["codebase",h,"archive",n].concat(p),a,d);l[0]=[0,0];d.query1Applet(k)}if(!c[k+1]&&d.canUseAppletTag()&&d.canTryApplet(1)){c[k+1]=i.isIE?i.instantiate("applet",["alt",a].concat(b).concat(e),["codebase",h].concat(b),a,d):i.instantiate("applet",["codebase",h,"alt",a].concat(b).concat(e),[].concat(b),a,d);l[1]=[0,0];d.query1Applet(k+1)}if(!c[k+2]&&d.canUseObjectTag()&&d.canTryApplet(2)){c[k+2]=i.isIE?i.instantiate("object",["classid",d.classID],["codebase",h].concat(e).concat(p),a,d):i.instantiate();l[2]=[0,0];d.query1Applet(k+2)};var o,j=0;for(o=0;o<l.length;o++){if(c[k+o]||d.canTryApplet(o)){j++}else{break}}if(j==l.length){d.getVersionDone=d.forceVerifyTag.length>0?0:1}return d.getBR()},canUseAppletTag:function(){return((!this.$.isIE||navigator.javaEnabled())?true:false)},canUseObjectTag:function(){return((!this.$.isIE||this.$.ActiveXEnabled)?true:false)},useAnyTag:function(){var b=this,a;for(a=0;a<b.tryApplet.length;a++){if(b.canTryApplet(a)){return true}}return false},canTryApplet:function(c){var a=this,b=a.$;if(a.tryApplet[c]==3){return true}if(!a.version0||!navigator.javaEnabled()||(b.isIE&&!b.ActiveXEnabled)){if(a.tryApplet[c]==2){return true}if(a.tryApplet[c]==1&&!a.getBR()[0]){return true}}return false},getBR:function(){var b=this.BridgeResult,a;for(a=0;a<b.length;a++){if(b[a][0]){return[b[a][0],b[a][1]]}}return[b[0][0],b[0][1]]},query1Applet:function(g){var f,c=this,d=c.$,a=vendor=null,b=d.getObject(c.DOMobj[g],true);if(b){try{a=b.getVersion()+" ";vendor=b.getVendor()+" ";b.statusbar(d.winLoaded?" ":" ")}catch(f){}if(d.num(a)){c.BridgeResult[g-c.Applet0Index]=[a,vendor]}try{if(d.isIE&&a&&b.readyState!=4){d.garbage=true;b.parentNode.removeChild(b)}}catch(f){}}},append:function(e,d){for(var c=0;c<d.length;c++){e[e.length]=d[c]}},JavaFix:function(){}},devalvr:{mimeType:"application/x-devalvrx",progID:"DevalVRXCtrl.DevalVRXCtrl.1",classID:"clsid:5D2CF9D0-113A-476B-986F-288B54571614",getVersion:function(){var a=null,g,c=this.$,f;if(!c.isIE){g=c.findNavPlugin("DevalVR");if(g&&g.name&&c.hasMimeType(this.mimeType)){a=g.description.split(" ")[3]}this.installed=a?1:-1}else{var b,h,d;h=c.getAXO(this.progID,1);if(h){b=c.instantiate("object",["classid",this.classID],["src",""],"",this);d=c.getObject(b);if(d){try{if(d.pluginversion){a="00000000"+d.pluginversion.toString(16);a=a.substr(a.length-8,8);a=parseInt(a.substr(0,2),16)+","+parseInt(a.substr(2,2),16)+","+parseInt(a.substr(4,2),16)+","+parseInt(a.substr(6,2),16)}}catch(f){}}}this.installed=a?1:(h?0:-1)}this.version=c.formatNum(a)}},flash:{mimeType:["application/x-shockwave-flash","application/futuresplash"],progID:"ShockwaveFlash.ShockwaveFlash",classID:"clsid:D27CDB6E-AE6D-11CF-96B8-444553540000",getVersion:function(){var c=function(i){if(!i){return null}var e=/[\d][\d\,\.\s]*[rRdD]{0,1}[\d\,]*/.exec(i);return e?e[0].replace(/[rRdD\.]/g,",").replace(/\s/g,""):null};var j,g=this.$,h,f,b=null,a=null,d=null;if(!g.isIE){j=g.findNavPlugin("Flash");if(j&&j.description&&g.hasMimeType(this.mimeType)){b=c(j.description)}}else{for(f=15;f>2;f--){a=g.getAXO(this.progID+"."+f);if(a){d=f.toString();break}}if(d=="6"){try{a.AllowScriptAccess="always"}catch(h){return"6,0,21,0"}}try{b=c(a.GetVariable("$version"))}catch(h){}if(!b&&d){b=d}}this.installed=b?1:-1;this.version=g.formatNum(b);return true}},shockwave:{mimeType:"application/x-director",progID:"SWCtl.SWCtl",classID:"clsid:166B1BCA-3F9C-11CF-8075-444553540000",getVersion:function(){var a=null,b=null,f,d,c=this.$;if(!c.isIE){d=c.findNavPlugin("Shockwave for Director");if(d&&d.description&&c.hasMimeType(this.mimeType)){a=c.getNum(d.description)}}else{try{b=c.getAXO(this.progID).ShockwaveVersion("")}catch(f){}if(c.isString(b)&&b.length>0){a=c.getNum(b)}else{if(c.getAXO(this.progID+".8",1)){a="8"}else{if(c.getAXO(this.progID+".7",1)){a="7"}else{if(c.getAXO(this.progID+".1",1)){a="6"}}}}}this.installed=a?1:-1;this.version=c.formatNum(a)}},windowsmediaplayer:{mimeType:["application/x-mplayer2","application/asx"],progID:"wmplayer.ocx",classID:"clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6",getVersion:function(){var a=null,e=this.$,b=null;this.installed=-1;if(!e.isIE){if(e.hasMimeType(this.mimeType)){if(e.findNavPlugin(["Windows","Media","(Plug-in|Plugin)"],false)||e.findNavPlugin(["Flip4Mac","Windows","Media"],false)){this.installed=0}var d=e.isGecko&&e.compareNums(e.GeckoRV,e.formatNum("1.8"))<0;if(!d&&e.findNavPlugin(["Windows","Media","Firefox Plugin"],false)){var c=e.instantiate("object",["type",this.mimeType[0]],[],"",this),f=e.getObject(c);if(f){a=f.versionInfo}}}}else{b=e.getAXO(this.progID);if(b){a=b.versionInfo}}if(a){this.installed=1}this.version=e.formatNum(a)}},silverlight:{mimeType:"application/x-silverlight",progID:"AgControl.AgControl",digits:[9,20,9,12,31],getVersion:function(){var e=this.$,j=document,i=null,c=null,h=false,b=[1,0,1,1,1],r=[1,0,1,1,1],k=function(d){return(d<10?"0":"")+d.toString()},n=function(s,d,u,v,t){return(s+"."+d+"."+u+k(v)+k(t)+".0")},o=function(d,s){return q((d==0?s:r[0]),(d==1?s:r[1]),(d==2?s:r[2]),(d==3?s:r[3]),(d==4?s:r[4]))},q=function(t,s,w,v,u){var u;try{return c.IsVersionSupported(n(t,s,w,v,u))}catch(u){}return false};if(!e.isIE){var a=[null,null],f=e.findNavPlugin("Silverlight Plug-in",false),g=e.isGecko&&e.compareNums(e.GeckoRV,e.formatNum("1.6"))<=0;if(f&&e.hasMimeType(this.mimeType)){i=e.formatNum(f.description);if(i){r=i.split(e.splitNumRegx);if(parseInt(r[2],10)>=30226&&parseInt(r[0],10)<2){r[0]="2"}i=r.join(",")}if(e.isGecko&&!g){h=true}if(!h&&!g&&i){a=e.instantiate("object",["type",this.mimeType],[],"",this);c=e.getObject(a);if(c){if(q(b[0],b[1],b[2],b[3],b[4])){h=true}if(!h){c.data="data:"+this.mimeType+",";if(q(b[0],b[1],b[2],b[3],b[4])){h=true}}}}}}else{c=e.getAXO(this.progID);var m,l,p;if(c&&q(b[0],b[1],b[2],b[3],b[4])){for(m=0;m<this.digits.length;m++){p=r[m];for(l=p+(m==0?0:1);l<=this.digits[m];l++){if(o(m,l)){h=true;r[m]=l}else{break}}if(!h){break}}if(h){i=n(r[0],r[1],r[2],r[3],r[4])}}}this.installed=h&&i?1:(i?-0.2:-1);this.version=e.formatNum(i)}},vlc:{mimeType:"application/x-vlc-plugin",progID:"VideoLAN.VLCPlugin",compareNums:function(e,d){var c=this.$,k=e.split(c.splitNumRegx),i=d.split(c.splitNumRegx),h,b,a,g,f,j;for(h=0;h<Math.min(k.length,i.length);h++){j=/([\d]+)([a-z]?)/.test(k[h]);b=parseInt(RegExp.$1,10);g=(h==2&&RegExp.$2.length>0)?RegExp.$2.charCodeAt(0):-1;j=/([\d]+)([a-z]?)/.test(i[h]);a=parseInt(RegExp.$1,10);f=(h==2&&RegExp.$2.length>0)?RegExp.$2.charCodeAt(0):-1;if(b!=a){return(b>a?1:-1)}if(h==2&&g!=f){return(g>f?1:-1)}}return 0},getVersion:function(){var b=this.$,d,a=null,c;if(!b.isIE){if(b.hasMimeType(this.mimeType)){d=b.findNavPlugin(["VLC","(Plug-in|Plugin)"],false);if(d&&d.description){a=b.getNum(d.description,"[\\d][\\d\\.]*[a-z]*")}}this.installed=a?1:-1}else{d=b.getAXO(this.progID);if(d){try{a=b.getNum(d.VersionInfo,"[\\d][\\d\\.]*[a-z]*")}catch(c){}}this.installed=d?1:-1}this.version=b.formatNum(a)}},zz:0};PluginDetect.initScript();/*
 * jQuery JavaScript Library v1.3.2
 * http://jquery.com/
 *
 * Copyright (c) 2009 John Resig
 * Dual licensed under the MIT and GPL licenses.
 * http://docs.jquery.com/License
 *
 * Date: 2009-02-19 17:34:21 -0500 (Thu, 19 Feb 2009)
 * Revision: 6246
 */
(function(){var l=this,g,y=l.jQuery,p=l.$,o=l.jQuery=l.$=function(E,F){return new o.fn.init(E,F)},D=/^[^<]*(<(.|\s)+>)[^>]*$|^#([\w-]+)$/,f=/^.[^:#\[\.,]*$/;o.fn=o.prototype={init:function(E,H){E=E||document;if(E.nodeType){this[0]=E;this.length=1;this.context=E;return this}if(typeof E==="string"){var G=D.exec(E);if(G&&(G[1]||!H)){if(G[1]){E=o.clean([G[1]],H)}else{var I=document.getElementById(G[3]);if(I&&I.id!=G[3]){return o().find(E)}var F=o(I||[]);F.context=document;F.selector=E;return F}}else{return o(H).find(E)}}else{if(o.isFunction(E)){return o(document).ready(E)}}if(E.selector&&E.context){this.selector=E.selector;this.context=E.context}return this.setArray(o.isArray(E)?E:o.makeArray(E))},selector:"",jquery:"1.3.2",size:function(){return this.length},get:function(E){return E===g?Array.prototype.slice.call(this):this[E]},pushStack:function(F,H,E){var G=o(F);G.prevObject=this;G.context=this.context;if(H==="find"){G.selector=this.selector+(this.selector?" ":"")+E}else{if(H){G.selector=this.selector+"."+H+"("+E+")"}}return G},setArray:function(E){this.length=0;Array.prototype.push.apply(this,E);return this},each:function(F,E){return o.each(this,F,E)},index:function(E){return o.inArray(E&&E.jquery?E[0]:E,this)},attr:function(F,H,G){var E=F;if(typeof F==="string"){if(H===g){return this[0]&&o[G||"attr"](this[0],F)}else{E={};E[F]=H}}return this.each(function(I){for(F in E){o.attr(G?this.style:this,F,o.prop(this,E[F],G,I,F))}})},css:function(E,F){if((E=="width"||E=="height")&&parseFloat(F)<0){F=g}return this.attr(E,F,"curCSS")},text:function(F){if(typeof F!=="object"&&F!=null){return this.empty().append((this[0]&&this[0].ownerDocument||document).createTextNode(F))}var E="";o.each(F||this,function(){o.each(this.childNodes,function(){if(this.nodeType!=8){E+=this.nodeType!=1?this.nodeValue:o.fn.text([this])}})});return E},wrapAll:function(E){if(this[0]){var F=o(E,this[0].ownerDocument).clone();if(this[0].parentNode){F.insertBefore(this[0])}F.map(function(){var G=this;while(G.firstChild){G=G.firstChild}return G}).append(this)}return this},wrapInner:function(E){return this.each(function(){o(this).contents().wrapAll(E)})},wrap:function(E){return this.each(function(){o(this).wrapAll(E)})},append:function(){return this.domManip(arguments,true,function(E){if(this.nodeType==1){this.appendChild(E)}})},prepend:function(){return this.domManip(arguments,true,function(E){if(this.nodeType==1){this.insertBefore(E,this.firstChild)}})},before:function(){return this.domManip(arguments,false,function(E){this.parentNode.insertBefore(E,this)})},after:function(){return this.domManip(arguments,false,function(E){this.parentNode.insertBefore(E,this.nextSibling)})},end:function(){return this.prevObject||o([])},push:[].push,sort:[].sort,splice:[].splice,find:function(E){if(this.length===1){var F=this.pushStack([],"find",E);F.length=0;o.find(E,this[0],F);return F}else{return this.pushStack(o.unique(o.map(this,function(G){return o.find(E,G)})),"find",E)}},clone:function(G){var E=this.map(function(){if(!o.support.noCloneEvent&&!o.isXMLDoc(this)){var I=this.outerHTML;if(!I){var J=this.ownerDocument.createElement("div");J.appendChild(this.cloneNode(true));I=J.innerHTML}return o.clean([I.replace(/ jQuery\d+="(?:\d+|null)"/g,"").replace(/^\s*/,"")])[0]}else{return this.cloneNode(true)}});if(G===true){var H=this.find("*").andSelf(),F=0;E.find("*").andSelf().each(function(){if(this.nodeName!==H[F].nodeName){return}var I=o.data(H[F],"events");for(var K in I){for(var J in I[K]){o.event.add(this,K,I[K][J],I[K][J].data)}}F++})}return E},filter:function(E){return this.pushStack(o.isFunction(E)&&o.grep(this,function(G,F){return E.call(G,F)})||o.multiFilter(E,o.grep(this,function(F){return F.nodeType===1})),"filter",E)},closest:function(E){var G=o.expr.match.POS.test(E)?o(E):null,F=0;return this.map(function(){var H=this;while(H&&H.ownerDocument){if(G?G.index(H)>-1:o(H).is(E)){o.data(H,"closest",F);return H}H=H.parentNode;F++}})},not:function(E){if(typeof E==="string"){if(f.test(E)){return this.pushStack(o.multiFilter(E,this,true),"not",E)}else{E=o.multiFilter(E,this)}}var F=E.length&&E[E.length-1]!==g&&!E.nodeType;return this.filter(function(){return F?o.inArray(this,E)<0:this!=E})},add:function(E){return this.pushStack(o.unique(o.merge(this.get(),typeof E==="string"?o(E):o.makeArray(E))))},is:function(E){return !!E&&o.multiFilter(E,this).length>0},hasClass:function(E){return !!E&&this.is("."+E)},val:function(K){if(K===g){var E=this[0];if(E){if(o.nodeName(E,"option")){return(E.attributes.value||{}).specified?E.value:E.text}if(o.nodeName(E,"select")){var I=E.selectedIndex,L=[],M=E.options,H=E.type=="select-one";if(I<0){return null}for(var F=H?I:0,J=H?I+1:M.length;F<J;F++){var G=M[F];if(G.selected){K=o(G).val();if(H){return K}L.push(K)}}return L}return(E.value||"").replace(/\r/g,"")}return g}if(typeof K==="number"){K+=""}return this.each(function(){if(this.nodeType!=1){return}if(o.isArray(K)&&/radio|checkbox/.test(this.type)){this.checked=(o.inArray(this.value,K)>=0||o.inArray(this.name,K)>=0)}else{if(o.nodeName(this,"select")){var N=o.makeArray(K);o("option",this).each(function(){this.selected=(o.inArray(this.value,N)>=0||o.inArray(this.text,N)>=0)});if(!N.length){this.selectedIndex=-1}}else{this.value=K}}})},html:function(E){return E===g?(this[0]?this[0].innerHTML.replace(/ jQuery\d+="(?:\d+|null)"/g,""):null):this.empty().append(E)},replaceWith:function(E){return this.after(E).remove()},eq:function(E){return this.slice(E,+E+1)},slice:function(){return this.pushStack(Array.prototype.slice.apply(this,arguments),"slice",Array.prototype.slice.call(arguments).join(","))},map:function(E){return this.pushStack(o.map(this,function(G,F){return E.call(G,F,G)}))},andSelf:function(){return this.add(this.prevObject)},domManip:function(J,M,L){if(this[0]){var I=(this[0].ownerDocument||this[0]).createDocumentFragment(),F=o.clean(J,(this[0].ownerDocument||this[0]),I),H=I.firstChild;if(H){for(var G=0,E=this.length;G<E;G++){L.call(K(this[G],H),this.length>1||G>0?I.cloneNode(true):I)}}if(F){o.each(F,z)}}return this;function K(N,O){return M&&o.nodeName(N,"table")&&o.nodeName(O,"tr")?(N.getElementsByTagName("tbody")[0]||N.appendChild(N.ownerDocument.createElement("tbody"))):N}}};o.fn.init.prototype=o.fn;function z(E,F){if(F.src){o.ajax({url:F.src,async:false,dataType:"script"})}else{o.globalEval(F.text||F.textContent||F.innerHTML||"")}if(F.parentNode){F.parentNode.removeChild(F)}}function e(){return +new Date}o.extend=o.fn.extend=function(){var J=arguments[0]||{},H=1,I=arguments.length,E=false,G;if(typeof J==="boolean"){E=J;J=arguments[1]||{};H=2}if(typeof J!=="object"&&!o.isFunction(J)){J={}}if(I==H){J=this;--H}for(;H<I;H++){if((G=arguments[H])!=null){for(var F in G){var K=J[F],L=G[F];if(J===L){continue}if(E&&L&&typeof L==="object"&&!L.nodeType){J[F]=o.extend(E,K||(L.length!=null?[]:{}),L)}else{if(L!==g){J[F]=L}}}}}return J};var b=/z-?index|font-?weight|opacity|zoom|line-?height/i,q=document.defaultView||{},s=Object.prototype.toString;o.extend({noConflict:function(E){l.$=p;if(E){l.jQuery=y}return o},isFunction:function(E){return s.call(E)==="[object Function]"},isArray:function(E){return s.call(E)==="[object Array]"},isXMLDoc:function(E){return E.nodeType===9&&E.documentElement.nodeName!=="HTML"||!!E.ownerDocument&&o.isXMLDoc(E.ownerDocument)},globalEval:function(G){if(G&&/\S/.test(G)){var F=document.getElementsByTagName("head")[0]||document.documentElement,E=document.createElement("script");E.type="text/javascript";if(o.support.scriptEval){E.appendChild(document.createTextNode(G))}else{E.text=G}F.insertBefore(E,F.firstChild);F.removeChild(E)}},nodeName:function(F,E){return F.nodeName&&F.nodeName.toUpperCase()==E.toUpperCase()},each:function(G,K,F){var E,H=0,I=G.length;if(F){if(I===g){for(E in G){if(K.apply(G[E],F)===false){break}}}else{for(;H<I;){if(K.apply(G[H++],F)===false){break}}}}else{if(I===g){for(E in G){if(K.call(G[E],E,G[E])===false){break}}}else{for(var J=G[0];H<I&&K.call(J,H,J)!==false;J=G[++H]){}}}return G},prop:function(H,I,G,F,E){if(o.isFunction(I)){I=I.call(H,F)}return typeof I==="number"&&G=="curCSS"&&!b.test(E)?I+"px":I},className:{add:function(E,F){o.each((F||"").split(/\s+/),function(G,H){if(E.nodeType==1&&!o.className.has(E.className,H)){E.className+=(E.className?" ":"")+H}})},remove:function(E,F){if(E.nodeType==1){E.className=F!==g?o.grep(E.className.split(/\s+/),function(G){return !o.className.has(F,G)}).join(" "):""}},has:function(F,E){return F&&o.inArray(E,(F.className||F).toString().split(/\s+/))>-1}},swap:function(H,G,I){var E={};for(var F in G){E[F]=H.style[F];H.style[F]=G[F]}I.call(H);for(var F in G){H.style[F]=E[F]}},css:function(H,F,J,E){if(F=="width"||F=="height"){var L,G={position:"absolute",visibility:"hidden",display:"block"},K=F=="width"?["Left","Right"]:["Top","Bottom"];function I(){L=F=="width"?H.offsetWidth:H.offsetHeight;if(E==="border"){return}o.each(K,function(){if(!E){L-=parseFloat(o.curCSS(H,"padding"+this,true))||0}if(E==="margin"){L+=parseFloat(o.curCSS(H,"margin"+this,true))||0}else{L-=parseFloat(o.curCSS(H,"border"+this+"Width",true))||0}})}if(H.offsetWidth!==0){I()}else{o.swap(H,G,I)}return Math.max(0,Math.round(L))}return o.curCSS(H,F,J)},curCSS:function(I,F,G){var L,E=I.style;if(F=="opacity"&&!o.support.opacity){L=o.attr(E,"opacity");return L==""?"1":L}if(F.match(/float/i)){F=w}if(!G&&E&&E[F]){L=E[F]}else{if(q.getComputedStyle){if(F.match(/float/i)){F="float"}F=F.replace(/([A-Z])/g,"-$1").toLowerCase();var M=q.getComputedStyle(I,null);if(M){L=M.getPropertyValue(F)}if(F=="opacity"&&L==""){L="1"}}else{if(I.currentStyle){var J=F.replace(/\-(\w)/g,function(N,O){return O.toUpperCase()});L=I.currentStyle[F]||I.currentStyle[J];if(!/^\d+(px)?$/i.test(L)&&/^\d/.test(L)){var H=E.left,K=I.runtimeStyle.left;I.runtimeStyle.left=I.currentStyle.left;E.left=L||0;L=E.pixelLeft+"px";E.left=H;I.runtimeStyle.left=K}}}}return L},clean:function(F,K,I){K=K||document;if(typeof K.createElement==="undefined"){K=K.ownerDocument||K[0]&&K[0].ownerDocument||document}if(!I&&F.length===1&&typeof F[0]==="string"){var H=/^<(\w+)\s*\/?>$/.exec(F[0]);if(H){return[K.createElement(H[1])]}}var G=[],E=[],L=K.createElement("div");o.each(F,function(P,S){if(typeof S==="number"){S+=""}if(!S){return}if(typeof S==="string"){S=S.replace(/(<(\w+)[^>]*?)\/>/g,function(U,V,T){return T.match(/^(abbr|br|col|img|input|link|meta|param|hr|area|embed)$/i)?U:V+"></"+T+">"});var O=S.replace(/^\s+/,"").substring(0,10).toLowerCase();var Q=!O.indexOf("<opt")&&[1,"<select multiple='multiple'>","</select>"]||!O.indexOf("<leg")&&[1,"<fieldset>","</fieldset>"]||O.match(/^<(thead|tbody|tfoot|colg|cap)/)&&[1,"<table>","</table>"]||!O.indexOf("<tr")&&[2,"<table><tbody>","</tbody></table>"]||(!O.indexOf("<td")||!O.indexOf("<th"))&&[3,"<table><tbody><tr>","</tr></tbody></table>"]||!O.indexOf("<col")&&[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"]||!o.support.htmlSerialize&&[1,"div<div>","</div>"]||[0,"",""];L.innerHTML=Q[1]+S+Q[2];while(Q[0]--){L=L.lastChild}if(!o.support.tbody){var R=/<tbody/i.test(S),N=!O.indexOf("<table")&&!R?L.firstChild&&L.firstChild.childNodes:Q[1]=="<table>"&&!R?L.childNodes:[];for(var M=N.length-1;M>=0;--M){if(o.nodeName(N[M],"tbody")&&!N[M].childNodes.length){N[M].parentNode.removeChild(N[M])}}}if(!o.support.leadingWhitespace&&/^\s/.test(S)){L.insertBefore(K.createTextNode(S.match(/^\s*/)[0]),L.firstChild)}S=o.makeArray(L.childNodes)}if(S.nodeType){G.push(S)}else{G=o.merge(G,S)}});if(I){for(var J=0;G[J];J++){if(o.nodeName(G[J],"script")&&(!G[J].type||G[J].type.toLowerCase()==="text/javascript")){E.push(G[J].parentNode?G[J].parentNode.removeChild(G[J]):G[J])}else{if(G[J].nodeType===1){G.splice.apply(G,[J+1,0].concat(o.makeArray(G[J].getElementsByTagName("script"))))}I.appendChild(G[J])}}return E}return G},attr:function(J,G,K){if(!J||J.nodeType==3||J.nodeType==8){return g}var H=!o.isXMLDoc(J),L=K!==g;G=H&&o.props[G]||G;if(J.tagName){var F=/href|src|style/.test(G);if(G=="selected"&&J.parentNode){J.parentNode.selectedIndex}if(G in J&&H&&!F){if(L){if(G=="type"&&o.nodeName(J,"input")&&J.parentNode){throw"type property can't be changed"}J[G]=K}if(o.nodeName(J,"form")&&J.getAttributeNode(G)){return J.getAttributeNode(G).nodeValue}if(G=="tabIndex"){var I=J.getAttributeNode("tabIndex");return I&&I.specified?I.value:J.nodeName.match(/(button|input|object|select|textarea)/i)?0:J.nodeName.match(/^(a|area)$/i)&&J.href?0:g}return J[G]}if(!o.support.style&&H&&G=="style"){return o.attr(J.style,"cssText",K)}if(L){J.setAttribute(G,""+K)}var E=!o.support.hrefNormalized&&H&&F?J.getAttribute(G,2):J.getAttribute(G);return E===null?g:E}if(!o.support.opacity&&G=="opacity"){if(L){J.zoom=1;J.filter=(J.filter||"").replace(/alpha\([^)]*\)/,"")+(parseInt(K)+""=="NaN"?"":"alpha(opacity="+K*100+")")}return J.filter&&J.filter.indexOf("opacity=")>=0?(parseFloat(J.filter.match(/opacity=([^)]*)/)[1])/100)+"":""}G=G.replace(/-([a-z])/ig,function(M,N){return N.toUpperCase()});if(L){J[G]=K}return J[G]},trim:function(E){return(E||"").replace(/^\s+|\s+$/g,"")},makeArray:function(G){var E=[];if(G!=null){var F=G.length;if(F==null||typeof G==="string"||o.isFunction(G)||G.setInterval){E[0]=G}else{while(F){E[--F]=G[F]}}}return E},inArray:function(G,H){for(var E=0,F=H.length;E<F;E++){if(H[E]===G){return E}}return -1},merge:function(H,E){var F=0,G,I=H.length;if(!o.support.getAll){while((G=E[F++])!=null){if(G.nodeType!=8){H[I++]=G}}}else{while((G=E[F++])!=null){H[I++]=G}}return H},unique:function(K){var F=[],E={};try{for(var G=0,H=K.length;G<H;G++){var J=o.data(K[G]);if(!E[J]){E[J]=true;F.push(K[G])}}}catch(I){F=K}return F},grep:function(F,J,E){var G=[];for(var H=0,I=F.length;H<I;H++){if(!E!=!J(F[H],H)){G.push(F[H])}}return G},map:function(E,J){var F=[];for(var G=0,H=E.length;G<H;G++){var I=J(E[G],G);if(I!=null){F[F.length]=I}}return F.concat.apply([],F)}});var C=navigator.userAgent.toLowerCase();o.browser={version:(C.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/)||[0,"0"])[1],safari:/webkit/.test(C),opera:/opera/.test(C),msie:/msie/.test(C)&&!/opera/.test(C),mozilla:/mozilla/.test(C)&&!/(compatible|webkit)/.test(C)};o.each({parent:function(E){return E.parentNode},parents:function(E){return o.dir(E,"parentNode")},next:function(E){return o.nth(E,2,"nextSibling")},prev:function(E){return o.nth(E,2,"previousSibling")},nextAll:function(E){return o.dir(E,"nextSibling")},prevAll:function(E){return o.dir(E,"previousSibling")},siblings:function(E){return o.sibling(E.parentNode.firstChild,E)},children:function(E){return o.sibling(E.firstChild)},contents:function(E){return o.nodeName(E,"iframe")?E.contentDocument||E.contentWindow.document:o.makeArray(E.childNodes)}},function(E,F){o.fn[E]=function(G){var H=o.map(this,F);if(G&&typeof G=="string"){H=o.multiFilter(G,H)}return this.pushStack(o.unique(H),E,G)}});o.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(E,F){o.fn[E]=function(G){var J=[],L=o(G);for(var K=0,H=L.length;K<H;K++){var I=(K>0?this.clone(true):this).get();o.fn[F].apply(o(L[K]),I);J=J.concat(I)}return this.pushStack(J,E,G)}});o.each({removeAttr:function(E){o.attr(this,E,"");if(this.nodeType==1){this.removeAttribute(E)}},addClass:function(E){o.className.add(this,E)},removeClass:function(E){o.className.remove(this,E)},toggleClass:function(F,E){if(typeof E!=="boolean"){E=!o.className.has(this,F)}o.className[E?"add":"remove"](this,F)},remove:function(E){if(!E||o.filter(E,[this]).length){o("*",this).add([this]).each(function(){o.event.remove(this);o.removeData(this)});if(this.parentNode){this.parentNode.removeChild(this)}}},empty:function(){o(this).children().remove();while(this.firstChild){this.removeChild(this.firstChild)}}},function(E,F){o.fn[E]=function(){return this.each(F,arguments)}});function j(E,F){return E[0]&&parseInt(o.curCSS(E[0],F,true),10)||0}var h="jQuery"+e(),v=0,A={};o.extend({cache:{},data:function(F,E,G){F=F==l?A:F;var H=F[h];if(!H){H=F[h]=++v}if(E&&!o.cache[H]){o.cache[H]={}}if(G!==g){o.cache[H][E]=G}return E?o.cache[H][E]:H},removeData:function(F,E){F=F==l?A:F;var H=F[h];if(E){if(o.cache[H]){delete o.cache[H][E];E="";for(E in o.cache[H]){break}if(!E){o.removeData(F)}}}else{try{delete F[h]}catch(G){if(F.removeAttribute){F.removeAttribute(h)}}delete o.cache[H]}},queue:function(F,E,H){if(F){E=(E||"fx")+"queue";var G=o.data(F,E);if(!G||o.isArray(H)){G=o.data(F,E,o.makeArray(H))}else{if(H){G.push(H)}}}return G},dequeue:function(H,G){var E=o.queue(H,G),F=E.shift();if(!G||G==="fx"){F=E[0]}if(F!==g){F.call(H)}}});o.fn.extend({data:function(E,G){var H=E.split(".");H[1]=H[1]?"."+H[1]:"";if(G===g){var F=this.triggerHandler("getData"+H[1]+"!",[H[0]]);if(F===g&&this.length){F=o.data(this[0],E)}return F===g&&H[1]?this.data(H[0]):F}else{return this.trigger("setData"+H[1]+"!",[H[0],G]).each(function(){o.data(this,E,G)})}},removeData:function(E){return this.each(function(){o.removeData(this,E)})},queue:function(E,F){if(typeof E!=="string"){F=E;E="fx"}if(F===g){return o.queue(this[0],E)}return this.each(function(){var G=o.queue(this,E,F);if(E=="fx"&&G.length==1){G[0].call(this)}})},dequeue:function(E){return this.each(function(){o.dequeue(this,E)})}});
/*
 * Sizzle CSS Selector Engine - v0.9.3
 *  Copyright 2009, The Dojo Foundation
 *  Released under the MIT, BSD, and GPL Licenses.
 *  More information: http://sizzlejs.com/
 */
(function(){var R=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^[\]]*\]|['"][^'"]*['"]|[^[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?/g,L=0,H=Object.prototype.toString;var F=function(Y,U,ab,ac){ab=ab||[];U=U||document;if(U.nodeType!==1&&U.nodeType!==9){return[]}if(!Y||typeof Y!=="string"){return ab}var Z=[],W,af,ai,T,ad,V,X=true;R.lastIndex=0;while((W=R.exec(Y))!==null){Z.push(W[1]);if(W[2]){V=RegExp.rightContext;break}}if(Z.length>1&&M.exec(Y)){if(Z.length===2&&I.relative[Z[0]]){af=J(Z[0]+Z[1],U)}else{af=I.relative[Z[0]]?[U]:F(Z.shift(),U);while(Z.length){Y=Z.shift();if(I.relative[Y]){Y+=Z.shift()}af=J(Y,af)}}}else{var ae=ac?{expr:Z.pop(),set:E(ac)}:F.find(Z.pop(),Z.length===1&&U.parentNode?U.parentNode:U,Q(U));af=F.filter(ae.expr,ae.set);if(Z.length>0){ai=E(af)}else{X=false}while(Z.length){var ah=Z.pop(),ag=ah;if(!I.relative[ah]){ah=""}else{ag=Z.pop()}if(ag==null){ag=U}I.relative[ah](ai,ag,Q(U))}}if(!ai){ai=af}if(!ai){throw"Syntax error, unrecognized expression: "+(ah||Y)}if(H.call(ai)==="[object Array]"){if(!X){ab.push.apply(ab,ai)}else{if(U.nodeType===1){for(var aa=0;ai[aa]!=null;aa++){if(ai[aa]&&(ai[aa]===true||ai[aa].nodeType===1&&K(U,ai[aa]))){ab.push(af[aa])}}}else{for(var aa=0;ai[aa]!=null;aa++){if(ai[aa]&&ai[aa].nodeType===1){ab.push(af[aa])}}}}}else{E(ai,ab)}if(V){F(V,U,ab,ac);if(G){hasDuplicate=false;ab.sort(G);if(hasDuplicate){for(var aa=1;aa<ab.length;aa++){if(ab[aa]===ab[aa-1]){ab.splice(aa--,1)}}}}}return ab};F.matches=function(T,U){return F(T,null,null,U)};F.find=function(aa,T,ab){var Z,X;if(!aa){return[]}for(var W=0,V=I.order.length;W<V;W++){var Y=I.order[W],X;if((X=I.match[Y].exec(aa))){var U=RegExp.leftContext;if(U.substr(U.length-1)!=="\\"){X[1]=(X[1]||"").replace(/\\/g,"");Z=I.find[Y](X,T,ab);if(Z!=null){aa=aa.replace(I.match[Y],"");break}}}}if(!Z){Z=T.getElementsByTagName("*")}return{set:Z,expr:aa}};F.filter=function(ad,ac,ag,W){var V=ad,ai=[],aa=ac,Y,T,Z=ac&&ac[0]&&Q(ac[0]);while(ad&&ac.length){for(var ab in I.filter){if((Y=I.match[ab].exec(ad))!=null){var U=I.filter[ab],ah,af;T=false;if(aa==ai){ai=[]}if(I.preFilter[ab]){Y=I.preFilter[ab](Y,aa,ag,ai,W,Z);if(!Y){T=ah=true}else{if(Y===true){continue}}}if(Y){for(var X=0;(af=aa[X])!=null;X++){if(af){ah=U(af,Y,X,aa);var ae=W^!!ah;if(ag&&ah!=null){if(ae){T=true}else{aa[X]=false}}else{if(ae){ai.push(af);T=true}}}}}if(ah!==g){if(!ag){aa=ai}ad=ad.replace(I.match[ab],"");if(!T){return[]}break}}}if(ad==V){if(T==null){throw"Syntax error, unrecognized expression: "+ad}else{break}}V=ad}return aa};var I=F.selectors={order:["ID","NAME","TAG"],match:{ID:/#((?:[\w\u00c0-\uFFFF_-]|\\.)+)/,CLASS:/\.((?:[\w\u00c0-\uFFFF_-]|\\.)+)/,NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF_-]|\\.)+)['"]*\]/,ATTR:/\[\s*((?:[\w\u00c0-\uFFFF_-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,TAG:/^((?:[\w\u00c0-\uFFFF\*_-]|\\.)+)/,CHILD:/:(only|nth|last|first)-child(?:\((even|odd|[\dn+-]*)\))?/,POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^-]|$)/,PSEUDO:/:((?:[\w\u00c0-\uFFFF_-]|\\.)+)(?:\((['"]*)((?:\([^\)]+\)|[^\2\(\)]*)+)\2\))?/},attrMap:{"class":"className","for":"htmlFor"},attrHandle:{href:function(T){return T.getAttribute("href")}},relative:{"+":function(aa,T,Z){var X=typeof T==="string",ab=X&&!/\W/.test(T),Y=X&&!ab;if(ab&&!Z){T=T.toUpperCase()}for(var W=0,V=aa.length,U;W<V;W++){if((U=aa[W])){while((U=U.previousSibling)&&U.nodeType!==1){}aa[W]=Y||U&&U.nodeName===T?U||false:U===T}}if(Y){F.filter(T,aa,true)}},">":function(Z,U,aa){var X=typeof U==="string";if(X&&!/\W/.test(U)){U=aa?U:U.toUpperCase();for(var V=0,T=Z.length;V<T;V++){var Y=Z[V];if(Y){var W=Y.parentNode;Z[V]=W.nodeName===U?W:false}}}else{for(var V=0,T=Z.length;V<T;V++){var Y=Z[V];if(Y){Z[V]=X?Y.parentNode:Y.parentNode===U}}if(X){F.filter(U,Z,true)}}},"":function(W,U,Y){var V=L++,T=S;if(!U.match(/\W/)){var X=U=Y?U:U.toUpperCase();T=P}T("parentNode",U,V,W,X,Y)},"~":function(W,U,Y){var V=L++,T=S;if(typeof U==="string"&&!U.match(/\W/)){var X=U=Y?U:U.toUpperCase();T=P}T("previousSibling",U,V,W,X,Y)}},find:{ID:function(U,V,W){if(typeof V.getElementById!=="undefined"&&!W){var T=V.getElementById(U[1]);return T?[T]:[]}},NAME:function(V,Y,Z){if(typeof Y.getElementsByName!=="undefined"){var U=[],X=Y.getElementsByName(V[1]);for(var W=0,T=X.length;W<T;W++){if(X[W].getAttribute("name")===V[1]){U.push(X[W])}}return U.length===0?null:U}},TAG:function(T,U){return U.getElementsByTagName(T[1])}},preFilter:{CLASS:function(W,U,V,T,Z,aa){W=" "+W[1].replace(/\\/g,"")+" ";if(aa){return W}for(var X=0,Y;(Y=U[X])!=null;X++){if(Y){if(Z^(Y.className&&(" "+Y.className+" ").indexOf(W)>=0)){if(!V){T.push(Y)}}else{if(V){U[X]=false}}}}return false},ID:function(T){return T[1].replace(/\\/g,"")},TAG:function(U,T){for(var V=0;T[V]===false;V++){}return T[V]&&Q(T[V])?U[1]:U[1].toUpperCase()},CHILD:function(T){if(T[1]=="nth"){var U=/(-?)(\d*)n((?:\+|-)?\d*)/.exec(T[2]=="even"&&"2n"||T[2]=="odd"&&"2n+1"||!/\D/.test(T[2])&&"0n+"+T[2]||T[2]);T[2]=(U[1]+(U[2]||1))-0;T[3]=U[3]-0}T[0]=L++;return T},ATTR:function(X,U,V,T,Y,Z){var W=X[1].replace(/\\/g,"");if(!Z&&I.attrMap[W]){X[1]=I.attrMap[W]}if(X[2]==="~="){X[4]=" "+X[4]+" "}return X},PSEUDO:function(X,U,V,T,Y){if(X[1]==="not"){if(X[3].match(R).length>1||/^\w/.test(X[3])){X[3]=F(X[3],null,null,U)}else{var W=F.filter(X[3],U,V,true^Y);if(!V){T.push.apply(T,W)}return false}}else{if(I.match.POS.test(X[0])||I.match.CHILD.test(X[0])){return true}}return X},POS:function(T){T.unshift(true);return T}},filters:{enabled:function(T){return T.disabled===false&&T.type!=="hidden"},disabled:function(T){return T.disabled===true},checked:function(T){return T.checked===true},selected:function(T){T.parentNode.selectedIndex;return T.selected===true},parent:function(T){return !!T.firstChild},empty:function(T){return !T.firstChild},has:function(V,U,T){return !!F(T[3],V).length},header:function(T){return/h\d/i.test(T.nodeName)},text:function(T){return"text"===T.type},radio:function(T){return"radio"===T.type},checkbox:function(T){return"checkbox"===T.type},file:function(T){return"file"===T.type},password:function(T){return"password"===T.type},submit:function(T){return"submit"===T.type},image:function(T){return"image"===T.type},reset:function(T){return"reset"===T.type},button:function(T){return"button"===T.type||T.nodeName.toUpperCase()==="BUTTON"},input:function(T){return/input|select|textarea|button/i.test(T.nodeName)}},setFilters:{first:function(U,T){return T===0},last:function(V,U,T,W){return U===W.length-1},even:function(U,T){return T%2===0},odd:function(U,T){return T%2===1},lt:function(V,U,T){return U<T[3]-0},gt:function(V,U,T){return U>T[3]-0},nth:function(V,U,T){return T[3]-0==U},eq:function(V,U,T){return T[3]-0==U}},filter:{PSEUDO:function(Z,V,W,aa){var U=V[1],X=I.filters[U];if(X){return X(Z,W,V,aa)}else{if(U==="contains"){return(Z.textContent||Z.innerText||"").indexOf(V[3])>=0}else{if(U==="not"){var Y=V[3];for(var W=0,T=Y.length;W<T;W++){if(Y[W]===Z){return false}}return true}}}},CHILD:function(T,W){var Z=W[1],U=T;switch(Z){case"only":case"first":while(U=U.previousSibling){if(U.nodeType===1){return false}}if(Z=="first"){return true}U=T;case"last":while(U=U.nextSibling){if(U.nodeType===1){return false}}return true;case"nth":var V=W[2],ac=W[3];if(V==1&&ac==0){return true}var Y=W[0],ab=T.parentNode;if(ab&&(ab.sizcache!==Y||!T.nodeIndex)){var X=0;for(U=ab.firstChild;U;U=U.nextSibling){if(U.nodeType===1){U.nodeIndex=++X}}ab.sizcache=Y}var aa=T.nodeIndex-ac;if(V==0){return aa==0}else{return(aa%V==0&&aa/V>=0)}}},ID:function(U,T){return U.nodeType===1&&U.getAttribute("id")===T},TAG:function(U,T){return(T==="*"&&U.nodeType===1)||U.nodeName===T},CLASS:function(U,T){return(" "+(U.className||U.getAttribute("class"))+" ").indexOf(T)>-1},ATTR:function(Y,W){var V=W[1],T=I.attrHandle[V]?I.attrHandle[V](Y):Y[V]!=null?Y[V]:Y.getAttribute(V),Z=T+"",X=W[2],U=W[4];return T==null?X==="!=":X==="="?Z===U:X==="*="?Z.indexOf(U)>=0:X==="~="?(" "+Z+" ").indexOf(U)>=0:!U?Z&&T!==false:X==="!="?Z!=U:X==="^="?Z.indexOf(U)===0:X==="$="?Z.substr(Z.length-U.length)===U:X==="|="?Z===U||Z.substr(0,U.length+1)===U+"-":false},POS:function(X,U,V,Y){var T=U[2],W=I.setFilters[T];if(W){return W(X,V,U,Y)}}}};var M=I.match.POS;for(var O in I.match){I.match[O]=RegExp(I.match[O].source+/(?![^\[]*\])(?![^\(]*\))/.source)}var E=function(U,T){U=Array.prototype.slice.call(U);if(T){T.push.apply(T,U);return T}return U};try{Array.prototype.slice.call(document.documentElement.childNodes)}catch(N){E=function(X,W){var U=W||[];if(H.call(X)==="[object Array]"){Array.prototype.push.apply(U,X)}else{if(typeof X.length==="number"){for(var V=0,T=X.length;V<T;V++){U.push(X[V])}}else{for(var V=0;X[V];V++){U.push(X[V])}}}return U}}var G;if(document.documentElement.compareDocumentPosition){G=function(U,T){var V=U.compareDocumentPosition(T)&4?-1:U===T?0:1;if(V===0){hasDuplicate=true}return V}}else{if("sourceIndex" in document.documentElement){G=function(U,T){var V=U.sourceIndex-T.sourceIndex;if(V===0){hasDuplicate=true}return V}}else{if(document.createRange){G=function(W,U){var V=W.ownerDocument.createRange(),T=U.ownerDocument.createRange();V.selectNode(W);V.collapse(true);T.selectNode(U);T.collapse(true);var X=V.compareBoundaryPoints(Range.START_TO_END,T);if(X===0){hasDuplicate=true}return X}}}}(function(){var U=document.createElement("form"),V="script"+(new Date).getTime();U.innerHTML="<input name='"+V+"'/>";var T=document.documentElement;T.insertBefore(U,T.firstChild);if(!!document.getElementById(V)){I.find.ID=function(X,Y,Z){if(typeof Y.getElementById!=="undefined"&&!Z){var W=Y.getElementById(X[1]);return W?W.id===X[1]||typeof W.getAttributeNode!=="undefined"&&W.getAttributeNode("id").nodeValue===X[1]?[W]:g:[]}};I.filter.ID=function(Y,W){var X=typeof Y.getAttributeNode!=="undefined"&&Y.getAttributeNode("id");return Y.nodeType===1&&X&&X.nodeValue===W}}T.removeChild(U)})();(function(){var T=document.createElement("div");T.appendChild(document.createComment(""));if(T.getElementsByTagName("*").length>0){I.find.TAG=function(U,Y){var X=Y.getElementsByTagName(U[1]);if(U[1]==="*"){var W=[];for(var V=0;X[V];V++){if(X[V].nodeType===1){W.push(X[V])}}X=W}return X}}T.innerHTML="<a href='#'></a>";if(T.firstChild&&typeof T.firstChild.getAttribute!=="undefined"&&T.firstChild.getAttribute("href")!=="#"){I.attrHandle.href=function(U){return U.getAttribute("href",2)}}})();if(document.querySelectorAll){(function(){var T=F,U=document.createElement("div");U.innerHTML="<p class='TEST'></p>";if(U.querySelectorAll&&U.querySelectorAll(".TEST").length===0){return}F=function(Y,X,V,W){X=X||document;if(!W&&X.nodeType===9&&!Q(X)){try{return E(X.querySelectorAll(Y),V)}catch(Z){}}return T(Y,X,V,W)};F.find=T.find;F.filter=T.filter;F.selectors=T.selectors;F.matches=T.matches})()}if(document.getElementsByClassName&&document.documentElement.getElementsByClassName){(function(){var T=document.createElement("div");T.innerHTML="<div class='test e'></div><div class='test'></div>";if(T.getElementsByClassName("e").length===0){return}T.lastChild.className="e";if(T.getElementsByClassName("e").length===1){return}I.order.splice(1,0,"CLASS");I.find.CLASS=function(U,V,W){if(typeof V.getElementsByClassName!=="undefined"&&!W){return V.getElementsByClassName(U[1])}}})()}function P(U,Z,Y,ad,aa,ac){var ab=U=="previousSibling"&&!ac;for(var W=0,V=ad.length;W<V;W++){var T=ad[W];if(T){if(ab&&T.nodeType===1){T.sizcache=Y;T.sizset=W}T=T[U];var X=false;while(T){if(T.sizcache===Y){X=ad[T.sizset];break}if(T.nodeType===1&&!ac){T.sizcache=Y;T.sizset=W}if(T.nodeName===Z){X=T;break}T=T[U]}ad[W]=X}}}function S(U,Z,Y,ad,aa,ac){var ab=U=="previousSibling"&&!ac;for(var W=0,V=ad.length;W<V;W++){var T=ad[W];if(T){if(ab&&T.nodeType===1){T.sizcache=Y;T.sizset=W}T=T[U];var X=false;while(T){if(T.sizcache===Y){X=ad[T.sizset];break}if(T.nodeType===1){if(!ac){T.sizcache=Y;T.sizset=W}if(typeof Z!=="string"){if(T===Z){X=true;break}}else{if(F.filter(Z,[T]).length>0){X=T;break}}}T=T[U]}ad[W]=X}}}var K=document.compareDocumentPosition?function(U,T){return U.compareDocumentPosition(T)&16}:function(U,T){return U!==T&&(U.contains?U.contains(T):true)};var Q=function(T){return T.nodeType===9&&T.documentElement.nodeName!=="HTML"||!!T.ownerDocument&&Q(T.ownerDocument)};var J=function(T,aa){var W=[],X="",Y,V=aa.nodeType?[aa]:aa;while((Y=I.match.PSEUDO.exec(T))){X+=Y[0];T=T.replace(I.match.PSEUDO,"")}T=I.relative[T]?T+"*":T;for(var Z=0,U=V.length;Z<U;Z++){F(T,V[Z],W)}return F.filter(X,W)};o.find=F;o.filter=F.filter;o.expr=F.selectors;o.expr[":"]=o.expr.filters;F.selectors.filters.hidden=function(T){return T.offsetWidth===0||T.offsetHeight===0};F.selectors.filters.visible=function(T){return T.offsetWidth>0||T.offsetHeight>0};F.selectors.filters.animated=function(T){return o.grep(o.timers,function(U){return T===U.elem}).length};o.multiFilter=function(V,T,U){if(U){V=":not("+V+")"}return F.matches(V,T)};o.dir=function(V,U){var T=[],W=V[U];while(W&&W!=document){if(W.nodeType==1){T.push(W)}W=W[U]}return T};o.nth=function(X,T,V,W){T=T||1;var U=0;for(;X;X=X[V]){if(X.nodeType==1&&++U==T){break}}return X};o.sibling=function(V,U){var T=[];for(;V;V=V.nextSibling){if(V.nodeType==1&&V!=U){T.push(V)}}return T};return;l.Sizzle=F})();o.event={add:function(I,F,H,K){if(I.nodeType==3||I.nodeType==8){return}if(I.setInterval&&I!=l){I=l}if(!H.guid){H.guid=this.guid++}if(K!==g){var G=H;H=this.proxy(G);H.data=K}var E=o.data(I,"events")||o.data(I,"events",{}),J=o.data(I,"handle")||o.data(I,"handle",function(){return typeof o!=="undefined"&&!o.event.triggered?o.event.handle.apply(arguments.callee.elem,arguments):g});J.elem=I;o.each(F.split(/\s+/),function(M,N){var O=N.split(".");N=O.shift();H.type=O.slice().sort().join(".");var L=E[N];if(o.event.specialAll[N]){o.event.specialAll[N].setup.call(I,K,O)}if(!L){L=E[N]={};if(!o.event.special[N]||o.event.special[N].setup.call(I,K,O)===false){if(I.addEventListener){I.addEventListener(N,J,false)}else{if(I.attachEvent){I.attachEvent("on"+N,J)}}}}L[H.guid]=H;o.event.global[N]=true});I=null},guid:1,global:{},remove:function(K,H,J){if(K.nodeType==3||K.nodeType==8){return}var G=o.data(K,"events"),F,E;if(G){if(H===g||(typeof H==="string"&&H.charAt(0)==".")){for(var I in G){this.remove(K,I+(H||""))}}else{if(H.type){J=H.handler;H=H.type}o.each(H.split(/\s+/),function(M,O){var Q=O.split(".");O=Q.shift();var N=RegExp("(^|\\.)"+Q.slice().sort().join(".*\\.")+"(\\.|$)");if(G[O]){if(J){delete G[O][J.guid]}else{for(var P in G[O]){if(N.test(G[O][P].type)){delete G[O][P]}}}if(o.event.specialAll[O]){o.event.specialAll[O].teardown.call(K,Q)}for(F in G[O]){break}if(!F){if(!o.event.special[O]||o.event.special[O].teardown.call(K,Q)===false){if(K.removeEventListener){K.removeEventListener(O,o.data(K,"handle"),false)}else{if(K.detachEvent){K.detachEvent("on"+O,o.data(K,"handle"))}}}F=null;delete G[O]}}})}for(F in G){break}if(!F){var L=o.data(K,"handle");if(L){L.elem=null}o.removeData(K,"events");o.removeData(K,"handle")}}},trigger:function(I,K,H,E){var G=I.type||I;if(!E){I=typeof I==="object"?I[h]?I:o.extend(o.Event(G),I):o.Event(G);if(G.indexOf("!")>=0){I.type=G=G.slice(0,-1);I.exclusive=true}if(!H){I.stopPropagation();if(this.global[G]){o.each(o.cache,function(){if(this.events&&this.events[G]){o.event.trigger(I,K,this.handle.elem)}})}}if(!H||H.nodeType==3||H.nodeType==8){return g}I.result=g;I.target=H;K=o.makeArray(K);K.unshift(I)}I.currentTarget=H;var J=o.data(H,"handle");if(J){J.apply(H,K)}if((!H[G]||(o.nodeName(H,"a")&&G=="click"))&&H["on"+G]&&H["on"+G].apply(H,K)===false){I.result=false}if(!E&&H[G]&&!I.isDefaultPrevented()&&!(o.nodeName(H,"a")&&G=="click")){this.triggered=true;try{H[G]()}catch(L){}}this.triggered=false;if(!I.isPropagationStopped()){var F=H.parentNode||H.ownerDocument;if(F){o.event.trigger(I,K,F,true)}}},handle:function(K){var J,E;K=arguments[0]=o.event.fix(K||l.event);K.currentTarget=this;var L=K.type.split(".");K.type=L.shift();J=!L.length&&!K.exclusive;var I=RegExp("(^|\\.)"+L.slice().sort().join(".*\\.")+"(\\.|$)");E=(o.data(this,"events")||{})[K.type];for(var G in E){var H=E[G];if(J||I.test(H.type)){K.handler=H;K.data=H.data;var F=H.apply(this,arguments);if(F!==g){K.result=F;if(F===false){K.preventDefault();K.stopPropagation()}}if(K.isImmediatePropagationStopped()){break}}}},props:"altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode metaKey newValue originalTarget pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target toElement view wheelDelta which".split(" "),fix:function(H){if(H[h]){return H}var F=H;H=o.Event(F);for(var G=this.props.length,J;G;){J=this.props[--G];H[J]=F[J]}if(!H.target){H.target=H.srcElement||document}if(H.target.nodeType==3){H.target=H.target.parentNode}if(!H.relatedTarget&&H.fromElement){H.relatedTarget=H.fromElement==H.target?H.toElement:H.fromElement}if(H.pageX==null&&H.clientX!=null){var I=document.documentElement,E=document.body;H.pageX=H.clientX+(I&&I.scrollLeft||E&&E.scrollLeft||0)-(I.clientLeft||0);H.pageY=H.clientY+(I&&I.scrollTop||E&&E.scrollTop||0)-(I.clientTop||0)}if(!H.which&&((H.charCode||H.charCode===0)?H.charCode:H.keyCode)){H.which=H.charCode||H.keyCode}if(!H.metaKey&&H.ctrlKey){H.metaKey=H.ctrlKey}if(!H.which&&H.button){H.which=(H.button&1?1:(H.button&2?3:(H.button&4?2:0)))}return H},proxy:function(F,E){E=E||function(){return F.apply(this,arguments)};E.guid=F.guid=F.guid||E.guid||this.guid++;return E},special:{ready:{setup:B,teardown:function(){}}},specialAll:{live:{setup:function(E,F){o.event.add(this,F[0],c)},teardown:function(G){if(G.length){var E=0,F=RegExp("(^|\\.)"+G[0]+"(\\.|$)");o.each((o.data(this,"events").live||{}),function(){if(F.test(this.type)){E++}});if(E<1){o.event.remove(this,G[0],c)}}}}}};o.Event=function(E){if(!this.preventDefault){return new o.Event(E)}if(E&&E.type){this.originalEvent=E;this.type=E.type}else{this.type=E}this.timeStamp=e();this[h]=true};function k(){return false}function u(){return true}o.Event.prototype={preventDefault:function(){this.isDefaultPrevented=u;var E=this.originalEvent;if(!E){return}if(E.preventDefault){E.preventDefault()}E.returnValue=false},stopPropagation:function(){this.isPropagationStopped=u;var E=this.originalEvent;if(!E){return}if(E.stopPropagation){E.stopPropagation()}E.cancelBubble=true},stopImmediatePropagation:function(){this.isImmediatePropagationStopped=u;this.stopPropagation()},isDefaultPrevented:k,isPropagationStopped:k,isImmediatePropagationStopped:k};var a=function(F){var E=F.relatedTarget;while(E&&E!=this){try{E=E.parentNode}catch(G){E=this}}if(E!=this){F.type=F.data;o.event.handle.apply(this,arguments)}};o.each({mouseover:"mouseenter",mouseout:"mouseleave"},function(F,E){o.event.special[E]={setup:function(){o.event.add(this,F,a,E)},teardown:function(){o.event.remove(this,F,a)}}});o.fn.extend({bind:function(F,G,E){return F=="unload"?this.one(F,G,E):this.each(function(){o.event.add(this,F,E||G,E&&G)})},one:function(G,H,F){var E=o.event.proxy(F||H,function(I){o(this).unbind(I,E);return(F||H).apply(this,arguments)});return this.each(function(){o.event.add(this,G,E,F&&H)})},unbind:function(F,E){return this.each(function(){o.event.remove(this,F,E)})},trigger:function(E,F){return this.each(function(){o.event.trigger(E,F,this)})},triggerHandler:function(E,G){if(this[0]){var F=o.Event(E);F.preventDefault();F.stopPropagation();o.event.trigger(F,G,this[0]);return F.result}},toggle:function(G){var E=arguments,F=1;while(F<E.length){o.event.proxy(G,E[F++])}return this.click(o.event.proxy(G,function(H){this.lastToggle=(this.lastToggle||0)%F;H.preventDefault();return E[this.lastToggle++].apply(this,arguments)||false}))},hover:function(E,F){return this.mouseenter(E).mouseleave(F)},ready:function(E){B();if(o.isReady){E.call(document,o)}else{o.readyList.push(E)}return this},live:function(G,F){var E=o.event.proxy(F);E.guid+=this.selector+G;o(document).bind(i(G,this.selector),this.selector,E);return this},die:function(F,E){o(document).unbind(i(F,this.selector),E?{guid:E.guid+this.selector+F}:null);return this}});function c(H){var E=RegExp("(^|\\.)"+H.type+"(\\.|$)"),G=true,F=[];o.each(o.data(this,"events").live||[],function(I,J){if(E.test(J.type)){var K=o(H.target).closest(J.data)[0];if(K){F.push({elem:K,fn:J})}}});F.sort(function(J,I){return o.data(J.elem,"closest")-o.data(I.elem,"closest")});o.each(F,function(){if(this.fn.call(this.elem,H,this.fn.data)===false){return(G=false)}});return G}function i(F,E){return["live",F,E.replace(/\./g,"`").replace(/ /g,"|")].join(".")}o.extend({isReady:false,readyList:[],ready:function(){if(!o.isReady){o.isReady=true;if(o.readyList){o.each(o.readyList,function(){this.call(document,o)});o.readyList=null}o(document).triggerHandler("ready")}}});var x=false;function B(){if(x){return}x=true;if(document.addEventListener){document.addEventListener("DOMContentLoaded",function(){document.removeEventListener("DOMContentLoaded",arguments.callee,false);o.ready()},false)}else{if(document.attachEvent){document.attachEvent("onreadystatechange",function(){if(document.readyState==="complete"){document.detachEvent("onreadystatechange",arguments.callee);o.ready()}});if(document.documentElement.doScroll&&l==l.top){(function(){if(o.isReady){return}try{document.documentElement.doScroll("left")}catch(E){setTimeout(arguments.callee,0);return}o.ready()})()}}}o.event.add(l,"load",o.ready)}o.each(("blur,focus,load,resize,scroll,unload,click,dblclick,mousedown,mouseup,mousemove,mouseover,mouseout,mouseenter,mouseleave,change,select,submit,keydown,keypress,keyup,error").split(","),function(F,E){o.fn[E]=function(G){return G?this.bind(E,G):this.trigger(E)}});o(l).bind("unload",function(){for(var E in o.cache){if(E!=1&&o.cache[E].handle){o.event.remove(o.cache[E].handle.elem)}}});(function(){o.support={};var F=document.documentElement,G=document.createElement("script"),K=document.createElement("div"),J="script"+(new Date).getTime();K.style.display="none";K.innerHTML='   <link/><table></table><a href="/a" style="color:red;float:left;opacity:.5;">a</a><select><option>text</option></select><object><param/></object>';var H=K.getElementsByTagName("*"),E=K.getElementsByTagName("a")[0];if(!H||!H.length||!E){return}o.support={leadingWhitespace:K.firstChild.nodeType==3,tbody:!K.getElementsByTagName("tbody").length,objectAll:!!K.getElementsByTagName("object")[0].getElementsByTagName("*").length,htmlSerialize:!!K.getElementsByTagName("link").length,style:/red/.test(E.getAttribute("style")),hrefNormalized:E.getAttribute("href")==="/a",opacity:E.style.opacity==="0.5",cssFloat:!!E.style.cssFloat,scriptEval:false,noCloneEvent:true,boxModel:null};G.type="text/javascript";try{G.appendChild(document.createTextNode("window."+J+"=1;"))}catch(I){}F.insertBefore(G,F.firstChild);if(l[J]){o.support.scriptEval=true;delete l[J]}F.removeChild(G);if(K.attachEvent&&K.fireEvent){K.attachEvent("onclick",function(){o.support.noCloneEvent=false;K.detachEvent("onclick",arguments.callee)});K.cloneNode(true).fireEvent("onclick")}o(function(){var L=document.createElement("div");L.style.width=L.style.paddingLeft="1px";document.body.appendChild(L);o.boxModel=o.support.boxModel=L.offsetWidth===2;document.body.removeChild(L).style.display="none"})})();var w=o.support.cssFloat?"cssFloat":"styleFloat";o.props={"for":"htmlFor","class":"className","float":w,cssFloat:w,styleFloat:w,readonly:"readOnly",maxlength:"maxLength",cellspacing:"cellSpacing",rowspan:"rowSpan",tabindex:"tabIndex"};o.fn.extend({_load:o.fn.load,load:function(G,J,K){if(typeof G!=="string"){return this._load(G)}var I=G.indexOf(" ");if(I>=0){var E=G.slice(I,G.length);G=G.slice(0,I)}var H="GET";if(J){if(o.isFunction(J)){K=J;J=null}else{if(typeof J==="object"){J=o.param(J);H="POST"}}}var F=this;o.ajax({url:G,type:H,dataType:"html",data:J,complete:function(M,L){if(L=="success"||L=="notmodified"){F.html(E?o("<div/>").append(M.responseText.replace(/<script(.|\s)*?\/script>/g,"")).find(E):M.responseText)}if(K){F.each(K,[M.responseText,L,M])}}});return this},serialize:function(){return o.param(this.serializeArray())},serializeArray:function(){return this.map(function(){return this.elements?o.makeArray(this.elements):this}).filter(function(){return this.name&&!this.disabled&&(this.checked||/select|textarea/i.test(this.nodeName)||/text|hidden|password|search/i.test(this.type))}).map(function(E,F){var G=o(this).val();return G==null?null:o.isArray(G)?o.map(G,function(I,H){return{name:F.name,value:I}}):{name:F.name,value:G}}).get()}});o.each("ajaxStart,ajaxStop,ajaxComplete,ajaxError,ajaxSuccess,ajaxSend".split(","),function(E,F){o.fn[F]=function(G){return this.bind(F,G)}});var r=e();o.extend({get:function(E,G,H,F){if(o.isFunction(G)){H=G;G=null}return o.ajax({type:"GET",url:E,data:G,success:H,dataType:F})},getScript:function(E,F){return o.get(E,null,F,"script")},getJSON:function(E,F,G){return o.get(E,F,G,"json")},post:function(E,G,H,F){if(o.isFunction(G)){H=G;G={}}return o.ajax({type:"POST",url:E,data:G,success:H,dataType:F})},ajaxSetup:function(E){o.extend(o.ajaxSettings,E)},ajaxSettings:{url:location.href,global:true,type:"GET",contentType:"application/x-www-form-urlencoded",processData:true,async:true,xhr:function(){return l.ActiveXObject?new ActiveXObject("Microsoft.XMLHTTP"):new XMLHttpRequest()},accepts:{xml:"application/xml, text/xml",html:"text/html",script:"text/javascript, application/javascript",json:"application/json, text/javascript",text:"text/plain",_default:"*/*"}},lastModified:{},ajax:function(M){M=o.extend(true,M,o.extend(true,{},o.ajaxSettings,M));var W,F=/=\?(&|$)/g,R,V,G=M.type.toUpperCase();if(M.data&&M.processData&&typeof M.data!=="string"){M.data=o.param(M.data)}if(M.dataType=="jsonp"){if(G=="GET"){if(!M.url.match(F)){M.url+=(M.url.match(/\?/)?"&":"?")+(M.jsonp||"callback")+"=?"}}else{if(!M.data||!M.data.match(F)){M.data=(M.data?M.data+"&":"")+(M.jsonp||"callback")+"=?"}}M.dataType="json"}if(M.dataType=="json"&&(M.data&&M.data.match(F)||M.url.match(F))){W="jsonp"+r++;if(M.data){M.data=(M.data+"").replace(F,"="+W+"$1")}M.url=M.url.replace(F,"="+W+"$1");M.dataType="script";l[W]=function(X){V=X;I();L();l[W]=g;try{delete l[W]}catch(Y){}if(H){H.removeChild(T)}}}if(M.dataType=="script"&&M.cache==null){M.cache=false}if(M.cache===false&&G=="GET"){var E=e();var U=M.url.replace(/(\?|&)_=.*?(&|$)/,"$1_="+E+"$2");M.url=U+((U==M.url)?(M.url.match(/\?/)?"&":"?")+"_="+E:"")}if(M.data&&G=="GET"){M.url+=(M.url.match(/\?/)?"&":"?")+M.data;M.data=null}if(M.global&&!o.active++){o.event.trigger("ajaxStart")}var Q=/^(\w+:)?\/\/([^\/?#]+)/.exec(M.url);if(M.dataType=="script"&&G=="GET"&&Q&&(Q[1]&&Q[1]!=location.protocol||Q[2]!=location.host)){var H=document.getElementsByTagName("head")[0];var T=document.createElement("script");T.src=M.url;if(M.scriptCharset){T.charset=M.scriptCharset}if(!W){var O=false;T.onload=T.onreadystatechange=function(){if(!O&&(!this.readyState||this.readyState=="loaded"||this.readyState=="complete")){O=true;I();L();T.onload=T.onreadystatechange=null;H.removeChild(T)}}}H.appendChild(T);return g}var K=false;var J=M.xhr();if(M.username){J.open(G,M.url,M.async,M.username,M.password)}else{J.open(G,M.url,M.async)}try{if(M.data){J.setRequestHeader("Content-Type",M.contentType)}if(M.ifModified){J.setRequestHeader("If-Modified-Since",o.lastModified[M.url]||"Thu, 01 Jan 1970 00:00:00 GMT")}J.setRequestHeader("X-Requested-With","XMLHttpRequest");J.setRequestHeader("Accept",M.dataType&&M.accepts[M.dataType]?M.accepts[M.dataType]+", */*":M.accepts._default)}catch(S){}if(M.beforeSend&&M.beforeSend(J,M)===false){if(M.global&&!--o.active){o.event.trigger("ajaxStop")}J.abort();return false}if(M.global){o.event.trigger("ajaxSend",[J,M])}var N=function(X){if(J.readyState==0){if(P){clearInterval(P);P=null;if(M.global&&!--o.active){o.event.trigger("ajaxStop")}}}else{if(!K&&J&&(J.readyState==4||X=="timeout")){K=true;if(P){clearInterval(P);P=null}R=X=="timeout"?"timeout":!o.httpSuccess(J)?"error":M.ifModified&&o.httpNotModified(J,M.url)?"notmodified":"success";if(R=="success"){try{V=o.httpData(J,M.dataType,M)}catch(Z){R="parsererror"}}if(R=="success"){var Y;try{Y=J.getResponseHeader("Last-Modified")}catch(Z){}if(M.ifModified&&Y){o.lastModified[M.url]=Y}if(!W){I()}}else{o.handleError(M,J,R)}L();if(X){J.abort()}if(M.async){J=null}}}};if(M.async){var P=setInterval(N,13);if(M.timeout>0){setTimeout(function(){if(J&&!K){N("timeout")}},M.timeout)}}try{J.send(M.data)}catch(S){o.handleError(M,J,null,S)}if(!M.async){N()}function I(){if(M.success){M.success(V,R)}if(M.global){o.event.trigger("ajaxSuccess",[J,M])}}function L(){if(M.complete){M.complete(J,R)}if(M.global){o.event.trigger("ajaxComplete",[J,M])}if(M.global&&!--o.active){o.event.trigger("ajaxStop")}}return J},handleError:function(F,H,E,G){if(F.error){F.error(H,E,G)}if(F.global){o.event.trigger("ajaxError",[H,F,G])}},active:0,httpSuccess:function(F){try{return !F.status&&location.protocol=="file:"||(F.status>=200&&F.status<300)||F.status==304||F.status==1223}catch(E){}return false},httpNotModified:function(G,E){try{var H=G.getResponseHeader("Last-Modified");return G.status==304||H==o.lastModified[E]}catch(F){}return false},httpData:function(J,H,G){var F=J.getResponseHeader("content-type"),E=H=="xml"||!H&&F&&F.indexOf("xml")>=0,I=E?J.responseXML:J.responseText;if(E&&I.documentElement.tagName=="parsererror"){throw"parsererror"}if(G&&G.dataFilter){I=G.dataFilter(I,H)}if(typeof I==="string"){if(H=="script"){o.globalEval(I)}if(H=="json"){I=l["eval"]("("+I+")")}}return I},param:function(E){var G=[];function H(I,J){G[G.length]=encodeURIComponent(I)+"="+encodeURIComponent(J)}if(o.isArray(E)||E.jquery){o.each(E,function(){H(this.name,this.value)})}else{for(var F in E){if(o.isArray(E[F])){o.each(E[F],function(){H(F,this)})}else{H(F,o.isFunction(E[F])?E[F]():E[F])}}}return G.join("&").replace(/%20/g,"+")}});var m={},n,d=[["height","marginTop","marginBottom","paddingTop","paddingBottom"],["width","marginLeft","marginRight","paddingLeft","paddingRight"],["opacity"]];function t(F,E){var G={};o.each(d.concat.apply([],d.slice(0,E)),function(){G[this]=F});return G}o.fn.extend({show:function(J,L){if(J){return this.animate(t("show",3),J,L)}else{for(var H=0,F=this.length;H<F;H++){var E=o.data(this[H],"olddisplay");this[H].style.display=E||"";if(o.css(this[H],"display")==="none"){var G=this[H].tagName,K;if(m[G]){K=m[G]}else{var I=o("<"+G+" />").appendTo("body");K=I.css("display");if(K==="none"){K="block"}I.remove();m[G]=K}o.data(this[H],"olddisplay",K)}}for(var H=0,F=this.length;H<F;H++){this[H].style.display=o.data(this[H],"olddisplay")||""}return this}},hide:function(H,I){if(H){return this.animate(t("hide",3),H,I)}else{for(var G=0,F=this.length;G<F;G++){var E=o.data(this[G],"olddisplay");if(!E&&E!=="none"){o.data(this[G],"olddisplay",o.css(this[G],"display"))}}for(var G=0,F=this.length;G<F;G++){this[G].style.display="none"}return this}},_toggle:o.fn.toggle,toggle:function(G,F){var E=typeof G==="boolean";return o.isFunction(G)&&o.isFunction(F)?this._toggle.apply(this,arguments):G==null||E?this.each(function(){var H=E?G:o(this).is(":hidden");o(this)[H?"show":"hide"]()}):this.animate(t("toggle",3),G,F)},fadeTo:function(E,G,F){return this.animate({opacity:G},E,F)},animate:function(I,F,H,G){var E=o.speed(F,H,G);return this[E.queue===false?"each":"queue"](function(){var K=o.extend({},E),M,L=this.nodeType==1&&o(this).is(":hidden"),J=this;for(M in I){if(I[M]=="hide"&&L||I[M]=="show"&&!L){return K.complete.call(this)}if((M=="height"||M=="width")&&this.style){K.display=o.css(this,"display");K.overflow=this.style.overflow}}if(K.overflow!=null){this.style.overflow="hidden"}K.curAnim=o.extend({},I);o.each(I,function(O,S){var R=new o.fx(J,K,O);if(/toggle|show|hide/.test(S)){R[S=="toggle"?L?"show":"hide":S](I)}else{var Q=S.toString().match(/^([+-]=)?([\d+-.]+)(.*)$/),T=R.cur(true)||0;if(Q){var N=parseFloat(Q[2]),P=Q[3]||"px";if(P!="px"){J.style[O]=(N||1)+P;T=((N||1)/R.cur(true))*T;J.style[O]=T+P}if(Q[1]){N=((Q[1]=="-="?-1:1)*N)+T}R.custom(T,N,P)}else{R.custom(T,S,"")}}});return true})},stop:function(F,E){var G=o.timers;if(F){this.queue([])}this.each(function(){for(var H=G.length-1;H>=0;H--){if(G[H].elem==this){if(E){G[H](true)}G.splice(H,1)}}});if(!E){this.dequeue()}return this}});o.each({slideDown:t("show",1),slideUp:t("hide",1),slideToggle:t("toggle",1),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"}},function(E,F){o.fn[E]=function(G,H){return this.animate(F,G,H)}});o.extend({speed:function(G,H,F){var E=typeof G==="object"?G:{complete:F||!F&&H||o.isFunction(G)&&G,duration:G,easing:F&&H||H&&!o.isFunction(H)&&H};E.duration=o.fx.off?0:typeof E.duration==="number"?E.duration:o.fx.speeds[E.duration]||o.fx.speeds._default;E.old=E.complete;E.complete=function(){if(E.queue!==false){o(this).dequeue()}if(o.isFunction(E.old)){E.old.call(this)}};return E},easing:{linear:function(G,H,E,F){return E+F*G},swing:function(G,H,E,F){return((-Math.cos(G*Math.PI)/2)+0.5)*F+E}},timers:[],fx:function(F,E,G){this.options=E;this.elem=F;this.prop=G;if(!E.orig){E.orig={}}}});o.fx.prototype={update:function(){if(this.options.step){this.options.step.call(this.elem,this.now,this)}(o.fx.step[this.prop]||o.fx.step._default)(this);if((this.prop=="height"||this.prop=="width")&&this.elem.style){this.elem.style.display="block"}},cur:function(F){if(this.elem[this.prop]!=null&&(!this.elem.style||this.elem.style[this.prop]==null)){return this.elem[this.prop]}var E=parseFloat(o.css(this.elem,this.prop,F));return E&&E>-10000?E:parseFloat(o.curCSS(this.elem,this.prop))||0},custom:function(I,H,G){this.startTime=e();this.start=I;this.end=H;this.unit=G||this.unit||"px";this.now=this.start;this.pos=this.state=0;var E=this;function F(J){return E.step(J)}F.elem=this.elem;if(F()&&o.timers.push(F)&&!n){n=setInterval(function(){var K=o.timers;for(var J=0;J<K.length;J++){if(!K[J]()){K.splice(J--,1)}}if(!K.length){clearInterval(n);n=g}},13)}},show:function(){this.options.orig[this.prop]=o.attr(this.elem.style,this.prop);this.options.show=true;this.custom(this.prop=="width"||this.prop=="height"?1:0,this.cur());o(this.elem).show()},hide:function(){this.options.orig[this.prop]=o.attr(this.elem.style,this.prop);this.options.hide=true;this.custom(this.cur(),0)},step:function(H){var G=e();if(H||G>=this.options.duration+this.startTime){this.now=this.end;this.pos=this.state=1;this.update();this.options.curAnim[this.prop]=true;var E=true;for(var F in this.options.curAnim){if(this.options.curAnim[F]!==true){E=false}}if(E){if(this.options.display!=null){this.elem.style.overflow=this.options.overflow;this.elem.style.display=this.options.display;if(o.css(this.elem,"display")=="none"){this.elem.style.display="block"}}if(this.options.hide){o(this.elem).hide()}if(this.options.hide||this.options.show){for(var I in this.options.curAnim){o.attr(this.elem.style,I,this.options.orig[I])}}this.options.complete.call(this.elem)}return false}else{var J=G-this.startTime;this.state=J/this.options.duration;this.pos=o.easing[this.options.easing||(o.easing.swing?"swing":"linear")](this.state,J,0,1,this.options.duration);this.now=this.start+((this.end-this.start)*this.pos);this.update()}return true}};o.extend(o.fx,{speeds:{slow:600,fast:200,_default:400},step:{opacity:function(E){o.attr(E.elem.style,"opacity",E.now)},_default:function(E){if(E.elem.style&&E.elem.style[E.prop]!=null){E.elem.style[E.prop]=E.now+E.unit}else{E.elem[E.prop]=E.now}}}});if(document.documentElement.getBoundingClientRect){o.fn.offset=function(){if(!this[0]){return{top:0,left:0}}if(this[0]===this[0].ownerDocument.body){return o.offset.bodyOffset(this[0])}var G=this[0].getBoundingClientRect(),J=this[0].ownerDocument,F=J.body,E=J.documentElement,L=E.clientTop||F.clientTop||0,K=E.clientLeft||F.clientLeft||0,I=G.top+(self.pageYOffset||o.boxModel&&E.scrollTop||F.scrollTop)-L,H=G.left+(self.pageXOffset||o.boxModel&&E.scrollLeft||F.scrollLeft)-K;return{top:I,left:H}}}else{o.fn.offset=function(){if(!this[0]){return{top:0,left:0}}if(this[0]===this[0].ownerDocument.body){return o.offset.bodyOffset(this[0])}o.offset.initialized||o.offset.initialize();var J=this[0],G=J.offsetParent,F=J,O=J.ownerDocument,M,H=O.documentElement,K=O.body,L=O.defaultView,E=L.getComputedStyle(J,null),N=J.offsetTop,I=J.offsetLeft;while((J=J.parentNode)&&J!==K&&J!==H){M=L.getComputedStyle(J,null);N-=J.scrollTop,I-=J.scrollLeft;if(J===G){N+=J.offsetTop,I+=J.offsetLeft;if(o.offset.doesNotAddBorder&&!(o.offset.doesAddBorderForTableAndCells&&/^t(able|d|h)$/i.test(J.tagName))){N+=parseInt(M.borderTopWidth,10)||0,I+=parseInt(M.borderLeftWidth,10)||0}F=G,G=J.offsetParent}if(o.offset.subtractsBorderForOverflowNotVisible&&M.overflow!=="visible"){N+=parseInt(M.borderTopWidth,10)||0,I+=parseInt(M.borderLeftWidth,10)||0}E=M}if(E.position==="relative"||E.position==="static"){N+=K.offsetTop,I+=K.offsetLeft}if(E.position==="fixed"){N+=Math.max(H.scrollTop,K.scrollTop),I+=Math.max(H.scrollLeft,K.scrollLeft)}return{top:N,left:I}}}o.offset={initialize:function(){if(this.initialized){return}var L=document.body,F=document.createElement("div"),H,G,N,I,M,E,J=L.style.marginTop,K='<div style="position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;"><div></div></div><table style="position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;" cellpadding="0" cellspacing="0"><tr><td></td></tr></table>';M={position:"absolute",top:0,left:0,margin:0,border:0,width:"1px",height:"1px",visibility:"hidden"};for(E in M){F.style[E]=M[E]}F.innerHTML=K;L.insertBefore(F,L.firstChild);H=F.firstChild,G=H.firstChild,I=H.nextSibling.firstChild.firstChild;this.doesNotAddBorder=(G.offsetTop!==5);this.doesAddBorderForTableAndCells=(I.offsetTop===5);H.style.overflow="hidden",H.style.position="relative";this.subtractsBorderForOverflowNotVisible=(G.offsetTop===-5);L.style.marginTop="1px";this.doesNotIncludeMarginInBodyOffset=(L.offsetTop===0);L.style.marginTop=J;L.removeChild(F);this.initialized=true},bodyOffset:function(E){o.offset.initialized||o.offset.initialize();var G=E.offsetTop,F=E.offsetLeft;if(o.offset.doesNotIncludeMarginInBodyOffset){G+=parseInt(o.curCSS(E,"marginTop",true),10)||0,F+=parseInt(o.curCSS(E,"marginLeft",true),10)||0}return{top:G,left:F}}};o.fn.extend({position:function(){var I=0,H=0,F;if(this[0]){var G=this.offsetParent(),J=this.offset(),E=/^body|html$/i.test(G[0].tagName)?{top:0,left:0}:G.offset();J.top-=j(this,"marginTop");J.left-=j(this,"marginLeft");E.top+=j(G,"borderTopWidth");E.left+=j(G,"borderLeftWidth");F={top:J.top-E.top,left:J.left-E.left}}return F},offsetParent:function(){var E=this[0].offsetParent||document.body;while(E&&(!/^body|html$/i.test(E.tagName)&&o.css(E,"position")=="static")){E=E.offsetParent}return o(E)}});o.each(["Left","Top"],function(F,E){var G="scroll"+E;o.fn[G]=function(H){if(!this[0]){return null}return H!==g?this.each(function(){this==l||this==document?l.scrollTo(!F?H:o(l).scrollLeft(),F?H:o(l).scrollTop()):this[G]=H}):this[0]==l||this[0]==document?self[F?"pageYOffset":"pageXOffset"]||o.boxModel&&document.documentElement[G]||document.body[G]:this[0][G]}});o.each(["Height","Width"],function(I,G){var E=I?"Left":"Top",H=I?"Right":"Bottom",F=G.toLowerCase();o.fn["inner"+G]=function(){return this[0]?o.css(this[0],F,false,"padding"):null};o.fn["outer"+G]=function(K){return this[0]?o.css(this[0],F,false,K?"margin":"border"):null};var J=G.toLowerCase();o.fn[J]=function(K){return this[0]==l?document.compatMode=="CSS1Compat"&&document.documentElement["client"+G]||document.body["client"+G]:this[0]==document?Math.max(document.documentElement["client"+G],document.body["scroll"+G],document.documentElement["scroll"+G],document.body["offset"+G],document.documentElement["offset"+G]):K===g?(this.length?o.css(this[0],J):null):this.css(J,typeof K==="string"?K:K+"px")}})})();/*
 * jQuery JSONP Core Plugin 1.1.0 (2009-10-06)
 * 
 * http://code.google.com/p/jquery-jsonp/
 *
 * Copyright (c) 2009 Julian Aubourg
 *
 * This document is licensed as free software under the terms of the
 * MIT License: http://www.opensource.org/licenses/mit-license.php
 */
(function($){
	
	// ###################### UTILITIES ##
	// Test a value is neither undefined nor null
	var defined = function(v) {
		return v!==undefined && v!==null;
	},
	// Call if defined
	callIfDefined = function(method,object,parameters) {
		defined(method) && method.apply(object,parameters);
	},
	// Let the current thread running
	later = function(functor) {
		setTimeout(functor,0);
	},
	// String constants (for better minification)
	empty="",
	amp="&",
	qMark="?",
	success = "success",
	error = "error",
	
	// Head element (for faster use)
	head = $("head"),
	// Page cache
	pageCache = {},
	
	// ###################### DEFAULT OPTIONS ##
	xOptionsDefaults = {
		//beforeSend: undefined,
		//cache: false,
		callback: "C",
		//callbackParameter: undefined,
		//complete: undefined,
		//data: ""
		//dataFilter: undefined,
		//error: undefined,
		//pageCache: false,
		//success: undefined,
		//timeout: 0,		
		url: location.href
	},

	// ###################### MAIN FUNCTION ##
	jsonp = function(xOptions) {
		
		// Build data with default
		xOptions = $.extend({},xOptionsDefaults,xOptions);
		
		// References to beforeSend (for better minification) 
		var beforeSendCallback = xOptions.beforeSend,
		
		// Abort/done flag
		done = 0;
		
		// Put a temporary abort
		xOptions.abort = function() { done = 1; };

		// Call beforeSend if provided (early abort if false returned)
		if (defined(beforeSendCallback) && (beforeSendCallback(xOptions,xOptions)===false || done))
			return xOptions;

		// References to xOptions members (for better minification)
		var successCallback = xOptions.success,
		completeCallback = xOptions.complete,
		errorCallback = xOptions.error,
		dataFilter = xOptions.dataFilter,
		callbackParameter = xOptions.callbackParameter,
		successCallbackName = xOptions.callback,
		cacheFlag = xOptions.cache,
		pageCacheFlag = xOptions.pageCache,
		url = xOptions.url,
		data = xOptions.data,
		timeout = xOptions.timeout,

		// Misc variables
		splitUrl,splitData,i,j;		
		
		// Control entries
		url = defined(url)?url:empty;
		data = defined(data)?((typeof data)=="string"?data:$.param(data)):empty;
		
		// Add callback parameter if provided as option
		defined(callbackParameter)
			&& (data += (data==empty?empty:amp)+escape(callbackParameter)+"=?");
		
		// Add anticache parameter if needed
		!cacheFlag && !pageCacheFlag
			&& (data += (data==empty?empty:amp)+"_"+(new Date()).getTime()+"=");
		
		// Search for ? in url
		splitUrl = url.split(qMark);
		// Also in parameters if provided
		// (and merge arrays)
		if (data!=empty) {
			splitData = data.split(qMark);
			j = splitUrl.length-1;
			j && (splitUrl[j] += amp + splitData.shift());
			splitUrl = splitUrl.concat(splitData);
		}
		// If more than 2 ? replace the last one by the callback
		i = splitUrl.length-2;
		i && (splitUrl[i] += successCallbackName + splitUrl.pop());
		
		// Build the final url
		var finalUrl = splitUrl.join(qMark),
		
		// Utility function
		notifySuccess = function(json) {
			// Apply the data filter if provided
			defined(dataFilter) && (json = dataFilter.apply(xOptions,[json]));
			// Call success then complete
			callIfDefined(successCallback,xOptions,[json,success]);
			callIfDefined(completeCallback,xOptions,[xOptions,success]);
		},
	    notifyError = function(type) {
			// Call error then complete
			callIfDefined(errorCallback,xOptions,[xOptions,type]);
			callIfDefined(completeCallback,xOptions,[xOptions,type]);
	    },
	    
	    // Get from pageCache
	    pageCached = pageCache[finalUrl];
		
		// Check page cache
		if (pageCacheFlag && defined(pageCached)) {
			later(function() {
				// If an error was cached
				defined(pageCached.s)
				? notifySuccess(pageCached.s)
				: notifyError(error);
			});
			return xOptions;
		}
		
		
		// Create & write to the iframe (sends the request)
		// We let the hand to current code to avoid
		// pre-emptive callbacks
		
		// We also install the timeout here to avoid
		// timeout before the code has been dumped to the frame
		// (in case of insanely short timeout values)
		later(function() {
			
			// If it has been aborted, do nothing
			if (done) return;
		
			// Create an iframe & add it to the document
			var frame = $("<iframe />").appendTo(head),
			
			// Get the iframe's window and document objects
			tmp = frame[0],
			window = tmp.contentWindow || tmp.contentDocument,
			document = window.document,
			
			// Declaration of cleanup function
			cleanUp,
			
			// Declaration of timer for timeout (so we can clear it eventually)
			timeoutTimer,
			
			// Error function
			errorFunction = function (_,type) {
				// If pure error (not timeout), cache if needed
				pageCacheFlag && !defined(type) && (pageCache[finalUrl] = empty); 
				// Cleanup
				cleanUp();
				// Call error then complete
				notifyError(defined(type)?type:error);
			},
			
			// Iframe variable cleaning function
			removeVariable = function(varName) {
				window[varName] = undefined;
				try { delete window[varName]; } catch(_) {}
			},
			
			// Error callback name
			errorCallbackName = successCallbackName=="E"?"X":"E";
			
			// Control if we actually retrieved the document
			if(!defined(document)) {
				document = window;
			    window = document.getParentNode();
			}
			
			// We have to open the document before
			// declaring variables in the iframe's window
			// Don't ask me why, I have no clue
			document.open();
			
			// Install callbacks
			window[successCallbackName] = function(json) {
				// Set as treated
				done = 1;
				// Pagecache is needed
				pageCacheFlag && (pageCache[finalUrl] = {s: json});
				// Give hand back to frame
				// To finish gracefully
				later(function(){
					// Cleanup
					cleanUp();
					// Call success then complete
					notifySuccess(json);
				});
			};
			
			window[errorCallbackName] = function(state) {
				// If not treated, mark
				// then give hand back to iframe
				// for it to finish gracefully
				(!state || state=="complete") && !done++ && later(errorFunction);
			};
			
			// Clean up function (declaration)
			xOptions.abort = cleanUp = function() {
				// Clear the timeout (is it exists)
				clearTimeout(timeoutTimer);
				// Open the iframes document & clean
				document.open();
				removeVariable(errorCallbackName);
				removeVariable(successCallbackName);
				document.write(empty);
				document.close();
				frame.remove();
			};
		
			// Write to the document
			document.write([
				'<html><head><script src="',
				finalUrl,'" onload="',
				errorCallbackName,'()" onreadystatechange="',
				errorCallbackName,'(this.readyState)"></script></head><body onload="',
				errorCallbackName,'()"></body></html>'
			].join(empty)
			);
			
			// Close (makes some browsers happier)
			document.close();
			
			// If a timeout is needed, install it
			timeout>0 && (timeoutTimer = setTimeout(function(){
					!done && errorFunction(empty,"timeout");
			},timeout));
		});
		
		return xOptions;
	}
	
	// ###################### SETUP FUNCTION ##
	jsonp.setup = function(xOptions) {
		$.extend(xOptionsDefaults,xOptions);
	};

	// ###################### INSTALL in jQuery ##
	$.jsonp = jsonp;
	
})(jQuery);/* ***** BEGIN LICENSE BLOCK *****
 * Version: MPL 1.1/GPL 2.0/LGPL 2.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 * The Original Code is Plugin Check.
 *
 * The Initial Developer of the Original Code is
 * The Mozilla Foundation.
 * Portions created by the Initial Developer are Copyright (C) 2___
 * the Initial Developer. All Rights Reserved.
 *
 * Contributor(s):
 *   Austin King <aking@mozilla.com> (Original Author)
 *
 * Alternatively, the contents of this file may be used under the terms of
 * either the GNU General Public License Version 2 or later (the "GPL"), or
 * the GNU Lesser General Public License Version 2.1 or later (the "LGPL"),
 * in which case the provisions of the GPL or the LGPL are applicable instead
 * of those above. If you wish to allow use of your version of this file only
 * under the terms of either the GPL or the LGPL, and not to allow others to
 * use your version of this file under the terms of the MPL, indicate your
 * decision by deleting the provisions above and replace them with the notice
 * and other provisions required by the GPL or the LGPL. If you do not delete
 * the provisions above, a recipient may use your version of this file under
 * the terms of any one of the MPL, the GPL or the LGPL.
 *
 * ***** END LICENSE BLOCK ***** */
/**
 * Plugin Finder Service Client Library.
 * There are two layers to the mozilla.com/en-US/plugincheck/ page: The UI and the PFS2 API.
 *
 * This file is the lower level code that talks to PFS2.
 * 
 * The main entry point into the PFS2 Client API is the findPluginInfos function.
 * This funtion takes a NavigatorInfo, a list of PluginInfos, and a callback function.
 *
 * It will serially contact the PFS2 server for each plugin and analyze the results.
 * It categorizes the plugins into disableNow, vulnerable, current, outdated, and unknown
 * and the callback recieves a list of each of these types of plugins
 * 
 * @author Austin King (ozten)
 */
if (window.Pfs === undefined) { window.Pfs = {}; }
Pfs = {
    /**
     * PFS2 accepts multiple mime-types per request. What is the maximum length
     * of each mime-type field. If a plugin has too many mime-types then it
     * will get chunked into several requests
     */
    MAX_MIMES_LENGTH: 3000,
    /**
     * Timeout a PFS request after 3 seconds
     */
    TIMEOUT: 3000,
    /**
     * Endpoint for the PFS2 API .
     */
    endpoint: "error set me before using",
    /**
     * A list of well known plugin names that are *always* up to date.
     * Bug#519234 - We skip RealPlayer G2 and use RealPlayer Version Plugin instead.
     * @client
     * @private
     */
    skipPluginsNamed: ["Default Plugin", "Default Plug-in", "Mozilla Default Plug-in", "RealPlayer(tm) G2 LiveConnect-Enabled Plug-In (32-bit)"],
    /**
     * Status Code for incremental callback.
     *
     * The plugin is CURRENT, but their is also a known
     * vulnerability, so it should be disbaled as soon
     * as possible. No newer release is known to exist.
     */
    DISABLE:    "should_disable",
    /**
     * Status Code for incremental callback.
     *
     * This browser is vulnerable to exploit due to the
     * currently installed plugin version. Upgrade the plugin
     * to the latest version.
     * 
     * Also can be used as a constant with PFS2Info status field
     */
    VULNERABLE: "vulnerable",
    /**
     * Status Code for incremental callback.
     *
     * Version detection for this plugin is imprecise,
     * and at least one plugin detected with this version
     * has been reported as vulnerable. Manual inspection
     * is suggested.
     * 
     * Also can be used as a constant with PFS2Info status field
     */
    MAYBE_VULNERABLE: "maybe_vulnerable",
    /**
     * Status Code for incremental callback
     *
     * This browser has an older version of the plugin installed.
     * There are no known vulnerabilities. Upgrade the plugin
     * to the latest version.
     *
     * Also can be used as a constant with PFS2Info status field
     */
    OUTDATED:    "outdated",
    /**
     * Status Code for incremental callback.
     *
     * Version detection for this plugin is imprecise,
     * and at least one plugin detected with this version
     * has been reported as outdated. Manual inspection
     * is suggested.
     * 
     * Also can be used as a constant with PFS2Info status field
     */
    MAYBE_OUTDATED: "maybe_outdated",
    /**
     * Status Code for incremental callback
     *
     * The browser has a current versin of the plugin. Whee!
     *
     * Also can be used as a constant with PFS2Info status field
     */
    CURRENT:    "latest",
    /**
     * Status Code for incremental callback.
     *
     * The browser has a plugin that is not tracked by the PFS2 server.
     */
    UNKNOWN:    "unknown",
    /**
     * Status Code for incremental callback.
     * 
     * Indicats that the browser's plugin is actually newer
     * than any releases tracked by the PFS2 server.
     */
    NEWER:    "newer",
    /**
     * Given information about the browser and plugins installed
     * the function contacts the PFS2 Service and analyzes each
     * plugin. When completed it uses two callback functions to
     * communicate progress and completion.
     *
     * The pluginInfos is a list of PluginInfo obejcts. The PluginInfo object
     * has a mimes property. This is a space delimited list of all the mime-types the
     * plugin accepts. You may want to include your own properties on each pluginInfo object for use
     * during the incremental callback.
     * 
     * @param {object} - navigatorInfo - A suitable navigatorInfo object is created via
     * the function browserInfo in modern_browser.js, but you can create one directly... {
     *   clientOS: "Intel Mac OS X 10.5", chromeLocale: "en-US", appID: "...", appRelease: "3.5.3", appVersion: "20090824085414"
     * }
     * @param {object} - pluginInfos - A suitable pluginInfos array is created via
     * the function browserPlugins in modern_browser.js, but you can create one directly... [{
     *     plugin: {}, mimes: ["mime1 mime2"], classified: false
     * }]
     *
     * @param {function} - incrementalCallback - A function which takes one argument pfsResults. Called once
     * each time a plugin is identified via the PFS2 service.
     *
     * @param {function} - finishedCallback - A function with no arguments which is called once finding plugins
     * is completed. incremental Callback will not be called again, once this callback is invoked. It wil be invoked
     * only once.
     */
    findPluginInfos: function(navigatorInfo, pluginInfos, incrementalCallback, finishedCallback) {
        var finderState = this.createFinder(navigatorInfo, incrementalCallback, finishedCallback);
        
        // Walk through the plugins and get the metadata from PFS2
        // PFS2 is JSONP and can't be called async using jQuery.ajax
        // We'll create a queue and manage our requests
        for(var i=0; i< pluginInfos.length; i++) {            
            if (Pfs.shouldSkipPluginNamed(pluginInfos[i].detected_version) !== true) {
                finderState.findPluginQueue.push(pluginInfos[i]);    
            }
            
        }
        finderState.startFindingNextPlugin();
    },
    /**
     * Creates an instance of the PluginFinder object, which tracks
     * the state of calling the PFS2 server
     * @private
     * @returns {object}
     */
    createFinder: function(navigatorInfo, incrementalCallback, finishedCallback) {        
        var finder = {
            // A list of plugin2mimeTypes
            findPluginQueue: [],
            // A plugin2mimeTypes
            currentPlugin: null,
            currentMime: -1,
            running: true,
           /**
            * The user supplied callback for when finding plugin information is complete            
            */
            finishedFn: finishedCallback,
            incrementalCallbackFn: incrementalCallback,
            startFindingNextPlugin: function() {
                //Note unknown plugins before we start the next one
                if (this.running && this.findPluginQueue.length > 0) {
                    this.currentPlugin = this.findPluginQueue.pop();
                    this.currentMime = 0;
                    
                    this.findPluginInfo();
                } else {
                    this.finishedFn();
                }
            },
            findPluginInfo: function() {
                
                var mime = this.currentPlugin.mimes[this.currentMime];
                    
                var that = this;
                this.callPfs2(
                    { detection: this.currentPlugin.detection_type, mimetype: mime },
                    function(){ that.pfs2Success.apply(that, arguments);},
                    function(){ that.pfs2Error.apply(that, arguments);}
                );  
            },
            /**
             * Stops the finder from continuing to work it's way through plugins in the queue
             * 
             * Added to support web badges, where we are only interested in making PFS2 calls
             * until we hit our first "bad" plugin. Then we stop making calls.
             *
             * Once this method has been called, the callee will still receive a completed callback
             * @public
             * @void
             */
            stopFindingPluginInfos: function() {
               this.running = false;
            },
            /************* PFS2 below *************/
            callPfs2: function(args_in, successFn, errorFn) {
                if (Pfs.endpoint == "error set me before using") {                    
                    Pfs.e("You must configure Pfs.endpoint before using this library");
                    return false;
                }
                var args = Pfs.$.extend({}, navigatorInfo, args_in);
                
                Pfs.$.jsonp({
                    cache: true,
                    callbackParameter: "callback",
                    data: args,
                    error: errorFn,
                    retry: 3,
                    success: successFn,
                    timeout: Pfs.TIMEOUT,                    
                    url: Pfs.endpoint                    
                });
                return true;
            },            
            
            startFindingNextMimetypeOnCurrentPlugin: function() {
                this.currentMime += 1;
                if (this.currentMime < this.currentPlugin.mimes.length) {
                    this.findPluginInfo();
                } else {
                    Pfs.w("Exhausted Mime-Types...");
                    if (this.currentPlugin !== null &&
                        ! this.currentPlugin.classified) {
                        this.incrementalCallbackFn({
                            pluginInfo: this.currentPlugin,
                            pfsInfo: {},
                            status: Pfs.UNKNOWN,
                            url: ""
                        });
                        this.currentPlugin.classified = true;                        
                    }
                    this.startFindingNextPlugin();
                }
            },
            /**
             * pfs2Success JSON callback data has the following structure
             * [ 
             *   {
             *     aliases: {
             *         literal: [String, String],
             *         regex: [String]
             *              },
             *     releases: {
             *         latest: {name: String, version: String, etc},
             *         others: [{name: String, version: String, etc}]
             *               }
             *    }
             * ]
             */
            pfs2Success: function(data, status){
                var currentPluginName = this.currentPlugin.detected_version;
                if (this.currentPlugin.raw && this.currentPlugin.raw.name) {
                    currentPluginName = this.currentPlugin.raw.name;
                }
                
                var searchingResults = true;
                var pluginMatch = false;
                var pluginInfo;

                for (var i =0; i < data.length; i++) {
                    if (! searchingResults) { break; }
                    
                    // Grab the current PFS info, and ensure it's well-formed and usable.
                    var pfsInfo = data[i];
                    if (! pfsInfo.aliases ||
                       (! pfsInfo.aliases.literal  && ! pfsInfo.aliases.regex )) {
                            Pfs.e("Malformed PFS2 plugin info, no aliases");
                            break;
                    }
                    if (! pfsInfo.releases ||
                        ! pfsInfo.releases.latest) {
                            Pfs.e("Malformed PFS2 plugin info, no latest release");
                            break;
                    }
                    // Is pfsInfo the plugin we seek?
                    var searchingPluginInfo = true;
                    if (pfsInfo.aliases.literal) {
                        for(var j=0; searchingPluginInfo && j < pfsInfo.aliases.literal.length; j++) {
                            var litName = pfsInfo.aliases.literal[j];
                            
                            if (Pfs.$.trim(currentPluginName) == Pfs.$.trim(litName)) {
                                searchingResults = false;
                                searchingPluginInfo = false;
                                pluginMatch = true;
                                pluginInfo = pfsInfo;
                            }
                        }
                    }
                    if (pfsInfo.aliases.regex) {
                        for(var j=0; searchingPluginInfo && j < pfsInfo.aliases.regex.length; j++) {
                            var rxName = pfsInfo.aliases.regex[j];
                            if (new RegExp(rxName).test(currentPluginName)) {
                                searchingResults = false;
                                searchingPluginInfo = false;
                                pluginMatch = true;
                                pluginInfo = pfsInfo;
                            }
                        }
                    }
                    // This does not appear to be the plugin we're looking for,
                    // so continue.
                    if (!pluginMatch) { continue; }
                    
                    var searchPluginRelease = true;

                    // Prepare a result to be reported to detection callback
                    var to_report = {
                        pluginInfo: this.currentPlugin,
                        pfsInfo: pfsInfo,
                        status: null,
                        url: pfsInfo.releases.latest ?  
                            pfsInfo.releases.latest.url : ''
                    };
                    
                    if (pfsInfo.releases.latest) {
                        to_report.url = pfsInfo.releases.latest.url;
                        to_report.release_info = pfsInfo.releases.latest;
                        // If a detected_version is available, use it.
                        // Otherwise, fall back to just plain version.
                        var pfs_version = (pfsInfo.releases.latest.detected_version) ?
                            pfsInfo.releases.latest.detected_version :
                            pfsInfo.releases.latest.version;
                        var pl_version = this.currentPlugin.detected_version;
                        
                        switch(Pfs.compVersion(pl_version, pfs_version)) {

                            // Installed is newer than the latest in PFS
                            case 1:
				/* No exact match records 'newer', but keeplooking */
                                if (Pfs.reportPluginFn) {
                                    Pfs.reportPluginFn([pfsInfo], 'newer');
                                }
                                to_report.status = Pfs.NEWER;
                                this.currentPlugin.classified = true;
                                /* searchPluginRelease = false;
                                Bug#565252 keep searching even if we are newer than
                                the latest release, since this could be a data entry issue. */
                                break;
                            // Installed version matches latest in PFS
                            case 0:
                                // Now, let's see what the status of the latest is...
                                switch (pfsInfo.releases.latest.status) {
                                    case Pfs.VULNERABLE:
                                    case Pfs.DISABLE:
                                        to_report.status = Pfs.DISABLE;
                                        break;
                                    case Pfs.MAYBE_VULNERABLE:
                                        to_report.status = Pfs.MAYBE_VULNERABLE;
                                        break;
                                    case Pfs.MAYBE_OUTDATED:
                                        to_report.status = Pfs.MAYBE_OUTDATED;
                                        break;
                                    default:
                                        to_report.status = Pfs.CURRENT;
                                        break;
                                }
                                this.currentPlugin.classified = true;
                                searchPluginRelease = false;
                                break;

                            // Installed may be older than latest, keep looking...
                            default: 
                                break;
                        }
                    }
                    if (this.running && searchPluginRelease && pfsInfo.releases.others) {
                        var others = pfsInfo.releases.others;
                        for (var k=0; searchPluginRelease && k < others.length; k++) {
                            var c_version = (others[k].detected_version) ?
                                others[k].detected_version : others[k].version;
                            if (!c_version) {
                                continue;
                            }
                            to_report.release_info = others[k];
                            switch(Pfs.compVersion(this.currentPlugin.detected_version, c_version)) {
                                case 1:
                                    //newer than ours, keep looking
                                    break;
                                case 0:
                                    if (others[k].status == Pfs.VULNERABLE) {
                                        to_report.status = Pfs.VULNERABLE;
                                        this.currentPlugin.classified = true; 
                                    } else {                                            
                                        to_report.status = Pfs.OUTDATED;
                                        this.currentPlugin.classified = true;
                                    }
                                    searchPluginRelease = false;
                                    break;
                                case -1:
                                    //older than ours, keep looking
                                    break;
                                default:
                                    //keep looking
                                    break;
                            }
                        }
                        if (this.currentPlugin.classified !== true) {
                            // Sparse matrix of version numbers...
                            // we know about 1.0.1 and 1.0.3 in db and this browser has 1.0.2, etc
                            to_report.status = Pfs.OUTDATED;
                            this.currentPlugin.classified = true;
                        }
                    }

                    if (this.currentPlugin.classified) {
                        this.incrementalCallbackFn(to_report);
                    }
                    
                }//for over the pfs2 JSON data

                if (this.running === false || pluginMatch) {
                    
                    searchingResults = false;
                    
                    this.startFindingNextPlugin();    
                } else {
                    //none of the plugins for this mime-type were a match... try the next mime-type
                    this.startFindingNextMimetypeOnCurrentPlugin();
                }
            },
            /**
             * bad hostname, 500 server error, malformed JSON textStatus = 'error'
             * server timeout textStatus= 'timeout'
             */
            pfs2Error: function(xhr, textStatus, errorThrown){
                xhr.retry = xhr.retry -1;
                if (xhr.retry >= 0) {
                    Pfs.e("Error Type [", textStatus, "] retrying on mime/plugin ", xhr, textStatus, errorThrown, this.currentPlugin.mimes[this.currentMime], this.currentPlugin);
                    Pfs.$.jsonp(xhr);
                } else {
                    Pfs.$('table.status').replaceWith(Pfs.$('#error-panel').show());
                    Pfs.e("Doh failed on mime/plugin ", xhr, textStatus, errorThrown, this.currentPlugin.mimes[this.currentMime], this.currentPlugin);    
                }
            }            
        };
        return finder;
    },
    /**
     * Discover 
     */
    knownPluginsByMimeType: function(navigatorInfo, mimeType, incrementalCallback, finishedCallback) {        
        var pluginInfos = Pfs.simulatePlugins(mimeType);
        Pfs.listPluginInfos(navigatorInfo, pluginInfos, incrementalCallback, finishedCallback);
    },
    /**
     * @private
     */
    simulatePlugins: function(mimeType) {        
        var simulatePlugin = { length: 1, "0": {
                            name: "", description: "", version: "0",
                            length: 1, "0": {type: mimeType}}};
        return Pfs.UI.browserPlugins(simulatePlugin);
    },
    /**
     * Given information about the browser and plugins mime-types required
     * the function contacts the PFS2 Service and lists known
     * plugins. When completed it uses two callback functions to
     * communicate progress and completion.
     *
     * The pluginInfos is a list of PluginInfo obejcts. The PluginInfo object
     * has a mimes property. This is a space delimited list of all the mime-types the
     * plugin accepts. You may want to include your own properties on each pluginInfo object for use
     * during the incremental callback.
     * 
     * @param {object} - navigatorInfo - A suitable navigatorInfo object is created via
     * the function browserInfo in modern_browser.js, but you can create one directly... {
     *   clientOS: "Intel Mac OS X 10.5", chromeLocale: "en-US", appID: "...", appRelease: "3.5.3", appVersion: "20090824085414"
     * }
     * @param {object} - pluginInfos - A suitable pluginInfos array is created via
     * the function browserPlugins in modern_browser.js, but you can create one directly... [{
     *     plugin: {}, mimes: ["mime1 mime2"], classified: false
     * }]
     *
     * @param {function} - incrementalCallback - A function which takes one argument pfsResults. Called once
     * each time a plugin is listed via the PFS2 service.
     *
     * @param {function} - finishedCallback - A function with no arguments which is called once finding plugins
     * is completed. incremental Callback will not be called again, once this callback is invoked. It wil be invoked
     * only once.
     */
    listPluginInfos: function(navigatorInfo, pluginInfos, incrementalCallback, finishedCallback) {
        var listerState = this.createPluginLister(navigatorInfo, incrementalCallback, finishedCallback);        
        for(var i=0; i< pluginInfos.length; i++) {
            listerState.findPluginQueue.push(pluginInfos[i]);    
        }
        listerState.startFindingNextPlugin();
    },
    /**
     * Creates an instance of the PluginLister object, which returns
     * known plugins based on mime-types.
     * 
     * @private
     * @returns {object}
     */
    createPluginLister: function(navigatorInfo, incrementalCallback, finishedCallback) {
        var lister = this.createFinder(navigatorInfo, incrementalCallback, finishedCallback);
        /**
         * override createFinder's pfs2Success
         */
        lister.pfs2Success = function(data, status){
            for (var i =0; i < data.length; i++) {                    
                // Grab the current PFS info, and ensure it's well-formed and usable.
                var pfsInfo = data[i];
                if (! pfsInfo.aliases ||
                   (! pfsInfo.aliases.literal  && ! pfsInfo.aliases.regex )) {
                        Pfs.e("Malformed PFS2 plugin info, no aliases");
                        break;
                }
                if (! pfsInfo.releases ||
                    ! pfsInfo.releases.latest) {
                        Pfs.e("Malformed PFS2 plugin info, no latest release");
                        break;
                }
                pfsInfo.releases.latest.name = pfsInfo.aliases.literal[0];
                this.incrementalCallbackFn(pfsInfo.releases.latest);
            }
            this.startFindingNextPlugin();
        };
        return lister;
    },
    /**
     * Compares the description of two plugin versions and returns
     * either 1, 0, or -1 to indicate:
     * newer = 1
     * same = 0
     * older = -1
     * @private
     * @client
     * @param plugin1 {string} The first plugin description. Example: QuickTime Plug-in 7.6.2
     * @param plugin2 {string} The second plugin description to compare against
     * @returns {integer} The comparison results
     */
    compVersion: function(v1, v2) {
        if (v1 && v2) {
            return this.compVersionChain( this.parseVersion(v1),
                                          this.parseVersion(v2));
        } else if (v1) {
            Pfs.w("compVersion v1, v2, v2 is undefined v1=", v1, " v2=", v2);
            return 1;
        } else {
            Pfs.w("compVersion v1, v2, either v1 or v2 or both is undefined v1=", v1, " v2=", v2);
            return -1;
        }
    },    
    /**
     * Ghetto BNF:
     * A Version = description? version comment?
     * version = versionPart | versionChain
     * versionPart = digit | character
     * versionChain = versionPart (seperator versionPart)+
     * seperator = .
     * 
     * v - string like "Quicktime 3.0.12"
     * @private
     * @client
     * return a "VersionChain" which is an array of version parts example - [3, 0, 12]
     */
     parseVersion: function(v) {
        var tokens = v.split(' ');
        var versionChain = [];
    
        var inVersion = false;
        var inNumericVersion = false;
        var inCharVersion = false;
    
        var currentVersionPart = "";
        function isNumeric(c) { return ! isNaN(parseInt(c, 10)); }
        
        function isChar(c) { return "abcdefghijklmnopqrstuvwxyz".indexOf(c.toLowerCase())  >= 0; }
        
        function isSeperator(c) { return c === '.'; }
    
        function startVersion(token, j) {
            if (isNumeric(token.charAt(j))) {
                inVersion = true;
                inNumericVersion = true;
                currentVersionPart += token.charAt(j);
            } /* else {
                skip we are in the description
            }*/
        }
        
        function finishVersionPart() {
            //cleanup this versionPart        
            if (inNumericVersion) {
                versionChain.push(parseInt(currentVersionPart, 10));
                inNumericVersion = false;
            } else if (inCharVersion) {
                versionChain.push(currentVersionPart);
                inCharVersion = false;
            } else {
                Pfs.e("This should never happen", currentVersionPart, inNumericVersion, inCharVersion);
            }        
            currentVersionPart = "";
        }
        
        for(var i=0; i < tokens.length; i++){
            var token = Pfs.$.trim(tokens[i]);            
            if (token.length === 0) {
                continue;
            }
            for(var j=0; j < token.length; j++) {                
                if (inVersion) {
                    if (isNumeric(token.charAt(j))) {
                        if (inCharVersion) {
                            finishVersionPart();
                        }
                        inNumericVersion = true;
                        currentVersionPart += token.charAt(j);                
                    } else if(isSeperator(token.charAt(j))) {
                        finishVersionPart();
                    } else if(j != 0 && isChar(token.charAt(j))) {
                        //    j != 0 - We are mid-token right? 3.0pre OK 3.0 Pre BAD
                        if (inNumericVersion) {
                            finishVersionPart();
                        }
                        inCharVersion = true;
                        currentVersionPart += token.charAt(j);
                    } else if(isSeperator(token.charAt(j))) {
                        finishVersionPart();
                    } else {
                        if (inNumericVersion) {
                            finishVersionPart();
                        }
                        return versionChain;
                    }
                } else {
                    startVersion(token, j);
                }
            }
            if (inVersion) {
                //clean up previous token
                finishVersionPart();
            }
        }                
        if (! inVersion) {            
            Pfs.w("Unable to parseVersion from " + v);
        }        
        return versionChain;    
    },
    /**
     * Given two "version chains" it determines if the first is newer, the same, or older
     * than the second argument. The results is either 1, 0, or -1
     * newer = 1
     * same = 0
     * older = -1
     * @private
     * @param versionChain1 {array} A list of version components Example [5, 3, 'a']
     * @param versionChain2 {array} The other version chain to compare against
     * @returns integer
     */
    compVersionChain: function(vc1, vc2) {
        for(var i=0; i < vc1.length && i < vc2.length; i++) {
            if (vc1[i] != vc2[i]) {
                if (vc1[i] > vc2[i]) {
                    return 1;
                } else {
                    return -1;
                }
            }
        }
        if (vc1.length != vc2.length) {
            // Okay there is extra version info... is the difference significant?
            if (vc1.length > vc2.length) {
                for (var i = vc2.length; i < vc1.length; i++) {
                    var version = parseInt(vc1[i], 10);
                    if (isNaN(version) ||
                        version > 0) {
                        return 1;
                    }
                }
                return 0;
            } else {
                for (var i = vc1.length; i < vc2.length; i++) {
                    var version = parseInt(vc2[i], 10);
                    if (isNaN(version) ||
                        version > 0) {
                        return -1;
                    }
                }
                return 0;
            }
        }
        return 0;
    },
    
    /**
     * @private
     */
    shouldSkipPluginNamed: function(name) {
        // IEBug [].indexOf is undefined
        if (this.skipPluginsNamed.indexOf) {
            return this.skipPluginsNamed.indexOf(Pfs.$.trim(name)) >= 0;    
        } else {
            return this.skipPluginsNamed.join(', ').indexOf(Pfs.$.trim(name)) >= 0;
        }
    },
     
    /**
     * Creates an object that can normailze and store mime types
     * 
     * @returns {object} - the master mime instance
     */
    createMasterMime: function() {
        return {
            seen: {},
            /**
             * normalizes a mime type. Example application/x-java-applet;version=1.3
             * becomes application/x-java-applet
             */
            normalize: function(mime) {
                return mime.split(';')[0];
            }
        };
    },
    /**
     * Log an error message if there is a console
     * @variadic
     * @param {object} or {string}
     */
    e: function(msg) {if (window.console && console.error && console.error.apply) {console.error.apply(console, arguments);}},
    /**
     * Log a warning if there is a console
     * @variadic
     * @param {object} or {string}
     */
    w: function(msg) {if (window.console && console.warn && console.warn.apply) {window.console.warn.apply(window.console, arguments);}},
    /**
     * Log a warning if there is a console
     * @variadic
     * @param {object} or {string}
     */
    i: function(msg) {if (window.console && console.info && console.info.apply) {console.info.apply(console, arguments);}}
};

/*
if (window.opera) {
    window.console = window.console || {};
    console.info || (console.error = opera.postError)
    console.info || (console.warn = opera.postError)
    console.info || (console.info = opera.postError)
} else if (! window.console) {
    var ul = Pfs.$('body').append('IE Console: <ul id="console"></ul>');
    
    window.ielog = function(msg) {
        ul.append('<li>' + msg + '</li>');
    };
    window.console = {};
    console.error = window.ielog;
    console.warn = window.ielog;
    console.info = window.ielog;
    
}*/
//Bug#535030 - All PFS scripts will use Pfs.$ to access jQuery, so that additional inclusions of
// jQuery or a conflicting  library won't break jQuery or it's plugins

Pfs.$ = jQuery.noConflict();/* ***** BEGIN LICENSE BLOCK *****
 * Version: MPL 1.1/GPL 2.0/LGPL 2.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 * The Original Code is Plugin Check.
 *
 * The Initial Developer of the Original Code is
 * The Mozilla Foundation.
 * Portions created by the Initial Developer are Copyright (C) 2___
 * the Initial Developer. All Rights Reserved.
 *
 * Contributor(s):
 *   Austin King <aking@mozilla.com> (Original Author)
 *
 * Alternatively, the contents of this file may be used under the terms of
 * either the GNU General Public License Version 2 or later (the "GPL"), or
 * the GNU Lesser General Public License Version 2.1 or later (the "LGPL"),
 * in which case the provisions of the GPL or the LGPL are applicable instead
 * of those above. If you wish to allow use of your version of this file only
 * under the terms of either the GPL or the LGPL, and not to allow others to
 * use your version of this file under the terms of the MPL, indicate your
 * decision by deleting the provisions above and replace them with the notice
 * and other provisions required by the GPL or the LGPL. If you do not delete
 * the provisions above, a recipient may use your version of this file under
 * the terms of any one of the MPL, the GPL or the LGPL.
 *
 * ***** END LICENSE BLOCK ***** */

/*jslint browser: true, plusplus: false */
/*global Pfs, PluginDetect, BrowserDetect, window*/
// jslint that we should fix below
/*jslint eqeqeq: false*/
if (window.Pfs === undefined) {
    window.Pfs = {};
}

/**
 * Common JS for getting browsers ready for using PFS
 * via a web page.
 */
Pfs.UI = {
    unknownVersionPlugins: [],
    /**
     * PPK browser detection
     */
    browserDetected: BrowserDetect.detect(),
    /**
     * Enhancements to fix some bugs
     */
    fixupBrowserDetected: function() {
        if ('Explorer' === Pfs.UI.browserDetected.browser) {
	    // Two issues with BrowserDetect 
	    // 1) 7.0; and 8.0; get rid of ';'
            // 2) detected.build is currently '???', give it something decent
            Pfs.UI.browserDetected.version = '' + parseFloat(Pfs.UI.browserDetected.version, 10);
            Pfs.UI.browserDetected.build = Pfs.UI.browserDetected.version;
	    }
    },
    /**
     * Creates a navigatorInfo object from the browser's navigator objectj
     */
    browserInfo: function () {
        var appID;
        Pfs.UI.fixupBrowserDetected();
        if ('Firefox' === Pfs.UI.browserDetected.browser || 'Minefield' === Pfs.UI.browserDetected.browser) {
            appID = '{ec8030f7-c20a-464f-9b0e-13a3a9e97384}';
        } else {
            appID = Pfs.UI.browserDetected.browser;
        }
        
        // IEBug navigator.language is undefined, fallback to IE specific browserLanguage
        return {
            appID:        appID,
            appRelease:   Pfs.UI.browserDetected.version,
            appVersion:   Pfs.UI.browserDetected.build,
            clientOS:     navigator.oscpu || navigator.platform,
            chromeLocale: navigator.language || navigator.browserLanguage || 'en-US'
        };
    },
    inList: function (pluginsSeen, name) {
        // IEBug
        if (pluginsSeen.indexOf) {
            return pluginsSeen.indexOf(name) >= 0;
        } else {
            return pluginsSeen.join(', ').indexOf(name) >= 0;
        }        
    },
    /**
     * Cleans up the navigator.plugins object into a list of plugin2mimeTypes
     * 
     * Each plugin2mimeTypes has two fields
     * * plugin - the plugin Description including Version information if available
     * * mimes - An array of mime types
     * * classified - Do we know the plugins status from pfs2
     * * raw - A reference to origional navigator.plugins object
     * Eample: [{plugin: "QuickTime Plug-in 7.6.2", detection_type: "original", mimes: ["image/tiff', "image/jpeg"], classified: false, raw: {...}}]
     *
     * Cleanup includes
     * * filtering out *always* up to date plugins
     * * Special handling of plugin names for well known plugins like Java
     * @param plugins {object} The window.navigator.plugins object
     * @returns {array} A list of plugin2mimeTypes
     */
    browserPlugins: function (plugins) {
        var p = [];
        var pluginsSeen = [];
        for (var i = 0; i < plugins.length; i++) {
            var pluginInfo;
            var rawPlugin = plugins[i];
            if (Pfs.shouldSkipPluginNamed(plugins[i].name) ||
                this.shouldSkipPluginFileNamed(plugins[i].filename) ||
                Pfs.UI.inList(pluginsSeen, plugins[i].name)) {
                continue;
            }
            // Linux Totem acts like QuickTime, DivX, VLC, etc Bug#520041
            if (plugins[i].filename == "libtotem-cone-plugin.so") {
                rawPlugin = {
                    name: "Totem",
                    description: plugins[i].description,
                    length: plugins[i].length,
                    filename: plugins[i].filename
                };
                for (var m = 0; m < plugins[i].length; m++) {
                    rawPlugin[m] = plugins[i][m];
                }                
            }
            var mimes = [];
            var marcelMrceau = Pfs.createMasterMime(); /* I hate mimes */
            for (var j = 0; j < rawPlugin.length; j++) {
                var mimeType = rawPlugin[j].type;
                if (mimeType) {
                    var mm = marcelMrceau.normalize(mimeType);
                    if (marcelMrceau.seen[mm] === undefined) {
                        marcelMrceau.seen[mm] = true;
                        mimes.push(mm);
                    } 
                }            
            }
            var wrappedPlugin = Pfs.UI.browserPlugin(rawPlugin, mimes);
            if (Pfs.UI.hasVersionInfo(wrappedPlugin.detected_version) === false) {
                Pfs.UI.unknownVersionPlugins.push(rawPlugin);
                continue;
            }
            var mimeValues = [];
            if (mimes.length > 0) {
                var mimeValue = mimes[0];
                var length = mimeValue.length;
                for (var jj = 1; jj < mimes.length; jj++) {
                    length += mimes[jj].length;
                    // mime types are space delimited
                    mimeValue += " " + mimes[jj];
                    if (length > Pfs.MAX_MIMES_LENGTH &&
                        (i + 1) < mimes.length) {                        
                        mimeValues.push(mimeValue);
                        //reset
                        mimeValue = mimes[i + 1];
                        length = mimeValue.length;
                    }
                }
                mimeValues.push(mimeValue);
            }
            wrappedPlugin.mimes = mimeValues;
            
            p.push(wrappedPlugin);
            
            if (rawPlugin.name) {
                // Bug#519256 - guard against duplicate plugins
                pluginsSeen.push(plugins[i].name);    
            }
            
        }
        
        return p;
    },
    /**
     * A list of well known plugin filenams that are *always* up to date.
     * Totem being DivX, WMP, or QuickTime we'll skip. For 'VLC' Totem see browserPlugins
     * where we rename the plugin to Totem
     * 
     * @private
     */
    skipPluginsFilesNamed: ["libtotem-mully-plugin.so",
                            "libtotem-narrowspace-plugin.so",
                            "libtotem-gmp-plugin.so"],
    shouldSkipPluginFileNamed: function (filename) {
        // IEBug [].indexOf is undefined
        if (this.skipPluginsFilesNamed.indexOf) {
            return this.skipPluginsFilesNamed.indexOf(Pfs.$.trim(filename)) >= 0;    
        } else {
            return this.skipPluginsFilesNamed.join(', ').indexOf(Pfs.$.trim(filename)) >= 0;
        }
    },
    /**
     * @private
     */
    hasVersionInfo: function (versionedName) {
        if (versionedName) {
            return Pfs.parseVersion(versionedName).length > 0;
        } else {
            return false;
        }
    },
    usePinladyDetection: true,
    /**
     * Cleans up a browser's plugin info based on it's
     * name, plugin.version property (Fx 3.6 only), description, 
     * and mime types. Using this info it chooses the
     * best candidate for a version string.
     *
     * This may include special handeling 
     * for known plugins using the PluginDetect or other hooks.
     *
     * lastly it return a new plugin like object suitable for
     * use with findPluginInfos.
     * 
     * @public
     * @ui - PluginDetect dependency belongs in UI, as well as hasVerison
     *       It's not so much a name hook as override version detection
     * @returns {string} - The name of the plugin, it may be enhanced via PluginDetect or other hooks
     */
    browserPlugin: function (rawPlugin, mimes) {
        var newPlugin = {
                plugin: undefined,
                mimes: undefined, // Gets set outside of this function
                detection_type: 'original',
                classified: false,
                raw: rawPlugin
            };
        if (Pfs.UI.usePinladyDetection) {
            if (/Java.*/.test(rawPlugin.name)) {
                //Bug#519823 If we want to start using Applets again
                var j =  PluginDetect.getVersion('Java', 'getJavaInfo.jar', [0, 0, 0]);
                if (j !== null) {
                    newPlugin.detected_version = "Java Embedding Plugin " + j.replace(/,/g, '.').replace(/_/g, '.');
                } 
            } else if (/.*Flash/.test(rawPlugin.name) && ! rawPlugin.version) {
                var f = PluginDetect.getVersion('Flash');
                if (f !== null) {
                    newPlugin.detected_version = rawPlugin.name + " " + f.replace(/,/g, '.');    
                }
            } else if (/.*QuickTime.*/.test(rawPlugin.name)) {
                var q = PluginDetect.getVersion('QuickTime');
                if (q !== null) {
                    newPlugin.detected_version = "QuickTime Plug-in " + q.replace(/,/g, '.');            
                }
            } else if (/Windows Media Player Plug-in.*/.test(rawPlugin.name)) {
                var w = PluginDetect.getVersion('WindowsMediaPlayer');
                if (w !== null) {
                    newPlugin.detected_version = rawPlugin.name + " " + w.replace(/,/g, '.');
                }
            }
            /* Note: Shockwave, DevalVR, Silverlight, and VLC pinlady detection only used in exploder.js
               this is because general version detection works as well w/o instaniating the plugin */
        }
        if (newPlugin.detected_version === undefined) {
            // General case
            if (rawPlugin.version !== undefined && this.hasVersionInfo(rawPlugin.version)) {
                // TODO - Note: no name or description... to avoid multiple versions
                // Example: name 'QuickTime Plug-in 7.6.5' versionproperty '7.6.5.0'
                // we'll return only '7.6.5.0'
                newPlugin.detected_version = rawPlugin.version;
                newPlugin.detection_type = 'version_available';
            } else if (rawPlugin.name && this.hasVersionInfo(newPlugin.name)) {                
                newPlugin.detected_version = rawPlugin.name;
            } else if (rawPlugin.description && this.hasVersionInfo(rawPlugin.description)) {                
                newPlugin.detected_version = rawPlugin.description;
            } else {
                if (/.*BrowserPlus.*/.test(rawPlugin.name)) {
                    // Only used for older versions of BrowserPlus
                    var bp = "";
                    if (mimes) {
                        var re_trailing_version = /_([0-9]+\.[0-9]+\.[0-9]+)$/;
                        for (var mime in mimes) {
                            mime = mimes[mime];
                            var r = re_trailing_version.exec(mime);
                            if (r) {
                                bp = r[1];
                                break;
                            }
                        }
                    }
                    bp = name + " " + bp;
                    newPlugin.detected_version = bp;
                } else if (rawPlugin.name) {
                    newPlugin.detected_version = rawPlugin.name;
                } else {
                    newPlugin.detected_version = rawPlugin.description;
                }
            }
        }
        if (newPlugin.detected_version === undefined) {
            throw new Error('Assertion Failed', 'Attempting to return from browserPlugin without setting the plugin field with version info.');
        }
        return newPlugin;
    }
};
/*jslint browser: true */
/*global Pfs, PluginDetect, window*/

if (Pfs.$.browser.msie) {    
    window.iePlugins = [];
    var alterNavigator = function (name, description, filename, mimeType) {        
        window.iePlugins.push({
            name: name,
            description: description,
            filename: filename,
            length: 1,
            "0": {type: mimeType }
        });        
    };
    
    /* IE has no proper navigator.plugins, so we use the pinlady library
       to detect COM objects or plugins via <object> tags.
       Once we've detected an installed plugin, we set either the \
       plugin name or description to the detected version.
       Lastly we disable pinladyDetection which is an option for
       Firefox, Opera, Safari, and Chrome */
    Pfs.UI.usePinladyDetection = false;
    
    
    //Bug#519823 If we want to start using Applets again
    var j =  PluginDetect.getVersion('Java', 'getJavaInfo.jar', [0, 0, 0]);
    if (j !== null) {
        alterNavigator('Java Embedding Plugin ' + j.replace(/,/g, '.').replace(/_/g, '.'),
                       'Runs Java applets using the latest installed versions of Java.',
                       'npjp2.dll',
                       'application/x-java-applet');
    } 
    
    var f = PluginDetect.getVersion('Flash');
    if (f !== null) {
        alterNavigator('Shockwave Flash', 'Shockwave Flash ' + f.replace(/,/g, '.'), 'NPSWF32.dll', 'application/x-shockwave-flash');
    }
    
    var q = PluginDetect.getVersion('QuickTime');
    if (q !== null) {
        alterNavigator('QuickTime Plug-in ' + q.replace(/,/g, '.'),
                       'The QuickTime Plugin allows you to view a wide variety of multimedia content in web pages.',
                       'npqtplugin.dll',
                       'video/quicktime');
    }
    
    var w = PluginDetect.getVersion('WindowsMediaPlayer');
    if (q !== null) {
        alterNavigator('Windows Media Player Plug-in Dynamic Link Library',
                       q.replace(/,/g, '.'),
                       'nsdsplay.dll',
                       'video/x-ms-wmv');
    }
    var d = PluginDetect.getVersion('Shockwave');
    
    if (d !== null) {
        alterNavigator('Shockwave for Director',
                       d.replace(/,/g, '.'),
                       'np32dsw.dll',
                       'application/x-director');
    }
    var dv = PluginDetect.getVersion('DevalVR');
    if (dv !== null) {
        alterNavigator('DevalVR - QTVR player',
                       dv.replace(/,/g, '.'),
                       'jaronlanier.dll', // FIXME
                       'application/x-devalvrx');
    }
    var sl = PluginDetect.getVersion('Silverlight');
    if (sl !== null) {
        alterNavigator('Silverlight Plug-In',
                       sl.replace(/,/g, '.'),
                       'silverlight.plugin', // FIXME
                       'application/x-silverlight');
    }
    var vlc = PluginDetect.getVersion('VLC');
    if (vlc !== null) {
        alterNavigator('VLC Multimedia Plug-in',
                       vlc.replace(/,/g, '.'),
                       'npvlc.dll', // FIXME
                       'video/mp4');
    }
    
    //BrowserPlus
    var browserPlusMime = 'application/x-yahoo-browserplus_2';
    Pfs.$('body').append('<object id="__browserPlusPluginID" type="' + browserPlusMime + '"></object>');
    var bp = Pfs.$('#__browserPlusPluginID').get(0);
    if (bp && bp.Info) {
        var browserPlusVersion = bp.Info().version;
        alterNavigator('BrowserPlus (from Yahoo!)',
                       'BrowserPlus ' + browserPlusVersion,
                       'npybrowserplus_' + browserPlusVersion + '.dll',
                       browserPlusMime);
    }
}/**
 * UI code for a web badge served up from mozilla.com
 */
Pfs.$(document).ready(function(){
    Pfs.endpoint = window.location.protocol + "//" + 'plugins.mozilla.org/en-us/pfs/v2';
    Pfs.UI.navInfo = Pfs.UI.browserInfo();
    var browserPlugins = Pfs.UI.browserPlugins(navigator.plugins);
    
    var incrementalCallbackFn = function (data) {        
        if (data.status == Pfs.DISABLE ||            
            data.status == Pfs.VULNERABLE ||
            data.status == Pfs.OUTDATED) {
            pfsNextImage = pfsUpdateImage;
            this.stopFindingPluginInfos();
        } 
    };
    var finishedCallbackFn = function() {
        Pfs.$('#mozilla_plugin_checker_badge').attr('src', pfsNextImage);
    };
    Pfs.findPluginInfos(Pfs.UI.navInfo, browserPlugins, incrementalCallbackFn, finishedCallbackFn);
});