<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pages extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->sLogin = $this->session->userdata('ei_login');
		$this->sId = $this->session->userdata('ei_id');
		$this->sLevel = $this->session->userdata('ei_level');
		$this->sUserTable = $this->session->userdata('ei_user_table');
		$this->session_key = array('ei_login','ei_id','ei_user','ei_pass','ei_level','ei_user_table');
		
		//$this->sSession = $this->session->userdata('ei_session');
	}

	public function index(){
		
	}

	public function login($user,$pass){
		$r = select2("user","*","WHERE username='$user' AND flag_aktif='1'");

		if(($r!=NULL) && ($r['username']==$user) && password_verify($pass, $r['password'])){
			$data = array(
				'ei_login' => TRUE, 
				'ei_id' => $r['id_user'],
				'ei_user' => $r['username'],
				'ei_pass' => $r['password'],
				'ei_level' => $r['id_user_level'],
				//'ei_level' => '1',
				'ei_user_table'=>$r['id_user_table'],
			);
			$this->session->set_userdata($data);
			return TRUE;
        }
        else{
        	$this->session->unset_userdata($this->session_key);
        	return FALSE;
        }
	}

	public function logout(){
		$this->session->unset_userdata($this->session_key);
    	//$this->session->sess_destroy();
	}

	public function menu_header(){
	    if($this->sLogin==TRUE){
			$level = select2("user_level","*","WHERE id='$this->sLevel'");
	      	$data = '
	      	<li class="nav-item">
	      		<a href="#" class="nav-link"><i class="fa fa-user"></i> '.str_uri($level['name'],1).'</a>
			</li>
			<li class="nav-item">
	      		<a href="'.base_url().'pages/content/profile/cpw" class="nav-link"><i class="fa fa-lock"></i> Change Password</a>
	      	</li>
	      	<li class="nav-item">
	      		<a href="'.base_url().'pages/logout" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a>
	      	</li>';
	    }
	    else{
			$data = '
			<li class="nav-item">
	      		<a href="'.base_url().'pages/login" class="nav-link"><i class="fa fa-sign-in2"></i> Login</a>
			</li>';
			  
			/* $data = '
	      	<li class="nav-item">
	      		<a href="" class="nav-link" data-toggle="modal" data-target="#modal_login"><i class="fa fa-sign-in"></i> Login</a>
	      	</li>'; */
	    }
	    return $data;
	}

	public function menu_navigation(){
		$menu = array();
		$content_url = base_url().'pages/content/';
		$active = '';
		if(urinext('content')=='home' || urinext('content')==''){
			$active = 'active';
		}

		$data = '
		<li class="nav-item">
			<a href="'.base_url().'" class="nav-link '.$active.'">
				<i class="fa fa-home"></i>
				<span class="nav-label">Home</span>
			</a>
		</li>';

		# Jika sudah login
		if($this->sLogin==TRUE){
			# Jika level user = 1 (Admin)
			if(in_array($this->sLevel,array('1'))){
				$menu = array(
					array('pages'=>$content_url.'user/data','class'=>'user','name'=>'User'),
					array('pages'=>$content_url.'test-centre/data','class'=>'medkit','name'=>'Test Centre'),
					array('pages'=>$content_url.'patient/data','class'=>'male','name'=>'Patient'),
					
					//array('pages'=>$content_url.'report/data','class'=>'file-pdf-o','name'=>'Report'),
				);
			}
			elseif(in_array($this->sLevel,array('2'))){
				$menu = array(
					array('pages'=>$content_url.'user/data','class'=>'user','name'=>'User'),
					array('pages'=>$content_url.'centre-officer/data','class'=>'medkit','name'=>'Centre Officer'),
					array('pages'=>$content_url.'test-kit/data','class'=>'medkit','name'=>'Test Kit'),
					//array('pages'=>$content_url.'report/data','class'=>'file-pdf-o','name'=>'Report'),
				);
			}
			elseif(in_array($this->sLevel,array('3'))){
				$menu = array(
					array('pages'=>$content_url.'report/data','class'=>'file-pdf-o','name'=>'Report'),
				);
			}
			elseif(in_array($this->sLevel,array('4'))){
				$menu = array(
					array('pages'=>$content_url.'covid-test/data','class'=>'medkit','name'=>'Covid Test'),
					//array('pages'=>$content_url.'report/data','class'=>'file-pdf-o','name'=>'Report'),
				);
			}
			elseif(in_array($this->sLevel,array('5'))){
				$menu = array(
					array('pages'=>$content_url.'covid-test/data','class'=>'medkit','name'=>'Covid Test'),
					//array('pages'=>$content_url.'report/data','class'=>'file-pdf-o','name'=>'Report'),
				);
			}
		}
		/* else{
			$menu = array(
				array('class'=>'table','name'=>'Galery',
					'sub'=>array(
						array('pages'=>$content_url.'gallery/data','class'=>'image','name'=>'Galery'),
					)
				),
			);
		} */

		foreach ($menu as $i => $r) {
			if(isset($r['sub'])){
				$data .= '
				<li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link">
						<i class="fa fa-'.$r['class'].'"></i>
						<span class="nav-label">'.$r['name'].'</span> 
						<span class="caret pull-right m-t-10"></span>
					</a>
					<ul class="nav nav-second-level collapse nav-group-sub" id="'.$i.'">';
					foreach ($r['sub'] as $j => $r2) {
						$content = str_replace($content_url,'',$r2['pages']);
						list($content,$action) = explode('/',$content);
						$active = '';
						$show = '';
						if(urinext('content')==$content){
							$active = 'active';
							$show = '
							<script>
								$("#'.$i.'").show();
							</script>';
						}

						$data .= '
						<li class="nav-item">
							<a href="'.$r2['pages'].'" class="nav-link '.$active.'"><i class="fa fa-'.$r2['class'].'"></i> <span class="nav-label">'.$r2['name'].'</span></a>
						</li>'.$show;
					}
					$data .= '
					</ul>
				</li>';
			}
			else{
				$content = str_replace($content_url,'',$r['pages']);
				if(stristr($content, '/') == TRUE){
					list($content,$action) = explode('/',$content);
				}
				
				$active = '';
				if(urinext('content')==$content){
					$active = 'active';
				}
				$data .= '
				<li class="nav-item">
					<a href="'.$r['pages'].'" class="nav-link '.$active.' scroll">
						<i class="fa fa-'.$r['class'].'"></i> 
						<span class="nav-label">'.$r['name'].'</span>
					</a>
				</li>';
			}
		}
		return $data;
	}
}