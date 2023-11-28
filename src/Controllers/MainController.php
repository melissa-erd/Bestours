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
        $tour = ORM::forTable('tours')->find_many();
        return $view->make('index', [
            'tours' => $tour]);
    }

    public function detail_page(View $view, $id)
    {
        $tour = ORM::forTable('tours')->find_one($id);

        $photos = ORM::forTable('photos')
            ->select('*')
            ->select('photos.photo', 'img')
            ->join('tours', ['photos.tours_id', '=', 'tours.id'])
            ->where('tours.id', $id)
            ->find_many();

        return $view->make('detail-page', [
            'tours' => $tour,
            'photos' => $photos
        ]);

    }

//    public function tour(ServerRequest $request)
//    {
//        $name = $request->getParsedBody()['name'];
//        $note = $request->getParsedBody()['note'];
//        $price = $request->getParsedBody()['price'];
//        $photo = $request->getParsedBody()['photo'];
//        $program_note = $request->getParsedBody()['program_note'];
//
//        $tour = ORM::for_table('tours')
//            ->where('name', $name)
//            ->where('note', $note)
//            ->where('price', $price)
//            ->where('photo', $photo)
//            ->where('program_note', $program_note)
//            ->find_one();
//        if ($tour == true) {
//            return new RedirectResponse('/detail-page/{id}');
//        }
//    }
}