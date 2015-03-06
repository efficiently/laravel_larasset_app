<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	protected $fillable = ['title', 'body'];

	public static $rules = [
        'title' => 'required',
        'body'  => 'required',
	];
}
