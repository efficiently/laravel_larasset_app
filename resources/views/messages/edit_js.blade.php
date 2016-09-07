// <script type="text/javascript"> {{-- Keep this line to have syntax highlight in IDE --}}

$('#{{ dom_id($message) }}').replaceWith({!! json_encode(render_view('messages._form', compact('message'))) !!});

// </script>{{-- Keep this line to have syntax highlight in IDE --}}
