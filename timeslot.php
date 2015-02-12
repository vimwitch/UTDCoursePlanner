<?php
//timeslot is a class that represents a given timeslot
//

include_once('time.php');

class timeslot {
	public $day = 0; // day is an int that represents the weekday - 0 is monday, 1 is tuesday, 2 is wednesday etc
	public $startTime; //a time object
	public $endTime; //time object

	function __construct($d, $s, $e){
		$this->day = $d;
		$this->startTime = $s;
		$this->endTime = $e;
	}

	//checks if this timeslot conflicts with another timeslot
	function doesTimeslotConflict($t){
		if($t->day != $this->day) return false;
		$start1 = intval($t->startTime->hour . ($t->startTime->min==0?"0":'') . $t->startTime->min);
		$end1 = intval($t->endTime->hour . ($t->endTime->min==0?"0":'') . $t->endTime->min);
		$start2 = intval($this->startTime->hour . ($this->startTime->min==0?"0":'') . $this->startTime->min);
		$end2 = intval($this->endTime->hour . ($this->endTime->min==0?"0":'') . $this->endTime->min);

		if($start1 <= $end2 && $end1 >= $end2) return true;
		if($start1 <= $start2 && $end1 >= $start2) return true;
		if($start2 <= $end1 && $end2 >= $end1) return true;
		if($start2 <= $start1 && $end2 >= $start1) return true;
		return false;
	}

	//returns true if $t(time) in $d(day) is contained within this timeslot
	function doesTimeConflict($d, $t){
		if($d != $this->day) return false;
		$time = intval($t->hour . ($t->min==0?"0":'') . $t->min);
		$start1 = intval($this->startTime->hour . ($this->startTime->min==0?"0":'') . $this->startTime->min);
		$end1 = intval($this->endTime->hour . ($this->endTime->min==0?"0":'') .  $this->endTime->min);
		if($time > $start1 && $time < $end1) return true;
		return false;
	}
}

?>
