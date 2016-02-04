<?php /* Smarty version Smarty-3.1.19, created on 2015-08-27 17:11:54
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/site/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:942124633542b4c766c6072-43609623%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89837ee481ff211155636fdefbdbd6fec3071672' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/site/index.tpl',
      1 => 1440720713,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '942124633542b4c766c6072-43609623',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b4c766cc237_49801322',
  'variables' => 
  array (
    'IMAGES' => 0,
    'SITE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b4c766cc237_49801322')) {function content_542b4c766cc237_49801322($_smarty_tpl) {?><div class="text-center">
	<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['IMAGES']->value, ENT_QUOTES, 'UTF-8');?>
/buildcommand_slogan.png" alt="Take Command of your home buildiing projects" />
</div>


<div id="public">
	<p>BuildCommand takes the processes and practices used by a professional home builder and makes them available for those who would like to manage their own project. BuildCommand is essentially a virtual general contractor and provides the tools and know-how to enable homeowners and do-it-yourselfers to be in command of their own construction project.</p>
	<p>BuildCommand is currently in a closed beta and is available by invitation only.  If you are interested in more information about using BuildCommand and how it can benefit you as a builder, contractor, or homeowner, or if you would like to be notified when the beta release is made public, please <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/contact">contact us</a>.</p>
</div>
<div id="home-box">
	<p>Take <span class="text-22"><i>command</i></span> over your construction project.</p>
	<div class="center">
		<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
/register" class="homepage-button">Register Now</a>
	</div>
</div>

<div id="home-info-container">
	<hr width="95%" />
	<div class="home-info text-12">
		<h2>About BuildCommand</h2>
		<ul>
			<li><a href="/public/what_is_buildcommand">Learn more</a> about how BuildCommand will help you manage your new home construction or remodel project.</li>
		</ul>
	</div>
	
	<div class="home-info text-12">
		<h2>Recent News</h2>
		<ul>
			<li><a href="">BuildCommand Beta Launch!</a></li>
		</ul>
	</div>
</div>
<div id="beta-message">
	<p>NOTE: BuildCommand is in active development and is currently in a BETA phase.  Not all project management features are available, but look for updates soon!</p>
</div>

<?php }} ?>
