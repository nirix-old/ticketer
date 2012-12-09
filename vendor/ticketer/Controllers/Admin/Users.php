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

namespace Ticketer\Controllers\Admin;

use Radium\Http\Request;
use Ticketer\Models\User;

/**
 * Users controller.
 *
 * @package Ticketer
 * @subpackage Controllers
 */
class Users extends AppController
{
    /**
     * User listing.
     */
    public function indexAction()
    {
        $this->set('users', User::all());
    }

    /**
     * Edit user
     *
     * @param integer $id
     */
    public function editAction($id)
    {
        $user = User::find($id);

        // Make sure the user exists
        if (!$user) {
            return $this->show404();
        }

        // Check if the form has been submitted
        if (Request::method() == 'post') {
            $user->set([
                'name'     => Request::$post['name'],
                'username' => Request::$post['username'],
                'email'    => Request::$post['email'],
                'group_id' => Request::$post['group'],
            ]);

            if ($user->save()) {
                Request::redirectTo('/admin/users');
            }
        }

        $this->set(compact('user'));
    }

    /**
     * Delete user
     *
     * @param integer $id
     */
    public function deleteAction($id)
    {
        $user = User::find($id);

        // Make sure the user exists
        if (!$user) {
            return $this->show404();
        }

        // Delete user
        if ($user->delete()) {
            Request::redirectTo('/admin/users');
        }
    }
}
