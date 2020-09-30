@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br>
                <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">Create New Data</div>
                    <div class="panel-body a1">
                        <form action="{{ url('editor/store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="accordion" id="accordionExample">

                                <!-- General -->
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                    data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                <h3>General</h3>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                         data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="drymode">drymode</label>
                                                <select class="form-control" name="drymode">
                                                    <option value="true">true</option>
                                                    <option value="false">false</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="loglevel">Loglevel</label>
                                                <select class="form-control" name="loglevel">
                                                    <option value="ERROR">ERROR</option>
                                                    <option value="NOTICE">NOTICE</option>
                                                    <option value="INFO">INFO</option>
                                                    <option value="DEBUG">DEBUG</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="silentPeriod">SilentPeriod</label>
                                                <input type="text" class="form-control" name="silentPeriod">
                                            </div>

                                            <div class="form-group">
                                                <label for="silenceRequired">SilenceRequired</label>
                                                <select class="form-control" name="silenceRequired">
                                                    <option value="true">true</option>
                                                    <option value="false">false</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="expirePeriod">ExpirePeriod</label>
                                                <input type="text" class="form-control" name="expirePeriod">
                                            </div>

                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" name="username">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="text" class="form-control" name="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /General -->

                                <!-- Actions -->
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <h3>Actions</h3>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="action_type">Action type</label>
                                                <select class="form-control" name="action_type">
                                                    <option value="message">message</option>
                                                    <option value="email">email</option>
                                                    <option value="conference">conference</option>
                                                    <option value="alert">alert</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="action_name">Action name</label>
                                                <input type="text" class="form-control" name="action_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="location_id1">Location id</label>
                                                <input type="text" class="form-control" name="location_id1">
                                            </div>
                                            <div class="form-group">
                                                <label for="location_id2">Location id</label>
                                                <input type="text" class="form-control" name="location_id2">
                                            </div>
                                            <div class="form-group">
                                                <label for="contact_id1">Contact id</label>
                                                <input type="text" class="form-control" name="contact_id1">
                                            </div>
                                            <div class="form-group">
                                                <label for="contact_id2">Contact id</label>
                                                <input type="text" class="form-control" name="contact_id2">
                                            </div>
                                            <div class="form-group">
                                                <label for="group_id1">Group id</label>
                                                <input type="text" class="form-control" name="group_id1">
                                            </div>
                                            <div class="form-group">
                                                <label for="group_id2">Group id</label>
                                                <input type="text" class="form-control" name="group_id2">
                                            </div>
                                            <div class="form-group">
                                                <label for="tag">Tag</label>
                                                <input type="text" class="form-control" name="tag">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Actions -->

                                <!-- Message -->
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <h3>Message</h3>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="priority">Priority</label>
                                                <select class="form-control" name="priority">
                                                    <option value="NOT CLASSIFIED">NOT CLASSIFIED (0)</option>
                                                    <option value="INFORMATION">INFORMATION (1)</option>
                                                    <option value="WARNING">WARNING (2)</option>
                                                    <option value="AVERAGE">AVERAGE (3)</option>
                                                    <option value="HIGH">HIGH (4)</option>
                                                    <option value="DISASTER">DISASTER (5)</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="requiredReceipt">Required receipt</label>
                                                <select class="form-control" name="requiredReceipt">
                                                    <option value="NOT CLASSIFIED">NONE</option>
                                                    <option value="INFORMATION">DELIVERY</option>
                                                    <option value="WARNING">READ</option>
                                                    <option value="AVERAGE">ACCEPTANCE</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="modify">Modify</label>
                                                <input type="text" class="form-control" name="modify">
                                            </div>
                                            <div class="form-group">
                                                <label for="modify_type">Modify Type</label>
                                                <input type="text" class="form-control" name="modify_type">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Message -->

                                <!-- Voicacall -->
                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                <h2>Voicecall</h2>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="voiceMessageId">Voicemessage Id</label>
                                                <input type="text" class="form-control" name="voiceMessageId">
                                            </div>
                                            <div class="form-group">
                                                <label for="useTts">UseTts</label>
                                                <select class="form-control" name="useTts">
                                                    <option value="true">true</option>
                                                    <option value="false">false</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Voicecall -->

                                <!-- ESPA -->
                                <div class="card">
                                    <div class="card-header" id="headingFive">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                <h3>ESPA</h3>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="espa_enabled">Enabled</label>
                                                <h6>0 is off, 1 is on</h6>
                                                <select class="form-control" name="espa_enabled">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </div>


                                        <!-- ESPA Options -->
                                        <h3>Options</h3>
                                        <div class="form-group">
                                            <label for="espa_general_floodprotection">Floodprotection</label>
                                            <input type="text" class="form-control" name="espa_general_floodprotection">
                                        </div>
                                        <div class="form-group">
                                            <label for="option_name">option name</label>
                                            <input type="text" class="form-control" name="option_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="rule_name">Rule name</label>
                                            <input type="text" class="form-control" name="rule_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="match">Match</label>
                                            <input type="text" class="form-control" name="match">
                                        </div>
                                        <div class="form-group">
                                            <label for="starttime">Start time</label>
                                            <input type="text" class="form-control" name="starttime">
                                        </div>
                                        <div class="form-group">
                                            <label for="endtime">End time</label>
                                            <input type="text" class="form-control" name="endtime">
                                        </div>
                                        <div class="form-group">
                                            <label for="daysOfWeek">Days Of Week</label>
                                            <input type="text" class="form-control" name="daysOfWeek">
                                        </div>
                                        <div class="form-group">
                                            <label for="actionReference">Action reference</label>
                                            <input type="text" class="form-control" name="actionReference">
                                        </div>
                                        <div class="form-group">
                                            <label for="sleeptime">Sleeptime</label>
                                            <input type="text" class="form-control" name="sleeptime">
                                        </div>
                                        <div class="form-group">
                                            <label for="timeout">Timeout</label>
                                            <h6>default 30</h6>
                                            <input type="text" class="form-control" name="timeout">
                                        </div>
                                        <div class="form-group">
                                            <label for="verbosity">Verbosity</label>
                                            <h6>Default: 1</h6>
                                            <select class="form-control" name="verbosity">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">2</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="port">Port</label>
                                            <h6>Default: /dev/ttyS2</h6>
                                            <input type="text" class="form-control" name="port">
                                        </div>
                                        <div class="form-group">
                                            <label for="baudRate">BaudRate</label>
                                            <h6>Default: 9600</h6>
                                            <select class="form-control" name="baudRate">
                                                <option value="300">300</option>
                                                <option value="600">600</option>
                                                <option value="1200">1200</option>
                                                <option value="2400">2400</option>
                                                <option value="9600">9600</option>
                                                <option value="14400">14400</option>
                                                <option value="19200">19200</option>
                                                <option value="38400">38400</option>
                                                <option value="57600">57600</option>
                                                <option value="115200">115200"</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dataBits">DataBits</label>
                                            <h6>Default: 8</h6>
                                            <select class="form-control" name="dataBits">
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="stopBits">StopBits</label>
                                            <h6>Default: 1</h6>
                                            <select class="form-control" name="stopBits">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="parity">Parity</label>
                                            <h6>Default: none</h6>
                                            <select class="form-control" name="parity">
                                                <option value="none">none</option>
                                                <option value="even">even</option>
                                                <option value="odd">odd</option>
                                            </select>
                                        </div>
                                            <!-- /Options -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /ESPA -->

                                <!-- /SDR -->
                                <div class="card">
                                    <div class="card-header" id="headingSix">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                <h3>SDR</h3>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="sdr_enabled">Enabled</label>
                                                <h6>0 is off, 1 is on</h6>
                                                <select class="form-control" name="sdr_enabled">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </div>

                                            <!-- SDR Options -->
                                            <h3>Options</h3>
                                            <div class="form-group">
                                                <label for="sdr_option_name1">Version</label>
                                                <h6>default sdr64</h6>
                                                <input type="text" class="form-control" name="sdr_option_name1">
                                            </div>
                                            <div class="form-group">
                                                <label for="sdr_option_name2">NormalPinState</label>
                                                <h6>default closed</h6>
                                                <input type="text" class="form-control" name="sdr_option_name2">
                                            </div>
                                            <div class="form-group">
                                                <label for="sdr_option_name3">AlertTimeout</label>
                                                <input type="text" class="form-control" name="sdr_option_name3">
                                            </div>
                                            <div class="form-group">
                                                <label for="sdr_option_name4">AlertRepeatTimeout</label>
                                                <input type="text" class="form-control" name="sdr_option_name4">
                                            </div>
                                            <div class="form-group">
                                                <label for="sdr_option_name5">ActivationTimeout</label>
                                                <input type="text" class="form-control" name="sdr_option_name5">
                                            </div>
                                            <div class="form-group">
                                                <label for="sdr_option_name6">fakeMode</label>
                                                <input type="text" class="form-control" name="sdr_option_name6">
                                            </div>

                                            <div class="form-group">
                                                <label for="pinnumber">Pin</label>
                                                <input type="text" class="form-control" name="pinnumber">
                                            </div>
                                            <div class="form-group">
                                                <label for="txt">Pin</label>
                                                <input type="text" class="form-control" name="txt">
                                            </div>
                                            <div class="form-group">
                                                <label for="sdr_starttime">Start time</label>
                                                <input type="text" class="form-control" name="sdr_starttime">
                                            </div>
                                            <div class="form-group">
                                                <label for="sdr_endtime">End time</label>
                                                <input type="text" class="form-control" name="sdr_endtime">
                                            </div>
                                            <div class="form-group">
                                                <label for="sdr_daysOfWeek">Days Of Week</label>
                                                <input type="text" class="form-control" name="sdr_daysOfWeek">
                                            </div>
                                            <div class="form-group">
                                                <label for="sdr_actionReference">Action Reference</label>
                                                <input type="text" class="form-control" name="sdr_actionReference">
                                            </div>

                                            <div class="form-group">
                                                <label for="sdr_port">Port</label>
                                                <input type="text" class="form-control" name="sdr_port">
                                            </div>
                                            <!-- /SDR Options -->

                                        </div>
                                    </div><button type="submit" class="btn btn-default">Submit</button>
                                </div>




                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
