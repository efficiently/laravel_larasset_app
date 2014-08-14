{{ form_for($message, ['data-remote' => true]) }}   
    <div class="field">
        {{ Form::label('title') }}
        {{ Form::text('title') }}
    </div>
    <div class="field">
        {{ Form::label('body') }}
        {{ Form::textarea('body') }}
    </div>
    <div class="actions">
        {{ Form::submit('Send message', ['data-disable-with' => "Saving this message..."]) }}
    </div>
{{ form_for_close() }}