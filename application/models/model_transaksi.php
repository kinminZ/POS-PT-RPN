<?php
	/**
	 * 
	 */
	class Model_transaksi extends CI_Model
	{
		
		function simpan_data_barang()
		{
			$nama_barang = $this->input->post('barang');
			$jumlah 	 = $this->input->post('jumlah');
			$idbarang 	 = $this->db->get_where('barang',array('nama_barang'=>$nama_barang))->row_array();
			$data 		 = array('id_barang'=>$idbarang['id_barang'],
								'jumlah'=>$jumlah,
								'harga'=>$idbarang['harga'],
								'harga_ppn'=>$idbarang['harga_ppn'],
								'status'=>'0');
			$this->db->insert('detail_transaksi',$data);
		}

		function simpan_data_kostumer()
		{
			$kostumer  		= $this->input->post('nama_kostumer');
			$no_trx			= $this->input->post('nomor_transaksi');
			$idkostumer		= $this->db->get_where('kostumer',array('nama_kostumer'=>$kostumer))->					  		row_array();
			$data 			= array('id_kostumer'=>$idkostumer['id_kostumer'],'nomor_transaksi'=>$no_trx,'status'=>'0');
			//$this->db->where('status =',0,FALSE);
			//$this->db->update('transaksi',$data);
			$this->db->insert('transaksi',$data);
		}

		function simpan_data_bayar()
		{
			$bayar = $this->input->post('bayar');
			$user = $this->session->userdata('username');
			$id_op = $this->db->get_where('operator',array('username'=>$user))->row_array();
			$data = array('id_operator'=>$id_op['id_operator'],'status_bayar'=>$bayar);			
			$this->db->where('status =',0,FALSE);
			$this->db->update('transaksi',$data);
		}

		function tampil_data_barang()
		{
			$query = "SELECT dt.id_detailtrx, dt.jumlah, dt.harga, dt.harga_ppn, b.nama_barang, sb.nama_satuan
			FROM detail_transaksi as dt, barang as b, satuan_barang as sb
			WHERE b.id_barang=dt.id_barang and b.id_satuan=sb.id_satuan and dt.status='0'";
			return $this->db->query($query);
		}

		function tampil_data_barang_laporan($trx)
		{
			$query = "SELECT dt.id_detailtrx, dt.jumlah, dt.harga, dt.harga_ppn, b.nama_barang, sb.nama_satuan
			FROM detail_transaksi as dt, barang as b, satuan_barang as sb, transaksi as t
			WHERE b.id_barang=dt.id_barang and b.id_satuan=sb.id_satuan and t.id_transaksi=dt.id_transaksi and t.nomor_transaksi='$trx'";
			return $this->db->query($query);
		}

		function tampil_data_kostumer()
		{
			$query = "SELECT nama_kostumer, kontak, alamat, kode_pos
			FROM kostumer";
			return $this->db->query($query);
		}

		function tampil_data_detail_kostumer()
		{
			$query = "SELECT t.nomor_transaksi, t.tgl_transaksi,k.nama_kostumer,k.kontak,k.alamat,k.kode_pos
			FROM transaksi as t, kostumer as k
			WHERE t.id_kostumer=k.id_kostumer and t.status='0'";
			return $this->db->query($query);
		}

		function tampil_data_detail_kostumer_laporan($trx)
		{
			$query = "SELECT t.nomor_transaksi, t.tgl_transaksi,k.nama_kostumer,k.kontak,k.alamat,k.kode_pos
			FROM transaksi as t, kostumer as k
			WHERE t.id_kostumer=k.id_kostumer and t.nomor_transaksi='$trx'";
			return $this->db->query($query);
		}

		function tampil_data_trx()
		{
			$query = "SELECT t.status_bayar, c.nama_cabang, c.rekening, c.no_rek
			FROM transaksi as t, operator as o, cabang_organisasi as c
			WHERE t.id_operator=o.id_operator and o.id_cabang=c.id_cabang and t.status='0'";
			return $this->db->query($query);
		}

		function tampil_data_trx_cetak()
		{
			$query = "SELECT t.status_bayar, c.nama_cabang, c.rekening, c.no_rek
			FROM transaksi as t, operator as o, cabang_organisasi as c
			WHERE t.id_operator=o.id_operator and o.id_cabang=c.id_cabang and t.status='0'";
			return $this->db->query($query);
		}

		function tampil_data_trx_laporan($trx)
		{
			$query = "SELECT t.status_bayar, c.rekening, c.no_rek
			FROM transaksi as t, operator as o, cabang_organisasi as c
			WHERE t.id_operator=o.id_operator and o.id_cabang=c.id_cabang and t.nomor_transaksi='$trx'";
			return $this->db->query($query);
		}

		function hapus_data($id)
		{
			$this->db->where('id_detailtrx',$id);
			$this->db->delete('detail_transaksi');
		}

		function selesai($data)
		{
			$this->db->where('status =',0,FALSE);
			$this->db->update('transaksi',$data);
			$id_akhir = $this->db->query('SELECT id_transaksi from transaksi order by id_transaksi desc')->row_array();
			$this->db->query("UPDATE detail_transaksi SET id_transaksi='".$id_akhir['id_transaksi']."' WHERE status='NULL'");
			$this->db->query("UPDATE detail_transaksi SET status='1' WHERE status='NULL'");
			$this->db->query("UPDATE transaksi SET status='1' WHERE status='0'");

		}

		function hapus_transaksi()
		{
			$this->db->where('status =',0,FALSE);
			$this->db->delete('transaksi');
		}

		function cetak_transaksi()
		{
			$nmr_trx = $this->session->userdata('nomor_transaksi');
			$query = "SELECT t.nomor_transaksi, t.tgl_transaksi, o.nama_lengkap, k.nama_kostumer, k.kontak, k.alamat, k.kode_pos, b.nama_barang, dt.jumlah, dt.harga, dt.harga_ppn
			FROM transaksi as t, detail_transaksi as dt, kostumer as k, operator as o, barang as b
			WHERE t.id_transaksi=dt.id_transaksi and t.nomor_transaksi='1'";
			return $this->db->query($query);
		}

		function laporan_default()
		{
			$query = "SELECT t.tgl_transaksi, t.nomor_transaksi, o.nama_lengkap, sum(dt.harga_ppn*dt.jumlah) as total, c.nama_cabang
			FROM transaksi as t, detail_transaksi as dt, operator as o, cabang_organisasi as c
			WHERE dt.id_transaksi=t.id_transaksi and o.id_operator=t.id_operator and c.id_cabang=o.id_cabang
			group by t.id_transaksi";
			return $this->db->query($query);
		}

		function laporan_periode($tgl1,$tgl2)
		{
			$query = "SELECT t.tgl_transaksi, t.nomor_transaksi, t.status_bayar, o.nama_lengkap, sum(dt.harga_ppn*dt.jumlah) as total, c.nama_cabang
			FROM transaksi as t, detail_transaksi as dt, operator as o, cabang_organisasi as c
			WHERE dt.id_transaksi=t.id_transaksi and o.id_operator=t.id_operator and c.id_cabang=o.id_cabang and t.tgl_transaksi between '$tgl1' and '$tgl2'
			group by t.id_transaksi";
			return $this->db->query($query);
		}

		function laporan_operator()
		{
			$user = $this->session->userdata('username');
			$query = "SELECT t.tgl_transaksi, t.nomor_transaksi, t.status_bayar, o.username, sum(dt.harga_ppn*dt.jumlah) as total
			FROM transaksi as t, detail_transaksi as dt, operator as o
			WHERE dt.id_transaksi=t.id_transaksi and o.id_operator=t.id_operator and o.username='$user'
			group by t.id_transaksi";
			return $this->db->query($query);
		}

		function get_one($id)
		{
			$param = array('nomor_transaksi'=>$id);
			return $this->db->get_where('transaksi',$param);
		}
	}
?>