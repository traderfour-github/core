<?php

namespace App\Repositories\V1\My\Account\Attachment;

use App\Models\Trader4\V1\User\Attachment;
use App\Models\Trader4\V1\User\User;
use Briofy\RepositoryLaravel\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class AttachmentRepository extends AbstractRepository implements IAttachmentRepository
{
    public function getAttachmentByUser(string $userId)
    {

       $user = User::where('id',$userId)->whereHas('attachments',function ($attachmentQuery)use($userId){
         return $attachmentQuery->where('attachmentable_id',$userId);
       })->get();
    }

    protected function instance(array $attributes = []): Model
    {
        return new Attachment();
    }
}
