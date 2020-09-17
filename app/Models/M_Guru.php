<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Guru extends Model
{
    protected $table = 'guru';

    /* public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    } */

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->db->table('guru')->get()->getResultArray();
        } else {
            $this->db->table('guru')->where('id', $id);
            return $this->db->table('guru')->get()->getRowArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table('guru')->insert($data);
    }

    public function hapus($id)
    {
        return $this->db->table('guru')->delete(['id' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->db->table('guru')->update($data, ['id' => $id]);
    }
}
