<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Member;

class Halamanmember extends Component
{
    public $menuProses;
    public $nama;
    public $nim;
    public $member_edit;

    public function tambahMember() {
        $this->menuProses = 'tambahMember';
    }

    public function simpan() {
        if($this->member_edit){
            $simpan = $this->member_edit;
        } else {
            $simpan = new Member();
        }
        $simpan->nama = $this->nama;
        $simpan->nim = $this->nim;
        $simpan->save();
        $this->reset();
    }

    public function edit($id) {
        $this->member_edit = Member::find($id);
        $this->nama = $this->member_edit->nama;
        $this->nim = $this->member_edit->nim;
        $this->menuProses = 'editMember';
    }

    public function hapus($id) {
        Member::destroy($id);
    }

    public function render()
    {
        return view('livewire.halamanmember')->with([
            'semuamember' => Member::all()
        ]);
    }
}
