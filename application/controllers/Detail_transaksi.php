<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_dtransaksi');
        $this->load->model('M_transaksi');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $menu_filter = $this->input->get('menu');
        $data = [
            'detail_transaksi' => $menu_filter
                ? $this->M_dtransaksi->getDetailTransaksiByMenu($menu_filter)
                : $this->M_dtransaksi->getAllDetailTransaksi(),
            'menu' => $this->M_dtransaksi->get_all_menu(),
            'total_detail_transaksi' => $this->M_dtransaksi->getTotalDetailTransaksi()
        ];

        $this->load->view('detail_transaksi/index', $data);
    }

    public function tambah()
    {
        $this->loadViewForAddOrEdit();
    }

    public function aksi_tambah()
    {
        $this->setValidationRules();

        if ($this->form_validation->run() === true) {
            $data = $this->collectFormData();
            if (empty($data['id_detail'])) {
                $data['id_detail'] = $this->generateDetailTransactionID();
            }

            if ($this->M_dtransaksi->insertDetailTransaksi($data)) {
                $this->syncTransactionStatus($data['id_trans']);
                $this->session->set_flashdata('success', 'Detail transaksi berhasil ditambahkan.');
                redirect('detail_transaksi');
            } else {
                $this->loadViewForAddOrEdit(['error' => 'Gagal menambahkan detail transaksi.']);
            }
        } else {
            $this->loadViewForAddOrEdit();
        }
    }


    public function edit($id_detail)
    {
        $data['detail'] = $this->M_dtransaksi->getDetailById($id_detail);
        if (empty($data['detail'])) {
            show_404();
        }
        $this->loadViewForAddOrEdit($data);
    }

    public function aksi_edit()
    {
        $id_detail = $this->input->post('id_detail');
        $this->setValidationRules();

        if ($this->form_validation->run() === true) {
            $data = $this->collectFormData();
            $data['id_detail'] = $id_detail;

            if ($this->M_dtransaksi->updateDetailTransaksi($id_detail, $data)) {
                $this->syncTransactionStatus($data['id_trans']);
                $this->session->set_flashdata('success', 'Detail transaksi berhasil diperbarui.');
                redirect('detail_transaksi');
            } else {
                $this->loadViewForAddOrEdit(['error' => 'Gagal memperbarui detail transaksi.', 'detail' => $data]);
            }
        } else {
            $data['detail'] = $this->M_dtransaksi->getDetailById($id_detail);
            $this->loadViewForAddOrEdit($data);
        }
    }

    public function delete($id_detail)
    {
        $detail = $this->M_dtransaksi->getDetailById($id_detail);
        if ($this->M_dtransaksi->deleteDetailTransaksi($id_detail)) {
            $this->syncTransactionStatus($detail['id_trans']);
            $this->session->set_flashdata('success', 'Detail transaksi berhasil dihapus.');
            redirect('detail_transaksi');
        } else {
            show_error('Gagal menghapus detail transaksi.');
        }
    }

    private function loadViewForAddOrEdit($data = [])
    {
        $data = array_merge($data, [
            'menu' => $this->M_dtransaksi->get_all_menu(),
            'karyawan' => $this->M_dtransaksi->get_all_karyawan(),
            'detail' => $data['detail'] ?? [
                'id_detail' => '',
                'id_trans' => '',
                'id_menu' => '',
                'kuantitas' => '',
                'harga' => '',
                'subtotal' => '',
                'trans_masuk' => '',
                'trans_ambil' => '',
                'id_karyawan' => '',
                'no_hp_cus' => '',
                'pembayaran' => '',
                'status_pembayaran' => '',
            ]
        ]);

        $this->load->view('detail_transaksi/' . (empty($data['detail']['id_detail']) ? 'tambah' : 'edit'), $data);
    }

    private function setValidationRules()
    {
        $this->form_validation->set_rules('id_detail', 'ID Detail Transaksi', 'required');
        $this->form_validation->set_rules('id_trans', 'ID Transaksi', 'required');
        $this->form_validation->set_rules('id_menu', 'Menu', 'required');
        $this->form_validation->set_rules('kuantitas', 'Kuantitas', 'required|numeric');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('trans_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('trans_ambil', 'Tanggal Ambil', 'required');
        $this->form_validation->set_rules('no_hp_cus', 'No HP Customer', 'required|numeric');
        $this->form_validation->set_rules('pembayaran', 'Pembayaran', 'required|numeric');
        $this->form_validation->set_rules('status_pembayaran', 'Status Pembayaran', 'required');
    }

    private function collectFormData()
    {
        return [
            'id_detail' => $this->input->post('id_detail') ?: null, // Null jika kosong, akan di-generate
            'id_trans' => $this->input->post('id_trans'),
            'id_menu' => $this->input->post('id_menu'),
            'kuantitas' => $this->input->post('kuantitas'),
            'harga' => $this->input->post('harga'),
            'subtotal' => $this->input->post('kuantitas') * $this->input->post('harga'),
            'trans_masuk' => $this->input->post('trans_masuk'),
            'trans_ambil' => $this->input->post('trans_ambil'),
            'id_karyawan' => $this->input->post('id_karyawan'),
            'no_hp_cus' => $this->input->post('no_hp_cus'),
            'pembayaran' => $this->input->post('pembayaran'),
            'status_pembayaran' => $this->input->post('status_pembayaran'),
        ];
    }


    private function syncTransactionStatus($id_trans)
    {
        $total_payment = $this->M_dtransaksi->getTotalPaymentByTransaction($id_trans);
        $status_payment = $this->M_dtransaksi->getPaymentStatusByTransaction($id_trans);

        $this->M_transaksi->updatePembayaranTransaksi($id_trans, $total_payment, $status_payment);
    }

    private function generateDetailTransactionID()
    {
        $timestamp = time();
        $random = rand(100, 999);
        return "DT-{$timestamp}-{$random}";
    }

}
?>