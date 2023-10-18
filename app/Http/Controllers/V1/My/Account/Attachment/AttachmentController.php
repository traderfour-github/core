<?php

namespace App\Http\Controllers\V1\My\Account\Attachment;

use App\Http\Controllers\V1\Controller;
use Briofy\FileSystem\Http\Requests\CreateAttachmentRequest;
use Briofy\FileSystem\Http\Resources\AttachmentResource;
use Briofy\FileSystem\Jobs\StoreAttachmentJob;


class AttachmentController extends Controller
{


    public function create(CreateAttachmentRequest $request)
    {

        try {
            return $this->respond(AttachmentResource::make(dispatch_sync(new StoreAttachmentJob(
                $request->validated(),
                $request->user()['uuid'],
                config('trader4.posts.disk'),
                config('trader4.posts.path')
            ))));
        } catch (\Exception $exception) {
            return $this->exceptionHandler($exception);
        }
    }
}
