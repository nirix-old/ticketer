<?php
/*!
 * Ticketer
 * Copyright (C) 2012 Jack P.
 * https://github.com/nirix
 *
 * This file is part of Ticketer.
 *
 * Ticketer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 only.
 *
 * Ticketer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ticketer. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Ticketer\Controllers;

use Radium\Http\Request;
use Ticketer\Models\User;

/**
 * User controller.
 *
 * @package Ticketer
 * @subpackage Controllers
 */
class Users extends AppController
{
    /**
     * Login page.
     */
    public function loginAction()
    {

    }

    /**
     * Register page.
     */
    public function registerAction()
    {
        $user = new User;

        if (Request::method() == 'post') {
            $user->set([
                'username' => Request::$post['username'],
                'password' => Request::$post['password'],
                'name'     => Request::$post['name'],
                'email'    => Request::$post['email'],
            ]);

            if ($user->save()) {
                Request::redirectTo('/login');
            }
        }

        $this->set(compact('user'));
    }
}
