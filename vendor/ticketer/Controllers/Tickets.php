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
use Ticketer\Models\Ticket;

/**
 * Ticket controller.
 *
 * @package Ticketer
 * @subpackage Controllers
 */
class Tickets extends AppController
{
    use \Ticketer\Traits\RequiresAuthentication;

    public function __construct()
    {
        parent::__construct();
        $this->title(l('tickets'));
    }

    /**
     * Users ticket listing page.
     */
    public function indexAction()
    {
        $tickets = Ticket::select()->where('user_id = ?', $this->currentUser->id)->fetchAll();
        $this->set(compact('tickets'));
    }

    public function newAction()
    {
        $ticket = new Ticket;

        if (Request::method() == 'post') {
            $ticket->set([
                'summary' => Request::$post['summary']
            ]);

            if ($ticket->save()) {
                Request::redirectTo($this->href());
            }
        }

        $this->set(compact('ticket'));
    }
}
