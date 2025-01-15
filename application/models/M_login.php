<?php
class M_login extends CI_Model
{
    public function cek_karyawan($nama_karyawan, $id_karyawan)
    {
        $this->db->where('nama_karyawan', $nama_karyawan);
        $this->db->where('id_karyawan', $id_karyawan);

        $query = $this->db->get('karyawan');

        return $query->row();
    }
}
