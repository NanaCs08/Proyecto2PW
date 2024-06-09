<?php
require_once ('models/LogInModel.php');

class LogInController extends Controller
{
    public function login()
    {
        $email = Input::get('email');
        $password = Input::get('password');
        $loginModel = new LogInModel();
        $user = $loginModel->findUserByEmail($email);

        if ($user && $password === $user['password']) {
            Auth::login($user, $password);
            $_SESSION['user'] = $user;
            echo json_encode(['success' => true, 'message' => 'Login successful', 'user' => $user]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer los datos JSON del cuerpo de la solicitud
            $data = json_decode(file_get_contents('php://input'), true);

            $email = $data['email'] ?? null;
            $password = $data['password'] ?? null;
            $name = $data['name'] ?? null;
            $Teams_idTeam = $data['Teams_idTeam'] ?? 1;
            $apellido1 = $data['apellido1'] ?? null;
            $apellido2 = $data['apellido2'] ?? null;

            // Instanciar el modelo y llamar al método de registro
            $model = new LogInModel();
            $result = $model->registerUser($email, $password, $name, $Teams_idTeam, $apellido1, $apellido2);

            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Usuario registrado correctamente']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al registrar el usuario. Por favor, intente de nuevo.']);
            }
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        }
    }

}
?>