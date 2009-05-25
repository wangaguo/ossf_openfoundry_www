<?php
// *******************************************************************
// Title          udde Instant Messages (uddeIM)
// Description    Instant Messages System for Mambo 4.5.X/Joomla 1.0.X
// Author         Benjamin Zweifel
// Version        1.5 
// as of          2008/12/1
// License        This is free software and you may redistribute it under the GPL.
//                uddeim comes with absolutely no warranty. For details, see the license at
//                http://www.gnu.org/licenses/gpl.txt
// *******************************************************************
// Language file: Simplified Chinese (source file is UTF-8)
// Translator: baijianpeng ( http://www.joomlagate.com )
//             Eric Cheng  ( http://www.webtmp.cn)
// *******************************************************************

// New: 1.5
DEFINE ('_UDDEMODULE_ALLDAYS', ' 站内消息');
DEFINE ('_UDDEMODULE_7DAYS', ' 本周周收到的消息');
DEFINE ('_UDDEMODULE_30DAYS', ' 本月收到的消息');
DEFINE ('_UDDEMODULE_365DAYS', ' 今年收到的消息');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_WARNING', '<br /><b>注意:<br />如果您正在使用mosMail,请设置一个有效的email地址!</b>');
DEFINE ('_UDDEIM_FILTEREDMESSAGE', '条消息已被筛选');
DEFINE ('_UDDEIM_FILTEREDMESSAGES', '条消息已被筛选');
DEFINE ('_UDDEIM_FILTER', '筛选:');
DEFINE ('_UDDEIM_FILTER_TITLE_INBOX', '仅显示来自此会员的消息');
DEFINE ('_UDDEIM_FILTER_TITLE_OUTBOX', '仅显示发送至此会员的消息');
DEFINE ('_UDDEIM_FILTER_UNREAD_ONLY', '仅显示未读消息');
DEFINE ('_UDDEIM_FILTER_SUBMIT', '筛选');
DEFINE ('_UDDEIM_FILTER_ALL', '- 所有会员 -');
DEFINE ('_UDDEIM_FILTER_PUBLIC', '- 仅对游客 -');
DEFINE ('_UDDEADM_FILTER_HEAD', '启用筛选');
DEFINE ('_UDDEADM_FILTER_EXP', '启用筛选时，会员可以设置在收件箱/发件箱内仅显示特定收件人或发件人的消息.');
DEFINE ('_UDDEADM_FILTER_P0', '禁用');
DEFINE ('_UDDEADM_FILTER_P1', '在消息列表上方显示');
DEFINE ('_UDDEADM_FILTER_P2', '在消息列表下方显示');
DEFINE ('_UDDEADM_FILTER_P3', '同时在消息列表上方和下方显示');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED', '<b>您目前有%s条消息在%s中.</b>');	// see next also six lines
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_UNREAD', '未读消息');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_FROM', '来自该会员');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_TO', '发送至该会员');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_INBOX', ' 收件箱');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_OUBOX', ' 发件箱');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_ARCHIVE', '存档');
DEFINE ('_UDDEIM_TODP_TITLE', '收件人');
DEFINE ('_UDDEIM_TODP_TITLE_CC', '一个或多个收件人(使用半角逗号间隔)');
DEFINE ('_UDDEIM_ADDCCINFO_TITLE', '启用此功能时，将自动在消息内添加一行包含所有收件人的信息.');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING_2', '...设置自动回复、自动转发、收件箱、过滤器参数');
DEFINE ('_UDDEADM_AUTORESPONDER_HEAD', '启用自动回复');
DEFINE ('_UDDEADM_AUTORESPONDER_EXP', '启用自动回复功能时，会员可以在个人设定中设置自动回复功能.');
DEFINE ('_UDDEIM_EMN_AUTORESPONDER', '启用自动回复功能');
DEFINE ('_UDDEIM_AUTORESPONDER', '自动回复');
DEFINE ('_UDDEIM_AUTORESPONDER_EXP', '启用自动回复功能时，所有收到的消息将会自动接到一条回复.');
DEFINE ('_UDDEIM_AUTORESPONDER_DEFAULT', "很抱歉, 我暂时不在线.\n当我上线的时候，会尽快给您回复消息.");
DEFINE ('_UDDEADM_USERSET_AUTOR', '自动回复');
DEFINE ('_UDDEADM_USERSET_SELAUTOR', '- 自动回复 -');
DEFINE ('_UDDEIM_USERBLOCKED', '此会员已被禁用.');
DEFINE ('_UDDEADM_AUTOFORWARD_HEAD', '启用自动转发');
DEFINE ('_UDDEADM_AUTOFORWARD_EXP', '启用自动转发时，会员收到的所有消息将会被自动转发至另一位会员.');
DEFINE ('_UDDEIM_EMN_AUTOFORWARD', '启用自动转发功能');
DEFINE ('_UDDEADM_USERSET_AUTOF', '自动转发');
DEFINE ('_UDDEADM_USERSET_SELAUTOF', '- 自动转发 -');
DEFINE ('_UDDEIM_AUTOFORWARD', '自动转发');
DEFINE ('_UDDEIM_AUTOFORWARD_EXP', '新的站内消息将会被自动转发给设定的会员.');
DEFINE ('_UDDEIM_THISISAFORWARD', '此消息自动转发自收件人');
DEFINE ('_UDDEADM_COLSROWS_HEAD', '收件箱(行数/列数)');
DEFINE ('_UDDEADM_COLSROWS_EXP', '此设定用于设置收件箱内显示的行数和列数(默认为60行/10列).');
DEFINE ('_UDDEADM_WIDTH_HEAD', '收件箱(宽度)');
DEFINE ('_UDDEADM_WIDTH_EXP', '此设定用于设置收件箱显示的宽度(单位为px，默认值为0). 当此处设置为0时，收件箱的宽度由CSS中相关参数控制.');
DEFINE ('_UDDEADM_CBE', 'CB 增强');

// New: 1.4
DEFINE ('_UDDEADM_IMPORT_CAPS', '导入');

// New: 1.3
DEFINE ('_UDDEADM_MOOTOOLS_HEAD', 'MooTools脚本加载设定');
DEFINE ('_UDDEADM_MOOTOOLS_EXP', '此设置将设定uddeIM加载MooTools脚本的方式 (自动完成器“Autocompleter”的使用需要加载MooTools脚本): 如果已经在模板设置中加载了MooTools脚本,请在此处设置为<b>从不</b>, 建议设置为<b>自动</b> , 如果使用的Joomla版本为1.0.x时请设置为强制加载MooTools 1.1版或者 1.2版脚本.');
DEFINE ('_UDDEADM_MOOTOOLS_NONE', '不加载 MooTools');
DEFINE ('_UDDEADM_MOOTOOLS_AUTO', '自动');
DEFINE ('_UDDEADM_MOOTOOLS_1', '强制加载 MooTools 1.1');
DEFINE ('_UDDEADM_MOOTOOLS_2', '强制加载 MooTools 1.2');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING_1', '使用MooTools默认设置');
DEFINE ('_UDDEADM_AGORA', '集会');

// New: 1.2
DEFINE ('_UDDEADM_CRYPT3', 'Base64 加密');
DEFINE ('_UDDEADM_TIMEZONE_HEAD', '调整时区设置');
DEFINE ('_UDDEADM_TIMEZONE_EXP', '当uddeIM显示时间有误时，请在此处调整市区设置.时间显示正确时请在这里设置为0.');
DEFINE ('_UDDEADM_HOURS', '小时');
DEFINE ('_UDDEADM_VERSIONCHECK', '版本信息:');
DEFINE ('_UDDEADM_STATISTICS', '统计信息:');
DEFINE ('_UDDEADM_STATISTICS_HEAD', '显示统计信息');
DEFINE ('_UDDEADM_STATISTICS_EXP', '此处将显示统计信息,如存储的消息条数等.');
DEFINE ('_UDDEADM_STATISTICS_CHECK', '显示统计信息');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT', '数据库中存储的消息条数: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_RECIPIENT', '被接收者删除的消息条数: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_SENDER', '被发送者删除的消息条数: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_TRASH', '待清理的消息条数: ');
DEFINE ('_UDDEADM_OVERWRITEITEMID_HEAD', '覆盖项目id');
DEFINE ('_UDDEADM_OVERWRITEITEMID_EXP', '正常情况下 uddeIM 会自行检测项目id是否已被使用、是否正确.在一些情况下条目id可能需要被覆盖,比如.设定了多个菜单链接至uddeIM.');
DEFINE ('_UDDEADM_OVERWRITEITEMID_CURRENT', '目前项目 id 是: ');
DEFINE ('_UDDEADM_USEITEMID_HEAD', '使用此项目id');
DEFINE ('_UDDEADM_USEITEMID_EXP', '修改目前的项目为新的项目id.');
DEFINE ('_UDDEADM_SHOWLINK_HEAD', '启用个人资料链接');
DEFINE ('_UDDEADM_SHOWLINK_EXP', '当设定为<b>是</b>时,在uddeIM中显示的所有会员名将会自动链接至会员的个人资料页面.');
DEFINE ('_UDDEADM_SHOWPIC_HEAD', '显示会员头像');
DEFINE ('_UDDEADM_SHOWPIC_EXP', '当设定为<b>是</b>时,每个会员的头像将在阅读站内消息时显示.');
DEFINE ('_UDDEADM_THUMBLISTS_HEAD', '在列表中显示会员头像');
DEFINE ('_UDDEADM_THUMBLISTS_EXP', '当设定为<b>是</b>时,将在消息列表中显示联系人的头像(收件箱,发件箱等.)');
DEFINE ('_UDDEADM_FIREBOARD', 'Fireboard');
DEFINE ('_UDDEADM_CB', 'Community Builder');
DEFINE ('_UDDEADM_DISABLED', '启用');
DEFINE ('_UDDEADM_ENABLED', '关闭');
DEFINE ('_UDDEIM_STATUS_FLAGGED', '导入');
DEFINE ('_UDDEIM_STATUS_UNFLAGGED', '');
DEFINE ('_UDDEADM_ALLOWFLAGGED_HEAD', '开启消息标签功能');
DEFINE ('_UDDEADM_ALLOWFLAGGED_EXP', '开启消息标签功能 (启用此功能时,uddeIM将在被标记的消息前显示一个星型标签，用以表示此消息为重要消息).');
DEFINE ('_UDDEADM_REVIEWUPDATE', '注意:当从早期版本升级uddIM的话，请仔细阅读README.有时需要手动对数据库表格和内容加以调整!');
DEFINE ('_UDDEIM_ADDCCINFO', '添加转发信息');
DEFINE ('_UDDEIM_CC', '转发:');
DEFINE ('_UDDEADM_TRUNCATE_HEAD', '引用文字截取功能');
DEFINE ('_UDDEADM_TRUNCATE_EXP', '当引用文字超过字数限额时，将截取全部内容的2/3作为引用内容.');
DEFINE ('_UDDEIM_PLUG_INBOXENTRIES', '收件箱 ');
DEFINE ('_UDDEIM_PLUG_LAST', '最后的 ');
DEFINE ('_UDDEIM_PLUG_ENTRIES', ' 条目');
DEFINE ('_UDDEIM_PLUG_STATUS', '状态');
DEFINE ('_UDDEIM_PLUG_SENDER', '发件人');
DEFINE ('_UDDEIM_PLUG_MESSAGE', '站内消息');
DEFINE ('_UDDEIM_PLUG_EMPTYINBOX', '清空收件箱');

// New: 1.1
DEFINE ('_UDDEADM_NOTRASHACCESS_NOT', '消息回收站访问权限被关闭.');
DEFINE ('_UDDEADM_NOTRASHACCESS_HEAD', '回收站访问权限设定');
DEFINE ('_UDDEADM_NOTRASHACCESS_EXP', '设置是否关闭回收站访问权限.默认设置下，所有会员可以访问消息回收站(<b>没有限制</b>).当访问权限被关闭时，仅允许特定会员或者管理员可以访问回收站, 而权限较低的群组成员就无法访问回收站并恢复被删除的消息。.');
DEFINE ('_UDDEADM_NOTRASHACCESS_0', '允许所有会员访问');
DEFINE ('_UDDEADM_NOTRASHACCESS_1', '特殊会员组及管理员访问');
DEFINE ('_UDDEADM_NOTRASHACCESS_2', '仅限管理员访问');
DEFINE ('_UDDEADM_PUBHIDEUSERS_HEAD', '在公开会员列表中隐藏下列会员');
DEFINE ('_UDDEADM_PUBHIDEUSERS_EXP', '输入会员的 ID(例如：65,66,67)，这些会员将不会显示在公开的会员列表中。');
DEFINE ('_UDDEADM_HIDEUSERS_HEAD', '在会员列表中隐藏下列会员');
DEFINE ('_UDDEADM_HIDEUSERS_EXP', '输入会员的 ID(例如：65,66,67)，这些会员将不会显示在会员列表中.，但管理员仍可查看包含隐藏会员的完整会员列表.');
DEFINE ('_UDDEIM_ERRORCSRF', 'CSRF 攻击识别');
DEFINE ('_UDDEADM_CSRFPROTECTION_HEAD', '开启 CSRF 保护');
DEFINE ('_UDDEADM_CSRFPROTECTION_EXP', '此项保护将防止伪造的跨站请求攻击. 默认情况下请开启此功能.仅限于遇到无法解决问题时请关闭此功能.');
DEFINE ('_UDDEIM_CANTREPLYARCHIVE', '您不能回复已存档消息.');
DEFINE ('_UDDEIM_COULDNOTRECALLPUBLIC', '向游客发送的消息无法撤回.');
DEFINE ('_UDDEADM_PUBREPLYS_HEAD', '允许游客回复消息');
DEFINE ('_UDDEADM_PUBREPLYS_EXP', '允许游客回复收到的站内消息.');
DEFINE ('_UDDEIM_EMN_BODY_PUBLICWITHMESSAGE',
"你好, %you%,\n\n%user% 在%site%向你发送了一条站内消息.\n__________________\n%pmessage%");
DEFINE ('_UDDEADM_PUBNAMESTEXT', '显示真实姓名');
DEFINE ('_UDDEADM_PUBNAMESDESC', '设置在前台显示为真实姓名或者会员名');
DEFINE ('_UDDEIM_USERLIST', '会员列表');
DEFINE ('_UDDEIM_YOUHAVETOWAIT', '很抱歉,请在发送新的站内消息前稍等片刻');
DEFINE ('_UDDEADM_USERSET_LASTSENT', '最后发送');
DEFINE ('_UDDEADM_TIMEDELAY_HEAD', '时间延迟');
DEFINE ('_UDDEADM_TIMEDELAY_EXP', '两次发送新的站内消息最小间隔(秒)： (0 表示没有间隔时间要求).');
DEFINE ('_UDDEADM_SECONDS', '秒');
DEFINE ('_UDDEIM_PUBLICSENT', '消息已发送.');
DEFINE ('_UDDEIM_ERRORINFROMNAME', '发件人信息有误');
DEFINE ('_UDDEIM_ERRORINEMAIL', 'email地址有误');
DEFINE ('_UDDEIM_YOURNAME', '您的姓名:');
DEFINE ('_UDDEIM_YOUREMAIL', '您的email:');
DEFINE ('_UDDEADM_VERSIONCHECK_USING', '你正在使用 uddeIM ');
DEFINE ('_UDDEADM_VERSIONCHECK_LATEST', '你目前使用的为最新版uddeIM.');
DEFINE ('_UDDEADM_VERSIONCHECK_CURRENT', '目前使用版本为');
DEFINE ('_UDDEADM_VERSIONCHECK_INFO', '升级信息:');
DEFINE ('_UDDEADM_VERSIONCHECK_HEAD', '检查升级信息');
DEFINE ('_UDDEADM_VERSIONCHECK_EXP', '此连接将访问uddeIM官方网站并获取最新uddeIM版本信息. 除了你所使用uddeIM版本信息外,将不会发送任何其它信息.');
DEFINE ('_UDDEADM_VERSIONCHECK_CHECK', '立刻检查');
DEFINE ('_UDDEADM_VERSIONCHECK_ERROR', '无法获得版本信息.');
DEFINE ('_UDDEIM_NOSUCHLIST', '联系列表不存在!');
DEFINE ('_UDDEIM_LISTSLIMIT_1', '超过了同时收件人数限额(最大. ');
DEFINE ('_UDDEADM_MAXONLISTS_HEAD', '站内消息容量');
DEFINE ('_UDDEADM_MAXONLISTS_EXP', '站内消息容量.');
DEFINE ('_UDDEIM_LISTSNOTENABLED', '联系人列表未启用');
DEFINE ('_UDDEADM_ENABLELISTS_HEAD', '启用联系人列表');
DEFINE ('_UDDEADM_ENABLELISTS_EXP', 'uddeIM 允许会员建立联系人列表.此列表可用于向多会员发送站内消息.当开启联系人列表使用功能时,请同时开启向多收件人发送站内消息功能.');
DEFINE ('_UDDEADM_ENABLELISTS_0', '关闭');
DEFINE ('_UDDEADM_ENABLELISTS_1', '注册会员');
DEFINE ('_UDDEADM_ENABLELISTS_2', '特殊会员组');
DEFINE ('_UDDEADM_ENABLELISTS_3', '仅限管理员');
DEFINE ('_UDDEIM_LISTSNEW', '建立新的联系人列表');
DEFINE ('_UDDEIM_LISTSSAVED', '新的联系人列表已保存');
DEFINE ('_UDDEIM_LISTSUPDATED', '联系人列表已更新');
DEFINE ('_UDDEIM_LISTSDESC', '联系人资料');
DEFINE ('_UDDEIM_LISTSNAME', '姓名');
DEFINE ('_UDDEIM_LISTSNAMEWO', '姓名 (请勿包含空格)');
DEFINE ('_UDDEIM_EDITLINK', '编辑');
DEFINE ('_UDDEIM_LISTS', '联系人');
DEFINE ('_UDDEIM_STATUS_READ', '已读');
DEFINE ('_UDDEIM_STATUS_UNREAD', '未读');
DEFINE ('_UDDEIM_STATUS_ONLINE', '在线');
DEFINE ('_UDDEIM_STATUS_OFFLINE', '离线');
DEFINE ('_UDDEADM_CBGALLERY_HEAD', '显示 CB 头像');
DEFINE ('_UDDEADM_CBGALLERY_EXP', '默认设置下uddeIM不显示会员头像.当此设定开启时,uddeIM将显示会员在CB中的头像.');
DEFINE ('_UDDEADM_UNBLOCKCB_HEAD', '启用 CB 联系人');
DEFINE ('_UDDEADM_UNBLOCKCB_EXP', '允许发送者向CB 联系人列表中的联系人发送消息 (无论收件人是否在屏蔽列表中).此设定独立于会员设定的单独屏蔽.');
DEFINE ('_UDDEIM_GROUPBLOCKED', '向该会员组发送消息受限.');
DEFINE ('_UDDEIM_ONEUSERBLOCKS', '收件人已将你加入忽略列表.');
DEFINE ('_UDDEADM_BLOCKGROUPS_HEAD', '对注册会员屏蔽的会员组');
DEFINE ('_UDDEADM_BLOCKGROUPS_EXP', '设置不接收注册会员所发站内消息的会员组，注册会员无法向该会员组发送消息.此设定作用于注册会员. 特殊会员组和管理员不受此设定影响. 此设定独立于会员自定义忽略列表.');
DEFINE ('_UDDEADM_PUBBLOCKGROUPS_HEAD', '对游客屏蔽的会员组');
DEFINE ('_UDDEADM_PUBBLOCKGROUPS_EXP', '设置不接收游客站内消息的会员组，游客无法向该会员组发送消息。此设定独立于会员自定义忽略列表.当该会员组被屏蔽时,此会员组成员将在个人设定中无法启用公众前台功能.');
DEFINE ('_UDDEADM_BLOCKGROUPS_1', '游客');
DEFINE ('_UDDEADM_BLOCKGROUPS_2', 'CB 连接');
DEFINE ('_UDDEADM_BLOCKGROUPS_18', '注册会员');
DEFINE ('_UDDEADM_BLOCKGROUPS_19', '作者');
DEFINE ('_UDDEADM_BLOCKGROUPS_20', '主编');
DEFINE ('_UDDEADM_BLOCKGROUPS_21', '总编');
DEFINE ('_UDDEADM_BLOCKGROUPS_23', '初级管理员');
DEFINE ('_UDDEADM_BLOCKGROUPS_24', '高级管理员');
DEFINE ('_UDDEADM_BLOCKGROUPS_25', '超级管理员');
DEFINE ('_UDDEIM_NOPUBLICMSG', '会员仅接受来自注册会员的站内消息.');
DEFINE ('_UDDEADM_PUBHIDEALLUSERS_HEAD', '从公开会员列表中隐藏');
DEFINE ('_UDDEADM_PUBHIDEALLUSERS_EXP', '特定会员组成员将被从公开会员列表中隐藏. 注: 此设定仅隐藏会员名，会员仍能收到站内消息. 未启用公众前台的会员将不会加入此列表.');
DEFINE ('_UDDEADM_HIDEALLUSERS_HEAD', '在会员列表中隐藏的用户组');
DEFINE ('_UDDEADM_HIDEALLUSERS_EXP', '特定会员组成员将在所有会员列表中被隐藏.注: 此设定仅隐藏会员名，会员仍能收到站内消息.');
DEFINE ('_UDDEADM_HIDEALLUSERS_0', '无');
DEFINE ('_UDDEADM_HIDEALLUSERS_1', '仅限超级管理员');
DEFINE ('_UDDEADM_HIDEALLUSERS_2', '仅限管理员');
DEFINE ('_UDDEADM_HIDEALLUSERS_3', '特殊会员组');
DEFINE ('_UDDEADM_PUBLIC', '游客');
DEFINE ('_UDDEADM_PUBMODESHOWALLUSERS_HEAD', '"所有会员"链接设定');
DEFINE ('_UDDEADM_PUBMODESHOWALLUSERS_EXP', '是否在公众前台上隐藏 "所有会员" 链接, 还是始终都显示该链接.');
DEFINE ('_UDDEADM_USERSET_PUBLIC', '公众前台');
DEFINE ('_UDDEADM_USERSET_SELPUBLIC', '- 选择游客 -');
DEFINE ('_UDDEIM_OPTIONS_F', '允许游客发送站内消息');
DEFINE ('_UDDEIM_MSGLIMITREACHED', '收件箱已满!');
DEFINE ('_UDDEIM_PUBLICUSER', '游客');
DEFINE ('_UDDEIM_DELETEDUSER', '会员已删除');
DEFINE ('_UDDEADM_CAPTCHALEN_HEAD', '验证码长度');
DEFINE ('_UDDEADM_CAPTCHALEN_EXP', '指定会员需要输入的验证码字符数.');
DEFINE ('_UDDEADM_USECAPTCHA_HEAD', '开启验证码验证功能');
DEFINE ('_UDDEADM_USECAPTCHA_EXP', '指定发送消息时需要输入验证码的会员和会员组');
DEFINE ('_UDDEADM_CAPTCHAF0', '关闭');
DEFINE ('_UDDEADM_CAPTCHAF1', '仅限游客');
DEFINE ('_UDDEADM_CAPTCHAF2', '游客及注册会员');
DEFINE ('_UDDEADM_CAPTCHAF3', '游客，注册会员，特殊会员');
DEFINE ('_UDDEADM_CAPTCHAF4', '所有会员 (包括管理员)');
DEFINE ('_UDDEADM_PUBFRONTEND_HEAD', '开启公众前台');
DEFINE ('_UDDEADM_PUBFRONTEND_EXP', '此功能启用时，将允许游客向本站注册会员发送站内消息(会员可以在个人设定中设置是否接收游客发送的消息).');
DEFINE ('_UDDEADM_PUBFRONTENDDEF_HEAD', '公众前台默认设置');
DEFINE ('_UDDEADM_PUBFRONTENDDEF_EXP', '此初始设置值下允许游客向注册会员发送站内消息.');
DEFINE ('_UDDEADM_PUBDEF0', '禁用');
DEFINE ('_UDDEADM_PUBDEF1', '启用');
DEFINE ('_UDDEIM_WRONGCAPTCHA', '验证码错误');

// New: 1.0
DEFINE ('_UDDEADM_NONEORUNKNOWN', '未知或者不存在');
DEFINE ('_UDDEADM_DONATE', '如果您喜爱 uddeIM 并打算给予开发团队一点支持的话，请向我们捐助.');
// New: 1.0rc2
DEFINE ('_UDDEADM_BACKUPRESTORE_DATE', '数据库中存在以下设置: ');
DEFINE ('_UDDEADM_BACKUPRESTORE_HEAD', '备份及恢复设置');
DEFINE ('_UDDEADM_BACKUPRESTORE_EXP', '将uddeIM设置备份至数据库中并在必要的时候从数据库中恢复.当升级uddeIM或者测试的时，请使用此功能.');
DEFINE ('_UDDEADM_BACKUPRESTORE_BACKUP', '备份设置');
DEFINE ('_UDDEADM_BACKUPRESTORE_RESTORE', '恢复设置');
DEFINE ('_UDDEADM_CANCEL', '取消');
// New: 1.0rc1
DEFINE ('_UDDEADM_LANGUAGECHARSET_HEAD', '语言文件字符编码');
DEFINE ('_UDDEADM_LANGUAGECHARSET_EXP', '通常情况下， <strong>默认</strong>（ISO-8859-1）是 Joomla 1.0 的正确设置，Joomla 1.5 使用 <strong>UTF-8</strong> .');
DEFINE ('_UDDEADM_LANGUAGECHARSET_UTF8', 'UTF-8');
DEFINE ('_UDDEADM_LANGUAGECHARSET_DEFAULT', '默认');
DEFINE ('_UDDEIM_READ_INFO_1', '已读消息在收件箱中最多保留 ');
DEFINE ('_UDDEIM_READ_INFO_2', ' 天。然后就自动删除。');
DEFINE ('_UDDEIM_UNREAD_INFO_1', '未读消息在收件箱中最多保留 ');
DEFINE ('_UDDEIM_UNREAD_INFO_2', ' 天。然后就自动删除。');
DEFINE ('_UDDEIM_SENT_INFO_1', '已发消息在发件箱中最多保留 ');
DEFINE ('_UDDEIM_SENT_INFO_2', ' 天。然后就自动删除。');
DEFINE ('_UDDEADM_DELETEREADAFTERNOTE_HEAD', '收件箱已读消息删除提示');
DEFINE ('_UDDEADM_DELETEREADAFTERNOTE_EXP', '设置是否在收件箱已读消息上显示"此已读消息在xx天后将被自动删除"');
DEFINE ('_UDDEADM_DELETEUNREADAFTERNOTE_HEAD', '收件箱未读消息删除提示');
DEFINE ('_UDDEADM_DELETEUNREADAFTERNOTE_EXP', '设置是否在收件箱未读消息上显示"此未读消息在xx天后将被自动删除"');
DEFINE ('_UDDEADM_DELETESENTAFTERNOTE_HEAD', '发件箱已发消息删除提示');
DEFINE ('_UDDEADM_DELETESENTAFTERNOTE_EXP', '设置是否在发件箱已发送消息上显示"此消息在xx天后将被自动删除"');
DEFINE ('_UDDEADM_DELETETRASHAFTERNOTE_HEAD', '回收站消息删除提示');
DEFINE ('_UDDEADM_DELETETRASHAFTERNOTE_EXP', '设置是否在回收站消息上显示"此消息在xx天后将被自动删除"');
DEFINE ('_UDDEADM_DELETESENTAFTER_HEAD', '已发消息保留天数');
DEFINE ('_UDDEADM_DELETESENTAFTER_EXP', '设置已发送消息在发件箱内的保存天数，超过保存天数的<b>已发消息</b>将会被从发件箱中自动删除.');
DEFINE ('_UDDEIM_SEND_TOALLSPECIAL', '发送至所有管理人员');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLSPECIAL', '消息发送至 <strong>所有管理人员</strong>');
DEFINE ('_UDDEADM_USERSET_SELUSERNAME', '- 选择会员名 -');
DEFINE ('_UDDEADM_USERSET_SELNAME', '- 选择姓名 -');
DEFINE ('_UDDEADM_USERSET_EDITSETTINGS', '修改会员设定');
DEFINE ('_UDDEADM_USERSET_EXISTING', '现有');
DEFINE ('_UDDEADM_USERSET_NONEXISTING', '不存在');
DEFINE ('_UDDEADM_USERSET_SELENTRY', '- 选择条目 -');
DEFINE ('_UDDEADM_USERSET_SELNOTIFICATION', '- 选择通知 -');
DEFINE ('_UDDEADM_USERSET_SELPOPUP', '- 选择弹出窗口 -');
DEFINE ('_UDDEADM_USERSET_USERNAME', '会员名');
DEFINE ('_UDDEADM_USERSET_NAME', '姓名');
DEFINE ('_UDDEADM_USERSET_NOTIFICATION', '通知');
DEFINE ('_UDDEADM_USERSET_POPUP', '弹出窗口');
DEFINE ('_UDDEADM_USERSET_LASTACCESS', '上次访问');
DEFINE ('_UDDEADM_USERSET_NO', '否');
DEFINE ('_UDDEADM_USERSET_YES', '是');
DEFINE ('_UDDEADM_USERSET_UNKNOWN', '未知');
DEFINE ('_UDDEADM_USERSET_WHENOFFLINEEXCEPT', '当离线时 (回复除外)');
DEFINE ('_UDDEADM_USERSET_ALWAYSEXCEPT', '总是 (回复除外)');
DEFINE ('_UDDEADM_USERSET_WHENOFFLINE', '当离线时');
DEFINE ('_UDDEADM_USERSET_ALWAYS', '总是');
DEFINE ('_UDDEADM_USERSET_NONOTIFICATION', '不通知');
DEFINE ('_UDDEADM_WELCOMEMSG', "欢迎使用 uddeIM!\n\n您已经成功安装了 uddeIM.\n\n请尝试用不同模板阅读此消息。您可以在 uddeIM 的管理后台设置模板。\n\nuddeIM 是一个仍然在开发中的项目。如果您发现了 bug 或者缺点，请写信告诉我，我们可以一起把 uddeIM 做的更好。\n\n祝您好运，请享用我们的产品!");
DEFINE ('_UDDEADM_UDDEINSTCOMPLETE', 'uddeIM 安装完成.');
DEFINE ('_UDDEADM_REVIEWSETTINGS', '请继续前往后台管理界面，检查本组件的各项设定。');
DEFINE ('_UDDEADM_REVIEWLANG', '如果您不是在以 ISO 8859-1 字符编码运行 Joomla! CMS，请注意调整成相应的编码设定。');
DEFINE ('_UDDEADM_REVIEWEMAILSTOP', '安装结束之后, uddeIM 的 email 发送功能 (email 通知, 未读提醒 emails) 是禁用状态，以便在您进行测试的时候，不会送出任何 email 。当您完成之后，不要忘记在后台禁用 "停止 email" 的选项。');
DEFINE ('_UDDEADM_MAXRECIPIENTS_HEAD', '收件人最多允许');
DEFINE ('_UDDEADM_MAXRECIPIENTS_EXP', '每个消息最多允许有多少个收件人(0 表示没有限制)');
DEFINE ('_UDDEIM_TOOMANYRECIPIENTS', '收件人太多了');
DEFINE ('_UDDEIM_STOPPEDEMAIL', '已禁用发送 emails 功能.');
DEFINE ('_UDDEADM_SEARCHINSTRING_HEAD', '在全文中搜索');
DEFINE ('_UDDEADM_SEARCHINSTRING_EXP', '在消息全文中也应用自动完成式搜索 (否则，仅在摘要文字中搜索)');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_HEAD', ' "全部会员" 链接');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_EXP', '设置是否显示 "全部会员" 链接，或者始终显示全部会员列表');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_0', '隐藏 "全部会员" 链接');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_1', '显示 "全部会员" 链接');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_2', '始终显示全部会员列表');
DEFINE ('_UDDEADM_CONFIGNOTWRITEABLE', '配置文件不可写:');
DEFINE ('_UDDEADM_CONFIGWRITEABLE', '配置文件可写:');
DEFINE ('_UDDEIM_FORWARDLINK', '转发');
DEFINE ('_UDDEIM_RECIPIENTFOUND', '收件人找到');
DEFINE ('_UDDEIM_RECIPIENTSFOUND', '收件人找到');
DEFINE ('_UDDEADM_MAILSYSTEM_MOSMAIL', 'mosMail');
DEFINE ('_UDDEADM_MAILSYSTEM_PHPMAIL', 'php mail (默认)');
DEFINE ('_UDDEADM_MAILSYSTEM_HEAD', '邮件发送系统');
DEFINE ('_UDDEADM_MAILSYSTEM_EXP', '选择 uddeIM 用来发送通知 E-mail的邮件系统.');
DEFINE ('_UDDEADM_SHOWGROUPS_HEAD', '显示 Joomla 群组');
DEFINE ('_UDDEADM_SHOWGROUPS_EXP', '在广播消息列表上显示 Joomla 群组.');
DEFINE ('_UDDEADM_ALLOWFORWARDS_HEAD', '消息转发');
DEFINE ('_UDDEADM_ALLOWFORWARDS_EXP', '允许转发消息.');
DEFINE ('_UDDEIM_FWDFROM', '原始消息来自：');
DEFINE ('_UDDEIM_FWDTO', '给：');

// New: 0.9+
DEFINE ('_UDDEIM_UNARCHIVE', '取消消息存档');
DEFINE ('_UDDEIM_CANTUNARCHIVE', '无法取消消息存档');
DEFINE ('_UDDEADM_ALLOWMULTIPLERECIPIENTS_HEAD', '允许群发');
DEFINE ('_UDDEADM_ALLOWMULTIPLERECIPIENTS_EXP', '允许发送给多个收件人(用逗号分隔).');
DEFINE ('_UDDEIM_CHARSLEFT', '个字符还可以输入');
DEFINE ('_UDDEADM_SHOWTEXTCOUNTER_HEAD', '显示文字计数');
DEFINE ('_UDDEADM_SHOWTEXTCOUNTER_EXP', '显示还可以输入多少个文字的计数提示.');
DEFINE ('_UDDEIM_CLEAR', '清除');
DEFINE ('_UDDEADM_ALLOWMULTIPLEUSER_HEAD', '将所选会员附加到收件人');
DEFINE ('_UDDEADM_ALLOWMULTIPLEUSER_EXP', '允许从“显示全部会员”的列表中选择多个收件人.');
DEFINE ('_UDDEADM_CBALLOWMULTIPLEUSER_HEAD', '将所选好友附加到收件人');
DEFINE ('_UDDEADM_CBALLOWMULTIPLEUSER_EXP', '允许从“CB 好友”的列表中选择多个收件人.');
DEFINE ('_UDDEADM_PMSFOUND', '找到的 PMS: ');
DEFINE ('_UDDEIM_ENTERNAME', '输入姓名');
DEFINE ('_UDDEADM_USEAUTOCOMPLETE_HEAD', '启用自动完成');
DEFINE ('_UDDEADM_USEAUTOCOMPLETE_EXP', '输入收件人名称时使用自动完成功能.');
DEFINE ('_UDDEADM_OBFUSCATING_HEAD', '混淆消息时使用的密钥');
DEFINE ('_UDDEADM_OBFUSCATING_EXP', '输入用于混淆消息的密钥。一旦混淆消息功能被启用，请不要更改此字串。');
DEFINE ('_UDDEADM_CFGFILE_NOTFOUND', '配置文件错误!');
DEFINE ('_UDDEADM_CFGFILE_FOUND', '找到的版本:');
DEFINE ('_UDDEADM_CFGFILE_EXPECTED', '需要的版本:');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING', '正在转换配置...');
DEFINE ('_UDDEADM_CFGFILE_DONE', '完成!');
DEFINE ('_UDDEADM_CFGFILE_WRITEFAILED', '严重错误: 无法写入配置文件:');

// New: 0.8+
DEFINE ('_UDDEIM_ENCRYPTDOWN', '消息已加密! - 无法下载!');
DEFINE ('_UDDEIM_WRONGPASSDOWN', '密码错误! - 无法下载!');
DEFINE ('_UDDEIM_WRONGPW', '密码错误! - 请与管理员联系!');
DEFINE ('_UDDEIM_WRONGPASS', '密码错误!');
DEFINE ('_UDDEADM_MAINTENANCE_D1', '错误的回收站日期 (inbox/outbox): ');
DEFINE ('_UDDEADM_MAINTENANCE_D2', '纠正错误的回收站日期');
DEFINE ('_UDDEIM_TODP', '收件人: ');
DEFINE ('_UDDEADM_MAINTENANCE_PRUNE', '立即清理消息');
DEFINE ('_UDDEADM_SHOWACTIONICONS_HEAD', '显示操作图标');
DEFINE ('_UDDEADM_SHOWACTIONICONS_EXP', '如果选择 <b>是</b>,操作链接将以图标显示。');
DEFINE ('_UDDEIM_UNCHECKALL', '取消全选');
DEFINE ('_UDDEIM_CHECKALL', '全选');
DEFINE ('_UDDEADM_SHOWBOTTOMICONS_HEAD', '显示底部图标');
DEFINE ('_UDDEADM_SHOWBOTTOMICONS_EXP', '如果设为 <b>是</b>,页面底部将显示链接及图标.');
DEFINE ('_UDDEADM_ANIMATED_HEAD', '使用动画表情图案');
DEFINE ('_UDDEADM_ANIMATED_EXP', '使用动画表情图案代替静态图案.');
DEFINE ('_UDDEADM_ANIMATEDEX_HEAD', '更多动画表情图案');
DEFINE ('_UDDEADM_ANIMATEDEX_EXP', '显示更多动画表情图案.');
DEFINE ('_UDDEIM_PASSWORDREQ', '消息已加密 - 需要输入密码');
DEFINE ('_UDDEIM_PASSWORD', '<strong>输入密码</strong>');
DEFINE ('_UDDEIM_PASSWORDBOX', '密码');
DEFINE ('_UDDEIM_ENCRYPTIONTEXT', ' (加密文字)');
DEFINE ('_UDDEIM_DECRYPTIONTEXT', ' (解密文字)');
DEFINE ('_UDDEIM_MORE', '更多');
// uddeIM Module
DEFINE ('_UDDEMODULE_PRIVATEMESSAGES', '站内消息');
DEFINE ('_UDDEMODULE_NONEW', '没有新消息');
DEFINE ('_UDDEMODULE_NEWMESSAGES', '新消息: ');
DEFINE ('_UDDEMODULE_MESSAGE', '消息');
DEFINE ('_UDDEMODULE_MESSAGES', '消息');
DEFINE ('_UDDEMODULE_YOUHAVE', '您有');
DEFINE ('_UDDEMODULE_HELLO', '您好');
DEFINE ('_UDDEMODULE_EXPRESSMESSAGE', '鸡毛信');

// New: 0.7+
DEFINE ('_UDDEADM_USEENCRYPTION', '消息加密设置');
DEFINE ('_UDDEADM_USEENCRYPTIONDESC', '加密已储存的消息');
DEFINE ('_UDDEADM_CRYPT0', '不加密');
DEFINE ('_UDDEADM_CRYPT1', '混淆消息');
DEFINE ('_UDDEADM_CRYPT2', '加密消息');
DEFINE ('_UDDEADM_NOTIFYDEFAULT_HEAD', '默认 E-mail通知');
DEFINE ('_UDDEADM_NOTIFYDEFAULT_EXP', 'E-mail通知默认值 (对未更改个人设定的会员生效).');
DEFINE ('_UDDEADM_NOTIFYDEF_0', '不通知');
DEFINE ('_UDDEADM_NOTIFYDEF_1', '始终通知');
DEFINE ('_UDDEADM_NOTIFYDEF_2', '离线时通知');
DEFINE ('_UDDEADM_SUPPRESSALLUSERS_HEAD', '隐藏 "显示全部会员" 链接');
DEFINE ('_UDDEADM_SUPPRESSALLUSERS_EXP', '在新建消息的页面中隐藏 "显示全部会员" 链接。 ');
DEFINE ('_UDDEADM_POPUP_HEAD','弹出式通知页面');
DEFINE ('_UDDEADM_POPUP_EXP','设置当收到新消息时是否显示一个弹出页面 (需配合修改版的 mod_cblogin 模块使用)');
DEFINE ('_UDDEIM_OPTIONS', '更多设定');
DEFINE ('_UDDEIM_OPTIONS_EXP', '点击此处进入更多设定页面.');
DEFINE ('_UDDEIM_OPTIONS_P', '当收到新消息时将自动显示一个弹出式通知页面');
DEFINE ('_UDDEADM_POPUPDEFAULT_HEAD', '默认使用弹出式通知窗口');
DEFINE ('_UDDEADM_POPUPDEFAULT_EXP', '设置系统是否默认启用弹出式通知页面 (会员可在个人设置中修改是否使用弹出式通知窗口).');
DEFINE ('_UDDEADM_MAINTENANCE', '维护');
DEFINE ('_UDDEADM_MAINTENANCE_HEAD', '当会员被删除时，同时将该会员的消息移动至回收站');
DEFINE ('_UDDEADM_MAINTENANCE_CHECK', '检查亢余消息');
DEFINE ('_UDDEADM_MAINTENANCE_TRASH', '清理回收站');
DEFINE ('_UDDEADM_MAINTENANCE_EXP', '当会员被删除时，该会员的消息往往还保留在数据库中。此功能可以检查是否需要删除亢余消息。如果需要，您可以删除它们。');
DEFINE ('_UDDEADM_MAINTENANCE_MC1', '正在检查 ...<br />');
DEFINE ('_UDDEADM_MAINTENANCE_MC2', '<b>#nnn (会员名): [收件箱|收件箱回收站|发件箱|发件箱回收站]</b><br />');
DEFINE ('_UDDEADM_MAINTENANCE_MC3', '<b>收件箱: 储存在会员收件箱中的消息。</b><br />');
DEFINE ('_UDDEADM_MAINTENANCE_MC4', '<b>收件箱回收站: 从会员的收件箱删除的消息，但仍然在其他某些人的发件箱中。</b><br />');
DEFINE ('_UDDEADM_MAINTENANCE_MC5', '<b>发件箱: 储存在会员发件箱的消息</b><br />');
DEFINE ('_UDDEADM_MAINTENANCE_MC6', '<b>发件箱回收站: 从会员的发件箱删除的消息，但仍然在其他某些人的收件箱中。</b><br />');
DEFINE ('_UDDEADM_MAINTENANCE_MT1', '正在删除 ...<br />');
DEFINE ('_UDDEADM_MAINTENANCE_NOTFOUND', '<b>#$i 没有找到 (from/to): $mvon/$man</b><br />');
DEFINE ('_UDDEADM_MAINTENANCE_MT2', '删除会员 #$i 的全部个人喜好设定<br />');
DEFINE ('_UDDEADM_MAINTENANCE_MT3', '删除对会员 #$i 的屏蔽<br />');
DEFINE ('_UDDEADM_MAINTENANCE_MT4', '将全部发送给会员 #$i 的消息从发件人的“发件箱”和会员 #$i 的“收件箱”中删除。<br />');
DEFINE ('_UDDEADM_MAINTENANCE_MT5', '将全部来自会员 #$i 的消息从 #$i 的“发件箱”和收件人的“收件箱”中删除。 <br />');
DEFINE ('_UDDEADM_MAINTENANCE_NOTHINGTODO', '<b>什么也不做</b><br />');
DEFINE ('_UDDEADM_MAINTENANCE_JOBTODO', '<b>必须删除</b><br />');

// New: 0.6+
DEFINE ('_UDDEADM_NAMESTEXT', '会员显示名称');
DEFINE ('_UDDEADM_NAMESDESC', '设置显示会员的真实姓名或会员名');
DEFINE ('_UDDEADM_REALNAMES', '真实姓名');
DEFINE ('_UDDEADM_USERNAMES', '会员名');
DEFINE ('_UDDEADM_CONLISTBOX', '好友列表显示格式');
DEFINE ('_UDDEADM_CONLISTBOXDESC', '设置好友列表显示为列表或表格');
DEFINE ('_UDDEADM_LISTBOX', '列表');
DEFINE ('_UDDEADM_TABLE', '表格');

DEFINE ('_UDDEIM_TRASHCAN_INFO', '消息在回收站中保留 24 小时后会被删除。在回收站中您将只能看到消息开头的几个字，如需阅读完整内容则必须首先还原该消息到原来的位置.');
DEFINE ('_UDDEIM_TRASHCAN_INFO_1', '消息在回收站中会保留 ');
DEFINE ('_UDDEIM_TRASHCAN_INFO_2', ' 小时，然后被删除。在回收站中您将只能看到消息开头的几个字，如需阅读完整内容则必须首先还原该消息到原来的位置.');
DEFINE ('_UDDEIM_RECALLEDMESSAGE_INFO', '此消息已被撤回，您现在可以修改并重新发送。');
DEFINE ('_UDDEIM_COULDNOTRECALL', '消息撤回失败。 (可能该消息已被阅读或者删除)');
DEFINE ('_UDDEIM_CANTRESTORE', '消息还原失败。 (可能该消息在回收站中时间超过保存时限，并已经被彻底删除。)');
DEFINE ('_UDDEIM_COULDNOTRESTORE', '消息还原失败.');
DEFINE ('_UDDEIM_DONTSEND', '不发送');
DEFINE ('_UDDEIM_SENDAGAIN', '重新发送');
DEFINE ('_UDDEIM_NOTLOGGEDIN', '您还未登录.');
DEFINE ('_UDDEIM_NOMESSAGES_INBOX', '<strong>您的收件箱中没有消息。</strong>');
	// changed in 0.4 (one dot that was too much after </strong> deleted)

DEFINE ('_UDDEIM_NOMESSAGES_OUTBOX', '<strong>您的发件箱中没有消息.</strong>');
DEFINE ('_UDDEIM_NOMESSAGES_TRASHCAN', '<strong>您的回收站中没有消息.</strong>');
DEFINE ('_UDDEIM_INBOX', '收件箱');
DEFINE ('_UDDEIM_OUTBOX', '发件箱');
DEFINE ('_UDDEIM_TRASHCAN', '回收站');
DEFINE ('_UDDEIM_CREATE', '新建消息');
DEFINE ('_UDDEIM_UDDEIM', '站内消息');
DEFINE ('_UDDEIM_READSTATUS', '已读');
DEFINE ('_UDDEIM_FROM', '发件人：');
DEFINE ('_UDDEIM_FROM_SMALL', '发件人：');
DEFINE ('_UDDEIM_TO', '收件人：');
DEFINE ('_UDDEIM_TO_SMALL', '收件人：');
DEFINE ('_UDDEIM_OUTBOX_WARNING', '您的发件箱中保存您已经送出并且还没有被删除的消息。如果对方还没有阅读，您可以在发件箱中撤回该消息。当消息被撤回时，收件人将无法再读取该消息。');
	// changed in 0.4

DEFINE ('_UDDEIM_RECALL', '撤回');
DEFINE ('_UDDEIM_RECALLTHISMESSAGE', '撤回该消息');
DEFINE ('_UDDEIM_RESTORE', '还原');
DEFINE ('_UDDEIM_MESSAGE', '消息');
DEFINE ('_UDDEIM_DATE', '日期');
DEFINE ('_UDDEIM_DELETED', '已删除');
DEFINE ('_UDDEIM_DELETE', '删除');
DEFINE ('_UDDEIM_ONLINEPIC', 'images/icon_online.gif');
DEFINE ('_UDDEIM_OFFLINEPIC', 'images/icon_offline.gif');
DEFINE ('_UDDEIM_DELETELINK', '删除');
DEFINE ('_UDDEIM_MESSAGENOACCESS', '此消息无法显示。<br />可能的原因:<ul><li>您没有权限阅读此特殊消息</li><li>该消息已被删除</li></ul>');
DEFINE ('_UDDEIM_YOUMOVEDTOTRASH', '<b>您已将该消息移除到回收站.</b>');
DEFINE ('_UDDEIM_MESSAGEFROM', '消息来自 ');
DEFINE ('_UDDEIM_MESSAGETO', '消息发送至 ');
DEFINE ('_UDDEIM_REPLY', '回复');
DEFINE ('_UDDEIM_SUBMIT', '发送');
DEFINE ('_UDDEIM_DELETEREPLIED', '回复之后将消息原件移动至回收站');
	// translators info: _UDDEIM_DELETEREPLIED is obsolete in 0.4. You can delete it.
DEFINE ('_UDDEIM_NOID', '错误: 收件人 ID 有误，消息发送失败。');
DEFINE ('_UDDEIM_NOMESSAGE', '错误: 消息正文为空! 消息发送失败.');
DEFINE ('_UDDEIM_MESSAGE_REPLIEDTO', '已发送的回复');
DEFINE ('_UDDEIM_MESSAGE_SENT', '已发送的消息');
DEFINE ('_UDDEIM_MOVEDTOTRASH', '且消息原件已移动至回收站');
DEFINE ('_UDDEIM_NOSUCHUSER', '此会员不存在!');
DEFINE ('_UDDEIM_NOTTOYOURSELF', '您不能给自己发送消息!');
DEFINE ('_UDDEIM_VIOLATION', '<b>访问被拒绝!</b> 您无权执行此项操作。!');
DEFINE ('_UDDEIM_PRUNELINK', '仅限管理员: 清理');

// Admin

DEFINE ('_UDDEADM_SETTINGS', 'uddeIM 管理');
DEFINE ('_UDDEADM_GENERAL', '常规');
DEFINE ('_UDDEADM_ABOUT', '关于');
DEFINE ('_UDDEADM_DATESETTINGS', '日期/时间');
DEFINE ('_UDDEADM_PICSETTINGS', '图标');
DEFINE ('_UDDEADM_DELETEREADAFTER_HEAD', '已读消息保留天数');
DEFINE ('_UDDEADM_DELETEUNREADAFTER_HEAD', '未读消息保留天数');
DEFINE ('_UDDEADM_DELETETRASHAFTER_HEAD', '回收站中的消息保留天数');
DEFINE ('_UDDEADM_DAYS', '天');
DEFINE ('_UDDEADM_DELETEREADAFTER_EXP', '设置已读消息保存时限，超出此时限的 <b>已读</b> 消息将被自动从收件箱中删除。如不想自动删除消息时，请设置为一个较大的数字，(例如 36524 天).。');
DEFINE ('_UDDEADM_DELETEUNREADAFTER_EXP', '设置未读消息保存时限，超出此时限的 <b>未读</b> 消息将被自动删除。');
DEFINE ('_UDDEADM_DELETETRASHAFTER_EXP', '设置回收站消息保存时限，超出此时限的回收站消息就会被彻底删除。此处可设置为小于 1 的数值。例如：如果希望回收站内的消息在进入后3 小时就被彻底删除，请输入 0.125 天.');
DEFINE ('_UDDEADM_DATEFORMAT_HEAD', '日期显示格式');
DEFINE ('_UDDEADM_DATEFORMAT_EXP', '设置消息日期/时间的显示格式。月份名称将根据您的 Joomla! 中的本地语言设定来缩写(如果对应的 uddeIM 语言文件也存在的话).');
DEFINE ('_UDDEADM_LDATEFORMAT_HEAD', '完整日期格式');
DEFINE ('_UDDEADM_LDATEFORMAT_EXP', '在消息显示页面有较大空间可以显示完整日期。设置打开消息时，消息日期的显示格式。星期名称及月份名称将根据 Joomla! 中的本地语言设定来显示(如果对应的 uddeIM 语言文件也存在的话).');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_HEAD', '仅限管理员启用自动删除操作');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_YES', '是, 仅限管理员');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_NO', '否, 任何会员');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_EXP', '自动删除会给服务器和数据库增加较重的负荷。设置为 <b>是, 仅限管理员</b>时，只有当管理员检查自己的信箱时，才能启动网站的自动删除功能（对全部会员消息的操作）。 如果网站管理员每天一次或者多次查看自己的信箱，请设置为<b>是, 仅限管理员</b>。(如果网站有多个管理员，则不管哪个管理员登录都启动自动删除功能。) 如果管理员很少查看自己的信箱，则请选择 <b>否, 任何会员</b>. 如果不明白此功能，或者不知如何操作，请选择 <b>否, 任何会员</b>.');

	// above string changed in 0.4
DEFINE ('_UDDEADM_SAVESETTINGS', '保存设定');
DEFINE ('_UDDEADM_THISHASBEENSAVED', '下列设定已被保存到配置文件:');
DEFINE ('_UDDEADM_SETTINGSSAVED', '设定已保存.');
DEFINE ('_UDDEADM_ICONONLINEPIC_HEAD', '图标: 会员在线');
DEFINE ('_UDDEADM_ICONONLINEPIC_EXP', '设置会员在线时其会员名旁边显示的图标，请输入该图标的位置。');
DEFINE ('_UDDEADM_ICONOFFLINEPIC_HEAD', '图标: 会员离线');
DEFINE ('_UDDEADM_ICONOFFLINEPIC_EXP', '设置会员离线时其会员名旁边显示的图标，请输入该图标的位置。');
DEFINE ('_UDDEADM_ICONREADPIC_HEAD', '图标: 已读消息');
DEFINE ('_UDDEADM_ICONREADPIC_EXP', '设置消息已被阅读时显示的图标，请输入该图标的位置。');
DEFINE ('_UDDEADM_ICONUNREADPIC_HEAD', '图标: 未读消息');
DEFINE ('_UDDEADM_ICONUNREADPIC_EXP', '设置消息未被阅读时显示的图标，请输入该图标的位置。');
DEFINE ('_UDDEADM_MODULENEWMESS_HEAD', '模块: 新消息图标');
DEFINE ('_UDDEADM_MODULENEWMESS_EXP', '此设置是用于设置mod_uddeim_new 模块中收到新消息时显示的图标，请输入该图标的位置。');

// admin import tab

DEFINE ('_UDDEADM_UDDEINSTALL', 'uddeIM 安装');
DEFINE ('_UDDEADM_FINISHED', '安装已完成。欢迎使用 uddeIM . ');
DEFINE ('_UDDEADM_NOCB', '<span style="color: red;">您尚未安装 Community Builder，将无法使用 uddeIM.</span><br /><br />请首先安装 <a href="http://www.mambojoe.com">Community Builder</a>.');
DEFINE ('_UDDEADM_CONTINUE', '继续');
DEFINE ('_UDDEADM_PMSFOUND_1', '您的 myPMS 站内消息系统中共有 ');
DEFINE ('_UDDEADM_PMSFOUND_2', ' 条记录。是否导入这些记录至 uddeIM 中?');
DEFINE ('_UDDEADM_IMPORT_EXP', '此操作不影响 myPMS 消息及该组件自身功能。您可以安全地将它myPMS的所有记录导入 uddeIM。同时，uddeIM 数据库中已有的消息不受影响.');
	// _UDDEADM_IMPORT_EXP above changed in 0.4

DEFINE ('_UDDEADM_IMPORT_YES', '立即从 myPMS 中导入消息到 uddeIM');
DEFINE ('_UDDEADM_IMPORT_NO', ' 不导入任何消息');
DEFINE ('_UDDEADM_IMPORTING', '请稍等，正在导入消息.');
DEFINE ('_UDDEADM_IMPORTDONE', '从 myPMS 中导入消息成功。请不要再次运行此安装程序，避免再次导入消息，从而造成重复消息。');
DEFINE ('_UDDEADM_IMPORT', '导入');
DEFINE ('_UDDEADM_IMPORT_HEADER', '从 myPMS 导入消息');
DEFINE ('_UDDEADM_PMSNOTFOUND', '尚未安装 myPMS，导入失败。');
DEFINE ('_UDDEADM_ALREADYIMPORTED', '<span style="color: red;"> myPMS 中的消息成功导入至 uddeIM .</span>');

// new in 0.3 Frontend
DEFINE ('_UDDEIM_BLOCKS', '被屏蔽');
DEFINE ('_UDDEIM_YOUAREBLOCKED', '消息发送失败 (您在收件人的忽略列表中)');
DEFINE ('_UDDEIM_BLOCKNOW', '忽略此会员');
DEFINE ('_UDDEIM_BLOCKS_EXP', '这是您的忽略列表，列表中的会员将无法给您发送站内消息。');
DEFINE ('_UDDEIM_NOBODYBLOCKED', '您的忽略列表暂时为空.');
DEFINE ('_UDDEIM_YOUBLOCKED_PRE', '您的忽略列表中目前包含 ');
DEFINE ('_UDDEIM_YOUBLOCKED_POST', ' 名会员.');
DEFINE ('_UDDEIM_UNBLOCKNOW', '[从忽略列表中删除]');
DEFINE ('_UDDEIM_BLOCKALERT_EXP_ON', '如果忽略列表中的会员试图给您发送站内消息，将被告知消息发送失败，同时通知他已经在您的忽略。');
DEFINE ('_UDDEIM_BLOCKALERT_EXP_OFF', '忽略列表中的会员将不会收到已在忽略列表的通知.');
DEFINE ('_UDDEIM_CANTBLOCKADMINS', '忽略列表中将不能包含管理员.');

// new in 0.3 Admin
DEFINE ('_UDDEADM_BLOCKSYSTEM_HEAD', '启用忽略列表功能');
DEFINE ('_UDDEADM_BLOCKSYSTEM_EXP', '启用此功能时，会员可设置自己的忽略列表。列表中的会员无法发送消息给列表设置者。管理员永远不会被屏蔽。');
DEFINE ('_UDDEADM_BLOCKSYSTEM_YES', '是');
DEFINE ('_UDDEADM_BLOCKSYSTEM_NO', '否');
DEFINE ('_UDDEADM_BLOCKALERT_HEAD', '通知忽略列表中的会员');
DEFINE ('_UDDEADM_BLOCKALERT_EXP', '设置为 <b>是</b>时, 当忽略列表中的会员发送消息失败时，系统将通知他已在收件人的忽略列表中。设置为 <b>否</b>时, 当忽略列表中的会员发送消息失败时，将不会收到任何通知.');
DEFINE ('_UDDEADM_BLOCKALERT_YES', '是');
DEFINE ('_UDDEADM_BLOCKALERT_NO', '否');
DEFINE ('_UDDEIM_BLOCKSDISABLED', '忽略列表尚未启用');
// DEFINE ('_UDDEADM_DELETIONS', '站内消息');
	// translators info: comment out or delete line above to avoid double definition.
	// new definition right below.
DEFINE ('_UDDEADM_DELETIONS', '删除'); // changed in 0.4
DEFINE ('_UDDEADM_BLOCK', '忽略列表');

// new in 0.4, admin
DEFINE ('_UDDEADM_INTEGRATION', '整合');
DEFINE ('_UDDEADM_EMAIL', 'E-mail');
DEFINE ('_UDDEADM_SHOWCBLINK_HEAD', '显示 CB 链接');
DEFINE ('_UDDEADM_SHOWCBLINK_EXP', '设置为 <b>是</b>时, 所有在 uddeIM 中显示的会员名都将链接至该会员的 Community Builder 资料页面.');
DEFINE ('_UDDEADM_SHOWCBPIC_HEAD', '显示 CB 头像');
DEFINE ('_UDDEADM_SHOWCBPIC_EXP', '设置为 <b>是</b>时,发件人的头像（如果该会员已在 Community Builder 的个人资料中添加了头像）显示在消息阅读页面。');
DEFINE ('_UDDEADM_SHOWONLINE_HEAD', '显示在线状态');
DEFINE ('_UDDEADM_SHOWONLINE_EXP', '设置为 <b>是</b>时, uddeIM 中显示的会员会员名旁将显示标示会员在线状态的小图标。图标图像可在图标管理页面中设置。');
DEFINE ('_UDDEADM_ALLOWEMAILNOTIFY_HEAD', '启用 E-mail通知');
DEFINE ('_UDDEADM_ALLOWEMAILNOTIFY_EXP', '设置为 <b>是</b>时, 会员可以选择收到新的站内消息时，系统是否自动发送通知 E-mail。');
DEFINE ('_UDDEADM_EMAILWITHMESSAGE_HEAD', '通知E-mail中包含消息内容');
DEFINE ('_UDDEADM_EMAILWITHMESSAGE_EXP', '设置为 <b>否</b>时,E-mail中仅显示消息发送时间和发件人信息，但不展示消息的内容。');
DEFINE ('_UDDEADM_LONGWAITINGEMAIL_HEAD', '未读提醒E-mail');
DEFINE ('_UDDEADM_LONGWAITINGEMAIL_EXP', '无论会员自己如何设定，本功能负责在会员过了相当长一段时间（时间可以在下面指定）之后还有未读消息在收件箱时，就发送 E-mail给该会员进行提醒。 此选项不受上面的 \'允许 E-mail通知\' 设定影响。如果您不想发送任何 E-mail通知, 您就必须将这两项都关闭。');
DEFINE ('_UDDEADM_LONGWAITINGDAYS_HEAD', '未读提醒发送时限');
DEFINE ('_UDDEADM_LONGWAITINGDAYS_EXP', '未读提醒功能启用时，请设置此处的发送天数。消息保持未读状态超出此时限时，系统将自动发送未读消息提醒E-mail。');
DEFINE ('_UDDEADM_FIRSTWORDSINBOX_HEAD', '消息摘要字符限额');
DEFINE ('_UDDEADM_FIRSTWORDSINBOX_EXP', '收件箱、发件箱及回收站显示页面中，消息列表显示的内容摘要字符数');
DEFINE ('_UDDEADM_MAXLENGTH_HEAD', '消息内容字符限额');
DEFINE ('_UDDEADM_MAXLENGTH_EXP', '设置消息正文可输入的最大字符数。超过长度的字符将被自动删除。设置为“0”时将不限制字符长度（不推荐）.');
DEFINE ('_UDDEADM_YES', '是');
DEFINE ('_UDDEADM_NO', '否');
DEFINE ('_UDDEADM_ADMINSONLY', '仅限管理员');
DEFINE ('_UDDEADM_SYSTEM', '系统');
DEFINE ('_UDDEADM_SYSM_USERNAME_HEAD', '系统消息发件人名称');
DEFINE ('_UDDEADM_SYSM_USERNAME_EXP', '设置系统消息的发件人名称。系统消息无特定发件人，所有收到消息的会员无法回复系统消息。在此设置系统消息发件人名称，(例如 <b>网站管理团队</b> 或者 <b>会员服务团队</b> 或者 <b>社区运营团队</b>)');
DEFINE ('_UDDEADM_ALLOWTOALL_HEAD', '允许管理员发送群发消息');
DEFINE ('_UDDEADM_ALLOWTOALL_EXP', '设置是否允许管理员发送群发消息。这些消息将被发送至网站上的所有注册会员。');
DEFINE ('_UDDEADM_EMN_SENDERNAME_HEAD', 'E-mail通知 发件人名称');
DEFINE ('_UDDEADM_EMN_SENDERNAME_EXP', '设置E-mail通知的发件人名称 (例如 <b>您的网站名称</b>)');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_HEAD', 'E-mail通知 发件人地址');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_EXP', '设置E-mail通知的发件人E-mail地址。(应该是您网站的管理员联系信箱.');
DEFINE ('_UDDEADM_VERSION', 'uddeIM 版本');
DEFINE ('_UDDEADM_ARCHIVE', '存档文件夹'); // translators info: headline for Archive system
DEFINE ('_UDDEADM_ALLOWARCHIVE_HEAD', '启用存档文件夹');
DEFINE ('_UDDEADM_ALLOWARCHIVE_EXP', '设置是否允许会员将消息存储至存档文件夹. 存档文件夹中的消息将不会被自动删除。');
DEFINE ('_UDDEADM_MAXARCHIVE_HEAD', '会员存档文件夹消息限额');
DEFINE ('_UDDEADM_MAXARCHIVE_EXP', '设置每个会员的存档文件夹中允许保留的最大消息条数(管理员不受限制).');
DEFINE ('_UDDEADM_COPYTOME_HEAD', '允许保存副本');
DEFINE ('_UDDEADM_COPYTOME_EXP', '允许会员将已发送消息保存副本至自己的收件箱中。');
DEFINE ('_UDDEADM_MESSAGES', '站内消息');
DEFINE ('_UDDEADM_TRASHORIGINAL_HEAD', '回复时删除消息原件');
DEFINE ('_UDDEADM_TRASHORIGINAL_EXP', '启用此功能时将在回复消息时的“发送”按钮旁边显示“删除消息原件”选项并默认选中。在此情况下，回复内容发送时将自动从收件箱中删除消息原件至回收站。此功能有助于减少数据库中记录的消息数量。如果会员希望在收件箱中保留消息原件，可以在发送前取消上述选项。');
	// translators info: 'Send' is the same as _UDDEIM_SUBMIT,
	// and 'trash original' the same as _UDDEIM_TRASHORIGINAL

DEFINE ('_UDDEADM_PERPAGE_HEAD', '每页显示消息条数');
DEFINE ('_UDDEADM_PERPAGE_EXP', '设置在收件箱、发件箱、回收站及存档文件夹页面上每页显示的站内消息条数');
DEFINE ('_UDDEADM_CHARSET_HEAD', '网站语言编码');
DEFINE ('_UDDEADM_CHARSET_EXP', '当使用非拉丁语系字符遇到问题时，请输入前台显示的字符编码。uddeIM 将把从数据库中读取的数据转换为此字符编码并输出至前台页面。 <b>注意：如果不清楚合适的字符编码时，请勿更改默认值!</b>');
DEFINE ('_UDDEADM_MAILCHARSET_HEAD', 'E-mail语言编码');
DEFINE ('_UDDEADM_MAILCHARSET_EXP', '当使用非拉丁语系字符遇到问题时请设置特定的字符编码，uddeIM 将使用该字符编码来发送寄往站外所有E-mail。<b>注意：如果不清楚合适的字符编码时，请勿更改默认值!</b>');
		// translators info: if you're translating into a language that uses a latin charset
		// (like English, Dutch, German, Swedish, Spanish, ... ) you might want to add a line
		// saying 'For usage in [mylanguage] the default value is correct.'

DEFINE ('_UDDEADM_EMN_BODY_NOMESSAGE_EXP', 'E-mail内容如下，当启用此功能时会员将收到此邮件。此E-mail内不包含站内消息内容，请勿更改 %you%, %user% 和 %site% 这些变量. ');
DEFINE ('_UDDEADM_EMN_BODY_WITHMESSAGE_EXP', 'E-mail内容如下，启用此功能时会员将收到此邮件。 此E-mail内不包含站内消息内容，请勿更改  %you%, %user%, %pmessage% 和 %site% 这些变量. ');
DEFINE ('_UDDEADM_EMN_FORGETMENOT_EXP', '未读提醒 E-mail内容如下。当启用未读提醒功能时，会员将收到此邮件，请勿更改 %you% 和 %site% 这些变量. ');
DEFINE ('_UDDEADM_ENABLEDOWNLOAD_EXP', '允许会员从存档文件夹中导出自己的消息（通过E-mail发送所有消息至会员）.');
DEFINE ('_UDDEADM_ENABLEDOWNLOAD_HEAD', '允许导出消息');
DEFINE ('_UDDEADM_EXPORT_FORMAT_EXP', '当会员从存档文件夹导出所有消息时，会收到一封包含所有消息的E-mail。该 E-mail的格式如下，请勿更改 %user%, %msgdate% 和 %msgbody% 这些变量. ');
		// translators info: Don't translate %you%, %user%, etc. in the strings above.

DEFINE ('_UDDEADM_INBOXLIMIT_HEAD', '设置收件箱限额');
DEFINE ('_UDDEADM_INBOXLIMIT_EXP', '设置存档消息的最大限额中包含收件箱中的消息数时，收件箱中的消息数量与存档文件夹中的消息数量之和不能超过存档消息的最大限额。单独设置收件箱的限额时，收件箱的存储限额将与存档文件夹无关。会员收件箱中的消息数量决定于收件箱限额。超过此限额时，会员可以继续接收并阅读消息，但将无法回复和新建消息。如需回复和新建消息，则需要清理收件箱或者存档文件夹中的消息。');
DEFINE ('_UDDEADM_SHOWINBOXLIMIT_HEAD', '在收件箱显示限额使用情况');
DEFINE ('_UDDEADM_SHOWINBOXLIMIT_EXP', '在收件箱底部显示会员已保存消息的数目，并同时显示会员能存储的最大数目.');

DEFINE ('_UDDEADM_ARCHIVETOTRASH_INTRO', '存档文件夹已关闭. 请选择如何处理储存在存档文件夹中的消息？');

DEFINE ('_UDDEADM_ARCHIVETOTRASH_LEAVE_LINK', '保存消息');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_LEAVE_EXP', '继续保留消息在存档文档夹中 (会员将无法访问已关闭存档文件夹中的消息，并且这些消息仍然占用消息限额).');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_LINK', '移动至收件箱');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_DONE', '所有存档消息已移动至收件箱');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_EXP', '所有存档消息将移动至会员的收件箱。(如果消息日期超过了系统设置的有效期，将会被直接删除至回收站).');


// 0.4 frontend, admins only (no translation necessary)
DEFINE ('_UDDEIM_VALIDFOR_1', '站内消息有效期： ');
DEFINE ('_UDDEIM_VALIDFOR_2', ' 小时. 0=永远 (自动删除有效)');
DEFINE ('_UDDEIM_WRITE_SYSM_GM', '[创建系统消息或群发消息]');
DEFINE ('_UDDEIM_WRITE_NORMAL', '[创建普通 (标准) 消息]');
DEFINE ('_UDDEIM_NOTALLOWED_SYSM_GM', '禁止发送群发消息及系统消息');
DEFINE ('_UDDEIM_SYSGM_TYPE', '消息类型');
DEFINE ('_UDDEIM_HELPON_SYSGM', '关于系统消息的帮助');
DEFINE ('_UDDEIM_HELPON_SYSGM_2', '(在新窗口中打开)');

DEFINE ('_UDDEIM_SYSGM_PLEASECONFIRM', '您将要发送下面显示的消息. 请仔细检查并确认消息内容!');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALL', '发送至 <strong>所有会员</strong> 的消息');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLADMINS', '发送至 <strong>全部管理员</strong> 的消息');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLLOGGED', '发送至  <strong>所有当前在线会员</strong> 的消息');
DEFINE ('_UDDEIM_SYSGM_WILLDISABLEREPLY', '收件人将不能回复此消息.');
DEFINE ('_UDDEIM_SYSGM_WILLSENDAS_1', '消息将以 <strong>');
DEFINE ('_UDDEIM_SYSGM_WILLSENDAS_2', '</strong> 作为发件人发送');

DEFINE ('_UDDEIM_SYSGM_WILLEXPIRE', '消息有效期至 ');
DEFINE ('_UDDEIM_SYSGM_WILLNOTEXPIRE', '消息永不过期');
DEFINE ('_UDDEIM_SYSGM_CHECKLINK', '在发送消息前请检查 <b>链接</b>(通过点击该链接) !');
DEFINE ('_UDDEIM_SYSGM_SHORTHELP', '下列 BB 代码 <strong>仅用于系统消息</strong>:<br /> [b]<strong>粗体</strong>[/b] [i]<em>斜体</em>[/i]<br />链接可写为
[url=http://www.someurl.com]some url[/url] 或者 [url]http://www.someurl.com[/url] ');
DEFINE ('_UDDEIM_SYSGM_ERRORNORECIPS', '错误: 收件人有误，消息发送失败.');


// 0.4 frontend (all users, translation needed)
DEFINE ('_UDDEIM_CANTREPLY', '您无法回复此消息.');
DEFINE ('_UDDEIM_EMNOFF', 'E-mail通知已关闭. ');
DEFINE ('_UDDEIM_EMNON', 'E-mail通知已启用. ');
DEFINE ('_UDDEIM_SETEMNON', '[启用]');
DEFINE ('_UDDEIM_SETEMNOFF', '[关闭]');
DEFINE ('_UDDEIM_EMN_BODY_NOMESSAGE', '您好 %you%,

在 %site% 网站，会员 %user% 给您发送了站内消息。请登录此网站阅读消息!');
DEFINE ('_UDDEIM_EMN_BODY_WITHMESSAGE', '您好 %you%,

在 %site% 网站，会员 %user% 给您发送了新的站内消息。内容如下：
__________________
%pmessage%

	请登录此网站回复消息!
');
DEFINE ('_UDDEIM_EMN_FORGETMENOT', '您好 %you%,

在 %site% 网站，您收到了新的站内消息.
请登录此网站阅读此消息!
');
DEFINE ('_UDDEIM_EXPORT_FORMAT', '
================================================================================
%user% (%msgdate%)
----------------------------------------
%msgbody%
================================================================================');
DEFINE ('_UDDEIM_EMN_SUBJECT', '在 %site% 网站，您收到了新的站内消息');
DEFINE ('_UDDEIM_SEND_ASSYSM', '作为系统消息发送 (收件人无法回复系统消息)');
DEFINE ('_UDDEIM_SEND_TOALL', '发送至全部会员');
DEFINE ('_UDDEIM_SEND_TOALLADMINS', '发送至全部管理员');
DEFINE ('_UDDEIM_SEND_TOALLLOGGED', '发送至全部在线会员');



DEFINE ('_UDDEIM_UNEXPECTEDERROR_QUIT', '意外错误: ');
DEFINE ('_UDDEIM_ARCHIVENOTENABLED', '存档未启用.');
DEFINE ('_UDDEIM_ARCHIVE_ERROR', '无法将此消息存储至存档文件夹.');
DEFINE ('_UDDEIM_ARC_SAVED_1', '您已存储了 ');
DEFINE ('_UDDEIM_ARC_SAVED_NONE', '<strong>存档文件夹中尚未存储任何消息.</strong>');
DEFINE ('_UDDEIM_ARC_SAVED_2', ' 封消息');
DEFINE ('_UDDEIM_ARC_SAVED_ONE', '您已存储了一封消息');
DEFINE ('_UDDEIM_ARC_SAVED_3', '存档文件夹已满，存储新消息前请清理该文件夹。');
DEFINE ('_UDDEIM_ARC_CANSAVEMAX_1', '您最多可以存储 ');
DEFINE ('_UDDEIM_ARC_CANSAVEMAX_2', ' 条消息.');
DEFINE ('_UDDEIM_INBOX_LIMIT_1', '您已存储 ');
DEFINE ('_UDDEIM_INBOX_LIMIT_2', ' 条消息在');
DEFINE ('_UDDEIM_ARC_UNIVERSE_ARC', '存档文件夹');
DEFINE ('_UDDEIM_ARC_UNIVERSE_INBOX', '收件箱');
DEFINE ('_UDDEIM_ARC_UNIVERSE_BOTH', '收件箱和存档文件夹');
DEFINE ('_UDDEIM_INBOX_LIMIT_3', '系统最多允许');
DEFINE ('_UDDEIM_INBOX_LIMIT_4', '您可以继续接收和阅读消息，但无法回复或者新建消息。新建消息和回复消息前请删除部分已存储消息.');
DEFINE ('_UDDEIM_SHOWINBOXLIMIT_1', '已存储的消息： ');
DEFINE ('_UDDEIM_SHOWINBOXLIMIT_2', '(最多： ');

DEFINE ('_UDDEIM_MESSAGE_ARCHIVED', '存档中的消息.');
DEFINE ('_UDDEIM_STORE', '存档');
		// translators info: as in: 'store this message in archive now'

DEFINE ('_UDDEIM_BACK', '返回');

DEFINE ('_UDDEIM_TRASHCHECKED', '删除选中消息');
	// translators info: plural!

DEFINE ('_UDDEIM_SHOWALL', '显示全部消息');
	// translators example "SHOW ALL messages"

DEFINE ('_UDDEIM_ARCHIVE', '存档');
	// should be same as _UDDEADM_ARCHIVE

DEFINE ('_UDDEIM_ARCHIVEFULL', '存档已满，保存失败.');

DEFINE ('_UDDEIM_NOMSGSELECTED', '请选择需要发送的消息');
DEFINE ('_UDDEIM_THISISACOPY', '使用E-mail发送消息副本至： ');
DEFINE ('_UDDEIM_SENDCOPYTOME', '使用E-mail发送消息副本至本人');
DEFINE ('_UDDEIM_SENDCOPYTOARCHIVE', '创建副本并存档');
DEFINE ('_UDDEIM_TRASHORIGINAL', '删除消息原件');

DEFINE ('_UDDEIM_MESSAGEDOWNLOAD', '导出消息');
DEFINE ('_UDDEIM_EXPORT_MAILED', '包含所有消息内容的的 E-mail发送成功.');
DEFINE ('_UDDEIM_EXPORT_NOW', '通过 E-mail将选中的消息发送至邮箱.');
DEFINE ('_UDDEIM_EXPORT_MAIL_INTRO', '此 E-mail中包含您的站内消息.');
DEFINE ('_UDDEIM_EXPORT_COULDNOTSEND', '含有站内信消息的E-mail发送失败.');

DEFINE ('_UDDEIM_LIMITREACHED', '草稿箱已满，存储失败.');

DEFINE ('_UDDEIM_WRITEMSGTO', '新建消息 ');

$udde_smon[1]="1";
$udde_smon[2]="2";
$udde_smon[3]="3";
$udde_smon[4]="4";
$udde_smon[5]="5";
$udde_smon[6]="6";
$udde_smon[7]="7";
$udde_smon[8]="8";
$udde_smon[9]="9";
$udde_smon[10]="10";
$udde_smon[11]="11";
$udde_smon[12]="12";

$udde_lmon[1]="一月";
$udde_lmon[2]="二月";
$udde_lmon[3]="三月";
$udde_lmon[4]="四月";
$udde_lmon[5]="五月";
$udde_lmon[6]="六月";
$udde_lmon[7]="七月";
$udde_lmon[8]="八月";
$udde_lmon[9]="九月";
$udde_lmon[10]="十月";
$udde_lmon[11]="十一月";
$udde_lmon[12]="十二月";

$udde_lweekday[0]="星期日";
$udde_lweekday[1]="星期一";
$udde_lweekday[2]="星期二";
$udde_lweekday[3]="星期三";
$udde_lweekday[4]="星期四";
$udde_lweekday[5]="星期五";
$udde_lweekday[6]="星期六";

$udde_sweekday[0]="日";
$udde_sweekday[1]="一";
$udde_sweekday[2]="二";
$udde_sweekday[3]="三";
$udde_sweekday[4]="四";
$udde_sweekday[5]="五";
$udde_sweekday[6]="六";

// new in 0.5 ADMIN

// Translators observe: Search for _UDDEIM_SYSGM_SHORTHELP (above)
// and change this text so that it no longer contains
// information abouth the [newurl] code. [newurl] is no
// longer supported by this version of uddeIM.

DEFINE ('_UDDEADM_TEMPLATEDIR_HEAD', 'uddeIM 模板');
DEFINE ('_UDDEADM_TEMPLATEDIR_EXP', '设置使用的 uddeIM 模板');
DEFINE ('_UDDEADM_SHOWCONNEX_HEAD', '显示 CB 好友');
DEFINE ('_UDDEADM_SHOWCONNEX_EXP', '如果已安装了 Community Builder 且需要在消息撰写页面上显示好友名单，请设置为 <b>是</b>.');
DEFINE ('_UDDEADM_SHOWSETTINGSLINK_HEAD', '显示个人设置');
DEFINE ('_UDDEADM_SHOWSETTINGSLINK_EXP', '当启用 E-mail通知或忽略列表功能，将在会员的 uddeIM 界面显示“个人设置”链接。如需关闭此功能，请设置为否。');
DEFINE ('_UDDEADM_SHOWSETTINGS_ATBOTTOM', '是, 在底部显示');
DEFINE ('_UDDEADM_ALLOWBB_HEAD', '允许 BB 代码');
DEFINE ('_UDDEADM_FONTFORMATONLY', '仅限字体格式');
DEFINE ('_UDDEADM_ALLOWBB_EXP', '设置为 <b>仅限字体格式</b>时，将允许会员使用 BB 代码来实现粗体、斜体、下划线、文字颜色及文字大小等文字效果。 设置为 <b>是</b>时,将允许会员使用 <strong>全部</strong> 支持的 BB 代码。.');
DEFINE ('_UDDEADM_ALLOWSMILE_HEAD', '启用表情');
DEFINE ('_UDDEADM_ALLOWSMILE_EXP', '设置为 <b>是</b>时, 站内消息中的表情代码( 如 :-) ) 将会被表情图标替代。请参看 readme 文件了解本组件支持的所有字符表情。');
DEFINE ('_UDDEADM_DISPLAY', '显示');
DEFINE ('_UDDEADM_SHOWMENUICONS_HEAD', '显示菜单图标');
DEFINE ('_UDDEADM_SHOWMENUICONS_EXP', '设置为 <b>是</b>时，将在菜单及操作链接旁显示相关图标。');
DEFINE ('_UDDEADM_SHOWTITLE_HEAD', '组件标题');
DEFINE ('_UDDEADM_SHOWTITLE_EXP', '自定义uddeIM组件的标题，例如：“站内消息”. 留空时，将使用默认标题。');
DEFINE ('_UDDEADM_SHOWABOUT_HEAD', '"关于"链接');
DEFINE ('_UDDEADM_SHOWABOUT_EXP', '设置为是否显示一个指向 uddeIM 软件开发小组和相关许可的链接，此链接将放置在所有 uddeIM 页面的底部.');
DEFINE ('_UDDEADM_STOPALLEMAIL_HEAD', '停止发送 E-mail');
DEFINE ('_UDDEADM_STOPALLEMAIL_EXP', '启用此功能将停止 uddeIM 向外发送 E-mail(新消息通知及未读消息提醒 E-mail)。此处设置优先级高于会员设置，例如测试网站时. 需要关闭E-mail发送功能时设置此选项为 <b>否</b>.');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_MANUALLY', '手动');
DEFINE ('_UDDEADM_GETPICLINK_HEAD', '显示会员 CB 头像');
DEFINE ('_UDDEADM_GETPICLINK_EXP', '设置是否在收件箱、发件箱中消息列表页面显示发件人或者收件人的 CB 头像，如需显示请设置为 <b>是</b>。');

// new in 0.5 FRONTEND

DEFINE ('_UDDEIM_SHOWUSERS', '显示全部会员');
DEFINE ('_UDDEIM_CONNECTIONS', '好友');
DEFINE ('_UDDEIM_SETTINGS', '个人设定');
DEFINE ('_UDDEIM_NOSETTINGS', '没有设定需要调整。');
DEFINE ('_UDDEIM_ABOUT', '关于'); // as in "About uddeIM"
DEFINE ('_UDDEIM_COMPOSE', '新建消息'); // as in "write new message", but only one word
DEFINE ('_UDDEIM_EMN', 'E-mail通知');
DEFINE ('_UDDEIM_EMN_EXP', '当您收到短消息时，系统将发送一封e-mail通知您。');
DEFINE ('_UDDEIM_EMN_ALWAYS', '收到新消息时发送 E-mail通知');
DEFINE ('_UDDEIM_EMN_NONE', '不发送 E-mail通知');
DEFINE ('_UDDEIM_EMN_WHENOFFLINE', '离线时发送 E-mail通知');
DEFINE ('_UDDEIM_EMN_NOTONREPLY', '收到回复时不发送通知');
DEFINE ('_UDDEIM_BLOCKSYSTEM', '忽略列表'); // Headline for blocking system in settings
DEFINE ('_UDDEIM_BLOCKSYSTEM_EXP', '您可以通过阻止会员来防止他们给您发送站内消息。在阅读消息时选择 <b>阻止会员</b>时，将自动将发件人加入至忽略列表中.'); // block user is the same as _UDDEIM_BLOCKNOW
DEFINE ('_UDDEIM_SAVECHANGE', '保存更改');
DEFINE ('_UDDEIM_TOOLTIP_BOLD', '生成粗体字符的 BB 代码。用法： [b]粗体[/b]');
DEFINE ('_UDDEIM_TOOLTIP_ITALIC', '生成斜体字符的 BB 代码。用法： [i]斜体[/i]');
DEFINE ('_UDDEIM_TOOLTIP_UNDERLINE', '生成下划线字符的 BB 代码。用法： [u]下划线[/u]');
DEFINE ('_UDDEIM_TOOLTIP_COLORRED', '生成红色字符的 BB 代码。用法： [color=#XXXXXX]colored[/color] 其中 XXXXXX 为16进制颜色代码。 FF0000 代表红色。');
DEFINE ('_UDDEIM_TOOLTIP_COLORGREEN', '生成绿色字符的 BB 代码。用法： [color=#XXXXXX]colored[/color] 其中 XXXXXX 为16进制颜色代码。00FF00 代表绿色.');
DEFINE ('_UDDEIM_TOOLTIP_COLORBLUE', '生成蓝色字符的 BB 代码。用法： [color=#XXXXXX]colored[/color] 其中 XXXXXX 为16进制颜色代码。0000FF 代表蓝色。');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE1', '生成较小字符的 BB 代码。用法： [size=1]较小字符.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE2', '生成小号字符的 BB 代码。用法： [size=2] 小号字符.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE4', '生成中号字符的 BB 代码。用法： [size=4]中号字符.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE5', '生成大字体字符的 BB 代码。用法： [size=5]大字体字符.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_IMAGE', '插入图片链接的 BB 代码标记。用法: [img]图片 URL[/img]');
DEFINE ('_UDDEIM_TOOLTIP_URL', '插入超级链接的 BB 代表标记. 用法: [url]网址[/url].请注意:网址请以 http:// 开始。');
DEFINE ('_UDDEIM_TOOLTIP_CLOSEALLTAGS', '关闭所有开放的 BB 代码.');
DEFINE ('_UDDEIM_INBOX_LIMIT_2_SINGULAR', ' 消息存放在您的'); // same as _UDDEIM_INBOX_LIMIT_2, but singular (as in 1 "message in your")
DEFINE ('_UDDEIM_ARC_SAVED_NONE_2', '<strong>您没有存档消息。</strong>');

// reserved by baijianpeng
DEFINE ('_UDDEADM_ABOUTTEXT', '
<strong>udde 站内消息组件 (uddeIM)</strong><br />
为 Mambo 4.5.X/Joomla 1.0.X/Joomla 1.5 开发的即时消息系统<br />
作者:         Benjamin Zweifel<br />
语言文件:     simplified_chinese.php<br />
版权:         Benjamin Zweifel<br />
这是一款免费软件，您可以基于 GPL 许可分发它。uddeIM+ 软件本身不承诺任何担保。
	欲知详情，请参看许可全文：
 <a href="http://www.gnu.org/licenses/gpl.txt">www.gnu.org/licenses/gpl.txt</a>.
');
?>