<?php

class User extends Eloquent {	
	public $timestamps = false;
	public function items() {
		return $this->hasMany('Item');
	}
}