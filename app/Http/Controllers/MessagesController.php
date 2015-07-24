<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Message;
use Former;
use Illuminate\Http\Request;
use Input;
use Validator;

class MessagesController extends Controller
{
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
        $message = app('App\Message');

        return $this->render(
            'messages.create',
            compact('message'),
            ['change' => 'create_message']
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $params = Input::except('_method', '_token');
        $validator = Validator::make($params, Message::$rules);

        if ($validator->passes() && $message = Message::create($params)) {
            session()->flash('success', "Message was successfully created.");
            return $this->loadAndRenderIndex();
        }

        $message = app('App\Message');
        session()->flash('error', "Error: Unable to save this message");
        Former::withErrors($validator);

        return $this->render(
            'messages.create',
            compact('message'),
            ['change' => 'create_message']
        );
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
        $message = Message::findOrFail($id);

        return $this->render(
            'messages.edit',
            compact('message'),
            ['change' => form_id($message)]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $message = Message::findOrFail($id);
        $params = Input::except('_method', '_token');
        $validator = Validator::make($params, Message::$rules);

        if ($validator->passes() && $message->update($params)) {
            session()->flash('success', "Message was successfully updated.");

            return $this->render(
                'messages.show',
                compact('message'),
                ['change' => form_id($message)]
            );
        }

        session()->flash('error', "Error: Unable to save this message");
        Former::withErrors($validator);

        return $this->render(
            'messages.edit',
            compact('message'),
            ['change' => form_id($message)]
        );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        if ($message->delete()) {
            return $this->loadAndRenderIndex();
        }

        return $this->redirectTo(
            route('messages.index'),
            ['change' => 'messages']
        )->with('error', "Error: Unable to remove this message");
    }

    protected function loadAndRenderIndex()
    {
        $messages = Message::all();

        return $this->render(
            'messages.index',
            compact('messages'),
            ['change' => 'messages']
        );
    }
}
