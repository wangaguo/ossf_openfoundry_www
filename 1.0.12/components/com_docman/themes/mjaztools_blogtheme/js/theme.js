function DMinitTheme()
{
	 DMaddPopupBehavior();
}

function DMaddPopupBehavior()
{
	var x = document.getElementsByTagName('a');
	for (var i=0;i<x.length;i++)
	{
		if (x[i].getAttribute('type') == 'popup')
		{
			x[i].onclick = function () {
				return DMpopupWindow(this.href)
			}
			x[i].title += ' (Popup)';
		}
	}
}

function DMpopupWindow(href)
{
	newwindow = window.open(href,'DOCMan Popup','height=600,width=800');
	return false;
}

function DMaddLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      oldonload();
      func();
    }
  }
}

DMaddLoadEvent(function() {
  DMinitTheme();
});
