<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;

trait FileHandlingTrait
{
    public function saveFile($file, $folder)
    {
        $this->createFolder($folder);
        // Saving The File
        $fileExtension = $file->getClientOriginalExtension();
        $file_name = uniqid(time()) . '.' . $fileExtension;
        $file_name_DataBase = $folder . '/' . $file_name;
        $file->move(base_path($folder), $file_name_DataBase);
        return $file_name_DataBase;
    }


    public function updateFile($object, $request, $file_name, $folder_name)
    {
        if ($request->hasFile($file_name)) {
            $this->deleteFile($object, $file_name);
            $file = $this->saveFile($request->file($file_name), $folder_name);
            return $file;
        } else
            return $object->$file_name;
    }

    public function deleteFile($object, $file_name)
    {
        $file_destination =  $object->$file_name;
        if (File::exists($file_destination)) {
            File::delete($file_destination);
        }
    }

    public function createFolder($folder)
    {
        if (!File::exists(base_path($folder))) {
            File::makeDirectory(base_path($folder));
        }
    }
}