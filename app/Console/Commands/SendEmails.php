<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Mail;


class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send drip e-mails to a user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $allUsers = DB::table('users')
                    ->get();
        // print_r($allUsers);
        // exit;
        $mailTitle = '規約を変更しました。';
        $data = [];
        
        for($i=0; $i<count($allUsers); $i++){

            $emailTo = $allUsers[$i]->email;
            Mail::send('email.testMail',$data, function ($message) use($mailTitle,$emailTo) {
                $message->subject($mailTitle);
                $message->to($emailTo);
                $message->from('uguisuyuuka@gmail.com','From:翻訳畑');
            });
        }
    }
}
