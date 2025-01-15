<?php
class M_dtransaksi extends CI_Model
{
    public function getAllDetailTransaksi()
    {
        $this->db->select('detail_transaksi.*, transaksi.id_trans, menu.nama_menu, karyawan.nama_karyawan');
        $this->db->from('detail_transaksi');
        $this->db->join('transaksi', 'transaksi.id_trans = detail_transaksi.id_trans');
        $this->db->join('menu', 'menu.id_menu = detail_transaksi.id_menu');
        $this->db->join('karyawan', 'karyawan.id_karyawan = detail_transaksi.id_karyawan');
        $this->db->order_by('detail_transaksi.id_detail', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_all_menu()
    {
        return $this->db->get('menu')->result_array();
    }

    public function get_all_karyawan()
    {
        return $this->db->get('karyawan')->result_array();
    }

    public function insertDetailTransaksi($data)
    {
        return $this->db->insert('detail_transaksi', $data);
    }

    public function getDetailById($id_detail)
    {
        $this->db->select('detail_transaksi.*, transaksi.id_trans, menu.nama_menu, karyawan.nama_karyawan');
        $this->db->from('detail_transaksi');
        $this->db->join('transaksi', 'transaksi.id_trans = detail_transaksi.id_trans');
        $this->db->join('menu', 'menu.id_menu = detail_transaksi.id_menu');
        $this->db->join('karyawan', 'karyawan.id_karyawan = detail_transaksi.id_karyawan');
        $this->db->where('detail_transaksi.id_detail', $id_detail);
        return $this->db->get()->row_array();
    }

    public function updateDetailTransaksi($id_detail, $data)
    {
        $this->db->where('id_detail', $id_detail);
        return $this->db->update('detail_transaksi', $data);
    }

    public function deleteDetailTransaksi($id_detail)
    {
        $this->db->where('id_detail', $id_detail);
        return $this->db->delete('detail_transaksi');
    }

    public function getTotalDetailTransaksi()
    {
        return $this->db->count_all('detail_transaksi');
    }

    public function getTotalPaymentByTransaction($id_trans)
    {
        $this->db->select_sum('pembayaran');
        $this->db->where('id_trans', $id_trans);
        $query = $this->db->get('detail_transaksi');
        return $query->row()->pembayaran ?? 0;
    }

    public function getPaymentStatusByTransaction($id_trans)
    {
        $this->db->select('status_pembayaran');
        $this->db->where('id_trans', $id_trans);
        $this->db->group_by('status_pembayaran');
        $statuses = $this->db->get('detail_transaksi')->result_array();

        if (count($statuses) === 1) {
            return $statuses[0]['status_pembayaran'];
        }
        return 'partial';
    }
}

class M_transaksi extends CI_Model
{
    public function updatePembayaranTransaksi($id_trans, $total_payment, $status_payment)
    {
        $this->db->set('pembayaran', $total_payment);
        $this->db->set('status_pembayaran', $status_payment);
        $this->db->where('id_trans', $id_trans);
        return $this->db->update('transaksi');
    }
}
?>