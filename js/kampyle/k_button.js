
var k_button_js_revision='$Rev: 5873 $';var k_button={"ff_link":document.getElementById("kampylink"),"close_button":document.getElementById("k_close_button"),"extra_params":null,"newwindow":'',"popitup":function(url,longUrl){if(!this.newwindow.closed&&this.newwindow.location)
this.newwindow.location.href=url;else
{this.newwindow=window.open(url,'kampyle_ff','left='+((window.screenX||window.screenLeft)+10)+',top='+((window.screenY||window.screenTop)+10)+',height=502px,width=440px,resizable=false');if(!this.newwindow.opener)this.newwindow.opener=self;}
if(window.focus)
this.newwindow.focus()
if(longUrl!='kampyle_ff')
this.newwindow.name=longUrl;return false;},"Set_Cookie":function(name,value,expires,path,domain,secure)
{var today=new Date();today.setTime(today.getTime());if(expires)
expires=expires*1000*60*60*24;var expires_date=new Date(today.getTime()+(expires));document.cookie=name+"="+escape(value)+
((expires)?";expires="+expires_date.toGMTString():"")+
((path)?";path="+path:"")+
((domain)?";domain="+domain:"")+
((secure)?";secure":"");},"Get_Cookie":function(name)
{var start=document.cookie.indexOf(name+"=");var len=start+name.length+1;if((!start)&&(name!=document.cookie.substring(0,name.length)))
return null;if(start==-1)return null;var end=document.cookie.indexOf(";",len);if(end==-1)end=document.cookie.length;return unescape(document.cookie.substring(len,end));},"get_main_domain":function()
{var domain=document.domain;if(document.domain!="undefined"&&document.domain!="")
{if(document.domain=='localhost')
main_domain='';else
{var dots=domain.split(/\./g);var tld=dots[dots.length-1];var sTlds=['COM','EDU','NET','ORG','GOV','MIL','INT'];var mDotsLength=3;for(var i in sTlds)
{if(sTlds[i]==tld.toUpperCase())
mDotsLength=2;}
if(dots.length>mDotsLength)
{main_domain=dots.slice(dots.length-mDotsLength).join('.');}
else
{main_domain=domain;}}}
else
main_domain='';return main_domain;},"open_ff":function(ff_params,url)
{var stats_kvp=new Array();if(typeof(k_button_js_revision)!='undefined')
{var matches=k_button_js_revision.match(/\d+/);if(matches!=false)
{stats_kvp.push('k_button_js_revision='+matches[0]);}}
if(typeof(k_push_js_revision)!='undefined')
{var matches=k_push_js_revision.match(/\d+/);if(matches!=false)
{stats_kvp.push('k_push_js_revision='+matches[0]);}}
if(typeof(k_push_vars)!='undefined')
{if(typeof(k_push_vars['view_percentage'])!='undefined')
stats_kvp.push('view_percentage='+k_push_vars['view_percentage']);if(typeof(k_push_vars['display_after'])!='undefined')
stats_kvp.push('display_after='+k_push_vars['display_after']);}
var stats_string=stats_kvp.join("&");var main_domain=k_button.get_main_domain();k_button.Set_Cookie('k_push8','1','21','/',main_domain,'');var url2send=url||window.location.href;url2send=encodeURIComponent(url2send);if(!ff_params)
{var ff_url=k_button.ff_link.href;if(k_button.ff_link.rel=='&push=1')
ff_url=ff_url+k_button.ff_link.rel;}
else
{var ff_link_rel=k_button.ff_link.rel;k_button.ff_link.href="javascript:void(0);";k_button.ff_link.target="";k_button.ff_link.rel='';if(ff_link_rel=='nofollow')
ff_link_rel='';var main_url='';if((k_button.ff_link)&&k_button.ff_link.getAttribute('ref_server')!=null){urlParts=k_button.ff_link.getAttribute('ref_server').split("/");main_url=urlParts[2];}
else{main_url='www.kampyle.com';}
var ff_url='http://'+main_url+'/feedback_form/ff-feedback-form.php?'+ff_params+ff_link_rel;}
if(this.extra_params)
{var extra_params=this.make_query_string(this.extra_params);ff_url=ff_url+'&'+extra_params;}
if(k_button.Get_Cookie("session_start_time")!=null)
{var startTime=k_button.Get_Cookie("session_start_time");var now=(new Date()).getTime();var numOfSecondsElapsed=Math.round((now-startTime)/1000);ff_url=ff_url+'&time_on_site='+numOfSecondsElapsed;}
if(stats_string!='')
{ff_url=ff_url+'&stats='+encodeURIComponent(stats_string);}
if(!k_button.Get_Cookie("__utmv")&&window.pageTracker)
pageTracker._setVar(k_button.Get_Cookie("__utma"));var ga_url='';if(k_button.Get_Cookie("__utmz")!=null)
{var ga_url='&utmz='+encodeURIComponent(k_button.Get_Cookie("__utmz"))+'&utma='+encodeURIComponent(k_button.Get_Cookie("__utma"))+'&utmv='+encodeURIComponent(k_button.Get_Cookie("__utmv"));}
longUrl='kampyle_ff';if((ff_url.length+url2send.length)>1024)
{longUrl=url2send;url2send='noUrl';}
this.popitup(ff_url+'&url='+url2send+ga_url,longUrl);},"hide_button":function()
{k_button.ff_link.style.display="none";k_button.close_button.style.display="none";},"make_query_string":function(params)
{var query_string='';var params_tmp=[];for(var s in params)
{if((s=='u_id')||(s=='u_email'))
params[s]=params[s].replace('+','KAMP_SPEC2B');params_tmp.push(s+'='+encodeURIComponent(params[s]));}
query_string=params_tmp.join('&');return query_string;},"addCss":function(path)
{var fileref=document.createElement("link")
fileref.setAttribute("rel","stylesheet")
fileref.setAttribute("type","text/css")
fileref.setAttribute("href",path)
if(typeof fileref!="undefined")
document.getElementsByTagName("head")[0].appendChild(fileref)}}
var k_button1=k_button;if(k_button.Get_Cookie("session_start_time")==null)
{var main_domain=k_button.get_main_domain();k_button.Set_Cookie("session_start_time",(new Date()).getTime(),0,"/",main_domain,'');}
if(((screen.width<=800)&&(screen.height<=600))&&(k_button.ff_link.className!='k_static'))
{k_button.close_button.onclick=k_button.hide_button;k_button.close_button.innerHTML='X';k_button.close_button.style.display="block";}