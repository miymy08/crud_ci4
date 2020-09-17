<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Pelajar;

class Pelajar extends Controller
{
    public function __construct()
    {
        $this->session = service('session');
		$this->auth = service('authentication');
        $this->model = new M_Pelajar;
        helper('sn');
    }

    public function index()
    {
        /* $model = new M_Pelajar(); */
        //jika belum login, tak boleh masuk
		if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? '/login';
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
		}

        $data = [
            'tajuk' => 'Data Pelajar',
            'pelajar' => $this->model->getAllData()
        ];
        //load view
        tampilan('pelajar/index', $data);
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
                'matric_no' => [
                    'label' => 'Nombor Matrik Pelajar',
                    'rules' => 'required|max_length[12]|is_unique[pelajar.matric_no]',
                    'errors' => [
                        'required' => '{field} Wajib Diisi.' ,
                        'is_unique' => '{field} Sudah Wujud'
                        ]
                ],
                'nama' => [
                    'label' => 'Nama Pelajar',
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
                    'tajuk' => 'Data Pelajar',
                    'pelajar' => $this->model->getAllData()
                ];

                //load view
                tampilan('pelajar/index', $data);
            } 
            else
            {
                $data = [
                    'matric_no' => $this->request->getPost('matric_no'),
                    'nama' => $this->request->getPost('nama')
                ];
        
                //insert data
                $success = $this->model->tambah($data);
                if($success)
                {
                    session()->setFlashdata('message', 'Ditambah');
                    return redirect()->to(base_url('/pelajar'));
                }
            }
        } else {
            return redirect()->to(base_url('/pelajar'));
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
        
        $success = $this->model->hapus($id);
                
        session()->setFlashdata('message', 'Dibuang');
        return redirect()->to(base_url('/pelajar'));
                
    }

    public function ubah()
    {
        //jika belum login, tak boleh masuk
		if (!$this->auth->check())
		{
			$redirectURL = session('redirect_url') ?? '/login';
			unset($_SESSION['redirect_url']);

			return redirect()->to($redirectURL);
        }
        
        if (isset($_POST['ubah'])) {
            $id = $this->request->getPost('id');
            $matric_no = $this->request->getPost('matric_no');
            $db_matric_no = $this->model->getAllData($id)['matric_no'];

            if ($matric_no === $db_matric_no) 
            {
                $val = $this->validate([
                    'matric_no' => [
                        'label' => 'Nombor Matrik Pelajar',
                        'rules' => 'required|max_length[12]',
                        'errors' => [
                            'required' => '{field} Wajib Diisi.' ,
                            'is_unique' => '{field} Sudah Wujud'
                            ]
                    ],
                    'nama' => [
                        'label' => 'Nama Pelajar',
                        'rules' => 'required|max_length[64]',
                        'errors' => [
                            'required' => '{field} Wajib Diisi.'
                            ]
                    ],
                ]);

            }else{

                $val = $this->validate([
                    'matric_no' => [
                        'label' => 'Nombor Matrik Pelajar',
                        'rules' => 'required|max_length[12]|is_unique[pelajar.matric_no]',
                        'errors' => [
                            'required' => '{field} Wajib Diisi.' ,
                            'is_unique' => '{field} Sudah Wujud'
                            ]
                    ],
                    'nama' => [
                        'label' => 'Nama Pelajar',
                        'rules' => 'required|max_length[64]',
                        'errors' => [
                            'required' => '{field} Wajib Diisi.'
                            ]
                    ],
                ]);
            }

            if (!$val)
            {
                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data = [
                    'tajuk' => 'Data Pelajar',
                    'pelajar' => $this->model->getAllData()
                ];

                //load view
                tampilan('pelajar/index', $data);
            } 
            else
            {
                $id = $this->request->getPost('id');

                $data = [
                    'matric_no' => $this->request->getPost('matric_no'),
                    'nama' => $this->request->getPost('nama')
                ];
        
                //update data
                $success = $this->model->ubah($data, $id);
                if($success)
                {
                    session()->setFlashdata('message', 'Dikemaskini');
                    return redirect()->to(base_url('/pelajar'));
                }
            }
        } else {
            return redirect()->to(base_url('/pelajar'));
        }         
    }

    public function excel()
    {
        $data = [
            'pelajar' => $this->model->getAllData()
        ];

        echo view('pelajar/excel', $data);
    }
}












