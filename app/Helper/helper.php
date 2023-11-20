<?php
 

 function getAllCategory()
{

	return \App\Models\ClassifiedCategory::all();
}

function getAllSubCategory()
{

	return \App\Models\ClassifiedSubCategory::all();
}

function getAllRoles()
{
	return \App\Models\Role::all();
}

function getAllPermissions()
{
	return \App\Models\Permission::all();
}

function getAllCountries()
{
	return \App\Models\Country::all();
}

function getAllState()
{
	return \App\Models\State::all();
}


function getCountryNamebyId($id)
{
	return \App\Models\Country::where('id', $id)->first();
}

function getStateNamebyId($id)
{
	return \App\Models\State::where('id', $id)->first();
}

function getRoleNamebyId($id)
{
	return \App\Models\Role::where('id', $id)->first();
}

function getPermissionNamebyId($id)
{
	return \App\Models\Permission::where('id', $id)->first();
}

function getCategoryNamebyId($id)
{
	return \App\Models\ClassifiedCategory::where('id', $id)->first();
}

function getSubCategoryNamebyId($id)
{
	return \App\Models\ClassifiedSubCategory::where('id', $id)->first();
}

function getMultipleCityNamebyId($id)
{
	$citiesIds = explode(",", $id);
	return \App\Models\City::whereIn('id', $citiesIds)->get();
}


function getCityNamebyId($id)
{
	return \App\Models\City::where('id', $id)->first();
}

function getBusinessCategoryNamebyId($id)
{
	return \App\Models\BusinessCategory::where('id', $id)->first();
}
function getBusinessSubCategoryNamebyId($id)
{
	return \App\Models\BusinessSubCategory::where('id', $id)->first();
}


function getAllBusinessCategory()
{

	return \App\Models\BusinessCategory::all();
}


function getUniversityNamebyId($id)
{
	return \App\Models\University::where('id', $id)->first();
}

function getAllUniversity()
{
	return \App\Models\University::all();
}

function getAllStudentTalkCategory()
{
	return \App\Models\StudentTalkCategory::all();
}



function getAllEventCategory()
{

	return \App\Models\EventCategory::all();
}


function getEventCategoryNamebyId($id)
{
	return \App\Models\EventCategory::where('id', $id)->first();
}


function getAllTrainingCategory()
{

	return \App\Models\TrainingPlacementCategory::all();
}


function getTrainingCategoryNamebyId($id)
{
	return \App\Models\TrainingPlacementCategory::where('id', $id)->first();
}



function getAllBlogCategory()
{

	return \App\Models\BlogCategory::all();
}


function getBlogCategoryNamebyId($id)
{
	return \App\Models\BlogCategory::where('id', $id)->first();
}





function getAllForumCategory()
{

	return \App\Models\ForumCategory::all();
}


function getForumCategoryNamebyId($id)
{
	return \App\Models\ForumCategory::where('id', $id)->first();
}



function getAllForumSubCategory()
{

	return \App\Models\ForumSubCategory::all();
}

function getForumSubCategoryNamebyId($id)
{
	return \App\Models\ForumSubCategory::where('id', $id)->first();
}





function getAllMovieVideoCategory()
{

	return \App\Models\MovieVideoCategory::all();
}

function getMovieVideoCategoryNamebyId($id)
{
	return \App\Models\MovieVideoCategory::where('id', $id)->first();
}

function getAllMovieVideoLanguage()
{

	return \App\Models\MovieVideoLanguage::all();
}

function getMovieVideoLanguageNamebyId($id)
{
	return \App\Models\MovieVideoLanguage::where('id', $id)->first();
}

function sendCommentAlert($data)
{

    // dd($data);
	$sub_type = isset($data['sub_type']) ? $data['sub_type'] : 'Comment';
	$name = isset($data['name']) ? $data['name'] : '';

	if (isset($data['link']) && isset($data['type']) && $data['email'] ) {
		if ($data['type'] == 'Verification') {
			$content = "<html><body>Hello ". $name ." ,\n<br>If you click the Verify Email Address your account will get verified.". $data['link'] . "</body></html>" ;
			$subject = "You have a Register on your " . $data['type'] . " Email Address";
		}
		elseif ($data['type'] == 'ForgotPassword') {
			$content = "<html><body>Hello ". $name ." ,\n<br>Click the Url to reset the password.". $data['link'] . "</body></html>" ;
			$subject = "You have a Register on your " . $data['type'] . " Email Address";
		}
		
		else{			
			$content = "<html><body>Hello ". $name ." ,\n<br>You have a ". $sub_type ." on your " . $data['type'] . " post. \n\n<br><br>Click on this link to view the  " . $sub_type . ' '. $data['link'] . "</body></html>" ;
			$subject = "You have a " . $sub_type . " on your " . $data['type'] . " post";
		}
		try {
			
			$headers = "From: info@nris.com\r\n";
			$headers .= "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

            $result = mail($data['email'], $subject, $content, $headers );
    

			if ($result) {
				return true;
			} else {
				return false;
			}

			
		} catch (\Exception $e) {
			echo "HERE CATCH";
		    dd($e);
			return $e->getMessage();
		}
	}
	return false;
}


function sendCreadentialsAlert($data){
    // dd($data);
	$sub_type = 'Creadentials';
	$name = isset($data['name']) ? $data['name'] : '';
	$email = isset($data['email']) ? $data['email'] : '';
	$pass = isset($data['pass']) ? $data['pass'] : '';

	if ($data['email'] ) {

		$content = "<html><body>Hello ". $name ." ,\n<br>Successfully your profile created.. \n<br>Please find your credentials below  \n\n<br>
		Email = ". $email .",\n<br>
		password = ". $pass ."
		</body></html>" ;
		$subject = "You have a " . $sub_type;

		try {

			
			$headers = "From: info@nris.com\r\n";
			$headers .= "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

            mail($data['email'], $subject, $content, $headers );
    
			return true;
		} catch (\Exception $e) {
		    dd($e);
			return $e->getMessage();
		}
	}
	return false;
}



function displayDotDot($str){   
	$string = mb_strimwidth($str, 0, 65, "...");
	return $string;
}




