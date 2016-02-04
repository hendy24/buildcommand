<?php /* Smarty version Smarty-3.1.19, created on 2015-12-08 16:57:07
         compiled from "/mnt/hgfs/Sites/buildcommand/App/Views/projects/add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11713932935435c73faba400-99969102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c486c45240b2ed94749fb38d97e3751c7f977105' => 
    array (
      0 => '/mnt/hgfs/Sites/buildcommand/App/Views/projects/add.tpl',
      1 => 1449622626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11713932935435c73faba400-99969102',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5435c73facfa04_91136323',
  'variables' => 
  array (
    'SITE_URL' => 0,
    'currentUrl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5435c73facfa04_91136323')) {function content_5435c73facfa04_91136323($_smarty_tpl) {?><script>
	$(document).ready(function() {

		$(".margin").hide();

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

		$(".bid-type").change(function() {
			if ($(this).val() == "cost_plus") {
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

<h1>Add New Project</h1>
<div class="form">

	<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['SITE_URL']->value, ENT_QUOTES, 'UTF-8');?>
" method="post" name="new_project" enctype="multipart/form-data">
		<input type="hidden" name="page" value="projects">
		<input type="hidden" name="action" value="add">
		<input type="hidden" name="path" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currentUrl']->value, ENT_QUOTES, 'UTF-8');?>
">
		
		<table>
			<tr class="title-row">
				<td>Project Name:</td>
				<td>Type</td>
				
			</tr>
			<tr>
				<td><input type="text" name="name" style="width: 200px" value=""></td>
				<td>
					<input type="radio" name="type" value="new_construction"> New Construction <br>
					<input type="radio" name="type" value="remodel_addition"> Remodel / Addition
				</td>

			</tr>
			<tr class="title-row">
				<td>Payment Type</td>				
			</tr>
			<tr>
				<td>
					<input type="radio" class="bid-type" name="bid_type" value="cost_plus"> Cost Plus <br>
					<input type="radio" class="bid-type" name="bid_type" value="fixed_price"> Fixed Price <br>
					<input type="radio" class="bid-type" name="bid_type" value="time_materials"> Time &amp; Materials
				</td>
			</tr>
			<tr>
				<td><strong>Contingency (%):</strong> <input type="text" name="contingency" class="number"></td>
				<td class="margin"><strong>Margin (%):</strong> <input type="text" name="margin" class="number"></td>
			</tr>
			<tr class="title-row">
				<td>Finished Sq. Ft.:</td>
				<td>Unfinished Sq. Ft.:</td>
				
			</tr>
			<tr>
				<td><input type="text" class="number" name="finished_sq_ft" value=""></td>
				<td><input type="text" class="number" name="unfinished_sq_ft" value=""></td>
			</tr>

			<tr>
				<td><strong>Project Plan</strong></td>	
			</tr>
			<tr>
				<td colspan="2" id="draganddrop"><span class="text-grey">Drop files here...</span></td>
			</tr>
			<tr>
				<td><input type="file" name="plan_filename"></td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			
			
			<tr>		
				<td colspan="2" class="text-right"><input type="submit" value="Next">
			</tr>
		</table>
	</form>
</div>
<?php }} ?>
