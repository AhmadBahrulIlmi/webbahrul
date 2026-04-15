<form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" id="frmTransaksi">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="mb-2">
            <select name="produk_id" id="produk_id" class="form-select mb-2">
                <option value="" disabled {{ $transaksi->produk_id ? '' : 'selected' }}>Pilih Produk</option>
                @foreach ($produk as $d)
                    <option value="{{ $d->id }}" {{ $d->id == $transaksi->produk_id ? 'selected' : '' }}>
                        {{ $d->nama_produk }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-category-plus">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3h6m-3 -3v6" />
                </svg>
            </span>
            <input type="number" name="jumlah" id="jumlah" value="{{ $transaksi->jumlah }}" class="form-control"
                placeholder="Jumlah">
        </div>
    </div>
    <div class="row">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-plus">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5" />
                    <path d="M16 3v4" />
                    <path d="M8 3v4" />
                    <path d="M4 11h16" />
                    <path d="M16 19h6" />
                    <path d="M19 16v6" />
                </svg>
            </span>
            <input type="date" name="tanggal" id="tanggal" value="{{ $transaksi->tanggal }}" class="form-control"
                placeholder="Tanggal">
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
