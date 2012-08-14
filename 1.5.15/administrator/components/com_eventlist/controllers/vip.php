<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');
jimport( 'joomla.database.database.mysql' );

class EventListControllerVip extends EventListController
{
	function __construct()
	{
		parent::__construct();

		// Register Extra task
		$this->registerTask( 'apply', 		'save' );
		$this->registerTask( 'copy',	 	'edit' );
	}
	/**
	 刪除vip code功能
	 由view/vip/view.html.php呼叫
	 */
 	function delete_vip()
	{
		unset($cid);
		
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$total 	= count( $cid );

		if (!is_array( $cid ) || count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('vip');
		
		if(!$model->delete_code($cid)) {
			echo "<script> alert('".$model->getError()."'); window.history.go(-1); </script>\n";
		}
		
		$cids		= implode(',',$cid);
		$user_info	= explode('&',$cids);
		$msg 		= JText::_( 'DELDTED');

		$cache = &JFactory::getCache('com_eventlist');
		$cache->clean();

		$this->setRedirect( 'index.php?option=com_eventlist&view=vip', $msg );
	}

	/**
	 將產生vipcode 寄給受邀請者
	 由view/vip/view.html.php呼叫
	 * 以下為函式流程
	 * 1.取得活動id
	 * 2.取得活動已經有的vip code並放入陣列並放入陣列
	 * 3.產生新的vip code並放入新的陣列
	 * 4.比較兩個陣列是否有重複
	 * 5.若有重複 就取消重複的code 
	 * 6.若無 存入資料庫
	 */	
	function produce_vipcode()
	{
		global $mainframe, $option;
		
		$user 	=& JFactory::getUser();
		
		$returnid = $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', $mainframe->getCfg('filter'), 'int'); //活動id
		
		$post = JRequest::get( 'post' ); //取得post變數
		$post['vip_name'] 	= JRequest::getVar( 'vip_name', '', 'post','string', JREQUEST_ALLOWRAW); //取得邀請者name
		$post['invite'] 	= JRequest::getVar( 'invite', '', 'post','string', JREQUEST_ALLOWRAW); //取得邀請者信箱
		$vip_num_obj[0] 	= JRequest::getVar( 'quantity', '', 'post','string', JREQUEST_ALLOWRAW);//取得需要給她幾個VIP CODE數量

		if($returnid!='' || $returnid!=0){
				
			(int)$vip_num = $vip_num_obj[0]; 
			settype($vip_num,int);		
			
			//取出資料庫中的vip code並裝入$sql_code[]
			$db = JFactory::getDBO();
	   		$vip_code = "SELECT vip_code ".
						"FROM #__eventlist_vip ";
			$db->setQuery($vip_code);
			$vipcode = $db->loadObjectList();
			
			$sql_code 	= array();   //sql 中的code
			$vip_array 	= array();   //新的code放入的地方
		
			foreach($vipcode as $code_value){
				$sql_code[] = $code_value->vip_code;
			}

			//產生新的vipcode並且跟sql中的vipcode比對
			if($sql_code[0] == ""){
				for($v=0;$v<$vip_num;$v++){
						
					$vip_n=EventListControllervip::new_code();
					
					if(in_array($vip_n, $vip_array) == false){	
						$vip_array[$v] = $vip_n;
					}else{
						$v=$v-1;
					}
				}
			}else{
				for($v=0;$v<$vip_num;$v++){
						
					$vip_n = EventListControllervip::new_code();
					
					if(in_array($vip_n, $vip_array)==false and in_array($vip_n, $sql_code)==false){	
						$vip_array[$v] = $vip_n; 
					}else{
						$v=$v-1;
					}
				}
			}

			for($i=0;$i<count($vip_array);$i++){
				
				$inv_vip = new stdClass();
				
				$inv_vip->reg_id	= $returnid;
				$inv_vip->vip_name	= $post['vip_name'];
				$inv_vip->vip_mail 	= $post['invite'];
				$inv_vip->vip_code 	= $vip_array[$i];
				$code_array[]		= $vip_array[$i];
				$inv_vip->code_state= 'n';
				$db->insertObject('#__eventlist_vip', $inv_vip,true);
				
			}

			$codes = implode("，",$code_array);
			
			$model = $this->getModel('vip');
			$model->mailtouser($returnid,$post['invite'],$post['vip_name'],$codes	);
			
			$msg = JText::_( 'GIVE' )." ".$post['vip_name']." (".$post['invite'].") ".$codes;
			
			$this->setRedirect( 'index.php?option=com_eventlist&view=vip', $msg );
			
		}else{
		 	$msg = JText::_( 'vip error' );
			$this->setRedirect( 'index.php?option=com_eventlist&view=vip', $msg );
		}
	}
	/**
	 * 產生vip碼
	 由produce_vipcode()呼叫
	 */
	function new_code()
	{
		$toEnStr=array("0","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		$code_1   = array("A","B","C","D","E","F","G","H","I");
		$code_2   = rand(0,9);
		$code_2_2 = $code_2 * 5;
		$code_3   = rand(0,9);
		$code_3_2 = $code_3 *4;
		$code_4   = rand(0,9);
		$code_4_2 = $code_4*3;
		$code_5   = rand(1,2);
		$code_5_2 = $code_5*8;
		$code_6   = rand(0,9);
		$code_6_2 = $code_6*7;
		$code_7   = rand(0,9);
		$code_7_2 = $code_7*6;
		$code_8   = rand(1,26);
		$code_8value=array("0","1","10","19","28","37","46","55","64","19","73","82","2","11","20","48","29","38","47","56","65","74","83","21","3","12","30");
		$code_9   = rand(0,9);
		$code_9_2 = $code_9*2;
		$code_10 = rand(0,9);
		$all=$code_2_2+$code_3_2+$code_4_2+$code_5_2+$code_6_2+$code_7_2+$code_8value[$code_8]+$code_9_2+$code_10;
		$all_2="$all";
		$all_len=strlen($all_2)-1;
		
		switch($all_2[$all_len]%10){
			case '0':	
				$code_11=0;
			break;
		
			case '1':	
				$code_11=9;
			break;
		
			case '2':	
				$code_11=8;
			break;
		
			case '3':	
				$code_11=7;
			break;
			
			case '4':	
				$code_11=6;
			break;

			case '5':	
				$code_11=5;
			break;
		
			case '6':	
				$code_11=4;
			break;
	
			case '7':	
				$code_11=3;
			break;

			case '8':	
				$code_11=2;
			break;

			case '9':	
				$code_11=1;
			break;
		}
		
		$code_12   = array("Z","Y","X","U","V","W","S","R","T","H","P","L");
		$res_vipNum = $code_1[array_rand($code_1)].$code_2.$code_3.$code_4.$code_5.$code_6.$code_7."$toEnStr[$code_8]".$code_9.$code_10.$code_11.$code_12[array_rand($code_12				)];
		
		return $res_vipNum;
	}

	/**
	 * 產生vipcode 
	 */	
	function pure_vipcode()
	{
		global $mainframe, $option;
		$user =& JFactory::getUser();
		
		$returnid = $mainframe->getUserStateFromRequest( $option.'.filter', 'filter', $mainframe->getCfg('filter'), 'int'); //活動id
	
		$post = JRequest::get( 'post' ); //取得post變數
		$vip_num_obj[0] = JRequest::getVar( 'quantity', '', 'post','string', JREQUEST_ALLOWRAW);//取得需要給她幾個VIP CODE數量

		if($returnid!='' || $returnid!=0){
				
			(int)$vip_num = $vip_num_obj[0]; 
			settype($vip_num,int);				
			//取出資料庫中的vip code並裝入$sql_code[]
			$db = JFactory::getDBO();
		   	$vip_code = "SELECT vip_code ".
						"FROM #__eventlist_vip ";
			$db->setQuery($vip_code);
			$vipcode = $db->loadObjectList();
			
			$sql_code 	= array();   //sql 中的code
			$vip_array 	= array();   //新的code放入的地方
		
			foreach($vipcode as $code_value){
				$sql_code[] = $code_value->vip_code;
			}

			//產生新的vipcode並且跟sql中的vipcode比對
			if($sql_code[0] == ""){
				for($v=0;$v<$vip_num;$v++){
						
					$vip_n=EventListControllervip::new_code();
					
					if(in_array($vip_n, $vip_array) == false){	
						$vip_array[$v] = $vip_n;
					}else{
						$v=$v-1;
					}
				}
			}else{
				for($v=0;$v<$vip_num;$v++){
						
					$vip_n = EventListControllervip::new_code();
					
					if(in_array($vip_n, $vip_array)==false and in_array($vip_n, $sql_code)==false){	
						$vip_array[$v] = $vip_n; 
					}else{
						$v=$v-1;
					}
				}
			}

			for($i=0;$i<count($vip_array);$i++){
				
				$inv_vip = new stdClass();
				$inv_vip->reg_id	= $returnid;
				$inv_vip->vip_code 	= $vip_array[$i];
				$code_array[]		= $vip_array[$i];
				
				$inv_vip->code_state= 'n';
				$db->insertObject('#__eventlist_vip', $inv_vip,true);
			}

			$codes = implode("，",$code_array);
			
			$msg = JText::_( 'PRODUCE' )." ".$codes;
			$this->setRedirect( 'index.php?option=com_eventlist&view=vip', $msg );
			
		}else{
			$msg = JText::_( 'vip error' );
			$this->setRedirect( 'index.php?option=com_eventlist&view=vip', $msg );
		}
	}
	
	/*
	編輯vip code資料
	*/
	function edit( )
	{
		JRequest::setVar( 'view', 'editvip' );
		JRequest::setVar( 'hidemainmenu', 1 );

		$model 	= $this->getModel('editvip');
		$task 	= JRequest::getVar('task');
	
			$user	=& JFactory::getUser();
			if ($model->isCheckedOut( $user->get('id') )) {
				$this->setRedirect( 'index.php?option=com_eventlist&view=editvip', JText::_( 'EDITED BY ANOTHER ADMIN' ) );
			}
			$model->checkout();
		
		parent::display();
	}
	
	/*
	儲存vip code資料
	*/
	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$task	= JRequest::getVar('task');
		$post 	= JRequest::get( 'post' );

		$model = $this->getModel('editvip');
	
		if ($returnid = $model->store($post)) {

			switch ($task){
				case 'apply' :
					$link = 'index.php?option=com_eventlist&controller=vip&view=editvip&hidemainmenu=1&cid[]='.$returnid;
					break;

				default :
					$link = 'index.php?option=com_eventlist&view=vip';
					break;
			}
			$msg	= JText::_( 'CODE STATE SAVED');
			$cache = &JFactory::getCache('com_eventlist');
			$cache->clean();

		} else {
			$msg 	= 'SAVE ERROR';
			$link = 'index.php?option=com_eventlist&view=vip';
		}

		$model->checkin();
		$this->setRedirect( $link, $msg );

 	}
 	
	/*
	退出編輯vip code
	*/
	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or die( 'Invalid Token' );
		
		$event = & JTable::getInstance('eventlist_vip', '');
		$event->bind(JRequest::get('post'));
		$event->checkin();

		$this->setRedirect( 'index.php?option=com_eventlist&view=vip' );
	}
 	
}
?>
