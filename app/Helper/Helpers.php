<?php


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


// ==============================================================================================================================

// delete item in database  
if (!function_exists('deleteItem')) {
    function deleteItem($model, $id, $oldimagepath)
    {
        try {
            $modelInstance = $model::findOrFail($id);
            $image = $modelInstance->image ?? null;

            if ($image) {
                $imagePath = storage_path('app/' . $oldimagepath . '/' . $image);
                if (file_exists($imagePath)) {
                    if (unlink($imagePath)) {
                        info('File deleted successfully');
                    } else {
                        info('Failed to delete file');
                    }
                } else {
                    info('File does not exist');
                }
            }
            $modelInstance->delete();
            return [
                'success' => true,
                'message' => 'Record deleted successfully'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Something went wrong, please refresh the page'
            ];
        }
    }
}



if (!function_exists('storeImageDatabase')) {
    function storeImageDatabase($file, string $path, string $prefix): string
    {
        $fileName = $prefix . '_' . time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs($path, $fileName);
        return basename($filePath);
    }
}


// delete image in main Storage folder  
if (!function_exists('deleteImageInStorage')) {
    function deleteImageInStorage(string $path, string $fileName)
    {
        $filePath = storage_path('app/' . $path . '/' . $fileName);
        if (File::exists($filePath)) {
            return File::delete($filePath);
        }
    }
}
