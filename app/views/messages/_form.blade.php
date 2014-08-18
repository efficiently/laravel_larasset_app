{{ former_for($message, ['class' => 'row', 'data-remote' => true])->rules(Message::$rules) }}
  <?php Former::populate($message) ?>
  <div class="col-md-8 well">
      {{ Former::text('title') }}

      {{ Former::textarea('body')->rows(5) }}

      {{ Former::actions(
            Button::primary_submit('Send message', ['data-disable-with' => "Saving this message..."])->with_icon('check')
         )
      }}
  </div>
{{ former_for_close() }}
