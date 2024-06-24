<?php

namespace App\Console\Commands;

use App\Models\StoreEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Artisan;
use Webklex\IMAP\Facades\Client;

class EmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch All emails from the inbox';

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
     * @return int
     */
    public function handle()
    {
        ini_set('max_execution_time', 30000); //300 seconds = 5 minutes
        
        Artisan::call("config:clear");
        $client = Client::account('gmail');
        $client->connect();
   
        $folders = $client->getFolder('INBOX');




        $time = Carbon::now()->subDays(1)->format('d.m.Y');
        $messages = $folders->query()->since($time)->get();

       

    foreach($messages as $key => $message)
    {
       if(StoreEmail::where('uid', $message->uid)->doesntExist())
       {
           StoreEmail::create([
               'from'      =>  $message->getFrom()[0]->mail,
               'date'      =>  $message->getDate(),
               'subject'   =>  $message->getSubject(),
               'body'      =>  utf8_encode($message->getHTMLBody()),
               'email_id'  =>  'subvention@novecology.fr',
               'uid'       =>  $message->uid,
           ]);
       }
    }
        ini_set('max_execution_time', 30000); //300 seconds = 5 minutes
    
        Artisan::call("config:clear");
        $client = Client::account('gmail_two');
        $client->connect();
   
        $folders = $client->getFolder('INBOX');




        $time = Carbon::now()->subDays(1)->format('d.m.Y');
        $messages = $folders->query()->since($time)->get();

       

    foreach($messages as $key => $message)
    {
       if(StoreEmail::where('uid', $message->uid)->doesntExist())
       {
           StoreEmail::create([
               'from'      =>  $message->getFrom()[0]->mail,
               'date'      =>  $message->getDate(),
               'subject'   =>  $message->getSubject(),
               'body'      =>  utf8_encode($message->getHTMLBody()),
               'email_id'  =>  'mandat@novecology.fr',
               'uid'       =>  $message->uid,
           ]);
       }
    }
        ini_set('max_execution_time', 30000); //300 seconds = 5 minutes
    
        Artisan::call("config:clear");
        $client = Client::account('gmail_three');
        $client->connect();
   
        $folders = $client->getFolder('INBOX');




        $time = Carbon::now()->subDays(1)->format('d.m.Y');
        $messages = $folders->query()->since($time)->get();

       

        foreach($messages as $key => $message)
        {
        if(StoreEmail::where('uid', $message->uid)->doesntExist())
        {
            StoreEmail::create([
                'from'      =>  $message->getFrom()[0]->mail,
                'date'      =>  $message->getDate(),
                'subject'   =>  $message->getSubject(),
                'body'      =>  utf8_encode($message->getHTMLBody()),
                'email_id'  =>  'supportmpr@novecology.fr',
                'uid'       =>  $message->uid,
            ]);
        }
        }
    }
}
