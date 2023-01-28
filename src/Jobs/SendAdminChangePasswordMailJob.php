<?php

namespace Creatify\Authentication\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Creatify\Authentication\Notifications\SendAdminVerificationMail;
use Creatify\Authentication\Repositories\Interfaces\IUserRepository;
use App\Models\User;
use Creatify\Authentication\Notifications\SendAdminChangePasswordMail;

class SendAdminChangePasswordMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $user;
    private $userRepository;
    public function __construct(User $user,IUserRepository $userRepository)
    {
        $this->user = $user;
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user=$this->userRepository->createCode($this->user->id,'change_password');
        $code=$user->pin_code;
        $this->user->notify(new SendAdminChangePasswordMail($code));
    }
}
