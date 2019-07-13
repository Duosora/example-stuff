<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Deleteall extends AbstractAction
{
    public function getTitle()
    {
        return 'Delete All Posts';
    }

    public function getIcon()
    {
        return 'voyager-trash';
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
            'onclick' => "deleteall(event,'". $id ."_u')",
            'id' => $id."_u"
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