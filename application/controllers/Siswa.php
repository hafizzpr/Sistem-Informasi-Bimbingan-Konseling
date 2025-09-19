<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
	}

	public function index()
	{
		$siswa_id = $this->session->userdata('siswa_id');
		$data = array(
			'title' => 'SISWA',
			'totalPengajuan' => $this->m_admin->total_pengajuan_siswa($siswa_id),
			'totalJadwal' => $this->m_admin->total_jadwalkonseling($siswa_id),
			'totalPoin' => $this->m_admin->poin_dataPelanggaranSiswa($siswa_id),
			'pengajuanKonseling' => $this->m_admin->get_all_pengajuansiswa($siswa_id),
			'jadwalKonseling' => $this->m_admin->get_all_jadwal_siswa($siswa_id),
			'pelanggaranSiswa' => $this->m_admin->get_id_dataPelanggaran($siswa_id),
			'dataSiswa' => $this->m_admin->get_id_siswa($siswa_id),
			'isi'	=> 'siswa/v_home'
		);
		$this->load->view('siswa/layout/v_wrapper', $data, FALSE);
	}

	// jadwal konseling
		public function jadwalKonseling() {
			$siswa_id = $this->session->userdata('siswa_id');

			$data = array(
				'title' => 'JADWAL KONSELING',
				'jadwalKonseling' => $this->m_admin->get_all_jadwal_siswa($siswa_id),
				'dataGuru' => $this->m_admin->get_all_guru(),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'siswa/jadwalkonseling/data'
			);

			$this->load->view('siswa/layout/v_wrapper', $data, FALSE);
		}


		public function viewJadwalKonseling($jadwal_id) {
			$detailJadwalKonseling = $this->m_admin->detail_jadwalKonseling($jadwal_id);
			$data = array(
				'title' => 'DETAIL JADWAL KONSELING',
				'detailJadwalKonseling' => $detailJadwalKonseling,
				'dataGuru' => $this->m_admin->get_all_guru(),
				'catatanKonseling' => $this->m_admin->detail_catatanKonseling($jadwal_id),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'siswa/jadwalkonseling/detail'
			);

			$this->load->view('siswa/layout/v_wrapper',$data,FALSE);
		}
	// end

	// Pelanggaran Siswa
		public function pelanggaranSiswa() {
			$siswa_id = $this->session->userdata('siswa_id');
			$detailSiswa = $this->m_admin->detail_siswa($siswa_id);
			$data = array(
				'title' => 'DATA PELANGGARAN SISWA',
				'detailSiswa' => $detailSiswa,
				'pelanggaran' => $this->m_admin->get_id_dataPelanggaran($siswa_id),
				'totalPoin' => $this->m_admin->poin_dataPelanggaranSiswa($siswa_id),
				'isi' => 'siswa/pelanggaransiswa/detail'
			);

			$this->load->view('siswa/layout/v_wrapper',$data,FALSE);
		}
	// end

	// pengajuan konseling
		public function pengajuanKonseling() {
			$siswa_id = $this->session->userdata('siswa_id');
			$data = array(
				'title' => 'PENGAJUAN KONSELING',
				'pengajuanKonseling' => $this->m_admin->get_all_pengajuansiswa($siswa_id),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'siswa/pengajuankonseling/data'
			);

			$this->load->view('siswa/layout/v_wrapper',$data,FALSE);
		}

		public function add_pengajuanKonseling() {
			$siswa_id = $this->session->userdata('siswa_id');

			if (!$siswa_id) {
				$this->session->set_flashdata('error', 'Siswa tidak ditemukan.');
				redirect('siswa/pengajuanKonseling');
			}

			$data = [
				'siswa_id'          => $siswa_id,
				'alasan'            => $this->input->post('alasan'),
				'tanggal_pengajuan' => $this->input->post('tanggal_pengajuan'),
				'create_at' => date('Y-m-d H:i:s')
			];

			$this->m_admin->insert_pengajuan($data);
			$this->session->set_flashdata('success', 'Pengajuan Konseling berhasil ditambahkan');
			redirect('siswa/pengajuanKonseling');
		}

		public function updatePengajuanKonseling($pengajuan_id) {
			$siswa_id = $this->session->userdata('siswa_id'); // ambil dari session

			$data = [
				'pengajuan_id'       => $pengajuan_id,
				'tanggal_pengajuan' => date('Y-m-d'),
				'alasan'             => $this->input->post('alasan'),
				'update_at'          => date('Y-m-d H:i:s')
			];

			$this->m_admin->update_pengajuanKonseling($data);
			$this->session->set_flashdata('success', 'Pengajuan Konseling berhasil diupdate');
			redirect('siswa/pengajuanKonseling/' . $siswa_id);
		}

		public function viewPengajuanKonseling($pengajuan_id) {
			$detailPengajuanKonseling = $this->m_admin->detail_pengajuanKonseling($pengajuan_id);
			$data = array(
				'title' => 'DETAIL JADWAL KONSELING',
				'detailPengajuanKonseling' => $detailPengajuanKonseling,
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'siswa/pengajuankonseling/detail'
			);

			$this->load->view('siswa/layout/v_wrapper',$data,FALSE);
		}
		
	// end

	// Pengembangan Diri
		public function pengembanganDiri() {
			$siswa_id = $this->session->userdata('siswa_id');
			$detailSiswa = $this->m_admin->detail_siswa($siswa_id);
			$data = array(
				'title' => 'DATA PENGEMBANGAN DIRI',
				'detailSiswa' => $detailSiswa,
				'pengembanganDiri' => $this->m_admin->get_id_pengembanganDiri($siswa_id),
				'isi' => 'siswa/pengembanganDiri/detail'
			);

			$this->load->view('siswa/layout/v_wrapper',$data,FALSE);
		}

		public function add_pengembanganDiri() {
			$siswa_id = $this->session->userdata('siswa_id');
			$data = [
				'siswa_id'  => $siswa_id,
				'jenis' => $this->input->post('jenis'),
				'deskripsi' => $this->input->post('bakat'),
				'tingkat' => $this->input->post('tingkat'),
				'deskripsi' => $this->input->post('deskripsi'),
				'tahun_mulai' => $this->input->post('tahun_mulai'),
				'catatan' => $this->input->post('catatan')
			];
			$this->m_admin->insert_datapengembanganDiri($data);
			$this->session->set_flashdata('success', 'Pengembangan Diri berhasil ditambahkan');
			redirect('siswa/pengembanganDiri');
		}

		public function updatedatapengembanganDiri($pengembangan_id)
		{
			$data = array(
				'pengembangan_id' => $pengembangan_id,
				'jenis' => $this->input->post('jenis'),
				'deskripsi' => $this->input->post('bakat'),
				'tingkat' => $this->input->post('tingkat'),
				'deskripsi' => $this->input->post('deskripsi'),
				'tahun_mulai' => $this->input->post('tahun_mulai'),
				'catatan' => $this->input->post('catatan')
			);
			$this->m_admin->update_datapengembanganDiri($data);
			$this->session->set_flashdata('success', 'Pengembangan Diri berhasil Diupdate');

			redirect('siswa/pengembanganDiri');
		}

		public function hapusdatapengembanganDiri($id) {
			$this->m_admin->delete_datapengembanganDiri($id);
			$this->session->set_flashdata('success', 'Minat Bakat berhasil Dihapus');
			redirect('siswa/pengembanganDiri');
		}
	// end

	// Laporan Pengaduan
		public function laporanPengaduan() {
			$siswa_id = $this->session->userdata('siswa_id');
			$detailSiswa = $this->m_admin->detail_siswa($siswa_id);
			$data = array(
				'title' => 'LAPORAN PENGADUAN',
				'detailSiswa' => $detailSiswa,
				'laporanPengaduan' => $this->m_admin->get_id_laporanPengaduan($siswa_id),
				'dataSiswa' => $this->m_admin->get_all_siswa(),
				'isi' => 'siswa/laporanPengaduan/data'
			);

			$this->load->view('siswa/layout/v_wrapper',$data,FALSE);
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

						$siswa_id = $this->session->userdata('siswa_id');
						$data = array(
							'siswa_id'  => $siswa_id,
							'judul_laporan' => $this->input->post('judul_laporan'),
							'ket_laporan' => $this->input->post('ket_laporan'),
							'nama_siswa' => $this->input->post('nama_siswa'),
							'create_at' => date('Y-m-d H:i:s'),
							'foto_laporan' => $upload_data['uploads']['file_name'], 
						);

						$this->m_admin->insert_datalaporanPengaduan($data);
						$this->session->set_flashdata('success', 'Laporan Pengaduan berhasil ditambahkan');
						redirect('siswa/laporanPengaduan');
					}
			}
			$this->session->set_flashdata('success', 'Laporan Pengaduan berhasil ditambahkan');
			redirect('siswa/laporanPengaduan');
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
						redirect('siswa/laporanPengaduan');
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
				redirect('siswa/laporanPengaduan');
			} else {
				$this->session->set_flashdata('success', validation_errors());
				redirect('siswa/laporanPengaduan');
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
			redirect('siswa/laporanPengaduan');
		}

	// end

	// Edukasi
		public function edukasi() {
			$data = array(
				'title' => 'EDUKASI SISWA',
				'edukasi' => $this->m_admin->get_all_edukasi(),
				'isi' => 'siswa/edukasi/data'
			);

			$this->load->view('siswa/layout/v_wrapper',$data,FALSE);
		}
	// end

	// Data Siswa
		public function updatedataSiswa($siswa_id)
		{
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required', array('required' => '%s Harus Diisi'));
			$this->form_validation->set_rules('nisn', 'NISN', 'required', array('required' => '%s Harus Diisi'));

			if ($this->form_validation->run() == TRUE) {
				$config['upload_path']   = './assets/image/foto_siswa/';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size']      = 5000;
				$this->upload->initialize($config);

				if (!empty($_FILES['foto_siswa']['name'])) {
					if (!$this->upload->do_upload('foto_siswa')) {
						$this->session->set_flashdata('success', 'Gambar gagal diupload');
						redirect('siswa');
					} else {
						$upload_data = array('uploads' => $this->upload->data());

						$siswa = $this->m_admin->detail_siswa($siswa_id);
						if ($siswa->foto_siswa != "" && file_exists('./assets/image/foto_siswa/' . $siswa->foto_siswa)) {
							unlink('./assets/image/foto_siswa/' . $siswa->foto_siswa);
						}

						$data = array(
							'nama_lengkap' => $this->input->post('nama_lengkap'),
							'nisn'   => $this->input->post('nisn'),
							'foto_siswa'  => $upload_data['uploads']['file_name'],
							'update_at'     => date('Y-m-d H:i:s'),
						);
					}
				} else {
					$data = array(
						'nama_lengkap' => $this->input->post('nama_lengkap'),
						'nisn'   => $this->input->post('nisn'),
						'update_at'     => date('Y-m-d H:i:s'),
					);
				}

				$this->m_admin->update_siswa($siswa_id, $data);
				$this->session->set_flashdata('success', 'Profil berhasil diperbarui');
				redirect('siswa');
			} else {
				$this->session->set_flashdata('success', validation_errors());
				redirect('siswa');
			}
		}
	// end
}
