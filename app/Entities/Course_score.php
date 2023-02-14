<?php
namespace App\Entities;

use App\Models\Crud;

class Course_score extends Crud
{
protected static $tablename='Course_score';
/* this array contains the field that can be null*/
static $nullArray=array();
static $compositePrimaryKey=array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/
static $uniqueArray=array('student_course_registration_id');
/*this is an associative array containing the fieldname and the type of the field*/
static $typeArray = array('student_course_registration_id'=>'int','ca_score'=>'float','exam_score'=>'float','score'=>'float');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','student_course_registration_id'=>'','ca_score'=>'','exam_score'=>'','score'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array();
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array();//array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.
		
static $relation=array('student_course_registration'=>array( 'student_course_registration_id', 'ID')
,'result_complaint'=>array(array( 'ID', 'course_score_id', 1))
);
static $tableAction=array('delete'=>'delete/course_score','edit'=>'edit/course_score');
function __construct($array=array())
{
	parent::__construct($array);
}
function getStudent_course_registration_idFormField($value=''){
	$fk=null;//change the value of this variable to array('table'=>'student_course_registration','display'=>'student_course_registration_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='student_course_registration_id' id='student_course_registration_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='student_course_registration_id'>Student Course Registration Id</label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='student_course_registration_id' id='student_course_registration_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;
}
function getScoreFormField($value=''){
	return "";
// 	return "<div class='form-group'>
// 	<label for='score' >Score</label>
// 		<input type='text' name='score' id='score' value='$value' class='form-control' required />
// </div> ";

}

function getCa_scoreFormField($value=''){
	return "<div class='form-group mb-3'>
	<label for='exam_score' >CA</label>
		<input type='text' name='ca_score' id='ca_score' value='$value' class='form-control' required />
</div> ";

}
function getExam_scoreFormField($value=''){
	return "<div class='form-group mb-3'>
	<label for='exam_score' >Exam</label>
		<input type='text' name='exam_score' id='exam_score' value='$value' class='form-control' required />
</div> ";

}


		
protected function getStudent_course_registration(){
	$query ='SELECT * FROM student_course_registration WHERE id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Student_course_registration.php');
	$resultObject = new Student_course_registration($result[0]);
	return $resultObject;
}
		
protected function getResult_complaint(){
	$query ='SELECT * FROM result_complaint WHERE course_score_id=?';
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Result_complaint.php');
	$resultobjects = array();
	foreach ($result as  $value) {
		$resultObjects[] = new Result_complaint($value);
	}

	return $resultObjects;
}

		}
		?>