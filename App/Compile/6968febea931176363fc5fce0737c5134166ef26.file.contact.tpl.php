<?php /* Smarty version Smarty-3.1.19, created on 2014-10-28 09:11:46
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/site/contact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2007101309542b4eddbbb217-23238822%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6968febea931176363fc5fce0737c5134166ef26' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/site/contact.tpl',
      1 => 1414509105,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2007101309542b4eddbbb217-23238822',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b4eddbc57e4_52718741',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b4eddbc57e4_52718741')) {function content_542b4eddbc57e4_52718741($_smarty_tpl) {?><div id="contact">
	<h1>Contact Us</h1>
	<div class="addContent">
		<div id="contact-form">
			<p style="line-height: 1.25em;">BuildCommand is located just outside Boise, Idaho in the beautiful Treasure Valley.  You can call us at (208) 740-3224 or send us a message using the form below and we will get back to you as soon as possible. If you need to send something to us or prefer to correspond by traditional mail our address is:</p>
			<ul>
				<li>2632 SW 3 1/2 Ave</li>
				<li>Fruitland, ID 83619</li>
			</ul>
			<br />
			<table>
			    <tr>
			        <td>
			        	<label for="name">Name:<br></label>
			        	<input id="name" type="text" name="name" size="80" value="">
			        	<div class="flash-inline"></div>
			        </td>
			    </tr>
			    <tr>
			        <td>
			        	<label for="email">Email:<br></label>
			        	<input id="email" type="text" name="email" size="80" value=""> 
			        	<div class="flash-inline">
			        </td>
			    </tr>
			    <tr>
			        <td>Message:<br>
			        	<textarea id="message" name="message" cols="80" rows="10" value=""></textarea>
			        	<div class="flash-inline">
			        </td>
			    </tr>
			    <tr>
			        <td colspan="2" align="right"><br></td>
			    </tr>
			</table>
		</div>
	</div>
</div>
<script src="/js/contact.js"></script><?php }} ?>
