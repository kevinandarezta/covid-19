<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengajuan extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function index(){

	}

	public function start(){
		$data = array();
		$data['table'] = str_uri(urinext('html'),2);
		$data['field'] = "*";
		$data['condition'] = "ORDER BY created DESC";
		$data['field_control'] = '';
		$data['start'] = 1;
		$data['extra'] = array(
			0=>'',
			1=>'',
		);
		return $data;
	}

	public function detail(){
		if($_POST){
			$data = $this->start();
			$id = $_POST['id'];

			$values = select2($data['table'],$data['field'],"WHERE id_$data[table]='$id'");
			
			$detail = select($data['table']."_detail a, jenis_surat_metadata b","*","WHERE a.id_jenis_surat_metadata=b.id_jenis_surat_metadata AND a.id_$data[table]='$id' AND b.type='file'");
			
			$body = '';
			foreach($detail as $i => $r){
				$body .= '
				<a href="'.base_url().'upload/'.$data['table'].'/'.$id.'/'.$r['value'].'" class="venobox" data-gall="venobox_image'.$i.'" target="_blank">
				<img src="'.base_url().'upload/'.$data['table'].'/'.$id.'/'.$r['value'].'" class="img-fluid img-thumbnail" alt="Image" width="100" height="100">
				</a>';
			}

			$output = '
			<div class="modal-body">
				<center>'.$body.'</center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>';
			return $output;
		}
	}

	public function append(){
		if($_POST){
			$output = '
			<div class="form-group row">
				<label class="control-label col-lg-3">Metadata :</label>
				<div class="col-lg-3">
					<input type="text" class="form-control" name="metadata[]" id="metadata[]" maxlength="200" value="" onkeypress="return string(event)" required>
				</div>
				<label class="control-label col-lg-2">Type :</label>
				<div class="col-lg-3">
					<select class="form-control select2" data-placeholder="Select ..." name="type[]" id="type[]"  required>
						<option value="">Select ...</option>';
						$type = array('text','number','date','select','file');
						foreach($type as $i => $r){
							$output .= '
							<option value="'.$r.'" >'.$r.'</option>';
						}
					$output .= '
					</select>
				</div>
				<div class="col-lg-1">
					<a href="javascript:void(0)" class="btn btn-danger remove"><span class="fa fa-trash" aria-hidden="true"></span></a>
				</div>
			</div>';

			return $output;
		}
	}
}