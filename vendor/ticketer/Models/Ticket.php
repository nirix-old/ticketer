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
 * Ticket model.
 *
 * @package Ticketer
 * @subpackage Models
 */
class Ticket extends \Radium\Database\Model
{
    protected static $_table = 'tickets';

    protected static $_validates = [
        'summary'       => ['required'],
        'issue'         => ['required'],
        'user_id'       => ['numeric'],
        'department_id' => ['numeric'],
        'is_closed'     => ['numeric']
    ];

    protected static $_belongsTo = ['user', 'status', 'department'];
    protected static $_hasMany = [
        'replies' => ['model' => 'TicketReply', 'foreignKey' => 'ticket_id']
    ];

    /**
     * Returns the URI for the ticket.
     *
     * @return string
     */
    public function href($uri = null)
    {
        return "/tickets/{$this->id}" . ($uri !== null ? "/" . trim($uri, '/') : '');
    }

    /**
     * Save ticket
     */
    public function save()
    {
        // Set is_closed value based off status
        if ($status = Status::find($this->status_id)) {
            $this->is_closed = $status->is_closed;
        }

        return parent::save();
    }
}
