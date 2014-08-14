{{ form_for($message, ['class' => 'well', 'data-remote' => true]) }}
  {{
    Form::control_group(
      Form::label('title'),
      Form::text('title')
    ).
    Form::control_group(
      Form::label('body'),
      Form::textarea('body')
    )
  }}
  <div class="form-group form-actions">
    {{ Button::primary_submit('Send message', ['data-disable-with' => "Saving this message..."]) }}
  </div>
{{ form_for_close() }}
