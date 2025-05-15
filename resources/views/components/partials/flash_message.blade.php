<style>
  .border-red {
    --border-opacity: 1 !important;
    border-color: rgba(244, 101, 101, 1) !important;
    border-color:rgba(244, 101, 101, var(--border-opacity)) !important
  }
  .text-red {
    --text-opacity: 1!important;
    color: rgba(197,48,48,var(--text-opacity))!important;
  }
  
  .border-success {
    --border-opacity: 1 !important;
    border-color: rgba(56,178,172, 1) !important;
    border-color:rgba(56,178,172,var(--border-opacity))!important
  }
  .text-success {
    --text-opacity: 1!important;
    color: rgba(35,78,82,var(--text-opacity))!important;
  }
</style>

@if ($message = Session::get('error'))
  <div class="border-l-4 border-red p-2 text-red" role="alert">
    <p>{!! $message !!} </p>
  </div>
  {{ session()->forget('error') }}
@endif

@if ($message = Session::get('success'))
  <div class="border-l-4 border-success p-2 text-success" role="alert">
    <p>{!! $message !!} </p>
  </div>
  {{ session()->forget('success') }}
@endif