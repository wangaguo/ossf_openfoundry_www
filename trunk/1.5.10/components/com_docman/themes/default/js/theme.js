/**
 * DOCman 1.4.x - Joomla! Document Manager
 * @version $Id: theme.js 774 2009-01-19 09:54:47Z mathias $
 * @package DOCman_1.4
 * @copyright (C) 2003-2009 Joomlatools
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.joomlatools.eu/ Official website
 **/


// TODO DEPRECATED IN DOCMAN 1.5

/**
 * Default DOCman Theme
 *
 * Creator:  Joomlatools
 * Website:  http://www.joomlatools.eu/
 * Email:    support@joomlatools.eu
 * Revision: 1.4
 * Date:     February 2007
 **/

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

/* -------------------------------------------- */
/* -- utility functions ----------------------- */
/* -------------------------------------------- */

function DMpopupWindow(href)
{
	newwindow = window.open(href,'DOCman Popup','height=600,width=800');
	return false;
}

/* -------------------------------------------- */
/* -- page loader ----------------------------- */
/* -------------------------------------------- */

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
