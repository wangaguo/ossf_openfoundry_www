<?php

(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');



function jcAdminUnicode_to_entities( $unicode ) {
        
        $entities = '';
        foreach( $unicode as $value ){
            if($value >= 128)
                $entities .= '&#' . $value . ';';
            else
                $entities .= chr($value);
        }
        return $entities;
        
    } // unicode_to_entities
    
function jcAdminUtf8_to_unicode( $str ) {
    $temp = jcUtf8_to_unicode($source);
	$result = jcUnicode_to_entities($temp);
	return $result;
} // utf8_to_unicode
    

class HTML_comment 
{

  function showAbout() {
  	$cms    =& cmsInstance('CMSCore');
  	
  	require_once( $cms->get_path('root') . '/includes/domit/xml_domit_lite_include.php' );
  	
	// Read the file to see if it's a valid component XML file
	$xmlDoc = new DOMIT_Lite_Document();
	$xmlDoc->resolveErrors( true );

	if (!$xmlDoc->loadXML( $cms->get_path('root') . "/administrator/components/com_jomcomment/jomcomment.xml", false, true )) {
		//continue;
	}

	$root = &$xmlDoc->documentElement;

	if ($root->getTagName() != 'mosinstall') {
		//continue;
	}
	if ($root->getAttribute( "type" ) != "component") {
		//continue;
	}

	$element 			= &$root->getElementsByPath('creationDate', 1);
	$row->creationdate 	= $element ? $element->getText() : 'Unknown';

	$element 			= &$root->getElementsByPath('author', 1);
	$row->author 		= $element ? $element->getText() : 'Unknown';

	$element 			= &$root->getElementsByPath('copyright', 1);
	$row->copyright 	= $element ? $element->getText() : '';

	$element 			= &$root->getElementsByPath('authorEmail', 1);
	$row->authorEmail 	= $element ? $element->getText() : '';

	$element 			= &$root->getElementsByPath('authorUrl', 1);
	$row->authorUrl 	= $element ? $element->getText() : '';

	$element 			= &$root->getElementsByPath('version', 1);
	$row->version 		= $element ? $element->getText() : '';

	$row->mosname 		= @strtolower( str_replace( " ", "_", $row->name ) );
			
  ?>
      <table cellpadding="4" cellspacing="0" border="0" width="100%">
      <tr>
        <td width="100%">
          <img src="components/com_jomcomment/logo.png">
        </td>
      </tr>
      <tr>
        <td>
        <blockquote>
          <p><br />
            Comment</p>
          <p>&nbsp;</p>
        </blockquote>
        </td>
      </tr>
      <tr>
      	<td><b>Release Date:</b>&nbsp;&nbsp;<?php echo $row->creationdate;?></td>
      </tr>
      <tr>
      	<td><b>Version:</b>&nbsp;&nbsp;<?php echo $row->version;?></td>
      </tr>
      </table>
  <?php
    }
    
    function showSupport() {
  ?>
      <table cellpadding="4" cellspacing="0" border="0" width="860px">
      <tr>
        <td width="100%">
          <img src="components/com_jomcomment/logo.png">
        </td>
      </tr>
      <tr>
        <td>

<blockquote>
    <h2>SUPPORT</h2>
    <table>
      <tbody>
          <tr>
              <td colspan="2" valign="top"><div align="left">
                          <h3>Product Wiki</h3>
              </div>
                  <p align="left">Here&rsquo;s where you can find all product  documentation's, frequently asked questions (FAQ&rsquo;s) and other product  details. This is the best place for quick information on anything  related to our products.</p>
                  <div align="left">
                      <h3>E-mail</h3>
                  </div>
                  <div align="left">
                  </div>
                  <br>
                      <div align="left">
                          <h3>Forum</h3>
                    </div>
                  <div align="left">
                          <p>If  you cannot find what you&rsquo;re looking for in the Wiki, you can post your  questions here. The community will do the best to help you. <em><strong>Keep  in mind this forum is community driven and is NOT the best way to  obtain fast response from us. Please write to us at the email above</strong></em>.</p>
                  </div></td>
          </tr>
      </tbody>
  </table>
  <p><strong>Common Issues </strong></p>
  <blockquote>
      <p> <strong>1. Have you enable the Jom Comment Sys Bot ? </strong><br>

            This solve 90% of all "it's not working" problem. Jom Comment uses 2 mambots, a content and a system mambot. Make sure BOTH mambots is enabled <br>
            <br>
            <strong>2. Are you using a custom templates? </strong><br>
            Comment require the folloowing code in the &lt;head&gt; section of your template. </p>
      <p> &lt;?php&nbsp;mosShowHead ();&nbsp; ?&gt; </p>

      <p>        The default template and most commercial template do include this code. Make sure it is there, if it is missing, add it. </p>
  </blockquote>
  </blockquote>

        </td>
      </tr>
      </table>
  <?php
    }
    
    function showLicense() {
  ?>
      <table cellpadding="4" cellspacing="0" border="0" width="860px">
      <tr>
        <td width="100%">
          <img src="components/com_jomcomment/logo.png">
        </td>
      </tr>
      <tr>
        <td>
        <blockquote>
  <H3>SOFTWARE LICENSE AND LIMITED WARRANTY </H3>
  <p>&nbsp;</p>
</blockquote>
        </td>
      </tr>
      </table>
  <?php
    }
    
############################################################################
  function showComments( $option, &$rows, &$search, &$pageNav, $searchContent) {
    $commentlenght = "40";

    $db =& cmsInstance('CMSDb');
	$cms    =& cmsInstance('CMSCore');
	$cms->load('helper','url');

	$limitOption    = cmsGetVar('limitOption','com_content', 'GET');
    $db->query("SELECT distinct `option` FROM #__jomcomment");
    $results = $db->get_object_list();
    $limitComOptions = "";
    foreach($results as $res){
    	if($res->option == $limitOption)
    		$limitComOptions .= "<option value=\"$res->option\" selected>$res->option</option>";
    	else
    		$limitComOptions .= "<option value=\"$res->option\">$res->option</option>";
	}
   

    # Table header
	$jq     	= JC_ADMIN_LIVEPATH  . '/js';
?>
<script src="<?php echo $jq;?>/jquery-1.2.2.pack.js" type="text/javascript"></script>

<script type='text/javascript'>
/*<![CDATA[*/
jQuery.noConflict();
/*]]>*/
</script>
<script src="<?php echo $jq;?>/ui.mouse.js" type="text/javascript"></script>
<script src="<?php echo $jq;?>/jquery.dimensions.js" type="text/javascript"></script>
<script src="<?php echo $jq;?>/ui.draggable.js" type="text/javascript"></script>
<div id="popupWindowContainer" style="visibility:hidden; position:absolute" >
		<div class="dropshadowBox">
		<div class="innerbox">
		<div id="popupWindowHandle"></div>
			<div id="popupWindowEditable" >
				<h4>Test 2</h4>
			  <p>This has two wrapping div's. one for the shadow, and one for the border.</p>
			</div>
		</div>
		</div>
	</div>
	
<style  type="text/css">
<!--
.dropshadowBox{
	float:left;
	clear:left;
	background: url(components/com_jomcomment/images/shadowAlpha.png) no-repeat right bottom!important;
	background: url(components/com_jomcomment/images/shadow.gif) no-repeat bottom right;
	margin: 10px 0 10px 10px !important;
	margin: 10px 0 10px 5px;
	width: 500px;
	padding: 0px;
}
.innerbox{
	position:relative;
	bottom:6px;
	right: 6px;
	border: 1px solid #999999;
	padding:4px;
	margin: 0px 0px 0px 0px;
	background-color: #EBEBEB;
}
.innerbox{
	/* IE5 hack */
	\margin: 0px 0px -3px 0px;
	ma\rgin:  0px 0px 0px 0px;
}
.innerbox p{		
	font-size:14px;
	margin: 3px;
} -->
</style>

<script language="javascript">
function getScrollXY() {
  var scrOfX = 0, scrOfY = 0;
  if( typeof( window.pageYOffset ) == 'number' ) {
    //Netscape compliant
    scrOfY = window.pageYOffset;
    scrOfX = window.pageXOffset;
  } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
    //DOM compliant
    scrOfY = document.body.scrollTop;
    scrOfX = document.body.scrollLeft;
  } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
    //IE6 standards compliant mode
    scrOfY = document.documentElement.scrollTop;
    scrOfX = document.documentElement.scrollLeft;
  }
  return [ scrOfX, scrOfY ];
}

// The data is JSON string
function showFloatingDialog(data){
	var html = "";
	// Attach onclick event to capture click outside the window
	 
	 
	// Fill up container with the main window
	//eval("html = \"" + data + "\";");
	//$('popupWindowContainer').innerHTML = html;
	
	// Show it
	var sc = getScrollXY();
	var w = 400;
	var h = 400;
	w += 32;
	h += 96;
	var wleft = 310; //((860 - w) / 2) + $('mainListingTable').getLeft();
  	var wtop = (screen.height - h) / 2 + sc[1];

    

	jQuery('#popupWindowEditable').html(data);
	jQuery('#popupWindowContainer').css('width', w+ 'px');
	jQuery('#popupWindowContainer').css('height', h+ 'px');
	jQuery('#popupWindowContainer').css('top', wtop + 'px');
	jQuery('#popupWindowContainer').css('left', wleft + 'px');
	jQuery('#popupWindowContainer').draggable();
	jQuery('#popupWindowContainer').css('visibility','visible');
}

</script>


    
    
    	<style type="text/css">
      <!--
    	
    	.infolevel1, .infolevel2 , .infolevel3 {
    	   background-color: #FAD163;
    	   display: block;
    	}
    	
    	.infolevel1, .infolevel2 {
            height: 1px;
            font-size: 1px
    	}
    	
        .infolevel1 {
        	margin-right: 3px;
        	margin-left: 3px;
        }
        
        .infolevel2 {
        	margin-right: 1px;
        	margin-left: 1px;
        }
        
        .infolevel3 {
            color: #000000;
        	font-weight: bold;
        	text-align: center;
        	vertical-align: middle;
        	height: 18px;
        }
        
        #powered_jc {
        	text-align: center;
        	display: block;
        	text-decoration: none;
        	font-size: xx-small;
        	
        	
        }
        
	--></style>
        
    <form action="index2.php?option=com_jomcomment&task=comments" method="post" name="adminForm"  id="adminForm" >
    <table cellpadding="4" cellspacing="0" border="0" width="860px">
    <tr>
      <td width="10%" rowspan="2"><img src="components/com_jomcomment/logo.png"></td>
      <td width="60%" rowspan="2"  align="center"><div id="ajaxInfo" class="message" align="center" >
      </div>
	  </td>
      <td>Search Comment:</td>
      <td>
        <input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />      </td>
      <td>Search Content:</td>
      <td>
        <input type="text" name="searchContent" value="<?php echo $searchContent;?>" class="inputbox" onChange="document.adminForm.submit();" />      </td>
    </tr>
    <tr>
        <td colspan="6" align="right" nowrap="nowrap"><select name="limitOption" id="limitOption" onchange="document.location = 'index2.php?option=com_jomcomment&task=comments&limitOption=' + jax.$('limitOption').value;">
        	<?php echo $limitComOptions; ?>
            </select></td>
        </tr>
    </table>

    <table id="mainListingTable" cellpadding="4" cellspacing="0" border="0" width="860px" class="mytable">
    <tbody>
      <tr>
        <th width="2%" class="title"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
        <!--
		<th class="title">Action</th>
        <th class="title"><div align="center">Author</div></th>
        <th class="title"><div align="center">Email</div></th>
        -->
        
        <th class="title" width="45%"><div align="left">Comment</div></th>
        <!-- <th class="title"><div align="left">Action</div></th>
        <th class="title"><div align="center">Date</div></th> 
        <th class="title"><div align="center">IP</div></th>-->
        <th class="title" width="15%"><div align="center">Content</div></th>
        <th class="title"><div align="center">Published</div></th>
      </tr>
      <?php
    $k = 0;
    $entrylenght = 64;
    $viewObj = new JCView();
    
    // Drawing the rows
    for ($i=0, $n=count( $rows ); $i < $n; $i++) {
		

        $row = &$rows[$i];
        
        $query = "SELECT title FROM #__content WHERE id='$row->contentid' AND state='1' ;";
		$db->query( $query );
		$contentTitle = $db->get_value();
		
        echo "<tr class='row$k'>";
        echo "<td width='1%'><input type='checkbox' id='cb$i' name='cid[]' value='$row->id' onclick='isChecked(this.checked);' /></td>";
	
		//echo "<td width='1%'><a href='javascript:void(0);' alt='Click to edit' onclick=\"jax.call('jomcomment','jcxEditComment', '$row->id');\" ><img src='components/com_jomcomment/application_form_edit.png' border='0' align='default'  ></a></td>";
		//echo "<td align='center' id='name-$row->id'>&nbsp;$row->name</td>";
		$row->comment  = transformDbText($row->comment);
		$row->comment = $viewObj->shortenURL($row->comment);
		if(strlen($row->comment) > 300) {
			$row->comment  = stripslashes(substr($row->comment,0,300-3));
			$row->comment .= "...";
		}
		# We must strip tags the comment. This fix the issue where user add redirect meta header
		# and stall the whole system, even the backend!      
		$row->comment 	= strip_tags($row->comment); 
	      
      //echo "<td align='left' width='10%' id='email-$row->id'>&nbsp;$row->email</td>";
      //echo "<td align='left' onclick=\"jax.call('jomcomment', 'jcxEditComment', '$row->id');\" ><span id='comment-$row->id'>$row->comment<span></td>";
      
      ?>
      <td>
      	
      	<div class="comment" style="text-align:left;overflow:hidden" id="comment-<?php echo $row->id; ?>">
      		<?php echo $row->comment; ?>
      	</div>
      	<div style="text-align:left">
      	<!-- <img src="components/com_jomcomment/images/Information_16x16.png" style="vertical-align: middle;" hspace="2"/> -->
      	<strong>INFO: </strong>
      		<strong>Name: </strong><?php echo $row->name; ?> | 
			<strong>Email: </strong><?php echo $row->email;?> | 
			<strong>URL: </strong><?php echo $row->website;?> |
			<strong>Date:</strong> <span id="date-<?php echo $row->id; ?>"><?php echo $row->date;?></span> |
			<strong>IP: </strong><?php echo $row->ip;?> | 
      	</div>
	    
      	<div class="comment-info">
	      	<!-- <img src="components/com_jomcomment/images/Gear_16x16.png" style="vertical-align: middle;" hspace="2"/> -->
			<span class="tinyaction" onclick="jax.call('jomcomment','jcxEditComment', <?= $row->id; ?>);">Edit</span> | 
		    <span class="tinyaction" onClick="jax.call('jomcomment','jcxBanUserName','<?php echo $row->name; ?>');">Ban this user</span> |
		    <span class="tinyaction" onClick="jax.call('jomcomment','jcxBanUserIP','<?php echo $row->ip; ?>');">Ban user IP</span>
	    </div>
	</td>
	<td>
	<div>
      		<strong><?php echo $contentTitle;?></strong>
      	</div>
	</td>
      <?php
      //echo "<td align='left' id='website-$row->id'width='10%'>$row->website&nbsp;</td>";
      //echo "<td align='center'>$row->date</td>";
      //echo "<td align='center' id='website-$row->id'width='10%'>$row->ip&nbsp;</td>";
      
      
      //echo "<td align='center' id='content-$row->id'>$contentTitle</td>";
      if(strlen($row->comment) > 64) {
        $row->comment  = substr($row->comment,0,64);
        $row->comment .= "...";
      }

      $task = $row->published ? 'unpublish' : 'publish';
      $img = $row->published ? 'publish_g.png' : 'publish_x.png';
      ?>
        <td width="10%" align="center">
            <a href="javascript: void(0);" onclick="jax.call('jomcomment','jcxTogglePublish', <?php echo $row->id; ?>);">
                <img id="pubImg<?php echo $row->id; ?>" src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" />
            </a>
        </td>
    </tr>
    <?php    
        $k = 1 - $k; 
        // Now we need to add hidden row.
        ?>
        <tr style="display: none;" id="<?php echo $row->id; ?>">
        <td align="center" colspan="10" height='1px'><div stye="display:block;" id="c<?php echo $row->id;?>" ></div></td>
        </tr>
        <?php 
    } 
    ?>
    <tr>
      <th align="center" colspan="10">
      <?php
      	echo $pageNav->footer;
	  ?>
		</th>
    </tr>
	</tbody>
  </table>
  <input type="hidden" name="option" value="com_jomcomment" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  </form>
  <?php
  }


  
  function showLanguageEdit($flist){
  ?>
    
    <table border="0" cellpadding="0" cellspacing="0" width="100%" >
    <tbody><tr>
      <td width="10%"><img src="components/com_jomcomment/logo.png"></td>
      <td align="center" width="100%"><div id="ajaxInfo" class="message" align="center">
      </div>
      </td>

      </tr>
    </tbody></table>
  <table width="100%" border="0" cellpadding="16" cellspacing="0">
    <tr>
      <td valign="top">
        <table width="100%"  class="mytable" border="0" cellpadding="0">
            <tr>
      <th valign="top">Select language file to edit </th>
    </tr>
          <tr>
            <td valign="top">
            <p>
                <select name="languageFile" size="12" style="width:200px "id="languageFile">
                  <?php echo $flist; ?>
                </select>
            </p>
              <p>                
              <input type="submit" name="Submit" value="Edit" class="CommonTextButtonSmall" onClick="jax.call('jomcomment','jcxLoadLangFile', document.getElementById('languageFile').value);">
              </p>
              </td>
          </tr>
        </table>
        </td>
      <td width="100%" valign="top">
      <table width="100%"  border="0" class="mytable" cellpadding="0">
      <tr>
      <th valign="top">Editing </th>
    </tr>
          <tr>
            <td><p>
                <textarea name="editLangTextArea" rows="20" id="editLangTextArea" style="width:98%"></textarea>
            </p>
              <p>                <input type="submit" name="Submit" value="Save" class="CommonTextButtonSmall" onClick="jax.call('jomcomment','jcxSaveLanguage', document.getElementById('editLangTextArea').value,document.getElementById('currentFile').value);">
                <input name="currentFile" type="hidden" id="currentFile">
              </p></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
  <?php
  }
}


class HTML_trackbacks
{
	
	function showTrackbacks( $option, &$rows, &$search, &$pageNav, $searchContent ) {
    	$db =& cmsInstance('CMSDb');
    	$commentlenght = 40;
    	?>
    	
    	<form action="index2.php?option=com_jomcomment&task=trackbacks" method="post"  id="adminForm" name="adminForm">
	    <table cellpadding="4" cellspacing="0" border="0" width="860px">
	    <tr>
	      <td width="10%"><img src="components/com_jomcomment/logo.png"></td>
	      <td width="100%"  align="center"><div id="ajaxInfo" class="message" align="center" >
	      </div>
	      </td>
	      <td nowrap="nowrap">Display #</td>
	      <td>
	        <?php echo $pageNav->writeLimitBox(); ?>
	      </td>
	      <td>Search:</td>
	      <td>
	        <input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
	      </td>
	      <td>Search Content:</td>
      <td>
        <input type="text" name="searchContent" value="<?php echo $searchContent;?>" class="inputbox" onChange="document.adminForm.submit();" />
	    </tr>
	    </table>
	
	    <table cellpadding="4" cellspacing="0" border="0" width="860px" class="mytable">
	      <tr>
	        <th width="2%" class="title"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
	        <th class="title"><div align="center">Title</div></th>
	        <th class="title" width="55%"><div align="left">Excerpt</div></th>
	        <th class="title"><div align="center">Content</div></th>
	        <th class="title"><div align="center">Published</div></th>
	      </tr>
		
		<?php
	    $k = 0;
	    $entrylenght = 64;
	    
	    // Drawing the rows
	    for ($i=0, $n=count( $rows ); $i < $n; $i++) {
	        $row = &$rows[$i];
	        echo "<tr class='row$k'>";
	        echo "<td width='1%'><input type='checkbox' id='cb$i' name='cid[]' value='$row->id' onclick='isChecked(this.checked);' /></td>"; 
			echo "<td align='center' id='title-$row->id'>&nbsp;$row->title</td>";
			
			if(strlen($row->excerpt) > $commentlenght) {
				$row->excerpt  = transformDbText(stripslashes(substr($row->excerpt,0,$entrylenght-3)));
				$row->excerpt .= "...";
			}
			?>
			<td>
				<div class="comment">
					<?= $row->excerpt; ?>
				</div>
				<div>
		      		<!-- <img src="components/com_jomcomment/images/Information_16x16.png" style="vertical-align: middle;" hspace="2"/> -->
					<strong>URL: </strong><?php echo $row->url;?> |
					<strong>Date:</strong> <?php echo $row->date;?> |
					<strong>IP: </strong><?php echo $row->ip;?> | 
		      	</div>
		      	
				<div class="comment-info">
				    <span class="tinyaction" onClick="jax.call('jomcomment','jcxBanUserIP','<?php echo $row->ip; ?>');">Ban user IP</span>
			    </div>
	        </td>
			<?php
			if(strlen($row->url) > 32) {
				$row->url  = substr($row->url,0,32);
				$row->url .= "...";
			}
			
			//echo "<td align='left' id='website-$row->id'width='10%'>$row->url&nbsp;</td>";
			//echo "<td align='center'>$row->date</td>";
			//echo "<td align='center' id='website-$row->id'width='10%'>$row->ip&nbsp;</td>";
			
			$query = "SELECT title FROM #__content WHERE id='$row->contentid' AND state='1' ;";
			$db->query( $query );
			$contentTitle = $db->get_value();
			echo "<td align='center' id='content-$row->id'>$contentTitle</td>";
			
			if(strlen($row->excerpt) > $commentlenght) {
				$row->excerpt  = substr($row->excerpt,0,$commentlenght-3);
				$row->excerpt .= "...";
			}
	
	      $task = $row->published ? 'unpublish' : 'publish';
	      $img = $row->published ? 'publish_g.png' : 'publish_x.png';
	      ?>
	        <td width="10%" align="center">
	            <a href="javascript: void(0);" onclick="jax.call('jomcomment','jcxToggleTrackbackPublish', <?php echo $row->id; ?>);">
	                <img id="pubImg<?php echo $row->id; ?>" src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" />
	            </a>
	            
	        </td>
	    </tr>
	    <?php    
	        $k = 1 - $k; 
	    } 
	    ?>
	    <tr>
	      <th align="center" colspan="10">
	        <?php echo $pageNav->writePagesLinks(); ?></th>
	    </tr>
	    <tr>
	      <td align="center" colspan="10">
	        <?php echo $pageNav->writePagesCounter(); ?></td>
	    </tr>
	  </table>
	  <input type="hidden" name="option" value="<?php echo $option;?>" />
	  <input type="hidden" name="task" value="" />
	  <input type="hidden" name="boxchecked" value="0" />
	  </form>
	  
	  

	  <?php
    }
}
