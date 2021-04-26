<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->sLogin = $this->session->userdata('ei_login');
		$this->sLevel = $this->session->userdata('ei_level');
		$this->sSession = $this->session->userdata('ei_session');
		$this->sBranch = $this->session->userdata('ei_branch');
	}

	public function index($themes,$app_name){
		$data = array();
		$data = session_check();
		//level_check($data['sLevel'],'1,2,3',1);

		# Tentukan assets yang akan digunakan
		$data['ASSETS'] = array(
			/* 'datatables',
			'form_validation',
			'select2',
			'datepicker',
			'timepicker', */
			//'datetimepicker',
			/*'currency',
			'ckeditor',
			'modal_detail',
			'form_event',
			'captcha',
			'addrow', */
			//'countdown',
			//'venobox',
			//'grafik',
		);
		$data['CONTENT_TITLE'] = str_uri(urinext('content'),1);
	    $data['ACTION'] = '';
		$ptitle = array('');

		/* $body = '
		<center>
		    <img src="'.base_url().'img/logo.png" class="img-responsive" alt="Logo" width="200px" height="200px"><br><br>
		    <h2>
				'.$app_name.'
			</h2>
			<br>
			<br>
		</center>'; */

		# Tampilan halaman home
		$body = '
		<div class="row">
			<div class="col-lg-12">
				<center>
					<h2 style="font-size: 25px; font-weight: bold; background-color: #c7c3c3; padding: 12px; width: 300px; border-radius: 25px;">
						<marquee>WELCOME</marquee>
					</h2>
					<h2 style="font-size: 25px; font-weight: bold;">
						'.$app_name.'
					</h2>
					<br>
					<img src="'.base_url().'img/logo.png" class="img-responsive" alt="Logo" width="200px" height="180px">
				</center>
			</div>
		</div>';

		/* if($this->sLogin==TRUE && in_array($this->sLevel,array('1','2','3'))){
			$prodi = select("prodi","*","WHERE flag_aktif='1' ORDER BY name");
			$jenis_surat = select("jenis_surat","*","WHERE flag_aktif='1' ORDER BY name");

			$body .= '
			<br><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="card bg-teal-400">
						<div class="card-body">
							<div class="d-flex">
								<h3 class="font-weight-semibold mb-0">
									<i class="fa fa-male"></i> Dosen / Prodi
								</h3>
							</div>
							<div>
								<table width="100% border="0">';
								foreach($prodi as $i => $r){
									$r2 = select2("dosen","COUNT(*) as jml","WHERE flag_aktif='1' AND id_prodi='$r[id_prodi]'");
									$body .= '
									<tr>
										<td width="5%">'.($i+1).'.</td>
										<td width="70%">'.$r['name'].'</td>
										<td width="5%">:</td>
										<td width="20%">'.$r2['jml'].'</td>
									</tr>';
								}
								$body .= '
								</table>
								<div class="font-size-sm opacity-75" style="margin-top: 100px;"></div>
							</div>
						</div>
						<div class="container-fluid">
							<div id="members-online"></div>
						</div>
					</div>
				</div>
	
				<div class="col-lg-4">
					<div class="card bg-pink-400">
						<div class="card-body">
							<div class="d-flex">
								<h3 class="font-weight-semibold mb-0">
									<i class="fa fa-users"></i> Mahasiswa / Prodi
								</h3>
							</div>
							<div>
								<table width="100% border="0">';
								foreach($prodi as $i => $r){
									$r2 = select2("mahasiswa a,konsentrasi b","COUNT(a.id_mahasiswa) as jml","WHERE a.flag_aktif='1' AND a.id_konsentrasi=b.id_konsentrasi AND b.id_prodi='$r[id_prodi]'");
									$body .= '
									<tr>
										<td width="5%">'.($i+1).'.</td>
										<td width="70%">'.$r['name'].'</td>
										<td width="5%">:</td>
										<td width="20%">'.$r2['jml'].'</td>
									</tr>';
								}
								$body .= '
								</table>
								<div class="font-size-sm opacity-75" style="margin-top: 100px;"></div>
							</div>
						</div>
						<div id="server-load"></div>
					</div>
	
				</div>
	
				<div class="col-lg-4">
					<div class="card bg-blue-400">
						<div class="card-body">
							<div class="d-flex">
								<h3 class="font-weight-semibold mb-0">
									<i class="fa fa-envelope"></i> Pengajuan / Jenis Surat
								</h3>
							</div>
							<div>
								<table width="100% border="0">';
								foreach($jenis_surat as $i => $r){
									$r2 = select2("pengajuan","COUNT(*) as jml","WHERE id_jenis_surat='$r[id_jenis_surat]'");
									$body .= '
									<tr>
										<td width="5%">'.($i+1).'.</td>
										<td width="70%">'.$r['name'].'</td>
										<td width="5%">:</td>
										<td width="20%">'.$r2['jml'].'</td>
									</tr>';
								}
								$body .= '
								</table>
								<div class="font-size-sm opacity-75" style="margin-top: 60px;"></div>
							</div>
						</div>
						<div id="today-revenue"></div>
					</div>
				</div>
			</div>';
		} */

		if($themes=='missio'){
			$data['CONTENT_TITLE'] = '';
		    $data['ACTION'] = '';
			$ptitle = array('');

			$body = '';
		}

		//$pbody = array($body);
		//$data['CONTENT'] = content($ptitle,$pbody,'panel');
		$data['CONTENT'] = $body;
		return $data;
	}
}