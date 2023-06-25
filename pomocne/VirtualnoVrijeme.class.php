<?php
class VirtualnoVrijeme
{
    private static function dohvatiPomakUrl()
    {
        $url = 'http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $odgovor = curl_exec($curl);

        if ($odgovor === false) {
            $greska = curl_error($curl);
            echo "cURL Greška: " . $greska;
        } else {
            $podaci = json_decode($odgovor, true);
            $pomak = $podaci["WebDiP"]["vrijeme"]["pomak"]["brojSati"];

        }



        curl_close($curl);
        return $pomak;
    }
    public static function upisiPomak()
    {
        $datoteka = '../configs/Vrijeme.cfg';
        $vrijeme = self::dohvatiPomakUrl();
        $dat = fopen(realpath($datoteka), 'w');


        fwrite($dat, $vrijeme);
        fclose($dat);
    }
    private static function dohvatiPomak()
    {

        try {
            $datoteka = __DIR__ . '/../configs/Vrijeme.cfg';
            $dat = fopen(realpath($datoteka), 'r');
            $vrijeme = fread($dat, filesize($datoteka));
        } catch (Exception $ex) {
            try {
                $datoteka = __DIR__ . '/../../configs/Vrijeme.cfg';
                $dat = fopen(realpath($datoteka), 'r');
                $vrijeme = fread($dat, filesize($datoteka));
            } catch (Exception $ex) {
                // Handle the exception or add any necessary error handling
            }
        }
        


      

        fclose($dat);
        return $vrijeme;


    }
    public static function virtualnoSada()
    {
        if (self::dohvatiPomak() >= 0)
            return strtotime("+" . self::dohvatiPomak() . " hours", time());
        else {
            return strtotime("-" . self::dohvatiPomak() . " hours", time());

        }
    }

}
?>