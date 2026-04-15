<form action="{{ route('produk.update', $produk->id) }}" method="POST" id="frmProduk">
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
                class="form-control" placeholder="Kode Produk">
        </div>
    </div>
    <div class="row">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-tag">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    <path
                        d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" />
                </svg>
            </span>
            <input type="text" name="nama_produk" id="nama_produk" value="{{ $produk->nama_produk }}"
                class="form-control" placeholder="Nama Produk">
        </div>
    </div>
    <div class="row">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-shirt-sport">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M15 4l6 2v5h-3v8a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1v-8h-3v-5l6 -2a3 3 0 0 0 6 0" />
                    <path d="M10.5 11h2.5l-1.5 5" />
                </svg>
            </span>
            <input type="text" name="jenis" id="jenis" value="{{ $produk->jenis }}" class="form-control"
                placeholder="Jenis">
        </div>
    </div>
    <div class="row">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-palette">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" />
                    <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                </svg>
            </span>
            <input type="text" name="warna" id="warna" value="{{ $produk->warna }}" class="form-control"
                placeholder="Warna">
        </div>
    </div>
    <div class="row">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-dimensions">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 5h11" />
                    <path d="M12 7l2 -2l-2 -2" />
                    <path d="M5 3l-2 2l2 2" />
                    <path d="M19 10v11" />
                    <path d="M17 19l2 2l2 -2" />
                    <path d="M21 12l-2 -2l-2 2" />
                    <path d="M3 10m0 2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2z" />
                </svg>
            </span>
            <input type="text" name="ukuran" id="ukuran" value="{{ $produk->ukuran }}" class="form-control"
                placeholder="Ukuran">
        </div>
    </div>
    <div class="row">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                    <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" />
                </svg>
            </span>
            <input type="number" name="harga" id="harga" value="{{ $produk->harga }}" class="form-control"
                placeholder="Harga">
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
