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
     * Ticket listing page.
     */
    public function indexAction()
    {
        if ($this->currentUser->group->is_staff) {
            $tickets = Ticket::all();
        } else {
            $tickets = Ticket::select()->where('user_id = ?', $this->currentUser->id)->fetchAll();
        }
        $this->set(compact('tickets'));
    }

    /**
     * View ticket page.
     *
     * @param integer $id
     */
    public function viewAction($id)
    {
        // Get ticket
        $ticket = Ticket::find($id);

        // Show 404 if no ticket is found
        if (!$ticket) {
            return $this->show404();
        }

        // Make sure the user has permission to view the ticket
        if ($ticket->user_id != $this->currentUser->id and !$this->currentUser->group->is_staff) {
            return $this->showNoPermission();
        }

        // Merge ticket and replies into a single array
        $messages = array_merge([$ticket], $ticket->replies->fetchAll());

        // Send data to view.
        $this->set(compact('ticket', 'messages'));
    }

    /**
     * New ticket page.
     */
    public function newAction()
    {
        $ticket = new Ticket;

        // Check if the form has been submitted
        if (Request::method() == 'post') {
            $ticket->set([
                'summary'       => Request::$post['summary'],
                'issue'         => Request::$post['issue'],
                'user_id'       => $this->currentUser->id,
                'department_id' => Request::$post['department'],
                'priority_id'   => Request::$post['priority']
            ]);

            // Save and redirect
            if ($ticket->save()) {
                Request::redirectTo($ticket->href());
            }
        }

        $this->set(compact('ticket'));
    }
}
