if(!window.SyntaxHighlighter)var SyntaxHighlighter=function(){var a={defaults:{"class-name":"","first-line":1,"pad-line-numbers":!0,highlight:null,"smart-tabs":!0,"tab-size":4,gutter:!0,toolbar:!0,collapse:!1,"auto-links":!0,light:!1,"wrap-lines":!0,"html-script":!1},config:{useScriptTags:!0,clipboardSwf:null,toolbarItemWidth:16,toolbarItemHeight:16,bloggerMode:!1,stripBrs:!1,tagName:"pre",strings:{expandSource:"查看源码",viewSource:"显示源码",copyToClipboard:"复制",copyToClipboardConfirmation:"复制成功",print:"打印",help:"Help",alert:"",noBrush:"Can't find brush for: ",brushNotHtmlScript:"Brush wasn't configured for html-script option: ",aboutDialog:'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>About SyntaxHighlighter</title></head><body style="font-family:Geneva,Arial,Helvetica,sans-serif;background-color:#fff;color:#000;font-size:1em;text-align:center;"><div style="text-align:center;margin-top:3em;"><div style="font-size:xx-large;">SyntaxHighlighter</div><div style="font-size:.75em;margin-bottom:4em;"><div>version 2.1.382 (June 24 2010)</div><div><a href="http://alexgorbatchev.com" target="_blank" style="color:#0099FF;text-decoration:none;">http://alexgorbatchev.com</a></div><div>If you like this script, please <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=2930402" style="color:#0099FF;text-decoration:none;">donate</a> to keep development active!</div></div><div>JavaScript code syntax highlighter.</div><div>Copyright 2004-2009 Alex Gorbatchev.</div></div></body></html>'},debug:!1},vars:{discoveredBrushes:null,spaceWidth:null,printFrame:null,highlighters:{}},brushes:{},regexLib:{multiLineCComments:/\/\*[\s\S]*?\*\//gm,singleLineCComments:/\/\/.*$/gm,singleLinePerlComments:/#.*$/gm,doubleQuotedString:/"([^\\"\n]|\\.)*"/g,singleQuotedString:/'([^\\'\n]|\\.)*'/g,multiLineDoubleQuotedString:/"([^\\"]|\\.)*"/g,multiLineSingleQuotedString:/'([^\\']|\\.)*'/g,xmlComments:/(&lt;|<)!--[\s\S]*?--(&gt;|>)/gm,url:/&lt;\w+:\/\/[\w-.\/?%&=@:;]*&gt;|\w+:\/\/[\w-.\/?%&=@:;]*/g,phpScriptTags:{left:/(&lt;|<)\?=?/g,right:/\?(&gt;|>)/g},aspScriptTags:{left:/(&lt;|<)%=?/g,right:/%(&gt;|>)/g},scriptScriptTags:{left:/(&lt;|<)\s*script.*?(&gt;|>)/gi,right:/(&lt;|<)\/\s*script\s*(&gt;|>)/gi}},toolbar:{create:function(b){var e,f,g,h,c=document.createElement("DIV"),d=a.toolbar.items;c.className="toolbar";for(e in d)f=d[e],g=new f(b),h=g.create(),b.toolbarCommands[e]=g,null!=h&&("string"==typeof h&&(h=a.toolbar.createButton(h,b.id,e)),h.className+="item "+e,c.appendChild(h));return c},createButton:function(b,c,d){var e=document.createElement("a"),f=e.style,g=a.config,h=g.toolbarItemWidth,i=g.toolbarItemHeight;return e.href="#"+d,e.title=b,e.highlighterId=c,e.commandName=d,e.innerHTML=b,0==isNaN(h)&&(f.width=h+"px"),0==isNaN(i)&&(f.height=i+"px"),e.onclick=function(b){try{a.toolbar.executeCommand(this,b||window.event,this.highlighterId,this.commandName)}catch(b){a.utils.alert(b.message)}return!1},e},executeCommand:function(b,c,d,e,f){var g=a.vars.highlighters[d],h;return null==g||null==(h=g.toolbarCommands[e])?null:h.execute(b,c,f)},items:{expandSource:function(b){this.create=function(){return 1==b.getParam("collapse")?a.config.strings.expandSource:void 0},this.execute=function(a,c,d){var e=b.div;a.parentNode.removeChild(a),e.className=e.className.replace("collapsed","")}},viewSource:function(b){this.create=function(){return a.config.strings.viewSource},this.execute=function(c,d,e){var f=a.utils.fixInputString(b.originalCode).replace(/</g,"&lt;"),g=a.utils.popup("","_blank",750,400,"location=0, resizable=1, menubar=0, scrollbars=1");f=a.utils.unindent(f),g.document.write("<pre>"+f+"</pre>"),g.document.close()}},copyToClipboard:function(b){var c,d,e=b.id;this.create=function(){function d(a){var c,b="";for(c in a)b+="<param name='"+c+"' value='"+a[c]+"'/>";return b}function f(a){var c,b="";for(c in a)b+=" "+c+"='"+a[c]+"'";return b}var g,h,i,j,b=a.config;return null==b.clipboardSwf?null:(g={width:b.toolbarItemWidth,height:b.toolbarItemHeight,id:e+"_clipboard",type:"application/x-shockwave-flash",title:a.config.strings.copyToClipboard},h={allowScriptAccess:"always",wmode:"transparent",flashVars:"highlighterId="+e,menu:"false"},i=b.clipboardSwf,j=/msie/i.test(navigator.userAgent)?"<object"+f({classid:"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000",codebase:"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0"})+f(g)+">"+d(h)+d({movie:i})+"</object>":"<embed"+f(g)+f(h)+f({src:i})+"/>",c=document.createElement("div"),c.innerHTML=j,c)},this.execute=function(c,d,e){var g,f=e.command;switch(f){case"get":if(g=a.utils.unindent(a.utils.fixInputString(b.originalCode).replace(/&lt;/g,"<").replace(/&gt;/g,">").replace(/&amp;/g,"&")),!window.clipboardData)return a.utils.unindent(g);window.clipboardData.setData("text",g);case"ok":a.utils.alert(a.config.strings.copyToClipboardConfirmation);break;case"error":a.utils.alert(e.message)}}},printSource:function(b){this.create=function(){return a.config.strings.print},this.execute=function(c,d,e){function h(a,b){var d,c=b.getElementsByTagName("link");for(d=0;d<c.length;d++)"stylesheet"==c[d].rel.toLowerCase()&&/shCore\.css$/.test(c[d].href)&&a.write('<link type="text/css" rel="stylesheet" href="'+c[d].href+'"></link>')}var f=document.createElement("IFRAME"),g=null;null!=a.vars.printFrame&&document.body.removeChild(a.vars.printFrame),a.vars.printFrame=f,f.style.cssText="position:absolute;width:0px;height:0px;left:-500px;top:-500px;",document.body.appendChild(f),g=f.contentWindow.document,h(g,window.document),g.write('<div class="'+b.div.className.replace("collapsed","")+' printing">'+b.div.innerHTML+"</div>"),g.close(),f.contentWindow.focus(),f.contentWindow.print()}},about:function(b){this.create=function(){return a.config.strings.help},this.execute=function(b,c){var d=a.utils.popup("","_blank",500,250,"scrollbars=0"),e=d.document;e.write(a.config.strings.aboutDialog),e.close(),d.focus()}}}},utils:{indexOf:function(a,b,c){c=Math.max(c||0,0);for(var d=c;d<a.length;d++)if(a[d]==b)return d;return-1},guid:function(a){return a+Math.round(1e6*Math.random()).toString()},merge:function(a,b){var c={},d;for(d in a)c[d]=a[d];for(d in b)c[d]=b[d];return c},toBoolean:function(a){switch(a){case"true":return!0;case"false":return!1}return a},popup:function(a,b,c,d,e){var h,f=(screen.width-c)/2,g=(screen.height-d)/2;return e+=", left="+f+", top="+g+", width="+c+", height="+d,e=e.replace(/^,/,""),h=window.open(a,b,e),h.focus(),h},addEvent:function(a,b,c){a.attachEvent?(a["e"+b+c]=c,a[b+c]=function(){a["e"+b+c](window.event)},a.attachEvent("on"+b,a[b+c])):a.addEventListener(b,c,!1)},alert:function(b){alert(a.config.strings.alert+b)},findBrush:function(b,c){var f,g,h,d=a.vars.discoveredBrushes,e=null;if(null==d){d={};for(f in a.brushes)if(g=a.brushes[f].aliases,null!=g)for(a.brushes[f].name=f.toLowerCase(),h=0;h<g.length;h++)d[g[h]]=f;a.vars.discoveredBrushes=d}return e=a.brushes[d[b]],null==e&&0!=c&&a.utils.alert(a.config.strings.noBrush+b),e},eachLine:function(a,b){var d,c=a.split("\n");for(d=0;d<c.length;d++)c[d]=b(c[d]);return c.join("\n")},trimFirstAndLastLines:function(a){return a.replace(/^[ ]*[\n]+|[\n]*[ ]*$/g,"")},parseParams:function(a){for(var b,f,g,c={},d=new XRegExp("^\\[(?<values>(.*?))\\]$"),e=new XRegExp("(?<name>[\\w-]+)\\s*:\\s*(?<value>[\\w-%#]+|\\[.*?\\]|\".*?\"|'.*?')\\s*;?","g");null!=(b=e.exec(a));)f=b.value.replace(/^['"]|['"]$/g,""),null!=f&&d.test(f)&&(g=d.exec(f),f=g.values.length>0?g.values.split(/\s*,\s*/):[]),c[b.name]=f;return c},decorate:function(b,c){return null==b||0==b.length||"\n"==b?b:(b=b.replace(/</g,"&lt;"),b=b.replace(/ {2,}/g,function(a){var c,b="";for(c=0;c<a.length-1;c++)b+="&nbsp;";return b+" "}),null!=c&&(b=a.utils.eachLine(b,function(a){if(0==a.length)return"";var b="";return a=a.replace(/^(&nbsp;| )+/,function(a){return b=a,""}),0==a.length?b:b+'<code class="'+c+'">'+a+"</code>"})),b)},padNumber:function(a,b){for(var c=a.toString();c.length<b;)c="0"+c;return c},measureSpace:function(){var c,j,b=document.createElement("div"),d=0,e=document.body,f=a.utils.guid("measureSpace"),g='<div class="',h="</div>",i="</span>";return b.innerHTML=g+'syntaxhighlighter">'+g+'lines">'+g+'line">'+g+"content"+'"><span class="block"><span id="'+f+'">&nbsp;'+i+i+h+h+h+h,e.appendChild(b),c=document.getElementById(f),/opera/i.test(navigator.userAgent)?(j=window.getComputedStyle(c,null),d=parseInt(j.getPropertyValue("width"))):d=c.offsetWidth,e.removeChild(b),d},processTabs:function(a,b){var d,c="";for(d=0;b>d;d++)c+=" ";return a.replace(/\t/g,c)},processSmartTabs:function(b,c){function h(a,b,c){return a.substr(0,b)+f.substr(0,c)+a.substr(b+1,a.length)}var g,d=b.split("\n"),e="	",f="";for(g=0;50>g;g++)f+="                    ";return b=a.utils.eachLine(b,function(a){var b,d;if(-1==a.indexOf(e))return a;for(b=0;-1!=(b=a.indexOf(e));)d=c-b%c,a=h(a,b,d);return a})},fixInputString:function(b){var c=/<br\s*\/?>|&lt;br\s*\/?&gt;/gi;return 1==a.config.bloggerMode&&(b=b.replace(c,"\n")),1==a.config.stripBrs&&(b=b.replace(c,"")),b},trim:function(a){return a.replace(/^\s+|\s+$/g,"")},unindent:function(b){var g,h,i,c=a.utils.fixInputString(b).split("\n"),d=new Array,e=/^\s*/,f=1e3;for(g=0;g<c.length&&f>0;g++)if(h=c[g],0!=a.utils.trim(h).length){if(i=e.exec(h),null==i)return b;f=Math.min(i[0].length,f)}if(f>0)for(g=0;g<c.length;g++)c[g]=c[g].substr(f);return c.join("\n")},matchesSortCallback:function(a,b){return a.index<b.index?-1:a.index>b.index?1:a.length<b.length?-1:a.length>b.length?1:0},getMatches:function(b,c){function d(b,c){return[new a.Match(b[0],b.index,c.css)]}for(var e=0,f=null,g=[],h=c.func?c.func:d;null!=(f=c.regex.exec(b));)g=g.concat(h(f,c));return g},processUrls:function(b){var c="&lt;",d="&gt;";return b.replace(a.regexLib.url,function(a){var b="",e="";return 0==a.indexOf(c)&&(e=c,a=a.substring(c.length)),a.indexOf(d)==a.length-d.length&&(a=a.substring(0,a.length-d.length),b=d),e+'<a href="'+a+'">'+a+"</a>"+b})},getSyntaxHighlighterScriptTags:function(){var c,a=document.getElementsByTagName("script"),b=[];for(c=0;c<a.length;c++)"syntaxhighlighter"==a[c].type&&b.push(a[c]);return b},stripCData:function(b){var c="<![CDATA[",d="]]>",e=a.utils.trim(b),f=!1;return 0==e.indexOf(c)&&(e=e.substring(c.length),f=!0),e.indexOf(d)==e.length-d.length&&(e=e.substring(0,e.length-d.length),f=!0),f?e:b}},highlight:function(b,c){function d(a){var c,b=[];for(c=0;c<a.length;c++)b.push(a[c]);return b}var i,j,k,l,m,n,o,e=c?[c]:d(document.getElementsByTagName(a.config.tagName)),f="innerHTML",g=null,h=a.config;if(h.useScriptTags&&(e=e.concat(a.utils.getSyntaxHighlighterScriptTags())),0!==e.length)for(i=0;i<e.length;i++)if(j=e[i],k=a.utils.parseParams(j.className),k=a.utils.merge(b,k),l=k["brush"],null!=l){if("true"==k["html-script"]||1==a.defaults["html-script"])g=new a.HtmlScript(l),l="htmlscript";else{if(o=a.utils.findBrush(l),!o)continue;l=o.name,g=new o}m=j[f],h.useScriptTags&&(m=a.utils.stripCData(m)),k["brush-name"]=l,g.highlight(m,k),n=g.div,a.config.debug&&(n=document.createElement("textarea"),n.value=g.div.innerHTML,n.style.width="70em",n.style.height="30em"),j.parentNode.replaceChild(n,j)}},all:function(b){a.utils.addEvent(window,"load",function(){a.highlight(b)})}};return a.Match=function(a,b,c){this.value=a,this.index=b,this.length=a.length,this.css=c,this.brushName=null},a.Match.prototype.toString=function(){return this.value},a.HtmlScript=function(b){function g(a,b){for(var c=0;c<a.length;c++)a[c].index+=b}function h(b,e){var l,m,n,f=b.code,h=[],i=d.regexList,j=b.index+b.left.length,k=d.htmlScript;for(m=0;m<i.length;m++)l=a.utils.getMatches(f,i[m]),g(l,j),h=h.concat(l);for(null!=k.left&&null!=b.left&&(l=a.utils.getMatches(b.left,k.left),g(l,b.index),h=h.concat(l)),null!=k.right&&null!=b.right&&(l=a.utils.getMatches(b.right,k.right),g(l,b.index+b[0].lastIndexOf(b.right)),h=h.concat(l)),n=0;n<h.length;n++)h[n].brushName=c.name;return h}var c=a.utils.findBrush(b),d,e=new a.brushes.Xml,f=null;if(null!=c)return d=new c,this.xmlBrush=e,null==d.htmlScript?(a.utils.alert(a.config.strings.brushNotHtmlScript+b),void 0):(e.regexList.push({regex:d.htmlScript.code,func:h}),void 0)},a.HtmlScript.prototype.highlight=function(a,b){this.xmlBrush.highlight(a,b),this.div=this.xmlBrush.div},a.Highlighter=function(){},a.Highlighter.prototype={getParam:function(b,c){var d=this.params[b];return a.utils.toBoolean(null==d?c:d)},create:function(a){return document.createElement(a)},findMatches:function(b,c){var e,d=[];if(null!=b)for(e=0;e<b.length;e++)"object"==typeof b[e]&&(d=d.concat(a.utils.getMatches(c,b[e])));return d.sort(a.utils.matchesSortCallback)},removeNestedMatches:function(){var b,c,d,e,f,a=this.matches;for(b=0;b<a.length;b++)if(null!==a[b])for(c=a[b],d=c.index+c.length,e=b+1;e<a.length&&null!==a[b];e++)if(f=a[e],null!==f){if(f.index>d)break;f.index==c.index&&f.length>c.length?this.matches[b]=null:f.index>=c.index&&f.index<d&&(this.matches[e]=null)}},createDisplayLines:function(b){var h,i,j,k,l,m,n,c=b.split("\n"),d=parseInt(this.getParam("first-line")),e=this.getParam("pad-line-numbers"),f=this.getParam("highlight",[]),g=this.getParam("gutter");for(b="",1==e?e=(d+c.length-1).toString().length:1==isNaN(e)&&(e=0),h=0;h<c.length;h++)i=c[h],j=/^(&nbsp;|\s)+/.exec(i),k="alt"+(0==h%2?1:2),l=a.utils.padNumber(d+h,e),m=-1!=a.utils.indexOf(f,(d+h).toString()),n=null,null!=j&&(n=j[0].toString(),i=i.substr(n.length)),i=a.utils.trim(i),0==i.length&&(i="&nbsp;"),m&&(k+=" highlighted"),b+='<div class="line '+k+'">'+"<table>"+"<tr>"+(g?'<td class="number"><code>'+l+"</code></td>":"")+'<td class="content">'+(null!=n?'<code class="spaces">'+n.replace(" ","&nbsp;")+"</code>":"")+i+"</td>"+"</tr>"+"</table>"+"</div>";return b},processMatches:function(b,c){function h(a){var b=a?a.brushName||g:g;return b?b+" ":""}var i,j,k,d=0,e="",f=a.utils.decorate,g=this.getParam("brush-name","");for(i=0;i<c.length;i++)j=c[i],null!==j&&0!==j.length&&(k=h(j),e+=f(b.substr(d,j.index-d),k+"plain")+f(j.value,k+j.css),d=j.index+j.length);return e+=f(b.substr(d),h()+"plain")},highlight:function(b,c){function k(){j.className=j.className.replace("show","")}var f,g,h,j,d=a.config,e=a.vars,i="important";this.params={},this.div=null,this.lines=null,this.code=null,this.bar=null,this.toolbarCommands={},this.id=a.utils.guid("highlighter_"),e.highlighters[this.id]=this,null===b&&(b=""),this.params=a.utils.merge(a.defaults,c||{}),1==this.getParam("light")&&(this.params.toolbar=this.params.gutter=!1),this.div=f=this.create("DIV"),this.lines=this.create("DIV"),this.lines.className="lines",className="syntaxhighlighter",f.id=this.id,this.getParam("collapse")&&(className+=" collapsed"),0==this.getParam("gutter")&&(className+=" nogutter"),0==this.getParam("wrap-lines")&&(this.lines.className+=" no-wrap"),className+=" "+this.getParam("class-name"),className+=" "+this.getParam("brush-name"),f.className=className,this.originalCode=b,this.code=a.utils.trimFirstAndLastLines(b).replace(/\r/g," "),h=this.getParam("tab-size"),this.code=1==this.getParam("smart-tabs")?a.utils.processSmartTabs(this.code,h):a.utils.processTabs(this.code,h),this.code=a.utils.unindent(this.code),this.getParam("toolbar")&&(this.bar=this.create("DIV"),this.bar.className="bar",this.bar.appendChild(a.toolbar.create(this)),f.appendChild(this.bar),j=this.bar,f.onmouseover=function(){k(),j.className+=" show"},f.onmouseout=function(){k()}),f.appendChild(this.lines),this.matches=this.findMatches(this.regexList,this.code),this.removeNestedMatches(),b=this.processMatches(this.code,this.matches),b=this.createDisplayLines(a.utils.trim(b)),this.getParam("auto-links")&&(b=a.utils.processUrls(b)),this.lines.innerHTML=b},getKeywords:function(a){return a=a.replace(/^\s+|\s+$/g,"").replace(/\s+/g,"|"),"\\b(?:"+a+")\\b"},forHtmlScript:function(a){this.htmlScript={left:{regex:a.left,css:"script"},right:{regex:a.right,css:"script"},code:new XRegExp("(?<left>"+a.left.source+")"+"(?<code>.*?)"+"(?<right>"+a.right.source+")","sgi")}}},a}();window.XRegExp||function(){var a={exec:RegExp.prototype.exec,match:String.prototype.match,replace:String.prototype.replace,split:String.prototype.split},b={part:/(?:[^\\([#\s.]+|\\(?!k<[\w$]+>|[pP]{[^}]+})[\S\s]?|\((?=\?(?!#|<[\w$]+>)))+|(\()(?:\?(?:(#)[^)]*\)|<([$\w]+)>))?|\\(?:k<([\w$]+)>|[pP]{([^}]+)})|(\[\^?)|([\S\s])/g,replaceVar:/(?:[^$]+|\$(?![1-9$&`']|{[$\w]+}))+|\$(?:([1-9]\d*|[$&`'])|{([$\w]+)})/g,extended:/^(?:\s+|#.*)+/,quantifier:/^(?:[?*+]|{\d+(?:,\d*)?})/,classLeft:/&&\[\^?/g,classRight:/]/g},c=function(a,b,c){for(var d=c||0;d<a.length;d++)if(a[d]===b)return d;return-1},d=void 0!==/()??/.exec("")[1],e={};XRegExp=function(d,f){if(d instanceof RegExp){if(void 0!==f)throw TypeError("can't supply flags when constructing one RegExp from another");return d.addFlags()}var f=f||"",g=f.indexOf("s")>-1,h=f.indexOf("x")>-1,i=!1,j=[],k=[],l=b.part,m,n,o,p,q;for(l.lastIndex=0;m=a.exec.call(l,d);)m[2]?b.quantifier.test(d.slice(l.lastIndex))||k.push("(?:)"):m[1]?(j.push(m[3]||null),m[3]&&(i=!0),k.push("(")):m[4]?(p=c(j,m[4]),k.push(p>-1?"\\"+(p+1)+(isNaN(d.charAt(l.lastIndex))?"":"(?:)"):m[0])):m[5]?k.push(e.unicode?e.unicode.get(m[5],"P"===m[0].charAt(1)):m[0]):m[6]?"]"===d.charAt(l.lastIndex)?(k.push("["===m[6]?"(?!)":"[\\S\\s]"),l.lastIndex++):(n=XRegExp.matchRecursive("&&"+d.slice(m.index),b.classLeft,b.classRight,"",{escapeChar:"\\"})[0],k.push(m[6]+n+"]"),l.lastIndex+=n.length+1):m[7]?g&&"."===m[7]?k.push("[\\S\\s]"):h&&b.extended.test(m[7])?(o=a.exec.call(b.extended,d.slice(l.lastIndex-1))[0].length,b.quantifier.test(d.slice(l.lastIndex-1+o))||k.push("(?:)"),l.lastIndex+=o-1):k.push(m[7]):k.push(m[0]);return q=RegExp(k.join(""),a.replace.call(f,/[sx]+/g,"")),q._x={source:d,captureNames:i?j:null},q},XRegExp.addPlugin=function(a,b){e[a]=b},RegExp.prototype.exec=function(b){var c=a.exec.call(this,b),e,f,g;if(c){if(d&&c.length>1&&(g=new RegExp("^"+this.source+"$(?!\\s)",this.getNativeFlags()),a.replace.call(c[0],g,function(){for(f=1;f<arguments.length-2;f++)void 0===arguments[f]&&(c[f]=void 0)})),this._x&&this._x.captureNames)for(f=1;f<c.length;f++)e=this._x.captureNames[f-1],e&&(c[e]=c[f]);this.global&&this.lastIndex>c.index+c[0].length&&this.lastIndex--}return c}}(),RegExp.prototype.getNativeFlags=function(){return(this.global?"g":"")+(this.ignoreCase?"i":"")+(this.multiline?"m":"")+(this.extended?"x":"")+(this.sticky?"y":"")},RegExp.prototype.addFlags=function(a){var b=new XRegExp(this.source,(a||"")+this.getNativeFlags());return this._x&&(b._x={source:this._x.source,captureNames:this._x.captureNames?this._x.captureNames.slice(0):null}),b},RegExp.prototype.call=function(a,b){return this.exec(b)},RegExp.prototype.apply=function(a,b){return this.exec(b[0])},XRegExp.cache=function(a,b){var c="/"+a+"/"+(b||"");return XRegExp.cache[c]||(XRegExp.cache[c]=new XRegExp(a,b))},XRegExp.escape=function(a){return a.replace(/[-[\]{}()*+?.\\^$|,#\s]/g,"\\$&")},XRegExp.matchRecursive=function(a,b,c,d,e){var e=e||{},f=e.escapeChar,g=e.valueNames,d=d||"",h=d.indexOf("g")>-1,i=d.indexOf("i")>-1,j=d.indexOf("m")>-1,k=d.indexOf("y")>-1,d=d.replace(/y/g,""),b=b instanceof RegExp?b.global?b:b.addFlags("g"):new XRegExp(b,"g"+d),c=c instanceof RegExp?c.global?c:c.addFlags("g"):new XRegExp(c,"g"+d),l=[],m=0,n=0,o=0,p=0,q,r,s,t,u,v;if(f){if(f.length>1)throw SyntaxError("can't supply more than one escape character");if(j)throw TypeError("can't supply escape character when using the multiline flag");u=XRegExp.escape(f),v=new RegExp("^(?:"+u+"[\\S\\s]|(?:(?!"+b.source+"|"+c.source+")[^"+u+"])+)+",i?"i":"")}for(;;){if(b.lastIndex=c.lastIndex=o+(f?(v.exec(a.slice(o))||[""])[0].length:0),s=b.exec(a),t=c.exec(a),s&&t&&(s.index<=t.index?t=null:s=null),s||t)n=(s||t).index,o=(s?b:c).lastIndex;else if(!m)break;if(k&&!m&&n>p)break;if(s)m++||(q=n,r=o);else{if(!t||!m)throw b.lastIndex=c.lastIndex=0,Error("subject data contains unbalanced delimiters");if(!--m&&(g?(g[0]&&q>p&&l.push([g[0],a.slice(p,q),p,q]),g[1]&&l.push([g[1],a.slice(q,r),q,r]),g[2]&&l.push([g[2],a.slice(r,n),r,n]),g[3]&&l.push([g[3],a.slice(n,o),n,o])):l.push(a.slice(r,n)),p=o,!h))break}n===o&&o++}return h&&!k&&g&&g[0]&&a.length>p&&l.push([g[0],a.slice(p),p,a.length]),b.lastIndex=c.lastIndex=0,l};
SyntaxHighlighter.brushes.CSS = function()
{
	function getKeywordsCSS(str)
	{
		return '\\b([a-z_]|)' + str.replace(/ /g, '(?=:)\\b|\\b([a-z_\\*]|\\*|)') + '(?=:)\\b';
	};
	
	function getValuesCSS(str)
	{
		return '\\b' + str.replace(/ /g, '(?!-)(?!:)\\b|\\b()') + '\:\\b';
	};

	var keywords =	'ascent azimuth background-attachment background-color background-image background-position ' +
					'background-repeat background baseline bbox border-collapse border-color border-spacing border-style border-top ' +
					'border-right border-bottom border-left border-top-color border-right-color border-bottom-color border-left-color ' +
					'border-top-style border-right-style border-bottom-style border-left-style border-top-width border-right-width ' +
					'border-bottom-width border-left-width border-width border bottom cap-height caption-side centerline clear clip color ' +
					'content counter-increment counter-reset cue-after cue-before cue cursor definition-src descent direction display ' +
					'elevation empty-cells float font-size-adjust font-family font-size font-stretch font-style font-variant font-weight font ' +
					'height left letter-spacing line-height list-style-image list-style-position list-style-type list-style margin-top ' +
					'margin-right margin-bottom margin-left margin marker-offset marks mathline max-height max-width min-height min-width orphans ' +
					'outline-color outline-style outline-width outline overflow padding-top padding-right padding-bottom padding-left padding page ' +
					'page-break-after page-break-before page-break-inside pause pause-after pause-before pitch pitch-range play-during position ' +
					'quotes right richness size slope src speak-header speak-numeral speak-punctuation speak speech-rate stemh stemv stress ' +
					'table-layout text-align top text-decoration text-indent text-shadow text-transform unicode-bidi unicode-range units-per-em ' +
					'vertical-align visibility voice-family volume white-space widows width widths word-spacing x-height z-index';

	var values =	'above absolute all always aqua armenian attr aural auto avoid baseline behind below bidi-override black blink block blue bold bolder '+
					'both bottom braille capitalize caption center center-left center-right circle close-quote code collapse compact condensed '+
					'continuous counter counters crop cross crosshair cursive dashed decimal decimal-leading-zero default digits disc dotted double '+
					'embed embossed e-resize expanded extra-condensed extra-expanded fantasy far-left far-right fast faster fixed format fuchsia '+
					'gray green groove handheld hebrew help hidden hide high higher icon inline-table inline inset inside invert italic '+
					'justify landscape large larger left-side left leftwards level lighter lime line-through list-item local loud lower-alpha '+
					'lowercase lower-greek lower-latin lower-roman lower low ltr marker maroon medium message-box middle mix move narrower '+
					'navy ne-resize no-close-quote none no-open-quote no-repeat normal nowrap n-resize nw-resize oblique olive once open-quote outset '+
					'outside overline pointer portrait pre print projection purple red relative repeat repeat-x repeat-y rgb ridge right right-side '+
					'rightwards rtl run-in screen scroll semi-condensed semi-expanded separate se-resize show silent silver slower slow '+
					'small small-caps small-caption smaller soft solid speech spell-out square s-resize static status-bar sub super sw-resize '+
					'table-caption table-cell table-column table-column-group table-footer-group table-header-group table-row table-row-group teal '+
					'text-bottom text-top thick thin top transparent tty tv ultra-condensed ultra-expanded underline upper-alpha uppercase upper-latin '+
					'upper-roman url visible wait white wider w-resize x-fast x-high x-large x-loud x-low x-slow x-small x-soft xx-large xx-small yellow';

	var fonts =		'[mM]onospace [tT]ahoma [vV]erdana [aA]rial [hH]elvetica [sS]ans-serif [sS]erif [cC]ourier mono sans serif';
	
	this.regexList = [
		{ regex: SyntaxHighlighter.regexLib.multiLineCComments,		css: 'comments' },	// multiline comments
		{ regex: SyntaxHighlighter.regexLib.doubleQuotedString,		css: 'string' },	// double quoted strings
		{ regex: SyntaxHighlighter.regexLib.singleQuotedString,		css: 'string' },	// single quoted strings
		{ regex: /\#[a-fA-F0-9]{3,6}/g,								css: 'value' },		// html colors
		{ regex: /(-?\d+)(\.\d+)?(px|em|pt|\:|\%|)/g,				css: 'value' },		// sizes
		{ regex: /!important/g,										css: 'color3' },	// !important
		{ regex: new RegExp(getKeywordsCSS(keywords), 'gm'),		css: 'keyword' },	// keywords
		{ regex: new RegExp(getValuesCSS(values), 'g'),				css: 'value' },		// values
		{ regex: new RegExp(this.getKeywords(fonts), 'g'),			css: 'color1' }		// fonts
		];

	this.forHtmlScript({ 
		left: /(&lt;|<)\s*style.*?(&gt;|>)/gi, 
		right: /(&lt;|<)\/\s*style\s*(&gt;|>)/gi 
		});
};

SyntaxHighlighter.brushes.CSS.prototype	= new SyntaxHighlighter.Highlighter();
SyntaxHighlighter.brushes.CSS.aliases	= ['css'];


SyntaxHighlighter.brushes.JScript = function()
{
	var keywords =	'break case catch continue ' +
					'default delete do else false  ' +
					'for function if in instanceof ' +
					'new null return super switch ' +
					'this throw true try typeof var while with'
					;

	this.regexList = [
		{ regex: SyntaxHighlighter.regexLib.singleLineCComments,	css: 'comments' },			// one line comments
		{ regex: SyntaxHighlighter.regexLib.multiLineCComments,		css: 'comments' },			// multiline comments
		{ regex: SyntaxHighlighter.regexLib.doubleQuotedString,		css: 'string' },			// double quoted strings
		{ regex: SyntaxHighlighter.regexLib.singleQuotedString,		css: 'string' },			// single quoted strings
		{ regex: /\s*#.*/gm,										css: 'preprocessor' },		// preprocessor tags like #region and #endregion
		{ regex: new RegExp(this.getKeywords(keywords), 'gm'),		css: 'keyword' }			// keywords
		];
	
	this.forHtmlScript(SyntaxHighlighter.regexLib.scriptScriptTags);
};

SyntaxHighlighter.brushes.JScript.prototype	= new SyntaxHighlighter.Highlighter();
SyntaxHighlighter.brushes.JScript.aliases	= ['js', 'jscript', 'javascript'];

SyntaxHighlighter.brushes.Php = function()
{
	var funcs	=	'abs acos acosh addcslashes addslashes ' +
					'array_change_key_case array_chunk array_combine array_count_values array_diff '+
					'array_diff_assoc array_diff_key array_diff_uassoc array_diff_ukey array_fill '+
					'array_filter array_flip array_intersect array_intersect_assoc array_intersect_key '+
					'array_intersect_uassoc array_intersect_ukey array_key_exists array_keys array_map '+
					'array_merge array_merge_recursive array_multisort array_pad array_pop array_product '+
					'array_push array_rand array_reduce array_reverse array_search array_shift '+
					'array_slice array_splice array_sum array_udiff array_udiff_assoc '+
					'array_udiff_uassoc array_uintersect array_uintersect_assoc '+
					'array_uintersect_uassoc array_unique array_unshift array_values array_walk '+
					'array_walk_recursive atan atan2 atanh base64_decode base64_encode base_convert '+
					'basename bcadd bccomp bcdiv bcmod bcmul bindec bindtextdomain bzclose bzcompress '+
					'bzdecompress bzerrno bzerror bzerrstr bzflush bzopen bzread bzwrite ceil chdir '+
					'checkdate checkdnsrr chgrp chmod chop chown chr chroot chunk_split class_exists '+
					'closedir closelog copy cos cosh count count_chars date decbin dechex decoct '+
					'deg2rad delete ebcdic2ascii echo empty end ereg ereg_replace eregi eregi_replace error_log '+
					'error_reporting escapeshellarg escapeshellcmd eval exec exit exp explode extension_loaded '+
					'feof fflush fgetc fgetcsv fgets fgetss file_exists file_get_contents file_put_contents '+
					'fileatime filectime filegroup fileinode filemtime fileowner fileperms filesize filetype '+
					'floatval flock floor flush fmod fnmatch fopen fpassthru fprintf fputcsv fputs fread fscanf '+
					'fseek fsockopen fstat ftell ftok getallheaders getcwd getdate getenv gethostbyaddr gethostbyname '+
					'gethostbynamel getimagesize getlastmod getmxrr getmygid getmyinode getmypid getmyuid getopt '+
					'getprotobyname getprotobynumber getrandmax getrusage getservbyname getservbyport gettext '+
					'gettimeofday gettype glob gmdate gmmktime ini_alter ini_get ini_get_all ini_restore ini_set '+
					'interface_exists intval ip2long is_a is_array is_bool is_callable is_dir is_double '+
					'is_executable is_file is_finite is_float is_infinite is_int is_integer is_link is_long '+
					'is_nan is_null is_numeric is_object is_readable is_real is_resource is_scalar is_soap_fault '+
					'is_string is_subclass_of is_uploaded_file is_writable is_writeable mkdir mktime nl2br '+
					'parse_ini_file parse_str parse_url passthru pathinfo readlink realpath rewind rewinddir rmdir '+
					'round str_ireplace str_pad str_repeat str_replace str_rot13 str_shuffle str_split '+
					'str_word_count strcasecmp strchr strcmp strcoll strcspn strftime strip_tags stripcslashes '+
					'stripos stripslashes stristr strlen strnatcasecmp strnatcmp strncasecmp strncmp strpbrk '+
					'strpos strptime strrchr strrev strripos strrpos strspn strstr strtok strtolower strtotime '+
					'strtoupper strtr strval substr substr_compare';

	var keywords =	'and or xor array as break case ' +
					'cfunction class const continue declare default die do else ' +
					'elseif enddeclare endfor endforeach endif endswitch endwhile ' +
					'extends for foreach function include include_once global if ' +
					'new old_function return static switch use require require_once ' +
					'var while abstract interface public implements extends private protected throw';
	
	var constants	= '__FILE__ __LINE__ __METHOD__ __FUNCTION__ __CLASS__';

	this.regexList = [
		{ regex: SyntaxHighlighter.regexLib.singleLineCComments,	css: 'comments' },			// one line comments
		{ regex: SyntaxHighlighter.regexLib.multiLineCComments,		css: 'comments' },			// multiline comments
		{ regex: SyntaxHighlighter.regexLib.doubleQuotedString,		css: 'string' },			// double quoted strings
		{ regex: SyntaxHighlighter.regexLib.singleQuotedString,		css: 'string' },			// single quoted strings
		{ regex: /\$\w+/g,											css: 'variable' },			// variables
		{ regex: new RegExp(this.getKeywords(funcs), 'gmi'),		css: 'functions' },			// common functions
		{ regex: new RegExp(this.getKeywords(constants), 'gmi'),	css: 'constants' },			// constants
		{ regex: new RegExp(this.getKeywords(keywords), 'gm'),		css: 'keyword' }			// keyword
		];

	this.forHtmlScript(SyntaxHighlighter.regexLib.phpScriptTags);
};

SyntaxHighlighter.brushes.Php.prototype	= new SyntaxHighlighter.Highlighter();
SyntaxHighlighter.brushes.Php.aliases	= ['php'];

SyntaxHighlighter.brushes.Sql = function()
{
	var funcs	=	'abs avg case cast coalesce convert count current_timestamp ' +
					'current_user day isnull left lower month nullif replace right ' +
					'session_user space substring sum system_user upper user year';

	var keywords =	'absolute action add after alter as asc at authorization begin bigint ' +
					'binary bit by cascade char character check checkpoint close collate ' +
					'column commit committed connect connection constraint contains continue ' +
					'create cube current current_date current_time cursor database date ' +
					'deallocate dec decimal declare default delete desc distinct double drop ' +
					'dynamic else end end-exec escape except exec execute false fetch first ' +
					'float for force foreign forward free from full function global goto grant ' +
					'group grouping having hour ignore index inner insensitive insert instead ' +
					'int integer intersect into is isolation key last level load local max min ' +
					'minute modify move name national nchar next no numeric of off on only ' +
					'open option order out output partial password precision prepare primary ' +
					'prior privileges procedure public read real references relative repeatable ' +
					'restrict return returns revoke rollback rollup rows rule schema scroll ' +
					'second section select sequence serializable set size smallint static ' +
					'statistics table temp temporary then time timestamp to top transaction ' +
					'translation trigger true truncate uncommitted union unique update values ' +
					'varchar varying view when where with work';

	var operators =	'all and any between cross in join like not null or outer some';

	this.regexList = [
		{ regex: /--(.*)$/gm,												css: 'comments' },			// one line and multiline comments
		{ regex: SyntaxHighlighter.regexLib.multiLineDoubleQuotedString,	css: 'string' },			// double quoted strings
		{ regex: SyntaxHighlighter.regexLib.multiLineSingleQuotedString,	css: 'string' },			// single quoted strings
		{ regex: new RegExp(this.getKeywords(funcs), 'gmi'),				css: 'color2' },			// functions
		{ regex: new RegExp(this.getKeywords(operators), 'gmi'),			css: 'color1' },			// operators and such
		{ regex: new RegExp(this.getKeywords(keywords), 'gmi'),				css: 'keyword' }			// keyword
		];
};

SyntaxHighlighter.brushes.Sql.prototype	= new SyntaxHighlighter.Highlighter();
SyntaxHighlighter.brushes.Sql.aliases	= ['sql'];

SyntaxHighlighter.brushes.Xml = function()
{
	function process(match, regexInfo)
	{
		var constructor = SyntaxHighlighter.Match,
			code = match[0],
			tag = new XRegExp('(&lt;|<)[\\s\\/\\?]*(?<name>[:\\w-\\.]+)', 'xg').exec(code),
			result = []
			;
		
		if (match.attributes != null) 
		{
			var attributes,
				regex = new XRegExp('(?<name> [\\w:\\-\\.]+)' +
									'\\s*=\\s*' +
									'(?<value> ".*?"|\'.*?\'|\\w+)',
									'xg');

			while ((attributes = regex.exec(code)) != null) 
			{
				result.push(new constructor(attributes.name, match.index + attributes.index, 'color1'));
				result.push(new constructor(attributes.value, match.index + attributes.index + attributes[0].indexOf(attributes.value), 'string'));
			}
		}

		if (tag != null)
			result.push(
				new constructor(tag.name, match.index + tag[0].indexOf(tag.name), 'keyword')
			);

		return result;
	}
	
	this.regexList = [
		{ regex: new XRegExp('(\\&lt;|<)\\!\\[[\\w\\s]*?\\[(.|\\s)*?\\]\\](\\&gt;|>)', 'gm'),			css: 'color2' },	// <![ ... [ ... ]]>
		{ regex: SyntaxHighlighter.regexLib.xmlComments,												css: 'comments' },	// <!-- ... -->
		{ regex: new XRegExp('(&lt;|<)[\\s\\/\\?]*(\\w+)(?<attributes>.*?)[\\s\\/\\?]*(&gt;|>)', 'sg'), func: process }
	];
};

SyntaxHighlighter.brushes.Xml.prototype	= new SyntaxHighlighter.Highlighter();
SyntaxHighlighter.brushes.Xml.aliases	= ['xml', 'xhtml', 'xslt', 'html'];

SyntaxHighlighter.brushes.Bash = function()
{
	var keywords =	'if fi then elif else for do done until while break continue case function return in eq ne gt lt ge le';
	var commands =  'alias apropos awk basename bash bc bg builtin bzip2 cal cat cd cfdisk chgrp chmod chown chroot' +
					'cksum clear cmp comm command cp cron crontab csplit cut date dc dd ddrescue declare df ' +
					'diff diff3 dig dir dircolors dirname dirs du echo egrep eject enable env ethtool eval ' +
					'exec exit expand export expr false fdformat fdisk fg fgrep file find fmt fold format ' +
					'free fsck ftp gawk getopts grep groups gzip hash head history hostname id ifconfig ' +
					'import install join kill less let ln local locate logname logout look lpc lpr lprint ' +
					'lprintd lprintq lprm ls lsof make man mkdir mkfifo mkisofs mknod more mount mtools ' +
					'mv netstat nice nl nohup nslookup open op passwd paste pathchk ping popd pr printcap ' +
					'printenv printf ps pushd pwd quota quotacheck quotactl ram rcp read readonly renice ' +
					'remsync rm rmdir rsync screen scp sdiff sed select seq set sftp shift shopt shutdown ' +
					'sleep sort source split ssh strace su sudo sum symlink sync tail tar tee test time ' +
					'times touch top traceroute trap tr true tsort tty type ulimit umask umount unalias ' +
					'uname unexpand uniq units unset unshar useradd usermod users uuencode uudecode v vdir ' +
					'vi watch wc whereis which who whoami Wget xargs yes'
					;
	
	this.findMatches = function(regexList, code)
	{
		code = code.replace(/&gt;/g, '>').replace(/&lt;/g, '<');
		this.code = code;
		return SyntaxHighlighter.Highlighter.prototype.findMatches.apply(this, [regexList, code]);
	};

	this.regexList = [
		{ regex: SyntaxHighlighter.regexLib.singleLinePerlComments,		css: 'comments' },		// one line comments
		{ regex: SyntaxHighlighter.regexLib.doubleQuotedString,			css: 'string' },		// double quoted strings
		{ regex: SyntaxHighlighter.regexLib.singleQuotedString,			css: 'string' },		// single quoted strings
		{ regex: new RegExp(this.getKeywords(keywords), 'gm'),			css: 'keyword' },		// keywords
		{ regex: new RegExp(this.getKeywords(commands), 'gm'),			css: 'functions' }		// commands
		];
}

SyntaxHighlighter.brushes.Bash.prototype	= new SyntaxHighlighter.Highlighter();
SyntaxHighlighter.brushes.Bash.aliases		= ['bash', 'shell'];