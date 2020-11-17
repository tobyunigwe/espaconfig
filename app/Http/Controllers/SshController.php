<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SshController extends Controller
{
    public function connect()
    {
        //Showing all errors
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $host = '10.10.2.79';
        $username = 'root';
        $password = 'Gl3yt8Bo99776';
        $connection = ssh2_connect($host, 22);
        ssh2_auth_password($connection, $username, $password);

        $stream = ssh2_exec($connection, '');

    }
}
