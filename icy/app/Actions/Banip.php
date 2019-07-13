<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Banip extends AbstractAction
{
    public function getTitle()
    {
        return 'Ban IP';
    }

    public function getIcon()
    {
        return 'voyager-eye';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        $id = $this->data->{$this->data->getKeyName()};
        return [
            'class' => 'btn btn-sm btn-danger pull-right banip',
            'onclick' => "banip(event,". $id .")",
            'id' => $id
        ];
    }

    public function getDefaultRoute()
    {
        //return ('/admin/users/'.$this->data->{$this->data->getKeyName()}.'/banip');

        return ('javascript:;');
    
    }

    public function shouldActionDisplayOnDataType()
    {
    return $this->dataType->slug == 'users';
    }
}