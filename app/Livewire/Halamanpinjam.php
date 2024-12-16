<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\Member;
use Livewire\Component;
use App\Models\Pinjam;

class Halamanpinjam extends Component
{
    public $menuProses;
    public $buku_id;
    public $member_id;
    public $tanggal_pinjam;
    public $tanggal_kembali;
    public $pinjam_edit;
    public $cari;
    public $member_nama;
    public $semuabuku;

    public function tambahPinjam() {
        $this->menuProses = 'tambahPinjam';
    }

    public function cariSiswa() {
        $hasilcari = Member::where('nim', $this->cari)->first();
        if ($hasilcari) {
            $this->member_id = $hasilcari->id;
            $this->member_nama = $hasilcari->nama;
            $this->semuabuku = Buku::all();
        } else {
            $this->member_id = '';
        }
    }

    public function simpan() {
        if ($this->pinjam_edit) {
            $simpan = $this->pinjam_edit;
        } else {
            $simpan = new Pinjam();
        }
        
        $buku = Buku::find($this->buku_id);
    
        if ($buku->jumlah > 0) { // Pastikan stok cukup
            $simpan->buku_id = $this->buku_id;
            $simpan->member_id = $this->member_id;
            $simpan->tanggal_pinjam = now();
            $simpan->tanggal_kembali = now()->addDays(7);
            $simpan->save();
    
            // Kurangi stok buku
            $buku->jumlah -= 1;
            $buku->save();
    
            $this->reset();
            session()->flash('success', 'Peminjaman buku berhasil.');
        } else {
            session()->flash('error', 'Jumlah buku tidak mencukupi.');
        }
    }
    
    public function status($id) {
        $status = Pinjam::find($id);
        
        if ($status) {
            if ($status->status === 'Dikembalikan') {
                // Jika sudah dikembalikan, jangan tambahkan stok lagi
                session()->flash('error', 'Status sudah dikembalikan sebelumnya.');
                return;
            }
            
            $status->status = 'Dikembalikan';
            $status->save(); 
    
            // Tambah stok buku
            $buku = Buku::find($status->buku_id);
            if ($buku) {
                $buku->jumlah += 1;
                $buku->save();
            }
        } else {
            session()->flash('error', 'Data peminjaman tidak ditemukan.');
        }
    }

    public function edit($id) {
        $this->pinjam_edit = Pinjam::find($id);
        $this->semuabuku = Buku::all();
        $this->buku_id = $this->pinjam_edit->buku_id;
        $this->cari = $this->pinjam_edit->member->nim;
        $this->member_id = $this->pinjam_edit->member_id;
        $this->tanggal_pinjam = $this->pinjam_edit->tanggal_pinjam;
        $this->tanggal_kembali = $this->pinjam_edit->tanggal_kembali;
        $this->menuProses = 'editPinjam';
        session()->flash('success', 'Data peminjaman berhasil diperbaharui.');
    }

    public function hapus($id) {
        Pinjam::destroy($id);
    }

    public function render()
    {
        return view('livewire.halamanpinjam')->with([
            'semuapinjam' => Pinjam::all()
        ]);
    }
}
