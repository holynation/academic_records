<?php
namespace App\Entities;

use App\Models\Crud;

class Grade_scale extends Crud
{
protected static $tablename='Grade_scale';
/* this array contains the field that can be null*/
static $nullArray=array();
static $compositePrimaryKey=array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/
static $uniqueArray=array();
/*this is an associative array containing the fieldname and the type of the field*/
static $typeArray = array('min_score'=>'float','max_score'=>'float','point'=>'float','grade'=>'varchar');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','min_score'=>'','max_score'=>'','grade'=>'','point'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array();
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array();//array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.
		
static $relation=array();
static $tableAction=array('delete'=>'delete/grade_scale','edit'=>'edit/grade_scale');
function __construct($array=array())
{
	parent::__construct($array);
}
function getMin_scoreFormField($value=''){
	return "<div class='form-group'>
	<label for='min_score' >Min Score</label>
		<input type='text' name='min_score' id='min_score' value='$value' class='form-control' required />
</div> ";

}
function getGradeFormField($value=''){
	return "<div class='form-group'>
	<label for='grade' >Grade</label>
		<input type='text' name='grade' id='grade' value='$value' class='form-control' required />
</div> ";

}
function getPointFormField($value=''){
	return "<div class='form-group'>
	<label for='point' >Point</label>
		<input type='text' name='point' id='point' value='$value' class='form-control' required />
</div> ";

}
function getMax_scoreFormField($value=''){
	return "<div class='form-group'>
	<label for='max_score' >Max Score</label>
		<input type='text' name='max_score' id='max_score' value='$value' class='form-control' required />
</div> ";
}


}