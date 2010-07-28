<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.06
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<?php 
/**
* PollXT for Joomla!
* @Copyright ((c) 2004 - 2009 JoomlaXT
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 2.00.06
**/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>


<?php
require_once (JPATH_SITE.'/administrator/components/com_pollxt/class/pollxt.questions.php');
require_once (JPATH_SITE.'/administrator/components/com_pollxt/class/pollxt.options.php');


class pageEditor {
var $editArea = null;
	function pageEditor($data) {
	 	global $my, $database;
		$this->task = $data->task;
		$this->message = "";
		$this->func = "";
		$this->selQuestion = $data->selQuestion;
		$this->selOption = $data->selOption;
		$this->poll = json_decode($data->poll);
		$this->questions = json_decode($data->questions);
		$this->options = json_decode($data->options);
		if (isset($data->edit)) { $this->edit = json_decode($data->edit);};
	 	$this->q = new pageEditorQuestions($this);
	 	$this->o = new pageEditorOptions($this);
		
		$this->messageType = "";
		$this->updateArea->question = false;
		$this->updateArea->option = false;
		$this->myPoll = json_decode($data->mypoll);

		$conf = new pollxtConfig();
		$conf->pollid = $this->poll->id;
		$conf->load();
		if ($conf->debug == "2" || $conf->debug == "3" ) {
			ini_set  ( "display_errors"  , "1"  );
			error_reporting(E_ALL);
		}		
		
		switch ($this->task) {
		 	
			case "init":
				$this->updateArea->question = true;
				break;
			case "selectQuestion":
				$this->editArea = "question";
				$this->updateArea->option = true;
				break;
			case "applyQuestion":
				$this->updateArea->question = true;
				$this->q->applyQuestion();
				break;
			case "orderUpQuestion":
				$this->updateArea->question = true;
				$this->editArea = "question";
				$this->q->orderQuestions(-1);
				break;
			case "orderDownQuestion":
				$this->updateArea->question = true;
				$this->editArea = "question";
				$this->q->orderQuestions(1);
				break;
			case "newQuestion":
				$this->updateArea->question = true;
				$this->updateArea->option = true;
				$this->editArea = "question";
				$this->q->newQuestion();
				break;
			case "delQuestion":
				$this->updateArea->question = true;
				$this->editArea = "question";
				$this->q->delQuestion();
				break;
			case "copyQuestion":
				$this->updateArea->question = true;
				$this->editArea = "question";
				$this->q->copyQuestion();
				break;
			case "selectOption":
				$this->editArea = "option";
				break;
			case "applyOption":
				$this->updateArea->option = true;
				$this->o->applyOption();
				break;
			case "newOption":
				$this->updateArea->option = true;
				$this->editArea = "option";
				$this->o->newOption();
				break;
			case "delOption":
				$this->updateArea->option = true;
				$this->editArea = "option";
				$this->o->delOption();
				break;
			case "copyOption":
				$this->updateArea->option = true;
				$this->editArea = "option";
				$this->o->copyOption();
				break;
			case "orderUpOption":
				$this->updateArea->option = true;
				$this->editArea = "option";
				$this->o->orderOptions(-1);
				break;
			case "orderDownOption":
				$this->updateArea->option = true;
				$this->editArea = "option";
				$this->o->orderOptions(1);
				break;
			case "save":
				if ($this->validate()) {
				 	$this->message = JText::_('POLLXT_SAVING_SETTINGS');
				 	$this->messageType = "S";
				 	$this->func = "submitform('save')";
				}
				break;
			case "apply":
				if ($this->validate()) {
				 	$this->message = JText::_('POLLXT_SAVING_SETTINGS');
				 	$this->messageType = "S";
				 	$this->func = "submitform('apply')";
				}
				break;
			case "cancel":
				$this->func = "submitform('cancel')";
				break;

		}
		
		$this->createOutput();
	}
	
	function createOutput() {
		if ($this->updateArea->question)
			$this->output->questionArea = $this->q->getQuestionArea();
		else $this->output->questionArea = "";
		if ($this->updateArea->option)
			$this->output->optionArea = $this->o->getOptionArea();
		else $this->output->optionArea = "";
			
		switch ($this->editArea) {
		 	case "question";
				$this->output->editArea = $this->q->getEditArea();
				break;
		 	case "option";
				$this->output->editArea = $this->o->getEditArea();
				break;
		}
		$this->output->questions = json_encode($this->questions);
		$this->output->options = json_encode($this->options);
		$this->output->message = $this->message;
		$this->output->messageType = $this->messageType;
		$this->output->func = $this->func;
		
	}

	function validate() {
		foreach ($this->questions as $q) {
			if ($q->upd != "D" && $q->type != "6") {
			 	$qid = $q->id;
			 	$i = 0;
			 	if (isset($this->options->$qid)) {
			 		foreach ($this->options->$qid as $o) {
						if ($o->upd != "D") $i++;
					}
			 	}
			 	if ($i == 0) {
					$this->message = JText::_('POLLXT_EACH_QUESTION_OPTION');
					return false;
				}
			}
		}
	if ($this->myPoll->title == "") {
		$this->message = JText::_('POLLXT_POLL_MUST_HAVE_TITLE');
		return false;
	}
	if ($this->myPoll->email == 1 && ($this->myPoll->subject == "" || $this->myPoll->emailtext== ""   ))
    { 
		$this->message = JText::_('POLLXT_MAINTAIN_EMAIL');
		return false;
     
	}	
	return true;

	}
}

?>