<?php
namespace App\Entities;

use App\Models\Crud;

class Student_course_registration extends Crud
{
protected static $tablename='Student_course_registration';
/* this array contains the field that can be null*/
static $nullArray=array('date_registered','semester_id' );
static $compositePrimaryKey=array('student_biodata_id','session_semester_course_id','academic_session_id');
static $uploadDependency = array();
/*this array contains the fields that are unique*/
static $uniqueArray=array();
/*this is an associative array containing the fieldname and the type of the field*/
static $typeArray = array('student_biodata_id'=>'int','session_semester_course_id'=>'int','academic_session_id'=>'int','semester_id'=>'int','date_registered'=>'timestamp');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','student_biodata_id'=>'','session_semester_course_id'=>'','academic_session_id'=>'','semester_id'=>'','date_registered'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array('date_registered'=>'current_timestamp()');
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array();//array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.
		
static $relation=array('student_biodata'=>array( 'student_biodata_id', 'ID')
,'session_semester_course'=>array( 'session_semester_course_id', 'ID')
,'course_score'=>array(array( 'ID', 'student_course_registration_id', 1))
);
static $tableAction=array('delete'=>'delete/student_course_registration','edit'=>'edit/student_course_registration');
function __construct($array=array())
{
	parent::__construct($array);
}

function getStudent_biodata_idFormField($value=''){
	$fk=null;//change the value of this variable to array('table'=>'student_biodata','display'=>'student_biodata_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='student_biodata_id' id='student_biodata_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='student_biodata_id'>Student Biodata</label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='student_biodata_id' id='student_biodata_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;

}

function getSemester_idFormField($value=''){
	$fk=null;//change the value of this variable to array('table'=>'student_biodata','display'=>'student_biodata_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='semester_id' id='semester_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='semester_id'>Semester</label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='semester_id' id='semester_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;
}
function getAcademic_session_idFormField($value=''){
	$fk=null;//change the value of this variable to array('table'=>'student_biodata','display'=>'student_biodata_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='academic_session_id' id='academic_session_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='academic_session_id'>Academic Session</label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='academic_session_id' id='academic_session_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;
}

function getSession_semester_course_idFormField($value=''){
	$query = "select session_semester_course.id, concat_ws(' ',course_code,course_unit) as value from session_semester_course join course on session_semester_course.course_id = course.id";
	$option = buildOptionFromQuery($this->db,$query,null,$value);
		$result ="
		<div class='form-group'>
		<label for='session_semester_course_id'>Course</label>";
		$result.="<select name='session_semester_course_id' id='session_semester_course_id' class='form-control'>
		$option
		</select></div>";
	return  $result;

}
function getDate_registeredFormField($value=''){
	return " ";

}

protected function getStudent_biodata(){
	$query ='SELECT * FROM student_biodata WHERE id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->getResultArray();
	if (empty($result)) {
		return false;
	}
	$resultObject = new \App\Entities\Student_biodata($result[0]);
	return $resultObject;
}
		
protected function getSession_semester_course(){
	$query ='SELECT * FROM session_semester_course WHERE id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->getResultArray();
	if (empty($result)) {
		return false;
	}
	$resultObject = new \App\Entities\Session_semester_course($result[0]);
	return $resultObject;
}
		
protected function getCourse_score(){
	$query ='SELECT * FROM course_score WHERE student_course_registration_id=?';
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->getResultArray();
	if (empty($result)) {
		return false;
	}
	$resultobjects = array();
	foreach ($result as  $value) {
		$resultObjects[] = new \App\Entities\Course_score($value);
	}

	return $resultObjects;
}

//function to override delete operation
//delete the course alongside with the registration;
public function delete($id=null,&$db=null)
{
	$db=$this->db;
	$db->transBegin();
	if(parent::delete($id,$db)){
		$query="delete from course_score where student_course_registration_id =?";
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




}