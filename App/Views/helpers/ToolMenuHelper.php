<?php

class ToolMenuHelper {

	public function options($project) {

		$rand = rand(1, 10000) * $project->id;
		$options = "";
		$options .= "<li><a href=\"" . SITE_URL . "/?page=draw_requests&amp;id={$project->public_id}\">Draw Requests</a></li>";
		$options .= "<li><a href=\"" . SITE_URL . "/?page=projects&amp;action=edit&amp;id={$project->public_id}\">Edit</a></li>";
		$options .= "<li><span title=\"{$project->public_id}\"><a href=\"" . SITE_URL . "/?page=projects&amp;action=archive&amp;id={$project->public_id}\" class=\"archive\">Archive</a></span></li>";
		// $options .= "<li><span title=\"{$project->public_id}\"><a href=\"#\" class=\"delete\">Delete</a></span></li>";



			echo <<<END
		<dl style="" class="dropdown">
			<dt><a id="linkglobal{$rand}" style="cursor:pointer;"></a></dt>
			<dd>
				<ul id="ulglobal{$rand}">
				{$options}
				</ul>
			</dd>
		</dl>
END;


	}

}