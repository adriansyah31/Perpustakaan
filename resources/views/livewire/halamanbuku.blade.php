<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ __('Buku') }}</div>
    
                    <div class="card-body">
                        <a href="/buku" class="btn btn-primary">Buku</a>
                        <a href="/home" class="btn btn-warning">Dashboard</a>
                        <hr />
                        <button class="btn btn-primary" wire:click="tambahBuku">Tambah Buku</button>
                        <i wire:loading>Loading . . .</i>
                        <br>
                        @if ($menuProses == 'tambahBuku' || $menuProses == 'editBuku')
                            <form wire:submit="simpan">
                                <div class="form-group">
                                    <label for="judul">Judul Buku</label>
                                    <input type="text" class="form-control" id="judul" wire:model="judul">
                                </div>
                                <div class="form-group">
                                    <label for="penulis">Penulis</label>
                                    <input type="text" class="form-control" id="penulis" wire:model="penulis">
                                </div>
                                <div class="form-group">
                                    <label for="penerbit">Penerbit</label>
                                    <input type="text" class="form-control" id="penerbit" wire:model="penerbit">
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun Terbit</label>
                                    <input type="text" class="form-control" id="tahun" wire:model="tahun">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Buku</label>
                                    <input type="text" class="form-control" id="jumlah" wire:model="jumlah">
                                </div>
                                <br>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </form>
                        @endif
                        <hr />
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Jumlah Buku</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <body>
                                @foreach ($semuabuku as $buku)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $buku->judul }}</td>
                                        <td>{{ $buku->penulis }}</td>
                                        <td>{{ $buku->penerbit }}</td>
                                        <td>{{ $buku->tahun }}</td>
                                        <td>{{ $buku->jumlah }}</td>
                                        <td>
                                            <button class="btn btn-warning" wire:click="edit({{ $buku->id }})">Edit</button>
                                            <button class="btn btn-danger" wire:click="hapus({{ $buku->id }})" wire:confirm="Apakah Anda Yakin Menghapus Buku ?">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </body>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
 