<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $meta = array(
            'title' => 'Keto UK',
            'description' => 'Receive 6-8 different Keto friendly products, shipped directly to your door every month for £30 – that’s less than £1 a day!',
            'section' => 'Home',
            'subSection' => 'Home'
        );

        return view('pages/home', compact('meta'));
    }

    public function holding(){
        return view('pages/holding');
    }

    public function faqs(){
        $meta = array(
            'title' => 'Keto UK',
            'description' => 'Receive 6-8 different Keto friendly products, shipped directly to your door every month for £30 – that’s less than £1 a day! Faqs',
            'section' => 'Faq',
            'subSection' => 'Faq'
        );

        return view('pages/faq', compact('meta'));
    }

    public function terms(){
        $meta = array(
            'title' => 'Keto UK',
            'description' => 'Receive 6-8 different Keto friendly products, shipped directly to your door every month for £30 – that’s less than £1 a day! terms and conditions',
            'section' => 'Terms',
            'subSection' => 'Terms'
        );

        return view('pages/terms', compact('meta'));
    }

    public function about(){
        $meta = array(
            'title' => 'Keto UK',
            'description' => 'Receive 6-8 different Keto friendly products, shipped directly to your door every month for £30 – that’s less than £1 a day! about',
            'section' => 'About',
            'subSection' => 'About'
        );

        return view('pages/about', compact('meta'));
    }

    public function privacy(){
        $meta = array(
            'title' => 'Keto UK',
            'description' => 'Receive 6-8 different Keto friendly products, shipped directly to your door every month for £30 – that’s less than £1 a day! privacy',
            'section' => 'Privacy',
            'subSection' => 'Privacy'
        );

        return view('pages/privacy', compact('meta'));
    }
}
