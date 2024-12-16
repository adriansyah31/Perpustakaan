<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Buku;

class Halamanbuku extends Component
{
    public $menuProses;
    public $judul;
    public $penulis;
    public $penerbit;
    public $tahun;
    public $jumlah;
    public $buku_edit;

    public function tambahBuku() {
        $this->menuProses = 'tambahBuku';
    }

    public function simpan() {
        if($this->buku_edit){
            $simpan = $this->buku_edit;
        } else {
            $simpan = new Buku();
        }
        $simpan->judul = $this->judul;
        $simpan->penulis = $this->penulis;
        $simpan->penerbit = $this->penerbit;
        $simpan->tahun = $this->tahun;
        $simpan->jumlah = $this->jumlah;
        $simpan->save();
        $this->reset();
    }

    public function edit($id) {
        $this->buku_edit = Buku::find($id);
        $this->judul = $this->buku_edit->judul;
        $this->penulis = $this->buku_edit->penulis;
        $this->penerbit = $this->buku_edit->penerbit;
        $this->tahun = $this->buku_edit->tahun;
        $this->jumlah = $this->buku_edit->jumlah;
        $this->menuProses = 'editBuku';
    }

    public function hapus($id) {
        Buku::destroy($id);
    }

    public function render()
    {
        return view('livewire.halamanbuku')->with([
            'semuabuku' => Buku::all()
        ]);
    }
}
