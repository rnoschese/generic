<?php

namespace App\Controllers;

use App\Models\LoginAttemptsModel;
use App\Models\MemberModel;

class Auth extends BaseController
{
    public function index()
    {
        echo view('auth/login');
    }

    private function redirect_login($var)
    {
        $destination =  '/dashboard';

        if($var === 'dealer'){
            $destination =  '/dashboard-dealer';
        }

        return $destination;
    }

    public function change_password() {
        echo view('auth/changepassword');
    }

    public function conferma_account() {
        echo view('mail_template/conferma_account');
    }

    public function register() {
        echo view('auth/register');
    }

    public function reset_password() {
        echo view('auth/reset_password');
    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    private function sec_session_start() {
        $session_name = 'sec_session_id'; // Imposta un nome di sessione
        $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
        $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
        ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
        $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
        session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
        session_start(); // Avvia la sessione php.
        session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
    }

    public function login() {
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('p');

        $model = new MemberModel();
        $row = $model->getUser($email);

        $destination = '/login';
        if (is_array($row)) {
            if ($this->checkbrute($row['id']) == true) {
                $session->setFlashdata('msg', 'Sono stati effettuati troppi tentativi di accesso. Controlla la tua casella di posta elettronica per riattivare il tuo account.');
            } elseif($row['attivo'] == 0){
                $session->setFlashdata('msg', 'Il tuo account è in attesa di attivazione.');
            } else {
                if ($row['password'] == $password) {
                    $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

                    $user_id = preg_replace("/[^0-9]+/", "", $row['id']); // ci proteggiamo da un attacco XSS
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $row['email']); // ci proteggiamo da un attacco XSS
                    $login_string = hash('sha512', $password . $user_browser);

                    $data = [
                        'idP' => $password,
                        'browser' => $user_browser,
                        'user_id' => $user_id,
                        'username' => $username,
                        'login_string' => $login_string,
                        'user' => $row,
                        'isLoggedIn' => true,
                        'logged_in' => true
                    ];

                    session()->set($data);

                    // Login eseguito con successo.
                    $destination = $this->redirect_login($row['sezione']);

                } else {
                    $model = new LoginAttemptsModel();
                    $data = [
                        'user_id' => $row['id'],
                        'time' => time()
                    ];

                    $model->save($data);
                    $session->setFlashdata('msg', 'La password inserita non è corretta.');
                }
            }
        } else {
            $session->setFlashdata('msg', 'L\'utente inserito non esiste.');
        }
        return redirect()->to($destination);
    }

    private function checkbrute($user_id)
    {
        $now = time();
        $valid_attempts = $now - (2 * 60 * 60);

        $mysqli = \Config\Database::connect();
        $builder = $mysqli->table('login_attempts');

        $builder->where('user_id', $user_id);
        $builder->where('time >', $valid_attempts);

        if ($builder->countAllResults() > 5) {
            return true;
        }

        return false;
    }

    public function save() {
        $model = new MemberModel();
        $session = session();
        $data = [
            'nome' => $this->request->getVar('nome'),
            'cognome' => $this->request->getVar('cognome'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('p'),
            'salt' => hash('sha512', uniqid(random_int(1, mt_getrandmax()), true))
        ];

        $lastID = $model->insert($data);

        $dataMail = array(
            'nome' => $this->request->getVar('nome'),
            'cognome' => $this->request->getVar('cognome'),
            'idMember' => $lastID,
            'mailMember' => $this->request->getVar('email'),
            'dataInsert' => date('Y-m-d H:i:s', time())
        );

        $this->mailConferma($dataMail);

        $session->setFlashdata('msg-success', 'Controlla la tua email per confermare la registrazione del tuo account.');
        return redirect()->to('/login');
    }

    public function mailConferma($data = array()) {
        $messaggio = mailer();

        $messaggio->AddAddress($data['mailMember']);
        $messaggio->Subject = 'Attivazione account';

        ob_start();
        require_once(APPPATH.'../public/mail_template/conferma_account.html');
        $body = ob_get_clean();

        $tokenMail = $this->tokenMail($data);
        $currentYear = date('Y', time());
        $linkAttivation = site_url('register/confirm/' . $tokenMail);
        $linkBrowser = site_url('register/mailConfermaBrowser/' . $tokenMail);

        $body = str_replace("##linkAttivation##", $linkAttivation, $body);
        $body = str_replace("##linkBrowser##", $linkBrowser, $body);
        $body = str_replace("##currentYear##", $currentYear, $body);

        $messaggio->MsgHTML($body);

        if (!$messaggio->Send()) {
            return $messaggio->ErrorInfo;
        }

        unset($messaggio);

        return 'Email inviata correttamente!';
    }

    public function tokenMail($dati = array()) {
        $default = array(
            'nome' => null,
            'cognome' => null,
            'idMember' => null,
            'mailMember' => null,
            'dataInsert' => null
        );

        foreach ($default as $key => $val) {
            if (isset($dati[$key])) {
                $arr[$key] = $dati[$key];
            } else {
                $arr[$key] = $default[$key];
            }
        }

        return base64_encode(serialize($arr));
    }

    public function confirm($token) {
        $session = session();
        $model = new MemberModel();
        $var = unserialize(base64_decode($token));

        $newData = [
            'attivo' => 1
        ];

        $model->update($var['idMember'],$newData);

        $session->setFlashdata('msg-success', 'Il tuo account è stato attivato. Inserisci le tue credenziali per accedere alla tua area riservata.');
        return redirect()->to('/login');
    }

    public function mailConfermaBrowser($tokenMail){
        ob_start();
        include __DIR__ . 'mail_template/conferma_account.html';
        $body = ob_get_clean();

        $currentYear = date('Y', time());
        $linkAttivation = site_url('register/confirm/' . $tokenMail);

        $body = str_replace("##linkAttivation##", $linkAttivation, $body);
        $body = str_replace("##currentYear##", $currentYear, $body);

        echo $body;
    }

    public function changePassword($token){
        $session = session();
        $model = new MemberModel();
        $var = unserialize(base64_decode($token));

        $newData = [
            'password' => $this->request->getVar('p')
        ];

        $model->update($var['idMember'],$newData);

        $session->setFlashdata('msg-success', "L'operazione è andata a buon fine. Effettua il login con la nuova password");
        return redirect()->to('/login');
    }

    public function resetPassword() {
        $session = session();
        $model = new MemberModel();
        $row = $model->getUser($this->request->getVar('mail'));

        if (!empty($row)) {
            $dataMail = array(
                'nome' => $row['nome'],
                'cognome' => $row['cognome'],
                'idMember' => $row['id'],
                'mailMember' => $this->request->getVar('mail'),
                'dataInsert' => $row['created_at']
            );

            $this->mailReset($dataMail);

            $session->setFlashdata('msg-success', 'Controlla la tua email e segui le istruzioni per resettare la password.');
            return redirect()->to('/login');
        }

        $session->setFlashdata('msg', "L'indirizzo email inserito non è presente nel nostro archivio.");
        return redirect()->to('/login');
    }

    public function mailReset($data = array()) {

        $messaggio = mailer();

        $messaggio->AddAddress($data['mailMember']);

        $messaggio->Subject = 'Reset password';

        ob_start();
        require_once(APPPATH.'../public/mail_template/reset_password.html');
        $body = ob_get_clean();

        $tokenMail = $this->tokenMail($data);
        $currentYear = date('Y', time());
        $resetPassword = site_url('changepassword/' . $tokenMail);
        $linkBrowser = site_url('reset_password/mailResetPassword/' . $tokenMail);

        $body = str_replace("##linkBrowser##", $linkBrowser, $body);
        $body = str_replace("##resetPassword##", $resetPassword, $body);
        $body = str_replace("##currentYear##", $currentYear, $body);

        $messaggio->MsgHTML($body);

        if (!$messaggio->Send()) {
            return $messaggio->ErrorInfo;
        }

        unset($messaggio);

        return 'Email inviata correttamente!';
    }

    public function mailResetPassword($tokenMail){
        ob_start();
        require_once(APPPATH.'../public/mail_template/reset_password.html');
        $body = ob_get_clean();

        $currentYear = date('Y', time());
        $resetPassword = site_url('reset_password/change/' . $tokenMail);
        $linkBrowser = site_url('reset_password/mailResetPassword/' . $tokenMail);

        $body = str_replace("##linkBrowser##", $linkBrowser, $body);
        $body = str_replace("##resetPassword##", $resetPassword, $body);
        $body = str_replace("##currentYear##", $currentYear, $body);

        echo $body;
    }
}