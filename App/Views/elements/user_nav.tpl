<ul>
	<li><a href="/">Home</a></li>
	<li>Projects
		<ul>
			{foreach $companyProjects as $project}
				<li><a href="{$SITE_URL}/?page=projects&amp;action=manage&amp;id={$project->public_id}">{$project->name}</a></li>
			{/foreach}
				<li><a href="{$SITE_URL}/?page=projects&amp;action=add"><span class="text-grey">Add New Project</span></a></li>
		</ul>
	</li>
	<li>Info
		<ul>
			<li><a href="{$SITE_URL}/?page=actions">Actions</a></li>
			<li><a href="{$SITE_URL}/?page=files">Files</a></li>
			<li><a href="{$SITE_URL}/?page=notes">Notes</a></li>
		</ul>

	</li>
	<li><a href="{$SITE_URL}/?page=partners">Partners</a>
<!-- 		<ul>
			<li><a href="/?page=partners&amp;type=contractor">Contractors</a></li>
			<li><a href="/?page=partners&amp;type=supplier">Suppliers</a></li>
			<li><a href="/?page=partners&amp;type=realtor">Realtors</a></li>
			<li><a href="/?page=partners&amp;type=lendor">Lendors</a></li>
		</ul>
 -->	</li>
	<li>Data
		<ul>
			<li><a href="/?page=users&amp;action=account_info">My Info</a></li>
			{if $auth->is_admin()}
				<li><a href="/?page=company">Company Info</a></li>
				<li><a href="/?page=users&amp;action=add">Add User</a></li>
				<li><a href="/?page=users&amp;action=manage">Manage Users</a></li>
			{/if}
		</ul>
</ul>
