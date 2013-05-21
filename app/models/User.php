<?php

namespace App\Models;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel {

	public function todos()
	{
		return $this->hasMany('Todo');
	}

}