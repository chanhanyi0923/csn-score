<?php
class fetch_html {
    private $url, $cookie_jar;
    public function __construct($_url, $_cookie = "cookie.txt") {
        $this -> cookie_jar = $_cookie;
        $this -> url = $_url;
    }
    public function login($page, $userid, $passwd) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this -> url . $page);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        curl_setopt($ch, CURLOPT_POST, 1);
        $request = "txtS_NO=".$userid."&txtPerno=".$passwd."&LEVEL=0";
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this -> cookie_jar);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this -> cookie_jar);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        
        $html = curl_exec($ch);
        curl_close($ch);
        
        //suc -> i_Stu.asp
        //fail -> Stu.asp
        preg_match("/Location:\s(.*?)\s/", $html, $location);
        if($location[1] == "i_Stu.asp") {
            return true;
        } else if($location[1] == "Stu.asp") {
            return false;
        }
    }
    public function logout() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this -> url. "Logout.asp");


        curl_setopt($ch, CURLOPT_COOKIEJAR, $this -> cookie_jar);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this -> cookie_jar);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        
        curl_exec($ch);
        
        curl_close($ch);
    }
    public function get_info($page) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this -> url. $page);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_COOKIEJAR, $this -> cookie_jar);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this -> cookie_jar);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        $re = iconv("BIG5", "UTF-8", curl_exec($ch));
        
        curl_close($ch);
        
        return $re;
    }
    public function __destruct() {
        unset($url);
        unset($cookie_jar);
    }
}
?>