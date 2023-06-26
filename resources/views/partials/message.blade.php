@if (session('message'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div id="liveToast" class="toast show text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">Notification</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
         {{session('message')}}
        </div>
      </div>
    </div>
    @elseif (session('edited'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div id="liveToast" class="toast show text-bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">Notification</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
         {{session('edited')}}
        </div>
      </div>
    </div>
    @elseif (session('problem'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div id="liveToast" class="toast show text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">Notification</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
         {{session('problem')}}
        </div>
      </div>
    </div>
@endif