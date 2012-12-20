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

/**
 * Account controller.
 *
 * @package Ticketer
 * @subpackage Controllers
 */
class Account extends AppController
{
    public function __construct()
    {
        parent::__construct();

        // Clone current user
        $this->user = clone $this->currentUser;
    }

    /**
     * Index Page.
     */
    public function indexAction()
    {
    }

    public function __shutdown()
    {
        // Send user to view
        $this->set('user', clone $this->user);
        parent::__shutdown();
    }
}
