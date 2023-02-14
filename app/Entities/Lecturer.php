<?php
namespace App\Entities;

use App\Models\Crud;
class Lecturer extends Crud
{
protected static $tablename='Lecturer';
/* this array contains the field that can be null*/
static $nullArray=array('designation','dob' ,'status' ,'address' ,'state_of_origin' ,'lga_of_origin'  ,'disability' ,'date_of_first_appointment' ,'nationality','role_id' );
static $compositePrimaryKey=array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/
static $displayField='staff_no';
static $uniqueArray=array('staff_no','email','phone_number');
/*this is an associative array containing the fieldname and the type of the field*/
static $typeArray = array('title'=>'enum','staff_no'=>'varchar','surname'=>'varchar','firstname'=>'varchar','middlename'=>'varchar','gender'=>'varchar','email'=>'text','phone_number'=>'text','dob'=>'date','status'=>'tinyint','address'=>'varchar','marital_status'=>'enum','religion'=>'enum','state_of_origin'=>'varchar','lga_of_origin'=>'varchar','nationality'=>'varchar','role_id'=>'int','lecturer_path'=>'varchar');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','title'=>'','staff_no'=>'','surname'=>'','firstname'=>'','middlename'=>'','gender'=>'','email'=>'','phone_number'=>'','dob'=>'','status'=>'','address'=>'','marital_status'=>'','religion'=>'','state_of_origin'=>'','lga_of_origin'=>'','nationality'=>'','role_id'=>'','lecturer_path'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array('status'=>'1');
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = ['lecturer_path'=>['type'=>['jpeg','jpg','png'],'size'=>'819200','directory'=>'lecturer/','preserve'=>false]];
		
static $relation=array(
);
static $tableAction=array('enable'=>'getEnabled','delete'=>'delete/lecturer','edit'=>'edit/lecturer','profile'=>'vc/lecturer/profile');
function __construct($array=array())
{
	parent::__construct($array);
}
	function getTitleFormField($value=''){
		$arr =array('Miss','Mr.','Mrs.','Dr.','Prof.');
		$option = buildOptionUnassoc($arr,$value);
		$result ="<div class='form-group'>
		<label for='title_id'>Title</label>";
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='title' id='title' class='form-control'>
			$option
		</select>";
	$result.="</div>";
	return  $result;

}
function getSurnameFormField($value=''){
	return "<div class='form-group'>
	<label for='surname' >Surname</label>
		<input type='text' name='surname' id='surname' value='$value' class='form-control'  />
</div> ";

}
function getFirstnameFormField($value=''){
	return "<div class='form-group'>
	<label for='firstname' >Firstname</label>
		<input type='text' name='firstname' id='firstname' value='$value' class='form-control'  />
</div> ";

}
function getMiddlenameFormField($value=''){
	return "<div class='form-group'>
	<label for='middlename' >Middlename</label>
		<input type='text' name='middlename' id='middlename' value='$value' class='form-control'  />
</div> ";

}
function getArea_of_specializationFormField($value=''){
	return "<div class='form-group'>
	<label for='area_of_specialization' >Area Of Specialization</label>
		<input type='text' name='area_of_specialization' id='area_of_specialization' value='$value' class='form-control'  />
</div> ";

}


function getGenderFormField($value=''){
	$arr =array('Male','Female');
	$option = buildOptionUnassoc($arr,$value);
	return "<div class='form-group'>
	<label for='gender' >Gender</label>
		<select  name='gender' id='gender'  class='form-control'  >
		$option
		</select>
</div> ";

}

function getReligionFormField($value=''){
	$arr =array('Christianity','Islam','Other');
	$option = buildOptionUnassoc($arr,$value);
	return "<div class='form-group'>
	<label for='religion' >Religion</label>
		<select  name='religion' id='religion'  class='form-control'  >
		$option
		</select>
</div> ";

}
	 function getRole_idFormField($value=''){
	$fk= array('table'=>'role','display'=>'role_title'); 

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='role_id' id='role_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='role_id'>Role</label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='role_id' id='role_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;

}

function getMarital_statusFormField($value=''){
	$arr =array('single','married','divorced','widowed','others');
	$option = buildOptionUnassoc($arr,$value);
	return "<div class='form-group'>
	<label for='gender' >Marital Status</label>
		<select  name='marital_status' id='marital_status'  class='form-control'  >
		$option
		</select>
</div> ";

}
function getEmailFormField($value=''){
	return "<div class='form-group'>
	<label for='email' >Email</label>
<textarea id='email' name='email' class='form-control' >$value</textarea>
</div> ";

}
function getPhone_numberFormField($value=''){
	return "<div class='form-group'>
	<label for='phone_number' >Phone Number</label>
<textarea id='phone_number' name='phone_number' class='form-control' >$value</textarea>
</div> ";

}
function getDobFormField($value=''){
	return "<div class='form-group'>
	<label for='dob' >Dob</label>
	<input type='date' name='dob' id='dob' value='$value' class='form-control'  />
</div> ";

}
function getStatusFormField($value=''){
	return "<div class='form-group'>
	<label class='form-checkbox'>Status</label>
	<select class='form-control' id='status' name='status' >
		<option value='1'>Yes</option>
		<option value='0' selected='selected'>No</option>
	</select>
	</div> ";

}
function getAddressFormField($value=''){
	return "<div class='form-group'>
	<label for='address' >Address</label>
		<input type='text' name='address' id='address' value='$value' class='form-control'  />
</div> ";

}
function getState_of_originFormField($value=''){
	$states = loadStates();
	$option = buildOptionUnassoc($states,$value);
	return "<div class='form-group'>
	<label for='state_of_origin' >State Of Origin</label>
		<select  name='state_of_origin' id='state_of_origin' value='$value' class='form-control autoload' data-child='lga_of_origin' data-load='lga'> 
		<option value=''>..select state...</option>
		$option
		</select>
</div> ";

}
function getLga_of_originFormField($value=''){
	$option='';
	if ($value) {
		$arr=array($value);
		$option = buildOptionUnassoc($arr,$value);
	}
	return "<div class='form-group'>
	<label for='lga_of_origin' >Lga Of Origin</label>
		<select type='text' name='lga_of_origin' id='lga_of_origin' value='$value' class='form-control'  >
		<option value=''></option>
		$option
		</select>
</div> ";

}
function getStaff_noFormField($value=''){
	return "<div class='form-group'>
	<label for='staff_no' >Staff No</label>
		<input type='text' name='staff_no' id='staff_no' value='$value' class='form-control'  />
</div> ";

}

public function getLecturer_pathFormField($value = ''){
	$path =  ($value != '') ? $value : "";
       return "<div class='row'>
                <div class='col-lg-8'>
                    <div class='form-group'>
                    <label>Lecturer Image</label>
                <input type='file' class='file-input' data-show-caption='false' data-show-upload='false' data-fouc name='lecturer_path' id='lecturer_path' />
                <span class='form-text text-muted'>Max File size is 800KB. Supported formats: <code> jpeg,jpg,png</code></span></div></div>
                <div class='col-sm-4'><img src='$path' alt='staff image' class='img-responsive' width='30%'/></div>
            </div><br>";
} 
function getNationalityFormField($value=''){
	return "<div class='form-group'>
	<label for='nationality' >Nationality</label>
		<input type='text' name='nationality' id='nationality' value='$value' class='form-control'  />
</div> ";

}

public function delete($id=null,&$db=null)
{
	$db=$this->db;
	$db->transBegin();
	if(parent::delete($id,$db)){
		$query="delete from user where user_table_id=? and user_type='lecturer'";
		if($this->query($query,array($id))){
			$db->transCommit();
			return true;
		}
		else{
			$db->transRollback();
			return false;
		}
	}
	else{
		$db->transRollback();
		return false;
	}
}


protected function getRole(){
	$query ='SELECT * FROM role WHERE id=?';
	if (!isset($this->array['role_id'])) {
		$this->load();
	}
	$id = $this->array['role_id'];
	$db = $this->db;
	$result = $db->query($query,[$id]);
	$result = $result->getResultArray();
	if (empty($result)) {
		return false;
	}
	$resultObject = new \App\Entities\Role($result[0]);
	return $resultObject;
}
}

?>