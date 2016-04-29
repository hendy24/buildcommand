<script>
	$(document).ready(function() {
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

	<form action="{$SITE_URL}" method="post" name="new_project" enctype="multipart/form-data">
		<input type="hidden" name="page" value="projects">
		<input type="hidden" name="action" value="add">
		<input type="hidden" name="path" value="{$currentUrl}">

		<table>
			<tr class="title-row">
				<td colspan="2">Project Name:</td>
			</tr>
			<tr>
				<td colspan="2"><input type="text" name="name" style="width: 500px" value=""></td>
			</tr>
			<tr>
				<td><strong>Class:</strong>
					<select name="class" id="class">
						<option value="">Select...</option>
						{foreach from=$class item=c}
						<option value="{$c->id}">{$c->name}</option>
						{/foreach}
					</select>
				</td>
				<td><strong>Type:</strong>
					<select name="type" id="type">
						<option value="">Select...</option>
						{foreach from=$type item=t}
						<option value="{$t->id}">{$t->name}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			<tr>
				<td><strong>Bid Type:</strong>
					<select name="bid_type" id="bid-type">
						<option value="">Select...</option>
						<option value="cost_plus">Cost Plus</option>
						<option value="fixed_price">Fixed Price</option>
						<option value="time_materials">Time &amp; Materials</option>
					</select>
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
			<tr class="title-row">
				<td>Owner Email</td>
				<td>Owner Phone</td>
			</tr>
			<tr>
				<td><input type="text" name="owner_email" style="width: 250px"></td>
				<td><input type="text" name="owner_phone"></td>
			</tr>
			<tr class="title-row">
				<td>Lender Email</td>
				<td>Lender Phone</td>
			</tr>

			<tr>
				<td><input type="text" name="lender_email" style="width: 250px"></td>
				<td><input type="text" name="lender_phone"></td>
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
