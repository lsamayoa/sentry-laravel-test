<?php

class Todo extends Eloquent {
    protected $guarded = array();

    public static $rules = array(
		'title' => 'required',
		'done' => 'required'
	);

	public function user()
	{
		return $this->belongsTo('User');
	}
}