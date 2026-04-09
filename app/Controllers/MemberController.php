<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\View;
use App\Models\MemberModel;

class MemberController
{
    private MemberModel $members;

    public function __construct()
    {
        $this->members = new MemberModel();
    }

    public function index(): void
    {
        $members = $this->members->all();

        View::render('user/members/index', [
            'members' => $members,
            'activePage' => 'members',
        ]);
    }

    public function show(int $id): void
    {
        if ($id <= 0) {
            redirect('/members');
        }

        $member = $this->members->find($id);

        if ($member === null) {
            redirect('/members');
        }

        View::render('user/members/show', [
            'member' => $member,
            'activePage' => 'members',
        ]);
    }
}
