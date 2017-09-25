<?php

namespace App\Controller;

use Core\Helper\BootstrapForm;
use Core\Helper\FormValidator;
use Core\Helper\GlobalXSSFilter;

class UserController extends AppController {

    public function login() {
        $form = new BootstrapForm(GlobalXSSFilter::get('post'));

        $this->render('user.login', compact('form'));
    }


    public function register() {
        $formValidator = new FormValidator();
        if(!empty(GlobalXSSFilter::get('post'))) {
            $formValidator = (new FormValidator(GlobalXSSFilter::get('post')))
                ->lenght('login', 2, 12)
                ->required('login', 'mail', 'confirm_mail', 'password', 'confirm_password');

        }

        if($formValidator->isValid()) {
            //TODO: save in database
        }

        $form = new BootstrapForm(GlobalXSSFilter::get('post'), $formValidator->getErrors());

        $this->render('user.register', compact('form'));
    }
}