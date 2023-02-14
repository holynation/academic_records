<?php

namespace App\Entities;

use App\Models\Crud;
class Entry_mode extends Crud
{
protected static $tablename='Entry_mode';
/* this array contains the field that can be null*/
static $nullArray=array();
static $compositePrimaryKey=array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/
static $uniqueArray=array('mode_of_entry');
/*this is an associative array containing the fieldname and the type of the field*/
static $typeArray = array('mode_of_entry'=>'varchar','level_id'=>'int','description'=>'text');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','mode_of_entry'=>'','level_id'=>'Start Level','description'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array();
static $displayField = 'mode_of_entry';
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array();//array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.
		
static $relation=array('student_biodata'=>array(array( 'ID', 'entry_mode_id', 1))
);
static $tableAction=array('delete'=>'delete/entry_mode','edit'=>'edit/entry_mode');
function __construct($array=array())
{
	parent::__construct($array);
}
function getMode_of_entryFormField($value=''){
	return "<div class='form-group'>
	<label for='mode_of_entry' >Mode Of Entry</label>
		<input type='text' name='mode_of_entry' id='mode_of_entry' value='$value' class='form-control' required />
</div> ";

}
function getDescriptionFormField($value=''){
	return "<div class='form-group'>
	<label for='description' >Description</label>
<textarea id='description' name='description' class='form-control' required>$value</textarea>
</div> ";

}

function getLevel_idFormField($value=''){
	$fk=array('table'=>'level','display'=>'level_name'); 

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='level_id' id='level_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='level_id'>start Level </label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='level_id' id='level_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;

}
		
protected function getStudent_biodata(){
	$query ='SELECT * FROM student_biodata WHERE entry_mode_id=?';
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->getResultArray();
	if (empty($result)) {
		return false;
	}
	$resultobjects = array();
	foreach ($result as  $value) {
		$resultObjects[] = new \App\Entities\Student_biodata($value);
	}

	return $resultObjects;
}


}