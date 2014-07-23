<?php

class MessagesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$messages = Message::all();
		
		return $this->render('messages.index', compact('messages'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return $this->render('messages.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$message = \App::make('Message');
		$message->fill(\Input::except('_method', '_token'));

		if ($message->save()) {
			$format = \Request::format();

			switch ($format) {
				case 'js':
					// Just renders messages/store_js.blade.php
					$render = $this->render(['js' => 'messages.store'], ['message' => $message]);
					break;
				case 'html':
				default:
					// No js fallback
					$render = \Redirect::route('messages.show', $message->id);
					break;
			}

			return $render;
		}

		return \Redirect::route('home')->with('message', "Error: Unable to save this message");
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$message = Message::findOrFail($id);
		
		return $this->render('messages.show', compact('message'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}
