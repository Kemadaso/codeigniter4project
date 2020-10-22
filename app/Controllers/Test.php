<?php 

namespace App\Controllers;

use \App\Models\User;

class Test extends BaseController
{
	public function index()
	{
    
    //$userModel = model('App\Models\UserModel');
    $user = new User();

    $activeUsers = $user->findAll();

    var_dump($activeUsers);
    
    echo "ahurrid";
    }
    
    public function bechmark()
	{
    
    
    
        echo "ahurrid";

	}

	//--------------------------------------------------------------------

}
