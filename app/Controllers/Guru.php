<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Guru;

class Guru extends Controller
{
    public function __construct()
    {
        $this->model = new M_Guru;
        helper('sn');
        $this->session = service('session');
        $this->auth = service('authentication');
        $this->pager = \Config\Services::pager();
    }

    public function index()
    {
        // pengecekan jika belum login
        if (!$this->auth->check()) {
            $redirectURL = session('redirect_url') ?? '/login';
            unset($_SESSION['redirect_url']);

            return redirect()->to($redirectURL);
        }

        $data = [
            'tajuk' => 'Data Guru',
            /* 'guru' => $this->model->getAllData() */
            'guru' => $this->model->paginate('10', 'guru'),
            'pager' => $this->model->pager
        ];
        // load view
        tampilan('guru/index', $data);
    }

    public function tambah()
    {
        //jika belum login, tak boleh masuk
		if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? '/login';
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
        }
        
        if (isset($_POST['tambah'])) {
            $val = $this->validate([
                'gambar' => 'uploaded[gambar]',
                'max_size[gambar, 4096]',
                'mime_in[gambar,image/jpg,image/png,image/JPG,image/jepg]',
                
                'nip' => [
                    'label' => 'Nombor Matrik Guru',
                    'rules' => 'required|max_length[12]|is_unique[guru.nip]',
                    'errors' => [
                        'required' => '{field} Wajib Diisi.' ,
                        'is_unique' => '{field} Sudah Wujud'
                        ]
                ],
                'nama' => [
                    'label' => 'Nama Guru',
                    'rules' => 'required|max_length[64]',
                    'errors' => [
                        'required' => '{field} Wajib Diisi.'
                        ]
                ],
            ]);

            if (!$val)
            {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data = [
                    'tajuk' => 'Data guru',
                    'guru' => $this->model->getAllData()
                ];

                //load view
                tampilan('guru/index', $data);
            } 
            else
            {
                $file = $this->request->getFile('gambar');
                $namaBaru = $file->getRandomName();
                $file->move('./assets/img/profile', $namaBaru);
                $data = [
                    'gambar' => $namaBaru,
                    'nip' => $this->request->getPost('nip'),
                    'nama' => $this->request->getPost('nama')
                ];
        
                //insert data
                $success = $this->model->tambah($data);
                if($success)
                {
                    session()->setFlashdata('message', 'Ditambah');
                    return redirect()->to(base_url('/guru'));
                }
            }
        } else {
            return redirect()->to(base_url('/guru'));
        }         
    }

    public function hapus($id)
    {
        //jika belum login, tak boleh masuk
		if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? '/login';
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
        }
        $data = [
            'guru' => $this->model->getAllData($id)
        ];

        //hapus data
        $success = $this->model->hapus($id);

        //hapus gambar
        //hapus gambar asal jika nama file tidak sama dengan gambar default
        $img = $data['guru']['gambar'];
        if ($img != 'default.png') {
            //unlink(FCPATH . 'assets/img/profile/' . $img);
            chmod('assets/img/profile/' . $img, 777);
        }
                
        session()->setFlashdata('message', 'Dibuang');
        return redirect()->to(base_url('/guru'));
                
    }
}
