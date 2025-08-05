<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Setting;

class SettingController
{
    public function index()
    {
        $this->checkAuth();
        $setting = Setting::get();
        View::render('settings/index.php', ['setting' => $setting], 'layouts/admin.php');
    }

    public function update()
    {
        $this->checkAuth();
        $title = $_POST['site_title'];
        $desc = $_POST['site_description'];

        $setting = Setting::get();
        $logo = $setting['site_logo'];

        if (!empty($_FILES['site_logo']['name'])) {
            $filename = time() . "_" . basename($_FILES['site_logo']['name']);
            move_uploaded_file($_FILES['site_logo']['tmp_name'], __DIR__ . "/../../public/uploads/" . $filename);
            $logo = $filename;
        }

        \App\Models\Setting::update($title, $desc, $logo);
        header("Location: /admin/settings");
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }
}
