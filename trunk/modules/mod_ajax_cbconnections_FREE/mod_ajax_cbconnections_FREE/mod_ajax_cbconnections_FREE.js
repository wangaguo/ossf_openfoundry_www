function acbc_submitForm_FREE() {
	ajaxObj=acbc_createXMLHttp_FREE()
	var url=document.getElementById('mosConfig_live_site').value;
	url=url+"/modules/mod_ajax_cbconnections_FREE.php"
	url=url+"?sid="+ new Date().getTime()
	ajaxObj.open("POST",url,true)
	ajaxObj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajaxObj.onreadystatechange=acbc_processVote_FREE
	var connectionsForm = document.forms['connectionsForm_FREE'];
	var connectionsFormBody = acbc_getRequestBody_FREE(connectionsForm);
	ajaxObj.send(connectionsFormBody);
}

function acbc_processVote_FREE() {
	if (ajaxObj.readyState==4 || ajaxObj.readyState=="complete") {
		setTimeout('document.getElementById(\'connections_output_FREE\').innerHTML=ajaxObj.responseText;document.getElementById(\'ajaxloading_FREE\').innerHTML="&nbsp;"' , 500)
	}
	else {
		document.getElementById('ajaxloading_FREE').innerHTML="<img src='modules/mod_ajax_cbconnections_FREE/images/ajax_loading.gif' border='0' />"
	}
}

function acbc_createXMLHttp_FREE() {
	if (typeof XMLHttpRequest != 'undefined')
		return new XMLHttpRequest();
	else if (window.ActiveXObject) {
		var avers = ["Microsoft.XmlHttp", "MSXML2.XmlHttp",
		"MSXML2.XmlHttp.3.0", "MSXML2.XmlHttp.4.0",
		"MSXML2.XmlHttp.5.0"];
		for (var i = avers.length -1; i >= 0; i--) {
			try {
				httpObj = new ActiveXObject(avers[i]);
				return httpObj;
			} catch(e) {}
		}
	}
	throw new Error('XMLHttp (AJAX) not supported by your browser.');
}

function acbc_getRequestBody_FREE(form_name) {
	var content_to_submit = '';
	var form_element;
	var last_element_name = '';

	for (i = 0; i < form_name.elements.length; i++) {
		form_element = form_name.elements[i];
		switch (form_element.type) {
			// Text fields, hidden form elements
			case 'text':
			case 'hidden':
			case 'password':
			case 'textarea':
			case 'select-one':
				content_to_submit += form_element.name + '=' + escape(form_element.value) + '&'
			break;
			// Radio buttons
			case 'radio':
				if (form_element.checked) {
					content_to_submit += form_element.name + '=' + escape(form_element.value) + '&'
				}
			break;
			// Checkboxes
			case 'checkbox':
			if (form_element.checked) {
				// Continuing multiple, same-name checkboxes
				if (form_element.name == last_element_name) {
					// Strip of end ampersand if there is one
					if (content_to_submit.lastIndexOf('&') == content_to_submit.length - 1) {
						content_to_submit = content_to_submit.substr(0, content_to_submit.length - 1);
					}
					// Append value as pipe-delimited string
					content_to_submit += '|' + escape(form_element.value);
				}
				else {
					content_to_submit += form_element.name + '=' + escape(form_element.value);
				}
				content_to_submit += '&';
				last_element_name = form_element.name;
			}
			break;
		}
	}
	// Remove trailing separator
	content_to_submit = content_to_submit.substr(0, content_to_submit.length - 1);
	return content_to_submit;
}