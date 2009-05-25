// JCE Popup Javascript
var jcePopupWindow = {					
	init : function(width, height, click){
		this.width 	= width;
		this.height = height;
		this.resizeToInnerSize();
		this.centerWindow();
		if(click){
			this.noClick();
		}
	},
	// Based on a similar TinyMCE function : http://tinymce.moxiecode.com
	resizeToInnerSize : function(){
		var n, d = document, b = d.body, dw, dh, x, oh = 0;
		
		var vw = window.innerWidth || d.documentElement.clientWidth || b.clientWidth || 0;
		var vh = window.innerHeight || d.documentElement.clientHeight || b.clientHeight || 0;
		
		// Add a little if title 
		var divs = d.getElementsByTagName('div');
		for(x=0;x<divs.length;x++){
			if(divs[x].className == 'contentheading'){
				oh = divs[x].offsetHeight;
			}
		}		
		dw = this.width - vw;
		dh = (this.height - vh) + oh;

		window.resizeBy(dw, dh);
	},
	// Center Window
	centerWindow : function(){
		var x = (screen.width-parseInt(this.width))/2;
		var y = (screen.height-parseInt(this.height))/2;
	
		window.moveTo(x, y);
	},
	// Disable right click
	noClick : function(){
		var w = window, d = w.document;

		d.onmousedown = function(e){
			e = e || w.event;
			// Its IE!
			if(/msie/i.test(navigator.userAgent)){
				if(e.button == 2) return false;
			}else{
				if(e.which == 2 || e.which == 3){
					return false;
				}
			}
		}
		d.oncontextmenu = function(){
			return false;
		}
	}
}