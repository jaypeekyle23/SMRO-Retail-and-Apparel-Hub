<?php

namespace App\Controllers;

use App\Models\ApplicationModel;

class Profile extends BaseController
{
    public function index()
    {
        $applicationModel = new ApplicationModel();
        $user             = $applicationModel->getUser(username: session()->get('username'));

        $data = array_merge($this->data ?? [], [
            'title' => 'My Profile',
            'user'  => $user
        ]);

        return view('pages/profile/index', $data);
    }

    public function update()
    {
        $applicationModel = new ApplicationModel();
        $user             = $applicationModel->getUser(username: session()->get('username'));

        if (!$this->validate([
            'fullname' => 'required|min_length[2]',
            'email'    => 'required|valid_email',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->table('users')->update([
            'fullname' => $this->request->getPost('fullname'),
            'email'    => $this->request->getPost('email'),
            'username' => $this->request->getPost('email'),
        ], ['id' => $user['userID']]);

        // Update session
        session()->set('username', $this->request->getPost('email'));

        return redirect()->to('profile')->with('success', 'Profile updated successfully!');
    }

    public function changePassword()
    {
        $applicationModel = new ApplicationModel();
        $user             = $applicationModel->getUser(username: session()->get('username'));

        if (!$this->validate([
            'current_password'  => 'required',
            'new_password'      => 'required|min_length[6]',
            'confirm_password'  => 'required|matches[new_password]',
        ])) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        // Verify current password
        if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Update password
        $db = \Config\Database::connect();
        $db->table('users')->update([
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)
        ], ['id' => $user['userID']]);

        return redirect()->to('profile')->with('success', 'Password changed successfully!');
    }
}