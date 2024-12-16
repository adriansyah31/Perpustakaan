<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ __('Pinjam Buku') }}</div>
    
                    <div class="card-body">
                        <a href="/pinjam" class="btn btn-primary">Pinjam</a>
                        <a href="/home" class="btn btn-warning">Dashboard</a>
                        <hr />
                        <button class="btn btn-primary" wire:click="tambahPinjam">Tambah Peminjaman Buku</button>
                        <i wire:loading>Loading . . .</i>
                        <br>
                        @if ($menuProses == 'tambahPinjam' || $menuProses == 'editPinjam')
                            <div class="form-control">
                                <input type="text" wire:model="cari" class="form-control" placeholder="NIM Mahasiswa"> 
                                <br>
                                <button class="btn btn-primary" wire:click="cariSiswa">Cari</button>
                            </div>
                            @if ($member_id)
                                Hai <h4>{{ $member_nama }}</h4>, Mau pinjam buku apa ?
                                <hr>
                                <select wire:model="buku_id" class="form-control">
                                    <option value="">Pilih Buku</option>
                                    @foreach ($semuabuku as $buku)
                                        <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <button class="btn btn-warning" wire:click="simpan">Simpan</button>
                            @endif
                        @endif
                        <hr />
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <body>
                                @foreach ($semuapinjam as $pinjam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pinjam->member->nama }}</td>
                                        <td>{{ $pinjam->buku->judul }}</td>
                                        <td>{{ $pinjam->tanggal_pinjam }}</td>
                                        <td>{{ $pinjam->tanggal_kembali }}</td>
                                        <td>{{ $pinjam->status }}</td>
                                        <td>
                                            <button class="btn btn-warning" wire:click="edit({{ $pinjam->id }})">Edit</button>
                                            <button class="btn btn-danger" wire:click="hapus({{ $pinjam->id }})" wire:confirm="Apakah Anda Yakin Menghapus Buku ?">Hapus</button>
                                            <button class="btn btn-success" wire:click="status({{ $pinjam->id }})">Status</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </body>
                            @if (session()->has('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            @if (session()->has('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
 