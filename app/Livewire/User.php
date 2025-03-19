<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as ModelUser;
class User extends Component
{


    public $pilihanMenu = 'lihat'; // Nilai default

    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function render()
    {
        return view(view: 'livewire.user')->with(key: ['semuaPengguna' => ModelUser::all()]);
    }
public $nama, $email, $password, $peran;

public function simpan(): void
{
    $this->validate([
        'nama' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'peran' => 'required',
    ], [
        'nama.required' => 'Nama harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',
        'password.required' => 'Password harus diisi.',
        'peran.required' => 'Peran harus dipilih.',
    ]);

    $simpan = new ModelUser();
    $simpan->name = $this->nama;
    $simpan->email = $this->email;
    $simpan->password = bcrypt($this->password);
    $simpan->role = $this->peran;
    $simpan->save();

    $this->reset(['nama', 'email', 'password', 'peran']);
    $this->pilihMenu('lihat');
}
public $penggunaTerpilih;

public function pilihHapus($id): void
{
    $this->penggunaTerpilih = ModelUser::findOrFail($id);
    $this->pilihanMenu = 'hapus';
}

public function hapus(): void
{
    $this->penggunaTerpilih->delete();
    $this->pilihMenu('lihat');
}

public function batal(): void
{
    $this->reset();
}


public function pilihEdit($id)
{
    $this->penggunaTerpilih = ModelUser::findOrFail($id);
    $this->nama = $this->penggunaTerpilih->name;
    $this->email = $this->penggunaTerpilih->email;
    $this->peran = $this->penggunaTerpilih->role;
    $this->pilihanMenu = 'edit';
}


public function simpanEdit()
{
    $this->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'password' => 'nullable|min:6',
        'peran' => 'required',
    ]);

    $this->penggunaTerpilih->name = $this->nama;
    $this->penggunaTerpilih->email = $this->email;
    $this->penggunaTerpilih->role = $this->peran;

    // Hanya update password jika diisi
    if ($this->password) {
        $this->penggunaTerpilih->password = bcrypt($this->password);
    }

    $this->penggunaTerpilih->save();

    session()->flash('message', 'Pengguna berhasil diperbarui.');
    $this->pilihanMenu = 'lihat'; // Kembali ke daftar pengguna
}


}
