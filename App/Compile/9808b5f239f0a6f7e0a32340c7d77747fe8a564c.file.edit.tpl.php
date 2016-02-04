<?php /* Smarty version Smarty-3.1.19, created on 2014-11-05 17:19:07
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/projects/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:186690312354517250c24d96-13425841%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9808b5f239f0a6f7e0a32340c7d77747fe8a564c' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/projects/edit.tpl',
      1 => 1415233146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186690312354517250c24d96-13425841',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_54517250c3e175_57122091',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'project' => 0,
    'currentUrl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54517250c3e175_57122091')) {function content_54517250c3e175_57122091($_smarty_tpl) {?><script>
	$(document).ready(function() {

		$(".margin").hide();

		if ($("#payment-type option:selected").val() == "cost_plus") {
			$(".margin").show();
		}

		$("#delete-project").click(function() {
			if (confirm("Are you sure you want to delete this project?  This cannot be undone.")) {
				// delete project
				window.location = SITE_URL + "/projects/delete/public_id:" + $(this).attr('rel');
			}
			
			return false;
			
		});
		
		
		$("#delete-plan").click(function() {
			if (confirm("Are you sure you want to delete the current house plan?")) {
				// delete house plan with ajax
				window.location = SITE_URL + "/projects/delete_plan/public_id:" + $(this).attr('rel');
			}
			
			return false;
		});

		$("#payment-type").change(function() {
			if ($("option:selected", this).val() == "cost_plus") {
				$(".margin").show();
			} else {
				$(".margin").hide();
			}
		});



		// Drag and drop file upload
		var obj = $("#draganddrop");
		obj.on('dragenter', function (e) {
			e.stopPropagation();
			e.preventDefault();
			$(this).css('border', '2px solid #0B85A1');
		});

		obj.on('dragover', function (e) {
			e.stopPropagation();
			e.preventDefault();
		});
		obj.on('drop', function (e) {
			$(this).css('border', '2px dotted #0B85A1');
			e.preventDefault();
			var files = e.originalEvent.dataTransfer.files;

			//  send dropped files to server
			handleFileUpload(files, obj);
		});


		// prevent file from opening new window if dropped outside the drop zone
		$(document).on('dragenter', function (e) {
			e.stopPropagation();
			e.preventDefault();
		});
		$(document).on('dragover', function (e) {
			e.stopPropagation();
			e.preventDefault();
			obj.css('border', '2px dotted #0B85A1');
		});
		$(document).on('drop', function (e) {
		    e.stopPropagation();
		    e.preventDefault();
		});

		
		function handleFileUpload(files, obj) {
			for (var i = 0; i < files.length; i++) {
				var fd = new FormData();
				fd.append('file', files[i]);

				var status = new createStatusbar(obj);
				status.setFileNameSize(files[i].name,files[i].size);
				sendFileToServer(fd,status);
			}
		}

		function sendFileToServer(formData, status) {
			var uploadURL = SITE_URL;
			var extraData = { page: "projects", action: "upload_file" };
			var jqXHR = $.ajax({
				xhr: function() {
					var xhrobj = $.ajaxSettings.xhr();
					if (xhrobj.upload) {
						xhrobj.upload.addEventListener('progress', function (event) {
							var percent = 0;
							var position = event.loaded || event.position;
							var total = event.total;
							if (event.lengthComputable) {
								percent = Math.ceil(position / total * 100);
							}
							// Set progress
							status.setProgress(percent);
						}, false);
					}
					return xhrobj;
				},
				url: uploadURL,
				type: "POST",
				contentType: false,
				processData: false,
				cache: false,
				data: formData,
				success: function (data) {
					status.setProgress(100);
				}
			});

			status.setAbort(jqXHR);
		}

	});
	
</script>

<h1>Edit Project</h1>
<div class="form">

	<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
" method="post" name="edit_project" enctype="multipart/form-data">
		<input type="hidden" name="page" value="projects">
		<input type="hidden" name="action" value="edit">
		<input type="hidden" name="id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->public_id, ENT_QUOTES, 'UTF-8');?>
">
		<input type="hidden" name="path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentUrl']->value, ENT_QUOTES, 'UTF-8');?>
">
		
		<table>
			<tr class="title-row">
				<td>Project Name:</td>
				<td>Project Number</td>
				
			</tr>
			<tr>
				<td><input type="text" name="name" style="width: 200px" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->name, ENT_QUOTES, 'UTF-8');?>
"></td>
				<td><input type="text" class="number" name="project_number" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->project_number, ENT_QUOTES, 'UTF-8');?>
" placeholder="Optional"></td>

			</tr>
			<tr class="title-row">
				<td>Owner Email Address:</td>
				<td>Bank Email Address:</td>
			</tr>
			<tr>
				<td><input type="text" name="owner_email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->owner_email, ENT_QUOTES, 'UTF-8');?>
" style="width: 250px"></td>
				<td><input type="text" name="bank_email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->bank_email, ENT_QUOTES, 'UTF-8');?>
"  style="width: 250px"></td>
			</tr>
			<tr class="title-row">
				<td>Payment Type</td>
				<td class="margin">Margin (%)</td>
			</tr>
			<tr>
				<td>
					<select name="payment_type" id="payment-type">
						<option value="">Select payment type...</option>
						<option value="cost_plus" <?php if ($_smarty_tpl->tpl_vars['project']->value->payment_type=='cost_plus') {?>selected<?php }?>>Cost Plus</option>
						<option value="hard_bid" <?php if ($_smarty_tpl->tpl_vars['project']->value->payment_type=='hard_bid') {?>selected<?php }?>>Bid</option>
					</select>
				</td>
				<td class="margin"><input type="text" name="margin" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->margin, ENT_QUOTES, 'UTF-8');?>
" class="number"></td>
			</tr>
			<tr class="title-row">
				<td>Contingency (%)</td>
			</tr>
			<tr>
				<td><input type="text" name="contingency" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->contingency, ENT_QUOTES, 'UTF-8');?>
" class="number"></td>
			</tr>
			<tr class="title-row">
				<td>Basement Sq. Ft.:</td>
				<td>Main Floor Sq. Ft.:</td>
				
			</tr>
			<tr>
				<td><input type="text" class="number" name="basement_sq_ft" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->basement_sq_ft, ENT_QUOTES, 'UTF-8');?>
"></td>
				<td><input type="text" class="number" name="main_floor_sq_ft" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->main_floor_sq_ft, ENT_QUOTES, 'UTF-8');?>
"></td>
			</tr>
			<tr class="title-row">
				<td>Upper Floor Sq. Ft.:</td>
				<td>Garage Sq. Ft.:</td>
				
			</tr>
			<tr>
				
				<td><input type="text" class="number" name="garage_sq_ft" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->garage_sq_ft, ENT_QUOTES, 'UTF-8');?>
"></td>
				<td><input type="text" class="number" name="upper_floor_sq_ft" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['project']->value->upper_floor_sq_ft, ENT_QUOTES, 'UTF-8');?>
"></td>
			</tr>

			<tr>
				<td><strong>Project Plan</strong></td>	
			</tr>

			<?php if ($_smarty_tpl->tpl_vars['project']->value->plan_filename!='') {?>
				<tr>
					<td colspan="2" class="text-right"><a href="" class="button">Delete Uploaded Plan</a></td>
				</tr>
			<?php } else { ?>
			<tr>
				<td colspan="2" id="draganddrop"><span class="text-grey">Drop files here...</span></td>
			</tr>
			<tr>
				<td><input type="file" name="plan_filename"></td>
			</tr>
			<?php }?>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			
			<tr>		
				<td><input type="button" value="Cancel" onclick="history.go(-1)"></td>
				<td class="text-right"><input type="submit" value="Save"></td>
			</tr>
		</table>
	</form>
</div>
<?php }} ?>
