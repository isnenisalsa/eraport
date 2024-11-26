<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 d-flex align-items-center">
                @if ($breadcrumb->title !== 'DASHBOARD')
                    <button type="button" class="btn btn-link" onclick="history.back()">
                        <i class="fas fa-solid fa-chevron-left fa-2x"></i>
                    </button>
                @endif
                <h1 class="mb-0">{{ $breadcrumb->title }}</h1>
            </div>
        </div>
    </div>
</section>
