<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\File;

use App\Data;
use phpDocumentor\Reflection\Types\Nullable;

class DataController extends Controller
{
    /** @noinspection PhpArrayUsedOnlyForWriteInspection */
    public function load()
    {
        $dom = new \DOMDocument();
        $dom->load('config.xml');

        //init
        $array = array();
        //get all form tags
        $generals = $dom->getElementsByTagName('general');
        $apis = $dom->getElementsByTagName('api');
        foreach ($generals as $general) {
            //get all field-tags from this form
            $fields = $general->getElementsByTagName('field');
            //create an empty element
            $element = array();
            //walk through the input elements of the current form element
            foreach ($fields as $field) {
                $name = $field->getAttribute('name');
                $value = $field->nodeValue;
                //add the data to element array
                $element[$name] = $value;
            }
            //add the element to your array
            $array[] = $element;
        }
        foreach ($apis as $api) {
            //get all field-tags from this form
            $fields = $api->getElementsByTagName('field');
            //create an empty element
            $element = array('api');
            //walk through the input elements of the current form element
            foreach ($fields as $field) {
                $name = $field->getAttribute('name');
                $value = $field->nodeValue;
                //add the data to element array
                $element[$name] = $value;
            }
            //add the element to your array
            $array[] = $element;

        }


        //print it
        $datas = $array;
//         var_dump($datas);die;

        return $datas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = $this->load();
        return view('data')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dom = new \DomDocument('1.0');
        $dom->load('config.xml');


        $datas = $this->load();

        $lastArray = end($datas);
        $lastId = $lastArray['id'];


        //set the root element config
        $config = $dom->getElementsByTagName('config')->item(0);


        // set the id in config
        $id = $dom->createElement('field', $lastId + 1);
        $idAttribute = $dom->createAttribute('name');
        $idAttribute->value = 'id';
        $id->appendChild($idAttribute);

        //general Element and children
        $general = $dom->createElement('general');

        $drymode = $dom->createElement('field',$request['drymode']);
        $drymodeAttribute = $dom->createAttribute('drymode');
        $drymodeAttribute->value = ("True|False");
        $drymode->appendChild($drymodeAttribute);

        $loglevel = $dom->createElement('field', $request['loglevel']);
        $loglevelAttribute = $dom->createAttribute('loglevel');
        $loglevelAttribute->value = ("ERROR|WARNING|NOTICE|INFO|DEBUG");
        $loglevel->appendChild($loglevelAttribute);

        //floodprotection Element and children
        $floodprotection = $dom->createElement('floodprotection');

        $silentPeriod= $dom->createElement('field', $request['silentPeriod']);
        $silentPeriodAttribute = $dom->createAttribute('silentPeriod');
        $silentPeriodAttribute->value = ('silentPeriode');
        $silentPeriod->appendChild($silentPeriodAttribute);

        $silenceRequired= $dom->createElement('field', $request['silenceRequired']);
        $silenceRequiredAttribute = $dom->createAttribute('silenceRequired');
        $silenceRequiredAttribute->value = ('silenceRequired');
        $silenceRequired->appendChild($silenceRequiredAttribute);

        $expirePeriod= $dom->createElement('field', $request['expirePeriod']);
        $expirePeriodAttribute = $dom->createAttribute('expirePeriod');
        $expirePeriodAttribute->value = ('expirePeriod');
        $expirePeriod->appendChild($expirePeriodAttribute);


        //general_email Element and children
        $email_general = $dom->createElement('email_general');

        $fromAddress = $dom->createElement('field');
        $fromAddressAttribute = $dom->createAttribute('fromAddress');
        $fromAddressAttribute->value = ("from@picasse.com");
        $fromAddress->appendChild($fromAddressAttribute);

        $bounceAddress = $dom->createElement('field');
        $bounceAddressAttribute = $dom->createAttribute('bounceAddress');
        $bounceAddressAttribute->value = ("bounce@picasse.com");
        $bounceAddress->appendChild($bounceAddressAttribute);



        //api Element and data
        $api = $dom->createElement('api');

        $primaryUrl = $dom->createElement('field');
        $primaryUrlAttribute = $dom->createAttribute('primaryUrl');
        $primaryUrlAttribute->value = ("http://vpn1.smsalarmering.nl/api/v2/jsonrpc/");
        $primaryUrl->appendChild($primaryUrlAttribute);

        $secondaryUrl = $dom->createElement('field');
        $secondaryUrlAttribute = $dom->createAttribute('secondaryUrl');
        $secondaryUrlAttribute->value = ("http://new.smsalarmering.nl/api/v2/jsonrpc/");
        $secondaryUrl->appendChild($secondaryUrlAttribute);

        $username = $dom->createElement('field', $request['username']);
        $usernameAttribute = $dom->createAttribute('username');
        $usernameAttribute->value = 'username';
        $username->appendChild($usernameAttribute);

        $password = $dom->createElement('field', $request['password']);
        $passwordAttribute = $dom->createAttribute('password');
        $passwordAttribute->value = 'password';
        $password->appendChild($passwordAttribute);

        $incomingSmsNumber = $dom->createElement('field');
        $incomingSmsNumberAttribute = $dom->createAttribute('incomingSmsNumber');
        $incomingSmsNumberAttribute->value = ("+31642500091");
        $incomingSmsNumber->appendChild($incomingSmsNumberAttribute);

        //actions element
        $actions = $dom->createElement('actions');

        // action element and children
        $action = $dom->createElement('action');

        $action_type = $dom->createElement('field', $request['action_type']);
        $action_typeAttribute = $dom->createAttribute('action_type');
        $action_typeAttribute->value = 'action_type';
        $action_type->appendChild($action_typeAttribute);

        $action_name = $dom->createElement('field', $request['action_name']);
        $action_nameAttribute = $dom->createAttribute('action_name');
        $action_nameAttribute->value = 'action_name';
        $action_name->appendChild($action_nameAttribute);

        //recipients element and children
        $recipients = $dom->createElement('recipients');

        $number = $dom->createElement('field');
        $numberAttribute = $dom->createAttribute('number');
        $numberAttribute->value = ("+3592342342");
        $number->appendChild($numberAttribute);

        $locationid1 = $dom->createElement('field', $request['location_id1']);
        $locationid1Attribute = $dom->createAttribute('locationid');
        $locationid1Attribute->value = 'location id';
        $locationid1->appendChild($locationid1Attribute);

        if (!empty($locationid2 = $dom->createElement ('field', $request['location_id2'])));
        $locationid2Attribute = $dom->createAttribute('locationid');
        $locationid2Attribute->value = 'location id';
        $locationid2->appendChild($locationid2Attribute);

        $contactid1 = $dom->createElement('field', $request['contact_id1']);
        $contactid1Attribute = $dom->createAttribute('contactid');
        $contactid1Attribute->value = 'contact id';
        $contactid1->appendChild($contactid1Attribute);

        $contactid2 = $dom->createElement('field', $request['contact_id2']);
        $contactid2Attribute = $dom->createAttribute('contactid');
        $contactid2Attribute->value = 'contact id';
        $contactid2->appendChild($contactid2Attribute);

        $groupid1 = $dom->createElement('field', $request['group_id1']);
        $groupid1Attribute = $dom->createAttribute('groupid');
        $groupid1Attribute->value = 'group id';
        $groupid1->appendChild($groupid1Attribute);

        $groupid2 = $dom->createElement('field', $request['group_id2']);
        $groupid2Attribute = $dom->createAttribute('groupid');
        $groupid2Attribute->value = 'group id';
        $groupid2->appendChild($groupid2Attribute);

        $tag = $dom->createElement('field', $request['tag']);
        $tagAttribute = $dom->createAttribute('tag');
        $tagAttribute->value = 'tag';
        $tag->appendChild($tagAttribute);

        //message element and children
        $message = $dom->createElement('message');

        $priority = $dom->createElement('field', $request['priority']);
        $priorityAttribute = $dom->createAttribute('priority');
        $priorityAttribute->value = 'priority';
        $priority ->appendChild($priorityAttribute);

        $requiredReceipt = $dom->createElement('field', $request['requiredReceipt']);
        $requiredReceiptAttribute = $dom->createAttribute('requiredReceipt');
        $requiredReceiptAttribute->value = 'requiredReceipt';
        $requiredReceipt ->appendChild($requiredReceiptAttribute);

        $modify = $dom->createElement('field', $request['modify']);
        $modifyAttribute = $dom->createAttribute('modify');
        $modifyAttribute->value = 'modify';
        $modify ->appendChild($modifyAttribute);

        //voicecall element and children
        $voicecall = $dom->createElement('voicecall');

        $voiceMessageId = $dom->createElement('field', $request['voiceMessageId']);
        $voiceMessageIdAttribute = $dom->createAttribute('voiceMessageId');
        $voiceMessageIdAttribute->value = 'voiceMessage id';
        $voiceMessageId->appendChild($voiceMessageIdAttribute);

        $useTts = $dom->createElement('field', $request['useTts']);
        $useTtsAttribute = $dom->createAttribute('useTts');
        $useTtsAttribute->value = 'useTts';
        $useTts ->appendChild($useTtsAttribute);

        //modify element and children
        $modify = $dom->createElement('modify');

        $modify_type = $dom->createElement('field', $request['modify_type']);
        $modify_typeAttribute = $dom->createAttribute('modify_type');
        $modify_typeAttribute->value = 'modifytype';
        $modify_type ->appendChild($modify_typeAttribute);

        //Espa element and children
        $espa = $dom->createElement('espa');

        $espa_enabled = $dom->createElement('field', $request['espa_enabled']);
        $espa_enabledAttribute = $dom->createAttribute('enabled');
        $espa_enabledAttribute->value = 'enabled';
        $espa_enabled ->appendChild($espa_enabledAttribute);


        //Espa_general element and children
        $espa_general = $dom->createElement('espa_general');

        $espa_general_floodprotection= $dom->createElement('field', $request['espa_general_floodprotection']);
        $espa_general_floodprotectionAttribute = $dom->createAttribute('floodprotection');
        $espa_general_floodprotectionAttribute->value = 'floodprotection';
        $espa_general_floodprotection->appendChild($espa_general_floodprotectionAttribute);

        //option element and children
        $option = $dom->createElement('option');

        $option_name= $dom->createElement('field', $request['option_name']);
        $option_nameAttribute = $dom->createAttribute('option');
        $option_nameAttribute->value = 'option';
        $option_name->appendChild($option_nameAttribute);

        //rule element and children
        $rule = $dom->createElement('rule');

        $rule_name= $dom->createElement('field', $request['rule_name']);
        $rule_nameAttribute = $dom->createAttribute('rulename');
        $rule_nameAttribute->value = 'rulename';
        $rule_name->appendChild($rule_nameAttribute);


        $match= $dom->createElement('field', $request['match']);
        $matchAttribute = $dom->createAttribute('what');
        $matchAttribute->value = ('pager');
        $match->appendChild($matchAttribute);

        //timeframe element and children
        $timeframe = $dom->createElement('timeframe');

        $starttime= $dom->createElement('field', $request['starttime']);
        $starttimeAttribute = $dom->createAttribute('starttime');
        $starttimeAttribute->value = ('starttime');
        $starttime->appendChild($starttimeAttribute);

        $endtime= $dom->createElement('field', $request['endtime']);
        $endtimeAttribute = $dom->createAttribute('endtime');
        $endtimeAttribute->value = ('endtime');
        $endtime->appendChild($endtimeAttribute);

        $daysOfWeek= $dom->createElement('field', $request['daysOfWeek']);
        $daysOfWeekAttribute = $dom->createAttribute('daysOfWeek');
        $daysOfWeekAttribute->value = ('daysOfWeek');
        $daysOfWeek->appendChild($daysOfWeekAttribute);

        $actionReference= $dom->createElement('field', $request['actionReference']);
        $actionReferenceAttribute = $dom->createAttribute('actionReference');
        $actionReferenceAttribute->value = ('actionReference');
        $actionReference->appendChild($actionReferenceAttribute);

        // wellicht hier rule 2? tweede rule actie.



        //receiver element and children
        $receiver = $dom->createElement('receiver', ['file="/storage/espa-sdr/etc/espa-receiver.ini"']);

        //main element and children
        $main = $dom->createElement('main');

        //pidfile element
        $pidFile= $dom->createElement('field',["/storage/espa-sdr/var/espa-receiver.pid"]);

        $sleeptime= $dom->createElement('field', $request['sleeptime']);
        $sleeptimeAttribute = $dom->createAttribute('daysOfWeek');
        $sleeptimeAttribute->value = ('sleeptime');
        $sleeptime->appendChild($sleeptimeAttribute);

        //smsCommand element
        $smsCommand= $dom->createElement('field',["/storage/bin/php -f /storage/espa-sdr/php/espa.php--"]);

        //heartbreak element and children
        $heartbreak = $dom->createElement('heartbreak');

        $timeout= $dom->createElement('field', $request['timeout']);
        $timeoutAttribute = $dom->createAttribute('timeout');
        $timeoutAttribute->value = ('timeout');
        $timeout->appendChild($timeoutAttribute);

        //statusFile element
        $statusFile= $dom->createElement('field',["/storage/espa-sdr/log/heartbeat_status"]);

        //intervalFile element
        $intervalFile= $dom->createElement('field',["/storage/espa-sdr/log/heartbeat_interval"]);

        //logging element and children
        $logging= $dom->createElement('logging');

        $verbosity= $dom->createElement('field', $request['verbosity']);
        $verbosityAttribute = $dom->createAttribute('verbosity');
        $verbosityAttribute->value = ('verbosity');
        $verbosity->appendChild($verbosityAttribute);

        //logFile element
        $logFile= $dom->createElement('field',["/storage/espa-sdr/log/espa-receiver.log"]);

        //communication element and children
        $communication= $dom->createElement('communication');

        $port= $dom->createElement('field', $request['port']);
        $portAttribute = $dom->createAttribute('port');
        $portAttribute->value = ("port default:/dev/ttyS2");
        $port->appendChild($portAttribute);

        $baudRate= $dom->createElement('field', $request['baudRate']);
        $baudRateAttribute = $dom->createAttribute('baudRate');
        $baudRateAttribute->value = ("baudRate default:9600");
        $baudRate->appendChild($baudRateAttribute);

        $dataBits= $dom->createElement('field', $request['dataBits']);
        $dataBitsAttribute = $dom->createAttribute('dataBits');
        $dataBitsAttribute->value = ("dataBits default:8");
        $dataBits->appendChild($dataBitsAttribute);

        $stopBits= $dom->createElement('field', $request['stopBits']);
        $stopBitsAttribute = $dom->createAttribute('stopBits');
        $stopBitsAttribute->value = ("stopBits default:1");
        $stopBits->appendChild($stopBitsAttribute);

        $parity= $dom->createElement('field', $request['parity']);
        $parityAttribute = $dom->createAttribute('parity');
        $parityAttribute->value = ("parity default:none");
        $parity->appendChild($parityAttribute);



        //append child to config element root

        $config->appendChild($general);
        //config id
        $config->appendChild($id);
        $config->appendChild($floodprotection);
        $config->appendChild($email_general);
        $config->appendChild($api);
        $config->appendChild($actions);
        $config->appendChild($action);
        $config->appendChild($recipients);
        $config->appendChild($message);
        $config->appendChild($voicecall);
        $config->appendChild($modify);
        $config->appendChild($espa);
        $config->appendChild($espa_general);
        $config->appendChild($option);
        $config->appendChild($rule);
        $config->appendChild($receiver);
        $config->appendChild($timeframe);
        $config->appendChild($main);
        $config->appendChild($pidFile);
        $config->appendChild($smsCommand);
        $config->appendChild($heartbreak);
        $config->appendChild($statusFile);
        $config->appendChild($intervalFile);
        $config->appendChild($logging);
        $config->appendChild($logFile);
        $config->appendChild($communication);




        //append child to general Element
        $general->appendChild($floodprotection);
        $general->appendChild($email_general);


        //general append child
        $general->appendChild($drymode);
        $general->appendChild($loglevel);

        //flooprotection append child
        $floodprotection->appendChild($silentPeriod);
        $floodprotection->appendChild($silenceRequired);
        $floodprotection->appendChild($expirePeriod);

        //email_general append child
        $email_general->appendChild($fromAddress);
        $email_general->appendChild($bounceAddress);

        //api append children element
        $api->appendChild($primaryUrl);
        $api->appendChild($secondaryUrl);
        $api->appendChild($username);
        $api->appendChild($password);
        $api->appendChild($incomingSmsNumber);

        // actions append children element
        $actions->appendChild($action);


        //action append action children
        $action->appendChild($action_name);
        $action->appendChild($action_type);

        //action append element recipients
        $action->appendChild($recipients);
        $action->appendChild($message);

        //reciption append children
        $recipients->appendChild($number);
        $recipients->appendChild($locationid1);
        $recipients->appendChild($locationid2);
        $recipients->appendChild($contactid1);
        $recipients->appendChild($contactid2);
        $recipients->appendChild($groupid1);
        $recipients->appendChild($groupid2);
        $recipients->appendChild($tag);


        //message append children
        $message->appendChild($priority);
        $message->appendChild($requiredReceipt);
        $message->appendChild($modify);
        $message->appendChild($voicecall);

        // modify append children
        $modify->appendChild($modify_type);

        // modify append children
        $voicecall->appendChild($voiceMessageId);

       //espa append children
        $espa->appendChild($espa_enabled);
        $espa->appendChild($espa_general);
        $espa->appendChild($rule);
        $espa->appendChild($timeframe);
        $espa->appendChild($receiver);
        $espa->appendChild($heartbreak);
        $espa->appendChild($logging);
        $espa->appendChild($communication);


        // espa_general element child
        $espa_general->appendChild($option);

        // option element child
        $option->appendChild($option_name);

        // rule children

        $rule->appendChild($rule_name);
        $rule->appendChild($match);
        $rule->appendChild($timeframe);

        //timeframe children

        $timeframe->appendChild($starttime);
        $timeframe->appendChild($endtime);
        $timeframe->appendChild($daysOfWeek);
        $timeframe->appendChild($actionReference);

        // receiver children
        $receiver->appendChild($main);

        // main children

        $main->appendChild($pidFile);
        $main->appendChild($sleeptime);
        $main->appendChild($smsCommand);

        //heartbreak children
        $heartbreak->appendChild($timeout);
        $heartbreak->appendChild($statusFile);
        $heartbreak->appendChild($intervalFile);

        //logging children
        $logging->appendChild($verbosity);
        $logging->appendChild($logFile);

        //communication children
        $communication->appendChild($port);
        $communication->appendChild($baudRate);
        $communication->appendChild($dataBits);
        $communication->appendChild($parity);



        $dom->save('config.xml');

        return redirect()->to('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // $post = Post::findOrFail($id);

        /**
         *
         * Using DomXML
         *
         */
        $document = new \DomDocument('1.0');
        $document->load('config.xml');

        $xpath = new \DOMXpath($document);

        $name = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="name"]');
        $position = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="position"]');
        $city = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="city"]');
        $email = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="email"]');
        $department = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="department"]');
        $avatar = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="avatar"]');
        $status = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="status"]');

        $row = array('id' => $id, 'name' => $name['domnodelist']->textContent, 'position' => $position['domnodelist']->textContent, 'city' => $city['domnodelist']->textContent,
            'email' => $email['domnodelist']->textContent, 'department' => $department['domnodelist']->textContent, 'avatar' => $avatar['domnodelist']->textContent, 'status' => $status['domnodelist']->textContent);

        // print_r($row);die;

        return view('edit')->with('row', $row);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $document = new \DomDocument('1.0');
        $document->load('config.xml');

        $xpath = new \DOMXpath($document);

        $delete = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="avatar"]');

//        if(input::hasFile('avatar')) {
//            $file = Input::file('avatar');
//            $destinationPath = public_path().'/img';
//            $filename = $file->getClientOriginalname();
//            $fileXML = 'img/'.$filename;
//
//            File::delete($delete['domnodelist']->textContent);
//            $file->move($destinationPath, $filename);
//        } else {
//            $fileXML = null;
//        }

        $requestData = $request->all();

        $name = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="name"]');
        $name['domnodelist']->nodeValue = $request['name'];

        $position = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="position"]');
        $position['domnodelist']->nodeValue = $request['position'];

        $city = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="city"]');
        $city['domnodelist']->nodeValue = $request['city'];

        $email = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="email"]');
        $email['domnodelist']->nodeValue = $request['email'];

        $department = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="department"]');
        $department['domnodelist']->nodeValue = $request['department'];

//        $avatar = $xpath->query('./row[field[@name="id"] ='.$id.']/field[@name="avatar"]');
//        $avatar['domnodelist']->nodeValue = $fileXML;

        $status = $xpath->query('./row[field[@name="id"] =' . $id . ']/field[@name="status"]');
        $status['domnodelist']->nodeValue = $request['status'];

        $document->save('data.xml');

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**
         *
         * Using DomXML
         *
         */
        $document = new \DomDocument('1.0');
        $document->load('config.xml');

        $xpath = new \DOMXpath($document);

        // Use XPath to locate our node(s)
        $nodelist = $xpath->query('.//field[@name="id"][.=' . $id . ']/..');

//        $avatar = $xpath->query('./row[field[@name="id"] ='.$id.']/field[@name="avatar"]');

        // Iterate over our node list and remove the data
        foreach ($nodelist as $dataNode) {
            if ($dataNode->parentNode === null) {
                continue;
            }

            // Get the data node parent (file) so we can call remove child
            $dataNode->parentNode->removeChild($dataNode);
        }

        $document->save('config.xml');

        /**
         *
         * Using SimpleXML
         *
         */
        // $xml = new \SimpleXMLElement(file_get_contents('data.xml'));
        // $data = $xml->xpath('//field[@name="id"][.=' . $id . ']/..');

        // if (isset($data[0])) {
        //     unset($data[0]->{0});
        // }

        // $xml->asXML('data.xml');


//        File::delete($avatar['domnodelist']->textContent);

        return redirect()->to('/');
    }
}
