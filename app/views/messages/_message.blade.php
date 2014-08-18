@div_for($message)
    <p>
        <strong>Title:</strong>
        {{{ $message->title }}}
    </p>
    <p>
        <strong>Body:</strong>
        {{ nl2br(e($message->body)) }}
    </p>
    <div class="actions">
        {{ link_to(route('messages.edit', $message->id), 'edit', ['data-remote' => true]) }}
        {{ link_to(route('messages.destroy', $message->id), 'remove', ['data-method' => 'delete', 'data-confirm' => "Are you sure?", 'data-remote' => true]) }}
    </div>
@end_div_for
