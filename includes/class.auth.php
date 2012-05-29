<?PHP
    class Auth
    {
        const SALT = "S&I'>6;R~6+!IBK3RWI8MpPr,WTuW=,`}Q*2+f*u|O.amX1`M.";

        private static $me;

        public $id;
        public $username;
        public $user;
        public $expiryDate;
        public $loginUrl = 'backend/login.php'; // Where to direct users to login

        private $nid;
        private $loggedIn;

        public function __construct()
        {
            $this->id         = null;
            $this->nid        = null;
            $this->username   = null;
            $this->user       = null;
            $this->loggedIn   = false;
            $this->expiryDate = mktime(0, 0, 0, 6, 2, 2037);
            $this->user       = new User();
        }

        public static function getAuth()
        {
            if(is_null(self::$me))
            {
                self::$me = new Auth();
                self::$me->init();
            }
            return self::$me;
        }

        public function init()
        {
            $this->setACookie();
            $this->loggedIn = $this->attemptSessionLogin();

            if($this->loggedIn === false)
                $this->loggedIn = $this->attemptCookieLogin();
        }

        public function login($username, $password)
        {
            $this->loggedIn = false;

            $db = Database::getDatabase();
            $hashed_password = self::hashedPassword($password);
            $row = $db->getRow("SELECT * FROM users WHERE username = " . $db->quote($username) . " AND password = " . $db->quote($hashed_password));

            if($row === false)
                return false;

            $this->id       = $row['id'];
            $this->nid      = $row['nid'];
            $this->username = $row['username'];
            $this->user     = new User();
            $this->user->id = $this->id;
            $this->user->load($row);

            $this->generateBCCookies();
            $_SESSION['nid'] = $this->nid;

            $this->loggedIn = true;

            return true;
        }

        public function logout()
        {
            $this->loggedIn = false;
            unset($_SESSION['nid']);
            $this->clearCookies();
            $this->sendToLoginPage();
        }

        public function loggedIn()
        {
            return $this->loggedIn;
        }

        public function requireUser()
        {
            if(!$this->loggedIn())
                $this->sendToLoginPage();
        }

        public function isAdmin()
        {
            return ($this->user->level === 'admin');
        }

        public static function createNewUser($username, $password = null)
        {
	    $db = Database::getDatabase();

            $user_exists = $db->getValue("SELECT COUNT(*) FROM users WHERE username = " . $db->quote($username));
            if($user_exists > 0)
                return false;

            if(is_null($password))
                $password = Auth::generateStrongPassword();

            srand(time());
            $u = new User();
            $u->username = $username;
            $u->nid = self::newNid();
            $u->password = self::hashedPassword($password);
            $u->insert();
            return $u;
        }

        private function attemptSessionLogin(){
            if(!isset($_SESSION['nid']))
                return false;

            $nid = $_SESSION['nid'];

            $db = Database::getDatabase();

            // We SELECT * so we can load the full user record into the user DBObject later
            $row = $db->getRow('SELECT * FROM users WHERE nid = ' . $db->quote($nid));
            if($row === false)
                return false;

            $this->id       = $row['id'];
            $this->nid      = $row['nid'];
            $this->username = $row['username'];
            $this->user     = new User();
            $this->user->id = $this->id;
            $this->user->load($row);

            return true;
        }

        private function attemptCookieLogin()
        {
            if(!isset($_COOKIE['A']) || !isset($_COOKIE['B']) || !isset($_COOKIE['C']))
                return false;

            $ccookie = base64_decode(str_rot13($_COOKIE['C']));
            if($ccookie === false)
                return false;

            $c = array();
            parse_str($ccookie, $c);
            if(!isset($c['n']) || !isset($c['l']))
                return false;

            $bcookie = base64_decode(str_rot13($_COOKIE['B']));
            if($bcookie === false)
                return false;

            $b = array();
            parse_str($bcookie, $b);
            if(!isset($b['s']) || !isset($b['x']))
                return false;

            if($b['x'] < time())
                return false;

            $computed_sig = md5(str_rot13(base64_encode($ccookie)) . $b['x'] . self::SALT);
            if($computed_sig != $b['s'])
                return false;

            $nid = base64_decode($c['n']);
            if($nid === false)
                return false;

            $db = Database::getDatabase();

            // We SELECT * so we can load the full user record into the user DBObject later
            $row = $db->getRow('SELECT * FROM users WHERE nid = ' . $db->quote($nid));
            if($row === false)
                return false;

            $this->id       = $row['id'];
            $this->nid      = $row['nid'];
            $this->username = $row['username'];
            $this->user     = new User();
            $this->user->id = $this->id;
            $this->user->load($row);

            return true;
        }

        private function setACookie()
        {
            if(!isset($_COOKIE['A']))
            {
                srand(time());
                $a = md5(rand() . microtime());
                setcookie('A', $a, $this->expiryDate, '/', Config::get('authDomain'));
            }
        }

        private function generateBCCookies()
        {
            $c  = '';
            $c .= 'n=' . base64_encode($this->nid) . '&';
            $c .= 'l=' . str_rot13($this->username) . '&';
            $c = base64_encode($c);
            $c = str_rot13($c);

            $sig = md5($c . $this->expiryDate . self::SALT);
            $b = "x={$this->expiryDate}&s=$sig";
            $b = base64_encode($b);
            $b = str_rot13($b);

            setcookie('B', $b, $this->expiryDate, '/', Config::get('authDomain'));
            setcookie('C', $c, $this->expiryDate, '/', Config::get('authDomain'));
        }

        private function clearCookies()
        {
            setcookie('B', '', time() - 3600, '/', Config::get('authDomain'));
            setcookie('C', '', time() - 3600, '/', Config::get('authDomain'));
        }

        private function sendToLoginPage()
        {
            $url = WEB_ROOT . $this->loginUrl;

            $full_url = full_url();
            if(strpos($full_url, 'logout') === false)
            {
                $url .= '?r=' . $full_url;
            }

            redirect($url);
        }

        private static function hashedPassword($password)
        {
            return md5($password . self::SALT);
        }

        private static function newNid()
        {
            srand(time());
            return md5(rand() . microtime());
        }
    }
