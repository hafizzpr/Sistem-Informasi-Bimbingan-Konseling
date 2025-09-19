<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
	}

	public function index()
	{
		$data = array(
			'title' => 'Home',
			'jumlahSiswa' => $this->m_admin->get_jumlah_siswa_per_kelas(),
			'jumlahPelanggaran' => $this->m_admin->get_jumlah_pelanggaran_per_kelas(),
			'dataPelanggaran' => $this->m_admin->get_all_dataPelanggaran(),
			'dataPengajuan' => $this->m_admin->home_all_pengajuan(),
			'dataKonseling' => $this->m_admin->home_all_jadwal(),
			'totalKonseling' => $this->m_admin->total_pengajuan_konseling(),
			'totalJadwal' => $this->m_admin->total_jadwal(),
			'top_pelanggaran' => $this->m_admin->get_top5_pelanggaran(),
			'poinSemester' => $this->m_admin->get_poin_pelanggaran_per_semester(),
			'jenisPelanggaran' => $this->m_admin->getJumlahPelanggaranPerJenis(),
			'isi'	=> 'admin/v_home'
		);
		$this->load->view('admin/layout/v_wrapper', $data, FALSE);
	}

	public function pelanggaran_per_semester()
	{
		$this->load->model('m_admin');
		$data = $this->m_admin->get_poin_pelanggaran_per_semester();

		header('Content-Type: application/json'); // tambahkan ini
		echo json_encode($data);
	}

	// dataSiswa
		public function dataSiswa()
		{
			$data = array(
				'title' => 'DATA SISWA',
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'admin/siswa/data'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function dataKelasSiswa($kelas)
		{
			$dataSiswa = $this->m_admin->get_kelas_siswa($kelas);

			$data = array(
				'title'         => 'DATA SISWA KELAS : ' .$kelas,
				'dataSiswa'     => $dataSiswa,
				'kelas'         => $kelas,
				'isi'           => 'admin/siswa/kelas'
			);
			$this->load->view('admin/layout/v_wrapper', $data, FALSE);
		}

		public function add_dataSiswa()
		{
			$userData = array(
				'email'       => $this->input->post('email'),
				'username'    => $this->input->post('username'),
				'password'    => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'role'        => 'siswa',
				'status_akun' => '1',
				'create_at'   => date('Y-m-d H:i:s'),
			);

			$user_id = $this->m_admin->add_dataSiswa($userData);

			$siswaData = array(
				'user_id'        => $user_id,
				'nama_lengkap'  		=> $this->input->post('nama_lengkap'),
				'nis'           		=> $this->input->post('nis'),
				'jenis_kelamin'         => $this->input->post('jenis_kelamin'),
				'nisn' 					=> $this->input->post('nisn'),
				'tempat_lahir' 			=> $this->input->post('tempat_lahir'),
				'tanggal_lahir'        	=> $this->input->post('tanggal_lahir'),
				'nik'      				=> $this->input->post('nik'),
				'agama'  				=> $this->input->post('agama'),
				'alamat'     			=> $this->input->post('alamat'),
				'rt'      				=> $this->input->post('rt'),
				'rw'      				=> $this->input->post('rw'),
				'kelurahan'      		=> $this->input->post('kelurahan'),
				'kecamatan'      		=> $this->input->post('kecamatan'),
				'no_siswa'      		=> $this->input->post('no_siswa'),
				'nama_ibu'      		=> $this->input->post('nama_ibu'),
				'kelas'      			=> $this->input->post('kelas')
			);

			$this->m_admin->insert_dataSiswa($siswaData);
			$this->session->set_flashdata('success', 'Data Siswa dan Akun berhasil ditambahkan');
			redirect('admin/dataSiswa');
		}

		public function update_dataSiswa()
		{
			$user_id    = $this->input->post('user_id');
			$siswa_id   = $this->input->post('siswa_id');

			// Data untuk tabel users
			$data_user = array(
				'email'   => $this->input->post('email'),
				'username'   => $this->input->post('username'),
				'status_akun'   => $this->input->post('status_akun'),
			);

			// Data untuk tabel siswa
			$data_siswa = array(
				'nama_lengkap'  		=> $this->input->post('nama_lengkap'),
				'nis'           		=> $this->input->post('nis'),
				'jenis_kelamin'         => $this->input->post('jenis_kelamin'),
				'nisn' 					=> $this->input->post('nisn'),
				'tempat_lahir' 			=> $this->input->post('tempat_lahir'),
				'tanggal_lahir'        	=> $this->input->post('tanggal_lahir'),
				'nik'      				=> $this->input->post('nik'),
				'agama'  				=> $this->input->post('agama'),
				'alamat'     			=> $this->input->post('alamat'),
				'rt'      				=> $this->input->post('rt'),
				'rw'      				=> $this->input->post('rw'),
				'kelurahan'      		=> $this->input->post('kelurahan'),
				'kecamatan'      		=> $this->input->post('kecamatan'),
				'no_siswa'      		=> $this->input->post('no_siswa'),
				'nama_ibu'      		=> $this->input->post('nama_ibu'),
				'kelas'      			=> $this->input->post('kelas')
			);

			// Update ke database
			$this->m_admin->update_user($user_id, $data_user);
			$this->m_admin->update_siswa($siswa_id, $data_siswa);

			$this->session->set_flashdata('success', 'Data siswa berhasil diperbarui.');
			redirect('admin/dataSiswa');
		}

		public function import_excel_siswa()
		{
			$file = $_FILES['file_excel']['tmp_name'];

			if ($file) {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				$spreadsheet = $reader->load($file);
				$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

				// Lewati baris pertama (header)
				for ($i = 2; $i <= count($sheetData); $i++) {
					$row = $sheetData[$i];

					// Pastikan kolom sesuai dengan format Excel
					$userData = [
						'email'       => $row['A'],
						'username'    => $row['B'],
						'password'    => password_hash($row['C'], PASSWORD_BCRYPT),
						'role'        => 'siswa',
						'status_akun' => '1',
						'create_at'   => date('Y-m-d H:i:s'),
					];

					$user_id = $this->m_admin->add_dataSiswa($userData);

					$siswaData = [
						'user_id'       		=> $user_id,
						'nama_lengkap'  		=> $row['D'],
						'nis'           		=> $row['E'],
						'jenis_kelamin'         => $row['F'],
						'nisn' 					=> $row['G'],
						'tempat_lahir' 			=> $row['H'],
						'tanggal_lahir'        	=> $row['I'],
						'nik'      				=> $row['J'],
						'agama'  				=> $row['K'],
						'alamat'     			=> $row['L'],
						'rt'      				=> $row['M'],
						'rw'      				=> $row['N'],
						'kelurahan'      		=> $row['O'],
						'kecamatan'      		=> $row['P'],
						'no_siswa'      		=> $row['Q'],
						'nama_ibu'      		=> $row['R'],
						'kelas'      			=> $row['S']
					];

					$this->m_admin->insert_dataSiswa($siswaData);
				}

				$this->session->set_flashdata('success', 'Import Data Siswa berhasil.');
			} else {
				$this->session->set_flashdata('error', 'File Excel tidak ditemukan.');
			}

			redirect('admin/dataSiswa');
		}

		public function update_password($user_id)
		{
			$data = array(
				'user_id' => $user_id,
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
			);
			$this->m_admin->update_user($user_id, $data);
			$this->session->set_flashdata('success', 'Data Berhasil Diedit');

			redirect('admin/dataSiswa');
		}

		public function delete_user($user_id)
		{
			// Cek apakah ada siswa yang terhubung ke user ini
			$siswa = $this->m_admin->get_siswa_by_user($user_id);
			if ($siswa) {
				$this->m_admin->delete_siswa_by_user($user_id);
			}

			// Hapus user-nya
			$this->m_admin->delete_user($user_id);

			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect('admin/dataSiswa');
		}

		public function update_kelas()
		{
			$data = array(
				'title' => 'UPDATE KELAS SISWA',
				'dataSiswa' => $this->m_admin->get_all_siswa_yang_belum_lulus(),
				'isi' => 'admin/siswa/update'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function naikkan_dengan_status() {
			$tidak_naik = $this->input->post('tidak_naik');
			$semua_id = $this->m_admin->get_all_ids();

			// 1. Update naik_kelas
			foreach ($semua_id as $id) {
				$status = (is_array($tidak_naik) && in_array($id, $tidak_naik)) ? 'TIDAK' : 'YA';
				$this->m_admin->update_naik_kelas($id, $status);
			}

			// 2. Naikkan kelas untuk siswa yang 'YA'
			$this->m_admin->naikkan_kelas();

			// 3. Feedback
			$this->session->set_flashdata('success', 'Semua status disimpan & kelas dinaikkan.');
			redirect('admin/dataSiswa');
		}

	// end

	// dataGuru
		public function dataGuru()
		{
			$data = array(
				'title' => 'DATA GURU',
				'dataGuru' => $this->m_admin->get_all_guru(),
				'isi' => 'admin/guru/data'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function add_dataGuru()
		{
			$userData = array(
				'email'       => $this->input->post('email'),
				'username'    => $this->input->post('username'),
				'password'    => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'role'        => 'guru',
				'status_akun' => '1',
				'create_at'   => date('Y-m-d H:i:s'),
			);

			$user_id = $this->m_admin->add_dataGuru($userData);

			$guruData = array(
				'user_id'        => $user_id,
				'nama_guru'   => $this->input->post('nama_guru'), 
				'nip'            => $this->input->post('nip'),
				'no_telepon'     => $this->input->post('no_telepon'),
				'status_guru'     => $this->input->post('status_guru')
			);

			$this->m_admin->insert_dataGuru($guruData);
			$this->session->set_flashdata('success', 'Data Guru dan Akun berhasil ditambahkan');
			redirect('admin/dataGUru');
		}

		public function update_dataGuru()
		{
			$user_id    = $this->input->post('user_id');
			$guru_id   = $this->input->post('guru_id');

			// Data untuk tabel users
			$data_user = array(
				'email'   => $this->input->post('email'),
				'username'   => $this->input->post('username'),
				'status_akun'   => $this->input->post('status_akun'),
			);

			// Data untuk tabel guru
			$data_guru = array(
				'nama_guru'   => $this->input->post('nama_guru'), 
				'nip'            => $this->input->post('nip'),
				'no_telepon'     => $this->input->post('no_telepon'),
				'status_guru'     => $this->input->post('status_guru')
			);

			// Update ke database
			$this->m_admin->update_user($user_id, $data_user);
			$this->m_admin->update_guru($guru_id, $data_guru);

			$this->session->set_flashdata('success', 'Data guru berhasil diperbarui.');
			redirect('admin/dataGuru');
		}

		public function update_pass($user_id)
		{
			$data = array(
				'user_id' => $user_id,
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
			);
			$this->m_admin->update_user($user_id, $data);
			$this->session->set_flashdata('success', 'Data Berhasil Diedit');

			redirect('admin/dataGuru');
		}

		public function delete_guru($user_id)
		{
			// Cek apakah ada guru yang terhubung ke user ini
			$guru = $this->m_admin->get_guru_by_user($user_id);
			if ($guru) {
				$this->m_admin->delete_guru_by_user($user_id);
			}

			// Hapus user-nya
			$this->m_admin->delete_user($user_id);

			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
			redirect('admin/dataGuru');
		}
	// end

	// jadwal konseling
		public function jadwalKonseling() {
			$data = array(
				'title' => 'JADWAL KONSELING',
				'jadwalKonseling' => $this->m_admin->get_all_jadwal(),
				'dataGuru' => $this->m_admin->get_all_guru(),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'admin/jadwalkonseling/data'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function viewJadwalKonseling($jadwal_id) {
			$detailJadwalKonseling = $this->m_admin->detail_jadwalKonseling($jadwal_id);
			$data = array(
				'title' => 'DETAIL JADWAL KONSELING',
				'detailJadwalKonseling' => $detailJadwalKonseling,
				'dataGuru' => $this->m_admin->get_all_guru(),
				'catatanKonseling' => $this->m_admin->detail_catatanKonseling($jadwal_id),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'admin/jadwalkonseling/detail'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function tambahJadwalKonseling() {
			$data = [
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
			redirect('admin/jadwalKonseling');
		}

		public function hapusJadwalKonseling($id) {
			$this->m_admin->delete_jadwalkonseling($id);
			$this->session->set_flashdata('success', 'Jadwal Konseling berhasil Dihapus');
			redirect('admin/jadwalKonseling');
		}

		public function update_statuskonseling($id, $status) {
			$this->m_admin->update_statuskonseling($id, $status);
			$this->session->set_flashdata('success', 'Status Konseling berhasil Diupdate');
			redirect('admin/jadwalKonseling');
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

			redirect('admin/viewJadwalKonseling/' .$jadwal_id);
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

			redirect('admin/viewJadwalKonseling/' .$jadwal_id);
		}

		public function laporanJadwalKonseling()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$JadwalKonseling = $this->m_admin->view_all_JadwalKonseling(); 
				$url_cetak_JadwalKonseling = 'admin/cetakpdf_JadwalKonseling';
				$label = 'Semua Data Jadwal Konseling';
			}else{ // Jika terisi
				$JadwalKonseling = $this->m_admin->view_by_date_JadwalKonseling($tgl_awal, $tgl_akhir);  
				$url_cetak_JadwalKonseling = 'admin/cetakpdf_JadwalKonseling?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['JadwalKonseling'] = $JadwalKonseling;
			$data['url_cetak_JadwalKonseling'] = base_url('index.php/'.$url_cetak_JadwalKonseling);
			$data['jadwalKonseling'] = $this->m_admin->get_all_jadwal();
			$data['label'] = $label;
			$data['title'] ='DATA JADWAL KONSELING';
			$data['isi'] = 'admin/jadwalkonseling/laporan';
			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function cekJadwalKonseling()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$JadwalKonseling = $this->m_admin->view_all_JadwalKonseling(); 
				$url_cetak_JadwalKonseling = 'admin/cetakpdf_JadwalKonseling';
				$label = 'Semua Data Jadwal Konseling';
			}else{ // Jika terisi
				$JadwalKonseling = $this->m_admin->view_by_date_JadwalKonseling($tgl_awal, $tgl_akhir);  
				$url_cetak_JadwalKonseling = 'admin/cetakpdf_JadwalKonseling?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['JadwalKonseling'] = $JadwalKonseling;
			$data['url_cetak_JadwalKonseling'] = base_url('index.php/'.$url_cetak_JadwalKonseling);
			$data['label'] = $label;
			$data['title'] ='DATA JADWAL KONSELING';
			$data['isi'] = 'admin/jadwalkonseling/cek';
			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
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
			$data = $this->load->view('admin/jadwalkonseling/pdf', $data, TRUE);
			$mpdf->WriteHTML($data);
			$mpdf->Output();
		}
	// end

	// Data Pelanggaran
		public function dataPelanggaran() {
			$data = array(
				'title' => 'DATA PELANGGARAN',
				'dataPelanggaran' => $this->m_admin->get_all_pelanggaran(),
				'isi' => 'admin/datapelanggaran/data'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function add_dataPelanggaran() {
			$data = [
				'nama_pelanggaran' => $this->input->post('nama_pelanggaran'),
				'poin_pengurang' => $this->input->post('poin_pengurang'),
				'kategori' => $this->input->post('kategori')
			];
			$this->m_admin->insert_dataPelanggaran($data);
			$this->session->set_flashdata('success', 'Jenis Pelanggaran berhasil ditambahkan');
			redirect('admin/dataPelanggaran');
		}

		public function updatedataPelanggaran($jenis_id)
		{
			$data = array(
				'jenis_id' => $jenis_id,
				'nama_pelanggaran' => $this->input->post('nama_pelanggaran'),
				'poin_pengurang' => $this->input->post('poin_pengurang'),
				'kategori' => $this->input->post('kategori'),
			);
			$this->m_admin->update_dataPelanggaran($data);
			$this->session->set_flashdata('success', 'Jenis Pelanggaran berhasil Diupdate');

			redirect('admin/dataPelanggaran');
		}

		public function hapusdataPelanggaran($id) {
			$this->m_admin->delete_dataPelanggaran($id);
			$this->session->set_flashdata('success', 'Jenis Pelanggaran berhasil Dihapus');
			redirect('admin/dataPelanggaran');
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
				'isi' => 'admin/pelanggaransiswa/data'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function datapelanggaranSiswa($kelas) 
		{
			$data = array(
				'title' => 'DATA PELANGGARAN SISWA',
				'dataPl' => $this->m_admin->get_pelanggaran_by_kelas($kelas),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'dataPelanggaran' => $this->m_admin->get_all_pelanggaran(),
				'pelanggaranSiswa' => $this->m_admin->get_all_pelanggaran(),
				'jumlahSiswa' => $this->m_admin->get_jumlah_siswa_per_kelas(),
				'isi' => 'admin/pelanggaransiswa/kelas'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}


		public function viewPelanggaranSiswa($siswa_id) {
			$detailSiswa = $this->m_admin->detail_siswa($siswa_id);
			$data = array(
				'title' => 'Pelanggaran Siswa : ' .$detailSiswa->nama_lengkap,
				'detailSiswa' => $detailSiswa,
				'pelanggaran' => $this->m_admin->detail_dataPelanggaran($siswa_id),
				'totalPoin' => $this->m_admin->poin_dataPelanggaranSiswa($siswa_id),
				'totalPoinPerSemester' => $this->m_admin->getTotalPoinPerSemester($siswa_id),
				'dataPelanggaran' => $this->m_admin->get_all_pelanggaran(),
				'isi' => 'admin/pelanggaransiswa/detail'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function add_pelanggaranSiswa1()
		{
			$semester = $this->db->get_where('semester', ['status' => 1])->row();

			if (!$semester) {
				$this->session->set_flashdata('error', 'Tidak ada semester aktif. Silakan aktifkan semester terlebih dahulu.');
				redirect('admin/pelanggaranSiswa/');
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
			redirect('admin/pelanggaranSiswa/');
		}

		public function add_pelanggaranSiswa($siswa_id)
		{
			$semester = $this->db->get_where('semester', ['status' => 1])->row();

			if (!$semester) {
				$this->session->set_flashdata('error', 'Tidak ada semester aktif. Silakan aktifkan semester terlebih dahulu.');
				redirect('admin/viewPelanggaranSiswa/' . $siswa_id);
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
			redirect('admin/viewPelanggaranSiswa/' . $siswa_id);
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
			redirect('admin/viewPelanggaranSiswa/' .$siswa_id);
		}

		public function hapuspelanggaranSiswa($pelanggaran_id, $siswa_id) {
			$this->m_admin->delete_pelanggaranSiswa($pelanggaran_id);
			$this->session->set_flashdata('success', 'Pelanggaran Siswa berhasil Dihapus');
			redirect('admin/viewPelanggaranSiswa/' .$siswa_id);
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
			$data = $this->load->view('admin/pelanggaransiswa/sp1', $data, TRUE);
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
			$data = $this->load->view('admin/pelanggaransiswa/sp2', $data, TRUE);
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
			$data = $this->load->view('admin/pelanggaransiswa/sp3', $data, TRUE);
			$mpdf->WriteHTML($data);
			$mpdf->Output();
		}

		public function laporanPelanggaranSiswa()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$PelanggaranSiswa = $this->m_admin->view_all_PelanggaranSiswa(); 
				$url_cetak_PelanggaranSiswa = 'admin/cetakpdf_PelanggaranSiswa';
				$label = 'Semua Data Laporan Pelanggaran Siswa';
			}else{ // Jika terisi
				$PelanggaranSiswa = $this->m_admin->view_by_date_PelanggaranSiswa($tgl_awal, $tgl_akhir);  
				$url_cetak_PelanggaranSiswa = 'admin/cetakpdf_PelanggaranSiswa?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['PelanggaranSiswa'] = $PelanggaranSiswa;
			$data['url_cetak_PelanggaranSiswa'] = base_url('index.php/'.$url_cetak_PelanggaranSiswa);
			$data['label'] = $label;
			$data['title'] ='DATA PELANGGARAN SISWA';
			$data['isi'] = 'admin/pelanggaransiswa/laporan';
			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function cekPelanggaranSiswa()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$PelanggaranSiswa = $this->m_admin->view_all_PelanggaranSiswa(); 
				$url_cetak_PelanggaranSiswa = 'admin/cetakpdf_PelanggaranSiswa';
				$label = 'Semua Data Laporan Pelanggaran Siswa';
			}else{ // Jika terisi
				$PelanggaranSiswa = $this->m_admin->view_by_date_PelanggaranSiswa($tgl_awal, $tgl_akhir);  
				$url_cetak_PelanggaranSiswa = 'admin/cetakpdf_PelanggaranSiswa?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['PelanggaranSiswa'] = $PelanggaranSiswa;
			$data['url_cetak_PelanggaranSiswa'] = base_url('index.php/'.$url_cetak_PelanggaranSiswa);
			$data['label'] = $label;
			$data['title'] ='DATA PELANGGARAN SISWA';
			$data['isi'] = 'admin/pelanggaransiswa/cek';
			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
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
			$data = $this->load->view('admin/pelanggaransiswa/pdf', $data, TRUE);
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
				'isi' => 'admin/pengajuankonseling/data'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function viewPengajuanKonseling($pengajuan_id) {
			$detailPengajuanKonseling = $this->m_admin->detail_pengajuanKonseling($pengajuan_id);
			$data = array(
				'title' => 'DETAIL JADWAL KONSELING',
				'detailPengajuanKonseling' => $detailPengajuanKonseling,
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'admin/pengajuankonseling/detail'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
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
			redirect('admin/pengajuankonseling/' .$pengajuan_id);
		}

		public function laporanPengajuanKonseling()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$PengajuanKonseling = $this->m_admin->view_all_PengajuanKonseling(); 
				$url_cetak_PengajuanKonseling = 'admin/cetakpdf_PengajuanKonseling';
				$label = 'Semua Data Laporan Pengajuan Konseling';
			}else{ // Jika terisi
				$PengajuanKonseling = $this->m_admin->view_by_date_PengajuanKonseling($tgl_awal, $tgl_akhir);  
				$url_cetak_PengajuanKonseling = 'admin/cetakpdf_PengajuanKonseling?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['PengajuanKonseling'] = $PengajuanKonseling;
			$data['url_cetak_PengajuanKonseling'] = base_url('index.php/'.$url_cetak_PengajuanKonseling);
			$data['label'] = $label;
			$data['title'] ='DATA PENGAJUAN KONSELING SISWA';
			$data['isi'] = 'admin/pengajuankonseling/laporan';
			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function cekPengajuanKonseling()
		{
			$tgl_awal = $this->input->get('tgl_awal'); 
			$tgl_akhir = $this->input->get('tgl_akhir');
			if(empty($tgl_awal) or empty($tgl_akhir)){ 
				$PengajuanKonseling = $this->m_admin->view_all_PengajuanKonseling(); 
				$url_cetak_PengajuanKonseling = 'admin/cetakpdf_PengajuanKonseling';
				$label = 'Semua Data Laporan Pengajuan Konseling';
			}else{ // Jika terisi
				$PengajuanKonseling = $this->m_admin->view_by_date_PengajuanKonseling($tgl_awal, $tgl_akhir);  
				$url_cetak_PengajuanKonseling = 'admin/cetakpdf_PengajuanKonseling?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir;
				$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); 
				$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir));
				$label = 'Periode Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;
			}
			$data['PengajuanKonseling'] = $PengajuanKonseling;
			$data['url_cetak_PengajuanKonseling'] = base_url('index.php/'.$url_cetak_PengajuanKonseling);
			$data['label'] = $label;
			$data['title'] ='DATA PENGAJUAN KONSELING';
			$data['isi'] = 'admin/pengajuankonseling/cek';
			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
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
			$data = $this->load->view('admin/pengajuankonseling/pdf', $data, TRUE);
			$mpdf->WriteHTML($data);
			$mpdf->Output();
		}
	// end

	// Pengembangan Diri
		public function pengembanganDiri() {
			$data = array(
				'title' => 'PENGEMBANGAN DIRI',
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'admin/pengembanganDiri/data'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function viewMinatsiswa($siswa_id) {
			$detailSiswa = $this->m_admin->detail_siswa($siswa_id);
			$data = array(
				'title' => 'PENGEMBANGAN DIRI : ' .$detailSiswa->nama_lengkap,
				'detailSiswa' => $detailSiswa,
				'pengembanganDiri' => $this->m_admin->get_id_pengembanganDiri($siswa_id),
				'isi' => 'admin/pengembanganDiri/detail'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}
	// End

	// Semester
		public function dataSemester() {
			$data = array(
				'title' => 'DATA SEMESTER',
				'dataSemester' => $this->m_admin->get_all_semester(),
				'isi' => 'admin/semester/data'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}

		public function add_dataSemester() {
			$data = [
				'nama_semester' => $this->input->post('nama_semester'),
			];
			$this->m_admin->insertdataSemester($data);
			$this->session->set_flashdata('success', 'Data Semeste berhasil ditambahkan');
			redirect('admin/dataSemester');
		}

		public function updatedataSemester($semester_id)
		{
			$data = array(
				'semester_id' => $semester_id,
				'nama_semester' => $this->input->post('nama_semester'),
			);
			$this->m_admin->update_dataSemester($data);
			$this->session->set_flashdata('success', 'Semester berhasil Diupdate');

			redirect('admin/dataSemester');
		}

		public function hapusdataSemester($semester_id) {
			$this->m_admin->delete_Semester($semester_id);
			$this->session->set_flashdata('success', 'Semester berhasil Dihapus');
			redirect('admin/dataSemester');
		}

		public function aktifkanSemester($id)
		{
			// 1. Pastikan semester dengan ID tersebut ada
			$semester = $this->db->get_where('semester', ['semester_id' => $id])->row();

			if (!$semester) {
				show_404(); // atau redirect dengan flash error
			}

			// 2. NONAKTIFKAN SEMUA SEMESTER terlebih dahulu
			$this->db->set('status', 0);
			$this->db->update('semester');

			// 3. AKTIFKAN SEMESTER YANG DIPILIH
			$this->db->set('status', 1);
			$this->db->where('semester_id', $id);
			$this->db->update('semester');

			// 4. Flash message
			$this->session->set_flashdata('success', 'Semester berhasil diaktifkan.');

			// 5. Kembali ke halaman data semester
			redirect('admin/dataSemester');
		}
	// End

	// Laporan pengaduan
		public function laporanPengaduan() {
			$data = array(
				'title' => 'LAPORAN PENGADUAN',
				'laporanPengaduan' => $this->m_admin->laporanPengaduan(),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'admin/laporanPengaduan/data'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}
	// End

	// Edukasi
		public function edukasi() {
			$data = array(
				'title' => 'EDUKASI SISWA',
				'edukasi' => $this->m_admin->get_all_edukasi(),
				'isi' => 'admin/edukasi/data'
			);

			$this->load->view('admin/layout/v_wrapper',$data,FALSE);
		}
	// end
}
