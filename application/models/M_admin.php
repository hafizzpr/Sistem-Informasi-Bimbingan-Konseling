<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin extends CI_Model{

	public function getJumlahPelanggaranPerJenis()
	{
		$this->db->select('jp.nama_pelanggaran, COUNT(ps.pelanggaran_id) AS jumlah');
		$this->db->from('pelanggaran_siswa ps');
		$this->db->join('jenis_pelanggaran jp', 'ps.jenis_id = jp.jenis_id', 'left');
		$this->db->group_by('ps.jenis_id');
		$query = $this->db->get();
		return $query->result_array();
	}


	//Siswa
		public function add_dataSiswa($data) {
			$this->db->insert('users', $data);
			return $this->db->insert_id();
		}

		public function insert_dataSiswa($data) {
			return $this->db->insert('siswa', $data);
		}

		public function get_jumlah_siswa_per_kelas() 
		{
			$this->db->select('kelas, COUNT(*) as jumlah');
			$this->db->from('siswa');
			$this->db->where('kelas !=', 'LULUS');
			$this->db->group_by('kelas');
			$this->db->order_by('kelas', 'ASC');
			return $this->db->get()->result();
		}

		public function get_jumlah_pelanggaran_per_kelas()
		{
			$this->db->select('s.kelas, COALESCE(SUM(jp.poin_pengurang),0) as total_poin');
			$this->db->from('siswa s');
			$this->db->join('pelanggaran_siswa ps', 's.siswa_id = ps.siswa_id', 'left');
			$this->db->join('jenis_pelanggaran jp', 'jp.jenis_id = ps.jenis_id', 'left');
			$this->db->where('s.kelas !=', 'LULUS'); 
			$this->db->group_by('s.kelas');
			$this->db->order_by('s.kelas', 'ASC');
			return $this->db->get()->result();
		}

		public function get_pelanggaran_by_kelas($kelas)
		{
			$this->db->select('s.siswa_id, s.nama_lengkap, s.kelas, COALESCE(SUM(jp.poin_pengurang),0) as total_poin');
			$this->db->from('siswa s');
			$this->db->join('pelanggaran_siswa ps', 's.siswa_id = ps.siswa_id', 'left');
			$this->db->join('jenis_pelanggaran jp', 'jp.jenis_id = ps.jenis_id', 'left');
			$this->db->where('s.kelas', $kelas);
			$this->db->group_by('s.siswa_id');
			$this->db->order_by('s.nama_lengkap', 'ASC');
			return $this->db->get()->result();
		}

		public function get_pelanggaran_siswa()
		{
			$this->db->select('s.siswa_id, s.nama_lengkap, s.kelas, COALESCE(SUM(jp.poin_pengurang),0) as total_poin');
			$this->db->from('siswa s');
			$this->db->join('pelanggaran_siswa ps', 's.siswa_id = ps.siswa_id', 'left');
			$this->db->join('jenis_pelanggaran jp', 'jp.jenis_id = ps.jenis_id', 'left');
			$this->db->group_by('s.siswa_id');
			$this->db->order_by('s.nama_lengkap', 'ASC');
			return $this->db->get()->result();
		}


		public function get_all_siswa() {
			$this->db->select('siswa.*, users.username, users.email, users.status_akun');
			$this->db->from('siswa');
			$this->db->join('users', 'users.user_id = siswa.user_id');
			$this->db->order_by('siswa.kelas', 'ASC');
			return $this->db->get()->result();
		}

		public function get_id_siswa($siswa_id) {
			$this->db->select('*');
			$this->db->from('siswa');
			$this->db->where('siswa_id', $siswa_id);
			return $this->db->get()->result();
		}

		public function detail_siswa($siswa_id)
		{
			$this->db->select('*');
			$this->db->from('siswa');
			$this->db->where('siswa_id', $siswa_id);
			return $this->db->get()->row();
		}

		public function update_user($user_id, $data)
		{
			$this->db->where('user_id', $user_id);
			$this->db->update('users', $data);
		}

		public function update_siswa($siswa_id, $data)
		{
			$this->db->where('siswa_id', $siswa_id);
			$this->db->update('siswa', $data);
		}

		public function get_siswa_by_user($user_id)
		{
			return $this->db->get_where('siswa', ['user_id' => $user_id])->row();
		}

		public function delete_siswa_by_user($user_id)
		{
			$this->db->where('user_id', $user_id);
			$this->db->delete('siswa');
		}

		public function delete_user($user_id)
		{
			$this->db->where('user_id', $user_id);
			$this->db->delete('users');
		}

		public function get_all_ids() {
			$result = $this->db->select('siswa_id')->get('siswa')->result();
			return array_map(function($r) { return $r->siswa_id; }, $result);
		}

		public function update_naik_kelas($siswa_id, $status) {
			$this->db->where('siswa_id', $siswa_id);
			return $this->db->update('siswa', ['naik_kelas' => $status]);
		}

		public function get_all_siswa_yang_belum_lulus() {
			return $this->db->where('kelas !=', 'LULUS')->get('siswa')->result();
		}


		public function naikkan_kelas() {
			$sql = "
				UPDATE siswa
				SET kelas = CASE
					WHEN kelas = 'X' THEN 'XI'
					WHEN kelas = 'XI' THEN 'XII'
					WHEN kelas = 'XII' THEN 'LULUS'
					ELSE kelas
				END
				WHERE naik_kelas = 'YA'
			";
			return $this->db->query($sql);
		}

		public function get_kelas_siswa($kelas)
		{
			$this->db->select('*');
			$this->db->from('siswa');
			$this->db->where('kelas', $kelas);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_siswa_by_kelas($kelas) {
			$this->db->select('*');
			$this->db->from('siswa');
			$this->db->where('kelas', $kelas);
			$this->db->order_by('nama_lengkap', 'ASC'); // urut berdasarkan nama
			return $this->db->get()->result();
		}

	// end

	//Guru
		public function add_dataGuru($data) {
			$this->db->insert('users', $data);
			return $this->db->insert_id();
		}

		public function insert_dataGuru($data) {
			return $this->db->insert('guru', $data);
		}

		public function detail_guru($guru_id)
		{
			$this->db->select('*');
			$this->db->from('guru');
			$this->db->where('guru_id', $guru_id);
			return $this->db->get()->row(); // hanya ambil satu baris
		}

		public function get_all_guru() {
			$this->db->select('guru.*, users.username, users.email, users.status_akun');
			$this->db->from('guru');
			$this->db->join('users', 'users.user_id = guru.user_id');
			return $this->db->get()->result(); 
		}

		public function update_guru($guru_id, $data)
		{
			$this->db->where('guru_id', $guru_id);
			$this->db->update('guru', $data);
		}

		public function get_guru_by_user($user_id)
		{
			return $this->db->get_where('guru', ['user_id' => $user_id])->row();
		}

		public function delete_guru_by_user($user_id)
		{
			$this->db->where('user_id', $user_id);
			$this->db->delete('guru');
		}

		public function get_id_guru($guru_id) {
			$this->db->select('*');
			$this->db->from('guru');
			$this->db->where('guru_id', $guru_id);
			return $this->db->get()->result();
		}

		public function get_pass_guru($guru_id) {
			$this->db->select('guru.*, users.username, users.email, users.status_akun');
			$this->db->from('guru');
			$this->db->join('users', 'users.user_id = guru.user_id');
			$this->db->where('guru_id', $guru_id);
			return $this->db->get()->result(); 
		}
	// end

	// Jadwal Konseling
		public function total_jadwal()
		{
			return $this->db->count_all_results('jadwal_konseling');
		}

		public function get_all_jadwal() {
			$this->db->select('jadwal_konseling.*, siswa.nama_lengkap, guru.nama_guru');
			$this->db->from('jadwal_konseling');
			$this->db->join('siswa', 'siswa.siswa_id = jadwal_konseling.siswa_id');
			$this->db->join('guru', 'guru.guru_id = jadwal_konseling.guru_id');
			return $this->db->get()->result();
		}

		public function home_all_jadwal() {
			$this->db->select('jadwal_konseling.*, siswa.nama_lengkap, guru.nama_guru');
			$this->db->from('jadwal_konseling');
			$this->db->join('siswa', 'siswa.siswa_id = jadwal_konseling.siswa_id');
			$this->db->join('guru', 'guru.guru_id = jadwal_konseling.guru_id');
			$this->db->limit(5);
			return $this->db->get()->result();
		}

		public function guru_all_jadwal() {
			$this->db->select('jadwal_konseling.*, siswa.nama_lengkap, guru.nama_guru');
			$this->db->from('jadwal_konseling');
			$this->db->join('siswa', 'siswa.siswa_id = jadwal_konseling.siswa_id');
			$this->db->join('guru', 'guru.guru_id = jadwal_konseling.guru_id');

			$now = date('Y-m-d H:i:s');
			$this->db->where("CONCAT(tanggal, ' ', waktu) >=", $now);

			$this->db->order_by('tanggal', 'ASC');
			$this->db->order_by('waktu', 'ASC');
			$this->db->limit(5);
			return $this->db->get()->result();
		}

		public function get_all_jadwal_siswa($siswa_id) {
			$this->db->select('jadwal_konseling.*, siswa.nama_lengkap, guru.nama_guru');
			$this->db->from('jadwal_konseling');
			$this->db->join('siswa', 'siswa.siswa_id = jadwal_konseling.siswa_id');
			$this->db->join('guru', 'guru.guru_id = jadwal_konseling.guru_id');
			$this->db->where('jadwal_konseling.siswa_id', $siswa_id); // filter berdasarkan siswa
			return $this->db->get()->result();
		}

		public function detail_jadwalKonseling($jadwal_id)
        {
            $this->db->select('*');
            $this->db->from('jadwal_konseling');
			$this->db->join('siswa', 'siswa.siswa_id = jadwal_konseling.siswa_id');
			$this->db->join('guru', 'guru.guru_id = jadwal_konseling.guru_id');
            $this->db->where('jadwal_id', $jadwal_id);
            return $this->db->get()->row();
        }

		public function insert_jadwal($data) {
			return $this->db->insert('jadwal_konseling', $data);
		}

		 public function update_JadwalKonseling($data)
        {
            $this->db->where('jadwal_id', $data['jadwal_id']);
            $this->db->update('jadwal_konseling', $data);
        }

		public function update_statusKonseling($id, $status) {
			$this->db->where('jadwal_id', $id);
			return $this->db->update('jadwal_konseling', ['status' => $status]);
		}

		public function delete_jadwalkonseling($jadwal_id) {
			$this->db->where('jadwal_id', $jadwal_id);
			$this->db->delete('jadwal_konseling');
		}

		public function view_all_JadwalKonseling()
        {
           $this->db->join('siswa', 'siswa.siswa_id = jadwal_konseling.siswa_id');
			$this->db->join('guru', 'guru.guru_id = jadwal_konseling.guru_id');
            $this->db->order_by('siswa.nama_lengkap', 'ASC');
            return $this->db->get('jadwal_konseling')->result();
        }

        public function view_by_date_JadwalKonseling($tgl_awal, $tgl_akhir)
        {
            $tgl_awal = $this->db->escape($tgl_awal);
            $tgl_akhir = $this->db->escape($tgl_akhir);
           	$this->db->join('siswa', 'siswa.siswa_id = jadwal_konseling.siswa_id');
			$this->db->join('guru', 'guru.guru_id = jadwal_konseling.guru_id');
            $this->db->where('DATE(tanggal) BETWEEN '.$tgl_awal.' AND '.$tgl_akhir);
			$this->db->order_by('siswa.nama_lengkap', 'ASC'); 
            return $this->db->get('jadwal_konseling')->result();
        }

		// Total Pengajuan Konseling Siswa
			public function total_jadwalkonseling($siswa_id)
			{
				$this->db->where('siswa_id', $siswa_id);
				return $this->db->count_all_results('jadwal_konseling');
			}
	// end

	// Catatan Konseling
		public function insert_catatanKonseling($data) {
			return $this->db->insert('catatan_konseling', $data);
		}
	
		public function detail_catatanKonseling($jadwal_id)
        {
            $this->db->select('*');
            $this->db->from('catatan_konseling');
            $this->db->where('jadwal_id', $jadwal_id);
            return $this->db->get()->result();
        }
	// end

	// Jenis Pelanggaran
		public function get_all_pelanggaran() {
			$this->db->select('*');
			$this->db->from('jenis_pelanggaran');
			return $this->db->get()->result();
		}

		public function insert_dataPelanggaran($data) {
			return $this->db->insert('jenis_pelanggaran', $data);
		}

		public function update_dataPelanggaran($data)
        {
            $this->db->where('jenis_id', $data['jenis_id']);
            $this->db->update('jenis_pelanggaran', $data);
        }

		public function delete_dataPelanggaran($jenis_id) {
			$this->db->where('jenis_id', $jenis_id);
			$this->db->delete('jenis_pelanggaran');
		}
	// end

	// Pelanggaran Siswa
		public function get_all_dataPelanggaran() {
			$this->db->select('*');
			$this->db->from('pelanggaran_siswa');
			$this->db->join('jenis_pelanggaran', 'jenis_pelanggaran.jenis_id = pelanggaran_siswa.jenis_id');
			$this->db->join('siswa', 'siswa.siswa_id = pelanggaran_siswa.siswa_id');
			$this->db->order_by('pelanggaran_id', 'DESC');
			$this->db->limit(5);
			return $this->db->get()->result();
		}

		public function detail_dataPelanggaran($siswa_id)
		{
			$this->db->select('*');
			$this->db->from('pelanggaran_siswa');
			$this->db->join('jenis_pelanggaran', 'jenis_pelanggaran.jenis_id = pelanggaran_siswa.jenis_id');
			$this->db->join('semester', 'semester.semester_id = pelanggaran_siswa.semester_id');
			$this->db->join('siswa', 'siswa.siswa_id = pelanggaran_siswa.siswa_id');
			$this->db->where('pelanggaran_siswa.siswa_id', $siswa_id);
			return $this->db->get()->result();
		}

		public function getTotalPoinPerSemester($siswa_id)
		{
			$this->db->select('semester.nama_semester, SUM(jenis_pelanggaran.poin_pengurang) as total_poin');
			$this->db->from('pelanggaran_siswa');
			$this->db->join('semester', 'semester.semester_id = pelanggaran_siswa.semester_id');
			$this->db->join('jenis_pelanggaran', 'jenis_pelanggaran.jenis_id = pelanggaran_siswa.jenis_id');
			$this->db->where('pelanggaran_siswa.siswa_id', $siswa_id);
			$this->db->group_by('pelanggaran_siswa.semester_id');
			$this->db->order_by('semester.nama_semester', 'ASC');
			
			return $this->db->get()->result();
		}


		public function insert_dataPelanggaranSiswa($data) {
			return $this->db->insert('pelanggaran_siswa', $data);
		}

		public function get_id_dataPelanggaran($siswa_id) {
			$this->db->select('*');;
			$this->db->from('pelanggaran_siswa');
			$this->db->join('semester', 'semester.semester_id = pelanggaran_siswa.semester_id');
			$this->db->join('jenis_pelanggaran', 'jenis_pelanggaran.jenis_id = pelanggaran_siswa.jenis_id');
			$this->db->join('siswa', 'siswa.siswa_id = pelanggaran_siswa.siswa_id');
			$this->db->where('pelanggaran_siswa.siswa_id', $siswa_id);
			return $this->db->get()->result();

			$result = [];
			foreach ($query as $row) {
				$result[$row->semester][] = $row;
			}
			return $result;
		}
		
		public function update_dataPelanggaranSiswa($data)
        {
            $this->db->where('pelanggaran_id', $data['pelanggaran_id']);
            $this->db->update('pelanggaran_siswa', $data);
        }

		public function detail_dataPelanggaranSiswa($siswa_id)
		{
			$this->db->select('*');
			$this->db->from('pelanggaran_siswa');
			$this->db->join('siswa', 'siswa.siswa_id = pelanggaran_siswa.siswa_id');
			$this->db->where('pelanggaran_siswa.siswa_id', $siswa_id);
			return $this->db->get()->row();
		}

		public function delete_pelanggaranSiswa($pelanggaran_id) {
			$this->db->where('pelanggaran_id', $pelanggaran_id);
			$this->db->delete('pelanggaran_siswa');
		}

		public function poin_dataPelanggaranSiswa($siswa_id)
		{
			$this->db->select('SUM(jenis_pelanggaran.poin_pengurang) AS total_poin');
			$this->db->from('pelanggaran_siswa');
			$this->db->join('jenis_pelanggaran', 'jenis_pelanggaran.jenis_id = pelanggaran_siswa.jenis_id');
			$this->db->where('pelanggaran_siswa.siswa_id', $siswa_id);
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				return $query->row()->total_poin ?? 0;
			} else {
				return 0;
			}
		}

		public function get_poin_pelanggaran_per_semester()
		{
			$this->db->select('semester.nama_semester, SUM(jenis_pelanggaran.poin_pengurang) as total_poin');
			$this->db->from('pelanggaran_siswa');
			$this->db->join('semester', 'pelanggaran_siswa.semester_id = semester.semester_id');
			$this->db->join('jenis_pelanggaran', 'pelanggaran_siswa.jenis_id = jenis_pelanggaran.jenis_id');
			$this->db->group_by('pelanggaran_siswa.semester_id');
			$this->db->order_by('semester.semester_id', 'ASC');
			return $this->db->get()->result();
		}


		// top 5 siswa
		public function get_top5_pelanggaran() 
		{
			$this->db->select('siswa.siswa_id, siswa.nama_lengkap, SUM(jenis_pelanggaran.poin_pengurang) AS total_poin');
			$this->db->from('pelanggaran_siswa');
			$this->db->join('jenis_pelanggaran', 'jenis_pelanggaran.jenis_id = pelanggaran_siswa.jenis_id');
			$this->db->join('siswa', 'siswa.siswa_id = pelanggaran_siswa.siswa_id');
			$this->db->group_by('siswa.siswa_id');
			$this->db->order_by('total_poin', 'DESC');
			$this->db->limit(5);
			return $this->db->get()->result();
		}

		public function view_all_PelanggaranSiswa()
		{
			$this->db->join('siswa', 'siswa.siswa_id = pelanggaran_siswa.siswa_id');
			$this->db->join('semester', 'semester.semester_id = pelanggaran_siswa.semester_id');
			$this->db->join('jenis_pelanggaran', 'jenis_pelanggaran.jenis_id = pelanggaran_siswa.jenis_id');
			$this->db->order_by('siswa.nama_lengkap', 'ASC');
			return $this->db->get('pelanggaran_siswa')->result();
		}

		public function view_by_date_PelanggaranSiswa($tgl_awal, $tgl_akhir)
		{
			$tgl_awal = $this->db->escape($tgl_awal);
			$tgl_akhir = $this->db->escape($tgl_akhir);
			$this->db->join('siswa', 'siswa.siswa_id = pelanggaran_siswa.siswa_id');
			$this->db->join('semester', 'semester.semester_id = pelanggaran_siswa.semester_id');
			$this->db->join('jenis_pelanggaran', 'jenis_pelanggaran.jenis_id = pelanggaran_siswa.jenis_id');
			$this->db->where('DATE(tanggal) BETWEEN '.$tgl_awal.' AND '.$tgl_akhir);
			$this->db->order_by('siswa.nama_lengkap', 'ASC'); 
			return $this->db->get('pelanggaran_siswa')->result();
		}
	// end

	// Pengajuan Konseling
		public function get_all_pengajuan() {
			$this->db->select('pengajuan_konseling.*, siswa.nama_lengkap');
			$this->db->from('pengajuan_konseling');
			$this->db->join('siswa', 'siswa.siswa_id = pengajuan_konseling.siswa_id');
			return $this->db->get()->result();
		}

		public function all_pengajuan() {
			$this->db->select('pengajuan_konseling.*, siswa.nama_lengkap');
			$this->db->from('pengajuan_konseling');
			$this->db->join('siswa', 'siswa.siswa_id = pengajuan_konseling.siswa_id');

			$today = date('Y-m-d');
			$this->db->where('tanggal_pengajuan >=', $today);
			$this->db->where('status', 'Menunggu');

			$this->db->order_by('tanggal_pengajuan', 'ASC');
			$this->db->limit(5);
			return $this->db->get()->result();
		}

		public function home_all_pengajuan() {
			$this->db->select('pengajuan_konseling.*, siswa.nama_lengkap');
			$this->db->from('pengajuan_konseling');
			$this->db->join('siswa', 'siswa.siswa_id = pengajuan_konseling.siswa_id');
			$this->db->limit(5);
			return $this->db->get()->result();
		}

		public function get_all_pengajuansiswa($siswa_id) {
			$this->db->select('pengajuan_konseling.*, siswa.nama_lengkap');
			$this->db->from('pengajuan_konseling');
			$this->db->join('siswa', 'siswa.siswa_id = pengajuan_konseling.siswa_id');
			$this->db->where('pengajuan_konseling.siswa_id', $siswa_id);
			return $this->db->get()->result();
		}

		public function detail_pengajuanKonseling($pengajuan_id)
        {
            $this->db->select('*');
            $this->db->from('pengajuan_konseling');
			$this->db->join('siswa', 'siswa.siswa_id = pengajuan_konseling.siswa_id');
            $this->db->where('pengajuan_id', $pengajuan_id);
            return $this->db->get()->row();
        }

		public function insert_pengajuan($data) {
			return $this->db->insert('pengajuan_konseling', $data);
		}

		 public function update_pengajuanKonseling($data)
        {
            $this->db->where('pengajuan_id', $data['pengajuan_id']);
            $this->db->update('pengajuan_konseling', $data);
        }

		public function view_all_PengajuanKonseling()
		{
			$this->db->join('siswa', 'siswa.siswa_id = pengajuan_konseling.siswa_id');
			$this->db->order_by('siswa.nama_lengkap', 'ASC');
			return $this->db->get('pengajuan_konseling')->result();
		}

		public function view_by_date_PengajuanKonseling($tgl_awal, $tgl_akhir)
		{
			$tgl_awal = $this->db->escape($tgl_awal);
			$tgl_akhir = $this->db->escape($tgl_akhir);
			$this->db->join('siswa', 'siswa.siswa_id = pengajuan_konseling.siswa_id');
			$this->db->where('DATE(tanggal_pengajuan) BETWEEN '.$tgl_awal.' AND '.$tgl_akhir);
			$this->db->order_by('siswa.nama_lengkap', 'ASC'); 
			return $this->db->get('pengajuan_konseling')->result();
		}

		public function total_pengajuan_konseling()
		{
			return $this->db->count_all_results('pengajuan_konseling');
		}

		// Total Pengajuan Konseling Siswa
		public function total_pengajuan_siswa($siswa_id)
		{
			$this->db->where('siswa_id', $siswa_id);
			return $this->db->count_all_results('pengajuan_konseling');
		}
	// end

	// Minat Bakat
		public function get_id_pengembanganDiri($siswa_id) {
			$this->db->select('*');;
			$this->db->from('pengembangan_diri');
			$this->db->join('siswa', 'siswa.siswa_id = pengembangan_diri.siswa_id');
			$this->db->where('pengembangan_diri.siswa_id', $siswa_id);
			return $this->db->get()->result();
		}

		public function insert_datapengembanganDiri($data) {
			return $this->db->insert('pengembangan_diri', $data);
		}

		public function update_datapengembanganDiri($data)
        {
            $this->db->where('pengembangan_id', $data['pengembangan_id']);
            $this->db->update('pengembangan_diri', $data);
        }

		public function delete_datapengembanganDiri($pengembangan_id) {
			$this->db->where('pengembangan_id', $pengembangan_id);
			$this->db->delete('pengembangan_diri');
		}
	// End

	// Semester
		public function get_all_semester() {
			$this->db->select('*');;
			$this->db->from('semester');
			return $this->db->get()->result();
		}

		public function insertdataSemester($data) {
			return $this->db->insert('semester', $data);
		}

		public function update_dataSemester($data)
        {
            $this->db->where('semester_id', $data['semester_id']);
            $this->db->update('semester', $data);
        }

		public function delete_Semester($semester_id) {
			$this->db->where('semester_id', $semester_id);
			$this->db->delete('semester');
		}
	// End

	// Laporan Pengaduan
		public function laporanPengaduan() {
			$this->db->select('*');;
			$this->db->from('laporan_pengaduan');
			return $this->db->get()->result();
		}

		public function get_id_laporan($guru_id) {
			$this->db->select('*');;
			$this->db->from('laporan_pengaduan');
			$this->db->join('guru', 'guru.guru_id = laporan_pengaduan.guru_id');
			$this->db->where('laporan_pengaduan.guru_id', $guru_id);
			return $this->db->get()->result();
		}

		public function get_id_laporanPengaduan($siswa_id) {
			$this->db->select('*');;
			$this->db->from('laporan_pengaduan');
			$this->db->join('siswa', 'siswa.siswa_id = laporan_pengaduan.siswa_id');
			$this->db->where('laporan_pengaduan.siswa_id', $siswa_id);
			return $this->db->get()->result();
		}

		public function detail_laporanPengaduan($laporan_id)
		{
			$this->db->select('*');
			$this->db->from('laporan_pengaduan');
			$this->db->join('siswa', 'siswa.siswa_id = laporan_pengaduan.siswa_id');
			$this->db->where('laporan_id', $laporan_id);
			return $this->db->get()->result();
		}

		public function insert_datalaporanPengaduan($data) {
			return $this->db->insert('laporan_pengaduan', $data);
		}

		public function get_laporanById($laporan_id)
		{
			return $this->db->get_where('laporan_pengaduan', array('laporan_id' => $laporan_id))->row();
		}

		public function update_datalaporanPengaduan($laporan_id, $data)
		{
			$this->db->where('laporan_id', $laporan_id); // sesuaikan nama kolom PK di tabel Anda
			$this->db->update('laporan_pengaduan', $data);
		}

		public function delete_datalaporanPengaduan($laporan_id) {
			$this->db->where('laporan_id', $laporan_id);
			$this->db->delete('laporan_pengaduan');
		}
	// End

	// edukasi
		public function get_all_edukasi() {
			$this->db->select('*');;
			$this->db->from('edukasi');
			return $this->db->get()->result();
		}

		public function insert_edukasi($data) {
			return $this->db->insert('edukasi', $data);
		}

		public function detail_edukasi($edukasi_id)
		{
			$this->db->select('*');
			$this->db->from('edukasi');
			$this->db->where('edukasi_id', $edukasi_id);
			return $this->db->get()->row();
		}

		public function update_edukasi($edukasi_id, $data)
        {
            $this->db->where('edukasi_id',$edukasi_id);
            $this->db->update('edukasi', $data);
        }

		public function delete_edukasi($edukasi_id) {
			$this->db->where('edukasi_id', $edukasi_id);
			$this->db->delete('edukasi');
		}
	// End
	
}