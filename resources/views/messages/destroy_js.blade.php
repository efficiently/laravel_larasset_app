// <script type="text/javascript"> {{-- Keep this line to have syntax highlight in IDE --}}

$('#{{ dom_id($message) }}').remove();
$('#flash').replaceWith({!! json_encode(render_view('_flash')) !!});

// </script>{{-- Keep this line to have syntax highlight in IDE --}}
