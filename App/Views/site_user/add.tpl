<script>
	$(document).ready(function() {
		// $(".phone").mask("(999) 999-9999");
		$("#multiple-projects").hide();
		$("#single-projects").hide();

		$("#account-type-tip").click(function(){
			$(".tooltip").toggle();
		});

		$("#group").selectmenu({ 
			width: 120,
			change: function (e, ui) {
				if ($("#group option:selected").val() == 2) {
					$("#multiple-projects").show();
				} else {
					$("#multiple-projects").hide();
				}
				
				if ($("#group option:selected").val() == 3) {
					$("#single-projects").show();
				} else {
					$("#single-projects").hide();
				}
			}
		});
		$("#state").selectmenu();
				
	});
		
</script>

<h1 class="text-center">{$title}</h1>
<form action="{$SITE_URL}" method="post">
	<input type="hidden" name="page" value="users">
	<input type="hidden" name="action" value="add">
	<input type="hidden" name="path" value="{$currentUrl}">

	<table class="form">
		<tr>
			<td>
				<strong>Group:</strong><img src="{$IMAGES}/information.png" alt="Information tooltip" id="account-type-tip" class="tooltip-button" /><div class="tooltip">The user group will allow different levels of access in the application.<br /><strong>Administrator:</strong> Access to all projects, user account management, add new users.<br /><strong>Manager:</strong> Access to specified projects<br /><strong>User:</strong> Access only to assigned project, typically a homeowner's account</div>
			</td>
			<td>
				<select name="group" id="group">
					<option value="">Select...</option>
					{foreach $groups as $group}
						<option value="{$group->id}" {if $editUser->group_id == $group->id} selected{/if}>{$group->name}</option>
					{/foreach}
				</select>
			</td>
		</tr>
		<tr id="multiple-projects">
			<td valign="top"><strong>Projects:</strong></td>
			<td>
				{foreach $projects as $project}
					<input type="checkbox" name="project[{$project->id}]" value="{$project->id}">{$project->name}<br>
				{/foreach}
			</td>
		</tr>
		<tr id="single-projects">
			<td valign="top"><strong>Projects:</strong></td>
			<td>
				{foreach $projects as $project}
					<input type="radio" name="project" value="{$project->id}">{$project->name}<br>
				{/foreach}
			</td>
		<tr>
			<td><strong>First Name:</strong></td>
			<td colspan="2"><strong>Last Name:</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="first_name" id="first-name" value="{$editUser->first_name}" size="30"></td>
			<td colspan="2"><input type="text" name="last_name" id="last-name" value="{$editUser->last_name}" size="50"></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Address:</strong></td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="address" id="address" value="{$editUser->address}" size="80"></td>
		</tr>
		<tr>
			<td style="width: 40%"><strong>City:</strong></td>
			<td style="width: 40%"><strong>State:</strong></td>
			<td style="width: 20%"><strong>Zip:</strong></td>
		</tr>
		<tr>
			<td><input type="text" name="city" id="city" value="{$editUser->city}" size="30"> </td>
			<td>
				<select name="state" id="state">
					<option value="">Select...</option>
					{foreach $states as $key => $state}
						<option value="{$key}" {if $editUser->state == $key} selected{/if}>{$state} ({$key})</option>
					{/foreach}
				</select>
			</td>
			<td><input type="text" name="zip" id="zip" value="{$editUser->zip}" size="10"></td>
		</tr>
		<tr>
			<td><strong>Phone Number:</strong></td>
			<td><input type="text" name="phone" id="phone" value="{$editUser->phone}"></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Username <span class="text-12">(Email Address)</span>:</strong></td>
		</tr>
		<tr>
			<td colspan="3"><input type="text" name="email" id="email" value="{$editUser->email}" size="40">
			{if $title == "Edit User"}
			&nbsp;<a href="{$SITE_URL}/?page=users&amp;action=change_password&amp;id={$editUser->public_id}" class="button">Reset Password</a></td>
			{else}
			</td>
			{/if}
		</tr>
		{if $title == "Edit User"}

		{else}
		<tr>	
			<td><strong>Password:</strong></td>
			<td><strong>Verify Password:</strong></td>
		</tr>
		<tr>	
			

			<td><input type="password" name="password" id="password"></td>
			<td><input type="password" name="verify_password" id="verify_password"></td>
		</tr>
		{/if}
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="right"><input type="submit" value="Add User"></td>
		</tr>
	</table>
</form>
