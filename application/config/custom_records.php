<?php

/**
 * Group id
 * 1 => superadmin
 * 2 => purchasing
 * 3 => personalia
 * 4 => multimedia
 * 5 => operator
 * 6 => marketing
 * 7 => teknisi
 * 8 => gudang
 * 9 => direksi
 * 10 => auditor
 *
 * Permission (delete,edit,primary_key,array(
 * 		'custom' => 'custom_url'
 * ))
 * 1 = enable
 * 0 = disable
 */


$config['users']['show'] = array(
	'name'
	,'username'
	,'email'
	,'last_login'
	,'phone'
);
$config['users']['input'] = array(
	'username'
	,'email'
	,'active'
);
$config['users']['toolbar']= array(
	'1' => array('tambah'),
	'11' => array('superadmin/create_user')
);
$config['users']['action'] = array(
	'11'=>array(
		'active' => array(
			'1' => array('matikan'=>'superadmin/set_pasive/')
			,'0'=> array('aktifkan'=>'superadmin/set_active/')
		),
		'edit'=>'welcome/edit/users/'
	)
);
$config['pegawai']['show'] = array(
	'NIK',
	'kontak_email',
	'departement',
	'job_title',
	'position',
	'status',
	'tanggal_masuk'
);

$config['pegawai']['input'] = array(
	'NIK',
	'kontak_email',
	'kontak_hp',
	'tanggal_masuk'
);
$config['pegawai']['toolbar'] = array(
	'3' => array('hrd/tambah_fungsional','hrd/tambah_pegawai','hrd/fungsional','hrd/semua')
);
$config['pegawai']['action'] = array(
	'3'=>array(
			'set fungsional'=>'hrd/set_fungsional/',
			'edit'=>'hrd/edit/pegawai/',
		)
);

$config['biodata_pegawai']['input'] =array(
	'nama_depan',
	'nama_belakang',
	'tanggal_lahir',
	'gender',
	'golongan_darah',
	'alamat_lengkap',
	'status_perkawinan',
	'pendidikan_terakhir'
);

$config['fungsional_pegawai']['show'] = array(
	'job_departement',
	'job_title',
	'job_position',
	'status_pegawai'
);

$config['fungsional_pegawai']['input'] = array(
	'id_group',
	'id_departement',
	'job_departement',
	'job_title',
	'job_position',
	'gaji_pokok',
	'status_pegawai'
);

$config['fungsional_pegawai']['toolbar'] = array(
		'3' => array('hrd/tambah_fungsional/'),
);


//parameter_slip
$config['parameter_slip']['show'] 	 = array(
	'status_parameter',
	'parameter',
	'nominal_bersifat',
	'jenis_parameter',
);
$config['parameter_slip']['input'] 	 = array(
	'parameter',
	'nominal_parameter',
	'nominal_bersifat',
	'jenis_parameter',
	'status_parameter'
);
$config['parameter_slip']['toolbar'] = array(
	'9' => array('direksi/tambah/parameter_slip'),
);
$config['parameter_slip']['action']	 = array(
	'9'=>array(
		'edit'=>'direksi/edit/parameter_slip/',
		'hapus'=>'direksi/hapus/parameter_slip/',
		'status_parameter'=>array(
			'aktif'=>array('matikan'=>'direksi/set_status_parameter/pasif/'),
			'pasif'=>array('aktifkan'=>'direksi/set_status_parameter/aktif/')
		)
	)
);
/*
//proyek_pegawai
$config['']['show'] 	= array();
$config['']['input'] 	= array();
$config['']['toolbar'] 	= array();
$config['']['action'] 	= array();

//checklist_proyek
$config['']['show'] 	= array();
$config['']['input'] 	= array();
$config['']['toolbar'] 	= array();
$config['']['action'] 	= array();
*/

//informasi_slip
$config['informasi_slip']['show'] 	 = array(
	'nama_instansi',
	'direktur_instansi',
	'telp_instansi',
	'email_instansi'
);
$config['informasi_slip']['input'] 	 = array(
	'id_direktur',
	'nama_instansi',
	'alamat_instansi',
	'direktur_instansi',
	'telp_instansi',
	'email_instansi',
	'fax_instansi',
	'website_instansi'
);
$config['informasi_slip']['toolbar'] = array(
	'9' => array('direksi/tambah/informasi_slip'),
);
$config['informasi_slip']['action']  = array(
	'9'=>array(
		'edit'=>'direksi/edit/informasi_slip/',
		'hapus'=>'direksi/hapus/informasi_slip/',
		'set format'=>'direksi/set_format_version/'
	)
);

/*
//slip_gaji_pegawai
$config['']['show'] 	= array();
$config['']['input'] 	= array();
$config['']['toolbar'] 	= array();
$config['']['action'] 	= array();
*/





