<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ __('Member') }}</div>
    
                    <div class="card-body">
                        <a href="/member" class="btn btn-primary">Member</a>
                        <a href="/home" class="btn btn-warning">Dashboard</a>
                        <hr />
                        <button class="btn btn-primary" wire:click="tambahMember">Tambah Member</button>
                        <i wire:loading>Loading . . .</i>
                        <br>
                        @if ($menuProses == 'tambahMember' || $menuProses == 'editMember')
                            <form wire:submit="simpan">
                                <div class="form-group">
                                    <label for="nama">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" id="nama" wire:model="nama">
                                </div>
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control" id="nim" wire:model="nim">
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
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <body>
                                @foreach ($semuamember as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $member->nama }}</td>
                                        <td>{{ $member->nim }}</td>
                                        <td>
                                            <button class="btn btn-warning" wire:click="edit({{ $member->id }})">Edit</button>
                                            <button class="btn btn-danger" wire:click="hapus({{ $member->id }})" wire:confirm="Apakah Anda Yakin Menghapus Buku ?">Hapus</button>
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
 