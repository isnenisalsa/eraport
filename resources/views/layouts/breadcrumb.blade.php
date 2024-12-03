<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 d-flex align-items-center">
                @if ($breadcrumb->title !== 'DASHBOARD')
                    <a href="{{ url()->previous() }}" class="btn btn-link">
                        <i class="fas fa-solid fa-chevron-left fa-2x"></i>
                    </a>
                @endif
                <h1 class="mb-0">{{ $breadcrumb->title }}</h1>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show position-absolute"
            style="top: 90px; right: 10px; z-index: 9999; animation: fadeOut 3s forwards;" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</section>
