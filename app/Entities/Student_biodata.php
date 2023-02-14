<?php
namespace App\Entities;

use App\Models\Crud;
class Student_biodata extends Crud
	{
protected static $tablename='Student_biodata';
/* this array contains the field that can be null*/
static $nullArray=array('middlename' ,'dob' ,'email' ,'phone_number' ,'gender' ,'address' ,'state_of_origin' ,'lga_of_origin' ,'registration_number' ,'entry_mode_id' ,'study_mode_id' ,'student_biodata_path' ,'nationality','status');
static $compositePrimaryKey=array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/
static $displayField='matric_number';
static $uniqueArray=array('matric_number' );
/*this is an associative array containing the fieldname and the type of the field*/
static $typeArray = array('matric_number'=>'varchar','surname'=>'varchar','firstname'=>'varchar','middlename'=>'varchar','dob'=>'date','email'=>'text','phone_number'=>'text','gender'=>'varchar','address'=>'text','state_of_origin'=>'varchar','lga_of_origin'=>'varchar','registration_number'=>'varchar','marital_status'=>'enum','religion'=>'enum','academic_session_id'=>'int','entry_mode_id'=>'int','student_biodata_path'=>'varchar','nationality'=>'varchar','status'=>'tinyint');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','matric_number'=>'','surname'=>'','firstname'=>'','middlename'=>'','dob'=>'','email'=>'','phone_number'=>'','gender'=>'','address'=>'','state_of_origin'=>'','lga_of_origin'=>'','registration_number'=>'','marital_status'=>'','religion'=>'','academic_session_id'=>'','entry_mode_id'=>'','student_biodata_path'=>'','nationality'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array();
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = ['student_biodata_path'=>['type'=>['jpeg','jpg','png'],'size'=>'819200','directory'=>'staff/','preserve'=>false]]; 
		
static $relation=array(
);
static $tableAction=array('delete'=>'delete/student_biodata','edit'=>'edit/student_biodata','profile'=>'vc/student/profile');

static $programCourseGroup=array();
function __construct($array=array())
{
	parent::__construct($array);
}
function getSurnameFormField($value=''){
	return "<div class='form-group'>
	<label for='surname' >Surname</label>
		<input type='text' name='surname' id='surname' value='$value' class='form-control' required />
</div> ";

}
function getFirstnameFormField($value=''){
	return "<div class='form-group'>
	<label for='firstname' >Firstname</label>
		<input type='text' name='firstname' id='firstname' value='$value' class='form-control' required />
</div> ";

}
function getMiddlenameFormField($value=''){
	return "<div class='form-group'>
	<label for='middlename' >Middlename</label>
		<input type='text' name='middlename' id='middlename' value='$value' class='form-control'  />
</div> ";
}
function getDobFormField($value=''){
	return "<div class='form-group'>
	<label for='dob' >Dob</label>
	<input type='date' name='dob' id='dob' value='$value' class='form-control'  />
</div> ";

}
function getEmailFormField($value=''){
	return "<div class='form-group'>
	<label for='email' >Email</label>
<input type='email' id='email' name='email' class='form-control' value='$value' />
</div> ";

}
function getPhone_numberFormField($value=''){
	return "<div class='form-group'>
	<label for='phone_number' >Phone Number</label>
<input type='phone' id='phone_number' name='phone_number' class='form-control' value='$value' />
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
function getAddressFormField($value=''){
	return "<div class='form-group'>
	<label for='address' >Address</label>
<textarea id='address' name='address' class='form-control' >$value</textarea>
</div> ";

}
function getState_of_originFormField($value=''){
	$states = loadStates();
	$option = buildOptionUnassoc($states,$value);
	return "<div class='form-group'>
	<label for='state_of_origin' >State Of Origin</label>
		<select  name='state_of_origin' id='state_of_origin' value='$value' class='form-control autoload' data-child='lga_of_origin' data-load='lga'> 
		<option value=''>..select state..</option>
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
function getMatric_numberFormField($value=''){
	return "<div class='form-group'>
	<label for='matric_number' >Matric Number</label>
		<input type='text' name='matric_number' id='matric_number' value='$value' class='form-control' required />
</div> ";

}
function getRegistration_numberFormField($value=''){
	return "<div class='form-group'>
	<label for='registration_number' >Jamb Registration Number</label>
		<input type='text' name='registration_number' id='registration_number' value='$value' class='form-control'  />
</div> ";

}

function getAcademic_session_idFormField($value=''){
	$fk=array('table'=>'academic_session','display'=>'session_name'); 

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='academic_session_id' id='academic_session_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='academic_session_id'>Entry Session </label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='academic_session_id' id='academic_session_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;

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
	 function getEntry_mode_idFormField($value=''){
	$fk= array('table'=>'entry_mode','display'=>'mode_of_entry'); 

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='entry_mode_id' id='entry_mode_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='entry_mode_id'>Entry Mode</label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='entry_mode_id' id='entry_mode_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;

}

function getStudent_biodata_pathFormField($value=''){
	return "<div class='form-group'>
	<label for='student_biodata_path' >Student Image</label>
		<input type='file' name='student_biodata_path' id='student_biodata_path' value='$value' class='form-control'  />
</div> ";

}
function getNationalityFormField($value=''){
	return "<div class='form-group'>
	<label for='nationality' >Nationality</label>
		<input type='text' name='nationality' id='nationality' value='$value' class='form-control'  />
</div> ";

}
		
protected function getEntry_mode(){
	$query ='SELECT * FROM entry_mode WHERE id=?';
	if (!isset($this->array['entry_mode_id'])) {
		$this->load();
	}
	$id = $this->array['entry_mode_id'];
	$result = $this->db->query($query,array($id));
	$result =$result->getResultArray();
	if (empty($result)) {
		return false;
	}
	$resultObject = new \App\Entities\Entry_mode($result[0]);
	return $resultObject;
}
protected function getLevel(){
	$query ='SELECT * FROM level WHERE id=?';
	if (!isset($this->array['level_id'])) {
		$this->load();
	}
	$id = $this->array['level_id'];
	$result = $this->db->query($query,array($id));
	$result =$result->getResultArray();
	if (empty($result)) {
		return false;
	}
	$resultObject = new \App\Entities\Level($result[0]);
	return $resultObject;
}	
		
protected function getNext_of_kin(){
	$query ='SELECT * FROM next_of_kin WHERE student_biodata_id=?';
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->getResultArray();
	if (empty($result)) {
		return false;
	}
	$resultObjects = new \App\Entities\Next_of_kin($result[0]);
	return $resultObjects;
}
		
protected function getStudentRegistration(){
	$query ='SELECT * FROM student_course_registration WHERE student_biodata_id=?';
	$id = $this->array['id'];
	$result = $this->db->query($query,array($id));
	$result =$result->getResultArray();
	if (empty($result)) {
		return false;
	}
	$resultobjects = array();
	foreach ($result as  $value) {
		$resultObjects[] = new \App\Entities\Student_course_registration($value);
	}

	return $resultObjects;
}



}