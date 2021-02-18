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
    
    public function index(Request $request)
    {
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;
        $interval = intval($request->input('interval',30));
        if($interval > 120)
        {
            $interval = 120;
        }

        //Contagem de Visitantes
        $dateInterval = date('Y-m-d H:i:s',strtotime('-' . $interval . ' days'));
        $visitsCount = Visitor::where('date_access','>=', $dateInterval)->count();

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
        $pagePieColors = [];
        $visitsAll = Visitor::selectRaw('page, count(page) as countPage')
                ->where('date_access','>=', $dateInterval)
                ->groupBy('page')
                ->get();
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
            'dateInterval' => $interval,
            'pagePieColors' => $pagePieColors
            
        ]);
    }
}
