<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'register'=>array(
		array('field'=>'username','label'=>'Nama akun','rules'=>'trim|required|is_unique[users.username]')
		,array('field'=>'password','label'=>'Kata sandi','rules'=>'trim|required')
		,array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[users.email]')
		,array('field'=>'group','label'=>'UserGroup ','rules'=>'trim|required')

	),
	'reset_password' => array(
		array('field'=>'password','label'=>'password','rules'=>'trim|required')
		,array('field'=>'cpassword','label'=>'konfirmasi password','rules'=>'trim|required|matches[password]')
	),
	'tambah_pegawai' => array(
array('field'=>'kontak_email','label'=>'Kontak Email','rules'=>'trim|required|valid_email|is_unique[pegawai.kontak_email]')
		,array('field'=>'tanggal_masuk','label'=>'Tanggal masuk','rules'=>'trim|required')
		,array('field'=>'nama_depan','label'=>'Nama Depan','rules'=>'trim|required')
		,array('field'=>'nomer_ktp','label'=>'Nomer KTP','rules'=>'trim|is_natural')
		,array('field'=>'nomer_npwp','label'=>'Nomer NPWP','rules'=>'trim|is_natural')
		,array('field'=>'kontak_hp','label'=>'Nomer handphone','rules'=>'trim|is_natural')
	),
	'tambah_fungsional_pegawai' => array(
		array('field'=>'id_pegawai','label'=>'Nama pegawai','rules'=>'trim|required')
		,array('field'=>'id_departement','label'=>'','rules'=>'trim|required|is_natural_no_zero')
		,array('field'=>'job_title','label'=>'','rules'=>'trim|required')
		,array('field'=>'id_group','label'=>'','rules'=>'trim|required|is_natural_no_zero')
		,array('field'=>'status_pegawai','label'=>'Status pegawai','rules'=>'trim|required')
	),
	'pegawai' => array(
		array('field'=>'kontak_hp','label'=>'Kontak hp','rules'=>'trim|required|is_natural')
		,array('field'=>'kontak_email','label'=>'Kontak email','rules'=>'trim|required|valid_email|is_unique[pegawai.kontak_email]')
		,array('field'=>'tanggal_masuk','label'=>'Tanggal masuk','rules'=>'trim|required')
	),
	'edit_pegawai' => array(
		array('field'=>'kontak_hp','label'=>'Kontak hp','rules'=>'trim|required|is_natural')
		,array('field'=>'kontak_email','label'=>'Kontak email','rules'=>'trim|required|valid_email')
		,array('field'=>'tanggal_masuk','label'=>'Tanggal masuk','rules'=>'trim|required')
	),
	'fungsional_pegawai' => array(
		array('field'=>'id_departement','label'=>'','rules'=>'trim|required|is_natural_no_zero')
		,array('field'=>'job_title','label'=>'','rules'=>'trim|required')
		,array('field'=>'id_group','label'=>'','rules'=>'trim|required|is_natural_no_zero')
		,array('field'=>'status_pegawai','label'=>'Status pegawai','rules'=>'trim|required')
	),
	'parameter_slip' => array(
		array('field'=>'nominal_parameter','label'=>'Nominal parameter','rules'=>'trim|is_natural_no_zero')
		,array('field'=>'parameter','label'=>'parameter','rules'=>'trim|required')
	),
	'informasi_slip' => array(
		array('field'=>'nama_instansi','label'=>'Nama instansi','rules'=>'trim|required')
		,array('field'=>'email_instansi','label'=>'Email instansi','rules'=>'trim|required')
		,array('field'=>'fax_instansi','label'=>'Fax instansi','rules'=>'trim|is_natural')
		,array('field'=>'telp_instansi','label'=>'No. Telp','rules'=>'trim|is_natural')
	),
	'format_slip' => array(
		array('field'=>'id_format','label'=>'format sudah ada','rules'=>'trim|is_natural')
		,array('field'=>'nomer_format','label'=>'Nomer format','rules'=>'trim|is_natural')
	),
	'post_pengajuan' => array(
		array('field'=>'satuan','label'=>'Satuan','rules'=>'trim|required')
		,array('field'=>'nama_item','label'=>'Nama item','rules'=>'trim|required')
		,array('field'=>'jumlah','label'=>'jumlah','rules'=>'trim|required|is_natural_no_zero')
	),
	'post_permintaan' => array(
		array('field'=>'judul_permintaan','label'=>'Judul Permintaan','rules'=>'trim|required')
		,array('field'=>'keperluan','label'=>'Keperluan','rules'=>'trim|required')
	),
	'aktiva' => array(
		array('field'=>'aktiva_tetap_enum','label'=>'Kebutuhan Aktifa Tetap','rules'=>'trim|required')
		,array('field'=>'golongan_aktiva_enum','label'=>'Golongan Aktifa','rules'=>'trim|required')
		,array('field'=>'estimasi_biaya','label'=>'Estimasi Biaya','rules'=>'trim|required|is_natural_no_zero')
	)
);

