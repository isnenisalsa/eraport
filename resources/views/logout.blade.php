<!-- Modal Hapus Data capel -->
<div class="modal fade" id="modal-logout" tabindex="-1" aria-labelledby="modal-logout" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-logout">Konfirmasi Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Seluruh sesi login akan dihapus.</b></p>
                <p>Apakah Anda yakin ingin logout?</p>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                <a type="button" class="btn btn-danger btn-sm" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </div>
</div>
