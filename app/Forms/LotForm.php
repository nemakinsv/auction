<?php


namespace App\Forms;

use App\User;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class LotForm extends Form
{
    public function buildForm()
    {

        $value = 'required|mimes:jpeg,jpg,gif,png|max:5128';
        $this->add('name', Field::TEXT, [
            'rules' => 'required|string|max:255',
            'label' => 'Название',
        ])->add('start_price', Field::NUMBER, [
            'rules' => 'required|numeric|between:0,99999999',
            'label' => 'Цена',
        ])->add('src', Field::FILE, [
        'rules' => $value,
        'label' => "Изображение",
        'attr' => [
            'class' => 'form-control clear-bg'
        ],
//        ])->add('auction_price', Field::NUMBER, [
//            'rules' => 'required|numeric|between:0,99999999',
//            'label' => 'Аукционная цена',
        ])->add('submit', 'submit', ['label' => 'Сохранить']);
    }
}
