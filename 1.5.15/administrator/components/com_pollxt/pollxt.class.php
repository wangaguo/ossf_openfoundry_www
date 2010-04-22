<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.05
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php

/**
* Poll database table class
*/
class mosPoll extends JTable {
/** @var int Primary key */
        var $id=null;
/** @var string */
        var $title=null;
        var $voters=null;
/** @var string */
        var $checked_out=null;
/** @var time */
        var $checked_out_time=null;
/** @var boolean */
        var $published=null;
/** @var int */
        var $access=null;
/** @var int */
        var $lag=null;
        var $multivote=null;
        var $rdisp=null;
        var $rdispb=null;
        var $rdispd=null;
        var $rdispdw=null;
        var $rdispall=null;
        var $ordering=null;
        var $intro=null;
        var $thanks=null;
        var $logon=null;
        var $img_url = null;
        var $imgor = null;
        var $imgsize = null;
        var $imglink = null;
        var $css = null;
        var $datefrom = null;
        var $dateto = null;
        var $timefrom = null;
        var $timeto = null;
        var $type = null;
        var $sh_numvote = null;
        var $sh_flvote = null;
        var $sh_abs = null;
        var $sh_perc = null;
        var $email = null;
        var $subject = null;
        var $emailtext = null;
        var $goto = null;
        var $goto_url = null;
        var $hidetitle = null;
        var $mailres = null;
        var $mailrestxt = null;
        var $mailresrec = null;
		var $wordwrap = null;
		var $category = null;
		var $notvote = null;
		var $notvoteerr = null;
		var $vbtext = null;
		var $hide = null;
		var $showvoters = null;

        /**
* @param database A database connector object
*/
        function mosPoll( &$db ) {
                parent::__construct( '#__pollsxt', 'id', $db );
        }
// overloaded check function
        function check() {
        // check for existing title
                $this->_db->setQuery( "SELECT id FROM #__pollsxt WHERE title='$this->title'"
                );

                $xid = intval( $this->_db->loadResult() );
                if ($xid && $xid != intval( $this->id )) {
                        $this->setError("There is a module already with that name (".$this->title."), please try again.");
                        return false;
                }

        // sanitise some data
                if (!get_magic_quotes_gpc()) {
//                        $this->title = addslashes( $this->title );
                }

                return true;
        }
// overloaded delete function
        function delete( $oid=null ) {
                $k = $this->_tbl_key;
                if ($oid) {
                        $this->$k = intval( $oid );
                }


                if (parent::delete( $oid )) {
                        $this->_db->setQuery( "SELECT q.pollid as pollid, o.quid as quid, d.optid as optid
                        FROM #__pollsxt_questions AS q
                        LEFT  JOIN #__pollsxt_options AS o ON o.quid = q.id
                        LEFT JOIN #__pollxt_data AS d ON d.optid = o.id
                        WHERE q.pollid =  '".$this->$k."'");

                        $rows = $this->_db->loadObjectList();
                         foreach ($rows as $row) {
                          $this->_db->setQuery( "DELETE from #__pollsxt_questions where pollid='".$row->pollid."'" );
                          $this->_db->query();
                          $this->_db->setQuery( "DELETE from #__pollsxt_options where quid='".$row->quid."'" );
                          $this->_db->query();
                          $this->_db->setQuery( "DELETE from #__pollxt_data where optid='".$row->optid."'" );
                          $this->_db->query();
                        }

                        if (!$this->_db->query()) {
                                $this->setError ($this->_db->getErrorMsg() . "\n");
                        }



                        $this->_db->setQuery( "DELETE from #__pollxt_menu where pollid='".$this->$k."'" );
                        if (!$this->_db->query()) {
                                $this->setError ($this->_db->getErrorMsg() . "\n");
                        }

                        return true;
                } else {
                        return false;
                }
        }
}
class mosPollQuestion extends JTable {
/** @var int Primary key */
        var $id=null;
        var $pollid = null;
/** @var string */
        var $title=null;
        var $type = null;
        var $img_url = null;
        var $imgor = null;
        var $imgsize = null;
        var $imglink = null;
        var $obli = null;
        var $multisize = null;
        var $inact = null;
        var $upd = null;
        var $minvotes = null;
        var $maxvotes = null;
        var $ratingval = null;
        var $ratingdesc = null;
        var $random = null;
        var $ordering = null;
        var $style = null;

        function mosPollQuestion( &$db ) {
                parent::__construct( '#__pollsxt_questions', 'id', $db );
        }
}
class mosPollOptions extends JTable {
/** @var int Primary key */
        var $id=null;
        var $quid = null;
/** @var string */
        var $qoption=null;
        var $img_url = null;
        var $imgor = null;
        var $imgsize = null;
        var $imglink = null;
        var $freetext = null;
        var $newopt = null;
        var $inact = null;
        var $multirows = null;
        var $multicols = null;
        var $upd = null;
        var $ordering = null;


        function mosPollOptions( &$db ) {
                parent::__construct( '#__pollsxt_options', 'id', $db );
        }
}
class mosPollData extends JTable {
/** @var int Primary key */
        var $id=null;
        var $optid = null;
        var $ip=null;
        var $user = null;
        var $datu = null;
        var $mailkey = null;
        var $block = null;
        
        
function mosPollData( &$db ) {
         parent::__construct( '#__pollsxt_data', 'id', $db );
        }
}

class mosPollConfig extends JTable {
/** @var int Primary key */
var $id = null;
var $version = null;
var $xt_disp = null;
var $xt_hide = null;
var $xt_selpo = null;
var $xt_publ = null;
var $xt_order = null;
var $xt_imgvote = null;
var $xt_imgresult = null;
var $imgdetail = null;
var $imgback = null;
var $xt_maxcolors = null;
var $xt_height = null;
var $xt_orderby = null;
var $xt_asc = null;
var $xt_seccookie = null;
var $xt_secip = null;
var $xt_secuname = null;
var $resselpo = null;
var $imgpath = null;
var $rdisp = null;
var $button_style;
var $debug = null;
var $compat = null;
        
function mosPollConfig( &$db ) {
         parent::__construct( '#__pollxt_config', 'id', $db );
        }
}

class mosPollPage extends JTable {
/** @var int Primary key */
var $id = null;
var $pollid = null;
var $elid = null;
var $eltype = null;
var $ordering = null;

function mosPollPage( &$db ) {
        parent::__construct( '#__pollxt_page', 'id', $db );
        }
}

class mosPollPlugin extends JTable {
/** @var int Primary key */
var $id = null;
var $pollid = null;
var $plugin = null;
var $param = null;
var $value = null;

function mosPollPlugin( &$db ) {
         parent::__construct( '#__pollxt_plugins', 'id', $db );
        }
}

?>
