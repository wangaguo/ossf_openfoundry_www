(function($){$.jce={Help:{options:{url:'',key:[],pattern:''},init:function(options){var key,id,n,self=this;$.extend(this.options,options);$('body').addClass('ui-jce');if($('#help-menu')){$('dd.subtopics','#help-menu').click(function(){$(this).parent('dl').children('dl').addClass('hidden');$(this).next('dl').removeClass('hidden')});this.nodes=$('dd[id]','#help-menu').click(function(e){$('dd.loading','#help-menu').removeClass('loading');self.loadItem(e.target)});$('iframe#help-iframe').load(function(){$('.loading','#help-menu').removeClass('loading')});key=this.options.key;if(!key.length){n=this.nodes[0]}else{id=key.join('.');n=document.getElementById(id)||this.nodes[0]}if(n){this.loadItem(n)}}$('#help-handle').click(function(){$('#help-menu').parent().toggle()})},loadItem:function(el){var s,n,keys,p,map;$(el).addClass('loading');var id=$(el).attr('id');if(this.options.pattern){keys=id.split('.');map={'section':keys[0]||'','category':keys[1]||'','article':keys[2]||''};p=this.options.pattern;s=p.replace(/\{\$([^\}]+)\}/g,function(a,b){return map[b]||''})}else{s=id}$('iframe#help-iframe').attr('src',this.options.url+s)}}}})(jQuery);