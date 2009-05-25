<h1 class="componentheading"><?php echo $this->_MT_LANG->TITLE ?></h1>

<div id="listing">

<h2><?php 
$link_name = $this->fields->getFieldById(1);
$this->plugin( 'ahreflisting', $this->link, $link_name->getOutput(1), '', array("delete"=>false, "edit"=>false) ) ?></h2>

<b><?php echo $this->_MT_LANG->CONFIRM_DELETE ?></b>
<p />

<center>
<form action="<?php echo sefRelToAbs("index.php") ?>" method="post">
<input type="submit" name="Submit" class="button" value="<?php echo $this->_MT_LANG->DELETE ?>" /> <input type="button" value="<?php echo $this->_MT_LANG->CANCEL ?>" onclick="history.back();" class="button" />
<input type="hidden" name="option" value="com_mtree" />
<input type="hidden" name="task" value="confirmdelete" />
<input type="hidden" name="link_id" value="<?php echo $this->link->link_id ?>" />
</form>
</center>

</div>