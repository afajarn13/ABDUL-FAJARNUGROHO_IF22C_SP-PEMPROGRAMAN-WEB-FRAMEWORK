<?php
 

header('content-type: application/json');

      $request=$_SERVER['REQUEST_METHOD'];

   switch ( $request) {
   	case 'GET':
	    $data=json_decode(file_get_contents('php://input'),true);
   		getmethod($data);
   	break;
   	case 'PUT':
          $data=json_decode(file_get_contents('php://input'),true);
         putmethod($data);
   	break;
   	case 'POST':
   		$data=json_decode(file_get_contents('php://input'),true);
         postmethod($data);
   	break;
   	case 'DELETE':
   		$data=json_decode(file_get_contents('php://input'),true);
         deletemethod($data);
   	break;
   	
   	default:
   		echo '{"name": "data not found"}';
   		break;
   }
//data read part are here
function getmethod($data){
  include "db.php";
  
  $id=$data["id"];
  $title=$data["title"];
  $request_parameter=$data["request_parameter"];
  
  //echo $title;
  
  if ($request_parameter=="by_id")
  {
	  
	  $sql = "SELECT * FROM survey where id=".$id;
	  $result = mysqli_query($conn, $sql);

	  if (mysqli_num_rows($result) > 0) {
		   $rows=array();
		   while ($r = mysqli_fetch_assoc($result)) {

			  $rows["result"][] = $r;
		   }

      }
  }
  else if ($request_parameter=="by_id_response")
  {
	  
	  $sql = "SELECT * FROM survey where id=".$id;
	  $result = mysqli_query($conn, $sql);

	  if (mysqli_num_rows($result) > 0) {
		   $rows=array();
		   while ($r = mysqli_fetch_assoc($result)) {

			  $rows["result"][] = $r;
		   }

      }
  }
  
  else if ($request_parameter=="get_jawaban")
  {
	  
	 $sql = "SELECT * FROM jawaban where question_id=".$id;
	  $result = mysqli_query($conn, $sql);

	  if (mysqli_num_rows($result) > 0) {
		   $rows=array();
		   while ($r = mysqli_fetch_assoc($result)) {

			  $rows["result"][] = $r;
		   }

      }
  }
   else if ($request_parameter=="all") 
  {	  
   echo "data1";
	  $sql = "SELECT * FROM survey";
	  $result = mysqli_query($conn, $sql);

	  if (mysqli_num_rows($result) > 0) {
		   $rows=array();
		   while ($r = mysqli_fetch_assoc($result)) {

			  $rows["result"][] = $r;
		   } 
	  }
  }
  
if (mysqli_num_rows($result) > 0) {
       echo json_encode($rows);
  }  else{
      echo '{"result": "no data found"}';
  }
  
  
}
//data insert part are here
function postmethod($data){
   include "db.php";
   
   
   $request_parameter=$data["request_parameter"];
   
   if ($request_parameter=="pertanyaan")
   {
	   
	   $title=$data["title"];
	   $description=$data["description"];
	   
	   $question=$data["question"];
	   $type=$data["type"];
	   
	   $options=$data["options"];
   
	  $sql= "INSERT INTO survey(title,description,question,type,options) VALUES ('$title','$description','$question','$type','$options' )"; 	
   }else if ($request_parameter=="jawaban")
   {
	   
	  // echo "jawaban1";
	  $question_id=$data["question_id"];
	  $answer=$data["answer"]; 
	   
	   
      $sql= "INSERT INTO jawaban(question_id,answer) VALUES ('$question_id','$answer')";	  
   }
   //echo $sql;
   if (mysqli_query($conn , $sql)) {
      echo '{"result": "data inserted"}';
   } else{

      echo '{"result": "data not inserted"}';
   }



}

//data edit part are here
function putmethod($data){
   include "db.php";
   $id=$data["id"];
   $name=$data["name"];
   $email=$data["email"];

   $sql= "UPDATE learnhunter SET name='$name', email='$email', created_at=NOW() where id='$id'  ";

   if (mysqli_query($conn , $sql)) {
      echo '{"result": "Update Succesfully"}';
   } else{

      echo '{"result": "not updated"}';
   }



}
//delete method are here,,,,,,,,,,,,,,
function deletemethod($data){
   include "db.php";

   $id=$data["id"];
   


   $sql= "DELETE FROM learnhunter where id=$id";

   if (mysqli_query($conn , $sql)) {
      echo '{"result": "delete Succesfully"}';
   } else{

      echo '{"result": "not deleted"}';
   }
}
?>
