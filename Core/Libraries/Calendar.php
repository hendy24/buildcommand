<?php

class Calendar {

	public function getWeek($date = null) {
		if ($date == null) {
			$date = date('Y-m-d');
		}

		if (date('w', strtotime($date)) == 0) {
			$startOfWeek = date('Y-m-d', strtotime($date));
		} else {
			$startOfWeek = date('Y-m-d', strtotime('last Sunday', strtotime($date)));
		}


		$week = array();
		$i = 0;
		while ($i < 7) {
			$week[$i] = date('Y-m-d', strtotime($startOfWeek . " + {$i} days"));
			$i++;
		}
		return $week;

	}

	/*
	 * -----------------------------------------------------------------------------
	 * Get an array with the date and day values for the month
	 * -----------------------------------------------------------------------------
	 *
	 *
	 */
	 public function getMonth($month, $year) {
		 $this->month = $month;
		 $this->last_month = date('F', strtotime($month . " " . $year . "first day of last month"));
		 $this->next_month = date('F', strtotime($month . " " . $year . "first day of next month"));
		 $month = date('m', strtotime($month));
		 $this->year = $year;
		 $num_days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		 // get the day for the first day of the month
		 $first_day = date('w', mktime(0, 0, 0, $month, 1, $year));
		 $month_dates = array();

		 // create an array for the month
		 $week = 1;
		 $day_date = 1;
		 while ($day_date <= $num_days_in_month) {
			 for ($day = 0; $day <= 6; $day++) {
				 $mktime = mktime(0, 0, 0, $month, $day_date, $year);
				 $date = date("d", $mktime);

				 if ($day != $first_day && $first_day != null) {
					 $month_dates[$week][$day] = "";
				 } elseif ($day_date <= $num_days_in_month) {
					 $month_dates[$week][$day] = $date;
					 $first_day = null;
					  $day_date++;
				 }
			 }
			 $week++;
		 }
		 $this->dates = $month_dates;
	 }

	private function getWeekOfMonth($date) {
		// get the first day of the month
		$date = strtotime($date);
		$first_of_month = strtotime(date("Y-m-01", $date));

		echo "Current Date<br>";
		echo $date . " : " . date("W", strtotime($date));
		echo "<br>";
		echo "<br>";
		echo "First Week of month<br>";
		echo $first_of_month . " : " . date("W", $first_of_month);
		echo "<br>";
		echo "<br>";
		return intval(date("W", strtotime($date))) - intval(date("W", $first_of_month)) + 1;
	}


}
