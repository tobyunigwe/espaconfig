<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Exception;

/**
 * Class SshController
 * @package App\Http\Controllers
 */
class SshController extends Controller
{
    /**
     *
     */

    public function index()
    {
        return view('ssh.index');
    }

    private function connection()
    {
        //create a SSH connection
        $connection = ssh2_connect('10.10.2.79', 22, array('hostkey' => 'ssh-rsa'));

        //defining keys for MC to grant access
        $pubkey = env('SSH_PUBLIC_KEY');
        $privKey = env('SSH_PRIVATE_KEY');
        $username = env('SSH_USERNAME');
        $passphrase = env('SSH_PASSPHRASE');

        //checking info for server to grant access (VPN must be on for this to work)
        if (ssh2_auth_pubkey_file($connection, $pubkey, $privKey, $passphrase)) {

            //define the source and destination file paths
            $srcFile = env('SSH_SOURCE_FILE');
            $dstFile = env('SSH_DESTINATION_FILE');

            //create a SFTP session
            $sftp = ssh2_sftp($connection);

            //opening file transfer stream with write functionality
            $stream = @fopen('ssh2.sftp://' . $sftp . $dstFile, 'w');
            try {

                if (!$stream) {
                    throw new Exception("Could not open remote file: $dstFile");
                }
                Log::info('SFTP steam started.');

                $sendData = @file_get_contents($srcFile);
                Log::info('Data content collected');

                if ($sendData === false) {
                    throw new Exception("Could not open local file: $srcFile.");
                }
                Log::info('local file opened');

                if (@fwrite($stream, $sendData) === false) {
                    throw new Exception("Could not send data from file: $srcFile.");
                }
                Log::info('Local file sent');

                fclose($stream);

                //throw all errors and send to log
            } catch (Exception $e) {
                error_log('Exception: ' . $e->getMessage());
                fclose($stream);
            }

        } else {
            die('Public Key Authentication Failed');
        }
        return back()->with('status', 'File transfer complete!');
    }

    public function connect()
    {
        //accessing the private method
        return $this->connection();
    }
}

