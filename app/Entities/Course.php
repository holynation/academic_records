<?php

namespace App\Entities;

use App\Models\Crud;

class Course extends Crud
{
protected static $tablename='Course';
/* this array contains the field that can be null*/
static $nullArray=array();
static $compositePrimaryKey=array();
static $uploadDependency = array();
static $displayField='course_code';
/*this array contains the fields that are unique*/
static $uniqueArray=array();
/*this is an associative array containing the fieldname and the type of the field*/
static $typeArray = array('course_title'=>'varchar','course_code'=>'varchar');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','course_title'=>'','course_code'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array();
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array();//array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.
		
static $relation=array();
static $tableAction=array('delete'=>'delete/course','edit'=>'edit/course');
function __construct($array=array())
{
	parent::__construct($array);
}
function getCourse_titleFormField($value=''){
	return "<div class='form-group'>
	<label for='course_title' >Course Title</label>
		<input type='text' name='course_title' id='course_title' value='$value' class='form-control' required />
</div> ";

}
function getCourse_codeFormField($value=''){
	return "<div class='form-group'>
	<label for='course_code' >Course Code</label>
		<input type='text' name='course_code' id='course_code' value='$value' class='form-control' required />
</div> ";

}




}