<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;


class ScoreRegisterForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('first_number', Field::NUMBER , [
                'rules' => 'required|min:1',
                'label' => '1位の数'
            ])
            ->add('second_number', Field::NUMBER , [
                'rules' => 'required|min:1',
                'label' => '2位の数'
                ])
            ->add('third_number', Field::NUMBER , [
                'rules' => 'required|min:1',
                'label' => '3位の数'
            ])
            ->add('fourth_number', Field::NUMBER , [
                'rules' => 'required|min:1',
                'label' => '4位の数'
            ])
            ->add('income', Field::NUMBER , [
                'rules' => 'required|numeric',
                'label' => '収支    '
            ])
            ->add('submit', Field:: BUTTON_SUBMIT, ['label' => '保存']);
    }

    protected function isNew()
    {
        return empty($this->model->id);
    }
}
