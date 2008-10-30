<?php
/**
 * Joom!Fish - multilingual extention and translation manager for Joomla!
 * Copyright (C) 2003-2006 Think Network GmbH, Munich
 * 
 * All rights reserved.  The Joom!Fish project is a set of extentions for 
 * the content management system Joomla!. It enables Joomla! 
 * to manage multilingual sites especially in all dynamic information 
 * which are stored in the database.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307,USA.
 *
 * The "GNU Lesser General Public License" (LGPL) is available at
 * http: *www.gnu.org/copyleft/lgpl.html
 * -----------------------------------------------------------------------------
 * $Id: ReadMe,v 1.2 2005/03/15 11:07:01 akede Exp $
 *
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class HTML_joomfish_help {

	function showWelcome() {
		global $act, $task, $option, $mosConfig_live_site, $mosConfig_absolute_path;
		HTML_joomfish::_JoomlaHeader( _JOOMFISH_TITLE. ' '._JOOMFISH_CREDITS, 'credits', false );
    ?>
	<tr align="center" valign="middle">
      <td align="left" valign="top" width="70%">
		<p>
      	<span class="moduleheading">欢迎使用 Joom!Fish</span></p>
      	
        <strong>Joom!Fish - 翻译? 多国语言内容管理 - 您到底在胡捻些什么? 这是什么玩意儿"鱼"?</strong>
		<p>Ok, 有一件事可以肯定! <b>这不是属于自动化的翻译工具, 像是外面一些公司所提供的!</b> 他们只是借用这个名词!</p>
		<p>但是你总听过 Ford Perfect , 是吧?<br />
		<strong>不会吧!</strong><br />
		&nbsp;<br />
		呜, 你嘛帮帮忙 - 人生真的是有这样困难吗?<br />
		说真的 ... - 没错! <br />
		&nbsp;<br />
		<strong>但是现在呢? ...</strong><br />
		你最好可以这样做: <a href="http://www.amazon.de/exec/obidos/ASIN/0345391802/thinknetwork-21" target="_blank">来这里看看</a> - 多看看书吧! 了解嘛!<br />
		&nbsp;<br />
		动作要快, 要不然通往银河的路都做好那就太迟了 ;-)</p>
		<p>
		<strong>对, 这是当然!</strong><br />
		聪明, 您在宇宙尽头的餐厅预约的位置已经订好了.<br />
		你想要 <a href="index2.php?option=com_joomfish&act=dinnermenu">看看菜单吗</a>?<br />
		&nbsp;<br />
		我很荣幸的能在这里为您服务.<br>
		
		<p>
		<span class="moduleheading">特别说明</span><br />
		如果有人还搞不懂我到底在说些什么. 你还真的需要去多看些书!<br />
		<br />
		我在这里要感谢所有 MambelFish 以及 Joom!Fish 的开发团队, 你们针对 Joomla! 所开发的工具具有的重大意义. <br />
		请不要客气. 欢迎你们的意见与建议, 来让这条"鱼"变得更好
		</p>
		<p>
		感谢 Joom!Fish 的研发团队, 所有的参予者以及 Tommy 设计这么可爱地"鱼".
		&nbsp;<br />
		Alex</p>
		</p>
		</td>
		<td align="left" valign="top" nowrap>
			<?php HTML_joomfish::_sideMenu();?>
			<?php HTML_joomfish::_creditsCopyright(); ?>
		</td>
	<?php
		HTML_joomfish::_footer($act, $option);
  }		
	
	
	function showDinnermenu() {
		global $act, $task, $option, $mosConfig_live_site;
		HTML_joomfish::_JoomlaHeader( _JOOMFISH_TITLE. ' ' ._JOOMFISH_ADMIN_HELP, 'support', false );
    ?>
	<tr align="center" valign="middle">
      <td align="left" valign="top" width="70%">
		<h2>我们该从何着手?</h2>
	   <p>您曾经扪心自问若是不使用 Joomla 的架构. 要如何制作多国语言的网站? 使用 Joom!Fish 就是这个问题的答案. <br />
		&nbsp;<br />
		Joom!Fish 元件能够支援您进行管理您网站中所有内容的翻译, 甚至是所有的元件以及模组. 这项元件是相当灵活的. <br />
		您可以轻易地加入新的元件之后来翻译新产生的内容.<br />
		&nbsp;</p>
		
		<h2>我们要如何了解内容?</h2>
		<p>当我们谈论到内容, 我所意指的是在于 Joomla 伺服器中所提供存取资料库中所储存的任何内容物或是其他资讯. <br />
			有每些文字资讯, 像是一些连结文字, 存放于系统中的广泛地语言档案. 这些档案可以让你在网站中轻易地变换 <br />
			不同的语言文字. 但是网站中您所发布的新闻讯息, 文章或者是其他的内容资料都只是属于单一的语言, Joom!Fish <br />
			是能够协助您翻译这些内容的解决方案 ;-) 以便于您的网站中能够真正支援多国语系. 每项动态内容我们这里先 <br />
			称为元件元素<br />
		&nbsp;</p>

		<h2>这个元件对您有什么帮助?</h2>
		我们当初没有想要制作翻译机器或者其他电脑为主的翻译方式. 目标在于翻译的处理过程, 您将会有更庞大的数 <br />
		据资料库. 在您建立新的内容资料的同时, 也必须要有人进行翻译的工作.<br />
		&nbsp;<br />
		而使用 Joom!Fish 的人也能够检查所有的内容中有哪些项目还没有被进行翻译, 观看近期改变的项目或管理所翻 <br />
		译支援的语系. 翻译内容的人在所能修改翻译的内容项目可以根据他/她所诠释更好的表达文字.</p>

		<h2>要如何运作它?</h2>
		<p>相当地简易. 在元件选单中您可以找到 <a href="index2.php?option=com_joomfish&act=config_component">"元件偏好设定"</a> 来变更显示的一般设定. 这些是属于通盘性的执行要件. <br />
		在此设定中主要是让您定义您的网站中提供哪些国家的语言翻译. 您可以从清单中选择.</p>

		<p>而紧接下来的部份就较为困难了. 您必须从资料库中不同的内容元素目录各别去定义各个内容资料, 这就是我们 <br />
			 不打算在管理区去执行这项设定的原因. 您可以进到管理区的 <a href="index2.php?option=com_joomfish&act=config_elements">"内容元素"</a> 来检视所有安装内容元素的定义. 这些 <br />
			 内容元素定义的 XML 档案都存放在 /administraton/components/com_joomfish/contentelements/ 目录夹当中. <br />
			 <br />
			 如果您想要自行去增加新的内容元素或者修改现有的 XML 档案当中的内容, 我想这应该不难去定义. 主要就在于 <br />
			 您自己, 从 XML 档案中去找寻可行的正确指引栏位 ;-) <br />
		&nbsp;<br />
			 如果您新增一项新的 XML 档案来针对尚未执行的元件/模组, 请确定您同样地也编辑元件/模组的PHP档案.</p>
		
		<p>关于翻译内容, 您必需透过 <a href="index2.php?option=com_joomfish&act=translate">"内容翻译"</a> 单元. 您可以找到关于资料库中所指定的内容元素列表. 选取特定的内容 <br />
			 元素之后您就可以检视资料库的内容物而轻易地进行翻译.</p>
		 <p>概略的说明到此, 如果有什么新的看法与问题 - 再写信给我<br>
	   &nbsp;<br />
	   Alex</p>		</td>
		<td align="left" valign="top" nowrap>
			<?php HTML_joomfish::_sideMenu();?>
			<?php HTML_joomfish::_creditsCopyright(); ?>
		</td>
	</tr>

<?php
		HTML_joomfish::_footer($act, $option);
  }

  function showMambotWarning(){
		global $act, $task, $option, $mosConfig_live_site, $mosConfig_absolute_path, $_VERSION;
		HTML_joomfish::_header();
		?>
     <td align="left" valign="top">
       <h2 style="color:red">There was a problem with your installation</h2>
       <p>目录 "<?php echo $mosConfig_absolute_path?>/mambots/system/" 无法进行写入</p>
       <p>请执行以下动作:</p>
       <ul>
       <li>移除 Joomfish</li>
       <li>修改档案的存取权限</li>
       <li>重新安装</li>
       </ul>
       <br/>谢谢.</p>
       </td>
	<?php
		HTML_joomfish::_footer($act, $option);
  	
  }
	function showPostInstall( $success=false ) {
		global $act, $task, $option, $mosConfig_live_site, $mosConfig_absolute_path, $_VERSION;
		HTML_joomfish::_header();
	?>
     <td align="left" valign="top">
       <h2>欢迎使用 JoomFish</h2>
       <p>我们当初没有想要制作翻译机器或者其他电脑为主的翻译方式. 目标在于翻译的处理过程, 您将会有更庞大的数
       	Joom!Fish 元件能够提供您设计与建立多国语系的网站. 它在使用上并不轻松,也不是一套相当好进行处理的元件 </p>
       	请您仔细地阅读以下的指示并且进行测试. 往后您如需找寻支援以及更进阶的协助可以前往至<a href="http://forge.joomla.org/sf/discussion/do/listForums/projects.joomfish/discussion" target="_blank">http://forge.joomla.org</a>.

        这套 Joom!Fish 目前的版本只能执行 Joomla! Version 1.0.7 以上的系统. 如果您使用的是不同的版本, 请参考 <br />
        相关的网站来取得适合的版本的 Joomla!.</p>
	   <p>
	   	  现在请安装所有的语系 (并没有限制) 您可以透过您的网站进行: <a href="index2.php?option=com_installer&element=language">网站 -> 语言管理 -> 新增</a> 的功能来安装所可 <br />
	   	  以支援的语系. <br />
	   	  在您完成了语系档的安装之后您必须启动该语系并且给予语系的名称. 您可以前往 (<a href="index2.php?option=com_joomfish&act=config_language">元件 -> Joom!Fish -> Languanges</a>) 进行操作.<br />
	   &nbsp;<br />
	   <b>首先检查:</b> 当您在网站前台变更网站的语系 (Solarflar [预设] 布景主题已经修改) 时, 所有的静态内容应该也 <br />
	   会改变.</p>

	   <h2>要如何翻译内容?</h2>
	   翻译的方式相当的简单. 将来只要有人建立了新的内容资料后, 您将会在翻译总览(Joom!Fish -> Translation )中发现 <br />
	   这项新内容. <br />
	   轻松翻译的方式是您可以去定义针对所有内容写入的标准语系. 然后您再用翻译模组来针对内容去编辑各式不同的语言.</p>
		 当您点选其中一项内容要进行翻译时, 您会发现 Joom!Fish 将某些指定的文字栏位提出让您进行翻译. 使用该表格进行 <br />
		 翻译工作完成后也别忘记进行发布的动作. 完成了整个翻译动作后您可以从前台前往所进行翻译的内容观看成果(当然是 <br />
		 要切换到您所翻译的语系项目). <br />
	   &nbsp;<br />

	   <h2>What I know</h2>
	   这套版本相当的深远. 管理区设定中有一小部份的指派已经合乎 Joomla! 的标准 (回存 / 取出回存) 并且作用于前台. <br />
		 &nbsp;<br />
		 主要是在前台的翻译整合于所有 Joomla! 核心系统的元件以及模组. 由于有几个 DHTML 的问题, 将在下个版本进行这项 <br />
		 挑战.
	   &nbsp;</p>
		 目前针对下一个版本已经有一些新的创意, 例如, 包含: :
		 <ul>
		 	<li>当原始的内容改变后将自动通知</li>
		 </ul>
	   	 还有什么问题吗? 请前往<a href="http://www.joomfish.net" target="_blank">viewProject/projects.joomfish</a>来发表您的看法以及意见.
	   	 Joom!Fish 将会进行追踪或公开的论坛.
		 
	   <p>感谢您体验这个元件所带来的挑战<br>
		 &nbsp;<br />
		 Alex</p>
	   </td>
		<td align="left" valign="top" nowrap>
			<?php HTML_joomfish::_sideMenu();?>
			<?php HTML_joomfish::_creditsCopyright(); ?>
		</td>
<?php
		HTML_joomfish::_footer($act, $option);
  }
}
?>
