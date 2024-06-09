<?php
require_once ('models/ChatModel.php');
class ChatController extends Controller
{
    public function saveMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Método no permitido
            return json_encode(['error' => 'Method not allowed']);
        }

        // Obtener los datos enviados en formato JSON
        $input = json_decode(file_get_contents('php://input'), true);

        // Validar los datos recibidos
        if (!isset($input['message']) || !isset($input['user_id'])) {
            http_response_code(400); // Solicitud incorrecta
            return json_encode(['error' => 'Message and user_id are required']);
        }
    
        $data = $input['message'];
        $Users_idUser = $input['user_id'];
        $date = date('Y-m-d H:i:s'); // Fecha y hora actual
        $Teams_idTeam = 1; // Valor fijo

        $chatModel = new ChatModel();
        $result = $chatModel->saveMessage($data, $date, $Teams_idTeam, $Users_idUser);

        if ($result) {
            return json_encode(['success' => true]);
        } else {
            http_response_code(500); // Error interno del servidor
            return json_encode(['error' => 'Failed to save message']);
        }
    }

    public function fetchMessages()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405); // Método no permitido
            return json_encode(['error' => 'Method not allowed']);
        }

        $Teams_idTeam = 1; // Valor fijo

        $chatModel = new ChatModel();
        $messages = $chatModel->getMessages($Teams_idTeam);

        return json_encode($messages);
    }
}