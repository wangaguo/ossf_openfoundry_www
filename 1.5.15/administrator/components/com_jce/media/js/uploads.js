(function($){$.widget("ui.upload",{options:{labels:{browse:'Browse',alert:'Incorrect file type'},extensions:['xml'],readonly:false,width:200,task:null,button:null,iframe:false,report:null},_init:function(){var self=this;if($.browser.webkit&&/Safari/.test(navigator.userAgent)){$(window).load(function(){self._createUploader()})}else{self._createUploader()}},_createUploader:function(){var self=this,o=this.options;var re='.('+o.extensions.join('|')+')$';if(o.iframe){var iframe=this.createIFrame()}var $button=$('<button/>');var $container=$('<span/>').addClass('upload_container').insertBefore(this.element).append(this.element).hover(function(){$button.addClass('ui-state-hover')},function(){$button.removeClass('ui-state-hover')});var $input=$('<input/>').attr({'type':'text','name':$(this.element).attr('name')+'_input','placeholder':$(this.element).attr('placeholder'),}).addClass('ui-widget-content upload_text ui-corner-all').css({'width':o.width}).insertBefore($container);if(o.readonly){$input.prop('readonly','readonly').appendTo($container)}var $span=$('<span/>').addClass('upload_clear ui-icon ui-icon-circle-close').css('opacity',0.15).insertBefore($container).click(function(){$input.val('').focus();$(self.element).val('')});$button.html(o.labels.browse).button({icons:{primary:'browse'}}).css('position','static').click(function(e){e.preventDefault()});$(this.element).css({'width':'100%','height':'100%','font-size':'2em','opacity':0});$input.placeholder();$input.click(function(){if($(self.element).val()){$(this,self.element).val('')}});$button.insertBefore($(this.element));if(o.button){var btn=document.getElementById(o.button),submit=o.submit;$(btn).click(function(e){if($input.hasClass('placeholder')){$input.val('')}if(iframe){$('form').attr('target',iframe.name)}if($(self.element).val()||$input.val()){$(this).addClass('ui-state-loading');$('input[name="task"]').val(o.task||'');$('form').submit()}e.preventDefault()}).button({icons:{primary:'import'}});$container.append(btn);$('<span style="position:absolute;overflow:hidden;display:inline-block;"></span>').css({'top':$button.css('margin-top'),'left':$button.css('margin-left'),'width':$button.outerWidth(),'height':$button.outerHeight()}).insertBefore(this.element).append(this.element)}if(!window.XMLHttpRequest){$(this.element).addClass('ie_upload_input_file');$input.addClass('ie_input_text');$button.addClass('ie_button')}$(this.element).change(function(){file=self.getFileName($(this).val());if(!new RegExp(re).test(file)){alert(o.labels.alert);$(this).val('')}else{$input.val(file).addClass('upload_file').removeClass('placeholder')}})},createIFrame:function(){var self=this,o=this.options;var iframe=document.getElementById('upload_iframe');if(!iframe){iframe=document.createElement('iframe');var form=$('form');$(iframe).attr({'src':'javascript:""','name':'upload_iframe','id':'upload_iframe'}).hide().load(function(e){var n=e.target,el;try{el=n.contentWindow.document||n.contentDocument||window.frames[n.id].document}catch(ex){alert("UPLOAD SECURITY ERROR");return}if(el.location.href=='about:blank'){return}var result=el.body.innerHTML||el.documentElement.innerText||el.documentElement.textContent;if(result!=''){$('form').removeAttr('target');if(!document.getElementById(o.report)){$('form').prepend('<div id="'+o.report+'"></div>')}$('form div#'+o.report).hide().html(result).fadeIn()}if(o.button){var btn=document.getElementById(o.button);$(btn).removeClass('loading')}}).appendTo('form');if(!$.support.cssFloat){window.frames['upload_iframe'].name='upload_iframe'}$('<input/>').attr({'type':'hidden','name':'method'}).val('iframe').appendTo('form')}return iframe},getFileName:function(file){file=file.replace(/\\/g,'/');return file.substring(file.lastIndexOf('/')+1)},destroy:function(){$.Widget.prototype.destroy.apply(this,arguments)}})})(jQuery);