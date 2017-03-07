<?php

class SchedulesController extends MainController {


	public function findEvents() {
		$events = $this->load('Schedule')->fetchEvents(input()->project_id);
		json_return($events);
	}


}