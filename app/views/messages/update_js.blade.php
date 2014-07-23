// <script type="text/javascript"> {{-- Keep this line to have syntax highlight in IDE --}}

$('#{{{ form_id($message) }}}').replaceWith({{ json_encode(render_view('messages._message', compact('message'))) }});

// </script>{{-- Keep this line to have syntax highlight in IDE --}}