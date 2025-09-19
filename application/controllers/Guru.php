<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
	}

	public function index()
	{
		$guru_id = $this->session->userdata('guru_id');
		$data = array(
			'title' => 'GURU',
			'top_pelanggaran' => $this->m_admin->get_top5_pelanggaran(),
			'jumlahSiswa' => $this->m_admin->get_jumlah_siswa_per_kelas(),
			'jumlahPelanggaran' => $this->m_admin->get_jumlah_pelanggaran_per_kelas(),
			'dataPelanggaran' => $this->m_admin->get_all_dataPelanggaran(),
			'dataPengajuan' => $this->m_admin->all_pengajuan(),
			'dataKonseling' => $this->m_admin->guru_all_jadwal(),
			'totalKonseling' => $this->m_admin->total_pengajuan_konseling(),
			'totalJadwal' => $this->m_admin->total_jadwal(),
			'poinSemester' => $this->m_admin->get_poin_pelanggaran_per_semester(),
			'jenisPelanggaran' => $this->m_admin->getJumlahPelanggaranPerJenis(),
			'dataGuru' => $this->m_admin->get_id_guru($guru_id),
			'PassGuru' => $this->m_admin->get_pass_guru($guru_id),
			'isi'	=> 'guru/v_home'
		);
		$this->load->view('guru/layout/v_wrapper', $data, FALSE);
	}

	// Data Siswa
		public function dataSiswa($kelas)
		{
			$dataSiswa = $this->m_admin->get_kelas_siswa($kelas);

			$data = array(
				'title'         => 'DATA SISWA KELAS : ' .$kelas,
				'dataSiswa'     => $dataSiswa,
				'kelas'         => $kelas,
				'isi'           => 'guru/dataSiswa/data'
			);
			$this->load->view('guru/layout/v_wrapper', $data, FALSE);
		}
	// end

	// jadwal konseling
		public function jadwalKonseling() {
			$guru_id = $this->session->userdata('guru_id');
			$detail_guru = $this->m_admin->detail_guru($guru_id);
			$data = array(
				'title' => 'JADWAL KONSELING',
				'jadwalKonseling' => $this->m_admin->get_all_jadwal(),
				'detail_guru' => $detail_guru,
				'dataGuru' => $this->m_admin->get_all_guru(),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'guru/jadwalkonseling/data'
			);

			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function viewJadwalKonseling($jadwal_id) {
			$guru_id = $this->session->userdata('guru_id');
			$detail_guru = $this->m_admin->detail_guru($guru_id);
			$detailJadwalKonseling = $this->m_admin->detail_jadwalKonseling($jadwal_id);
			$data = array(
				'title' => 'DETAIL JADWAL KONSELING',
				'detailJadwalKonseling' => $detailJadwalKonseling,
				'detail_guru' => $detail_guru,
				'dataGuru' => $this->m_admin->get_all_guru(),
				'catatanKonseling' => $this->m_admin->detail_catatanKonseling($jadwal_id),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'guru/jadwalkonseling/detail'
			);

			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function tambahJadwalKonseling() {

			$guru_id = $this->session->userdata('guru_id');

			if (!$guru_id) {
				$this->session->set_flashdata('error', 'Siswa tidak ditemukan.');
				redirect('guru/jadwalKonseling');
			}

			$data = [
				'guru_id'  => $guru_id,
				'siswa_id' => $this->input->post('siswa_id'),
				'guru_id' => $this->input->post('guru_id'),
				'tanggal' => $this->input->post('tanggal'),
				'waktu' => $this->input->post('waktu'),
				'tempat' => $this->input->post('tempat'),
				'link_zoom' => $this->input->post('link_zoom'),
				'topik' => $this->input->post('topik')
			];
			$this->m_admin->insert_jadwal($data);
			$this->session->set_flashdata('success', 'Jadwal Konseling berhasil ditambahkan');
			redirect('guru/jadwalKonseling');
		}

		public function hapusJadwalKonseling($id) {
			$this->m_admin->delete_jadwalkonseling($id);
			$this->session->set_flashdata('success', 'Jadwal Konseling berhasil Dihapus');
			redirect('guru/jadwalKonseling');
		}

		public function update_statuskonseling($id, $status) {
			$this->m_admin->update_statuskonseling($id, $status);
			$this->session->set_flashdata('success', 'Status Konseling berhasil Diupdate');
			redirect('guru/jadwalKonseling');
		}

		public function updateJadwalKonseling($jadwal_id)
		{
			$data = array(
				'jadwal_id' => $jadwal_id,
				'tanggal' => $this->input->post('tanggal'),
				'waktu' => $this->input->post('waktu'),
				'tempat' => $this->input->post('tempat'),
				'topik' => $this->input->post('topik'),
				'link_zoom' => $this->input->post('link_zoom'),
				'updated_at' => date('Y-m-d H:i:s')
			);
			$this->m_admin->update_JadwalKonseling($data);
			$this->session->set_flashdata('success', 'Jadwal Konseling berhasil Diupdate');

			redirect('guru/viewJadwalKonseling/' .$jadwal_id);
		}

		public function catatanKonseling($jadwal_id)
		{
			$data = array(
				'jadwal_id' => $jadwal_id,
				'ringkasan_masalah' => $this->input->post('ringkasan_masalah'),
				'solusi' => $this->input->post('solusi'),
				'tanggal_catatan' => date('Y-m-d H:i:s')
			);
			$this->m_admin->insert_catatanKonseling($data);

			// Update status jadwal jadi 'selesai'
    		$this->m_admin->update_statusKonseling($jadwal_id, 'selesai');

			$this->session->set_flashdata('success', 'Catatan Konseling Berhasil Ditambahkan');

			redirect('guru/viewJadwalKonseling/' .$jadwal_id);
		}

		public function laporanJadwalKonseling()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$JadwalKonseling = $this->m_admin->view_all_JadwalKonseling(); 
				$url_cetak_JadwalKonseling = 'guru/cetakpdf_JadwalKonseling';
				$label = 'Semua Data Jadwal Konseling';
			}else{ // Jika terisi
				$JadwalKonseling = $this->m_admin->view_by_date_JadwalKonseling($tgl_awal, $tgl_akhir);  
				$url_cetak_JadwalKonseling = 'guru/cetakpdf_JadwalKonseling?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['JadwalKonseling'] = $JadwalKonseling;
			$data['url_cetak_JadwalKonseling'] = base_url('index.php/'.$url_cetak_JadwalKonseling);
			$data['label'] = $label;
			$data['title'] ='DATA JADWAL KONSELING';
			$data['isi'] = 'guru/jadwalkonseling/laporan';
			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function cekJadwalKonseling()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$JadwalKonseling = $this->m_admin->view_all_JadwalKonseling(); 
				$url_cetak_JadwalKonseling = 'guru/cetakpdf_JadwalKonseling';
				$label = 'Semua Data Jadwal Konseling';
			}else{ // Jika terisi
				$JadwalKonseling = $this->m_admin->view_by_date_JadwalKonseling($tgl_awal, $tgl_akhir);  
				$url_cetak_JadwalKonseling = 'guru/cetakpdf_JadwalKonseling?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['JadwalKonseling'] = $JadwalKonseling;
			$data['url_cetak_JadwalKonseling'] = base_url('index.php/'.$url_cetak_JadwalKonseling);
			$data['label'] = $label;
			$data['title'] ='DATA JADWAL KONSELING';
			$data['isi'] = 'guru/jadwalkonseling/cek';
			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function cetakpdf_JadwalKonseling(){
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'format' => [215, 330],
				'orientation' => $orientation,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_top' => 16,
				'margin_bottom' => 35,
				'margin_header' => 9,
				'margin_footer' => 9,
				]);

			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
				if(empty($tgl_awal) or empty($tgl_akhir)){
					$JadwalKonseling = $this->m_admin->view_all_JadwalKonseling();
					$label = 'SEMUA DATA JADWAL KONSELING';
				}else{ // Jika terisi
					$JadwalKonseling = $this->m_admin->view_by_date_JadwalKonseling($tgl_awal, $tgl_akhir);
					$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
					$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
					$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
				}

			$data['label'] = $label;
			$data['JadwalKonseling'] = $JadwalKonseling;
			$mpdf->SetTitle('Data Jadwal Konseling : ' .$label);
			$current_date = date('d-m-Y H:i:s');
			$mpdf->SetFooter('Dicetak pada: ' . $current_date);
			$data = $this->load->view('guru/jadwalkonseling/pdf', $data, TRUE);
			$mpdf->WriteHTML($data);
			$mpdf->Output();
		}
	// end

	// Pelanggaran Siswa
		public function pelanggaranSiswa() {
			$data = array(
				'title' => 'DATA PELANGGARAN SISWA',
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'dataPl' => $this->m_admin->get_pelanggaran_siswa(),
				'dataPelanggaran' => $this->m_admin->get_all_pelanggaran(),
				'pelanggaranSiswa' => $this->m_admin->get_all_pelanggaran(),
				'jumlahSiswa' => $this->m_admin->get_jumlah_siswa_per_kelas(),
				'isi' => 'guru/pelanggaransiswa/home'
			);

			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function datapelanggaranSiswa($kelas) {
			$data = array(
				'title' => 'DATA PELANGGARAN SISWA',
				'dataSiswa' => $this->m_admin->get_siswa_by_kelas($kelas),
				'dataPl' => $this->m_admin->get_pelanggaran_by_kelas($kelas),
				'dataPelanggaran' => $this->m_admin->get_all_pelanggaran(),
				'pelanggaranSiswa' => $this->m_admin->get_all_pelanggaran(),
				'jumlahSiswa' => $this->m_admin->get_jumlah_siswa_per_kelas(),
				'isi' => 'guru/pelanggaransiswa/data'
			);

			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function viewPelanggaranSiswa($siswa_id) {
			$detailSiswa = $this->m_admin->detail_siswa($siswa_id);
			$data = array(
				'title' => 'Pelanggaran Siswa : ' .$detailSiswa->nama_lengkap,
				'detailSiswa' => $detailSiswa,
				'pelanggaran' => $this->m_admin->detail_dataPelanggaran($siswa_id),
				'totalPoin' => $this->m_admin->poin_dataPelanggaranSiswa($siswa_id),
				'dataPelanggaran' => $this->m_admin->get_all_pelanggaran(),
				'isi' => 'guru/pelanggaransiswa/detail'
			);

			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function add_pelanggaranSiswa1()
		{
			$semester = $this->db->get_where('semester', ['status' => 1])->row();

			if (!$semester) {
				$this->session->set_flashdata('error', 'Tidak ada semester aktif. Silakan aktifkan semester terlebih dahulu.');
				redirect('guru/pelanggaranSiswa/');
				return;
			}

			$data = [
				'siswa_id'   => $this->input->post('siswa_id'),
				'jenis_id'   => $this->input->post('jenis_id'),
				'semester_id'=> $semester->semester_id,
				'tanggal'    => $this->input->post('tanggal'),
				'deskripsi'  => $this->input->post('deskripsi'),
				'lokasi'     => $this->input->post('lokasi'),
				'create_at'  => date('Y-m-d H:i:s')
			];

			$this->m_admin->insert_dataPelanggaranSiswa($data);
			$this->session->set_flashdata('success', 'Pelanggaran Siswa berhasil ditambahkan');
			redirect('guru/pelanggaranSiswa/');
		}

		public function add_pelanggaranSiswa2()
		{
			$semester = $this->db->get_where('semester', ['status' => 1])->row();

			if (!$semester) {
				$this->session->set_flashdata('error', 'Tidak ada semester aktif. Silakan aktifkan semester terlebih dahulu.');
				redirect('guru/pelanggaranSiswa/');
				return;
			}

			$data = [
				'siswa_id'   => $this->input->post('siswa_id'),
				'jenis_id'   => $this->input->post('jenis_id'),
				'semester_id'=> $semester->semester_id,
				'tanggal'    => $this->input->post('tanggal'),
				'deskripsi'  => $this->input->post('deskripsi'),
				'lokasi'     => $this->input->post('lokasi'),
				'create_at'  => date('Y-m-d H:i:s')
			];

			$this->m_admin->insert_dataPelanggaranSiswa($data);
			$this->session->set_flashdata('success', 'Pelanggaran Siswa berhasil ditambahkan');
			redirect('guru/pelanggaranSiswa/');
		}

		public function add_pelanggaranSiswa($siswa_id)
		{
			$semester = $this->db->get_where('semester', ['status' => 1])->row();

			if (!$semester) {
				$this->session->set_flashdata('error', 'Tidak ada semester aktif. Silakan aktifkan semester terlebih dahulu.');
				redirect('guru/viewPelanggaranSiswa/' . $siswa_id);
				return;
			}

			$data = [
				'siswa_id'   => $siswa_id,
				'jenis_id'   => $this->input->post('jenis_id'),
				'semester_id'=> $semester->semester_id,
				'tanggal'    => $this->input->post('tanggal'),
				'deskripsi'  => $this->input->post('deskripsi'),
				'lokasi'     => $this->input->post('lokasi'),
				'create_at'  => date('Y-m-d H:i:s')
			];

			$this->m_admin->insert_dataPelanggaranSiswa($data);
			$this->session->set_flashdata('success', 'Pelanggaran Siswa berhasil ditambahkan');
			redirect('guru/viewPelanggaranSiswa/' . $siswa_id);
		}

		public function update_pelanggaranSiswa($pelanggaran_id, $siswa_id) {
			$data = [
				'pelanggaran_id'=> $pelanggaran_id,
				'jenis_id' => $this->input->post('jenis_id'),
				'tanggal' => $this->input->post('tanggal'),
				'deskripsi' => $this->input->post('deskripsi'),
				'lokasi' => $this->input->post('lokasi'),
				'update_at' => date('Y-m-d H:i:s')
			];
			$this->m_admin->update_dataPelanggaranSiswa($data);
			$this->session->set_flashdata('success', 'Pelanggaran Siswa berhasil diupdate');
			redirect('guru/viewPelanggaranSiswa/' .$siswa_id);
		}

		public function hapuspelanggaranSiswa($pelanggaran_id, $siswa_id) {
			$this->m_admin->delete_pelanggaranSiswa($pelanggaran_id);
			$this->session->set_flashdata('success', 'Pelanggaran Siswa berhasil Dihapus');
			redirect('guru/viewPelanggaranSiswa/' .$siswa_id);
		}

		public function printSp1($siswa_id)
		{
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'format' => [215, 330],
				'orientation' => $orientation,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_top' => 16,
				'margin_bottom' => 35,
				'margin_header' => 9,
				'margin_footer' => 9,
				]);
			$detailSiswa = $this->m_admin->detail_siswa($siswa_id);
			$totalPoin = $this->m_admin->poin_dataPelanggaranSiswa($siswa_id);
			$data['totalPoin'] = $totalPoin;
			$data['detailSiswa'] = $detailSiswa;
			$data['pelanggaran'] = $this->m_admin->detail_dataPelanggaran($siswa_id);
			$mpdf->SetTitle('Cetak SP 1 Siswa : ' .$detailSiswa->nama_lengkap);
			$current_date = date('d-m-Y H:i:s');
			$mpdf->SetFooter('Dicetak pada: ' . $current_date);
			$data = $this->load->view('guru/pelanggaransiswa/sp1', $data, TRUE);
			$mpdf->WriteHTML($data);
			$mpdf->Output();
		}

		public function printSp2($siswa_id)
		{
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'format' => [215, 330],
				'orientation' => $orientation,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_top' => 16,
				'margin_bottom' => 35,
				'margin_header' => 9,
				'margin_footer' => 9,
				]);
			$detailSiswa = $this->m_admin->detail_siswa($siswa_id);
			$totalPoin = $this->m_admin->poin_dataPelanggaranSiswa($siswa_id);
			$data['totalPoin'] = $totalPoin;
			$data['detailSiswa'] = $detailSiswa;
			$data['pelanggaran'] = $this->m_admin->detail_dataPelanggaran($siswa_id);
			$mpdf->SetTitle('Cetak SP 2 Siswa : ' .$detailSiswa->nama_lengkap);
			$current_date = date('d-m-Y H:i:s');
			$mpdf->SetFooter('Dicetak pada: ' . $current_date);
			$data = $this->load->view('guru/pelanggaransiswa/sp2', $data, TRUE);
			$mpdf->WriteHTML($data);
			$mpdf->Output();
		}

		public function printSp3($siswa_id)
		{
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'format' => [215, 330],
				'orientation' => $orientation,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_top' => 16,
				'margin_bottom' => 35,
				'margin_header' => 9,
				'margin_footer' => 9,
				]);
			$detailSiswa = $this->m_admin->detail_siswa($siswa_id);
			$totalPoin = $this->m_admin->poin_dataPelanggaranSiswa($siswa_id);
			$data['totalPoin'] = $totalPoin;
			$data['detailSiswa'] = $detailSiswa;
			$data['pelanggaran'] = $this->m_admin->detail_dataPelanggaran($siswa_id);
			$mpdf->SetTitle('Cetak SP 3 Siswa : ' .$detailSiswa->nama_lengkap);
			$current_date = date('d-m-Y H:i:s');
			$mpdf->SetFooter('Dicetak pada: ' . $current_date);
			$data = $this->load->view('guru/pelanggaransiswa/sp3', $data, TRUE);
			$mpdf->WriteHTML($data);
			$mpdf->Output();
		}

		public function laporanPelanggaranSiswa()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$PelanggaranSiswa = $this->m_admin->view_all_PelanggaranSiswa(); 
				$url_cetak_PelanggaranSiswa = 'guru/cetakpdf_PelanggaranSiswa';
				$label = 'Semua Data Laporan Pelanggaran Siswa';
			}else{ // Jika terisi
				$PelanggaranSiswa = $this->m_admin->view_by_date_PelanggaranSiswa($tgl_awal, $tgl_akhir);  
				$url_cetak_PelanggaranSiswa = 'guru/cetakpdf_PelanggaranSiswa?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['PelanggaranSiswa'] = $PelanggaranSiswa;
			$data['url_cetak_PelanggaranSiswa'] = base_url('index.php/'.$url_cetak_PelanggaranSiswa);
			$data['label'] = $label;
			$data['title'] ='DATA PELANGGARAN SISWA';
			$data['isi'] = 'guru/pelanggaransiswa/laporan';
			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function cekPelanggaranSiswa()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$PelanggaranSiswa = $this->m_admin->view_all_PelanggaranSiswa(); 
				$url_cetak_PelanggaranSiswa = 'guru/cetakpdf_PelanggaranSiswa';
				$label = 'Semua Data Laporan Pelanggaran Siswa';
			}else{ // Jika terisi
				$PelanggaranSiswa = $this->m_admin->view_by_date_PelanggaranSiswa($tgl_awal, $tgl_akhir);  
				$url_cetak_PelanggaranSiswa = 'guru/cetakpdf_PelanggaranSiswa?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['PelanggaranSiswa'] = $PelanggaranSiswa;
			$data['url_cetak_PelanggaranSiswa'] = base_url('index.php/'.$url_cetak_PelanggaranSiswa);
			$data['label'] = $label;
			$data['title'] ='DATA PELANGGARAN SISWA';
			$data['isi'] = 'guru/pelanggaransiswa/cek';
			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function cetakpdf_PelanggaranSiswa(){
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'format' => [215, 330],
				'orientation' => $orientation,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_top' => 16,
				'margin_bottom' => 35,
				'margin_header' => 9,
				'margin_footer' => 9,
				]);

			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
				if(empty($tgl_awal) or empty($tgl_akhir)){
					$PelanggaranSiswa = $this->m_admin->view_all_PelanggaranSiswa();
					$label = 'SEMUA DATA PELANGGARAN SISWA';
				}else{ // Jika terisi
					$PelanggaranSiswa = $this->m_admin->view_by_date_PelanggaranSiswa($tgl_awal, $tgl_akhir);
					$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
					$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
					$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
				}

			$data['label'] = $label;
			$data['PelanggaranSiswa'] = $PelanggaranSiswa;
			$mpdf->SetTitle('Data Pelanggaran Siswa : ' .$label);
			$current_date = date('d-m-Y H:i:s');
			$mpdf->SetFooter('Dicetak pada: ' . $current_date);
			$data = $this->load->view('guru/pelanggaransiswa/pdf', $data, TRUE);
			$mpdf->WriteHTML($data);
			$mpdf->Output();
		}
	// end

	// pengajuan konseling
		public function pengajuanKonseling() {
			$data = array(
				'title' => 'PENGAJUAN KONSELING',
				'pengajuanKonseling' => $this->m_admin->get_all_pengajuan(),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'guru/pengajuankonseling/data'
			);

			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function viewPengajuanKonseling($pengajuan_id) {
			$detailPengajuanKonseling = $this->m_admin->detail_pengajuanKonseling($pengajuan_id);
			$data = array(
				'title' => 'DETAIL JADWAL KONSELING',
				'detailPengajuanKonseling' => $detailPengajuanKonseling,
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'guru/pengajuankonseling/detail'
			);

			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function updatePengajuanKonseling($pengajuan_id) {
			$data = [
				'pengajuan_id'=> $pengajuan_id,
				'status' => $this->input->post('status'),
				'catatan' => $this->input->post('catatan'),
				'tanggal_setuju' => date('Y-m-d H:i:s'),
				'update_at' => date('Y-m-d H:i:s')
			];
			$this->m_admin->update_pengajuanKonseling($data);
			$this->session->set_flashdata('success', 'Pelanggaran Siswa berhasil diupdate');
			redirect('guru/pengajuankonseling/' .$pengajuan_id);
		}

		public function laporanPengajuanKonseling()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$PengajuanKonseling = $this->m_admin->view_all_PengajuanKonseling(); 
				$url_cetak_PengajuanKonseling = 'guru/cetakpdf_PengajuanKonseling';
				$label = 'Semua Data Laporan Pengajuan Konseling';
			}else{ // Jika terisi
				$PengajuanKonseling = $this->m_admin->view_by_date_PengajuanKonseling($tgl_awal, $tgl_akhir);  
				$url_cetak_PengajuanKonseling = 'guru/cetakpdf_PengajuanKonseling?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['PengajuanKonseling'] = $PengajuanKonseling;
			$data['url_cetak_PengajuanKonseling'] = base_url('index.php/'.$url_cetak_PengajuanKonseling);
			$data['label'] = $label;
			$data['title'] ='DATA PENGAJUAN KONSELING SISWA';
			$data['isi'] = 'guru/pengajuankonseling/laporan';
			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function cekPengajuanKonseling()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$PengajuanKonseling = $this->m_admin->view_all_PengajuanKonseling(); 
				$url_cetak_PengajuanKonseling = 'guru/cetakpdf_PengajuanKonseling';
				$label = 'Semua Data Laporan Pengajuan Konseling';
			}else{ // Jika terisi
				$PengajuanKonseling = $this->m_admin->view_by_date_PengajuanKonseling($tgl_awal, $tgl_akhir);  
				$url_cetak_PengajuanKonseling = 'guru/cetakpdf_PengajuanKonseling?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['PengajuanKonseling'] = $PengajuanKonseling;
			$data['url_cetak_PengajuanKonseling'] = base_url('index.php/'.$url_cetak_PengajuanKonseling);
			$data['label'] = $label;
			$data['title'] ='DATA PENGAJUAN KONSELING';
			$data['isi'] = 'guru/pengajuankonseling/cek';
			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function cetakpdf_PengajuanKonseling(){
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'format' => [215, 330],
				'orientation' => $orientation,
				'margin_left' => 15,
				'margin_right' => 15,
				'margin_top' => 16,
				'margin_bottom' => 35,
				'margin_header' => 9,
				'margin_footer' => 9,
				]);

			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
				if(empty($tgl_awal) or empty($tgl_akhir)){
					$PengajuanKonseling = $this->m_admin->view_all_PengajuanKonseling();
					$label = 'SEMUA DATA PENGAJUAN KONSELING';
				}else{ // Jika terisi
					$PengajuanKonseling = $this->m_admin->view_by_date_PengajuanKonseling($tgl_awal, $tgl_akhir);
					$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
					$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir));
					$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
				}

			$data['label'] = $label;
			$data['PengajuanKonseling'] = $PengajuanKonseling;
			$mpdf->SetTitle('Data Pengajuan Konseling : ' .$label);
			$current_date = date('d-m-Y H:i:s');
			$mpdf->SetFooter('Dicetak pada: ' . $current_date);
			$data = $this->load->view('guru/pengajuankonseling/pdf', $data, TRUE);
			$mpdf->WriteHTML($data);
			$mpdf->Output();
		}
	// end

	// Pengembangan Diri
		public function pengembanganDiri() {
			$data = array(
				'title' => 'PENGEMBANGAN DIRI',
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'guru/pengembanganDiri/data'
			);

			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function viewMinatsiswa($siswa_id) {
			$detailSiswa = $this->m_admin->detail_siswa($siswa_id);
			$data = array(
				'title' => 'PENGEMBANGAN DIRI : ' .$detailSiswa->nama_lengkap,
				'detailSiswa' => $detailSiswa,
				'pengembanganDiri' => $this->m_admin->get_id_pengembanganDiri($siswa_id),
				'isi' => 'guru/pengembanganDiri/detail'
			);

			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}
	// End

	// Laporan Pengaduan
		public function laporanPengaduan() {
			$guru_id = $this->session->userdata('guru_id');
			$detailGuru = $this->m_admin->detail_guru($guru_id);
			$data = array(
				'title' => 'LAPORAN PENGADUAN',
				'laporanPengaduan' => $this->m_admin->laporanPengaduan(),
				'detailGuru' => $detailGuru,
				'Pengaduan' => $this->m_admin->get_id_laporan($guru_id),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'guru/laporanPengaduan/data'
			);

			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function add_laporanPengaduan()
		{
			$this->form_validation->set_rules('judul_laporan', 'Judul Laporan', 'required', array('required' => '%s Harus Diisi'));
			$this->form_validation->set_rules('ket_laporan', 'Deskripsi', 'required', array('required' => '%s Harus Diisi'));
			$this->form_validation->set_rules('nama_siswa', 'Nama Siswa Yang Dilaporakan', 'required', array('required' => '%s Harus Diisi'));
			
			if ($this->form_validation->run() == TRUE) {
				$config['upload_path'] = './assets/image/foto_laporan/';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['max_size']             = 5000;
				$this->upload->initialize($config);
					if (!$this->upload->do_upload('foto_laporan'))
					{
						$this->session->set_flashdata('success', 'Gambar Gagal di tambahkan');
						redirect('guru/laporanPengaduan');
					}
					else
					{
						$upload_data 				= array('uploads' => $this->upload->data());
						$config['image_liblary']	= 'gd2';
						$config['source_image']		= './assets/image/foto_laporan/' .$upload_data['uploads']['file_name'];
						$this->load->library('image_lib', $config);

						$guru_id = $this->session->userdata('guru_id');
						$data = array(
							'guru_id'  => $guru_id,
							'judul_laporan' => $this->input->post('judul_laporan'),
							'ket_laporan' => $this->input->post('ket_laporan'),
							'nama_siswa' => $this->input->post('nama_siswa'),
							'create_at' => date('Y-m-d H:i:s'),
							'foto_laporan' => $upload_data['uploads']['file_name'], 
						);

						$this->m_admin->insert_datalaporanPengaduan($data);
						$this->session->set_flashdata('success', 'Laporan Pengaduan berhasil ditambahkan');
						redirect('guru/laporanPengaduan');
					}
			}
			$this->session->set_flashdata('success', 'Laporan Pengaduan berhasil ditambahkan');
			redirect('guru/laporanPengaduan');
		}

		public function updatedatalaporanPengaduan($laporan_id)
		{
			$this->form_validation->set_rules('judul_laporan', 'Judul Laporan', 'required', array('required' => '%s Harus Diisi'));
			$this->form_validation->set_rules('ket_laporan', 'Deskripsi', 'required', array('required' => '%s Harus Diisi'));
			$this->form_validation->set_rules('nama_siswa', 'Nama Siswa Yang Dilaporkan', 'required', array('required' => '%s Harus Diisi'));

			if ($this->form_validation->run() == TRUE) {
				$config['upload_path']   = './assets/image/foto_laporan/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size']      = 5000;
				$this->upload->initialize($config);

				if (!empty($_FILES['foto_laporan']['name'])) {
					if (!$this->upload->do_upload('foto_laporan')) {
						$this->session->set_flashdata('success', 'Gambar gagal diupload');
						redirect('guru/laporanPengaduan');
					} else {
						$upload_data = array('uploads' => $this->upload->data());

						$laporan = $this->m_admin->get_laporanById($laporan_id);
						if ($laporan->foto_laporan != "" && file_exists('./assets/image/foto_laporan/' . $laporan->foto_laporan)) {
							unlink('./assets/image/foto_laporan/' . $laporan->foto_laporan);
						}

						$data = array(
							'judul_laporan' => $this->input->post('judul_laporan'),
							'ket_laporan'   => $this->input->post('ket_laporan'),
							'nama_siswa'    => $this->input->post('nama_siswa'),
							'foto_laporan'  => $upload_data['uploads']['file_name'],
							'update_at'     => date('Y-m-d H:i:s'),
						);
					}
				} else {
					$data = array(
						'judul_laporan' => $this->input->post('judul_laporan'),
						'ket_laporan'   => $this->input->post('ket_laporan'),
						'nama_siswa'    => $this->input->post('nama_siswa'),
						'update_at'     => date('Y-m-d H:i:s'),
					);
				}

				$this->m_admin->update_datalaporanPengaduan($laporan_id, $data);
				$this->session->set_flashdata('success', 'Laporan Pengaduan berhasil diperbarui');
				redirect('guru/laporanPengaduan');
			} else {
				$this->session->set_flashdata('success', validation_errors());
				redirect('guru/laporanPengaduan');
			}
		}

		public function hapusdatalaporanPengaduan($id)
		{
			$laporan = $this->m_admin->get_laporanById($id);

			if ($laporan && $laporan->foto_laporan != "" && file_exists('./assets/image/foto_laporan/' . $laporan->foto_laporan)) {
				unlink('./assets/image/foto_laporan/' . $laporan->foto_laporan);
			}
			$this->m_admin->delete_datalaporanPengaduan($id);

			$this->session->set_flashdata('success', 'Laporan Pengaduan berhasil dihapus');
			redirect('guru/laporanPengaduan');
		}

	// end

	// edukasi
		public function edukasi() {
			$data = array(
				'title' => 'EDUKASI SISWA',
				'edukasi' => $this->m_admin->get_all_edukasi(),
				'isi' => 'guru/edukasi/data'
			);

			$this->load->view('guru/layout/v_wrapper',$data,FALSE);
		}

		public function add_edukasi()
		{
			$this->form_validation->set_rules('judul', 'Judul', 'required', array('required' => '%s Harus Diisi'));
			$this->form_validation->set_rules('jenis', 'Jenis', 'required', array('required' => '%s Harus Diisi'));

			if ($this->form_validation->run() == TRUE) {

				$jenis = $this->input->post('jenis');

				if ($jenis == "foto") {
					// Konfigurasi upload file
					$config['upload_path']   = './assets/image/file_edukasi/';
					$config['allowed_types'] = 'jpg|png|jpeg|pdf';
					$config['max_size']      = 5000;
					$this->upload->initialize($config);

					if (!empty($_FILES['file_edukasi']['name'])) {
						if (!$this->upload->do_upload('file_edukasi')) {
							$this->session->set_flashdata('error', 'File gagal diupload: ' . $this->upload->display_errors());
							redirect('guru/edukasi');
						} else {
							$upload_data = $this->upload->data();
							$data = array(
								'judul'        => $this->input->post('judul'),
								'jenis'        => $jenis,
								'file_edukasi' => $upload_data['file_name'],
								'link'         => null
							);
						}
					} else {
						$this->session->set_flashdata('error', 'File harus dipilih untuk jenis Foto.');
						redirect('guru/edukasi');
					}

				} else if ($jenis == "vidio") {
					// Simpan hanya link (YouTube embed)
					$data = array(
						'judul'        => $this->input->post('judul'),
						'jenis'        => $jenis,
						'link'         => $this->input->post('link'),
						'file_edukasi' => null
					);

				} else if ($jenis == "link") {
					// Simpan hanya link eksternal
					$data = array(
						'judul'        => $this->input->post('judul'),
						'jenis'        => $jenis,
						'link'         => $this->input->post('link'),
						'file_edukasi' => null
					);
				}

				// Simpan ke DB
				$this->m_admin->insert_edukasi($data);
				$this->session->set_flashdata('success', 'Edukasi berhasil ditambahkan');
				redirect('guru/edukasi');
			} else {
				$this->session->set_flashdata('error', validation_errors());
				redirect('guru/edukasi');
			}
		}

		public function edit_edukasi($edukasi_id)
		{
			$this->form_validation->set_rules('judul', 'Judul', 'required', array('required' => '%s Harus Diisi'));
			$this->form_validation->set_rules('jenis', 'Jenis', 'required', array('required' => '%s Harus Diisi'));

			if ($this->form_validation->run() == TRUE) {
				$jenis = $this->input->post('jenis');

				if ($jenis == "foto") {
					// Konfigurasi upload file
					$config['upload_path']   = './assets/image/file_edukasi/';
					$config['allowed_types'] = 'jpg|png|jpeg|pdf';
					$config['max_size']      = 5000;
					$this->upload->initialize($config);

					if (!empty($_FILES['file_edukasi']['name'])) {
						// ada file baru diupload
						if (!$this->upload->do_upload('file_edukasi')) {
							$this->session->set_flashdata('error', 'File gagal diupload: ' . $this->upload->display_errors());
							redirect('guru/edukasi');
						} else {
							$upload_data = $this->upload->data();

							// hapus file lama
							$edukasi = $this->m_admin->detail_edukasi($edukasi_id);
							if ($edukasi && $edukasi->file_edukasi != "" && file_exists('./assets/image/file_edukasi/' . $edukasi->file_edukasi)) {
								unlink('./assets/image/file_edukasi/' . $edukasi->file_edukasi);
							}

							$data = array(
								'judul'        => $this->input->post('judul'),
								'jenis'        => $jenis,
								'file_edukasi' => $upload_data['file_name'],
								'link'         => null
							);
						}
					} else {
						// tidak ada file baru
						$data = array(
							'judul'        => $this->input->post('judul'),
							'jenis'        => $jenis,
							'link'         => null
						);
					}

				} else if ($jenis == "vidio") {
					$data = array(
						'judul'        => $this->input->post('judul'),
						'jenis'        => $jenis,
						'link'         => $this->input->post('link'),
						'file_edukasi' => null
					);

				} else if ($jenis == "link") {
					$data = array(
						'judul'        => $this->input->post('judul'),
						'jenis'        => $jenis,
						'link'         => $this->input->post('link'),
						'file_edukasi' => null
					);
				}

				// Update ke DB
				$this->m_admin->update_edukasi($edukasi_id, $data);
				$this->session->set_flashdata('success', 'Edukasi berhasil diperbarui');
				redirect('guru/edukasi');
			} else {
				$this->session->set_flashdata('error', validation_errors());
				redirect('guru/edukasi');
			}
		}

		public function hapus_edukasi($edukasi_id)
		{
			$edukasi = $this->m_admin->detail_edukasi($edukasi_id);

			if ($edukasi && $edukasi->file_edukasi != "" && file_exists('./assets/image/file_edukasi/' . $edukasi->file_edukasi)) {
				unlink('./assets/image/file_edukasi/' . $edukasi->file_edukasi);
			}
			$this->m_admin->delete_edukasi($edukasi_id);

			$this->session->set_flashdata('success', 'Data Edukasi berhasil dihapus');
			redirect('guru/edukasi');
		}

	// End

	// Profil Guru
		public function updatedataGuru($guru_id)
		{
			$this->form_validation->set_rules('nama_guru', 'Nama Lengkap', 'required', array('required' => '%s Harus Diisi'));
			$this->form_validation->set_rules('nip', 'NIP', 'required', array('required' => '%s Harus Diisi'));

			if ($this->form_validation->run() == TRUE) {
				$config['upload_path']   = './assets/image/foto_guru/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size']      = 5000;
				$this->upload->initialize($config);

				if (!empty($_FILES['foto_guru']['name'])) {
					if (!$this->upload->do_upload('foto_guru')) {
						$this->session->set_flashdata('success', 'Gambar gagal diupload');
						redirect('guru');
					} else {
						$upload_data = array('uploads' => $this->upload->data());

						$guru = $this->m_admin->detail_guru($guru_id);
						if ($guru->foto_guru != "" && file_exists('./assets/image/foto_guru/' . $guru->foto_guru)) {
							unlink('./assets/image/foto_guru/' . $guru->foto_guru);
						}

						$data = array(
							'nama_guru' => $this->input->post('nama_guru'),
							'nip'   => $this->input->post('nip'),
							'foto_guru'  => $upload_data['uploads']['file_name'],
							'update_at'     => date('Y-m-d H:i:s'),
						);
					}
				} else {
					$data = array(
						'nama_guru' => $this->input->post('nama_guru'),
						'nip'   => $this->input->post('nip'),
						'update_at'     => date('Y-m-d H:i:s'),
					);
				}

				$this->m_admin->update_guru($guru_id, $data);
				$this->session->set_flashdata('success', 'Profil berhasil diperbarui');
				redirect('guru');
			} else {
				$this->session->set_flashdata('success', validation_errors());
				redirect('guru');
			}
		}

		public function update_pass($user_id)
		{
			$data = array(
				'user_id' => $user_id,
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'update_at'     => date('Y-m-d H:i:s')
			);
			$this->m_admin->update_user($user_id, $data);
			$this->session->set_flashdata('success', 'Password Berhasil Diedit');

			redirect('guru');
		}
	// end
}
