(function(){var each=tinymce.each,JSON=tinymce.util.JSON,Node=tinymce.html.Node;tinymce.create('tinymce.plugins.CodePlugin',{init:function(ed,url){var self=this;this.editor=ed;this.url=url;ed.onPreInit.add(function(){ed.parser.addNodeFilter('script',function(nodes){for(var i=0,len=nodes.length;i<len;i++){self._serializeSpan(nodes[i])}});ed.serializer.addNodeFilter('span',function(nodes,name,args){for(var i=0,len=nodes.length;i<len;i++){var node=nodes[i];if(node.name=='span'&&/mceItemScript/.test(node.attr('class'))){self._buildScript(node)}}})});ed.onInit.add(function(){if(ed.theme&&ed.theme.onResolveName){ed.theme.onResolveName.add(function(theme,o){if(o.name==='span'&&/mceItemScript/.test(o.node.className)){o.name='script'}})}if(ed.settings.content_css!==false)ed.dom.loadCSS(url+"/css/content.css")});ed.onBeforeSetContent.add(function(ed,o){if(/<(\?|script)/.test(o.content)){if(!ed.getParam('code_javascript')){o.content=o.content.replace(/<script[^>]*>([\s\S]*?)<\/script>/gi,'')}if(!ed.getParam('code_php')){o.content=o.content.replace(/<\?(php)?([\s\S]*?)\?>/gi,'')}o.content=o.content.replace(/\="([^"]+?)"/g,function(a,b){if(/<\?(php)?/.test(b)){b=ed.dom.encode(b)}return'="'+b+'"'});if(/<textarea/.test(o.content)){o.content=o.content.replace(/<textarea([^>]*)>([\s\S]*?)<\/textarea>/gi,function(a,b,c){if(/<\?(php)?/.test(c)){c=ed.dom.encode(c)}return'<textarea'+b+'>'+c+'</textarea>'})}o.content=o.content.replace(/<([^>]+)<\?(php)?(.+?)\?>([^>]*?)>/gi,function(a,b,c,d,e){if(b.charAt(b.length)!==' '){b+=' '}return'<'+b+'data-mce-php="'+d+'" '+e+'>'});o.content=o.content.replace(/<\?(php)?([\s\S]+?)\?>/gi,'<span class="mceItemPhp" data-mce-type="php"><!--PHP$2PHP--></span>')}});ed.onPostProcess.add(function(ed,o){if(o.get){if(/mceItemPhp/.test(o.content)){o.content=o.content.replace(/"(.*?)&lt;\?(php)?([^"]+)\?&gt;(.*?)"/g,function(a,b,c,d,e){return'"'+b+'<?php'+ed.dom.decode(d)+'?>'+e+'"'});o.content=o.content.replace(/<textarea([^>]*)>([\s\S]*?)<\/textarea>/gi,function(a,b,c){if(/&lt;\?php/.test(c)){c=ed.dom.decode(c)}return'<textarea'+b+'>'+c+'</textarea>'});o.content=o.content.replace(/data-mce-php="([^"]+?)"/g,function(a,b){return'<?php'+ed.dom.decode(b)+'?>'});o.content=o.content.replace(/<span([^>]+)class="mceItemPhp"([^>]+)>(<!--PHP)?([\s\S]*?)(PHP-->)?<\/span>/g,function(a,b,c,d,e){return'<?php'+ed.dom.decode(e)+'?>'})}if(/<script/.test(o.content)){o.content=o.content.replace(/<script([^>]+)>([\s\S]*?)<\/script>/g,function(a,b,c){c=self._clean(c);c=c.replace(/&nbsp;/g,' ');c=ed.dom.decode(c);if(c&&/\S*/.test(c)){if(c&&ed.getParam('code_cdata',false)){c='\n// <![CDATA[\n'+c+'\n// ]]>\n'}else{c='\n'+c+'\n'}}return'<script'+b+'>'+c+'</script>'})}}})},_buildScript:function(n){var self=this,ed=this.editor,s,node,text;if(!n.parent)return;p=JSON.parse(n.attr('data-mce-json'))||{};p.type='text/javascript';if(n.firstChild){s=self._clean(n.firstChild.value)}node=new Node('script',1);if(s){text=new Node('#text',3);text.value=tinymce.trim(s);node.append(text)}each(p,function(v,k){node.attr(k,v)});n.replace(node);return true},_serializeSpan:function(n){var self=this,ed=this.editor,dom=ed.dom,v,k,p={};if(!n.parent)return;each(n.attributes,function(at){if(at.name=='type')return;p[at.name]=at.value});var span=new Node('span',1);span.attr('class','mceItem'+this._ucfirst(n.name));span.attr('data-mce-json',JSON.serialize(p));span.attr('data-mce-type',n.name);var value=n.firstChild?n.firstChild.value:'';if(value!=''){var text=new Node('#comment',8);text.value=this._clean(value);span.append(text)}span.append(new tinymce.html.Node('#text',3)).value='\u00a0';n.replace(span)},_ucfirst:function(s){return s.charAt(0).toUpperCase()+s.substring(1)},_clean:function(s){s=s.replace(/(\/\/\s+<!\[CDATA\[)/gi,'\n');s=s.replace(/(<!--\[CDATA\[|\]\]-->)/gi,'\n');s=s.replace(/^[\r\n]*|[\r\n]*$/g,'');s=s.replace(/^\s*(\/\/\s*<!--|\/\/\s*<!\[CDATA\[|<!--|<!\[CDATA\[)[\r\n]*/gi,'');s=s.replace(/\s*(\/\/\s*\]\]>|\/\/\s*-->|\]\]>|-->|\]\]-->)\s*$/g,'');return s},getInfo:function(){return{longname:'Code',author:'Ryan Demmer',authorurl:'http://www.joomlacontenteditor.net',infourl:'http://www.joomlacontenteditor.net',version:'2.0.0beta7'}}});tinymce.PluginManager.add('code',tinymce.plugins.CodePlugin)})();