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

    public function connection($ipAdress)
    {
        //create a SSH connection
        $connection = ssh2_connect($ipAdress, 22, array('hostkey' => 'ssh-rsa'));

        //defining keys for MC to grant access
        $pubkey = env('SSH_PUBLIC_KEY');
        $privKey = env('SSH_PRIVATE_KEY');
        $username = env('SSH_USERNAME');
        $passphrase = env('SSH_PASSPHRASE');

        //checking info for server to grant access (VPN must be on for this to work)
        if (ssh2_auth_pubkey_file($connection, $username, $pubkey, $privKey, $passphrase)) {

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

//                prevent the script to run before the MC is ready for it
//                sleep(10);

                $stream = ssh2_exec($connection, "ESPA_SDR_CONFIG '/storage/espa-sdr/bin/etc/espa-sdr.xml' php -f /storage/espa-sdr/php/generate-config.php", null, []);
//                $stream = ssh2_exec($connection, "php -f /storage/espa-sdr/php/generate-config.php", null, ["ESPA_SDR_CONFIG" => "/storage/espa-sdr/bin/etc/espa-sdr.xml"]);
                $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
                echo stream_get_contents($stream_out);
//
//                $output2 = ssh2_exec($connection, '^[');
//                stream_set_blocking($output2, true);
//                $stream_out = ssh2_fetch_stream($output2, SSH2_STREAM_STDIO);
//                echo stream_get_contents($stream_out);
//
//                $output3 = ssh2_exec($connection, '^[');
//                stream_set_blocking($output3, true);
//                $stream_out = ssh2_fetch_stream($output3, SSH2_STREAM_STDIO);
//                echo stream_get_contents($stream_out);

//                $commands = [ '/storage/espa-sdr/bin/configure', '^[[21~' ];
//                ssh2_auth_password( $connection, 'username', 'password' );
//                $output = [];
//                foreach ($commands as $cmd) {
//                    $stream = ssh2_exec( $connection, $cmd );
//                    stream_set_blocking( $stream, true );
//                    $stream_out = ssh2_fetch_stream( $stream, SSH2_STREAM_STDIO );
//                    $output[] = stream_get_contents($stream_out);
//                }

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

}

