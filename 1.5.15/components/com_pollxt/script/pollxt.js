function output (ret) {
	data = JSON.parse(ret);
    document.getElementById("load"+data.name).style.display="none";

	
	if (data.header) {
	    document.getElementById("header"+data.name).innerHTML	= data.header;
	}
	if (data.intro) {
	    document.getElementById("intro"+data.name).innerHTML	= data.intro;
	}
	if (data.outro) {
	    document.getElementById("outro"+data.name).innerHTML	= data.outro;
	}
	if (data.select) {
	    document.getElementById("select"+data.name).innerHTML	= data.select;
	}

	
	if (data.message) {
	    document.getElementById("checkmsg"+data.name).innerHTML	= data.message;
	    document.getElementById("checkmsg"+data.name).style.display="block";
    }
    else
	    document.getElementById("checkmsg"+data.name).style.display="none";
    
    if (data.text) {
		document.getElementById("poll"+data.name).innerHTML = data.text;
	}

//    if (data.buttons) {
		document.getElementById("button"+data.name).innerHTML = data.buttons;
//	}
    if (data.func) {
      eval(data.func);
      }
// ititialize the Tooltips
//	var t = new Tips('.tipxt');
	try {
		var t = new Tips($$('.hasTip')); 
	}
	catch (e) {}
    
}
function getPolldata(xname) {
        var polldata = new Object;
        if (!document.forms[xname]) return polldata;
       	pollform = document.forms[xname];
		polldata["pollid"] = pollform.id.value;
		polldata["cfm"] = pollform.cfm.value;
		polldata["Itemid"] = pollform.Itemid.value;
		polldata["isPopup"] = pollform.isPopup.value;
		polldata["state"] = pollform.state.value;
		if (pollform.email)
			polldata["email"] = pollform.email.value;
		if (pollform.params)
			polldata["params"] = pollform.params.value;
		polldata["pos"] = pollform.pos.value;
		polldata["name"] = xname;
		return polldata;	
}

function xtVote(name) {
        var polldata = new Object;
        polldata = getPolldata(name);
		polldata["votes"] = getVotes(name);
        polldata["texts"] = getFreetext(name);
        polldata["plugin"] = getPlugin(name);
		polldata["state"] = "validate";
    	var strPOST = JSON.stringify(polldata);  
		x_pollxtController(strPOST, output)
}

function xtResults(name) {
        var polldata = new Object;
        polldata = getPolldata(name);
		polldata["state"] = "result";

    	var strPOST = JSON.stringify(polldata);  

		x_pollxtController(strPOST, output)
}
function xtDetail(name) {
        var polldata = new Object;
        polldata = getPolldata(name);
		polldata["state"] = "detail";

    	var strPOST = JSON.stringify(polldata);  

		x_pollxtController(strPOST, output)
}

function xtInit(name) {
        var polldata = new Object;
        polldata = getPolldata(name);
    	var strPOST = JSON.stringify(polldata);
		x_pollxtController(strPOST, output)
}


function switchonoff(name) {
	name = "poll"+name;
    if (document.getElementById(name).style.display=="none")
    	{
        document.getElementById(name).style.display="block";
        }
    else
        {
        document.getElementById(name).style.display="none";
        }
}

function checkSelected(id) {
	vid = "v"+id;
    pid = "p"+id;
	if  (document.getElementById(vid).value != '' )
    {  
		document.getElementById(pid).checked = true;
    	return true;
    }
}

function getVotes(name) {
	xname =  name;
	pollform = document.forms[xname];
	len = pollform.length;
	votes = new Array()
	for (var i = 0; i < len; i++) {
		el = pollform.elements[i];
		if ((el.type == "radio" || el.type == "checkbox" )&& el.checked == true ) {
			votes.push(el.value);
		}
		if ((el.type == "select-one" || el.type == "select-multiple")) {
    		for (var j = 0; j < el.options.length; j++ ) {
        		if (el.options[j].selected == true) {
          			if (el.name.substr(0,6) != "xtRate" && el.name.substr(0,5) != "xtVal" && el.value != "") {
            			votes.push(el.options[j].value);
            		}
        		}
    		}
		}
		
		if ((el.type == "hidden") && el.value != ''&& el.id !=
        	"cPage"+name &&  el.id != "name"
            && el.id != "pollid" && el.id != "cfm"
            && el.id != "option" && el.id != "Itemid"
            && el.id != "redir" && el.id != "state"
            && el.id != "params"  && el.id != "pos"
            && el.id != "email"
			&& el.name.substr(0,6) != "xtRate"
            && el.name != "id" && el.name != "task"
            && el.name.substr(0,5) != "xtVal") {
            	votes.push(el.value);
            	
		}

		if ((el.type == "input" ) && el.value != ''&& el.id !=
        	"cPage"+name &&  el.id != "name"
            && el.id != "pollid" && el.id != "pollpos" ) {
            	votes.push(el.value);
		}
		

	}
	return votes;
}

function getFreetext(name) {
	pollform = document.forms[name];
	len = pollform.length;
	votes = new Array()
	for (var i = 0; i < len; i++) {
    	el = pollform.elements[i];
    	if (el.name.substr(0,5) == "xtVal") {
      		if (el.value != "-1") {
				ft = new Array(el.id.substr(1,el.id.length), el.value);
      			votes.push(ft);

      		}
      	}
    }
if (votes)
	return votes;
else return "";

}    
function getPlugin(name) {
	pollform = document.forms[name];
	len = pollform.length;
	votes = new Array()
	for (var i = 0; i < len; i++) {
    	el = pollform.elements[i];
    	if (el.name.substr(0,10) == "plugindata") {
      		ft = new Object();
      		ft[el.name.substr(11,el.name.length)] = el.value;
      		votes.push(ft);
      	}
    }    
if (votes)
	return votes;
else return "";
}

function show(tip) {
	tip = new Tips(document.getElementById("tooltip"));
	alert("tata");
	tip.start(1);
}
