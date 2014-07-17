// <script type="text/javascript"> {{-- Keep this line to have syntax highlight in IDE --}}

{{-- renders messages/_message.blade.php --}}
$('#messages').append({{ json_encode(render_view('messages/_message', ['message' => $message])) }});// Add the new message
$('#{{{ dom_id($message) }}}').fadeTo('slow', 0.2).fadeTo('fast', 1); // Add effects to highlight the new message
$('#create_message').trigger("reset"); // Clear form fields

// </script>{{-- Keep this line to have syntax highlight in IDE --}}