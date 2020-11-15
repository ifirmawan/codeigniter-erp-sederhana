<?php
/**
 * Group id
 * 1 => Admin
 * 2 => purchasing
 * 3 => personalia
 * 4 => multimedia
 * 5 => operator
 * 6 => marketing
 * 7 => Quality control (QC)
 * 8 => gudang
 * 9 => direksi
 * 10 => auditor
 */
$config['site']['brand']		= 'internal.jvm';
$config['site']['author']		= 'jvmdeveloper';
$config['site']['admin']		= 'iwan.firmawan@jvm.co.id';
$config['default']['content'] 	= 'Hello world';
$config['default']['layout']	= 'ui_bootstrap';

$config['menu'] = array(
/* Admin */			array('pegawai'), 
/* purchasing */	array('proyek_pegawai'),
/* personalia */	array('daftar_pegawai'),
/* multimedia */	array('proyek_pegawai'),
/* operator */		array('proyek_pegawai'),
/* marketing */		array('proyek_pegawai'),
/* QC */			array('proyek_pegawai'),
/* gudang */		array('proyek_pegawai'),
/* direksi */		array('pegawai','informasi_slip','parameter_slip'),
/* auditor */		array('proyek_pegawai'),
/* super */			array('users','pegawai'),
/* general_affair */array('proyek_pegawai'),
/* finance */		array('proyek_pegawai'),
/* it_support */	array('proyek_pegawai'),
/* seo */			array('proyek_pegawai')

);

$config['input_file'] 				= array('id_berkas','surat_permintaan');

// $config['include_home'] will tell the library if the frist element should ....
$config['include_home'] 	= '';
// $config['divider'] is the divider you want between the crumbs. leave blank
$config['divider'] 			= '';
// $config['container_open'] this the opening tag of the breadcrumb container
$config['container_open'] 	= '<ol class="breadcrumb">';
// $config['container_close'] this the opening tag of the breadcrumb container
$config['container_close'] 	= '</ol>';
// $config['crumb_open'] is the opening tag of the crumb container
$config['crumb_open'] 		= '<li>';
// $config['crumb_close'] is the closing tag of the crumb container
$config['crumb_close'] 		= '</li>';

