<?php

namespace App\Console\Commands;

use App\Contracts\IUserRepository;
use App\Mail\BirthdayMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendBirthdayEmailCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-birthday-email-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send birthday greetings to user';

    /**
     * Execute the console command.
     */
    public function handle(IUserRepository $repository): void
    {
        $email = new BirthdayMail();
        $user = $repository->getUserByEmail('lvoronin99@gmail.com');
        Mail::to($user->email)->send($email);
        $this->info('Daily mail sent successfully');
    }
}
