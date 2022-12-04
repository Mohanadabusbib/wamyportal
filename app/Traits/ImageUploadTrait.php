<?php

namespace App\Traits;

trait ImageUploadTrait
{
    protected $avatar_path  = "app/public/images";

    protected $avatar_height=240;

    protected $avatar_width=240;

    public function imageName($image)
    {
        return time().'-'.$image->getClientOriginalName();
    }

    public function uploadAvatar($img)
    {
        $img_name=$this->imageName($img);
        $img->storeAs($this->avatar_path,$img_name);
        \Image::make($img)->resize($this->avatar_width,$this->avatar_height)->save(storage_path($this->avatar_path.'/'.$img_name));

        return $img_name;
    }

}
