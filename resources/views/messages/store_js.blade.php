// <script type="text/javascript"> {{-- Keep this line to have syntax highlight in IDE --}}

$('#messages').append({!! json_encode(render_view('messages._message', compact('message'))) !!});// Add the new message
$('#{{ dom_id($message) }}').fadeTo('slow', 0.2).fadeTo('fast', 1); // Add effects to highlight the new message
$('#create_message').remove();
$('#create_message_link').show();
// </script>{{-- Keep this line to have syntax highlight in IDE --}}
