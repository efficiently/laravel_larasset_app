@div_for($message)
    <p>
        <strong>Title:</strong>
        {{{ $message->title }}}
    </p>
    <p>
        <strong>Body:</strong>
        {{ nl2br(e($message->body)) }}
    </p>
@end_div_for
