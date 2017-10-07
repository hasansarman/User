<?php

namespace Modules\User\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * Return the gravatar link for the users email
     * @param  int $size
     * @return string
     */
    public function gravatar($size = 90)
    {
        $email = md5($this->EMAIL);

        return "//www.gravatar.com/avatar/$email?s=$size";
    }

    /**
     * @return string
     */
    public function fullname()
    {
        return $this->NAME ?: $this->FIRST_NAME . ' ' . $this->LAST_NAME;
    }
}
