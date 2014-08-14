@div_for($message, null, ['class' => 'row'])
  <div class="col-lg-10 col-md-8 col-sm-6">
    <dl class="dl-horizontal">
      <dt>Title</dt>
      <dd>
        {{{ $message->title }}}
      </dd>

      <dt>Body</dt>
      <dd>
        {{ nl2br(e($message->body)) }}
      </dd>
    </dl>
  </div>
  <div class="col-md-2">
    <div class="actions">
      {{
        Button::sm_link(route('messages.edit', $message->id), 'edit', [
          'data-remote' => true,
        ])->with_icon('pencil')
      }}
      {{
        Button::danger_sm_link(route('messages.destroy', $message->id), 'remove', [
          'data-method' => 'delete',
          'data-confirm' => "Are you sure?", 'data-remote' => true,
        ])->with_icon('trash-o')
      }}
    </div>
  </div>
@end_div_for
