<form action="{{ route('produk.update', $produk->id) }}" method="POST" id="frmProduk" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    <path d="M7 17l0 .01" />
                    <path d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    <path d="M7 7l0 .01" />
                    <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    <path d="M17 7l0 .01" />
                    <path d="M14 14l3 0" />
                    <path d="M20 14l0 .01" />
                    <path d="M14 14l0 3" />
                    <path d="M14 20l3 0" />
                    <path d="M17 17l3 0" />
                    <path d="M20 17l0 3" />
                </svg>
            </span>
            <input type="text" name="kode_produk" id="kode_produk" value="{{ $produk->kode_produk }}"
                class="form-control" placeholder="Kode Produk" readonly>
        </div>
    </div>
    <div class="row">
        <div class="mb-3">
            <label>Foto Produk</label><br>
            <img src="{{ asset('foto/' . $produk->foto_produk) }}" width="100" class="mb-2">

            <input type="file" name="foto_produk" id="edit_foto" class="form-control">

            <img id="preview_edit_foto" width="100" style="display:none; margin-top:10px;">
        </div>
    </div>
    <div class="row">
        <div class="mb-3">
            <label>Spik Produk</label><br>
            <img src="{{ asset('foto/' . $produk->spik_produk) }}" width="100" class="mb-2">

            <input type="file" name="spik_produk" id="edit_spik" class="form-control">

            <img id="preview_edit_spik" width="100" style="display:none; margin-top:10px;">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <div class="form-selectgroup form-selectgroup-pills">

            <label class="form-selectgroup-item">
                <input type="radio" name="keterangan" value="aktif" class="form-selectgroup-input"
                    {{ $produk->keterangan == 'aktif' ? 'checked' : '' }}>
                <span class="form-selectgroup-label">Aktif</span>
            </label>

            <label class="form-selectgroup-item">
                <input type="radio" name="keterangan" value="tidak_aktif" class="form-selectgroup-input"
                    {{ $produk->keterangan == 'tidak_aktif' ? 'checked' : '' }}>
                <span class="form-selectgroup-label">Tidak Aktif</span>
            </label>

        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="form form-group">
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </div>
        </div>
    </div>
</form>
