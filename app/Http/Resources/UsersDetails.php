<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UsersDetails extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
			'email' => $this->email,
			'gender' => $this->gender,
			'dateofBirth' => $this->dateofBirth,
			'biography' => $this->biography,
			'profilepicture' => $this->profilepicture
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0',
            'author_url' => url('http://vishant.com')
        ];
    }
}
