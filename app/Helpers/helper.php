<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

/**
 * Returns current timestamp in format = 'Y-m-d-H-m-s-u'
 * @return string
 */
function timestamp()
{
    return Carbon::now()->format('Y-m-d-H-m-s-u');
}
/**
 * Stores an image given an image request and a directory
 *@param UploadedFile $image
 * @param string $old_path
 * @param string $dir
 * @param string $prefix skip if you need clientOriginalName
 * @param string $disk default = public
 * @return string $new_path
 */
function saveImage($image, string $dir, ?string $prefix = '', string $disk = 'public')
{
    if ($image) {
        if ($prefix === '' || $prefix === null) {
            $prefix = str($image->getClientOriginalName())->slug();
        }
        $ext  = $image->extension();
        $name = $prefix . "-" . timestamp() . '.' . $ext;
        $path = $image->storeAs("uploads/$dir", $name, $disk);
        return $path;
    } else {
        return $image;
    }
}

/**
 * Updates a file given a new file and old path
 * @param UploadedFile $file
 * @param string $old_path
 * @param string $dir
 * @param string $prefix skip if you need clientOriginalName
 * @param string $disk default = public
 * @return string $new_path
 */
function updateFile($file, $old_path, $dir, $prefix = "", $disk = "public")
{
    if ($file === null) {
        return $old_path;
    }
    $new_path = $old_path;
    $isFile   = str($old_path)->contains('/storage');
    if ($isFile) {
        $old_path = explode("storage", $old_path)[ 1 ];
    }
    $path       = $old_path ? $disk . "/" . $old_path : 'no file exists';
    $fileExists = Storage::exists($path);
    if ($fileExists) {
        if ($file) {
            $new_path = saveImage($file, $dir, $prefix, $disk);
            Storage::delete($path);
        }
    } else {
        $new_path = saveImage($file, $dir, $prefix, $disk);
    }
    return $new_path;
}

/**
 * Deletes a file given its path from database
 * @param string $old_path
 * @param string $disk default = public
 */
function deleteFile($old_path, $disk = 'public')
{
    $isFile = str($old_path)->contains('/storage');
    if ($isFile) {
        $old_path = explode("storage", $old_path)[ 1 ];
    }
    $path    = $disk . '/' . $old_path;
    $deleted = false;
    if (Storage::exists($path)) {
        $deleted = Storage::delete($path);
    }
    return $deleted;
}

function ownerId()
{
    return 1;
}

function productId()
{
    // Only in development and local server
    if (env('SEEDING')) {
        return Product::first()->id;
    }
    return request()->cookie('product_id');
}

function demoSub()
{
    $sub = User::where('type', 'subscriber')->first();
    return $sub;
}

/**
 * Use this only in CanSendNotification Trait
 *
 * @param mixed $model
 * @param int $productId
 * @return array
 */
function getNotificationData($model, $productId = null)
{
    $productId = $productId ?? productId();
    $initiator = auth()->user();
    $users     = Product::find($productId)?->users;
    if ($users) {
        $users = $users->filter(function (User $user) use ($initiator) {
            return $user->id != auth()->id();
        });
    } else {
        $users = [  ];
    }
    // dd($model);
    $feature = explode('\\', $model);
    $feature = array_pop($feature);

    return [ $users, $initiator, $feature ];
}
/**
 * Image or favicon default
 *
 * @param Image|null $url
 * @return string
 */
function favicon(?Image $url = null)
{
    if ($url != null) {
        return $url->url;
    } else {
        return asset('img/p6.png');
    }

}

function avatar(string $seed = null)
{
    if ($seed == null) {
        $seed = str()->random(10);
        return "https://api.dicebear.com/7.x/bottts-neutral/svg?seed=$seed&radius=50";
    }
    $seed = str($seed)->slug();
    return "https://api.dicebear.com/7.x/initials/svg?seed=$seed&radius=50";
}

/**
 * Set env variables
 *
 * @param array<string,string> $values
 * @return void
 */
function setEnv($values)
{
    $envFile = base_path('.env');
    foreach ($values as $key => $value) {
        $envContent = File::get($envFile);
        $pattern           = "/^({$key}=)(.*)$/m";
        $updatedEnvContent = preg_replace($pattern, "$1\"{$value}\"", $envContent);
        File::put($envFile, $updatedEnvContent);
    }
    Artisan::call('config:clear');

}
