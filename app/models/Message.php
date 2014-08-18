<?php

class Message extends Eloquent
{
    protected $fillable = ['title', 'body'];

    public static $rules = [
        'title' => 'required',
        'body'  => 'required',
    ];
}
