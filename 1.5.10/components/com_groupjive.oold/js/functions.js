function toggleLayer(whichLayer) {
  if (document.getElementById) {
    // this is the way the standards work
    var style2 = document.getElementById(whichLayer).style;
    style2.display = style2.display? "":"block";
  } else if (document.all) {
    // this is the way old msie versions work
    var style2 = document.all[whichLayer].style;
    style2.display = style2.display? "":"block";
  } else if (document.layers) {
    // this is the way nn4 works
    var style2 = document.layers[whichLayer].style;
    style2.display = style2.display? "":"block";
  }
}

function toggleVisibility(whichLayer){
  if (document.getElementById) {
    // this is the way the standards work
    var style2 = document.getElementById(whichLayer).style;
    style2.visibility = style2.visibility=="visible"? "hidden":"visible";
  } else if (document.all) {
    // this is the way old msie versions work
    var style2 = document.all[whichLayer].style;
    style2.visibility = style2.visibility=="visible"? "hidden":"visible";
  } else if (document.layers) {
    // this is the way nn4 works
    var style2 = document.layers[whichLayer].style;
    style2.visibility = style2.visibility=="visible"? "hidden":"visible";
  }
}


function domContains (container, containee) {
  while (containee) {
    if (container === containee) {
      return true;
    }
    containee = containee.parentNode;
  }
  return false;
}

function checkMouseLeave (node, evt) {  
  if (typeof evt.relatedTarget != 'undefined') {
    return !domContains(node, evt.relatedTarget);
  }
  else if (typeof evt.toElement != 'undefined' && typeof node.contains != 'undefined') {
    return !node.contains(evt.toElement);
  }
}

function checkMouseEnter (node, evt) {
  if (typeof evt.relatedTarget != 'undefined') {
    return !domContains(node, evt.relatedTarget);
  }
  else if (typeof evt.fromElement != 'undefined' && typeof node.contains != 'undefined') {
    return !node.contains(evt.fromElement);
  }
}
