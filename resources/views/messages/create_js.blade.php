// <script type="text/javascript"> {{-- Keep this line to have syntax highlight in IDE --}}

$('#create_message_link').hide().after({!! json_encode(render_view("messages._form", compact('message'))) !!});

// </script>{{-- Keep this line to have syntax highlight in IDE --}}
