<?php 
	/**
	* This is the class that contain the method that will be called whenever any data is inserted for a particular table.
	* the url path should be linked to this page so that the correct operation is performed ultimately. T
	*/
	namespace App\Models;

	use CodeIgniter\Model;
	use App\Models\WebSessionManager;
	use App\Models\Mailer;
	use CodeIgniter\I18n\Time;

	class ModelControllerCallback extends Model
	{
		protected $db;
		private $webSessionManager;
		private $mailer;

		function __construct()
		{
			helper(['string','url','array']);
			$this->webSessionManager = new WebSessionManager;
			$this->mailer = new Mailer;
			$this->db = db_connect();
		}

		public function onAdminInserted($data,$type,&$db,&$message)
		{
			//remember to remove the file if an error occured here
			//the user type should be admin
			$user = loadClass('user');
			if ($type=='insert') {
				// login details as follow: username = email, password = firstname(in lowercase)
				$password = encode_password(strtolower($data['firstname']));
				$param = array('user_type'=>'admin','username'=>$data['email'],'password'=>$password,'user_table_id'=>$data['LAST_INSERT_ID']);
				$std = new $user($param);
				if ($std->insert($db,$message)) {
					return true;
				}
				return false;
			}
			return true;
		}

		public function onLecturerInserted($data,$type,&$db,&$message)
		{
			//remember to remove the file if an error occured here
			//the user type should be admin
			$user = loadClass('user');
			if ($type=='insert') {
				// login details as follow: username = email, password = firstname(in lowercase)
				$password = encode_password(strtolower($data['firstname']));
				$param = array('user_type'=>'lecturer','username'=>$data['email'],'password'=>$password,'user_table_id'=>$data['LAST_INSERT_ID']);
				$std = new $user($param);
				if ($std->insert($db,$message)) {
					return true;
				}
				return false;
			}
			return true;
		}

		public function onStudent_biodataInserted($data,$type,&$db,&$message)
		{
			//remember to remove the file if an error occured here
			//the user type should be admin
			$user = loadClass('user');
			if ($type=='insert') {
				// login details as follow: username = matric, password = firstname(in lowercase)
				$password = encode_password(strtolower($data['surname']));
				$param = array('user_type'=>'student_biodata','username'=>$data['matric_number'],'password'=>$password,'user_table_id'=>$data['LAST_INSERT_ID']);
				$std = new $user($param);
				if ($std->insert($db,$message)) {
					return true;
				}
				return false;
			}
			return true;
		}

	}
 ?>