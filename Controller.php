<?php

class Controller
{
    private $update;
    private $chat_id;
    private $user;
    private $model;
    
    
    public function __construct()
    {
        $this->model = new Model();
    }
    
    public function handle($update)
    {
        $this -> update = $update;
        $this -> chat_id = $this->update['message']['chat']['id'];
        $this -> user = $this->model->get_user($this->chat_id);
        var_dump($this->user);
        $text = $update['message']['text'];
        $this -> check_predefine_messages($text);
    }

    public function check_predefine_messages($text)
    {
        switch($text){
            case '/start':
                $this->start_cmd();
                break;

            case 'دیدن سوال':
                $this->question();
                break;

            default:
                $this->run_game($text);
                $this->question();
                break;
        }
    }


    public function run_game($_text)
    {
        $level = $this->model->get_level($this->user['level_id']);

        if(strtolower($_text) === $level['answer']){
            TelegramLib::send_message('تبریک شما برنده شدید',$this->chat_id);
            $this->model->next_level($this->user['id'] , $level['id']+1);
            $this -> user = $this->model->get_user($this->chat_id);
            return;
        }
        TelegramLib::send_message('لطفا دوباره تلاش کنید' , $this->chat_id);
    }



    public function start_cmd()
    {
        $keyboard = TelegramLib::make_keyboard(
            [
                // [['text'    => 'دیدن سوال']  ,  ['text'      => 'ROW 1 COL 2']],
                // [['text'    => 'ROW 2 COL 1'] ,  ['text'     => 'ROW 2 COL 2']],
                [['text'    => 'دیدن سوال']]
            ]
        );
        $text = "
        خوش امدید به ربات امیرحسام.\n

        برای دیدن سوال روی دکمه زیر کلیک کنید
        ";
        TelegramLib::send_message($text , $this->chat_id , $keyboard);
    }

    public function question()
    {
        $level = $this->model->get_level($this->user['level_id']);
        TelegramLib::send_message(
            $level['quest'],
            $this->update['message']['chat']['id']
        );
    }
}