{!! former_for($message, ['class' => 'row', 'data-remote' => true])->populate($message) !!}
  <div class="col-md-8 well">
      {!! Former::text('title') !!}

      {!! Former::textarea('body')->rows(5) !!}

      {!! Former::actions(
            Button::primary('Send message')
              ->withAttributes(['data-disable-with' => 'Saving this message...'])
              ->submit()->prependIcon(Icon::check())
         )
      !!}
  </div>
{!! former_for_close() !!}
