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
 * Requires Authentication on controllers
 * that use this trait.
 *
 * @package Ticketer
 * @subpackage Traits
 */
trait RequiresAuthentication
{
    /**
     * Add the filter.
     */
    public function filters()
    {
        parent::filters();
        $this->before['*'][] = 'requireAuthentication';
    }

    /**
     * Checks if the user is logged in.
     */
    public function requireAuthentication()
    {
        if (!LOGGEDIN) {
            $this->render['action'] = false;
            $this->render('users/login');
        }
    }
}
