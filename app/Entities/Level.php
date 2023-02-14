<?php
namespace App\Entities;

use App\Models\Crud;
class Level extends Crud
{
protected static $tablename='Level';
/* this array contains the field that can be null*/
static $nullArray=array('description');
static $compositePrimaryKey=array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/
static $displayField = 'level_name';
static $uniqueArray=array('level_name' );
/*this is an associative array containing the fieldname and the type of the field*/
static $typeArray = array('level_name'=>'varchar','description'=>'text');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','level_name'=>'','description'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array();
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array();//array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.
		
static $relation=array('session_semester_course'=>array(array( 'ID', 'level_id', 1))
);
static $tableAction=array('delete'=>'delete/level','edit'=>'edit/level');
function __construct($array=array())
{
	parent::__construct($array);
}
function getLevel_nameFormField($value=''){
	return "<div class='form-group'>
	<label for='level_name' >Level Name</label>
		<input type='text' name='level_name' id='level_name' value='$value' class='form-control' required />
</div> ";

}
function getDescriptionFormField($value=''){
	return "<div class='form-group'>
	<label for='description' >Description</label>
<textarea id='description' name='description' class='form-control' required>$value</textarea>
</div> ";

}


}