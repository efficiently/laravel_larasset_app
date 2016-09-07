<?php

namespace App\Http\Controllers;

use App\Message;

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
        $format = request()->format();
        switch ($format) {
            case 'js':
                $render = $this->render(['js' => 'messages.create'], compact('message'));
                break;
            case 'html':
            default:
                // No js fallback
                $render = $this->render('messages.create', compact('message'));
                break;
        }

        return $render;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $message = app('App\Message');
        $message->fill(request()->except('_method', '_token'));

        if ($message->save()) {
            $format = request()->format();

            switch ($format) {
                case 'js':
                    // Just renders messages/store_js.blade.php
                    $render = $this->render(['js' => 'messages.store'], ['message' => $message]);
                    break;
                case 'html':
                default:
                    // No js fallback
                    $render = redirect()->route('messages.show', $message->id);
                    break;
            }

            return $render;
        }

        return redirect()->route('home')->with('message', 'Error: Unable to save this message');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
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
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $message = Message::findOrFail($id);
        $format = request()->format();
        switch ($format) {
            case 'js':
                $render = $this->render(['js' => 'messages.edit'], compact('message'));
                break;
            case 'html':
            default:
                // No js fallback
                $render = $this->render('messages.edit', compact('message'));
                break;
        }

        return $render;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $message = Message::findOrFail($id);
        $message->fill(request()->except('_method', '_token'));
        if ($message->save()) {
            $format = request()->format();
            switch ($format) {
                case 'js':
                    // Just renders messages/update_js.blade.php
                    $render = $this->render(['js' => 'messages.update'], ['message' => $message]);
                    break;
                case 'html':
                default:
                    // No js fallback
                    $render = redirect()->route('messages.show', $message->id);
                    break;
            }

            return $render;
        }

        return redirect()->route('home')->with('message', 'Error: Unable to save this message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        if ($message->delete()) {
            $format = request()->format();
            switch ($format) {
                case 'js':
                    // Just renders messages/destroy_js.blade.php
                    $render = $this->render(['js' => 'messages.destroy'], compact('message'));
                    break;
                case 'html':
                default:
                    // No js fallback
                    $render = redirect()->route('messages.index');
                    break;
            }

            return $render;
        }

        return redirect()->route('home')->with('message', 'Error: Unable to delete this message');
    }
}
