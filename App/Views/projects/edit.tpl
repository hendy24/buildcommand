<script>
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

	<form action="{$SITE_URL}" method="post" name="edit_project" enctype="multipart/form-data">
		<input type="hidden" name="page" value="projects">
		<input type="hidden" name="action" value="edit">
		<input type="hidden" name="id" value="{$project->public_id}">
		<input type="hidden" name="path" value="{$currentUrl}">
		
		<table>
			<tr class="title-row">
				<td>Project Name:</td>
				<td>Project Number</td>
				
			</tr>
			<tr>
				<td><input type="text" name="name" style="width: 200px" value="{$project->name}"></td>
				<td><input type="text" class="number" name="project_number" value="{$project->project_number}" placeholder="Optional"></td>

			</tr>
			<tr class="title-row">
				<td>Owner Email Address:</td>
				<td>Bank Email Address:</td>
			</tr>
			<tr>
				<td><input type="text" name="owner_email" value="{$project->owner_email}" style="width: 250px"></td>
				<td><input type="text" name="bank_email" value="{$project->bank_email}"  style="width: 250px"></td>
			</tr>
			<tr class="title-row">
				<td>Payment Type</td>
				<td class="margin">Margin (%)</td>
			</tr>
			<tr>
				<td>
					<select name="payment_type" id="payment-type">
						<option value="">Select payment type...</option>
						<option value="cost_plus" {if $project->payment_type == 'cost_plus'}selected{/if}>Cost Plus</option>
						<option value="hard_bid" {if $project->payment_type == 'hard_bid'}selected{/if}>Bid</option>
					</select>
				</td>
				<td class="margin"><input type="text" name="margin" value="{$project->margin}" class="number"></td>
			</tr>
			<tr class="title-row">
				<td>Contingency (%)</td>
			</tr>
			<tr>
				<td><input type="text" name="contingency" value="{$project->contingency}" class="number"></td>
			</tr>
			<tr class="title-row">
				<td>Basement Sq. Ft.:</td>
				<td>Main Floor Sq. Ft.:</td>
				
			</tr>
			<tr>
				<td><input type="text" class="number" name="basement_sq_ft" value="{$project->basement_sq_ft}"></td>
				<td><input type="text" class="number" name="main_floor_sq_ft" value="{$project->main_floor_sq_ft}"></td>
			</tr>
			<tr class="title-row">
				<td>Upper Floor Sq. Ft.:</td>
				<td>Garage Sq. Ft.:</td>
				
			</tr>
			<tr>
				
				<td><input type="text" class="number" name="garage_sq_ft" value="{$project->garage_sq_ft}"></td>
				<td><input type="text" class="number" name="upper_floor_sq_ft" value="{$project->upper_floor_sq_ft}"></td>
			</tr>

			<tr>
				<td><strong>Project Plan</strong></td>	
			</tr>

			{if $project->plan_filename != ""}
				<tr>
					<td colspan="2" class="text-right"><a href="" class="button">Delete Uploaded Plan</a></td>
				</tr>
			{else}
			<tr>
				<td colspan="2" id="draganddrop"><span class="text-grey">Drop files here...</span></td>
			</tr>
			<tr>
				<td><input type="file" name="plan_filename"></td>
			</tr>
			{/if}
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
