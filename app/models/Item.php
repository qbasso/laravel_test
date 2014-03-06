<?php

class Item extends Eloquent {
	protected $table = 'item';	
	public $timestamps = false;
	
	public function user() {
		return $this->belongsTo('User');
	}
}