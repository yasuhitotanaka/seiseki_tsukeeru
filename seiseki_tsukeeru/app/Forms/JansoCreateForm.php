<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;


class JansoCreateForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required|min:1',
                'label' => '雀荘の名前'
            ])
            ->add('location', Field::TEXT, [
                'label' => '場所'
            ])
            ->add('submit', Field:: BUTTON_SUBMIT, ['label' => '保存']);
    }

    protected function isNew()
    {
        return empty($this->model->id);
    }
}
