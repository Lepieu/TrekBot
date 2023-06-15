<?php
    try {
        require_once($_SERVER['DOCUMENT_ROOT'].'/lib/Classes/Python.php');
    } catch (Throwable $e) {
        $data['errors'][] = $e->getMessage();
    }    

    try {
        $py = new Python('hello');
    } catch (Throwable $e) {
        $data['errors'][] = $e->getMessage();
    }

    $data['prompt'] = $_POST['SpeechRecognitionResult'];
    //$data['length'] = strlen($data['prompt']);
    $data['encrypted'] = base64_encode($data['prompt']);
    
    try {
        $py_result = $py->run([$data['encrypted']]);     
        $data['response'] = $py_result['output'];
    } catch (Throwable $e) {
        $data['errors'][] = $e->getMessage();
    }


    
    echo json_encode($data);
    

?>