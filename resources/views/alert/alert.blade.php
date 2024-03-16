<div class="toast-container position-fixed bottom-0 end-0 p-3 toast-index toast-rtl">
    <div class="toast hide toast fade" id="liveToast1" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex justify-content-between alert-{{ session('succ')?'success':'danger' }}">
            <div class="toast-body">
                @if (session('succ'))
                    {{ session('succ') }}
                @endif

                @if (session('err'))
                    {{ session('err') }}
                @endif
            </div>
            <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
</div>
