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

namespace Ticketer\Traits;

/**
 * Restricts the controller to admins.
 *
 * @package Ticketer
 * @subpackage Traits
 */
trait AdminOnly
{
    /**
     * Add the filter.
     */
    public function filters()
    {
        parent::filters();
        $this->before['*'][] = 'checkIfAdmin';
    }

    /**
     * Checks if the user is logged in.
     */
    public function checkIfAdmin()
    {
        if (!LOGGEDIN or !$this->currentUser->group->is_admin) {
            $this->render['action'] = false;
            $this->render('errors/no_permission');
        }
    }
}
