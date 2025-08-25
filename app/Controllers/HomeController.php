<?php
class HomeController extends Controller
{
    public function index()
    {
        Auth::check();
        $this->view('home/index');
    }
}
