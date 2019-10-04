<?php
class User {
    private $_db,
            $_data,
            $_sessionName,
            $_isLoggedIn;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');

        if(!$user) {
            if (Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);
                if ($this->findById($user)) {
                    $this->_isLoggedIn = true;
                } else {
                }
            }
        } else {
            $this->findById($user);
        }
    }

    public function create($fields) {
        if(!$this->_db->insert('users', $fields)) {
            throw new Exception('there was a problem creating an account.');
        }
    }

    public function findById($user = null) {
        if ($user) {
            $data = $this->_db->get('users', ['u_id', '=', $user]);
        }

        if ($data->count()) {
            $this->_data = $data->first();
            return true;
        }
        return false;
    }

    public function findByUsername($user = null) {
        if ($user) {
            $data = $this->_db->get('users', ['u_username', '=', $user]);
        }

        if ($data->count()) {
            $this->_data = $data->first();
            return true;
        }
        return false;
    }

    public function login($username = null, $password = null) {
        $user = $this->findByUsername($username);

        if ($user) {
            if ($this->data()->u_password === Hash::make($password, $this->data()->u_salt)) {
                Session::put($this->_sessionName, $this->data()->u_id);
                echo 'session created';
                return true;
            } else {
                echo 'Password incorrect';
            }
        } else {
            echo 'Username doesn\'t exist';
        }

        return false;
    }

    public function logout() {
        Session::delete($this->_sessionName);
        // echo 'session deleted';
    }

    public function data() {
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->_isLoggedIn;
    }
} ?>
