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

namespace Ticketer\Models;

/**
 * User model.
 *
 * @package Ticketer
 * @subpackage Models
 */
class User extends \Radium\Database\Model
{
    protected static $_table = 'users';

    protected static $_validates = [
        'username' => ['unique', 'required'],
        'email'    => ['unique', 'required', 'email'],
        'password' => ['required', 'minLength' => 8],
        'name'     => ['required']
    ];

    protected static $_before = [
        'create' => ['beforeCreate']
    ];

    /**
     * Checks if the users password matches.
     *
     * @param string $password
     *
     * @return boolean
     */
    public function verifyPassword($password)
    {
        return crypt($password, $this->password) == $this->password;
    }

    protected function beforeCreate()
    {
        $this->preparePassword();
        $this->login_hash = sha1($this->username . time() . rand(0, 500) . sha1(microtime()));
        $this->created_at = 'NOW()';
    }

    protected function preparePassword()
    {
        $this->password = crypt($this->password, '$2a$10$' . sha1(microtime() . $this->username . $this->email) . '$');
    }
}
