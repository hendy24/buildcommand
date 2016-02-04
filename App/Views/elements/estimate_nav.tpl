<h1>{$project->name}</h1>

<div id="estimate-nav">
	<ul>
		<li id="general-link"><a href="{$SITE_URL}/?page=estimates&amp;action=general&amp;id={$project->public_id}">General</a></li>
		<li id="rough-structure-link" ><a href="{$SITE_URL}/?page=estimates&amp;action=rough_structure&amp;id={$project->public_id}">Rough Structure</a></li>
		<li id="mechanical-link"><a href="{$SITE_URL}/?page=estimates&amp;action=mechanical&amp;id={$project->public_id}">Mechanical</a></li>
		<li id="interior-finishes-link"><a href="{$SITE_URL}/?page=estimates&amp;action=interior&amp;id={$project->public_id}">Interior</a></li>
		<li id="exterior-finishes-link"><a href="{$SITE_URL}/?page=estimates&amp;action=exterior&amp;id={$project->public_id}">Exterior</a></li>
		<li id="closing-link"><a href="{$SITE_URL}/?page=estimates&amp;action=closing&amp;id={$project->public_id}">Closing</a></li>
	</ul>	
</div>