<?php

namespace App\Services\Attachment;

use App\Enums\V1\User\Attachment\Type;
use App\Models\Trader4\V1\Post;
use App\Models\Trader4\V1\User\Attachment;
use App\Repositories\V1\My\Account\Attachment\AttachmentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateAttachmentService
{
    public function __construct(
        private AttachmentRepository $attachmentRepository,
    )
    {
    }



    public function getAttachments(string $userId)
    {
         $this->attachmentRepository->getAttachmentByUser($userId);
    }

    public function showAttachment(string $attachmentId)
    {
         $this->attachmentRepository->find($attachmentId);
    }

    public function upload($file,string $id)
    {
        $user = $this->userRepository->find($id);
        $data['path']=$file;
        $data['type']=Attachment::DOCUMENT;
        $attachment = $this->attachmentRepository->createAttachment($data);
        $user->attachments()->attach($attachment);



    }

    public function create(Model $model, UploadedFile $file): string
    {

        $path = $this->upload($file);

        $this->attachmentRepository->create([
            'attachmentable_id' => $model->id,
            'attachmentable_type' => get_class($model),
            'path' => $this->getFileURL($path),
            'type' => Type::IMAGE // Todo:: need to define file types
        ]);

        return true;
    }

    public function deleteAttachment($attachmentId)
    {
        $this->attachmentRepository->find($attachmentId)->delete();
    }



    public function addLogo(Post $product, UploadedFile $logo): string
    {//TODO should handle min.io storage
        if (!empty($product->logo)){
            $this->removeOldMediaFile(storage_path('applications/logos/') . $product->logo);
        }

        $imageName = $this->getMediaName($product, $logo);
        $logo->move(storage_path('applications/logos'), $imageName);

        $this->appRepository->updateModel($product, [
            'logo' => $imageName
        ]);

        return $imageName;
    }

    public function addCover(Post $product, UploadedFile $cover): string
    {//TODO should handle min.io storage

        if (!empty($product->cover))
        {
            $this->removeOldMediaFile(storage_path('applications/covers/') . $product->cover);
        }

        $imageName =  $this->getMediaName($product, $cover);
        $cover     -> move(storage_path('applications/covers'), $imageName);

        $this->appRepository->updateModel($product, [
            'cover' => $imageName
        ]);

        return $imageName;
    }

    private function removeOldMediaFile(string $path)
    {
        if(file_exists($path)){

            return unlink($path);
        }

        return true;
    }



}
