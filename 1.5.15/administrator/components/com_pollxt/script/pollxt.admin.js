function toHex (inp) {
  hex="0123456789ABCDEF";
  var out = "";
    while(inp != 0) {
        out=hex.charAt(inp%16)+out;
        inp=inp >> 4;
        }
    return out;
}

function toDec (inp) {
  return parseInt(inp,16);
}

function fadeOutRed(val) {
  document.getElementById("messageArea").style.border = "thin solid #FF0000";
  if (val < "EC") {
    val = toHex(toDec(val)+20);
    document.getElementById("messageArea").style.background = "#FF"+val+val;
    document.getElementById("messageArea").style.padding = "5px";
    setTimeout("fadeOutRed('"+val+"')", 50);

  }
}
function fadeOutGreen(val) {
  document.getElementById("messageArea").style.border = "thin solid #00FF00";
  if (val < "EC") {
    val = toHex(toDec(val)+20);
    document.getElementById("messageArea").style.background = "#"+val+"FF"+val;
    document.getElementById("messageArea").style.padding = "5px";
    setTimeout("fadeOutGreen('"+val+"')", 50);

  }
}



/////////////////////////////////////////////////////////////////
function typeChange(val) {
	multi = "edit_multisize";
    if (val=='4') {
		document.getElementById(multi).disabled = false;
	}
	else {
		document.getElementById(multi).disabled = true; 
    }
    if (val=='4' || val=='2') {
		document.getElementById("minmax").style.display = "block";
	}
	else {
		document.getElementById("minmax").style.display = "none";
    }
    if (val=='7') {
		document.getElementById("rating").style.display = "block";
	}
	else {
		document.getElementById("rating").style.display = "none";
    }
    if (val=='1' || val=='2') {
		document.getElementById("style").style.display = "block";
	}
	else {
		document.getElementById("style").style.display = "none";
    }
 }
 

function activate(id, togglePic) {
	field = document.getElementById(id);
	pic = document.getElementById(togglePic);
	if (field.value == 0) {
		document.getElementById(id).value = 1;
		
		pic.src = 'images/publish_x.png';
		pic.alt = 'inactive';
    }
    else {
		document.getElementById(id).value = 0;
		pic.src = 'images/publish_g.png';
		pic.alt = 'active';
    }
}

function getQuestion()
{
  var y = new Array ("edit_title", "edit_style", "edit_type", "edit_img_url", "edit_imgsize", "edit_imgor",
            "edit_imglink", "edit_obli", "edit_multisize", "edit_inact", "edit_minvotes", "edit_maxvotes",
			"edit_ratingval", "edit_ratingdesc", "edit_random", "edit_desc");
  var z = new Object();
  for (var el in y)
  	{
  	if (document.getElementById(y[el]))
  		val = document.getElementById(y[el]).value;
    	z[y[el]] = val;
	}

  return z;  
}
function getOption()
{
  var y = new Array ("edit_qoption", "edit_img_url", "edit_imgsize", "edit_imgor", "edit_inact",
            "edit_imglink", "edit_freetext", "edit_multicols", "edit_multirows", "edit_newopt", "edit_desc",
			"edit_linkurl", "edit_linktext");
  var z = new Object();
  for (var el in y)
  	{
  	if (document.getElementById(y[el]))
	    z[y[el]] = document.getElementById(y[el]).value;
	}

  return z;  
}


function getSelected(obj) {
  id = new Array();
  var j = 0;
  for (i = 0; i < obj.length; ++i)
    if (obj.options[i].selected == true) {
        id[j] = obj.options[i].value;
        j++}
    return id;

}

function output(ret) {
	data = JSON.parse(ret);
	document.getElementById("loadArea").style.display = "none";
	var err = ret.search(/Session Expired.+/);
	if (err != -1) {
		document.getElementById("messageArea").style.display = "block";
    	document.getElementById("messageArea").innerHTML = "Your session expired, please login again!";
     	window.setTimeout("fadeOutRed('00')", 50);
     	return;	
	}

//    if (text[0])
//     document.getElementById("pageArea").innerHTML = text[0];
    if (data.questionArea)
    	document.getElementById("questionArea").innerHTML = data.questionArea;
    if (data.optionArea)
     	document.getElementById("optionArea").innerHTML = data.optionArea;
    if (data.editArea)
     	document.getElementById("editArea").innerHTML = data.editArea;
    if (data.message) {
	 	document.getElementById("messageArea").style.display = "block";
     	document.getElementById("messageArea").innerHTML = data.message;
     	if (data.messageType == "S")
			window.setTimeout("fadeOutGreen('00')", 50);
		else
		 	window.setTimeout("fadeOutRed('00')", 50);
    }
    else 
	{
	 document.getElementById("messageArea").innerHTML = "<p></p>";
	 document.getElementById("messageArea").style.display = "none";
	}
	
	document.getElementById("ajaxQuestions").value = data.questions;
	document.getElementById("ajaxOptions").value = data.options;
	
	if (data.func) eval(data.func);

		SqueezeBox.initialize({});
		$$('a.modal').each(function(el) {
			el.addEvent('click', function(e) {
				new Event(e).stop();
				SqueezeBox.fromElement(el);
			});
		});
	
}
function getPoll() {
	pollform = document.forms["adminForm"];
	len = pollform.length;
	mypoll = new Object();
	for (var i = 0; i < len; i++) {
    	el = pollform.elements[i];
    	if (el.name.substr(0,6) == "mypoll") {
    	 	l = el.name.length - 8;
//    	 	alert (el.name.length + "|" + l);
      		mypoll[el.name.substr(7,l)] = escape(el.value);
//      		mypoll.push(ft);
      	}
    }
    return mypoll;
}    

function xtAdminController(task)
{
	document.getElementById("loadArea").style.display = "block";

    var polldata = new Object;
 	polldata["poll"] = document.getElementById("ajaxPoll").value;
 	polldata["questions"] = document.getElementById("ajaxQuestions").value;
 	polldata["options"] = document.getElementById("ajaxOptions").value;
	polldata["task"] = task;
	polldata["mypoll"] = JSON.stringify(getPoll());

	if (document.getElementById("xtquestions"))
		polldata["selQuestion"] = getSelected(document.getElementById("xtquestions"));
	else polldata["selQuestion"] = "";
	if (document.getElementById("xtoptions"))
		polldata["selOption"] = getSelected(document.getElementById("xtoptions"));
	else polldata["selOption"] = "";
	if (task == 'applyQuestion') {
		polldata["edit"] = JSON.stringify(getQuestion());
	}
	if (task == 'applyOption') {
		polldata["edit"] = JSON.stringify(getOption());
	}
   	var strPOST = JSON.stringify(polldata);  
  	x_pollxtAdminController(strPOST, output);

}

