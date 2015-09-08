@div_for($message, null, ['class' => 'row'])
  <div class="col-lg-10 col-md-8 col-sm-6">
    <dl class="dl-horizontal">
      <dt>Title</dt>
      <dd>
        {{ $message->title }}
      </dd>

      <dt>Body</dt>
      <dd>
        {!! nl2br(e($message->body)) !!}
      </dd>
    </dl>
  </div>
  <div class="col-lg-2 col-md-3">
    <div class="actions">
      {!!
        Button::normal('edit')->asLinkTo(route('messages.edit', $message->id))->withAttributes([
          'data-remote' => true,
        ])->prependIcon(Icon::pencil())
      !!}

      {!!
        button_to(Icon::trash_o().' remove', [
          'route' => ['messages.destroy', $message->id],
          'method' => 'delete',
          'data-remote' => true,
          'data-confirm' => "Are you sure?",
          'data-disable-with' => 'removing...',
          'formClass' => 'button-to-inline',
          'class' => 'btn-danger btn',
        ])
      !!}
    </div>
  </div>
@end_div_for
