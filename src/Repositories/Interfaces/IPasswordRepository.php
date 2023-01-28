<?php

namespace Creatify\Authentication\Repositories\Interfaces;

interface IPasswordRepository{

    public function sendResetLinkEmail($data);
    public function resetPassword($data);


}









?>
