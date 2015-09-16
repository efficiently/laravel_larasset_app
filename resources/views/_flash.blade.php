<div id="flash" data-turbolinks-temporary>
  {{-- check for flash notification messages --}}
  @foreach (['info', 'success', 'warning', 'danger'] as $level)
    <?php $sessionLevel = $level === 'danger' ? 'error' : $level; // 'danger' means 'error' for Bootstrap ?>
    {!!
        Alert::{$level}(Session::get($sessionLevel))->withAttributes([
          'data-alert' => 'alert',
          'class' => (Session::has($sessionLevel)) ? 'fade in' : 'fade in hidden'
        ])->close()
    !!}
    <?php Session::forget($sessionLevel); ?>
  @endforeach
</div>
