<?php
namespace App\Entities;

use App\Models\Crud;
class Session_semester_course extends Crud
{
static protected  $GES_CODE='GES';
protected static $tablename='Session_semester_course';
/* this array contains the field that can be null*/
static $nullArray=array();
static $compositePrimaryKey=array('course_id','level_id');
static $uploadDependency = array();
/*this array contains the fields that are unique*/
static $uniqueArray=array();
/*this is an associative array containing the fieldname and the type of the field*/
static $typeArray = array('course_status'=>'enum','course_id'=>'int','level_id'=>'int','course_unit'=>'int');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','course_status'=>'','course_id'=>'','level_id'=>'','course_unit'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array();
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array();//array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.
static $relation=array(
);
static $tableAction=array('delete'=>'delete/session_semester_course','edit'=>'edit/session_semester_course');
function __construct($array=array())
{
	parent::__construct($array);
}
function getCourse_statusFormField($value=''){
	return "<div class='form-group'>
	<label for='course_status' >Course Status</label><select name='course_status' id='course_status' value='$value' class='form-control' required>
	<option>..choose..</option><option>R</option><option>E</option><option>C</option><option>P</option>
</select>
</div> ";

}
	 function getCourse_idFormField($value=''){
	$fk=array('table'=>'course','display'=>'course_code');

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='course_id' id='course_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='course_id'>Course</label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='course_id' id='course_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;

}
	 function getLevel_idFormField($value=''){
	$fk= array('table'=>'level','display'=>'level_name'); 
	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='level_id' id='level_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='level_id'>Level</label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='level_id' id='level_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;
}

function getCourse_unitFormField($value=''){
	return "<div class='form-group'>
	<label for='course_unit' >Course Unit</label><input type='number' name='course_unit' id='course_unit' value='$value' class='form-control' required />
</div> ";

}
	
protected function getCourse(){
	$query ='SELECT * FROM course WHERE id=?';
	if (!isset($this->array['course_id'])) {
		$this->load();
	}
	$id = $this->array['course_id'];
	$result = $this->db->query($query,array($id));
	$result =$result->getResultArray();
	if (empty($result)) {
		return false;
	}
	$resultObject = new \App\Entities\Course($result[0]);
	return $resultObject;
}
	
protected function getStudent_course_registration(){
	$query ='SELECT * FROM student_course_registration WHERE session_semester_course_id=?';
	$id = $this->array['ID'];
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
