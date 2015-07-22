{!!
  Button::success('Add a message')->withAttributes([
    'id' => 'create_message_link',
    'data-remote' => true,
    'data-disable-with' => "Loading...",
  ])->asLinkTo(route('messages.create'))
  ->large()->prependIcon(Icon::plus_circle())
!!}
