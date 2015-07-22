@section('content')
  <h1 class="page-header">All messages:</h1>
  <div id="messages">
    {{-- renders app/views/messages/_message.blade.php for each message --}}
    @foreach ($messages as $message)
      @include('messages._message')
    @endforeach

  <div id="create_message">
    @include('messages._create_link')
  </div>
@stop
