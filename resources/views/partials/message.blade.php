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
    @elseif (session('edit'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div id="liveToast" class="toast show text-bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">Notification</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
         {{session('edit')}}
        </div>
      </div>
    </div>
    @elseif (session('delete'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
      <div id="liveToast" class="toast show text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">Notification</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
         {{session('delete')}}
        </div>
      </div>
    </div>
@endif