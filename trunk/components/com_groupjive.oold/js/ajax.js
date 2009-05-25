 function callAHAH(url, pageElement, callMessage, errorMessage) {
     document.getElementById('gjloadmarker').innerHTML = callMessage;
     try {
     req = new XMLHttpRequest(); 
     /* e.g. Firefox */
     } catch(e) {
       try {
       req = new ActiveXObject("Msxml2.XMLHTTP");  
       /* some versions IE */
       } catch (e) {
         try {
         req = new ActiveXObject("Microsoft.XMLHTTP");  
         /* some versions IE */
         } catch (E) {
          req = false;
         } 
       } 
     }
     req.onreadystatechange
        = function() {responseAHAH(pageElement, errorMessage);};
     req.open("GET",url,true);
     req.send(null);
  }

function responseAHAH(pageElement, errorMessage) {
   if(req.readyState == 4) {
      if(req.status == 200) {
         output = req.responseText;
         document.getElementById(pageElement).innerHTML
            = output;
         } else {
         document.getElementById(pageElement).innerHTML
            = errorMessage+"\n"+responseText;
         }
         document.getElementById('gjloadmarker').innerHTML = '&nbsp;'
   		document.getElementById('gjsearchbox').style.display = "block";
      }

  }

function init() {
	// avoid autocomplete
	if(document.getElementById) {
		var obj = document.getElementById('fr_name');
	if(obj.setAttribute) obj.setAttribute('autocomplete','off');
	}
}

function fillBox(box, text) {
	if(document.getElementById) {
		document.getElementById(box).value=text;
		document.getElementById('gjsearchbox').style.display = "";
	}
}

function showAvatar(avatar){
	if(document.getElementById) {
		document.getElementById('gjavatar').src = avatar;
		document.getElementById('gjavatarbox').style.visibility = "visible";
	}
}

function hideAvatar(){
	if(document.getElementById) {
		document.getElementById('gjavatarbox').style.visibility = "hidden";
	}
}

window.onload = init;
