<?php
	//翻译者：Eddy Chang(eddy@joomla.org.tw) 20060720
	//http://www.joomla.org.tw
	
define( "LM_SUBSCRIBE_SUBJECT", "您的电子报订阅于[mosConfig_live_site]" );
define( "LM_SUBSCRIBE_MESSAGE", 
"您好 [NAME],

您已经成功订阅电子报于 
[mosConfig_live_site]。
感谢您！

要确认您的订阅，请点按以下的连结或复制它
然后在您的浏览器中贴上。

[LINK]

_________________________
[mosConfig_live_site]" );

define( "LM_UNSUBSCRIBE_SUBJECT", "电子报服务于[mosConfig_live_site]：取消订阅" );
define( "LM_UNSUBSCRIBE_MESSAGE",
"您好 [NAME],

您已经取消订阅电子报服务于 [mosConfig_live_site].
感谢您使用这项服务。

________________________
[mosConfig_live_site]" );

define( "LM_NEWSLETTER_FOOTER",
"<br/><br/>___________________________________________________________<br/>
您会收到这个电子报是因为您之前有订阅<br/>
电子报服务于[mosConfig_live_site].<br/>
要取消订阅请点按这里：[UNLINK]" );

/* Module */
define( "LM_FORM_NOEMAIL", "请填入合法的电子邮件位址。" );
define( "LM_FORM_SHORTERNAME", "请使用短一点的订阅者名称。谢谢。" );
define( "LM_FORM_NONAME", "请填入订阅者名称。谢谢。" );
define( "LM_SUBSCRIBE", "订阅" );
define( "LM_UNSUBSCRIBE", "取消订阅" );
define( "LM_BUTTON_SUBMIT", "确认！" );

/* Backend */
define( "LM_ERROR_NEWSLETTER_COULDNTBESENT", "电子报无法送出！" );
define( "LM_NEWSLETTER_SENDTO_X_USERS", "电子报已送给{X}位用户" );
define( "LM_IMPORT_USERS", "汇入订阅者" );
define( "LM_EXPORT_USERS", "汇出订阅者" );
define( "LM_UPLAOD_FAILED", "上传错误" );
define( "LM_ERROR_PARSING_XML", "剖析XML档案时发生错误" );
define( "LM_ERROR_NO_XML", "请上传xml档案" );
define( "LM_ERROR_EMAIL_ALREADY_ONLIST", "这个电子邮件位址已存在于清单中" );
define( "LM_SUCCESS_ON_IMPORT", "成功汇入{X}位订阅者。" );
define( "LM_IMPORT_FINISHED", "汇入结束" );
define( "LM_ERROR_DELETING_FILE", "档案无法删除" );
define( "LM_DIR_NOT_WRITABLE", "无法写入目录 ".$GLOBALS['mosConfig_cachepath'] );
define( "LM_ERROR_INVALID_EMAIL", "不合法的电子邮件位址" );
define( "LM_ERROR_EMPTY_EMAIL", "空白的电子邮件位址" );
define( "LM_ERROR_EMPTY_FILE", "错误：空白档案" );
define( "LM_ERROR_ONLY_TEXT", "仅能使用文字档案" );

define( "LM_SELECT_FILE", "请选择一个档案" );
define( "LM_YOUR_XML_FILE", "您的 YaNC/Letterman XML 汇出档案" );
define( "LM_YOUR_CSV_FILE", "CSV 汇入档案" );
define( "LM_POSITION_NAME", "-Name- 栏位的位置" );
define( "LM_NAME_COL", "Name栏位" );
define( "LM_POSITION_EMAIL", "-Email- 栏位的位置" );
define( "LM_EMAIL_COL", "Email栏位" );
define( "LM_STARTFROM", "开始汇入从行数..." );
define( "LM_STARTFROMLINE", "开始行数" );
define( "LM_CSV_DELIMITER", "CSV 分隔符号" );
define( "LM_CSV_DELIMITER_TIP", "CSV 分隔符号： , ; 或Tabulator（跳格键）" );

/* Newsletter Management */
define( "LM_NM", "电子报管理" );
define( "LM_MESSAGE", "讯息" );
define( "LM_LAST_SENT", "最后送出" );
define( "LM_SEND_NOW", "立即送出" );
define( "LM_CHECKED_OUT", "提交" );
define( "LM_NO_EXPIRY", "完成：无过期的" );
define( "LM_WARNING_SEND_NEWSLETTER", "您确认要送出电子报？\\n警告：如果您针对数量多的群组用户寄送，需要花一点时间！" );
define( "LM_SEND_NEWSLETTER", "送出电子报" );
define( "LM_SEND_TO_GROUP", "送给群组" );
define( "LM_MAIL_FROM", "寄件人是" );
define( "LM_DISABLE_TIMEOUT", "关闭时间限制" );
define( "LM_DISABLE_TIMEOUT_TIP", "勾选已保护程式码产生时间限制错误。<br/><strong>在安全模组式下是没有作用的！<strong>" );
define( "LM_REPLY_TO", "回覆到" );
define( "LM_MSG_HTML", "讯息 (HTML-所视即所得)" );
define( "LM_MSG", "讯息 (HTML-原始码)" );
define( "LM_TEXT_MSG", "额外的文字讯息" );
define( "LM_NEWSLETTER_ITEM", "电子报项目" );

/* Subscriber Management */
define( "LM_SUBSCRIBER", "订阅者" );
define( "LM_NEW_SUBSCRIBER", "新订阅者" );
define( "LM_EDIT_SUBSCRIBER", "编辑订阅者" );
define( "LM_SELECT_SUBSCRIBER", "选择订阅者" );
define( "LM_SUBSCRIBER_NAME", "订阅者姓名" );
define( "LM_SUBSCRIBER_EMAIL", "订阅者电子邮件" );
define( "LM_SIGNUP_DATE", "订阅日期" );
define( "LM_CONFIRMED", "已确认" );
define( "LM_SUBSCRIBER_SAVED", "订阅者资讯已储存" );
define( "LM_SUBSCRIBERS_DELETED", "您已成功删除了{X}位订阅者。" );
define( "LM_SUBSCRIBER_DELETED", "订阅者已经被删除。" );

/* Frontend */
define( "LM_ALREADY_SUBSCRIBED", "您已经订阅我们的电子报。" );
define( "LM_NOT_SUBSCRIBED", "您目前没有订阅我们的电子报。" );
define( "LM_YOUR_DETAILS", "您的详细资料：" );
define( "LM_SUBSCRIBE_TO", "订阅我们的电子报" );
define( "LM_UNSUBSCRIBE_FROM", "取消订阅我们的电子报" );
define( "LM_VALID_EMAIL_PLEASE", "请输入合法的电子邮件位址！" );
define( "LM_SAME_EMAIL_TWICE", "您填入的电子邮件位址已经在我们的订阅者清单中！" );
define( "LM_ERROR_SENDING_SUBSCRIBE", "订阅讯息无法被送达：" );
define( "LM_SUCCESS_SUBSCRIBE", "您的电子邮件位址已经加入我们的电子报中。" );
define( "LM_RETURN_TO_NL", "回到电子报" );
define( "LM_ERROR_UNSUBSCRIBE_OTHER_USER", "抱歉，您无法删除其它在清单中的用户。" );
define( "LM_ERROR_SENDING_UNSUBSCRIBE", "一个取消订阅的讯息无法被送出：" );
define( "LM_SUCCESS_UNSUBSCRIBE", "您的电子邮件位址已经从我们的电子报中移除。" );
define( "LM_SUCCESS_CONFIRMATION", "您的帐户已成功被确认" );
define( "LM_ERROR_CONFIRM_ACC_NOTFOUND", "与您确认连结的相关帐户资料无法找到。" );

define( "LM_CONFIRMED_ACCOUNTS_ONLY", "只有要确认帐户？" );
define( "LM_CONFIRMED_ACCOUNTS_ONLY_TIP", "只寄送电子报给<strong>有确认过</strong>的订阅者帐户。订阅者但未完成确认动作的，是不会收到电子报的。" );

define( "LM_NAME_TAG_USAGE", "您可使用标签<strong>[NAME]</strong>在电子报中，用来寄送针对个人的电子报。<br/>当寄送电子报时，[NAME]会被用户/订阅者的姓名所取代。" );

define( "LM_USERS_TO_SUBSCRIBERS", "让用户成为订阅者" );
define( "LM_ASSIGN_USERS", "指派用户" );
define( "LM_FORM_MSG", "回覆表单" );

/**
 * @since Letterman 1.2.0
 */
define( 'LM_SEND_LOG', 'Letterman 电子报寄送日志' );
define( 'LM_NUMBER_OF_MAILS_SENT', '%s 于 %s 邮件已经被送出。');
define( 'LM_SEND_NEXT_X_MAILS', '点按这按钮寄送剩下的 %s 邮件。');
define( 'LM_CHANGE_MAILS_PER_STEP', '更改每步骤的邮件数量');
define( 'LM_CONFIRM_ABORT_SENDING', '您真的要停止寄送中的电子报？');
define( 'LM_MAILS_PER_STEP', '每次要寄送多少数量的电子报？');
define( 'LM_CONFIRM_UNSUBSCRIBE', '您真的要停止订阅我们的电子报服务？');

/**
 * @since Letterman 1.2.1
 */
define( 'LM_COMPOSE_NEWSLETTER', '编辑电子报从内容项目');
define( 'LM_USABLE_TAGS', '您可使用的标签' );
define( 'LM_CONTENT_ITEMS', '内容项目' );
define( 'LM_ADD_CONTENT', '新增内容项目/文章' );
define( 'LM_ADD_CONTENT_TOOLTIP', '如果您从列表中选择一个内容项目，一个标签将会被插入到文字区域中。这个标签在储存之后将会在文章中被转译出来(摘要文字只能使用图片)。' );
define( 'LM_ATTACHMENTS', '附件' );
define( 'LM_ATTACHMENTS_TOOLTIP', '您可从目录 %s 选择一个或多个档案，可以用来嵌入到要被寄送出的邮件中。请不要在意标签[ATTACHMENT ..] - 这个将会寄送时被移除！' );
define( 'LM_MULTISELECT', '使用Ctrl键和滑鼠点按来复选档案' );

?>