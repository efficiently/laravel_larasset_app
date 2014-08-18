<?php

class MessagesController extends BaseController
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
        $message = \App::make('Message');
        $format = \Request::format();

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
        $inputs = \Input::except('_method', '_token');
        $validator = \Validator::make($inputs, Message::$rules);

        if ($validator->passes() && $message = Message::create($inputs)) {
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

        return \Redirect::route('messages.create')->withInput()
            ->with('error', "Error: Unable to save this message");
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

        $format = \Request::format();

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
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $message = Message::findOrFail($id);
        $inputs = \Input::except('_method', '_token');
        $validator = \Validator::make($inputs, Message::$rules);

        if ($validator->passes() && $message->update($inputs)) {
            $format = \Request::format();

            switch ($format) {
                case 'js':
                    // Just renders messages/update_js.blade.php
                    $render = $this->render(['js' => 'messages.update'], ['message' => $message]);
                    break;
                case 'html':
                default:
                    // No js fallback
                    $render = \Redirect::route('messages.show', $message->id);
                    break;
            }

            return $render;
        }

        return \Redirect::route('messages.edit', $message->id)->withInput()
            ->with('error', "Error: Unable to save this message");
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
            $format = \Request::format();

            switch ($format) {
                case 'js':
                    // Just renders messages/destroy_js.blade.php
                    $render = $this->render(['js' => 'messages.destroy'], compact('message'));
                    break;
                case 'html':
                default:
                    // No js fallback
                    $render = \Redirect::route('messages.index');
                    break;
            }

            return $render;
        }

        return \Redirect::route('messages.show', $message->id)->with('error', "Error: Unable to remove this message");
    }
}
