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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dom = new \DOMDocument();

        //load the xml file
        $dom->load('config.xml');

        //load the element tag name
        $datas = $dom->getElementsByTagName('config');

        return view('espasdr.data',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('espasdr.add');
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


        $config = $this->load();

//        $lastArray = ($config);
//        $lastId = $lastArray['id'];


        //set the root element config
        $config = $dom->getElementsByTagName('config')->item(0);


//        // set the id in config
//        $id = $dom->createElement('id', $lastId + 1);
//        $idAttribute = $dom->createAttribute('name');
//        $idAttribute->value = 'id';
//        $id->appendChild($idAttribute);

        //general Element and children
        $general = $dom->createElement('general');

        $drymode = $dom->createElement('drymode', $request['drymode']);
        $drymodeAttribute = $dom->createAttribute('drymode');
        $drymodeAttribute->value = ("True|False");
        $drymode->appendChild($drymodeAttribute);

        $loglevel = $dom->createElement('loglevel', $request['loglevel']);
        $loglevelAttribute = $dom->createAttribute('loglevel');
        $loglevelAttribute->value = ("ERROR|WARNING|NOTICE|INFO|DEBUG");
        $loglevel->appendChild($loglevelAttribute);

        //floodprotection Element and children
        $floodprotection = $dom->createElement('floodprotection');

        $silentPeriod = $dom->createElement('silentPeriod', $request['silentPeriod']);
//        $silentPeriodAttribute = $dom->createAttribute('silentPeriod');
//        $silentPeriodAttribute->value = ('silentPeriode');
//        $silentPeriod->appendChild($silentPeriodAttribute);

        $silenceRequired = $dom->createElement('silenceRequired', $request['silenceRequired']);
//        $silenceRequiredAttribute = $dom->createAttribute('silenceRequired');
//        $silenceRequiredAttribute->value = ('silenceRequired');
//        $silenceRequired->appendChild($silenceRequiredAttribute);

        $expirePeriod = $dom->createElement('expirePeriod', $request['expirePeriod']);
//        $expirePeriodAttribute = $dom->createAttribute('expirePeriod');
//        $expirePeriodAttribute->value = ('expirePeriod');
//        $expirePeriod->appendChild($expirePeriodAttribute);


        //general_email Element and children
        $email_general = $dom->createElement('email');

        $fromAddress = $dom->createElement('fromAddress');
        $fromAddressAttribute = $dom->createAttribute('fromAddress');
        $fromAddressAttribute->value = ("from@picasse.com");
        $fromAddress->appendChild($fromAddressAttribute);

        $bounceAddress = $dom->createElement('bounceAddress');
        $bounceAddressAttribute = $dom->createAttribute('bounceAddress');
        $bounceAddressAttribute->value = ("bounce@picasse.com");
        $bounceAddress->appendChild($bounceAddressAttribute);


        //api Element and data
        $api = $dom->createElement('api');

        $primaryUrl = $dom->createElement('primaryUrl');
        $primaryUrlAttribute = $dom->createAttribute('primaryUrl');
        $primaryUrlAttribute->value = ("http://vpn1.smsalarmering.nl/api/v2/jsonrpc/");
        $primaryUrl->appendChild($primaryUrlAttribute);

        $secondaryUrl = $dom->createElement('secondaryUrl');
        $secondaryUrlAttribute = $dom->createAttribute('secondaryUrl');
        $secondaryUrlAttribute->value = ("http://new.smsalarmering.nl/api/v2/jsonrpc/");
        $secondaryUrl->appendChild($secondaryUrlAttribute);

        $username = $dom->createElement('username', $request['username']);
//        $usernameAttribute = $dom->createAttribute('username');
//        $usernameAttribute->value = 'username';
//        $username->appendChild($usernameAttribute);

        $password = $dom->createElement('password', $request['password']);
//        $passwordAttribute = $dom->createAttribute('password');
//        $passwordAttribute->value = 'password';
//        $password->appendChild($passwordAttribute);

        $incomingSmsNumber = $dom->createElement('incomingSmsNumber');
        $incomingSmsNumberAttribute = $dom->createAttribute('incomingSmsNumber');
        $incomingSmsNumberAttribute->value = ("+31642500091");
        $incomingSmsNumber->appendChild($incomingSmsNumberAttribute);

        //actions element
        $actions = $dom->createElement('actions');

        // action element and children
        $action = $dom->createElement('action');

        $action_type = $dom->createElement('type', $request['action_type']);


        $action_name = $dom->createElement('name', $request['action_name']);


        //recipients element and children
        $recipients = $dom->createElement('recipients');

        $number = $dom->createElement('number');
        $numberAttribute = $dom->createAttribute('number');
        $numberAttribute->value = ("+3592342342");
        $number->appendChild($numberAttribute);

        $locationid1 = $dom->createElement('locationid', $request['location_id1']);
        $locationid1Attribute = $dom->createAttribute('locationid');
        $locationid1Attribute->value = 'location id';
        $locationid1->appendChild($locationid1Attribute);

        // uitproberen voor als het leeg is

        if (!empty($locationid2 = $dom->createElement('locationid', $request['location_id2']))) ;
        $locationid2Attribute = $dom->createAttribute('locationid');
        $locationid2Attribute->value = 'location id';
        $locationid2->appendChild($locationid2Attribute);

        $contactid1 = $dom->createElement('contactid', $request['contact_id1']);
        $contactid1Attribute = $dom->createAttribute('contactid');
        $contactid1Attribute->value = 'contact id';
        $contactid1->appendChild($contactid1Attribute);

        $contactid2 = $dom->createElement('contactid', $request['contact_id2']);
        $contactid2Attribute = $dom->createAttribute('contactid');
        $contactid2Attribute->value = 'contact id';
        $contactid2->appendChild($contactid2Attribute);

        $groupid1 = $dom->createElement('groupid', $request['group_id1']);
        $groupid1Attribute = $dom->createAttribute('groupid');
        $groupid1Attribute->value = 'group id';
        $groupid1->appendChild($groupid1Attribute);

        $groupid2 = $dom->createElement('groupid', $request['group_id2']);
        $groupid2Attribute = $dom->createAttribute('groupid');
        $groupid2Attribute->value = 'group id';
        $groupid2->appendChild($groupid2Attribute);

        $tag = $dom->createElement('tag', $request['tag']);
        $tagAttribute = $dom->createAttribute('tag');
        $tagAttribute->value = 'tag';
        $tag->appendChild($tagAttribute);

        //message element and children
        $message = $dom->createElement('message');

        $priority = $dom->createElement('priority', $request['priority']);
//        $priorityAttribute = $dom->createAttribute('priority');
//        $priorityAttribute->value = 'priority';
//        $priority ->appendChild($priorityAttribute);

        $requiredReceipt = $dom->createElement('requiredReceipt', $request['requiredReceipt']);
//        $requiredReceiptAttribute = $dom->createAttribute('requiredReceipt');
//        $requiredReceiptAttribute->value = 'requiredReceipt';
//        $requiredReceipt ->appendChild($requiredReceiptAttribute);

        $modify = $dom->createElement('modify', $request['modify']);
//        $modifyAttribute = $dom->createAttribute('modify');
//        $modifyAttribute->value = 'modify';
//        $modify ->appendChild($modifyAttribute);

        //voicecall element and children
        $voicecall = $dom->createElement('voicecall');

        $voiceMessageId = $dom->createElement('voiceMessageId', $request['voiceMessageId']);
//        $voiceMessageIdAttribute = $dom->createAttribute('voiceMessageId');
//        $voiceMessageIdAttribute->value = 'voiceMessage id';
//        $voiceMessageId->appendChild($voiceMessageIdAttribute);

        $useTts = $dom->createElement('useTts', $request['useTts']);
//        $useTtsAttribute = $dom->createAttribute('useTts');
//        $useTtsAttribute->value = 'useTts';
//        $useTts ->appendChild($useTtsAttribute);

        //modify element and children
        $modify = $dom->createElement('modify');

        $modify_type = $dom->createElement('modify', $request['modify_type']);
//        $modify_typeAttribute = $dom->createAttribute('modify_type');
//        $modify_typeAttribute->value = 'modifytype';
//        $modify_type ->appendChild($modify_typeAttribute);

        //Espa element and children
        $espa = $dom->createElement('espa');

        $espa_enabled = $dom->createElement('enabled', $request['espa_enabled']);
//        $espa_enabledAttribute = $dom->createAttribute('enabled');
//        $espa_enabledAttribute->value = 'enabled';
//        $espa_enabled ->appendChild($espa_enabledAttribute);


        //Espa_general element and children
        $espa_general = $dom->createElement('general');

        $espa_general_floodprotection = $dom->createElement('general', $request['espa_general_floodprotection']);
//        $espa_general_floodprotectionAttribute = $dom->createAttribute('floodprotection');
//        $espa_general_floodprotectionAttribute->value = 'floodprotection';
//        $espa_general_floodprotection->appendChild($espa_general_floodprotectionAttribute);

        //option element and children
        $option = $dom->createElement('option');

        $option_name = $dom->createElement('option', $request['option_name']);
        $option_nameAttribute = $dom->createAttribute('name');
        $option_nameAttribute->value = 'name';
        $option_name->appendChild($option_nameAttribute);

        //rule element and children
        $rule = $dom->createElement('rule');

        $rule_name = $dom->createElement('name', $request['rule_name']);


        $match = $dom->createElement('match', $request['match']);
        $matchAttribute = $dom->createAttribute('what');
        $matchAttribute->value = ('pager');
        $match->appendChild($matchAttribute);

        //timeframe element and children
        $timeframe = $dom->createElement('timeframe');

        $starttime = $dom->createElement('startTime', $request['starttime']);
//        $starttimeAttribute = $dom->createAttribute('starttime');
//        $starttimeAttribute->value = ('starttime');
//        $starttime->appendChild($starttimeAttribute);

        $endtime = $dom->createElement('endTime', $request['endtime']);
//        $endtimeAttribute = $dom->createAttribute('endtime');
//        $endtimeAttribute->value = ('endtime');
//        $endtime->appendChild($endtimeAttribute);

        $daysOfWeek = $dom->createElement('daysOfWeek', $request['daysOfWeek']);
//        $daysOfWeekAttribute = $dom->createAttribute('daysOfWeek');
//        $daysOfWeekAttribute->value = ('daysOfWeek');
//        $daysOfWeek->appendChild($daysOfWeekAttribute);

        $actionReference = $dom->createElement('actionReference', $request['actionReference']);
//        $actionReferenceAttribute = $dom->createAttribute('actionReference');
//        $actionReferenceAttribute->value = ('actionReference');
//        $actionReference->appendChild($actionReferenceAttribute);

        // wellicht hier rule 2? tweede rule actie.


        //receiver element and children
        $receiver = $dom->createElement('receiver');
        $receiverAttribute = $dom->createAttribute('file');
        $receiverAttribute->value = ("file=/storage/espa-sdr/etc/espa-receiver.ini");
        $receiver->appendChild($receiverAttribute);

        //main element and children
        $main = $dom->createElement('main');

        //pidfile element
        $pidFile = $dom->createElement('pidFile', "/storage/espa-sdr/var/espa-receiver.pid");

        $sleeptime = $dom->createElement('sleepTime', $request['sleeptime']);
//        $sleeptimeAttribute = $dom->createAttribute('sleeptime');
//        $sleeptimeAttribute->value = ('sleeptime');
//        $sleeptime->appendChild($sleeptimeAttribute);

        //smsCommand element
        $smsCommand = $dom->createElement('smscommand', "/storage/bin/php -f /storage/espa-sdr/php/espa.php--");

        //heartbreak element and children
        $heartbreak = $dom->createElement('heartbreak');

        $timeout = $dom->createElement('timeout', $request['timeout']);
//        $timeoutAttribute = $dom->createAttribute('timeout');
//        $timeoutAttribute->value = ('timeout');
//        $timeout->appendChild($timeoutAttribute);

        //statusFile element
        $statusFile = $dom->createElement('statusfile', "/storage/espa-sdr/log/heartbeat_status");

        //intervalFile element
        $intervalFile = $dom->createElement('intervalfile', "/storage/espa-sdr/log/heartbeat_interval");

        //logging element and children
        $logging = $dom->createElement('logging');

        $verbosity = $dom->createElement('verbosity', $request['verbosity']);
//        $verbosityAttribute = $dom->createAttribute('verbosity');
//        $verbosityAttribute->value = ('verbosity');
//        $verbosity->appendChild($verbosityAttribute);

        //logFile element
        $logFile = $dom->createElement('logfile', "/storage/espa-sdr/log/espa-receiver.log");

        //communication element and children
        $communication = $dom->createElement('communication');

        $port = $dom->createElement('port', $request['port']);
        $portAttribute = $dom->createAttribute('port');
        $portAttribute->value = ("port default:/dev/ttyS2");
        $port->appendChild($portAttribute);

        $baudRate = $dom->createElement('baudRate', $request['baudRate']);
        $baudRateAttribute = $dom->createAttribute('baudRate');
        $baudRateAttribute->value = ("baudRate default:9600");
        $baudRate->appendChild($baudRateAttribute);

        $dataBits = $dom->createElement('dataBits', $request['dataBits']);
        $dataBitsAttribute = $dom->createAttribute('dataBits');
        $dataBitsAttribute->value = ("dataBits default:8");
        $dataBits->appendChild($dataBitsAttribute);

        $stopBits = $dom->createElement('stopBits', $request['stopBits']);
        $stopBitsAttribute = $dom->createAttribute('stopBits');
        $stopBitsAttribute->value = ("stopBits default:1");
        $stopBits->appendChild($stopBitsAttribute);

        $parity = $dom->createElement('parity', $request['parity']);
        $parityAttribute = $dom->createAttribute('parity');
        $parityAttribute->value = ("parity default:none");
        $parity->appendChild($parityAttribute);

        //Sdr element and children
        $sdr = $dom->createElement('sdr');

        $sdr_enabled = $dom->createElement('enabled', $request['sdr_enabled']);
//        $sdr_enabledAttribute = $dom->createAttribute('enabled');
//        $sdr_enabledAttribute->value = 'enabled';
//        $sdr_enabled ->appendChild($sdr_enabledAttribute);


        //sdr_general element and children
        $sdr_general = $dom->createElement('general');


        $sdr_option1 = $dom->createElement('option', $request['sdr_option_name1']);
        $sdr_option1Attribute = $dom->createAttribute('name');
        $sdr_option1Attribute->value = 'version';
        $sdr_option1->appendChild($sdr_option1Attribute);

        $sdr_option2 = $dom->createElement('option', $request['sdr_option_name2']);
        $sdr_option2Attribute = $dom->createAttribute('name');
        $sdr_option2Attribute->value = 'normalPinState';
        $sdr_option2->appendChild($sdr_option2Attribute);

        $sdr_option3 = $dom->createElement('option', $request['sdr_option_name3']);
        $sdr_option3Attribute = $dom->createAttribute('name');
        $sdr_option3Attribute->value = 'alertTimeout';
        $sdr_option3->appendChild($sdr_option3Attribute);

        $sdr_option4 = $dom->createElement('option', $request['sdr_option_name4']);
        $sdr_option4Attribute = $dom->createAttribute('name');
        $sdr_option4Attribute->value = 'alertRepeatTimeout';
        $sdr_option4->appendChild($sdr_option4Attribute);

        $sdr_option5 = $dom->createElement('option', $request['sdr_option_name5']);
        $sdr_option5Attribute = $dom->createAttribute('name');
        $sdr_option5Attribute->value = 'activationTimeout';
        $sdr_option5->appendChild($sdr_option5Attribute);

        $sdr_option6 = $dom->createElement('option', $request['sdr_option_name6']);
        $sdr_option6Attribute = $dom->createAttribute('name');
        $sdr_option6Attribute->value = 'fakeMode';
        $sdr_option6->appendChild($sdr_option6Attribute);


        //pin element and children
        $pin = $dom->createElement('pin');

        $pinnumber = $dom->createElement('number', $request['pinnumber']);

        // meerdere pinnumbers mogelijk

        $txt = $dom->createElement('txt', $request['txt']);


        // SDR timeframe element and children
        $sdr_timeframe = $dom->createElement('timeframe');

        $sdr_starttime = $dom->createElement('startTime', $request['sdr_starttime']);
//        $sdr_starttimeAttribute = $dom->createAttribute('starttime');
//        $sdr_starttimeAttribute->value = ('starttime');
//        $sdr_starttime->appendChild($sdr_starttimeAttribute);

        $sdr_endtime = $dom->createElement('endTime', $request['sdr_endtime']);
//        $sdr_endtimeAttribute = $dom->createAttribute('endtime');
//        $sdr_endtimeAttribute->value = ('endtime');
//        $sdr_endtime->appendChild($sdr_endtimeAttribute);

        $sdr_daysOfWeek = $dom->createElement('daysOfWeek', $request['sdr_daysOfWeek']);
//        $sdr_daysOfWeekAttribute = $dom->createAttribute('daysOfWeek');
//        $sdr_daysOfWeekAttribute->value = ('daysOfWeek');
//        $sdr_daysOfWeek->appendChild($sdr_daysOfWeekAttribute);

        $sdr_actionReference = $dom->createElement('actionReference', $request['sdr_actionReference']);
//        $sdr_actionReferenceAttribute = $dom->createAttribute('actionReference');
//        $sdr_actionReferenceAttribute->value = ('actionReference');
//        $sdr_actionReference->appendChild($sdr_actionReferenceAttribute);

        // SDR kan meerdere timeframes hebben in een pin
        // pin kan meerdere pin hebben

        // modem element and children
        $modem = $dom->createElement('modem');
        $modemAttribute = $dom->createAttribute('file');
        $modemAttribute->value = ("/storage/espa-sdr/etc/.gammurc");
        $modem->appendChild($modemAttribute);

        $sdr_port = $dom->createElement('port', $request['sdr_port']);


        //append child to config element root

        $config->appendChild($general);
//        //config id
//        $config->appendChild($id);
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
        $config->appendChild($sdr);
        $config->appendChild($sdr_general);
        $config->appendChild($pin);
        $config->appendChild($pinnumber);
        $config->appendChild($txt);
        $config->appendChild($sdr_timeframe);
        $config->appendChild($modem);
        $config->appendChild($sdr_port);


        //append child to general Element
        $general->appendChild($drymode);
        $general->appendChild($loglevel);
        $general->appendChild($floodprotection);
        $general->appendChild($email_general);


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

        // voicecall append children
        $voicecall->appendChild($voiceMessageId);
        $voicecall->appendChild($useTts);

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
        $receiver->appendChild($heartbreak);
        $receiver->appendChild($logging);
        $receiver->appendChild($communication);

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

        //Sdr children
        $sdr->appendChild($sdr_enabled);
        $sdr->appendChild($sdr_general);
        $sdr->appendChild($pin);

        // sdr_general append children

        $sdr_general->appendChild($sdr_option1);
        $sdr_general->appendChild($sdr_option2);
        $sdr_general->appendChild($sdr_option3);
        $sdr_general->appendChild($sdr_option4);
        $sdr_general->appendChild($sdr_option5);
        $sdr_general->appendChild($sdr_option6);

        // pin append children
        $pin->appendChild($pinnumber);
        $pin->appendChild($txt);
        $pin->appendChild($sdr_timeframe);

        // sdr_timeframe append children
        $sdr_timeframe->appendChild($sdr_starttime);
        $sdr_timeframe->appendChild($sdr_endtime);
        $sdr_timeframe->appendChild($sdr_daysOfWeek);
        $sdr_timeframe->appendChild($sdr_actionReference);

        //modem element children
        $modem->appendChild($sdr_port);

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
