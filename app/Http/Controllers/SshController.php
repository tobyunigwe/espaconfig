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

    /**
     *
     *
     * @param $ipAdress
     * @return void
     */
    public function connection()
    {
        $ipAdress = '10.10.2.79';

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

                //Commands for the MC to generate configuration files.
                $stream = ssh2_exec($connection, 'export ESPA_SDR_CONFIG="/storage/espa-sdr/etc/espa-sdr.xml" ; php -f /storage/espa-sdr/php/generate-config.php', null, []);                stream_set_blocking($stream, true);

                $streamOut = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
                $streamContents = stream_get_contents($streamOut);

                //Disconnect in case of errors.
                if (strpos($streamContents, 'ERROR') !== false) {

                    echo 'FAILED: ' . $streamContents;
                    fclose($stream);
                    exit();

                } else {
                    echo 'SUCCESS: ' . $streamContents;

                    //When successful, wait 20 seconds to let the MC generate the config files,
                    sleep(20);

                    //And after that, execute commands on the MC to reset the daemon.
                    $stream = ssh2_exec ( $connection , "/storage/espa-sdr/bin/run-espa restart");
                    $stream = ssh2_exec ( $connection , "/storage/espa-sdr/bin/run-sdr restart");

                    fclose($stream);
                }

                //throw all errors and send to log
            } catch (Exception $e) {
                error_log('Exception: ' . $e->getMessage());
                fclose($stream);
            }

        } else {
            die('Public Key Authentication Failed');
        }
        return;
    }

}

