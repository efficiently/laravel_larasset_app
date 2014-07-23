@section('content')
    <h1>All messages:</h1>
    <div id="messages">
        {{-- renders app/views/messages/_message.blade.php for each message --}}
        @foreach ($messages as $message)
            @include('messages._message')
        @endforeach
    </div>

    {{ link_to(route('messages.create'), 'Add a message', ['id' => 'new_link', 'data-remote' => true]) }}
@stop