<?php 

namespace system\Helpers;

use Exception;

class Helpers {


    public static function redirect(string $url = null){
        header('HTTP/1.1 302 Found');
        $local = ($url ? self::url($url) : self::url());

        header("Location: {$local} ");
        exit();
    }

    public static function validateCPF(string $cpf):bool{
        $cpf = self::clearNumber($cpf);
        if(strlen($cpf) != 11 or preg_match('/(\d)\1{10}/',$cpf)){
            throw new Exception('CPF Invalido');
            return false;
        }
        for ( $t = 9; $t < 11; $t++){
            for($d = 0, $c = 0; $c < $t; $c++){
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ( $cpf[$c] != $d){
                throw new Exception('CPF Invalio');
                return false;
            } 
        }
        return true;
    }
    public static function clearNumber(string $number): string
    {
        return preg_replace('/[^0-9]/','',$number);
    }
    public static function slug(string $str): string 
    {
        $map['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?¨|;:.,\\\'<>°ºª  ';

        $map['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';
        
        $slug = strtr(utf8_decode($str),utf8_decode($map['a']),$map['b']);
        return $slug;
    }


    public static function url(string $url=NULL): string
    {
        // return $url;
        $server = filter_input(INPUT_SERVER, 'SERVER_NAME');
        $environment = ($server == 'localhost' ? URL_DEV : URL_PROD);
        // echo 'holasldasdlasdlasdldl <br> dasdsiadsaidsa <br> djsidjsaid';
        if(str_starts_with($url,'/')){
            return $environment.$url;
        }

        return $environment.'/'.$url;
    }

    public static function localhost():bool
    {
        $server = filter_input(INPUT_SERVER,'SERVER_NAME');

        if($server == 'localhost'){
            return true;
        }
        return false;
    }

    /**
     *  Validate url
     * @param string $url
     * @return bool 
     */
    public static function validateUrl(string $url):bool
    {
        if(str_contains($url,'.') and (str_starts_with($url,'http://') or str_starts_with($url,'https://'))){
            return true;
        }
        return false;
    }

    public static function validateEmail( string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    public static function formatDate(): string 
    {
        $monthDay = date('d');
        $weekDay = date('w'); 
        $month = date('n') -1;
        $year = date('Y');

        $weekDaysNames = [ 
            'Domingo',
            'Segunda',
            'Terça',
            'Quarta',
            'Quinta',
            'Sexta',
            'Sábado'
        ];
        $monthNames = [
            'Janeiro',
            'Fevereiro',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro'];

        $dateFormated = $weekDaysNames[$weekDay]." ".$monthDay.' de '.$monthNames[$month].' de '.$year;
        return $dateFormated;
    }

    /**
     *  Count time from specifc date until now
     *  @param string $data
     * @return string
     */
    public static function timeCounter(string $date)
    {
        $now = strtotime(date('Y-m-d H:i:s'));
        // echo "<hr>";
        $time = strtotime($date);
        // echo "<hr>";
        $timeDelta = $now - $time;

        $seconds = $timeDelta;
        $minutes = round($timeDelta/60);
        $hours = round($timeDelta/3600);
        $days = round($timeDelta/86400);
        $weeks = round($timeDelta/604800);
        $months = round($timeDelta/2419200);
        $years = round($timeDelta /29030400);
        // echo "<hr>";
        // var_dump($minutes);
        if($seconds <= 60){
            return 'agora';
        }elseif($minutes <= 60){
            return $minutes == 1 ? 'há 1 minuto' : 'há '.$minutes.' minutos';
        }elseif($hours <= 24){
            return $hours == 1 ? 'há 1 hora': 'há '.$hours.' horas.';
        }elseif($days <= 7){
            return $days == 1 ? 'ontem': 'há '.$days.' dias.';
        }elseif($weeks <= 4){
            return $weeks == 1 ? 'há 1 semana': 'há '.$weeks.' semanas.';
        }elseif($months <= 12){
            return $months == 1 ? 'há 1 mês': 'há '.$months.' meses.';
        }else{
            return $years == 1 ? 'há 1 ano': 'há '.$years.' anos.';
        }
    }
    public static function formatValue( float $value = null):string
    {
        return number_format($value,2,',','.');
    }
    public static function greets(): int 
    {
        return 1+1;
    }

    /**
     *  Writes a new text
     *  @param string $text to be write
     * @return string $text returned
     */
    public static function hello(string $usr = '')
    {
        $time = date("H");
        // $time = 18;
        $greet = " Hello";
        if($time < 5){
            $greet = "Boa Madrugada";
        }elseif($time <=11){
            $greet = "Bom Dia";
        }elseif($time <=17){
            $greet = "Boa Tarde";
        }else {
            $greet = "Boa Noite";
        }
        if($usr){
            echo $greet.', '.$usr;
        }else{
            echo $greet;
        }
        // echo $time;

        // echo 'hehe<br>';

        // return $time;
    }

}