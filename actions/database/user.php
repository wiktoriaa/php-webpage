<?php
	

	class User {

			public  $hash_salt = 'avDf7FvSB7h';


			/* Metoda sprawdzająca czy użytkownik istnieje, jeśli tak, zwraca jego dane */

			private function get_user_data($username, $password = '') {

				$data = array();

				$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
				
				if ($password == '')
					$filter = [ 'username' => $username ]; 
				
				else 
					$filter = [ 'username' => $username, 'pass' => md5($password . $this->hash_salt) ];

				$query = new MongoDB\Driver\Query($filter); 
				$data['username'] = '';
					     
				$rows = $mng->executeQuery("wai.users", $query);

					    
				foreach ($rows as $row) {
					    
				    if ($username == $row->username) {

				      	$data['username'] = $row->username;	
				      	$data['pass'] = $row->pass;
				      	$data['id'] = $row->id;
				    }
				}

				return $data;
			}



			/* Metoda dodająca użytkownika do bazy */

			private function user_add($username, $pass, $email) {

			   $con = new MongoDB\Client("mongodb://localhost:27017");

			   $db = $con->selectDatabase('wai');
			   $col = $db->selectCollection('users');

			   $document = array( 
			      "username" 	 => $username, 
			      "pass" 		 => md5($pass . $this->hash_salt),
			      "email" 	     => $email,
			      "id"			 => md5($username . random_int(1, 9999))
			   );

			   $col->insertOne($document);
			}



			/* Wyślij obrazek na serwer */

			private function img_send(array $image) {

				if(isset($image['image'])){

				      $errors 	 = array();
				      $file_name = $image['image']['name'];
				      $file_size = $image['image']['size'];
				      $file_tmp  = $image['image']['tmp_name'];
				      $file_type = $image['image']['type'];
				      $file_ext  = strtolower(end(explode('.', $image['image']['name'])));
				      
				      $expensions = array("jpeg","jpg","png");
				      
				      if (in_array($file_ext, $expensions) === false){
				         $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
				      }
				      
				      if ($file_size > 2097152){
				         $errors[] =' File size must be excately 2 MB';
				      }
				      
				      if (empty($errors) == true){

				         move_uploaded_file($file_tmp, "../img/upload/" . $file_name);
				         echo "Success";

				      }

				      else
				         print_r($errors);

				   }
			}



			/* Sprawdz czy w bazie istnieje obrazek o nazwie $img_name */

			private function img_name_exist($img_name) {

				$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

				$filter = [ 'img' => $img_name ]; 
				$query = new MongoDB\Driver\Query($filter); 

				$rows = $mng->executeQuery("wai.images", $query);

				foreach ($rows as $row) {

					if ($row->img == $img_name)
						$img_name = random_int(0, 9) . $img_name;
				}

				return $img_name;
			}



			/* Zapisz info o obrazku w bazie MongoDB */

			private function img_store_info($username, $img_name, $role) {

				$img_name = $this->img_name_exist($img_name);

				$con = new MongoDB\Client("mongodb://localhost:27017");

			    $db = $con->selectDatabase('wai');
			    $col = $db->selectCollection('images');

			    $document = array( 
			      "username" 	 => $username, 
			      "img" 		 => $img_name,
			      "role"		 => $role
			    );

			    $col->insertOne($document);

			    return $img_name;

			}



			/* Publiczna metoda dodająca uzytkownika */

			public function add($username, $pass, $email) {

				$user_data = $this->get_user_data($username);

				if ($user_data['username'] != '') {
					header("Location: ../?page=login&err=u");
					exit();
				}

				$this->user_add($username, $pass, $email);

				header('Location: ../../?page=login&reg=1');

			}

			
			
			/* Publiczna metoda logowania */

			public function login($username, $pass) {

				$data = $this->get_user_data($username, $pass);

				if (md5($pass . $this->hash_salt) == $data['pass']) {

					$_SESSION['user']  = $username;
					$_SESSION['id']	   = $data['id'];

					header('Location: ../../?page=panel');

				}

				else
					header("Location: ../?page=login&err=n");

			}



			/* Metoda przesyłania obrazka */

			public function send_image($username, $image, $role = 'public') {

				$image = $this->img_store_info($username, $image, $role);
				return $image;

			}


			/* Pobierz nazwy plików należących do użytkownika $username */

			public function get_all_images($username, $role = 'public') {

				$images = array();

				$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");

				$filter = [ 'username' => $username, 'role' => $role]; 
				$query = new MongoDB\Driver\Query($filter); 

				$rows = $mng->executeQuery("wai.images", $query);

				foreach ($rows as $row) {
					$images[] = $row->img;
				}

				return $images;
			}

	}


?>