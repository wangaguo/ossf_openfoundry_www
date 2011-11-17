(function(){var each=tinymce.each;tinymce.create('tinymce.plugins.Source',{init:function(ed,url){var self=this,DOM=tinymce.DOM;this.editor=ed;this.url=url;this.settings=tinymce.settings;this.active=[];ed.addCommand('mceSource',function(){self.toggleSource()});this.state=false;this.highlight=ed.getParam('source_higlight',1);this.numbers=ed.getParam('source_numbers',1);this.wrap=ed.getParam('source_wrap',1);this.invisibles=false;if(ed.onContextMenu){cMenu=ed.onContextMenu.addToTop(function(ed,e){if(ed.plugins.source.state){return false}})}ed.onBeforeExecCommand.add(function(ed,cmd,ui,val,o){var cm=ed.controlManager,se=self.getEditor();if(self.state&&se){switch(cmd){case'Undo':o.terminate=true;se.undo();cm.setDisabled('redo',false);return true;break;case'Redo':o.terminate=true;se.redo();cm.setDisabled('redo',true);return true;break;case'mcePrint':o.terminate=true;return self.printSource();break}}});ed.onGetContent.add(function(ed,o){if(self.getState()){self._disable();o.content=self.getContent()}});ed.onLoadContent.add(function(ed,o){if(self.getState()){self._disable();self.setContent()}});ed.onSetContent.add(function(ed,o){if(self.getState()){self.setContent();self._disable()}});ed.onSaveContent.add(function(ed,o){if(self.getState()){o.content=self.getContent()}});ed.onExecCommand.add(function(ed,cmd,ui,v,o){switch(cmd){case'mceCodeEditor':case'mceSource':self._disable();break;case'mceFullScreen':if(self.getState()){self._disable();var fs=ed.plugins.fullscreen;var w=fs.getWidth(),h=fs.getHeight();self.resize(w,h)}break;case'mceInsertContent':if(self.getState()){o.terminate=true;self._disable();self.insertContent(v)}break}});ed.addButton('source',{title:'source.source_desc',cmd:'mceSource'});ed.addButton('wrap',{title:'source.wrap_desc',onclick:function(){self.setWrap(!self.wrap);return true}});ed.addButton('highlight',{title:'source.highlight_desc',onclick:function(){self.setHighlight(!self.highlight);return true}});ed.addButton('numbers',{title:'source.numbers_desc',onclick:function(){self.setNumbers(!self.numbers);return true}});ed.onNodeChange.add(function(ed,cm,n){var s=self.getState();if(s){self._disable()}each(['wrap','highlight','numbers'],function(e){cm.setDisabled(e,!s)})});ed.theme.onResize.add(function(){self.resize()})},_disable:function(){var self=this;window.setTimeout(function(){self.toggleDisabled()},0)},getWin:function(){var ed=this.editor,f=tinymce.DOM.get('wf_'+ed.id+'_source_iframe');if(f){return f.contentWindow}return false},getDoc:function(){var w=this.getWin();if(w){return w.document}return false},getContainer:function(){var se=this.getEditor();if(se){return se.getContainer()}return null},getEditor:function(){var win=this.getWin();if(win){return win.SourceEditor||null}return null},getState:function(){return this.state},setState:function(s){this.state=s},getTop:function(){var ed=this.editor,container=ed.getContentAreaContainer();return container.offsetTop+Math.round((container.offsetHeight-container.clientHeight)/2)},printSource:function(){var self=this,ed=this.editor,DOM=tinymce.DOM,content='';var iframe=DOM.get(ed.id+'_ifr'),print=DOM.get(ed.id+'_source_print');if(se){if(!print){var print=DOM.create('iframe',{src:'javascript:""',id:ed.id+'_source_print',style:{position:'absolute',top:this.getTop()}});print.style.visibility='hidden';var parent=iframe.parentNode;parent.insertBefore(print,iframe)}var doc=print.contentWindow.document;content+=ed.settings.doctype+'<html><head xmlns="http://www.w3.org/1999/xhtml">';content+='<meta http-equiv="X-UA-Compatible" content="IE=edge" />';content+='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';var theme=this.highlight?'textmate':'';each(['editor',theme],function(s){if(s){content+='<link type="text/css" rel="stylesheet" href="'+self.url+'/css/ace/'+s+'.css" />'}});content+='</head><body><div style="position:relative;"><div class="'+ACE.renderer.getContainerElement().className+'">'+DOM.getOuterHTML(DOM.select('div.ace_layer.ace_text-layer',ACE.renderer.getContainerElement())[0])+'</div></div></body></html>';doc.open();doc.write(content);doc.close()}print.contentWindow.print()},reInit:function(){this.toggleDisabled(),se=this.getEditor();if(this.getState()&&se){se.focus()}},setContent:function(v){var ed=this.editor,DOM=tinymce.DOM,se=this.getEditor();if(typeof v=='undefined'){v=ed.getContent({no_events:true})}if(se){v=this.indent(DOM.decode(v));se.setContent(v)}},insertContent:function(v){var ed=this.editor,DOM=tinymce.DOM,se=this.getEditor();if(se){v=this.indent(DOM.decode(v));se.insertContent(v)}},getContent:function(){var ed=this.editor,DOM=tinymce.DOM,se=this.getEditor();if(se){return se.getContent()}},resize:function(w,h){if(!this.state)return;var self=this,ed=this.editor,DOM=tinymce.DOM,ifr=DOM.get(ed.id+'_ifr'),se=this.getEditor();w=parseFloat(w)||ifr.clientWidth;h=parseFloat(h)||ifr.clientHeight;if(se){DOM.setStyles('wf_'+ed.id+'_source_iframe',{'width':w,'height':h});DOM.setStyles(this.getContainer(),{'width':w,'height':h});se.resize(w,h)}},toggleDisabled:function(){var self=this,ed=this.editor,DOM=tinymce.DOM,cm=ed.controlManager;var state=this.getState();var active=DOM.select('.mceButtonActive',DOM.get(ed.id+'_toolbargroup'));if(!state){var print=DOM.get(ed.id+'_source_print');if(print){DOM.remove(print)}each(['wrap','highlight','numbers'],function(e){cm.setActive(e,false)})}each(active,function(n){cm.setActive(n.id,!state)});each(DOM.select('.mceButton, .mceListBox, .mceSplitButton',DOM.get(ed.id+'_toolbargroup')),function(n){cm.setDisabled(n.id,state)});cm.setActive('source',state);cm.setActive('fullscreen',DOM.hasClass(ed.getContainer(),'fullscreen'));cm.setDisabled('source',false);cm.setDisabled('fullscreen',false);each(['wrap','highlight','numbers'],function(e){cm.setDisabled(e,!state)})},toggleSource:function(){var self=this,ed=this.editor,DOM=tinymce.DOM,cm=ed.controlManager,textarea,cMenu;var se=this.getEditor();var state=this.getState();var iframe=DOM.get(ed.id+'_ifr');var element=ed.getElement();this.setState(!state);if(tinymce.isIE){DOM.setStyle(iframe.parentNode,'position','relative')}var editorpath=DOM.get(ed.id+'_path_row');var wordcount=DOM.get(ed.id+'-word-count');if(!state){var w=parseFloat(iframe.clientWidth);var h=parseFloat(iframe.clientHeight);if(editorpath){DOM.hide(editorpath)}if(wordcount){DOM.hide(wordcount.parentNode)}DOM.setStyle(iframe,'visiblity','hidden');DOM.setAttrib(iframe,'aria-hidden',true);this.setHighlight(this.highlight)}else{if(se){ed.setContent(self.getContent());DOM.hide('wf_'+ed.id+'_source_container');DOM.setAttrib('wf_'+ed.id+'_source_container','aria-hidden',true)}DOM.setStyle(iframe,'visiblity','visible');iframe.removeAttribute('aria-hidden');if(editorpath){DOM.show(editorpath)}if(wordcount){DOM.show(wordcount.parentNode)}ed.focus();ed.setProgressState(false)}},loadEditor:function(){var self=this,ed=this.editor,url=this.url,DOM=tinymce.DOM,iframe=DOM.get(ed.id+'_ifr');var w=iframe.clientWidth,h=iframe.clientHeight;var container=DOM.create('div',{role:'textbox',style:{position:'absolute',top:tinymce.isIE?0:this.getTop()},id:'wf_'+ed.id+'_source_container','class':'WFSourceEditor'});var parent=iframe.parentNode;DOM.insertAfter(container,iframe);var query=ed.getParam('site_url')+'index.php?option=com_jce';var args={'view':'editor','layout':'plugin','plugin':'source'};var token=DOM.get('wf_'+ed.id+'_token');if(!token){alert('INVALID TOKEN');return false}args[token.name]=token.value;for(k in args){query+='&'+k+'='+encodeURIComponent(args[k])}var iframe=DOM.create('iframe',{'frameborder':0,'scrolling':'no','id':'wf_'+ed.id+'_source_iframe','src':query,'style':{'width':w,'height':h}});tinymce.dom.Event.add(iframe,'load',function(){var editor=self.getEditor();var v=ed.getContent({no_events:true});v=v.replace(/^<br \/>$/,'');editor.init({'url':ed.getParam('site_url'),'wrap':self.wrap,'numbers':self.numbers,'highlight':self.highlight,'width':w,'height':h,'theme':ed.getParam('source_theme','textmate'),'load':function(){ed.setProgressState(false);if(tinymce.isIE&&!document.querySelector){ed.hide();ed.show()}},change:function(){ed.controlManager.setDisabled('undo',false)}},self.indent(v))});DOM.add(container,iframe)},indent:function(h){h=h.replace(/<(\/?)(ul|hr|table|meta|link|tbody|tr|object|audio|video|body|head|html|map)(|[^>]+)>\s*/g,'\n<$1$2$3>\n');h=h.replace(/\s*<(p|h[1-6]|blockquote|div|title|style|pre|script|td|li|area|param|source)(|[^>]+)>/g,'\n<$1$2>');h=h.replace(/<\/(p|h[1-6]|blockquote|div|title|style|pre|script|td|li)>\s*/g,'</$1>\n');h=h.replace(/\n\n/g,'\n');h=h.replace(/<!--\[if([^\]]*)\]>(<!)?-->/gi,'\n<!--[if$1]>$2-->');h=h.replace(/<!(--<!)?\[endif\](--)?>/gi,'<!$1[endif]$2>\n');return tinymce.trim(h)},setHighlight:function(s){var ed=this.editor,DOM=tinymce.DOM,v,n,cm=ed.controlManager,se=this.getEditor();cm.setActive('highlight',!!s);if(se){se.setHighlight(s);this.setContent();DOM.show('wf_'+ed.id+'_source_container');DOM.setAttrib('wf_'+ed.id+'_source_container','aria-hidden',false);this.resize();this.setNumbers(this.numbers);this.setWrap(this.wrap);ed.focus();ed.setProgressState(false)}else{ed.setProgressState(true);this.loadEditor()}this.highlight=!!s},setWrap:function(s){var ed=this.editor,DOM=tinymce.DOM,v,n,se=this.getEditor();var cm=ed.controlManager;this.wrap=!!s;cm.setActive('wrap',this.wrap);if(se){se.setWrap(s)}},setNumbers:function(s){var cm=this.editor.controlManager,se=this.getEditor();this.numbers=!!s;cm.setActive('numbers',this.numbers);if(se){return se.setNumbers(this.numbers)}},getInfo:function(){return{longname:'Source',author:'Ryan Demmer',authorurl:'http://www.joomlacontenteditor.net',infourl:'http://www.joomlacontenteditor.net',version:'2.0.3'}}});tinymce.PluginManager.add('source',tinymce.plugins.Source)})();