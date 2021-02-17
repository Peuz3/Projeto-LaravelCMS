<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;

        //Contagem de Visitantes
        $visitsCount = Visitor::count();

        //Contagem de Usuários On-line
        $dateLimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('date_access', '>=', $dateLimit)->groupBy('ip')->get();
        $onlineCount = count($onlineList);

        //Contagem de Páginas
        $pageCount = Page::count();

        //Contagem de Usuários
        $userCount = User::count();

        //Contagem do PagePie
        $pagePie = [];
        $visitsAll = Visitor::selectRaw('page, count(page) as countPage')->groupBy('page')->get();
        foreach($visitsAll as $visit)
        {
            $pagePie[$visit['page']] = intval($visit['countPage']);
            //Gera cores aleatórias
            $pagePieColors[] = 'rgba('.rand(0, 255).', '.rand(0, 255).', '.rand(0, 255).')';
        }

        $pageLabels = json_encode(array_keys($pagePie));
        $pageValues = json_encode(array_values($pagePie));
        $pagePieColors = json_encode( array_values($pagePieColors));

        return view('admin.home',[
            'visitsCount' => $visitsCount,
            'onlineCount' => $onlineCount,
            'pageCount' => $pageCount,
            'userCount' => $userCount,
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues,
            'pagePieColors' => $pagePieColors
        ]);
    }
}
