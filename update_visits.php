<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$visitsFile = 'visits.json';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Read current visits
    if (file_exists($visitsFile)) {
        $data = json_decode(file_get_contents($visitsFile), true);
        echo json_encode($data);
    } else {
        echo json_encode(['totalVisits' => 0, 'lastUpdated' => '']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update visits
    if (file_exists($visitsFile)) {
        $data = json_decode(file_get_contents($visitsFile), true);
        $data['totalVisits']++;
        $data['lastUpdated'] = date('Y-m-d H:i:s');
        file_put_contents($visitsFile, json_encode($data, JSON_PRETTY_PRINT));
        echo json_encode($data);
    } else {
        $data = [
            'totalVisits' => 1,
            'lastUpdated' => date('Y-m-d H:i:s')
        ];
        file_put_contents($visitsFile, json_encode($data, JSON_PRETTY_PRINT));
        echo json_encode($data);
    }
}
?> 