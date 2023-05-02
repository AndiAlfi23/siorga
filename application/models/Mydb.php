<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mydb extends CI_Model
{
	//INPUT,UPDATE,DELETE
	function input_dt($data, $table)
	{
		$this->db->insert($table, $data);
	}
	function update_dt($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	function del($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	
	function truncate($table)
	{
		return $this->db->query('TRUNCATE TABLE ' . $table);
	}
	//ORGA
	function orga()
	{
		return $this->db->get_where('t_orga', ['id_orga' => '1'])->row_array();
	}
	//MENU
	function getMenu()
	{
		return $this->db->get('t_menu')->result_array();
	}
	function getSubMenu()
	{
		return $this->db->query('select t_sub_menu.* , t_menu.menu  
			from t_sub_menu join t_menu
			on t_sub_menu.id_menu = t_menu.id_menu')->result_array();
	}
	function select_role($id)
	{
		return $this->db->get_where('t_role', ['level' => $id])->row_array();
	}
	function select_menu($id)
	{
		return $this->db->get_where('t_menu', ['id_menu' => $id])->row_array();
	}
	function select_submenu($id)
	{
		return $this->db->get_where('t_sub_menu', ['id_sm' => $id])->row_array();
	}
	//LAINNYA
	function select_user($username)
	{
		return $this->db->query('select a.*, nama_jabatan 
								from t_anggota a, t_jabatan b
								where a.id_jabatan = b.id_jabatan 
								and a.username="' . $username . '"')->row_array();
	}
	function anggota()
	{
		return $this->db->query('select a.*, nama_jabatan 
								from t_anggota a, t_jabatan b
								where a.id_jabatan = b.id_jabatan 
								and a.level != "0"
								and a.level <5
								order by a.npm ASC')->result_array();
	}
	function get_anggota($id)
	{
		return $this->db->query('select a.*, nama_jabatan 
								from t_anggota a, t_jabatan b
								where a.id_jabatan = b.id_jabatan 
								and a.level != "0"
								and a.level <5
								AND a.id_mhs="' . $id . '"')->row_array();
	}
	function jabatan()
	{
		return $this->db->get('t_jabatan')->result_array();
	}
	function kegiatan()
	{
		return $this->db->query('select * from t_kegiatan order by tgl_kegiatan DESC')->result_array();
	}
	function newKegiatan()
	{
		return $this->db->query("select * from t_kegiatan order by tgl_kegiatan DESC limit 3")->result_array();
	}
	function getHistory($user, $limit)
	{
		return $this->db->query("select * from t_history 
		where username='" . $user . "' 
		order by id_history DESC " . $limit)->result_array();
	}
	function getJabatan($id)
	{
		return $this->db->get_where('t_jabatan', ['id_jabatan' => $id])->row_array();
	}
	function getKegiatan($no)
	{
		return $this->db->get_where('t_kegiatan', ['no_kegiatan' => $no])->result_array();
	}
	function getAbsen($no)
	{
		return $this->db->query("select concat(`b`.`tgl_kegiatan`,'.',`c`.`npm`) AS `no`,
		`b`.*,
		`c`.`id_mhs` AS `id_mhs`, `c`.`npm` AS `npm`, `c`.`nama` AS `nama`, 
		`a`.`status` AS `status` 
		from ((`t_absen` `a` join `t_kegiatan` `b`) join `t_anggota` `c`) 
		where `a`.`no_kegiatan` = `b`.`no_kegiatan` 
		and `a`.`id_mhs` = `c`.`id_mhs` 
		and `a`.no_kegiatan = '" . $no . "'
		order by concat(`b`.`tgl_kegiatan`,'.',`c`.`npm`)")->result_array();
		// return $this->db->get_where('v_absen', ['no_kegiatan' => $no])->result_array();
	}
	function selectKegiatan($no)
	{
		return $this->db->get_where('t_kegiatan', ['no_kegiatan' => $no])->row_array();
	}
	function selectAbsen($npm) //Profile
	{
		return $this->db->query("select concat(`b`.`tgl_kegiatan`,'.',`c`.`npm`) AS `no`,
		`b`.*,
		`c`.`id_mhs` AS `id_mhs`, `c`.`npm` AS `npm`, `c`.`nama` AS `nama`, 
		`a`.`status` AS `status` 
		from ((`t_absen` `a` join `t_kegiatan` `b`) join `t_anggota` `c`) 
		where `a`.`no_kegiatan` = `b`.`no_kegiatan` 
		and `a`.`id_mhs` = `c`.`id_mhs` 
		and c.npm = '" . $npm . "'")->result_array();
		// return $this->db->get_where('v_absen', ['npm' => $npm])->result_array();
	}
	function editAbsen($no, $id)
	{
		return $this->db->query("select concat(`b`.`tgl_kegiatan`,'.',`c`.`npm`) AS `no`,
		`b`.*,
		`c`.`id_mhs` AS `id_mhs`, `c`.`npm` AS `npm`, `c`.`nama` AS `nama`, 
		`a`.`status` AS `status` 
		from ((`t_absen` `a` join `t_kegiatan` `b`) join `t_anggota` `c`) 
		where `a`.`no_kegiatan` = `b`.`no_kegiatan` 
		and `a`.`id_mhs` = `c`.`id_mhs` 
		and a.id_mhs = '" . $id . "' 
		and b.no_kegiatan = '" . $no . "'")->row_array();
	}
	function getHadir($no)
	{
		return $this->db->query("select concat(`b`.`tgl_kegiatan`,'.',`c`.`npm`) AS `no`,
		`b`.*,
		`c`.`id_mhs` AS `id_mhs`, `npm`, `nama`, 
		`status` 
		from `t_absen` `a`,`t_kegiatan` `b`, `t_anggota` `c` 
		where `a`.`no_kegiatan` = `b`.`no_kegiatan` 
		and `a`.`id_mhs` = `c`.`id_mhs` 
		and a.status = 'Hadir' 
		and a.no_kegiatan = '" . $no . "' ORDER BY c.npm")->result_array();
	}
	function getNonHadir($no)
	{
		return $this->db->query("select a.*, npm, nama 
			from t_absen a, t_anggota b 
			where a.id_mhs = b.id_mhs
			and status!='Hadir' 
			and no_kegiatan='" . $no . "'")->result_array();
	}
	function totalAbsen($no)
	{
		return $this->db->query("select count(no_kegiatan) as total from t_absen 
			where status='Hadir' and no_kegiatan='" . $no . "'")->row_array();
	}
	function totalNonHadir($no)
	{
		return $this->db->query("select count(no_kegiatan) as total from t_absen 
			where status!='Hadir' 
			and no_kegiatan='" . $no . "'")->row_array();
	}
	function jmlAnggota()
	{
		return $this->db->query("select count(id_mhs) as jmlAnggota 
			from t_anggota 
			where level>0 and level<5")->row_array();
	}
	function jmlKegiatan()
	{
		return $this->db->query("select count(no_kegiatan) as jmlKegiatan from t_kegiatan")->row_array();
	}
	//CASH RULE
	function cash_rule($id)
	{
		if ($id == ' ') {
			return $this->db->get('t_cash_rule')->result_array();
		} else {
			return $this->db->get_where('t_cash_rule', ['id_cr' => $id])->row_array();
		}
	}
	//TAGIHAN
	function tagihan($no)
	{
		if ($no == ' ') {
			$query = $this->db->query('SELECT * FROM t_tagihan ORDER BY created_at DESC')->result_array();
			return $query;
		} else {
			return $this->db->get_where('t_tagihan', ['no_tg' => $no])->row_array();
		}
	}
	function getPembayaran($no, $id)
	{
		return $this->db->get_where('t_pembayaran', ['no_tg' => $no, 'id_mhs' => $id])->row_array();
	}
	function tagihan_anggota($no)
	{
		return $this->db->query('select b.id_mhs as id_mhs, npm, nama, a.no_ta, a.no_tg, 
							nama_tagihan, jml_tagihan, dibayar, pesan
							from t_tagihan_anggota a, t_anggota b, t_tagihan c
							where a.id_mhs = b.id_mhs 
							and a.no_tg = c.no_tg 
							and a.no_tg = "' . $no . '" 
							ORDER BY npm ASC')->result_array();
	}
	function tagihan_anggota2($no_ta)
	{
		return $this->db->query('select b.id_mhs as id_mhs, npm, nama, a.no_tg, nama_tagihan, jml_tagihan, dibayar, pesan
							from t_tagihan_anggota a, t_anggota b, t_tagihan c
							where a.id_mhs = b.id_mhs 
							and a.no_tg = c.no_tg 
							and a.no_ta = "' . $no_ta . '"')->result_array();
	}
	function jml_ta($no)  //jml anggota yg sudah dpt tagihan
	{
		return $this->db->query('select count(id_mhs) as jml_ta 
							from t_tagihan_anggota  
							where no_tg="' . $no . '"')->row_array();
	}
	function cek_ta($no, $id)
	{
		return $this->db->query('select * 
							from t_tagihan_anggota  
							where no_tg="' . $no . '" 
							and id_mhs="' . $id . '"')->row_array();
	}
	function s_tagihan($npm)
	{
		return $this->db->query('select a.* , b.dibayar, b.pesan, c.npm, c.nama 
								from t_tagihan a, t_tagihan_anggota b, t_anggota c 
								where b.no_tg = a.no_tg 
								and b.id_mhs = c.id_mhs 
								and c.npm = "' . $npm . '" 
								order by b.no_tg DESC')->result_array();
	}
	function s_pembayaran($npm)
	{
		if ($npm == 'no') {
			return $this->db->query('select a.* , b.no_pb, b.nominal_bayar, b.tgl_bayar, c.id_mhs, c.npm, c.nama 
			from t_tagihan a, t_pembayaran b, t_anggota c 
			where b.no_tg = a.no_tg 
			and b.id_mhs = c.id_mhs  
			order by b.no_pb DESC')->result_array();
		} else {
			return $this->db->query('select a.* , b.no_pb, b.nominal_bayar, b.tgl_bayar, c.id_mhs, c.npm, c.nama 
			from t_tagihan a, t_pembayaran b, t_anggota c 
			where b.no_tg = a.no_tg 
			and b.id_mhs = c.id_mhs 
			and c.npm = "' . $npm . '" 
			order by b.no_tg DESC')->result_array();
		}
	}
	function s_pb($no)
	{
		return $this->db->get_where('t_pembayaran', ['no_pb' => $no])->row_array();
	}
	function s_ta($no, $id)
	{
		return $this->db->query('select a.* ,  b.dibayar, c.id_mhs as id_mhs, c.npm, c.nama
								from t_tagihan a, t_tagihan_anggota b, t_anggota c 
								where b.no_tg = a.no_tg 
								and b.id_mhs = c.id_mhs 
								and b.no_tg = "' . $no . '" 
								and b.id_mhs = "' . $id . '"')->row_array();
	}
	//Pengeluaran
	function pengeluaran()
	{
		return $this->db->query('select * from t_pengeluaran order by tgl_pk DESC')->result_array();
	}
	function s_pk($no)
	{
		return $this->db->get_where('t_pengeluaran', ['no_pk' => $no])->row_array();
	}
	//CHART
	function bar_pm()
	{
		return $this->db->query('SELECT left(`t_pembayaran`.`tgl_bayar`,7) AS `tgl`,sum(nominal_bayar) as total 
			FROM `t_pembayaran` 
			group by tgl ASC')->result_array();
	}
	function bar_pk($tgl)
	{
		return $this->db->query('SELECT left(`t_pengeluaran`.`tgl_pk`,7) AS `tgl`,sum(jml_pk) as total_pk 
			FROM `t_pengeluaran` 
			WHERE left(`t_pengeluaran`.`tgl_pk`,7)="' . $tgl . '"')->row_array();
	}
	//LIST BELUM BAYAR TAGIHAN
	function nunggak()
	{
		return $this->db->query("SELECT a.id_mhs as id, c.nama as nm, sum(b.jml_tagihan) as jml, 
				sum(a.dibayar) as bayar, 
				sum(b.jml_tagihan)-sum(a.dibayar) as sisa
			FROM `t_tagihan_anggota` a, t_tagihan b, t_anggota c
			WHERE a.no_tg = b.no_tg AND a.id_mhs=c.id_mhs AND c.level > 0
			GROUP BY c.nama ASC  
			ORDER BY `sisa`  DESC
			LIMIT 3 ")->result_array();
	}
}
