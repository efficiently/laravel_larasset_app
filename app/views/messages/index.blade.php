@section('content')
    <h1>All messages:</h1>
    <div id="messages">
        {{-- renders app/views/messages/_message.blade.php for each message --}}
        @foreach ($messages as $message)
            @include('messages._message')
        @endforeach
    </div>

    <h2>Add a message</h2>
    <?php $message = App::make('Message'); ?>
    @include('messages/_form')
@stop