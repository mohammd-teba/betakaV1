<?php


/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/12/17
 * Time: 2:50 PM
 */

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

function authAdmin()
{
    if (auth()->guard('admin')->check())
        return auth()->guard('admin')->user();
    return null;
}

function user()
{
    if (auth()->check())
        return auth()->user();
    return null;
}

function admin_dashboard_url()
{
    return '/admin/home';
}

function empObj()
{
    return new stdClass();
}

function modals($page)
{
    return 'admin.modals.' . $page;
}

function assets($folder)
{
    return url('assets/' . $folder . '/assets');
}

function layouts($folder)
{
    return $folder . '.layout';
}

function dashboard()
{
    return 'Dashboard';
}

function admin_vw()
{
    return 'admin';
}
function admin_test_vw()
{
    return admin_vw() . '.test';
}

function admin_test_url()
{
    return 'admin/test';
}

function admin_web_url()
{
    return 'admin/web';
}

function admin_admins_url()
{
    return 'admin/admins';
}
function admin_admins_vw()
{
    return admin_vw() . '.admins';
}

function admin_home_url()
{
    return 'admin/home';
}

function admin_users_vw()
{
    return admin_vw() . '.users';
}


function admin_users_url()
{
    return admin_vw() . '/users';
}

function admin_settings_vw()
{
    return admin_vw() . '.settings';
}

function admin_settings_url()
{
    return admin_vw() . '/settings';
}


function admin_roles_url()
{
    return 'admin/roles';
}

function admin_roles_vw()
{
    return 'admin.roles';
}


function public_url()
{
    return url('public/');
}

function upload_url()
{
    return base_path() . '/assets/upload';
}

function upload_assets()
{
    return url('/assets/upload');
}

function upload_storage()
{
    return storage_path('app');
}

function loader_icon()
{
    return url(assets('admin') . '/apps/img/preloader.gif');
}

function user_vw()
{
    return 'user';
}



function admin_sectors_url()
{
    return 'admin/sectors';
}

function admin_sectors_vw()
{
    return 'admin.sectors';
}
function admin_categories_url()
{
    return 'admin/categories';
}

function admin_categories_vw()
{
    return 'admin.categories';
}
function admin_managerMessages_url()
{
    return 'admin/managerMessages';
}

function admin_managerMessages_vw()
{
    return 'admin.managerMessages';
}
function admin_teams_url()
{
    return 'admin/teams';
}

function admin_teams_vw()
{
    return 'admin.teams';
}
function admin_projects_url()
{
    return 'admin/projects';
}

function admin_projects_vw()
{
    return 'admin.projects';
}
function admin_partners_url()
{
    return 'admin/partners';
}

function admin_partners_vw()
{
    return 'admin.partners';
}



function max_pagination($record = 10.0)
{
    return $record;
}

function admin_layout_vw()
{
    return 'admin.layout';
}


function site_layout_vw()
{
    return 'site.layout';
}

function notification_trans()
{
    return 'app.notification_message';
}


function message($status_code)
{
    switch ($status_code) {
        case 200:
            return __('app.success');
        case 400:
            return __('app.not_data_found');
        case 401:
            return __('app.invalid_token');
        case 404:
            return __('app.invalid_route');
        case 422:
            return __('app.client_input_error');//'Client input error.';
        case 500:
            return __('app.server_error');//'Something went wrong. Please try again later.';
    }
    return 'Sorry! You do not have permission.';
}

function response_api($status, $statusCode, $message = null, $object = null, $page_count = null, $page = null, $count = null, $errors = null, $another_data = null)
{

    $message = isset($message) ? $message : message($statusCode);
    $error = ['status' => false, 'statusCode' => $statusCode, 'message' => $message];
    $success = ['status' => true, 'statusCode' => $statusCode, 'message' => $message];

    if ($status && isset($object)) {
        if (isset($page_count) && isset($page)) {
            if (isset($another_data))
                $success['items'] = ['info' => $another_data, 'data' => $object, 'total_pages' => $page_count, 'current_page' => $page + 1, 'total_records' => $count];
            else
                $success['items'] = ['data' => $object, 'total_pages' => $page_count, 'current_page' => $page + 1, 'total_records' => $count];
        } else
            $success['items'] = $object;

    } else if (!$status && isset($errors))
        $error['errors'] = $errors;
    else if (isset($object) || (is_array($object) && empty($object)))
        $error['items'] = $object;

    if (isset($another_data))
        foreach ($another_data as $key => $value)
            $success [$key] = $value;
    $response = ($status) ? $success : $error;
    return response()->json($response);
}

function page_count($num_object, $page_size)
{
    return ceil($num_object / (doubleval($page_size)));
}

function uploadFileImage($file, $path = '')
{

    $ImageName = Str::random(16) . '.' . $file->getClientOriginalExtension();
    $FolderName = Carbon::now()->toDateString();
    $ImagePath = public_path() . '/upload/';
    // check if directory for ProfileImage  exists, if not then create one
    if (!File::exists($ImagePath)) {
        File::makeDirectory($ImagePath, 0777, true);
    }
    // save the ProfileImage as it is
    try
    {
        Image::make($file->getRealPath())->interlace(true)->save($ImagePath . $ImageName);
        return $ImageName;
    }
    catch(\Intervention\Image\Exception\NotReadableException $e)
    {
        return false;
    }

}

