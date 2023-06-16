<?php
    try {
        require_once($_SERVER['DOCUMENT_ROOT'].'/lib/Classes/Python.php');
    } catch (Throwable $e) {
        $data['errors'][] = $e->getMessage();
    }    

    try {
        $py = new Python('challenge');
    } catch (Throwable $e) {
        $data['errors'][] = $e->getMessage();
    }

    $data['prompt'] = $_POST['SpeechRecognitionResult'];
    //$data['length'] = strlen($data['prompt']);
    $data['encoded'] = base64_encode($data['prompt']);
    
    $api_flag = (!isset($_POST['api_flag']) ? 1 : $_POST['api_flag']);
    $tts_flag = (!isset($_POST['tts_flag']) ? 0 : $_POST['tts_flag']);
// these check to see if the api and tts flags have been sent from the front end. If they haven't been sent from the front end it sets them to their defaults (true for $api_flag and false for $tts_flag), otherwise it sets them to whatever was sent from the front end (NOTE: you may need to deal with string/integer conversion in that case, depending on how the data is sent from the front end)


    $data['api_flag'] = $api_flag;
    $data['tts_flag'] = $tts_flag;
//Including these in the return array allows you to make sure they were correctly sent to python. It also provides a convenient way to handle the response in the JS without having to rely on global state variables. You just have the JS react accordingly to what's included in the above two entries in the $data array.

    try {
        $py_result = $py->run([$data['encoded'], $api_flag, $tts_flag]);
    // you may end up wanting to change the order here, if so, just remember to adjust the references to sys.argv[i] in python accordingly    
    
        $data['response'] = $py_result['output'];
    } catch (Throwable $e) {
        $data['errors'][] = $e->getMessage();
    }
    
    echo json_encode($data);
    

?>