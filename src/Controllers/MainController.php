<?php

namespace src\Controllers;

use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\ServerRequest;
use MiladRahimi\PhpRouter\View\View;
use ORM;

class MainController
{
    public function index(View $view)
    {
        return $view->make('index');
    }

    public function detail_page(View $view, $id)
    {
        $review = ORM::forTable('reviews')->find_many();
        $tour = ORM::forTable('tours')->find_one($id);
        return $view->make('detail-page', [
            'items'=>$review,
            'tour'=>$tour
        ]);
    }

    public function tour(ServerRequest $request)
    {
        $name = $request->getParsedBody()['name'];
        $note = $request->getParsedBody()['note'];
        $price = $request->getParsedBody()['price'];
        $photo = $request->getParsedBody()['photo'];
        $program_note = $request->getParsedBody()['program_note'];

        $tour = ORM::for_table('tours')
            ->where('name', $name)
            ->where('note', $note)
            ->where('price', $price)
            ->where('photo', $photo)
            ->where('program_note', $program_note)
            ->find_one();
        if ($tour == true) {
            return new RedirectResponse('/detail-page/{id}');
        }
    }
}