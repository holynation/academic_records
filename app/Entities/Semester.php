<?php
namespace App\Entities;

use App\Models\Crud;
class Semester extends Crud
{
protected static $tablename='Semester';
/* this array contains the field that can be null*/
static $nullArray=array();
static $compositePrimaryKey=array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/
static $uniqueArray=array('semester_name' );
/*this is an associative array containing the fieldname and the type of the field*/
static $displayField='semester_name';
static $typeArray = array('semester_name'=>'varchar','is_last'=>'tinyint');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','semester_name'=>'','is_last'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array();
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array();//array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.
		
static $relation=array('session_semester'=>array(array( 'ID', 'semester_id', 1))
);
static $tableAction=array('delete'=>'delete/semester','edit'=>'edit/semester');
function __construct($array=array())
{
	parent::__construct($array);
}
function getSemester_nameFormField($value=''){
	return "<div class='form-group'>
	<label for='semester_name' >Semester Name</label>
		<input type='text' name='semester_name' id='semester_name' value='$value' class='form-control' required />
</div> ";

}
function getIs_lastFormField($value=''){
	$arr = array(array('id'=>1,'value'=>'Yes'),array("id"=>0,'value'=>'No'));
	$option = buildOption($arr,$value);
	return "<div class='form-group'>
	<label for='is_last' >Is Last(in Session)</label>
	<select name='is_last' id='is_last' value='$value' class='form-control' required>
	<option>..choose..</option>
	$option
</select>
</div> ";

}

		
}