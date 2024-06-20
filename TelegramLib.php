<?php

class TelegramLib
{

    private static string $url;

    /**
     * set url parameter to use
     *
     * @return void [return description]
     */

    private static function init(): void
    {
        self::$url = 'https://api.telegram.org/bot'.TOKEN.'/';
    }   


    /**
     * Undocumented function
     *
     * @param string $_method
     * @param array $_parameters
     * @return array|bool
     */
    private static function execute(string $_method , array $_parameters):array|bool
    {
        if(!isset(self::$url)){
            self::init();
        }

        $url = self::$url . $_method;

        $curl = curl_init($url);
        curl_setopt($curl , CURLOPT_RETURNTRANSFER , true);
        if(!empty($_parameters)){
            curl_setopt($curl , CURLOPT_POSTFIELDS , json_encode($_parameters));
        }
        curl_setopt($curl , CURLOPT_HTTPHEADER , ['Content-Type:application/json']);
        
        $result = curl_exec($curl);
        $error = null ;
        if(curl_errno($curl)){
            $error = curl_error($curl);
        }
        if(!is_null($error)){
            return false;
        }

        $output = json_decode($result , true);
        if(is_null($output)){
            return false;
        }
        return $output;
    }

    public static function make_keyboard(array $_keyboard , bool $_resize = false , bool $_one_time = false)
    {
        return [
            'keyboard'                  => $_keyboard,
            'resize_keyboard'           => $_resize,
            'one_time_keyboard'         => $_one_time
        ];
    }



    /**
     * Undocumented function
     *
     * @param string $_text
     * @param string $_chat_id
     * @return array|boolean
     */
    public static function send_message(string $_text , string $_chat_id , array $_keyboard = []):array|bool
    {
        $parameters = [
            "text"      =>  $_text,
            "chat_id"   =>  $_chat_id  
        ];
        if(!empty($_keyboard)){
            $parameters['reply_markup'] = $_keyboard;
        }
        return self::execute('sendMessage' , $parameters);
    }

    /**
     * Undocumented function
     *
     * @param integer|null $_offset
     * @return array|null
     */
    public static function get_update(int $_offset = null):array|null
    {
        $parameters = [];
        if(!is_null($_offset)){
            $parameters['offset'] = $_offset;
        }
        $result = self::execute('getUpdates' , $parameters);
        if(!is_array($result)){
            return false;
        }
        return $result['result'];
    }

    public static function get_me(){
        $parameters=[];
        return self::execute('getMe',$parameters);
    }

}



