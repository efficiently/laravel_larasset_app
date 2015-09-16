// <script type="text/javascript"> {{-- Keep this line to have syntax highlight in IDE --}}

$('#{{ dom_id($message) }}').remove();
Turbolinks.replace({!! json_encode(render_view('_flash')) !!}, {change: 'flash'});

// </script>{{-- Keep this line to have syntax highlight in IDE --}}
