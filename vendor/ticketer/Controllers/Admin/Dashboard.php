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

use Ticketer\Models\Ticket;
use Ticketer\Models\User;

/**
 * Dashboard controller.
 *
 * @package Ticketer
 * @subpackage Controllers
 */
class Dashboard extends AppController
{
    public function indexAction()
    {
        $information = ['tickets' => []];

        // Tickets
        $information['tickets']['open'] = Ticket::select()->where('is_closed = ?', 0)->rowCount();
        $information['tickets']['resolved'] = Ticket::select()->where('is_closed = ?', 1)->rowCount();
        $information['tickets']['total'] = $information['tickets']['open'] + $information['tickets']['resolved'];

        // Tickets
        $information['users']['newest'] = User::select()->orderBy('id', 'DESC')->fetch();
        $information['users']['total'] = User::select('id')->rowCount();

        $this->set(compact('information'));
    }
}
