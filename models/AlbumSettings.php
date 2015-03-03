<?php

/**
 * Album Settings allows admin to configure the album settings.
 * 
 * @author rifaideen<rifajas@gmail.com>
 */
class AlbumSettings extends CFormModel
{
    public $allowedExtensions;
    
    public function rules()
    {
        return [
            ['allowedExtensions', 'filter', 'filter' => 'trim'],
            ['allowedExtensions', 'required']
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'allowedExtensions' => 'Allowed Image Extensions'
        ];
    }
}
