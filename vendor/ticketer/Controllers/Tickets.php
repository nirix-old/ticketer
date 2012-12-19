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
use Radium\Util\Inflector;

use Ticketer\Models\Ticket;
use Ticketer\Models\TicketReply;
use Ticketer\Models\Department;
use Ticketer\Models\Status;

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
     * Update ticket.
     *
     * @param integer $id
     */
    public function updateAction($id)
    {
        if (Request::method() != 'post') {
            Request::redirectTo('/');
        }

        // Get the ticket
        $ticket = Ticket::find($id);

        // Ticket changes
        $changes = [];
        foreach (['department', 'status', 'priority'] as $property) {
            if ($ticket->{$property . '_id'} != Request::$post[$property]) {
                $change = ['property' => $property];

                switch ($property) {
                    case 'department':
                    case 'status':
                        $class = "\\Ticketer\\Models\\" . Inflector::classify($property);
                        $change['from'] = $class::find($ticket->{"{$property}_id"})->name;
                        $change['to'] = $class::find(Request::$post[$property])->name;
                        break;

                    case 'priority':
                        $change['from'] = getPriorityName($ticket->priority_id);
                        $change['to'] = getPriorityName(Request::$post['priority']);
                        break;
                }

                $changes[] = $change;
            }
        }

        // Update ticket properties
        $ticket->set([
            'department_id' => Request::$post['department'],
            'status_id'     => Request::$post['status'],
            'priority_id'   => Request::$post['priority']
        ]);

        // Ticket reply
        $reply = new TicketReply([
            'message'   => Request::$post['message'],
            'user_id'   => $this->currentUser->id,
            'ticket_id' => $ticket->id,
            'changes'   => json_encode($changes)
        ]);

        if (count($changes) or Request::$post['message'] != '') {
            if ($reply->save() and $ticket->save()) {
                Request::redirectTo($ticket->href());
            }
        } else {
            Request::redirectTo($ticket->href());
        }

        $this->set(compact('ticket', 'reply'));
        $this->render['view'] = 'tickets/view';
    }
}
